<!--**
 	*  SMPU - Upload de cadastros qr-code
	*  cortesia: Michel Mittmann
 	*  lembre -se de conceder os créditos ao desenvolvedor.
 *-->
<?php
include_once("conexao.php");
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
</head>

<body>
<table>

    <?php
    header ('Content-type: text/html; charset=UTF-8');
    $query_02 = "SELECT id, nome_passageiro FROM sim.moradores_costa ORDER BY id DESC";
    $resultado_02 = $conn->query($query_02);
    $resultado_02_count = $resultado_02->rowCount();

    if (($resultado_02_count != 0)) { ?>


              
                <?php while ($row = $resultado_02->fetch()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?>  </td>
                        <td> <?php echo $row['nome_passageiro']; ?><br>
                        <td>

                        <?php $nome_passageiro = mb_strtoupper(utf8_encode($row['nome_passageiro']), 'UTF-8');



echo $nome_passageiro; ?></td>



                        </td>
                      
                    </tr>

                <?php } ?>
            </table>
        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
    }
        ?>

      
</body>
</html>