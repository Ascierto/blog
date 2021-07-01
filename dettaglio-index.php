<?php
session_start();

include __DIR__ .'/includes/navbar.php';

include __DIR__ .'/includes/BlogFather.php';

include __DIR__ .'/includes/Articolo.php';

$args     = array(
    'id' => $_GET['id'],
);

if(isset($_GET['id'])){
    $articolo = \FirstMile\Articolo::showArticoli($args);
    $conta = \FirstMile\Articolo::countComment($args);
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

            <p>Autore : <?php echo $articolo[0]['autore'] ?></p>

            <h5> Pubblicato? <?php $articolo[0]['pubblicato'] == 0 ? printf('No!'):printf('Si!') ;?> </h5>

            <p>Questo articolo ha <span class="fs-3 fw-bold"> <?php echo $conta[0]['conta'] ?> </span>commenti </p>
        </div>
    </div>

</section>

<section class="container my-5">
    <div class="row">
        <div class="col-12">
            <form action="includes/inserisci-commento.php?id=<?php echo $articolo[0]['id'] ?>" method="POST">
                <label for="commento" class="form-label">Aggiungi commento</label>
                <textarea name="commento" id="commento" cols="5" rows="4" class="form-control"></textarea>

                <input type="submit" value="Inserisci commento" class="btn btn-dark my-2">
            </form>
        </div>
    </div>
</section>


<?php 
    include __DIR__ .'/includes/Commenti.php';

    $id=$_GET['id'];

    $commenti=\FirstMile\Commenti::selectComment($id);

    if(count($commenti)>0) :

?>

        <section class="container my-5">
            <div class="row">
                <div class="col-12">
                    <h3>Tutti i commenti</h3>
                </div>
    <?php foreach ($commenti as $commento):?>

                <div class="col-12">
                    <div class="card bg-light my-2">
                        <p class="p-3"><?php echo $commento['commento']; ?></p>
                    </div>
                </div>
    <?php endforeach; ?>
            </div>
        </section>
        

  <?php else : ?>
  <div class="container my-5">
    <div class="row">
        <div class="col-12 text-center">
            <h3>Non ci sono commenti, sii tu il primo a commentare</h3>
        </div>
    </div>
  </div>
   <?php endif ; ?>




        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>