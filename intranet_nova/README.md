# 🏛️ Intranet PMF - Nova Versão

Sistema moderno de intranet para a Prefeitura Municipal de Florianópolis, desenvolvido com PHP, HTML5, CSS3 e JavaScript vanilla.

## 📋 **Características Principais**

### ✅ **Funcionalidades Implementadas**
- **Sistema de Login** compatível com banco de dados existente
- **Menu Dinâmico** baseado em permissões do usuário
- **Dashboard Moderno** com estatísticas e widgets
- **Módulo de Usuários** - CRUD completo
- **Módulo de Notícias** - Gerenciamento de conteúdo
- **Módulo de Sistemas** - Catálogo de sistemas da intranet
- **Módulo de Mídias** - Upload e gerenciamento de arquivos
- **Calendário Interativo** com eventos
- **Design Responsivo** para todos os dispositivos
- **Sistema de Permissões** baseado no sistema antigo

### 🎨 **Design System**
- **Cores:** Paleta moderna com variáveis CSS
- **Tipografia:** Fonte Inter (Google Fonts)
- **Ícones:** Font Awesome 6
- **Layout:** Flexbox e CSS Grid
- **Animações:** Transições suaves
- **Responsividade:** Mobile-first approach

## 🚀 **Instalação e Configuração**

### 1. **Requisitos do Sistema**
- PHP 7.4 ou superior
- PostgreSQL 10 ou superior
- Apache/Nginx com mod_rewrite habilitado
- Extensões PHP: PDO, PDO_PGSQL, GD

### 2. **Configuração do Banco de Dados**
```sql
-- Execute o script para criar as tabelas
psql -U seu_usuario -d seu_banco -f create_modules_tables.sql
```

### 3. **Configuração dos Arquivos**
1. Copie os arquivos para o diretório do servidor web
2. Configure as permissões:
   ```bash
   chmod 755 uploads/
   chmod 644 assets/css/ assets/js/
   ```
3. Edite `config/database.php` com suas credenciais

### 4. **Estrutura de Diretórios**
```
intranet_nova/
├── assets/
│   ├── css/
│   │   ├── modern.css
│   │   └── components.css
│   └── js/
│       ├── modern.js
│       ├── dashboard.js
│       └── calendar.js
├── config/
│   ├── database.php
│   └── compatibility.php
├── includes/
│   ├── functions.php
│   └── menu.php
├── scripts/
│   └── php/ (sistema antigo)
├── uploads/
│   └── midias/
├── index.php
├── login.php
├── usuarios.php
├── noticias.php
├── sistemas.php
├── midias.php
└── README.md
```

## 🔐 **Sistema de Autenticação**

### **Compatibilidade com Sistema Antigo**
- Utiliza as mesmas tabelas: `uni_usuarios`, `intranet_permissoes`, etc.
- Mantém compatibilidade com senhas MD5 existentes
- Sistema de sessões compatível com estrutura antiga
- Permissões baseadas em perfis existentes

### **Fluxo de Login**
1. Usuário informa login/matrícula
2. Sistema verifica existência do usuário
3. Valida permissões e perfil
4. Cria sessão com dados do usuário
5. Redireciona para dashboard

## 📊 **Módulos do Sistema**

### **1. Dashboard (`index.php`)**
- Estatísticas em tempo real
- Widget de calendário
- Notícias recentes
- Acesso rápido aos sistemas
- Notificações

### **2. Usuários (`usuarios.php`)**
- Listagem de usuários
- Criação de novos usuários
- Edição de dados
- Exclusão de usuários
- Busca e filtros

### **3. Notícias (`noticias.php`)**
- Gerenciamento de notícias
- Categorização
- Status (ativo/rascunho/arquivado)
- Editor de conteúdo
- Busca avançada

### **4. Sistemas (`sistemas.php`)**
- Catálogo de sistemas
- Categorização por área
- Links diretos
- Status de disponibilidade
- Descrições detalhadas

### **5. Mídias (`midias.php`)**
- Upload de arquivos
- Suporte a imagens, vídeos, áudios
- Organização por categorias
- Preview de arquivos
- Download de arquivos

