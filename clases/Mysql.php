<?php 
class Mysql extends DataBase 
{
    //conexion con la base de datos
    private $db; 
    
    public function __construct($db){
        $this->db=$db;
    }
    //retorna el email si el usuario existe
    public function traerUsuario($email){
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = '$email'"); 
        $stmt->execute();
        $usuario= $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario['email'];
    }    

    //devuelve un objeto Usuario con los datos guardados
    public function usuarioLogin($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = '$email'"); 
        $stmt->execute();
        $usuario= $stmt->fetch(PDO::FETCH_ASSOC);
        
        return new Usuario($usuario['nombre'], $usuario['apellido'], $usuario['email'], $usuario['password'], $usuario['foto']);
    }

    //recibe un objeto Usuario para guardarlo en la BD
    public function guardarUsuario($usuario){

        $sql = "INSERT INTO usuarios (nombre, apellido, email, password, foto) VALUES (:nombre,:apellido, :email, :password, :foto)";
        //ejecutamos el metodo prepare() que tiene la clase PDO, recibe la sentencia sql y retorna un objeto de tipo PDOStatement
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nombre", $usuario->getNombre(), PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $usuario->getApellido(), PDO::PARAM_STR);
        $stmt->bindParam(":email", $usuario->getEmail(), PDO::PARAM_STR);
        $stmt->bindParam(":password", $usuario->getContrasenia(), PDO::PARAM_STR);
        $stmt->bindParam(":foto", $usuario->getFotoPerfil(), PDO::PARAM_STR);
        $stmt->execute();
        // dd($stmt);
    }

    //devuelve la imagen guardada
    public function searchImg($email)
    {
        $stmt = $this->db->prepare("SELECT foto FROM usuarios WHERE email = '$email'"); 
        $stmt->execute();
        $usuario= $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario['foto'];
    }
    //Verifica contraseña y devuelve true si la verificacion lo es
    public function searchPassword($password, $email){

        $stmt = $this->db->prepare("SELECT password FROM usuarios WHERE email = '$email'"); 
        $stmt->execute();
        $usuario= $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $usuario['password'])) {  
                        return true;
                    } else {
                        return false;
                    }
    }

    //modifica todos los datos del perfil
    //{{ Tomar en cuenta a futuro una confirmacion del nuevo email introducido}}
    public function modificarBD($post)
    {
        
        $emailActual = user()->getEmail();
        $passwordActual = user()->getContrasenia();
        if ($passwordActual != $post['password'] ) {
            $password = password_hash($post['password'], PASSWORD_DEFAULT);
        } else {
            $password = $post['password'];
        }

        $stmt = $this->db->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, email = :email, password = :password WHERE email = '$emailActual'");
        
        $stmt->bindParam(":nombre",  $post['nombre']);
        $stmt->bindParam(":apellido",  $post['apellido']);
        $stmt->bindParam(":email",  $post['email']);
        $stmt->bindParam(":password",  $password);
        $stmt->execute();
        $usuario = $this->usuarioLogin($post['email']);
        return new Usuario($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->contrasenia);

    }
    //elimina de la base de datos. {{ Considerar una confirmacion previa }}
    public function eliminarBD($email)
    {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE email = '$email'"); 
        $stmt->execute();
    }

    public function modificarFotoUsuario($email)
    {
        $nuevaFoto = "img/".$this->guardarFoto($_FILES["subirFotoPerfil"]);
        $stmt = $this->db->prepare("UPDATE usuarios SET foto = :foto WHERE email = '$email'");
        $stmt->bindParam(":foto",  $nuevaFoto);
        $stmt->execute();

    }

}
?>