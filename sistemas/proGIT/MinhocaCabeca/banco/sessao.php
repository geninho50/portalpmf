<?php
  include_once('gdb.php'); 

class sessao  extends gdb {
   
   var $usid;
   var $nome;
   var $codigoProjeto;
   var $email;
   var $cpf;
   var $codigoSessao;
   var $id;
   var $ip;
   var $pagina;

   function sessao($id = "",$usid = "", $nome = "", $codigoProjeto = "", $email = "", $cpf = "", $codigoSessao = "") {
      if (($usid!="") && ($nome!="")) {
		  
         $this->id = $this->sessionid();
         $this->usid = $usid;
         $this->nome = $nome;         
         $this->email = $email;
         $this->cpf = $cpf;
		 $this->codigoProjeto = $codigoProjeto;
         

         session_start();
         $this->codigoSessao = $this->sessionid();
		 
         setcookie("ID", $this->id, 0, '/');
         setcookie("USID", $this->usid, 0, '/');
         setcookie("NOME", $this->nome, 0, '/');
         setcookie("CODIGOPROJETO", $this->codigoProjeto, 0, '/');
         setcookie("EMAIL", $this->email, 0, '/');
         setcookie("CPF", $this->cpf, 0, '/');
         setcookie("SESSAO", $this->codigoSessao, 0, '/');
         
         //, time()+60*30, '/'
      }
      else {
		  if( ISSET( $_COOKIE['ID'] ) ){ 
			 $this->id 			 = $_COOKIE['ID'];
			 $this->usid		 = $_COOKIE['USID'];
			 $this->nome		 = $_COOKIE['NOME'];         
			 $this->email		 = $_COOKIE['EMAIL'];
			 $this->cpf 		 = $_COOKIE['CPF'];
			 $this->codigoSessao = $_COOKIE['SESSAO'];
		  }	 
      }
      $this->pagina = $_SERVER['SCRIPT_NAME'];
      $this->ip = $_SERVER['REMOTE_ADDR'];

   }
  
