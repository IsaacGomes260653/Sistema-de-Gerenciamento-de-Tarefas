<?php
require_once __DIR__ . '/config/config.php';

if (!empty($_SESSION['usuario_id'])) {
    redirect(BASE_URL . '/tarefas/index.php');
}

$erro = isset($_GET['erro']);

$pageTitle = 'Entrar — TaskFlow';
$pageCss   = ['/assets/css/login.css'];
include __DIR__ . '/includes/partials/head.php';
?>

<button type="button" class="icon-toggle theme-toggle theme-toggle-floating" data-theme-toggle aria-pressed="false" aria-label="Alternar tema claro/escuro">
    <span class="theme-toggle-sun"><?= icon('sun') ?></span>
    <span class="theme-toggle-moon"><?= icon('moon') ?></span>
</button>

<?php include __DIR__ . '/includes/partials/flash.php'; ?>

<main id="main-content" class="login-shell">
    <section class="login-showcase" aria-hidden="true">
        <span class="brand"><?= icon('logo') ?> TaskFlow</span>
        <div>
            <h1>Organize suas tarefas com clareza e foco.</h1>
            <p>Crie, acompanhe e conclua suas tarefas em um único lugar, com um painel simples e rápido.</p>
        </div>
        <div class="login-stats">
            <div><strong>100%</strong><span>Seus dados, sua conta</span></div>
            <div><strong>&lt;1s</strong><span>Resposta do painel</span></div>
        </div>
    </section>

    <section class="login-panel">
        <span class="brand-mobile"><?= icon('logo') ?> TaskFlow</span>

        <div class="card">
            <div class="card-body">
                <h2>Acesso ao sistema</h2>
                <p class="subtitle">Entre com sua conta para ver suas tarefas.</p>

                <?php if ($erro): ?>
                <div class="form-alert">
                    <?= icon('warning') ?> Usuário ou senha incorretos.
                </div>
                <?php endif; ?>

                <form action="<?= e(BASE_URL) ?>/logar.php" method="POST" data-lock-submit novalidate>
                    <?= csrf_field() ?>

                    <div class="field">
                        <label class="field-label" for="usuario">Usuário</label>
                        <input class="input" type="text" id="usuario" name="usuario" placeholder="Seu usuário"
                               autocomplete="username" required autofocus>
                    </div>

                    <div class="field">
                        <label class="field-label" for="senha">Senha</label>
                        <div class="input-with-action">
                            <input class="input" type="password" id="senha" name="senha" placeholder="Sua senha"
                                   autocomplete="current-password" required minlength="4">
                            <button type="button" class="input-action" data-password-toggle="senha" aria-label="Mostrar senha">
                                <?= icon('eye') ?>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <?= icon('sign-in') ?> Entrar
                    </button>
                </form>
            </div>
        </div>

        <p class="login-footer">TaskFlow &middot; Sistema de Gerenciamento de Tarefas</p>
    </section>
</main>

<?php include __DIR__ . '/includes/partials/footer-scripts.php'; ?>
