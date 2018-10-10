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
  $filesErrores = $db->validarFotoPerfil($_SESSION['usuario']);
  $db->modificarFotoUsuario(user()->getEmail());
}
$user = $db->traerUsuario($_SESSION['usuario']);


?>
<title>Perfil | Objective Food</title>
  </head>
<?php
//convoca al header
require_once('_header.php');
?>
<body>

    <section class="contact-container">
      <!-- <nav class="nav-perfil">
        <ul>
          <a href=""><li>Cuenta</li></a>
          <a href=""><li>Informes</li></a>
          <a href=""><li>Ventas</li></a>
          <a href=""><li>Configuración</li></a>
        </ul>
      </nav> -->
      <section class="file">
      <article>
          <h3>Hola <?= user()->getNombre();?></h3>
          <img src="<?= user()->getFotoPerfil()?>" alt="">
          <form class="file-form contact-form"action="" method="post" enctype="multipart/form-data">
            <label for="file">Foto de Perfil</label>
            <input type="file" name="subirFotoPerfil">
            <button type="subit">Subir</button>
          </form>
        </article>

        <article class="">
          <form class="contact-form" method="post">
            <label for="nombre">Nombre:</label>
            <input  class="form-input" name ="nombre" type="text" value="<?= user()->getNombre();?>">
            <label for="apellido">Apellido:</label>
            <input  class="form-input" name="apellido" type="text" value="<?= user()->getApellido();?>">
            <label for="email">Email:</label>
            <input  class="form-input" name="email" type="email" value="<?= user()->getEmail();?>">
            <!-- <button type ="submit" name="submit">Actualizar</button> -->
          </form>
        </article>



        <!-- <article>
          <h3>Hola <?= user()->getNombre();?></h3>
          <img src="<?= user()['fotoperfil']?>" alt="">
          <form class="file-form contact-form" action="" method="post" enctype="multipart/form-data">
              <label for="nombre">Nombre:</label>
            <input  class="form-input" name ="nombre" type="text" value="<?= user()->getNombre();?>">
            <label for="apellido">Apellido:</label>
            <input  class="form-input" name="apellido" type="text" value="<?= user()->getApellido();?>">
            <label for="email">Email:</label>
            <input  class="form-input" name="email" type="email" value="<?= user()->getEmail();?>">  
            <label for="file">Foto de Perfil</label>
            <input type="file" name="subirFotoPerfil">
            <button type="submit">Actualizar</button>
          </form>
        </article>

        <article class="">
          <form class="contact-form" method="post">
            <label for="nombre">Nombre:</label>
            <input  class="form-input" name ="nombre" type="text" value="<?= user()['nombre'];?>">
            <label for="apellido">Apellido:</label>
            <input  class="form-input" name="apellido" type="text" value="<?= user()['apellido'];?>">
            <label for="email">Email:</label>
            <input  class="form-input" name="email" type="email" value="<?= user()['email'];?>">
             <button type ="submit" name="submit">Actualizar</button> 
          </form>
        </article>

        -->
      </section>
    </section>
</body>
<?php
//convoca al footer
require_once('_footer.php');