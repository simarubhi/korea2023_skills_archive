<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
<?php

    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    // file_put_contents($title . '.doc', $description);

    // Set headers to trigger file download
    header('Content-Description: File Transfer');
    header('Content-Type: application/msword');
    header('Content-Disposition: attachment; filename="' . $title . '.doc"');
    header('Content-Length: ' . strlen($description));
    header('Pragma: public');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    echo $description;

    exit();

?>
    
</body>
</html>