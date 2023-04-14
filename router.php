<?php

$pagina = $_GET['pagina'] ?? false;

echo 'você chegou ao router 🥳🥳🥳🥳🥳🥳';

$include = filter_var("{$pagina}.php", FILTER_SANITIZE_STRING);

if (!file_exists($include)) {
    echo 'hacker!!';
    die;
}

require($include);