function validarPassageiros(rv) {
  var rv1 = true; // <=== Default return value
  
 
  
  $('.verificar_passageiros').each(function (rv1) {
      if (this.value == '') {
          $(this).css('border', '1px solid red');
          this.focus();
          return rv1 = false;
      };
      if (this.value != '') {
          $(this).css('border', '1px solid');
          return rv1 = true; // <
      };
  
      if (!rv1) {
          return rv = false;
      }
  })
  }

 

$(document).ready(function() {

    $("#driver").click(function(event) {

    
      var rv = true; 
      
    if (validarPassageiros(rv) === false) {
            return false;
  };

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

 