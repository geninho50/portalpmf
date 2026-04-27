<?php
include "backend/db.php";


$id = $_GET['id'];
$idBotSub = "btnSubmit";
if ($id != null) {
    $sql = $db->prepare("SELECT * FROM `palestras`.`funcionario` where `id` = $id");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if ($data != '') {
        $nome = utf8_encode($data['nome']);
        $secretaria = utf8_encode($data['secretaria']);
        $identificacao = utf8_encode($data['identificacao']);
    }
    $idBotSub = "update";
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Palestras</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="subpage">

    <header id="header">
        <div class="logo"><a href="http://www.pmf.sc.gov.br">Sair</a></div>
    </header>


    <section id="two" class="wrapper style2">
        <div class="inner">
            <div class="box">

                <div>
                    <img style="object-fit:cover; object-position: 0 30%; height: 400px;" src="images/capa.jpg" width="100%">
                </div>


                <div class="content">
                    <header class="align-center">
                        <h2>INSCRIÇÕES ENCERRADAS</h2>
                        <div style="color: white; background-color: black; font-size: 35px;" align="left" class="alert alert-danger hide" id="error"></div>
                    </header>

                    <form id="frm1" name="frm1" method="post" action="backend/cadastro.php" ; enctype="multipart/form-data">

                        <br>
                        <h3>Palestras: </h3>
                        <br>
                        <div class="row uniform">
                            <div class="12u 12u$(xsmall)">
                                <h3><strong>Comunicação Positiva, Relações Construtivas</strong></h3>
                                <!--<input type="checkbox" name="nome_palestra" value="1" id="palestra1" name="priority">-->
                                <label for="palestra1"><strong>Palestrante: Juliana Germann<br>
                                        Data: 22/10/2019<br>
                                        Horário: 17:00<br>
                                        Local: CRCSC - Av. Osvaldo Rodrigues Cabral, 1900 - Centro, Florianópolis - SC, 88015-710</strong></label>

                                <br><br>

                                <h3><strong>Influência da Voz e a Importância da Comunicação no Ambiente de Trabalho</strong></h3>
                                <!--<input type="checkbox" name="nome_palestra" value="2" id="palestra2">-->
                                <label for="palestra2"><strong>Palestrante: Cristine Luiz<br>
                                        Data: 25/10/2019<br>
                                        Horário: 17:00<br>
                                        Local: CEC - Centro de Educação Continuada - Rua Ferreira Lima, 82 - Centro</strong></label>

                                <br><br>

                                <h3><strong>Ser Humano: o valor da vida e o poder da palavra</strong></h3>
                                <!--<input type="checkbox" name="nome_palestra" value="3" id="palestra3">-->
                                <label for="palestra3"><strong>Palestrante: Mauricio Fernandes Pereira<br>
                                        Data: 28/10/2019<br>
                                        Horário: 16:30<br>
                                        Local: Castelmar Hotel - R. Felipe Schmidt, 1260 - Centro, Florianópolis - SC, 88010-002</strong></label>
                            </div>
                        </div>

                        <br>
                        <hr>
                        <br>

                        <!--<div class="row uniform">
                            <div class="8u 12u$(xsmall)"><label>Nome</label>
                                <input type="text" value="<?= $nome ?>" id="nome" name="nome" placeholder="Nome Completo" />
                            </div>

                            <div class="6u 12u$(xsmall)"><label>Secretaria:</label>
                                <select class="form-control" id="secretaria">
                                    <option value="Administração">Administração</option>
                                    <option value="Assistência Social">Assistência Social</option>
                                    <option value="Casa Civil">Casa Civil</option>
                                    <option value="COMCAP">COMCAP</option>
                                    <option value="Continente">Continente</option>
                                    <option value="Cultura, Esporte e Juventude">Cultura, Esporte e Juventude</option>
                                    <option value="Defesa do Consumidor, Trabalho e Renda">Defesa do Consumidor</option>
                                    <option value="Educação">Educação</option>
                                    <option value="Fazenda">Fazenda</option>
                                    <option value="FLORAM">FLORAM</option>
                                    <option value="Franklin Cascaes">Franklin Cascaes</option>
                                    <option value="Fundação Municipal de Esportes">Fundação Municipal de Esportes</option>
                                    <option value="Gabinete do Prefeito">Gabinete do Prefeito</option>
                                    <option value="IGEOF">IGEOF</option>
                                    <option value="Infraestrutura">Infraestrutura</option>
                                    <option value="IPREF">IPREF</option>
                                    <option value="IPUF">IPUF</option>
                                    <option value="Meio Ambiente, Planejamento e Desenvolvimento Urbano">Meio Ambiente, Planejamento e Desenvolvimento Urbano</option>
                                    <option value="Procuradoria">Procuradoria</option>
                                    <option value="Saúde">Saúde</option>
                                    <option value="Segurança Pública">Segurança Pública</option>
                                    <option value="Transparência, Auditoria e Controle">Transparência, Auditoria e Controle</option>
                                    <option value="Transporte e Mobilidade Urbana">Transporte e Mobilidade Urbana</option>
                                    <option value="Turismo, Tecnologia e Desenvolvimento Econômico">Turismo, Tecnologia e Desenvolvimento Econômico</option>
                                </select>
                            </div>

                            <div class="2u 12u$(xsmall)"><label>Matrícula</label>
                                <input type="text" value="<?= $identificacao ?>" id="identificacao" name="identificacao" placeholder="Matrícula" />
                            </div>
                        </div>

                        <br><br>

                        <div class="12u$">
                            <ul class="actions">
                                <div><input id="id1" name="id1" type="hidden" /></div>
                                <input type="button" name="btnSubmit" onclick="update()" id="btnSubmit" class="btn btn-primary botao" value="Enviar" />
                            </ul>
                        </div>
                </div>
                </form>-->

                <hr />
            </div>
        </div>
        </div>
    </section>

    </div>


    <footer id="footer">
        <div class="copyright">
            <header class="align-center">
                <img src="images/Prefeitura.png" alt="" />
            </header>
        </div>
    </footer>

    <form id="formsucesso" action="sucesso.php">
        <input id="idpalestrahidden" name="idpalestrahidden" type="hidden">
    </form>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/validacao.js"></script>

</body>

<script type="text/javascript" src="js/validacao.js"></script>
<script>
    $('#identificacao').mask("99999-9");

    $('#btnSubmit').bind('click', function() {

        $('#error').addClass('hide');
        var err = '';

        var obj = new FormData($("#frm1").get(0));
        $('#btnSubmit').attr("disabled", true);

    });

    function update() {
        if ($('#nome').val() == '') {
            alert('Informe o seu nome!');
            $('#nome').focus();
        } else if ($('#secretaria').val() == '') {
            alert('Informe a secretaria na qual trabalha!');
            $('#secretaria').focus();
        } else if ($('#nome_palestra').val() == '') {
            alert('Selecione alguma palestra!');
        } else {
            var ArrayPalestras = [];
            if($("#palestra1")[0].checked) {
                ArrayPalestras.push($("#palestra1")[0].value);
            } 
            if ($("#palestra2")[0].checked) {
                ArrayPalestras.push($("#palestra2")[0].value);
            } 
            if ($("#palestra3")[0].checked) {
                ArrayPalestras.push($("#palestra3")[0].value);
            }
            var obj = {
                nome: $('#nome').val(),
                secretaria: $('#secretaria').val(),
                identificacao: $('#identificacao').val(),
                palestras: ArrayPalestras
            }

            $.ajax({
                type: "POST",
  					url: "backend/cadastro.php",
  					dataType: "json",
  					data: obj,
  					success: function(data) {
  						console.log(data);

  						if (data['success'] == 1) {	
                              document.getElementById("idpalestrahidden").value = ArrayPalestras;
                              document.getElementById("formsucesso").submit();
  						} else {
  							alert(data['error']);
  						}

  					},
  					error: function(data) {
  						alert(data['error']);
  						console.log(data);
  					}

            });
        }
    }

    function validacao() {
        document.getElementById("cadastro").style.display = "block";
        document.getElementById("btnEntrar").style.display = "none";
    }
</script>

</html>