<?php
class controleIp extends DB_mysql
{ 
	var $ipuser;

	function controleIp( $_ipuser = 0 )
	{
		$this->ipuser = $_ipuser;
	}
	/**
		$objAcessoIP = new controleIp;
		$objAcessoIP->incrementaAcesso($ipuser);
	**/
	function incrementaAcesso($ipuser,$data_fim)
	{
		$query = " insert into ipuser (ip,data) values ('$ipuser','$data_fim') ";
		$obj = new DB_mysql();
		$obj->executaQuery($query);
		$obj->closeVar($query);
		$obj->closeQuery();
		$obj->closeConexao();
	}	
	/**
		$objAcessoIP = new controleIp;
		$veracessoip = $objAcessoIP->retornaAcessoIP($linha['ip']);
	**/
	function retornaAcessoIP($ipuser,$data_hoje)
	{
		$obj = new DB_mysql();

		// Remover IP que votaram e que o dia de prazo já passou
		$query = " DELETE FROM ipuser WHERE data <= '".$data_hoje."' ";
		$obj->executaQuery($query);

		$veripacesso = false;
		$query = "SELECT * FROM ipuser where data > '".$data_hoje."' and ip='".$ipuser."' ";		
		$resultado = $obj->executaQuery($query);
		if ( $linha = mysql_fetch_array($resultado) )
		{
			$veripacesso = true;
		}
		$obj->closeVar($query);
		$obj->closeVar($resultado);
		$obj->closeVar($linha);
		$obj->closeQuery();
		$obj->closeConexao();
		return $veripacesso;
	}

	/**
		Pegar Ip
	**/
	function pegarIP()
	{
		$variables = array('REMOTE_ADDR',
					   'HTTP_X_FORWARDED_FOR',
					   'HTTP_X_FORWARDED',
					   'HTTP_FORWARDED_FOR',
					   'HTTP_FORWARDED',
					   'HTTP_X_COMING_FROM',
					   'HTTP_COMING_FROM',
					   'HTTP_CLIENT_IP');

		$return = 'Unknown';
		foreach ($variables as $variable)
		{
			if (isset($_SERVER[$variable]))
			{
				$return = $_SERVER[$variable];
				break;
			}
		}
		return $return;
	}
}
