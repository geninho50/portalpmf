<div class="column4-lg column8-md column8-sm column8-xs featured-news">
      <?php
      
  //--------------------------------------------------------
  // Monta as notícias de 1º nível (horizontais superiores)
  //--------------------------------------------------------

  //-----------------------------------------------------------------------
  // Se for diagramação automática buscas as 3 primieras notícias com foto
  //-----------------------------------------------------------------------
  $noti_id = $IdEntidade;

                    $sqlImport     = "SELECT * 
                                        FROM import_noticias 
                                       WHERE id_import_noticia_id_entidade = '$noti_id' 
                                    order by id_import_noticia_noti_id";
                                    
                    $return      = $drive->pedido($sqlImport);
                    $complemento = "";
                    
                    while($comp = pg_fetch_object($return)){
                        $complemento .=" OR noti_id = ".$comp->id_import_noticia_noti_id;
                    }

					/*if($_SERVER[REMOTE_ADDR] == '10.10.202.74') {
						print_R($V_manchete);
					}*/          
                    // print "SQL  : $notSql ";

                    if($V_manchete->man_tipo == 1){
                      
                       $notSql = "SELECT
                                    entidades.entidade_sigla,
                                    noticias.noti_id,
                                    noticias.noti_titulo,
                                    noticias.noti_manchete,
                                    noticias.noti_hora,
                                    noticias.noti_data
                                FROM
                                    noticias
                                INNER JOIN
                                    entidades
                                ON
                                    noticias.noti_entidade_id = entidades.entidade_id
                                WHERE
                                    noticias.noti_status = 't'
                                AND
                                    noticias.noti_entidade_id = $noti_id

                                $complemento
                                ORDER BY
                                    noticias.noti_data
                                DESC,
                                    noticias.noti_hora
                                DESC LIMIT 4 OFFSET 0";
                    }


  $Tresult = $drive->pedido($notSql);
  
  $j=0;

  /*if($_SERVER[REMOTE_ADDR] == '10.10.202.74') {
	print $noti_id;
  }*/
  
  while($TnotId = pg_fetch_object($Tresult)){
    $TnotiId[$j] = $TnotId->noti_id;
    $j++;
		/*if($_SERVER[REMOTE_ADDR] == '10.10.202.74') {
			print($TnotId->noti_id);
			echo '<br>';
		}*/
  }


  //------------------
  // Imprime notícias
  //------------------
  for($i=0; $i<4; $i++){
    if($V_manchete->man_tipo == 1){
      switch ($i) {
        case 0: $notId = $TnotiId[0]; break;
        case 1:	$notId = $TnotiId[1]; break;
        case 2: $notId = $TnotiId[2]; break;
        case 3: $notId = $TnotiId[3]; break;
      }
    }else{
      switch ($i) {
        case 0: $notId = $V_manchete->man_noti_1; break;
        case 1:	$notId = $V_manchete->man_noti_2; break;
        case 2: $notId = $V_manchete->man_noti_3; break;
        case 3: $notId = $V_manchete->man_noti_4; break;
      }
    }

/*  
  print "<pre>";
  print "Passou aqui : $notId ";
  print_r( $TnotiId[0] );
  print "Passou aqui ";
  print_r( $TnotId );
  print "</pre>";  
*/
    
    $sql = "SELECT
          editorias.edit_nome,
          noticias.noti_id,
          noticias.noti_manchete,
          noticias.noti_titulo,
          noticias.noti_data,
          imagens.img_link_v_alta,
          imagens.img_link_v_media
        FROM((
          noticias
        INNER JOIN
          editorias
        ON
          noticias.noti_edit_id = editorias.edit_id)
        INNER JOIN
          noticias_imagens
        ON
          noticias.noti_id = noticias_imagens.nimg_noti_id)
        INNER JOIN
          imagens
        ON
          noticias_imagens.nimg_img_id = imagens.img_id
        WHERE
          noticias.noti_id = ".$notId."
        AND
          noticias_imagens.nimg_principal = 't' 
		LIMIT 4 OFFSET 0";
    
    $TresultPrinc = $drive->pedido($sql);
    $TnotiPrinc   = pg_fetch_object($TresultPrinc);

    $Tdata = $TnotiPrinc->noti_data;
    $Tdata = explode("-", $Tdata, 3);
    $Tdata = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];

    if( !isset($_GET['menu']) ){
      $_GET['menu'] = 0;
    }

    if(!empty($TnotiPrinc)): 
      
    ?>


    <div class="featured-news__item">
      <a class="featured-news__anchor" href="?pagina=notpagina&menu=<?=$_GET['menu']?>&noti=<?=$TnotiPrinc->noti_id?>"></a>
      <div class="featured-news__image">
        <img src="../<?=$TnotiPrinc->img_link_v_alta?>"  width = "50px"  height = "50px" />
      </div>
      <div class="featured-news__details">
        <p class="featured-news__date"><?=transformDataNewsFormat($TnotiPrinc->noti_data)?></p>
        <p class="featured-news__category"><?=$TnotiPrinc->edit_nome?></p>
        <h3 class="featured-news__title"><?php echo(subString(strip_tags(html_entity_decode($TnotiPrinc->noti_titulo)),75));?></h3>
      </div>
    </div>
          <?php endif; ?>
          <?php
    $home_vazia = false;
  }
  ?>

