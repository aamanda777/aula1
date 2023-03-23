<?php
require('twig_carregar.php');
require('pdo.inc.php');

$token = $_GET['token'] ?? $_POST['token'] ?? false;

if (!$token) {
    header('location:login.php');
    die;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password = $_POST['senha'] ?? false;
    //trim = tirar os espaços no início e fim do texto
    $password = trim($password);
    //tratamento para o caso de senha falsa
    //

    $sql = $pdo->prepare('UPDATE usuario SET senha = :senha , recupera_token = NULL WHERE recupera_token = :token');
    $sql->execute([
        ':senha' => password_hash($password, PASSWORD_BCRYPT),
        ':token' => $token,
    ]);

    header('location:login.php?erro=3');

    die;
}

$sql = $pdo->prepare('SELECT * FROM usuario WHERE recupera_token = ?');
$sql->execute([$token]);

if ($sql->rowCount() == 1) {
    echo $twig->render('recupera_senha_escolher.html' , ['token' => $token]);
}else {
    header('location:login.php');
    die;
}