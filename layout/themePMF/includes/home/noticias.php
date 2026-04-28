<div class="column4-lg column4-md column8-sm column8-xs featured-news">

<?php

  if($only2) {
    $start = 0;
    $maxNotici = 1;
    $style = " max-width: 100%;";
  } else {
    $start = 1;
    $maxNotici = 5;
    $style = "";
  }
  //--------------------------------------------------------
  // Monta as notícias de 1º nível (horizontais superiores)
  //--------------------------------------------------------
  
  $sql 		= "SELECT * FROM config_manchetes WHERE man_entidade_id = $noti_id";
 
  $result		= $drive->pedido($sql);
  $V_manchete = pg_fetch_object($result);

  for($i=$start; $i<$maxNotici; $i++){

      switch ($i) {
      // case 0: $notId = 24722; break;
      // case 0: $notId = 25399; break;
      // case 0: $notId = 25415; break;
      // case 0: $notId = 25988; break;        
      // case 0: $notId = 25844; break;
      // case 0: $notId = 26802; break;        
      // case 0: $notId = 27104; break;
      // case 0: $notId = 26930; break;
      // case 0: $notId = 26573; break;
      // case 0: $notId = 26708; break;       
        
        case 0: $notId = $V_manchete->man_noti_1; break;
        case 1: $notId = $V_manchete->man_noti_2; break;
        case 2: $notId = $V_manchete->man_noti_3; break;
        case 3: $notId = $V_manchete->man_noti_4; break;
        case 4: $notId = $V_manchete->man_noti_5; break;
        case 5: $notId = $V_manchete->man_noti_6; break;
        case 6: $notId = $V_manchete->man_noti_7; break;
        case 7: $notId = $V_manchete->man_noti_8; break;
      }
    
      // fixando a mensagem do corona no topo
      // if(  $notId == 24722 ){  $notId = 24722+1;  }      
   
      $sql = "SELECT
              editorias.edit_nome,
              noticias.noti_id,
              noticias.noti_data,
              noticias.noti_manchete,
              noticias.noti_titulo,
              imagens.img_link_v_alta,
              imagens.img_legenda,
              noticias_imagens.nimg_principal
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
            noticias.noti_id = '$notId' AND noticias_imagens.nimg_principal = 't' ";   

        $result 		= $drive->pedido($sql);
        $V_noticias 	= pg_fetch_object($result);
       
        if( !is_null( $V_noticias->noti_id ) ){
            /*
            print "<pre>";    
            print_r( $V_noticias );
            print "</pre>"; 
            */
            
            if($pageIsHome) {
              $url = "/noticias/index.php?pagina=notpagina&noti=";
            }else{
              $url = "index.php?pagina=notpagina&noti=";
            }
            ?>

            <div class="featured-news__item <?php if ($i % 2 != 0){ ?>featured-news__item--inverted<?php } ?>">
              <a class="featured-news__anchor" 
            <?php 
            
              // Tirando a data da primeira notícia            
            if( $notId <> 27322 && $V_noticias->noti_id <> 27322 ){ ?>
                  href="<?=$url?><?=$V_noticias->noti_id?>"
            <?php 
            } else{                
                // href="http://covidometrofloripa.com.br" 
                // href="http://ipuf.pmf.sc.gov.br/pd2022/"   
                // href="https://e-gov.betha.com.br/cdweb/resource.faces?params=x9FhmqtjS1X_mO4jInmT_A=="  25415
                // href="https://www.pmf.sc.gov.br/entidades/smpi/index.php?pagina=notpagina&menu=0&noti=25844"
                // href="https://www.pmf.sc.gov.br/entidades/smdu/index.php?pagina=notpagina&menu=0&noti=26218"
                // href="https://redeplanejamento.pmf.sc.gov.br/floriparegular/"     
                // href="https://www.pmf.sc.gov.br/entidades/somarfloripa/index.php?pagina=notpagina&noti=26708"                
                // href="https://www.pmf.sc.gov.br/entidades/somarfloripa/index.php?pagina=notpagina&noti=26573"
                // href="https://e-gov.betha.com.br/cdweb/03114-452/contribuinte/rel_guiaiptu.faces"
                ?>

                href="https://www.pmf.sc.gov.br/arquivos/arquivos/_pdf/notificacao.pdf"                
                target="_blank"          

            <?php } ?>
        
            ></a>
          <div class="featured-news__image" style="background-image: url(<?=$V_noticias->img_link_v_alta?>); <?=$style?>"></div>
          <div class="featured-news__details">
          <?php 
            // Tirando a data da primeira notícia
            // $notId != 25415 && $notId != 25399 && $notId != 26573           
            // if( $notId != 25988 && $notId != 26802  ){ 
            //&& $notId != 27104
                        
          if( $notId != 27322 ){ ?>
              <p class="featured-news__date">
              <?=transformDataNewsFormat($V_noticias->noti_data) ?> 
              <span class="featured-news__category"><?=$V_noticias->edit_nome?></span></p>
        <?php
          }
        ?>	  
            <h3 class="featured-news__title"><?php echo(subString(strip_tags(html_entity_decode($V_noticias->noti_titulo)),75));?></h3>
          </div>
        </div>
      <?php
      }
  }

    if(!$only2){
      echo "<a class=\"btn-block btn-primary btn-sm\" href=\"/noticias/index.php\">Ver todas as notícias</a>";
    }
  ?>

</div>