<?php

session_start();

    include __DIR__ .'/BlogFather.php';
    include __DIR__ . '/Articolo.php';

    // var_dump($_FILES);
    // var_dump($_POST);
    // var_dump($_SESSION);
    // exit();
   

        $articolo = \FirstMile\Articolo::insertData($_POST,$_SESSION['userId'],$_FILES);
    
