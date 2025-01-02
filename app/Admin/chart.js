// Ensure the DOM is fully loaded before executing the script
window.onload = function () {
    // Get the contexts for each chart
    const ctxDaily = document.getElementById('dailyChart').getContext('2d');
    const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
    const annualCtx = document.getElementById('annualChart').getContext('2d');
  
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const dailySalesData = {
      January: [10, 20, 15, 30, 25, 10, 40, 35, 20, 15, 30, 25, 40, 20, 10, 30, 15, 35, 25, 40, 10, 30, 20, 25, 35, 10, 40, 30, 15, 25],
      February: [5, 15, 10, 20, 15, 5, 25, 30, 15, 10, 20, 15, 25, 15, 5, 20, 10, 30, 15, 25, 5, 20, 15, 25, 35, 5, 30, 25, 10, 20],
      March: [10, 20, 15, 30, 25, 10, 40, 35, 20, 15, 30, 25, 40, 20, 10, 30, 15, 35, 25, 40, 10, 30, 20, 25, 35, 10, 40, 30, 15, 25],
      April: [5, 15, 10, 20, 15, 5, 25, 30, 15, 10, 20, 15, 25, 15, 5, 20, 10, 30, 15, 25, 55, 20, 15, 25, 35, 5, 30, 25, 10, 20],
      May: [10, 20, 15, 30, 25, 10, 40, 35, 20, 15, 30, 25, 40, 20, 10, 30, 15, 35, 25, 40, 10, 30, 20, 25, 35, 10, 40, 30, 15, 25],
      June: [55, 15, 10, 20, 15, 5, 25, 30, 40, 10, 20, 15, 25, 15, 5, 20, 10, 30, 15, 25, 5, 20, 15, 25, 35, 5, 30, 25, 10, 20],
      July: [10, 20, 15, 30, 25, 10, 40, 35, 20, 15, 30, 25, 40, 20, 10, 30, 15, 35, 25, 40, 10, 30, 20, 25, 35, 10, 40, 30, 15, 25],
      August: [25, 15, 10, 20, 15, 5, 25, 30, 15, 10, 20, 15, 25, 15, 45, 20, 10, 30, 15, 25, 5, 20, 15, 25, 35, 5, 30, 25, 10, 20],
      September: [10, 20, 15, 30, 25, 10, 40, 35, 20, 15, 30, 25, 40, 20, 10, 30, 15, 35, 25, 40, 10, 30, 20, 25, 35, 10, 40, 30, 15, 25],
      October: [15, 15, 10, 20, 15, 5, 25, 30, 15, 10, 20, 15, 25, 15, 5, 20, 10, 30, 15, 25, 5, 20, 15, 25, 35, 5, 30, 25, 10, 20],
      November: [10, 20, 15, 30, 25, 10, 40, 35, 2, 15, 30, 25, 40, 20, 10, 30, 15, 15, 25, 40, 10, 30, 20, 25, 35, 10, 40, 30, 15, 25],
      December: [65, 15, 10, 20, 15, 5, 25, 30, 15, 10, 20, 15, 25, 15, 65, 20, 10, 30, 15, 25, 55, 20, 15, 25, 35, 5, 30, 25, 10, 20],
    };
  
    let currentMonthIndex = 0;
  
    // Create the initial daily sales chart
    const dailyChart = new Chart(ctxDaily, {
        type: 'line',
        data: {
            labels: Array.from({ length: 30 }, (_, i) => i + 1),
            datasets: [{
                label: 'Daily Sales (RM)',
                data: dailySalesData[months[currentMonthIndex]],
                borderColor: '#032062',
                backgroundColor: '#bdc6e67e',
                borderWidth: 1,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Sales (RM)' } },
                x: { title: { display: true, text: 'Day' } }
            },
            plugins: {
                title: { display: true, text: 'Daily Sales ' + months[currentMonthIndex] + ' 2024'}
            }
        }
    });
  
    // Function to change the month
    window.changeMonth = function (direction) {
        currentMonthIndex = (currentMonthIndex + direction + 12) % 12;
  
        // Ensure the selected month has data
        if (!dailySalesData[months[currentMonthIndex]]) {
            dailySalesData[months[currentMonthIndex]] = Array(30).fill(0); // Default data
        }
  
        // Update chart data and title
        dailyChart.data.datasets[0].data = dailySalesData[months[currentMonthIndex]];
        dailyChart.options.plugins.title.text = 'Daily Sales for ' + months[currentMonthIndex] + ' 2024';
        dailyChart.update();
  
        // Update displayed month
        document.getElementById('currentMonth').textContent = months[currentMonthIndex];
    };
    


// Example monthly sales data for multiple years
const monthlySalesData = {
    2020: [106520, 208220, 152580, 302820, 225250, 120110, 354440, 404410, 325110, 282800, 254280, 304520],
    2021: [432020, 604050, 378390, 268950, 537960, 499530, 653550, 737420, 883150, 902130, 106500, 790030],
    2022: [712220, 849500, 650340, 455500, 384900, 544450, 633220, 839250, 484670, 475420, 541320, 905320],
    2023: [521110, 653250, 777890, 410200, 255150, 600330, 452550, 401100, 311000, 642550, 585320, 678490],
    2024: [465220, 802300, 356540, 753250, 301110, 450920, 614550, 735920, 388340, 709050, 621340, 890220],
};


let currentYear = 2024;

// Create the initial monthly sales chart
const monthlyChart = new Chart(ctxMonthly, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Monthly Sales (RM)',
            data: monthlySalesData[currentYear],
            backgroundColor: '#bdc6e67e',
            borderColor: '#032062',
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Sales (RM)' } },
            x: { title: { display: true, text: 'Months' } }
        },
        plugins: {
            title: { display: true, text: 'Monthly Sales for ' + currentYear }
        }
    }
});

// Function to change the year
window.changeYear = function (direction) {
    const years = Object.keys(monthlySalesData).map(year => parseInt(year));
    const currentIndex = years.indexOf(currentYear);

    // Navigate between years
    const newIndex = (currentIndex + direction + years.length) % years.length;
    currentYear = years[newIndex];

    // Update chart data and title
    monthlyChart.data.datasets[0].data = monthlySalesData[currentYear];
    monthlyChart.options.plugins.title.text = 'Monthly Sales for ' + currentYear;
    monthlyChart.update();

    // Update displayed year
    document.getElementById('currentYear').textContent = currentYear;
};

    

    // Annual Sales Chart
    new Chart(annualCtx, {
        type: 'line', // Line chart for annual sales
        data: {
            labels: ['2020', '2021', '2022', '2023', '2024'], // Example years
            datasets: [{
                label: 'Sales',
                data: [800000, 100000, 200000, 150000, 300000], // Example data for annual sales
                borderWidth: 1,
                backgroundColor:'#bdc6e67e',
                borderColor: '#032062',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Sales (RM)'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Annual Sales'
                }
            }
        }
    });
  };