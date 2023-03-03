<?php

session_start();
session_destroy();

header('loction:login.php');
die;