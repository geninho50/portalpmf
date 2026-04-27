<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '0');

  include_once("/home/www/sistemas/banco/gdb.php"); 
  include_once("/home/www/sistemas/banco/usuario.func.php");   
  include_once("/home/www/sistemas/banco/sessao.php");          
		  
  $gdb 	  = new usuarios();
  $sessao = new sessao();
  
  /*
  print "<pre>";
  print_r( $_GET );
  print_r( $_POST );
  print_r( $_REQUEST );
  print "</pre>";
  */

  $alterarSenha  = $gdb->vargetpost('alterarSenha');  
  $perfil        = $gdb->vargetpost('perfil');  
  $usuario       = $gdb->vargetpost('login');
  $senha         = md5($gdb->vargetpost('senha') );
  $sistema       = $gdb->vargetpost('sistema');  
  $nome          = "";      
  $captcha 		 = $gdb->vargetpost("recaptcha");
  $ok      = false;

  if( $captcha != "" ){    
  	  $secreto  = '6Lf0zBsaAAAAAIvyKbJg6ruDd9ixTJxky1JQ1umm';
	  $ip		= $_SERVER["REMOTE_ADDR"];
	  $var      = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secreto&response=$captcha&remoteip=$ip");
	  $resposta = json_decode($var,true);

	  if( $resposta['success'] ){
		  $ok = true;
	  }
  }

  if( $sistema == 'cliente' && $ok ){
	  if( $alterarSenha != 1 ){
		  $gdb->open("select * from pessoa where email = '$usuario' ");
		  
		  if( $gdb->linhas>0 ){
			  $nome = $gdb->gs['NOME'][0];
		  }
		  
		  $gdb->select("",$usuario,"","",$senha);

		  if( $usuario !='' && $senha !='' ){	 
			  	
			  if( $gdb->linhas >0 && $gdb->gs['STATUS'][0]=='1' ){
				  $sessao->iniciar_sessao('PROCON',$gdb->gs['CODIGOUSUARIO'][0] );
				  $codigo = $gdb->buscarCodigoPessoa( $usuario, 'PROCON','P' );
				  echo $codigo;
				  die();
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
					   WHERE codigoUsuario = '$codigoUsuario' " ) ){
			  echo '1';			   
		  }else{
			  echo '0';
		  }   
	  }
  }else{
	  
	  $gdb->open("select * 
	                from usuario 
				   where login = '$usuario' 
				     and senha = '$senha'  ");	  
	  
	  if( $gdb->linhas>0 && $ok ){
		  if( $gdb->gs['PERFIL'][0] == 'A' ){			  	 			  
			  if( $gdb->gs['STATUS'][0]=='1' ){
				  $sessao->iniciar_sessao('PROCON',$gdb->gs['CODIGOUSUARIO'][0] );
				  echo $gdb->gs['CODIGOUSUARIO'][0];
			  }else{
					echo '999999';
			  }			  
		  }else{			  			 
			 echo '222222 | ok : '.$ok; 
		  }
	  }else{
		echo '0';
	  }	  
 	  
	  // print "teste";
  }	  
	  
?>