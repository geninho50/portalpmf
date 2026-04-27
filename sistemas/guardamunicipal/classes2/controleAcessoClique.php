<?php
class controleAcessoClique extends DB_mysql
{ 
	var $acesso;
	function controleAcessoClique($_idcomponente=0,$_acesso=0)
	{
		$this->acesso = $_acesso;
	}
	function incrementaAcessoDia()
	{
		$obj = new DB_mysql();
		$query = " SELECT * FROM acessoclique where data=CURRENT_DATE() ";
		$resultado = $obj->executaQuery($query);
		if ( $linha = mysql_fetch_array($resultado) )
		{
			$query = " UPDATE acessoclique set clique=clique+1 where data=CURRENT_DATE() ";
		}
		else
		{
			$query = "INSERT INTO acessoclique(data,clique) values (CURRENT_DATE(),'1') ";
		}		
		$obj->executaQuery($query);
		$obj->closeVar($query);
		$obj->closeVar($resultado);
		$obj->closeVar($linha);
		$obj->closeQuery();
		$obj->closeConexao();
	}
	/**
		Retorna acesso por mês
	**/
	function retornaAcessoMes($mes)
	{
		$acesso = 0;
		$obj = new DB_mysql();		
		$query = "SELECT SUM(clique) as cliques FROM acessoclique where MONTH(data)=".$mes;		
		$resultado = $obj->executaQuery($query);
		if ( $linha = mysql_fetch_array($resultado) )
		{
			$acesso = $linha['cliques'];
		}
		$obj->closeVar($query);
		$obj->closeVar($resultado);
		$obj->closeVar($linha);
		$obj->closeQuery();
		$obj->closeConexao();
		return $acesso;
	}

	/**
		Retorna acesso por mês e dia
	**/
	function retornaAcessoMesDia($mes,$dia)
	{
		$acesso = 0;
		$obj = new DB_mysql();		
		$query = "SELECT SUM(clique) as cliques FROM acessoclique where DAY(data)=".$dia." and MONTH(data)=".$mes;
		$resultado = $obj->executaQuery($query);
		if ( $linha = mysql_fetch_array($resultado) )
		{
			$acesso = $linha['cliques'];
		}
		$obj->closeVar($query);
		$obj->closeVar($resultado);
		$obj->closeVar($linha);
		$obj->closeQuery();
		$obj->closeConexao();
		return $acesso;
	}
}
