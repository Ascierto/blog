<?php

    include __DIR__ .'/Commenti.php';

    $args=array(
        'id'=>$_GET['id']
    );

 $commento = \FirstMile\Commenti::insertComment($_POST,$args);
    

   