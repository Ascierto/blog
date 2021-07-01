<?php

session_start();

include __DIR__ .'/includes/navbar.php';

include __DIR__ .'/includes/BlogFather.php';

include __DIR__ .'/includes/Articolo.php';

var_dump($_SESSION);

?>

<main class="container">
    <div class="row">
        <div class="col-12">
        <h1>Ciao <?php echo $_SESSION['nome'] ?></h1>
        </div>
    </div>
</main>