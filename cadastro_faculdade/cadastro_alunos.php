<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'portaria') {
    header('Location: index.php');
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $ra = $_POST['ra'];
    $placa = $_POST['placa'];

    // Grava os dados do aluno no arquivo
    $dados = "$nome|$ra|$placa\n";
    file_put_contents('aluno.txt', $dados, FILE_APPEND);
    
    //echo "O cadastro foi realizado com sucesso!";
//} else {
 //   echo "Erro ao abrir o arquivo.";
}

// Ler e exibir todos os cadastrados no arquivo.txt
$alunos = [];
if (file_exists('aluno.txt')) {
    $linhas = file('aluno.txt', FILE_IGNORE_NEW_LINES);
    foreach ($linhas as $linha) { 
        list($nome, $ra, $placa) = explode('|', $linha);
        $alunos[] = ['nome' => $nome, 'ra' => $ra, 'placa' => $placa];
    }
    // Ordena os alunos em ordem alfabética
    sort($alunos);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Estacionamento FATEC</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;}
    </style>
</head>
<body>
    <center>
    <div class="page-header">
        <h1><strong>Cadastro de Alunos</strong></h1>
        <hr>
            <a href="dashboard.php"><input type="submit" value="Voltar"></a>
          
            <a href="logout.php"><input type="submit" value="Sair"></a>
    </div>
    <?php echo '<br><br>';?>
    
    <form method="POST">
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="ra">Registro Acadêmico:</label>
        <input type="text" id="ra" name="ra" required><br><br>
        <label for="placa">Placa do Veículo:</label>
        <input type="text" id="placa" name="placa" required><br><br>
        <input type="submit" value="Cadastrar">
    </form>
    <br><br>
    </center>
    <center>
        <!-- Listando alunos cadastrados -->
    <hr>
    <h2><strong>Alunos Cadastrados:</strong></h2>
    </center>
    <br>
    <ul>
        <?php foreach ($alunos as $aluno) : ?>
            <li><?php echo $aluno['nome'] . ' | ' . $aluno['ra'] . ' | ' . $aluno['placa']; ?></li>
        <?php endforeach; ?>
    </ul> 
</body>
</html>
