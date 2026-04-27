<?php
include_once("banco/gdb.php");
$gdb = new gdb();

$pagina = $_GET['pag'];
if(!$pagina){
  $pagina = 1;
}

$limite = 15;
$inicio = ($pagina * $limite) - $limite;

$tipoAnimal = (isset($_GET['tipoAnimal'])) ? $_GET['tipoAnimal'] : 1;

$where = "";

if($tipoAnimal == 0) {
  $where = "i.status = 1";
} else if($tipoAnimal == 1) {
  $where = "i.status is null AND a.tipo = 'Cachorro'";
} else if($tipoAnimal == 2) {
  $where = "i.status is null AND a.tipo = 'Gato'";
}

$sAnimal = (isset($_GET['sAnimal'])) ? $_GET['sAnimal'] : 5;

if($sAnimal == 3) { 
  $where .= " AND a.sexo = 'M'";
} else if($sAnimal == 4) {
  $where .= " AND a.sexo = 'F'";
} else if($sAnimal == 5) {
  $where .= " ";
}

$gdb->open("SELECT COUNT(*) AS TOTAL_REGISTROS_ADOTADO  FROM adoteDibea.animal a
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
WHERE i.status = '1' AND a.ativo = 1");

$paginas_adotados = (ceil($gdb->gs["TOTAL_REGISTROS_ADOTADO"][0]/$limite) == 0) ? 1 : ceil($gdb->gs["TOTAL_REGISTROS_ADOTADO"][0]/$limite);

$gdb->open("SELECT COUNT(*) AS TOTAL_REGISTROS_CAES  FROM adoteDibea.animal a
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
WHERE a.tipo = 'Cachorro' AND a.ativo = 1");

$paginas_caes = (ceil($gdb->gs["TOTAL_REGISTROS_CAES"][0]/$limite) == 0) ? 1 : ceil($gdb->gs["TOTAL_REGISTROS_CAES"][0]/$limite);

$gdb->open("SELECT COUNT(*) AS TOTAL_REGISTROS_GATOS  FROM adoteDibea.animal a
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
WHERE a.tipo = 'Gato' AND a.ativo = 1");

$paginas_gatos = (ceil($gdb->gs["TOTAL_REGISTROS_GATOS"][0]/$limite) == 0) ? 1 : ceil($gdb->gs["TOTAL_REGISTROS_GATOS"][0]/$limite);

$gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.animal a WHERE a.tipo = 'Cachorro' AND a.ativo = 1");

$numeroCaes = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.animal a WHERE a.tipo = 'Gato' AND a.ativo = 1");

$numeroGatos = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT i.id_animal FROM adoteDibea.interesse i 
            JOIN adoteDibea.animal a ON a.id_animal = i.id_animal
            WHERE i.status = '1' and a.ativo = 1");

$adotados = $gdb->gs["ID_ANIMAL"];

$gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.interesse i 
          JOIN adoteDibea.animal a ON a.id_animal = i.id_animal
          WHERE i.status = '1' and a.ativo = 1");

$numeroAdotados = $gdb->gs["NUMERO"][0];

$gdb->open("SELECT a.id_animal, a.nome_animal, a.tipo, a.sexo, a.porte, a.sobre, a.ativo, ga.id_galeria_animal, ga.id_galeria, g.img_principal, g.img_dois, g.img_tres, i.status
FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
LEFT JOIN adoteDibea.interesse i ON i.id_animal = a.id_animal AND i.status = 1
WHERE ".$where." AND a.ativo = 1 
LIMIT $inicio, $limite");

$adotado = $gdb->gs;

$gdb->open("SELECT a.id_animal, a.nome_animal, a.tipo, a.sexo, a.porte, a.sobre, a.ativo, ga.id_galeria_animal, ga.id_galeria, g.img_principal, g.img_dois, g.img_tres, i.status
FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
LEFT JOIN adoteDibea.interesse i ON i.id_animal = a.id_animal AND i.status = 1
WHERE ".$where." AND a.ativo = 1 
LIMIT $inicio, $limite");

$caes = $gdb->gs;

$gdb->open("SELECT a.id_animal, a.nome_animal, a.tipo, a.sexo, a.porte, a.sobre, a.ativo, ga.id_galeria_animal, ga.id_galeria, g.img_principal, g.img_dois, g.img_tres, i.status
FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
LEFT JOIN adoteDibea.interesse i ON i.id_animal = a.id_animal AND i.status = 1
WHERE ".$where." AND a.ativo = 1 
LIMIT $inicio, $limite");

$gatos = $gdb->gs;

$gdb->open("SELECT a.id_animal, a.nome_animal, a.tipo, a.sexo, a.porte, a.sobre, a.ativo, ga.id_galeria_animal, ga.id_galeria, g.img_principal, g.img_dois, g.img_tres, i.status
FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
LEFT JOIN adoteDibea.interesse i ON i.id_animal = a.id_animal AND i.status = 1
WHERE ".$where." AND a.ativo = 1 
LIMIT $inicio, $limite");

$machos = $gdb->gs;

$gdb->open("SELECT a.id_animal, a.nome_animal, atipo.tipo, a.sexo, a.porte, a.sobre, a.ativo, ga.id_galeria_animal, ga.id_galeria, g.img_principal, g.img_dois, g.img_tres, i.status
FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
LEFT JOIN adoteDibea.interesse i ON i.id_animal = a.id_animal AND i.status = 1
WHERE ".$where." AND a.ativo = 1 
LIMIT $inicio, $limite");

$femeas = $gdb->gs;

$gdb->open("SELECT a.id_animal, a.nome_animal, a.tipo, a.sexo, a.porte, a.sobre, a.ativo, ga.id_galeria_animal, ga.id_galeria, g.img_principal, g.img_dois, g.img_tres, i.status
FROM adoteDibea.animal a 
LEFT JOIN adoteDibea.galeria_animal ga ON a.id_animal = ga.id_animal
LEFT JOIN adoteDibea.galeria g ON g.id_galeria = ga.id_galeria
LEFT JOIN adoteDibea.interesse i ON i.id_animal = a.id_animal AND i.status = 1
WHERE ".$where." AND a.ativo = 1 
LIMIT $inicio, $limite");

$todos = $gdb->gs;

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
  <!--<script type="text/javascript">
    function slide1(){
    document.getElementById('id').src="img/marcelinha4.png";
    setTimeout("slide2()", 5000)
    }
      
    function slide2(){
    document.getElementById('id').src="img/capa6.png";
    setTimeout("slide1()", 5000)
    }
  </script>-->
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

  <form id="frm_animal" method="GET" action="animal.php">
    <input type="hidden" id="id_animal_a" name="idAnimal">
  </form>

  <form id="frm_show" method="POST" action="index.php">
    <input type="hidden" name="show" id="show">
  </form>
  
  <!--<img id="id">-->
  <div id="bannernoticias" class="carousel slide carousel-fade" data-ride="carousel">
    <!--<ul class="carousel-indicators">
      <li data-target="#bannernoticias" data-slide-to="0" class="active"></li>
      <li data-target="#bannernoticias" data-slide-to="1"></li>
      <li data-target="#bannernoticias" data-slide-to="2"></li>
    </ul>-->
    <div id="banner" class="carousel-inner">
      <div id="banner" class="carousel-item active">
        <img id="banner" src="img/banner1.jpg" class="d-block mx-auto w-100 img-fluid" alt="...">
      </div>
      <div id="banner" class="carousel-item">
        <img id="banner" src="img/banner2.jpg" class="d-block mx-auto w-100 img-fluid" alt="...">
      </div>
      <div id="banner" class="carousel-item">
        <img id="banner" src="img/banner3.jpg" class="d-block mx-auto w-100 img-fluid" alt="...">
      </div>
    </div>
  </div>


  <div class="container text-center">
    <h1>Adote um amigo</h1>
    <p>Nosso site está cheio de peludos ansiosos pra ter uma família.</p>

    <div class="busca">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtrar</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" id="macho" onclick="filtro(3)">Macho</a>
                  <a class="dropdown-item" id="femea" onclick="filtro(4)">Fêmea</a>
                  <a class="dropdown-item" id="todos" onclick="filtro(5)">Todos</a>
                </div>
            </div>
            <input id="autocomplete" type="text" class="form-control" aria-label="Text input with dropdown button">
        </div>
    </div>

    <a  href="index.php?tipoAnimal=1">
      <div class="center" id="shiva">
        <span class="count"><?= $numeroCaes ?></span>
        <h3><img src="img/dog.png" alt="dog" />Cães</h3> 
      </div>
    </a>
    <a  href="index.php?tipoAnimal=2">
      <div class="center" id="shiva">
        <span class="count"><?= $numeroGatos ?></span>
        <h3><img src="img/cat.png" alt="cat" />Gatos</h3>
      </div>
    </a>
    <a  href="index.php?tipoAnimal=0">
      <div class="center" id="shiva">
        <span class="count"><?= $numeroAdotados ?></span>
        <h3>Adotados</h3>
      </div>
    </a>
  </div><br>



  <ul id="pet-list-search" class="list-inline pet-list-index">
    <?php
    for ($i = 0; $i < count($gdb->gs["ID_ANIMAL"]); $i++) {
      ?>
      <li>
        <p class="layer" style="position:absolute!important;z-index:999!important;color:#fff!important;font-size:25px!important;text-align:center!important;margin-top:142px!important;background-color:#ff572f!important;padding:0px 32px!important;">
              <?php if(in_array($gdb->gs["ID_ANIMAL"][$i], $adotados)) {
                    echo "Adotado(a)";
                  } else {
                    echo "";
                  }  ?>
        </p>
        <a onclick="document.getElementById('id_animal_a').value = <?= $gdb->gs['ID_ANIMAL'][$i]; ?>; document.getElementById('frm_animal').submit()">
          <div class="image">
            <img class="img-rounded" src='<?= "img/" . $gdb->gs['ID_ANIMAL'][$i] . "/" . $gdb->gs['IMG_PRINCIPAL'][$i]; ?>' alt="imagem">
          </div>
        </a>
        <div class="info" style="background-image: url('img/<?= ($gdb->gs['SEXO'][$i] == 'M') ? "male.png" : "female.png" ?>');background-repeat: no-repeat;background-position: right;background-size: 21px;margin-right:5px">
          <p class="name" onclick="document.getElementById('id_animal_a').value = <?= $gdb->gs['ID_ANIMAL'][$i]; ?>; document.getElementById('frm_animal').submit()"><?= $gdb->gs["NOME_ANIMAL"][$i]; ?></p>
          <p class="name">
            <?php
              switch ($gdb->gs["PORTE"][$i]) {
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
                  echo $gdb->gs["PORTE"][$i];
                  break;
              }
              ?>
          </p>
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
                if($tipoAnimal == 0) {
                  $paginas_atual = $paginas_adotados;
                } else if($tipoAnimal == 1) {
                  $paginas_atual = $paginas_caes;
                } else if($tipoAnimal == 2) {
                  $paginas_atual = $paginas_gatos;
                }

                echo '<a style="padding: 8px 8px !important;" href="index.php?pag=1&tipoAnimal='.$tipoAnimal.'&sAnimal='.$sAnimal.'">'.'Primeira página'.'</a>';
                for($i=1; $i <= $paginas_atual; $i++)
                {
                    if($pagina == $i)
                    {
                      echo " ".$i." ";
                    }
                    else
                    {
                      echo '<a style="padding: 8px 8px !important;" href="index.php?pag='.$i.'&tipoAnimal='.$tipoAnimal.'&sAnimal='.$sAnimal.'"> '.$i.'</a>';
                    }
                }   
                echo '<a style="padding: 8px 8px !important;" href="index.php?pag='.$paginas_atual.'&tipoAnimal='.$tipoAnimal.'&sAnimal='.$sAnimal.'"> Última página</a>';
                ?>
            </li>
        </ul>
    </nav>
    </div>
  



  <footer>
    <div class="text-center">
      <h3 class="text-uppercase">Diretoria de Bem Estar Animal</h3>
      <p style="color:#fff; font-weight:bold;">Horário de funcionamento: Segunda a Sexta das 08:00 às 17:00<br>Endereço: SC-401, 114 - Itacorubi, Florianópolis - SC, 88010-102<br>Contato: (48) 3234-5677</p>
      <p><a href="http://www.pmf.sc.gov.br/entidades/bemestaranimal/index.php"><img src="img/prefeitura.png" alt="Logo da Prefeitura de Florianópolis" /></a></p>
    </div>
  </footer>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- Go to www.addthis.com/dashboard to customize your tools -->

<script>
 $( function() {
    $( "#autocomplete" ).autocomplete({
      source: 'banco/getNomes.php',
      minLength: 1,
      select: function( event, ui ) {
        document.getElementById('id_animal_a').value = ui.item.id; document.getElementById('frm_animal').submit()
      }
    });
  });
</script>

  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5db8ada4253ded01"></script>
  <script type="text/javascript">
    $('.count').each(function() {
      $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
      }, {
        duration: 4000,
        easing: 'swing',
        step: function(now) {
          $(this).text(Math.ceil(now));
        }
      });
    });
  </script>
  <script>
    function listItems(items, pageActual, limitItems){
      let result = [];
      let totalPage = Math.ceil( items.length / limitItems );
      let count = ( pageActual * limitItems ) - limitItems;
      let delimiter = count + limitItems;

      if(pageActual <= totalPage){
        for(let i=count; i<delimiter; i++){
          if(items[i] != null){
            result.push(items[i]);
          }
          count++;
        }
      }
      return result;
    };
  </script>

  <script>
    function filtro(newsAnimal){
      var tipoAnimal = <?=$tipoAnimal;?>;
      var sAnimal = <?=$sAnimal;?>;
      var pag = <?=$pagina;?>;

      window.location.replace("index.php?pag="+pag+"&tipoAnimal="+tipoAnimal+"&sAnimal="+newsAnimal);
    }


  </script>  
  
</body>

</html>
