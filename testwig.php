<?php
require('vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader('./templates');

$twig = new \Twig\Environment($loader);

$template = $twig->load('teste.html');

echo $template->render([
    'nome' => 'amanda',
    'idade' => 17,
    'titulo' => 'vsf agusto'
]);

?>