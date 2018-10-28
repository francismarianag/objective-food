<?php 
require_once('helpers.php'); 
require_once('_head.php'); 

?>
<title>Log-in | Objective Food</title>
  </head>
<?php
//convoca al header
require_once('_header.php');

//si hay sesion iniciada, e intentar acceder al de reestablecer contraseña, este redirecciona al perfil del usuario
if ($session->status()) { 
  header('location: userProfile.php');
    exit();
}

if ($_POST) {
  $buscaEmail =  $db->traerUsuario($_POST['email']);
  $errores = Validation::validarRecover($buscaEmail); //se envian los datos recibidos por POST a la funcion encargada de validar los datos
  

// si no hay errores, se modifica el archivon Json con la funcion modificarJson
  if (!$errores) 
  {
      $recover = true;
      // $recoverPassword =password_hash($_POST['password'], PASSWORD_DEFAULT);
      // $email = $_POST['email'];
     
      //Esta funcion se encuetra en el archivo validatioRecoverControllers, la misma recibe como parametro el email y la nueva contraseña. El email para poder verificar el usuario donde se cambiara la contraseña.
      // $db->modificarJson($email, $recoverPassword);

      //se cierra la sesion si hay una abierta. Si closeSession no se ejecuta, se evidencian errores  en el menu del header.
      //  $session->closeSession();

  }
      
}
?>
<main class="login-back">
  <section class="back-blur">
        <article class="login container">
            <h3>Reestablecer contraseña</h3>

            <form class="" action="" method="post">
                <label for="account">Email:</label>
                <input class="form-input form-row" type="text" id="account"  name="email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
                  <?php if (isset($errores["email"])) { ?><span class="error-container">
                      <i class="fas fa-exclamation-circle"></i>
                      <?php echo $errores["email"]; ?>
                    </span>
                  <?php } elseif (isset($recover)) { ?>
                    <span class="error-container">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo "Hemos enviado un mail a $_POST[email] con
                    los datos para reestablecer el acceso a su cuenta"; ?>
                    </span>
                    <?php } ?>
              
                <button class="form-row form-button" type="submit" name="submit">Enviar</button>
            </form>
        </article>
        <!-- fin article class="login container"  -->
  </section>

</main>

<?php
//convoca al footer
require_once('_footer.php');

?>