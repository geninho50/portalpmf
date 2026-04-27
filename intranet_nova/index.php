<?php
// Configuração de erro para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

    print "<pre>";
    print_r($_SESSION);
    print "</pre>";

try {
    session_start();
    require_once("config/database.php");
    require_once("config/compatibility.php");
    require_once("includes/functions.php");
    require_once("includes/menu.php");
    require_once("includes/entity_switcher.php");

    // Verificar se está logado (compatível com sistema antigo)
    if (!isset($_SESSION['SuserId'])) {
        header("Location: login.php");
        exit();
    }

    // Usar dados da sessão antiga se disponível, senão usar estrutura moderna
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        // Criar estrutura moderna a partir da sessão antiga
        $user = [
            'id' => $_SESSION['SuserId'],
            'nome' => $_SESSION['SuserNome'] ?? 'Usuário',
            'email' => '',
            'matricula' => $_SESSION['SuserLogin'] ?? '',
            'login' => $_SESSION['SuserLogin'] ?? '',
            'perfil' => 'Usuário'
        ];
    }

    // Inicializar gerenciador de menu
    $menuManager = new MenuManager(
        $pdo, 
        $_SESSION['SuserId'], 
        $_SESSION['SuserPerfilId'] ?? 1, 
        $_SESSION['SuserEnt'] ?? 1
    );
    
    // Inicializar trocador de entidade
    $entitySwitcher = new EntitySwitcher(
        $pdo,
        $_SESSION['SuserId'],
        $_SESSION['SuserEnt'] ?? 1
    );
} catch (Exception $e) {
    error_log("Erro crítico no index.php: " . $e->getMessage());
    die("Erro interno do servidor. Verifique os logs para mais detalhes.");
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet PMF - Prefeitura Municipal de Florianópolis</title>
    
    <!-- CSS Moderno -->
    <link rel="stylesheet" href="assets/css/modern.css">
    
    <!-- Os CSSs extras -->
    <link rel="stylesheet" href="assets/css/CSS_teste.css">
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
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
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <?php echo $menuManager->generateMenu(); ?>
            </nav>
   
            

            <!--Troquei de lugar -pf-->
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <span class="user-name"><?php echo htmlspecialchars($user['matricula']); ?></span>
                        <span class="user-role"><?php echo htmlspecialchars($user['perfil']); ?></span>
                    </div>
                </div>
            </div>
            
            </aside>
            
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="header-toggle" id="headerToggle" style="display: none;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1>Dashboard</h1>                    
                    <br><p>Bem-vindo à Intranet da Prefeitura Municipal de Florianópolis</p>
                </div>
                
                
                <div class="header-right">
                    <div class="header-actions">

                    <!-- Entity Switcher -->
                    <div class="sidebar-entity-switcher">
                        <?php echo $entitySwitcher->render(); ?>
                    </div>
                        
                        <button class="notification-btn" id="notificationBtn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <div class="user-menu" id="userMenu">
                            <button class="user-menu-btn">
                                <div class="user-avatar-small">
                                    <i class="fas fa-user"></i>
                                </div>
                            <!--Chamda do nome de quem fez o login-->
                                <span><?php echo htmlspecialchars($user['nome']); ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <!--Itens do menu perfil-->
                            <div class="user-dropdown">
                                <a href="usuariodados.php">
                                    <i class="fas fa-user"></i>
                                    Perfil
                                </a>
                                <a href="page_config.php">
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
                    <?php
                    // Buscar estatísticas do banco
                    $stats = getDashboardStats($pdo);
                    ?>
                    
                    <div class="stat-card">
                        <div class="stat-icon primary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $stats['noticias']; ?></h3>
                            <p>Notícias</p>
                            <span class="stat-change positive">+12%</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon success">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $stats['midias']; ?></h3>
                            <p>Mídias</p>
                            <span class="stat-change positive">+8%</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon warning">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $stats['usuarios']; ?></h3>
                            <p>Usuários Ativos</p>
                            <span class="stat-change positive">+5%</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon danger">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $stats['eventos']; ?></h3>
                            <p>Eventos</p>
                            <span class="stat-change positive">+15%</span>
                        </div>
                    </div>
                </div>

                <!-- Main Grid -->
                <div class="dashboard-grid">
                    <!-- Últimas Notícias -->
                    <div class="dashboard-card">
                        <div class="card">
                            <div class="card-header">
                                <h2>Últimas Notícias</h2>
                                <a href="noticias.php" class="card-link"><i class="fa-solid fa-newspaper"></i></a>
                            </div>
                            <div class="card-content">
                                <?php
                                $recentNews = getRecentNews($pdo, 5);
                                if ($recentNews): ?>
                                    <div class="news-list">
                                        <?php foreach ($recentNews as $news): ?>
                                            <div class="news-item">
                                                <div class="news-content">
                                                    <h4><?php echo htmlspecialchars($news['titulo']); ?></h4>
                                                    <p><?php echo htmlspecialchars(substr($news['conteudo'], 0, 100)) . '...'; ?></p>
                                                    <span class="news-date"><?php echo formatDate($news['data_criacao']); ?></span>
                                                </div>
                                                <a href="noticia.php?id=<?php echo $news['id']; ?>" class="news-link">
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p style="margin:15px;" class="empty-state">Nenhuma notícia encontrada.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Notificações -->
                    <div class="dashboard-card">
                        <div class="card">
                            <div class="card-header">
                                <h2>Notificações</h2>
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-content">
                                <?php
                                $notifications = getNotifications($pdo, 5);
                                if ($notifications): ?>
                                    <div class="notification-list">
                                        <?php foreach ($notifications as $notification): ?>
                                            <div class="notification-item">
                                                <div class="notification-icon">
                                                    <i class="fas fa-<?php echo getNotificationIcon($notification['tipo']); ?>"></i>
                                                </div>
                                                <div class="notification-content">
                                                    <p><?php echo htmlspecialchars($notification['mensagem']); ?></p>
                                                    <span class="notification-time"><?php echo formatTimeAgo($notification['data_criacao']); ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p style="margin:15px;" class="empty-state">Nenhuma notificação.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                     <!-- Calendário -->
                    <div class="dashboard-card">
                        <div class="card">
                            <div class="card-header">
                                <h2>Calendário</h2>
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="card-content">
                                <div id="calendar-widget">
                                    <div class="calendar-header">
                                        <button id="prevMonth" class="calendar-nav-btn">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <h3 id="currentMonth">Janeiro 2024</h3>
                                        <button id="nextMonth" class="calendar-nav-btn">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                    <div class="calendar-weekdays">
                                        <div>Dom</div>
                                        <div>Seg</div>
                                        <div>Ter</div>
                                        <div>Qua</div>
                                        <div>Qui</div>
                                        <div>Sex</div>
                                        <div>Sáb</div>
                                    </div>
                                    <div id="calendar-days" class="calendar-days"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações Rápidas -->
                    <div class="dashboard-card">
                        <div class="card">
                            <div class="card-header">
                                <h2>Ações Rápidas</h2>
                            </div>
                            <div class="card-content" >
                                <div class="quick-actions">
                                    <a href="noticias.php" class="quick-action-btn">
                                        <i class="fas fa-newspaper"></i>
                                        <span>Criar Notícia</span>
                                    </a>
                                    <a href="midia-upload.php" class="quick-action-btn">
                                        <i class="fas fa-upload"></i>
                                        <span>Upload de Mídia</span>
                                    </a>
                                    <a href="novo-usuario.php" class="quick-action-btn">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Novo Usuário</span>
                                    </a>
                                    <a href="page_config.php" class="quick-action-btn">
                                        <i class="fas fa-cog"></i>
                                        <span>Configurações</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        // Variáveis globais

        // Função principal para toggle da sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const headerToggle = document.getElementById('headerToggle');
            
            if (!sidebar || !mainContent || !headerToggle) {
                console.log('Elementos não encontrados');
                return;
            }
            
            // Verificar se a sidebar está fechada
            const isClosed = sidebar.classList.contains('sidebar-closed');
            console.log('Sidebar fechada:', isClosed);
            
            if (isClosed) {
                // Abrir sidebar
                console.log('Abrindo sidebar...');
                sidebar.classList.remove('sidebar-closed');
                mainContent.classList.remove('main-expanded');
                headerToggle.style.display = 'none';
            } else {
                // Fechar sidebar
                console.log('Fechando sidebar...');
                sidebar.classList.add('sidebar-closed');
                mainContent.classList.add('main-expanded');
                headerToggle.style.display = 'inline-block';
            }
        }
        


        // Função para trocar entidade
        function switchEntity(entidadeId) {
            if (!entidadeId) return;
            
            const select = document.getElementById("entity-select");
            if (select) {
                const originalValue = select.value;
                select.disabled = true;
                
                fetch("backend/api/switch_entity.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        entidade_id: entidadeId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert("Erro ao trocar entidade: " + data.message);
                        select.value = originalValue;
                        select.disabled = false;
                    }
                })
                .catch(error => {
                    console.error("Erro:", error);
                    alert("Erro ao trocar entidade");
                    select.value = originalValue;
                    select.disabled = false;
                });
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const headerToggle = document.getElementById('headerToggle');
            const userMenu = document.getElementById('userMenu');

            // Toggle sidebar (botão da sidebar)
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Botão sidebar clicado');
                    toggleSidebar();
                });
            }
            
            // Toggle sidebar (botão do header)
            if (headerToggle) {
                headerToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Botão header clicado');
                    toggleSidebar();
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
                    const mainContent = document.querySelector('.main-content');
                    const headerToggle = document.getElementById('headerToggle');
                    
                    if (sidebar) {
                        // Forçar sidebar aberta em desktop
                        sidebar.classList.remove('sidebar-closed');
                        mainContent.classList.remove('main-expanded');
                        headerToggle.style.display = 'none';
                    }
                } else {
                    // Em mobile, fechar sidebar
                    const sidebar = document.getElementById('sidebar');
                    const mainContent = document.querySelector('.main-content');
                    const headerToggle = document.getElementById('headerToggle');
                    
                    if (sidebar) {
                        sidebar.classList.add('sidebar-closed');
                        mainContent.classList.add('main-expanded');
                        headerToggle.style.display = 'inline-block';
                    }
                }
            });

            // Calendário
            initCalendar();
        });

        // Função do calendário
        function initCalendar() {
            let currentDate = new Date();
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();

            function renderCalendar() {
                const monthNames = [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ];

                // Atualizar cabeçalho
                document.getElementById('currentMonth').textContent = 
                    `${monthNames[currentMonth]} ${currentYear}`;

                // Calcular primeiro dia do mês
                const firstDay = new Date(currentYear, currentMonth, 1);
                const lastDay = new Date(currentYear, currentMonth + 1, 0);
                const startDate = new Date(firstDay);
                startDate.setDate(startDate.getDate() - firstDay.getDay());

                const calendarDays = document.getElementById('calendar-days');
                calendarDays.innerHTML = '';

                // Gerar dias do calendário
                for (let i = 0; i < 42; i++) {
                    const day = new Date(startDate);
                    day.setDate(startDate.getDate() + i);

                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day';

                    // Verificar se é o dia atual
                    const isToday = day.getDate() === currentDate.getDate() &&
                                   day.getMonth() === currentDate.getMonth() &&
                                   day.getFullYear() === currentDate.getFullYear();

                    // Verificar se é do mês atual
                    const isCurrentMonth = day.getMonth() === currentMonth;

                    if (isToday) {
                        dayElement.classList.add('today');
                    }
                    if (!isCurrentMonth) {
                        dayElement.classList.add('other-month');
                    }

                    dayElement.textContent = day.getDate();
                    calendarDays.appendChild(dayElement);
                }
            }

            // Event listeners para navegação
            document.getElementById('prevMonth').addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar();
            });

            document.getElementById('nextMonth').addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar();
            });

            // Renderizar calendário inicial
            renderCalendar();
        }
    </script>
</body>
</html>