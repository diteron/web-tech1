<?php
date_default_timezone_set("Europe/Minsk");

$pdo = connectToDataBase('visits_db');
$pageName = $_SERVER['SCRIPT_NAME'];
$pageId = getPageDbId($pageName, $pdo);

// If page not registered in database
if ($pageId == 0) {
    registerNewPageInDb($pageName, $pdo);
    $pageId = $pdo->lastInsertId();
}

registerVisitInDb($pdo, $pageId) or die('<span class="error-text">Failed to register visit</span>');

function connectToDataBase(string $dbName): PDO {
    $host =         'localhost';
    $user =         'root';
    $password =     'password';
    $charset =      'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";
    $pdo = new PDO($dsn, $user, $password);

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        die('<span class="error-text">Failed to connect to database: </span>' . $e->getMessage());
    }

    return $pdo;
}

function getPageDbId($pageName, $pdo): int {
    $query = "SELECT `id` FROM `pages`
              WHERE `page_name` = '$pageName';";
    $stmt = $pdo->query($query);
    $idArr = $stmt->fetchAll();

    return !empty($idArr) ? $idArr[0]['id']
                          : 0;
}

function registerNewPageInDb($pageName, $pdo) {
    $query = "INSERT INTO `pages` (`page_name`)
              VALUES ('$pageName');";
    $pdo->query($query);
}

function registerVisitInDb($pdo, $pageId): bool {
    $visitTime = date_create();
    if (isNextDayVisit($pdo, $visitTime)) {
        truncateTable($pdo, 'visits');
    }
    
    $visitTimeStr = $visitTime->format("Y-m-d H:i:s");
    $query = "INSERT INTO `visits` (`page_id`, `visit_time`)
              VALUES ($pageId, '$visitTimeStr');";
    
    if (!$pdo->query($query)) {
        echo '<span class="error-text">Failed to run query</span>';
        return false;
    }    

    return true;
}

function isNextDayVisit($pdo, $visitTime): bool { 
    $visitDate = date_format($visitTime, "Y-m-d");
    $lastVisitDate = date_format(getDateOfLastVisit($pdo), "Y-m-d");

    return $visitDate != $lastVisitDate;
}

function getDateOfLastVisit($pdo): DateTimeInterface {
    $query = "SELECT `visit_time` FROM `visits`
              WHERE `id` = (SELECT max(`id`) FROM `visits`);";
    $stmt = $pdo->query($query);
    $lastVisitArr = $stmt->fetchAll();

    return !empty($lastVisitArr) ? date_create($lastVisitArr[0]['visit_time'])
                                 : date_create();
}

function truncateTable($pdo, $tableName): void {
    $query = "TRUNCATE TABLE `$tableName`;";
    $pdo->query($query);
}
?>