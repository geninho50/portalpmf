<?php
$user = $_POST['user'];
$password = $_POST['password'];
if ($user == "claudia" && $password == "1985") {

    include_once("../backend/gdb.php");

    $p1 = new gdb();
    $p2 = new gdb();
    $p3 = new gdb();
    
    $p1->open("SELECT f.nome, f.secretaria, f.identificacao
                    FROM funcionario f
                    JOIN inscricao i ON i.idfuncionario = f.idfuncionario
                    JOIN palestras p ON p.idpalestra = i.idpalestra
                    WHERE p.idpalestra = 1
                    GROUP BY p.idpalestra, f.nome");
    $total1 = $p1->gs["NOME"];
    $result1 = count($total1);

    $p2->open("SELECT f.nome, f.secretaria, f.identificacao
                    FROM funcionario f
                    JOIN inscricao i ON i.idfuncionario = f.idfuncionario
                    JOIN palestras p ON p.idpalestra = i.idpalestra
                    WHERE p.idpalestra = 2
                    GROUP BY p.idpalestra, f.nome");
    $total2 = $p2->gs["NOME"];
    $result2 = count($total2);

    $p3->open("SELECT f.nome, f.secretaria, f.identificacao
                    FROM funcionario f
                    JOIN inscricao i ON i.idfuncionario = f.idfuncionario
                    JOIN palestras p ON p.idpalestra = i.idpalestra
                    WHERE p.idpalestra = 3
                    GROUP BY p.idpalestra, f.nome");
    $total3 = $p3->gs["NOME"];
    $result3 = count($total3);

    ?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Palestras</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../assets/css/main.css" />
    </head>

    <body class="subpage">

        <header id="header">
            <div class="logo"><a href="http://www.pmf.sc.gov.br">Sair</a></div>
        </header>

        <div class="container">
            <table>
                <h2 style="margin-top: 100px;" align="center"><b>Servidores Inscritos</b></h2><br />
                <h3><b>Comunicação Positiva, Relações Construtivas</b></h3>
                <p>Total de Inscritos: <? echo $result1 ?> </p>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Secretaria</th>
                        <th>Identificação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($p1->gs["NOME"] as $key => $value) {
                            ?>
                        <tr style="font-size: 12px">
                            <td><?= $p1->gs["NOME"][$key] ?></td>
                            <td><?= $p1->gs["SECRETARIA"][$key] ?></td>
                            <td><?= $p1->gs["IDENTIFICACAO"][$key] ?></td>
                        </tr>
                    <?php
                        }
                        ?>
                </tbody>
            </table>

            <table>
                <h3><b>Influência da Voz e a Importância da Comunicação no Ambiente de Trabalho</b></h3>
                <p>Total de Inscritos: <? echo $result2 ?> </p>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Secretaria</th>
                        <th>Identificação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($p2->gs["NOME"] as $key => $value) {
                            ?>
                        <tr style="font-size: 12px">
                            <td><?= $p2->gs["NOME"][$key] ?></td>
                            <td><?= $p2->gs["SECRETARIA"][$key] ?></td>
                            <td><?= $p2->gs["IDENTIFICACAO"][$key] ?></td>
                        </tr>
                    <?php
                        }
                        ?>
                </tbody>
            </table>
            
            <table>
                <h3><b>Eu vim das Estrelas</b></h3>
                <p>Total de Inscritos: <? echo $result3 ?> </p>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Secretaria</th>
                        <th>Identificação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($p3->gs["NOME"] as $key => $value) {
                            ?>
                        <tr style="font-size: 12px">
                            <td><?= $p3->gs["NOME"][$key] ?></td>
                            <td><?= $p3->gs["SECRETARIA"][$key] ?></td>
                            <td><?= $p3->gs["IDENTIFICACAO"][$key] ?></td>
                        </tr>
                    <?php
                        }
                        ?>
                </tbody>
            </table>
        </div>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script type="text/javascript" src="assets/js/validacao.js"></script>

    </body>

    </html>
<?php
} else {
    header('location:http://www.pmf.sc.gov.br/sistemas/palestras/gerenciamento/login.php');
}
?>