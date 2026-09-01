<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/tarefas/index.php');
}

csrf_verify();

$id = (int) ($_POST['id'] ?? 0);

$sql  = 'UPDATE tarefas SET status = "concluida" WHERE id = :id AND usuario_id = :usuario_id';
$stmt = $conexao->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':usuario_id', current_user_id(), PDO::PARAM_INT);
$stmt->execute();

flash($stmt->rowCount() ? 'success' : 'error', $stmt->rowCount() ? 'Tarefa concluída.' : 'Tarefa não encontrada.');
redirect(BASE_URL . '/tarefas/index.php');