## 🎯 **Sistema de Menu Dinâmico**

### **Estrutura Baseada em Banco**
- **Tabelas:** `intranet_menu`, `intranet_submenu`, `intranet_menu_relacionado`
- **Permissões:** `intranet_perfil_menu`, `intranet_perfil_submenu`
- **Perfis:** `intranet_permissoes`

### **Funcionalidades**
- Menu gerado dinamicamente
- Verificação de permissões por usuário
- Ícones automáticos baseados no nome
- Navegação responsiva
- Estados ativos/inativos

## 🎨 **Componentes CSS**

### **Sistema de Design**
```css
:root {
    /* Cores */
    --primary-50: #eff6ff;
    --primary-600: #2563eb;
    --secondary-50: #f8fafc;
    --secondary-600: #475569;
    
    /* Espaçamento */
    --spacing-1: 0.25rem;
    --spacing-4: 1rem;
    --spacing-6: 1.5rem;
    
    /* Bordas */
    --border-radius: 0.375rem;
    --border-radius-lg: 0.75rem;
}
```

### **Componentes Disponíveis**
- **Alertas:** `.alert`, `.alert-success`, `.alert-danger`
- **Botões:** `.btn`, `.btn-primary`, `.btn-secondary`
- **Tabelas:** `.table`, `.table-container`
- **Formulários:** `.form-group`, `.form-input`, `.form-select`
- **Modais:** `.modal-overlay`, `.modal`
- **Cards:** `.card`, `.card-header`, `.card-content`

## 📱 **Responsividade**

### **Breakpoints**
- **Desktop:** > 1024px
- **Tablet:** 768px - 1024px
- **Mobile:** < 768px

### **Recursos Mobile**
- Sidebar colapsável
- Menu hambúrguer
- Grid adaptativo
- Touch-friendly buttons
- Otimização de performance

## 🔧 **Manutenção e Desenvolvimento**

### **Logs e Debug**
- Logs de erro em `error_log`
- Debug mode configurável
- Mensagens de erro amigáveis
- Validação de dados

### **Segurança**
- Prepared statements (PDO)
- Validação de entrada
- Escape de saída (htmlspecialchars)
- Verificação de permissões
- Proteção contra CSRF

### **Performance**
- Índices otimizados no banco
- CSS e JS minificados
- Cache de consultas
- Lazy loading de imagens

## 📈 **Próximas Funcionalidades**

### **Planejadas**
- [ ] Sistema de notificações push
- [ ] Chat interno
- [ ] Relatórios avançados
- [ ] API REST
- [ ] Integração com sistemas externos
- [ ] Backup automático
- [ ] Auditoria completa

### **Melhorias**
- [ ] PWA (Progressive Web App)
- [ ] Offline mode
- [ ] Temas personalizáveis
- [ ] Multi-idioma
- [ ] Dashboard customizável

## 🐛 **Solução de Problemas**

### **Problemas Comuns**

1. **Erro de Conexão com Banco**
   - Verifique as credenciais em `config/database.php`
   - Confirme se o PostgreSQL está rodando
   - Teste a conexão com `debug.php`

2. **Arquivos não Carregam**
   - Verifique permissões dos diretórios
   - Confirme se o `.htaccess` está correto
   - Teste com `test.php`

3. **Menu não Aparece**
   - Verifique se as tabelas de menu existem
   - Confirme permissões do usuário
   - Teste com `debug.php`

### **Debug**
```php
// Ativar debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Testar conexão
php debug.php
```

## 📞 **Suporte**

### **Contatos**
- **Desenvolvedor:** Equipe de TI PMF
- **Email:** ti@pmf.sc.gov.br
- **Documentação:** Este README

### **Links Úteis**
- [Documentação PHP](https://www.php.net/docs.php)
- [PostgreSQL Docs](https://www.postgresql.org/docs/)
- [Font Awesome](https://fontawesome.com/)
- [Google Fonts](https://fonts.google.com/)

---

**Versão:** 2.0.0  
**Última Atualização:** Dezembro 2024  
**Compatibilidade:** Sistema Antigo PMF  
**Status:** ✅ Produção
