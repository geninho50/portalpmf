<?php
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION["idUsuario"])) {
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"http://pgs.pmf.sc.gov.br\">Entrar</a></p>");
}

if($_SESSION["permissaoUsuario"] > 3) {
    die("Você não tem permissão para poder acessar esta página");

}
?>