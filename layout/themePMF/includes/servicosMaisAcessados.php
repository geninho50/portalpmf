
<?php if( !isset( $servicosClass ) ){
          $servicosClass = '';
      }
?>
<div class="quick-access-wrapper column4-lg column4-md column8-sm column8-xs">
  <div class="quick-access-services card-container <?php echo $servicosClass ?>">
    <?php
      $detect = new Mobile_Detect;
			if ($detect->isMobile() ) {
 				$position = 2;
			} else {
        $position = 6;
      }

      $query = " (  SELECT * 
					  FROM servicos 
					 WHERE ( servicos.serv_status = 't' 
                   AND servicos.serv_acessos <> 0 
                   AND serv_id<>260 
                   AND servicos.serv_abrir_interno = 0  ) 
				  ORDER BY servicos.serv_acessos DESC LIMIT 5 )
			      UNION
				 ( SELECT * 
					FROM servicos 
				   WHERE serv_id = 5188 
             or serv_id = 4377 
             or serv_id = 5146 
             or serv_id = 5657 
				 ORDER BY servicos.serv_acessos DESC LIMIT 4 ) ";
				 
      $result = $drive->pedido($query);
      $elementsHtml = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "", 7 => "", 8 => "");
      $i = 0;
      $activeClass = " active ";

      while($obj = pg_fetch_object($result)) {
        $stringResult = "<a class=\"card";
        if($i == 0 || $i == 1) {
          $stringResult .= $activeClass;
        }
		
        if( $i== 0 ){
            $stringResult .= "\" href=\"https://www.pmf.sc.gov.br/entidades/sadm/index.php?cms=contratacoes+e+aquisicoes+da+lei+no++13+979+2020&menu=0\"> 
                                  <i class=\"fa fa-arrow-circle-o-right\"></i>CONTRATOS EMERGENCIAIS</a>";	
		    }else{		

            if( $obj->serv_id == 5296 ){
              $obj->serv_nome = "<b>".$obj->serv_nome."</b>";
            }

            if( $obj->serv_id == 5227 ){
              $obj->serv_nome = "<b>ITBI WEB <br>( AQUI )</b>";
            } 

			      $stringResult .= "\" href=\"/servicos/index.php?pagina=servpagina&id=".$obj->serv_id."&menu=2\"> <i class=\"fa fa-arrow-circle-o-right\"></i>" . $obj->serv_nome . "</a>";
		    }
		
        if($i == $position){
          $i++;
        }
        if($i == 1){
          $elementsHtml[$position] = $stringResult;
        } else {
          $elementsHtml[$i] = $stringResult;
        }

        $i++;
      }
      echo(implode("",$elementsHtml));
     ?>
  </div>
  <div class="slider-button-right hidden-lg">
    <a class="js-next-service" href="#"><i class="fa fa-chevron-right"></i></a>
  </div>
  <a href="/servicos/index.php?pagina=servonline" class="btn-block btn-primary btn-sm">Ver todos os serviços</a>
</div>
