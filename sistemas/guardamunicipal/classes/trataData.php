<?php

class trataData
{ 
	function closeVar($var)
	{
		if( !empty($var))
		{
			unset($var);
		}
	}

	function getDataMySQL()
	{
		$data = date("Y-m-d");
		return $data;
	}

	function formataDataPInterface($data)
	{
		$data = explode("-", $data);
		return "".$data[2]." / ".$data[1]." / ".$data[0];
	}

	function formataDataPBanco($data)
	{
		$data = explode(" / ", $data);
		return "".$data[2]." - ".$data[1]." - ".$data[0];
	}

	function retornaUltimoDiaMes($mes,$ano)
	{
		return cal_days_in_month(CAL_GREGORIAN,$mes,$ano);
	}

	function getData()
	{
		//Vai-se buscar o dia em que estamos
		$dia = date("l");
		switch($dia)
		{
			case "Monday":
				$dia_port = "Segunda-feira";
			break;
			case "Tuesday":
				$dia_port = "Terчa-feira";
			break;
			case "Wednesday":
				$dia_port = "Quarta-feira";
			break;
			case "Thursday":
				$dia_port = "Quinta-feira";
			break;
			case "Friday":
				$dia_port = "Sexta-feira";
			break;
			case "Saturday":
				$dia_port = "Sсbado";
			break;
			case "Sunday":
				$dia_port = "Domingo";
			break;
		}
		//Vai-se buscar o mes em que estamos
		$mes = date("n");
		// E щ necessсrio verificar tambщm o mъs em portuguъs e fazer a respectiva atribuiчуo
		switch($mes)
		{
			case "1":
				$mes_port = "Janeiro";
			break;
			case "2":
				$mes_port = "Fevereiro";
			break;
			case "3":
				$mes_port = "Marчo";
			break;
			case "4":
				$mes_port = "Abril";
			break;
			case "5":
				$mes_port = "Maio";
			break;
			case "6":
				$mes_port = "Junho";
			break;
			case "7":
				$mes_port = "Julho";
			break;
			case "8":
				$mes_port = "Agosto";
			break;
			case "9":
				$mes_port = "Setembro";
			break;
			case "10":
				$mes_port = "Outubro";
			break;
			case "11":
				$mes_port = "Novembro";
			break;
			case "12":
				$mes_port = "Dezembro";
			break;			
		}
		return $dia_port.", ".date("d")." de ".$mes_port." de ".date("Y");
	}

	function somar_dias_uteis($str_data,$int_qtd_dias_somar = 7)
	{
		$str_data = substr($str_data,0,10);
		if ( preg_match("@/@",$str_data) == 1 )
		{
			$str_data = implode("-", array_reverse(explode("/",$str_data)));
		}
		$array_data = explode('-', $str_data);
		$count_days = 0;
		$int_qtd_dias_uteis = 0;
		while ( $int_qtd_dias_uteis < $int_qtd_dias_somar )
		{
			$count_days++;
			if ( ( $dias_da_semana = gmdate('w', strtotime('+'.$count_days.' day', mktime(0, 0, 0, $array_data[1], $array_data[2], $array_data[0]))) ) != '0' && $dias_da_semana != '7' )
			{
				$int_qtd_dias_uteis++;
			}
		}
		return gmdate('d/m/Y',strtotime('+'.$count_days.' day',strtotime($str_data)));
	}
	function somardiasData($data,$dias)
	{
		$data = explode("-", $data);
		$devolver  = mktime (0, 0, 0, $data[1]  , $data[2]+$dias, $data[0]);
		return "".date("Y-m-d", $devolver);
	}
}
?>