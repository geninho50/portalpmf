<div class="centro">
	<div id="caminho_migalhas">home &gt; sobre</div>
	<div id="titulo_pagina">Endereços</div>
	<div><br><br>
		<?php
			//=================================================================//
			//     Consulta retorna dados e coloca dentro da $V_entidade.      //
			//=================================================================//
			$sql = "SELECT * FROM entidades WHERE entidade_id = $IdEntidade";
			$result = $drive->pedido($sql);
			$V_entidade = pg_fetch_object($result);

			//===============================================================================//
			//      Verifica se a entidade é a COMCAP para impressão correta do e-mail.		 //
			//===============================================================================//
			if($IdEntidade == 37){
				$complemento_email = "comcap.org.br";
			}else{
				$complemento_email = "";
			}

			//==================================================================//
			//   Consultas são realizadas de acordo com a $indice e colocadas   //
			//   dentro da $local e sao impressas na tela como informação.      //
			//==================================================================//
//			for($i=0; $i < $indice; $i++){
				$sql = "SELECT LOC.*, BAR.bairro_nome FROM locais AS LOC INNER JOIN bairros AS BAR ON LOC.loc_bairro = BAR.bairro_id WHERE LOC.loc_entidade_id = ".$IdEntidade." ORDER BY LOC.loc_id";
				$result = $drive->pedido($sql);
				while($local = pg_fetch_object($result)){
				
				if( strpos($local->loc_fone,'4') === 0 ){	
					$fone = " (".substr($local->loc_fone,0,2).") ".substr($local->loc_fone,2,4)."-".substr($local->loc_fone,6,4);
                }else{
                    $fone = $local->loc_fone;
				} 
				?>
		<hr width="100%" style="border:0; border-bottom:1px dashed #999" /><br />
        <p><?=$local->loc_rua?>, nº <?=$local->loc_num?> - <?=$local->loc_complemento?><br />
        <?=$local->bairro_nome?> - CEP: <?=$local->loc_cep?><br />
        <!-- Telefone: <?=$V_telefone = " (".substr($local->loc_fone,0,2).") ".substr($local->loc_fone,2,4)."-".substr($local->loc_fone,6,4);?>  <br /> -->
		Telefone : <?=$V_telefone = $fone; ?>  <br />
        <!--E-mail: <?=$local->loc_email?>@<?=$complemento_email?></p>-->


<?php

$acentos = array(
		'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
		'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
		'C' => '/&Ccedil;/',
		'c' => '/&ccedil;/',
		'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
		'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
		'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
		'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
		'N' => '/&Ntilde;/',
		'n' => '/&ntilde;/',
		'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
		'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
		'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
		'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
		'Y' => '/&Yacute;/',
		'y' => '/&yacute;|&yuml;/');

	$TruaAbbr	 = preg_replace($acentos, array_keys($acentos), htmlentities($local->loc_rua,ENT_NOQUOTES, 'UTF-8'));
	$TnumeroAbbr = preg_replace($acentos, array_keys($acentos), htmlentities($local->loc_num,ENT_NOQUOTES, 'UTF-8'));
	$TbairroAbbr = preg_replace($acentos, array_keys($acentos), htmlentities($local->bairro_nome,ENT_NOQUOTES, 'UTF-8'));
	$caracteres  = array("+", "-", "!", "_", " ", "?", "[", "]", "(", ")", "{", "}", "@", "#", "\\", "/", ";", ":", ".", ",", "<", ">", "^", "|");

	if($Tnumero != "s/n"){
		$Tendereco = str_replace($caracteres, "+", $TruaAbbr).",+".str_replace($caracteres, "+", $TnumeroAbbr).",+".str_replace($caracteres, "+", $TbairroAbbr);
	}else{
		$Tendereco = str_replace($caracteres, "+", $TruaAbbr).",+".str_replace($caracteres, "+", $TbairroAbbr);
	}
?>



            <br />



            <iframe width="500" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
src="
http://maps.google.com.br/maps?
f=q&amp;
source=s_q&amp;
hl=pt-BR&amp;
geocode=&amp;
q=<?=$Tendereco?>,+Florian%C3%B3polis+-+Santa+Catarina&amp;
aq=&amp;
g=Florian%C3%B3polis,+BR&amp;
t=p&amp;
ie=UTF8&amp;

z=15&amp;
output=embed">
</iframe>

            <br><br>
		<b><i>Setores neste endereço:</i></b><br /><br />

        <?php
        //==============================================================================//
		//   Consulta retorna dados ordernados por posição de setor dentro da $result.  //
		//==============================================================================//
			$sqlSet = "SELECT * FROM setores WHERE setor_local_id = ".$local->loc_id." ORDER BY setor_posicao";
			$resultSet = $drive->pedido($sqlSet);
			while($setores = pg_fetch_object($resultSet)){
				echo "<span class=\"titulo_quem_e_quem\">".$setores->setor_nome."</span><br><br>";
			}

		}

		?>


	</div>
</div><!-- fim coluna_C2 -->
