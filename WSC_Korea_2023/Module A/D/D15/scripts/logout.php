<?php
session_destroy();
session_start();

/**
 * define the number of ../ to get to the root folder
 */
define('ROOT_LEVEL', '../');

/**
 * require the general functions file
 */
require(ROOT_LEVEL . 'include/functions.php');


/*
 * remove the user cookie info and redirect to the login page.
 */
setcookie('logged_in', '', time() - 3600, '/');
$_SESSION['username'] = null;
$_SESSION['id'] = null;
header('Location:' . ROOT_LEVEL . 'login.php');