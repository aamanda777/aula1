<?php
$user = $_POST['user'];
$pass = $_POST['pass'];

if ($user == 'amanda' && $pass == '123') {
    // login com sucesso
    header ('location: boasvindas.php');
    die;
} else {
    // falha no login
    header ('location: login.php?erro=1');
    die;
}
?>