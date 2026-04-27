<?php
session_start();
include_once './conexao.php';
/*--------------------------------------------------------------------------------*
 * Parte 1: Configurações do Envio de arquivos via FTP com PHP
 * Configura o tempo limite para ilimitado
 * IP do Servidor FTP - Usuário e senha para o servidor FTP - Caminho da pasta FTP
/*--------------------------------------------------------------------------------*/
set_time_limit(0);
$servidor_ftp = '200.192.64.3';
$usuario_ftp = 'redemobilidade';
$senha_ftp   = 'rm#1010';
$caminho = 'upload/arquivos/';

/*-----------------------------------------------------------------------------*
 * Parte 2: Configurações do arquivo
 * Verifica se o arquivo não foi enviado. Se não; termina o script.
/*----------------------------------------------------------------------------*/

if ( ! isset( $_FILES['arquivo'] ) ) {
	exit('Nenhum arquivo enviado!');
}

/*--------------------------------------------------------------------------------*
 * CRIA PROXIMO ID
 * ler da base o ultimo id
 * seta id + 1
/*--------------------------------------------------------------------------------*/

$sql = "SELECT id FROM lacustre.viagens WHERE id=(select max(id) from lacustre.viagens)";
$stmt = $conn->prepare ($sql);
$stmt->execute(); 
$row = $stmt->fetch();
$id=$row["id"]+1;

/*--------------------------------------------------------------------------------*
 * COLETA DADOS DO FORM
/*--------------------------------------------------------------------------------*/

$data_viagem = $_POST['data'];
$data_viagem = date('Y-m-d', strtotime($data_viagem));
$horario = $_POST['horario'];
$modalidade = $_POST['modalidade'];
$sentido = $_POST['sentido'];
$num_ficha = $_POST['num_ficha'];
$id_embarcacao = $_POST['id_embarcacao'];
$arquivo = $_FILES['arquivo'];

/*--------------------------------------------------------------------------------*
 * CRIA VARIAVEIS
/*--------------------------------------------------------------------------------*/
$contrato = '743.2020';// numero do contatro das viagens
$id_viagem = $id.".". $data_viagem .".". $horario.".". $sentido.".".$id_embarcacao;
$status = 1; // status de analise do registro
$data_criado = date("Y-m-d H:i:s"); // data de efetivação do cadastro

/*--------------------------------------------------------------------------------*
 * PROCESSA ARQUIVO ENVIADO
 * Nome do arquivo enviado
 * Tamanho do arquivo enviado
 * Nome do arquivo temporário
 * Extensão do arquivo enviado
 * O destino para qual o arquivo será enviado
/*--------------------------------------------------------------------------------*/
$nome_arquivo = $arquivo['name'];
$tamanho_arquivo = $arquivo['size'];
$arquivo_temp = $arquivo['tmp_name'];
$extensao_arquivo = strrchr( $nome_arquivo, '.' );
$destino = $caminho .time(md5($nome_arquivo)).$extensao_arquivo;

/*-----------------------------------------------------------------------------*
 * Parte 4: Conexão FTP
 * Realiza a conexão  | Tenta fazer login | OK continua senao encerra
 * Envia o arquivo e processa envio de dados para tabela
/*----------------------------------------------------------------------------*/
$conexao_ftp = ftp_connect( $servidor_ftp );
$login_ftp = @ftp_login( $conexao_ftp, $usuario_ftp, $senha_ftp );

if ( ! $login_ftp ) {
	exit('Usuário ou senha FTP incorretos.');
}

if ( @ftp_put( $conexao_ftp, $destino, $arquivo_temp, FTP_BINARY ) ) {

	$sql = "INSERT INTO lacustre.viagens (id, id_viagem, id_embarcacao, data_viagem, horario, data_criado, sentido, modalidade,  imagem, status, contrato, num_ficha) VALUES (:id, :id_viagem, :id_embarcacao, :data_viagem, :horario, :data_criado, :sentido, :modalidade, :imagem, :status, :contrato, :num_ficha)";
	$stmt = $conn->prepare ($sql);
	$stmt->bindValue(':id', $id);
	$stmt->bindValue(':id_viagem', $id_viagem);
	$stmt->bindValue(':id_embarcacao', $id_embarcacao);
	$stmt->bindValue(':imagem', $destino);
	$stmt->bindValue(':data_viagem', $data_viagem);
	$stmt->bindValue(':horario', $horario);
	$stmt->bindValue(':data_criado', $data_criado);
	$stmt->bindValue(':sentido', $sentido);
	$stmt->bindValue(':status', 1, PDO::PARAM_INT);
	$stmt->bindValue(':contrato', $contrato);
	$stmt->bindValue(':modalidade', $modalidade);
	$stmt->bindValue(':num_ficha', $num_ficha, PDO::PARAM_INT);
	$stmt->execute();
	$count = $stmt->rowCount();

} else {
	// Se não for enviado, mostra essa mensagem
	echo 'Erro ao enviar arquivo!';
}

// Fecha a conexão FTP
ftp_close( $conexao_ftp );




?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> <?php
		if($count != 0){
			echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=form_viagem-6.php?id_viagem=". $id_viagem . "&id=". $id. "' > 
					";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=form_viagem-5.php>
				<script type=\"text/javascript\">
					alert(\"Erro ao cadastrar.\");
				</script>
			";	
		}?>
	</body>
</html>