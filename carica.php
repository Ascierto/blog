<?php

if(isset($_FILES['upload']) && $_FILES['upload']['error'] == 0){
    print_r($_FILES['upload']);
    $estensioni_permesse=array(
        'jpg'=>'image/jpg',
        'jpeg'=>'image/jpeg',
        'png'=>'image/png',
    );
    $nome_file=$_FILES['upload']['name'];
    $tipo_file=$_FILES['upload']['type'];
    $size_file=$_FILES['upload']['size'];

    //verifico estensione file

    $estensione = pathinfo($nome_file,PATHINFO_EXTENSION);
    if(! array_key_exists($estensione,$estensioni_permesse)){
        echo"errore!Seleziona formato valido";
    }

    //fare controllo dimensioni!

    if(in_array($tipo_file,$estensioni_permesse)){
        if(file_exists('images/'.$nome_file)){
            echo $nome_file . 'esiste già';
        }else{
            move_uploaded_file($_FILES['upload']['tmp_name'], 'images/'.$nome_file);
        }
    }else{
        echo 'Errore durante il caricamento';
    }
}else{

    echo "Errore" . $_FILES['upload']['error'];
}