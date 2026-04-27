<?php
include_once "conexao.php";

if (!empty($_FILES['arquivo']['tmp_name'])) {
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <title>Importa Base de Dados</title>
    </head>

    <div class="container" theme-showcase" role="main">
        <div class="page-header">
            <h2>Importando Arquivo da Frota</h2>

            <a href="index.php">Volta para índice de importação</a>
            <table WIDTH="100%" border="1">

                <?php

                $resetar = (isset($_POST['resetar'])) ? true : null;

                if ($resetar) {
                    
                //limpar db

                $sql = 'TRUNCATE TABLE lacustre.embarcacoes RESTART IDENTITY';
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                echo "Base de dados foi sobrescrita";
                };

                $arquivo = new DomDocument();
                $arquivo->load($_FILES['arquivo']['tmp_name']);
                //var_dump($arquivo);
                $linhas = $arquivo->getElementsByTagName("Row");
                $contagem_linhas_total = $arquivo->getElementsByTagName("Row")->length - 1; // 6

                ?>
                <h5>Foram encontrados <b><?php echo $contagem_linhas_total; ?> </b> registros </h5>
                <?php




                $primeira_linha = true;

                foreach ($linhas as $linha) {
                    if ($primeira_linha == false) {

                        //busca no xml cada inferencia ao item "data" e descarrega na variavel referente

                        //colar do excel lista automatizada
                        $nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                        $inscricao = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                        $capacidade = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                        $ocupacao = $linha->getElementsByTagName("Data")->item(2)->nodeValue;


                        //imprime lista da importação a ser efetuada

                ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $nome ?></td>
                                <td> <?php echo $inscricao ?></td>
                                <td> <?php echo $capacidade ?></td>
                                <td> <?php echo $ocupacao ?></td>
                            </tr>
                        </tbody>

                <?php

                        //Inserir no BD

                        $sql = 'INSERT INTO lacustre.embarcacoes
                    (   
                        nome,
                        inscricao,
                        capacidade,
                        ocupacao
                    )
                    VALUES
                    (
                        :nome,
                        :inscricao,
                        :capacidade,
                        :ocupacao
 
                  )';


                        $stmt = $conn->prepare($sql);

                        $stmt->bindValue(':nome', $nome);
                        $stmt->bindValue(':inscricao', $inscricao);
                        $stmt->bindValue(':capacidade', $capacidade);
                        $stmt->bindValue(':ocupacao', $ocupacao);

                        $stmt->execute();
                    }
                    $primeira_linha = false;
                }
                ?>

            </table>
        </div>

    </div>

    </div>

<?php
}
?>