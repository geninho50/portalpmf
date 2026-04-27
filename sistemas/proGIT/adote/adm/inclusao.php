<?php
$user = $_POST['user'];
$password = $_POST['password'];
if ($user == "adote.pmf@gmail.com" && $password == "Dibea.123") {

    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include_once("../banco/gdb.php");

    $gdb = new gdb();

    $gdb->open("SELECT id_localizacao, CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(especie_localizacao, ' '), numero_localizacao), ' '), tipo_localizacao), ' '), baias_localizacao) AS LOC
    FROM adoteDibea.localizacao");

    $localizacoes = $gdb->gs;

    $gdb = new gdb();

    $gdb->open("SELECT id_local, cidade AS LO FROM adoteDibea.local");

    $locais = $gdb->gs;

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet"> 
    <link rel="shortcut icon" type="image/x-icon" href="../img/2093faviconpmf.ico">
    <title>Adote</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../index.php">
                <img id="logo" src="../img/logosdp5.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="#"><span>Inclusão</span></a>
                    <a class="nav-item nav-link" href="#" onclick="document.getElementById('frm_edicao').submit()"><span>Edição</span></a> 
                    <a class="nav-item nav-link" href="#" onclick="document.getElementById('frm_inte').submit()"><span>Interessados</span></a>
                    <a class="nav-item nav-link" href="../index.php"><span>Sair</span></a>
                </div>
            </div>
        </nav>
    </header>

    <form id="frm_incl" method="POST" action="inclusao.php">
        <input type="hidden" name="user" value="<?=$user;?>">
        <input type="hidden" name="password" value="<?=$password;?>">
    </form>
    
    <form id="frm_edicao" method="POST" action="edicao.php">
        <input type="hidden" name="user" value="<?=$user;?>">
        <input type="hidden" name="password" value="<?=$password;?>">
    </form>

    <form id="frm_inte" method="POST" action="interessados.php">
        <input type="hidden" name="user" value="<?=$user;?>">
        <input type="hidden" name="password" value="<?=$password;?>">
    </form>


    <div class="container" style="border: 1px;">
        <h1>Inclusão de Animais</h1>
        <form id="frm">
            <h3>Dados Gerais</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome_animal">Nome do Animal</label>
                    <input type="text" class="form-control" id="nome_animal" placeholder="Nome do Animal">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="sobre">Sobre o Animal</label>
                    <textarea class="form-control" id="sobre" placeholder="Sobre o Animal"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="tipo"><b>Tipo:</b></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="tipo1" value="Cachorro">
                        <label class="form-check-label" for="tipo">Cachorro</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="tipo2" value="Gato">
                        <label class="form-check-label" for="tipo">Gato</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sexo"><b>Sexo:</b></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="Macho">
                        <label class="form-check-label" for="sexo">Macho</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="Fêmea">
                        <label class="form-check-label" for="sexo">Fêmea</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="porte"><b>Porte:</b></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="porte" id="porte1" value="Pequeno">
                        <label class="form-check-label" for="porte">Pequeno</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="porte" id="porte2" value="Médio">
                        <label class="form-check-label" for="porte">Médio</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="porte" id="porte3" value="Grande">
                        <label class="form-check-label" for="porte">Grande</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome_animal">Idade do Animal</label>
                    <input type="text" class="form-control" id="idade_animal" placeholder="Idade do Animal">
                </div>
            </div>

            
            <hr>

            <h3>Personalidade</h3>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="temperamento"><b>Temperamento:</b></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="temperamento" id="temperamento1" value="1">
                        <label class="form-check-label" for="temperamento1">Dócil</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="temperamento" id="temperamento2" value="2">
                        <label class="form-check-label" for="temperamento2">Brincalhão</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="temperamento" id="temperamento3" value="3">
                        <label class="form-check-label" for="temperamento3">Sociável</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="temperamento" id="temperamento4" value="4">
                        <label class="form-check-label" for="temperamento4">Territorialista</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="temperamento" id="temperamento5" value="5">
                        <label class="form-check-label" for="temperamento5">Arisco</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="temperamento" id="temperamento6" value="6">
                        <label class="form-check-label" for="temperamento6">Calmo</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sociavel"><b>Sociável:</b></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="sociavel" id="sociavel1" value="1">
                        <label class="form-check-label" for="sociavel1">Crianças</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="sociavel" id="sociavel2" value="2">
                        <label class="form-check-label" for="sociavel2">Outros Animais</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="sociavel" id="sociavel3" value="3">
                        <label class="form-check-label" for="sociavel3">Idosos</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="sociavel" id="sociavel4" value="4">
                        <label class="form-check-label" for="sociavel4">Desconhecidos</label>
                    </div>
                </div>
            </div>

            <hr>

            <h3>Outras Informações</h3>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="vive_bem"><b>Vive bem em:</b></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="vive_bem" id="vive1" value="1">
                        <label class="form-check-label" for="vive1">Casa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="vive_bem" id="vive2" value="2">
                        <label class="form-check-label" for="vive2">Apartamento</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="vive_bem" id="vive3" value="3">
                        <label class="form-check-label" for="vive2">Apartamento Telado</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="vive_bem" id="vive4" value="4">
                        <label class="form-check-label" for="vive3">Com outro animal</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="vive_bem" id="vive5" value="5">
                        <label class="form-check-label" for="vive4">Sem outro animal</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="saude"><b>Saúde:</b></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="saude" id="saude1" value="1">
                        <label class="form-check-label" for="saude1">Vacinado</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="saude" id="saude2" value="2">
                        <label class="form-check-label" for="saude2">Castrado</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="saude" id="saude3" value="3">
                        <label class="form-check-label" for="saude3">Vermifugado</label>
                    </div>
                </div>
            </div>
            
            <hr>

            <h3>Localização:</h3>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="form-check form-check-inline">
                        <select name="localizacao" id="localizacao">
                            <?php
                                for($i = 0; $i < count($localizacoes["LOC"]); $i++) {
                            ?>
                                    <option value="<?=$localizacoes["ID_LOCALIZACAO"][$i];?>"><?=utf8_encode($localizacoes["LOC"][$i]);?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <select name="local" id="local">
                            <?php
                                for($i = 0; $i < count($locais["LO"]); $i++) {
                            ?>
                                    <option value="<?=$locais["ID_LOCAL"][$i];?>"><?=utf8_encode($locais["LO"][$i]);?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>


            <hr>

            <h3>Imagens</h3>

            <div class="form-group">
                <label for="imagem_animal">Selecione as imagens:</label>
                <input type="file" class="form-control-file" id="img_principal"><br>
                <input type="file" class="form-control-file" id="img_dois"><br>
                <input type="file" class="form-control-file" id="img_tres">
            </div>

            <br>

            <input name="btnSubmit" onclick="update()" id="btnSubmit" class="btn btn-primary botao" value="Enviar">

            <br><br><br>

        </form>
    </div>

    <footer>
        <div class="text-center">
            <h3 class="text-uppercase">Diretoria de Bem Estar Animal</h3>
            <p style="color:#fff; font-weight:bold;">Horário de funcionamento: Segunda a Sexta das 08:00 às 17:00<br>Endereço: SC-401, 114 - Itacorubi, Florianópolis - SC, 88010-102<br>Contato: (48) 3234-5677</p>
            <p><a href="http://www.pmf.sc.gov.br/entidades/bemestaranimal/index.php"><img src="../img/prefeitura.png" alt="Logo da Prefeitura de Florianópolis"/></a></p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/jquery.scrollex.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/skel.min.js"></script>
    <script src="../js/util.js"></script>
    <script src="../js/main.js"></script>
</body>

<script>
    $('#btnSubmit').bind('click', function() {

        $('#error').addClass('hide');
        var err = '';
        //$('#btnSubmit').attr("disabled", true);

    });

    function update() {
        if ($('#nome_animal').val() == '') {
            alert('Informe o nome do animal!');
            $('#nome_animal').focus();
            $('#btnSubmit').attr("disabled", false);
        } else if ($('#tipo').val() == '') {
            alert('Informe o tipo do animal!');
            $('#tipo').focus();
        } else if ($('#sexo').val() == '') {
            alert('Selecione o sexo do animal!');
            $('#sexo').focus();
        } else if ($('#porte').val() == '') {
            alert('Informe o porte do animal!');
            $('#porte').focus();
        } else if ($('#idade_animal').val() == '') {
            alert('Informe a idade do animal!');
            $('#idade_animal').focus();
        } else if ($('#temperamento').val() == '') {
            alert('Informe o temperamento do animal!');
            $('#temperamento').focus();
        } else if ($('#sociavel').val() == '') {
            alert('Informe com quem o animal é sociável!');
            $('#sociavel').focus();
        } else if ($('#vive_bem').val() == '') {
            alert('Selecione o melhor lugar onde o animal vive!');
            $('#vive_bem').focus();
        } else if ($('#saude').val() == '') {
            alert('Informe as condições de saúde do animal!');
            $('#saude').focus();
        } else if($('#img_principal').val() == ''){
            alert('Escolha a imagem principal do animal!');
            $('#img_principal').focus();
            $('#btnSubmit').prop("disabled", false);
            //$('#btnSubmit').attr("disabled", false);
        }else {
            var ArrayTemperamento = [];
            if($("#temperamento1")[0].checked) {
                ArrayTemperamento.push($("#temperamento1")[0].value);
            } 
            if ($("#temperamento2")[0].checked) {
                ArrayTemperamento.push($("#temperamento2")[0].value);
            } 
            if ($("#temperamento3")[0].checked) {
                ArrayTemperamento.push($("#temperamento3")[0].value);
            }
            if ($("#temperamento4")[0].checked) {
                ArrayTemperamento.push($("#temperamento4")[0].value);
            }
            if ($("#temperamento5")[0].checked) {
                ArrayTemperamento.push($("#temperamento5")[0].value);
            }
            if ($("#temperamento6")[0].checked) {
                ArrayTemperamento.push($("#temperamento6")[0].value);
            }
            var ArraySociavel = [];
            if($("#sociavel1")[0].checked) {
                ArraySociavel.push($("#sociavel1")[0].value);
            }
            if($("#sociavel2")[0].checked) {
                ArraySociavel.push($("#sociavel2")[0].value);
            }
            if($("#sociavel3")[0].checked) {
                ArraySociavel.push($("#sociavel3")[0].value);
            }
            if($("#sociavel4")[0].checked) {
                ArraySociavel.push($("#sociavel4")[0].value);
            }
            var ArrayViveBem = [];
            if($("#vive1")[0].checked) {
                ArrayViveBem.push($("#vive1")[0].value);
            }
            if($("#vive2")[0].checked) {
                ArrayViveBem.push($("#vive2")[0].value);
            }
            if($("#vive3")[0].checked) {
                ArrayViveBem.push($("#vive3")[0].value);
            }
            if($("#vive4")[0].checked) {
                ArrayViveBem.push($("#vive4")[0].value);
            }
            if($("#vive5")[0].checked){
                ArrayViveBem.push($("#vive5")[0].value);
            }
            var ArraySaude = [];
            if($("#saude1")[0].checked) {
                ArraySaude.push($("#saude1")[0].value);
            }
            if($("#saude2")[0].checked) {
                ArraySaude.push($("#saude2")[0].value);
            }
            if($("#saude3")[0].checked) {
                ArraySaude.push($("#saude3")[0].value);
            }
            

            var file_data_principal = $('#img_principal').prop('files')[0];
            var file_data_dois = $('#img_dois').prop('files')[0];
            var file_data_tres = $('#img_tres').prop('files')[0];

            var form_data = new FormData();                  

            form_data.append('img_principal', file_data_principal);
            form_data.append('img_dois', file_data_dois);
            form_data.append('img_tres', file_data_tres);

            form_data.append('nome_animal', $('#nome_animal').val());
            form_data.append('sobre', $('#sobre').val());
            form_data.append('tipo', document.querySelector('input[name="tipo"]:checked').value);
            form_data.append('sexo', document.querySelector('input[name="sexo"]:checked').value);
            form_data.append('porte', document.querySelector('input[name="porte"]:checked').value);
            form_data.append('temperamento', ArrayTemperamento);
            form_data.append('sociavel', ArraySociavel);
            form_data.append('vive_bem', ArrayViveBem);
            form_data.append('saude', ArraySaude);
            form_data.append('id_localizacao',$('#localizacao').val());
            form_data.append('id_local',$('#local').val());

            $.ajax({
                type: "POST",
                url: "../banco/incluirAnimal.php",
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    let response = JSON.parse(data);
                    if (response['success'] == '1') {	
                        alert("Animal incluído com sucesso!");
                        $('#frm')[0].reset();
                        $('#nome_animal').focus();
                    } else {
                        alert(response['error']);
                    }
                },
                error: function(data) {
                    let response = JSON.parse(data);
                    alert(response['error']);
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
<?php
} else {
	header('location:http://www.pmf.sc.gov.br/sistemas/adote/adm/login.php');
}
?>