<?php
namespace FirstMile;


include __DIR__ .'/util.php';

abstract class BlogFather{

    use \FirstMile\Utils\InputSanitize;

    abstract protected static function sanitize($fields);
    abstract public static function insertData($form_data, $loggedInUserId,$file=null);
    abstract public static function selectData($args=null);
    abstract public static function updateData($form_data,$id);
    abstract public static function deleteData($id = null, $userId = null);
    abstract public static function showArticoli($args=null);

   
}