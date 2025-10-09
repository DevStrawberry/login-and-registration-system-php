CREATE DATABASE IF NOT EXISTS `basic-crm-system-db`;

USE `basic-crm-system-db`;

CREATE TABLE users (
    -- ID único para cada usuário, chave primária, auto-incrementável
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,

    -- Nome de usuário
    username VARCHAR(100) NOT NULL,

    -- Endereço de e-mail (usado para login, deve ser único)
    email VARCHAR(100) NOT NULL UNIQUE,

    -- Senha: Armazena o hash seguro (VARCHAR de 255 é o padrão para hashes como bcrypt)
    password VARCHAR(255) NOT NULL,

    -- Timestamp: registra quando o usuário foi criado
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);