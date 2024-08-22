<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['area'])) {
        $number_final = [];
        $area_input = trim($_REQUEST['area']);
        for ($i = 0; $i < strlen($area_input); $i++) {
            if (is_numeric($area_input[$i])) {
                array_push($number_final, intval($area_input[$i]) / 2);
            }
        }

        $final_ints =  [];
        
        for ($i = 0; $i < count($number_final); $i++) {
            if (is_int($number_final[$i])) {
                array_push($final_ints, $number_final[$i]);
            }
        }

        foreach ($final_ints as $int) {
            echo $int . ', ';
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
        <textarea name="area" id="area"></textarea>
        <button type="submit">Submit</button>
    </form>
</body>
</html>