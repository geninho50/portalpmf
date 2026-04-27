<?php

$emBreve = "Em breve";

print '

<a class="navbar-brand" href="index.html">
    <img class="logo" src="images/logo.png" alt="logo" /> 
</a>

<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="fas fa-bars"> <span class="hidden-md"> </span> 
</button>

<div class="collapse navbar-collapse" id="navbarResponsive">

    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link active" href="index.html">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" onclick="AbrirItem( 1 );">Sobre Nós</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" onclick="AbrirItem( 2 );">Cursos e Oficinas </a>
        </li>


        <li class="nav-item dropdown">

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                <a class="dropdown-item" href="#" onclick="AbrirItem( 25 );">RESPONS&Aacute;VEL</a>
                <a class="dropdown-item" href="#" onclick="AbrirItem( 34 );">SUA HORTA</a>

            </div>
        </li>
        <!-- -->

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hortas</a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                <!-- -->
                <a class="nav-link" onclick="showMessageHortas();" >Formulário para Cadastro de Horta</a>
                <hr>
                <a class="nav-link" href="#" onclick="AbrirItem( 8 )"> HORTAS COMUNIT&Aacute;RIAS</a>
                <hr>
                <a  href="#"><b>HORTAS INSTITUCIONAIS</b></a><br>
                <a class="nav-link" href="#" onclick="AbrirItem( 10 )">PEDAGÓGICAS</a>
                <a class="nav-link" href="#" onclick="AbrirItem( 22 );">CENTROS DE SAÚDE</a>
            </div>
        </li>


        <a class="nav-link" href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/NORMAS2.pdf" target="_blank" >Normas</a>
        <hr>


        <li class="nav-item">
            <a class="nav-link" href="#" onclick="AbrirItem( 31 );">Compostagem</a>
        </li>

        <li class="nav-item">
            <a class="nav-link"  href="#" onclick="AbrirItem( 6 );">Viveiros de Mudas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="#" onclick="AbrirItem( 7 );">Solicite sua horta ou insumos</a>
        </li>
    </ul>
</div>';


/* <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Feiras
         </a>
         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
            <a class="dropdown-item" href="#" onclick="AbrirItem(20);">História das Feiras</a>
            <a class="dropdown-item" href="#" onclick="AbrirItem(20);">Feiras Livres</a>
            <a class="dropdown-item" href="#" onclick="AbrirItem(4);">Feiras de Orgânicos</a>
         </div>
      </li>*/
?>

<script>
    function showMessageInsumo() {
        var confirmation = confirm("ANTES DE SOLICITAR INSUMOS, E OBRIGATORIO O CADASTRO DA HORTA");

        if(confirmation){
            window.open("https://docs.google.com/forms/d/1Ufzm6xGMUaRUt67FU_OepCrQICEZM_HDXFugqaq5P1U/edit", "_blank");
        }    

    }

    function showMessageHortas() {
        var confirmation = confirm("INFORMAMOS QUE TODAS AS HORTAS ATENDIDAS PELO CULTIVA FLORIPA DEVEM SER CADASTRADAS NO SITE");
        
        if(confirmation){
            window.open("https://docs.google.com/forms/u/0/d/1XPuOX5qUva8mOkLrWn1EzpkEL0NbwT5NTbr-ETAKKwI/viewform?edit_requested=true", "_blank");
        }    

    }
</script>
