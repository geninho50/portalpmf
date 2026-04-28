$(document).ready(function() {

    $("#driver").click(function(event) {

        $.post(
            "./src/serie.php",
            $("#testform").serializeArray(),
            function(data) {
                $('#stage1').html(data);
            }
        );


    });

});