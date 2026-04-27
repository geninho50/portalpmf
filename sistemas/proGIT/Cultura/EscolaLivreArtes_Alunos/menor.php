<!doctype html>
<html lang='pt-BR'>
    <head>
    <meta charset="UTF-8">
    <title>Franklin Cascaes</title>
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
    <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

        <div class="row">
            <div class="col-md-6">
                <img src="img/pmf2.png" class="pmf"> 
            </div> 
            <div class="col-md-6">
                <img src="img/fcc.png" class="fcc"> 
            </div>
        </div>

        <br><br>

        <h1>Formulário de Inscrições para Alunos</h1>

        <div class="row">

            <div class="col-md-12">
                <form id="frm1" name="frm1" method="post" action="backend/cadastrar.php"; enctype="multipart/form-data">

           <div class="row">
            <div class="col-md-12">
            <h2>Identificação do candidato menor de 18 anos:</h2><br>
            </div>

            <div class="col-md-6"><label id="lbnome" >Nome do Aluno *</label><input type="text" id="nome" name="nome" class="form-control obrigatorio " /></div>
            <div class="col-md-6"><label id="lbnome2" >Nome Social</label><input type="text" id="nome2" name="nome2" class="form-control" /></div>
            </div><br>

            <div class="row">           
            <div class="col-md-4"><label id="lbcertidao" >N° Certidão de Nascimento *</label><input type="text" name="certidao" id="certidao" class="form-control obrigatorio " /></div>
            <div class="col-md-4"><label id="lbfolha" >Livro/Folha *</label><input type="text" name="folha" id="folha" class="form-control obrigatorio " /></div>
            <div class="col-md-4"><label id="nacionalidade" >Nacionalidade *</label><input type="text" name="nacionalidade" id="nacionalidade" class="form-control obrigatorio " /></div>
            </div><br>


            <div class="row">
                <div class="col-md-8">
                    <label>Gênero*: </label> 
                    <label class="radio-inline">
                        <input type="radio" name="genero"  value="1" class="genero"> Masculino
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="genero"  value="2" class="genero"> Feminino 
                    </label>
                </div>
                <div class="col-md-4"><label id="lbnascimento" >Data de Nascimento *</label><input type="text" id="nascimento" name="nascimento" class="form-control obrigatorio " /></div>
            </div><br>


            

            <div class="row">
                <div class="col-md-4"><label id="lbespecial" >Necessidades Especiais? *</label></div>
                    <div class="col-md-4">
                    <input type="button" value="SIM" name="especial" class="form-control" onclick="ativarDIV('especial');" /></div>
                    <div class="col-md-4">
                    <input type="button" value="NÃO" name="especial" class="form-control" /></div>
                </div>

            <div class="row">
                <div id="especial" style="display:none;">
                    <div class="col-md-12"><label id="lbespecial2" >Quais?</label><input type="text" id="especial2" name="especial2" class="form-control" /></div>
                </div>
            </div><br>



            <div class="row">           
            <div class="col-md-12"><h2>Dados do Responsável:</h2></div><br>
            <div class="col-md-4"><label id="lbnome3" >Nome *</label><input type="text" name="nome3" id="nome3" class="form-control obrigatorio " /></div>
            <div class="col-md-4"><label id="lbrg" >RG *</label><input type="text" name="rg" id="rg" class="form-control obrigatorio " /></div>
            <div class="col-md-4"><label id="lbemail" >E-mail *</label><input  name="email" id="email" class="form-control" type="text"/></div>
            </div><br>

            <div class="row">
            <div class="col-md-3"><label  id="lbcep" >CEP *</label><input type="text" name="cep" id="cep" placeholder="CEP" class="form-control obrigatorio " />
                 <span class="input-group-btn">
                    <button class="btn btn-default" onclick="buscarCEP();" type="button">BUSCAR CEP</button>
                </span></div>            
                <div class="col-md-7"><label id="lblogradouro" >Endereço *</label><input type="text" name="logradouro" id="logradouro" placeholder="Endereço" class="form-control obrigatorio " /></div>
                <div class="col-md-2"><label id="lbnumero" >Número *</label><input name="numero" id="numero" class="form-control" type="numero"/></div>
            </div><br>

            <div class="row">     
                <div class="col-md-6"><label id="lbbairro" >Bairro *</label><input type="text" name="bairro" id="bairro" placeholder="Bairro" class="form-control obrigatorio " /></div>
                <div class="col-md-6"><label>Cidade *</label><input type="text" name="municipio" id="municipio" placeholder="Cidade" class="form-control obrigatorio " /></div>
            </div><br>


            <div class="row">
                <div class="col-md-6"><label id="lbcelular" >Celular *</label><input  name="celular" id="celular" class="form-control obrigatorio " type="text"/></div>
                <div class="col-md-6"><label id="lbtelefone" >Telefone *</label><input name="telefone"  id="telefone" class="form-control" type="text"/></div>
            </div><br>

            <div class="row">           
            <div class="col-md-12"><h2>Renda Familiar:</h2></div><br>
            <div class="col-md-4"><label id="lbresidentes" >Quantas pessoas moram na sua residência? *</label><input type="number" name="residentes" id="residentes" class="ol-2 col-form-label" /></div>
            <div class="col-md-4"><label id="lbqntrenda" >Destas, quantas pessoas possuem renda? *</label><input type="number" name="qntrenda" id="qntrenda" class="ol-2 col-form-label" /></div>
            <div class="col-md-4"><label id="lbmenores" >Quantos menores de idade moram na sua residência? *</label><input type="number" name="menores" id="menores" class="ol-2 col-form-label" /></div>
            </div><br>

            <div class="row">
            <div class="col-md-4"><label id="lbrenda" >Qual o valor da renda familiar? *</label><input type="text" id="renda" name="renda" class="form-control field " /></div>
            </div><br>


             <div class="row">         
                <div class="col-md-12"><h2>Escolha <strong>UMA</strong> das oficinas *:</h2><br></div>
               
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="atelie" class="form-check-label"> Desenho de Ateliê</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="quadrinho" class="form-check-label"> Desenho e Quadrinho</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="modelagem" class="form-check-label"> Modelagem em Argila</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="pintura" class="form-check-label"> Pintura</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="boi" class="form-check-label"> Boi de Mamão</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="bilro" class="form-check-label"> Renda de Bilro para Iniciantes</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="danca1" class="form-check-label"> Iniciação à Dança I</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="danca2" class="form-check-label"> Iniciação à Dança II</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="teatro" class="form-check-label"> Iniciação Teatral</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="canto" class="form-check-label"> Canto</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="cavaquinho" class="form-check-label"> Cavaquinho/Bandolim</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="musicalizacao" class="form-check-label"> Musicalização</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="violao" class="form-check-label"> Violão/Guitarra</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="conjunto" class="form-check-label"> Prática de Conjunto</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="violino" class="form-check-label"> Violino</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="piano" class="form-check-label"> Piano</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="contrabaixo" class="form-check-label"> Contrabaixo</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="acordeon" class="form-check-label"> Acordeon</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="percussao" class="form-check-label"> Percussão</label></div>
                 <div class="col-md-6">
                <label><input type="radio" name="opicao1" value="percussao" class="form-check-label"> Saxofone/Flauta Transversal</label></div>
                </div>
                <br><br>


                <div class="row">
                 <div class="col-md-12"><h2>Escolha <strong>UMA</strong> das oficinas como segunda opção*:</h2><br></div>
               
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="atelie" class="form-check-label"> Desenho de Ateliê</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="quadrinho" class="form-check-label"> Desenho e Quadrinho</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="modelagem" class="form-check-label"> Modelagem em Argila</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="pintura" class="form-check-label"> Pintura</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="boi" class="form-check-label"> Boi de Mamão</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="bilro" class="form-check-label"> Renda de Bilro para Iniciantes</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="danca1" class="form-check-label"> Iniciação à Dança I</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="danca2" class="form-check-label"> Iniciação à Dança II</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="teatro" class="form-check-label"> Iniciação Teatral</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="canto" class="form-check-label"> Canto</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="cavaquinho" class="form-check-label"> Cavaquinho/Bandolim</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="musicalizacao" class="form-check-label"> Musicalização</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="violao" class="form-check-label"> Violão/Guitarra</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="conjunto" class="form-check-label"> Prática de Conjunto</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="violino" class="form-check-label"> Violino</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="piano" class="form-check-label"> Piano</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="contrabaixo" class="form-check-label"> Contrabaixo</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="acordeon" class="form-check-label"> Acordeon</label></div>
                <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="percussao" class="form-check-label"> Percussão</label></div>
                 <div class="col-md-6">
                <label><input type="radio" name="opicao2" value="percussao" class="form-check-label"> Saxofone/Flauta Transversal</label></div>
                </div>
   
        <div class="responsabilidade">
            <p><strong>*Todos os campos * são obrigatórios</strong></p>
            <p>**Qualquer necessidade de alteração na ficha de inscrição deve ser solicitada através do email: <strong>escolalivredeartesffc@gmail.com.</strong></p>
        </div>
          <input type="button" name="btnSubmit" id="btnSubmit" onclick="enviar();" class="btn btn-primary botao" value="Enviar" />
        
    </div>

    <div class="overlay"></div>
