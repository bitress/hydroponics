document.addEventListener('DOMContentLoaded', function () {
    const sensorIds = [1, 3, 4, 5, 6, 8, 11];
    const dateRangeSelect = document.getElementById('dateRangeSelect');
    const chartDiv = document.getElementById('sensor_data_chart');
    let autoRefreshInterval;
    let currentSensorId = 'all'; 

    

    const fetchSensorData = (sensorId, range) => {
        const params = new URLSearchParams();
        params.append('range', range);

        if (sensorId === 'all') {
            sensorIds.forEach(id => params.append('sensor_id[]', id));
        } else {
            params.append('sensor_id[]', sensorId);
        }

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
                return null;
            });
    };

    const createTraces = (groupedData) => {
        const traces = [];
        for (const sensorId in groupedData) {
            const sensorData = groupedData[sensorId];
            if (sensorData.length === 0) {
                continue;
            }
            const sensorName = sensorData[0].sensor_name;
            
            console.log(`Sensor Name: ${sensorName}`); // Debugging: Check if the name is available
    
            sensorData.sort((a, b) => a.reading_time - b.reading_time);
            const x = sensorData.map(d => d.reading_time);
            const y = sensorData.map(d => d.value);
            const trace = {
                x: x,
                y: y,
                mode: 'lines+markers',
                name: sensorName, // Label to show
                type: 'scatter', 
                line: {
                    shape: 'linear'
                },
                marker: {
                    size: 6 
                }
            };
            traces.push(trace);
        }
        return traces;
    };
    

    const updateChart = (sensorId, range) => {
        console.log(`Updating chart for sensorId: ${sensorId}, range: ${range}`); // Debugging: Check selected sensor and range
        Plotly.newPlot(chartDiv, [], { title: 'Loading...' });
    
        fetchSensorData(sensorId, range)
            .then(groupedData => {
                if (!groupedData) {
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
    
                console.log(`Traces for sensor ${sensorId}:`, traces); // Debugging: Check traces data
    
                const layout = {
                    title: 'Sensor Data Overview',
                    xaxis: {
                        title: 'Reading Time',
                        type: 'date',
                        tickformat: '%Y-%m-%d %H:%M:%S',
                        tickangle: -45 
                    },
                    yaxis: {
                        title: 'Sensor Values',
                        tickformat: '.2f' 
                    },
                    legend: {
                        orientation: 'h', 
                        y: -0.2
                    },
                    margin: {
                        b: 150            
                    },
                    hovermode: 'closest' 
                };
    
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
    
    const startAutoRefresh = (sensorId, range) => {
        if (autoRefreshInterval) {
            clearInterval(autoRefreshInterval);
        }
        autoRefreshInterval = setInterval(() => {
            updateChart(sensorId, range);
        }, 10000);
    };

    const initialRange = dateRangeSelect.value;
    updateChart('all', initialRange);  
    startAutoRefresh('all', initialRange);

    dateRangeSelect.addEventListener('change', function () {
        const selectedRange = this.value;
        updateChart(currentSensorId, selectedRange);
        startAutoRefresh(currentSensorId, selectedRange);
    });

    $('.view').on('click', function () {
        var sensorId = $(this).data('value'); 
        currentSensorId = sensorId;  
        updateChart(sensorId, initialRange);
        startAutoRefresh(sensorId, initialRange);
    });

    $('#backToAllButton').on('click', function () {
        currentSensorId = 'all';  
        updateChart('all', initialRange);
        startAutoRefresh('all', initialRange);
    });
});
