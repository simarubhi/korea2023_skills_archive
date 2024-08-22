<?php

$final_string = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['area'])) {
        $number_final = [];
        $area_input = trim($_REQUEST['area']);
        $area_arr = explode(' ', $area_input);

        $numeric_arr = [];

        function isFloatAnInteger($float) {
            return is_float($float) && ($float == (int)$float);
        }

        for ($i = 0; $i < count($area_arr); $i++) {
            if (is_numeric($area_arr[$i]) && isFloatAnInteger(floatval($area_arr[$i]))) {
                array_push($numeric_arr, intval($area_arr[$i]) / 2);
            }
        }

        for ($i = 0; $i < count($numeric_arr); $i++) {
            if (is_int($numeric_arr[$i])) {
                $final_string .= strval($numeric_arr[$i]) . ' ';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP list of even numbers</title>
</head>
<body>
    <form method="post">
        <textarea name="area" id="area"><?php echo $final_string; ?></textarea>
        <button type="submit">Submit</button>
    </form>
</body>
</html>