<?php
    $submitted = [];

    $fileSub = new SplFileObject("./submittedAnswers.csv");
    while (!$fileSub->eof()) {
        array_push($submitted, $fileSub->fgetcsv()[0]);
    }
    
    $actual = [];

    $fileAns = new SplFileObject("./actualAnswers.csv");
    while (!$fileAns->eof()) {
        array_push($actual, $fileAns->fgetcsv()[0]);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer Check</title>
</head>
<body>
    <table style="border-collapse: separate; border: 1px solid;">
        <thead>
            <tr>
                <th style="border: 1px solid;" scope="col">Question</th>
                <th style="border: 1px solid;" scope="col">Actual Answer</th>
                <th style="border: 1px solid;" scope="col">Submitted Answer</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 0; for($i = 0; $i < count($submitted); $i++) : ?>
                <?php if ($actual[$i] === $submitted[$i]) $count++; ?>
            <tr>
                <td style="border: 1px solid;" scope="row"><?php echo $i + 1; ?></th>
                <td style="border: 1px solid;"><?php echo $actual[$i]; ?></td>
                <td style="border: 1px solid;"><?php echo $submitted[$i]; ?></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <span>Score:<?php echo $count; ?> /10</span>
</body>
</html>