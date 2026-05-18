<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tarefas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="login-container">
        <h2>Acesso ao Sistema</h2>

        <?php if (isset($_GET['erro']) && $_GET['erro'] == '1') { ?>
            <div class="msg-erro">Usuário ou senha incorretos!</div>
        <?php } ?>

        <form action="logar.php" method="POST">
            <div class="input-group-login">
                <label>Usuário:</label>
                <input type="text" name="usuario" placeholder="Digite seu usuário" required>
            </div>

            <div class="input-group-login">
                <label>Senha:</label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
            </div>

            <div class="botoes-grupo">
                <button type="submit" class="btn-entrar">Entrar</button>
                <button type="reset" class="btn-limpar">Limpar</button>
            </div>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
