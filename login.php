<?php 
require_once('helpers.php');
require_once('_head.php'); 

?>
<title>Log-in | Objective Food</title>
  </head>
<?php
//convoca al header
require_once('_header.php');
//si hay sesion iniciada, e intentar acceder a la pagina de login, este redirecciona al perfil del usuario
if ($session->status()) { 
  header('location: userProfile.php');
    exit();
}
if ($_POST) {

  $buscaEmail =  $db->searchUser($_POST['email']);
  $buscaPassword = $db->searchPassword($_POST['password'], $buscaEmail);
  $errores = Validation::validationLogin($buscaEmail,$buscaPassword);
  //se envian los datos recibidos por POST a la funcion encargada de validar los datos
  

// si no hay errores, se guarda el usuario en un array
  if (!$errores) 
  {

      $usuarioLogin = $db->traerUsuario($_POST['email']);

            
      //funcion que se encarga de iniciar sesion y de mantenerla abierta si el usuario tildo la opcion de recordar, para ello, se le pasa el array que devuelve la funcion loginUser
      $session->rememberSession($usuarioLogin);
      
      //por ultimo, la pagina del login, redirecciona al perfil
      header('Location: userProfile.php'); 
      exit();
      
  }
      
}
?>
<main class="login-back">
  <section class="back-blur">
        <article class="login container">
            <h3>Ingresar</h3>
            <!-- <p>Continuar con:</p>
            <div class="login-extern">

              <a href=""><img src="img/fb-icon.png" alt="Facebook"></a>

              <a href=""><img src="img/go-icon.png" alt="Google"></a>

            </div> -->

            <form class="" action="" method="post">
                <label for="account">Cuenta:</label>
                <input class="form-input form-row" type="text" id="account"  name="email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
                  <?php if (isset($errores["email"])) { ?><span class="error-container">
                      <i class="fas fa-exclamation-circle"></i>
                      <?php echo $errores["email"]; ?>
                    </span>
                  <?php } ?>
                <label for="password">Contraseña:</label>
                <a href="recover.php">Olvidé mi Contraseña</a>
                <input class="form-input form-row" type="password" name="password" >
                  <?php if (isset($errores["password"])) { ?><span class="error-container">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errores["password"]; ?>
                </span>
                <?php } ?>
                <input type="checkbox" name="remember" <?= (isset($_POST['remember'])) ? 'checked' : ""; ?> > 
                <label for="remember">Recordarme</label>
                <button class="form-row form-button" type="submit" id="send-login" name="submit">Ingresar</button>
            </form>
        </article>
        <!-- fin article class="login container"  -->
  </section>

</main>

<?php
//convoca al footer
require_once('_footer.php');

?>
