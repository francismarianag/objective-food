<?php 
class Json extends DataBase 
{
    
    public $archivo;
    
    public function __construct($archivo){
        $this->archivo=$archivo;
    }
    //+ la funcion traer usuario recibe un parametro email que en realidad va a ser la variable 
    //+ $_POST['email]. Al recibir el email, primero declara al usuario como null( osea no existe).
    //+ luego, hace un fopen del archivo 'usuarios.txt' y lo recorre linea por linea decodificando
    //+ cada usuario. Si el email recibido por post concuerda con un email del archivo json quiere decir
    //+ que el usuario ya existía entonces deja de ser null. Cierra el archivo y retorna $usuario.
    public function traerUsuario($email){
        $usuario=null;
        
        $recurso = fopen($this->archivo, 'r');
        
        
        while (($linea = fgets($recurso))!==false) {
            $usuarioActual=json_decode($linea, true);
            
            if ($usuarioActual['email'] === $email) {
                $usuario=$usuarioActual;
                break;
            }
        } 
        fclose($recurso);
        if ($usuario !== null) {
            return new Usuario($usuario['nombre'], $usuario['apellido'], $usuario['email'], $usuario['password']);
        }
        return $usuario;
    }
    
    //+ la funcion guardarUsuario recibe como parametro un usuario, hace un json_encode de este y luego
    //+ lo guarda en el archivo usuarios.json.
    
    public function guardarUsuario($usuario){

        // var_dump($usuario);
        // exit;
        $user = [
            "nombre" => $usuario->getNombre(),
            "apellido" => $usuario->getApellido(),
            "email" => $usuario->getEmail(),
            "password" => $usuario->getContrasenia()
        ];
        $jsonUsuarioNuevo=json_encode($user);
        file_put_contents($this->archivo, $jsonUsuarioNuevo . PHP_EOL, FILE_APPEND);
    }
    
    //busca si el usuario existe y si es asi, devuelve true. Esta funcion es usada en el login para verificar si el email introducido existe 
    public function searchUser($email){
        
        $emailDecod = [];
        
        if (isset($archivo)) {
            $archivo = fopen($this->archivo, 'r');  //abre en modo lectura
        } else {
            $archivo = fopen($this->archivo, 'r');
        }    
        
        while (($linea = fgets($archivo)) !== false) {
            $emailDecod = json_decode($linea, true);     
            
            if ($emailDecod['email'] === $email) {  
                return $email;
                break;
            } 
            
            
        }
        fclose($archivo);
        
        
        
    }
    //Verifica contraseña en el archivo json. Esta funcion es usada en el login para verificar si el password introducido coincide con el guardado en el registro 
    public function searchPassword($password, $email){
        
        $passwordDecod = [];
        
        if (isset($archivo)) {
            $archivo = fopen($this->archivo, 'r');
        } else {
            $archivo = fopen($this->archivo, 'r');
        }  
        
        while (($linea = fgets($archivo)) !== false) {
            $passwordDecod = json_decode($linea, true);
            if ($passwordDecod['email']===$email) {
                
                if (password_verify($password, $passwordDecod['password'])) {  //devuelve true si la verificacion lo es
                    return true;
                    break;
                }  
            }               
            
        }
        fclose($archivo);
        
        return false;
        
    }
    
                      
            public function modificarJson($email,$recover){  
                $recurso=fopen($this->archivo, 'r');
                
                $usuarios=file_get_contents($this->archivo);
                $usuarios = explode(PHP_EOL, $usuarios);
                array_pop($usuarios);
                
                foreach ($usuarios as $llave => $valor) {
                    $usuarioJson=json_decode($valor, true);
                    if ($usuarioJson['email']===$email) {
                        
                        $nuevoPassword = $recover;
                        $usuarioJson["password"] = $nuevoPassword;
                        $usuarios[$llave] = json_encode($usuarioJson);
                        $_SESSION["usuario"]["password"] = $nuevoPassword;
                    }
                }
                file_put_contents($this->archivo, implode(PHP_EOL, $usuarios) . PHP_EOL);
                
                
            }

            public function modificarFotoUsuario($email){
                $recurso=fopen($this->archivo, 'r');
            
                $usuarios=file_get_contents($this->archivo);
                $usuarios = explode(PHP_EOL, $usuarios);
                array_pop($usuarios);
            
                foreach ($usuarios as $llave => $valor) {
                    $usuarioJson=json_decode($valor, true);
                    //var_dump($usuarioJson['email']);
                    if ($usuarioJson["email"]===$email) {
                        $nuevaFoto = 'img/' . $this->guardarFoto($_FILES["subirFotoPerfil"]);
                        $usuarioJson["fotoperfil"] = $nuevaFoto;
                        $usuarios[$llave] = json_encode($usuarioJson);
                        // $_SESSION["usuario"]["fotoperfil"] = $nuevaFoto;
                    }
                }

                file_put_contents($this->archivo, implode(PHP_EOL, $usuarios) . PHP_EOL);
                
            }
        }
            ?>