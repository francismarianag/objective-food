<?php 
require_once('autoloader.php');


$session = new Session();
/* Trabaja con el JSON como base de datos */
 $db = new Json('usuarios.json');

/* Trabaja con MySql como base de datos */
//se invoca el metodo estatico para realizar la conexion
// $conexion = ConexionDB::conexion();
// $db = new Mysql($conexion);

//redirecciona de la pagina actual a la pagina pasada como parametro
function redirect($pagina){
    header("location: $pagina");
    exit();
}
//ayuda a debuguear
function dd(...$param)
{
    echo "<pre>";
    die(var_dump($param));
}

function old($name){
        echo $_POST[$name];
}

// Nos devuelve true en caso de que estemos logueados, false en caso de que no lo estemos.
// function check()
// {
//     return isset($_SESSION['usuario']);
// }

// Nos devuelve false en caso de que estemos logueados, true en caso de que no lo estemos.
// function guest()
// {
//     return !check();
// }

// Nos devuelve el usuario en el caso de que estemos logueados, false si no.
function user()
{
    if (isset($_SESSION['usuario'])) {
        return $_SESSION['usuario'];
    } else {
        return false;
    }
}

?>