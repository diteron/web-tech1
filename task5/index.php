<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>task5</title>
</head>

<body>
    <?php
    $host =         'localhost';
    $db   =         'task5_db';
    $user =         'root';
    $password =     'password';
    $charset =      'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $password);

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        die("Failed to connect to database: " . $e->getMessage());
    }

    $tableNames = fetchTableNames($pdo);

    foreach ($tableNames as $tableName) {
        printTable($pdo, $tableName);
    }


    function fetchTableNames($pdo): array {
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

    function printTable($pdo, string $tableName): void {
        echo '<div class="db-table"><h2>', $tableName, '</h2><table>';
        printColumnsInfo($pdo, $tableName);
        printTableData($pdo, $tableName);
        echo '</table></div>';
    }

    function printColumnsInfo($pdo, string $tableName): void {
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

    function printTableData($pdo, string $tableName): void {
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