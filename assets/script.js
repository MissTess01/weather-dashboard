
const ctx = document.getElementById('weatherChart');

if (ctx && typeof Chart !== 'undefined') {
    let forecast = [];

    try {
        forecast = JSON.parse(ctx.dataset.weather || '[]');
    } catch (error) {
        console.error('Unable to read weather data:', error);
    }

    if (forecast.length > 0) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: forecast.map(day => day.day),
                datasets: [
                    {
                        label: 'Temperature (°C)',
                        data: forecast.map(day => Number(day.temperature)),
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Humidity (%)',
                        data: forecast.map(day => Number(day.humidity)),
                        borderWidth: 2,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Temperature / Humidity'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Day of the Week'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Weather Forecast'
                    }
                }
            }
        });
    } else {
        console.error('No weather forecast data found.');
    }
} else {
    console.error('Chart canvas or Chart.js library is missing.');
}
