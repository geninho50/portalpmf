<?php

function listaDeAnosAnteriores($tipo) {

    if ($tipo == '1') {
        return $anos = [('Educação Infantil'), '1&ordm; Ano', '2&ordm; Ano', '3&ordm; Ano', '4&ordm; Ano', '5&ordm; Ano',
            '6&ordm; Ano', '7&ordm; Ano', '8&ordm; Ano', '9&ordm; Ano'];
    } else {
        if ($tipo == '2') {
            return $anos = ['Grupo 1', 'Grupo 2', 'Grupo 3', 'Grupo 4', 'Grupo 5', 'Grupo 6'];
        } else {
            if ($tipo == '3') {
                return $anos = ['Segmento 1', 'Segmento 2'];
            }
        }
    }
}

?>
