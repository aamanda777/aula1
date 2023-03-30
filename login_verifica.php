<?php

require 'pdo.inc.php';

$user = $_POST['user'];
$pass = $_POST['pass'];

// cria a consulta e aguarda os dados
$sql = $pdo->prepare('SELECT * FROM usuario WHERE username =:usr AND ativo=1');

// adiciona os dados na consulta
$sql->bindParam(':usr', $user);

// roda a consulta
$sql->execute();

// se encontrou o usuário
if ($sql->rowCount()) {
    // login com sucesso

    $user = $sql->fetch(PDO::FETCH_OBJ);

    // verifica se a senha está certa
    if (!password_verify($pass, $user->senha)) {
        header('location: login.php?erro=1');
        die;
    }

    session_start();
    $_SESSION['user'] = $user->nome;

    header('location: boasvindas.php');
    die;
} else {
    // falha no login
    header('location: login.php?erro=1');
    die;
}