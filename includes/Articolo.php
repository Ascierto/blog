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

    public static function insertData($form_data, $loggedInUserId,$file=null){

        $file=array(
            'nome'=>$_FILES['immagine']['name'],
            'path'=>$_FILES['immagine']['tmp_name'],
            'type'=>$_FILES['immagine']['type'],
            'error'=>$_FILES['immagine']['error']
        );

 

            if($file['error'] == 0){
               
                $estensioni_permesse=array(
                    'jpg'=>'image/jpg',
                    'jpeg'=>'image/jpeg',
                    'png'=>'image/png',
                );

            
                //verifico estensione file
            
                $estensione = pathinfo($file['nome'],PATHINFO_EXTENSION);
                if(! array_key_exists($estensione,$estensioni_permesse)){
                    echo"errore!Seleziona formato valido";
                }
            
                //fare controllo dimensioni!
            
                if(in_array($file['type'],$estensioni_permesse)){
                    if(file_exists('images/'.$file['nome'])){
                        echo $file['nome']. 'esiste già';
                    }else{
                        move_uploaded_file($file['path'], '../images/'.$file['nome']);
                    }
                }else{
                    echo 'Errore durante il caricamento';
                }
            }else{
            
                echo "Errore" . $file['error'];
            }

   
       

        $fields=array(
            'titolo'=>$form_data['titolo'],
            'contenuto'=>$form_data['contenuto'],
            'pubblicato'=>$form_data['pubblicato'],
            'immagine'=>$file['nome']
        );


    

        

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

        if($fields){

            $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');
    
            if ($mysqli->connect_errno) {
                echo 'Connessione al database fallita: ' . $mysqli->connect_error;
                exit();
            }
            
            echo 'Connesso al db';
    
            $query = $mysqli->prepare('INSERT INTO articoli(titolo, contenuto, immagine,created_at,pubblicato,id_utente) VALUES (?, ?, ?,NOW(),?,?)');
                $query->bind_param('sssii', $form_data['titolo'], $form_data['contenuto'],$fields['immagine'],$form_data['pubblicato'],$loggedInUserId);
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

    public static function selectData($args=null){

        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }



        if (isset($args['id'])) {
            $args['id'] = intval($args['id']);
            $query      = $mysqli->prepare('SELECT * FROM articoli JOIN utenti ON articoli.id_utente = utenti.id
            WHERE articoli.id = ? AND utenti.id = ?');
            $query->bind_param('ii', $args['id'],$args['userId']);
            $query->execute();
            $query = $query->get_result();
        } else {
            $query = $mysqli->query('SELECT * FROM blog_php.articoli WHERE articoli.id_utente =' . $args['userId']);
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
        $fields = array(
            'titolo'=>$form_data['titolo'],
            'contenuto'=>$form_data['contenuto'],
            'pubblicato'=>$form_data['pubblicato'],
            'immagine'=>$form_data['immagine']
        );

        $fields = self::sanitize($fields);

        if ($fields) {
            $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');
    
            if ($mysqli->connect_errno) {
                echo 'Connessione al database fallita: ' . $mysqli->connect_error;
                exit();
            }

            $id          = intval($id);
            $is_in_error = false;

            try {
                $query = $mysqli->prepare('UPDATE articoli 
                SET titolo = ?, contenuto = ?, created_at = NOW(),pubblicato = ? 
                WHERE id = ?');
                if (is_bool($query)) {
                    throw new \Exception('Query non valida. $mysqli->prepare ha restituito false.');
                }
                $query->bind_param('ssii', $fields['titolo'], $fields['contenuto'], $fields['pubblicato'],$id);
                $query->execute();
            } catch (\Exception $e) {
                error_log("Errore PHP in linea {$e->getLine()}: " . $e->getMessage() . "\n", 3, 'my-errors.log');
            }

            if (! is_bool($query)) {
                if (count($query->error_list) > 0) {
                    $is_in_error = true;
                    foreach ($query->error_list as $error) {
                        error_log("Errore MySQL n. {$error['errno']}: {$error['error']} \n", 3, 'my-errors.log');
                    }
                    header('Location: http://localhost:8888/blog/modifica-articolo.php?id=' . $id . '&stato=ko');
                    exit;
                }
            }

            $stato = $is_in_error ? 'ko' : 'ok';
            header('Location: http://localhost:8888/blog/dettaglio-articolo.php?id=' . $id . '&stato=' . $stato);
            exit;
        }

        
    }
    

    public static function deleteData($id = null, $userId = null){

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
        }else {
            // $query = $mysqli->query('DELETE FROM contatti_meta');
            $query = $mysqli->prepare('DELETE FROM articoli WHERE id_utente = ?');
            $query->bind_param('i', $userId);
            $query->execute();
    
            if ($query->affected_rows > 0) {
                header('Location: http://localhost:8888/blog/cancella-articolo.php?statocanc=ok');
                exit;
            } else {
                header('Location: http://localhost:8888/blog/cancella-articolo.php?statocanc=ko');
                exit;
            }
          }

    }
    public static function showArticoli($args=null)
    {
        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "blog_php");
        
        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }

        if (isset($args['id'])) {
            $args['id'] = intval($args['id']);
            $query = $mysqli->query('SELECT * FROM articoli WHERE pubblicato=1 AND id = '.$args['id']);
        }else{

            $query = $mysqli->query('SELECT * FROM articoli WHERE pubblicato=1');
        }


        $results=[];

        if($query->num_rows > 0){
            
            while ($row = $query->fetch_assoc()) {
                $results[] = $row;
            }      
        }

        return $results;
    }

    
}