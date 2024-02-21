<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Numbers</title>
</head>
<body>
    <form method="post">
        <textarea name="numin" id="numin" cols="30" rows="10"></textarea>
        <input type="submit">
    </form>

    <?php 
        function numfil($x) {
            if (is_numeric($x)) {
                return;
            } else {
                return $x;
            }
        }

        if(isset($_POST['numin'])) {
            $nums = str_split($_POST['numin']);

            print(implode(array_map('numfil', $nums)));
        } 
    ?>
</body>
</html>