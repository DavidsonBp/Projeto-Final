<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de usuário inválido.";
    exit;
}


require_once 'classes/Usuarios.php';
$u = new Usuarios();
$u->conectar("projeto_login", "localhost", "root", "");


$user = $u->buscarUsuarioPorId($_GET['id']);
if (!$user) {
    echo "Usuário não encontrado.";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar']) && $_POST['confirmar'] == "Sim") {

    $u->excluirUsuario($_GET['id']);

    header("Location: listar_usuarios.php?delete_success=true");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Usuário</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>
<body>
    <div class="container">
    
    <h1>Excluir Usuário</h1>
    <div class="table-container"></div>
    <p>Você tem certeza que deseja excluir o usuário <?php echo $user['nome']; ?>?</p>
    <form method="POST" action="">
        <input type="submit" name="confirmar" value="Sim">
        <a classe="input" href="listar_usuarios.php">Cancelar</a>
    </form>
    </div>
</body>
</html>
