<?php

require('verifica_login.php');
require('twig_carregar.php');

require('models/Model.php');
require('models/Usuario.php');

$id = $_GET['id'] ?? false;

$usr = new Usuario();
$usuarios = $usr->getAll(['ativo' => 1]);

echo $twig->render('usuarios.html', [
    'usuario' => $usuarios,
]);

?>