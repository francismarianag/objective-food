<?php

class ConexionDB
{
    //el metodo lo hago static para usarlo sin instanciar la clase.
    public static function conexion()
    {
        
        $dsn = 'mysql:host=localhost;dbname=dh_database;port=3306;charset=utf8mb4';
        $username = 'root';
        $password = 'root';
        
        try {
            $db = new PDO($dsn, $username, $password);
            // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
        catch( PDOException $Exception ) {
            echo $Exception->getMessage();
        }
    }
}