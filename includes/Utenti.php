<?php

namespace FirstMile;

use mysqli;

include __DIR__.'/util.php';

class Utenti{

    use \FirstMile\Utils\InputSanitize;
    
    
    
    public static function registerUser($form_data)
    {
        
        $fields = array(
            'nome'        => $form_data['nome'],
            'cognome'        => $form_data['cognome'],
            'email'        => $form_data['email'],
            'password'        => $form_data['password'],
            'password-check'  => $form_data['password-check']
        );
        
        $fields = self::sanitize($fields);
        
        if ($fields['password'] !== $fields['password-check']) {
            
            header('Location: http://localhost:8888/blog/registrati.php?stato=errore&messages=Le password non corrispondono');
            exit;
            
        }
        
        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');
        
        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }
        
        $query_user = $mysqli->query("SELECT email FROM utenti WHERE email = '" . $fields['email'] . "'");
        
        if ($query_user->num_rows > 0) {
            header('Location: http://localhost:8888/blog/registrati.php?stato=errore&messages=Email già presente');
            exit;
        }
        
        $query_user->close();
        
        $query = $mysqli->prepare('INSERT INTO utenti(nome,cognome,email, password) VALUES (?,?,?, MD5(?))');
        $query->bind_param('ssss', $fields['nome'], $fields['cognome'], $fields['email'], $fields['password']);
        $query->execute();
        
        if ($query->affected_rows === 0) {
            error_log('Error MySQL: ' . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/blog/registrati.php?stato=ko');
            exit;
        }
        
        header('Location: http://localhost:8888/blog/login.php?stato=ok');
        exit;
    }
    public static function loginUser($form_data)
    {

        $fields = array(
        'email'  => $_POST['email'],
        'password'  => $_POST['password']
        );

        $fields = self::sanitize($fields);

        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }

        $query_user = $mysqli->query("SELECT * FROM utenti WHERE email = '" . $fields['email'] . "'");

        if ($query_user->num_rows === 0) {
            header('Location: http://localhost:8888/blog/login.php?stato=errore&messages=Utente non presente');
            exit;
        }

        $user = $query_user->fetch_assoc();

        if ($user['password'] !== md5($fields['password'])) {
            header('Location: http://localhost:8888/blog/login.php?stato=errore&messages=Password errata');
            exit;
        }

        return array(
        'id'  => $user['id'],
        'email' => $user['email'],
        'nome' => $user['nome']
        );
    }
    
    public static function isEmailAddressValid($email_address)
    {
        return filter_var($email_address, FILTER_VALIDATE_EMAIL);
    }
    
    protected static function sanitize($fields)
    {
        if (isset($fields['email']) && $fields['email'] !== '') {
            $fields['email'] = self::cleanInput($fields['email']);
            if (! self::isEmailAddressValid($fields['email'])) {
                $errors[] = new \Exception('Indirizzo email non valido.');
            }
        }
    
        return $fields;
    }
}