<?php 
      if( !isset( $bannersColumn ) ){
        $bannersColumn = '';
      }
?>

 <div class="category-wrapper column4-lg column8-md column8-sm">
  <!-- <div class="category-wrapper column4-lg column4-md column8-sm"> -->

  <h2>Serviços para Empresas</h2>
  <div class="category-list">
  <?php

    $sqlEmpresa = "SELECT * FROM categorias
    WHERE cat_id IN
      (SELECT serv_categoria_empresa FROM servicos WHERE servicos.serv_categoria_empresa = categorias.cat_id)
    ORDER BY (SELECT SUM(serv_acessos) FROM servicos WHERE servicos.serv_categoria_empresa = categorias.cat_id)  DESC
    LIMIT 12;";

    /* 
    $sqlCidadao = "SELECT * FROM categorias
    WHERE cat_id IN
      (SELECT serv_categoria_cidadao FROM servicos WHERE servicos.serv_categoria_cidadao = categorias.cat_id)
    ORDER BY (SELECT SUM(serv_acessos) FROM servicos WHERE servicos.serv_categoria_cidadao = categorias.cat_id)  DESC
    LIMIT 12;"; 
    */
     
    $resultEmpresa = $drive->pedido($sqlEmpresa);
    //$resultCidadao = $drive->pedido($sqlCidadao);

    echo "<div class=\"category-citizen \">";
    // $i = 0;
    // while ($objCidadao = pg_fetch_object($resultCidadao)){
    //   $element = "<a class=\"category";
    //   if($i <= 2){
    //     $element  .= " active ";
    //   }
    //   $element .= "\" href=\"/servicos/index.php?pagina=servcategoria&idCidadao=$objCidadao->cat_id\">$objCidadao->cat_nome</a>";
    //   echo $element;
    //   $i++;
    // };

    echo "</div> <div class=\"category-company active \">";
    $i = 0;
    while ($objEmpresa = pg_fetch_object($resultEmpresa)){
      $element = "<a class=\"category";
      if($i <= 2){
        $element  .= " active ";
      }
      $element .= "\" href=\"/servicos/index.php?pagina=servcategoria&idEmpresa=$objEmpresa->cat_id\">$objEmpresa->cat_nome</a>";
      echo $element;
      $i++;
    };
    echo "</div>";
  ?>
    <div class="slider-button-right hidden-lg">
      <a class="" href="#"><i class="fa fa-chevron-right"></i></a>
    </div>
  </div>
</div>