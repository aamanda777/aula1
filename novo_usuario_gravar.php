<?php

require('pdo.inc.php');

$user = $_POST['user'] ?? false;
$pass = $_POST['pass'] ?? false;
$nome = $_POST['nome'] ?? false;
$email = $_POST['email'] ?? false;
$admin = isset($_POST ['admin']);

if (!$user || !$pass || !$nome || !$email) {
    header('location:novo_usuario.php');
    die;
}

$pass = password_hash($pass , PASSWORD_BCRYPT);

$sql = $pdo->prepare('INSERT INTO usuario(username , senha , nome , email , admin) values (:user , :pass , :nome , :email , :admin)');

$sql->bindParam(':user' , $user);
$sql->bindParam(':pass' , $pass);
$sql->bindParam(':nome' , $nome);
$sql->bindParam(':email' , $email);
$sql->bindParam(':admin' , $admin);

$sql->execute();