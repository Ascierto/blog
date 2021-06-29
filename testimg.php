<?php
include __DIR__ . '/includes/navbar.php';


?>

<form action="carica.php" method="post" enctype="multipart/form-data">

    <input type="file" name="upload">

    <input type="submit" value="invia">
</form>