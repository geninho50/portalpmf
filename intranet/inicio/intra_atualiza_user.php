<?php
//------------------------------------------
// Página implementada em : 09/06/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>
<script>

function mascara_fone(form){
	if(form.fone.value.length==4){
		form.fone.value=form.fone.value + "-";
	}
	if(form.fone.value.length==9){
		form.fone.value=form.fone.value;
	}
} 

function mascara_data(form){
	if(form.nascimento.value.length==2){
		form.nascimento.value=form.nascimento.value + "/";
	}
	if(form.nascimento.value.length==5){
		form.nascimento.value=form.nascimento.value + "/";
	}
} 

function verifica_cpf(form){
	if(form.cpf.value.length == 11){
		if(vercpf(form.cpf.value)){
			document.form.submit();
		}else{
			errors="1";
			if (errors) 
				alert('CPF inválido!');
			document.retorno = (errors == '');
		}
	}else{
		return true;
	}
}

function vercpf (cpf){
	if(cpf.length != 11 || 
	   cpf == "00000000000" || 
	   cpf == "11111111111" || 
	   cpf == "22222222222" || 
	   cpf == "33333333333" || 
	   cpf == "44444444444" || 
	   cpf == "55555555555" || 
	   cpf == "66666666666" || 
	   cpf == "77777777777" || 
	   cpf == "88888888888" || 
	   cpf == "99999999999")
		return false;
		add = 0;
		for (i=0; i < 9; i ++)
			add += parseInt(cpf.charAt(i)) * (10 - i);
		rev = 11 - (add % 11);
		if (rev == 10 || rev == 11)
			rev = 0;
		if (rev != parseInt(cpf.charAt(9)))
			return false;
		add = 0;
		for (i = 0; i < 10; i ++)
			add += parseInt(cpf.charAt(i)) * (11 - i);
		rev = 11 - (add % 11);
		if (rev == 10 || rev == 11)
			rev = 0;
		if (rev != parseInt(cpf.charAt(10)))	
			return false;
	return true;
}
</script>

