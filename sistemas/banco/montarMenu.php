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
                     m.nome,
                     m.descricao					 
                from menu m, 
			         menuUsuario u 
			   where u.codigoMenu = m.codigoMenu 
			     and u.codigoUsuario = '$codigoUsuario'
			 	 and ( m.codigoMenuPai is null or m.codigoMenuPai = 0 )
		    order by u.codigoMenu ");

  $menu = "";  

  foreach($menuPai->gs["CODIGO"] as $key=>$value ){
	  
	$menu .= '<ul class="nav navbar-nav navbar-left">';
    $menu .= '    <li class="dropdown"> ';
	$menu .= '	     <a href="#" class="dropdown-toggle"  data-toggle="dropdown"  role="button"  aria-haspopup="true"  id="menuPai'.$value.'" ';	
	$menu .= '		 aria-expanded="false">'.$menuPai->gs["NOME"][$key].'<span class="caret"></span></a>';	
    
	$subMenu->open("Select * from menu m where m.codigoMenuPai = '$value' "); 
	
	if( $subMenu->linhas>0 ){		
	
		$menu .= '<ul>';		
	    
		foreach($subMenu->gs["NOME"] as $key1=>$value1 ){
		   $vModulo = $subMenu->gs['MODULO'][$key1];
		   $vCodigo = $subMenu->gs['CODIGOMENU'][$key1];			
           $menu .= "<li><a href='#' onclick='ativar( $vCodigo, \"$vModulo\" );' >$value1</a> </li>";		  
		}		
		$menu .= '</ul>';
	}	
	$menu .= '	</li>';
  	$menu .= '</ul>';		
  }
  
  $menu .= '<ul class="nav navbar-nav navbar-left">';
  $menu .= '    <li>';
  $menu .= '      <a href="#" ';
  $menu .= '	     class="dropdown-toggle" ';
  $menu .= '		 role="button" ';
  $menu .= '		 aria-haspopup="true" ';
  $menu .= '         onclick="sair();" ';  
  $menu .= '		 aria-expanded="false"><b>Sair</b></a>';
  $menu .= '	</li>	';
  $menu .= '</ul>	';		
	
  if( $menu !="" ){
	  $tabela = array( "tabela"=>"$menu" );
	  $retorno = json_encode( $tabela );
  }else{
	  $errors = array("erro :"=>"0");
	  $retorno = json_encode( $errors );
  }

  echo $retorno;
  
  
?>