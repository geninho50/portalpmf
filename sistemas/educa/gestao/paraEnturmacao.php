<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
	session_unset(); 
	session_destroy();
	header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['aut_gm'])) {
	if ($_SESSION['aut_gm'] != true) {
		header('Location: index.php');
	}
} else {
	header('Location: index.php');
}

if(isset($_GET['id'])){
	include 'fnc/buscaInfoVaga.php';
	$infoVaga = buscaInfoVaga($_GET['id']);

	include 'fnc/buscaInfoAluno.php';
	$infoAluno = buscaInfoAluno($infoVaga[1]);

	include 'fnc/buscaPais.php';
	$pais = buscaPais($infoAluno[2]);

	include 'fnc/buscaResponsavel.php';
	$mae = buscaResponsavelAluno($infoVaga[1], 1);
	if($mae == false) {
		$mae = 'null';
		$maeReside = 0;
	} else {
		if($mae[1] == 1){
			$maeReside = 1;
		} else {
			$maeReside = 0;
		}
		if($mae[2] == 1){
			$acompanha = 'MAE';
		}
		$mae = $mae[0];
	}

	$pai = buscaResponsavelAluno($infoVaga[1], 2);
	if($pai == false) {
		$pai = 'null';
		$paiReside = 0;
	} else {		
		if($pai[1] == 1){
			$paiReside = 1;
		} else {
			$paiReside = 0;
		}
		if($pai[2] == 1){
			$acompanha = 'PAI';
		}
		$pai = $pai[0];
	}

	$resp = buscaResponsavelAluno($infoVaga[1], 3);
	if($resp == false) {
		$resp = 'null';
		$respReside = 0;
	} else {		
		if($resp[1] == 1){
			$respReside = 1;
		} else {
			$respReside = 0;
		}
		if($resp[2] == 1){
			$acompanha = 'RESPONSAVEL';
		}
		$resp = $resp[0];
	}

	$mae = 'null';
	$pai = 'null';
	$resp = 'null';


	include_once('fnc/connect.php');

	$sql = sprintf("SELECT * FROM educacao.pais
		where ds_cod_alpha3 = '%s'", mysql_real_escape_string($pais[4]));

	$resultado = mysql_query($sql);

	$row = true;
	while ($row != FALSE) {
		$row = mysql_fetch_row($resultado);
		if ($row[0] != '') {
			$pais_educacao = $row;
		}
	}

	mysql_close();

	include 'fnc/buscaAluno.php';
	$aluno = buscaAluno($infoVaga[1]);

	$sql = sprintf("INSERT INTO `matricula`.`para_enturmacao`
		(`id_aluno`,
			`id_inscricao`,
			`data`)
	VALUES
	(%s,
		%s,
		sysdate())"
	, mysql_real_escape_string($infoVaga[1])
	, mysql_real_escape_string($aluno[2]));

	$resultado = mysql_query($sql);

mysql_close();

  $link = mysql_connect('72.55.168.187', 'suporte', 'T$b3pkG6_V2F');
	
	$sql = sprintf("INSERT INTO `educacao`.`pessoa`
		(`id`,
			`dataCadastramento`,
			`nome`,
			`telefoneComercial`,
			`email`,
			`idEnderecoComercial`)
	VALUES
	(%s,
		sysdate(),
		'%s',
		null,
		null,
		null)"
	, mysql_real_escape_string($infoVaga[1])
	, mysql_real_escape_string($aluno[0]));

	$resultado = mysql_query($sql);

	$sql = sprintf("INSERT INTO `educacao`.`pessoafisica`
		(`id`,
			`sexo`,
			`dataNascimento`,
			`ufNascimento`,
			`cidadeNascimento`,
			`paisOrigem`)
	VALUES
	(%s,
		'%s',
		STR_TO_DATE('%s', '%s'),
		%s,
		%s,
		%s)
	"
	, mysql_real_escape_string($infoVaga[1])
	, mysql_real_escape_string($infoAluno[0])
	, mysql_real_escape_string($aluno[1])
	, mysql_real_escape_string('%Y-%m-%d')
	, mysql_real_escape_string($infoAluno[4])
	, mysql_real_escape_string($infoAluno[5])
	, mysql_real_escape_string($pais_educacao[0]));

	$resultado = mysql_query($sql);

	$sql = sprintf("INSERT INTO `educacao`.`aluno`
		(`id`,
			`matricula`,
			`idAlunoMae`,
			`idAlunoPai`,
			`idAlunoResponsavel`,
			`idUnidadeEscolar`)
	VALUES
	(%s,
		%s,
		%s,
		%s,
		%s,
		%s)
	"
	, mysql_real_escape_string($infoVaga[1])
	, mysql_real_escape_string($aluno[2])
	, mysql_real_escape_string($mae)
	, mysql_real_escape_string($pai)
	, mysql_real_escape_string($resp)
	, mysql_real_escape_string($infoVaga[7]));

	$resultado = mysql_query($sql);

	$sql = sprintf("INSERT INTO `educacao`.`matricula`
		(`idAluno`,
			`idUnidadeEscolar`,
			`idAno`,
			`idPeriodo`,
			`idEtapa`,
			`ativo`,
			`enturmado`)
	VALUES
	(%s,
		%s,
		1,
		2,
		%s,
		1,
		0)
	"
	, mysql_real_escape_string($infoVaga[1])
	, mysql_real_escape_string($infoVaga[7])
	, mysql_real_escape_string($infoVaga[5]));

	$resultado = mysql_query($sql);

	$sql = sprintf("INSERT INTO `educacao`.`alunobasicofundamental`
		(`id`,
			`resideComMae`,
			`resideComPai`,
			`resideComResponsavel`,
			`acompanhamentoEscolarPor`)
	VALUES
	(%s,
		%s,
		%s,
		%s,
		'%s')
	"
	, mysql_real_escape_string($infoVaga[1])
	, mysql_real_escape_string($maeReside)
	, mysql_real_escape_string($paiReside)
	, mysql_real_escape_string($respReside)
	, mysql_real_escape_string($acompanha));

	$resultado = mysql_query($sql);

	mysql_close();


	$_SESSION['msg']['alunoParaEnturmacao'] = true;
	
	header("Location: listaDeMatriculados.php?escola=".$infoVaga[7]."&ano=0&fase=".$infoVaga[5]);
}

?>