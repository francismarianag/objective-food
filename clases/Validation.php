<?php 

abstract class Validation

{
    
    public static function validationLogin($buscaEmail, $buscaPassword){
        $error = [];
        if (isset($_POST['email'])) {               
            $email = ($_POST['email']);
            if (empty($email)) {            
                $error['email'] = self::loginError('email');
            }
            elseif ($buscaEmail !== $email){                 
                
                $error['email'] = self::loginError('email-invalidates');
            }

        }

        if (isset($_POST['password'])) {               
            $password = ($_POST['password']);

            if (empty($password)) {            
            $error['password'] = self::loginError('password');
            }
                
            elseif ($buscaPassword === false){                 
                $error['password'] = self::loginError('password-invalidates');
            }
            

        }
    

        return $error;
        
    }

    public static function loginError($dato){

        switch ($dato) {
            
            case 'email':
                $error = "Debes ingresar tu email para poder iniciar sesión";
                return $error;
                break;
            case 'email-invalidates':
                $error = "La dirección de E-mail ingresada no es válida!";
                return $error;
                break; 
            case 'password':
                $error = "Debes ingresar tu contraseña para poder iniciar sesión";
                return $error;
                break;
            case 'password-invalidates':
                $error = "La contraseña ingresada no es válida!";
                return $error;
                break;
        }

    }
    //si hay errores, retorna un array de errores
    public static function validarErrores(){
        $errores=[];
        
        if (isset($_POST['nombre'])) {
            if ($_POST['nombre']==="") {
                $errores['emptyName']='Debes ingresar tu nombre para poder registrarte!';
            }
        }
        
        if (isset($_POST['apellido'])) {
            if ($_POST['apellido']==="") {
                $errores['emptyLastName']='Debes ingresar tu apellido para poder registrarte!';
            }
        }
        
        if (isset($_POST['email'])) {
            if ($_POST['email']==="") {
                $errores['emptyEmail']='Debes ingresar una direccion de E-mail para poder registrarte!';
            }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errores['invalidEmail']='La dirección de E-mail ingresada no es válida!';
            }
        }
        
        if (isset($_POST['password'])) {
            if ($_POST['password']==="") {
                $errores['emptyPassword']='Debes ingresar una contraseña para poder registrarte!';
            }elseif (strlen($_POST['password'])<8) {
                $errores['passwordLength']='La contraseña debe tener un minimo de 8 caracteres!';
            }elseif ($_POST['password'] === strtolower($_POST['password'])) {// si son iguales es porque no hay mayuscula y muestra error
                $errores['passwordlower']='La contraseña debe tener una letra mayuscula!';
                
            }
        }
        
        if (!isset($_POST['tyc'])) {
            $errores['emptyTyc']='Debes aceptar los términos y condiciones para poder registrarte!';
        }
        
        return $errores; 
    }

    public static function recoverError($dato){

        switch ($dato) {
            
            case 'email':
                $error = "Debes ingresar tu email para poder reestablecer contraseña";
                return $error;
                break;
            case 'email-invalidates':
                $error = "La dirección de E-mail ingresada no es válida!";
                return $error;
                break; 
            //para el futuro  
            // case 'password':
            //     $error = "Debes ingresar una contraseña";
            //     return $error;
            //     break;
            // case 'passwordLength':
            //     $error = "La contraseña debe tener un minimo de 8 caracteres!";
            //     return $error;
            //     break;
            // case 'passwordlower':
            //     $error = "La contraseña debe tener una letra mayuscula!";
            //     return $error;
            //     break;
        }
    
    }
    
    public static function validarRecover($buscaEmail){
        $error = [];
            
            if (isset($_POST['email'])) {               
                $email = ($_POST['email']);
                if (empty($email)) {            
                    $error['email'] = self::recoverError('email');
                }
                elseif ($buscaEmail !== $email){                 
                    
                    $error['email'] = self::recoverError('email-invalidates');
                }
        
            }
        
            // if (isset($_POST['password'])) {               
            //     $password = ($_POST['password']);
        
            //     if (empty($password)) {            
            //        $error['password'] = self::recoverError('password');
            //     } elseif (strlen($_POST['password'])<8) {
            //         $error['password'] = self::recoverError('passwordLength');
            //     } elseif ($_POST['password'] === strtolower($_POST['password'])) {// si son iguales es porque no hay mayuscula y muestra error
            //         $error['password'] = self::recoverError('passwordlower');
                
            //     }
        
            // }
           
        
            return $error;
            
        }
    
    
    
}
    ?>