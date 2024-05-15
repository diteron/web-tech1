<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Administrator panel</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home page</a></li>
                <li><a href="page1.php">Page 1</a></li>
                <li><a href="page2.php">Page 2</a></li>
                <li><a href="page3.php">Page 3</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <?php
    $pdo = connectToDataBase('visits_db');
    $pages = getAllPages($pdo);

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

    function getAllPages($pdo): array {
        $query = "SELECT * FROM `pages`;";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllVisitsOfPage(int $pageId, PDO $pdo): array
    {
        $query = "SELECT * FROM `visits`
                  WHERE `page_id` = $pageId;";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>

    <div class="pages-statistic">
        <h2>Visits of pages:</h2>
        <?php foreach ($pages as $page) : ?>
            <div class="page">
                <h2><?php echo $page['page_name']; ?></h2>
                <?php
                $pageVisits = getAllVisitsOfPage($page['id'], $pdo);
                ?>
                <h3>Number of visits: <?php echo count($pageVisits); ?></h3>
                <table>
                    <th>#</th>
                    <th>Visit time</th>
                    <?php for ($i = 0; $i < count($pageVisits); ++$i): ?>
                        <tr>
                            <td><?php echo $i + 1 . "."; ?></td>
                            <td><?php echo $pageVisits[$i]['visit_time']; ?></td>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>