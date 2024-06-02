<?php
require_once 'classes/Professores.php';
$p = new Professores();



if (isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $curso = addslashes($_POST['curso']);
    $matricula = addslashes($_POST['matricula']);
    $data_nascimento = addslashes($_POST['data_nascimento']);
    $sexo = addslashes($_POST['sexo']);

    if (!empty($nome) && !empty($email) && !empty($curso) && !empty($matricula) && !empty($data_nascimento) && !empty($sexo)) {
        $p->conectar("projeto_login", "localhost", "root", "");
        if ($p->msgERRO == "") {
            if ($p->cadastrar($nome, $email, $curso, $matricula, $data_nascimento, $sexo)) {
                $mensagem = 'Professor Cadastrado com Sucesso!';
                echo "<script>
                        alert('$mensagem');
                        window.location.href = 'listar_professores.php';
                      </script>";
                exit();

            } else {
                $mensagem = 'Erro ao cadastrar professor.';
            }
        } else {
            $mensagem = "Erro: " . $p->msgERRO;
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
    <title>Cadastro de Professores</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Cadastro de Professores</h1>
        <?php if (!empty($mensagem)): ?>
            <script>
                alert('<?php echo $mensagem; ?>');
            </script>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="50"/>
            <input type="email" name="email" placeholder="Email" maxlength="50"/>
            <input type="text" name="curso" placeholder="Curso" maxlength="50"/>
            <input type="text" name="matricula" placeholder="Matrícula" maxlength="20"/>
            <input type="date" name="data_nascimento" placeholder="Data de Nascimento"/>
            <input type="text" name="sexo" placeholder="Sexo (M/F)" maxlength="1"/>
            <input type="submit" value="Cadastrar"/>
        </form>
    </div>
</body>
</html>
