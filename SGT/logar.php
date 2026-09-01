<?php
require_once __DIR__ . '/config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/index.php');
}

csrf_verify();

// Basic brute-force throttle: 5 tries, 60s cool-down.
$_SESSION['login_attempts'] ??= 0;
$_SESSION['login_locked_until'] ??= 0;

if (time() < $_SESSION['login_locked_until']) {
    flash('error', 'Muitas tentativas. Aguarde um minuto antes de tentar novamente.');
    redirect(BASE_URL . '/index.php');
}

$usuario = trim($_POST['usuario'] ?? '');
$senha   = (string) ($_POST['senha'] ?? '');

$sql  = 'SELECT * FROM usuarios WHERE usuario = :usuario';
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();
$user = $stmt->fetch();

if ($user && password_verify($senha, $user['senha'])) {
    session_regenerate_id(true);
    $_SESSION['usuario_id']     = $user['id'];
    $_SESSION['usuario']        = $user['usuario'];
    $_SESSION['login_attempts'] = 0;
    redirect(BASE_URL . '/tarefas/index.php');
}

$_SESSION['login_attempts']++;
if ($_SESSION['login_attempts'] >= 5) {
    $_SESSION['login_locked_until'] = time() + 60;
    $_SESSION['login_attempts']     = 0;
}

redirect(BASE_URL . '/index.php?erro=1');
