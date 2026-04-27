<?php

$cpf=81162502921;
// Inclui o arquivo com a função valida_cpf
include('valida-cpf.php');

// Verifica o CPF
if ( valida_cpf($cpf) ) {
    echo "CPF é válido. <br>";
} else {
    echo "CPF Inválido. <br>";
}

