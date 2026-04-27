<!doctype html>
<html lang='pt-BR'>
<head>
<meta charset="UTF-8">
	<title>Terreno no cemitério</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/estilo.css">
</head>

<body>
	<div class="container">
		<img src="img/Logo PMF-01.png" class="center-block" />
		<div class="alert alert-danger hide" id="error"></div>
		<div class="form" role="form">

		<strong><h2>Cadastro</h2></strong>

		<div class="row">
			<div class="col-md-6">
				<label>Nome do Falecido:</label>
				<input value="<?=$nome?>" id="nome" class="form-control" type="text"/>
			</div>

			<div class="col-md-6">
				<label>Data de Falecimento:</label>
				<input value="<?=$dataFalecimento?>" id="dataFalecimento" class="form-control" type="text"></input>
			</div>
		</div>

		<h3>Dados do Terreno</h3>

		<div class="row">
			<div class="col-md-6">
				<label>Cemitério:</label>
				<input value="<?=$rg?>" id="via" class="form-control" type="text"/>
			</div>
			<div class="col-md-6">
				<label>Via:</label>
				<input value="<?=$cpf?>" id="quadra" class="form-control" type="text"/>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<label>Quadra:</label>
				<input value="<?=$cpf?>" id="quadra" class="form-control" type="text"/>
			</div>
			<div class="col-md-6">
				<label>Sepultura:</label><input value="<?=$sepultura?>" id="sepultura" class="form-control" type="text"/>
			</div>
		</div>

		<h3>Dados do Declarante</h3>

		<div class="row">
			<div class="col-md-6">
				<label>Nome:</label>
				<input value="<?=$nome?>" id="nome" class="form-control" type="nome"/>
			</div>
			<div class="col-md-6">
				<label>Data de Nascimento:</label>
				<input value="<?=$dataNascimento?>" id="dataNascimento" class="form-control" type="text"/>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<label>CPF:</label>
				<input value="<?=$cpf?>" id="cpf" class="form-control" type="text"/>
			</div>
			<div class="col-md-6">
				<label>Telefone:</label>
				<input value="<?=$telefone?>" id="telefone" class="form-control" type="text"/>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<label>Endereço:</label>
				<input value="<?=$endereco?>" id="endereco" class="form-control" type="text"/>
			</div>
			<div class="col-md-6">
				<label>Grau de Parentesco:</label>
				<input value="<?=$parentesco?>" id="parentesco" class="form-control" type="text"/>
			</div>
		</div>

        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />

<br>
<br>
	<p> Ocupando uma área de mais de 90 mil metros quadrados, o <strong>Cemitério do Itacorubi</strong> ( o único administrado pela SESP) é o maior de Santa Catarina,mais de 65 mil pessoas estão enterradas no local.

	Segundo estimativas da administração do CI, cerca de 700 túmulos não estão cadastrados em seus registros.  Não há como saber se o contrato de aforamento é do tipo permanente (pertence à família) ou temporário (pertence ao município, que pode retirar os ossos após determinado período liberando o terreno para novo sepultamento).

	Hoje <strong>NÃO há vagas no CI</strong>, e a liberação de túmulos (caso dois) é <strong>URGENTE</strong>. Por isso a necessidade deste cadastramento via internet, que será amplamente divulgado na mídia.

	Cabe destacar que vocês do GE poderão sugerir à Secretaria do Continente a utilização deste formulário para o cadastramento do cemitério daquela região.</p>
	</div>

</body>

<script>
    $('#submit').bind('click',function(){
      console.log("CHEGOU");
        $('#error').addClass('hide');
        var err = '';
        var obj = {
            nome                : $('#nome').val(),
            dataFalecimento     : $('#dataFalecimento').val(),
            via                 : $('#via').val(),
            quadra              : $('#quadra').val(),
            sepultura           : $('#sepultura').val(),
            nomeDeclarante      : $('#nomeDeclarante').val(),
            dataNascimento      : $('#dataNascimento').val(),
            cpf                 : $('#cpf').val(),
            telefone            : $('#telefone').val(),
            endereco            : $('#endereco').val(),
            parentesco          : $('#parentesco').val()
        };

    });
    
</script>

</html>

