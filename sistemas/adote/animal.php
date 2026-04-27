<?php
include_once("../banco/gdb.php");

$gdb = new gdb();

$idAnimal = $gdb->vargetpost('idAnimal');

$gdb->open("SELECT a.nome_animal, a.porte, a.sexo, a.tipo, a.sobre AS SOBRE_ANIMAL, a.idade_animal, g.img_principal, g.img_dois, g.img_tres, ta.id_temperamento, soa.id_sociavel, vba.id_vive_bem, saa.id_saude, i.status FROM adoteDibea.animal a
                LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
                LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
                LEFT JOIN adoteDibea.temperamento_animal ta ON ta.id_animal = a.id_animal
                LEFT JOIN adoteDibea.sociavel_animal soa ON soa.id_animal = a.id_animal
                LEFT JOIN adoteDibea.vive_bem_animal vba ON vba.id_animal = a.id_animal
                LEFT JOIN adoteDibea.saude_animal saa ON saa.id_animal = a.id_animal
                LEFT JOIN adoteDibea.interesse i ON i.id_animal = a.id_animal
                WHERE a.id_animal = $idAnimal");

$nome_animal = $gdb->gs["NOME_ANIMAL"][0];
$sobre_animal = $gdb->gs["SOBRE_ANIMAL"][0];
$idade_animal = $gdb->gs["IDADE_ANIMAL"][0];
$temperamento_animal = $gdb->gs["ID_TEMPERAMENTO"];
$sociavel_animal = $gdb->gs["ID_SOCIAVEL"];
$vive_bem_animal = $gdb->gs["ID_VIVE_BEM"];
$saude_animal = $gdb->gs["ID_SAUDE"];
$tipo_animal = $gdb->gs["TIPO"][0];
$sexo_animal = $gdb->gs["SEXO"][0];
$porte_animal = $gdb->gs["PORTE"][0];
$status_animal = $gdb->gs["STATUS"][0];

$img_principal  = $gdb->gs["IMG_PRINCIPAL"][0];
$img_dois       = $gdb->gs["IMG_DOIS"][0];
$img_tres       = $gdb->gs["IMG_TRES"][0];

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="img/2093faviconpmf.ico">
    <title>Adote</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">
                <img id="logo" src="img/logosdp5.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.php"><span>Home</span></a>
                    <a class="nav-item nav-link" href="adm/login.php"><span>Administração</span></a>
                </div>
            </div>
        </nav>
    </header>

    <form id="frm_interesseadocao" method="POST" action="adm/interesseAdocao.php">
        <input type="hidden" id="id_animal_ia" name="idAnimal">
    </form>

    <div class="animalarea">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col">
                    <h3 style="color: #ff6e00;"><b>Galeria de Fotos</b></h3>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol id="car" class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        </ol>
                        <div id="car" class="carousel-inner">
                            <div id="car" class="carousel-item active">
                                <img id="car" style="min-height:200px; height:400px; object-fit:contain;" class="d-block w-100" src='<?= "img/" . $idAnimal . "/" . $img_principal; ?>' alt="Primeiro Slide">
                            </div>
                            <?php if ($img_dois != '0') { ?>
                                <div id="car" class="carousel-item">
                                    <img id="car" style="min-height:200px; height:400px; object-fit:contain;" class="d-block w-100" src='<?= "img/" . $idAnimal . "/" . $img_dois; ?>' alt="Segundo Slide">
                                </div>
                            <?php } ?>
                            <?php if ($img_tres != '0') { ?>
                                <div id="car" class="carousel-item">
                                    <img id="car" style="min-height:200px; height:400px; object-fit:contain;" class="d-block w-100" src='<?= "img/" . $idAnimal . "/" . $img_tres; ?>' alt="Terceiro Slide">
                                </div>
                            <?php } ?>
                        </div>
                        <a id="car" class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span id="car" class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span id="car" class="sr-only">Anterior</span>
                        </a>
                        <a id="car" class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span id="car" class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span id="car" class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div>


                <div class="col-sm-5">
                    <h3 style="color: #ff6e00;"><b><?= $nome_animal; ?></b></h3>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title text-uppercase">Sobre mim</h6>
                            <ul class="info-pet">
                                <li>Tipo: <?= $tipo_animal; ?></li>
                                <li> Sexo:
                                    <?php
                                    switch ($sexo_animal) {
                                        case 'F':
                                            echo "Fêmea";
                                            break;
                                        case 'M':
                                            echo "Macho";
                                            break;
                                        default:
                                            echo $sexo_animal;
                                            break;
                                    }
                                    ?>
                                </li>
                                <li>Porte:
                                    <?php
                                    switch ($porte_animal) {
                                        case 'P':
                                            echo "Pequeno";
                                            break;
                                        case 'M':
                                            echo "Médio";
                                            break;
                                        case 'G':
                                            echo "Grande";
                                            break;
                                        default:
                                            echo $porte_animal;
                                            break;
                                    }
                                    ?>
                                </li>
                                <!--<li>Idade: <?= $idade_animal; ?></li>-->
                            </ul>
                            <div class="row justify-content-md-center">
                                <div class="col-md-auto">
                                    <?php if($status_animal != 1) { ?>
                                        <button type='button' class='btn btn-primary' onclick="document.getElementById('id_animal_ia').value = <?= $idAnimal; ?>; document.getElementById('frm_interesseadocao').submit();"> Quero adotar</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div><br>


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4><b>A história de <?php echo $nome_animal; ?></b></h4>
                <p><?php echo $sobre_animal; ?>
                </p>
            </div>
            <div class="col-md-3 perso-info">
                <h4><b>Personalidade:</b></h4>
                <h6>Temperamentos:</h6>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(1, $temperamento_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="temperamento" id="temperamento1" value="1">
                    <label class="form-check-label" for="temperamento1">Dócil</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(2, $temperamento_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="temperamento" id="temperamento2" value="2">
                    <label class="form-check-label" for="temperamento2">Brincalhão</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(3, $temperamento_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="temperamento" id="temperamento3" value="3">
                    <label class="form-check-label" for="temperamento3">Sociável</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(4, $temperamento_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="temperamento" id="temperamento4" value="4">
                    <label class="form-check-label" for="temperamento4">Territorialista</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(5, $temperamento_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="temperamento" id="temperamento5" value="5">
                    <label class="form-check-label" for="temperamento5">Arisco</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(6, $temperamento_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="temperamento" id="temperamento6" value="6">
                    <label class="form-check-label" for="temperamento6">Calmo</label>
                </div><br>
                <h6>Sociavel com:</h6>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(1, $sociavel_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="sociavel" id="sociavel1" value="1">
                    <label class="form-check-label" for="sociavel1">Crianças</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(2, $sociavel_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="sociavel" id="sociavel2" value="2">
                    <label class="form-check-label" for="sociavel2">Outros Animais</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(3, $sociavel_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="sociavel" id="sociavel3" value="3">
                    <label class="form-check-label" for="sociavel3">Idosos</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(4, $sociavel_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="sociavel" id="sociavel4" value="4">
                    <label class="form-check-label" for="sociavel4">Desconhecidos</label>
                </div>
            </div>
            <div class="col-md-3 perso-info">
                <h4><b>Outras Informações:</b></h4>
                <h6>Vive bem em:</h6>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(1, $vive_bem_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="vive_bem" id="vive1" value="1">
                    <label class="form-check-label" for="vive1">Casa</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(2, $vive_bem_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="vive_bem" id="vive2" value="2">
                    <label class="form-check-label" for="vive2">Apartamento</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(3, $vive_bem_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="vive_bem" id="vive3" value="3">
                    <label class="form-check-label" for="vive3">Apartamento telado</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(4, $vive_bem_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="vive_bem" id="vive4" value="4">
                    <label class="form-check-label" for="vive4">Com outro animal</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(5, $vive_bem_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="vive_bem" id="vive5" value="5">
                    <label class="form-check-label" for="vive5">Sem outro animal</label>
                </div><br>
                <h6>Saúde:</h6>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(1, $saude_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="saude" id="saude1" value="1">
                    <label class="form-check-label" for="saude1">Vacinado</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(2, $saude_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="saude" id="saude2" value="2">
                    <label class="form-check-label" for="saude2">Castrado</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" disabled <?php if (in_array(3, $saude_animal)) {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="saude" id="saude3" value="3">
                    <label class="form-check-label" for="saude3">Vermifugado</label>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <?php if($status_animal != 1) { ?>
                    <button type='button' class='btn btn-primary' onclick="document.getElementById('id_animal_ia').value = <?= $idAnimal; ?>; document.getElementById('frm_interesseadocao').submit();"> Quero adotar</button>
            <?php } ?>
        </div>
    </div>


    <footer>
        <div class="text-center">
            <h3 class="text-uppercase">Diretoria de Bem Estar Animal</h3>
            <p style="color:#fff; font-weight:bold;">Horário de funcionamento: Segunda a Sexta das 08:00 às 17:00<br>Endereço: SC-401, 114 - Itacorubi, Florianópolis - SC, 88010-102<br>Contato: (48) 3234-5677</p>
            <p><a href="http://www.pmf.sc.gov.br/entidades/bemestaranimal/index.php"><img src="img/prefeitura.png" alt="Logo da Prefeitura de Florianópolis" /></a></p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/validacao.js"></script>

</body>
<script>
    $('#cep').mask("99999-999");
    $('#cpf').mask("999.999.999-99");
    $('#celular').mask("(99) 99999-9999");
    $('#telefone').mask("(99) 9999-9999");
</script>

<script language="Javascript">
    function validacaoEmail(field) {
        usuario = field.value.substring(0, field.value.indexOf("@"));
        dominio = field.value.substring(field.value.indexOf("@") + 1, field.value.length);
        if ((usuario.length >= 1) &&
            (dominio.length >= 3) &&
            (usuario.search("@") == -1) &&
            (dominio.search("@") == -1) &&
            (usuario.search(" ") == -1) &&
            (dominio.search(" ") == -1) &&
            (dominio.search(".") != -1) &&
            (dominio.indexOf(".") >= 1) &&
            (dominio.lastIndexOf(".") < dominio.length - 1)) {
            document.getElementById("msgemail").innerHTML = "E-mail válido";
            alert("email valido");
        } else {
            document.getElementById("msgemail").innerHTML = "<font color='red'>Email inválido </font>";
            alert("E-mail invalido");
        }
    }
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5db8ada4253ded01"></script>
</html>