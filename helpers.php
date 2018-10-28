<?php 
require_once('autoloader.php');


$session = new Session();
$db = new Json('usuarios.json');

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
function check()
{
    return isset($_SESSION['usuario']);
}

// Nos devuelve false en caso de que estemos logueados, true en caso de que no lo estemos.
function guest()
{
    return !check();
}

// Nos devuelve el usuario en el caso de que estemos logueados, false en el caso de que no.
function user()
{
    if (check()) {
        return $_SESSION['usuario'];
    } else {
        return false;
    }
}

?>