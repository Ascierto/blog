<?php

session_start();

    include __DIR__ .'/BlogFather.php';
    include __DIR__ . '/Articolo.php';

    // var_dump($_FILES);
    // exit();

    $articolo = \FirstMile\Articolo::insertData($_POST,$_SESSION['userId']);