</div>



<?php // NEXTTTTTTTT ?>

<div class="column4-lg column8-md column8-sm column8-xs featured-news">
      <?php
  //----------------------------------------------------
  // Monta as notícias de 2º nível (verticais esquerda)
  //----------------------------------------------------
  $primeiro = true;
  //---------------------------------------------------------------------
  // Se for diagramação automática buscas as notícas de (4 a 6) com foto
  //---------------------------------------------------------------------
  if($V_manchete->man_tipo == 1){
    $numSql = "SELECT COUNT(*) FROM noticias INNER JOIN entidades ON noticias.noti_entidade_id = entidades.entidade_id WHERE noticias.noti_status = 't' AND noticias.noti_data <= '$dataAtual' AND noticias.noti_entidade_id = $noti_id $complemento";

                            $notSql = "SELECT
                                    entidades.entidade_sigla,
                                    noticias.noti_id,
                                    noticias.noti_titulo,
                                    noticias.noti_manchete,
                                    noticias.noti_hora,
                                    noticias.noti_data
                                FROM
                                    noticias
                                INNER JOIN
                                    entidades
                                ON
                                    noticias.noti_entidade_id = entidades.entidade_id
                                WHERE
                                    noticias.noti_status = 't'
                                AND
                                    noticias.noti_entidade_id = $noti_id

                                $complemento
                                ORDER BY
                                    noticias.noti_data
                                DESC,
                                    noticias.noti_hora
                                DESC LIMIT 4 OFFSET 4";
  }
  $Tresult = $drive->pedido($notSql);
  $j=0;
  while($TnotId = pg_fetch_object($Tresult)){
    $TnotiId2[$j] = $TnotId->noti_id;
    $j++;
	/*if($_SERVER[REMOTE_ADDR] == '10.10.202.74') {
		print_R($TnotId);
		echo '<br>';
	}*/
  }
  //------------------
  // Imprime notícias
  //------------------
  for($i=0; $i<4; $i++){
    if($V_manchete->man_tipo == 1){
      switch ($i) {
        case 0: $notId = $TnotiId2[0]; break;
        case 1:	$notId = $TnotiId2[1]; break;
        case 2: $notId = $TnotiId2[2]; break;
        case 3: $notId = $TnotiId2[3]; break;
      }
    }else{
      switch ($i) {
        case 0: $notId = $V_manchete->man_noti_5; break;
        case 1:	$notId = $V_manchete->man_noti_6; break;
        case 2: $notId = $V_manchete->man_noti_7; break;
        case 3: $notId = $V_manchete->man_noti_8; break;
      }
    }

    $sql = "SELECT
          editorias.edit_nome,
          noticias.noti_id,
          noticias.noti_manchete,
          noticias.noti_titulo,
          noticias.noti_data,
          imagens.img_link_v_alta,
          imagens.img_link_v_media
        FROM((
          noticias
        INNER JOIN
          editorias
        ON
          noticias.noti_edit_id = editorias.edit_id)
        INNER JOIN
          noticias_imagens
        ON
          noticias.noti_id = noticias_imagens.nimg_noti_id)
        INNER JOIN
          imagens
        ON
          noticias_imagens.nimg_img_id = imagens.img_id
        WHERE
          noticias.noti_id = ".$notId."
        AND
          noticias_imagens.nimg_principal = 't' ";
    $TresultImg = $drive->pedido($sql);
    $TnotImg 	= pg_fetch_object($TresultImg);

    $Tdata = $TnotImg->noti_data;
    $Tdata = explode("-", $Tdata, 3);
    $Tdata = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];

    if(!empty($TnotImg)): ?>

    <div class="featured-news__item">
      <a class="featured-news__anchor" href="?pagina=notpagina&menu=<?=$_GET['menu']?>&noti=<?=$TnotImg->noti_id?>"></a>
      <div class="featured-news__image">
        <img src="../<?=$TnotImg->img_link_v_alta?>" />
      </div>
      <div class="featured-news__details">
        <p class="featured-news__date"><?=transformDataNewsFormat($TnotImg->noti_data)?></p>
        <p class="featured-news__category"><?=$TnotImg->edit_nome?></p>
        <h3 class="featured-news__title"><?php echo(subString(strip_tags(html_entity_decode($TnotImg->noti_titulo)),75));?></h3>
      </div>
    </div>
            <?php endif; ?>
            <?php
    $primeiro 	= false;
    $home_vazia = false;
  }
  ?>
