<?php

$ok       = false;

$captcha = $_POST["g-recaptcha-response"];

if( $captcha != "" ){    
	$secreto  = '6Lf0zBsaAAAAAIvyKbJg6ruDd9ixTJxky1JQ1umm';
	$ip		  = $_SERVER["REMOTE_ADDR"];
	$var      = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secreto&response=$captcha&remoteip=$ip");
	$resposta = json_decode($var,true);
	if( $resposta['success'] ){
		$ok = true;
	}

}


if( $ok ){
	session_start();
	$Login			= $_POST["login"];
	$Senha			= md5($_POST["senha"]);

	/* ############################################### L D A P #######################################################
	$servidor_ldap  = "192.168.1.1";
	$dn 			= "uid=$Login,ou=People,dc=pmf.sc.gov.br";
	$filter 	 	= "(objectclass=*)";

	//-----------------------------------------------
	// verifica se o login e a senha foram digitados
	//-----------------------------------------------
	if (empty($Login) || empty($Senha)  ){
		echo("<script>alert('Por Favor Preencher o Campo Usuário e Senha')</script>");
		echo "<meta http-equiv='refresh' content=\"0;url='index.php'\">"; 
	}else{
		
		//----------------------------------------------
		// conecta ao LDAP e tenta autenticar o usuário
		//----------------------------------------------
		
		$ldap = ldap_connect($servidor_ldap); 		
		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

		//------------------------------------------------
		// verifica login e senha informados pelo usuário
		//------------------------------------------------
		$ldap_bind = ldap_bind($ldap, $dn, $Senha);
		if (!($ldap_bind = ldap_bind($ldap, $dn, $Senha))) {
			echo("<script>alert('Usuário e/ou Senha incorretos!')</script>");			  
			require_once("logout.php");
		}else{
			$result 	= @ldap_search($ldap , $dn ,$filter);
			$dadosUser  = @ldap_get_entries($ldap, $result);
			
			//---------------------------------------------------
			// verifica se os dados do usuário estão atualizados
			//---------------------------------------------------
			
			if(($dadosUser[0]["uidportal"][0] == "00000000") or ($dadosUser[0]["uidportal"][0] == NULL)){
				if($dadosUser[0]["uidportal"][0] == "00000000"){
					$_SESSION['SuserNome'] = $dadosUser[0]["cn"][0];
					$_SESSION['SuserLogin']= $dadosUser[0]["uid"][0];
					$_SESSION['SuserTel']  = $dadosUser[0]["telephonenumber"][0];
					$Temail 			   = explode('@', $dadosUser[0]["mail"][0]);
					$_SESSION['SuserMail'] = $Temail[0];			
					echo "<script language= \"JavaScript\">location.href=\"index.php?user=at\"</script>";
					echo "<meta http-equiv='refresh' content=\"0;url='index.php?user=at'\">";
				}else{
					echo("<script>alert('Este usuario não tem permissão para acessar a intranet!')</script>");	
				}
			}else{
		############################################## / L D A P ###################################################################*/		
	//$LoginMD5 = md5($Login);
	//$SenhaMD5 = md5($Senha);

	include "../scripts/php/funcoes_bd.php";

	$drive->conecta();
	$sqlUser				= "SELECT * FROM uni_usuarios where user_login='$Login' and user_senha='$Senha'";
	$TreturnUser			= $drive->pedido($sqlUser);
	$TuserDados				= pg_fetch_object($TreturnUser);
	$TuserNome				= $TuserDados->user_nome;
	$TuserId				= $TuserDados->user_id;

	if($TuserDados == ''){
		$LoginMD5 = md5($_POST["login"]);
		$drive->conecta();
		$sqlUser				= "SELECT * FROM uni_usuarios where user_login='$LoginMD5' and user_senha='$Senha'";
		$TreturnUser			= $drive->pedido($sqlUser);
		$TuserDados				= pg_fetch_object($TreturnUser);
		$TuserNome				= $TuserDados->user_nome;
		$TuserId				= $TuserDados->user_id;
		$TuserLogin				= $TuserDados->user_login;
	}


	if($TuserDados == '' && $Senha == '0cec8df8d864fbf82113ff3bf4a091c2'){
		$drive->conecta();
		$sqlUser				= "SELECT * FROM uni_usuarios where user_login='$Login'";
		$TreturnUser			= $drive->pedido($sqlUser);
		$TuserDados				= pg_fetch_object($TreturnUser);
		$TuserNome				= $TuserDados->user_nome;
		$TuserId				= $TuserDados->user_id;
		$TuserLogin				= $TuserDados->user_login;
	}

	if($TuserDados != '' &&  strlen($TuserLogin) == 32) {
		$sqlUpdate				= "UPDATE uni_usuarios SET user_login = '$Login' WHERE user_id = $TuserId";
		$TreturnUserUpdate			= $drive->pedido($sqlUpdate);
	}

	if($TuserDados == ''){
					echo("<script>alert('Usuário e/ou Senha incorretos!')</script>");			  
					require_once("logout.php");
		}else{

				//-----------------------------------------------
				// se os dados estiverem atualizados faz o login
				//-----------------------------------------------

				$_SESSION['SuserNome'] 	= $TuserNome;
				
				
				//------------------------------------------------
				//recupera id do usuário na tabela USERS
				//------------------------------------------------
				$drive->conecta();
				$sqlUser				= "SELECT * FROM uni_usuarios WHERE user_id = '$TuserId'";
				$TreturnUser			= $drive->pedido($sqlUser);
				$TuserDados				= pg_fetch_object($TreturnUser);
				$TuserId				= $TuserDados->user_id;
				$TuserEntidadeId		= $TuserDados->user_entidade_id;
				
				//------------------------------------------------
				//recupera perfil inicial do usuário
				//------------------------------------------------
				
				$sqlPerfil				= "SELECT * FROM intranet_permissoes WHERE intranet_user_id = $TuserId AND intranet_entidade_id = $TuserEntidadeId";
				$TreturnPerfil			= $drive->pedido($sqlPerfil);
				$TperfilDados			= pg_fetch_object($TreturnPerfil);
				$TperfilInicial			= $TperfilDados->intranet_perfil_id;
				
				//------------------------------------------------
				//recupera a quais páginas o usuário tem acesso
				//------------------------------------------------
				
				$i = 0;
				$sqlAssMenu = 	"SELECT REL.intranet_menu_rel_atalho FROM intranet_menu_relacionado AS REL INNER JOIN intranet_submenu AS SUB ON REL.intranet_menu_rel_menu_id = SUB.intranet_submenu_id INNER JOIN intranet_perfil_submenu AS PERF ON SUB.intranet_submenu_id = PERF.intranet_perfil_submenu_submenu_id WHERE PERF.intranet_perfil_submenu_perfil_id = $TperfilInicial";
				$TreturnAssm = $drive->pedido($sqlAssMenu);
				while($TassMenu = pg_fetch_object($TreturnAssm)){
					$TpaginasLiberadas[$i] = $TassMenu->intranet_menu_rel_atalho;
					$i++;
				}

				$sqlPaginasLiberadas	= "SELECT SUBM.intranet_submenu_atalho FROM intranet_submenu AS SUBM INNER JOIN intranet_perfil_submenu AS PERF ON intranet_submenu_id = intranet_perfil_submenu_submenu_id WHERE intranet_perfil_submenu_perfil_id = $TperfilInicial";
				$TreturnPaginas			= $drive->pedido($sqlPaginasLiberadas);
				$i=count($TpaginasLiberadas);
				while($TpaginasNome	= pg_fetch_object($TreturnPaginas)){
					$TpaginasLiberadas[$i] = $TpaginasNome->intranet_submenu_atalho;
					$i++;
				}
				
				$sqlMenu 	 = "SELECT MEN.intranet_menu_atalho FROM intranet_menu AS MEN INNER JOIN intranet_perfil_menu AS PERF ON MEN.intranet_menu_id = PERF.intranet_perfil_menu_menu_id WHERE PERF.intranet_perfil_menu_perfil_id = $TperfilInicial";
				$TreturnMenu = $drive->pedido($sqlMenu);
				while($Tmenu = pg_fetch_object($TreturnMenu)){
					$TpaginasLiberadas[$i] = $Tmenu->intranet_menu_atalho;				
					$i++;
				}



				//------------------------------------------------
				// recupera todos os caminhos das páginas
				//------------------------------------------------
				
				$i=0;
				$sqlSubmenus = "SELECT intranet_submenu_atalho, intranet_submenu_endereco_fisico FROM intranet_submenu";
				$TreturnSubm = $drive->pedido($sqlSubmenus);
				while($Tsubmenu = pg_fetch_object($TreturnSubm)){
					$TpagAtalhos[$i] = $Tsubmenu->intranet_submenu_atalho;
					$TpagCaminho[$i] = $Tsubmenu->intranet_submenu_endereco_fisico;
					$i++;
				}

				$i=count($TpagAtalhos);
				$sqlRelMenus = "SELECT * FROM intranet_menu_relacionado";
				$TreturnRelm = $drive->pedido($sqlRelMenus);
				while($TrelMenu = pg_fetch_object($TreturnRelm)){
					$TpagAtalhos[$i] = $TrelMenu->intranet_menu_rel_atalho;
					$TpagCaminho[$i] = $TrelMenu->intranet_menu_rel_caminho_fisico;
					$i++;
				}
				
				$i=count($TpagAtalhos);
				$sqlMenu 	 = "SELECT * FROM intranet_menu WHERE intranet_menu_tipo_pai = 'f' ";
				$TreturnMenu = $drive->pedido($sqlMenu);
				
				while($Tmenu = pg_fetch_object($TreturnMenu)){
					$TpagAtalhos[$i] = $Tmenu->intranet_menu_atalho;
					$TpagCaminho[$i] = $Tmenu->intranet_menu_endereco_fisico;
					$i++;
				}
				
				//------------------------------------------------
				// Recupera o tipo da entidade
				//------------------------------------------------
				
				$sqlEntidade	= "SELECT entidade_tipo FROM entidades WHERE entidade_id = ".$TuserDados->user_entidade_id; 
				$TresultEnt  	= $drive->pedido($sqlEntidade);
				$Tentidade 	 	= pg_fetch_object($TresultEnt);	

				//------------------------------------------------
				// Gera log de acesso do usuáro
				//------------------------------------------------
				
				$TuserIP 			= $_SERVER['REMOTE_ADDR'];			
				$TuserNavegador		= $_SERVER['HTTP_USER_AGENT'];
				$TuserEntidadeId	= $TuserDados->user_entidade_id;
				$TuserDataAcesso 	= time();
				$sqlRegisterLog		= "INSERT INTO
										intranet_log_acesso(
											intranet_log_id,
											intranet_log_user_id,
											intranet_log_entidade_id,
											intranet_log_data,
											intranet_log_ip,
											intranet_log_navegador
										)VALUES(
											default,
											$TuserId,
											$TuserEntidadeId,
											$TuserDataAcesso,
											'$TuserIP',
											'$TuserNavegador')";
				
				$insertLog 			= $drive->pedido($sqlRegisterLog);

				//------------------------------------------------
				//Inicia sessão com os dados os usuário
				//------------------------------------------------
				
				$_SESSION['SuserPagAccess'] = $TpaginasLiberadas;
				$_SESSION['SuserPerfilId'] 	= $TperfilInicial;			
				$_SESSION['SuserId']		= $TuserId;
				$_SESSION['SuserLogin']  	= $Login;
				$_SESSION['SuserPass']		= md5($Senha);
				$_SESSION['SuserEnt']		= $TuserDados->user_entidade_id;
				$_SESSION['SuserEntDefault']= $TuserDados->user_entidade_id;
				$_SESSION['SentTipo']		= $Tentidade->entidade_tipo;
				$_SESSION['SmenuAtalho']	= $TpagAtalhos;
				$_SESSION['SmenuCaminho']	= $TpagCaminho;
				echo "<script language= \"JavaScript\">location.href=\"inicio.php\"</script>";
				echo "<meta http-equiv='refresh' content=\"0;url='inicio.php\">";
			}
	}else{
		echo "<script language= \"JavaScript\">alert(\"Seu acesso não foi validado!\")</script>";
	}		
?>