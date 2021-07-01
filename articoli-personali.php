<?php
   session_start();

    include __DIR__ .'/includes/navbar.php';

    include __DIR__ .'/includes/BlogFather.php';

    include __DIR__ .'/includes/Articolo.php';

    //riesco a loggarmi ed iniziare una sessione e riesco a prendere l'email quando

    var_dump($_SESSION);

    


  $articoli = \FirstMile\Articolo::selectData(array( 'userId' => $_SESSION['userId'] ));


if(count($articoli)>0) :


?>

<main class="container">
  <div class="row">

    <?php foreach ($articoli as $articolo) :?>
    <?php if($articolo['pubblicato']== 0): ?>
    <div class="col-12 col-md-6 text-center">
        <h1>Le mie Bozze</h1>
            <div class="col-md-4">
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
                  <a href="dettaglio-articolo.php?id=<?php echo $articolo['id'];?>" class="btn btn-success">Dettaglio</a>
                </div>
              </div>
            </div>

    </div>


  <?php elseif($articolo['pubblicato']== 1):?>
    <div class="col-12 col-md-6 text-center">
        <h1>Articoli pubblicati</h1>
          <div class="col-md-4">
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
                <a href="dettaglio-articolo.php?id=<?php echo $articolo['id'];?>" class="btn btn-success">Dettaglio</a>
              </div>
            </div>
          </div>
    </div>


    <?php endif ; ?>
    
    <?php endforeach ; ?>
  <?php else : ?>

  <div class="my-5 p-5">
    <h2>Non ci sono articoli da visualizzare</h2>
    <p>Vuoi aggiungerne uno? <a href="crea-articolo.php">Clicca qui</a></p>
  </div>

  <?php endif ;?>
  </div>
</main>








        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>