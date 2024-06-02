<?php
require_once 'classes/Professores.php';
$p = new Professores();

$p->conectar("projeto_login", "localhost", "root", "");

if (isset($_GET['id'])) {
    $id_professor = $_GET['id'];

    $professor = $p->buscarProfessorPorId($id_professor);

    if ($professor) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $curso = $_POST['curso'];
            $matricula = $_POST['matricula'];
            $data_nascimento = $_POST['data_nascimento'];
            $sexo = $_POST['sexo'];

            $p->atualizarProfessor($id_professor, $nome, $email, $curso, $matricula, $data_nascimento, $sexo);

            header("Location: listar_professores.php?edit_success=true");
            exit();
        }
    } else {
        echo "Professor não encontrado.";
        exit();
    }
} else {
    echo "ID do professor não especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar Professor</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <div class="container">
        <h1>Editar Professor</h1>
        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $professor['nome']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $professor['email']; ?>" required>
            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" value="<?php echo $professor['curso']; ?>" required>
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" value="<?php echo $professor['matricula']; ?>" required>
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $professor['data_nascimento']; ?>" required>
            <label for="sexo">Sexo:</label>
            <input type="text" id="sexo" name="sexo" value="<?php echo $professor['sexo']; ?>" required>
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>
