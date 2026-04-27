<?php
    require_once("../../../scripts/php/funcoes_bd.php"); 
    require_once("../../../scripts/php/config.php");  
$conexao = $drive->conecta();

$sql	= "SELECT * FROM users";
$TresultUsers  	= $drive->pedido($sql);
$usuarios 	 	= pg_fetch_all($TresultUsers);

foreach($usuarios   as $value ){
		$user_id = $value['user_id'];
		$sql	= "SELECT * FROM uni_usuarios WHERE user_id = $user_id";
		$TresultUniUsers  	= $drive->pedido($sql);
		$uni_usuarios 	 	= pg_fetch_all($TresultUniUsers);
		
		if($uni_usuarios == ''){
			$user_nome =  $value['user_nome'];
			$user_senha =  $value['user_senha'];
			$user_login =  $value['user_login'];
			$user_fone =  $value['user_fone'];
			$user_entidade_id =  $value['user_entidade_id'];
			$user_foto_link =  $value['user_foto_link'];
			$user_grupo_id =  $value['user_grupo_id'];
			if ($user_grupo_id == '') {
				$user_grupo_id = 1;
			}
			$user_setor_id =  $value['user_setor_id'];
			$user_cargo_id =  $value['user_cargo_id'];
			$user_data_nascimento =  $value['user_data_nascimento'];
			if ($user_data_nascimento == '') {
				$user_data_nascimento = 'NULL';
			}
			$user_data_ult_atualizacao =  $value['user_data_ult_atualizacao'];
			if ($user_data_ult_atualizacao == '') {
				$user_data_ult_atualizacao = 'NULL';
			}
			$user_quem =  $value['user_quem'];
			if($user_quem == 'f'){
				$user_quem = 'false';
			}
			if($user_quem == 't'){
				$user_quem = 'true';
			}
			if($user_quem == ''){
				$user_quem = 'false';
			}

			$user_foto =  $value['user_foto'];
			$user_curriculo =  $value['user_curriculo'];
			$user_maticula =  $value['user_maticula_ldap'];
			$user_email =  $value['user_email'];
			$user_data_atualizacao =  '';
			if ($user_data_atualizacao == '') {
				$user_data_atualizacao = 'NULL';
			}
			$user_cpf =  $value['user_cpf'];
			$user_gab =  $value['user_gab'];
			if($user_gab == 'f'){
				$user_gab = 'false';
			}
			if($user_gab == 't'){
				$user_gab = 'true';
			}
			if($user_gab == ''){
				$user_gab = 'false';
			}
			$user_bloqueado =  $value['user_bloqueado'];
			if($user_bloqueado == 'f'){
				$user_bloqueado = 'false';
			}
			if($user_bloqueado == 't'){
					$user_bloqueado = 'true';
			}

			if($user_bloqueado == ''){
					$user_bloqueado = 'false';
			}
			$insetQr = $drive->pedido( "INSERT INTO uni_usuarios(
	            user_id, user_nome, user_senha, user_login, user_fone, user_entidade_id, 
	            user_foto_link, user_grupo_id, user_setor_id, user_cargo_id, 
	            user_data_nascimento, user_data_ult_atualizacao, user_quem, user_foto, 
	            user_curriculo, user_maticula, user_email, user_data_atualizacao, 
	            user_cpf, user_gab, user_bloqueado)
			    VALUES ( $user_id, '$user_nome', '$user_senha', '$user_login',
						 '$user_fone', '$user_entidade_id', '$user_foto_link',
						 $user_grupo_id, $user_setor_id, $user_cargo_id,
						 '$user_data_nascimento', '$user_data_ult_atualizacao',
						 $user_quem, '$user_foto', '$user_curriculo', '$user_maticula',
						 '$user_email', $user_data_atualizacao, '$user_cpf',
						 $user_gab, $user_bloqueado)" );

				var_dump("INSERT INTO uni_usuarios(
	            user_id, user_nome, user_senha, user_login, user_fone, user_entidade_id, 
	            user_foto_link, user_grupo_id, user_setor_id, user_cargo_id, 
	            user_data_nascimento, user_data_ult_atualizacao, user_quem, user_foto, 
	            user_curriculo, user_maticula, user_email, user_data_atualizacao, 
	            user_cpf, user_gab, user_bloqueado)
			    VALUES ( $user_id, '$user_nome', '$user_senha', '$user_login',
						 '$user_fone', '$user_entidade_id', '$user_foto_link',
						 $user_grupo_id, $user_setor_id, $user_cargo_id,
						 $user_data_nascimento, $user_data_ult_atualizacao,
						 $user_quem, '$user_foto', '$user_curriculo', '$user_maticula',
						 '$user_email', $user_data_atualizacao, '$user_cpf',
						 $user_gab, $user_bloqueado)");
			echo "<br><br><br>";
	}
}