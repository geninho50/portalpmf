<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">alterar senha</div>
	<div id="margem_direita"><br>
		<div class="conteudo_abas">
			<form method="post">
            <div id="conteudo_dados" style="display:inline">
	            
	            
	            <div class="texto_formulario">Nome do Usuário:</div>
                <input name="NameUser" id="NameUser" type="text" class="componente_miolo_menor" maxlength="" />
                <script type="text/javascript">
		            var FnewPass2 = new LiveValidation('FnewPass2');
		            FnewPass2.add(Validate.Confirmation, { match: 'FnewPass1', failureMessage: "Senhas Incompativeis"} );
		        </script>
	           
				<br>
				<div class="texto_formulario">Nova Senha:</div>
				<input name="FnewPass" id="FnewPass" type="password" class="componente_miolo_menor" maxlength="10" />
                <script type="text/javascript">
					var FnewPass1= new LiveValidation('FnewPass1');
					FnewPass1.add(Validate.Presence, {failureMessage: "Obrigatorio"});
				</script>                 
                <br>
				<br>
				<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btAltera" id="btAltera" value="btAltera" /> 
			</div>
            </form>
		</div>  
	</div>
</div>  
<br class="clearfloat" />
<?php
}else{

	
	$Tsenha		= $_POST['FnewPass'];
	$TnomeUser	= $_POST['NameUser'];
	$Tsenha 	= $Tsenha;

	//$conexao = $drive->conecta();
	//$insetQr = $drive->pedido( "UPDATE uni_usuarios SET user_senha = '$Tsenha' WHERE user_login = '$userLogin';" );

	//################################################### L D A P ################################################################
	$sdn		= "uid=$TnomeUser,ou=People,dc=pmf.sc.gov.br";
	$serv_ldap 	= "192.168.1.1";
	$filter 	= "(objectclass=*)";
	$ldap 		= ldap_connect($serv_ldap);
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	$res		= ldap_bind($ldap, "uid=admin,ou=People,dc=pmf.sc.gov.br", "CafenoBule");
	
	$uid 		= "uid=$TnomeUser,ou=People,dc=pmf.sc.gov.br";

	$entry[userPassword]	= "{crypt}". crypt($Tsenha);
	$ult_linha 				= exec("/usr/bin/smbencrypt $Tsenha");
	$lmpass 				= substr($ult_linha,0,32);
	$ntpass 				= substr($ult_linha,33,65);
	$entry[sambaLMPassword]	= $lmpass;
	$entry[sambaNTPassword]	= $ntpass;
	$res 					= ldap_modify( $ldap, $uid, $entry );
	//################################################### / L D A P ###############################################################

	if($res){
		echo("<script>alert(\"Senha atualizada com sucesso!\");</script>");
		echo("<script>window.location = \"inicio.php?pagina=senhaldap&menu=11\";</script>");	
	}else{
		echo("<script>alert(\"Servidor Ocupado\\n\\nTente novamente dentro de alguns instantes\");</script>");
		echo("<script>window.location = \"inicio.php?pagina=senhaldap&menu=11\";</script>");
	}
}
?>
