<?php
session_start();
require_once("config/database.php");
require_once("config/compatibility.php");
require_once("includes/functions.php");
require_once("includes/menu.php");

// Verificar se está logado
requireLogin();

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

        // Verificar permissão de acesso
    // if (!$menuManager->hasAccess('form_radio2')) {
    //     header("Location: index.php?error=no_permission");
    //     exit();
    // }

    // Buscar entidades para o formulário
    $sql = "SELECT entidade_id, entidade_nome FROM entidades ORDER BY entidade_nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $entidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Processar upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] === UPLOAD_ERR_NO_FILE) {
            throw new Exception('Nenhum arquivo foi selecionado.');
        }
        
        $file = $_FILES['arquivo'];
        $nome = sanitizeInput($_POST['nome'] ?? '');
        $descricao = sanitizeInput($_POST['descricao'] ?? '');
        $tipo = sanitizeInput($_POST['tipo'] ?? '');
        
        if (empty($nome)) {
            throw new Exception('Nome é obrigatório.');
        }
        
        // Upload do arquivo
        $uploadDir = 'uploads/midias/';
        $fileName = uploadFile($file, $uploadDir);
        
        // Determinar tipo de arquivo
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
        $audioExtensions = ['mp3', 'wav', 'ogg'];
        
        if (in_array($fileExtension, $imageExtensions)) {
            $detectedType = 'imagem';
        } elseif (in_array($fileExtension, $videoExtensions)) {
            $detectedType = 'video';
        } elseif (in_array($fileExtension, $audioExtensions)) {
            $detectedType = 'audio';
        } else {
            $detectedType = 'documento';
        }
        
        // Usar tipo detectado se não foi especificado
        if (empty($tipo)) {
            $tipo = $detectedType;
        }
        
        // Inserir no banco
        $sql = "INSERT INTO midias (nome, descricao, tipo, url, tamanho, usuario_id, data_upload) 
                VALUES (:nome, :descricao, :tipo, :url, :tamanho, :usuario_id, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':tipo' => $tipo,
            ':url' => $uploadDir . $fileName,
            ':tamanho' => $file['size'],
            ':usuario_id' => $user['id']
        ]);
        
        // Registrar log
        logAction($user['id'], 'upload_midia', "Upload de mídia: {$nome}");
        
        $success = 'Mídia enviada com sucesso!';

        $sql = "SELECT entidade_id, entidade_nome FROM entidades ORDER BY entidade_nome";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $entidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Mídia - Intranet PMF</title>
    
    <!-- CSS Moderno -->
    <link rel="stylesheet" href="assets/css/modern.css">
    <link rel="stylesheet" href="assets/css/components.css">

    <!-- Css para testes -->
     <link rel="stylesheet" href="assets/css/CSS_teste.css">
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--secondary-200);
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }
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

            <!--Arrumar aqui-->
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
                        <span class="user-name"><?php echo htmlspecialchars($user['nome']); ?></span>
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
                    <h1>Upload de Mídia</h1>
                    <p>Envie imagens, vídeos, áudios e documentos</p>
                </div>
                
                <div class="header-right">
                    <a href="midias.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Voltar
                    </a>
                </div>
            </header>

            <!-- Content -->
            <div class="dashboard-content">
                <div class="upload-container">
                    <?php if ($error): ?>
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            <?php echo htmlspecialchars($success); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data" id="uploadForm">
                        <!-- Área de Upload -->
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                Arraste e solte arquivos aqui
                            </div>
                            <div class="upload-hint">
                                ou clique para selecionar arquivos
                            </div>
                            <input type="file" name="arquivo" id="fileInput" style="display: none;" accept="image/*,video/*,audio/*,.pdf,.doc,.docx">
                        </div>

                        <!-- Preview do Arquivo -->
                        <div class="file-preview" id="filePreview">
                            <div class="file-info">
                                <div class="file-icon" id="fileIcon">
                                    <i class="fas fa-file"></i>
                                </div>
                                <div class="file-details">
                                    <h4 id="fileName">Nome do arquivo</h4>
                                    <p id="fileSize">Tamanho do arquivo</p>
                                </div>
                                <img id="imagePreview" class="image-preview" style="display: none;">
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" id="progressFill"></div>
                            </div>
                        </div>

                        <!-- Formulário de Dados -->
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nome" class="form-label">Nome da Mídia *</label>
                                <input type="text" id="nome" name="nome" class="form-input" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select id="tipo" name="tipo" class="form-select">
                                    <option value="">Detectar automaticamente</option>
                                    <option value="imagem">Imagem</option>
                                    <option value="video">Vídeo</option>
                                    <option value="audio">Áudio</option>
                                    <option value="documento">Documento</option>
                                </select>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea id="descricao" name="descricao" class="form-textarea" placeholder="Descreva o conteúdo da mídia..."></textarea>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='midias.php'">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                <i class="fas fa-upload"></i>
                                Enviar Mídia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>

    <!-- JavaScript -->
    <script>
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
    });

