
<!DOCTYPE html>
<html lang="pt-br">

<head>


<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/bas/js/javascriptpersonalizado.js"></script>
    <script type="text/javascript" src="/bas/js/javascript_frota.js"></script>
    <script src="/bas/js/sorttable.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.quick.search.js"></script>
    <script type="text/javascript" src="/home/www/sistemas/redemobilidade/cidadao/moradores_costa/js/jquery.js"></script>
    <script type="text/javascript" src="/bas/js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="/bas/js/formrules.js"></script>
    <script src="/bas/js/cep.js"></script> <!-- análise de CEP !-->
    <script src="/bas/js/masks.js"></script> <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="/bas/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/bas/js/jquery-ui.min.js"></script>
    <script src="https://compressjs.herokuapp.com/compress.js"></script>


    <script>
    //      if (location.protocol != 'https:') {
    //         location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
    //      }
    </script>
</head>			
				<ul class="nav nav-tabs">
					<li><a data-toggle="tab" href="#emitir">Busca por nome</a></li>
<!--					
					<li class="active"><a data-toggle="tab" href="#busca">Busca por documento</a></li>
					<li><a data-toggle="tab" href="#validar">Validar Comprovante</a></li>
-->				  
				</ul>

				  <div id="emitir" class="" style="margin-top:20px">
				  
					<form name="emitir-certidao" action="busca_nome.php" method="POST" data-ajax="false">
						<div class="form-group">
							<label for="fname" value="$_REQUEST['nome']">Nome Completo:</label>
							<input type="text" name="nome" required="required" id="nome" class="form-control" style="text-transform:uppercase;" placeholder="Nome completo..." size="50" value="">
						</div>						
						<div class="form-group">
							<label for="fname" >Data de Nascimento:</label>
							<input type="text" name="dt_nascimento" required="required" class="form-control" id="datepicker1" placeholder="Data de nasc.no formato dd/mm/aaaa"  maxlength="12" class="hasDatepicker" value="">
						</div>		
						
						<div class="form-group">
							<label for="fname" >Nome da Mãe:</label>
							<input type="text" name="mae" class="form-control" id="mae" style="text-transform:uppercase;" placeholder="Nome da mãe..." size="50" value="">
						</div>
						<div class="form-group">
							<label for="fname" >Informe estado e município:</label>
							<div class="form-group">
								
								
								
							<table style="width: 100%">
									
									<tr>
										<td style="width:200px">											
											<select name='uf_ibge' style='width: 160px' id='uf_ibge' class="form-control" onChange="selecionaEstado()">												
												<option value=""></option>
												<option value="12">AC  - ACRE</option>
												<option value="27">AL  - ALAGOAS</option>
												<option value="13">AM  - AMAZONAS</option>
												<option value="16">AP  - AMAPÁ</option>
												<option value="29">BA  - BAHIA</option>
												<option value="23">CE  - CEARÁ</option>
												<option value="53">DF  - DISTRITO FEDERAL</option>
												<option value="32">ES  - ESPÍRITO SANTO</option>
												<option value="52">GO  - GOIÁS</option>
												<option value="21">MA  - MARANHÃO</option>
												<option value="31">MG  - MINAS GERAIS</option>
												<option value="50">MS  - MATO GROSSO DO SUL</option>
												<option value="51">MT  - MATO GROSSO</option>
												<option value="15">PA  - PARÁ</option>
												<option value="25">PB  - PARAÍBA</option>
												<option value="26">PE  - PERNAMBUCO</option>
												<option value="22">PI  - PIAUÍ</option>
												<option value="41">PR  - PARANÁ</option>
												<option value="33">RJ  - RIO DE JANEIRO</option>
												<option value="24">RN  - RIO GRANDE DO NORTE</option>
												<option value="11">RO  - RONDÔNIA</option>
												<option value="14">RR  - RORAIMA</option>
												<option value="43">RS  - RIO GRANDE DO SUL</option>
												<option value="42">SC  - SANTA CATARINA</option>
												<option value="28">SE  - SERGIPE</option>
												<option value="35">SP  - SÃO PAULO</option>
												<option value="17">TO  - TOCANTINS</option>
											</select>
											
										</td>
										<td>
											<div id='selector_municipiosSAGIUF'>
												<select name='p_ibge' id='p_ibge' class="form-control" style="dislay:" disabled="disabled">
													
												</select>
											</div>
										</td>
									</tr>
								</table>




							</div>
						</div>
						
						<input type="submit" value="Emitir Certidão" class="btn btn-primary btn-lg center-block">
					</form>
	

        	
<script>


function selecionaEstado(){
    let uf = $("#uf_ibge").val();

    $("#p_ibge").empty(); //
    $('#p_ibge').append($('<option>', {
        value: "carregando...",
        text: ''
    }));

    // $("#p_ibge").attr("disabled","true");

    if(parseInt(uf)>0){
        let url = "municipios.php";
        $.ajax({
            "url":url,
            "type":"POST",
            "dataType":"json",
            "data":{"uf":uf},
            success:function(obj){
                if(!obj)
                    return false;

                if(obj.lenth<=0)
                    return false;
                
                $('#p_ibge').append($('<option>', {
                    value: "",
                    text: ''
                }));

                for(var i=0; i<obj.length;i++){
                    let str = obj[i];
                    let arr = str.split(';');
                    let codigo=arr[0];
                    let nome=arr[1];

                    if(!codigo && !nome)
                        continue;
                    
                        $('#p_ibge').append($('<option>', {
                            value: codigo,
                            text: nome
                        }));
                }
                $("#p_ibge").removeAttr("disabled");
            }
        })
    }
}

</script>

    </body>
</html>