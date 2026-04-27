<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Layout</title>
    <link rel="stylesheet" href="assets/css/modern.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-building"></i>
                    <span>Intranet PMF</span>
                </div>
                <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <!-- Entity Switcher -->
            <div class="sidebar-entity-switcher">
                <div class="entity-switcher">
                    <label for="entity-select" class="entity-switcher__label">Entidade:</label>
                    <select id="entity-select" class="entity-switcher__select" onchange="switchEntity(this.value)">
                        <option value="">Carregando entidades...</option>
                    </select>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <ul class="sidebar__menu">
                    <li class="sidebar__item">
                        <a href="#" class="sidebar__link active">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar__item">
                        <a href="#" class="sidebar__link">
                            <i class="fas fa-newspaper"></i>
                            <span>Notícias</span>
                        </a>
                    </li>
                    <li class="sidebar__item">
                        <a href="#" class="sidebar__link">
                            <i class="fas fa-images"></i>
                            <span>Mídias</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <span class="user-name">Usuário Teste</span>
                        <span class="user-role">Administrador</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <h1>Dashboard</h1>
                    <p>Bem-vindo à Intranet da Prefeitura Municipal de Florianópolis</p>
                </div>
                
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Pesquisar..." id="searchInput">
                    </div>
                    
                    <div class="header-actions">
                        <button class="notification-btn" id="notificationBtn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <div class="user-menu" id="userMenu">
                            <button class="user-menu-btn">
                                <div class="user-avatar-small">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span>Usuário Teste</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            
                            <div class="user-dropdown">
                                <a href="perfil.php">
                                    <i class="fas fa-user"></i>
                                    Perfil
                                </a>
                                <a href="configuracoes.php">
                                    <i class="fas fa-cog"></i>
                                    Configurações
                                </a>
                                <hr>
                                <a href="logout.php" class="logout-link">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Sair
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon primary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-content">
                            <h3>25</h3>
                            <p>Notícias</p>
                            <span class="stat-change positive">+12%</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon success">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="stat-content">
                            <h3>150</h3>
                            <p>Mídias</p>
                            <span class="stat-change positive">+8%</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon warning">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h3>1,250</h3>
                            <p>Usuários</p>
                            <span class="stat-change positive">+5%</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon info">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="stat-content">
                            <h3>8</h3>
                            <p>Eventos</p>
                            <span class="stat-change negative">-2%</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Variáveis globais
        let sidebarOpen = false;

        // Função principal para toggle da sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            console.log('Toggle chamado - Sidebar aberta:', sidebarOpen);
            
            if (sidebarOpen) {
                // Fechar sidebar
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                sidebarOpen = false;
                console.log('Sidebar fechada');
            } else {
                // Abrir sidebar
                sidebar.classList.add('open');
                overlay.classList.add('active');
                sidebarOpen = true;
                console.log('Sidebar aberta');
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('sidebarOverlay');
            const userMenu = document.getElementById('userMenu');
            
            console.log('Elementos encontrados:', {
                sidebarToggle: !!sidebarToggle,
                overlay: !!overlay,
                userMenu: !!userMenu
            });

            // Fechar sidebar ao clicar no overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    console.log('Overlay clicado');
                    if (sidebarOpen) {
                        toggleSidebar();
                    }
                });
            }
            
            // User menu toggle
            if (userMenu) {
                userMenu.addEventListener('click', function() {
                    this.classList.toggle('active');
                });
            }
            
            // Fechar sidebar ao redimensionar a tela para desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 1024) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebarOverlay');
                    
                    if (sidebar && overlay && sidebarOpen) {
                        sidebar.classList.remove('open');
                        overlay.classList.remove('active');
                        sidebarOpen = false;
                    }
                }
            });

            console.log('Event listeners configurados');
            
            // Carregar entidades do banco de dados
            loadEntities();
        });
        
        // Carregar entidades do banco de dados
        function loadEntities() {
            fetch('backend/api/get_entities.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const select = document.getElementById('entity-select');
                        select.innerHTML = '';
                        
                        data.entities.forEach(entity => {
                            const option = document.createElement('option');
                            option.value = entity.entidade_id;
                            
                            // Criar nome de exibição com sigla se existir
                            let displayName = entity.entidade_nome;
                            if (entity.entidade_sigla) {
                                displayName += ' (' + entity.entidade_sigla + ')';
                            }
                            
                            option.innerHTML = displayName;
                            
                            // Marcar como selecionada se for a entidade atual
                            if (entity.entidade_id == data.current_entity) {
                                option.selected = true;
                            }
                            
                            select.appendChild(option);
                        });
                        
                        console.log('Entidades carregadas:', data.entities);
                    } else {
                        console.error('Erro ao carregar entidades:', data.message);
                        // Fallback para entidades padrão
                        loadDefaultEntities();
                    }
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                    // Fallback para entidades padrão
                    loadDefaultEntities();
                });
        }
        
        // Carregar entidades padrão (fallback)
        function loadDefaultEntities() {
            const select = document.getElementById('entity-select');
            const defaultEntities = [
                {id: 1, nome: 'Prefeitura Municipal'},
                {id: 2, nome: 'Secretaria de Educação'},
                {id: 3, nome: 'Secretaria de Saúde'},
                {id: 4, nome: 'Secretaria de Transportes'},
                {id: 5, nome: 'Secretaria de Cultura'}
            ];
            
            select.innerHTML = '';
            defaultEntities.forEach(entity => {
                const option = document.createElement('option');
                option.value = entity.id;
                option.innerHTML = entity.nome;
                select.appendChild(option);
            });
        }
        
        // Entity switcher function
        function switchEntity(entidadeId) {
            console.log('Trocando para entidade:', entidadeId);
            
            if (!entidadeId) return;
            
            // Enviar requisição para trocar entidade
            fetch('backend/api/switch_entity.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ entidade_id: entidadeId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Entidade alterada com sucesso');
                    // Recarregar a página para aplicar as mudanças
                    window.location.reload();
                } else {
                    alert('Erro ao trocar entidade: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao trocar entidade');
            });
        }
    </script>
</body>
</html>
