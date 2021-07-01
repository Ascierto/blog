<?php
    session_start();


if (!isset($_SESSION['email'])) {
    header('Location: http://localhost:8888/blog/login.php');
}

    include __DIR__ .'/includes/navbar.php';

    include __DIR__ .'/includes/BlogFather.php';

    include __DIR__ .'/includes/Articolo.php';


    $args= array(
        'id'=>$_GET['id'],
        'userId' => $_SESSION['userId']
      );
      
  
      $articolo = \FirstMile\Articolo::selectData($args);

?>

        <main class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="./includes/modifica.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="mb-3">
                            <label for="titolo" class="form-label">Titolo</label>
                            <input name="titolo" type="text" class="form-control" id="titolo" value="<?php echo $articolo[0]['titolo']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contenuto" class="form-label">Contenuto</label>
                            <textarea name="contenuto" id="contenuto" cols="15" rows="4" class="form-control"><?php echo $articolo[0]['contenuto']; ?> </textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pubblica adesso o salva come bozza?</label>
                            <select name="pubblicato" class="form-select">
                                <option value="1">Pubblica</option>
                                <option value="0">Salva in bozze</option>
                            </select>    
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>                
                </div>
            </div>
        </main>
