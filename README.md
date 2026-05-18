# ✅ TaskFlow — Sistema de Gerenciamento de Tarefas

> Aplicação web para gerenciamento pessoal de tarefas com autenticação de usuários e controle de acesso por sessão.

---
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
- [XAMPP](https://www.apachefriends.org/) ou outro servidor com PHP e MySQL

### Passo a passo

```bash
# Clone o repositório
git clone [https://github.com/seu-usuario/taskflow.git](https://github.com/IsaacGomes260653/Sistema-de-Gerenciamento-de-Tarefas/tree/main)
```

1. Mova a pasta do projeto para dentro de `htdocs` (XAMPP) ou `www` (WAMP)
2. Importe o banco de dados:
   - Abra o **phpMyAdmin** em `http://localhost/phpmyadmin`
   - Crie um banco de dados novo (ex: `taskflow`)
   - Importe o arquivo `banco.sql`
3. Configure a conexão em `conexao.php` com seus dados:
   ```php
   $host = "localhost";
   $banco = "taskflow";
   $usuario = "root";
   $senha = "";
   ```
4. Acesse no navegador: `http://localhost/A2`

---

## 📁 Estrutura do Projeto

```
A2/
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

<p align="center">Feito com 💙 por <strong>Isaac</strong></p>
