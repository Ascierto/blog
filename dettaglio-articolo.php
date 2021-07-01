<?php
session_start();


if (!isset($_SESSION['email'])) {
    header('Location: http://localhost:8888/blog/login.php');
}

    include __DIR__ .'/includes/navbar.php';

    include __DIR__ .'/includes/BlogFather.php';

    include __DIR__ .'/includes/Articolo.php';

$args     = array(
    'id' => $_GET['id'],
    'userId' => $_SESSION['userId']
);
 

$articolo = \FirstMile\Articolo::selectData($args);



if (count($articolo) > 0) :


if (isset($_GET['stato'])) {
    \FirstMile\Utils\showAlert('modifica', $_GET['stato']);
}

?>


<section class="container">
    <div class="row">
        <div class="col-12 text-end">
            <a href="modifica-articolo.php?id=<?php echo $_GET['id'];?>" class="btn btn-outline-warning">Modifica</a>
            <a href="cancella-articolo.php?id=<?php echo $_GET['id'];?>" class="btn btn-outline-danger">Elimina</a>
        </div>
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

            <p>Autore : <?php echo $articolo[0]['autore'] ?></p>

            <h5> Pubblicato? <?php $articolo[0]['pubblicato'] == 0 ? printf('No!'):printf('Si!') ;?> </h5>
        </div>
    </div>

</section>

<?php else : ?>

<h1>Spiacenti nessun articolo trovato</h1>

<?php endif; ?>

