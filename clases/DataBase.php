<?php 
abstract class DataBase
{
    
    
    //+ la funcion traer usuario recibe un parametro email que en realidad va a ser la variable 
    //+ $_POST['email]. Al recibir el email, primero declara al usuario como null( osea no existe).
    //+ luego, hace un fopen del archivo 'usuarios.txt' y lo recorre linea por linea decodificando
    //+ cada usuario. Si el email recibido por post concuerda con un email del archivo json quiere decir
    //+ que el usuario ya existía entonces deja de ser null. Cierra el archivo y retorna $usuario.
    abstract public function traerUsuario($email);
    
    //+ la funcion guardarUsuario recibe como parametro un usuario, hace un json_encode de este y luego
    //+ lo guarda en el archivo usuarios.json.
    
    abstract public function guardarUsuario($usuario);
    
    //Verifica contraseña en el archivo json. Esta funcion es usada en el login para verificar si el password introducido coincide con el guardado en el registro 
    abstract public function searchPassword($password, $email);

    abstract public function modificarBD($email);

    public function guardarFoto($fotoPerfil)
    {

    // Ponemos el nombre original de la foto en una variable.
    $nombre = $fotoPerfil["name"];

    // Ponemos el nombre nuevo en otra variable (el que php pone en la carpeta /tmp).
    $archivo = $fotoPerfil["tmp_name"];

    // Ponemos la extensión del archivo en una variable.
    $ext = pathinfo($nombre, PATHINFO_EXTENSION);

    // Generamos el nuevo nombre de la imagen usando un id único con la función uniqid
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