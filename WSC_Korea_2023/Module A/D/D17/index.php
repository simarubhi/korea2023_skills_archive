<?php

$notices = [];
$content = json_decode(file_get_contents('log.json'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['content']) && !empty(trim($_POST['content'])) && isset($_POST['name']) && !empty(trim($_POST['name']))) {
        $notices = json_decode(file_get_contents('log.json'));
        if (empty($notices)) {
            $notices = [];
        }

        array_push($notices, [
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'date' => date('dS M, Y - G:i'),
        ]);

        file_put_contents('log.json', json_encode($notices));

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
        
        
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticeboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        form {
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 2rem 3rem;
        }
        .posts {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
            margin: 2rem 3rem;
        }
    </style>
</head>
<body>
    <form method="POST">
        <div class="row">
            <label for="name">Name</label>
            <input name="name" type="text">
        </div>
        <div class="row">
            <label for="content">content</label>
            <textarea name="content" id="content"></textarea>
        </div>
        <button type="submit">Create</button>
    </form>

    <div class="posts">
        <?php
        if (!empty($content)) :
            for ($i = 0; $i < count($content); $i++) :
        ?>

        <div class="post">
            <h1 style="margin-bottom: 20px;"><?php echo $content[$i]->name; ?> / <?php echo $content[$i]->date; ?></h1>
            <p><?php echo $content[$i]->content; ?></p>
        </div>

        <?php
            endfor;
        endif;
        ?>

    </div>
</body>
</html>