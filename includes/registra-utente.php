<?php   

include __DIR__ . '/Utenti.php';
include_once __DIR__ . '/util.php';

\FirstMile\Utenti::registerUser($_POST);

