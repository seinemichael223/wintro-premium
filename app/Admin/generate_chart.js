document.addEventListener("DOMContentLoaded", () => {
//********************************DAILY********************************
    const months = [
        'January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    let currentMonthIndex = new Date().getMonth(); // Default to current month
    let currentYear = new Date().getFullYear(); // Default to current year

    const dailyChart = new Chart(document.getElementById('dailyChart'), {
        type: 'line',
        data: {
            labels: [], // Dates will be updated dynamically
            datasets: [{
                label: 'Daily Sales (RM)',
                data: [], // Sales data will be updated dynamically
                backgroundColor: '#bdc6e67e',
                borderColor: '#032062',
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
                title: {
                    display: true,
                    text: 'Daily Sales for ${months[currentMonthIndex]} ${currentYear}'
                }
            }
        }
    });

    // Function to fetch and update chart data
    function fetchAndUpdateChart(year, month) {
        fetch(`fetching_chart_data.php?year=${year}&month=${month + 1}`)
            .then(response => response.json())
            .then(data => {
                const dailySales = data.dailySales;

                // Prepare new data
                const dailyLabels = dailySales.map(sale => sale.date);
                const dailyData = dailySales.map(sale => sale.total_sales);

                // Update chart
                dailyChart.data.labels = dailyLabels;
                dailyChart.data.datasets[0].data = dailyData;
                dailyChart.options.plugins.title.text = `Daily Sales for ${months[month]} ${year}`;
                dailyChart.update();

                // Update displayed month
                document.getElementById('currentMonth').textContent = `${months[month]} ${year}`;
            })
            .catch(error => console.error('Error fetching chart data:', error));
    }

    // Function to handle month navigation
    window.changeMonth = function (direction) {
        currentMonthIndex += direction;

        // Adjust year if month index goes out of bounds
        if (currentMonthIndex < 0) {
            currentMonthIndex = 11;
            currentYear -= 1;
        } else if (currentMonthIndex > 11) {
            currentMonthIndex = 0;
            currentYear += 1;
        }

        // Fetch and update chart data
        fetchAndUpdateChart(currentYear, currentMonthIndex);
    };

    // Fetch data for the initial load
    fetchAndUpdateChart(currentYear, currentMonthIndex);

//********************************WEEKLY********************************

    let currentWeek = 1; // Default to week 1

    const weeklyChart = new Chart(document.getElementById('weeklyChart'), {
        type: 'bar',
        data: {
            labels: [], // Days of the selected week
            datasets: [{
                label: 'Weekly Sales (RM)',
                data: [], // Sales data for the week
                backgroundColor: '#bdc6e67e',
                borderColor: '#032062',
                borderWidth: 1
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
                title: {
                    display: true,
                    text: 'Weekly Sales for Week ${currentWeek} of ${currentYear}'
                }
            }
        }
    });

    // Function to fetch and update chart data
    function fetchAndUpdateWeeklyChart(year, week) {
        fetch(`fetching_chart_data.php?year=${year}&week=${week}`)
            .then(response => response.json())
            .then(data => {
                const weeklySales = data.weeklySales;

                // Prepare new data
                const weeklyLabels = weeklySales.map(sale => `Day ${sale.day}`); // Example: Replace with actual day names if available
                const weeklyData = weeklySales.map(sale => sale.total_sales);

                // Update chart
                weeklyChart.data.labels = weeklyLabels;
                weeklyChart.data.datasets[0].data = weeklyData;
                weeklyChart.options.plugins.title.text = `Weekly Sales for Week ${week} of ${year}`;
                weeklyChart.update();

                // Update displayed week
                document.getElementById('currentWeek').textContent = `Week ${week} of ${year}`;
            })
            .catch(error => console.error('Error fetching weekly chart data:', error));
    }

    // Function to handle week navigation
    window.changeWeek = function (direction) {
        currentWeek += direction;

        // Adjust year if week index goes out of bounds
        if (currentWeek < 1) {
            currentYear -= 1;
            currentWeek = 52; // Assuming 52 weeks in the previous year
        } else if (currentWeek > 52) {
            currentYear += 1;
            currentWeek = 1;
        }

        // Fetch and update chart data
        fetchAndUpdateWeeklyChart(currentYear, currentWeek);
    };

    // Fetch data for the initial load
    fetchAndUpdateWeeklyChart(currentYear, currentWeek);


//********************************MONTHLY********************************


// Initialize Monthly Sales Chart
const monthlyChart = new Chart(document.getElementById('monthlyChart'), {
    type: 'bar',
    data: {
        labels: [], // Months of the selected year
        datasets: [{
            label: 'Monthly Sales (RM)',
            data: [], // Sales data for the year
            backgroundColor: '#bdc6e67e',
            borderColor: '#032062',
            borderWidth: 1
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
            title: {
                display: true,
                text: 'Monthly Sales for ${currentYear}'
            }
        }
    }
});

// Function to fetch and update monthly chart data
    function fetchAndUpdateMonthlyChart(year) {
        fetch(`fetching_chart_data.php?year=${year}`)
            .then(response => response.json())
            .then(data => {
                const monthlySales = data.monthlySales;

                // Prepare new data
                const monthlyLabels = monthlySales.map(sale => months[sale.month - 1]); // Convert month numbers to names
                const monthlyData = monthlySales.map(sale => sale.total_sales);

                // Update chart
                monthlyChart.data.labels = monthlyLabels;
                monthlyChart.data.datasets[0].data = monthlyData;
                monthlyChart.options.plugins.title.text = `Monthly Sales for ${year}`;
                monthlyChart.update();

                // Update displayed year
                document.getElementById('currentYear').textContent = `${year}`;
            })
            .catch(error => console.error('Error fetching monthly chart data:', error));
    }

    // Function to handle year navigation
    window.changeYear = function (direction) {
        currentYear += direction;

        // Fetch and update chart data
        fetchAndUpdateMonthlyChart(currentYear);
    };

    // Fetch data for the initial load
    fetchAndUpdateMonthlyChart(currentYear);

});

