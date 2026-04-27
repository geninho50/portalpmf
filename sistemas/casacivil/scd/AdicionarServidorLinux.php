<?php 
session_start();
include "backend/db.php"; 
include "backend/funcoes.php";
if(!$_SESSION['login']){
	header('Location: ../loginADM.php');
}
$id = $_GET['id'];
$idBotSub = "submit";
if($id != null){
	$sql = $db->prepare("SELECT * FROM servidoreslinux where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);

	if($data != ''){
		$name_vm       = $data['name_vm'];
		$host_name     = $data['host_name'];
		$ip            = $data['ip'];
		$disco         = $data['disco'];
		$memoria       = $data['memoria'];
		$core          = $data['core'];
		$os            = $data['os'];
		$vm_serial     = $data['vm_serial'];
		$server_serial = $data['server_serial'];
		$servicos      = $data['servicos'];
		$login         = $data['login'];
		$custo         = $data['custo'];
	}

	$idBotSub = "update";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<title>Adicionar Servidor Linux</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="headerLogin bg-primary">
		<input type='button' value='Sair' class='sair btn btn-default btn-xs'>
		<input type='button' value='Home' class='home btn btn-default btn-xs'>
		<div id="nomeUsuario"><strong>Nome: </strong><?php echo $_SESSION['login'];?></div>
	</div>
	<div class="alert alert-danger hide" id="error"></div>
	<div  role="form">
		<div class="formulario boxDecisao">
			<label>Name VM (CIASC): <input value="<?=$name_vm?>" id="name_vm" class="form-control" type="text" name="name_vm" /></label>
			<label>Host Name:       <input value="<?=$host_name?>" id="host_name" class="form-control" type="text" name="host_name"></label>
			<label>IP Address:      <input value="<?=$ip?>" id="ip" class="form-control" type="text" name="ip" /></label>
			<label>DISCO:           <input value="<?=$disco?>" id="disco" class="form-control" type="text" name="disco"></label>
			<label>Memoria:         <input value="<?=$memoria?>" id="memoria" class="form-control" type="text" name="memoria"></label>
			<label>CORE:            <input value="<?=$core?>" id="core" class="form-control" type="text" name="core"></label>
			<label>OS:              <input value="<?=$os?>" id="os" class="form-control" type="text" name="os"></label>
			<label>VM Serial:       <input value="<?=$vm_serial?>" id="vm_serial" class="form-control" type="text" name="vm_serial"></label>
			<label>Server SerialKey:<input value="<?=$server_serial?>" id="server_serial" class="form-control" type="text" name="server_serial"></label>
			<label>Serviços:        <input value="<?=$servicos?>" id="servicos" class="form-control" type="text" name="servicos"></label>
	  		<label>Login:           <input value="<?=$login?>" id="login" class="form-control" type="text" name="login"></label>
	  		<label>Centro de Custo: <input value="<?=$custo?>" id="custo" class="form-control" type="text" name="custo"></label><br>
	  		<?php if($id != null){?>
	  		<input type="button" name="update" onclick="update()" id="update" class="btn btn-primary botao" value="Atualizar" />
	 	    <?php } else{?>
	 	    <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
	 	    <?php }?>
	 	    <button type="button" class="btn btn-primary botao" id="voltar">Voltar</button>
		</div>
	</div>
<script type="text/javascript">
	$('.home').bind('click',function(){
		location.href = "decidirADM.php";
	});

	$('.sair').bind('click',function(){
		location.href = "loginADM.php";
	});	

	$('#voltar').bind('click', function(){
		location.href = "servidoresLinux.php";
	});

	$('#submit').bind('click',function(){
		$('#error').addClass('hide');
		var err = '';
		var obj = {
			name_vm      : $('#name_vm').val(),
			host_name    : $('#host_name').val(),
			ip           : $('#ip').val(),
			disco        : $('#disco').val(),
			memoria      : $('#memoria').val(),
			core         : $('#core').val(),
			os           : $('#os').val(),
			vm_serial    : $('#vm_serial').val(),
			server_serial: $('#server_serial').val(),
			servicos     : $('#servicos').val(),
			login        : $('#login').val(),
			custo        : $('#custo').val()
		};
		
		$.post( "backend/formServLinuxReq.php", obj).done(function( data ) {	
		   	var retorno = jQuery.parseJSON(data);
		   	if(retorno.success == 1){
		   		location.href = "servidoresLinux.php";
		   	}else{
		   		$('#error').text(retorno.error).removeClass('hide');	
		    }

		});
	});

	function update(){
		$('#error').addClass('hide');
		var err = '';
		var id = "<?=$id?>";
		var obj = {
			id           : id, 
			name_vm      : $('#name_vm').val(),
			host_name    : $('#host_name').val(),
			ip           : $('#ip').val(),
			disco        : $('#disco').val(),
			memoria      : $('#memoria').val(),
			core         : $('#core').val(),
			os           : $('#os').val(),
			vm_serial    : $('#vm_serial').val(),
			server_serial: $('#server_serial').val(),
			servicos     : $('#servicos').val(),
			login        : $('#login').val(),
			custo        : $('#custo').val()
		};
		
		$.post( "backend/editarServidorLinux.php", obj).done(function( data ) {	
		   	var retorno = jQuery.parseJSON(data);
		    if(retorno.success == 1){
		    	location.href = "servidoresLinux.php";
		    }else{
		    	$('#error').text(retorno.error).removeClass('hide');
		    }
		});	 
	}
</script>
</body>
</html>