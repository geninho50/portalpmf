<?php

function existeNomePerfil($nomeNovoPerfil, $perfis) {

    foreach ($perfis as $key => $value) {
        if($nomeNovoPerfil == $value[1]){
            return true;
        }
    }
    
    return false;
}

?>
