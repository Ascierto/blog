<?php

namespace FirstMile;

use mysqli;

class Commenti{

    public static function insertComment($data,$args){


        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }

        if(isset($args['id'])){
            $args['id'] = intval($args['id']);
            $query= $mysqli->prepare('INSERT INTO commenti(commento,id_articolo) VALUES (?,?)');
            $query->bind_param('si', $data['commento'],$args['id']);
            $query->execute();

            if ($query->affected_rows === 0) {
                error_log('Errore MySQL: ' . $query->error_list[0]['error']);
                header('Location: http://localhost:8888/blog/?stato-commento=ko');
                exit;
            }

            header('Location: http://localhost:8888/blog/?&stato-commento=ok');
            exit;
        }

    }

    public static function selectComment($id){

        $mysqli = new mysqli('127.0.0.1', 'root', 'rootroot', 'blog_php');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }

      
            $query = $mysqli->query('SELECT * FROM commenti JOIN articoli ON commenti.id_articolo = articoli.id
            WHERE id_articolo = '. $id);
  
            
        

        

        

        $results=[];

        if($query->num_rows > 0){
            
            while ($row = $query->fetch_assoc()) {
                $results[] = $row;
            }      
        }

        return $results;

    }
}