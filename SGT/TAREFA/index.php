<?php
// Framework utilizado: Bootstrap 5
// Importado de: https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css

include "../sessao.php";
include "../conexao.php";

$sql  = "SELECT * FROM tarefas WHERE usuario_id = :usuario_id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':usuario_id', $_SESSION["usuario_id"]);
$stmt->execute();
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Tarefas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style_tarefa.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Sistema de Tarefas</a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white">Olá, <?php echo $_SESSION['usuario']; ?></span>
            <a href="../logout.php" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </div>
</nav>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Minhas Tarefas</h4>
        <a href="inserir.php" class="btn btn-success">+ Nova Tarefa</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Data de Criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarefas as $tarefa): ?>
                    <tr>
                        <td><?php echo $tarefa['titulo']; ?></td>
                        <td><?php echo $tarefa['descricao']; ?></td>
                        <td>
                            <?php if ($tarefa['status'] == 'concluida'): ?>
                                <span class="badge bg-success">Concluída</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Pendente</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $tarefa['data_criacao']; ?></td>
                        <td>
                            <a href="inserir.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="concluir.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-success btn-sm">Concluir</a>
                            <a href="excluir.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
