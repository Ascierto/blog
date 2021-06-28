<?php

namespace FirstMile;

abstract class BlogFather{

    abstract protected static function sanitize($fields);
    abstract public static function insertData($form_data);
    abstract public static function selectData($args=null);
}