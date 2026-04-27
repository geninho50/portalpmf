<?php
			include_once("conexao.php");
			include_once("conexao_ftp.php");
            // Configura o tempo limite para ilimitado
            set_time_limit(0);
   


// Caminho da pasta FTP
$caminho = '/cidadao/moradores_costa/documentos/';

// Aqui o arquivo foi enviado e vamos configurar suas variáveis
$arquivo = $_FILES['arquivo'];

$nome_arquivo = $arquivo['name'];

//$nome_arquivo = md5(time()).'.jpg';

// Tamanho do arquivo enviado
$tamanho_arquivo = $arquivo['size'];

// Nome do arquivo temporário
$arquivo_temp = $arquivo['tmp_name'];

// Extensão do arquivo enviado
$extensao_arquivo = strrchr( $nome_arquivo, '.' );

// O destino para qual o arquivo será enviado
$destino = $caminho . $nome_arquivo;

$nomefinal = $caminho . md5(time()) .strtolower($extensao_arquivo);
echo $nomefinal;

// Realiza a conexão
$conexao_ftp = ftp_connect( $servidor_ftp );

// Tenta fazer login
$login_ftp = @ftp_login( $conexao_ftp, $usuario_ftp, $senha_ftp );

// Envia o arquivo
if ( @ftp_put( $conexao_ftp, $nomefinal, $arquivo_temp, FTP_BINARY ) ) {
	// Se for enviado, mostra essa mensagem
	echo 'Arquivo enviado com sucesso!';
} else {
	// Se não for enviado, mostra essa mensagem
	echo 'Erro ao enviar arquivo!';
}

// Fecha a conexão FTP
ftp_close( $conexao_ftp );
