<?php
//--------------------------------------------
// Scripts que serão utilizados para inclusão
//--------------------------------------------
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/funcoes_bd.php");
$drive->conecta();

//-------------------------------------------------------------------------------
// Monta o sql para inserir os dados no banco de dados e faz o upload do arquivo
//-------------------------------------------------------------------------------
$Tmsg1		= "Diário Oficial publicado com Sucesso!";	
$Tmsg2		= "Não foi possível publicar o Diário Oficial!";	
$Tretorno 	= "?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."";	
$Tarq 		= $drive->upload(CAMINHO_SITE."/".UPLOAD_DIARIO,$_FILES["Farquivo"],"pdf",50);
$Tdata		= inverteData($_POST['Fcal_data']);
$Tnum		= $_POST['Fdiario_numero'];
$Texc 		= 0;
$Textra		= $_POST['Fdiario_extra'];


//------------------------------------------------------------------------------
// verifica se o diário em questão esta sendo substituido ou é um novo cadastro
//------------------------------------------------------------------------------

$sqlVer = "SELECT arquivo_diario_oficial_id, 
                  arquivo_diario_oficial_link, 
                  arquivo_diario_oficial_data, 
                  arquivo_diario_oficial_edicao, 
                  arquivo_diario_oficial_exc, 
        CASE WHEN arquivo_diario_oficial_ch = 'n' THEN 'NORMAL' ELSE 'EXTRA' END AS  arquivo_diario_oficial_ch 
             FROM arquivo_diario_oficial 
            WHERE arquivo_diario_oficial_edicao = ".$Tnum;

if( $Textra == 'n' ){
	$sqlVer .=" AND arquivo_diario_oficial_ch = '".$Textra."' ORDER BY arquivo_diario_oficial_data DESC LIMIT 1 ";
}

$Tretver = $drive->pedido($sqlVer);
$Tnumreg = pg_fetch_row($Tretver);

if($Tnumreg != NULL || ( $Tnumreg == NULL && $Textra == 'e' ) ){	
	//-----------------------------------------------
	// verifica se o arquivo anterio ja foi excluido
	//-----------------------------------------------
	if($Tnumreg[4] == "f" && $Textra == 'n' ){
		$sql = "";
		$Tmsg2	= "Já existe um Diário Oficial com esta numeração!";	
	}else if($Tnumreg == NULL && $Textra == 'e' ){
		$sql = "";
		$Tmsg2	= "Não existe um Diário Oficial com esta numeração para criar uma Edição Extra !";	
	}else{
		//-----------------------
		// gera log da alteração
		//-----------------------
		$Tacao 		= "UPDATE";
		$Thora 		= date("H:i:s");
		$TdataAtual = date("d/m/Y");
		$Tip   		= $_SERVER['REMOTE_ADDR'];
		$Tuser 		= $_SESSION['SuserNome'];		
	     
	    if( $Textra == 'n' ){ 
		   $Tlog = "* ".$Tacao." - ".$TdataAtual." - ".$Thora." - ".$Tuser." - " .$Tip." - Edição (".$Tnum.") de ".$_POST['Fcal_data']."\r\n";
		}else{
			$Tlog = "* ".$Tacao." - ".$TdataAtual." - ".$Thora." - ".$Tuser." - " .$Tip." - Edição (".$Tnum." - Extra ) de ".$_POST['Fcal_data']."\r\n";
		}

		include_once ('../scripts/php/log.php');
		$arquivo = "gestaoetransparencia/formularios/log_diario/diario.txt";
		$arq = new Arquivo();
		$arq->abreArq($arquivo, 'a');
		$arq->gravaArq($Tlog);
		$arq->fechaArq();	

		$sql = "INSERT INTO 
					arquivo_diario_oficial (
						arquivo_diario_oficial_id,
						arquivo_diario_oficial_link,
						arquivo_diario_oficial_data,
						arquivo_diario_oficial_edicao,
						arquivo_diario_oficial_exc,
						arquivo_diario_oficial_ch) 
				VALUES (
					default, 
					'$Tarq[6]',
					'$Tdata',
					 $Tnum,
					'$Texc',
					'$Textra')";
	}
}else{	
			
	$sql = "INSERT INTO 
					arquivo_diario_oficial (
						arquivo_diario_oficial_id,
						arquivo_diario_oficial_link,
						arquivo_diario_oficial_data,
						arquivo_diario_oficial_edicao,
						arquivo_diario_oficial_exc,
						arquivo_diario_oficial_ch)  
				VALUES (
					default, 
					'$Tarq[6]',
					'$Tdata',
					 $Tnum,
					'$Texc',
					'$Textra')";
}
//-----------------------------------
// Insere os dados no banco de dados
//-----------------------------------
$Tinsert = $drive->pedido($sql);
$drive->close();

//------------------------------------------------
// Imprime mensagem de de confirmação de inclusão
//------------------------------------------------	
if($Tinsert){
	$Tmsg = "
	<form method=\"post\" action=\"".$Tretorno."\">
		<br />
		<br />
		".$Tmsg1."		
		<br />
		<br />
		<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
	</form>";			
	MsgSql($Tmsg, 100, 400);
}else{	
	$Tmsg = "
	<form method=\"post\" action=\"".$Tretorno."\">
		<br />
		<br />
		".$Tmsg2."	
		<br />
		<br />
		<input type=\"submit\" onclick=\"document.getElementById('popup').style.display = 'none';\" value=\"Voltar\">			
	</form>";			
	MsgSql($Tmsg, 100, 400);	
}