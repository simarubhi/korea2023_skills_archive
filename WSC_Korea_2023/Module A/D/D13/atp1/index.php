<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert code 64 to image</title>
</head>
<body>


    <form action="" method="POST">
        <textarea name="code" placeholder="CODE64"></textarea>
        <input type="submit" value="Convert">
    </form>

    <?php
    

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['code']) && !empty($_POST['code'])) {
                if (!file_exists('img')) {
                    mkdir('img');
                }

                $content = base64_decode($_POST['code']);
                $file_name = 'img' . hexdec(uniqid());

                file_put_contents('img/' . $file_name . '.png', $content);

                echo 'Successful convention';
            }
        }

    
    ?>

</body>
</html>