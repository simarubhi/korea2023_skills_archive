<?php

$data = file_get_contents('./data.json');
$data_json = json_decode($data);

$start = intval($_REQUEST['start']);

$res = [];

for ($i = $start; $i < $start + 10; $i++) {
    array_push($res, $data_json[$i]);
}

echo json_encode($res);