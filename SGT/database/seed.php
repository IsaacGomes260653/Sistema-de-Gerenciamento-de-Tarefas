<?php
/**
 * Creates the first admin account with a properly hashed password.
 * Run once from the command line: php database/seed.php
 * (Never insert plaintext or MD5 passwords directly via SQL — see banco.sql.)
 */
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/database.php';

$usuario = 'admin';
$senha   = '123456';

$check = $conexao->prepare('SELECT id FROM usuarios WHERE usuario = :usuario');
$check->bindParam(':usuario', $usuario);
$check->execute();

if ($check->fetch()) {
    echo "Usuário '$usuario' já existe — nada a fazer.\n";
    exit(0);
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

$insert = $conexao->prepare('INSERT INTO usuarios (usuario, senha) VALUES (:usuario, :senha)');
$insert->bindParam(':usuario', $usuario);
$insert->bindParam(':senha', $hash);
$insert->execute();

echo "Usuário '$usuario' criado com senha padrão '$senha'. Troque-a após o primeiro login.\n";
