
<?php

function videos_youtube($canal){
/*	//$xml = simplexml_load_file("https://gdata.youtube.com/feeds/api/users/PrefeituraFLN/uploads");
	$xml = simplexml_load_file("https://gdata.youtube.com/feeds/api/playlists/PLQMSPgabN_XVvMZrQX_EelcSrf2b6Nl_y");
	$videoLink = '';
	foreach ($xml as $xmlFE) {
		$xmlArr[] = $xmlFE;
	}

	for( $i = 0; $i < count($xmlArr)-1; $i++ ){
		if ( $xmlArr[$i]->link["href"] != null ) {
			$linksCompletos[] = $xmlArr[$i]->link["href"];
			$titulo[] = $xmlArr[$i]->title;
		}
	}

	$link_primeiro = $linksCompletos[0];
	$link_primeiro = explode('=', $link_primeiro);
	$link_primeiro = explode('&', $link_primeiro[1]);
	$link_primeiro = $link_primeiro[0];
*/	
	//provisorio 
		$link_primeiro = 'LwTilQi8zdY';
		$titulo[1] = 'Plano de Ação Voltado aos Moradores de Rua';
		$linksCompletos[1] = 'https://www.youtube.com/watch?v=caLPs24Q5WA';
		$titulo[2] = 'Floripa em Movimento';
		$linksCompletos[2] = 'https://www.youtube.com/watch?v=x0N-idfsQ_8&feature=youtu.be';
		$titulo[3] = 'XII Concurso de Desenho e Redação de Florianópolis';
		$linksCompletos[3] = 'https://www.youtube.com/watch?v=GZC4gw7rRxk';
	//fimProvisorio	

	$videoLink = "<div id='video_caixa'><iframe src='https://www.youtube.com/embed/".$link_primeiro."' frameborder='0' allowfullscreen></iframe></div>";

	for( $i = 1; $i <= 3; $i++ ){
			$base = 'https://www.youtube.com/watch?v=';
			$link = $linksCompletos[$i];
			$link = explode('=', $link);
			$link = explode('&', $link[1]);
			$link = $link[0];
			
			$videoLink .= "<div class='imagem_video' id='imagem_video_$i'><img src='https://img.youtube.com/vi/$link/0.jpg' id='$link' class='video_yt' style='cursor: pointer;'>";
			$videoLink .= "<p>".$titulo[$i]."</p></div>";
			 //"<iframe width=$width height=$height src=http://www.youtube.com/embed/$link frameborder='0' allowfullscreen'></iframe>";
	}
	return $videoLink;
}
?>

