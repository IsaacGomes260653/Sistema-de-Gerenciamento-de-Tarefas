<?php
/**
 * PDO connection. Credentials come from .env — never hardcoded.
 * $conexao is kept as the global variable name for continuity with the rest of the app.
 */
$host   = env('DB_HOST', 'localhost');
$dbname = env('DB_NAME', 'tarefas');
$user   = env('DB_USER', 'root');
$pass   = env('DB_PASS', '');

try {
    $conexao = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    error_log('Falha na conexão com o banco: ' . $e->getMessage());
    http_response_code(500);
    die('Não foi possível conectar ao banco de dados. Tente novamente mais tarde.');
}
