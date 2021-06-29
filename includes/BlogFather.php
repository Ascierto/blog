<?php
namespace FirstMile;


include __DIR__ .'/util.php';

abstract class BlogFather{

    use \FirstMile\Utils\InputSanitize;

    abstract protected static function sanitize($fields);
    abstract public static function insertData($form_data);
    abstract public static function selectData($args=null);
    abstract public static function updateData($form_data,$id);
    abstract public static function deleteData($id=null);

   
}