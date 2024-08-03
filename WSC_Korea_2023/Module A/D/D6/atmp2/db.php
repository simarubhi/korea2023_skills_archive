<?php

$conn = mysqli_connect("localhost", "root", "", "korea_d6");

if (!$conn) {
    die('failed to connect to database');
}