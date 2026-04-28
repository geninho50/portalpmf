<?php

class banco{

	var $endereco;
	var $login;
	var $senha;
	var $porta;
	var $banco;
	var $conexao;
	var $pedido;
	
	//*Construtor da classe, cria-se o objeto apartir deste ponto.
	//*Padrão: $objeto = new banco(endereco,porta,login,senha,banco);
	function banco($lendereco,$lporta,$llogin,$lsenha,$lbanco){
		$this->endereco = $lendereco;
		$this->porta 	= $lporta;
		$this->login 	= $llogin;
		$this->senha 	= $lsenha;
		$this->banco 	= $lbanco;
	}
	//*Fim do construtor*//
	
	
	//*Função responsável por conectar na base.
	//*Retorno: True se houve sucesso, False se deu piroca.
	function conecta(){
		$sql = "host = $this->endereco 
				port=$this->porta 
				dbname=$this->banco 
				user=$this->login 
				password=$this->senha";

		if($this->conexao=pg_connect($sql)){
			return true;
		}else{
		 	return false;
		}
	}
	/*Fim da função conecta*/
	
	
	//*Limpa a memória de uma query efetuada
	function limpa() {
		pg_free_result($this->pedido);
	}
	//*Fim limpa()
	
	//*Fecha a conexão com o banco
	function close() {
		if(!pg_close($this->conexao)) {
			print pg_last_error($this->conexao);
		}
	}
	//*Fim close()
	
	//*Efetua uma requisição ao banco
	//*Uso:  $var = $objeto(requisicao)
	function pedido($lpedido){
		return $this->pedido=pg_query($this->conexao,$lpedido);
	}
	//*Fim pedido()
	
	 //*Conta quantos registros existem em uma determinada tabela
	 //*Forma: $total = $objeto->quantidade(tabela)
	function GetRegistros($tabela){
		$sql = "SELECT COUNT(*) as total FROM $tabela";
		$retorno = $this->pedido($sql);
		$total = pg_fetch_object($retorno);
		return $total->total;
	} 
	//*fim GetRegistros
	
	/*
		Função responsável por deletar itens de uma determinada tabela.
		Nome da função: deleta()
		Tipo de retorno: true para sucesso false para problema.
		Parâmetros:
			$tabela = tabela na qual iremos deletar o item
			$parametro = apartir de qual item da tabela iremos deletar
			$valor = deletar item da tabela aonde $parametro for igual a $valor.
	*/
	function deleta($tabela,$parametro,$valor){
		
		$sql = "DELETE FROM $tabela WHERE $parametro = '$valor'";
		
		if($retorno = $this->pedido($sql)){
			return true;
		}else{
			return false;
		}
	
	}
	
	/*
		Função responsável por visualizar um determinado dado em um campo de tabela.
		Nome da função: verdado()
		Tipo de retorno: variável de acordo com o dado requisitado.
		Parâmetros:
			$tabela: tabela a ser trabalhada.
			$campo: o nome do campo que está dentro desta tabela.
			$parametro: o dado que está dentro de $campo será retornado de acordo com o 	$parametro.
		
	*/
	
