<?php

#include 'errors.php';

session_start();

// Verifica se o usuário já está logado, se sim, redireciona para o painel
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'portaria') {
    header('Location: dashboard.php');
    exit;
}

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o usuário e a senha estão corretos
    if ($usuario === 'portaria' && $senha === 'FatecAraras') {
        // Autenticação bem-sucedida, inicia a sessão
        $_SESSION['usuario'] = $usuario;
        header('Location: dashboard.php'); 
        exit;
    } else {
        $mensagem = 'Usuário ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Estacionamento FATEC</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{font: 16px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1><strong>Controle do Estacionamento da FATEC Araras</strong></h1>
    <br>
    <h3>Por favor, forneça usuário e senha.</h3>
    <?php
    if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'portaria') {
        // exibe o botão de sair se o usuário estiver logado
        echo '<a href="logout.php">Sair</a>';
    }
    ?>
    <p><?php echo $mensagem; ?></p>
    <form method="POST"> <!--POST, para não apresentar dados sigilosos na URL -->
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>


