<?php
  session_start();
    include __DIR__ .'/includes/navbar.php';

    include __DIR__ .'/includes/BlogFather.php';

    include __DIR__ .'/includes/Articolo.php';

    $articoli=\FirstMile\Articolo::showArticoli();

    // var_dump($articoli);
?>

<main class="container">
  <div class="row">
    <div class="col-12 text-center">
        <h1>Tutti gli articoli</h1>
    </div>

    <?php foreach ($articoli as $articolo) :?>

    <div class="col-12 col-md-4">
      <div class="card mb-3">
      <?php if($articolo['immagine']): ?>
        <img src="./images/<?php echo $articolo['immagine'] ?>" class="card-img-top img-fluid" alt="...">
       <?php else :?>
        <img src="./images/default-blog.jpg" class="card-img-top img-fluid" alt="...">
        <?php endif?>
        <div class="card-body">
          <h5 class="card-title"> <?php echo $articolo['titolo'] ?></h5>
          <p class="card-text">  <?php echo substr($articolo['contenuto'],0,100) . "..." ?>  </p>
          <p class="card-text"><small class="text-muted"> <?php echo $articolo['created_at'] ?> </small></p>

          <h5 class="card-title"> Pubblicato? <?php $articolo['pubblicato'] == 0 ? printf('No!'):printf('Si!') ;?> </h5>


        </div>
        <div>
          <a href="dettaglio-index.php?id=<?php echo $articolo['id'];?>" class="btn btn-success">Dettaglio</a>
        </div>
      </div>
    </div>

    <?php endforeach ; ?>
  </div>

</main>






        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>