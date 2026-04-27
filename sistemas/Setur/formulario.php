<?
include "backend/db.php"; 


$id = $_GET['id'];
$idBotSub = "btnSubmit";
if($id != null){
    $sql = $db->prepare("SELECT * FROM `setur`.`setur` where `id` = $id");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if($data != ''){
        $nome                = utf8_encode($data['nome']);
        $genero              = utf8_encode($data['genero']);
        $dataNasc            = utf8_encode($data['dataNasc']);
        $rua                 = utf8_encode($data['rua']);
        $numero              = utf8_encode($data['numero']);
        $bairro              = utf8_encode($data['bairro']);
        $cep                 = utf8_encode($data['cep']);
        $escolaridade        = utf8_encode($escolaridade['escolaridade']);
        $email               = utf8_encode($data['email']);
        $telefone            = utf8_encode($data['telefone']);
        $celular             = utf8_encode($data['celular']);
        $profissional        = utf8_encode($data['profissional']);
        $qual                = utf8_encode($data['qual']);
        $ctps                = utf8_encode($data['ctps']);
        $area                = utf8_encode($data['area']);
        $rg                  = utf8_encode($data['rg']);
        $cpf                 = utf8_encode($data['cpf']);

        
    }    
    $idBotSub = "update";
}
?>

<!doctype html>
<html lang='pt-BR'>
	<head>
    <meta charset="UTF-8">
    <title>Projeto Crescendo e Empreendendo - Curso de Perfil Empreendedor</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo2.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>
  	
  <body>
        <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

         <div class="row">
            <div class="col-md-12">
                <img src="img/capa.jpg" class="fcc"> 
            </div> 
        </div>
        </div>

        <br><br>

        <form id="frm1" name="frm1" method="post" action="backend/cadastrarSetur.php"; enctype="multipart/form-data">
        
        <h1>Formulário de Inscrição</h1><br>
        <p><strong>Somente jovens de 15 a 18 anos</strong></p>
        <p><strong>Todos os campos com * são obrigatórios</strong></p>
        <p><strong>Somente um CPF por cadastro</strong></p>
        <p><strong>Dúvidas e informações: E-mail desenvolvimento@pmf.sc.gov.br / Telefone (48) 3952-7016</strong></p><br>
        <p><strong>Lembrando que a capacitação ocorrerão sempre após fecharmos uma turma mínima de 25 alunos em sua região.</strong></p><br><br>


