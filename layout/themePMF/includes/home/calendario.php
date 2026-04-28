<?php
  //----------------------------------
  //impressão das datas no calendário
  //----------------------------------
  $dataAtual = date("Y/m/d");
  if(!$mostraTodosCalendario){
    $specificEntity = " AND cal_entidade_id = $IdEntidade ";
  }

  if( !isset($specificEntity) ){
      $specificEntity = '';
  }
  
  $sql 	   = "SELECT * FROM calendario WHERE cal_data >= '$dataAtual' ". $specificEntity ."  AND cal_tipo = 1 ORDER BY cal_data ASC LIMIT $calendarioNumeroResult";
  $resultado = $drive->pedido($sql);
  $meses = array(1 => "JAN", 2 =>"FEV", 3 =>"MAR", 4 => "ABR", 5 => "MAI", 6 => "JUN", 7 => "JUL", 8 => "AGO", 9 => "SET", 10 => "OUT", 11 => "NOV", 12 => "DEZ");
    $TcalImp = "";
    while($obj = pg_fetch_object($resultado)){
    $tituloEvento = substr($obj->cal_titulo,0,100);
    if(strlen($tituloEvento) == 100){
      $tituloEventoExp = explode(" ",$tituloEvento);
      $tituloEvento = "";
      for($i = 0; $i < count( $tituloEventoExp )-1; $i++ ){
        $tituloEvento .= " ".$tituloEventoExp[$i];
      }
      $tituloEvento=$tituloEvento."...";
    }
    $idEvento 	  = $obj->cal_id;
    $data 		  = date("d", strtotime($obj->cal_data))."<span>".$meses[date("n", strtotime($obj->cal_data))]."</span>";

    if(!empty($obj->cal_complemento)){
      $complemento = "<span>". $obj->cal_complemento ."</span>";
    } else {
      $complemento = "";
    }


    if($obj->cal_evento == null){
      $TcalImp	 .= "<li class=\"featured-events__item\"><p class=\"featured-events__date\">".$data."</p><div class=\"featured-events__details\">".strtolower($tituloEvento) . "</div></li>";
    }else{
      $TcalImp	 .= "<li class=\"featured-events__item\"><p class=\"featured-events__date\">".$data."</p><div class=\"featured-events__details\"><a href=\"".$obj->cal_evento."\">".strtolower($tituloEvento)."</a></div></li>";
    }
  }

  ?>
  <div class="featured-events hidden-xs">
    <h2>Calendário</h2>
    <ul class="featured-events__list">
      <?=$TcalImp?>
    </ul>
    <a class="btn-block btn-primary btn-sm" href="/noticias/index.php?pagina=calendario">Ver calend&aacute;rio completo</span></a>
   <!-- <a class="btn-block btn-primary btn-sm" href="../calendario.php">Ver calend&aacute;rio completo</span></a>
-->
</div>
