<?php
include "../sessao.php";
include "../conexao.php";

$id  = $_GET["id"];
$sql = "DELETE FROM tarefas WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: index.php");
?>
