<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score</title>
</head>
<body>
    <table border="1px">
        <tr>
            <th>Question</th>
            <th>Actual Answer</th>
            <th>Submitted Answer</th>
        </tr>

        <?php
            
            $sub = file("submittedAnswers.csv");
            $act = file("actualAnswers.csv");

            $count = count($sub);
            $score = 0;

            for ($i = 0; $i < $count; $i++) :
                if ($act[$i] == $sub[$i]) $score++;
        ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $act[$i]; ?></td>
                <td><?php echo $sub[$i]; ?></td>
            </tr>

        <?php
            endfor;

        ?>
    </table>
    <?php echo "Score: " . $score . "/10"; ?>
</body>
</html>