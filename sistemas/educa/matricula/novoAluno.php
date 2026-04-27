<?php
session_name('ma');
session_start();

session_destroy();

//$fechar = date('d-m-Y') >= '12-02-2014';

//if($fechar != true){
	header("Location: identificacaoAluno.php?curso=1&ano=2014&periodo=1&tipoMatricula=1");
// } else {
// 	header("Location: index.php");
// }

?>
