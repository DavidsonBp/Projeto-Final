<?php
require_once 'classes/Usuarios.php';
$u = new Usuarios();

$u->conectar("projeto_login", "localhost", "root", "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['telefone']) && isset($_POST['email'])) {
        $id_usuario = $_POST['id'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $u->atualizarUsuario($id_usuario, $nome, $telefone, $email); 

        header("Location: listar_usuarios.php?edit_success=true");
        exit();
    } else {
        echo "Todos os campos devem ser preenchidos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
