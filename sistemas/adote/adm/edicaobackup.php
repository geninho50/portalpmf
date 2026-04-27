<?php
$user = $_POST['user'];
$password = $_POST['password'];
if ($user == "adote.pmf@gmail.com" && $password == "Dibea.123") {
include_once("../banco/gdb.php");
$gdb = new gdb();

$limite = 15;
$pagina = $_POST['pag'];
if(!$pagina){
  $pagina = 1;
}
$inicio = ($pagina * $limite) - $limite;

$ativoAnimal = (isset($_POST['ativoAnimal'])) ? $_POST['ativoAnimal'] : 1;

$gdb->open("SELECT COUNT(*) AS TOTAL_REGISTROS  FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
WHERE a.ativo = '$ativoAnimal'");

$total_paginas = (ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite) == 0) ? 1 : ceil($gdb->gs["TOTAL_REGISTROS"][0]/$limite);

$gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.animal a WHERE  a.ativo = 1");

$numeroExibidos = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.animal a WHERE  a.ativo = 0");

$numeroOcultos = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT id_animal FROM adoteDibea.interesse WHERE status = '1'");

$adotados = $gdb->gs["ID_ANIMAL"];

$gdb->open("SELECT * FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
WHERE a.ativo = '$ativoAnimal'
LIMIT $inicio, $limite");

$idAnimal = $gdb->gs["ID_ANIMAL"];

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../img/2093faviconpmf.ico">
    <title>Adote</title>
</head>


<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../index.php">
                <img id="logo" style="height: 35px !important;" src="../img/logosdp5.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="#" onclick="document.getElementById('frm_incl').submit()"><span>Inclusão</span></a>
                    <a class="nav-item nav-link" href="#"><span>Edição</span></a>
                    <a class="nav-item nav-link" href="#" onclick="document.getElementById('frm_inte').submit()"><span>Interessados</span></a>
                    <a class="nav-item nav-link" href="../index.php"><span>Sair</span></a>
                </div>
            </div>
        </nav>
    </header>

    <form id="frm_paginacao" method="POST" action="edicao.php">
        <input type="hidden" name="user" value="<?=$user;?>">
        <input type="hidden" name="password" value="<?=$password;?>">
        <input type="hidden" name="ativoAnimal" value="<?=$ativoAnimal;?>">
        <input type="hidden" id="pag" name="pag">
    </form>

    <form id="frm_exibicao" method="POST" action="edicao.php">
        <input type="hidden" name="user" value="<?=$user;?>">
        <input type="hidden" name="password" value="<?=$password;?>">
        <input type="hidden" id="ativoAnimal" name="ativoAnimal">
    </form>

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

    <form id="frm_edicao_animal" method="POST" action="editarAnimal.php">
        <input type="hidden" id="id_animal_editar" name="idAnimal">
        <input type="hidden" name="user" value="<?=$user;?>">
        <input type="hidden" name="password" value="<?=$password;?>">
    </form>

    <div class="container text-center">
        <a  href="#" onclick="changeExibicao(1)">
            <div style="width: 100px; height:100px; margin-left: 30px !important;font-size: 25px !important;border: 1px solid !important;border-radius: 86px !important;display: inline-block !important;" class="center" id="shiva2">
                <span class="count"><?= $numeroExibidos ?></span>
                <h3>Exibidos</h3> 
            </div>
        </a>
        <a  href="#" onclick="changeExibicao(0)">
            <div style="width: 100px; height:100px; margin-left: 30px !important;font-size: 25px !important;border: 1px solid !important;border-radius: 86px !important;display: inline-block !important;" class="center" id="shiva2">
                <span class="count"><?= $numeroOcultos ?></span>
                <h3>Ocultos</h3>
            </div>
        </a>
    </div><br>

    <ul id="pet-list-search" class="list-inline pet-list-index">
    <?php
        for($i = 0; $i < count($gdb->gs["ID_ANIMAL"]); $i++){
    ?>
        <li>
            <div class="image"><img class="img-rounded" src='<?="../img/".$gdb->gs['ID_ANIMAL'][$i]."/".$gdb->gs['IMG_PRINCIPAL'][$i];?>' alt="imagem"></div>
            <div class="info">
                <p class="name"><?=$gdb->gs["NOME_ANIMAL"][$i];?></p>
                <div class="details">
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('id_animal_editar').value = <?=$gdb->gs['ID_ANIMAL'][$i];?>; document.getElementById('frm_edicao_animal').submit()">Editar</button>
                    <button type="button" class="btn btn-secondary" onclick="remove(<?=$gdb->gs['ID_ANIMAL'][$i];?>)">Ocultar</button>
                    <button type="button" class="btn btn-secondary" onclick="exibe(<?=$gdb->gs['ID_ANIMAL'][$i];?>)">Exibir</button>
                </div>
            </div>
        </li>
    <?php
        }
    ?>
    </ul>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <?php
                //echo '<a href="index.php?pag=1">'.'Primeira página'.'</a>';
                for($i=1; $i <= $total_paginas; $i++)
                {
                    if($pagina == $i)
                    {
                        echo " ".$i." ";
                    }
                    else
                    {
                    echo '<a href="#" onclick="changePag('.$i.')"> '.$i.'</a>';
                    }
                }   
                //echo '<a href="index.php?pag='.$total_paginas.'"> Última página</a>';
                ?>
            </li>
        </ul>
    </nav>
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
    <script>
        function changePag(pag) {
            document.getElementById('pag').value = pag; 
            document.getElementById('frm_paginacao').submit();
        }

        function changeExibicao(exibe) {
            document.getElementById('ativoAnimal').value = exibe; 
            document.getElementById('frm_exibicao').submit();
        }

        function remove(id) {
            $.ajax({
                type: "POST",
                    url: "exclusao.php",
                    data: { idAnimal: id },
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == 1) {	
                            alert("Animal ocultado com sucesso!");
                        } else {
                            alert(response['error']);
                        }
                    },
                    error: function(data) {
                        alert(response['error']);
                    }

            });
        }

        function exibe(id) {
            $.ajax({
                type: "POST",
                    url: "exibicao.php",
                    data: { idAnimal: id },
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == 1) {	
                            alert("Animal alterado com sucesso!");
                        } else {
                            alert(response['error']);
                        }
                    },
                    error: function(data) {
                        alert(response['error']);
                    }

            });
        }
    </script>
</body>

</html>

</body>
<?php } else {
    header("location:login.php");
}