# ✅ TaskFlow — Sistema de Gerenciamento de Tarefas

> Aplicação web para gerenciamento pessoal de tarefas com autenticação de usuários, controle de acesso por sessão e um design system próprio.

---

## 📋 Sobre o Projeto

O **TaskFlow** é um sistema de gerenciamento de tarefas desenvolvido com foco em segurança, performance e simplicidade. Cada usuário possui acesso exclusivo às suas próprias tarefas, com proteção de rotas e de dados que impede o acesso a recursos de outros usuários mesmo manipulando a URL ou o corpo da requisição diretamente.

---

## ✨ Funcionalidades

- 🔐 **Autenticação de usuários** — Login com usuário e senha (hash bcrypt)
- 🛡️ **Proteção de rotas e de dados** — Toda consulta/gravação de tarefa é filtrada pelo dono da sessão
- ✅ **Criar e editar tarefas** — Título, descrição e status
- 🏁 **Concluir tarefas** — Marque tarefas como concluídas em um clique
- 🗑️ **Excluir tarefas** — Com diálogo de confirmação customizado
- 🔎 **Busca e filtro instantâneos** — Por título/descrição e por status, sem recarregar a página
- 📊 **Painel com estatísticas** — Total, pendentes e concluídas
- 🌗 **Tema claro/escuro** — Persistente, com detecção automática do tema do sistema
- 📱 **Layout responsivo** — Tabela no desktop, cartões no mobile
- 🔔 **Feedback visual** — Toasts de sucesso/erro para cada ação
- 📅 **Data de criação** — Registro automático
- 🚪 **Logout seguro**

---

## 🔒 Segurança

- Cada usuário só visualiza e gerencia **suas próprias tarefas** — checado no banco (`WHERE usuario_id = ...`), não apenas na interface
- Proteção **CSRF** em todos os formulários que alteram dados
- Senhas com **`password_hash`/`password_verify`** (bcrypt) — nunca MD5 ou texto plano
- Saída sempre escapada (`htmlspecialchars`), prevenindo XSS
- Ações destrutivas exigem **POST**, nunca GET
- Cookies de sessão `HttpOnly` + `SameSite`, regeneração de ID de sessão no login
- Cabeçalhos de segurança (`X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`)
- Bloqueio temporário após tentativas de login seguidas malsucedidas
- Credenciais do banco fora do código-fonte (`.env`, nunca commitado)

---

## 🛠️ Tecnologias Utilizadas

- **Frontend:** HTML, CSS (design system próprio, sem framework externo), JavaScript vanilla
- **Backend:** PHP 8.1+ (PDO)
- **Banco de Dados:** MySQL / MariaDB
- **Autenticação:** Sessions (PHP nativo) + bcrypt
- **Servidor:** Apache (XAMPP/WAMP) ou o servidor embutido do PHP

---

## 🚀 Como Executar Localmente

### Pré-requisitos
- [XAMPP](https://www.apachefriends.org/) (ou PHP 8.1+ e MySQL/MariaDB por conta própria)

### Passo a passo

1. **Copie a pasta `SGT`** para dentro de `C:\xampp\htdocs\`, ficando `C:\xampp\htdocs\SGT\`
2. **Configure o ambiente:** copie `SGT/.env.example` para `SGT/.env` e ajuste as credenciais se necessário
3. **Crie o schema:** importe `SGT/banco.sql` via phpMyAdmin (ou `mysql -u root -p < banco.sql`)
4. **Crie o usuário administrador** (senha padrão `123456`, já hasheada com bcrypt):
   ```
   php SGT/database/seed.php
   ```
5. **Inicie os serviços Apache e MySQL** no painel do XAMPP
6. **Acesse o sistema:**
   ```
   http://localhost/SGT
   ```

> A aplicação detecta sozinha se está rodando na raiz do domínio ou em um subdiretório, então os links funcionam sem alterar código.

---

## 📁 Estrutura do Projeto

```
SGT/
├── assets/
│   ├── css/            # tokens, base, componentes e estilos de página
│   ├── js/app.js         # tema, toasts, dropdown, diálogo de confirmação, busca/filtro
│   └── img/favicon.svg
├── config/                # bootstrap, conexão PDO, leitor de .env
├── includes/                # guarda de rota, CSRF, helpers, ícones SVG, partials
├── database/seed.php          # cria o usuário admin com senha hasheada
├── tarefas/                     # painel, formulário, concluir/excluir
├── banco.sql
├── .env.example
├── index.php                      # login
├── logar.php
└── logout.php
```

---

## 🤝 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma *issue* ou enviar um *pull request*.

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -m 'feat: adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

---

## 📄 Licença

Este projeto está sob a licença MIT.

---

<p align="center">Feito com 💙 por <strong>ISAAC</strong></p>

---

# ✅ TaskFlow — Task Management System (English)

> Web app for personal task management with user authentication, session-based access control, and a custom design system.

## 📋 About

**TaskFlow** is a task management system built with a focus on security, performance and simplicity. Each user has exclusive access to their own tasks, with both route and data-level protection — access to other users' resources is blocked even by tampering with the URL or request body directly.

## ✨ Features

Secure login (bcrypt), task CRUD with instant search/filter, a stats dashboard, light/dark theme, responsive layout (table on desktop, cards on mobile), toast feedback, and a custom confirm dialog for destructive actions.

## 🔒 Security

Every task query/write is scoped to the session's owner at the database level; CSRF protection on all state-changing forms; bcrypt password hashing; escaped output against XSS; destructive actions require POST; secure session cookies with ID regeneration on login; security headers; login throttling; DB credentials kept out of source control via `.env`.

## 🛠️ Tech stack

Frontend: HTML, CSS (custom design system), vanilla JS · Backend: PHP 8.1+ (PDO) · Database: MySQL/MariaDB · Auth: native PHP sessions + bcrypt · Server: Apache (XAMPP/WAMP) or PHP's built-in server.

## 🚀 Running it locally

1. Install [XAMPP](https://www.apachefriends.org/).
2. Copy the `SGT` folder into `C:\xampp\htdocs\`.
3. Copy `SGT/.env.example` to `SGT/.env` and adjust credentials if needed.
4. Import `SGT/banco.sql` via phpMyAdmin (or `mysql -u root -p < banco.sql`).
5. Create the admin user: `php SGT/database/seed.php` (default password `123456`).
6. Start the **Apache** and **MySQL** modules.
7. Open `http://localhost/SGT` in your browser.

## 📄 License

MIT.

---

<p align="center">Built with 💙 by <strong>ISAAC</strong></p>
