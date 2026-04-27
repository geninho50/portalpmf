<?php

//Credenciais de acesso ao BD

define('HOST', '192.168.173.178');
define('USER', 'postgres');
define('PASS', 'ipufgeo1977');
define('DBNAME', 'turismo');

try {
    
    $conn = new PDO(
        'pgsql:host=' . HOST . 
        ';dbname=' . DBNAME . ';', 
        USER, 
        PASS
    );
    
} catch (PDOException $e) {
    echo '<h1> HTTP error 500 - Database connection error</h1> <br>';
    echo $e->getMessage();
    
}

?>