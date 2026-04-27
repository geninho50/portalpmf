<?php

function buscarUsuarioPorCPF($cpf, $config) {
    $ldap_conn = ldap_connect($config['ldap_host'], $config['ldap_port']);
    ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

    if (!$ldap_conn) {
        throw new Exception('Erro ao conectar ao servidor LDAP: ' . ldap_error($ldap_conn));
    }

    // Tentar fazer o bind usando o formato NetBIOS (pmf\glpi.integracao)
    if (!@ldap_bind($ldap_conn, $config['ldap_user'], $config['ldap_password'])) {
        throw new Exception('Erro ao fazer o bind no LDAP: ' . ldap_error($ldap_conn));
    }

    $base_dn = $config['base_dn'];
    $filter = "(sAMAccountName=$cpf)";

    error_log("Tentando buscar o usuário com filtro: $filter");

    $search = ldap_search($ldap_conn, $base_dn, $filter);
    $entries = ldap_get_entries($ldap_conn, $search);

    if ($entries['count'] > 0) {
        error_log("Usuário encontrado: " . print_r($entries[0], true));
        return [
            'username' => $entries[0]['samaccountname'][0],
            'nome_completo' => $entries[0]['displayname'][0],
            'ou' => extrairOU($entries[0]['distinguishedname'][0])
        ];
    } else {
        error_log("Usuário não encontrado com filtro: $filter");
    }

    return false;
}

function extrairOU($dn) {
    $ou = [];
    preg_match_all('/OU=([^,]+)/', $dn, $matches);
    return implode(", ", $matches[1]);
}

?>
