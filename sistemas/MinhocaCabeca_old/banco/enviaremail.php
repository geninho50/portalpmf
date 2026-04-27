<?php
	include_once("gdb.php"); 
    include_once("../email/gmailSender.class.php");

    $gdb = new gdb();
	
    $gmailSender = new gmailSender();

    $retorno = array();

    $sqlEmail = "SELECT nome, email FROM pessoa p WHERE p.id_pessoa = ";
    $email	  = "minhocanacabeca.comcap@gmail.com";
    $titulo	  = "PROJETO MINHOCA NA CABECA";

    $texto    = $gdb->vargetpost('texto');
	$pessoas2 = $gdb->vargetpost('pessoas');
    $pessoas  = explode(",", $pessoas2 );
    
    print "Pessoas : ".$pessoas2;
    print "<pre>";
    print_r( $pessoas );
    print "</pre>";
    /**/
    
    foreach( $pessoas as $i=>$value ) {

        $gdb->open( $sqlEmail.$pessoas[$i] );
        $teste = $pessoas[$i];

        print "Teste : ".$teste."<br>";

        $destinatario = $gdb->gs['EMAIL'][0];
        $nome         = $gdb->gs['NOME'][0];
        $mensagem     = "Caro(a) Senhor(a) $nome,
                        <br>$texto<br><br>
                        Autarquia Comcap<br>
                        Prefeitura Municipal de Florianópolis";

        print "Destinatário : ".$destinatario."<br>";

        $enviado = $gmailSender->smtpmailer( $destinatario, $email, utf8_decode($nome), $titulo, $mensagem );
        
        if ( !$enviado ){
            echo json_encode( array('error' =>'Erro de envio') ); 
        }else{
            echo json_encode( array('success' => '1','total'=>count( $pessoas ) ) );
        }
    }
   
	if( count($pessoas) == 0){
		echo json_encode( array('success' => '1') );
    }	
    
?>