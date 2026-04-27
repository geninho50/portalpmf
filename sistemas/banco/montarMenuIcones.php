<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();  
  $menuPai = new usuarios();  
  $subMenu = new usuarios();    
  
    
  $codigoUsuario  = $gdb->vargetpost('codigoUsuario');
  
  $menuPai->open("Select m.codigoMenu as codigo,
						 m.nome as titulo,
						 m.descricao,
						 m.imagem	 
					from menu m, 
						 menuUsuario u 
				   where u.codigoMenu = m.codigoMenu 
					 and u.codigoUsuario = '$codigoUsuario'
					 and ( m.codigoMenuPai is null or m.codigoMenuPai = 0  )
					 and m.codigoMenu<>98				
				union 	
				Select m2.codigoMenu as codigo,
					   m2.nome as titulo,
					   m2.descricao,
					   m2.imagem	 
				  from menu m2				
				 Where m2.codigoMenu=99 ");
				
  $uibGridInicio  	 = '<tr>';
  $uibGridInicioSem   = '<tr>';
  $uibGridTermino 	  = '</tr>';
  $figureAlignInicio  = '<td align="center">';
  $figureAlignTermino = '</td>';
  
  $itens = 1;
  $menu = "<div id='menu0' class='upage-areaTrabalho' style='display:block;' >
           <table width='65%' height='40%'>";
																
  $menuOutros = "";
  
  foreach( $menuPai->gs["CODIGO"] as $key=>$value ){
	 
	 $menuOutros .= construirSubmenu( $codigoUsuario, $value, $subMenu);
	 
     if($itens == 4 ){
	    $itens 		   = 1;
		$uibGridInicio = $uibGridInicioSem;
	 }	
	 
     if( $itens == 1  ){	
	   $menu .= $uibGridInicio;	   
	 }
	 
	 $imagem    = $menuPai->gs["IMAGEM"][$key];
	 $titulo    = $menuPai->gs["TITULO"][$key];
	 $descricao = $menuPai->gs["DESCRICAO"][$key];	
	 
     $menu .= $figureAlignInicio;	 
     $menu .= "<img src='$imagem' id='$titulo' width='75px' height='75px'  ";
	 if( $value == 99  ){
		 $menu .= " onclick='sair();' ";
	 }else{ 	    
        $menu .= " onclick='operacaoMenu(0,$value);' ";
     }
	 $menu .= " title='$descricao'><br>";	 
     $menu .= "<label>$titulo</label>";		 
	 $menu .= $figureAlignTermino;	 
	 
     if( $itens == 3  ){	
	   $menu .= $uibGridTermino;	   
	 }
	 
	 $itens++;
  }
  
  

  if( $itens != 4  ){	
    $menu .= $uibGridTermino."</table></div>".$menuOutros;	   
  }else{
	$menu .="</tr></table></div>".$menuOutros;	     
  } 

  if( $menu !="" ){
	 $tabela = array( "tabela"=>"$menu" );
	 $retorno = json_encode( $tabela );
  }else{
    $errors = array("erro :"=>"0");
    $retorno = json_encode( $errors );
  }

  echo $retorno; 
  

function construirSubmenu( $codigoUsuario, $codigo, $dbm ){

 $uibGridInicio  	 = '<tr>';
 $uibGridInicioSem   = '<tr>';
 $uibGridTermino 	 = '</tr>';
 $figureAlignInicio  = '<td align="center">';
 $figureAlignTermino = '</td>';
 $menuOutros 		 = "";
 $subMenu 			 = "";
 $itens 			 = 1;
 
 $dbm->open("Select m.codigoMenu as codigo,
                    m.nome as titulo,
                    m.descricao,
       				m.imagem,
				    m.codigoMenuPai	as pai,
                    m.modulo					
               from menu m 
			  where m.codigoMenuPai = '$codigo'
			     or m.codigoMenu = '98' 				 
		   order by m.codigoMenu");	
			
  if( $dbm->linhas>0 ){
	  
	$subMenu = "<div id='menu$codigo' class='upage-areaTrabalho' style='display:none;' >
	              <table width='65%' height='40%'>";
	  
	foreach( $dbm->gs["CODIGO"] as $key=>$value ){
		
		 if( $dbm->gs["PAI"][$key] == '13' ){
			$menuOutros .=  construirMenuProjeto( $codigoUsuario, $value , $codigo);
		 }	
		 
		 if($itens == 4 ){
			$itens 		   = 1;
			$uibGridInicio = $uibGridInicioSem;
		 }	
		 
		 if( $itens == 1  ){	
		     $subMenu .= $uibGridInicio;	   
		 }
		 
		 $imagem    = $dbm->gs["IMAGEM"][$key];
		 $titulo    = $dbm->gs["TITULO"][$key];
		 $descricao = $dbm->gs["DESCRICAO"][$key];	
		 
		 $subMenu .= $figureAlignInicio;	 
		 $subMenu .= "<img src='$imagem' id='$titulo' width='75px' height='75px'   ";
		 
		 if( $value == 98  ){
			 $subMenu .= " onclick='operacaoMenu($codigo,0);' ";
		 }
		 else{ 
			$subMenu .= " onclick='operacaoMenu($codigo,$value);' ";
		 }
		 $subMenu .= " title='$descricao'><br>";	 
		 $subMenu .= "<label>$titulo</label>";		 
		 $subMenu .= $figureAlignTermino;
		 
		 if( $itens == 3  ){	
		   $subMenu .= $uibGridTermino;	   
		 }
		 
		 $itens++;
	}
	
    if( $itens != 4  ){	
      $subMenu .="</tr></table></div>".$menuOutros;	     
    }else{
 	  $subMenu .="</table></div>".$menuOutros;	     
    } 
  }	
  
  return $subMenu;   
}
  
function construirMenuProjeto( $codigoUsuario, $codigo, $menuFechar ){
	
 $dbProjeto = new usuarios();      

 $uibGridInicio  	 = '<tr>';
 $uibGridInicioSem   = '<tr>';
 $uibGridTermino 	  = '</tr>';
 $figureAlignInicio  = '<td align="center">';
 $figureAlignTermino = '</td>';

 $subMenu = "";
 $itens = 1;
 
 $dbProjeto->open("  Select m.codigoMenu as codigo,
							m.nome as titulo,
							m.descricao,
							m.imagem                    					
					   from menu m 
					  where m.codigoMenu in ('16','10','98') 				 
				   order by m.codigoMenu");	
			
  if( $dbProjeto->linhas>0 ){
	  
	$subMenu = "<div id='menu$codigo' class='upage-areaTrabalho' style='display:none;' >
	              <table width='65%' height='40%'>";
	  
	foreach( $dbProjeto->gs["CODIGO"] as $key=>$value ){
		
		 
		 if($itens == 4 ){
			$itens 		   = 1;
			$uibGridInicio = $uibGridInicioSem;
		 }	
		 
		 if( $itens == 1  ){	
		     $subMenu .= $uibGridInicio;	   
		 }
		 
		 $imagem    = $dbProjeto->gs["IMAGEM"][$key];
		 $titulo    = $dbProjeto->gs["TITULO"][$key];
		 $descricao = $dbProjeto->gs["DESCRICAO"][$key];	
		 
		 $subMenu .= $figureAlignInicio;	 
		 $subMenu .= "<img src='$imagem' id='".$dbProjeto->gs["CODIGO"][$key]."$codigo' width='75px' height='75px'   ";
		 
		 if( $value == 98  ){
			 $subMenu .= " onclick='operacaoMenu($codigo,$menuFechar);' ";
		 }
		 else{ 
			$subMenu .= " onclick='operacaoMenu( $menuFechar ,$codigo);' ";
		 }
		 $subMenu .= " title='$descricao'><br>";	 
		 $subMenu .= "<label>$titulo</label>";		 
		 $subMenu .= $figureAlignTermino;	 
		 
		 if( $itens == 3  ){	
		   $subMenu .= $uibGridTermino;	   
		 }
		 
		 $itens++;
	}
	
    if( $itens != 4  ){	
      $subMenu .="</tr></table></div>";	     
    }else{
 	  $subMenu .="</table></div>";	     
    } 
  }  
  
  
  return $subMenu;   
}
?>