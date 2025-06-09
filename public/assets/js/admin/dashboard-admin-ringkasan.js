window.myChart = null;
function renderChart() {
    const ctx = document.getElementById('myChart').getContext('2d');
           window.myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Aktivitas',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

window.onload = renderChart;
