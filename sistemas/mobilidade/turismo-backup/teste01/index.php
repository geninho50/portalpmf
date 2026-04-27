<!DOCTYPE HTML>
<html lang="pt-br">
<?php 
echo dirname(__FILE__)
?>
<head>
    <meta charset="utf-8">
    <title>Adicionar e remover campos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .form-group {
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Adicionar Campo</h1>


    <span id="msg-erro"></span>

    <form id="add-Nome1" method="POST">

        <span id="msg_rotas"></span>

        <span id="msg_rotas"></span>


        <div id="formularios_rotas">
            <div class="form-group">

                <label>Rota 1: </label>
                <input type="date" name="data_rota[]" id="data_rota" class="verificar_rotas" placeholder="Saída" />
                <input type="text" name="rota_saida[]" id="rota_saida" class="verificar_rotas" placeholder="Saída" />
                <input type="text" name="rota_chegada[]" id="rota_chegada" class="verificar_rotas" placeholder="Chegada">
                <button type="button" id="2" class="btn-add_rotas"> + </button>
            </div>
        </div>

        <hr>

        <span id="msg_nomes"></span>

        <div id="formularios_nomes">

            <div class="form-group">

                <label>Passageiro: </label>
                <input type="text" name="nome[]" id="nome" class="verificar_nomes" placeholder="Nome" />
                <input type="text" name="documento[]" class="verificar_nomes" placeholder="Documento">
                <button type="button" id="1" class="btn-add_nomes"> + </button>

            </div>
        </div>


        <div class="form-group">
            <input type="button" name="cadastrar_nomes" id="cadastrar_nomes" onclick="validar()" value="Cadastrar">
        </div>
    </form>


    <span id="msg"></span>


    <script>
        $(document).ready(function() {
            var cont_nomes = 1;
            var cont_rotas = 1;
            var data = 1;

            //https://api.jquery.com/click/
            $('#add-Nome').click(function() {
                //   cont_rotas++;
                //  cont_nomes++;
            });

            $('form').on('click', '.btn-add_nomes', function() {
                cont_nomes++;
                var button_id = $(this).attr("id");
                $('#formularios_nomes').append(`
                    <div class="form-group" id="nome${cont_nomes}"> 
                        <label>Passageiro${cont_nomes}: </label>
                        <input type="text" id="add-Nome" name="nome[]"  class="verificar_nomes" placeholder="Nome">  
                        <input type="text" name="documento[]" class="verificar_nomes" placeholder="Documento"> 
                        <button type="button" id="${cont_nomes}" class="btn-add_nomes"> + </button> 
                        <button type="button" id="${cont_nomes}" class="btn-apagar_nomes"> - </button>
                    </div>
                `);
                $("#msg_nomes").html(`
                    <div class="alert alert-danger" role="alert">Lista com ${cont_nomes} passageiros</div>
                `);

            });

            $('form').on('click', '.btn-add_rotas', function() {
                cont_rotas++;
                var button_id_rota = $(this).attr("id");
                $('#formularios_rotas').append(`
                    <div class="form-group" id="rota${cont_rotas}"> 
                        <label>Rota ${cont_rotas}: </label> 
                        <input type="date" name="data_rota[]" id="data_rota" class="verificar_rotas" placeholder="Saída" />
                        <input type="text" name="rota_saida[]" id="rota_saida" class="verificar_rotas" placeholder="Saída" />
                        <input type="text" name="rota_chegada[]" class="verificar_rotas" placeholder="Chegada">
                        <button type="button" id="add_rotas" class="btn-add_rotas"> + </button> 
                        <button type="button" id="${cont_rotas}" class="btn-apagar_rotas"> - </button>
                    </div>
                `);
                $("#msg_rotas").html(`
                    <div class="alert alert-danger" role="alert">Foram programadas ${cont_rotas} rotas</div>
                `);
            });

            $('form').on('click', '.btn-apagar_nomes', function() {
                var button_id = $(this).attr("id");
                cont_nomes--;
                $('#nome' + button_id + '').remove();
                $("#msg_nomes").html(`
                    <div class="alert alert-danger" role="alert">Lista com ${cont_nomes} passageiros</div>
                `);
            });

            $('form').on('click', '.btn-apagar_rotas', function() {
                var button_id = $(this).attr("id");
                cont_rotas--;
                $('#rota' + button_id + '').remove();
                $("#msg_rotas").html(`
                    <div class="alert alert-danger" role="alert">Foram programadas ${cont_rotas} rotas</div>
                `);
            });            

        })

        function validar() {
            //Receber os dados do formulário
            var dados = $("#add-Nome1").serialize();
            var dados1 = $("#add-Nome").serialize();
            var rv = true; // <=== Default return value

            $("#msg-erro").html('<div class="alert alert-danger" role="alert"></div>');

            $('.verificar_rotas').each(function() {
                if (this.value == '') {
                    $(this).css('border', '2px solid red');
                    $("#msg-erro").html('<div class="alert alert-danger" role="alert">Obrigatorio preencher as rotas</div>');
                    return rv = false; // <
                };
                if (this.value != '') {
                    $(this).css('border', '1px solid');
                    $("#msg-erro").html('<div class="alert alert-danger" role="alert"></div>');
                    return rv = true; // <
                };
            })

            if (!rv) {
                return false
            }

            $('.verificar_nomes').each(function() {
                if (this.value == '') {
                    $(this).css('border', '2px solid red');
                    $("#msg-erro").html('<div class="alert alert-danger" role="alert">Obrigatorio preencher a lista de passageiros</div>');
                    return rv = false; // <
                };
                if (this.value != '') {
                    $(this).css('border', '1px solid');
                    $("#msg-erro").html('<div class="alert alert-danger" role="alert"></div>');
                    return rv = true; // <
                };
            })

            if (!rv) {
                return false
            }


            if (rv = true) {
                $.post("teste3.php", dados, function(retorna) {
                    $("#msg").slideDown('slow').html(retorna);

                    //Limpar os campos
                    //$('#add-Nome')[0].reset();

                    //Apresentar a mensagem leve
                    // retirarMsg();
                });
            }

        };

        //Retirar a mensagem após 1700 milissegundos
        function retirarMsg() {
            setTimeout(function() {
                $("#msg").slideUp('slow', function() {});
            }, 62700);
        }

        function validarform() {

        };
    </script>
</body>

</html>