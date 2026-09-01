<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_login();

$id     = !empty($_GET['id']) ? (int) $_GET['id'] : null;
$tarefa = ['titulo' => '', 'descricao' => '', 'status' => 'pendente'];
$errors = [];

if ($id) {
    $stmt = $conexao->prepare('SELECT * FROM tarefas WHERE id = :id AND usuario_id = :usuario_id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':usuario_id', current_user_id(), PDO::PARAM_INT);
    $stmt->execute();
    $found = $stmt->fetch();

    if (!$found) {
        flash('error', 'Tarefa não encontrada.');
        redirect(BASE_URL . '/tarefas/index.php');
    }
    $tarefa = $found;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $tarefa['titulo']    = trim($_POST['titulo'] ?? '');
    $tarefa['descricao'] = trim($_POST['descricao'] ?? '');
    $tarefa['status']    = ($_POST['status'] ?? '') === 'concluida' ? 'concluida' : 'pendente';

    if ($tarefa['titulo'] === '') {
        $errors['titulo'] = 'Informe um título para a tarefa.';
    } elseif (mb_strlen($tarefa['titulo']) > 255) {
        $errors['titulo'] = 'O título pode ter no máximo 255 caracteres.';
    }

    if (mb_strlen($tarefa['descricao']) > 2000) {
        $errors['descricao'] = 'A descrição pode ter no máximo 2000 caracteres.';
    }

    if (empty($errors)) {
        if ($id) {
            $sql  = 'UPDATE tarefas SET titulo = :titulo, descricao = :descricao, status = :status
                     WHERE id = :id AND usuario_id = :usuario_id';
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        } else {
            $sql  = 'INSERT INTO tarefas (titulo, descricao, status, usuario_id)
                     VALUES (:titulo, :descricao, :status, :usuario_id)';
            $stmt = $conexao->prepare($sql);
        }

        $stmt->bindValue(':titulo', $tarefa['titulo']);
        $stmt->bindValue(':descricao', $tarefa['descricao']);
        $stmt->bindValue(':status', $tarefa['status']);
        $stmt->bindValue(':usuario_id', current_user_id(), PDO::PARAM_INT);
        $stmt->execute();

        flash('success', $id ? 'Tarefa atualizada com sucesso.' : 'Tarefa criada com sucesso.');
        redirect(BASE_URL . '/tarefas/index.php');
    }
}

$pageTitle = ($id ? 'Editar Tarefa' : 'Nova Tarefa') . ' — TaskFlow';
$pageCss   = ['/assets/css/dashboard.css'];
include __DIR__ . '/../includes/partials/head.php';
include __DIR__ . '/../includes/partials/navbar.php';
include __DIR__ . '/../includes/partials/flash.php';
?>

<main id="main-content" class="container form-shell">
    <div class="page-header">
        <div>
            <h1><?= $id ? 'Editar Tarefa' : 'Nova Tarefa' ?></h1>
            <p class="subtitle"><?= $id ? 'Atualize os detalhes da tarefa.' : 'Descreva o que precisa ser feito.' ?></p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?= e(BASE_URL) ?>/tarefas/form.php<?= $id ? '?id=' . $id : '' ?>" data-lock-submit novalidate>
                <?= csrf_field() ?>

                <div class="field">
                    <label class="field-label" for="titulo">Título <span class="field-required">*</span></label>
                    <input class="input <?= isset($errors['titulo']) ? 'has-error' : '' ?>" type="text" id="titulo" name="titulo"
                           value="<?= e($tarefa['titulo']) ?>" maxlength="255" required
                           aria-describedby="<?= isset($errors['titulo']) ? 'titulo-error' : '' ?>">
                    <?php if (isset($errors['titulo'])): ?>
                    <span class="field-error" id="titulo-error"><?= icon('warning') ?> <?= e($errors['titulo']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <label class="field-label" for="descricao">Descrição</label>
                    <textarea class="textarea <?= isset($errors['descricao']) ? 'has-error' : '' ?>" id="descricao" name="descricao"
                              maxlength="2000" rows="5" data-char-count="descricao-count"><?= e($tarefa['descricao']) ?></textarea>
                    <div class="char-count" id="descricao-count">0 / 2000</div>
                    <?php if (isset($errors['descricao'])): ?>
                    <span class="field-error"><?= icon('warning') ?> <?= e($errors['descricao']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <span class="field-label">Status</span>
                    <div class="segmented">
                        <input type="radio" name="status" id="status-pendente" value="pendente" <?= $tarefa['status'] === 'pendente' ? 'checked' : '' ?>>
                        <label for="status-pendente"><?= icon('clock') ?> Pendente</label>

                        <input type="radio" name="status" id="status-concluida" value="concluida" <?= $tarefa['status'] === 'concluida' ? 'checked' : '' ?>>
                        <label for="status-concluida"><?= icon('check-circle') ?> Concluída</label>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?= e(BASE_URL) ?>/tarefas/index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <?= icon('check') ?> <?= $id ? 'Salvar alterações' : 'Criar tarefa' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../includes/partials/footer-scripts.php'; ?>
