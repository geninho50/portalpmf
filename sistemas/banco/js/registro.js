function buscarRegistro(tabela,posicao,registro,titulo){
   var data;
   
    if( posicao == 'B' || posicao == 'PV' ){
       if( posicao == 'B' ){
           $('#divForm').css('display','none');
           $('#divTitulo').css('display','none');
           $('#divProcura').css('display','block');
       }else if( posicao == 'PV' ){
           $('#divForm').css('display','block');
           $('#divTitulo').css('display','block');
           $('#divProcura').css('display','none'); 
           $('#descricaoBusca').val('');
           $('#resultadoBusca').html('');
       }  
    }else{
			
      if( registro === "" ){
          registro = $('#codigo' ).val();
      }
      
      if( posicao === 'PB' ){
          data = {
              "registro":registro,
              "posicao":posicao,
              "tabela":tabela,
              "campo": $('#comboBusca').val(),
              "procura":$('#descricaoBusca').val(),
              "listaCampos": $('#listaCampos').val(),
              "campochave": $('#campochave').val()
          };        
      }else{
          data = {
              "registro": registro,
              "posicao": posicao,
              "tabela": tabela,
              "campochave":$('#campochave').val(),
			  "listaCampos": $('#listaCampos').val()
          };
      }  
 
      data = $( this ).serialize() + "&" + $.param(data);
     
      $.ajax( {
        type: "POST",
        dataType: "json",
        url: "../banco/buscarDados.php", 
        data: data,
        success: function( data ) {		   
		
           if(posicao !="PB"){
             atribuirInputs(data,tabela);
           }else{
             montarTabela(tabela,data,titulo);
           }  
        },
        error: function( data ){
           console.log( data );
        }
      } );
      
    }  
    return true;
}

function operacao( tipo, tabela, registro ){
  
  if( registro === "" ){
      registro = $('#codigo' ).val( );
  }
  
  if( tipo === 'novo' || tipo === 'editar' ){
      desativarBotao();
      if( tipo === 'novo' ){
         var campochave = $('#campochave').val();
         $('#frm input').val("");
         $('#frm textarea').val("");
         $('#codigo').val(registro);
         $('#campochave').val( campochave );
         $("#btnCEP").val("Buscar");
      } 
  }
  
  if( tipo === 'cancelar' ){
     ativarBotao();
     buscarRegistro( tabela, 'buscar', registro,'' );
  }

  if( tipo === 'salvar' || tipo === 'excluir' ){
    
     if( confirm('Deseja realmente '+tipo+' estes dados ?')){
       
        var jsonForm = ConvertFormToJSON('frm');
        var ultimaOperacao = $('#ultimaOperacao').val();
			 
        var data = {
            "registro" : registro,
            "posicao"  : tipo,
            "tabela"   : tabela,
            "ultimaOperacao": ultimaOperacao,
            "jsonForm" : jsonForm
        };
        
        data = $( this ).serialize() + "&" + $.param(data);
			 
        $.ajax( {
            type: "POST",
            dataType: "json",
            url: "../banco/buscarDados.php", 
            data: data,
            success: function( data ){
               console.log( "Sucesso : " + data );
               atribuirInputs(data,tabela); 
               desativarBotao();
            },
            error: function( data ){
               console.log( "Erro : " + data );
							 desativarBotao();
            }
        } );
       
     }
  }
  $('#ultimaOperacao').val(tipo);
  
}

function atribuirInputs( data, tabela  ){
  var chave = $('#campochave').val().toLowerCase();
  var i = 0;
    
  $.each( data, function( key, value ){
      // console.log(key+':'+value);
      if( key.toLowerCase() === 'nascimento' ){
          var str = value.toString(); 
          str = str.substring(8,10)+'/'+str.substring(5,7)+'/'+str.substring(0,4);
          $('#'+key.toLowerCase() ).val("");
          $('#'+key.toLowerCase() ).val( str );
      }else if( key.toLowerCase() === 'estado' || 
                key.toLowerCase() === 'unidade' || 
                key.toLowerCase() === 'codigogrupo' || 
                key.toLowerCase() === 'codigolinha' ){
                $("#"+key.toLowerCase()+" option[value='"+value+"']").attr("Selected", true);
      }else{
         if( key.toLowerCase() != 'erro :' ){
		   // alert( key.toLowerCase() );	 
           $('#'+key.toLowerCase() ).val("");
           $('#'+key.toLowerCase() ).val( value );
         }  
      }
    
      if( key.toLowerCase() === chave ){
          $('#codigo').val( value );
				  
				  if( tabela == "produtos" ){
							buscarImagens( value );
					}
      }
  } );
  
  // var codigo =  
  // $('#codigo').val( );
}

