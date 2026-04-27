<?php
session_start(); //Comando para poder inciar la sesión en php e inicializar $_SESSION

//Nos devuelve a la pagina de inicio si el usuario no se ha logeado
function requireLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}
//Esta funcion nos redirige a la pagina de incio si el usuario no es un admin
function requireAdmin() {
    requireLogin();
    if ($_SESSION['rol'] !== 'admin') {
       
        header('Location: index.php?error=sin_permiso');
        exit;
    }
}

//Esta funcion nos devuleve true o false si el usuario es admin o no
function isAdmin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
}

//Esta funcion nos devuelve true o false si el usuario se ha logeado o no
function isLoggedIn() {
    return isset($_SESSION['usuario_id']);
}