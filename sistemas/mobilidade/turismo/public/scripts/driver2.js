
$(document).ready(function () {

    $("#driver1").click(function () {
       
        var rv = true;
        semaforo = 1;

        $('.verificar_passageiros').each(function () {

            if (this.value == '') {
                $(this).css('border', '1px solid red');
                $("#msg-error").html('<div class="alert alert-danger" role="alert">INDEX:</div>');
                this.focus();
                semaforo = 1;
                return rv = false;
            };

            if (semaforo = 1)
            return false;

            if (this.value != '') {
                $(this).css('border', '1px solid');
                $("#msg-error").html('<div class="alert alert-danger" role="alert">passou1</div>');
                semaforo = 2;
                return rv = true;
            };
        })

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
