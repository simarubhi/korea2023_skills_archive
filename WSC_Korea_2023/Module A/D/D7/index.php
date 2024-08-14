<?php

$day_output = null;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$day1 = new DateTime($_GET['date1']);
	$day2 = new DateTime($_GET['date2']);

	if (!isset($day1) || !isset($day2) || $day1 > $day2) {
		$day_output = 'Please enter valid dates';
	} else {
		$internal = $day1->diff($day2);
	
		$days = $internal->days;

		$formatter = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
    	$days_word = $formatter->format($days);
	
		$day_output = ucfirst($days_word) . ' day' . ($days != 1 ? 's' : '');
	}

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Number of Days</title>
</head>

<body>
	<h4>Calculate number of days</h4>

	<form method="GET">
		<label for="date1">Date 1:
			<input type="date" id="date1" name="date1">
		</label>

		<label for="date2">Date 2:
			<input type="date" id="date2" name="date2">
		</label>

		<input type="submit" />
	</form>

	<p>Output: <?php echo $day_output; ?></p>
</body>

</html>