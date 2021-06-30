<?php

use function PHPSTORM_META\type;

var_dump($_FILES['upload']);
    

    $file=array(
        'nome'=>$_FILES['upload']['name'],
        'path'=>$_FILES['upload']['tmp_name'],
        'type'=>$_FILES['upload']['type'],
        'error'=>$_FILES['upload']['error']
    );

    var_dump($file);
    exit();


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
                move_uploaded_file($_FILES['upload']['tmp_name'], './images/'.$nome_file);
            }
        }else{
            echo 'Errore durante il caricamento';
        }
    }else{
    
        echo "Errore" . $_FILES['upload']['error'];
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
         <img src="./images/<?php echo $nome_file; ?>" alt="">
    </div>
</body>
</html>