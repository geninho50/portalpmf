$(document).ready(function() {

    $("#driver").click(function(event) {

        $.post(
            "./src/serie.php",
            $("#testform").serializeArray(),            
            function(data) {
                Swal.fire(
                    'Viagem Cadastrada!',
                    '',
                    'success'
                ).then
                    $('#stage1').html(data);
            }
        );

})})