<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de aluno inválido.";
    exit;
}

require_once 'classes/Alunos.php';
$a = new Alunos();
$a->conectar("projeto_login", "localhost", "root", "");

$aluno = $a->buscarAlunoPorId($_GET['id']);
if (!$aluno) {
    echo "Aluno não encontrado.";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar']) && $_POST['confirmar'] == "Sim") {

    $a->excluirAluno($_GET['id']);

    header("Location: listar_alunos.php?delete_success=true");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Aluno</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>
<body>
    <div class="container">
        <h1>Excluir Aluno</h1>
        <div class="table-container"></div>
        <p>Você tem certeza que deseja excluir o aluno(a) <?php echo $aluno['nome']; ?>?</p>
        <form method="POST" action="">
            <input type="submit" name="confirmar" value="Sim">
            <a class="input" href="listar_alunos.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
