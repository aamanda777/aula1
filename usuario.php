<?php

require('verifica_login.php');
require('twig_carregar.php');
require('pdo.inc.php');

$sql = $pdo->query('SELECT * FROM usuario');
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('usuarios.html' , [
    'usuario' => $usuarios,
]);

?>

