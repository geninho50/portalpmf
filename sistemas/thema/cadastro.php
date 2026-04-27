<? 
session_start();

include "backend/db.php"; 
include "backend/funcoes.php";

$id = $_GET['id'];
$idBotSub = "submit";
if($id != null){
	$sql = $db->prepare("SELECT * FROM thema where id = $id");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);

	if($data != ''){
		$nome           = $data['nome'];
		$telefone       = $data['telefone'];
		$cpf            = $data['cpf'];
		$orgao          = $data['orgao'];
		$movimentacao   = $data['movimentacao'];
		$status         = $data['status'];
	}

	$idBotSub = "update";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro Thema</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="estilos.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="alert alert-danger hide" id="error"></div>
	<div class="form" role="form">
		<div class="caixa">
			<h1>Solicitação de Acesso</h1>
			<label>Nome Completo:                      </label><input value="<?=$nome?>" id="nome" class="form-control" type="text"/><br>
			<label>Telefone:                           </label><input value="<?=$telefone?>" id="telefone" class="form-control" type="text"/><br>
			<label>CPF:                                </label><input value="<?=$cpf?>" id="cpf" class="form-control" type="text"/><br>
			<label>Secretaria/Órgão que irá trabalhar: </label><input value="<?=$orgao?>" id="orgao" class="form-control" type="text"/><br>
			<label>Movimentações que serão efetuadas*: </label>
			<p class="mini">* Neste item é necessário que seja informado com detalhes o que o usuário precisará inserir ou consultar no sistema, exemplo: Inserir Empenho, Liquidação, Convênios,  Pedido de compra, Consultas na contabilidade, Consultas no Compras. Outra forma possível é informar que necessita das mesmas categorias que outro usuário (informando o nome completo deste outro usuário).</p>
			<textarea value="<?=$movimentacao?>" id="movimentacao"
			class="form-control"><?=$movimentacao?></textarea><br>
				
			<?php if($id != null){?>
		  		<?php if ($status != 1) { ?>
		  		<input type="button" name="aprovar" onclick="aprovar()" id="aprovar" class="btn btn-success botao" value="Aprovar" />
		  		<?php } else { ?>
		  		<input type="button" name="revogar" onclick="revogar()" id="revogar" class="btn btn-danger botao" value="Revogar" />
		  		<?php }?>
		  		<input type="button" name="update" onclick="update()" id="update" class="btn btn-primary botao" value="Atualizar" />
	 	    <?php } else{?>

	 	    <div class="responsabilidade">
	 	    	<h3>TERMO DE RESPONSABILIDADE</h3>

				<p>Política de uso do Sistema Integrado de Gestão Municipal (SIGM).

				<p>Declaro ter solicitado permissão de acesso para trabalhar dentro do Sistema Integrado de Gestão Municipal da Prefeitura Municipal de Florianópolis me comprometendo a:

				<p><strong>a)</strong> Acessar o Sistema Integrado de Gestão Municipal somente com autorização (usuário/senha), por necessidade de serviço ou por determinação expressa de superior hierárquico de minha Pasta;</p>
				<p><strong>b)</strong> Não me ausentar da estação de trabalho sem encerrar a sessão de uso do SIGM, certificando-me de que o sistema necessita de novo login e senha para ser acessado, garantindo assim a impossibilidade de acesso indevido por terceiros;</p>
				<p><strong>c)</strong> Não revelar minha senha de acesso ao Sistema Integrado de Gestão Municipal a ninguém, sob qualquer hipótese e tomar o máximo de cuidado para que ela permaneça somente de meu conhecimento;</p>
				<p><strong>d)</strong> Alterar minha senha com certa frequência ou sempre que tenha suspeita de descoberta por terceiros, não usando combinações simples que possam ser facilmente descobertas;</p>
				<p><strong>e)</strong> Respeitar as normas de segurança e restrições do SIGM, solicitando, sempre que necessária, nova permissão de acesso com a devida autorização;</p>
				<p><strong>f)</strong> Responder, em todas as instâncias, pelas consequências das ações realizadas com o meu usuário;</p>
				<p><strong>g)</strong> Solicitar o bloqueio do meu usuário e senha quando findar minhas atividades dentro do sistema, em casos de mudança de cargo, exoneração, aposentadoria etc.</p>

			</div>

			<div class="check">
				<input type="checkbox" id="check">
				Declaro ter ciência e estar de acordo com os procedimentos acima descritos, comprometendo-me a respeitá-los e cumpri-los plena e integralmente.
			</div>

	 	    	<input type="button" disabled name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
	 	    <?php }?>
				<input type="button" name="voltar" id="voltar" class="btn btn-primary botao" value="Voltar" /><br>
		</div>
	</div>
	<script>
		$('#check').bind('click',function(){
	    	if($(this).is(':checked') ){
	    		$('#submit').prop( "disabled", false );
	    	}else{
	    		$('#submit').prop( "disabled", true );
	    	}
	    });
		
       	$('#cpf').mask("999.999.999-99");
       	$('#telefone').mask("(99) 9999-9999");

		$('#voltar').bind('click', function(){
			window.location.href = "cadastrados.php";
		});

		$('#submit').bind('click',function(){
			$('#error').addClass('hide');
			var err = '';
			var obj = {
				nome           : $('#nome').val(),
				telefone       : $('#telefone').val(),
				cpf            : $('#cpf').val(),
				orgao          : $('#orgao').val(),
				movimentacao   : $('#movimentacao').val()
			};
			
			$.post( "backend/cadastroReq.php", obj).done(function( data ) {	
			   	var retorno = jQuery.parseJSON(data);
			   	if(retorno.success == 1){
			   		location.href = "termoPDF.php";
			   	}else{	
			   		$('#error').text(retorno.error).removeClass('hide');
			   		window.scrollTo(0, 0);
			    }

			});
		});

		function update(){
		$('#error').addClass('hide');
		var err = '';
		var id = "<?=$id?>";
		var obj = {
			id             : id, 
			nome           : $('#nome').val(),
			telefone       : $('#telefone').val(),
			cpf            : $('#cpf').val(),
			orgao          : $('#orgao').val(),
			movimentacao   : $('#movimentacao').val()
		};
		
		$.post( "backend/editarCadastro.php", obj).done(function( data ) {	
		   	var retorno = jQuery.parseJSON(data);
		    if(retorno.success == 1){
		    	location.href = "cadastrados.php";
		    }else{
		    	$('#error').text(retorno.error).removeClass('hide');
		    }
		});	 
	}

	function aprovar(){
		$('#error').addClass('hide');
		var err = '';
		var id = "<?=$id?>";
		var obj = {
			id       : id, 
			status   : $('#status').val()
		};
		
		$.post( "backend/aprovar.php", obj).done(function( data ) {	
		   	var retorno = jQuery.parseJSON(data);
		    if(retorno.success == 1){
		    	location.href = "cadastrados.php";
		    }else{
		    	$('#error').text(retorno.error).removeClass('hide');
		    }
		});	 
	}

	function revogar(){
		$('#error').addClass('hide');
		var err = '';
		var id = "<?=$id?>";
		var obj = {
			id       : id, 
			status   : $('#status').val()
		};
		
		$.post( "backend/revogar.php", obj).done(function( data ) {	
		   	var retorno = jQuery.parseJSON(data);
		    if(retorno.success == 1){
		    	location.href = "cadastrados.php";
		    }else{
		    	$('#error').text(retorno.error).removeClass('hide');
		    }
		});	 
	}

	</script>
</body>
</html>