function montarTabela(tabela,data,titulo){
  
  var dadoTabela = "<table class='table table-striped table-bordered table-hover' cellspacing='0' border=1 >";
  var matriz;
  var arrayTitulo = titulo.split(",");
  var chave = $('#campochave').val( ).toUpperCase( );
  var codigoDados;
  
  dadoTabela +="<tr>";  
  
  $.each( arrayTitulo, function( key, value ) {
     dadoTabela += "<td align='center'><b>"+ value + "</b></td>";
     matriz = key;
   } );
  
  dadoTabela +="</tr>";
  
  if( matriz == 'erro' ){
      dadoTabela = "<table class='table table-striped table-bordered table-hover' cellspacing='0' border=1 >";
      dadoTabela += "<tr><td align='center'><b>Nenhum registro foi encontrado !</b></td>"; 
  }else{
       console.log( data );
       $.each( data[chave], function( keyLinha, valueLinha ) {
        dadoTabela +="<tr onMouseOver = \"this.style.cursor='pointer';\" ";
        dadoTabela +=" onClick = \"buscarRegistro('"+tabela+"','buscar'," + valueLinha + ",''); buscarRegistro('"+tabela+"','PV','',''); \" > ";
        /*
        tabela +="onMouseOut  = \"mOut(this,'white'); \" > ";
        tabela +="<tr>";
        alert( tabela );
        */
        $.each( data, function( key, value ) {
          dadoTabela += "<td align='center'>"+ data[ key ][ keyLinha ] + "</td>";
        });

        dadoTabela +="</tr>";

       } );
  }
  // alert( dadoTabela );
  dadoTabela += "</table>";
  $("#resultadoBusca").html( dadoTabela );
  
}

function ConvertFormToJSON(form){
  
  var array = $(frm).serializeArray();
  var json = {};
  
  jQuery.each(array, function() {
      json[this.name] = this.value || '';      
  });
  return json;
}

function desativarBotao(){
   $("#btnInicio").prop("disabled",true); 
   $("#btnVoltar").prop("disabled",true);
   $("#btnProxima").prop("disabled",true); 
   $("#btnUltimo").prop("disabled",true); 
  
   $("#btnProcurar").prop("disabled",true); 
   $("#btnNovo").prop("disabled",true);
   $("#btnEditar").prop("disabled",true);
   $("#btnCancelar").prop("disabled",false); 
   $("#btnExcluir").prop("disabled",true); 
   $("#btnSalvar").prop("disabled",false); 
}

function ativarBotao(){

   $("#btnInicio").prop("disabled",false); 
   $("#btnVoltar").prop("disabled",false);
   $("#btnProxima").prop("disabled",false); 
   $("#btnUltimo").prop("disabled",false); 
  
   $("#btnProcurar").prop("disabled",false); 
   $("#btnNovo").prop("disabled",false);
   $("#btnEditar").prop("disabled",false);
   $("#btnCancelar").prop("disabled",true); 
   $("#btnExcluir").prop("disabled",false); 
   $("#btnSalvar").prop("disabled",true); 
}

//Quando o campo cep perde o foco.
function buscarCEP() {

    //Nova variável "cep" somente com dígitos.
    var cep = $("#cep").val().replace(/\D/g, '');
    
    //Verifica se campo cep possui valor informado
    if ( cep !== "" && $("#logradouro").val() === "" )  {
      
         $("#btnCEP").val("Processando ...");  
      
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;
          
        //Valida o formato do CEP.
        if(validacep.test(cep)) {
              
            //Consulta o webservice viacep.com.br
            var urlCEP = "https://correiosapi.apphb.com/cep/" + cep;
         
            $.ajax( {
                type: "POST",
                dataType: "jsonp",
                url: urlCEP,
                crossDomain: true,
                contentType:"application/json",
                success: function( dados )  {
                    $("#logradouro").val(dados.tipoDeLogradouro+" "+dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#municipio").val(dados.cidade);
                    $("#estado").val(dados.estado);
                    $("#codigomunicipio").val(dados.ibge);                  
                },
                error : function(dados){
                    alert("Erro no retorno de dados !");
                }
            } );
          
            $("#btnCEP").val("Buscar");
          
        }
    } //end if.
 }

function buscarImagens(codigo){
  var mostrarTabela = "";
	
	var dataVariaveis = {
		  'teste'       : 'teste',
			"registro"    : codigo[0],
			"campochave"  : 'codigoProduto',
			"tabela"      : 'produtosImagem',
			"listaCampos" : 'localImagem as local, nomeImagem as nome, codigoImagem as codigo '
	};
  
	dataVariaveis = $( this ).serialize() + "&" + $.param(dataVariaveis);

	$.ajax( {
		type: "POST",
		dataType: "json",
		url: "../banco/buscarDados.php", 
		data: dataVariaveis,
		success: function( data ) {
						
			if( data["erro :"]  !="1" ){
						mostrarTabela = "<div class='row-fluid'><ul class='thumbnails'>";
						$.each( data["LOCAL"],function( key, value ) {
							 mostrarTabela += "<li class='span3'><input type='button'";
							 mostrarTabela += " class='btn btn-mini btn-danger' value=' X ' ";
							 mostrarTabela += " onclick='operacaoImagem(2,";
							 mostrarTabela += data["CODIGO"][ key ] + ");' > <a href='#' class='thumbnail inner-border'>";
							 mostrarTabela += "<span></span>";
							 mostrarTabela += "<img src =";
							 mostrarTabela += "'" + value + "' ></a></li>";
						} );
			}else{
				mostrarTabela = "";
			}
			
			if( mostrarTabela !="" ){
					mostrarTabela = mostrarTabela + "</ul></div>";
					$("#tabelaImagem").css("display","block");
					$("#mostrarImagens").css("display","block");
			}else{
					$("#tabelaImagem").css("display","none");
					$("#mostrarImagens").css("display","none");
			}
			
			$("#tabelaImagem").html( mostrarTabela );
		},
		error: function( data ){
			 console.log( data );
		}
	} );
  
}