<?php

namespace FirstMile;
use mysqli;

class Articolo extends BlogFather{

    protected static function sanitize($fields)
    {
        //Questa funzione è da rivedere non funziona effettivamente;
        
        $fields['titolo'] = self::cleanInput($fields['titolo']);

        $fields['contenuto'] = self::cleanInput($fields['contenuto']);

        return $fields;

    }

    public static function insertData($form_data){

        $fields=array(
            'titolo'=>$form_data['titolo'],
            'contenuto'=>$form_data['contenuto'],
            'immagine'=>$form_data['immagine']
        );

        // $target = "blog/images/". basename($_FILES['immagine']['name']);

        

        $fields = self::sanitize($fields);

        if ($fields[0] instanceof \Exception) {
            $error_messages = '';
            foreach ($fields as $key => $error) {
                $error_messages .= $error->getMessage();
                if ($key < count($fields) - 1) {
                    $error_messages .= '|';
                }
            }
            header('Location: http://localhost:8888/blog/crea-articolo.php?stato=errore&messages='
             . $error_messages);
            exit;
        }

        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }
        
        echo 'Connesso al db';

        $query = $mysqli->prepare('INSERT INTO articoli(titolo, contenuto, immagine,created_at) VALUES (?, ?, ?,NOW())');
            $query->bind_param('sss', $form_data['titolo'], $form_data['contenuto'],$form_data['immagine']);
            $query->execute();

            if ($query->affected_rows === 0) {
                error_log('Errore MySQL: ' . $query->error_list[0]['error']);
                header('Location: http://localhost:8888/blog/crea-articolo.php?stato=ko');
                exit;
            }

        // if(move_uploaded_file($_FILES['immagine']['tmp_name'],$target)){
        //     echo "immagine caricata nella cartella";
        // }else{
        //     echo "Ops c'è stato un errore";
        // }

        header('Location: http://localhost:8888/blog/crea-articolo.php?stato=ok');
        exit;
        
        

    }

    public static function selectData($args=null){

        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }



        if(isset($args['id'])){
            $args['id'] = intval($args['id']);
            $query = $mysqli->query("SELECT * FROM articoli WHERE id = " . $args['id']);
        }else{
            
            $query= $mysqli->query("SELECT * FROM articoli");
        }
        

        

        $results=[];

        if($query->num_rows > 0){
            
            while ($row = $query->fetch_assoc()) {
                $results[] = $row;
            }      
        }

        return $results;

    }

    public static function updateData($form_data, $id)
    {
        $fields=array(
            'titolo'=>$form_data['titolo'],
            'contenuto'=>$form_data['contenuto'],
            'immagine'=>$form_data['immagine']
        );

        $fields = self::sanitize($fields);

        if($fields){

            $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');
    
            if ($mysqli->connect_errno) {
                echo 'Connessione al database fallita: ' . $mysqli->connect_error;
                exit();
            }

            $id= intval($id);

            //Gestisci bene gli errori


            try {
                $query = $mysqli->prepare('UPDATE articoli SET titolo = ?, contenuto = ?, created_at = NOW() WHERE id = ?');
                if (is_bool($query)) {
                    throw new \Exception('Query non valida. $mysqli->prepare ha restituito false.');
                }
                $query->bind_param('ssi', $fields['titolo'], $fields['contenuto'], $id);
                $query->execute();
            } catch (\Exception $e) {
                error_log("Errore PHP in linea {$e->getLine()}: " . $e->getMessage() . "\n", 3, 'my-errors.log');
            }

            if ($query->affected_rows === 0) {
                error_log("Errore MySQL: " . $query->error_list[0]['error']);
                header('Location: http://localhost:8888/blog/modifica-articolo.php?stato=ko&id='. $id);
                exit;
            }
            
            header('Location: http://localhost:8888/blog/index.php?stato=ok');
            exit;
            
            $mysqli->close();
        
        }
    }

    public static function deleteData($id = null){

        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "blog_php");
        
        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }

        if ( $id ) {

            $id = intval($id);
    
            $query = $mysqli->prepare('DELETE FROM articoli WHERE id = ?');
            $query->bind_param('i', $id);
            $query->execute();
    
            if ($query->affected_rows > 0) {
                header('Location: http://localhost:8888/blog/?statocanc=ok');
                exit;
            } else {
                header('Location: http://localhost:8888/blog/?statocanc=ko');
                exit;
            }
        }

        //   else{

        //     $query = $mysqli->query('DELETE FROM lista');
            
        //     if ($query->affected_rows > 0) {
        //         header('Location: http://localhost:8888/todolist/?statocanc=ok');
        //         exit;
        //     } else {
        //         header('Location: http://localhost:8888/todolist/?statocanc=ko');
        //         exit;
        //     }
        // }
    }

    
}