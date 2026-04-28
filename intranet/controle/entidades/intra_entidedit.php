<script ype="text/javascript"> 
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

<?php 

if(!isset($_POST['btEditar_x'])){

	require_once("../scripts/php/funcoes_bd.php");
	$drive->conecta(); 
	
	//------------------------------------------------
	//Recupera informações da entidade a ser alterada
	//------------------------------------------------
	$TentideId  = $_GET['id']; 	
	$sqlEnt 	= "SELECT * FROM entidades WHERE entidade_id = $TentideId";
	$TresultEnt = $drive->pedido($sqlEnt);
	$Tentidade  = pg_fetch_object($TresultEnt);
	
	//----------------------------------------------------------------------------------
	// busca todas os path's já cadastrados pra não deixar cadastrar dois path's iguais
	//----------------------------------------------------------------------------------
	$sql = "SELECT entidade_path FROM entidades";
	$TreturnSql = $drive->pedido($sql);
	$TvalidaPath = "";
	while($Tpath = pg_fetch_object($TreturnSql)){
		if(($Tpath->entidade_path !="") and($Tpath->entidade_path != $Tentidade->entidade_path)){
			$TvalidaPath .= "'".$Tpath->entidade_path."' , ";
		}
	}
	
?>
            
<div class="center">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">editar entidade</div>
	<div id="margem_direita"><br>
        <div class="conteudo_abas">    
            <div id="conteudo_dados" style="display:inline">    
                <form method="post" enctype="multipart/form-data" >                
                <div class="texto_formulario">DADOS GERAIS:</div>    
                <div class="texto_formulario">Sigla:</div>    
                <input name="Fsigla" type="text" id="Fsigla" class="componente_miolo_menor" maxlength="10" style="text-transform: uppercase;" value="<?=$Tentidade->entidade_sigla?>" />
                <script type="text/javascript">
					var Fsigla= new LiveValidation('Fsigla');
					Fsigla.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script>
                <br>                
                <div class="texto_formulario">Tipo de Entidade:</div>                
                <?php 
				if($Tentidade->entidade_tipo != 7){
				?>                  
                    <input id="rprefeitura" name="Ftipo" type="radio" value="0" <?php if($Tentidade->entidade_tipo == 0){echo"checked=\"checked\"";}?> />Prefeitura<br>               
                    <input id="rexecutiva" name="Ftipo" type="radio" value="4" <?php if($Tentidade->entidade_tipo == 4){echo"checked=\"checked\"";}?>  />Secretaria Municipal<br>               
                    <input id="rmunicipal" name="Ftipo" type="radio" value="5" <?php if($Tentidade->entidade_tipo == 5){echo"checked=\"checked\"";}?> />Secretaria Executiva<br>               
                    <input id="rsuperintendencia" name="Ftipo" type="radio" value="8" <?php if($Tentidade->entidade_tipo == 8){echo"checked=\"checked\"";}?> />Superintend&ecirc;ncia<br>               					
					<input id="rconselho" name="Ftipo" type="radio" value="9" <?php if($Tentidade->entidade_tipo == 9){echo"checked=\"checked\"";}?> />Conselho<br>               										
                    <input id="rorgao" name="Ftipo" type="radio" value="6" <?php if($Tentidade->entidade_tipo == 6){echo"checked=\"checked\"";}?> />&Oacute;rg&atilde;o<br>               
                <?php 
				}else{ 
				?>                
                	<input id="revento" name="Ftipo" type="radio" value="7" <?php if($Tentidade->entidade_tipo == 7){echo"checked=\"checked\"";}?> />Evento<br>               
                <?php 
				} 
				?>                
                <div class="texto_formulario">Nome:</div>               
                <input name="Fnome" id="Fnome" type="text" class="componente_miolo" maxlength="100" value="<?=$Tentidade->entidade_nome?>" /><br>              
                <script type="text/javascript">
					var Fnome= new LiveValidation('Fnome');
					Fnome.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script>
                <br>                
                <?php 
				
				//---------------------------------------------------
				//Dados específicos de entidades que não são eventos
				//---------------------------------------------------
				if($Tentidade->entidade_tipo != 7){
				?>               
                <div id="padrao">                
                    <hr size="1" width="100%">                
                    <div class="texto_formulario">DADOS DE CONTATO:</div>                
                    <br>                
                    <div class="texto_formulario">E-mail:</div>                
                    <input name="Femail" type="text" class="componente_miolo_menor" maxlength="50" value="<?=$Tentidade->entidade_email?>" /> @pmf.sc.gov.br <br>        			
                    <?php 					
     	           	$Ttelefone = substr($Tentidade->entidade_fone,2,4)."-".substr($Tentidade->entidade_fone,6,4);					
					$Tfax = substr($Tentidade->entidade_fax,2,4)."-".substr($Tentidade->entidade_fax,6,4);                    
					?>                    
					<div class="texto_formulario">Fone:</div>                
                    <input name="Ffone" type="text" class="componente_miolo_menor" maxlength="9" value="<?=$Ttelefone?>"  onkeyup="mascara_fone(form)"/> Ex: 3251-0000<br>                      
                    <div class="texto_formulario">Fax:</div>                    
                    <input name="Ffax" type="text" class="componente_miolo_menor" maxlength="9" value="<?=$Tfax?>"  onkeyup="mascara_fax(form)"/> Ex: 3251-0000<br>                    
                    <br>                    
                    <hr size="1" width="100%">                     
                    <div class="texto_formulario">ORGANOGRAMA:</div>                    
                    <div class="texto_formulario">Arquivo organograma (em pdf):</div>                    
                    <input name="Farquivo" type="file" class="componente_miolo" maxlength="300" /><br />                    
                    <input name="Fciente" id="Fciente" type="checkbox" onclick = "marcaDesmarca" />Estou ciente que isso vai excluir meu organograma anterior. Esta operação é irreversível.<br>                
                </div>                 
                <?php 
				} 
				?>                
                <br>                
                <hr size="1" width="100%">                
                <div class="texto_formulario">CONFIGURAÇÃO DO SITE:</div>                
                <br>                
                <div class="texto_formulario">Nome de exibição da entidade no cabeçalho do site:</div>                
                <input name="Flinha1" id="Flinha1" type="text" class="componente_miolo" maxlength="100" value="<?=$Tentidade->entidade_linha_1?>" /> 
                <script type="text/javascript">
					var Flinha1= new LiveValidation('Flinha1');
					Flinha1.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script>
                <br>                 
                OBS: não é preciso incluir "Secretaria Municipal de" ou "Secretaria Executiva"<br>                
                <br>                 
                <div class="texto_formulario">Esta entidade possui um site?</div>                
                <input name="FflagSite" type="radio" <?php if($Tentidade->entidade_flag_site == 1){echo"checked=\"checked\"";}?> value="1" /> Sim &nbsp;&nbsp;                
                <input name="FflagSite" type="radio" <?php if($Tentidade->entidade_flag_site == 0){echo"checked=\"checked\"";}?> value="0" />Não<br>                
                http://www.pmf.sc.gov.br/<?php if($Tentidade->entidade_tipo != 7){echo"entidades";}else{echo"sites";}?>/<input name="Fsite" id="Fsite" type="text" class="componente_miolo_menor" onkeypress="bloqueiaAcentos(this);" maxlength="15" value="<?=$Tentidade->entidade_path?>" /><br><br>                
                <input name="FsiteAtual" type="hidden" value="<?=$Tentidade->entidade_path?>" />                
                <script>
                	var Fsite = new LiveValidation('Fsite'); 
					Fsite.add( Validate.Exclusion, { within: [ <?=$TvalidaPath?> ], failureMessage: "Em uso" } ); 
				</script>
                <div class="texto_formulario">Habilitar funções padrão do site:</div>                
                <input name="Fsobre" <?php if($Tentidade->conteudo_sobre == "t"){echo"checked=\"checked\"";}?> type="checkbox" value="1" />Sobre a Entidade<br>                
                <input name="Fgestao" <?php if($Tentidade->conteudo_gestao == "t"){echo"checked=\"checked\"";}?> type="checkbox" value="1" />Gestão e Transparência<br>                
                <input name="Fservicos" <?php if($Tentidade->conteudo_servicos == "t"){echo"checked=\"checked\"";}?> type="checkbox" value="1" />Serviços<br>                
                <input name="Fnoticias" <?php if($Tentidade->conteudo_noticias == "t"){echo"checked=\"checked\"";}?> type="checkbox" value="1" />Notícias e Eventos<br>                
                <br>                 
                <div class="texto_formulario">Em casa de não possuir um site, informe um link  :</div>                
				<input name="Flink" id="Flink" type="text" class="componente_miolo" maxlength="300" size="100" value="<?=$Tentidade->entidade_link?>" /><br><br>
				<?php 
				
				//-------------------------------------
				//Configurações específicas de EVENTOS
				//-------------------------------------
				if($Tentidade->entidade_tipo == 7){
				?>               
                    <div id="evento">                
                        <br><hr size="1" width="100%">                
                        <div class="texto_formulario" >CONFIGURAÇÃO DO EVENTO:</div><br> 
                        <div style="width:260px; height:160px; text-align:center; border:1px solid #CCCCCC; background-color:#FFF; vertical-align:middle; display:table-cell;">
                        	<img src="../<?=UPLOAD_EVENTOLOGO.$Tentidade->entidade_logo?>" border="0" width="250" height="150">   
                        </div>
                        logomarca atual
                        <br />
                        <div class="texto_formulario">Imagem de divulga&ccedil;&atilde;o do evento (logomarca):</div>
                        <input type="file" name="Flogo" id="Flogo" /><br />250 x 150 pixels <i>(apenas imagens .jpg ou .png)</i><br />  
                        <br><hr size="1" width="100%">                        
                        <div class="texto_formulario">Configuração do Menu Fixo:</div>
                        <input type="checkbox" name="FeveCal" id="FeveCal" <?php if($Tentidade->entidade_eve_calendario == "t"){echo"checked=\"checked\"";}?> value="1" /> Calend&aacute;rio<br />
                        <input type="checkbox" name="FeveImg" id="FeveImg" <?php if($Tentidade->entidade_eve_imagem == "t"){echo"checked=\"checked\"";}?> value="1" /> Imagens<br />
                        <input type="checkbox" name="FeveMid" id="FeveMid" <?php if($Tentidade->entidade_eve_videos == "t"){echo"checked=\"checked\"";}?> value="1" /> V&iacute;deo<br />
                        <br><hr size="1" width="100%">   
                        <div class="texto_formulario">Esta entidade possui um twitter?</div>                
                        <input name="FflagTwitter" <?php if($Tentidade->entidade_flag_twitter == "t"){echo"checked=\"checked\"";}?> type="radio" value="1"/> Sim &nbsp;&nbsp;<input name="FflagTwitter" type="radio" <?php if($Tentidade->entidade_flag_twitter == "f"){echo"checked=\"checked\"";}?> value="0" />Não<br>                
                        http://www.twitter.com/<input name="Ftwitter" type="text" class="componente_miolo_menor" maxlength="20"  onkeypress="bloqueiaAcentos(this);" value="<?=$Tentidade->entidade_twitter?>" /><br><br>                 
                        <hr size="1" width="100%">   
                        <div class="texto_formulario">Esta entidade possui transmissão ao vivo?</div>                
                        <input name="FflagTransmissao" type="radio" <?php if($Tentidade->entidade_flag_aovivo == "t"){echo"checked=\"checked\"";}?> value="1" /> Sim &nbsp;&nbsp;<input name="FflagTransmissao" type="radio" <?php if($Tentidade->entidade_flag_aovivo == "f"){echo"checked=\"checked\"";}?> value="0" />Não<br>                
                        <input name="Ftransmissao" type="text" class="componente_miolo" maxlength="100" value="<?=$Tentidade->entidade_aovivo?>" /><br>                
                        <i>Endereço Servidor de Stream</i><br />  
                        <div class="texto_formulario">T&iacute;tulo da transmiss&atilde;o:</div>         
                        <input name="FtransTitulo" id="FtransTitulo" type="text" class="componente_miolo" maxlength="100" value="<?=$Tentidade->entidade_eve_titulo_trans?>" /><br>
                        <div class="texto_formulario">Data da transmiss&atilde;o:</div>         
                        <input name="FtransData" id="FtransData" type="text" class="componente_miolo" maxlength="100" value="<?=$Tentidade->entidade_eve_data_trans?>" /><br>
                        <div class="texto_formulario">Descri&ccedil;&atilde;o da transmiss&atilde;o:</div>         
                        <input name="FtransDesc" id="FtransDesc" type="text" class="componente_miolo" maxlength="100" value="<?=$Tentidade->entidade_eve_desc_trans?>" /><br>      
                    </div>             
             	<?php 
				} 
				?>                
             	<br><br>                                   
                <input name="btEditar" value="btEditar" id="btEditar" type="image" src="../layout/imagens/intra_btn_salvar.png">                
                </form>                                     
            </div>        
        </div>    
    </div>
</div>

<script>
function marcaDesmarca(){
	if ( document.getElementById('Fciente').checked ){
		document.getElementById('Fciente').value = 1;
	}else{
		document.getElementById('Fciente').value = 0;
	}
}
</script>

<br class="clearfloat" />
<?php

}else{

	//-------------------------------
	//Dados comuns Entidades/Eventos
	//-------------------------------
	$TidEntidade 	= $_GET['id'];
	$Tsigla 		= strtoupper($_POST['Fsigla']);
	$Ttipo 			= $_POST['Ftipo'];
	$Tnome 			= $_POST['Fnome'];
	$TnomeExibicao  = $_POST['Flinha1'];	
	$Tsite 			= strtolower($_POST['Fsite']);
	$TsiteAtual 	= $_POST['FsiteAtual'];
	$TflagSite 		= $_POST['FflagSite'];	
	$Tlink 			= $_POST['Flink'];	

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
	$Temail 		= $_POST['Femail'];
	$Tfone 			= $_POST['Ffone'];
	$Tfax 			= $_POST['Ffax'];
	$Torganograma   = $_FILES['Farquivo'];	
	
	if( $_POST['Fciente'] = 'on' ){
		$Tciente 		= 1;
	}else{
		$Tciente 		= 0;
	}
	
	//----------------------------
	//Dados exclusivos de eventos
	//----------------------------
	$Tlogo				= $_FILES['Flogo'];
	$TflagLogo			= $_POST['FalteraLogo'];
	$TflagTwitter 		= $_POST['FflagTwitter'];
	$Ttwitter 			= $_POST['Ftwitter'];
	$TflagTransmissao   = $_POST['FflagTransmissao'];
	$Ttransmissao 		= $_POST['Ftransmissao'];
	if($_POST['FeveImg'] != 1){$TflagImagens = 0;}else{$TflagImagens = 1;}
	if($_POST['FeveMid'] != 1){$TflagMidias = 0;}else{$TflagMidias = 1;}
	if($_POST['FeveCal'] != 1){$TflagCalendario = 0;}else{$TflagCalendario = 1;}
	$TtransTitulo		= $_POST['FtransTitulo'];
	$Ttransdata			= $_POST['FtransData'];
	$TtransDesc			= $_POST['FtransDesc'];

	//------------------------------------------------------------------------------
	//Faz tratamendo nos dados do telefone e do fax para inserir corretamente no bd
	//------------------------------------------------------------------------------
	$TfoneFinal = explode("-",$Tfone);
	$Tfone = "48".$TfoneFinal[0].$TfoneFinal[1];
	$TfaxFinal = explode("-", $Tfax);
	$Tfax = "48".$TfaxFinal[0].$TfaxFinal[1];
	
	//------------------------------------------------
	//Separa em pastas diferentes eventos e entidades
	//------------------------------------------------
	switch((int)$Ttipo)
	{
		case 7  : $tipoSite = "sites";
		break;
		default : $tipoSite = "entidades";
	}
	
	//-------------------------------------------------------------
	//Exclui a pasta caso não exista mais o site da entidade/evento
	//-------------------------------------------------------------
	if(($TflagSite == 0) or ($Tsite == "")){
			
		if((int)$Ttipo != 7){
			$deletarsistema   = @unlink("../".$tipoSite."/".$TsiteAtual."/sistema.php");
			$deletarconsultas = @unlink("../".$tipoSite."/".$TsiteAtual."/consultas.php");
		}
		$deletarindex     = @unlink("../".$tipoSite."/".$TsiteAtual."/index.php");
		$deletarbanner    = @unlink("../".$tipoSite."/".$TsiteAtual."/Banner.swf");
		$deletarpasta     = @rmdir("../".$tipoSite."/".$TsiteAtual."/");
		$Tsite = "";
		$TflagSite = 0;

	}
	
	//------------------------
	// altera a pasta do site
	//------------------------
	if(($Tsite != $TsiteAtual) and ($Tsite != "")){
		rename("../".$tipoSite."/".$TsiteAtual."","../".$tipoSite."/".$Tsite."");	
	}
	
	//-----------------------------------------------------
	// verifica se esta sendo solicitado a criação do site 
	//-----------------------------------------------------
	if(($TflagSite == 1) and ($TsiteAtual == "")){ 
		
		$diretorio = "../".$tipoSite."/".$Tsite."/";			
		$dir = @mkdir($diretorio, 0775,true);								
					
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
		
		
		if($Ttipo != 7)
		{
			/**/
			$arquivo_sistema  = '<?php' . ' require_once($_SERVER[\'DOCUMENT_ROOT\']."/scripts/php/config.php");'; 
			$arquivo_sistema .= 'require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");';
			$arquivo_sistema .= '$drive->conecta();';
			$arquivo_sistema .= '$pasta = explode("/" , $_SERVER[\'PHP_SELF\']);';
			$arquivo_sistema .= '$path = $pasta[2];';
			$arquivo_sistema .= '$sql = "SELECT * FROM entidades WHERE entidade_path = \'$Tsite\'";';
			$arquivo_sistema .= '$resultado = $drive->pedido($sql);';
			$arquivo_sistema .= 'require_once("../serv_sistema.php"); ?>';	
			/**/
			
			/**/
			$arquivo_consulta  = '<?php' . ' require_once($_SERVER[\'DOCUMENT_ROOT\']."/scripts/php/config.php");'; 
			$arquivo_consulta .= 'require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");';
			$arquivo_consulta .= '$drive->conecta();';
			$arquivo_consulta .= '$pasta = explode("/" , $_SERVER[\'PHP_SELF\']);';
			$arquivo_consulta .= '$path = $pasta[2];';
			$arquivo_consulta .= '$sql = "SELECT * FROM entidades WHERE entidade_path = \'$Tsite\'";';
			$arquivo_consulta .= '$resultado = $drive->pedido($sql);';
			$arquivo_consulta .= 'require_once("../serv_consulta.php"); ?>';	
			/**/ 
			
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
	
		$sql = "UPDATE 
						entidades
				SET 					  	
						entidade_nome = 	'$Tnome',
						entidade_email = 	'$Temail',
						entidade_sigla = 	'$Tsigla',
						entidade_fone = 	'$Tfone',
						entidade_fax = 		'$Tfax',
						entidade_link = 	'$Tlink',
						entidade_linha_1 = 	'$TnomeExibicao',
						entidade_path = 	'$Tsite',
						entidade_tipo = 	'$Ttipo',
						entidade_flag_site = $TflagSite,
						conteudo_sobre = 	'$Tsobre',
						conteudo_gestao = 	'$Tgestao',						
						conteudo_servicos = '$Tservicos',
						conteudo_noticias = '$Tnoticias'";			
						
						
						if($Ttipo == 7){
							
							$sql .= ", entidade_flag_twitter = '$TflagTwitter',
							entidade_twitter = 	'$Ttwitter',
							entidade_flag_aovivo = '$TflagTransmissao',
							entidade_aovivo = 	'$Ttransmissao',
							entidade_eve_calendario = '$TflagCalendario',
							entidade_eve_imagem = '$TflagImagens',
							entidade_eve_videos = '$TflagMidias',
							entidade_eve_data_trans  = '$Ttransdata',
							entidade_eve_titulo_trans = '$TtransTitulo',
							entidade_eve_desc_trans = '$TtransDesc'"; 
						}
						
				 $sql .= "WHERE entidade_id = $TidEntidade";
			
		$TresultUpdateEnt = $drive->pedido($sql);	

		//-------------------------------------------------------
		//Se foi solicitado a troca da logo do evento então muda 
		//-------------------------------------------------------	
		if(!empty($Tlogo['tmp_name'])){
			
			$sql = "SELECT 
						  entidade_logo
					  FROM 
						  entidades
					  WHERE
						  entidade_id = $TidEntidade
					  ";
			$Tconsulta   = $drive->pedido($sql);
			$TresultLogo = pg_fetch_object($Tconsulta);	  
			$Tarquivo    = "../" . UPLOAD_EVENTOLOGO . $TresultLogo->entidade_logo;
			
			@unlink($Tarquivo); // Exclui logomarca antiga
	
			$Tdir   = UPLOAD_EVENTOLOGO;  //caminhos definidos em /scripts/php/config.php 
			$Text   = "jpg#png";	
			
			$Tcarrega = $drive->upload($T_dir,$Tlogo,$Text,10);
			var_dump($Tcarrega);	
			$TnomeLogo = $Tcarrega[6];
	
			$sql = "UPDATE 
						entidades
					 SET 					  	
						entidade_logo = '$TnomeLogo'
					 WHERE 
						entidade_id = $TidEntidade";
	
			$TresultUpdate = $drive->pedido($sql);
			
			if ($TresultUpdate == true){
				echo"<script>alert(\"Logomarca alterada com Sucesso!\");</script>";
				
			}else{
				echo"<script>alert(\"Não foi possível alterar a Logomarca.\");</script>";
				
			}
		
		}
		
		//-----------------------------------------------
		//Se foi adiocionado um organograma faz o UPLOAD
		//-----------------------------------------------
		if($Tciente == 1){
			
			$sql = "SELECT 
						  entidade_link_pdf 
					  FROM 
						  entidades
					  WHERE
						  entidade_id = $TidEntidade
					  ";
			$Tconsulta = $drive->pedido($sql);
			$TresultPdf = pg_fetch_object($Tconsulta);	  
			$Tarquivo = "../" . UPLOAD_DOCUMENTOS . $TresultPdf->entidade_link_pdf;
		
			unlink($Tarquivo); // Exclui organograma antigo
	
			$Tdir   = CAMINHO_SITE . "/" . UPLOAD_DOCUMENTOS;  //caminhos definidos em /scripts/php/config.php 
			$Text   = "pdf";	
				
			$Tcarrega = $drive->upload($T_dir,$Torganograma,$Text,50);
			print "<pre>";
			print_r( $Tcarrega );
			print "</pre>";
			
			$TnomeOrganograma = $Tcarrega[6];
	
			$sql = "UPDATE 
						entidades
					 SET 					  	
						entidade_link_pdf = '$TnomeOrganograma'
					 WHERE 
						entidade_id = $TidEntidade";
	
			$TresultUpdate = $drive->pedido($sql);
			
			if ($TresultUpdate == true){
				echo"<script>alert(\"Organograma alterado com Sucesso!\");</script>";
				
			}else{
				echo"<script>alert(\"Não foi possível alterar o Organograma.\");</script>";
				
			}
		
		}
		
		if ($TresultUpdateEnt == true){
			echo"<script>alert(\"Entidade Alterada com Sucesso!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=entedit&menu=".$_GET['menu']."&id=".$_GET['id']."\";</script>");		
		}else{
			echo"<script>alert(\"Não foi possível alterar a Entidade.\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=entedit&menu=".$_GET['menu']."&id=".$_GET['id']."\";</script>");	
		}
		
	$drive->close();	
}

?>