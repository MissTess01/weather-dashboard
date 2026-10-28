
<?php
$weatherFile = __DIR__ . '/data/weather.json';
$weatherData = [];

if (file_exists($weatherFile)) {
    $json = file_get_contents($weatherFile);
    $decodedData = json_decode($json, true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($decodedData)) {
        $weatherData = $decodedData;
    }
}

$forecast = $weatherData['forecast'] ?? [];

if (!is_array($forecast)) {
    $forecast = [];
}

$temperatures = array_column($forecast, 'temperature');
$humidities = array_column($forecast, 'humidity');

$averageTemperature = count($temperatures) > 0
    ? array_sum($temperatures) / count($temperatures)
    : null;

$averageHumidity = count($humidities) > 0
    ? array_sum($humidities) / count($humidities)
    : null;

$highestTemperature = count($temperatures) > 0
    ? max($temperatures)
    : null;

$lowestTemperature = count($temperatures) > 0
    ? min($temperatures)
    : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Weather Dashboard</title>

    <link rel="stylesheet" href="assets/style.css">

    <!-- Load Chart.js before our chart script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header>
        <h1>Weather Dashboard</h1>
        <p>CSC-20021 Weather Visualization</p>

        <nav>
            <a href="index.php">Home</a>
            <a href="cv.php">CV</a>
            <a href="weather.php">Weather</a>
        </nav>
    </header>

    <main>
        <section>
            <h2><?= htmlspecialchars($weatherData['location'] ?? 'Weather Forecast') ?> Weather</h2>

            <p>
                Location:
                <?= htmlspecialchars($weatherData['location'] ?? 'Unknown') ?>
            </p>

            <h3>Temperature and Humidity Chart</h3>

            <?php if (count($forecast) > 0): ?>
                <canvas
    id="weatherChart"
    data-weather="<?= htmlspecialchars(json_encode($forecast), ENT_QUOTES, 'UTF-8') ?>"
    aria-label="Temperature and humidity chart"
    role="img">
</canvas>


            <?php else: ?>
                <p>Weather data is not available.</p>
            <?php endif; ?>
        </section>

        <section>
            <h2>Weather Summary</h2>

            <p class="forecast-days">
                Forecast Days Available: <?= count($forecast) ?>
            </p>

            <?php if ($averageTemperature !== null): ?>
                <h3>Average Temperature</h3>
                <p class="average-temperature">
                    <?= number_format($averageTemperature, 1) ?> °C
                </p>

                <p>
                    Highest Temperature:
                    <?= htmlspecialchars((string) $highestTemperature) ?> °C
                </p>

                <p>
                    Lowest Temperature:
                    <?= htmlspecialchars((string) $lowestTemperature) ?> °C
                </p>
            <?php endif; ?>

            <?php if ($averageHumidity !== null): ?>
                <p>
                    Average Humidity:
                    <?= number_format($averageHumidity, 1) ?>%
                </p>
            <?php endif; ?>
        </section>

        <section>
            <h2>Weather Forecast</h2>

            <?php if (count($forecast) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Temperature (°C)</th>
                            <th>Humidity (%)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($forecast as $day): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars((string) ($day['day'] ?? 'N/A')) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars((string) ($day['date'] ?? 'N/A')) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars((string) ($day['temperature'] ?? 'N/A')) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars((string) ($day['humidity'] ?? 'N/A')) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Weather data is not available.</p>
            <?php endif; ?>
        </section>

        <p><a href="index.php">Back to Home</a></p>
    </main>

    <footer>
        <p>CSC-20021 Web Technologies Assessment</p>
    </footer>

    <!-- Load our script after the canvas exists -->
    <script src="assets/script.js"></script>
</body>
</html>
