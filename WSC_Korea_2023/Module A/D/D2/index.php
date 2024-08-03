<?php
/**
 * ATTEMPT 1 Orignal Attempt is better than this one, remeber to use $_GET for query string and also what pre does
 */
$arr = range(1, 40);

function arr_map($n) {
    $factor = intval(substr($_SERVER['QUERY_STRING'], 7)) ?? 0;
    
    if ($factor != 0 && $n % $factor == 0) {
        return $n . ' is a multiple of ' .  $factor . '**';
    }

    return $n;
}

$ma = array_map('arr_map', $arr);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Fill</title>
</head>
<body>
    <pre>
        <?php print_r($ma); ?>
    </pre>
</body>
</html>