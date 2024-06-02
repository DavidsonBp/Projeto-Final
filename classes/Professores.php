<?php

class Professores {
    private $pdo;
    public $msgERRO = "";

    public function conectar($nome, $host, $usuario, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
        }
    }

    public function cadastrar($nome, $email, $curso, $matricula, $data_nascimento, $sexo) {
        try {
            $sql = $this->pdo->prepare("SELECT id_professor FROM professores WHERE matricula = :m");
            $sql->bindValue(":m", $matricula);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return false; // Matrícula já cadastrada
            } else {
                $sql = $this->pdo->prepare("INSERT INTO professores (nome, email, curso, matricula, data_nascimento, sexo) VALUES (:n, :e, :c, :m, :d, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":c", $curso);
                $sql->bindValue(":m", $matricula);
                $sql->bindValue(":d", $data_nascimento);
                $sql->bindValue(":s", $sexo);
                $sql->execute();
                return true;
            }
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function buscarProfessorPorId($id) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM professores WHERE id_professor = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function atualizarProfessor($id, $nome, $email, $curso, $matricula, $data_nascimento, $sexo) {
        try {
            $sql = $this->pdo->prepare("UPDATE professores SET nome = :n, email = :e, curso = :c, matricula = :m, data_nascimento = :d, sexo = :s WHERE id_professor = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":c", $curso);
            $sql->bindValue(":m", $matricula);
            $sql->bindValue(":d", $data_nascimento);
            $sql->bindValue(":s", $sexo);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function excluirProfessor($id) {
        try {
            $sql = $this->pdo->prepare("DELETE FROM professores WHERE id_professor = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function buscarTodosProfessores() {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM professores");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}
?>
