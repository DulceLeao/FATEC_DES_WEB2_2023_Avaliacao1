<?php

#include 'errors.php';

session_start();

// para destruir a sessão e voltar para o login
session_destroy();
header('Location: index.php');
exit;
?>
