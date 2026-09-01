<script>
    window.SGT_ICONS = {
        eye: <?= json_encode(icon('eye'), JSON_UNESCAPED_SLASHES) ?>,
        eyeSlash: <?= json_encode(icon('eye-slash'), JSON_UNESCAPED_SLASHES) ?>,
        spinner: <?= json_encode(icon('spinner', 'icon spinner'), JSON_UNESCAPED_SLASHES) ?>
    };
</script>
<script src="<?= e(BASE_URL) ?>/assets/js/app.js" defer></script>
</body>
</html>
