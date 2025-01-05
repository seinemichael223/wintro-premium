// Fetch data from PHP file
fetch('fetching_chart_data.php')
    .then(response => response.json())
    .then(data => {
        // Prepare data for each chart
        const dailySales = data.dailySales;
        const monthlySales = data.monthlySales;
        const yearlySales = data.yearlySales;

        // Daily Sales Chart
        const dailyLabels = dailySales.map(sale => sale.date);
        const dailyData = dailySales.map(sale => sale.total_sales);

        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        let currentMonthIndex = 0;

        const dailyChart = new Chart(document.getElementById('dailyChart'), {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'Daily Sales',
                    data: dailyData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            }
        });
        
        // Function to change the month
    window.changeMonth = function (direction) {
        currentMonthIndex = (currentMonthIndex + direction + 12) % 12;
  
        // Ensure the selected month has data
        if (!monthlySales[months[currentMonthIndex]]) {
            monthlySales[months[currentMonthIndex]] = Array(30).fill(0); // Default data
        }
  
        // Update chart data and title
        dailyChart.data.datasets[0].data = dailySales[months[currentMonthIndex]];
        dailyChart.options.plugins.title.text = 'Daily Sales for ' + months[currentMonthIndex] + ' 2024';
        dailyChart.update();
  
        // Update displayed month
        document.getElementById('currentMonth').textContent = months[currentMonthIndex];
    };
    
        // Monthly Sales Chart
        const monthlyLabels = monthlySales.map(sale => `${sale.year}-${sale.month}`);
        const monthlyData = monthlySales.map(sale => sale.total_sales);

        const monthlyChart = new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Monthly Sales',
                    data: monthlyData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
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
        monthlyChart.data.datasets[0].data = monthlySales[currentYear];
        monthlyChart.options.plugins.title.text = 'Monthly Sales for ' + currentYear;
        monthlyChart.update();

        // Update displayed year
        document.getElementById('currentYear').textContent = currentYear;
    };

        // // Weekly Sales Chart
        // const weeklyLabels = weeklySales.map(sale => sale.week);
        // const weeklyData = weeklySales.map(sale => sale.total_sales);

        // const weeklyChart = new Chart(document.getElementById('weeklyChart'), {
        //     type: 'bar',
        //     data: {
        //         labels: yearlyLabels,
        //         datasets: [{
        //             label: 'Yearly Sales',
        //             data: yearlyData,
        //             backgroundColor: 'rgba(255, 159, 64, 0.2)',
        //             borderColor: 'rgba(255, 159, 64, 1)',
        //             borderWidth: 1
        //         }]
        //     }
        // });
    })
    .catch(error => console.error('Error fetching data:', error));
