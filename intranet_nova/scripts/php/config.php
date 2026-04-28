<?php

/*CONFIGURAÇÃO DOS DIRETÓRIOS*/
$Croot		 = $_SERVER['DOCUMENT_ROOT'];
$Cupload 	 = "arquivos";
$Cimagem 	 = "imagens";
$Caudio  	 = "audio";
$Cdocumentos = "documentos";
$Cvideos     = "videos";
$Cedital	 = "editais";
$Carquivos   = "arquivos";
$Cdiario	 = "diario";
$Cbanner	 = "banners";
$Cdestaques  = "destaques";
$Ccurriculum = "curriculum";
$Clogoevento = "eventologo";
$CminiPortal = "miniportal";

/*CONFIGURAÇÃO DOS DIRETÓRIOS*/

//Não mexer aqui
$BASE_UPLOAD	 = $Cupload."/";
$path = array
(
"CAMINHO_SITE" 			=> $Croot,
"CAMINHO_UPLOAD"		=> $BASE_UPLOAD,
"UPLOAD_IMAGEM"			=> $BASE_UPLOAD    . $Cimagem      ."/",
"UPLOAD_AUDIO"			=> $BASE_UPLOAD    . $Caudio       ."/",
"UPLOAD_DOCUMENTOS"		=> $BASE_UPLOAD    . $Cdocumentos  ."/",
"UPLOAD_VIDEOS"			=> $BASE_UPLOAD    . $Cvideos 	   ."/",
"UPLOAD_EDITAL"			=> $BASE_UPLOAD	   . $Cedital 	   ."/",
"UPLOAD_ARQUIVOS"		=> $BASE_UPLOAD	   . $Carquivos	   ."/",
"UPLOAD_DIARIO"			=> $BASE_UPLOAD	   . $Cdiario      ."/",
"UPLOAD_BANNER"			=> $BASE_UPLOAD	   . $Cbanner      ."/",
"UPLOAD_DESTAQUE"		=> $BASE_UPLOAD	   . $Cdestaques   ."/",
"UPLOAD_CURRICULUM"		=> $BASE_UPLOAD	   . $Ccurriculum  ."/",
"UPLOAD_EVENTOLOGO"		=> $BASE_UPLOAD	   . $Clogoevento  ."/",
"UPLOAD_MINIPORTAL"		=> $BASE_UPLOAD	   . $CminiPortal  ."/",
);

define("CAMINHO_SITE",$path["CAMINHO_SITE"]);
define("CAMINHO_UPLOAD",$path["CAMINHO_SITE"]);
define("UPLOAD_IMAGEM",$path["UPLOAD_IMAGEM"]);
define("UPLOAD_AUDIO",$path["UPLOAD_AUDIO"]);
define("UPLOAD_DOCUMENTOS",$path["UPLOAD_DOCUMENTOS"]);
define("UPLOAD_VIDEOS",$path["UPLOAD_VIDEOS"]);
define("UPLOAD_EDITAL",$path["UPLOAD_EDITAL"]);
define("UPLOAD_ARQUIVOS",$path["UPLOAD_ARQUIVOS"]);
define("UPLOAD_DIARIO",$path["UPLOAD_DIARIO"]);
define("UPLOAD_BANNER",$path["UPLOAD_BANNER"]);
define("UPLOAD_DESTAQUE",$path["UPLOAD_DESTAQUE"]);
define("UPLOAD_CURRICULUM",$path["UPLOAD_CURRICULUM"]);
define("UPLOAD_MINIPORTAL",$path["UPLOAD_MINIPORTAL"]);
define("UPLOAD_EVENTOLOGO",$path["UPLOAD_EVENTOLOGO"]);

// Links Softplan

//Botoes do detalhe do Servico
define("CONSULTA_PROCESSO_INTERNO","https://servicos.floripa.sc.gov.br/atendimento/atendimento");
define("CONSULTA_PROCESSO","https://servicos.floripa.sc.gov.br/atendimento/atendimento");
define("VERIFICACAO_DOC_ELETRONICO","https://servicos.floripa.sc.gov.br/atendimento/conferencia-documento");

//Consulta de processo do menu
define("CONSULTA_PROCESSO_MENU","https://servicos.floripa.sc.gov.br/atendimento/atendimento");

//Componente de consulta de processo da home/portal de servicos
define("CONSULTA_PROCESSO_POST_URL", "http://portalrastreabilidade.pmf.sc.gov.br/cpa-ptl-pmf");

?>