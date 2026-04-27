<?php
class DB_mysql
{ 
	var $BaseDatos = 'siga';
	//var $Servidor = 'localhost';
	var $Servidor = '192.168.1.20';
	var $Usuario = 'gmf';
	//var $Usuario = 'root';
	var $Clave; 
	var $Conexion_ID = 0;
	var $Consulta_ID = 0;
	var $Errno = 0;
	var $Error = "";
	var $nome;
	var $id;
	var $idcomponente;
	var $acesso;
	/**
		A configuração da conexão com o banco de dados é feita preenchendo os parâmetros
		do construtor da presente classe, que são:
		$bd = 'florliz' [ Nome da Base de dados ];
		$host = 'localhost' [ Nome do Host ];
		$user = 'root' [ Usuário ];
		$pass = '' [ Senha ].
	**/
	//function DB_mysql($bd = 'gmf',$host = '192.168.39.206',$user = 'root',$pass = 'mkstec8045')
	//function DB_mysql($bd = 'intranet',$host = 'localhost',$user = 'root',$pass = 'mkstec8045')
	function DB_mysql($bd = 'siga',$host = '192.168.1.20',$user = 'gmf',$pass = '6f532!@AT') 
	{
		$this->BaseDatos = $bd;
		$this->Servidor = $host;
		$this->Usuario = $user;
		$this->Clave = $pass;
	}	
	function conectarConf()
	{	
		$linkid = mysql_connect($this->Servidor,$this->Usuario,$this->Clave);
		$result = mysql_select_db($this->BaseDatos,$linkid);
		$this->Conexion_ID = $result;
		if (!$this->Conexion_ID)
		{
			$this->Error = "Falha na conexão (parametros).";
			return 0;
		}
		return $this->Conexion_ID;
	}
	function retornaSringTamanho($stringT,$tamanho)
	{
		$palavra = "";
		$tamanhoT = strlen($stringT);

		if( $tamanhoT > $tamanho )
		{
			for ($i = 0; $i <= $tamanho; $i++)
			{			
				$palavra = $palavra.$stringT[$i];
			}
			$palavra = $palavra."...";
		}
		else
		{
			$palavra = $stringT;
		}
		return $palavra;
	}
	function executaQuery($query)
	{
		$obj = new DB_mysql;
		$obj->conectarConf();
		$result = mysql_query($query);
		// Fechando as variáveis
		$obj->closeQuery();
		return $result;
	}
	function retornarItens($sql = "")
	{
		$resultado = mysql_query($sql);
		$linha = mysql_fetch_array($resultado);
		return $linha;
	}
	function numcampos()
	{
		return mysql_num_fields($this->Consulta_ID);
	}
	function numregistros($query)
	{
		$conexao = mysql_query($query);
		return mysql_num_rows($conexao);
	}
	function nombrecampo($numcampo)
	{
		return mysql_field_name($this->Consulta_ID, $numcampo);
	}
	function retornarItem($query)
	{
		$conexao = mysql_query($query);
		$linha = mysql_fetch_array($conexao);	
		$this -> setId($linha['id']);
		$this -> setNome($linha['nome']);
	}
	function closeConexao()
	{
		if( $this->Conexion_ID )
		{
			mysql_close($this->Conexion_ID);
		}
	}	
	function closeQuery()
	{
		if( $this->Consulta_ID )
		{
			mysql_close($this->Consulta_ID);
		}
	}	
	function closeConexaoGeral()
	{		
		mysql_close();
	}
	function closeConexaoArg($conexao)
	{		
		mysql_close($conexao);
	}
	function closeVar($var)
	{
		if( !empty($var))
		{
			unset($var);
		}
	}
	public function setNome($VNome)
	{
		$this->nome = $VNome;
	}
	public function getNome()
	{
		return $this->nome;
	}
	public function setId($VId)
	{
		$this->id = $VId;
	}
	public function getId()
	{
		return $this->id;
	}

	function controleAcesso($_idcomponente=0,$_acesso=0)
	{
		$this->idcomponente = $_idcomponente;
		$this->acesso = $_acesso;
	}
	/**
		$objAcesso = new controleAcesso;
		$objAcesso->incrementaAcesso($idcomponente);
	**/
	function incrementaAcesso($idcomponente)
	{
		$query = "UPDATE acesso set acesso=acesso+1 where idcomponente=$idcomponente";
		$obj = new DB_mysql();
		$obj->executaQuery($query);
		$obj->closeVar($query);
		$obj->closeQuery();
		$obj->closeConexao();
	}	
	/**
		$objAcesso = new controleAcesso;
		$numeroAcessoComponente = $objAcesso->retornaAcessoComponente($linha['id']);
	**/
	function retornaAcessoComponente($idcomponente)
	{
		$acesso = 0;
		$query = "SELECT * FROM acesso where idcomponente=".$idcomponente;
		$obj = new DB_mysql();
		$resultado = $obj->executaQuery($query);
		if ( $linha = mysql_fetch_array($resultado) )
		{
			$acesso = $linha['acesso'];
		}
		$obj->closeVar($query);
		$obj->closeVar($resultado);
		$obj->closeVar($linha);
		$obj->closeQuery();
		$obj->closeConexao();
		return $acesso;
	}
	
}
?>
