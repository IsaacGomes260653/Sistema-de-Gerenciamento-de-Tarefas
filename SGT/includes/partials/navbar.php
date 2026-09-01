<?php
$userName    = current_user_name();
$userInitial = $userName !== '' ? mb_strtoupper(mb_substr($userName, 0, 1)) : '?';
?>
<nav class="navbar">
    <div class="container navbar-inner">
        <a class="navbar-brand" href="<?= e(BASE_URL) ?>/tarefas/index.php">
            <?= icon('logo') ?>
            <span>TaskFlow</span>
        </a>

        <div class="navbar-actions">
            <button type="button" class="icon-toggle theme-toggle" data-theme-toggle aria-pressed="false" aria-label="Alternar tema claro/escuro">
                <span class="theme-toggle-sun"><?= icon('sun') ?></span>
                <span class="theme-toggle-moon"><?= icon('moon') ?></span>
            </button>

            <div class="user-menu">
                <button type="button" class="user-trigger" data-user-trigger aria-haspopup="true" aria-expanded="false">
                    <span class="avatar" aria-hidden="true"><?= e($userInitial) ?></span>
                    <span class="user-name">Olá, <?= e($userName) ?></span>
                </button>
                <div class="user-dropdown" data-user-dropdown role="menu">
                    <a href="<?= e(BASE_URL) ?>/logout.php" role="menuitem" class="danger">
                        <?= icon('sign-out') ?> Sair
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
