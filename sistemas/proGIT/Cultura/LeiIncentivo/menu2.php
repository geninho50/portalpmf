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


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">A - Proponente<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="ativarDIV('item0');">A.1 - Dados - Pessoa Física</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item1');">A.2 - Dados - Pessoa Jurídica</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item2');">A.3 - Dados - Pessoa Bancários</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">B - Resumo Projeto<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="ativarDIV('item10');">B.1 - Nome do Projeto </a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item10');">B.2 - Modalidade de Incentivo Fiscal</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item10');">B.3 - Setor/Área Cultural do Projeto</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item10');">B.4 - Produto</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item14');">B.5 - Realização</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item15');">B.6 - Previsão Geral de Execução</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item16');">B.7 - Resumo Geral dos Recursos</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">C - Detalhamento do Projeto<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="ativarDIV('item20');">C.1 - Justificativa</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item21');">C.2 - Produto Principal</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item22');">C.3 - Objetivos</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item23');">C.4 - Concessão de Direitos Autorais</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item24');">C.5 - Recursos humanos Envolvidos</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item25');">C.6 - Perfil de Estimativa de Público Alvo</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item26');">C.7 - Plano Ação e Cronograma Execução</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item27');">C.8 - Plano de Distribuição</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item28');">C.9 - Plano de Divulgação</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item29');">C.10 - Demonstração Realização do Projeto</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item210');">C.11 - Prestação de Contas</a></li>

          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">D - Orçamentos<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="ativarDIV('item30');">D.1 - Orçamentos dos Recursos Via Lei de Incentivo</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item31');">D.2 - Orçamento de todo o Projeto Incluindo Recursos de outros</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">E - Anexos<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="ativarDIV('item40');">E.1 - Documentos</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item41');">E.2 - Comprovante de Residência</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item42');">E.3 - Currículo</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item43');">E.4 - Certidões</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item44');">E.5 - Declaração</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" onclick="ativarDIV('item45');">E.6 - Informações Complementares</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>