<?php

session_start();

    include __DIR__ .'/BlogFather.php';
    include __DIR__ . '/Articolo.php';

    $articolo = \FirstMile\Articolo::insertData($_POST,$_SESSION['userId']);

