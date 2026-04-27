<?php

class trataString
{ 
	function closeVar($var)
	{
		if( !empty($var))
		{
			unset($var);
		}
	}

	function getLink($link)
	{
		$sTempLink = "";
		$tamanho = strlen($link);
		if( $tamanho > 6 )
		{
			$sTempLink = "".$link{0}.$link{1}.$link{2}.$link{3}.$link{4}.$link{5}.$link{6};
			if( $sTempLink == "http://" )
			{
				// OK
			}
			else
			{
				$link = "http://".$link;
			}
		}
		return $link;
	}
	function getTokens($string)
	{
		$array_categ = preg_split("/\s+/s", $string, -1, PREG_SPLIT_NO_EMPTY);
		$array_categ = array_unique($array_categ);
		return $array_categ;
	}
	function getTokensSQL($array_categ,$campo)
	{
		$stringSQL = "";
		$tamanho_array = count($array_categ);
		for ( $i=0; $i < $tamanho_array ; $i++ )
		{
			if( $i == 0 )
			{
				$stringSQL .= " UPPER(".$campo.") like UPPER('%".$array_categ[$i]."%') ";
			}
			else
			{
				$stringSQL .= " OR UPPER(".$campo.") like UPPER('%".$array_categ[$i]."%') ";
			}
		}
		return $stringSQL;
	}
	function convertem($term, $tp)
	{
		if ($tp == "1")
			$palavra = strtr(strtoupper($term),"‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ˜¯˘¸˙˛ˇ","¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷◊ÿŸ‹⁄ﬁﬂ");
		elseif ($tp == "0")
			$palavra = strtr(strtolower($term),"¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷◊ÿŸ‹⁄ﬁﬂ","‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ˜¯˘¸˙˛ˇ");
		return $palavra;
	}
	function getStringTamanho($string,$tamanhoS)
	{
		$sTempLink = "";
		$tamanho = strlen($string);
		if( $tamanho > $tamanhoS )
		{
			for ( $i=0; $i < $tamanhoS ; $i++ )
			{
				$sTempLink .= "".$string{$i};
			}
			$sTempLink .= "...";
		}
		else
		{
			$sTempLink = $string;
		}
		return $sTempLink;
	}
	function filtra_caracteres($string, $substitui)
	{ 
		// Um unicode tem 65536 caracteres, entao eh menos trabalhoso 
		// colocar quais sao os caracteres permitidos 
		$permitidos = " 0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz·ÈÌÛ˙‚ÍiÙ¸‡<>,./?;:[{]}\|=+-_)(*&^%$#@!„ı~'"; 

		if((!isset($substitui)) OR ($substitui == Null)) { 
				// essa aqui sera a flag para $substitui nulo 
				$substitui = chr(0); 
		} 

		// Vamos prevenir o '$substitui' para n„o ter mais de um caractere 
		$substitui = $substitui{0}; 

		// Esse laco for varrera cada caractere da string informada em $string 
		for($i = 0; $i < strlen($string); $i++) { 
				$ok = False; 
				// Esse laco varrera cada caractere da string $permitidos 
				for($j = 0; $j < strlen($permitidos); $j++) { 
						// Se o pedaco da string for igual ao pedaco de permitidos 
						// pula para o proximo 
						if($string{$i} == $permitidos{$j}) { 
								$j = strlen($permitidos); 
								$ok = True; 
						} 
				} 
				// Substituindo o caractere nao contido em '$permitidos' por '$substitui' 
				if(!$ok) { 
						$string{$i} = $substitui; 
				} 
		} 
		// Se o '$substitui' for nulo retira os caracteres 
		// de $string que nao estao em $permitidos 
		if($substitui == chr(0)) { 
				$string = str_replace($substitui, '', $string); 
		} 
		return($string); 
	}
}
?>