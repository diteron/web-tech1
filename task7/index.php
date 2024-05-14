<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>task7</title>
</head>

<body>
    <?php
    $host =         'localhost';
    $db   =         'emails';
    $user =         'root';
    $password =     'password';
    $charset =      'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $password);

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        die('<span class="error-text">Failed to connect to database: </span>' . $e->getMessage());
    }
    ?>

    <div class="email-input">
        <h2>Add email to database:</h2>
        <form action="index.php" method="post">
            <div class="form-field">
                <label for="email">E-mail:</label>
                <input class="text-input" type="email" id="email" name="email" required>
            </div>
            <input class="button" type="submit" name="add-email-button" value="Add email">
        </form>
        <?php
        $isAddEmailButtonPressed = isset($_POST['add-email-button']);
        if ($isAddEmailButtonPressed) {
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
                $query = "INSERT INTO emails (email) VALUES
                        (?);";
                $stmt = $pdo->prepare($query);

                try {
                    $stmt->execute([$email]);
                } catch (PDOException $e) {
                    die('<span class="error-text">Failed to add email: </span>' . $e->getMessage());
                }

                echo 'Email is added';
            } else {
                echo '<span class="error-text">Enter correct email</span>';
            }
        }
        ?>
    </div>

    <div class="message-input">
        <h2>Enter message:</h2>
        <form action="index.php" method="post">
            <div class="form-field">
                <label for="email-subject">Subject:</label>
                <input class="text-input" type="text" id="email-subject" name="email-subject">
            </div>
            <div class="form-field">
                <label for="email-text">Message:</label>
                <textarea type="text" name="email-text" id="email-text" required></textarea>
            </div>
            <input class="button" type="submit" name="send-email-button" value="Send email">
        </form>
        <?php 
        if (isset($_POST['send-email-button'])) {
            $emails = getEmailsFromDb($pdo);
            sendEmail($emails);
        }

        function getEmailsFromDb($pdo): string {
            $query = 'SELECT * FROM emails';
            $stmt = $pdo->query($query);
            $emailsDbRows = $stmt->fetchAll(PDO::FETCH_NUM);

            $emails = '';
            foreach ($emailsDbRows as $row) {
                $emails .= $row[1] . ', ';
            }
            
            return rtrim($emails, ', ');
        }

        function sendEmail(string $to): void {
            $subject = $_POST['email-subject'];
            $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';
            $message = $_POST['email-text'];

            $additionalHeaders = ['Content-type' => 'text/html; charset=utf-8',
                                  'From'         => 'From my task7 site <bsuir.webtech@mail.ru>',
                                  'Reply-To'     => 'noreply@example.com',
                                  'MIME-Version' => '1.0'];

            if (mail($to, $subject, $message, $additionalHeaders)) {
                echo '<p>';
                echo 'Email is sent to: ';
                print_r($to);
                echo '</p>';
            } else {
                echo '<span class="error-text">Failed to send email</span>';
            } 
        }
        ?>
    </div>
</body>

</html>