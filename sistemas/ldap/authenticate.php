<?php

header('Content-Type: application/json');

include_once("infosldap.php");

// Verifica se as credenciais foram enviadas
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Usuário ou senha não informados.']);
    exit();
} 

if (verificarCredenciais( $username , $password )) {
    
    $ldap_dn = "DC=PMF,DC=local";
    $ldap = ldap_connect("ldap://192.168.12.100");
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    
    $ldap_rdn = "PMF\\" . $username;
    

    $search = ldap_search($ldap, $ldap_dn, "(sAMAccountName=$username)");
    $info = ldap_get_entries($ldap, $search);


    if ($info["count"] > 0) {
        $fullName              = $info[0]["displayname"][0]; // Obtém o nome completo do usuário
        $_SESSION['username']  = $fullName; // Armazena o nome completo na sessão
        $_SESSION['matricula'] = $info[0]["samaccountname"][0]; // Armazena o nome completo na sessão
        $_SESSION['mail']      = $info[0]["mail"][0]; // Armazena o nome completo na sessão
        $setor                 = "";

        // Verifica se a chave 'distinguishedname' e o índice '0' existem
        if (isset($info[0]['distinguishedname'][0])) {
            // Extrai o distinguishedName
            $distinguishedName = $info[0]['distinguishedname'][0];
        
            // Divide a string em partes com base na vírgula
            $parts = explode(',', $distinguishedName);
        
            // Itera sobre as partes para encontrar o OU específico
            foreach ($parts as $part) {
                // Verifica se a parte começa com 'OU='
                if (strpos($part, 'OU=') === 0) {
                    // Remove 'OU=' do início
                    $setor = substr($part, 3);
                    break; // Para após encontrar o primeiro OU
                }
            }
        }
        
        $_SESSION['setor'] = $setor;
        echo json_encode(['success' => true, 'username' => $info[0]["samaccountname"][0], 'setor' => $setor]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não encontrado no AD.']);
    }
    ldap_close($ldap);
} else {
    echo json_encode(['success' => false, 'message' => 'Falha na autenticação.']);
}
?>