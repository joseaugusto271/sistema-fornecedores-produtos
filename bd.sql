CREATE DATABASE IF NOT EXISTS sistema;

USE sistema;

-- Expressão SQL para criar a tabela de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Expressão SQL para criar a tabela de fornecedores
CREATE TABLE IF NOT EXISTS fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL
);

-- Expressão SQL para criar a tabela de produtos relacionada via FK com a tabela de fornecedores
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fornecedor_id INT,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    tipo ENUM ('Manutenção', 'Alimentação', 'Loja', 'Segurança', 'Serviço') NOT NULL,
    validade DATE NOT NULL,
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id)
);

-- Expressão SQL para cadastrar um usuário
INSERT INTO usuarios (usuario, senha) VALUES ('usuário', MD5('123'));