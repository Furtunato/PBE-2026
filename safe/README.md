## 📚 SAFE - Sistema de Autorização e Fluxo Escolar

### Sobre o Projeto

O **SAFE** é um sistema web desenvolvido para digitalizar e otimizar o processo de autorização de saída/entrada de alunos em instituições de ensino, eliminando autorizações em papel e proporcionando um fluxo digital seguro e rastreável.

---

### 🎯 Objetivo

Modernizar a comunicação entre coordenação, professores e portaria, garantindo que nenhum aluno saia da escola sem a devida autorização, com registro digital de todas as etapas.

---

### 🔄 Fluxo de Funcionamento

O sistema opera em 3 etapas principais:

| Etapa | Responsável | Ação |
|-------|-------------|------|
| 1 | **Coordenação (AQV)** | Cria e assina a autorização |
| 2 | **Professor** | Libera o aluno da sala de aula |
| 3 | **Portaria** | Libera a catraca para saída |

---

### 👥 Perfis de Acesso

| Perfil | Função |
|--------|--------|
| **Admin (AQV)** | Cria autorizações, assina digitalmente, acompanha todo o fluxo |
| **Professor** | Visualiza alunos autorizados e libera da sala |
| **Portaria** | Visualiza alunos liberados pelo professor e libera a catraca |

---

### 🛠️ Tecnologias Utilizadas

| Tecnologia | Finalidade |
|------------|------------|
| Laravel 13.x | Framework principal |
| PHP 8.4 | Linguagem backend |
| MySQL | Banco de dados |
| Tailwind CSS | Interface responsiva |
| Laragon | Ambiente de desenvolvimento |

---

### ✅ Funcionalidades Implementadas

- Login por perfil (Admin, Professor, Portaria)
- Cadastro de autorizações com dados do aluno e responsável
- Controle de status em tempo real (pendente → aprovado → liberado)
- Aprovação em 3 etapas com validações por perfil
- Interface responsiva adaptada para cada usuário
- Registro de logs para rastreabilidade
- Simulação de notificações via Log

---

### ⏳ Funcionalidades Pendentes (Desafio)

| Funcionalidade | Status | Descrição |
|----------------|--------|-----------|
| **WhatsApp Real** | ⏳ Pendente | Integração com API oficial do WhatsApp |
| **E-mail Real** | ⏳ Pendente | Configuração com Mailpit/SMTP real |
| **Notificações Automáticas** | ⏳ Pendente | Disparo em tempo real para responsáveis |

---

### 📊 Estrutura do Banco de Dados

**Tabela `users`**
- Armazena dados de login e perfil de acesso

**Tabela `autorizacaos`**
- Registra todas as solicitações
- Controla status em cada etapa (status_aqv, status_professor, status_portaria)

---

### 🔒 Segurança

- Autenticação obrigatória para acessar o sistema
- Redirecionamento por perfil
- Proteção contra acesso não autorizado a rotas
- Senhas criptografadas (bcrypt)

---

### 📁 Estrutura do Projeto

```
safe/
├── app/
│   ├── Http/Controllers/     # Controladores da aplicação
│   ├── Models/                # Models (User, Autorizacao)
│   └── Services/              # Serviços adicionais
├── database/
│   ├── migrations/            # Estrutura do banco
│   └── seeders/               # Dados iniciais
├── resources/views/           # Interfaces do sistema
└── routes/web.php             # Rotas da aplicação
```

---

### 🚀 Benefícios

| Benefício | Descrição |
|-----------|-----------|
| **Segurança** | Controle total sobre quem autoriza a saída |
| **Rastreabilidade** | Histórico completo de cada autorização |
| **Agilidade** | Processo digital, sem papel |
| **Organização** | Centralização das informações |
| **Transparência** | Status visível para todos os envolvidos |

---

### 📌 Status do Projeto

🚧 **Em Desenvolvimento** - 80% concluído

**Partes Concluídas:**
- ✅ Sistema de autenticação e perfis
- ✅ Fluxo completo de autorização
- ✅ Interface para todos os perfis
- ✅ Controle de status

**Partes Pendentes:**
- ⏳ Integração com WhatsApp real
- ⏳ Disparo de e-mails reais
- ⏳ Notificações automáticas em tempo real

---

### 🔜 Próximos Passos

1. Implementar integração com API do WhatsApp Business
2. Configurar envio de e-mails com fila (queue)
3. Adicionar webhooks para notificações em tempo real

---

### 👨‍💻 Autor

Desenvolvido como solução para otimização de fluxo escolar

---

**SAFE - Segurança e Agilidade no Fluxo Escolar**
