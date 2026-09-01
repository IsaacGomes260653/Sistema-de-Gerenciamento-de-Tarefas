<?php $messages = flash_messages(); ?>
<div class="toast-region" aria-live="polite" aria-atomic="true">
    <?php foreach ($messages as $msg): ?>
    <div class="toast toast-<?= e($msg['type']) ?>" role="status">
        <?= icon($msg['type'] === 'error' ? 'warning' : 'check-circle', 'toast-icon') ?>
        <div class="toast-body"><?= e($msg['message']) ?></div>
        <button type="button" class="toast-close" aria-label="Fechar aviso"><?= icon('x') ?></button>
    </div>
    <?php endforeach; ?>
</div>
