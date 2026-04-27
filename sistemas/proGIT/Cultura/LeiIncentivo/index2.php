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

  <body>
    <input type="hidden" id="ultimaDiv" value="">



    <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

        <div class="row">
            <div class="col-md-6">
                <img src="img/logo.png" class="pmf"> 
            </div> 
            <div class="col-md-6">
                <img src="img/fcc.png" class="fcc"> 
            </div>
        </div>
<br>

        <h1>Lei Municipal de Incentivo a Cultura</h1>
<br>
        <? include_once("menu2.php"); ?>   
<br>

        <? include_once("corpo2.php"); ?>   


  

       </div>


</body>

<script type="text/javascript" src="js/bootstrap-dropdown.js">
  $(function () {
    $('.dropdown-toggle').dropdown();
  });         
</script>
	
<script>
    
    $('#a1fone1').mask("(99) 999999999");
    $('#a1fone2').mask("(99) 999999999");
    $('#a3fone1').mask("(99) 999999999");
    $('#a3fone2').mask("(99) 999999999");
    $('#a3contatoAg').mask("(99) 999999999");
    $('#a3foneAg').mask("(99) 999999999");
    $('#a2fone1').mask("(99) 999999999");
    $('#a2fone2').mask("(99) 999999999");
    $('#a2fone1responsa').mask("(99) 999999999");
    $('#a2fone2responsa').mask("(99) 9999999999");


    $('#a1cpf').mask("999.999.999-99");
    $('#a2cpf').mask("999.999.999-99");


    $('#a1cep').mask("99.999-999");
    $('#a2cep').mask("99999-999");
    $('#a3cep').mask("99999-999");

    

    $('#a2cnpj').mask("99.999.999/9999-99");
    
    
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


    function addLine(area){

        if(area == "RHE"){
          var table = document.getElementById("tableRHE");
          var numOfRows = table.rows.length;
          var numOfCols = table.rows[numOfRows-1].cells.length;        
          var newRow = table.insertRow(numOfRows);
          var numberArea = 1;
   
          newCell = newRow.insertCell(0);
          newCell.innerHTML = "<input id='c51[]' class='form-control field' type='text'>";       

          newCell = newRow.insertCell(1);
          newCell.innerHTML = "<input id='c52[]' class='form-control field' type='text'>";       

          newCell = newRow.insertCell(2);
          newCell.innerHTML = "<input id='c53[]' class='form-control field' type='text'>";       

          newCell = newRow.insertCell(3);
          newCell.innerHTML = "<input id='btnADD' class='btn btn-danger' type='button' value=' - ' onclick = 'delLine(" + numOfRows + ","+ numberArea +");' />";       
        }

        else if(area == "PACE1"){
                var table = document.getElementById("tablePACE1");
                var numOfRows = table.rows.length;
                var numOfCols = table.rows[numOfRows-1].cells.length;        
                var newRow = table.insertRow(numOfRows);
                var numberArea = 2;
         
                newCell = newRow.insertCell(0);
                newCell.innerHTML = "<input id='c7Pre1[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(1);
                newCell.innerHTML = "<input id='c7Pre2[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(2);
                newCell.innerHTML = "<input id='c7Pre3[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(3);
                newCell.innerHTML = "<input id='btnADD' class='btn btn-danger' type='button' value=' - ' onclick = 'delLine(" + numOfRows + ","+ numberArea +");' />";      

        } 

           else if(area == "PACE2"){
                var table = document.getElementById("tablePACE2");
                var numOfRows = table.rows.length;
                var numOfCols = table.rows[numOfRows-1].cells.length;        
                var newRow = table.insertRow(numOfRows);
                var numberArea = 2;
         
                newCell = newRow.insertCell(0);
                newCell.innerHTML = "<input id='c7Pro1[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(1);
                newCell.innerHTML = "<input id='c7Pro2[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(2);
                newCell.innerHTML = "<input id='c7Pro3[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(3);
                newCell.innerHTML = "<input id='btnADD' class='btn btn-danger' type='button' value=' - ' onclick = 'delLine(" + numOfRows + ","+ numberArea +");' />";      

        }
               else if(area == "PACE3"){
                var table = document.getElementById("tablePACE3");
                var numOfRows = table.rows.length;
                var numOfCols = table.rows[numOfRows-1].cells.length;        
                var newRow = table.insertRow(numOfRows);
                var numberArea = 2;
         
                newCell = newRow.insertCell(0);
                newCell.innerHTML = "<input id='c7Pos1[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(1);
                newCell.innerHTML = "<input id='c7Pros2[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(2);
                newCell.innerHTML = "<input id='c7Pos3[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(3);
                newCell.innerHTML = "<input id='btnADD' class='btn btn-danger' type='button' value=' - ' onclick = 'delLine(" + numOfRows + ","+ numberArea +");' />";      

        }

                else if(area == "PD"){
                var table = document.getElementById("tablePD");
                var numOfRows = table.rows.length;
                var numOfCols = table.rows[numOfRows-1].cells.length;        
                var newRow = table.insertRow(numOfRows);
                var numberArea = 2;
         
                newCell = newRow.insertCell(0);
                newCell.innerHTML = "<input id='c91[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(1);
                newCell.innerHTML = "<input id='c92[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(2);
                newCell.innerHTML = "<input id='c93[]' class='form-control field' type='text'>";       

                newCell = newRow.insertCell(3);
                newCell.innerHTML = "<input id='btnADD' class='btn btn-danger' type='button' value=' - ' onclick = 'delLine(" + numOfRows + ","+ numberArea +");' />";      

        }
    }       

    function delLine(numRow, numberArea){

        if( numRow !=0 ){
           numRow = numRow - 1;
        }  

        if( numberArea == 1 ){
          var area = "RHE";
        }else if( numberArea == 2 ){
                var area = "PACE1";
        } else if( numberArea == 3 ){
                var area = "PACE2";
        } else if( numberArea == 4 ){
                var area = "PACE3";
        } else if( numberArea == 4 ){
                var area = "PD";
        }  

        if(area == "RHE"){
          var tabela = document.getElementById("tableRHE");
        } 
        else if(area == "PACE1"){
          var tabela = document.getElementById("tablePACE1");
        }
        else if(area == "PACE2"){
          var tabela = document.getElementById("tablePACE2");
        }
        else if(area == "PACE3"){
          var tabela = document.getElementById("tablePACE3");
        }
        else if(area == "PD"){
          var tabela = document.getElementById("tablePD");
        }

        alert( tabela ); 
            
        table.deleteRow(numRow);

}

</script>

</html>