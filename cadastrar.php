<?php
require_once 'classes/Usuarios.php';
$u = new Usuarios();

$mensagem = "";

if(isset($_POST['nome'])) {
    
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $conf_senha = addslashes($_POST['conf_senha']);

    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($conf_senha)) {
        
        $u->conectar("projeto_login", "localhost", "root", "");

        if($u->msgERRO == "") {

            if($senha == $conf_senha) {
           
                if($u->cadastrar($nome, $telefone, $email, $senha)) { 
                    $mensagem = 'Cadastrado com Sucesso! Acesse para entrar!';
                } else {
                    $mensagem = 'Email já cadastrado!';
                }

            } else {
                $mensagem = 'Senha e Confirmar Senha não correspondem!';
            }

        } else {
            $mensagem = "Erro: " . $u->msgERRO;
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
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>

<body>

<div id="corpo-form-cad">
    <h1>Cadastre-se</h1>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="50"/>
        <input type="text" name="telefone" placeholder="Telefone" maxlength="15"/>
        <input type="email" name="email" placeholder="Email de usuário" maxlength="30"/>
        <input type="password" name="senha" placeholder="Senha" maxlength="15"/>
        <input type="password" name="conf_senha" placeholder="Confirmar Senha"/><br>
        <input type="submit" value="CADASTRAR" name="" maxlength="15"/>
        <button type="button" class="btn-limpar" onclick="limparCampos()">Limpar Campos</button>
    </form>
</div>

<script>
    function limparCampos() {
        document.getElementsByName("nome")[0].value = "";
        document.getElementsByName("telefone")[0].value = "";
        document.getElementsByName("email")[0].value = "";
        document.getElementsByName("senha")[0].value = "";
        document.getElementsByName("conf_senha")[0].value = "";
    }

    function redirecionar() {
        window.location.href = "index.php";
    }

    <?php if(!empty($mensagem)): ?>
        alert('<?php echo $mensagem; ?>');
        <?php if($mensagem === 'Cadastrado com Sucesso! Acesse para entrar!'): ?>
            redirecionar();
        <?php endif; ?>    
    <?php endif; ?>
</script>

</body>
</html>
