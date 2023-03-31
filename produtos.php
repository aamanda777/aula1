<?php
require 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./templates');

$twig = new \Twig\Environment($loader);

$template = $twig->load('produtos.html');

$produtos = [
    [
        'nome' => 'chinelo',
        'preço' => 30,
    ],
    [
        'nome' => 'camiseta',
        'preço' => 50,
    ],
    [
        'nome' => 'boné',
        'preço' => 39.90,
    ],
    [
        'nome' => 'automóvel',
        'preço' => 12000,
    ],
];

echo $template->render([
    'titulo' => 'produtos',
    'produtos' => $produtos,
]);