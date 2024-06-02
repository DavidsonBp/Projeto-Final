<?php

class Alunos {
    private $pdo;
    public $msgERRO = "";

    public function conectar($nome, $host, $usuario, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
        }
    }

    public function cadastrar($nome, $matricula, $curso, $periodo, $email, $data_nascimento, $sexo) {
        try {
            $sql = $this->pdo->prepare("SELECT id_aluno FROM alunos WHERE matricula = :m");
            $sql->bindValue(":m", $matricula);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return false;
            } else {
                $sql = $this->pdo->prepare("INSERT INTO alunos (nome, matricula, curso, periodo, email, data_nascimento, sexo) VALUES (:n, :m, :c, :p, :e, :d, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":m", $matricula);
                $sql->bindValue(":c", $curso);
                $sql->bindValue(":p", $periodo);
                $sql->bindValue(":e", $email);
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

    public function buscarAlunoPorId($id) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM alunos WHERE id_aluno = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function atualizarAluno($id, $nome, $matricula, $curso, $periodo, $email, $data_nascimento, $sexo) {
        try {
            $sql = $this->pdo->prepare("UPDATE alunos SET nome = :n, matricula = :m, curso = :c, periodo = :p, email = :e, data_nascimento = :d, sexo = :s WHERE id_aluno = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":m", $matricula);
            $sql->bindValue(":c", $curso);
            $sql->bindValue(":p", $periodo);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":d", $data_nascimento);
            $sql->bindValue(":s", $sexo);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function excluirAluno($id) {
        try {
            $sql = $this->pdo->prepare("DELETE FROM alunos WHERE id_aluno = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
            return false;
        }
    }

    public function buscarTodosAlunos() {
        try {
            $sql = $this->pdo->prepare("SELECT  * FROM alunos");
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