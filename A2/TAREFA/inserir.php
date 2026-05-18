<?php
include "../sessao.php";
include "../conexao.php";

// Trata se é uma Edição (tem ID) ou Novo Cadastro (sem ID)
$id     = !empty($_GET['id']) ? $_GET['id'] : null;
$tarefa = null;

if ($id) {
    $sql  = "SELECT * FROM tarefas WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['titulo'])) {
    $id        = !empty($_POST['id']) ? $_POST['id'] : null;
    $titulo    = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status    = $_POST["status"];

    if ($id) {
        $sql  = "UPDATE tarefas SET titulo = :titulo, descricao = :descricao, status = :status WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
    } else {
        $sql  = "INSERT INTO tarefas (titulo, descricao, status, usuario_id) VALUES (:titulo, :descricao, :status, :usuario_id)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':usuario_id', $_SESSION["usuario_id"]);
    }

    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? 'Editar Tarefa' : 'Nova Tarefa'; ?></title>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header <?php echo $id ? 'bg-warning text-dark' : 'bg-success text-white'; ?>">
                    <h5 class="mb-0"><?php echo $id ? 'Editar Tarefa' : 'Nova Tarefa'; ?></h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="inserir.php">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control"
                                   value="<?php echo $tarefa ? $tarefa['titulo'] : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" class="form-control" rows="4"><?php echo $tarefa ? $tarefa['descricao'] : ''; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="pendente"  <?php echo ($tarefa && $tarefa['status'] == 'pendente')  ? 'selected' : ''; ?>>Pendente</option>
                                <option value="concluida" <?php echo ($tarefa && $tarefa['status'] == 'concluida') ? 'selected' : ''; ?>>Concluída</option>
                            </select>
                        </div>

                        <button type="submit" class="btn <?php echo $id ? 'btn-warning' : 'btn-success'; ?>">Salvar</button>
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
