<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$ok = true;

$cpf = $gdb->vargetpost('cpf');
$gdb->open("select count(*) as tem from cultiva_responsavel where prodCPF = '$cpf' ");
if( $gdb->gs['TEM'][0]>0 ){
   echo json_encode(array('success' => '1','msg' =>'Esse cpf já existe nos nossos cadastros !'));       
   $ok = false;
}

$email = $gdb->vargetpost('email');
$gdb->open("select count(*) as tem from cultiva_responsavel where prodEmail = '$email' ");
if( $gdb->gs['TEM'][0]>0 ){
   echo json_encode(array('success' => '1','msg' =>'Esse email já existe em nosso cadastro !'));       
   $ok = false;
}

if( $ok ){
   
   $gdb->open("select max( prodCodigo ) as codigo from cultiva_responsavel where prodEmail = '$email' ");

   $codigo = $gdb->gs['CODIGO'][0] + 1; 
   
   $nome            = $gdb->vargetpost('nome');
   $telefone        = $gdb->vargetpost('telefone');
   $celular         = $gdb->vargetpost('celular');
   $municipio       = $gdb->vargetpost('municipio');
   $bairro          = $gdb->vargetpost('bairro');				
   $logradouro      = $gdb->vargetpost('logradouro');
   $estado          = $gdb->vargetpost('estado');
   $numero          = $gdb->vargetpost('numero');
   $complemento     = $gdb->vargetpost('complemento');
   $senha           = $gdb->vargetpost('senha');
   $identidade      = $gdb->vargetpost('identidade');


   $gdb->open("INSERT INTO cultiva_responsavel
                         ( prodCodigo,
                           prodNome,
                           prodCPF,
                           prodIdentidade,
                           prodCEP,
                           prodLogradouro,
                           prodNumero,
                           prodComplemento,
                           prodBairro,
                           prodMunicipio,
                           prodEstado,
                           prodCelular,
                           prodTelefone,
                           prodEmail )
                  VALUES(   $codigo,
                            '$nome',
                            '$cpf',
                            '$identidade',
                            '$cep',
                            '$logradouro',
                            '$numero',
                            '$complemento',
                            '$bairro',
                            '$municipio',
                            '$estado',
                            '$celular',
                            '$telefone',
                            '$email' ) ");

   echo json_encode(array('success' => '1','msg' =>'')); 
}


?>