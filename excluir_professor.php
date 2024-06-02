<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de professor inválido.";
    exit;
}


require_once 'classes/Professores.php';
$p = new Professores();
$p->conectar("projeto_login", "localhost", "root", "");


$professor = $p->buscarProfessorPorId($_GET['id']);
if (!$professor) {
    echo "Professor não encontrado.";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar']) && $_POST['confirmar'] == "Sim") {

    $p->excluirProfessor($_GET['id']);

    header("Location: listar_professores.php?delete_success=true");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Professor</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>
<body>
    <div class="container">
        <h1>Excluir Professor</h1>
        <div class="table-container"></div>
        <p>Você tem certeza que deseja excluir o professor(a) <?php echo $professor['nome']; ?>?</p>
        <form method="POST" action="">
            <input type="submit" name="confirmar" value="Sim">
            <a class="input" href="listar_professores.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