<?php
if(!isset($_POST['btAlt_x'])){
echo("<script>alert('Para continuar, por favor atualize seu cadastro!')</script>");	
?>

<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">atualizar dados de usu&aacute;rio</div>
    <div id="margem_direita">
		<div class="conteudo_abas">
            <form method="post" name="atualiza" name="atualiza">
            <div id="conteudo_dados" style="display:inline">
            	<b>IMPORTANTE:</b> Preencha os dados corretamente, pois alguns deles serão exibidos no Portal da Prefeitura.<br /><br />
				<div class="texto_formulario">Nome:</div>
				<input name="Fnome" id="nome" type="text" class="componente_miolo" maxlength="200" value="<?=$_SESSION['SuserNome']?>" /><br>
				<script type="text/javascript">
					var nome= new LiveValidation('nome');
					nome.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script> 
                <div class="texto_formulario">CPF:</div>
				<input name="cpf" id="cpf" type="text" class="componente_miolo_menor" maxlength="11" onkeyup="verifica_cpf(form)"/> apenas numeros
				<script type="text/javascript">
					var cpf= new LiveValidation('cpf');
					cpf.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					cpf.add(Validate.Length, {minimum: 11, tooShortMessage: "CPF Inválido"} ); 
				</script> 
                <div class="texto_formulario">Entidade:</div>
				<select name="secretaria" id="secretaria" class="componente_miolo">
                	<option value="999999">=== Selecione uma Entidade ===</option>
                </select><br /><b><font color="#FF0000">Atenção:</font></b> Após escolher e salvar a Entidade a qual pertence, ela não poderá ser alterada.<br>                 
                <script type="text/javascript">
					var secretaria= new LiveValidation('secretaria');
					secretaria.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script> 
                <div class="texto_formulario">Setor:</div>	
                <select name="setor" id="setor" class="componente_miolo">
					 <option>=== Selecione uma Entidade ===</option>
                </select><br /><b><font color="#FF0000">Atenção:</font></b> Selecione corretamente o setor a qual voc&ecirc; esta alocado.<br>
                <script type="text/javascript">
					var setor= new LiveValidation('setor');
					setor.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script> 
                <div class="texto_formulario">Cargo:</div>
				<select name="cargo" id="cargo" class="componente_miolo">
					 <option>=== Selecione uma Entidade ===</option>
                </select><br /><b><font color="#FF0000">Atenção:</font></b> Se o cargo que ocupa não consta nesta relação <b>NÃO</b> continue o cadastro, <br />
               <script type="text/javascript">
					var cargo= new LiveValidation('cargo');
					cargo.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Solicite a inclusão pelo e-mail ao lado informando qual a sua Entidade.<br>
				<div class="texto_formulario">E-mail:</div>
				<input name="email" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$_SESSION['SuserMail']?>"  style="background-color:#EAE9DB;"/> @pmf.sc.gov.br<br>
				<div class="texto_formulario">Telefone:</div>
				<input name="fone" id="fone" type="text" class="componente_miolo_menor" maxlength="9" value="<?=$_SESSION['SuserTel']?>" onkeyup="mascara_fone(form)" /> Ex: 3251-0000<br> 
				<script type="text/javascript">
					var fone= new LiveValidation('fone');
					fone.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					fone.add(Validate.Length, {minimum: 9, tooShortMessage: "Telefone Inválido"} );
					fone.add(Validate.Format, {pattern: new RegExp(/^\d{4}-?\d{4}$/), failureMessage: "Telefone Inválido" }); 
				</script> 
                <div class="texto_formulario">Data de Nascimento:</div>
				<input name="nascimento" id="nasc" type="text" class="componente_miolo_menor" maxlength="10" onkeyup="mascara_data(form)" /> Ex: 30/12/1975
				<script type="text/javascript">
					var nasc= new LiveValidation('nasc');
					nasc.add(Validate.Presence, {failureMessage: "Obrigatorio"});
					nasc.add(Validate.Length, {minimum: 10, tooShortMessage: "Data Inválida"} );
					nasc.add(Validate.Format, {pattern: new RegExp(/^([0-9]|[0,1,2][0-9]|3[0,1])\/([0][1-9]|[1][0-2])\/\d{4}$/), failureMessage: "Data Inválida" }); 
				</script> 
                <br><br>
				<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btAlt" id="btAlt" value="btAlt" />
			</div>
            </form>
    	</div>
	</div>
</div> 
<?php
}else{
	include "../scripts/php/funcoes.php";
	
	//dados alterados pelo usuário
	
	$TuserNome		= $_POST['Fnome'];
	$Tcpf			= md5($_POST['cpf']);
	$TuserEntidade	= $_POST['secretaria'];
	$TuserSetor 	= $_POST['setor'];
	$TuserCargo		= $_POST['cargo'];
	$TuserEmail		= $_SESSION['SuserMail'];
	$TuserFone		= $_POST['fone'];
	$TuserNasc		= inverteDate($_POST['nascimento']);
	$TuserMatricula	= $_SESSION['SuserLogin'];
	$TdataAtualiza	= time();
	
	//dados complementares
	
	$TdataUltAlt	= date("Y/m/d");
	$TuserQuem		= 0;
	$TuserGabinete	= 0;
	$TuserFoto		= NULL;
	$TuserCur		= NULL;
	
	//------------------------------------------------
	//sql alteração dados usuário na base da intranet
	//------------------------------------------------
	
	$sql = "INSERT INTO
				uni_usuarios(
					user_id,
					user_nome,
					user_entidade_id,
					user_setor_id,
					user_cargo_id,
					user_data_nascimento,
					user_data_ult_atualizacao,
					user_quem,
					user_gabinete,
					user_foto,
					user_curriculo,
					user_maticula,
					user_email,
					user_telefone,
					user_data_atualizacao,
					user_cpf
			)VALUES(
				 default,
				'$TuserNome',
				 $TuserEntidade,
				 $TuserSetor,
				 $TuserCargo,
				'$TuserNasc',
				'$TdataUltAlt',
				'$TuserQuem',
				'$TuserGabinete',
				'$TuserFoto',
				'$TuserCur',
				'$TuserMatricula',
				'$TuserEmail',
				'$TuserFone',
				$TdataAtualiza,
				'$Tcpf')";
		
	$isr = $drive->pedido($sql);

	//------------------------------------------------
	//atualização dos dados na base do LDAP
	//------------------------------------------------
	
	/*recupera ID do usuário*/
	$sqlUserId 	= "SELECT user_id FROM uni_usuarios WHERE user_nome = '$TuserNome'";
	$TresultUs 	= $drive->pedido($sqlUserId);
	$TobjUserId = pg_fetch_object($TresultUs);
	$TuserId	= $TobjUserId->user_id;	
	
	/*recupera nome da entitdade a qual pertence o usuário*/
	$sqlEntId 	= "SELECT entidade_nome FROM entidades WHERE entidade_id = $TuserEntidade";
	$TresulTEn 	= $drive->pedido($sqlEntId);
	$TobjEntId  = pg_fetch_object($TresulTEn);
	$TentName	= $TobjEntId->entidade_nome;
	
	/*recupera ao qual setor o usuário esta subordinado*/
	$sqlSetId 	= "SELECT setor_nome FROM setores WHERE setor_id = $TuserSetor";
	$TresulTSt 	= $drive->pedido($sqlSetId);
	$TobjSetNo  = pg_fetch_object($TresulTSt);
	$TsetName	= $TobjSetNo->setor_nome;
	
	/*recupera o cargo que o usuário exerce*/
	$sqlCartId 	= "SELECT cargo_nome FROM cargos WHERE cargo_id = $TuserCargo";
	$TresulTCa 	= $drive->pedido($sqlCartId);
	$TobjCarId  = pg_fetch_object($TresulTCa);
	$TcarName	= $TobjCarId->cargo_nome;	

	$TnomeUser	= $_SESSION['SuserLogin'];
	$serv_ldap 	= "192.168.1.1";
	$filter 	= "(objectclass=*)";
	$ldap 		= ldap_connect($serv_ldap);
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	$res		= ldap_bind($ldap, "uid=admin,ou=People,dc=pmf.sc.gov.br", "CafenoBule");	
	
	$uid 		= "uid=$TnomeUser,ou=People,dc=pmf.sc.gov.br";
	
	$entry[cn]					= $_POST['Fnome'];
	$entry[uidportal]			= $TuserId;
	$entry[uidPortalEntidade]	= $TentName;
	$entry[uidPortalSetor]		= $TsetName;
	$entry[uidPortalCargo]		= $TcarName;
	$entry[telephoneNumber] 	= $_POST['fone'];

	$res 		= ldap_modify( $ldap, $uid, $entry );

	//------------------------------------------------
	//libera acesso ao perfil básico 
	//------------------------------------------------
	
	$TperfilId 	= 2;
	$sqlPerfil 	= "INSERT INTO
					intranet_permissoes(
				  		intranet_perm_id,
						intranet_user_id,
						intranet_perfil_id,
						intranet_entidade_id
				  )VALUES(
				  	default,
					$TuserId,
					$TperfilId,
					$TuserEntidade					
				  )";
	
	$Tperm		= $drive->pedido($sqlPerfil);
			
	if($isr == TRUE){
		echo("<script>alert(\"Dados atualizados com sucesso!\\n\\nPara acessar a INTRANET faça o login novamente.\");</script>");
		echo("<script>window.location = \"index.php\";</script>");	
	}else{
		echo("<script>alert(\"Servidor Ocupado\\n\\nTente novamente dentro de alguns instantes\");</script>");
		echo("<script>window.location = \"index.php\";</script>");
	}
}
?>

