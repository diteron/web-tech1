<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>task6</title>
</head>

<body>
    <?php
    date_default_timezone_set("Europe/Minsk");

    $visits = [date("Y-m-d H:i:s")];

    if (isset($_COOKIE["visits"])) {
        $visits = json_decode($_COOKIE['visits']);
        $visits[] = date("Y-m-d H:i:s");
    }

    setcookie("visits", json_encode($visits), strtotime("+7 days"));
    ?>

    <div class="visits-count">
        <h2>Number of site visits: <?php echo count($visits); ?></h2>
    </div>
    <div class="visits-time">
        <h2>List of visits:</h2>
        <ol>
            <?php
            foreach ($visits as $visit) {
                echo "<li>" . $visit . "</li>";
            }
            ?>
        </ol>

    </div>
</body>

</html>