</div>
 </form>


</body>

  
  <script type="text/javascript" src="../../Biblioteca/js/buscarCep.js"></script>  
  <script type="text/javascript" src="../../Biblioteca/js/validadores.js"></script>  
  <script type="text/javascript">  
    $('#telefone').mask("(99)9999-9999");
    $('#celular').mask("(99)99999-9999");
    $('#nascimento').mask("99/99/9999");
    $('#cep').mask("99999-999");
    $('#cpf').mask("999.999.999-99");
    $('#pis').mask(" 999.99999.99-9");
   
    function enviar(){
    
        var $inputsText = $('form input:text');     
        var $habilidades = $("#frm1 input[name='habilidades[]']:checked");      
        var habilidadesChecked = '';
        var values = {};
        var err = '';
        var localImagem  = '../Cultura/EscolaLivreArtes/img/';
        var nTelefone = '';
        
        if( $habilidades.length == 0 ){
            alert("informe uma ou mais habilidades !");
            err = 'Tem';
            $("#frm1 input[name='habilidades[]']").focus();
        }
        
        if( $habilidades.length != 0 ){
        
            $habilidades.each( function(){
               habilidadesChecked += $(this).val() + ", ";
            });
            
            $inputsText.each( function() {                  
                if( $(this).hasClass('obrigatorio') &&  $(this).val() == "" && err !='Tem' ){                         
                    err = 'Tem';                
                    alert("Informe o " + $( '#lb'+$(this).attr('id') ).html() + " !");
                    $(this).focus();
                }
            });
        }
        
        if( !ePIS() && err !='Tem' ){
           $("#pis").focus();
           err = 'Tem';
           alert("Informe o número do PIS/PASEP corretamente !");          
        }       
      
        if( err !=  'Tem' ){        
        
            var obj = {
                habilidades    : habilidadesChecked,
                nome           : $('#nome').val(),
                nome2          : $('#nome2').val(),
                nome3          : $('#nome3').val(),
                rg             : limpezaDeDocumento( $('#rg').val() ),
                cpf            : limpezaDeDocumento( $('#cpf').val() ),
                pis            : limpezaDeDocumento( $('#pis').val() ),
                celular        : limpezaDeDocumento( $('#celular').val() ),
                telefone       : limpezaDeDocumento( $('#telefone').val() ),
                cep            : limpezaDeDocumento( $('#cep').val() ),
                nascimento     : ajustarData($('#nascimento').val()),
                especial       : $('#especial').val(),
                especial2      : $('#especial2').val(),
                emissor        : $('#emissor').val(),
                expedicao      : $('#expedicao').val(),
                logradouro     : $('#logradouro').val(),
                bairro         : $('#bairro').val(),
                municipio      : $('#municipio').val(),
                numero         : $('#numero').val(),
                email          : $('#email').val(),
                banco          : $('#banco').val(),
                agencia        : $('#agencia').val(),
                contaNum       : $('#contaNum').val(), 
                tipoConta      : $('#tipoConta').val(),
                curriculo      : $('#curriculo').val(),
                facebook       : $('#facebook').val(),
                youtube        : $('#youtube').val(),
                video          : $('#video').val(),
                codigoprojeto  : 'ELA'              
            };
            
            obj = $( this ).serialize() + "&" + $.param( obj );
                      
            $.ajax({            
                   type: "POST",
                   url: "../../banco/cadastrarELAProfessor.php",
                   dataType: "json",
                   data: obj,
                   success: function ( data ) {
                      document.getElementById("frm1").action = "../../banco/sucesso.php?telefone="+nTelefone+"&codigoprojeto=ELA&titulo=Franklin Cascaes&codigo="+data['codigo']+"&emailResposta=escolalivredeartesffc@gmail.com&localImagem="+ localImagem;
                      document.getElementById("frm1").submit();                             
                    },
                   
                   error: function ( data ) {
                      console.log(data);
                   }
                
            });
        }
    }   

     function ativarDIV(idDIV){
      
      document.getElementById(idDIV).style.display = 'block';
    
    }    
      
    </script>

</html>