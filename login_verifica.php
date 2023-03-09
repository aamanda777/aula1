<?php

require('pdo.inc.php');

$user = $_POST['user'];
$pass = $_POST['pass'];

// cria a consulta e aguarda os dados
$sql = $pdo->prepare('SELECT * FROM usuario WHERE username =:usr AND senha = :pass');


// adiciona os dados na consulta
$sql->bindParam(':usr', $user);
$sql->bindParam(':pass', $pass);

// roda a consulta
$sql->execute();
 
// se encontrou o usuário
if ($sql->rowCount()) {
    // login com sucesso

    $user = $sql->fetch(PDO::FETCH_OBJ);
    var_dump($user);

    session_start();
    $_SESSION['user'] = $user->nome;

    header ('location: boasvindas.php');
    die;
} else {
    // falha no login
    header ('location: login.php?erro=1');
    die;
}
?>