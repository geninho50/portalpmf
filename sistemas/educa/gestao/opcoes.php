<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['aut_gm'])) {
    if ($_SESSION['aut_gm'] != true) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Página Inicial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <![endif]-->

          <!-- Fav and touch icons -->
          <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
          <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
          <link rel="shortcut icon" href="ico/favicon.png">
      </head>

      <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo' style='min-height: 500px;'>
                <div class="row-fluid">
                    <div class="span12" style="padding-left: 5px; padding-right: 5px; margin-top: 5px;">

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#home" data-toggle="tab">Geral</a></li>
                            <li><a href="#infantil" data-toggle="tab">Educação Infantil</a></li>
                            <li><a href="#fundamental" data-toggle="tab">Educação Fundamental</a></li>
                            <li><a href="#eja" data-toggle="tab">EJA</a></li>
                        </ul>

                        <div class="tab-content" style='padding-left: 10px; padding-top: 0px;'>
                            <div class="tab-pane active" id="home">
                                <h4>Configurações</h4>
                                <?php if ($_SESSION['usuario']['permissoes'][1][1] == 1) { ?>
                                <a class='btn btn-primary' 
                                style='line-height: 40px; margin-top:5px;' href="manutencaoEscolas.php">Manutenção de Escolas</a>
                                <?php } ?>
                                
                                <?php if ($_SESSION['usuario']['permissoes'][9][1] == 1) { ?>
                                <?php if ($_SESSION['usuario']['perfil'] != 13) { ?>
                                <?php if ($_SESSION['usuario']['perfil'] != 14) { ?>
                                <a class='btn btn-primary' 
                                style='line-height: 40px; margin-top:5px;' href="manutencaoUsuarios.php">Manutenção de Usuários</a>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][1][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '00871781921') { ?>
                                <a class='btn btn-primary' 
                                style='line-height: 40px; margin-top:5px;' href="alterarSenha.php">Alterar Senha</a>
                                <hr>
                                <?php } ?>

                                <?php if ($_SESSION['usuario']['permissoes'][1][1] == 1) { ?>
                                <a class='btn btn-primary' 
                                style='line-height: 40px; margin-top:5px;' href="consultaAlunos.php">Consulta de Alunos</a>
                                <?php } ?>
                                <hr>
                            </div>

                            <div class="tab-pane" id="infantil">
                                <?php if ($_SESSION['usuario']['nome_usuario'] != '01902288859') { ?>
                                <h4>Cadastros</h4>
                                <?php if ($_SESSION['usuario']['permissoes'][3][1] == 1) { ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1) { ?>
                                <!--<a class='btn btn-primary' href='novoAlunoInfantil.php' style='line-height: 20px; margin-top:5px;'>CDIN001: Cadastro de<br>Criança (Intenção)</a>
                                --><?php } } } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][3][1] == 1) { ?>
                                <!--<a class='btn btn-primary' href='cadastroSimplificadoInfantil.php' style='line-height: 20px; margin-top:5px;'>CDIN002: Cadastro de<br>Crianças Frequentando</a>
                                --><?php } ?>
                                <hr>
                                <h4>Consultas</h4>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' href='pesquisarInfantil.php' style='line-height: 20px; margin-top:5px;'>CSIN001: Pesquisar<br>Crianças (Intenção)</a>
                                <?php } ?> 
                                <?php if ($_SESSION['usuario']['permissoes'][5][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' href='pesquisarInfantilComVaga.php' style='line-height: 20px; margin-top:5px;'>CSIN002: Pesquisar<br>Crianças (Atendidos)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][5][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' href='listaDeIntencaoInfantil.php' style='line-height: 20px; margin-top:5px;'>CSIN003: Lista de<br>Intenção</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][5][1] == 1) { ?>
                                <a class='btn btn-primary' href='consultaAlunosInfantil.php' style='line-height: 20px; margin-top:5px;'>CSIN004: Consulta de<br>Alunos</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][5][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' href='consultaAlunosInfantilDesistentesIntencao.php' style='line-height: 20px; margin-top:5px;'>CSIN005: Consulta de<br>Alunos Desistentes</a>
                                <?php } ?>
                                <hr>
                                <h4>Relatórios</h4>
                                
                                <?php if ($_SESSION['usuario']['permissoes'][5][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '00871781921') { ?>
                                <a class='btn btn-primary'style='line-height: 20px; margin-top:5px;' href='classificacaoInfantil.php'>RLIN001: Classificação<br>(Intenção)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][5][1] == 1) { ?>
                                <a class='btn btn-primary'style='line-height: 20px; margin-top:5px;' href='relatorios/geraRelatorioAlunoInfantilDuplicado.php'>RLIN002: Crianças com<br>matrícula duplicada</a>
                                <?php } ?>
                                <!--<?php if ($_SESSION['usuario']['permissoes'][5][1] == 1) { ?>
                                <a class='btn btn-primary'style='line-height: 20px; margin-top:5px;' href='relatorios/geraRelatorioInscritosInfantil.php'>RLIN003: Crianças Inscritas<br>em Intenção (Quant.)</a>
                                <?php } ?>-->
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioIntencaoTotalInfantil.php">RLIN003: Inten&ccedil;&otilde;es<br>(Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioAtendidosInfantil.php">RLIN004: Crianças<br>Atendidas (Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioCriancasInfantil.php">RLIN005: Crianças Atendidas e em<br> Inten&ccedil;&atilde;o por Bairro (Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioRendaInfantil.php">RLIN006: Renda per capita<br> por Bairro (Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioBolsaInfantil.php">RLIN007: Bolsa Família<br> por Bairro (Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioCriancasInfantilAtendidos.php">RLIN008: Crianças Atendidas<br> por Bairro (Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorioCriancasEndereco.php">RLIN009: Crianças Atendidas com<br> Endereço (por Escola e Grupo)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorioCriancasIntencaoEndereco.php">RLIN010: Crianças em Intenção com<br> Endereço (por Escola e Grupo)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorioCriancasIntencaoEnderecoSemVaga.php">RLIN011: Crianças em Intenção sem Vaga<br>com Endereço (por Escola e Grupo)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorioCriancasEscolha.php">RLIN012: Crianças em Atendidas com tipo<br>de atendimento (a partir de 18/03)</a>
                                <?php } ?>
							    <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioAlunoInfantilDuplicado.php">RLIN013: Homônimos com<br>Vaga e Intenção</a>
                                <?php } ?>
								
								
								<?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioAlunoInfantilDesistente.php">RLIN014: Crianças<br>Desistentes(Vaga)</a>
                                <?php } ?>
								<?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioAlunoInfantilDesistenteIntencao.php">RLIN015: Crianças<br>Desistentes(Intenção)</a>
                                <?php } ?>								
                                <hr>
                                <h4>Formulários</h4>
                                <?php if ($_SESSION['usuario']['permissoes'][4][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary'style='line-height: 20px; margin-top:5px;' onclick='window.open("relatorios/emitirFormListaIntencao.php", "popupWindow", "width=600,height=600,scrollbars=yes");'>FRIN001: Formulário<br>de Cadastro em Branco</a>
                                <?php } ?>
                                <br><br>
                            </div>

                            <div class="tab-pane" id="fundamental">
                                <h4>Cadastros</h4>
                                <?php if ($_SESSION['usuario']['permissoes'][11][1] == 1) { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="quadroDeVagas.php">CDEF001: Quadro<br>de Vagas</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1) { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="novoAlunoRematricula.php">CDEF002: Novo Aluno<br>para Rematrícula</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][13][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="../matricula/novoAluno.php">CDEF003: Cadastro<br>de Novo Aluno</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][13][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="../matricula/loginRematricula.php">CDEF004: Rematrícula<br>Fundamental</a>
                                <?php } ?>
                                <hr>
                                <h4>Consultas</h4>   
                                <!--href='quadroDeVagas.php'--> 
                                <?php if ($_SESSION['usuario']['permissoes'][14][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="listaDeMatriculados.php">CSEF001: Lista<br>de Alunos</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][13][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="listaDeNovosAlunos.php">CSEF002: Lista de<br>Novos Alunos</a>
                                <?php } ?>
                                <!--href='quadroDeVagas.php'--> 
                                <?php if ($_SESSION['usuario']['permissoes'][14][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="listaDeRematriculados.php">CSEF003: Lista de<br>Rematriculas Realizadas</a>
                                <?php } ?>
                                <!--href='listaDeMatriculados.php'--> 
                                <?php if ($_SESSION['usuario']['permissoes'][13][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="listaDeIntencao.php">CSEF004: Lista<br>de Intenção</a>
                                <?php } ?>                           
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="listaDeAlunosExcluidos.php">CSEF005: Lista de<br>Vagas Excluídas</a>
                                <?php } ?>                          
                                <?php if ($_SESSION['usuario']['permissoes'][13][1] == 1) { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="consultaAlunosFundamental.php">CSEF006: Consulta de<br>Alunos</a>
                                <?php } ?>
<!--                                 <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1) { ?>
                                <a class='btn btn-primary' style='line-height: 40px; margin-top:5px;' href="listaDeIntencaoTodos.php">Lista de Intenção - Todas Escolas</a>
                                <?php } ?> -->
<!--                                 <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1) { ?>
                                <a class='btn btn-primary' style='line-height: 40px; margin-top:5px;' href="listaDeIntencaoTudo.php">Lista de Intenção - Todas Escolas e Fases</a>
                                <?php } ?> -->
                                
                                <hr>
                                <h4>Relatórios</h4>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioAlunosComMaisVagas.php">RLEF001: Alunos com<br>Mais de Uma Vaga</a>
                                <?php } ?>

                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioAlunoComMaisVagasEscola.php">RLEF002: Alunos com Mais<br>de Uma Vaga (por Escola)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][14][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioQuadroVagasEscola.php">RLEF003: Vagas<br>(Quadro de Vagas)</a>
                                <?php } ?>
                                <?php //Incluso 02/12 por alex ?>
                                <?php if ($_SESSION['usuario']['permissoes'][14][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioQuadroVagasNova.php">RLEF004: Vagas de Novos<br>Alunos (Quadro de Vagas)</a>
                                <?php } ?>
                                <?php //Incluso 02/12 por alex ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioQuadroVagasReserva.php">RLEF005: Vagas de Reserva<br>(Quadro de Vagas)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][14][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/relatorioDeAlunosPorEscola.php">RLEF006: Relatório<br>de Alunos</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatoriosRematricula.php">RLEF007: Relatórios<br>da Rematrícula</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioRematriculaTotal.php">RLEF008: Rematrículas<br> Realizadas (Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioNovasVagasTotal.php">RLEF009: Vagas<br>de Novos Alunos</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioIntencaoTotal.php">RLEF010: Inten&ccedil;&otilde;es<br>(Quant.)</a>
                                <?php } ?>
                                
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioAlunoFundamentalDuplicado.php">RLEF011: Relatório<br>de Homônimos</a>
                                <?php } ?>

                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioTotalAlunosNovos.php">RLEF012: Relatório<br>Total de Novos Alunos</a>
                                <?php } ?>

                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioTotalAlunosEscola.php">RLEF013: Relatório<br>Total de Alunos por Escola</a>
                                <?php } ?>

                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioTotaldeRematricula.php">RLEF014: Relatório<br>Total de Rematrícula</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][13][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="classificacaoFundamental.php">RLEF015: Classificação<br> de Intenção</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioAlunoIntencaoFundamentalDuplicado.php">RLEF016: Relatório de<br> Homônimos em Intenção</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioAlunosfundamentalvagaintencao.php">RLEF017: Relatório de Alunos com<br> Vaga e em Intenção na Mesma Unidade</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioTotalAtendidos.php">RLEF018: Relatório de <br>Alunos em Intenção Atendidos</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioIntencaoReserva.php">RLEF019: Relatório de Intenção<br>e Vagas de Reserva (Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorioCriancasIntencaoFundamentalEnderecoSemVaga.php">RLEF020: Alunos em Intenção sem Vaga<br>com Endereço (por Escola e Etapa)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/geraRelatorioIntencaoSemVaga.php">RLEF021: Alunos em Intenção sem Vaga<br>por Escola e Etapa (Quant.)</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 OR $_SESSION['usuario']['nome_usuario'] == '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/gerarRelatorioAlunoFundamentalDuplicado2.php">RLEF022: Homônimos com<br>Vaga e Intenção</a>
                                <?php } ?>

                                <hr>
                                <h4>Formulários</h4>
                                <?php if ($_SESSION['usuario']['permissoes'][12][1] == 1 ) { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="imprimirCadastroAlunoFund.php">FREF001: Imprimir<br>Cadastro Aluno</a>
                                <?php } ?>
                                <?php if ($_SESSION['usuario']['permissoes'][13][1] == 1 && $_SESSION['usuario']['nome_usuario'] != '05843825965') { ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="relatorios/emitirFormCadastroFundamentalBranco.php">FREF002: Imprimir<br>Cadastro em Branco</a>
                                <?php } ?>
                                <br><br>
                            </div>

                            <div class="tab-pane" id="eja">
                                <h4>Cadastros</h4>
                                <?php if($_SESSION['usuario']['perfil'] == 1 || $_SESSION['usuario']['perfil'] == 3 || $_SESSION['usuario']['perfil'] == 6 || $_SESSION['usuario']['perfil'] == 12 || $_SESSION['usuario']['perfil'] == 14 && $_SESSION['usuario']['nome_usuario'] != '05843825965'){ ?>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="novoAlunoRematriculaEJA.php">CDEJ001: Novo Aluno<br>para Rematrícula</a>
                                <a class='btn btn-primary' style='line-height: 20px; margin-top:5px;' href="../matricula/novoAlunoEJA.php">CDEJ002: Cadastro de<br>Novo Aluno</a>
                                <?php } ?>
                                <hr>
                                <h4>Consultas</h4>
                                <?php if($_SESSION['usuario']['perfil'] == 1 || $_SESSION['usuario']['perfil'] == 3 || $_SESSION['usuario']['perfil'] == 6 || $_SESSION['usuario']['perfil'] == 12 || $_SESSION['usuario']['perfil'] == 14 || $_SESSION['usuario']['perfil'] == 15){ ?>   
                                <a class='btn btn-primary' href='listaDeRematriculadosEJA.php' style='line-height: 20px; margin-top:5px;'>CSEJ001: Rematriculas<br>Realizadas</a>
                                <a class='btn btn-primary' href='listaDeAlunosRematriculaEJA.php' style='line-height: 20px; margin-top:5px;'>CSEJ002: Alunos<br>para Rematricula</a>
                                <a class='btn btn-primary' href='consultaAlunosEja.php' style='line-height: 20px; margin-top:5px;'>CSEJ003: Consulta de<br>Alunos</a>
                                <?php } ?>
                                <hr>
                                <h4>Formulários</h4>
                                <?php if($_SESSION['usuario']['perfil'] == 1 || $_SESSION['usuario']['perfil'] == 3 || $_SESSION['usuario']['perfil'] == 6 || $_SESSION['usuario']['perfil'] == 12 || $_SESSION['usuario']['perfil'] == 14 || $_SESSION['usuario']['perfil'] == 15){ ?>   
                                <a class='btn btn-primary' href='../gestao/relatorios/emitirFormBrancoEJA.php' style='line-height: 20px; margin-top:5px;'>FREJ001: Formulario de<br>Cadastro em Branco</a>
                                <?php } ?>
                                <hr>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
    </html>
