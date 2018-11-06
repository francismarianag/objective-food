<?php 
abstract class DataBase
{
    // abstract public function traerUsuario($email);   
    abstract public function usuarioLogin($email);
    abstract public function guardarUsuario($usuario);
    abstract public function searchPassword($password, $email);
    abstract public function modificarBD($email);

    public function guardarFoto($fotoPerfil)
    {

    // nombre original
    $nombre = $fotoPerfil["name"];
    //nombre nuevo
    $archivo = $fotoPerfil["tmp_name"];

    //extension del archivo
    $ext = pathinfo($nombre, PATHINFO_EXTENSION);

    //nuevo nombre de la imagen usando un id unico
    $nombreFinal = uniqid() . "." . $ext;

    // Generamos el nuevo path completo de la imagen, usando realpath para permitirnos volver una carpeta hacia atrás.
    $miArchivo = realpath(dirname(__FILE__) . '/..');
    $miArchivo = $miArchivo . "/img/";
    $miArchivo = $miArchivo . $nombreFinal;


    // Movemos el archivo de nuestro /tmp a la nueva locación (en este caso, la carpeta /img)
    move_uploaded_file($archivo, $miArchivo);

    return $nombreFinal;
    }
    
    public function validarFoto ($foto)
    {
        if ($foto["error"] !== UPLOAD_ERR_OK) {
            return false; 
        }
        return true;
    }

    public function validarFotoPerfil($usuario)
    {
        $filesErrores = [];

        // Validamos la foto que recibimos, nos fijamos que se haya subido bien.
        if (!$this->validarFoto($_FILES['subirFotoPerfil'])) {
            $filesErrores['fotoPerfil'] = 'Hubo un error al subir la foto.';
        }
        return $filesErrores;
    }

}
?>