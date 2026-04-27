<?php
/**
 * Configuração de Compatibilidade com Sistema Atual
 * Este arquivo mantém a compatibilidade com as tabelas e estrutura existentes
 */

// Incluir arquivos do sistema antigo primeiro
require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/config.php");

// Instância global do banco (sistema antigo)
$drive = new banco("127.0.0.1", "5432", "postgres", "#Pmf@48", "portal_pmf");

// Configurações de diretórios (sistema atual)
$Croot       = $_SERVER['DOCUMENT_ROOT'];
$Cupload     = "arquivos";
$Cimagem     = "imagens";
$Caudio      = "audio";
$Cdocumentos = "documentos";
$Cvideos     = "videos";
$Cedital     = "editais";
$Carquivos   = "arquivos";
$Cdiario     = "diario";
$Cbanner     = "banners";
$Cdestaques  = "destaques";
$Ccurriculum = "curriculum";
$Clogoevento = "eventologo";

$BASE_UPLOAD = $Cupload."/";
$path = array(
    "CAMINHO_SITE" => $Croot,
    "CAMINHO_UPLOAD" => $BASE_UPLOAD,
    "UPLOAD_IMAGEM" => $BASE_UPLOAD . $Cimagem ."/",
    "UPLOAD_AUDIO" => $BASE_UPLOAD . $Caudio ."/",
    "UPLOAD_DOCUMENTOS" => $BASE_UPLOAD . $Cdocumentos ."/",
    "UPLOAD_VIDEOS" => $BASE_UPLOAD . $Cvideos ."/",
    "UPLOAD_EDITAL" => $BASE_UPLOAD . $Cedital ."/",
    "UPLOAD_ARQUIVOS" => $BASE_UPLOAD . $Carquivos ."/",
    "UPLOAD_DIARIO" => $BASE_UPLOAD . $Cdiario ."/",
    "UPLOAD_BANNER" => $BASE_UPLOAD . $Cbanner ."/",
    "UPLOAD_DESTAQUE" => $BASE_UPLOAD . $Cdestaques ."/",
    "UPLOAD_CURRICULUM" => $BASE_UPLOAD . $Ccurriculum ."/",
    "UPLOAD_EVENTOLOGO" => $BASE_UPLOAD . $Clogoevento ."/"
);

// Definir constantes (apenas se não estiverem definidas)
if (!defined("CAMINHO_SITE")) define("CAMINHO_SITE", $path["CAMINHO_SITE"]);
if (!defined("CAMINHO_UPLOAD")) define("CAMINHO_UPLOAD", $path["CAMINHO_SITE"]);
if (!defined("UPLOAD_IMAGEM")) define("UPLOAD_IMAGEM", $path["UPLOAD_IMAGEM"]);
if (!defined("UPLOAD_AUDIO")) define("UPLOAD_AUDIO", $path["UPLOAD_AUDIO"]);
if (!defined("UPLOAD_DOCUMENTOS")) define("UPLOAD_DOCUMENTOS", $path["UPLOAD_DOCUMENTOS"]);
if (!defined("UPLOAD_VIDEOS")) define("UPLOAD_VIDEOS", $path["UPLOAD_VIDEOS"]);
if (!defined("UPLOAD_EDITAL")) define("UPLOAD_EDITAL", $path["UPLOAD_EDITAL"]);
if (!defined("UPLOAD_ARQUIVOS")) define("UPLOAD_ARQUIVOS", $path["UPLOAD_ARQUIVOS"]);
if (!defined("UPLOAD_DIARIO")) define("UPLOAD_DIARIO", $path["UPLOAD_DIARIO"]);
if (!defined("UPLOAD_BANNER")) define("UPLOAD_BANNER", $path["UPLOAD_BANNER"]);
if (!defined("UPLOAD_DESTAQUE")) define("UPLOAD_DESTAQUE", $path["UPLOAD_DESTAQUE"]);
if (!defined("UPLOAD_CURRICULUM")) define("UPLOAD_CURRICULUM", $path["UPLOAD_CURRICULUM"]);
if (!defined("UPLOAD_EVENTOLOGO")) define("UPLOAD_EVENTOLOGO", $path["UPLOAD_EVENTOLOGO"]);

/**
 * Estrutura das Tabelas Atuais:
 * 
 * uni_usuarios:
 * - user_id (SERIAL PRIMARY KEY)
 * - user_nome (VARCHAR)
 * - user_senha (VARCHAR) - MD5
 * - user_login (VARCHAR)
 * - user_fone (VARCHAR)
 * - user_entidade_id (INTEGER)
 * - user_grupo_id (INTEGER)
 * - user_setor_id (INTEGER)
 * - user_cargo_id (INTEGER)
 * - user_data_nascimento (DATE)
 * - user_maticula (VARCHAR)
 * - user_email (VARCHAR)
 * - user_cpf (VARCHAR)
 * 
 * intranet_permissoes:
 * - intranet_perm_id (SERIAL PRIMARY KEY)
 * - intranet_user_id (INTEGER)
 * - intranet_perfil_id (INTEGER)
 * - intranet_entidade_id (INTEGER)
 * 
 * intranet_perfil:
 * - intranet_perfil_id (SERIAL PRIMARY KEY)
 * - intranet_perfil_nome (VARCHAR)
 * 
 * entidades:
 * - entidade_id (SERIAL PRIMARY KEY)
 * - entidade_nome (VARCHAR)
 * 
 * grupo:
 * - grupo_id (SERIAL PRIMARY KEY)
 * - grupo_nome (VARCHAR)
 */
?>
