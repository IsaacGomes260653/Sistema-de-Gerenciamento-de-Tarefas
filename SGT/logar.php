<?php
session_start();
include "conexao.php";

$usuario = $_POST["usuario"];
$senha   = md5($_POST["senha"]);

$sql  = "SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':senha', $senha);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $_SESSION["usuario_id"] = $user["id"];
    $_SESSION["usuario"]    = $user["usuario"];
    header("Location: TAREFA/index.php");
    exit;
} else {
    header("Location: index.php?erro=1");
    exit;
}
?>
