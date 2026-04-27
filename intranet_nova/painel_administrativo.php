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

    // // Verificar permissão de acesso
    // if (!$menuManager->hasAccess('noticias')) {
    //     header("Location: index.php?error=no_permission");
    //     exit();
    // }


} catch (Exception $e) {
     error_log("Erro crítico em noticias.php: " . $e->getMessage());
     die("Erro interno do servidor. Verifique os logs para mais detalhes.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Notícias - Intranet PMF</title>
    
    <!-- CSS Moderno -->
    <link rel="stylesheet" href="assets/css/modern.css">
    <link rel="stylesheet" href="assets/css/components.css">

    <!-- Os CSSs extras -->
    <link rel="stylesheet" href="assets/css/CSS_teste.css">

    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> adciona o visual dos menus noticias-->
    
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
                    <button class="header-toggle" id="headerToggle" style="display: none;"> <!--Faz a troca no side bar-->
                        <i class="fas fa-bars"></i>
                    </button>  
                    <h1>Painel Administrativo</h1>
                    <p>Adicione e Edite entidades</p>
                </div>
                
                <!--barra de pesquisa de noticias-->
                <div class="header-right">
                    
                    <!--Icone de notificação-->
                    <div class="header-actions">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <!--faixa do usuario-->
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
                </div>
            </header>

            <!--Escurece a tela-->
            <div class="overlay hidden"></div>

            <!--Modal Exemplo - Visualizar-->
            <dialog id="modal_um" class="modal hidden">
                <button id="fecharModal" class="btn" >⨉</button>

                <!--conteudo modal 1-->
                <div  id="1" class="card form-group" style="display:none">
                    <label class="form-label">
                        <h2>Configurar Permissoes</h2>
                    </label>
                    <div class="form-row">
                        <div style="flex: 1;">
                            <label class="form-label"><h3>Entidade</h3>
                            <select name="categoria" class="form-input">
                                <option value="">Prefeitura</option>
                                <option value="">Controladoria Geral do Municipio</option>
                                <option value="">Gabinete do Prefeito</option>
                                <option value="">Pagina Home</option>
                            </select>

                        </div>
                        <div style="flex: 1;">
                            <label class="form-label"><h3>Nivel de Acesso</h3>
                            <select name="categoria" class="form-input">
                                <option value="">ADM</option>
                                <option value="">ADM tester</option>
                                <option value="">ADM Master</option>
                                <option value="">Super ADM</option>
                            </select>

                        </div>
                    </div>
                    
                    <div class="form-footer">
                    </div>
                </div>

                <!--conteudo modal 2-->
                <div id="2" class="card form-group" style="display:none">
                    <label class="form-label">
                        <h2>Editar Menu</h2>
                    </label>
                    <div class="form-row">
                        <div style="flex: 1;">
                            <label class="form-label">Nome Entidade</label>
                            <input type="text" class="form-input" placeholder="Nome entidade" required>

                            <input class="radioEscolhas" type="radio" id="radioV1"  name="liberar" onclick="revelar(true)" checked> <label class="radio-label" for="radioV1">Sub-Menu</label>
                            <input class="radioEscolhas" type="radio" id="radioV2" name="liberar" onclick="revelar(false)"> <label class="radio-label" for="radioV2">Pagina</label>

                            <input type="text" class="form-input opcao1"  placeholder="Endereço ex: index.php" required>
                            <input type="text" class="form-input opcao2 hidden"  placeholder="Link ex: https//: site.local.com" required>
                        </div>
                    </div>
                    
                    <div class="form-footer">
                    </div>
                </div>
            </dialog>

            <!-- Content -->
            <div class="dashboard-content">
                <div class="card text-center" >
                    <!--Abas do Menus-->
                    <div class="menu-nav-bootstrap">
                        <ul class="nav nav-tabs mb-4" id="main1">

                            <li class="nav-item main-item">
                                <h3><a id="1menu" class="nav-link active" aria-current="page" href="#" onclick="trocaMenu(1)">Entidade</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="2menu" class="nav-link" href="#" onclick="trocaMenu(2)">Usuarios</a></h3>
                            </li>
                            <li class="nav-item main-item">
                                <h3><a id="3menu" class="nav-link" href="#" onclick="trocaMenu(3)">Configurações</a></h3>
                            </li>

                        </ul>
                    </div>

                    <!--Entidades-->
                    <div id="1new-menu" style="display:block">
                        <div class="card text-center" >
                            <!--Abas do Menu Noticias-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-2">
                                    <li class="nav-item">
                                        <h3><a id="1submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(1)">Consultar</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="2submenu" class="nav-link" href="#" onclick="trocarSubMenu(2)">Incluir</a></h3>
                                    </li>
                                </ul>
                            </div>

                            <!--Consultar Entidades -->
                            <div id="1new-submenu" style="display:block">
                                <div class="card card-size">
                                    <div class="card-body">

                                        <table class="table table-container">
                                            <tbody>
                                                <caption class="titulo-tabela"><h3>Prefeitura</h3></caption>
                                                <tr>
                                                    <td>Nome da Entidade</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Nome da Entidade 2</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
        

                                                <caption class="titulo-tabela"><h3>Secretaria Municipal</h3></caption>
                                                <tr>
                                                    <td>Nome da Entidade</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Nome da Entidade 2</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
        

                                                <caption class="titulo-tabela"><h3>Secretaria Executiva</h3></caption>
                                                <tr>
                                                    <td>Nome da Entidade</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nome da Entidade 2</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <caption class="titulo-tabela"><h3>Superintendencia</h3></caption>
                                                <tr>
                                                    <td>Nome da Entidade</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Nome da Entidade 2</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
        

                                                <caption class="titulo-tabela"><h3>Conselhos</h3></caption>
                                                <tr>
                                                    <td>Nome da Entidade</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Nome da Entidade 2</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <caption class="titulo-tabela"><h3>Orgãos</h3></caption>
                                                <tr>
                                                    <td>Nome da Entidade</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Nome da Entidade 2</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <caption class="titulo-tabela"><h3>Eventos</h3></caption>
                                                <tr>
                                                    <td>Nome da Entidade</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Nome da Entidade 2</td>
                                                    <td>Sigla</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                            <!-- Incluir Entidades -->
                            <div id="2new-submenu" style="display:none;">
                                <div class="card card-size">
                                    <div class="card-body">
                                        <form method="POST" action="?action=add">
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div style="flex: 3;">
                                                        <label class="form-label">Nome Entidade</label>
                                                        <input type="text" class="form-input" placeholder="Nome entidade" required>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Sigla</label>
                                                        <input type="text"  class="form-input" placeholder="Sigla" required>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Tipo entidade</label>
                                                        <select name="categoria" class="form-input">
                                                            <option value="">Prefeitura</option>
                                                            <option value="">Secretaria Municipal</option>
                                                            <option value="">Secretaria Executiva</option>
                                                            <option value="">Superintedencia</option>
                                                            <option value="">Conselho</option>
                                                            <option value="">Orgãos</option>
                                                            <option value="">Eventos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div style="flex: 3;">
                                                        <label class="form-label">Nome de Exibição</label>
                                                        <input type="text" class="form-input" placeholder="Nome entidade" required>
                                                        
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Telefone</label>
                                                        <input type="tel"  class="form-input" placeholder="(00)0000-000">
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Fax</label>
                                                        <input type="tel"  class="form-input" placeholder="(00)0000-000">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-row">


                                                    <div style="flex: 3;">
                                                        <label class="form-label">E-mail</label>
                                                        <input type="email"  class="form-input" placeholder="pmf.sc.gov.br">
                                                    </div>
                                                    <div style="flex: 2;">

                                                        <label class="form-label">Organograma</label>
                                                        <input type="file" id="input-file" hidden>
                                                        <label for="input-file" class="btn custom-file">Upload</label>
                                                    </div>
                                                    </div>
                                                <div class="form-row">
                                                    <div style="flex: 1;">
                                                        <label class="form-label">Possui um site?</label>
                                                        <input class="radioEscolhas" type="radio" id="radioLI"  name="liberar" onclick="revelar(true)" checked> <label class="radio-label" for="radioLI">Sim</label>
                                                        <input class="radioEscolhas" type="radio" id="radioLE" name="liberar" onclick="revelar(false)"> <label class="radio-label" for="radioLE">Não</label>
                                                    </div>
                                                    <div style="flex: 3;">
                                                        <input type="text" class="form-input opcao1" value="pmf.sc.gov/">
                                                        <input type="text" class="form-input opcao2 hidden" placeholder="site@site.lugar.br">
                                                    </div>
                                                </div>

                                        

                                                <div class="form-row">
                                                    <div style="flex: 6;">
                                                        <label class="form-label">Habilitar Serviços</label>
                                                        <input class="radioEscolhas" type="checkbox" id="radio1"  name="liberar"> <label class="radio-label" for="radio1">Entidade</label>
                                                        <input class="radioEscolhas" type="checkbox" id="radio2"  name="liberar"> <label class="radio-label" for="radio2">Gestão</label>
                                                        <input class="radioEscolhas" type="checkbox" id="radio3"  name="liberar"> <label class="radio-label" for="radio3">Serviços</label>
                                                        <input class="radioEscolhas" type="checkbox" id="radio4"  name="liberar"> <label class="radio-label" for="radio4">Noticias</label>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB">Criar Entidade</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Usuarios -->
                    <div id="2new-menu" style="display:none"> 
                       <!-- Actions -->
                        <div class="card text-center" >
                                
                            <!--Abas do submenus-->
                            <div class="menu-nav-bootstrap">
                                <ul class="nav nav-tabs  mb-2">
                                    
                                    <li class="nav-item">
                                        <h3><a id="3submenu" class="nav-link active" aria-current="page" href="#" onclick="trocarSubMenu(3)">Perfil</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="4submenu" class="nav-link" href="#" onclick="trocarSubMenu(4)">Permissões</a></h3>
                                    </li>
                                    <li class="nav-item">
                                        <h3><a id="5submenu" class="nav-link" href="novo-usuario.php" >Cadastro</a></h3>
                                    </li>
                                </ul>
                            </div>
                            <!--Perfil-->
                            <div id="3new-submenu" class="NN1" style="display:block;">
                                <div class="card table-container">

                                    <div id="base_um" class="card-body opcao2">
                                    <!--Listra de menus-->
                                        <table class="table" >
                                            <thead>
                                                <tr>
                                                    <th>Nome da Permissão</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>ADM</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" title="Editar" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ADM Master Tester</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" title="Editar" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ADM Total</td>
                                                    <td>
                                                    <button class="btn btn-sm btn-outline-warning" title="Editar" onclick=""><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-primary" style="color:#00B1EB" onclick="revelar(true)">Incluir Acesso</button>
                                    </div>

                                    <div id="base_dois" class="card-body opcao1 hidden">
                                        <div class="form-group" >
                                            <div class="form-row">
                                                <div style="flex: 4;">
                                                    <label class="form-label">Nome do nivel de acesso</label>
                                                    <input type="text" class="form-input" placeholder="Nome do acesso" required>
                                                </div>
                                                <div style="flex: 1;">
                                                <button type="submit" class="btn btn-primary" style="color:#00B1EB" onclick="revelar(false)">Salvar</button>
                                                <button type="submit" class="btn btn-primary" style="color:#00B1EB" onclick="revelar(false)">Cancelar</button>
                                                </div>
                                            </div>

                                            <table class="table">
                                                <tbody>
                                                    <caption class="titulo-tabela"><h3>Portal Intranet</h3></caption>
                                                    <tr>
                                                        <td><input type="radio" id="radio1"> <label class="radio-label" for="radio1">Meus dados</label></td> 
                                                        <td>Alterar Perfil</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="radio" id="radio1"> <label class="radio-label" for="radio1">Meus dados</label></td> 
                                                        <td>Alterar Senha</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="radio" id="radio1"> <label class="radio-label" for="radio1">Painel Administrativo</label></td> 
                                                        <td>Consultar Entidade</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="radio" id="radio1"> <label class="radio-label" for="radio1">Painel Administrativo</label></td> 
                                                        <td>Incluir Entidade</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="radio" id="radio1"> <label class="radio-label" for="radio1">Personalizar Site</label></td> 
                                                        <td>Incluir Pagina</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="radio" id="radio1"> <label class="radio-label" for="radio1">Personalizar Site</label></td> 
                                                        <td>Editar Pagina</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                           
                            <!--Permissoes-->
                            <div id="4new-submenu" class="NN2" style="display:none">
                                <div class="card table-container">
                                    <div id="permissao_um" class="card-body" style="display:block">
                                        <form class="form-group">
                                            <div class="form-row">
                                                <div style="flex: 4;">
                                                    <label class="form-label" >Buscar</label>
                                                    <input type="text" class="form-input" placeholder="Nome ou matricula" value="Nome do Usuario" required>
                                                </div>
                                                <div style="flex: 4;">
                                                    <button type="submit" class="btn btn-primary" style="color:#00B1EB" onclick="revelar(true)">Salvar</button>
                                                </div>
                                            </div>
                                        </form>

                                        <table id="lista_usuarios" class="table opcao1 hidden">
                                            <div class="card-header">
                                                <h3 class="card-title">Permissões</h3>
                                            </div>
                                            <tbody>
                                                <tr>
                                                    <td>Matricula</td>
                                                    <td>Nome do Usuario</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-warning" title="Adicionar" onclick="adicionarPermissao(true)"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="permissao_dois" class="card-body" style="display:none">
                                        <div class="card-header">
                                            <h3 class="card-title">Permissões</h3>
                                        </div>

                                        <table class="table">
                                        <tbody>
                                            
                                            <tr>
                                                <td>Nome</td>
                                                <td>Nivel de Acesso</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nome Um</td>
                                                <td>Nivel de Acesso</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nome Dois</td>
                                                <td>Nivel de Acesso</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        </table>

                                        <div class="form-row">
                                            <div style="flex: 1;">
                                                <button type="submit" class="btn btn-primary" style="color:#00B1EB" onclick="openModal(1)">Incluir Permisão</button>
                                                <button type="submit" class="btn btn-primary" style="color:#00B1EB" onclick="adicionarPermissao(false)">Retornar</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                             <!--Cadastros vai para outra pagina-->
                            <div id="5new-submenu" class="NN2" style="display:none"></div>

                        </div>
                    </div>

                     <!-- Configurações -->
                    <div id="3new-menu" style="display:none"> 
                            <div class="card">
                                <div class="card-body" style="display:block">
                                    <table class="table" >
                                        <thead>
                                            <tr>
                                                <th>.</th>
                                                <th>Nome do Menu</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                <td>Dashbord</td>
                                                <td>
                                                <button class="btn btn-sm btn-outline-warning" title="Editar" onclick="openModal(2)"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Submenu" onclick=""><i class="fa-solid fa-folder-open"></i></button>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                <td>Meus dados</td>
                                                <td>
                                                <button class="btn btn-sm btn-outline-warning" title="Editar" onclick="openModal(2)"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Submenu" onclick=""><i class="fa-solid fa-folder-open"></i></button>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                <td>Painel Administrativo</td>
                                                <td>
                                                <button class="btn btn-sm btn-outline-warning" title="Editar"onclick="openModal(2)"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Submenu" onclick=""><i class="fa-solid fa-folder-open"></i></button>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td><i class="fa-solid fa-arrows-up-down-left-right"></i></td>
                                                <td>Midias</td>
                                                <td>
                                                <button class="btn btn-sm btn-outline-warning" title="Editar" onclick="openModal(2)"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Excluir" onclick="alertaExcluit()"><i class="fas fa-trash"></i></button>
                                                <button class="btn btn-sm btn-outline-danger" title="Submenu" onclick=""><i class="fa-solid fa-folder-open"></i></button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary" style="color:#00B1EB" onclick="">Adicionr Menu</button>
                                </div>
                            </div>

                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src ="assets/js/modern.js"></script>
    <script src ="assets/js/scripts_geral.js"></script>

    <!--troca submenu, interno no menu ativo-->
    <script>
        function trocaMenu(local) {
            //limpa todas as seleções e displays
            for (let i = 1; i <=3; i++) {
                document.getElementById(i + 'menu').classList.remove('active');
                document.getElementById(i + 'new-menu').style.display = 'none';
            }
            //ativa quem for selecionado
            document.getElementById(local + 'menu').classList.add('active');
            document.getElementById(local + 'new-menu').style.display = 'block';
        }

        function trocarSubMenu(valor){
            let a, b;

            //depedendo da pagina, esse if muda o loop para remover valores nas areas corretas.
            if (valor <= 2){ a = 1; b = 2; }
            else if (valor <= 5){ a = 3; b = 5; }

            //limpa todas as seleções e displays
            for (let i = a; i <= b; i++) {
                document.getElementById( i + 'submenu').classList.remove('active');
                document.getElementById( i + 'new-submenu').style.display = 'none';
            }
            //ativa quem for selecionado
            document.getElementById(valor + 'submenu').classList.add('active');
            document.getElementById(valor + 'new-submenu').style.display = 'block';
        }
        
    </script>

    <!-- Trumbowyg JS -- Cria o menu de edição da caixa de texto -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.28.0/dist/trumbowyg.min.js"></script>

</body>
</html>