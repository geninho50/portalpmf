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
include 'fnc/buscaEscolas.php';
$escolas = buscaEscolasInfantil();

include 'fnc/buscaPeriodos.php';
$anos = buscaPeriodos();

include 'fnc/buscaFases.php';
$fasesF = buscaFases(2);

if (isset($_GET['escola'])) {
    if (isset($_GET['ano'])) {
        if (isset($_GET['fase'])) {
            include 'fnc/buscaIntencaoInfantil.php';
            $intencao = buscaIntencaoInfantil(2, $_GET['ano'], $_GET['fase'], $_GET['escola']);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Pesquisar Aluno</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/dt_bootstrap.css" rel="stylesheet">
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
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Lista de Intenção (Ordem Alfabética)</h2>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>
                        <form>
                            <label style='display: inline;'> Escola:
                                <select id='inputEscola' name='escola' style='margin-bottom: 0px;' required 
                                onchange="if ($(this).val() != '') {
                                $('#opt1').remove();
                                $('#inputAno').removeAttr('disabled');
                                $('#opt2').attr('selected', '');
                                $('#inputFase').attr('disabled', '');
                            }">
                            <option id='opt1'></option>
                            <?php
                            foreach ($escolas as $key => $value) {
                                echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                            }
                            ?>
                        </select>
                    </label>
                    <label style='display: inline;'> Ano:
                        <select id='inputAno' disabled name='ano' style='margin-bottom: 0px; width: 150px;' required
                        onchange='$.get("ajax/fasesCAE.php", {curso: 2, ano: $(this).val(), escola: $("#inputEscola").val()})
                        .done(function(data) {
                        $("#inputFases").html(data);
                        $("#inputFases").removeAttr("disabled");
                    });'>
                    <option id='opt2'></option>
                    <?php
                    foreach ($anos as $key => $value) {
                        echo '<option>' . $value[0] . '</option>';
                    }
                    ?>
                </select>
            </label>
            <label style='display: inline;'> Etapa:
                <select id='inputFases' disabled name='fase' style='margin-bottom: 0px;' required>
                    <?php
                    foreach ($fasesF as $key => $value) {
                        echo '<option>' . ($value[1]) . '</option>';
                    }
                    ?>
                </select>
            </label>
            <h5 id='semFase' style='display: none;'>Escola não possui fases no ano escolhido.</h5>

            <button class='btn btn-primary'>Avançar</button>
        </form>

        <?php if (isset($intencao)) { ?>
        <hr>
        <div id='intencao' style='display: inherit;'>
            <?php
            if (isset($_GET['sucesso'])) {
                if ($_GET['sucesso'] == true) {
                    ?>
                    <div class='sucesso'>
                        <strong>Sucesso!</strong> Aluno removido da lista de intenção com sucesso. 
                    </div>
                    <?php
                } else {
                    ?>
                    <div class='erro'>
                        <strong>Erro!</strong> Um erro ocorreu, tente novamente.
                    </div>
                    <?php
                }
            }
            ?><?php
            if (isset($_GET['sucessoA'])) {
                if ($_GET['sucessoA'] == 'true') {
                    ?>
                    <div class='sucesso'>
                        <strong>Sucesso!</strong> Aluno atendido com sucesso. 
                    </div>
                    <?php
                } else {
                    ?>
                    <div class='erro'>
                        <strong>Erro!</strong> Não existem vagas disponíveis.
                    </div>
                    <?php
                }
            }
            ?>
            <h4>Escola: <?php echo ($escolas[$_GET['escola']][1]); ?></h4>
            <h4>Ano: <?php echo $anos[$_GET['ano']][0]; ?></h4>
            <h4>Etapa: <?php echo $fasesF[$_GET['fase']][1]; ?></h4>
            <table class='table table-striped table-bordered' id='tabela'>
                <thead>
                    <tr>
                        <td style='width: 50px;'># Matrícula</td>
                        <td>Nome</td>
                        <td>Dt. Nasc.</td>
                        <td>Opção</td>
                        <td style='width: 70px;'>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $aspa = "'";
                    if (isset($intencao)) {
                        if ($intencao != false) {
                            foreach ($intencao as $key => $value) {
                                echo '<tr>';
                                echo '<td style="width: 70px;">';
                                echo $value[3];
                                echo '</td>';
                                echo '<td>';
                                echo ($value[2]);
                                echo '</td>';
                                echo '<td>';
                                $data = explode('-', $value[6]);
                                echo $data[2].'/'.$data[1].'/'.$data[0];
                                echo '</td>';
                                echo '<td style="width: 50px;">';
                                if ($value[4] == 1) {
                                    echo 'Primeira';
                                } else {
                                    echo 'Segunda';
                                }
                                echo '</td>';
                                echo '<td style="width: 100px;">';
                                if(($_SESSION['usuario']['permissoes'][13][1] == 1)OR($_SESSION['usuario']['perfil'] = 4)){
                                    if($value[4] == 1){
                                        echo '<a title="Atender em 1ª opção" href="#modalAtender" role="button" data-toggle="modal"
                                        onclick="passarInfo(' . $value[3] . ', ' . $aspa . $value[2] . $aspa . ', ' . $value[1] . ', '.$value[4].');"
                                        ><i class="iconic-check" style="color: green"></i></a>';
                                        echo '&nbsp;';
                                        echo '<span title="Atender"
                                        ><i class="iconic-check" style="color: #c4ffc4"></i></span>';
                                        echo '&nbsp;';
                                    } else {
                                        echo '<span
                                        ><i class="iconic-check" style="color: #c4ffc4"></i></span>';
                                        echo '&nbsp;';
                                        echo '<a title="Atender em 2ª opção" href="#modalAtender" role="button" data-toggle="modal"
                                        onclick="passarInfo(' . $value[3] . ', ' . $aspa . $value[2] . $aspa . ', ' . $value[1] . ', '.$value[4].');"
                                        ><i class="iconic-check" style="color: green"></i></a>';
                                        echo '&nbsp;';
                                    }
                                }
                                echo '<a title="Visualizar Aluno" href="visualizarAlunoInfantil.php?idAluno='.$value[1].'"><i style="color: blue;" class="iconic-magnifying-glass"></i></a>';
                                echo '&nbsp;';
                                
                                if ($_SESSION['usuario']['perfil'] != 13) {
                                    if ($_SESSION['usuario']['perfil'] != 14) {
                                        if ($_SESSION['usuario']['nome_usuario'] != '01902288859') {
                                            echo '<a title="Editar Aluno" href="editarAlunoInfantil.php?idAluno=' .
                                            $value[1] . '"><i class="iconic-pen-alt2"></i></a>';
                                            echo '&nbsp;';
                                        
//                                                    if ($_GET['escola'] == $_SESSION['usuario']['id_escola']) {

                                        
                                         echo '<a title="Desistir Aluno" href="#modalDesistir" role="button" data-toggle="modal"
                                         onclick="passarInfoD(' . $value[3] . ', ' . $aspa . $value[2] . $aspa . ', ' . $value[1] . ');"
                                         ><i class="iconic-x" style="color: red"></i></a>';
                                     }
                                 }
                             }
//                                                    }
                            echo '&nbsp;'; 
                             echo '<a title="Ocorrências" href="ocorrencias.php?idAluno=' . $value[1] . '"><i class="iconic-book" style="color: orange"></i></a>';
                                                
                             echo '</td>';
                             echo '</tr>';
                         }
                     }
                 }
                 ?>
             </tbody>
         </table>
         <hr>
         <a class='btn' href='opcoes.php'>Voltar</a>
     </div>
     <?php } ?>

 </div>
</div>   
</div>

<div id="modalAtender" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="labelModalEfetivar"><strong># Matrícula:</strong> <font id='numeroMatriculaM'></font></h3>
    </div>
    <div class="modal-body">
        <h5>Nome: <font id='nomeAlunoM'></font></h5>
        <h5>Escola: <?php echo ($escolas[$_GET['escola']][1]); ?></h5>
        <h5>Ano: <?php echo $anos[$_GET['ano']][0]; ?></h5>
        <h5>Etapa: <?php echo $fasesF[$_GET['fase']][1]; ?></h5>
        <p>Tem certeza que você deseja atender este aluno?</p>
    </div>
    <div class="modal-footer">
        <form action='atenderAlunoIntencaoInfantil.php' method="post">
            <input name='id_aluno' type='hidden' id='inputIdAlunoM'>
            <input name='escola' value="<?php echo $_GET['escola']; ?>" type='hidden' id='inputEscolaM'>
            <input name='ano' value="<?php echo $_GET['ano']; ?>" type='hidden' id='inputAnoM'>
            <input name='fase' value="<?php echo $_GET['fase']; ?>" type='hidden' id='inputFaseM'>
            <input name='opcao' type='hidden' id='inputOpcaoM'>
            <a class="btn" data-dismiss="modal" aria-hidden="true">Não</a>
            <button class="btn btn-primary">Sim</button>
        </form>
    </div>
</div>

<div id="modalDesistir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="labelModalEfetivar"><strong>#</strong> <font id='numeroMatriculaD'></font></h3>
    </div>
    <div class="modal-body">
        <p>Tem certeza que você deseja desistir o aluno desta intenção?</p>
    </div>
    <div class="modal-footer">
        <form action='desistirAlunoIntencaoInfantil.php'>
            <input name='id_aluno' type='hidden' id='inputIdAlunoD'>
            <label>Motivo:
                <select name="motivo" required>
                    <option></option>
                    <option value='1'>Aluno já Matriculado na Rede.</option>
                    <option value='2'>Após 2 tentativas não foi possível contatar o aluno ou a família.</option>
                    <option value='3'>Aluno/Família requisitou a desistência na unidade.</option>
                    <option value='4'>Erro de cadastro.</option>
                    <option value='5'>Mudança de Endereço.</option>
                    <option value='6'>Não compareceu por 5 dias consecutivos ou alternados durante o mês.</option>
                </select>
            </label>
            <input name='escola' value="<?php echo $_GET['escola']; ?>" type='hidden' id='inputEscolaD'>
            <input name='ano' value="<?php echo $_GET['ano']; ?>" type='hidden' id='inputAnoD'>
            <input name='fase' value="<?php echo $_GET['fase']; ?>" type='hidden' id='inputFaseD'>
            <a class="btn" data-dismiss="modal" aria-hidden="true">Não</a>
            <button class="btn btn-primary">Sim</button>
        </form>
    </div>
</div>

</div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
        <script src="js/dt_bootstrap.js"></script>
        <script>

            $('#tabela').dataTable({
                "aaSorting": [[ 1, "asc" ]],
                "oLanguage": {
                    "sSearch": "Buscar:",
                    "bSort": false,
                    "oPaginate": {
                        "sNext": "Próxima",
                        "sPrevious": "Anterior"
                    },
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sZeroRecords": "Nenhum registro encontrado...",
                    "sInfo": "Mostrando _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)"
                }
            });
        </script>
        <script type="text/javascript">
            function passarInfo(matricula, nome, id_aluno, opcao) {
                $('#numeroMatriculaM').html(matricula);
                $('#nomeAlunoM').html(nome);
                $('#inputIdAlunoM').val(id_aluno);
                $('#inputOpcaoM').val(opcao);
            }
            function passarInfoD(matricula, nome, id_aluno) {
                $('#numeroMatriculaD').html(matricula);
                $('#nomeAlunoD').html(nome);
                $('#inputIdAlunoD').val(id_aluno);
            }
        </script>
    </body>
    </html>
