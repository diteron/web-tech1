<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>task4</title>
</head>

<body>
    <div class="open-file">
        <h2>Choose file with text:</h2>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <label for="file-selector">File with text:</label>
            <input type="file" name="file-selector" id="file-selector" accept=".txt"><br>
            <input class="button" type="submit" name="format-file-button" value="Format File">
        </form>
        <?php
        $isFormatButtonPressed = isset($_POST['format-file-button']);
        $isFileSelected = !empty($_FILES['file-selector']['name']);
        ?>
    </div>

    <div class="text-output">
        <h2>Formatted text:</h2>
        <?php
        $emails = [];
        if ($isFormatButtonPressed && $isFileSelected) {
            if (isFileValid('file-selector')) {
                $filePath = $_FILES['file-selector']['tmp_name'];
                $text = file_get_contents($filePath);
                $formattedText = formatEmailsInText($text, $emails);
                echo nl2br($formattedText);
            }
        } else if ($isFormatButtonPressed && !$isFileSelected) {
            echo '<span class="warning-text">File is not selected</span>';
        }

        function isFileValid(string $fileInputName): bool {
            if ($_FILES[$fileInputName]['error'] > 0) {
                echo '<span class="error-text">Error: ' . $_FILES['file-selector']['error'] . '</span>';
                return false;
            }
            else if ($_FILES[$fileInputName]['type'] != 'text/plain') {
                echo '<span class="warning-text">Wrong file format</span>';
                return false;
            }

            return true;
        }

        function formatEmailsInText(string &$text, array &$emails) : string {
            $emailRegex = '/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/i';
            $callback = function ($matches) use (&$emails) {
                $formattedEmail = "<a class=\"email\" href=\"mailto:$matches[0]\">$matches[0]</a>";
                $emails[] = $formattedEmail;
                return $formattedEmail;
            };
            return preg_replace_callback($emailRegex, $callback, $text);
        }
        ?>
    </div>

    <div class="emails-output">
        <h2>E-mails in text:</h2>
        <?php
            echo "<p>"; 
            foreach ($emails as $email) {
                echo $email . "<br>";
            }
            echo "</p>";
        ?>
    </div>
</body>

</html>