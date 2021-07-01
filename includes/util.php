<?php

namespace FirstMile\Utils;


trait InputSanitize
{
    public static function cleanInput($data)
    {
        $data = trim($data);
        $data = filter_var($data, FILTER_SANITIZE_ADD_SLASHES);
        $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        return $data;
    }
}

function showAlert($action_type, $state)
{
    if ($state === 'ko') {
      echo '<div class="alert alert-danger" role="alert">Ops! C\'è stato un problema, riprova più tardi.</div>';
      return false;
    }

    if ($state === "errore") {
      echo '<div class="alert alert-danger" role="alert"><ul>';
      $error_messages = explode('|', $_GET['messages']);
      foreach ($error_messages as $error) {
          echo "<li>$error</li>";
      }
      echo '</ul></div>';
    }

    if ($action_type === 'cancellazione' && $state === 'ok') {
      echo '<div class="alert alert-success" role="alert">Articolo eliminato con successo.</div>';
    } elseif ($action_type === 'modifica' && $state === 'ok') {
      echo '<div class="alert alert-success" role="alert">Articolo modificato con successo.</div>';
    } elseif ($action_type === 'inserimento' && $state === 'ok') {
      echo '<div class="alert alert-success" role="alert">Articolo inserito con successo.</div>';
    }
}