</script>


    <script src="assets/js/modern.js"></script>
    <script>
        // Elementos do DOM
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const fileIcon = document.getElementById('fileIcon');
        const imagePreview = document.getElementById('imagePreview');
        const submitBtn = document.getElementById('submitBtn');
        const nomeInput = document.getElementById('nome');
        const tipoSelect = document.getElementById('tipo');

        // Eventos de drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });

        // Clique na área de upload
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Mudança no input de arquivo
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFile(e.target.files[0]);
            }
        });

        // Função para lidar com o arquivo
        function handleFile(file) {
            // Validar tamanho (máximo 50MB)
            const maxSize = 50 * 1024 * 1024;
            if (file.size > maxSize) {
                showToast('Arquivo muito grande. Máximo 50MB.', 'error');
                return;
            }

            // Validar tipo
            const allowedTypes = [
                'image/jpeg', 'image/png', 'image/gif', 'image/webp',
                'video/mp4', 'video/avi', 'video/mov', 'video/wmv',
                'audio/mp3', 'audio/wav', 'audio/ogg',
                'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];

            if (!allowedTypes.includes(file.type)) {
                showToast('Tipo de arquivo não suportado.', 'error');
                return;
            }

            // Mostrar preview
            showFilePreview(file);

            // Habilitar botão de envio
            submitBtn.disabled = false;

            // Preencher nome automaticamente
            if (!nomeInput.value) {
                nomeInput.value = file.name.replace(/\.[^/.]+$/, '');
            }

            // Detectar tipo automaticamente
            if (!tipoSelect.value) {
                detectFileType(file);
            }
        }

        // Função para mostrar preview do arquivo
        function showFilePreview(file) {
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);

            // Determinar ícone baseado no tipo
            const fileType = file.type.split('/')[0];
            let iconClass = 'fas fa-file';

            if (fileType === 'image') {
                iconClass = 'fas fa-image';
                showImagePreview(file);
            } else if (fileType === 'video') {
                iconClass = 'fas fa-video';
                hideImagePreview();
            } else if (fileType === 'audio') {
                iconClass = 'fas fa-music';
                hideImagePreview();
            } else {
                hideImagePreview();
            }

            fileIcon.innerHTML = `<i class="${iconClass}"></i>`;
            filePreview.style.display = 'block';
        }

        // Função para mostrar preview de imagem
        function showImagePreview(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        // Função para esconder preview de imagem
        function hideImagePreview() {
            imagePreview.style.display = 'none';
        }

        // Função para detectar tipo de arquivo
        function detectFileType(file) {
            const fileType = file.type.split('/')[0];
            const typeMap = {
                'image': 'imagem',
                'video': 'video',
                'audio': 'audio'
            };
            
            if (typeMap[fileType]) {
                tipoSelect.value = typeMap[fileType];
            } else {
                tipoSelect.value = 'documento';
            }
        }

        // Função para formatar tamanho do arquivo
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Simular progresso de upload
        function simulateProgress() {
            const progressFill = document.getElementById('progressFill');
            let progress = 0;
            
            const interval = setInterval(() => {
                progress += Math.random() * 10;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                }
                progressFill.style.width = progress + '%';
            }, 100);
        }

        // Evento de submit do formulário
        document.getElementById('uploadForm').addEventListener('submit', (e) => {
            if (!fileInput.files.length) {
                e.preventDefault();
                showToast('Por favor, selecione um arquivo.', 'error');
                return;
            }

            // Simular progresso
            simulateProgress();
            
            // Desabilitar botão
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
        });
    </script>
</body>
</html>
