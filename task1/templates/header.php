<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: /error.php'));
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/2620479d46.js" crossorigin="anonymous"></script>
    <title><?php echo $title; ?></title>
</head>

<body>
    <div class="header-container">
        <header>
            <h1 class="logo">Авто<span style="color: #d8b74c;">Мастер</span></h1>
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <label for="nav-toggle" class="nav-toggle-hamburger">
                <i class="fa-solid fa-bars"></i>
            </label>
            <nav>
                <ul>
                    <li><a href="home.php">Главная</a></li>
                    <li><a href="services.php">Услуги</a></li>
                    <li><a href="about.php">О нас</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
            </nav>
        </header>
    </div>