<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>task5</title>
</head>

<body>
    <div class="db-name-input">
        <form action="index.php" method="POST">
            <div class="form-field">
                <label for="db-name">Enter name of the database to connect:</label>
                <input class="text-input" type="text" id="db-name" name="db-name" required>
            </div>
            <input class="button" type="submit" name="db-connect-button" value="Connect">
        </form>
    </div>

    <?php
    if (isset($_POST['db-connect-button'])) {
        if (isset($_POST['db-name'])) {
            $pdo = connectToDataBase($_POST['db-name']);
            printDbTables($pdo);
        } else {
            echo '<span class="error-text">Enter database name</span>';
        }
    }


    function connectToDatabase(string $dbName): PDO {
        $host =         'localhost';
        $user =         'root';
        $password =     'password';
        $charset =      'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";

        try {
            $pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die('<span class="error-text">Failed to connect to database: </span>' . $e->getMessage());
        }

        return $pdo;
    }

    function printDbTables(PDO $pdo): void {
        $tableNames = fetchTableNames($pdo);

        foreach ($tableNames as $tableName) {
            printTable($pdo, $tableName);
        }
    }

    function fetchTableNames(PDO $pdo): array {
        $sql = "SHOW TABLES";
        $stmt = $pdo->query($sql);
        $dataArrays = $stmt->fetchAll(PDO::FETCH_NUM);

        $tableNames = [];
        foreach ($dataArrays as $tableArrays) {
            foreach ($tableArrays as $tableName) {
                $tableNames[] = $tableName;
            }
        }

        return $tableNames;
    }

    function printTable(PDO $pdo, string $tableName): void {
        echo '<div class="db-table"><h2>', $tableName, '</h2><table>';
        printColumnsInfo($pdo, $tableName);
        printTableData($pdo, $tableName);
        echo '</table></div>';
    }

    function printColumnsInfo(PDO $pdo, string $tableName): void {
        $sql = "DESCRIBE $tableName";
        $stmt = $pdo->query($sql);
        $columnsInfoArr = $stmt->fetchAll(PDO::FETCH_NUM);

        echo '<tr>';
        foreach ($columnsInfoArr as $column) {
            if ($column[3] == "PRI") {
                echo '<th>', "$column[0], type: $column[1], PRIMARY", '</th>';
            } else if ($column[3] == "") {
                echo '<th>', "$column[0], type: $column[1]", '</th>';
            } else {
                echo '<th>', "$column[0], type: $column[1], SECONDARY", '</th>';
            }
        }
        echo '</tr>';
    }

    function printTableData(PDO $pdo, string $tableName): void {
        $sql = "SELECT * FROM $tableName";
        $stmt = $pdo->query($sql);
        $tableRows = $stmt->fetchAll(PDO::FETCH_NUM);

        foreach ($tableRows as $tableRow) {
            echo '<tr>';
            foreach ($tableRow as $column) {
                echo '<td>', $column, '</td>';
            }
            echo '</tr>';
        }
    }
    ?>
</body>

</html>