<?php
			include_once("conexao.php");
			include_once("conexao_ftp.php");
            // Configura o tempo limite para ilimitado
            set_time_limit(0);
   


// Extensões de arquivos permitidas
$extensoes_autorizadas = array( '.exe', '.jpg', '.mp4', '.mkv', '.txt' );

// Caminho da pasta FTP
$caminho = 'upload/arquivos';

/* 
Se quiser limitar o tamanho dos arquivo, basta colocar o tamanho máximo 
em bytes. Zero é ilimitado
*/
$limitar_tamanho = 0;

/* 
Qualquer valor diferente de 0 (zero) ou false, permite que o arquivo seja 
sobrescrito
*/
$sobrescrever = 0;

/*-----------------------------------------------------------------------------*
 * Parte 2: Configurações do arquivo
/*----------------------------------------------------------------------------*/

// Verifica se o arquivo não foi enviado. Se não; termina o script.
if ( ! isset( $_FILES['arquivo'] ) ) {
	exit('Nenhum arquivo enviado!');
}

// Aqui o arquivo foi enviado e vamos configurar suas variáveis
$arquivo = $_FILES['arquivo'];

// Nome do arquivo enviado
$nome_arquivo = $arquivo['name'];

// Tamanho do arquivo enviado
$tamanho_arquivo = $arquivo['size'];

// Nome do arquivo temporário
$arquivo_temp = $arquivo['tmp_name'];

// Extensão do arquivo enviado
$extensao_arquivo = strrchr( $nome_arquivo, '.' );

// O destino para qual o arquivo será enviado
$destino = $caminho . $nome_arquivo;

/*-----------------------------------------------------------------------------*
 *  Parte 3: Verificações do arquivo enviado
/*----------------------------------------------------------------------------*/

/* 
Se a variável $sobrescrever não estiver configurada, assumimos que não podemos 
sobrescrever o arquivo. Então verificamos se o arquivo existe. Se existir; 
terminamos aqui. 
*/

if ( ! $sobrescrever && file_exists( $destino ) ) {
	exit('Arquivo já existe.');
}

/* 
Se a variável $limitar_tamanho tiver valor e o tamanho do arquivo enviado for
maior do que o tamanho limite, terminado aqui.
*/

if ( $limitar_tamanho && $limitar_tamanho < $tamanho_arquivo ) {
	exit('Arquivo muito grande.');
}

/* 
Se as $extensoes_autorizadas não estiverem vazias e a extensão do arquivo não 
estiver entre as extensões autorizadas, terminamos aqui.
*/

if ( ! empty( $extensoes_autorizadas ) && ! in_array( $extensao_arquivo, $extensoes_autorizadas ) ) {
 
	echo "
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=cadastro.php'>
	<script type=\"text/javascript\">
	$(\"#msg-error\").html('<div class=\"alert alert-danger\" role=\"alert\"><b>CPF</b> já em uso!</div>');
	</script>
";	

	

	exit();
}

/*-----------------------------------------------------------------------------*
 * Parte 4: Conexão FTP
/*----------------------------------------------------------------------------*/

// Realiza a conexão
$conexao_ftp = ftp_connect( $servidor_ftp );

// Tenta fazer login
$login_ftp = @ftp_login( $conexao_ftp, $usuario_ftp, $senha_ftp );

// Se não conseguir fazer login, termina aqui
if ( ! $login_ftp ) {exit('Usuário ou senha FTP incorretos.');}

// Envia o arquivo
if ( @ftp_put( $conexao_ftp, $destino, $arquivo_temp, FTP_BINARY ) ) {
	// Se for enviado, mostra essa mensagem
	echo 'Arquivo enviado com sucesso!';

	echo "
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=cadastro.php'>
	<script type=\"text/javascript\">
	$(\"#msg-error\").html('<div class=\"alert alert-danger\" role=\"alert\"><b>CPF</b> já em uso!</div>');
	</script>
";	










	
} else {
	// Se não for enviado, mostra essa mensagem
	echo 'Erro ao enviar arquivo!';

	echo "
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=cadastro.php'>
	<script type=\"text/javascript\">
	$(\"cadastro.php#msg-error2\").html('<div class=\"alert alert-danger\" role=\"alert\"><b>CPF</b> já em uso!</div>');
	</script>
";	
}

// Fecha a conexão FTP
ftp_close( $conexao_ftp );
