<?php 
require_once('helpers.php'); 
require_once('_head.php'); 


?>
<?php

//si no hay sesion iniciada, e intentar acceder al perfil, este redirecciona al login
if (!$session->status()) { 
  header('location: login.php');
    exit();
}
//GUARDAR FOTO EN USER
if ($_FILES){
  // var_dump($_FILES);

  $filesErrores = $db->validarFotoPerfil($_SESSION['usuario']);
  $db->modificarFotoUsuario(user()->getEmail());
  
}

if (($_POST)) {
  $errores=Validation::validarErrores();
  $usuarioBD=$db->traerUsuario($_POST['email']);
  $usuarioActual = user()->getEmail();
  if (count($errores) == 1 ) {  //count va hacer siempre uno por el $errores['emptyTyc'], indicaria que solo ese error contiene.
    if ($usuarioBD == $usuarioActual || $usuarioBD== null) { 
      // var_dump($
      $usuarioActualizado = $db->modificarBD(user()->getEmail());
      session_destroy();
      session_start();  
      $_SESSION['usuario'] = $usuarioActualizado;
      
     }else {
       $errores['usuarioExiste']='Este email ya pertenece a una cuenta registrada!';
            
            
    }
  }

 
}
$usuario = $_SESSION['usuario']->getFotoPerfil();

 $usuario = $db->searchImg(user()->getEmail());
?>
<title>Perfil | Objective Food</title>
  </head>
<?php
//convoca al header
require_once('_header.php');
?>
<body>

    <section class="profile-content">
      <!-- <nav class="nav-perfil">
        <ul>
          <a href=""><li>Cuenta</li></a>
          <a href=""><li>Informes</li></a>
          <a href=""><li>Ventas</li></a>
          <a href=""><li>Configuración</li></a>
        </ul>
      </nav> -->
      
      
      <article class="foto-profile">
        <img src="<?= $usuario; ?>" alt="">
        <form class="file-form contact-form"action="" method="post" enctype="multipart/form-data">
        <label for="file">Foto de Perfil</label>
        <input type="file" name="subirFotoPerfil">
        <?= (isset($filesErrores)) ? $filesErrores['fotoPerfil'] : "" ?>
        <button type="submit">Subir</button>
      </form>
    </article>
    
    <article class="data-profile">
        <h3>Hola <?= user()->getNombre();?></h3>
          <form class="contact-form" method="post">
            <label for="nombre">Nombre:</label>
            <input  class="form-input" name ="nombre" type="text" value="<?= user()->getNombre();?>">
            <label for="apellido">Apellido:</label>
            <input  class="form-input" name="apellido" type="text" value="<?= user()->getApellido();?>">
            <label for="email">Email:</label>
            <input  class="form-input" name="email" type="email" value="<?= user()->getEmail();?>">
            <?php if (isset($errores['invalidEmail'])):?>
              <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['invalidEmail']; ?></span>
                                                
            <?php elseif (isset($errores['usuarioExiste'])):?>
              <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['usuarioExiste']; ?></span>
            <?php endif ?>
            <label for="email">Contraseña:</label>
            <input  class="form-input" name="password" type="password" value="<?= user()->getContrasenia();?>">
            
            <?php if (isset($errores['passwordLength'])):?>
              <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['passwordLength']; ?></span>
            <?php elseif (isset($errores['passwordlower'])):?>
              <span class="error-container"><i class="fas fa-exclamation-circle"></i><?php echo $errores['passwordlower']; ?></span>
            <?php endif ?>
            <button type ="submit" name="submit">Actualizar</button>

          </form>
        </article>

    </section>
</body>
<?php
require_once('_footer.php');