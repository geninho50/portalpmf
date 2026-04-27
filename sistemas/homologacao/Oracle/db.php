<?php
    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.12.68)(PORT = 1521)))(CONNECT_DATA=(SID=orcl)))" ;

    if($c = OCILogon("root", "Thema&pmf", $db)){
        echo "Successfully connected to Oracle.\n";
        OCILogoff($c);
        var_dump("ufaishfoiuahsioufhasouihdoahsofhasoidhoaishiduhasiufioahisu");
    } else{
        $err = OCIError();
        echo "Connection failed." . $err[text];
    }
?>