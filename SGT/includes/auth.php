<?php
/** Route guard for every protected page. Include after config/config.php. */
function require_login(): void
{
    if (empty($_SESSION['usuario_id'])) {
        redirect(BASE_URL . '/index.php');
    }
}

function current_user_id(): int
{
    return (int) ($_SESSION['usuario_id'] ?? 0);
}

function current_user_name(): string
{
    return $_SESSION['usuario'] ?? '';
}
