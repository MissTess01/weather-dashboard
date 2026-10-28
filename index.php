
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSC-20021 | Web Technologies</title>

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

   
<header>
    <h1>My Web Technologies Portfolio</h1>
    <p>CSC-20021 Assessment Project</p>

   
<nav>
    <a href="index.php">Home</a>
    <a href="cv.php">My CV</a>
    <a href="weather.php">Weather</a>
</nav>

</header>


    <main>
        <section>
            <h2>Welcome</h2>
            <p>
                Welcome to my web technologies project.
                This website demonstrates HTML, CSS, JavaScript and PHP.
            </p>

            <?php
                echo "<p>PHP is working successfully!</p>";
            ?>
        </section>

        <section>
            <h2>About This Website</h2>
            <p>This portfolio will include:</p>
            <ul>
                <li>CV and academic highlights</li>
                <li>Interactive weather visualization</li>
                <li>Administrator login system</li>
            </ul>
        </section>
    </main>

    <footer>
        <p>CSC-20021 Web Technologies Assessment</p>
    </footer>

</body>
</html>
