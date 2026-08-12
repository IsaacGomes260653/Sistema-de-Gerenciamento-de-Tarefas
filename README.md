# ✅ TaskFlow — Sistema de Gerenciamento de Tarefas

> Aplicação web para gerenciamento pessoal de tarefas com autenticação de usuários e controle de acesso por sessão.

---

## 📋 Sobre o Projeto

O **TaskFlow** é um sistema de gerenciamento de tarefas desenvolvido com foco em segurança e simplicidade. Cada usuário possui acesso exclusivo às suas próprias tarefas, com proteção de rotas que impede o acesso a páginas de outros usuários mesmo que a URL seja conhecida.

---

## ✨ Funcionalidades

- 🔐 **Autenticação de usuários** — Login com usuário e senha
- 🛡️ **Proteção de rotas** — Acesso negado a páginas alheias mesmo com o link direto
- ✅ **Criar tarefas** — Adicione novas tarefas com título e descrição
- ✏️ **Editar tarefas** — Atualize informações de tarefas existentes
- 🏁 **Concluir tarefas** — Marque tarefas como concluídas
- 🗑️ **Excluir tarefas** — Remova tarefas que não são mais necessárias
- 📅 **Data de criação** — Registro automático da data e hora de criação
- 🚪 **Logout seguro** — Encerramento de sessão com botão "Sair"

---

## 🔒 Segurança

- Cada usuário só visualiza e gerencia **suas próprias tarefas**
- O sistema **bloqueia o acesso via URL direta** a recursos de outros usuários
- Sessão necessária para qualquer operação dentro do sistema
- Redirecionamento automático para o login caso o usuário não esteja autenticado

---

## 🛠️ Tecnologias Utilizadas

- **Frontend:** HTML, CSS
- **Backend:** PHP
- **Banco de Dados:** MySQL
- **Autenticação:** Sessions (PHP nativo)
- **Servidor:** Apache (XAMPP / WAMP)

---

## 🚀 Como Executar Localmente

### Pré-requisitos
- Instalar o [XAMPP](https://www.apachefriends.org/)

### Passo a passo

1. **Instale o XAMPP** e abra o painel de controle
2. **Inicie os serviços** clicando em **Start** nos módulos **Apache** e **MySQL**
3. **Copie a pasta do projeto** (`SGT`) para dentro do diretório:
   ```
   C:\xampp\htdocs\
   ```
   Ficando assim: `C:\xampp\htdocs\SGT\`
4. **Importe o banco de dados:**
   - Abra o navegador e acesse `http://localhost/phpmyadmin`
   - Clique em **Novo** para criar um banco de dados (ex: `taskflow`)
   - Com o banco selecionado, clique em **Importar**
   - Escolha o arquivo `banco.sql` da pasta do projeto e clique em **Executar**
5. **Verifique a conexão** no arquivo `conexao.php`:
   ```php
   $host = "localhost";
   $banco = "taskflow";
   $usuario = "root";
   $senha = "";
   ```
6. **Acesse o sistema** no navegador:
   ```
   http://localhost/SGT
   ```

---

## 📁 Estrutura do Projeto

```
SGT/
├── TAREFA/
│   ├── concluir.php      # Marca tarefa como concluída
│   ├── excluir.php       # Remove uma tarefa
│   ├── index.php         # Lista as tarefas do usuário
│   ├── inserir.php       # Cria nova tarefa
│   └── style_tarefa.css  # Estilos da tela de tarefas
├── banco.sql             # Script de criação do banco de dados
├── conexao.php           # Configuração da conexão com o MySQL
├── index.php             # Página inicial / redirecionamento
├── logar.php             # Lógica de autenticação
├── login.css             # Estilos da tela de login
├── logout.php            # Encerra a sessão do usuário
├── sessao.php            # Verificação e proteção de sessão
└── style.css             # Estilos globais
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

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](./LICENSE) para mais detalhes.

---

<p align="center">Feito com 💙 por <strong>ISAAC</strong></p>

---

# ✅ TaskFlow — Task Management System (English)

> Web app for personal task management with user authentication and session-based access control.

## 📋 About

**TaskFlow** is a task management system built with a focus on security and simplicity. Each user has exclusive access to their own tasks, with route protection that blocks access to other users' pages even if the URL is known.

## ✨ Features

User login, route protection against direct-URL access to other users' data, task creation/editing/completion/deletion, automatic creation timestamps, and secure logout.

## 🔒 Security

Each user only sees and manages their own tasks; direct-URL access to other users' resources is blocked; a valid session is required for any operation; unauthenticated users are redirected to login automatically.

## 🛠️ Tech stack

Frontend: HTML, CSS · Backend: PHP · Database: MySQL · Auth: native PHP sessions · Server: Apache (XAMPP/WAMP).

## 🚀 Running it locally

1. Install [XAMPP](https://www.apachefriends.org/).
2. Start the **Apache** and **MySQL** modules.
3. Copy the `SGT` folder into `C:\xampp\htdocs\`.
4. Import `banco.sql` via phpMyAdmin into a new database (e.g. `taskflow`).
5. Check the credentials in `conexao.php` match your local setup.
6. Open `http://localhost/SGT` in your browser.

## 📄 License

MIT — see [LICENSE](./LICENSE).

---

<p align="center">Built with 💙 by <strong>ISAAC</strong></p>
