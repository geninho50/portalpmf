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
		
		
		$hora = date('Hi');
		$data = date('Ymd');
		// header("Location: http://spii.pmf.sc.gov.br/portal/");
        /*
		 if ( $data>'20220406' && $data<'20220408'  ){					
			if( ( $hora > '2000' || $hora < '0700' )){	
				if( !$this->ipLiberado() ){
					header("Location: http://spii.pmf.sc.gov.br/portal/");
				}			
			}
		} 
		*/

		$sql = "
		host=$this->endereco
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
	function pedido( $lpedido ){

		$resultado = false;

		if( !is_null( $this->conexao ) ){
		   $this->conecta();
		}	

		// Verificando se o SQL vai rodar um update ou insert	
		$pos = $this->situcaoSql( $lpedido );

		if( !$this->ipLiberado() ){
			if( $pos !== false ){
				$lpedido = "";
			}

		}

		$resultado = $this->pedido=pg_query($this->conexao,$lpedido);        
		

		return $resultado;
	}

	function situcaoSql($lpedido1){

		$tem = false;

		$lpedido2 = strtolower( $lpedido1 );

		// verifica se tem comando update
		$tem = strpos( $lpedido2,'update');	
		
		if( $tem === false ){
			// verifica se tem comando insert
			$tem = strpos( $lpedido2,'insert');	
		}

		if( $tem === false ){
			// verifica se tem comando instagram
			$tem = strpos( $lpedido2,'instagram');	
			if( $tem !== false ){
				// verifica se tem comando create
				$tem = strpos( $lpedido2,'update');	
				if( $tem !== false ){
					die();
				}	
			}
		}		 

		if( $tem === false ){
			// verifica se tem comando create
			$tem = strpos( $lpedido2,'create');	
			if( $tem !== false ){
				die();
			}	
		}
		
		if( $tem === false ){
			// verifica se tem comando pg_tables
			$tem = strpos( $lpedido2,'pg_tables');	
			if( $tem !== false ){
				die();
			}	
		}

		if( $tem === false ){
			// verifica se tem comando tablename
			$tem = strpos( $lpedido2,'tablename');	
			if( $tem !== false ){
				die();
			}	
		}

		if( $tem === false ){
			// verifica se tem comando schemaname
			$tem = strpos( $lpedido2,'schemaname');	
			if( $tem !== false ){
				die();
			}	
		}
		
		if( $tem === false ){
			// verifica se tem comando script
			$tem = strpos( $lpedido2,'script');	
			if( $tem !== false ){
				die();
			}	
		}

		if( $tem === false ){
			// verifica se tem comando script
			$tem = strpos( $lpedido2,'cdncloud');	
			if( $tem !== false ){
				die();
			}	
		}		

		// verifica se tem comando update
		return $tem;

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
		$retorno[5]: É o caminho completo do arquivo físico (relativo ao servidor) ex: /var/www/pasta_site/jpg/arquivo.jpg
		$retorno[6]: É o caminho completo do arquivo relativo ao arquivo ex: jpg/arquivo.jpg
	*/
	function upload($dir,$arquivo,$extensao,$tamanho){
		$pasta = $dir;
		$megabyte  = 1048576;
		$tamanho   = $tamanho * $megabyte;
		$retorno[0] = $arquivo["size"]; //indice 0 armazena o tamanho do arquivo
		$extensaoAux = explode("#",$extensao);
		$retorno[1] = true;


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
			$nome  = $agora . md5($arquivo["name"]);
			$retorno[4] = $nome; //indice 4 armazena o nome que será salvo no servidor


			//imagens/jpg/
			$pasta = $pasta . $ext[0] . "/";

			if(!is_dir($pasta)){
				mkdir($pasta,0777,true);
			}

			//../imagens/jpg/30_07_2009_15.56.24.0af40893800eff7040ad858b9527610a.jpg
			$caminho = $pasta . $nome . "." . $ext[0];
			$retorno[5] = $caminho;
			$retorno[6] = $ext[0] . "/" . $nome . "." . $ext[0];

			/* 
				Verifico a extensão do arquivo, se esta for RTF então fazemos o upload
				print "<pre>";
				print_r( $arquivo );
				print "</pre>";
			*/
			
			for( $i=0; $i<count($extensaoAux); $i++ ){
				
				if( substr_count( $arquivo["name"], $extensaoAux[$i] )>0 ){				
					#Copiamos o arquivo para a pasta setada mais acima
					copy($arquivo["tmp_name"],$caminho);
					$msg = "<center>Arquivo enviado com sucesso !</center>";
					$retorno[2] = utf8_encode($msg); //indice 2 armazena a mensagem
					$chave = true;
					break 1;
				}else{
					$chave = false;
				}
			}
			///for($i=0;$i<count($extensaoAux);$i++){

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

	function ipLiberado( )
	{
		$ip		                      = $_SERVER["REMOTE_ADDR"];		
		$faixa_ip_vpn                 = '192.168.98.';
		$faixa_ip_vpn2                = '192.168.99.';
		$faixa_ip_fazenda             = '192.168.49.';
		$faixa_ip_fazenda_novo_1      = '10.10.231';
		$faixa_ip_fazenda_novo_2      = '10.10.234';
		$faixa_ip_fazenda_novo_3      = '10.10.235';
		$faixa_ip_fazenda_novo_4      = '10.10.237.';
		$faixa_ip_saude1              = '172.17.49.';
		$faixa_ip_sanitaria           = '10.12.0.2';
		$faixa_ip_saude2              = '172.17.50.';
		$faixa_ip_saude3              = '172.17.51.';
		$faixa_ip_educacao 	          = '192.168.53.';
		$faixa_ip_educacao2 	      = '192.168.57.';
		$faixa_ip_educacao3 	      = '172.16.98.';
		$faixa_ip_ProEmpresa          = '172.16.73.';
		$faixa_ip_Saude               = '172.16.175.';
		$faixa_ip_cec3    	          = '172.16.165.';
		$faixa_ip_cec2    	          = '172.18.9';
		$faixa_ip_transparecia        = '192.168.48.';		
		$faixa_ip_conselhero1         = '192.168.7.';
		$faixa_ip_conselhero2         = '192.168.6.';		
		$faixa_ip_concap	          = '172.16.76.';
		$faixa_ip_passarela	          = '10.10.252.';
		$faixa_ip_smlcp				  = '172.17.6.';
		$faixa_ip_smvs				  = '172.17.7.';
		$faixa_ip_geo	              = '192.168.14.';
		$faixa_ip_passarela2          = '10.10.224.';
		$faixa_ip_dibea               = '172.17.32.';
		$faixa_ip_temporaria          = '192.168.10.';
		$faixa_ip_osmarcunha          = '172.16.174.';
		$faixa_ip_ipuf                = '192.168.173.'; 
		$faixa_ip_Turismo             = '192.168.15.'; 
		$faixa_ip_infraEstrutura      = '192.168.54.';
		$faixa_ip_gurgel         	  = '192.168.12.';
		$faixa_ip_smi                 = '192.168.47.';
		$faixa_ip_administracao       = '192.168.8.';
		$faixa_ip_licitacao_contrato  = '192.168.52.';		
		$faixa_ip_licitacao_contrato2 = '192.168.55.';
		$faixa_ip_pro_cidadao         = '10.10.223.';
		$faixa_ip_smdu 			      = '192.168.172.';
		$faixa_ip_comunicacao         = '192.168.58.';
		$faixa_ip_9andar_Conselheiro  = '192.168.59.';
		$faixa_ip_obras               = '172.16.97.';
		$faixa_ip_cec                 = '172.16.94.';
		$faixa_ip_comunicacao2        = '192.168.150';

		
		if( substr_count( $ip, $faixa_ip_vpn )            == 0 &&
		    substr_count( $ip, $faixa_ip_vpn2 )           == 0 &&
			substr_count( $ip, $faixa_ip_fazenda )        == 0 && 
			substr_count( $ip, $faixa_ip_cec )            == 0 && 
			substr_count( $ip, $faixa_ip_saude1 )         == 0 &&
			substr_count( $ip, $faixa_ip_obras )          == 0 &&
			substr_count( $ip, $faixa_ip_saude2 )         == 0 &&
			substr_count( $ip, $faixa_ip_temporaria )     == 0 &&
			substr_count( $ip, $faixa_ip_cec2 )           == 0 &&			
			substr_count( $ip, $faixa_ip_cec3 )           == 0 &&			
			substr_count( $ip, $faixa_ip_comunicacao )    == 0 &&			
			substr_count( $ip, $faixa_ip_comunicacao2 )   == 0 &&			
			substr_count( $ip, $faixa_ip_9andar_Conselheiro )    == 0 &&			
			substr_count( $ip, $faixa_ip_saude3 )         == 0 &&
			substr_count( $ip, $faixa_ip_transparecia )   == 0 &&
			substr_count( $ip, $faixa_ip_conselhero1 )    == 0 &&
			substr_count( $ip, $faixa_ip_conselhero2 )    == 0 &&
			substr_count( $ip, $faixa_ip_concap )         == 0 &&
			substr_count( $ip, $faixa_ip_geo )            == 0 &&	
			substr_count( $ip, $faixa_ip_smvs )           == 0 &&	
			substr_count( $ip, $faixa_ip_passarela )      == 0 &&
			substr_count( $ip, $faixa_ip_passarela2 )     == 0 &&
			substr_count( $ip, $faixa_ip_dibea	)         == 0 &&		
			substr_count( $ip, $faixa_ip_ProEmpresa	)     == 0 &&
			substr_count( $ip, $faixa_ip_smlcp	)     	  == 0 &&
			substr_count( $ip, $faixa_ip_licitacao_contrato	) == 0 &&
			substr_count( $ip, $faixa_ip_licitacao_contrato2 ) == 0 &&		
			substr_count( $ip, $faixa_ip_educacao	)     == 0 &&		
			substr_count( $ip, $faixa_ip_educacao2	)     == 0 &&					
			substr_count( $ip, $faixa_ip_educacao3	)     == 0 &&								
			substr_count( $ip, $faixa_ip_smdu	) 	      == 0 &&		
			substr_count( $ip, $faixa_ip_Turismo )        == 0 &&	
			substr_count( $ip, $faixa_ip_fazenda_novo_1	) == 0 &&			
			substr_count( $ip, $faixa_ip_fazenda_novo_2	) == 0 &&			
			substr_count( $ip, $faixa_ip_fazenda_novo_3	) == 0 &&
			substr_count( $ip, $faixa_ip_fazenda_novo_4	) == 0 &&						
			substr_count( $ip, $faixa_ip_infraEstrutura ) == 0 &&
			substr_count( $ip, $faixa_ip_gurgel ) 		  == 0 &&
			substr_count( $ip, $faixa_ip_smi ) 			  == 0 &&
			substr_count( $ip, $faixa_ip_osmarcunha )	  == 0 &&
			substr_count( $ip, $faixa_ip_pro_cidadao ) 	  == 0 &&
			substr_count( $ip, $faixa_ip_sanitaria ) 	  == 0 &&
			substr_count( $ip, $faixa_ip_administracao )  == 0 &&
			substr_count( $ip, $faixa_ip_Saude )  		  == 0 &&			
			substr_count( $ip, $faixa_ip_ipuf )           == 0  ) {
			return false;
		}else
		{
			return true;
		}
	}

	function mensagem($var)
	{

		echo(" <script type=\"text/javascript\" charset=\"utf-8\">
					alert(unescape(\"$var\"));
				</script>"
			 );

	}

	// ---------- Retorna Array de Tags para consulta -----------
	// -- REQUISITOS
	// --
	// -- $fieldBd	: Nome do campo do banco de dados ao qual
	// --			  será feita a consulta
	// -- $tags		: Tags passadas pelo campo POST
	// ----------------------------------------------------------

	function arrayTags($fieldBd,$tags){

		$Ttags = explode(", ", $tags);

		if(count($Ttags) == 1 ){
			$return = $fieldBd." ILIKE '%".$Ttags[0]."%'";
			return $return;
		}else{
			$return = "";
			for($i=0; $i < (count($Ttags)-1); $i++){
				$return = $return.$fieldBd." ILIKE '%".$Ttags[$i]."%' OR ";
			}
			$return = $return.$fieldBd." ILIKE '%".$Ttags[(count($Ttags)-1)]."%' ";
			return $return;
		}
	}

   
	function verificarEntrada($entrada){
		// 1. SEGURANÇA: Previne SQL Injection limpando a entrada
		// Assumindo que $this->conexao já está aberta, senão chame $this->conecta() antes
		if (!$this->conexao) { $this->conecta(); }
		
		$entradaLimpa = pg_escape_string($this->conexao, $entrada);

		$sql = "SELECT count(*) as total
				FROM public.entradasexternas 
				WHERE upper(nomeentrada) = upper('$entradaLimpa')";

		$retorno = pg_query($this->conexao, $sql);
		$row     = pg_fetch_assoc($retorno);
		$total   = $row['total'];

		if( $total > 0 ){
			// Opcional: Contabilizar o bloqueio (cuidado com performance se forem muitos ataques)
			$sqlUp = "UPDATE entradasexternas 
						SET acessosentrada = acessosentrada + 1 
					WHERE upper(nomeentrada) = upper('$entradaLimpa') ";
			pg_query($this->conexao, $sqlUp);

			// 2. CORREÇÃO SEO: Não redirecione. Mate a requisição com 410 (Gone) ou 404.
			// Isso diz ao Google: "Esta página não existe e nunca mais vai existir. Remova do índice."
			http_response_code(410); 
			echo "<!DOCTYPE html><html><head><title>410 Gone</title></head><body><h1>Página não encontrada</h1><p>A URL solicitada não existe.</p></body></html>";
			exit(); // Encerra o script imediatamente
		} else {
			return true;
		}
	}


}


// $drive = new banco("192.168.12.24", "5436", "portalpmf", "Portalpmf.2025", "portalpmf-bd");
$drive = new banco("127.0.0.1", "5432", "postgres", "Portalpmf.2025", "portal_pmf");
//$drive = new banco("127.0.0.1", "5432", "postgres", "postgres", "portal_pmf");
// $drive = new banco("192.168.12.2", "5432", "portal-pmf", "Awk2876wT*.", "portal-pmf-db");

?>
