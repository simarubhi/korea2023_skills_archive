<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
<?php

    $title = trim($_POST['title']);
    $desc = $_POST['description'];

    header("Content-Disposition: attachment; filename=" . $title . '.doc');
    header('Content-Length: ' . strlen($desc));
    header('Content-Type: application/doc');

    echo '<h1>' . $title . '</h1><p>' . $desc . '</p>';

    exit();

?>
    
</body>
</html>