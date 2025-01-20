CREATE DATABASE acme_fitness;
USE acme_fitness;

CREATE TABLE categorias (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60),
    descricao VARCHAR(255)
);

CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(60),
    nome VARCHAR(100),
    descricao VARCHAR(255),
    preco DECIMAL(10,2),
    peso DECIMAL(8,2),
    data_cadastro DATE,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id) ON DELETE CASCADE
);

CREATE TABLE variacoes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_produto INT,
    cor VARCHAR(60),
    imagem TEXT,
    tamanho VARCHAR(10),
    estoque INT,
    FOREIGN KEY (id_produto) REFERENCES produtos(id) ON DELETE CASCADE
);

CREATE TABLE clientes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    cpf CHAR(11),
    data_nascimento DATE
);

CREATE TABLE enderecos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50),
    logradouro VARCHAR(255),
    numero VARCHAR(20),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    cep CHAR(8),
    complemento VARCHAR(255),
    id_cliente INT,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE CASCADE
);

CREATE TABLE pedidos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    id_endereco INT,
    valor_frete DECIMAL(10, 2),
    desconto DECIMAL(10, 2),
    valor_total DECIMAL(10, 2),
    forma_pagamento ENUM('pix', 'boleto', 'cartao'),
    data_pedido DATE,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_endereco) REFERENCES enderecos(id)
);

CREATE TABLE item_pedido (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_variacao INT,
    preco DECIMAL(10, 2),
    quantidade INT,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id),
    FOREIGN KEY (id_variacao) REFERENCES variacoes(id)
);
