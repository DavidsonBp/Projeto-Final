<?php
require_once 'classes/Alunos.php';
$a = new Alunos();

$a->conectar("projeto_login", "localhost", "root", "");

if (isset($_GET['id'])) {
    $id_aluno = $_GET['id'];

    $aluno = $a->buscarAlunoPorId($id_aluno);

    if ($aluno) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $matricula = $_POST['matricula'];
            $curso = $_POST['curso'];
            $periodo = $_POST['periodo'];
            $email = $_POST['email'];
            $data_nascimento = $_POST['data_nascimento'];
            $sexo = $_POST['sexo'];

            $a->atualizarAluno($id_aluno, $nome, $matricula, $curso, $periodo, $email, $data_nascimento, $sexo);

            header("Location: listar_alunos.php?edit_success=true");
            exit();
        }
    } else {
        echo "Aluno não encontrado.";
        exit();
    }
} else {
    echo "ID do aluno não especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <div class="container">
        <h1>Editar Aluno</h1>
        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $aluno['nome']; ?>" required>
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" value="<?php echo $aluno['matricula']; ?>" required>
            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" value="<?php echo $aluno['curso']; ?>" required>
            <label for="periodo">Período:</label>
            <input type="text" id="periodo" name="periodo" value="<?php echo $aluno['periodo']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $aluno['email']; ?>" required>
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $aluno['data_nascimento']; ?>" required>
            <label for="sexo">Sexo:</label>
            <input type="text" id="sexo" name="sexo" value="<?php echo $aluno['sexo']; ?>" required>
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>
