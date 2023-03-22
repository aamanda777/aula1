<?php

require('twig_carregar.php');
require('pdo.inc.php');
require('mailer.inc.php');

$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'] ?? false;

    $sql = $pdo->prepare('SELECT * FROM usuario WHERE username = ?');
    $sql->execute([$username]);

    // se encontrou usuario

   if ($sql->rowCount()){
       // recuperar senha

       $usuario = $sql->fetch(PDO::FETCH_ASSOC);

       $token = uniqid(null , true) . bin2hex(random_bytes(16));

       $sql = $pdo->prepare('UPDATE usuario SET recupera_token = :token WHERE id = :id_usr');

       $sql->execute([
           'token' => $token,
           ':id_usr' => $usuario['id'],

       ]);

       $msg = 'vai lá olhar teu e-mail 😊';

       echo $twig->render('email_recupera_senha.html' , [
           'token' => $token
       ]);
       die;

   } else {
       $msg = 'Usuário não encontrado 😱😱';
   }
}

echo $twig->render('recuperar_senha.html' , [
    'msg' => $msg,
]);