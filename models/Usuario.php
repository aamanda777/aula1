<?php

class Usuario extends Model
{
public function __construct(){
    parent ::__construct();
    $this->table = 'usuario';
}
}
