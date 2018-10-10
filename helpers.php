<?php 
require_once('autoloader.php');


$session = new Session();
$db = new Json('usuarios.json');

function redirect(){
    header('location: userProfile.php');
    exit();
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