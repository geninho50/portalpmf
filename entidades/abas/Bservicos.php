<?php
$drive->conecta();

$idMenu = "";

if( isset( $_GET['menu'] ) ){
	$idMenu = $_GET['menu']
}
//------------------------------------------------
//converte todas as letra MAIÚSCULAS em minúscula
//------------------------------------------------
$convert_to = array(
	"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
	"V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
	"Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
	"З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
	"Ь", "Э", "Ю", "Я");
$convert_from = array(
	"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
	"v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
	"ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
	"з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
	"ь", "э", "ю", "я");

//--------------------------
// retira acentos e cedilha
//--------------------------
$convert_to_2 	= array("à", "á", "â", "ã", "ä", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "ç");
$convert_from_2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c");

//-------------------------------
// trata as palavras consultadas
//-------------------------------
$convert_to_3 	= array(";", "-", ",", "/", "+");
$convert_from_3 = array(" ", " ", " ", " ", " ");

//---------------------------------------------
// faz os tratamentos necessários para a busca
//---------------------------------------------

if(isset($_POST['txtbusca'])){
	$Tentidade	  = $_POST['Ssec'];													// variável que armazena em qual entidade deve ser feita a consulta 0 / 9999 (todas)
	$TtxtBusca	  =	$_POST['txtbusca'];												// armazena as palavras buscadas para exibir ao usuário		
	$TsqlEnt  = " AND SERV.serv_entidade_id = ".$IdEntidade;
}else if(isset($_GET['keys'])){
	$Tentidade	  = $_GET['ent'];													// variável que armazena em qual entidade deve ser feita a consulta 0 / 9999 (todas)
	$TtxtBusca	  =	$_GET['keys'];													// armazena as palavras buscadas para exibir ao usuário	
	$TsqlEnt  = " AND SERV.serv_entidade_id = ".$IdEntidade;
}
									
$Tespacamento = str_replace($convert_to_3, $convert_from_3, $TtxtBusca); 			// remove caracteres como , ; /
$Tminusculas  = str_replace($convert_to, $convert_from, $Tespacamento); 			// modifica todoas as letras para minúsculas
$Tacentos  	  = str_replace($convert_to_2, $convert_from_2, $Tminusculas); 			// remove todos os acentos e cedilhas 
$Tpalavras 	  = explode(" ", $Tacentos); 											// se + que uma palavra, separa cada uma individualmente<a href="../camera_pro.php">camera_pro.php</a>
$Tbusca		  = "";																	// variável ultilizada para montar o sql
$TcamPg		  = "&keys=";
for($i=0; $i<count($Tpalavras); $i++){												// verifica quantas palavras foram digitadas e monta padrão de consulta sql
	if($i == (count($Tpalavras)-1)){
		$Tbusca .= "ind_serv_palavra ILIKE '%".$Tpalavras[$i]."%' ";
		$TcamPg .= $Tpalavras[$i]."&ent=".$IdEntidade;
	}else{
		$Tbusca .= "ind_serv_palavra ILIKE '%".$Tpalavras[$i]."%' OR ";
		$TcamPg .= $Tpalavras[$i]."+";
	}
}
$sqlBusca = "SELECT * FROM index_servicos WHERE ".$Tbusca."";						// slq da busca dos serviços
$TretServIds =  $drive->pedido($sqlBusca);											// retorno da consulta no banco de dados
$TidsServ = array();																// inicialização do array que conterá os ids dos serviços

while($TservIds = pg_fetch_object($TretServIds)){
	$Tids = explode(",", $TservIds->ind_serv_servicos);  							// separa os ids recebidos na consulta
	for($j=0; $j<count($Tids); $j++){
		array_push($TidsServ, $Tids[$j]);											// monta um array com todos os ids dos serviços encontrados
	}
}
$TidsPesquisa = array_unique($TidsServ);											// remove ids duplicados 

$TidsFinal = array();																//Re-ordena keys do array
foreach($TidsPesquisa as $Tid) {
	array_push($TidsFinal, $Tid);
}

//-----------------------------------------------------------
// monta o sql para trazer os dados dos serviços encontrados
//-----------------------------------------------------------
$Tbusca		  = "";																	// variável ultilizada para montar o sql
for($i=0; $i<count($TidsFinal); $i++){
	if($i == (count($TidsFinal)-1)){
		$Tbusca .= "SERV.serv_id = ".$TidsFinal[$i]." ";
	}else{
		$Tbusca .= "SERV.serv_id = ".$TidsFinal[$i]." OR ";
	}	
}

//------------------------------------------------------------
// verifica se é a primeira página para controle da paginação
//------------------------------------------------------------
if(!isset($_GET['pg'])){
	$pg = 1;
}else{
	$pg = $_GET['pg'];	
}		
$inicio = ($pg * 10) - 10; 
$dataAtual = date("Y/m/d");

$sqlServ  = "SELECT ENT.entidade_nome, ENT.entidade_sigla, SERV.* FROM servicos AS SERV INNER JOIN entidades AS ENT ON SERV.serv_entidade_id = ENT.entidade_id ".$TsqlEnt." WHERE ".$Tbusca." ORDER BY SERV.serv_nome ASC LIMIT 10 OFFSET ".$inicio;
$sqlCnt   = "SELECT COUNT(SERV.*) FROM servicos AS SERV INNER JOIN entidades AS ENT ON SERV.serv_entidade_id = ENT.entidade_id ".$TsqlEnt." WHERE ".$Tbusca;
$TretServ = $drive->pedido($sqlServ);
$TretCnt  = $drive->pedido($sqlCnt);
$Tcount	  = pg_fetch_object($TretCnt);
$Tcaminho = "?pagina=servbusca".$TcamPg."&menu=".$idMenu;


?>

	<h3 class="search-string">Pesquisa: <span><?=$TtxtBusca?></span></h3>
	<ul class="painel_abas tabs">
		<li id="aba_servicos" class="category-tab active">
			<a href="??pagina=servbusca&info=servicos&menu=2">Serviços (<?=$Tcount->count?>)</a>
		</li>
	</ul>

	<div class="list-servicos list-servicos--entidades">
			<?php
			if(count($TidsFinal)>0){
				while($Tserv = pg_fetch_object($TretServ)){				
					echo "<div class=\"service-card\">
							<h3>".html_entity_decode($Tserv->serv_nome)."</h3>
							<div class=\"column6-lg column6-md column8-sm text-wrapper\"><p>".strip_tags($Tserv->serv_descricao)."</p></div>
							<div class=\"btn-wrapper-inline\">
								<a class=\"btn-primary btn-sm\" href=\"index.php?pagina=servpagina&acao=open&id=".$Tserv->serv_id."&menu=".$idMenu."\">
									Mais informações
								</a>";
								if($Tserv->serv_flag_online == 't'){
									if($Tserv->serv_abrir_interno == 0){
										echo "&nbsp;<a class=\"btn-primary btn-sm\" href=\"".$Tserv->serv_link."\">Acessar</a>";
									}else{
										echo "&nbsp;<a class=\"btn-primary btn-sm\" href=\"sistema.php?servicoid=".$Tserv->serv_id."\">Acessar</a>";
									}
								}
					echo "	</div>
						  </div>";
				}
				//------------------------------------
				// Imprime numumero de paginas rodapé 
				//------------------------------------
				echo("</div><br />");
				require_once("../../scripts/php/paginacao.php");
				echo "<p align=\"center\">";
				$TnumPag = $Tcount->count;
				if($TnumPag < 10){
					$TnumPag = 10;
				}
				mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
			}else{
				echo "<p>Nenhum serviço encontrado.</p>";	
			}
			?>
	</div>


