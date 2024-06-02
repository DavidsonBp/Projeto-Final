<?php
require_once 'classes/Usuarios.php';
$u = new Usuarios();

$u->conectar("projeto_login", "localhost", "root", "");

if(isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    $usuario = $u->buscarUsuarioPorId($id_usuario);

    if($usuario) {

        ?>

        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <title>Editar Usuário</title>
            <link rel="stylesheet" href="style/main.css">
            <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
        </head>
        <body>
            <div class="container">
                <h1>Editar Usuário</h1>
                <form action="editar_processamento.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id_usuario; ?>">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" value="<?php echo $usuario['telefone']; ?>">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>">
                    <input type="submit" value="Salvar">
                </form>
            </div>
        </body>
        </html>

        <?php
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "ID do usuário não especificado.";
}
?>
