<?php 
        $verIncluir = false; 
 
        require ("DB_mysql.php"); 
        $obj = new DB_mysql; 
        $tamanho = strlen($login); 
 		
		$id = $_POST['id'];

        if(isset($_POST)) { 
            $i = 0; 
            foreach($_POST['login'] as $v) 
            { 
 
                    $query ="update listaescala set hora1='".$_POST['qtdhoras1'][$i]."', hora2='" .$_POST['qtdhoras2'][$i]. "',adicional='" .$_POST['adicional'][$i]. "' where idescala = '" .$_POST['idescala'][$i]. "' and login = '" .$v. "'";
					/*$query = "INSERT INTO listaescala(login, hora1, hora2, adicional,idescala, data,chefe,auditado) 
                              VALUES 
                              ('" .$v. "', 
                               '" .$_POST['qtdhoras1'][$i]. "', 
                               '" .$_POST['qtdhoras2'][$i]. "', 
                               '" .$_POST['adicional'][$i]. "',
							   '" .$_POST['idescala'][$i]. "', 
                               '" .$_POST['data'][$i]. "')"; */
                    $obj->executaQuery($query); 
                    $verIncluir = true; 
 
					$i++; 
					/*$queryL = "update listaescala set chave=1 where idescala=$id"; 
					$obj->executaQuery($queryL);*/
            } 
           $obj->closeVar($query); 
           $obj->closeQuery(); 
           $obj->closeConexaoGeral(); 
 
          // Redireciona 
          if( $verIncluir == false ) 
          { 
                  echo 'Não foi possível efetuar o cadastro.'; 
          } 
          else 
          { 
 
                  header ("Location:../adm/busca_escala_horaextra.php"); 
                  $queryC = "update escalahoraextra set chave=1 where id=$id"; 
                  $obj->executaQuery($queryC); 
          } 
        } 
?>