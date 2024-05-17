<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>task2</title>
</head>

<body>
    <form action="index.php" method="post">
        <label for="arr1">Массив 1:</label>
        <input class="text-input" type="text" id="arr1" name="arr1" required><br>
        <label for="arr2">Массив 2:</label>
        <input class="text-input" type="text" id="arr2" name="arr2" required><br>
        <input class="button" type="submit">
    </form>
</body>
</html>

<?php
if (isset($_POST['arr1']) && isset($_POST['arr2'])) {
    $arr1 = str_replace(" ", "", $_POST['arr1']);
    $arr2 = str_replace(" ", "", $_POST['arr2']);
    $arr1 = explode(",", $arr1);
    $arr2 = explode(",", $arr2);

    print_r($arr1);
    echo "<br>";
    print_r($arr2);
    echo "<br>";

    $mergedArr = [];
    foreach ($arr1 as $element) {
        if (isStrIntNum($element)) {
            $mergedArr[] = $element;
        }
    }

    foreach ($arr2 as $element) {
        if (isStrIntNum($element)) {
            $mergedArr[] = $element;
        }
    }

    echo "Объединенный массив:<br>";
    print_r($mergedArr);
    echo "<br>";

    echo "<br>Четные числа в массиве:<br>";
    foreach ($mergedArr as $el) {
        if ((intval($el) % 2 == 0)) {
            echo "$el ";
        }
    }
}
else {
    echo 'Введите оба массива';
}

function isStrIntNum(string $numStr) {
    if ($numStr[0] == '-') {
        return ctype_digit(substr($numStr, 1));
    }
    
    return ctype_digit($numStr);
}
?>
