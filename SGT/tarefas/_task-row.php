<?php
/** Expects $tarefa in scope. Included once per row from index.php (desktop table). */
$isDone   = $tarefa['status'] === 'concluida';
$search   = mb_strtolower($tarefa['titulo'] . ' ' . $tarefa['descricao']);
$created  = date('d/m/Y \à\s H:i', strtotime($tarefa['data_criacao']));
?>
<tr data-task-row data-search="<?= e($search) ?>" data-status="<?= e($tarefa['status']) ?>">
    <td class="task-title"><?= e($tarefa['titulo']) ?></td>
    <td class="task-desc"><?= e($tarefa['descricao']) ?: '—' ?></td>
    <td>
        <?php if ($isDone): ?>
        <span class="badge badge-success"><?= icon('check-circle') ?> Concluída</span>
        <?php else: ?>
        <span class="badge badge-warning"><?= icon('clock') ?> Pendente</span>
        <?php endif; ?>
    </td>
    <td><?= e($created) ?></td>
    <td>
        <div class="row-actions">
            <a href="<?= e(BASE_URL) ?>/tarefas/form.php?id=<?= (int) $tarefa['id'] ?>" class="btn btn-secondary btn-sm btn-icon"
               aria-label="Editar tarefa <?= e($tarefa['titulo']) ?>"><?= icon('pencil') ?></a>

            <?php if (!$isDone): ?>
            <form action="<?= e(BASE_URL) ?>/tarefas/concluir.php" method="POST" data-lock-submit>
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int) $tarefa['id'] ?>">
                <button type="submit" class="btn btn-primary btn-sm btn-icon" aria-label="Concluir tarefa <?= e($tarefa['titulo']) ?>">
                    <?= icon('check') ?>
                </button>
            </form>
            <?php endif; ?>

            <form action="<?= e(BASE_URL) ?>/tarefas/excluir.php" method="POST" data-lock-submit data-confirm-submit
                  data-confirm-title="Excluir tarefa?"
                  data-confirm-body="A tarefa “<?= e($tarefa['titulo']) ?>” será removida permanentemente.">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int) $tarefa['id'] ?>">
                <button type="submit" class="btn btn-danger btn-sm btn-icon" aria-label="Excluir tarefa <?= e($tarefa['titulo']) ?>">
                    <?= icon('trash') ?>
                </button>
            </form>
        </div>
    </td>
</tr>
