<?php

namespace FirstMile\Utils;


trait InputSanitize
{
    public static function cleanInput($data)
    {
        $data = trim($data);
        $data = filter_var($data, FILTER_SANITIZE_ADD_SLASHES);
        $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        return $data;
    }
}