   function iniciar_sessao($sistema = '', $usid){
	   
	 $db = new gdb();
	 
	 $data  = date('Y-m-d');
	 
	 $db->open("select count(*) as logado 
	              from sessao 
				 where codigoUsuario='$usid' 
				   and sistema='$sistema' 
				   and dataInicial = '$data' 
				   and horaFinal is null ");	
	 
	 if( ( $db->gs['LOGADO'][0] == 0 ) || ( !isset($_SESSION) ) ){
	
		 $hora  = date('H:i');
		 $nu_ip	=  getenv("REMOTE_ADDR");	         
	     session_start();
		 $codigoSessao = $this->sessionid();
		 
		 // print "Codigo Sessão ; ".$codigoSessao;
		 
		 if( $sistema !='JEM' ){
           $db->open("select p.nome, 
                             cpf, 
                             login, 
                             codigoUsuario as usid 
                        from usuario u, 
                             pessoa p 
                       where p.email = u.login 
                         and codigoUsuario='$usid' ");		
        }else{
           $db->open("select p.nome, 
                             cnpj as cpf, 
                             login, 
                             codigoUsuario as usid 
                        from usuario u, 
                             escola p 
                       where p.email = u.login 
                         and codigoUsuario='$usid' ");             
        }   
         
		 setcookie("ID", $this->sessionid(), 0, '/');
         setcookie("USID", $db->gs['USID'][0], 0, '/');
         setcookie("NOME", $db->gs['NOME'][0], 0, '/');
         setcookie("CODIGOPROJETO", 'MNC', 0, '/');
         setcookie("EMAIL", $db->gs['LOGIN'][0], 0, '/');
         setcookie("CPF", $db->gs['CPF'][0], 0, '/');         
         setcookie("SESSAO", $codigoSessao, 0, '/');

		 $db->open("insert into sessao( codigoSessao,
		                                dataInicial, 
		                                horainicial, 
									           codigoUsuario, 
										        numeroip, 
										        sistema ) 
   									values('$codigoSessao',
   									       '$data',
   									       '$hora',
   										   '$usid',
   										   '$nu_ip',
   										   '$sistema') ");
	 }else return 0;
	   
   }
   
   function encerrar_sessao($sistema = '', $usid){ 
   
	 $db = new gdb();
	 
	 $data  = date('Y-m-d');
   
	 $db->open("SELECT codigoSessao, 
	                    dataInicial, 
						horaInicial  
	               FROM backend.sessao 
				  where codigoUsuario='$usid' 
			  order by dataInicial desc, 
			           horaInicial desc LIMIT 0,1 ");					   

	 if( $db->linhas == 1  ){		 
	 
		$codigoSessao = $db->gs['CODIGOSESSAO'][0];	 
		$hora  = date('H:i');			  
		
		$db->open("update sessao
					  set dataFinal = '$data',
						  horaFinal = '$hora'
					where codigoSessao='$codigoSessao' ");
		$this->close();			
	 }	 
	     
   }
   
   function logado_sessao($sistema = '',$usid){ 
   
	 $db = new gdb();
	 
	 $data  = date('Y-m-d');
   
     $db->open("select count(*) as logado 
	              from sessao 
				 where codigoUsuario ='$usid' 
				   and sistema ='$sistema' 
				   and dataInicial = '$data' 
				   and dataFinal is null ");
	 
	 if( $db->gs['LOGADO'][0]>0  ) return 1;
	 else return 0;		     
   
   }
   
   function sessionid() {

      $id = "";
      $tam = 32;
      $vetor = array('0', '1', '2', '3',
                     '4', '5', '6', '7',
                     '8', '9', 'a', 'b',
                     'c', 'd', 'e', 'f',
                     'g', 'h', 'i', 'j',
                     'k', 'l', 'm', 'n',
                     'o', 'p', 'q', 'r',
                     's', 't', 'u', 'v',
                     'w', 'x', 'y', 'z');


      for ($j=1; $j <= $tam; $j++)
         $id .= $vetor[rand(0, count($vetor) - 1)];

      return $id;

   }

   function close(){	   
      setcookie("ID", "");
      setcookie("USID", "");
      setcookie("NOME", "");
      setcookie("CODIGOPROJETO", "");
      setcookie("EMAIL", "");
      setcookie("CPF", "");      
      setcookie("SESSAO", "");
      $this->id = "";
      $this->usid = "";
      $this->nome = "";
      $this->codigoprojeto = "";
      $this->page = "";
      $this->ip = "";
      $this->email = "";
      $this->cpf = "";      
      $this->codigoSessao = "";
	  if( isset( $_SESSION ) ){
		  session_destroy();
	  }
	  session_unset();
   }

   function finalizarAcesso($minutes) {
      $atividade = strftime("%d/%m/%Y %H:%M:%S", strtotime("now") - ($minutes * 60) );
      $this->open("delete from acesso where atualizacao <= '$atividade' ");      
      return $this->linhas;

   }
   
   function selectAcesso($codigoAcesso = "", $sessaophp ="" ) {
	  $where = ""; 
	  if( $codigoAcesso != "" ){
		  $where = " where codigoAcesso = '$codigoAcesso' ";
	  } 
		  
	  if( $sessaophp != "" ){
		  if( $where == "" ){
			  $where = " where sessaophp = '$sessaophp' ";
		  }else{
			  $where .= " and sessaophp = '$sessaophp' ";
		  }
	  } 
	  
      $this->open("select * from acesso $where ");
      return $this->linhas;
   }
   
   function insertAcesso($ssid, $usid, $pagina, $entrada, $atualizacao, $ip, $sessaophp) {

      if ( $this->select($ssid, $sessaophp) ){
		  $this->open("delete from acesso where codigoAcesso = '$ssid' ");
      }
	  
      $this->open("insert into acesso (codigoAcesso, codigoUsuario, pagina,entrada, atualizacao, ip, sessaophp) values ('$ssid','$usid','$pagina', $entrada, $atualizacao, '$ip', '$sessaophp') ");

      return $this->linhas;
   }

   function updateAcesso($ssid, $usid, $pagina,$entrada, $atualizacao, $ip ) {

      // login nao deve ser atualizado, pois contém a data de entrada no sistema
      $this->open("update acesso 
	                  set pagina = '$pagina',
                          atualizacao = $atualizacao
                    where codigoAcesso = '$ssid'
                      and codigoUsuario = '$usid'
                      and ip = '$ip' ");
	  
      return $this->linhas;

   }
 
}  
  ?>