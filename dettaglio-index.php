<?php
include __DIR__ .'/includes/navbar.php';

include __DIR__ .'/includes/BlogFather.php';

include __DIR__ .'/includes/Articolo.php';

$args     = array(
    'id' => $_GET['id'],
);

if(isset($_GET['id'])){
    $articolo = \FirstMile\Articolo::showArticoli($args);
}

?>

<section class="container">
    <div class="row">

        <div class="col-12">
            <h1> <?php echo $articolo[0]['titolo'] ?></h1>
            <p> # <?php echo $_GET['id'] ?></p>
        </div>
        <div class="col-12 col-md-6">
        <?php if($articolo[0]['immagine']): ?>
            <img src="./images/<?php echo $articolo[0]['immagine'] ?>" class="card-img-top img-fluid" alt="...">
        <?php else :?>
            <img src="./images/default-blog.jpg" class="card-img-top img-fluid" alt="...">
        <?php endif?>
        </div>
        <div class="col-12 col-md-6">
            <p> <?php echo $articolo[0]['contenuto'] ?></p>
            <p><?php echo $articolo[0]['created_at'] ?></p>
        </div>
    </div>

</section>