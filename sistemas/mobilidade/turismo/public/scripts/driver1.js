
function validar() {

        var rv = true;
        semaforo = false;
        variaveljs = 1;  
        $('.verificar_passageiros').each(function (index) {

            if (this.value == '') {
                $(this).css('border', '2px solid red');
                document.getElementById("passageiros_msg_"+count_passageiros).innerHTML = ' É obrigatório preencher todos os dados do passageiro! <br> <i>¡Es obligatorio indicar el país del operador! </b>';
                this.focus();
                semaforo = false;
                return rv = false;
            };

            if (this.value != '') {
                $(this).css('border', '1px solid');
                semaforo = true;
                return rv = true;
            };        

        })


        $("#msg-error4").html('<div class="alert alert-danger" role="alert">na espera</div>');
        if (semaforo ===true) { $("#msg-error4").html('<div class="alert alert-danger" role="alert">vai para frente</div>');
        
    
        $.post(
            "./src/serie.php",
            $("#testform").serializeArray(),
            function (data) {
                Swal.fire(
                    'Viagem Cadastrada!',
                    '',
                    'success'
                ).then
                $('#stage1').html(data);
            }
        );
    }
        

    }


    function envia(){

        $.post(
            "./src/serie.php",
            $("#testform").serializeArray(),
            function (data) {
                Swal.fire(
                    'Viagem Cadastrada!',
                    '',
                    'success'
                ).then
                $('#stage1').html(data);
            }
        );




    }




$(document).ready(function () {

    $("#driver1").click(function () {
       
        validar();

        if (semaforo = 2) {
            $("#msg-error2 ").html('<div class="alert alert-danger" role="alert">cadastra</div>');
            $.post(
                "./src/serie.php",
                $("#testform").serializeArray(),
                function (data) {
                    Swal.fire(
                        'Viagem Cadastrada!',
                        '',
                        'success'
                    ).then
                    $('#stage1').html(data);
                }
            );
        }
    })
})
