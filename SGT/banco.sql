CREATE DATABASE IF NOT EXISTS tarefas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tarefas;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    status ENUM('pendente', 'concluida') NOT NULL DEFAULT 'pendente',
    usuario_id INT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_tarefas_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    INDEX idx_tarefas_usuario_status (usuario_id, status)
);

-- No default user is seeded here: passwords must go through PHP's password_hash().
-- Run `php database/seed.php` after creating the schema to create the first admin account.
