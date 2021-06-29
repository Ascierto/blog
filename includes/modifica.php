<?php


include __DIR__ .'/BlogFather.php';

include __DIR__ .'/Articolo.php';

if(isset($_GET['id'])){
    \FirstMile\Articolo::updateData($_POST,$_GET['id']);
}