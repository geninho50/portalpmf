<?php

include_once("gdb.php");

class usuarios extends gdb {

   function insert( $nm_usrs,
                    $cd_acss,
                    $nm_logn,
                    $cd_pass,
                    $in_tipo,
					$ds_email,
					$hr_matt_entr,
					$hr_matt_saida,
					$hr_vesp_entr,
					$hr_vesp_saida,
					$cd_depr ) {
                    
      $this->parametro("nm_usrs","STRING"  ,$nm_usrs );
      $this->parametro("ds_email","STRING"  ,$ds_email );	  
      $this->parametro("cd_depr","NUMERICO",$cd_depr );	  
      $this->parametro("nm_logn","STRING"  ,$nm_logn );
      $this->parametro("cd_pass","STRING"  ,$cd_pass );

      $rows = 0;
      if ($this->open("insert into usuarios (nm_usrs,
                                             nm_logn,
                                             cd_pass,
											 ds_email )
                   values (:nm_usrs,
                           :nm_logn,
                           :cd_pass,
						   :ds_email )")) return 1;
      else return 0;
   }

   function update( $cd_usrs,
                    $nm_usrs,
                    $cd_acss,
                    $nm_logn,
                    $cd_pass,
                    $in_tipo,
					$ds_email,
					$hr_matt_entr,
					$hr_matt_saida,
					$hr_vesp_entr,
					$hr_vesp_saida,
					$cd_depr 	 ){

      $this->parametro("cd_usrs","NUMERIC",$cd_usrs );
      $this->parametro("nm_usrs","STRING"  ,$nm_usrs );
      $this->parametro("cd_depr","NUMERIC",$cd_depr );	  
      $this->parametro("nm_logn","STRING"  ,$nm_logn );
      $this->parametro("cd_pass","STRING"  ,$cd_pass );
      $this->parametro("ds_email","STRING"  ,$ds_email );	  
  
      // atualizamos com as novas informa??es
      if( $this->open("update usuarios set nomeUsuario=:nm_usrs,
                                           login=:nm_logn,
                                           senha=:cd_pass,
									                         email=:ds_email
                                     where codigousuario = :cd_usrs") ) return 1;
      else return 0;
   }

   function delete($cd_usrs) {

      $this->parametro("cd_usrs","NUMERICO",$cd_usrs );

      $this->open(" delete from usuarios
                     where cd_usrs = :cd_usrs ");
      return $this->linhas;

   }

   function select(  $codigousuario = "",
                     $login 		= "",
                     $nome 			= "",
                     $datainsert	= "",
                     $senha 		= "",
					 $sistema       = ""	) {

            $where = "";

            if ($codigousuario !="" ){
                $this->parametro("codigousuario","NUMERIC",$codigousuario );
                $where =" Where codigousuario=:codigousuario ";
            }
            
            if ($login!="" ){
                $this->parametro("login","STRING",$login );
                ($where=="")?$where =" Where login = :login ":$where .=" and login = :login ";
            }
            
            if ($nome!="" ){
                $this->parametro("nome","CLIKE",$nome );
                ($where=="")?$where =" Where upper( nome) like (:nome) ":$where .=" and upper( nome ) like (:nome) ";
            }
            
            if ($senha!="" ){
                $this->parametro("senha","STRING"  ,$senha );
                ($where=="")?$where =" Where senha=:senha ":$where .=" and senha=:senha";
            }
            
            if ($sistema !="" ){
                $this->parametro("sistema","STRING"  ,$sistema );
                ($where=="")?$where =" Where codigoProjeto =: sistema ":$where .=" and codigoProjeto = :sistema";
            }
            
            $this->open("select * from  usuario $where ");
            
            return $this->linhas;
   }
   
  function gravar_acesso($cd_usrs,$cd_menu,$in_tipo='i'){
   
      $this->parametro("cd_usrs","NUMERIC",$cd_usrs );
      $this->parametro("cd_menu","NUMERIC",$cd_menu );	  
	  
	  if($in_tipo == 'd') $this->open("delete from menu_usuario where codigousuario=:cd_usrs");	    	
	  else $this->open("insert into menu_usuario(codigousuario,cd_menu) values(:cd_usrs,:cd_menu) ");
	  
	  return $this->rows;   
  }
  
  function buscarCodigoPessoa( $login, $codigoProjeto, $perfil = 'P' ){
	  
	  $this->open("select p.codigopessoa as codigo 
					 from usuario u, 
						  pessoa p
					where u.login = p.email 
					  and u.login = '$login'
					  and u.codigoProjeto = '$codigoProjeto'
					  and u.perfil = '$perfil' ");

	  if( isset( $this->gs['CODIGO'][0] ) ){
		  return $this->gs['CODIGO'][0];
      }else{
           return '0';  
      }				  							
  }
      
} 

?>