<?php 
class Json extends DataBase 
{
    //este atributo corresponde contiene la conexion con
    //la base de datos
    private $conexion; 
    
    public function __construct($conexion){
        $this->conexion=$conexion;
    }
    //retorna el email si el usuario existe en la base de datos
    public function traerUsuario($email){
        
    }    

    //devuelve un objeto Usuario con los datos guardados
    public function usuarioLogin($email)
    {
    }

    //guarda el usuario una vez completado y validado el registro
    public function guardarUsuario($usuario){
        
    }
    //usar un typeof
    //retorna un array con los usuarios del json
    public function traerUsuarios()
    {

    }

    //devuelve la imagen guardada en el json
    public function searchImg($email){
    }

    public function searchPassword($password, $email){
        
    }
    public function modificarBD($email)
    {
        
    }

    public function eliminarBD($email)
    {

    }

    public function modificarFotoUsuario($email)
    {
        
    }


    //retorna un array de la consulta query
    public function index($tabla)
    {
        //prepara una sentencia y devuelve un objeto sentencia
        //la estoy usando porque recibo variables del usuario
        $query = $this->conexion->prepare("SELECT * FROM {$tabla}"); 
        $query->execute();
        //extraigo los datos con fectchall y lo almaceno en $result
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
       
        return $result;
    }

}
            ?>