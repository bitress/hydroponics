const categories = [];
const seriesData = [];

const currentDate = new Date();
for (let i = 0; i < 24; i++) {

    const hour = new Date(currentDate);
  hour.setHours(i, 0, 0, 0);
  categories.push(hour.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));

  const randomPhValue = (Math.random() * (7.5 - 5.5) + 5.5).toFixed(2);
  seriesData.push(randomPhValue);
}

// Chart options
const options = {
  chart: {
    id: 'ph-level-chart',
    type: 'line',
    zoom: { enabled: false },
  },
  xaxis: {
    categories: categories,
    title: {
      text: 'Time (Hours)',
    },
  },
  yaxis: {
    title: {
      text: 'pH Level',
    },
    min: 5,
    max: 8,
  },
  stroke: {
    curve: 'smooth',
  },
  markers: {
    size: 5,
  },
  tooltip: {
    shared: true,
    intersect: false,
  },
  series: [{
    name: 'pH Level',
    data: seriesData,
  }],
};

// Create the chart
const chart = new ApexCharts(document.querySelector("#ph_level_chart"), options);
chart.render();



function initializeTemperatureChart() {
    var options = {
      chart: {
        type: 'line',
        height: 350
      },
      series: [{
        name: 'Temperature',
        data: [25, 26, 28, 29, 30, 32, 33]  // Example data for a week
      }],
      xaxis: {
        categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']  // Days of the week
      },
      title: {
        text: 'Temperature Over the Week',
        align: 'center'
      }
    };

    // Render the chart
    var temperatureChart = new ApexCharts(document.querySelector("#temperature_chart"), options);
    temperatureChart.render();
  }

  // Initialize the chart when the page loads
  document.addEventListener('DOMContentLoaded', initializeTemperatureChart);
