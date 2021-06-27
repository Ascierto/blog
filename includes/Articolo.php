<?php

class Articolo {

    public static function insertData($form_data){

        $form_data=array(
            'titolo'=>$form_data['titolo'],
            'contenuto'=>$form_data['contenuto'],
            'immagine'=>$form_data['immagine']
        );

        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }
        
        echo 'Connesso al db';

        $query = $mysqli->prepare('INSERT INTO articoli(titolo, contenuto, immagine) VALUES (?, ?, ?)');
            $query->bind_param('sss', $form_data['titolo'], $form_data['contenuto'],$form_data['immagine']);
            $query->execute();

            if ($query->affected_rows === 0) {
                error_log('Errore MySQL: ' . $query->error_list[0]['error']);
                header('Location: http://localhost:8888/blog/crea-articolo.php?stato=ko');
                exit;
            }

        header('Location: http://localhost:8888/blog/crea-articolo.php?stato=ok');
        exit;
    }
}