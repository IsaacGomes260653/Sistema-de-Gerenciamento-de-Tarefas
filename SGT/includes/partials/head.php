<?php
/**
 * Expects (optional): $pageTitle, $pageCss (array of extra stylesheet paths, relative to BASE_URL),
 * $bodyClass. Include, then open <body>, then include navbar.php/flash.php as needed.
 */
$pageTitle ??= 'TaskFlow';
$pageCss   ??= [];
$bodyClass ??= '';
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d9488">
    <title><?= e($pageTitle) ?></title>

    <!-- Runs before first paint to avoid a light-mode flash for users who prefer dark. -->
    <script>
        (function () {
            try {
                var saved = localStorage.getItem('sgt-theme');
                var theme = saved || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                document.documentElement.setAttribute('data-theme', theme);
            } catch (e) {}
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">

    <link rel="stylesheet" href="<?= e(BASE_URL) ?>/assets/css/tokens.css">
    <link rel="stylesheet" href="<?= e(BASE_URL) ?>/assets/css/base.css">
    <link rel="stylesheet" href="<?= e(BASE_URL) ?>/assets/css/components.css">
    <?php foreach ($pageCss as $css): ?>
    <link rel="stylesheet" href="<?= e(BASE_URL . $css) ?>">
    <?php endforeach; ?>

    <link rel="icon" href="<?= e(BASE_URL) ?>/assets/img/favicon.svg" type="image/svg+xml">
</head>
<body class="<?= e($bodyClass) ?>">
<a class="skip-link" href="#main-content">Pular para o conteúdo</a>
