<?php

/*-----------------------------------------------------------------------------*
 *          Credenciais de acesso ao Servidor FTP para envio das imagens
/*-----------------------------------------------------------------------------*/

// IP do Servidor FTP
$servidor_ftp = '192.168.173.5';

// Usuário e senha para o servidor FTP
$usuario_ftp = 'IPUFNT\michel';
$senha_ftp   = '@mob1973';
$conexao_ftp = ftp_connect( $servidor_ftp );
			
?>
