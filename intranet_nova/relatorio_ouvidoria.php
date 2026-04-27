<?php
// Configuração de erro para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

try {
    session_start();
    require_once("config/database.php");
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
    <style>
        
    </style>


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
                    <h1>Relatorio Ouvidoria</h1>
                    <p>Adcionar Novo Relatorio</p>
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
                               <a href="usuariodados.php">
                                    <i class="fas fa-user"></i>
                                    Meu Perfil
                                </a>
                                <a href="page_config.php">
                                    <i class="fas fa-cog"></i>
                                    Configurações
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


 <div class="overlay hidden"></div>

            <!--Modal Exemplo - Visualizar-->
            <dialog id="modal_um" class="modal hidden">
                <button class="btn" onclick="closeModal()">⨉</button>

                <!--conteudo modal 1-->
                <div  class="card form-group">
                    <label class="form-label">
                        <h2>Relatorios</h2>
                    </label>
                    <div class="form-row">
                        <div style="flex: 1;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><a href="#">Relatorio 1</a></td>
                                        <td>2024</td>
                                        <td>Janeiro</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><a href="#">Relatorio 2</a></td>
                                        <td>2024</td>
                                        <td>fevereiro</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><a href="#">Relatorio 3</a></td>
                                        <td>2024</td>
                                        <td>Março</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                   
                                </tbody>
                            </table>

                        </div>
                    </div>
                    
                    <div class="form-footer">
                    </div>
                </div>
            </dialog>



            <!-- Conteudo da pagina-->
            <div class="dashboard-content">
           
            <!--Nome titular da pagina-->
                <div class="card card-size">
                    <div class="card-header">
                        <h2><i class="fa-solid fa-user"></i>Relatorio</h2>

                        <button class="btn btn-primary" onclick="openModal(1)">Acessar Lista de Relatorios</button>
                </div>

                    <!--Formulario Novo relatorio-->
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-container">
                                <div class="form-group">
                                    <!--titulo do relatorio-->
                                    <div class="form-row" >
                                       <div style="flex: 4;">
                                            <label class="form-label" >Titulo</label>
                                            <input type="text" name="nome" class="form-input" placeholder="Relatorio ... " required>
                                        </div>
                                        <div style="flex: 1;">
                                            <label class="form-label ">Arquivo</label>
                                            <input type="file" id="input-file" accept="image/*,.pdf,.doc,.docx" hidden>
                                            <label for="input-file" class="btn custom-file">Upload</label>
                                        </div>
                                    </div>

                                    <!--mes | ano |arquivo do relatorio-->
                                    <div class="form-row" >
                                        <div style="flex: 2;">
                                            <label class="form-label">Mes</label>
                                            <select type="select" name="nome" class="form-input" placeholder="ADM" required>
                                            <option value="m1">Janeiro</option>
                                            <option value="m2">Fevereiro</option>
                                            <option value="m3">Março</option>
                                            <option value="m4">Abril</option>
                                            <option value="m5">Maio</option>
                                            <option value="m6">Junho</option>
                                            <option value="m7">Julho</option>
                                            <option value="m8">Agosto</option>
                                            <option value="m9">Setembro</option>
                                            <option value="m10">Outubro</option>
                                            <option value="m11">Novembro</option>
                                            <option value="m12">Dezembro</option>
                                            </select>
                                        </div>
                                        <div style="flex: 2;">
                                            <label class="form-label">Ano</label>
                                            <input type="text" name="nome" class="form-input" placeholder="0000" required>
                                        </div>

                                        <div style="flex: 1;">
                                            <button class="btn btn-primary">Salvar</button>
                                        </div>
                                    </div>
                                    <!--Botao de salvar-->
                                </div>
                            </form>
                        </div>
                    </div>
                    
            </div>
            
        </main>
    </div>

  
<script src ="scripts/scripts_geral.js"></script>
<script src="assets/js/modern.js"></script>
    
</body>
</html>
