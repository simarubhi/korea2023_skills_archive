<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numbers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post">
        <textarea name="numbers" id="nums" cols="30" rows="10"></textarea>
        <input type="submit">
    </form>

    <?php
        if (isset($_POST['numbers'])) {
            $arr = explode(" ", $_POST['numbers']);

            function divide($x) {
                return (int) $x / 2;
            }

            $arr = array_map('divide', $arr);

            foreach ($arr as $a) {
                echo $a . ", ";
            }
        }
    ?>
</body>
</html>