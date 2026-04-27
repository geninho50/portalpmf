

<script type="text/javascript">

function verificaEmpresa(form){

	if(form.empresa.value==0){
		alert("Selecione uma Empresa de Ônibus");
		return false;
	}else
		return true;
	
}
function verificaTerminal(form){

	if(form.terminal.value==0){
		alert("Selecione um Terminal de Ônibus");
		return false;
	}else
		return true;
	
}


function stAba(menu,conteudo){
		this.menu = menu;
		this.conteudo = conteudo;
}

var arAbas = new Array();
arAbas[0] = new stAba('aba_empresas','conteudo_empresas');
arAbas[1] = new stAba('aba_terminais','conteudo_terminais');
arAbas[2] = new stAba('aba_trajetos','conteudo_trajetos');


function AlternarAbas(passo){
	
	document.getElementById('formPrincipal').passoGeral.value = passo;
	document.getElementById('formPrincipal').submit();
}

</script>


<div class="centro">
 <div id="cabecalho_onibus">
    <div id="caminho_migalhas">
    	home &gt; serviços
    </div>
    <div id="titulo_pagina">
    	consulta de hor&aacute;rios de &ocirc;nibus
    </div>     

	<div class="box_msg_baixo">
			Preencha os opções abaixo para consultar as linhas de ônibus disponíveis</div>
            
</div>
	<div id="area_servicos_onibus">
    <br> 
         <div class="box">

<?php 

	require_once("../scripts/php/funcoes_bd_onibus.php");
	$driveOnibus->conecta();
	$sql = "SELECT * FROM empresas ORDER BY nome_empresa";
	$resultado = $driveOnibus->pedido($sql);
	while($obj = pg_fetch_object($resultado)){
	
		$empNome = utf8_encode($obj->nome_empresa);
		$empId = $obj->empresa;
		$optionEmpresas.="<option value=\"$empId\" title=\"$empNome\">$empNome</option>";
	
	}

	$_consulta = pg_query("UPDATE linhas SET nome_linha = n.novo_nome FROM linhas_nomes n 
								WHERE n.codlinha = linha AND n.dataref <= current_date");

?>
    
    
 
    <div class="conteudo_abas_ext">
    
        <div id="conteudo_empresas">
 
            
            <form method="post" onsubmit="return verificaEmpresa(this)">
            <div class="texto_formulario"><strong>Empresa:</strong></div>
            <input type="hidden" name="passoGeral" value="1"/>
            <input type="hidden" name="passoEmpresa" value="1"/>
            <select name="empresa" class="componente_grande">
                <option value="0">== Selecione uma Empresa ==</option>
                <?=$optionEmpresas?>
            </select >
            <br><br>
            <div class="texto_formulario">
            	<strong>Consultar:</strong>
            </div>
            <input name="opcao" type="radio" value="1" title="todas as linhas da empresa" checked />Todas as linhas da empresa<br>
            <input name="opcao" type="radio" value="2" title="linha de número"/>Linha de número: 
            <input name="linhaNumero" type="text" class="componente_pequeno" maxlength="100" /><br>
            <input name="opcao" type="radio" value="3" title="linha de nome"/>Linha de nome (letreiro):
            <input name="linhaNome" type="text" class="componente_medio" maxlength="100" />
            <br /><br />
            <input type="image" src="../layout/imagens/serv_btn_buscar.png" align="absmiddle" />
            </form>  
            

        </div><!-- fim conteudo_empresas -->
    </div><!-- fim conteudo_abas_ext -->     
    
     </div><!-- fim box--> 
          
 
     <br />
    <?php 
	if($_POST['passoEmpresa']==1){
		
		$empresa = $_POST['empresa'];
		if($_POST['opcao']==1){
		
			$sql = "SELECT EMP.*,LIN.* FROM linhas AS LIN
					JOIN empresas AS EMP ON EMP.empresa = LIN.empresa
					WHERE LIN.empresa = $empresa 
					ORDER BY LIN.nome_linha";
		}else
		if($_POST['opcao']==2){
			$linhaNumero = $_POST['linhaNumero'];
			$sql = "SELECT EMP.*,LIN.* FROM linhas AS LIN
					JOIN empresas AS EMP ON EMP.empresa = LIN.empresa
					WHERE LIN.empresa = $empresa 
					AND 
					LIN.linha ILIKE '%$linhaNumero%'
					ORDER BY LIN.nome_linha";
					
		}else
		if($_POST['opcao']==3){
			
			$linhaNome = $_POST['linhaNome'];
			$sql = "SELECT EMP.*,LIN.* FROM linhas AS LIN
					JOIN empresas AS EMP ON EMP.empresa = LIN.empresa
					WHERE LIN.empresa = $empresa 
					AND 
					LIN.nome_linha ILIKE '%$linhaNome%'
					ORDER BY LIN.nome_linha";
			
		}
		
		
		$resultado = $driveOnibus->pedido($sql);
		$numLinhas = pg_num_rows($resultado);
		while($obj = pg_fetch_object($resultado)){
			$empNome = utf8_encode($obj->nome_empresa);
			$imprimir.="<li>$obj->linha - ".utf8_encode($obj->nome_linha)." |   
						<a href=\"index.php?pagina=onibuslinha&idLinha=$obj->linha&menu=2\">
							<img src=\"../layout/imagens/serv_btn_info.png\" alt=\"informações\" border=\"0\" align=\"absmiddle\" />
						</a>
						</li>  						
						";
			
		
		}
	?>
    <div id="resultados_busca">
        
    
        <h4>Número de linhas encontradas: <?=$numLinhas?></h4>                 
           
        <?php 
		if($numLinhas>0){
		?>   
        <br><br><br>
        <span class="titulo_empresa_onibus"><?=$empNome?></span><br><br> 
        <ul class="listagem">                                     
      	<?=$imprimir?> 
        </ul> 
      	<?php
		}
		?>
    
    </div><!-- fim resultados_busca -->  

    <?
	
	}
	?> 

</div>
</div><!-- fim coluna_C2 -->            



