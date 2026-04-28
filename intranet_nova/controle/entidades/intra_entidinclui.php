<?php
if(!isset($_POST['btInclui_x'])){

//----------------------------------------------------------------------------------
// busca todas os path's já cadastrados pra não deixar cadastrar dois path's iguais
//----------------------------------------------------------------------------------
$sql = "SELECT entidade_path FROM entidades";
$TreturnSql = $drive->pedido($sql);
$TvalidaPath = "";
while($Tpath = pg_fetch_object($TreturnSql)){
	if($Tpath->entidade_path !=""){
		$TvalidaPath .= "'".$Tpath->entidade_path."' , ";
	}
}
?>

<script ype="text/javascript"> 
function MostraPaineis(){ 
	var i 
	if (document.getElementById("revento").checked) {
		document.getElementById('padrao').style.display = 'none';
		document.getElementById('evento').style.display = 'block';
	} else {
		document.getElementById('padrao').style.display = 'block';
		document.getElementById('evento').style.display = 'none';
	}
} 

function bloqueiaAcentos(obj)
{
        var str = new String(obj.value);
        var acentos = new String('àâêôûãõáéíóúçüÀÂÊÔÛÃÕÝÉÝÓÚÇÜ');
        var SemAcento = new String('aaeouaoaeioucuAAEOUAOAEIOUCU');
        var c = new String();
        var i = new Number();
        var x = new Number();
        var res = '';
        
        for (i = 0; i<str.length; i++)
        {
                c = str.substring(i,i+1);
                for (x=0; x< acentos.length; x++)
                {
                        if (acentos.substring(x,x+1) == c)
                        {
                                c = SemAcento.substring(x,x+1);
                        }
                        
                
                }
                res += c;
        }
        obj.value = res;
}

function mascara_fone(form){
	if(form.Ffone.value.length==4){
		form.Ffone.value=form.Ffone.value + "-";
	}
	if(form.Ffone.value.length==9){
		form.Ffone.value=form.Ffone.value;
	}
}

function mascara_fax(form){
	if(form.Ffax.value.length==4){
		form.Ffax.value=form.Ffax.value + "-";
	}
	if(form.Ffax.value.length==9){
		form.Ffax.value=form.Ffax.value;
	}
}

</script>

<div class="center">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">incluir entidade</div>
	<div id="margem_direita"><br>
        <div class="conteudo_abas">    
            <div id="conteudo_dados" style="display:inline">    
                <form method="post" enctype="multipart/form-data">                            
                    <div class="texto_formulario">DADOS GERAIS:</div>    
                    <div class="texto_formulario">Sigla:</div>    
                    <input name="Fsigla" id="Fsigla" type="text" class="componente_miolo_menor" maxlength="10" style="text-transform: uppercase;" />
                    <script type="text/javascript">
						var Fsigla= new LiveValidation('Fsigla');
						Fsigla.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					</script>
                    <br>                
                    <div class="texto_formulario">Tipo de Entidade:</div>                
                    <input id="rprefeitura" name="Ftipo" type="radio" value="0" onchange="javascript:MostraPaineis()" checked="checked" />Prefeitura<br>               
                    <input id="rexecutiva" name="Ftipo" type="radio" value="4" onchange="javascript:MostraPaineis()" />Secretaria Municipal<br>               
                    <input id="rmunicipal" name="Ftipo" type="radio" value="5" onchange="javascript:MostraPaineis()" />Secretaria Executiva<br>               
                    <input id="rsuperintendencia" name="Ftipo" type="radio" value="8" <?php if($Tentidade->entidade_tipo == 8){echo"checked=\"checked\"";}?> />Superintend&ecirc;ncia<br>               					
					<input id="rconselho" name="Ftipo" type="radio" value="9" <?php if($Tentidade->entidade_tipo == 9){echo"checked=\"checked\"";}?> />Conselho<br>               										
                    <input id="rorgao" name="Ftipo" type="radio" value="6" onchange="javascript:MostraPaineis()" />&Oacute;rg&atilde;o<br>               
                    <input id="revento" name="Ftipo" type="radio" value="7" onchange="javascript:MostraPaineis()" />Evento<br>               
                    <div class="texto_formulario">Nome:</div>               
                    <input name="Fnome" id="Fnome" type="text" class="componente_miolo" maxlength="100" />
                    <script type="text/javascript">
						var Fnome= new LiveValidation('Fnome');
						Fnome.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					</script>
                    <br>               
                    <br>                
                    <div id="padrao" style="display:block">                
                        <hr size="1" width="100%">                 
                        <div class="texto_formulario">DADOS DE CONTATO:</div>                
                        <br>                
                        <div class="texto_formulario">E-mail:</div>                
                        <input name="Femail" id="Femail" type="text" class="componente_miolo_menor" maxlength="50" /> @pmf.sc.gov.br<br>                
                        <div class="texto_formulario">Fone:</div>                
                        <input name="Ffone" id="Ffone" type="text" class="componente_miolo_menor" maxlength="9" onkeyup="mascara_fone(form)" /> Ex: 3251-0000<br>                      
                        <div class="texto_formulario">Fax:</div>                    
                        <input name="Ffax" id="Ffax" type="text" class="componente_miolo_menor" maxlength="9" onkeyup="mascara_fax(form)" /> Ex: 3251-0000<br>                     
                        <br>                    
                        <hr size="1" width="100%">                     
                        <div class="texto_formulario">ORGANOGRAMA:</div>                    
                        <div class="texto_formulario">Arquivo organograma (em pdf):</div>                    
                        <input name="Farquivo" type="file" class="componente_miolo" maxlength="300" />
                        <br />            
                    </div>                
                    <br>                
                    <hr size="1" width="100%">                
                    <div class="texto_formulario">CONFIGURAÇÃO DO SITE:</div>                
                    <br>                
                    <div class="texto_formulario">Nome de exibição da entidade no cabeçalho do site:</div>                
                    <input name="Flinha1" id="Flinha1" type="text" class="componente_miolo" maxlength="100" /> 
                    <script type="text/javascript">
						var Flinha1= new LiveValidation('Flinha1');
						Flinha1.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					</script><br>                 
                    OBS: não é preciso incluir "Secretaria Municipal de" ou "Secretaria Executiva"<br>                
                    <br>                 
                    <div class="texto_formulario">Esta entidade/evento possui um site?</div>                
                    <input name="FflagSite" type="radio" value="1" /> Sim &nbsp;&nbsp;<input name="FflagSite" type="radio" value="0" checked="checked" />Não<br>                
                    http://www.pmf.sc.gov.br/.../<input name="Fsite" id="Fsite" type="text" class="componente_miolo_menor" onkeypress="bloqueiaAcentos(this);" maxlength="15" />
                    <script type="text/javascript">
                    var Fsite = new LiveValidation('Fsite'); 
						Fsite.add( Validate.Exclusion, { within: [ <?=$TvalidaPath?> ], failureMessage: "Em uso" } ); 
					</script>
                    <br><br>                
                    <div class="texto_formulario">Habilitar funções padrão do site:</div>                
                    <input name="Fsobre" type="checkbox" value="1" />Sobre a Entidade / Evento<br>                
                    <input name="Fgestao" type="checkbox" value="1" />Gestão e Transparência<br>                
                    <input name="Fservicos" type="checkbox" value="1" />Serviços<br>                
                    <input name="Fnoticias" type="checkbox" value="1" />Notícias e Eventos<br>   
					<br>                 
	                <div class="texto_formulario">Em casa de não possuir um site, informe um link  :</div>                
					<input name="Flink" id="Flink" type="text" class="componente_miolo" maxlength="300" size="100" value="" /><br><br>

                    <div id="evento" style="display:none">                
                        <br><hr size="1" width="100%">                
                        <div class="texto_formulario" >CONFIGURAÇÃO DO EVENTO:</div><br>  
                        <div class="texto_formulario">Imagem de divulga&ccedil;&atilde;o do evento (logomarca):</div>
                		<input type="file" name="Flogo" id="Flogo" /><br />250 x 150 pixels (<i>apenas imagens .jpg ou .png</i>)<br />
                        <div class="texto_formulario">Este evento possui um twitter?</div>                
                        <input name="FflagTwitter" type="radio" value="1" /> Sim &nbsp;&nbsp;<input name="FflagTwitter" type="radio" value="0" checked="checked" />Não<br>                
                        http://www.twitter/<input name="Ftwitter" type="text" class="componente_miolo_menor" maxlength="20"  onkeypress="bloqueiaAcentos(this);" /><br><br>                 
                        <div class="texto_formulario">Este evento possui transmissão ao vivo?</div>                
                        <input name="FflagTransmissao" type="radio" value="1" /> Sim &nbsp;&nbsp;<input name="FflagTransmissao" type="radio" value="0" checked="checked" />Não<br>                
                        <input name="Ftransmissao" type="text" class="componente_miolo" maxlength="100" /><br>                
                        Endereço Servidor de Stream                
                    </div>                  
                    <br /><br />                
                    <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInclui" id="btInclui" value="btInclui" />                
                </form>                     
            </div>        
        </div>    
    </div>
</div>
<br class="clearfloat" />
<?php
}else{

	//-------------------------------
	//Dados comuns Entidades/Eventos
	//-------------------------------
	$Tsigla = 		 strtoupper($_POST['Fsigla']);
	$Ttipo = 		 $_POST['Ftipo'];
	$Tnome = 		 $_POST['Fnome'];
	$TnomeExibicao = $_POST['Flinha1'];	
	$Tsite = 		 strtolower($_POST['Fsite']);
	$TflagSite =	 $_POST['FflagSite'];
	$Tlink =	 	 $_POST['Flink'];


	//----------------------------
	//Dados do controle de acesso 
	//----------------------------	
	if($_POST['Fsobre'] != 1){$Tsobre = 0;}else{$Tsobre = 1;}
	if($_POST['Fgestao'] != 1){$Tgestao = 0;}else{$Tgestao = 1;}
	if($_POST['Fservicos'] != 1){$Tservicos = 0;}else{$Tservicos = 1;}
	if($_POST['Fnoticias'] != 1){$Tnoticias = 0;}else{$Tnoticias = 1;}
	
	//-----------------------------
	//Dados exclusivos de entidade
	//-----------------------------
	$Temail = 		$_POST['Femail'];
	$Tfone =		$_POST['Ffone'];
	$Tfax = 		$_POST['Ffax'];
	$Torganograma = $_FILES['Farquivo'];
	
	//------------------------------------------------------------------------------
	//Faz tratamendo nos dados do telefone e do fax para inserir corretamente no bd
	//------------------------------------------------------------------------------
	$TfoneFinal = explode("-",$Tfone);
	$Tfone = "48".$TfoneFinal[0].$TfoneFinal[1];
	$TfaxFinal = explode("-", $Tfax);
	$Tfax = "48".$TfaxFinal[0].$TfaxFinal[1];	
	
	//----------------------------
	//Dados exclusivos de eventos
	//----------------------------	
	$Tlogo		  = 	$_FILES['Flogo'];
	$TflagTwitter =     $_POST['FflagTwitter'];
	if($_POST['Ftwitter'] == ""){$Ttwitter = " ";}else{$Ttwitter = $_POST['Ftwitter'];}
	$TflagTransmissao = $_POST['FflagTransmissao'];
	if($_POST['Ftransmissao'] == ""){$Ttransmissao = " ";}else{$Ttransmissao = $_POST['Ftransmissao'];}
	
	//----------------------------------------
	//chamada para as classes de BD e FUNÇÕES
	//----------------------------------------
	require_once ("../scripts/php/funcoes.php"); 	
	require_once ("../scripts/php/funcoes_bd.php"); 
	$drive->conecta();
	
	//------------------------------------
	//Se for um evento inclui a logomarca
	//------------------------------------	
	if($Tlogo["name"] == ""){
		$TlogoNome = NULL;
	}else{
		$Tdir   = CAMINHO_SITE."/".UPLOAD_EVENTOLOGO;  //caminhos definidos em /scripts/php/config.php 
		$Text   = "jpg#png";						
		$TcarregaArquivo = $drive->upload($Tdir,$Tlogo,$Text,5);		
		$TlogoNome 		 = $TcarregaArquivo[6];

		if ($V_carrega[1] == false){
			echo"<script>alert(\"Nao foi possivel carregar a logo!\");</script>";			
		}
	}	
	
	//-----------------------------------------------
	//Se foi adiocionado um organograma faz o UPLOAD
	//-----------------------------------------------	
	if($Torganograma["name"] == ""){
		$TpdfNome = " ";
	}else{
		$Tdir   = CAMINHO_SITE . "/" . UPLOAD_DOCUMENTOS;  //caminhos definidos em /scripts/php/config.php 
		$Text   = "pdf";						
		$TcarregaArquivo = $drive->upload($Tdir,$Torganograma,$Text,10);		
		$TpdfNome 		 = $TcarregaArquivo[6];

		if ($V_carrega[1] == false){
			echo"<script>alert(\"Erro no envio do arquivo!\");</script>";			
		}
	}	
		
	//---------------------------------------------------------	
	//Se existir SITE então cria pasta individual para o mesmo
	//---------------------------------------------------------
	if($Tsite != ""){
		
		//------------------------------------------------
		//Separa em pastas diferentes eventos e entidades
		//------------------------------------------------
		switch($Ttipo){ 
			case 7 : $tipoSite = "sites";
			break;
			default : $tipoSite = "entidades";
		}
		
		//------------------------------------------------------
		//Verifica se ja existe uma pasta com o nome solicitado
		//------------------------------------------------------
		if(is_dir("../". $tipoSite ."/$Tsite") && (int)$_POST['FflagSite'] == 1){
			
			echo("<script>");
			echo("alert(\"Erro: Pasta $Tsite já existe, favor inserir outro nome.\")");
			echo("</script>");
		
		}else if((int)$_POST['FflagSite'] == 1){

		//----------------------------------------
		//Se a pasta ainda não existe, então cria	
		//----------------------------------------
			$diretorio  = "../". $tipoSite ."/".$Tsite."/";			
			$dir 		= @mkdir($diretorio, 0775,true);
			copy(CAMINHO_SITE."/Banner.swf","../". $tipoSite ."/".$Tsite."/Banner.swf");
											
			/**/
			$arquivo_index  = '<?php' . ' require_once($_SERVER[\'DOCUMENT_ROOT\']."/scripts/php/config.php");'; 
			$arquivo_index .= 'require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");';
			$arquivo_index .= '$drive->conecta();';
			$arquivo_index .= '$pasta = explode("/" , $_SERVER[\'PHP_SELF\']);';
			$arquivo_index .= '$path = $pasta[2];';
			$arquivo_index .= '$sql = "SELECT * FROM entidades WHERE entidade_path = \'$path\'";';
			$arquivo_index .= '$resultado = $drive->pedido($sql);';
			$arquivo_index .= 'require_once("../qwerty.php"); ?>';	
			/**/
			
			/**/
			
			if($Ttipo != 7){
			
				$arquivo_sistema  = '<?php' . ' require_once($_SERVER[\'DOCUMENT_ROOT\']."/scripts/php/config.php");'; 
				$arquivo_sistema .= 'require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");';
				$arquivo_sistema .= '$drive->conecta();';
				$arquivo_sistema .= '$pasta = explode("/" , $_SERVER[\'PHP_SELF\']);';
				$arquivo_sistema .= '$path = $pasta[2];';
				$arquivo_sistema .= '$sql = "SELECT * FROM entidades WHERE entidade_path = \'$path\'";';
				$arquivo_sistema .= '$resultado = $drive->pedido($sql);';
				$arquivo_sistema .= 'require_once("../serv_sistema.php"); ?>';	
				
				
				$arquivo_consulta  = '<?php' . ' require_once($_SERVER[\'DOCUMENT_ROOT\']."/scripts/php/config.php");'; 
				$arquivo_consulta .= 'require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");';
				$arquivo_consulta .= '$drive->conecta();';
				$arquivo_consulta .= '$pasta = explode("/" , $_SERVER[\'PHP_SELF\']);';
				$arquivo_consulta .= '$path = $pasta[2];';
				$arquivo_consulta .= '$sql = "SELECT * FROM entidades WHERE entidade_path = \'$path\'";';
				$arquivo_consulta .= '$resultado = $drive->pedido($sql);';
				$arquivo_consulta .= 'require_once("../serv_consulta.php"); ?>';
				
				$fp2 = fopen($diretorio."sistema.php", "w");
				$escrever2 = fwrite($fp2,$arquivo_sistema);
				fclose($fp2);
				
				$fp3 = fopen($diretorio."consultas.php", "w");
				$escrever3 = fwrite($fp3,$arquivo_consulta);
				fclose($fp3);
			
			}
			
			$fp = fopen($diretorio."index.php", "w");
			$escrever = fwrite($fp,$arquivo_index);
			fclose($fp);
			
		}	
	}	
	
	$sql = "INSERT INTO 
					entidades (
						entidade_id, 
						entidade_nome, 
						entidade_email, 
						entidade_fone, 
						entidade_fax, 
						entidade_sigla, 
						entidade_link_pdf,  
						entidade_tipo, 
						entidade_flag_site, 
						entidade_path, 
						entidade_linha_1, 
						conteudo_sobre, 
						conteudo_gestao, 
						conteudo_servicos, 
						conteudo_noticias,						
						entidade_flag_twitter,
						entidade_twitter,
						entidade_flag_aovivo,
						entidade_aovivo,
						entidade_logo,
						entidade_link,
						entidade_excluida
					) 
				VALUES (
					default, 
					'$Tnome', 
					'$Temail', 
					'$Tfone', 
					'$Tfax', 					
					'$Tsigla', 
					'$TpdfNome', 
					 $Ttipo, 
					 $TflagSite, 
					'$Tsite', 
					'$TnomeExibicao', 	 
					'$Tsobre', 
					'$Tgestao', 
					'$Tservicos', 
					'$Tnoticias',					
					'$TflagTwitter',
					'$Ttwitter',
					'$TflagTransmissao',
					'$Ttransmissao',
					'$TlogoNome',
					'$Tlink',
					'f'
				)";

				$result = $drive->pedido($sql);
				
				

		if ($result == true){
					
			$sql2 = "SELECT max(entidade_id) FROM entidades";
			$result = pg_fetch_object($drive->pedido($sql2));
			
			$sql3 = "INSERT INTO config_manchetes (man_id, man_entidade_id, man_tipo) VALUES (default, '".$result->max."', '1')";
			$drive->pedido($sql3);
			
			echo"<script>alert(\"Entidade incluida com Sucesso!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=entinclui&menu=".$_GET['menu']."\";</script>");
			
        }else{		
			echo"<script>alert(\"Não foi possível incluir a entidade.\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=entinclui&menu=".$_GET['menu']."\";</script>");
		}	
	
	$drive->close();
		
}

?>