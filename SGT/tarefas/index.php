<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_login();

$stmt = $conexao->prepare(
    'SELECT * FROM tarefas WHERE usuario_id = :usuario_id ORDER BY data_criacao DESC'
);
$stmt->bindValue(':usuario_id', current_user_id(), PDO::PARAM_INT);
$stmt->execute();
$tarefas = $stmt->fetchAll();

$total     = count($tarefas);
$pendentes = count(array_filter($tarefas, fn ($t) => $t['status'] === 'pendente'));
$concluidas = $total - $pendentes;

$pageTitle = 'Minhas Tarefas — TaskFlow';
$pageCss   = ['/assets/css/dashboard.css'];
include __DIR__ . '/../includes/partials/head.php';
include __DIR__ . '/../includes/partials/navbar.php';
include __DIR__ . '/../includes/partials/flash.php';
?>

<main id="main-content" class="container">
    <div class="page-header">
        <div>
            <h1>Minhas Tarefas</h1>
            <p class="subtitle">Acompanhe o que está pendente e o que já foi concluído.</p>
        </div>
        <a href="<?= e(BASE_URL) ?>/tarefas/form.php" class="btn btn-accent">
            <?= icon('plus') ?> Nova Tarefa
        </a>
    </div>

    <div class="stats-grid">
        <div class="card stat-card">
            <span class="stat-icon total"><?= icon('clipboard') ?></span>
            <div><span class="stat-value"><?= (int) $total ?></span><p class="stat-label">Total de tarefas</p></div>
        </div>
        <div class="card stat-card">
            <span class="stat-icon pending"><?= icon('clock') ?></span>
            <div><span class="stat-value"><?= (int) $pendentes ?></span><p class="stat-label">Pendentes</p></div>
        </div>
        <div class="card stat-card">
            <span class="stat-icon done"><?= icon('check-circle') ?></span>
            <div><span class="stat-value"><?= (int) $concluidas ?></span><p class="stat-label">Concluídas</p></div>
        </div>
    </div>

    <?php if ($total === 0): ?>
    <div class="card">
        <div class="empty-state">
            <?= icon('clipboard') ?>
            <h3>Nenhuma tarefa ainda</h3>
            <p>Crie sua primeira tarefa para começar a organizar seu dia.</p>
            <a href="<?= e(BASE_URL) ?>/tarefas/form.php" class="btn btn-primary">
                <?= icon('plus') ?> Nova Tarefa
            </a>
        </div>
    </div>
    <?php else: ?>

    <div class="toolbar">
        <div class="input-with-action">
            <input class="input" type="search" placeholder="Buscar por título ou descrição…" data-task-filter
                   aria-label="Buscar tarefas">
            <span class="input-action is-static" aria-hidden="true"><?= icon('search') ?></span>
        </div>
        <div class="filter-pills" role="group" aria-label="Filtrar por status">
            <button type="button" class="filter-pill" data-status-filter="all" aria-pressed="true">Todas</button>
            <button type="button" class="filter-pill" data-status-filter="pendente" aria-pressed="false">Pendentes</button>
            <button type="button" class="filter-pill" data-status-filter="concluida" aria-pressed="false">Concluídas</button>
        </div>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table class="task-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Criada em</th>
                        <th class="visually-hidden">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarefas as $tarefa): ?>
                    <?php include __DIR__ . '/_task-row.php'; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="task-cards">
            <?php foreach ($tarefas as $tarefa): ?>
            <?php include __DIR__ . '/_task-card.php'; ?>
            <?php endforeach; ?>
        </div>

        <div class="empty-state" data-filter-empty hidden>
            <?= icon('search') ?>
            <h3>Nada encontrado</h3>
            <p>Tente outro termo de busca ou outro filtro de status.</p>
        </div>
    </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/../includes/partials/confirm-dialog.php'; ?>
<?php include __DIR__ . '/../includes/partials/footer-scripts.php'; ?>
