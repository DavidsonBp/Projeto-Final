# Projeto Final - Gestão Acadêmica

Este é um sistema básico de cadastro escolar desenvolvido para gerenciar alunos e professores em uma escola. Ele permite realizar operações simples de cadastro, edição, remoção e visualização de informações de alunos e professores.

# Funcionalidades
- Cadastro de alunos e professores
- Visualização de lista de alunos e professores cadastrados
- Edição de informações de alunos e professores
- Remoção de alunos e professores do sistema

# Tecnologias usadas no desenvolvimento
- HTML
- CSS
- JAVASCRIPT
- MYSQL
- PHP

# Banco de Dados

Criação do Banco de Dados e suas Tabelas

```sql
CREATE DATABASE IF NOT EXISTS projeto_login;
USE projeto_login;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    telefone VARCHAR(30),
    email VARCHAR(40) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS alunos (
    id_aluno INT AUTO_INCREMENT PRIMARY KEY,echo
    nome VARCHAR(50) NOT NULL,
    matricula VARCHAR(20) NOT NULL UNIQUE,
    curso VARCHAR(50) NOT NULL,
    periodo VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    sexo CHAR(1) NOT NULL
);

CREATE TABLE IF NOT EXISTS professores (
    id_professor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    curso VARCHAR(50) NOT NULL,
    matricula VARCHAR(20) NOT NULL UNIQUE,
    data_nascimento DATE NOT NULL,
    sexo CHAR(1) NOT NULL
);
