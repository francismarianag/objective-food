<?php 
class Json extends DataBase 
{
    
    public $archivo;
    
    public function __construct($archivo){
        $this->archivo=$archivo;
    }
    //retorna el email si el usuario existe en la base de datos
    public function traerUsuario($email){
        $usuarios = $this->traerUsuarios();

        foreach ($usuarios->usuarios as $usuario) {
            $emailJson = $usuario->email;
            

            if ( $emailJson == $email) {
                return $email;
            } 
        }
        return NULL;
    
    }

    //devuelve un objeto Usuario con los datos guardados
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
                            if ($key == 'password' && $value != $usuario->password) {
                                $usuario->password = password_hash($value, PASSWORD_DEFAULT);
                            } elseif ($key != 'submit')  {
                                $usuario->$key = $value;
                            }                            
                        }
                        
                    }
                    //ejecutar el break para que salga del bucle, de lo contrario, el $usuarioActualizado sera igual al ultimo usuario ingresado
                    break;
                }
            
                $json = json_encode($usuarios);
                
                file_put_contents($this->archivo, $json);
                $usuarioActualizado = new Usuario($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->password);

                return $usuarioActualizado;
                
            }

            public function eliminarUsuario($email){  
                $usuarios = $this->traerUsuarios();
                
                foreach ($usuarios->usuarios as $usuario) {
                    $emailJson = $usuario->email;
                    if ($emailJson == $email) {
                        foreach ($_POST as $key => $value) {
                            //if ($key == 'password' && $value != "") {
                            //     // $usuario->password = password_hash($value, PASSWORD_DEFAULT);
                            //     $usuario->password  = $value;
                            // } elseif ($key != 'submit') {
                            if ($key != 'eliminar') {
                                $usuario->$key = $value;
                             }
                        }
                        
                        break;
                    }
                }
            
                $json = json_encode($usuarios);
                
                var_dump($json);
                exit;
                
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