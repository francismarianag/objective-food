<?php 
require_once('helpers.php'); 
require_once('_head.php'); 

?>

<title>Home | Objective Food</title>
  </head>
  <?php

// {"usuarios":{"nombre":"vane","apellido":"guzman","email":"vane@algo.com","password":"$2y$10$7AXLyNU.YTMD1URNxGFlp.XuaUW.BAq4pTdBqBtQjf1NXkizy9x7q","fotoPerfil":"img\/profile.svg"}}

// $archivo = 'usuarios.json';
// $contenido = file_get_contents($archivo); //lee el contenido del archivo y lo muestra en formato json
// $arrayUsuarios = json_decode($contenido, true); //decodifica y lo convierte en un array
// // print_r($arrayUsuarios->usuarios->nombre);
// // var_dump($contenido);
// //  var_dump($arrayUsuarios['usuarios']);

//  foreach ($arrayUsuarios['usuarios'] as $clave => $valor) {
//   if ($valor === 'francismarianag@gmail.com') {  
//       $arrayUsuarios['usuarios']['email'] = 'vane@algo.com';
//       $arrayUsuarios = json_encode($arrayUsuarios);
//       // $_SESSION["usuario"]["email"] = 'francismarianag@gmail.com';
//       //  var_dump($arrayUsuarios);
//             // return $email;
            
//           } 
//   }
//    file_put_contents($archivo, $arrayUsuarios);
      
?>
  <?php require_once('_header.php');?>
  <?php $session->mantenerSesion(); ?>
  <?php require_once('_main-home.php');?>
  <?php require_once('_footer.php');?>




  </body>
</html>
