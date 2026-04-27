<!doctype html>
<html lang='pt-BR'>

  <head>
    <meta charset="UTF-8">
    <title>Lei de Incentivo a Cultura</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>

<style type="text/css">
    .coluna1{ 
     width: 25%;
     vertical-align:top;
    }    

    .coluna2{ 
     width: 75%;
     vertical-align:top;
    }        

    .coluna3{ 
     width: 100%;
     vertical-align:top;
    }        


    .bodyPrincipal{
     margin-left: 5%;
     margin-right: 5%;   
    }

</style>

<body class="bodyPrincipal" >
    
    <table>    
      <tr>
        <td align="center">
          <img src="img/logo.png" width="50%" height="50%">
        </td>
      </tr>  
      <tr>
        <td class="coluna3" align="center">
         <? include_once("emailSetor.php"); ?>   
        </td>
      </tr>
    </table>
</body>

<script type="text/javascript" src="js/bootstrap-dropdown.js">
  $(function () {
    $('.dropdown-toggle').dropdown();
  });         
</script>
	
<script>
    $('#a1fone1').mask("(99) 999999999");
    $('#a1fone2').mask("(99) 999999999");
    $('#a1cpf').mask("999.999.999-99");
    $('#a1cep').mask("99.999-999");

    $('#a2cnpj').mask("99.999.999/9999-99");
    $('#a2cep').mask("99999-999");
    $('#a2fone1').mask("(99) 999999999");
    $('#a2fone2').mask("(99) 999999999");
    $('#a2fone1responsa').mask("(99) 999999999");
    $('#a2fone2responsa').mask("(99) 9999999999");
    $('#a2cpf').mask("999.999.999-99");

    	
    	

    $('#b6inicio').mask("99/99/9999");
    $('#b6termino').mask("99/99/9999");

    $('#b7valor1').mask("R$ 999.999,99");
    $('#b7valor2').mask("R$ 999.999,99");
    $('#b7valor3').mask("R$ 999.999,99");
    $('#b7valor4').mask("R$ 999.999,99");
    $('#b7valor5').mask("R$ 999.999,99");
</script>

<script type="text/javascript">

    function statusDIV(id){

      if( document.getElementById(id).style.display == 'none' ){
          document.getElementById(id).style.display = 'block';
      }else{
          document.getElementById(id).style.display = 'none';
      }

    }

    function sair(){
      alert("Teste");
    }

    function ativarDIV(idDIV){
      var ultimaDiv = document.getElementById("ultimaDiv").value;  

      document.getElementById(idDIV).style.display = 'block';

      if( ultimaDiv !='' && ultimaDiv != idDIV ){
          document.getElementById(ultimaDiv).style.display = 'none';
      } 

      document.getElementById("ultimaDiv").value = idDIV;  
    }    


    function addRHE(){

        var table = document.getElementById("tableRHE");
        var numOfRows = table.rows.length;
        var numOfCols = table.rows[numOfRows-1].cells.length;        
        var newRow = table.insertRow(numOfRows);
 
        newCell = newRow.insertCell(0);
        newCell.innerHTML = "<input id='c51[]' class='form-control field' type='text'>";       

        newCell = newRow.insertCell(1);
        newCell.innerHTML = "<input id='c52[]' class='form-control field' type='text'>";       

        newCell = newRow.insertCell(2);
        newCell.innerHTML = "<input id='c53[]' class='form-control field' type='text'>";       

        newCell = newRow.insertCell(3);
        newCell.innerHTML = "<input id='btnADD' class='btn btn-danger' type='button' value=' - ' onclick = 'delRHE(" + numOfRows + ");' />";       

    }            

    function delRHE(numRow){

        var table = document.getElementById("tableRHE");
        
        table.deleteRow(numRow);

    }

</script>

</html>