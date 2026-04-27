<?php

    $mysqli = new mysqli('72.55.168.187', 
                         'suporte', 
                         'T$b3pkG6_V2F');

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT t.id FROM educacao.Aluno t limit 1";

    if ($stmt = $mysqli->prepare($query)) {

        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($id);

        /* fetch value */
        $stmt->fetch();

        /* close statement */
        $stmt->close();
    }

    /* close connection */
    $mysqli->close();

    var_dump($id);

?>