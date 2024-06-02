<?php
require_once 'classes/Professores.php';
$p = new Professores();


$p->conectar("projeto_login", "localhost", "root", "");

$dados = array();
if ($p->msgERRO == "") {
    $dados = $p->buscarTodosProfessores();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Professores Cadastrados</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>
<body>
    <div class="container">
        <h1>Cadastro - Professores</h1>
        <a href="Menu.php" class="btn-menu">Menu</a>
        <a href="cadastrar_professor.php" class="botao-cadastrar">Cadastrar Novo Professor</a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <th>Matrícula</th>
                        <th>Data de Nascimento</th>
                        <th>Sexo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if ($dados) {
                        foreach ($dados as $dado) {
                            echo "<tr>";
                            echo "<td>".$dado['nome']."</td>";
                            echo "<td>".$dado['email']."</td>";
                            echo "<td>".$dado['curso']."</td>";
                            echo "<td>".$dado['matricula']."</td>";
                            echo "<td>".$dado['data_nascimento']."</td>";
                            echo "<td>".$dado['sexo']."</td>";
                            echo "<td>";
                            echo "<a href='editar_professor.php?id=".$dado['id_professor']."' class='botao-editar'>Editar</a>";
                            echo " | ";
                            echo "<a href='excluir_professor.php?id=".$dado['id_professor']."' class='botao-excluir'>Excluir</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Nenhum professor encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <h2><a href="sair.php">Sair</a></h2>
</body>
</html>
