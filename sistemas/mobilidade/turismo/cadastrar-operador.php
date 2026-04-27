<!DOCTYPE html>
<html lang="pt-br">
<!-- lang é um atributo-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Turismo | Cadastro de Operadores Turimo </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" href="./public/styles/main.css">
    <link rel="stylesheet" href="./public/styles/partials/header.css">
    <link rel="stylesheet" href="./public/styles/partials/forms.css">
    <link rel="stylesheet" href="./public/styles/partials/page-cadastrar-operadoras.css">

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <script type="text/javascript" src="./public/scripts/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./public/scripts/form-operador.js"></script>
    <script src="./public/scripts/on-off.js"></script>

    <!-- mascaras de input dos forms -->
    <script src="./public/scripts/masks.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.mask.min.js"></script>
    <script src="./public/scripts/masks.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.mask.min.js" defer></script>

    <script src="./public/scripts/mobile-nav-bar-active.js" defer></script> <!-- Script for mobile nav-bar links-->




</head>

<body id="page-cadastrar-operadoras">

    <div id="container">
        <header class="page-header">
            <div class="top-bar-container">
                <nav class="navbar">
                    <div class="logo-title">
                        <a href="./">SELO TURÍSTICO</a> 
                    </div>
                    <a href="#" class="toggle-button">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </a>
                    <ul class="navbar-links">
                        <li>
                            <a href="./">Ajuda</a>
                        </li>
                        <li>
                            <a href="./login.php">Entrar</a>
                        </li>

                    </ul>
                </nav>
            </div>

            <div class="header-content">
                <img src="./public/images/logo.svg" alt="PMF">

                <strong>Cadastrar operadora de viagens</strong>
                <p>Cadastre sua operadora para começar <br> a cadastar suas viagens</p>
            </div>
            <!-- <div id="stage1" style="background-color:maroon;color:white; display:block">
            </div> -->
        </header>

        <main>

            <form method="post" id="operadorform" action="./src/cadastrar_operador_db.php">
                <fieldset id="cadastro_operador" class="div-show" style="display: block;">
                    <legend> Dados do Operador<i>Datos del operador</i></legend>
                    <div class="cadastro_operador_show" id="cadastro_operador_show" style="display: block;">
                        <span id="msg-error-operador"></span>
                        <div class="select-block">
                            <label for="operador_pais">País do Operador &#183;<i> País del operador</i></label>
                            <select class="form-control" name="operador_pais" id="operador_pais">
                                <option disabled selected value>Selecione o país da operadora</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Bolívia">Bolívia</option>
                                <option value="Brasil">Brasil</option>
                                <option value="Chile">Chile</option>
                                <option value="Colômbia">Colômbia</option>
                                <option value="Equador">Equador</option>
                                <option value="Paraguai">Paraguai</option>
                                <option value="Peru">Peru</option>
                                <option value="Uruguai">Uruguai</option>
                                <option value="Venezuela">Venezuela</option>
                            </select>
                           <small id="operador_pais_helpId" class="form-text text-muted">Escolha o país &#183;<i> Elige tu país</i></small>
                           <small id="operador_pais_msg" class="small-message form-text text-muted"></small>
                        </div>

                        <div class="input-block">
                            <label for="operador_nome">Nome do Operador;<i> Nombre del operador</i>   </label>
                            <input type="text" class="form-control" style="text-transform: uppercase;"
                                name="operador_nome" id="operador_nome" aria-describedby="operador_nome_helpId"
                                placeholder="Digite o nome...">
                                <small id="operador_nome_helpId" class="form-text text-muted">Digite o nome ou razão social do operador</small>
                                <small id="operador_nome_msg" class="small-message form-text text-muted"></small>
                        
                            </div>
                        
                        <div class="input-block grid grid-two">
                            <div class="select-block">
                                <label for="operador_tipo_documento">Tipo de documento</label>
                                <select class="form-control" name="operador_tipo_documento" id="operador_tipo_documento">
                                    <option disabled selected value>Selecione uma opção</option>
                                    <option value="RG">RG</option>
                                    <option value="CPF">CPF</option>
                                    <option value="CNPJ">CNPJ</option>
                                    <option value="CNH">CNH</option>
                                    <option value="Carteira de Identidade">(Estrangeiro) Carteira de Identidade</option>
                                    <option value="Cédula de Cidadania">(Estrangeiro) Cédula de Cidadania</option>
                                    <option value="Cédula de Estrangeiro">(Estrangeiro) Cédula de Estrangeiro</option>
                                    <option value="Cédula de Identidade">(Estrangeiro) Cédula de Identidade</option>
                                    <option value="Documento Nacional de Identidade">(Estrangeiro) Documento Nacional de
                                        Identidade</option>
                                    <option value="Passaporte">(Estrangeiro) Passaporte</option>
                                </select>
                                <small id="operador_tipo_documento_helpId" class="form-text text-muted">Escolha o tipo de documento para cadastro</small>
                                <small id="operador_tipo_documento_msg" class="small-message form-text text-muted"></small>

                            </div>

                            <div class="input-block">
                                <label for="operador_documento">Número do documento</label>
                                <input type="text" class="form-control" name="operador_documento" id="operador_documento" placeholder="Número do documento">
                                <small id="operador_documento_msg" class="small-message form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="input-block grid grid-four">
                            <div class="input-block">
                                <label for="operador_cep">Código postal</label>
                                <input type="text" class="form-control" name="operador_cep" id="operador_cep" aria-describedby="operador_lcep" placeholder="Código postal local">
                                <small id="operador_cep_helpId" class="form-text text-muted">Ex: 88-888.888</small>
                                <small id="operador_cep_msg" class="small-message form-text text-muted"></small>
                            </div>
                            <div class="input-block">
                                <label for="operador_logradouro">Logradouro</label>
                                <input type="text" class="form-control" name="operador_logradouro" id="operador_logradouro" aria-describedby="operador_logradouro_helpId" >
                                <small id="operador_logradouro_helpId" class="form-text text-muted">Ex: Rua Felipe Schimidt</small>
                                <small id="operador_logradouro_msg" class="small-message form-text text-muted"></small>
                                    
                            </div>

                            <div class="input-block">
                                <label for="operador_endereco_numero">Número</label>
                                <input type="text" class="form-control" name="operador_endereco_numero" id="operador_endereco_numero" aria-describedby="operador_endereco_numero_helpId">
                                <small id="operador_endereco_numero_helpId" class="form-text text-muted">Ex:43</small>
                                <small id="operador_endereco_numero_msg" class="small-message form-text text-muted"></small>
                            </div>

                            <div class="input-block">
                                <label for="operador_complemento">Complemento</label>
                                <input type="text" class="form-control" name="operador_complemento" id="operador_complemento" aria-describedby="operador_complemento_helpId">
                                <small id="operador_complemento_helpId" class="form-text text-muted">Bloco 1</small>
                                <small id="operador_complemento_msg" class="small-message form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="input-block grid grid-tree">
                            <div class="input-block">
                                <label for="operador_bairro">Bairro</label>
                                <input type="text" class="form-control" name="operador_bairro" id="operador_bairro" aria-describedby="operador_bairro_helpId">
                                <small id="operador_bairro_helpId" class="form-text text-muted">Ex: Centro</small>
                                <small id="operador_bairro_msg" class="small-message form-text text-muted"></small>
                            </div>

                            <div class="input-block">
                                <label for="operador_cidade">Cidade</label>
                                <input type="text" class="form-control" name="operador_cidade" id="operador_cidade" placeholder="Cidade">
                                <small id="operador_cidade_msg" class="small-message form-text text-muted"></small>
                            </div>

                            <div class="input-block">
                                <label for="operador_estado">Estado</label>
                                <input type="text" class="form-control" name="operador_estado" id="operador_estado" placeholder="Estado">
                                <small id="operador_estado_msg" class="small-message form-text text-muted"></small>
                            </div>
                        </div>
            
                        <div class="input-block grid grid-two">
                            <div class="input-block">
                                <label for="operador_email">E-mail</label>
                                <input type="email" class="form-control" name="operador_email" id="operador_email" placeholder="email@email.com">
                            </div>

                            <div class="input-block">
                                <label for="operador_email_rep">Confirmar E-mail</label>
                                <input type="email" class="form-control" name="operador_email_rep"
                                    id="operador_email_rep" placeholder="email@email.com">
                            </div>
                        </div>

                        <div class="input-block grid grid-tree-phone">

                            <!-- <label for="operador_telefone"><b>Telefone (DDI + DDD + Número)</b></label> -->
                            <div class="input-block">
                                <label for="operador_ddi">DDI</label>
                                <input type="tel" name="operador_ddi" id="operador_ddi" class="telefoneddi form-control" placeholder="código do país" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Brasil: 55</small>
                            </div>
                            <div class="input-block">
                                <label for="operador_ddd">DDD</label>
                                <input type="tel" name="operador_ddd" id="operador_ddd" class="telefoneddd form-control" placeholder="código de área" aria-describedby="helpId">
                                <small id="helpId" class="text-muted"></small>
                            </div>
                            <div class="input-block">
                                <label for="operador_numero">Número</label>
                                <input type="tel" name="operador_numero" id="operador_numero"
                                    class="telefone form-control" placeholder="telefone" aria-describedby="helpId">
                                <small id="helpId" class="text-muted"></small>
                            </div>
                        </div>

                        <div class="input-block grid grid-two">
                            <div class="input-block">
                                <label for="operador_senha">Senha</label>
                                <input type="password" name="operador_senha" id="operador_senha" class="form-control"  aria-describedby="helpId_operador_senha">
                                <small id="helpId_operador_senha" class="text-muted"></small>
                            </div>
                            <div class="input-block">
                                <label for="operador_ddd">Repetir Senha</label>
                                <input type="password" name="operador_rep_senha" id="operador_rep_senha" class="form-control"  aria-describedby="helpId">
                                <small id="helpId_operador_rep_senha" class="text-muted"></small>
                            </div>

                        </div>


                    </div>

                </fieldset>


                <footer>
                    <p>
                        Importante! <br>
                        Preencha todos os dados corretamente
                    </p>

                    <input type="submit" type="button" id="" value="Testar campos do formulario"
                        onclick="return validaroperador()" />
                    <button id="cadastrar_operador_db">Salvar cadastro sem teste</button>
                </footer>
            </form>



        </main>
        <script>

        </script>
    </div>

</body>

</html>