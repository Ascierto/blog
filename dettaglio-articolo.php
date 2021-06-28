<?php

include __DIR__ .'/includes/navbar.php';

include __DIR__ .'/includes/BlogFather.php';

include __DIR__ .'/includes/Articolo.php';

$args=array(
    'id'=>$_GET['id']
);
if(isset($_GET['id'])){
    $articolo = \FirstMile\Articolo::selectData($args);
}

?>


<section class="container">
    <div class="row">
        <div class="col-12">
            <h1> <?php echo $articolo[0]['titolo'] ?></h1>
            <p> # <?php echo $articolo[0]['id'] ?></p>
        </div>
        <div class="col-12 col-md-6">
            <img src="https://images.unsplash.com/photo-1471107340929-a87cd0f5b5f3?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8YmxvZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=60" class="card-img-top img-fluid" alt="...">
        </div>
        <div class="col-12 col-md-6">
            <p> <?php echo $articolo[0]['contenuto'] ?></p>
            <p><?php echo $articolo[0]['created_at'] ?></p>
        </div>
    </div>

</section>