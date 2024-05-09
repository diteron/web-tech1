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
        <?php
        // Чтение файла с данными о компаниях    
        $file = fopen("companies.csv", "a+");
        $currentLine = 0;
        $companies[][4] = "";
        while (!feof($file)) {
            $companies[$currentLine++] = fgetcsv($file);
        }

        $isAddButtonPressed = isset($_POST['add-company-button']);
        if ($isAddButtonPressed) {
            $name = isset($_POST['name']) ? trim($_POST['name']) : "";
            $isNameCorrect = !empty($name);

            if ($isNameCorrect) {
                addCompany($name, $companies, $file);
            } else {
                echo '<span class="error-text">Enter correct name</span>';
            }
        }

        function addCompany($name, &$companies, &$file): void {
            $isAddingSameCompany = isSameCompanyAdded($name, $companies);
            if (!$isAddingSameCompany) {
                $address = isset($_POST['address']) ? trim($_POST['address']) : "";
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
                $email = isset($_POST['email']) ? trim($_POST['email']) : "";
                fputcsv($file, array($name, $address, $phone, $email));
                header("Refresh:0");
            } else {
                echo '<span class="warning-text">Company already exist</span>';
            }
        }

        function isSameCompanyAdded($companyName, &$companies): bool {
            for ($i = 0; $i < count($companies) - 1; ++$i) {
                if ($companies[$i][0] == $companyName) {
                    return true;
                }
            }
            return false;
        }
        ?>
    </div>

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
            $isSearchButtonPressed = isset($_POST['search-company-button']);

            $searchName = "";
            if ($isSearchButtonPressed && isset($_POST['search-name'])) {
                $searchName = trim($_POST['search-name']);
            }
            $isSearchNameCorrect = !empty($searchName);

            // Поиск компании
            $foundCompany[] = "";
            if ($isSearchNameCorrect) {
                for ($i = 0; $i < count($companies) - 1; ++$i) {
                    if ($companies[$i][0] == $searchName) {
                        $foundCompany = $companies[$i];
                        break;
                    }
                }
            } else if ($isSearchButtonPressed) {
                echo '<span class="error-text">Enter correct name for search</span>';
            }
            ?>
        </div>

        <?php if ($isSearchButtonPressed && $isSearchNameCorrect) { ?>
            <div class="search-result">
                <?php if (!empty($foundCompany[0])) { ?>
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
                } else {
                    echo '<span class="warning-text">There is no such company</span>';
                }
                ?>
            </div>
        <?php } ?>
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
            for ($i = 0; $i < count($companies) - 1; ++$i) {
                echo "<tr>";
                for ($j = 0; $j < count($companies[$i]); ++$j) {
                    echo "<td>", $companies[$i][$j], "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>