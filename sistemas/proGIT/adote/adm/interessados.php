<?php
include_once("../banco/gdb.php");

$gdb = new gdb();

$user = $_POST['user'];
$password = $_POST['password'];

if ($user == "adote.pmf@gmail.com" && $password == "Dibea.123") {
    $inicio = ($pagina * $limite) - $limite;

    $gdb->open("SELECT i.id_interessado, i.nome_pessoa, i.cpf, i.telefone, i.celular, i.email, i.cep, i.endereco, i.numero, i.complemento, i.bairro, i.ip_interessado, i.data_interessado, a.nome_animal, ie.status, ie.id_interesse, l.tipo_localizacao, l.especie_localizacao, l.baias_localizacao, l.numero_localizacao, l.id_localizacao, la.id_localizacao_animal, lo.cidade, lo.id_local, loa.id_local
                FROM adoteDibea.interessado i
                JOIN adoteDibea.interesse ie ON i.id_interessado = ie.id_interessado
                LEFT JOIN adoteDibea.animal a ON ie.id_animal = a.id_animal
                LEFT JOIN adoteDibea.localizacao_animal la ON la.id_animal= a.id_animal
                LEFT JOIN adoteDibea.localizacao l ON l.id_localizacao = la.id_localizacao
                LEFT JOIN adoteDibea.local_animal loa ON loa.id_animal = a.id_animal
                LEFT JOIN adoteDibea.local lo ON lo.id_local = loa.id_local
                WHERE ie.status = 0
                ORDER BY i.id_interessado;");

    $novo_interessado = $gdb->gs;


    $gdb->open("SELECT i.id_interessado, i.nome_pessoa, i.cpf, i.telefone, i.celular, i.email, i.cep, i.endereco, i.numero, i.complemento, i.bairro, i.ip_interessado, i.data_interessado, a.nome_animal, ie.status, ie.id_interesse, l.tipo_localizacao, l.especie_localizacao, l.baias_localizacao, l.numero_localizacao, l.id_localizacao, la.id_localizacao_animal, lo.cidade, lo.id_local, loa.id_local
                FROM adoteDibea.interessado i
                JOIN adoteDibea.interesse ie ON i.id_interessado = ie.id_interessado
                LEFT JOIN adoteDibea.animal a ON ie.id_animal = a.id_animal
                LEFT JOIN adoteDibea.localizacao_animal la ON la.id_animal= a.id_animal
                LEFT JOIN adoteDibea.localizacao l ON l.id_localizacao = la.id_localizacao
                LEFT JOIN adoteDibea.local_animal loa ON loa.id_animal = a.id_animal
                LEFT JOIN adoteDibea.local lo ON lo.id_local = loa.id_local
                WHERE ie.status = 1
                ORDER BY i.id_interessado;");

    $aprovados = $gdb->gs;

    $gdb->open("SELECT i.id_interessado, i.nome_pessoa, i.cpf, i.telefone, i.celular, i.email, i.cep, i.endereco, i.numero, i.complemento, i.bairro, i.ip_interessado, i.data_interessado, a.nome_animal, ie.status, ie.id_interesse, l.tipo_localizacao, l.especie_localizacao, l.baias_localizacao, l.numero_localizacao, l.id_localizacao, la.id_localizacao_animal, lo.cidade, lo.id_local, loa.id_local
                FROM adoteDibea.interessado i
                JOIN adoteDibea.interesse ie ON i.id_interessado = ie.id_interessado
                LEFT JOIN adoteDibea.animal a ON ie.id_animal = a.id_animal
                LEFT JOIN adoteDibea.localizacao_animal la ON la.id_animal= a.id_animal
                LEFT JOIN adoteDibea.localizacao l ON l.id_localizacao = la.id_localizacao
                LEFT JOIN adoteDibea.local_animal loa ON loa.id_animal = a.id_animal
                LEFT JOIN adoteDibea.local lo ON lo.id_local = loa.id_local
                WHERE ie.status = 2
                ORDER BY i.id_interessado;");

    $nao_compareceu = $gdb->gs;

    $gdb->open("SELECT i.id_interessado, i.nome_pessoa, i.cpf, i.telefone, i.celular, i.email, i.cep, i.endereco, i.numero, i.complemento, i.bairro, i.ip_interessado, i.data_interessado, a.nome_animal, ie.status, ie.id_interesse, l.tipo_localizacao, l.especie_localizacao, l.baias_localizacao, l.numero_localizacao, l.id_localizacao, la.id_localizacao_animal, lo.cidade, lo.id_local, loa.id_local
                FROM adoteDibea.interessado i
                JOIN adoteDibea.interesse ie ON i.id_interessado = ie.id_interessado
                LEFT JOIN adoteDibea.animal a ON ie.id_animal = a.id_animal
                LEFT JOIN adoteDibea.localizacao_animal la ON la.id_animal= a.id_animal
                LEFT JOIN adoteDibea.localizacao l ON l.id_localizacao = la.id_localizacao
                LEFT JOIN adoteDibea.local_animal loa ON loa.id_animal = a.id_animal
                LEFT JOIN adoteDibea.local lo ON lo.id_local = loa.id_local
                WHERE ie.status = 3
                ORDER BY i.id_interessado;");

    $nao_aprovados = $gdb->gs;

    $gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.interesse ie WHERE ie.status = 0");

    $numeroNinteressado = $gdb->gs["NUMERO"][0];

    $gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.interesse ie WHERE ie.status = 1");

    $numeroAprovados = $gdb->gs["NUMERO"][0];

    $gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.interesse ie WHERE ie.status = 2");

    $numeroNcompareceu = $gdb->gs["NUMERO"][0];

    $gdb->open("SELECT COUNT(*) AS NUMERO FROM adoteDibea.interesse ie WHERE ie.status = 3");

    $numeroNaprovados = $gdb->gs["NUMERO"][0];

    ?>
    <!doctype html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="../img/2093faviconpmf.ico">
        <title>Adote</title>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="../index.php">
                    <img id="logo" style="height: 35px;" src="../img/logosdp5.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="#" onclick="document.getElementById('frm_incl').submit()"><span>Inclusão</span></a>
                        <a class="nav-item nav-link" href="#" onclick="document.getElementById('frm_edicao').submit()"><span>Edição</span></a>
                        <a class="nav-item nav-link" href="#"><span>Interessados</span></a>
                        <a class="nav-item nav-link" href="../index.php"><span>Sair</span></a>
                    </div>
                </div>
            </nav>
        </header>

        <form id="frm_incl" method="POST" action="inclusao.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>

        <form id="frm_edicao" method="POST" action="edicao.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>

        <form id="frm_inte" method="POST" action="interessados.php">
            <input type="hidden" name="user" value="<?= $user; ?>">
            <input type="hidden" name="password" value="<?= $password; ?>">
        </form>



        <div class="col-md-12">
            <input type="button" class="btn btn-primary botao" value="Novos interessados: <?= $numeroNinteressado ?>" onclick="changeStatus(0)">
            <input type="button" class="btn btn-primary botao" value="Aprovados: <?= $numeroAprovados ?>" onclick="changeStatus(1)">
            <input type="button" class="btn btn-primary botao" value="Não compareceu: <?= $numeroNcompareceu ?>" onclick="changeStatus(2)">
            <input type="button" class="btn btn-primary botao" value="Não aprovados: <?= $numeroNaprovados ?>" onclick="changeStatus(3)">
        </div>
        <div id="nao_compareceu" class="row" style="display:none">
            <?php
                for ($i = 0; $i < count($nao_compareceu["NOME_PESSOA"]); $i++) {
                    ?>
                <div class="col-sm-3">
                    <div class="card-deck" style="width: 24rem;">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><?= $nao_compareceu["NOME_PESSOA"][$i]; ?></h3>
                                <p class="card-text"><b>CPF:</b> <?= $nao_compareceu["CPF"][$i]; ?></p>
                                <p class="card-text"><b>Interesse em adotar:</b> <?= $nao_compareceu["NOME_ANIMAL"][$i] . ' - ' . $nao_compareceu["TIPO_LOCALIZACAO"][$i] . ' - ' . $nao_compareceu["ESPECIE_LOCALIZACAO"][$i] . ' - ' . $nao_compareceu["NUMERO_LOCALIZACAO"][$i] . ' - baia - ' . $nao_compareceu["BAIA_LOCALIZACAO"][$i] . ' - ' . $nao_compareceu["CIDADE"][$i]; ?></p>
                                <p class="card-text"><b>Contato:</b> <?= $nao_compareceu["TELEFONE"][$i]; ?></p>
                                <p class="card-text"><b>Celular:</b> <?= $nao_compareceu["CELULAR"][$i]; ?></p>
                                <p class="card-text"><b>E-mail:</b> <?= $nao_compareceu["EMAIL"][$i]; ?></p>
                                <p class="card-text"><b>Endereço:</b> <?= $nao_compareceu["ENDERECO"][$i] . ', ' . $nao_compareceu["BAIRRO"][$i] . ' - ' . $nao_compareceu["NUMERO"][$i] . ' - ' . $nao_compareceu["COMPLEMENTO"][$i] . ' - ' . $nao_compareceu["CEP"][$i]; ?></p>
                                <p class="card-text"><b>IP do interessado:</b> <?=$nao_compareceu["IP_INTERESSADO"][$i];?></p>
                                <p class="card-text"><b>Data de cadastro:</b> <?=$nao_compareceu["DATA_INTERESSADO"][$i];?></p>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="porte"><b>Status:</b></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $nao_compareceu["ID_INTERESSE"][$i] ?>" value="1" <?php echo ($nao_compareceu["STATUS"][$i] == 1) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Aprovado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $nao_compareceu["ID_INTERESSE"][$i] ?>" value="3" <?php echo ($nao_compareceu["STATUS"][$i] == 3) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Não aprovado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $nao_compareceu["ID_INTERESSE"][$i] ?>" value="2" <?php echo ($nao_compareceu["STATUS"][$i] == 2) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Não compareceu</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $nao_compareceu["ID_INTERESSE"][$i] ?>" value="0" <?php echo ($nao_compareceu["STATUS"][$i] == 0) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Novo interessado</label>
                                        </div>
                                        <input name="btnSubmit" onclick="update(<?= $nao_compareceu['ID_INTERESSE'][$i] ?>)" id="btnSubmit" class="btn btn-primary botao" value="Enviar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
                ?>
        </div>
        <div id="nao_aprovado" class="row" style="display:none">
            <?php
                for ($i = 0; $i < count($nao_aprovados["NOME_PESSOA"]); $i++) {
                    ?>
                <div class="col-sm-3">
                    <div class="card-deck" style="width: 24rem;">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><?= $nao_aprovados["NOME_PESSOA"][$i]; ?></h3>
                                <p class="card-text"><b>CPF:</b> <?= $nao_aprovados["CPF"][$i]; ?></p>
                                <p class="card-text"><b>Interesse em adotar:</b> <?= $nao_aprovados["NOME_ANIMAL"][$i] . ' - ' . $nao_aprovados["TIPO_LOCALIZACAO"][$i] . ' - ' . $nao_aprovados["ESPECIE_LOCALIZACAO"][$i] . ' - ' . $nao_aprovados["NUMERO_LOCALIZACAO"][$i] . ' - baia - ' . $nao_aprovados["BAIAS_LOCALIZACAO"][$i] . ' - ' . $nao_aprovados["CIDADE"][$i]; ?></p>
                                <p class="card-text"><b>Contato:</b> <?= $nao_aprovados["TELEFONE"][$i]; ?></p>
                                <p class="card-text"><b>Celular:</b> <?= $nao_aprovados["CELULAR"][$i]; ?></p>
                                <p class="card-text"><b>E-mail:</b> <?= $nao_aprovados["EMAIL"][$i]; ?></p>
                                <p class="card-text"><b>Endereço:</b> <?= $nao_aprovados["ENDERECO"][$i] . ', ' . $nao_aprovados["BAIRRO"][$i] . ' - ' . $nao_aprovados["NUMERO"][$i] . ' - ' . $nao_aprovados["COMPLEMENTO"][$i] . ' - ' . $nao_aprovados["CEP"][$i]; ?></p>
                                <p class="card-text"><b>IP do interessado:</b> <?=$nao_aprovados["IP_INTERESSADO"][$i];?></p>
                                <p class="card-text"><b>Data de cadastro:</b> <?=$nao_aprovados["DATA_INTERESSADO"][$i];?></p>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="porte"><b>Status:</b></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $nao_aprovados["ID_INTERESSE"][$i] ?>" value="1" <?php echo ($nao_aprovados["STATUS"][$i] == 1) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Aprovado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $nao_aprovados["ID_INTERESSE"][$i] ?>" value="3" <?php echo ($nao_aprovados["STATUS"][$i] == 3) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Não aprovado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $nao_aprovados["ID_INTERESSE"][$i] ?>" value="2" <?php echo ($nao_aprovados["STATUS"][$i] == 2) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Não compareceu</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $nao_aprovados["ID_INTERESSE"][$i] ?>" value="0" <?php echo ($nao_aprovados["STATUS"][$i] == 0) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Novo interessado</label>
                                        </div>
                                        <input name="btnSubmit" onclick="update(<?= $nao_aprovados['ID_INTERESSE'][$i] ?>)" id="btnSubmit" class="btn btn-primary botao" value="Enviar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
                ?>
        </div>
        <div id="aprovado" class="row" style="display:none">
            <?php
                for ($i = 0; $i < count($aprovados["NOME_PESSOA"]); $i++) {
                    ?>
                <div class="col-sm-3">
                    <div class="card-deck" style="width: 24rem;">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><?= $aprovados["NOME_PESSOA"][$i]; ?></h3>
                                <p class="card-text"><b>CPF:</b> <?= $aprovados["CPF"][$i]; ?></p>
                                <p class="card-text"><b>Interesse em adotar:</b> <?= $aprovados["NOME_ANIMAL"][$i] . ' - ' . $aprovados["TIPO_LOCALIZACAO"][$i] . ' - ' . $aprovados["ESPECIE_LOCALIZACAO"][$i] . ' - ' . $aprovados["NUMERO_LOCALIZACAO"][$i] . ' - baia - ' . $aprovados["BAIAS_LOCALIZACAO"][$i] . ' - ' . $aprovados["CIDADE"][$i];; ?></p>
                                <p class="card-text"><b>Contato:</b> <?= $aprovados["TELEFONE"][$i]; ?></p>
                                <p class="card-text"><b>Celular:</b> <?= $aprovados["CELULAR"][$i]; ?></p>
                                <p class="card-text"><b>E-mail:</b> <?= $aprovados["EMAIL"][$i]; ?></p>
                                <p class="card-text"><b>Endereço:</b> <?= $aprovados["ENDERECO"][$i] . ', ' . $aprovados["BAIRRO"][$i] . ' - ' . $aprovados["NUMERO"][$i] . ' - ' . $aprovados["COMPLEMENTO"][$i] . ' - ' . $aprovados["CEP"][$i]; ?></p>
                                <p class="card-text"><b>IP do interessado:</b> <?=$aprovados["IP_INTERESSADO"][$i];?></p>
                                <p class="card-text"><b>Data de cadastro:</b> <?=$aprovados["DATA_INTERESSADO"][$i];?></p>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="porte"><b>Status:</b></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $aprovados["ID_INTERESSE"][$i] ?>" value="1" <?php echo ($aprovados["STATUS"][$i] == 1) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Aprovado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $aprovados["ID_INTERESSE"][$i] ?>" value="3" <?php echo ($aprovados["STATUS"][$i] == 3) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Não aprovado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $aprovados["ID_INTERESSE"][$i] ?>" value="2" <?php echo ($aprovados["STATUS"][$i] == 2) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Não compareceu</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $aprovados["ID_INTERESSE"][$i] ?>" value="0" <?php echo ($aprovados["STATUS"][$i] == 0) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Novo interessado</label>
                                        </div>
                                        <input name="btnSubmit" onclick="update(<?= $aprovados['ID_INTERESSE'][$i] ?>)" id="btnSubmit" class="btn btn-primary botao" value="Enviar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
                ?>
        </div>
        <div id="novo_interessado" class="row">
            <?php
                for ($i = 0; $i < count($novo_interessado["NOME_PESSOA"]); $i++) {
                    ?>
                <div class="col-sm-3">
                    <div class="card-deck" style="width: 24rem;">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><?= $novo_interessado["NOME_PESSOA"][$i]; ?></h3>
                                <p class="card-text"><b>CPF:</b> <?= $novo_interessado["CPF"][$i]; ?></p>
                                <p class="card-text"><b>Interesse em adotar:</b> <?= $novo_interessado["NOME_ANIMAL"][$i] . ' - ' . $novo_interessado["TIPO_LOCALIZACAO"][$i] . ' - ' . $novo_interessado["ESPECIE_LOCALIZACAO"][$i] . ' - ' . $novo_interessado["NUMERO_LOCALIZACAO"][$i] . ' -  baia - '. $novo_interessado["BAIAS_LOCALIZACAO"][$i] . ' - ' . $novo_interessado["CIDADE"][$i]; ?></p>
                                <p class="card-text"><b>Contato:</b> <?= $novo_interessado["TELEFONE"][$i]; ?></p>
                                <p class="card-text"><b>Celular:</b> <?= $novo_interessado["CELULAR"][$i]; ?></p>
                                <p class="card-text"><b>E-mail:</b> <?= $novo_interessado["EMAIL"][$i]; ?></p>
                                <p class="card-text"><b>Endereço:</b> <?= $novo_interessado["ENDERECO"][$i] . ', ' . $novo_interessado["BAIRRO"][$i] . ' - '. $novo_interessado["NUMERO"][$i] . ' - ' . $novo_interessado["COMPLEMENTO"][$i] . ' - ' . $novo_interessado["CEP"][$i]; ?></p>
                                <p class="card-text"><b>IP do interessado:</b> <?=$novo_interessado["IP_INTERESSADO"][$i];?></p>
                                <p class="card-text"><b>Data de cadastro:</b> <?=$novo_interessado["DATA_INTERESSADO"][$i];?></p>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="porte"><b>Status:</b></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $novo_interessado["ID_INTERESSE"][$i] ?>" value="1" <?php echo ($novo_interessado["STATUS"][$i] == 1) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Aprovado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $novo_interessado["ID_INTERESSE"][$i] ?>" value="3" <?php echo ($novo_interessado["STATUS"][$i] == 3) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Não aprovado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $novo_interessado["ID_INTERESSE"][$i] ?>" value="2" <?php echo ($novo_interessado["STATUS"][$i] == 2) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Não compareceu</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status<?= $novo_interessado["ID_INTERESSE"][$i] ?>" value="0" <?php echo ($novo_interessado["STATUS"][$i] == 0) ? "checked='checked'" : null; ?>>
                                            <label class="form-check-label" for="status">Novo interessado</label>
                                        </div>

                                        <input name="btnSubmit" onclick="update(<?= $novo_interessado['ID_INTERESSE'][$i] ?>)" id="btnSubmit" class="btn btn-primary botao" value="Enviar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
                ?>
        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../js/jquery.scrollex.min.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/skel.min.js"></script>
        <script src="../js/util.js"></script>
        <script src="../js/main.js"></script>
        <script>
            function changeStatus(status) {
                switch (status) {
                    case 0:
                        document.getElementById("nao_aprovado").style = "display: none";
                        document.getElementById("aprovado").style = "display: none";
                        document.getElementById("nao_compareceu").style = "display: none";
                        document.getElementById("novo_interessado").style = "display: flex";
                        break;
                    case 1:
                        document.getElementById("nao_aprovado").style = "display: none";
                        document.getElementById("aprovado").style = "display: flex";
                        document.getElementById("nao_compareceu").style = "display: none";
                        document.getElementById("novo_interessado").style = "display: none";
                        break;
                    case 2:
                        document.getElementById("nao_aprovado").style = "display: none";
                        document.getElementById("aprovado").style = "display: none";
                        document.getElementById("nao_compareceu").style = "display: flex";
                        document.getElementById("novo_interessado").style = "display: none";
                        break;
                    case 3:
                        document.getElementById("nao_aprovado").style = "display: flex";
                        document.getElementById("aprovado").style = "display: none";
                        document.getElementById("nao_compareceu").style = "display: none";
                        document.getElementById("novo_interessado").style = "display: none";
                        break;
                    default:
                        document.getElementById("nao_aprovado").style = "display: none";
                        document.getElementById("aprovado").style = "display: none";
                        document.getElementById("nao_compareceu").style = "display: none";
                        document.getElementById("novo_interessado").style = "display: flex";
                }
            }
        </script>
        <script>
            $('#btnSubmit').bind('click', function() {

                $('#error').addClass('hide');
                var err = '';
                $('#btnSubmit').attr("disabled", true);

            });

            function update(idInteresse) {
                var status = document.getElementsByName("status" + idInteresse);

                var novoStatus = 0;

                for (var i = 0; i < status.length; i++) {
                    if (status[i].checked) {
                        novoStatus = status[i].value;
                    }
                }

                var form_data = new FormData();

                form_data.append('status', novoStatus);
                form_data.append('idInteresse', idInteresse);

                $.ajax({
                    type: "POST",
                    url: "../banco/status.php",
                    dataType: "text",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        let response = JSON.parse(data);
                        if (response['success'] == '1') {
                            alert("Status atualizado com sucesso!");
                            window.location.reload();
                        } else {
                            alert(response['error']);
                        }
                    },
                    error: function(data) {
                        let response = JSON.parse(data);
                        alert(response['error']);
                    }
                });
            }
        </script>
       

    </html>
<?php
} else {
    header('location:login.php');
}
