<?php

class Usuarios {
    private $pdo;
    public $msgERRO = "";

    public function conectar($nome, $host, $usuario, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha) {
        try {
            $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return false;
            } else {
                $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();
                return true;
            }
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function logar($email, $senha) {
        try {
            $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dado = $sql->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dado['id_usuario'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function buscarUsuarioPorId($id) {
        try {
            $sql = $this->pdo->prepare("SELECT nome, telefone, email FROM usuarios WHERE id_usuario = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function atualizarUsuario($id, $nome, $telefone, $email) {
        try {
            $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, telefone = :telefone, email = :email WHERE id_usuario = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":email", $email);
            $sql->execute();

            $_SESSION['nome_usuario'] = $nome;

            return true;
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function excluirUsuario($id) {
        try {
            $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function getPDO() {
        return $this->pdo;
    }

    public function buscarUsuarioPorEmail($email) {
        try {
            $sql = $this->pdo->prepare("SELECT nome FROM usuarios WHERE email = :email");
            $sql->bindValue(":email", $email);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }



    }

?>
