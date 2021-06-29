<?php   

include __DIR__ . '/includes/Utenti.php';
include_once __DIR__ . '/includes/util.php';

\FirstMile\Utenti::registerUser($_POST);