<div id='cadastro'>
        <div class="row">
            
                <div class="col-md-6"><label>Nome Completo* :</label><input value="<?=$nome?>" id="nome" name="nome" class="form-control" type="text"/></div>
                <div class="col-md-6"><label>Data de Nascimento* :</label><input value="<?=$dataNasc?>" id="dataNasc" name="dataNasc" class="form-control" type="text"/></div>
            
        </div><br>

         <div class="row">
               <div class="col-md-6"><label>RG* :</label><input value="<?=$rg?>" id="rg" name="rg" class="form-control" type="text"/></div>
               <div class="col-md-6"><label>CPF* :</label><input value="<?=$cpf?>" id="cpf" name="cpf" class="form-control" type="text"/></div>
        </div><br>

        <div class="row">
            <div class="col-md-6">
                <label>Gênero*: </label> 
                <label class="radio-inline">
                    <input type="radio" name="genero"  value="1" class="genero"> Masculino
                </label>
                <label class="radio-inline">
                  <input type="radio" name="genero"  value="2" class="genero"> Feminino 
                </label>
            </div>
        </div><br>

        <div class="row">
            <div class="col-md-8"><label>Endereço*:</label><input value="<?=$rua?>" id="rua"  name="rua" class="form-control" type="text"/></div>
            <div class="col-md-4"><label>Número*:</label><input value="<?=$numero?>" id="numero"  name="numero" class="form-control" type="text"/></div>
        </div><br>

        <div class="row">     
            <div class="col-md-4"><label>Bairro*:</label><input value="<?=$bairro?>" id="bairro"  name="bairro" class="form-control" type="text"/></div>
            <div class="col-md-4"><label>CEP:</label><input value="<?=$cep?>" id="cep" name="cep" class="form-control" type="text"/></div>
            <div class="col-md-4"><label>Cidade: <br /> Florianópolis</label></div>
        </div><br>  

        <div class="row">
                <div class="col-md-8"><label>Grau de Escolaridade*:</label> </div><br>
                <div class="col-md-6">
                <label class="radio-inline">
                  <input type="radio" name="escolaridade" value="1" class="escolaridade"> 2° Grau Completo
                </label><br />

                <label class="radio-inline">
                  <input type="radio" name="escolaridade"  value="2" class="escolaridade"> 2° Grau Incompleto 
                </label> <br />

                <label class="radio-inline">
                  <input type="radio" name="escolaridade"  value="3" class="escolaridade"> Superior Completo 
                </label><br />

                <label class="radio-inline">
                  <input type="radio" name="escolaridade"  value="4" class="escolaridade"> Superior Incompleto 
                </label>
            </div>
        </div><br>  

        <div class="row">     
            <div class="col-md-4"><label>Email*:</label><input value="<?=$email?>" id="email"  name="email" class="form-control" type="text"/></div>
            <div class="col-md-4"><label>Telefone Fixo:</label><input value="<?=$telefone?>" id="telefone" name="telefone"  class="form-control" type="text"/></div>
            <div class="col-md-4"><label>Celular*:</label><input value="<?=$celular?>" id="celular" name="celular" class="form-control"  name="celular" type="text"/></div>
        </div><br>

        <div class="row">
            <div class="col-md-6">
                <label>Já teve alguma experiência profissional?* </label> 
                <label class="radio-inline">
                    <input type="radio" name="profissional"  value="1" class="profissional"> Sim
                </label>
                <label class="radio-inline">
                  <input type="radio" name="profissional"  value="2" class="profissional"> Não 
                </label>
            </div>
        </div><br>   


        <div class="row">     
            <div class="col-md-12"><label>Qual?</label><textarea value="<?=$qual?>" id="qual" name="qual" class="form-control" row="4" type="text" /></textarea></div>
        </div><br>

        <div class="row">
            <div class="col-md-6">
                <label>Com Carteira de Trabalho Assinada (CTPS)?* </label> 
                <label class="radio-inline">
                    <input type="radio" name="ctps"  value="1" class="ctps"> Sim
                </label>
                <label class="radio-inline">
                  <input type="radio" name="ctps"  value="2" class="ctps"> Não 
                </label>
            </div>
        </div><br>

        <div><input id="id1" name="id1" type="hidden"/></div>
        <input type="button" name="btnSubmit" onclick="update()" id="btnSubmit" class="btn btn-primary botao" value="Enviar" />        
        </div><br>

    </div>
    </form>    
    <div class="overlay"></div>    
    </div>
    </body>
   
   <script type="text/javascript" src="js/validacao.js"></script>
   <script>
    $('#telefone').mask("(99) 9999-9999");
    $('#celular').mask("(99) 99999-9999");
    $('#dataNasc').mask("99/99/9999");
    $('#cep').mask("99999-999");
    $('#cpf').mask("999.999.999-99");    
    
    $('#btnSubmit').bind('click',function(){

        var ano  = document.getElementById("dataNasc").value.substring(6,10);
        var ecpf = $('#cpf').val(); 
        
        // preparando o CPF para validação
        ecpf = ecpf.replace('.','');
        ecpf = ecpf.replace('.','');
        ecpf = ecpf.replace('-','');
       
        if( !ecnpjcpf( ecpf ) ){            
            return false;            
        }

        if( ano>2002 || ano<1998 ){
            alert("Você está fora da faixa etária permitida no projeto! ");
            return false;
        }        

        $('#error').addClass('hide');
            var err = '';

            var obj = {
            nome                 : $('#nome').val(),
            genero               : $('#genero').val(),
            dataNasc             : $('#dataNasc').val(),
            rua                  : $('#rua').val(),
            numero               : $('#numero').val(),
            bairro               : $('#bairro').val(),
            cep                  : $('#cep').val(),
            escolaridade         : $('#escolaridade').val(),
            email                : $('#email').val(),
            telefone             : $('#telefone').val(),
            celular              : $('#celular').val(),
            profissional         : $('#profissional').val(),
            qual                 : $('#qual').val(),
            ctps                 : $('#ctps').val(),
            area                 : $('#area').val(),
            rg                   : $('#rg').val(),
            cpf                  : $('#cpf').val()
          
        };
    

    
           var obj = new FormData($("#frm1").get(0));
           $('#btnSubmit').attr("disabled", true);
                  

           $.ajax({
               type: "POST",
               url: "backend/cadastrarSetur.php",
               //dataType: "json",
               contentType: false,
               processData:false,
               data: obj,
               success: function (obj1) {
                    //console.log(obj1);
                    var oRetorno = JSON.parse(obj1);                    
                    if(oRetorno.sucesso == 1){
                        $('#error').addClass('hide');     
                        document.getElementById("frm1").action = "sucesso.php";
                        $('#id1').val(oRetorno.id);                  
                        document.getElementById("frm1").submit();                             
                    }else{  
                       //console.log(oRetorno);
                       $('#error').text(oRetorno.error).removeClass('hide');
                       $('.error').removeClass('error');
                       if ('fieldProblem' in oRetorno){
                        $('#' + oRetorno.fieldProblem).addClass('error');
                       }
                       window.scrollTo(0, 0);
                       $('#btnSubmit').removeAttr("disabled");
                    }

                },
               

               error: function (obj1) {
                    $('#btnSubmit').removeAttr("disabled");
                    console.log("erro:"+obj1);
               }
            
        });
    });      


    function update(){
        $('#error').addClass('hide');
        var err = '';
        var id  = "<?=$id?>";
        var obj = {
            id                   : id,
            nome                 : $('#nome').val(),
            genero               : $('#genero').val(),
            dataNasc             : $('#dataNasc').val(),
            rua                  : $('#rua').val(),
            numero               : $('#numero').val(),
            bairro               : $('#bairro').val(),
            cep                  : $('#cep').val(),
            escolaridade         : $('#escolaridade').val(),
            email                : $('#email').val(),
            telefone             : $('#telefone').val(),
            celular              : $('#celular').val(),
            profissional         : $('#profissional').val(),
            qual                 : $('#qual').val(),
            ctps                 : $('#ctps').val(),
            area                 : $('#area').val(),
            rg                   : $('#rg').val(),
            cpf                  : $('#cpf').val()
        };
    }

    function validacao(){
      document.getElementById("cadastro").style.display = "block";
      document.getElementById("btnEntrar").style.display = "none";
    }

    </script>
    </html>

    