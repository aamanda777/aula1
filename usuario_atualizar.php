<?php

require('models/Model.php');
require('models/Usuario.php');


$id = $_POST['id'] ?? false;
$nome = $_POST['nome'] ?? false;
$email = $_POST['email'] ?? false;
$username = $_POST['username'] ?? false;

if(!$nome || !$email || !$username){
    //nao mostra erro na tela
    //o usuario que aprenda a preencher os campos
    die;
}

$usr = new Usuario();
$usr->update([
    'nome'=>$nome,
    'email'=>$email,
    'username'=>$username,

], $id);
header('location:usuario.php');
die;