<?php

$hexa = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_REQUEST['red']) && isset($_REQUEST['green']) && isset($_REQUEST['blue']) && trim($_REQUEST['red']) !== '' && trim($_REQUEST['green']) !== '' && trim($_REQUEST['blue']) !== '') {
		$red = dechex(intval($_REQUEST['red']));
		$green = dechex(intval($_REQUEST['green']));
		$blue = dechex(intval($_REQUEST['blue']));
	
		$hexa = $red . $green . $blue;
	} else {
		$hexa = '';
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>RGB to HEX</title>
</head>

<body>
	<h4>RGB to HEX</h4>

	<form method="post">
		<label for="red">Red:
			<input type="text" name="red" id="red">
		</label>

		<label for="green">Green:
			<input type="text" name="green" id="green">
		</label>

		<label for="blue">Blue:
			<input type="text" name="blue" id="blue">
		</label>

		<input type="submit" />
	</form>

	<p>Hexadecimal: #<?php echo $hexa; ?></p>
</body>

</html>