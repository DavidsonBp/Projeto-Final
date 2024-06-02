<?php
require_once 'classes/Alunos.php';
$a = new Alunos();



if (isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $matricula = addslashes($_POST['matricula']);
    $curso = addslashes($_POST['curso']);
    $periodo = addslashes($_POST['periodo']);
    $email = addslashes($_POST['email']);
    $data_nascimento = addslashes($_POST['data_nascimento']);
    $sexo = addslashes($_POST['sexo']);

    if (!empty($nome) && !empty($matricula) && !empty($curso) && !empty($periodo) && !empty($email) && !empty($data_nascimento) && !empty($sexo)) {
        $a->conectar("projeto_login", "localhost", "root", "");
        if ($a->msgERRO == "") {
            if ($a->cadastrar($nome, $matricula, $curso, $periodo, $email, $data_nascimento, $sexo)) {
                $mensagem = 'Aluno Cadastrado com Sucesso!';
                echo "<script>
                        alert('$mensagem');
                        window.location.href = 'listar_alunos.php';
                      </script>";
                exit();
            } else {
                $mensagem = 'Erro ao cadastrar aluno.';
            }
        } else {
            $mensagem = "Erro: " . $a->msgERRO;
        }
    } else {
        $mensagem = 'Preencha Todos os Campos!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastro de Alunos</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Cadastro de Alunos</h1>
        <?php if (isset($mensagem) && $mensagem !== 'Aluno Cadastrado com Sucesso!'): ?>
            <script>
                alert('<?php echo $mensagem; ?>');
            </script>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="50"/>
            <input type="text" name="matricula" placeholder="Matrícula" maxlength="20"/>
            <input type="text" name="curso" placeholder="Curso" maxlength="50"/>
            <input type="text" name="periodo" placeholder="Período" maxlength="20"/>
            <input type="email" name="email" placeholder="Email" maxlength="50"/>
            <input type="date" name="data_nascimento" placeholder="Data de Nascimento"/>
            <input type="text" name="sexo" placeholder="Sexo (M/F)" maxlength="1"/>
            <input type="submit" value="Cadastrar"/>
        </form>
    </div>
</body>
</html>