	/*Funcao que redireciona para algum lugar*/
	function redirect($site){
		echo("
			<script language=\"javascript\">
				location.href=\"$site\"
			</script>
		");
	}
	/**/
	
	/*
	Função que realiza o upload de um arquivo para uma determinada pasta
	Nome: upload();
	Parâmetros:
		$dir: indica a pasta aonde o arquivo será salvo
		$arquivo: passa o arquivo vindo pelo formulário
		$extensao: faz o upload somente se a extensão do arquivo for igual a $extensao
		$tamanho: faz o upload somente se o tamanho do arquivo for igual a $tamanho	(em MB)
		
		Esta função retorna ao ponto aonde foi chamada um vetor sendo que este vetor compreende:
		
		$retorno[0]: O tamanho do arquivo enviado.
		$retorno[1]: True: Sucesso no envio, False: Falha no envio
		$retorno[2]: Armazena uma mensagem para o usuário visualizar o status do upload.
		$retorno[3]: Armaneza o nome do documento enviado (Nome real enviado ao form)
		$retorno[4]: Armazena o nome que será salvo no servidor
		$retorno[5]: É o caminho completo do arquivo
	*/
	function upload($dir,$arquivo,$extensao,$tamanho){
		$pasta = $dir; 
		$megabyte  = 1048576;
		$tamanho   = $tamanho * $megabyte;
		$retorno[0] = $arquivo["size"]; //indice 0 armazena o tamanho do arquivo
		$extensaoAux = explode("#",$extensao);
		
		
		
		if($arquivo["size"] > $tamanho) {
			$msg = "<center>Erro no envio do anexo<br />Seu anexo não poderá ser maior que <b>" . $tamanho/$megabyte ."mb</b>!</center>";
			$retorno[1] = false; //indice 1 armazena se houve sucesso ou não
			$retorno[2] = utf8_encode($msg); //indice 2 armazena a mensagem 
		}else{
			/*Verificamos a existencia do diretorio, senão o criamos*/
				if(!is_dir($pasta)){
					mkdir($pasta,0777,true);	
				}
			/********************************************************/
		
			/*Preciso da extensão do arquivo para concatenar com o MD5*/
				$ext = explode('.',$arquivo["name"]);
				$ext = array_reverse($ext);
				$retorno[3] = $arquivo["name"]; //indice 3 armazena o nome do documento
				
			/**********************************************************/ 
				$agora = date("d_m_Y_G.i.s."); //30_07_2009_15.56.24
				
				//30_07_2009_15.56.24.0af40893800eff7040ad858b9527610a.jpg 
				$nome  = $agora . md5($arquivo["tmp_name"]); 
	   		    $retorno[4] = $nome; //indice 4 armazena o nome que será salvo no servidor				
				
				//../imagens/jpg/
				$pasta = $pasta . $ext[0] . "/";
				
					if(!is_dir($pasta)){
					  mkdir($pasta,0777,true);	
					}
				
				//../imagens/jpg/30_07_2009_15.56.24.0af40893800eff7040ad858b9527610a.jpg
				$caminho = $pasta . $nome . "." . $ext[0];
				$retorno[5] = $caminho;
				
			/*Verifico a extensão do arquivo, se esta for RTF então fazemos o upload*/
				
				for($i=0;$i<count($extensaoAux);$i++){

					if(eregi($extensaoAux[$i], $arquivo["name"])) {
						#Copiamos o arquivo para a pasta setada mais acima
						copy($arquivo["tmp_name"],$caminho);
						$msg = "<center>Arquivo enviado com sucesso !</center>";
						$retorno[2] = utf8_encode($msg); //indice 2 armazena a mensagem
						$retorno[1] = true;
						$chave = true;
						break 1;
					}else{
						$chave = false;
					}					
				}///for($i=0;$i<count($extensaoAux);$i++){
				
				///Se a extensão nao for a pretendida entao
				if($chave == false){
					for($i=0;$i<count($extensaoAux);$i++){
						if($i < count($extensaoAux)-1){
							$msgext .= "." . $extensaoAux[$i] . ", ";	
						}else{
							$msgext .= "ou " . "." . $extensaoAux[$i];
						}
					}
					$msg = "
							<center>
								Erro, a extensão não deve ser <b>" . "." . $ext[0] . "</b> e sim <b>$msgext</b>
							</center>
							";
					$retorno[2] = utf8_encode($msg); //indice 2 armazena a mensagem
					$retorno[1] = false;
				}
				///if($chave == false){
		} 
		return $retorno;	
	}
}

$drive = new banco("192.168.1.42", "5432", "postgres", "postgres", "portal_pmf");

?>