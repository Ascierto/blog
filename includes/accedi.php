<?php
session_start();

include __DIR__ . '/Utenti.php';
include_once __DIR__ . '/util.php';

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header('Location: http://localhost:8888/blog/login.php');
    exit;
}

$loggedInUser = \FirstMile\Utenti::loginUser($_POST);
$_SESSION['email'] = $loggedInUser['email'];
$_SESSION['userId'] = $loggedInUser['id'];
header('Location: http://localhost:8888/blog');
exit;

var_dump($_SESSION);