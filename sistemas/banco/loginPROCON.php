<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '0');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();
  $sessao = new sessao();
  
  $alterarSenha  = $gdb->vargetpost('alterarSenha');  
  $perfil        = $gdb->vargetpost('perfil');  
  $usuario       = $gdb->vargetpost('login');
  $senha         = md5($gdb->vargetpost('senha') );
  $sistema       = $gdb->vargetpost('sistema');
  
  //$senha         = $gdb->vargetpost('senha');
  
  $nome          = "";    
  
  if( $sistema == 'cliente'){
	  if( $alterarSenha != 1 ){
		  $gdb->open("select * from pessoa where email = '$usuario' ");
		  
		  if( $gdb->linhas>0 ){
			  $nome = $gdb->gs['NOME'][0];
		  }
		  
		  $gdb->select("",$usuario,"","",$senha);

		  if( $usuario !='' && $senha !='' ){	 
			  if( $gdb->linhas >0 && $gdb->gs['STATUS'][0]=='1' ){
				  // print "Codigo : ".$gdb->gs['CODIGOUSUARIO'][0];
				  $sessao->iniciar_sessao('PROCON',$gdb->gs['CODIGOUSUARIO'][0] );
				  $codigo = $gdb->buscarCodigoPessoa( $usuario, 'PROCON','P' );
				  echo $codigo;
			  }else if(  $gdb->linhas == 0 ){
					   $gdb->select("",$usuario,"","","");  
					   if( $gdb->linhas == 0 && $nome !="" ){
						   $gdb->open("insert into usuario( codigoProjeto, nome, login, senha, status ) values('PROCON','$nome','$usuario','$senha','1') ");
						   $gdb->open("select max(CODIGOUSUARIO) as CODIGOUSUARIO from usuario ");
						   $sessao->iniciar_sessao('PROCON',$gdb->gs['CODIGOUSUARIO'][0] );
						   $codigo = $gdb->buscarCodigoPessoa( $usuario, 'PROCON','P' );
						   echo $codigo;
					   }else{
						   echo '0';
					   }
			  }else if( $gdb->gs['STATUS'][0]=='0'  ){
					 echo '999999';
			  }else{
				  echo '0';
			  }
		  }
	  }else{	  
		  $codigoUsuario  = $gdb->vargetpost('codigoUsuario');
		  $senha          = md5($gdb->vargetpost('senha') );  	  
		  if( $gdb->open("UPDATE usuario 
						 SET senha='$senha' 
					   WHERE codigoUsuario = '$codigoUsuario' ") ){
			  echo '1';			   
		  }else{
			  echo '0';
		  }   
	  }
  }else{
	  
	  $gdb->open("select * from usuario where login = '$usuario' and senha = '$senha'  ");	  
	  
	  if( $gdb->linhas>0 ){
		  if( $gdb->gs['PERFIL'][0] == 'A' ){			  	 			  
			  if( $gdb->gs['STATUS'][0]=='1' ){
				  $sessao->iniciar_sessao('PROCON',$gdb->gs['CODIGOUSUARIO'][0] );
				  echo $gdb->gs['CODIGOUSUARIO'][0];
			  }else{
					echo '999999';
			  }			  
		  }else{			  
			 echo '222222'; 
		  }
	  }else{
		echo '0';
	  }	  
 	  
	  // print "teste";
  }	  
	  
?>