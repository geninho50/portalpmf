<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
        require ("DB_mysql.php"); 
        $obj = new DB_mysql; 
        $tamanho = strlen($login); 
 		
		$senhagm4 = $_POST['xsenhagm4'];
		$matriculagm4 = $_POST['matriculagm4devolucao'];
		$senhaCorretagm4 = md5($senhagm4);
		
		$senhaguarda = $_POST['xsenhaguarda'];
		$matriculaguarda = $_POST['xmatriculadevolucao'];
		$senhaCorretaguarda = md5($senhaguarda);
		//Pega a data atual
		
		$sql = "SELECT * FROM guarda_gmf where matricula=$matriculagm4";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$senhaBanco = $linha["senha"];
		}
		
		$sqlG = "SELECT * FROM guarda_gmf where matricula=$matriculaguarda";
		$resultadoG = $obj->executaQuery($sqlG);
		$linhaG = mysql_fetch_array($resultadoG);
		if( $linhaG )
		{
			$senhaBancoG = $linha["senha"];
		}
		
		if($senhaCorretagm4==$senhaBanco)
		{
			if($senhaCorretaguarda==$senhaBancoG)
			{
				if(isset($_POST)) { 
					$i = 0; 
					foreach($_POST['id'] as $v) 
					{ 
						$data_atual = date("Y-m-d");
						$hora_atual = date("H:i:s");
						$status = 2;
						$query ="update pagamentodiario set matriculadevolucao='".$matriculaguarda."', matriculagm4devolucao='" .$matriculagm4. "',qtddevolucao='" .$_POST['qtddevolucao'][$i]. "',datadevolucao='" .$data_atual. "',horadevolucao='" .$hora_atual. "',status='" .$status. "' where id = '" .$v. "'";
						$obj->executaQuery($query); 
						$i++; 
					} 
					echo "<script>alert('Material devolvido com sucesso com sucesso!');</script>";     
				} 
			}else{
				echo "<script>alert('Senha ou matricula do guarda esta incorreta!');</script>";    
				echo "<script> window.location.href = '../controle/devolucao_material_diario.php' </script>";
			}
		}else{
			echo "<script>alert('Senha ou matricula do GM4 esta incorreta!');</script>";    
			echo "<script> window.location.href = '../controle/devolucao_material_diario.php' </script>";                   
		}
?>