<?php
session_start();

include_once("./src/conexao.php");
include_once("./src/calculaidade.php");
// link geral do gerado de pdf - biblioteca mpdf

?>

<!DOCTYPE html>
<!-- saved from url=(0071)http://192.168.173.217/teste-interface/src/views/cadastrar-viagens.html -->
<html lang="pt-br"><!-- lang é um atributo--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo | Cadastre sua viagem </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/main.css">
    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/header.css">
    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/forms.css">
    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/page-cadastrar-viagens.css">

    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/buttons.css">

    <link href="./Turismo _ Cadastre sua viagem_files/css2" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"

    <link href="./Turismo _ Cadastre sua viagem_files/css2(1)" rel="stylesheet">

    <script src="./Turismo _ Cadastre sua viagem_files/addField.js.download" defer=""></script>


    <style>
        
    </style>
</head>

<?php
$contratantes_email = $_GET['contratantes_email']; //recebe da pagina anterior o numero do cadastro
$contratantes_email='michelmittmann@gmail.com';
$query_02 = "SELECT * FROM turismo.viagens WHERE contratantes_email = 'michelmittmann@gmail.com'";
$resultado_02 = $conn->query($query_02);
$resultado_02_count = $resultado_02->rowCount();


?>
  


  <!DOCTYPE html>
<!-- saved from url=(0071)http://192.168.173.217/teste-interface/src/views/cadastrar-viagens.html -->
<html lang="pt-br"><!-- lang é um atributo--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo | Cadastre sua viagem </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/main.css">
    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/header.css">
    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/forms.css">
    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/page-cadastrar-viagens.css">

    <link rel="stylesheet" href="./Turismo _ Cadastre sua viagem_files/buttons.css">

    <link href="./Turismo _ Cadastre sua viagem_files/css2" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"

    <link href="./Turismo _ Cadastre sua viagem_files/css2(1)" rel="stylesheet">

    <script src="./Turismo _ Cadastre sua viagem_files/addField.js.download" defer=""></script>


    <style>
        
        
        nav{
            /* background-color: var(--color-box-base); */
            width: 100%;
            max-width: 88rem;
            border-radius: .8rem;
            margin: -3.2rem auto 3.2rem;
            padding-top: 6.4rem;
            background: var(--color-box-base);
            height: 12rem;
            /* width: 100vw; */
            margin-bottom: 5rem;

        }
        nav ul{
            display: flex;
            margin:  -4rem 10rem auto 12rem;
            justify-content: space-between;
            /* margin-left: 10rem;
            margin-right: 10rem; */
        }
        nav ul li{
            display: inline-block;
            /* align-items: center; */
            /* vertical-align: middle; */
            text-align: center;
            /* margin-top: 2rem ;
            margin-bottom: 2rem; */
            width: 12rem;
            
        }
        nav ul li a{
      
            /* margin-top: 4rem ; */
            /* margin-bottom: 4rem; */
      
            
        }
        nav ul li img {
            display: inline-block;
            align-items: center;
            vertical-align: middle;
            text-align: center;
            margin-left: 4rem;
            /* margin-top: 4rem ;
            margin-bottom: 4rem; */
            width: 4rem;
            
        }
        nav > ul > li, nav > ul > li > a {
        text-decoration: none; 
        list-style: none; 
        box-sizing: border-box;
        color: var(--color-text-base);
        }

    </style>
</head>
<body id="page-cadastrar-viagens">

    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <a href="http://192.168.173.217/">
                <img src="./Turismo _ Cadastre sua viagem_files/back.svg" alt="Voltar">
                </a>
                <img src="./Turismo _ Cadastre sua viagem_files/logo.svg" alt="PMF">
            </div>

            <div class="header-content">
                <strong>Minhas Viagens  <?php echo  $cod_registro; ?></strong>
                <p>Você tem xx viagens!</p>
            </div>
       
        </header>
        <nav>
            <ul class="nav-form-setp-bar">
                <table cellspacing="3" border=0 bgcolor="" width=100% height=100% ALIGN=center>
                    <tr>
                    <td valign=center align=center>
                            <img src="./Turismo _ Cadastre sua viagem_files/check_circle.svg" alt="check">
                        </td>
                        <td width ="16px">


                        </td>
                        
                        <td valign=center align=center>
                            <h3>Você tem x viagens : 
                        </td>                  
                        <td valign=center align=center>
                        <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev/imprimir.php?cod_registro=<?php echo $cod_registro;?>'" type="button">Imprimir Ficha e<br> QR-CODE</button>
</td>
                    </tr>
                </table>
                  

                </ul>
            </nav><a>
        <main>
<?php


        $número_viagens = 0;


while ($row = $resultado_02->fetch()) {

    $número_viagens= $número_viagens+1;

    $id_viagem = $row['id_viagem'];
    $num_viagens = $row['id_viagem'];
    $array_num_viagens = json_decode($num_viagens, true);
    $cod_registro = $row['cod_registro'];
    $data_cadastro = date('d-m-Y', strtotime($row['data_cadastro']));
    $data_chegada = date('d-m-Y', strtotime($row['data_chegada']));
    $data_saida = date('d-m-Y', strtotime($row['data_saida']));
    $contratantes = $row['contratantes'];
    $array_contratantes = json_decode($contratantes, true);
    $contratantes_nome = $array_contratantes['contratantes_nome'];
    $contratantes_email = $array_contratantes['contratantes_email'];
    $contratantes_telefone = $array_contratantes['contratantes_telefone_com_ddd'];

?>
            
                <fieldset id="cadastro_contratantes" class="div-show" style="display: block;">
                                                    
                    <legend> Dados da operadora
                        <button>Ver detalhes + </button>
                    </legend>
                    Operador Turístico: <b><?php echo $contratantes_nome; ?></b>
                    <br> Telefone: <b><?php echo $contratantes_telefone; ?></b>
                    <br>Email: <b><?php echo $contratantes_email; ?></b>
                    <br>Endereço:<b>
                    <?php echo $array_contratantes['contratantes_logradouro'] ?>
                    <?php echo $array_contratantes['contratantes_bairro'] ?>
                    <?php echo $array_contratantes['contratantes_cidade'] ?>
                    <?php echo $array_contratantes['contratantes_estado'] ?>
                    <?php echo $array_contratantes['contratantes_pais'] ?> </b>
                </fieldset>

            
                

            



        
       
               
                                   

          
        </main>
    </a>



<?php 

     
}
?>


<footer>

                <p>
                    Importante! <br>
                    Faça o download da ficha de viagem e QR-CODE!
                    Imprima ......
                </p>
                <button onclick="location.href='http://redemobilidade.pmf.sc.gov.br/turismo-dev/imprimir.php?cod_registro=<?php echo $cod_registro;?>'" type="button">Imprimir Ficha e<br> QR-CODE</button>
            </footer>
            </main>
    </div></body></html>



