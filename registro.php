<?php  require_once('helpers.php'); ?>
<?php require_once('_head.php'); ?>

<title>Registro | Objective Food</title>
  </head>
<?php 

//si hay sesion iniciada, e intentar acceder a la pagina de registro, este redirecciona al perfil del usuario
if ($session->status()) { 
        header('location: userProfile.php');
          exit();
}

      if ($_POST) {
        //+ Si recibo datos por $_POST, primero checkeo si con el dato ingresado por  
        //+ email existe un usuario viejo y lo guardo en la variable $usuarioViejo. 
        //+ Si no se encuentra un mail igual, el usuario no existe ($usuarioViejo===null).
        //+ Si no existe, creo un usuario nuevo con los datos que recibo por POST, la variable
        //+ $usuarioNuevo va a guardar el array asociativo proveniente de la funcion crearUsuario.
    
        $errores=Validation::validarErrores();
        $usuarioViejo=$db->traerUsuario($_POST['email']);

        if ($usuarioViejo===null) {
                
        //+ Una vez creado el usuario nuevo, verifico si no hay errores y si checkeo el terminos y condiciones.
                if (count($errores)===0 && isset($_POST['tyc'])) {
                $usuarioNuevo = new Usuario($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['password']);
     
        
        //+ si no existen errores, hasheo la contraseña y la guardo.
                         $hashedPassword=password_hash($_POST['password'], PASSWORD_DEFAULT);
                         $usuarioNuevo->setContrasenia($hashedPassword);
        //+ se procede a guardar los datos del usuario en el archivo JSON para luego crear una                  
        //+ sesion con su usuario y redirigirlo a la página del usuario.
        // var_dump($usuarioNuevo);
        //  exit;
        $db->guardarUsuario($usuarioNuevo);
                        $_SESSION['usuario']=$usuarioNuevo;
                        redirect();
                }
        }else {
                //+ si el usuario existe, se crea un error.
                $errores['usuarioExiste']='Este email ya pertenece a una cuenta registrada!';
        }
    }


?>

<?php require_once('_header.php'); ?>
<main class="signin-back">
        <section class="back-blur">
                <article class="signin container">
                <h3>Crea una cuenta</h3>
                <!-- <p>Registrarme con:</p>
                <div class="login-extern">
                  <a href=""><img src="img/fb-icon.png" alt="Facebook"></a>
                  <a href=""><img src="img/go-icon.png" alt="Google"></a>
                </div> -->
                        <form class="signin-form" action="" method="post">
                                <div class="signin-group-form">
                                        <label for="firts-name">Nombre</label>
                                                <input class="form-input" type="text" id="firts-name" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>" name="nombre">
                                 <!--En esta parte hay php embebido, si existe el error del input, aparece un span conteniendo el error respectivo.  -->
                                                <?php if (isset($errores['emptyName'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['emptyName']; ?></span>
                                                <?php endif ?>
                                </div>
                                <div class="signin-group-form">
                                        <label for="last-name">Apellido</label>
                                                <input class="form-input" type="text" id="last-name" value="<?php if(isset($_POST['apellido'])) echo $_POST['apellido']; ?>" name="apellido">
                                 <!--En esta parte hay php embebido, si existe el error del input, aparece un span conteniendo el error respectivo.  -->
                                                <?php if (isset($errores['emptyLastName'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['emptyLastName']; ?></span>
                                                <?php endif ?>
                                </div>
                                <div class="signin-group-form">
                                        <label for="email">Email</label>
                                        <input class="form-input" type="text" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email">
                                 <!--En esta parte hay php embebido, si existe el error del input, aparece un span conteniendo el error respectivo.  -->
                                        <?php if (isset($errores['emptyEmail'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['emptyEmail']; ?></span>
                                                <?php endif ?>
                                                <?php if (isset($errores['invalidEmail'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['invalidEmail']; ?></span>
                                                <?php endif ?>
                                                <?php if (isset($errores['usuarioExiste'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['usuarioExiste']; ?></span>
                                                <?php endif ?>
                                </div>
                                <div class="signin-group-form">
                                        <label for="password">Contraseña</label>
                                                <input class="form-input" type="password" id="password" value="" name="password">
                                 <!--En esta parte hay php embebido, si existe el error del input, aparece un span conteniendo el error respectivo.  -->
                                                <?php if (isset($errores['emptyPassword'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['emptyPassword']; ?></span>
                                                <?php endif ?>
                                                <?php if (isset($errores['passwordLength'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['passwordLength']; ?></span>
                                                <?php endif ?>
                                                <?php if (isset($errores['passwordlower'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['passwordlower']; ?></span>
                                                <?php endif ?>
                                </div>
                                <div class="politics">
                                        <div class="tyc">
                                                <input type="checkbox" id="politics" name="tyc" value="" <?= (isset($_POST['tyc'])) ? 'checked' : ""; ?> >
                                                <label for="politics">Estoy de acuerdo con los <a href="">términos y condiciones.</a></label>
                                        </div>
                                  <!--En esta parte hay php embebido, si existe el error del input, aparece un span conteniendo el error respectivo.  -->   
                                                <?php if (isset($errores['emptyTyc'])):?>
                                                <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['emptyTyc']; ?></span>
                                                <?php endif ?>
                                </div>
                                <button class="form-row form-button" type="submit" name="send-signin">Crear cuenta</button>
                        </form>
                </article>
                <!-- fin <article class="signin container"> -->
        </section>
</main>
<!-- fin class="main-registro" -->

<?php
//convoca al footer
require_once('_footer.php');
