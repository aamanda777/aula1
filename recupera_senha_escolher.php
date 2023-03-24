<?php
require 'twig_carregar.php';
require 'pdo.inc.php';

$token = $_GET['token'] ?? $_POST['token'] ?? false;

if (!$token) {
    header('location:login.php');
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['senha'] ?? false;
    $password_confi = $_POST['senha_confirma'] ?? false;
    //trim = tirar os espaços no início e fim do texto
    $password = trim($password);
    $password_confi = trim($password_confi);
    //tratamento para o caso de senha falsa
    //
    if ($password == $password_confi) {
        $sql = $pdo->prepare('UPDATE usuario SET senha = :senha , recupera_token = NULL WHERE recupera_token = :token');
        $sql->execute([
            ':senha' => password_hash($password, PASSWORD_BCRYPT),
            ':token' => $token,
        ]);
        header('location:login.php?erro=3');

        die;
    }

    $msg = 'conseguiu errar a senha, né? 😂';
}
$sql = $pdo->prepare('SELECT * FROM usuario WHERE recupera_token = ?');
$sql->execute([$token]);

if ($sql->rowCount() == 1) {
    echo $twig->render('recupera_senha_escolher.html', ['token' => $token , 'msg' => $msg ?? false]);
} else {
    header('location:login.php');
    die;
}