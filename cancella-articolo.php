<?php


if (!isset($_SESSION['email'])) {
    header('Location: http://localhost:8888/blog/login.php');
}


include __DIR__ .'/includes/BlogFather.php';

include __DIR__ .'/includes/Articolo.php';

if(isset($_GET['id'])){
    \FirstMile\Articolo::deleteData($_GET['id']);
} else {
    \FirstMile\Articolo::deleteData(null, $_SESSION['userId']);
  }

  