<?php
    include __DIR__ .'/includes/navbar.php';

    include __DIR__ .'/includes/BlogFather.php';

    include __DIR__ .'/includes/Articolo.php';


    $args= array(
        'id'=>$_GET['id']
      );
      
  
      $articolo = \FirstMile\Articolo::selectData($args);

?>

        <main class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="./includes/modifica.php?id=<?php echo $articolo[0]['id']; ?>" method="POST">
                        <div class="mb-3">
                            <label for="titolo" class="form-label">Titolo</label>
                            <input name="titolo" type="text" class="form-control" id="titolo" value="<?php echo $articolo[0]['titolo']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contenuto" class="form-label">Contenuto</label>
                            <textarea name="contenuto" id="contenuto" cols="15" rows="4" class="form-control"><?php echo $articolo[0]['contenuto']; ?> </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Immagine</label>
                            <input name="immagine" type="file" class="form-control" id="img">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>                
                </div>
            </div>
        </main>
