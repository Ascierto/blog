<?php

session_start();


if (!isset($_SESSION['email'])) {
    header('Location: http://localhost:8888/blog/login.php');
}

    include __DIR__ .'/includes/navbar.php';

    include __DIR__ .'/includes/BlogFather.php';

    include __DIR__ .'/includes/Articolo.php';

    if (isset($_GET['stato'])) {
        \FirstMile\Utils\showAlert('inserimento', $_GET['stato']);
    }

?>

        <main class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9">
                    <h1 class="my-3">Inserisci Articolo</h1>
                    <form action="./includes/inserisci-articolo.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titolo" class="form-label">Titolo</label>
                            <input name="titolo" type="text" class="form-control" id="titolo">
                        </div>
                        <div class="mb-3">
                            <label for="contenuto" class="form-label">Contenuto</label>
                            <textarea name="contenuto" id="contenuto" cols="15" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Immagine</label>
                            <input name="immagine" type="file" class="form-control" id="img">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pubblica adesso o salva come bozza?</label>
                            <select name="pubblicato" class="form-select">
                                <option value="1">Pubblica</option>
                                <option value="0">Salva in bozze</option>
                            </select>    
                        </div>
                        <div class="mb-3">
                            <label for="autore" class="form-label">Scritto da..</label>
                            <input name="autore" type="text" class="form-control" id="autore">
                        </div>


                        <button type="submit" class="btn btn-primary">Crea</button>
                    </form>                
                </div>
            </div>
        </main>






        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>