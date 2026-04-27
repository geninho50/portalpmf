<?php
// Configuração de erro para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

try {
    session_start();
    // require_once("config/database.php");
    require_once("config/bancoTeste.php");
    require_once("config/compatibility.php");
    require_once("includes/functions.php");
    require_once("includes/menu.php");

    
    // Verificar se está logado
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

    // Buscar entidades para o formulário
    $sql = "SELECT entidade_id, entidade_nome FROM entidades ORDER BY entidade_nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $entidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    error_log("Erro crítico em usuarios.php: " . $e->getMessage());
    die("Erro interno do servidor. Verifique os logs para mais detalhes.");
}
?>

<!--
Notas:
    -Adcionar salvamento de valores do formulado no sql
    -adcionar verificação de gral de acesso para fazere o cadastro
    -adcioanr validação de matricula/email ao cadastro
    -adicionar alerta para que todas as areas do formulario sejam preenchidas
-->


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuário - Intranet PMF</title>
    
    <!-- CSS Moderno -->
    <link rel="stylesheet" href="assets/css/modern.css">
    <link rel="stylesheet" href="assets/css/components.css">

    <!-- Os CSSs extras -->
    <link rel="stylesheet" href="assets/css/CSS_teste.css">
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Trumbowyg CSS --E o que faz os editores da caixa de texto funcionarem -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.28.0/dist/ui/trumbowyg.min.css">

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

        <!--Adciona novo menus com todas as entidades-->
            <nav class="sidebar-nav">
                <ul>
                    <?php echo $menuManager->generateMenu(); ?>
                </ul>
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
                    <h1>Dados do  Usuario</h1>
                    <p>Edite seus dados</p>
                </div>
                    
                    <div class="header-actions">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">0</span>
                        </button>
                        
                        <div class="user-menu">
                            <button class="user-menu-btn">
                                <div class="user-avatar-small">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span><?php echo htmlspecialchars($_SESSION['SuserNome'] ?? 'Usuário'); ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            
                            <div class="user-dropdown">
                                <a href="perfil.php">
                                    <i class="fas fa-user"></i>
                                    <span>Meu Perfil</span>
                                </a>
                                <a href="configuracoes.php">
                                    <i class="fas fa-cog"></i>
                                    <span>Configurações</span>
                                </a>
                                <hr>
                                <a href="logout.php" class="logout-link">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Sair</span>
                                </a>
                            </div>
                        </div>
                    </div>

            </header>

             <!--Escurece a tela-->
            <div class="overlay hidden"></div>

                <!--Modal Exemplo - Visualizar-->
                <section class="modal hidden">
                        <button class="btn-primary" onclick="closeModal()">⨉</button>

                    <!--conteudo modal-->
                    <div class="card form-group">
                        <label class="form-label">
                            <h2>Trocar Senha</h2>
                        </label>
                        <div class="form-row">
                            <div style="flex: 1;">
                                <label class="form-label">Nova senha</label>
                                <input type="password" name="nome" class="form-input" value="" required>

                                <label class="form-label">Confirmar senha</label>
                                <input type="password" name="nome" class="form-input" required> 

                            </div>
                        </div>
                        <div class="form-row">
                            <div style="flex: 1;">
                                <button class="btn-primary" onclick="closeModal()">Salvar</button>
                            </div>
                        </div>
                        <div class="form-footer">
                        </div>
                    </div>
                </section>
            

            <!-- Conteudo da pagina-->
            <div class="dashboard-content">
           
                <!--Nome titular da pagina-->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fa-solid fa-user"></i> Editar Dados dos Ususario</h2> <p><button type="submit" class="btn btn-primary" style="color:#00B1EB" onclick="openModal()">Trocar Senha</button></p>
                    </div>

                    <!--Formulario para novo usuario-->
                    <div class="card-content card-body">
                        <div class="form-container">
                            <form class="form-group">
                                <div class="form-row">
                                    <div style="flex: 3;">
                                        <label class="form-label" > Nome</label>
                                        <input type="text" name="nome" class="form-input" placeholder=<?php echo htmlspecialchars($_SESSION['SuserNome'] ?? 'Usuário'); ?> required>

                                        <label class="form-label">Email</label>
                                        <input type="text" name="mail" class="form-input" placeholder=<?php echo htmlspecialchars($_SESSION['SuserEmail'] ?? 'Email'); ?> required> 

                                        <label class="form-label">Data de Nascimento</label>
                                        <input type="date" name="data" class="form-input" placeholder="<?php echo htmlspecialchars($_SESSION['SuserData'] ?? '10/10/1000'); ?>" required>
                                        
                                        <label class="form-label">Telefone PMF</label>
                                        <input type="numeric" name="tele" class="form-input" placeholder="<?php echo htmlspecialchars($_SESSION['SuserTelefone'] ?? '(00)0000-000'); ?>" required> 

                                        <label class="form-label">Setor</label>
                                        <select type="select" name="setor" class="form-input" required>
                                        <option value="adm">Dev</option>
                                        <option value="s_adm">Intra</option>
                                        <option value="m_adm">Telefonia</option>
                                        </select>

                                        <label class="form-label" >Cargo</label>
                                        <select type="select" name="cargo" class="form-input"  required>
                                        <option value="adm">ADM</option>
                                        <option value="s_adm">ADM MASTER</option>
                                        <option value="m_adm">ADM SUPER</option>
                                        </select>
                                    </div>

                                    <div style="flex: 2;">
                                        <label class="form-label" >Foto</label>
                                        <div id="imagem" class="foto"><img src="https://placehold.co/15x15/EEE/31343C" width= 70%; alt="Placehold" class="header-image"></div>

                                        <label class="form-label">Conteúdo</label>
                                        <textarea name="textocaixa" class="form-input" placeholder="" required rows="1"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer"><button type="submit" class="btn btn-primary">Salvar Alterações</button></div>
                </div>
            </div>
        </main>
    </div>

    <!-- JavaScript -  Funsao para trocar a side bar -->
    <script src ="assets/js/modern.js"></script>
    <script src ="assets/js/scripts_geral.js"></script>


    <!-- Trumbowyg JS -- Cria o menu de edição da caixa de texto -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.28.0/dist/trumbowyg.min.js"></script>

    <script>
        $(function() {
            $('textarea[name="textocaixa"]').trumbowyg({
                btns: [
                    ['undo', 'redo'],
                    ['formatting'],
                    ['bold', 'italic', 'underline'],
                    ['link'],
                    ['unorderedList', 'orderedList'],
                    ['removeformat']
                ]
            });
        });
    </script>

</body>
</html>
