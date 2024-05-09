<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>task3</title>
</head>

<body>
    <div class="company-input">
        <h2>Add company:</h2>
        <form action="index.php" method="post">
            <div class="form-field">
                <label for="name">Name:</label>
                <input class="text-input" type="text" id="name" name="name">
            </div>
            <div class="form-field">
                <label for="address">Address:</label>
                <input class="text-input" type="text" id="address" name="address">
            </div>
            <div class="form-field">
                <label for="phone">Phone:</label>
                <input class="text-input" type="tel" id="phone" name="phone">
            </div>
            <div class="form-field">
                <label for="email">E-mail:</label>
                <input class="text-input" type="email" id="email" name="email">
            </div>
            <input class="button" type="submit" name="add-company-button" value="Add company">
        </form>
    </div>
    <?php
    // Чтение файла с данными о компаниях
    $file = fopen("companies.csv", "a+");
    $currentLine = 0;
    $companies[][4] = "";
    while (!feof($file)) {
        $companies[$currentLine++] = fgetcsv($file);
    }

    $isAddButtonPressed = false;
    if (isset($_POST['add-company-button'])) {
        $isAddButtonPressed = true;
    }

    $isNameCorrect = false;
    $name = "";
    $address = "";
    $phone = "";
    $email = "";

    if ($isAddButtonPressed && isset($_POST['name'])) {
        $name = trim($_POST['name']);
        if ($name != "") {
            $isNameCorrect = true;
        }
        else {
            echo '<span class="error-text">Enter correct name</span>';
        }
    }
    // Поиск компании с тем же именем
    if ($isNameCorrect) {
        for ($i = 0; $i < count($companies) - 1; ++$i) {
            if ($companies[$i][0] == $name) {
                echo '<span class="warning-text">Company already exist</span>';
                $isNameCorrect = false;
            }
        }
    }

    if ($isNameCorrect) {
        if (isset($_POST['address'])) {
            $address = trim($_POST['address']);
        }

        if (isset($_POST['phone'])) {
            $phone = trim($_POST['phone']);
        }

        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);
        }

        fputcsv($file, array($name, $address, $phone, $email));
        header("Refresh:0");
    }
    ?>

    <div class="company-search">
        <div class="search-name-input">
            <h2>Find company:</h2>
            <form action="index.php" method="post">
                <div class="form-field">
                    <label for="search-name">Name:</label>
                    <input class="text-input" type="text" id="search-name" name="search-name">
                </div>
                <input class="button" type="submit" name="search-company-button" value="Search">
            </form>
            <?php
            $isSearchButtonPressed = false;
            if (isset($_POST['search-company-button'])) {
                $isSearchButtonPressed = true;
            }

            $searchName = "";
            $isSearchNameCorrect = false;
            if ($isSearchButtonPressed && isset($_POST['search-name'])) {
                $searchName = trim($_POST['search-name']);
                if ($searchName != "") {
                    $isSearchNameCorrect = true;
                }
                else {
                    echo '<span class="error-text">Enter correct name for search</span>';
                }
            }
            // Поиск компании
            $foundCompany[] = '';
            $isCompanyFound = false;
            if ($isSearchNameCorrect) {
                for ($i = 0; $i < count($companies) - 1; ++$i) {
                    if ($companies[$i][0] == $searchName) {
                        $foundCompany = $companies[$i];
                        $isCompanyFound = true;
                        break;
                    }
                }
            }
            ?>
        </div>

        <div class="search-result">
            <?php if ($isCompanyFound) { ?>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>E-mail</th>
                    </tr>
                    <?php
                        echo '<tr>';
                        for ($i = 0; $i < count($foundCompany); ++$i) {
                            echo '<td>', $foundCompany[$i], '</td>';
                        }
                        echo '</tr>';
                    ?>
                </table>
            <?php 
            } 
            else if ($isSearchButtonPressed && $isSearchNameCorrect) {
                echo '<span class="warning-text">There is no such company</span>';
            }
            ?>
        </div>
    </div>

    <div class="companies-list">
        <h2>Companies list:</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>E-mail</th>
            </tr>
            <?php
            // Вывод данных о компаниях в таблицу
            for ($i = 0; $i < count($companies) - 1; ++$i) {
                echo "<tr>";
                for ($j = 0; $j < count($companies[0]); ++$j) {
                    echo "<td>", $companies[$i][$j], "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php

?>