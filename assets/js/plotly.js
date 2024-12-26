document.addEventListener('DOMContentLoaded', function () {
    const sensorIds = [1, 2, 3, 4, 5, 6];
    const dateRangeSelect = document.getElementById('dateRangeSelect');
    const chartDiv = document.getElementById('sensor_data_chart');

    /**
     * Function to fetch data for all sensors based on the selected range
     * Optimized to fetch all sensors in a single request
     * @param {string} range - The selected date range
     * @returns {Promise<Object>} - Promise resolving to an object with sensor IDs as keys and their data as values
     */
    const fetchAllSensorData = (range) => {
        const params = new URLSearchParams();
        params.append('range', range);
        sensorIds.forEach(id => params.append('sensor_id[]', id));
        const url = `fetchSensorData.php?${params.toString()}`;

        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const groupedData = {};
                sensorIds.forEach(id => {
                    groupedData[id] = [];
                });
                data.forEach(item => {
                    const sensorId = item.id;
                    if (groupedData[sensorId]) {
                        groupedData[sensorId].push({
                            value: parseFloat(item.value),
                            reading_time: new Date(item.reading_time),
                            sensor_name: item.sensor_name
                        });
                    }
                });
                return groupedData;
            })
            .catch(error => {
                console.error(`Error fetching sensor data:`, error);
                return null; // Return null on error
            });
    };

    /**
     * Function to create Plotly traces from the grouped sensor data
     * @param {Object} groupedData - Object with sensor IDs as keys and their data arrays as values
     * @returns {Array} - Array of Plotly trace objects
     */
    const createTraces = (groupedData) => {
        const traces = [];

        for (const sensorId in groupedData) {
            const sensorData = groupedData[sensorId];
            if (sensorData.length === 0) {
                continue; // Skip if no data for this sensor
            }

            // Assuming all entries have the same sensor_name
            const sensorName = sensorData[0].sensor_name;

            // Sort data by reading_time ascending
            sensorData.sort((a, b) => a.reading_time - b.reading_time);

            // Extract x and y values
            const x = sensorData.map(d => d.reading_time);
            const y = sensorData.map(d => d.value);

            // Create a trace for this sensor
            const trace = {
                x: x,
                y: y,
                mode: 'lines+markers',
                name: sensorName
            };

            traces.push(trace);
        }

        return traces;
    };

    /**
     * Function to update the chart with new data
     * @param {string} range - The selected date range
     */
    const updateChart = (range) => {
        // Show a loading indicator
        Plotly.newPlot(chartDiv, [], {title: 'Loading...'});
        
        fetchAllSensorData(range)
            .then(groupedData => {
                if (!groupedData) {
                    // Handle error case
                    Plotly.newPlot(chartDiv, [], {
                        title: 'Error fetching data',
                        xaxis: { title: 'Reading Time' },
                        yaxis: { title: 'Sensor Values' }
                    });
                    return;
                }

                const traces = createTraces(groupedData);

                if (traces.length === 0) {
                    Plotly.newPlot(chartDiv, [], {
                        title: 'No data available for the selected range',
                        xaxis: { title: 'Reading Time' },
                        yaxis: { title: 'Sensor Values' }
                    });
                    return;
                }

                // Define the layout of the chart
                const layout = {
                    title: 'Sensor Data Overview',
                    xaxis: {
                        title: 'Reading Time',
                        type: 'date',
                        tickformat: '%Y-%m-%d %H:%M:%S',
                        tickangle: -45
                    },
                    yaxis: {
                        title: 'Sensor Values'
                    },
                    legend: {
                        orientation: 'h',
                        y: -0.2
                    },
                    margin: {
                        b: 150 // Increase bottom margin to accommodate rotated x-axis labels
                    }
                };

                // Render the plot
                Plotly.newPlot(chartDiv, traces, layout);
            })
            .catch(error => {
                console.error('Error updating chart:', error);
                Plotly.newPlot(chartDiv, [], {
                    title: 'Error updating chart',
                    xaxis: { title: 'Reading Time' },
                    yaxis: { title: 'Sensor Values' }
                });
            });
    };

    // Initial chart load with default range
    const initialRange = dateRangeSelect.value;
    updateChart(initialRange);

    // Event listener for date range selection change
    dateRangeSelect.addEventListener('change', function () {
        const selectedRange = this.value;
        updateChart(selectedRange);
    });
});