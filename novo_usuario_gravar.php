<?php

require('models/Model.php');
require('models/Usuario.php');

$user = $_POST['user'] ?? false;
$pass = $_POST['pass'] ?? false;
$nome = $_POST['nome'] ?? false;
$email = $_POST['email'] ?? false;
$admin = isset($_POST['admin']);

if (!$user || !$pass || !$nome || !$email) {
    header('location:novo_usuario.php');
    die;
}

$pass = password_hash($pass, PASSWORD_BCRYPT);

$usr = new Usuario();
$usr->create([
    'username' => $user,
    'senha' => $pass,
    'nome' => $nome,
    'email' => $email,
    'admin' => $admin,
    'ativo' => 1,
]);

header('location:usuario.php');