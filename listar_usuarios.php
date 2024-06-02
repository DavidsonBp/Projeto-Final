<?php
require_once 'classes/Usuarios.php';
$u = new Usuarios();

$u->conectar("projeto_login", "localhost", "root", "");

$dados = array();
if ($u->msgERRO == "") {
    $pdo = $u->getPDO();
    $sql = $pdo->prepare("SELECT id_usuario, nome, telefone, email FROM usuarios");
    $sql->execute();
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Usuários Cadastrados</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>
<body>

<script>
        if (window.location.search.includes('edit_success=true')) {
            alert("Cadastro editado com sucesso!");
        } else if (window.location.search.includes('delete_success=true')) {
            alert("Cadastro excluído com sucesso!");
        }
    </script>

    <div class="container">
        <h1>Usuários Cadastrados</h1>
        <a href="Menu.php" class="btn-menu">Menu</a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dados as $dado) {
                        echo "<tr>";
                        echo "<td>".$dado['nome']."</td>";
                        echo "<td>".$dado['telefone']."</td>";
                        echo "<td>".$dado['email']."</td>";
                        echo "<td>";
                        echo "<a href='editar.php?id=".$dado['id_usuario']."' class='botao-editar'>Editar</a>";
                        echo " | ";
                        echo "<a href='excluir.php?id=".$dado['id_usuario']."' class='botao-excluir'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <h2><a href="sair.php">Sair</a></h2>
</body>
</html>
