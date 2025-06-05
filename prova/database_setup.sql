CREATE DATABASE IF NOT EXISTS banco_vagas;
USE banco_vagas;

CREATE TABLE pessoas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE vagas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    descricao VARCHAR(255)
);

CREATE TABLE candidaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pessoa INT,
    id_vaga INT,
    FOREIGN KEY (id_pessoa) REFERENCES pessoas(id),
    FOREIGN KEY (id_vaga) REFERENCES vagas(id)
);
