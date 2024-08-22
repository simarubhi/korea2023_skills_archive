<?php

$final_string = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['area'])) {
        $area = trim($_REQUEST['area']);

        for ($i = 0; $i < strlen($area); $i++) {
            if (!is_numeric($area[$i])) {
                $final_string .= $area[$i];
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