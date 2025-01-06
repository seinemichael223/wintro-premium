fetch('fetching_chart_data.php')
    .then((response) => response.json())
    .then((data) => {
        const weeklySales = data.weeklySales;
        const weeks = weeklySales.map(item => `Week ${item.week}`); // Labels
        const sales = weeklySales.map(item => item.total_sales);   // Data

        // Render the chart
        const ctx = document.getElementById('WeeklyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // You can change to 'line', 'pie', etc.
            data: {
                labels: weeks,
                datasets: [{
                    label: 'Weekly Sales',
                    data: sales,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch((error) => console.error('Error fetching data:', error));

