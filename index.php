<?php
    include __DIR__ .'/includes/navbar.php';

    include __DIR__ .'/includes/BlogFather.php';

    include __DIR__ .'/includes/Articolo.php';
    

    $articoli = \FirstMile\Articolo::selectData();
?>

<main class="container">
  <div class="row">
    <div class="col-12 text-center">
        <h1>Tutti gli articoli</h1>
    </div>

    <?php foreach ($articoli as $articolo) :?>

    <div class="col-12 col-md-4">
      <div class="card mb-3">
        <img src="https://images.unsplash.com/photo-1471107340929-a87cd0f5b5f3?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8YmxvZ3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=60" class="card-img-top img-fluid" alt="...">
        <div class="card-body">
          <h5 class="card-title"> <?php echo $articolo['titolo'] ?></h5>
          <p class="card-text">  <?php echo substr($articolo['contenuto'],0,100) . "..." ?>  </p>
          <p class="card-text"><small class="text-muted"> <?php echo $articolo['created_at'] ?> </small></p>
        </div>
        <div>
          <a href="dettaglio-articolo.php?id=<?php echo $articolo['id'];?>" class="btn btn-success">Dettaglio</a>
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