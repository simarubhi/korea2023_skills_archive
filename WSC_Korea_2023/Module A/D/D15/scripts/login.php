<?php
session_start();

$max_attempts = 5;
$lockout_time = 900;

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

if ($_SESSION['login_attempts'] >= $max_attempts && time() - $_SESSION['last_attempt_time'] < $lockout_time) {
    die('Too many login attempts. Please try again later.');
}

/**
 * define the number of ../ to get to the root folder
 */
define('ROOT_LEVEL', '../');

/**
 * require the general functions file
 */
require(ROOT_LEVEL . 'include/functions.php');

/*
 * look up the user
 */

$pdo = dbConnect();
$stmt = $pdo->prepare("SELECT `id`, `username` FROM `users` WHERE `username`= ? AND `password`= ?");
$stmt->execute([$_POST['username'], hash('md5', $_POST['password'])]);
$user = $stmt->fetch();

/*
 * if no user is found, redirect to the login page with an error,
 * otherwise, save the info in a cookie
 */
if (!$user){
    header('Location:' . ROOT_LEVEL . 'login.php');
    $_SESSION['errors'] = 'Wrong username or password';
    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt_time'] = time();
    $_SESSION['username'] = null;
    $_SESSION['id'] = null;
    exit;
} else {
    setcookie('logged_in', true, 0, '/');
    $_SESSION['username'] = $user->username;
    $_SESSION['id'] = $user->id;
    $_SESSION['login_attempts'] = 0;
    $_SESSION['errors'] = null;
    header('Location:' . ROOT_LEVEL . 'index.php');
    exit;
}

