<?php
session_start();

if(!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}

if(isset($_SESSION['nome_usuario'])) {
    $nomeUsuario = $_SESSION['nome_usuario'];
} else {
    
    $nomeUsuario = "Usuário";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Menu</title>
    <link rel="stylesheet" href="style/menu.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>
<body>

<header>
    <h1 style="text-align: center; margin: 0; padding: 20px;">Menu de Cadastro de Alunos e Professores</h1>
</header>

<div id="cortes">
    <h1>Bem-Vindo(a), <?php echo $nomeUsuario; ?></h1>
    <h3>
        <a href="listar_usuarios.php" class="botao-link">Lista de usuários</a>
        <a href="listar_alunos.php" class="botao-link">Lista de alunos</a><br>
        <a href="listar_professores.php" class="botao-link">Lista de professores</a>
        <br>
    </h3>
</div>

<div>
    <h2><a href="sair.php">Sair</a></h2>
</div>

</body>
</html>