</div>



<?php // NEXTTTTTTTT ?>




          <?php

    //busca as últimas 3 notícias e as guarda em uma variável de impressao.

      $imprime_3_noticias = "";

       if($V_manchete->man_tipo == 1){
                  $query   = 	"
                  SELECT *
                  FROM noticias
        WHERE noti_id NOT IN(
          SELECT NOTI.noti_id FROM noticias AS NOTI
            INNER JOIN noticias_imagens AS NIMG ON NOTI.noti_id = NIMG.nimg_noti_id
            WHERE NOTI.noti_entidade_id = ".$IdEntidade.".
            AND NIMG.nimg_principal = 't'
            ORDER BY NOTI.noti_data DESC, NOTI.noti_hora DESC LIMIT 7 OFFSET 0
        )
        AND noti_entidade_id = ".$IdEntidade." ORDER BY noti_data DESC, noti_hora DESC LIMIT 3 OFFSET 0";
    }
      $Tresult = $drive->pedido($query);
      $j=0;
      while($TnotId = pg_fetch_object($Tresult)){
        $TnotiId3[$j] = $TnotId->noti_id;
        $j++;
      }

      for($i=0; $i<3; $i++){
        if($V_manchete->man_tipo == 1){
          switch ($i) {
            case 0: $notId = $TnotiId3[0]; break;
            case 1:	$notId = $TnotiId3[1]; break;
            case 2: $notId = $TnotiId3[2]; break;
          }
        }else{
          switch ($i) {
            case 0: $notId = $V_manchete->man_noti_8; break;
            case 1:	$notId = $V_manchete->man_noti_9; break;
            case 2: $notId = $V_manchete->man_noti_10; break;
          }
        }

      $sql =" SELECT
            noticias.noti_id,
            noticias.noti_titulo,
            noticias.noti_manchete,
            noticias.noti_data,
            editorias.edit_nome
          FROM
            noticias
          INNER JOIN
            editorias
          ON
            noticias.noti_edit_id = editorias.edit_id
          WHERE
            noticias.noti_id = $notId
          AND
            noticias.noti_status = 't'
          ";

      $result = $drive->pedido($sql);
      $V_noticias = pg_fetch_object($result);

      $V_data = $V_noticias->noti_data;
      $V_date = explode("-", $V_data, 3);
      $V_data_final = $V_date[2]."/".$V_date[1]."/".$V_date[0];

      if( $V_noticias->noti_titulo != "" ) {
		  $imprime_3_noticias .= "<div class=\"secondary-news__item\">";
		  $imprime_3_noticias .= "<a class=\"secondary-news__anchor\" href=\"index.php?pagina=notpagina&amp;noti=$V_noticias->noti_id\"></a>";
		  $imprime_3_noticias .= "<p class=\"secondary-news__category\">";
		  $imprime_3_noticias .= "<span class=\"secondary-news__date\">$V_data_final</span></p>";
		  $imprime_3_noticias .= "<h3 class=\"secondary-news__title\">$V_noticias->noti_titulo</h3></div>";

      $home_vazia = false;
      } }

                if (!($home_vazia)) {
                  $imprime_3_noticias .= "<a class=\"btn-block btn-primary btn-sm\" href=\"index.php?pagina=notultimas&menu=4\">Ver todas as notícias</a>";
      }


            ?>


<?php
  if($hasCalendario->count > 0) {
    echo "<div class=\"column4-lg column4-md column8-sm secondary-news column8-xs\">";
  } else {
    echo "<div class=\"column8-lg column8-md column8-sm secondary-news column8-xs\">";
  }
 ?>
  <hr class="divider visible-lg">
  <h2>Mais notícias</h2>
  <?=$imprime_3_noticias?>
</div>