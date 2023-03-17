<?php

require 'twig_carregar.php';

require 'pdo.inc.php';

// rotina de POST - apagar o usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //modifica o user para ativo
    $id = $_POST['id'] ?? false;
    if ($id){
        $sql = $pdo->prepare('UPDATE usuario SET ativo = 0 WHERE id = ?');
        $sql->execute([$id]);
    }
    header('location:usuario.php');
    die;
die;
}

// rotina de GET - mostrar informações na tela

$id = $_GET['id'] ?? false;
$sql = $pdo->prepare('SELECT * FROM usuario WHERE id = ?');

$sql->execute([$id]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

echo $twig->render('usuario_apagar.html', [
    'usuario' => $usuario,
]);
