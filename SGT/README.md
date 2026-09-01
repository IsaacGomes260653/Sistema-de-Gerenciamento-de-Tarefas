# TaskFlow — Sistema de Gerenciamento de Tarefas

Aplicação PHP/MySQL para gerenciamento pessoal de tarefas, com login por sessão, CRUD completo e um painel com busca, filtros, tema claro/escuro e feedback visual em cada ação.

## Funcionalidades

- Login com senha protegida por hash (`password_hash`/`password_verify`)
- CRUD de tarefas (criar, editar, concluir, excluir), sempre restrito ao dono da tarefa
- Painel com cartões de estatísticas (total, pendentes, concluídas)
- Busca instantânea e filtro por status, sem recarregar a página
- Tema claro/escuro com persistência local e detecção do tema do sistema
- Confirmação de exclusão via diálogo customizado (não bloqueia a aba como `confirm()`)
- Mensagens de sucesso/erro (toasts) para cada ação
- Layout responsivo: tabela no desktop, cartões no mobile

## Segurança

- Proteção CSRF em todos os formulários que alteram dados
- Toda consulta/gravação de tarefa é filtrada por `usuario_id` da sessão — não é possível ver, editar, concluir ou excluir tarefas de outro usuário mesmo manipulando o `id` na URL
- Senhas com `password_hash` (bcrypt), nunca MD5 ou texto plano
- Saída sempre escapada com `htmlspecialchars` (função `e()`), prevenindo XSS
- Ações destrutivas exigem `POST`, não `GET`
- Cookies de sessão `HttpOnly` + `SameSite=Lax`, regeneração de ID de sessão no login
- Cabeçalhos de segurança (`X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`)
- Bloqueio temporário após 5 tentativas de login seguidas
- Credenciais do banco fora do código-fonte (`.env`, nunca commitado)

## Estrutura do projeto

```
SGT/
├── assets/
│   ├── css/            # tokens.css (design tokens), base.css, components.css, login.css, dashboard.css
│   ├── js/app.js        # tema, toasts, dropdown, dialog de confirmação, busca/filtro
│   └── img/favicon.svg
├── config/
│   ├── env.php           # leitor de .env
│   ├── config.php        # bootstrap: sessão, headers de segurança, BASE_URL
│   └── database.php       # conexão PDO
├── includes/
│   ├── auth.php           # guarda de rota (require_login)
│   ├── csrf.php
│   ├── helpers.php        # e(), redirect(), flash()
│   ├── icons.php           # ícones SVG inline
│   └── partials/           # head, navbar, flash, confirm-dialog, footer-scripts
├── database/
│   └── seed.php            # cria o usuário admin com senha hasheada
├── tarefas/
│   ├── index.php            # painel (lista, busca, filtros, estatísticas)
│   ├── form.php               # criar/editar tarefa
│   ├── concluir.php            # marca como concluída (POST)
│   ├── excluir.php              # exclui (POST)
│   └── _task-row.php, _task-card.php
├── banco.sql
├── .env.example
├── index.php                    # login
├── logar.php
└── logout.php
```

## Como executar localmente

Requer PHP 8.1+ e MySQL/MariaDB.

1. Copie `.env.example` para `.env` e ajuste as credenciais do banco:
   ```
   cp .env.example .env
   ```
2. Crie o schema:
   ```
   mysql -u root -p < banco.sql
   ```
3. Crie o usuário administrador (senha padrão `123456`, hasheada com bcrypt):
   ```
   php database/seed.php
   ```
4. Sirva o projeto (embutido no PHP, ou aponte o Apache/XAMPP para esta pasta):
   ```
   php -S localhost:8000
   ```
5. Acesse `http://localhost:8000` e entre com `admin` / `123456`.

> A aplicação detecta sozinha se está rodando na raiz do domínio ou em um subdiretório (ex. `http://localhost/SGT/`), então os links funcionam nos dois cenários sem alterar código.

## Design

Sistema visual próprio (sem framework CSS externo), com tokens de cor/tipografia/espaçamento, paleta teal + laranja com contraste AAA, tipografia Plus Jakarta Sans, componentes consistentes (botões, badges, cards, tabela responsiva, diálogos, toasts) e microinterações de 150–300ms respeitando `prefers-reduced-motion`.
