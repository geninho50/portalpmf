<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lei de Incentivo a Cultura</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/brasao.gif">
    <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
</head>

<?php

   error_reporting(E_ALL);
   ini_set('display_errors', '1');

    $menu = array(
        'A - Proponente',
        'B - Resumo Projeto',
        'C - Detalhamento do Projeto',
        'D - Orçamentos',
        'E - Anexos'
    );
  
    $itensMenu = array();
    $itensMenu[0] = array('(01) - Dados - Pessoa Física',
                          '(02) - Dados - Pessoa Jurídica',
                          '(03) - Dados - Bancários');
    $itensMenu[1] = array('(01) - Nome do Projeto',
                          '(02) - Modalidade de Incentivo Fiscal',
                          '(03) - Setor/Área Cultural do Projeto',
                          '(04) - Produto',
                          '(05) - Realização',
                          '(06) - Previsão Geral de Execução',
                          '(07) - Resumo Geral dos Recursos');

    $itensMenu[2] = array('(01) - Justificativa',
                          '(02) - Produto Principal',
                          '(03) - Objetivos',
                          '(04) - Concessão de Direitos Autorais',
                          '(05) - Recursos humanos Envolvidos',
                          '(06) - Perfil de Estimativa de Público Alvo',
                          '(07) - Plano Ação e Cronograma Execução',
                          '(08) - Plano de Distribuição',
                          '(09) - Plano de Divulgação',
                          '(10) - Demonstração Realização do Projeto',
                          '(11) - Prestação de Contas');

    $itensMenu[3] = array('(01) - Orçamentos dos Recursos Via <br> Lei de Incentivo','(02) - Orçamento de todo o Projeto <br> Incluindo Recursos de outros');
    $itensMenu[4] = array('(01) - Documentos','(02) - Comprovante de Residência','(03) - Currículo','(04) - Certidões','(05) - Declaração','(06) - Informações Complementares');
   
?>

<body>

    <div class="dropdown">
       <? foreach( $menu as $key => $value ){ ?>    
        <div class="nav-header" >              
         <a class="btn btn-default menu" href="#" onclick="statusDIV('id<? print $key; ?>');"><b><? print $value; ?><b class="caret"></b></a><br>
            <div id="id<? print $key; ?>" style="display:none;" >
               <? foreach( $itensMenu[$key] as $key2 => $value2 ){ ?>                                    
                    <a class="btn btn-default menu"  href="#" alt="<? print $value2; ?>" onclick="ativarDIV('item'+<? print $key.$key2; ?>);" >
                        &nbsp;&nbsp;&nbsp;<? print $value2; ?>
                    </a><br>                   
               <? } ?>   
            </div>             
      <?} ?>                
        </div>
        
        <div class="nav navbar-nav navbar-left">          
            <a href="#" onclick="sair();" class="btn btn-default menu" ><b>Sair</b></a>
         </div>
    </div>

</body>

</html>