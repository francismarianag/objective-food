<?php 
class Json extends DataBase 
{
    
    public $archivo;
    
    public function __construct($archivo){
        $this->archivo=$archivo;
    }
    //+ la funcion traer usuario recibe un parametro email que en realidad va a ser la 
    //+ cada usuario. Si el email recibido por post concuerda con un email del archivo json quiere decir
    //+ que el usuario ya existía entonces deja de ser null y retorna el email
    public function traerUsuario($email){
        $usuarios = $this->traerUsuarios();

        foreach ($usuarios->usuarios as $usuario) {
            $emailJson = $usuario->email;
            

            if ( $emailJson == $email) {
                
                // return new Usuario($usuario['nombre'], $usuario['apellido'], $usuario['email'], $usuario['password'], $usuario['fotoPerfil']);    
                return $email;
            } 
        }
        return NULL;
    
    }

    //devuelve un objeto Usuario con los datos guarddos
    public function usuarioLogin($email){
        $usuarios = $this->traerUsuarios();

        foreach ($usuarios->usuarios as $usuario) {
            $emailJson = $usuario->email;
            

            if ( $emailJson == $email) {
                
                return new Usuario($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->password, $usuario->fotoPerfil);    
            } 
        }
    
    }
    
    //+ la funcion guardarUsuario recibe como parametro un usuario, hace un json_encode de este y luego
    //+ lo guarda en el archivo usuarios.json.

    public function guardarUsuario($usuario){

      
        $user = [
            "nombre" => $usuario->getNombre(),
            "apellido" => $usuario->getApellido(),
            "email" => $usuario->getEmail(),
            "password" => $usuario->getContrasenia(),
            "fotoPerfil" => $usuario->getFotoPerfil()
        ];

        $usuarios = $this->traerUsuarios(); 
        $usuarios->usuarios[]=$user;
        // var_dump($usuarios);
        // exit;
        // $usuarios = $this->traerUsuarios();
        // $usuarios['usuarios'][]=$user;
        $json = json_encode($usuarios);
        file_put_contents($this->archivo, $json);
    }
    
    //retorna todos los usuarios en el json
    public function traerUsuarios()
    {
        // $arrayUsuarios = [];
        
        // Leemos el archivo 
        $archivo = file_get_contents($this->archivo);
        $arrayUsuarios = json_decode($archivo); //devuelve un string de json
        
        return $arrayUsuarios;
    }

   
    //devuelve la imagen guardada en el json
    public function searchImg($email){


        $usuarios = $this->traerUsuarios();

        foreach ($usuarios->usuarios  as $usuario) {
            $emailJson = $usuario->email;
            if ($emailJson == $email) {
                return $usuario->fotoPerfil;
                         break;
            }
        }
    }
    //Verifica contraseña en el archivo json. Esta funcion es usada en el login para verificar si el password introducido coincide con el guardado en el registro 
    public function searchPassword($password, $email){

        $usuarios = $this->traerUsuarios();

        foreach ($usuarios->usuarios as $usuario) {
            $emailJson = $usuario->email;
            

            if ( $emailJson == $email) {
                if (password_verify($password, $usuario->password)) {  //devuelve true si la verificacion lo es
                    return true;
                    break;
                } else {
                    return false;
                    break;
                }
            } 
        }

        
    }
    
                      
            public function modificarBD($email){  
                $usuarios = $this->traerUsuarios();
                
                foreach ($usuarios->usuarios as $usuario) {
                    $emailJson = $usuario->email;
                    if ($emailJson == $email) {
                        foreach ($_POST as $key => $value) {
                            if ($key == 'password' && $value != "") {
                                $usuario->password = password_hash($value, PASSWORD_DEFAULT);
                            } elseif ($key != 'submit') {
                                $usuario->$key = $value;
                            }
                        }
                        
                        break;
                    }
                }
            
                $json = json_encode($usuarios);
                
                // var_dump($json);
                // exit;
                
                file_put_contents($this->archivo, $json);
                return new Usuario($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->password);
                
                
            }

            public function modificarFotoUsuario($email){

                $usuarios = $this->traerUsuarios();
                
                foreach ($usuarios->usuarios as $usuario) {
                    $emailJson = $usuario->email;
                    if ($emailJson == $email) {
                        $nuevaFoto = "img/".$this->guardarFoto($_FILES["subirFotoPerfil"]);
                                $usuario->fotoPerfil= $nuevaFoto;
                                // user()->setFotoPerfil($db->guardarFoto($_FILES['subirFotoPerfil']));
                                // $this->setFotoPerfil($nuevaFoto);
                    }
                }
                $json = json_encode($usuarios);
                // var_dump($json);
                // exit;
                file_put_contents($this->archivo, $json);
                
                
            }
        }
            ?>