<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Factors</title>
</head>
<body>
    <?php

        $div = isset($_GET['factor']) ? $_GET['factor'] : 2;

        function divisor($num, $divisor) {
            if ($num % $divisor == 0) return ($num . " is a divsor of " . $divisor . "**");
            else return $num;
        }

        $arr = range(1, 40);
        echo "<pre>";
        echo "Original ";
        print_r($arr);
        echo "</pre> <br>";

        $mod = array_map(function($num) use ($div) {
            return divisor($num, $div);
        }, $arr);
        echo "<pre>";
        echo "Modified ";
        print_r($mod);
        echo "</pre> <br>";
        ?>
</body>
</html>