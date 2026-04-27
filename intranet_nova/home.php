<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");	
$TidEntidade = $_SESSION['SuserEnt'];
$TuserId	 = $_SESSION['SuserId'];
?>

<div class="centro">
	<div>
		<div id="coluna_esquerda">        
        <div id="banner">
        <div id="slides">
            <div class="slides_container">
                <?php
                //--------------------------------------------
                // busca todas as imagens do banner principal
                //--------------------------------------------
                $sqlBanner	= "SELECT * FROM cms_banner WHERE cms_banner_entidade_id = 0 ORDER BY cms_banner_ordem ASC  ";
                $rBanner 	= $drive->pedido($sqlBanner);						
                while($objBanner = pg_fetch_object($rBanner)){							
                    echo"<div class=\"slide\">
                    		<a href=\"".$objBanner->cms_banner_link."\">
								<img src=\"../arquivos/banners/".$objBanner->cms_banner_path."\" alt=\"".$objBanner->cms_banner_titulo."\" border=\"0\" width=\"305\" height=\"179\"/> 
							</a>
							<div class=\"caption\" style=\"bottom:0\">
								<h2>".$objBanner->cms_banner_titulo."</h2><p>".$objBanner->cms_banner_subtitulo."</p>
							</div>
						</div>";
                }								
                ?>
				</div>
				<a href="#" class="prev"><img src="../scripts/slidesjs/img/arrow-next.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="../scripts/slidesjs/img/arrow-prev.png" width="24" height="43" alt="Arrow Next"></a>
            </div>
        </div>        
        <div id="bloco-5-lista">
        	<div class="titulo-bloco noticias"><label>ÚLTIMAS NOTÍCIAS</label><a href="inicio.php?pagina=notconsult&menu=7">MAIS (+)</a></div>
            <ul>
            	<?php
				//--------------------------------------------------
				// Imprime lista com as últimas notícias publicadas
				//--------------------------------------------------
				$TnoticiaSql  = "SELECT * FROM intranet_noticia WHERE intranet_noticia_entidade_id = ".$TidEntidade." AND intranet_noticia_status='t' ORDER BY intranet_noticia_data DESC LIMIT 5";
				$TretornoNot = $drive->pedido($TnoticiaSql);
				$i 			 = 0;
				while($noticia = pg_fetch_object($TretornoNot)){
					echo"						
						<li>
							<a href=\"inicio.php?pagina=noticia&idNot=".$noticia->intranet_noticia_id."\">".$noticia->intranet_noticia_titulo."</a>
						</li>";
						$i++;
				}		
				if($i==0){
					echo"<li>Este &eacute; o espa&ccedil;o colaborativo da sua secretaria ou &oacute;rg&atilde;o. Em breve estar&atilde;o dispon&iacute;veis notícas internas da secretaria ou &oacute;rg&atilde;o.</li>";
				}
				?>
         	</ul>
            <br class="clearfloat"> 
       	</div>
        <br class="clearfloat"> 
        <div id="bloco-5-lista">
        	<div class="titulo-bloco paginas"><label>ÚLTIMAS PÁGINAS</label><a href="inicio.php?pagina=pagconsulta&menu=6">MAIS (+)</a></div>
            <ul>
           		<?php
				//-------------------------------------------------
				// Imprime lista com as últimas páginas publicadas
				//-------------------------------------------------
				$TpaginaSql  = "SELECT * FROM intranet_pagina WHERE intranet_pagina_entidade_id = ".$TidEntidade." AND intranet_pagina_status='t' ORDER BY intranet_pagina_id DESC LIMIT 5";
				$TretornoPag = $drive->pedido($TpaginaSql);
				$i 			 = 0;
				while($pagina = pg_fetch_object($TretornoPag)){
					echo"						
						<li>
							<a href=\"inicio.php?pagina=pagina&idPag=".$pagina->intranet_pagina_id."\">".$pagina->intranet_pagina_titulo."</a>
						</li>";
						$i++;
				}		
				if($i==0){
					echo"<li>Este &eacute; o espa&ccedil;o colaborativo da sua secretaria ou &oacute;rg&atilde;o. Em breve estar&atilde;o dispon&iacute;veis textos, arquivos para download, imagens, v&iacute;deos e &aacute;udios.</li>";
				}
				?>
           	</ul>
            <br class="clearfloat">
       	</div>
        <div id="bloco-5-lista">
        	<div class="titulo-bloco arquivos"><label>ÚLTIMOS ARQUIVOS</label><a href="inicio.php?pagina=midias&menu=8">MAIS (+)</a></div>
            <ul>
            	<?php
				//----------------------------------------------
				// imprime os últimos arquivos disponibilizados
				//----------------------------------------------
				$TarquivoSql = "SELECT * FROM arquivos WHERE arq_entidade_id = ".$TidEntidade." ORDER BY arq_id DESC LIMIT 5";
				$TretornoArq = $drive->pedido($TarquivoSql);
				$i 			 = 0;
				while($arquivo = pg_fetch_object($TretornoArq)){
					echo"<li><a href=\"../".$arquivo->arq_link."\">".$arquivo->arq_nome."</a></li>";	
					$i++;
				}
				if($i==0){
					echo"<li>Este &eacute; o espa&ccedil;o colaborativo da sua secretaria ou &oacute;rg&atilde;o. Em breve estar&atilde;o dispon&iacute;veis arquivos para download.</li>";
				}
				?>
            </ul>
            <br class="clearfloat">
       	</div>
        <div id="bloco-galeria-imagens">
        	<div class="titulo-bloco"><label class="arquivos">ÚLTIMAS IMAGENS</label><a href="inicio.php?pagina=midias&menu=8">MAIS (+)</a></div>
            <ul>
            	<?php
				//---------------------------------------------
				// imprime as últimas imagens disponibilizadas
				//---------------------------------------------	
				$TimagemSql	 = "SELECT * FROM imagens WHERE img_entidade_id = ".$TidEntidade." ORDER BY img_data DESC LIMIT 8";	
				$TretornoImg = $drive->pedido($TimagemSql);	
				$i 			 = 0;	
				while($imagem = pg_fetch_object($TretornoImg)){
					echo"				
						<li>
							<a href=".$imagem->img_link_v_alta." rel='colorbox-galeria'  title=\"".$imagem->img_legenda."\">
								<img src=".$imagem->img_link_v_pequena." border=\"0\">
							</a>
						</li>";
					$i++;
				}
				if($i==0){
					echo"<li>Este &eacute; o espa&ccedil;o colaborativo da sua secretaria ou &oacute;rg&atilde;o. Em breve estar&atilde;o dispon&iacute;veis imagens para download.</li>";
				}
				?>
                <br class="clearfloat">
         	</ul>
            <br class="clearfloat">
       	</div>
        <br class="clearfloat">
	</div>
	<div id="coluna_direita">            
    	<div id="bloco-avisos" class="box-intranet">
        	<div class="titulo-bloco"><label>AVISOS</label></div>
            <div id="avisos">
           	    <ul>
					<?php	
					//----------------------------------------
					// Imprime os últimos 5 avisos publicados
					//----------------------------------------
					$TavisoSql	 = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id = ".$TidEntidade." ORDER BY intranet_avisos_id DESC LIMIT 5";
					$TretornoAvi = $drive->pedido($TavisoSql);			
					$i 			 = 0;
					while($aviso = pg_fetch_object($TretornoAvi)){
						echo"<li><a href=\"inicio.php?pagina=aviso&menu=".$_GET['menu']."&aviso_id=".$aviso->intranet_avisos_id."\">".$aviso->intranet_avisos_titulo."</a></li>";
						$i++;
					}
					if($i==0){
						echo"<li style=\"line-height:150%;\">Acompanhe pela Intranet os &uacute;ltimos avisos e informa&ccedil;&otilde;es importantes da sua secretaria ou &oacute;rgão.</li>";
					}else{
                        echo"<br /><a href=\"inicio.php?pagina=avisoconsulta\"><img src=\"../layout/imagens/intra_btn_mais.png\" border=\"0\" alt=\"mais\"></a>";	
                    }			
					?>
            	</ul>
            </div>
		</div>
        <div id="bloco-calendario" class="box-intranet">       
        	<div class="titulo-bloco"><label>CALENDÁRIO INTERNO</label></div>
            <ul>
            	<?php                    
				//----------------------------
				// imprime calendário interno
				//----------------------------
				$TdataAtual  = date("Y-m-d");
				$TcalSql 	 = "SELECT * FROM calendario WHERE cal_data <= '".$TdataAtual."' AND cal_entidade_id = ".$TidEntidade." AND cal_tipo = 0 ORDER BY cal_data ASC LIMIT 5";
				$TretornoCal = $drive->pedido($TcalSql);
                $i 			 = 0;
				while($calendario = pg_fetch_object($TretornoCal)){
					$Tdata = explode("-", $calendario->cal_data);
					switch($Tdata[1]){
						case 1: $Tmes = "JAN"; break;
						case 2: $Tmes = "FEV"; break;
						case 3: $Tmes = "MAR"; break;
						case 4: $Tmes = "ABR"; break;
						case 5: $Tmes = "MAI"; break;
						case 6: $Tmes = "JUN"; break;
						case 7: $Tmes = "JUL"; break;
						case 8: $Tmes = "AGO"; break;
						case 9: $Tmes = "SET"; break;
						case 10: $Tmes = "OUT"; break;
						case 11: $Tmes = "NOV"; break;
						case 12: $Tmes = "DEZ"; break;
					}
					if(empty($calendario->cal_evento)){
						$Tlink = "";
					}else{
						$Tlink = $calendario->cal_evento;
					}
					?>
					<li>
                        <div class=\"data\">
                           	<h2><?=$Tdata[2]?></h2>
                            <h4><?=$Tmes?></h4>
                        </div>
                        
                        <a href="<?=$Tlink?>" class="calendario-evento">&nbsp;&nbsp;<?=$calendario->cal_titulo?></a>
                        <br class="clearfloat" />
                    </li>
					<?php
                	$i++;
				}
				if($i==0){
					echo"<li style=\"line-height:150%;\">Este &eacute; o espa&ccedil;o colaborativo da sua secretaria ou &oacute;rg&atilde;o. Em breve estar&atilde;o dispon&iacute;veis datas de eventos, reunões internas.</li>";
				}
				?>
        	</ul>              
       	</div>
		<div id="bloco-sistemas" class="box-intranet">
        	<div class="titulo-bloco"><label>MEUS SISTEMAS</label></div>
            <ul>
                <?php
                //--------------------------------------------------
                // relaciona todos os sistemas favoritos do usuário
                //--------------------------------------------------
                $TsistemaSql = "SELECT * FROM intranet_favoritos LEFT JOIN intranet_sistemas ON intranet_favoritos_sistema_id = intranet_sistemas_id WHERE intranet_favoritos_user_id = ".$TuserId." ORDER BY intranet_favoritos_id ASC LIMIT 5";
                $TretornoSis = $drive->pedido($TsistemaSql);
                $i 			 = 0;
                while($sistema = pg_fetch_object($TretornoSis)){
                    if($sistema->intranet_sistemas_exibirweb=='t'){
                        echo"<li><a href=\"".$sistema->intranet_sistemas_endereco."\">".$sistema->intranet_sistemas_nome."</a></li>";
                        $i++;
                    }
                }							
                if($i==0){
                    echo"<li style=\"line-height:150%;\">
                        Para ter acesso r&aacute;pido aos sistemas da Prefeitura que mais usa, crie sua cole&ccedil;&atilde;o de favoritos. Sempre que voc&ecirc; entrar na Intranet, sua lista de sistemas estar&aacute; dispon&iacute;vel, independente do computador que estiver usando.<br>
                        <br><a href=\"inicio.php?pagina=sistconsulta&menu=".$_GET['menu']."\"><img src=\"../layout/imagens/intra_btn_inclui_fav.png\" border=\"0\" align=\"left\" /></a><br></li>";
                }
                ?>
            </ul>    
        </div>
		<div id="bloco-calendario" class="box-intranet">
        	<?php                    
			//-------------------------------
			// imprime lista de aniversários
			//-------------------------------
			if (date("m") >= 10){$Tano = date("Y");}else{$Tano = date("Y")+1;}
			$sql  = "SELECT user_nome, user_data_nascimento FROM users WHERE date_part('month', user_data_nascimento) < date_part('month', date'".$Tano."-12-01') AND user_entidade_id = ".$_SESSION['SuserEnt']." ORDER BY date_part('month', user_data_nascimento) ASC, date_part('day', user_data_nascimento) ASC, user_nome ASC LIMIT 5";
			$Tret = $drive->pedido($sql);
			?>
            <div class="titulo-bloco aniversarios"><label>PRÓXIMOS ANIVERSÁRIOS</label></div>
            <ul>
				<?php
                while($Taniver = pg_fetch_object($Tret)){
					$Tdata = explode("-", $Taniver->user_data_nascimento);
					switch($Tdata[1]){
						case 1: $Tmes = "JAN"; break;
						case 2: $Tmes = "FEV"; break;
						case 3: $Tmes = "MAR"; break;
						case 4: $Tmes = "ABR"; break;
						case 5: $Tmes = "MAI"; break;
						case 6: $Tmes = "JUN"; break;
						case 7: $Tmes = "JUL"; break;
						case 8: $Tmes = "AGO"; break;
						case 9: $Tmes = "SET"; break;
						case 10: $Tmes = "OUT"; break;
						case 11: $Tmes = "NOV"; break;
						case 12: $Tmes = "DEZ"; break;
					}
                	?>
                	<li>
                    	<div class="data">
                        	<h2><?=$Tdata[2]?></h2>
                            <h4><?=$Tmes?></h4>
                        </div>
                        <?=$Taniver->user_nome?>                        
                    	<br class="clearfloat" />
                    </li>                    
				<?php   
                }
                ?>
			</ul>
		</div>
        <br class="clearfloat">
      	<?php
		//-----------------------------------------------------------------------------------------
		// verifica se existe algum vídeo publicado, se não existe não exibe a sessão ÚLTIMO VÍDEO
		//-----------------------------------------------------------------------------------------
		$TvideoSql	 = "SELECT * FROM midia WHERE midia_entidade_id=$TidEntidade AND midia_tipo=0 ORDER BY midia_id DESC LIMIT 1";
		$TretornoVid = $drive->pedido($TvideoSql);
		$retVideo 	 = pg_fetch_object($TretornoVid);
		if($retVideo->midia_link != ""){			
			?>
			<div id="bloco-video">
				<div class="titulo-bloco"> <label>ÚLTIMO VÍDEO</label> <a href="inicio.php?pagina=midias&menu=<?=($TposicMenuMidia->intranet_menu_posicao + 1)?>">MAIS (+)</a> </div>
				<div class="video"> 
					<?				
					// ---------- Carrega Player de Vídeo ----------
					$width	 = "232";
					$height  = "169";
					$player  = "../scripts/php/videoPlayer";
					$video   = "http://portal.pmf.sc.gov.br/".$retVideo->midia_link;
					$retorno = videoPlayer($video,$width,$height,$player);
					// ---------- Fim Carrega Player de Vídeo ----------
					echo $retorno;					
					?>
				</div>
			</div>
       	<?php
		}
        ?>
	</div>
   	<br class="clearfloat">   
</div>
</div>        