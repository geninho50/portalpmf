<?php
    ini_set('display_errors', '0');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['login_csrf'])) {
        $_SESSION['login_csrf'] = bin2hex(random_bytes(32));
    }

    if (isset($_POST["btConn_x"])) {
        require_once("../scripts/php/funcoes_bd_ldap.php");
        die();
    }

require_once("../scripts/php/config.php");
require_once("../scripts/php/funcoes_bd.php");
require_once("../scripts/php/funcoes.php");

$caminhoRecuperacao = "../scripts/php/processa_recuperacao.php";
if (file_exists($caminhoRecuperacao)) {
    require_once($caminhoRecuperacao);
} else {
    die("Erro interno: Arquivo processa_recuperacao.php não encontrado.");
}

$drive->conecta();

$manutencao = false;
$acao = $_GET['acao'] ?? 'login';
$mensagemStatus = '';
$statusTipo = 'info';

// Processamento dos formulários POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btn_solicitar_recuperacao'])) {
        $resultado = solicitarRecuperacaoSenha($drive, trim($_POST['matricula_recupera']));
        $mensagemStatus = $resultado['msg'];
        $statusTipo = $resultado['status'] ? 'sucesso' : 'erro';
    } elseif (isset($_POST['btn_redefinir_senha'])) {
        $resultado = redefinirSenha(
            $drive, 
            $_POST['token'], 
            trim($_POST['matricula_confirma']), 
            $_POST['nova_senha'], 
            $_POST['confirmar_senha']
        );
        $mensagemStatus = $resultado['msg'];
        $statusTipo = $resultado['status'] ? 'sucesso' : 'erro';
        if ($resultado['status']) {
            $acao = 'login';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php
    if (!isset($manutencao) || !$manutencao) {
        if (isset($_GET['user'])) {
            echo '
                <script src="../scripts/js/jquery/jquery.js" type="text/javascript"></script>
                <script type="text/javascript" src="controle/usuarios/script_setores.js"></script>
            ';
        }
    }
    ?>
    <title>Prefeitura Municipal de Florianópolis</title>
    <link rel="stylesheet" href="../layout/pmf-estilo.css" type="text/css">
    <link rel="stylesheet" href="../scripts/js/livevalidation/livevalidation13.css" type="text/css">
    <script src="../scripts/js/livevalidation/livevalidation13.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"></link>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="layout_intranet bg-[#eef2f7]">
        <?php $menu_principal = "login"; ?>
        <div style="display:none"><?php echo($menu_principal); ?></div>
        <?php include("../layout/menus/menu_geral.php"); ?>
                
        <div class="flex flex-col md:flex-row max-w-[1350px] mx-auto my-8 px-4 md:px-8 gap-8 overflow-visible max-h-none rounded-[24px]">
            
            <div class="flex-[1.5] w-full max-w-[520px] mx-auto md:mx-0 h-fit rounded-2xl p-6">
                <?php 
                if ($manutencao) {
                    ?>
                    <div class="sf-header flex items-center justify-between border-b border-gray-100 pb-2 mb-6">
                        <span class="sf-title text-2xl font-semibold text-red-600 font-['Outfit',system-ui,sans-serif]" id="titulo_pagina">Acesso Indisponível</span>
                    </div>
                    <div id="margem_direita">
                        <div class="bg-white border rounded-3xl p-8 text-center" style="box-shadow: 0 4px 24px rgba(0, 48, 99, 0.07);">
                            <div class="text-red-500 mb-4">
                                <i class="fa fa-ban text-4xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-blue-950 mb-2 font-['Outfit',system-ui,sans-serif]">Intranet em manutenção</h2>
                            <p class="text-gray-600 text-sm leading-relaxed font-['Outfit',system-ui,sans-serif]">
                                O sistema encontra-se temporariamente bloqueado para manutenções programadas. O acesso será restabelecido em breve.
                            </p>
                        </div>
                    </div>
                    <?php
                } else {
                    if (!$drive->ipLiberado()) {      
                        echo "<div class='sf-header flex items-center justify-between border-b border-gray-100 pb-2 mb-6'>";
                        echo "<span class='sf-title text-xl font-semibold text-red-600' id='titulo_pagina'>Acesso não autorizado!</span>";
                        echo "</div>";
                        echo "<p class='sf-section-label text-sm text-blue-950 mt-4'>Seu IP atual: <strong></strong></p>";
                    } else {

                        if (!empty($mensagemStatus)) {
                            $classeCor = ($statusTipo === 'sucesso') 
                                ? 'bg-green-50 border-green-200 text-green-800' 
                                : 'bg-red-50 border-red-200 text-red-800';
                            echo '<div class="mb-6 p-4 border rounded-2xl text-sm font-[\'Outfit\',system-ui,sans-serif] ' . $classeCor . '">';
                            echo htmlspecialchars($mensagemStatus);
                            echo '</div>';
                        }

                        if ($acao === 'esqueci') {
                            // TELA 1: SOLICITAR RECUPERACAO DE SENHA
                            ?>
                            <div class="sf-header flex items-center justify-between border-b border-gray-100 pb-2 mb-6">
                                <span class="sf-title text-2xl font-semibold text-[#00a3e0] font-['Outfit',system-ui,sans-serif]">Recuperação de Senha</span>
                            </div>
                            <div id="margem_direita">
                                <div class="bg-white border rounded-3xl p-6" style="box-shadow: 0 4px 24px rgba(0, 48, 99, 0.07);">
                                    <form method="post" class="flex flex-col gap-6">
                                        <div class="sf-search-wrap">
                                            <label class="sf-section-label text-[#00a3e0] text-md font-medium uppercase tracking-wider block mb-1 font-['Outfit',system-ui,sans-serif]">Informe sua Matrícula:</label>
                                            <div class="relative">
                                                <input class="sf-search-input bg-white border border-gray-200 w-full py-[10px] px-[14px] rounded-xl text-md placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#00BFFF] focus:border-[#00BFFF] font-['Outfit',system-ui,sans-serif]" 
                                                       placeholder="Digite sua matrícula" 
                                                       name="matricula_recupera" 
                                                       id="matricula_recupera" 
                                                       type="text" required />
                                            </div>
                                        </div>

                                        <div class="sf-btn-ajuste border-t border-gray-100 pt-4 mt-2 flex flex-col gap-3">
                                            <button type="submit" name="btn_solicitar_recuperacao" class="sf-submit-btn bg-blue-950 text-white rounded-3xl w-full p-3 text-lg font-medium font-['Outfit',system-ui,sans-serif] hover:bg-[#00BFFF] focus:outline-none focus:ring-2 focus:ring-[#00BFFF] focus:ring-offset-2 transition-all duration-200 cursor-pointer">Enviar E-mail de Recuperação</button>
                                            <a href="index.php" class="btn text-center rounded-3xl w-full p-3 text-lg font-medium text-gray-500 hover:text-[#00BFFF] font-['Outfit',system-ui,sans-serif] underline mt-1 duration-200 cursor-pointer ">Voltar para o Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        } elseif ($acao === 'redefinir') {
                            // TELA 2: REDEFINICAO DE SENHA COM CONFIRMACAO
                            $tokenURL = $_GET['token'] ?? '';
                            $tokenValido = validarTokenPostgres($drive, $tokenURL);
                            ?>
                            <div class="sf-header flex items-center justify-between border-b border-gray-100 pb-2 mb-6">
                                <span class="sf-title text-2xl font-semibold text-[#00a3e0] font-['Outfit',system-ui,sans-serif]">Redefinir Senha</span>
                            </div>
                            <div id="margem_direita">
                                <div class="bg-white border rounded-3xl p-6" style="box-shadow: 0 4px 24px rgba(0, 48, 99, 0.07);">
                                    <?php if ($tokenValido): ?>
                                        <form method="post" class="flex flex-col gap-5">
                                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($tokenURL); ?>" />
                                            
                                            <!-- CAMPO 1: CONFIRMACAO DE MATRICULA -->
                                            <div class="sf-search-wrap">
                                                <label class="sf-section-label text-[#00a3e0] text-sm font-medium uppercase tracking-wider block mb-1 font-['Outfit',system-ui,sans-serif]">Confirme sua Matrícula:</label>
                                                <input class="sf-search-input bg-white border border-gray-200 w-full py-[10px] px-[14px] rounded-xl text-md placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#00BFFF] focus:border-[#00BFFF] font-['Outfit',system-ui,sans-serif]" 
                                                       placeholder="#####-#" 
                                                       name="matricula_confirma" 
                                                       id="matricula_confirma" 
                                                       type="text" required />
                                            </div>

                                            <!-- CAMPO 2: NOVA SENHA -->
                                            <div class="sf-search-wrap">
                                                <label class="sf-section-label text-[#00a3e0] text-sm font-medium uppercase tracking-wider block mb-1 font-['Outfit',system-ui,sans-serif]">Nova Senha:</label>
                                                <input class="sf-search-input bg-white border border-gray-200 w-full py-[10px] px-[14px] rounded-xl text-md placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#00BFFF] focus:border-[#00BFFF] font-['Outfit',system-ui,sans-serif]" 
                                                       placeholder="Digite sua nova senha" 
                                                       name="nova_senha" 
                                                       id="nova_senha" 
                                                       type="password" required />
                                            </div>

                                            <!-- CAMPO 3: CONFIRMAR NOVA SENHA -->
                                            <div class="sf-search-wrap">
                                                <label class="sf-section-label text-[#00a3e0] text-sm font-medium uppercase tracking-wider block mb-1 font-['Outfit',system-ui,sans-serif]">Confirmar Nova Senha:</label>
                                                <input class="sf-search-input bg-white border border-gray-200 w-full py-[10px] px-[14px] rounded-xl text-md placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#00BFFF] focus:border-[#00BFFF] font-['Outfit',system-ui,sans-serif]" 
                                                       placeholder="Repita a nova senha" 
                                                       name="confirmar_senha" 
                                                       id="confirmar_senha" 
                                                       type="password" required />
                                            </div>

                                            <div class="sf-btn-ajuste border-t border-gray-100 pt-4 mt-2">
                                                <button type="submit" name="btn_redefinir_senha" class="sf-submit-btn bg-blue-950 text-white rounded-3xl w-full p-3 text-lg font-medium font-['Outfit',system-ui,sans-serif] hover:bg-[#00BFFF] focus:outline-none focus:ring-2 focus:ring-[#00BFFF] focus:ring-offset-2 transition-all duration-200 cursor-pointer">Salvar Nova Senha</button>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <p class="text-red-600 text-sm font-['Outfit',system-ui,sans-serif] mb-4">O link de recuperação acessado é inválido, expirou ou atingiu o limite de 3 tentativas.</p>
                                        <a href="index.php?acao=esqueci" class="text-sm text-[#00a3e0] underline font-['Outfit',system-ui,sans-serif]">Solicitar um novo link de recuperação</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        } else {
                            // TELA PADRAO: LOGIN DE USUARIO
                            ?>
                            <div class="sf-header flex items-center justify-between border-b border-gray-100 pb-2 mb-6">
                                <span class="sf-title text-2xl font-semibold text-[#00a3e0] font-['Outfit',system-ui,sans-serif]" id="titulo_pagina">Identificação do Usuário</span>
                            </div>
                            
                            <div id="margem_direita">
                                <div class="bg-white border rounded-3xl p-6" style="box-shadow: 0 4px 24px rgba(0, 48, 99, 0.07);">
                                    <form method="post" class="flex flex-col gap-6">
                                        <input type="hidden" name="btConn_x" id="btConn_x" value="open" />
                                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['login_csrf'], ENT_QUOTES, 'UTF-8'); ?>" />
                                        
                                        <div class="sf-search-wrap">
                                            <label class="sf-section-label text-[#00a3e0] text-md font-medium uppercase tracking-wider block mb-1 font-['Outfit',system-ui,sans-serif]">Matrícula:</label>
                                            <div class="relative">
                                                <input class="sf-search-input bg-white border border-gray-200 w-full py-[10px] px-[14px] rounded-xl text-md placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#00BFFF] focus:border-[#00BFFF] font-['Outfit',system-ui,sans-serif]" 
                                                       placeholder="Digite sua matrícula"  
                                                       name="login" 
                                                       id="login" 
                                                       type="text" />
                                                <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#00BFFF]">
                                                    <i class="fa fa-search p-1 text-xs"></i>
                                                </span>
                                            </div>
                                            <script type="text/javascript">
                                                var login = new LiveValidation('login');
                                                login.add(Validate.Presence, {failureMessage: "Obrigatório"});
                                            </script>
                                        </div>
                                        
                                        <div class="sf-search-wrap">
                                            <label class="sf-section-label text-[#00a3e0] text-md font-medium uppercase tracking-wider block mb-1 font-['Outfit',system-ui,sans-serif]">Senha:</label>
                                            <div class="relative">
                                                <input class="sf-search-input bg-white border border-gray-200 w-full py-[10px] px-[14px] rounded-xl text-md placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#00BFFF] focus:border-[#00BFFF] font-['Outfit',system-ui,sans-serif]" 
                                                       placeholder="Digite sua senha" 
                                                       name="senha" 
                                                       id="senha" 
                                                       type="password" />
                                                <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#00BFFF]">
                                                    <i class="fa fa-search p-1 text-xs"></i>
                                                </span>
                                            </div>
                                            <script type="text/javascript">
                                                var senha = new LiveValidation('senha');
                                                senha.add(Validate.Presence, {failureMessage: "Obrigatório"});
                                            </script>
                                        </div>

                                        <div class="flex justify-end -mt-3">
                                            <a href="index.php?acao=esqueci" class="text-sm font-medium text-[#00a3e0] hover:text-[#00BFFF] transition-all duration-200 cursor-pointer font-['Outfit',system-ui,sans-serif]">Esqueci minha senha</a>
                                        </div>
                                        
                                        <!-- <div class="sf-search-wrap flex justify-center mb-2 rounded-xl">
                                            <div class="g-recaptcha" data-sitekey="6Lf0zBsaAAAAAPaI0ZpJj9u79TjRkLJuOl_d8kr5"></div>
                                        </div> -->
                                        
                                        <div class="sf-btn-ajuste border-t border-gray-100 pt-4 mt-2">
                                            <button type="submit" name="button" class="sf-submit-btn bg-blue-950 text-white rounded-3xl w-full p-3 text-lg font-medium font-['Outfit',system-ui,sans-serif] hover:bg-[#00BFFF] focus:outline-none focus:ring-2 focus:ring-[#00BFFF] focus:ring-offset-2 transition-all duration-200 cursor-pointer">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>

            <div class="flex-1 w-full md:min-w-[345px] h-fit text-center md:text-left mt-6 md:mt-0 pt-10">
                <div class="sf-header">
                    <span class="text-2xl font-semibold text-blue-950">Intranet</span>
                </div>
                <div id="msg_login" class="mt-4 leading-relaxed">
                    <p class="md:text-md text-xl text-blue-950">
                        Acesso exclusivo a administradores do sistema.<br/> 
                        Entre em contato com a <strong>Secretaria do Governo Eletrônico</strong> para mais informações.
                    </p>
                </div>
            </div>
            
        </div>
        
        <?php include("../layout/rodape/rodape.php"); ?>
    </div>

    <!-- <?php if (!$manutencao): ?>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <?php endif; ?> -->
</body>
</html>