<?php

class ConexionDB
{
    //el metodo lo hago static para usarlo sin instanciar la clase.
    public static function conexion()
    {
        
        $dsn = 'mysql:host=localhost;dbname=usuarios;port=3306;charset=utf8';
        $username = 'root';
        $password = 'root';
        // $options =  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];
        
        try {
            $db = new PDO($dsn, $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $db;
        }
        catch( PDOException $Exception ) {
            echo $Exception->getMessage();
        }
    }
}