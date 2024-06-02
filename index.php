<?php
require_once 'classes/Usuarios.php';
$usuario = new Usuarios();

if (isset($_POST['email'])) {

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if (!empty($email) && !empty($senha)) {

        $usuario->conectar("projeto_login", "localhost", "root", "");

        if ($usuario->msgERRO == "") {

            if ($usuario->logar($email, $senha)) {

                session_start();
                $_SESSION['nome_usuario'] = $usuario->buscarUsuarioPorEmail($email)['nome'];
                
                header("location: Menu.php");
                exit();
            } else {
                $mensagemErro = 'E-mail e/ou Senha Incorretos!';
            }

        } else {
            $mensagemErro = "Erro: " . $usuario->msgERRO;
        }

    } else {
        $mensagemErro = 'Preencha Todos os Campos!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>

<body>

<div id="corpo-form">
    <h1>Sistema de Login</h1>
    <?php if (isset($mensagemErro)): ?>
        <script>
            alert('<?php echo $mensagemErro; ?>');
        </script>
    <?php endif; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email de usuário"/>
        <input type="password" name="senha" placeholder="Senha"/>
        <input type="submit" value="ACESSAR" name=""/>
        <a href="cadastrar.php">Ainda não é cadastrado? <strong>Cadastre-se aqui!</strong></a>
    </form>
    <div>
</body>
</html>
