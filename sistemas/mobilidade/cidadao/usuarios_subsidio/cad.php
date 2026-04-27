<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Meu Cadúnico</title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <script>
        if (location.protocol != 'https:') {
            location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
        }
    </script>

    <link href="./lib/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./lib/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="./css/styles_layout.css" rel="stylesheet">
    <link href="./lib/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./lib/jquery/jquery-ui.css">

    <link rel="shortcut icon" href="ico/favicon.png">

    <script type="text/javascript" src="./js/funcoes.js">
</script>

</head>

<body role="document">
    <div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
        <ul id="menu-barra-temp" style="list-style:none;">
            <li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED">
                <a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a>
            </li>
            <li>
            <a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a>
            </li>
        </ul>
    </div>

    
    <div class="navbar navbar-static-top  menu-app-sagi4" role="banner" id="a5833c85c7f6f04f5cd8632eb16d1490">

        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Alternar navegação<</span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="index.php">Meu Cadúnico</a>

            </div>


            <div class="collapse navbar-collapse navbar-ex1-collapse" id="">



                <ul class="nav navbar-nav " id="">
                    <li id="goBcps1">
                        <a href="index.php" alt="Página Inicial" title="Página Inicial"><i class="fa fa-home fa-lg"></i></a>
                    </li>
                    <li><a href="index.php" alt="Ir para a Página Inicial" title="Ir para a Página Inicial">Página Inicial</a></li>
                    <!-- <li><a href="index.php">Busca Nome</a></li> -->
                    <li><a href="form_valida.php">Validar</a></li>
                    <li><a href="manual/manual_consulta_cidadao.pdf">Manual</a></li>

               
                </ul>
                <ul class="nav navbar-nav navbar-right" style="margin-right: 0px;">

                    <li id="goBcps">
                        <a href="#" onclick="goBcps();" alt="Fale Conosco" title="Fale Conosco"><i class="fa fa-envelope fa-lg"></i></a>
                    </li>
                    

                </ul>


                <ul class="nav navbar-nav navbar-right ">
                </ul>

            </div>
            <!--/.nav-collapse -->




        </div>

    </div>

    <div class="container container-da-applicacao-principal"> <!--container container-da-->
            

<div class="container row local-applicacao-meu-cad">				
	<div class="col-md-6 col-md-offset-3">				
		<div style='text-align:center;'>
			<img class="img-responsive"  src="imagens/consulta_cidadao004.png" height='122' width='450'>
        </div>
				
				<!-- <h4>Meu Cadúnico - Cadastro Único</h4> -->
				<p> Para mais detalhes consulte o <a href="manual/manual_consulta_cidadao.pdf">Manual de uso</a>.</p><br>

<div>
	<b>Consulte o seu NIS através do aplicativo Meu CadÚnico</b>
	<p>Se você está cadastrado no Cadastro Único para Programas Sociais e deseja consultar qual o seu Número de Identificação Social(NIS), faça a instalação do aplicativo para smartphone Meu CadÚnico.</p>
	<p>
	<a href='https://play.google.com/store/apps/details?id=br.gov.mds.cadastrounico&hl=pt_BR&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img width=150 alt='Disponível no Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/pt_badge_web_generic.png'/></a> 
	<a href='https://itunes.apple.com/br/app/meu-cad%C3%BAnico/id1405740503?mt=8'><img width=120 alt='Baixar na App Store' src='imagens/Download_on_the_App_Store_Badge_PTBR_RGB_blk_092917.png'/></a> 
	</p>
</div>

			
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
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="6LeX7CgUAAAAAFuUGUbOXNUramCrv0eK7fAnH1QT"></div>
						</div>
						<input type="submit" value="Emitir Certidão" class="btn btn-primary btn-lg center-block">
					</form>
				  </div>
				  
				  <div id="validar" class="tab-pane fade">
					<h4>Informe os dados abaixo para validar o comprovante de cadastramento:</h4>

					<form method="post" action="emitir_certidao.php">
						<!--
						<div class="form-group">
							<label for="fname">NIS:</label>
							<input type="text" class="form-control" name="fname" id="fname" placeholder="NIS..." size="50">
						</div>
						-->
						<div class="form-group">
							<label for="fname" >Informe a chave da segurança do comprovante de cadastramento:</label>
							<input type="text" class="form-control" name="fname" id="fname" placeholder="Informe a chave da segurança .."  lenght="10">					    
						</div>
						<input type="submit" align="center" value="Validar" class="btn btn-primary center-block">	
					</form>
				  </div>
				</div>
			</div>			
		</div>

        <div class="voltar-ao-topo">
            <a href="#" onclick="toTop()" alt="Clique para ir para o início da tela" title="Clique para ir para o início da tela"><i class="fa fa-chevron-up"></i>
                Ir para o Topo</a>
        </div>

        </div> <!-- /<div class="container container-da-applicacao-principal"> -->


        <footer class="bs-docs-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <a href="http://cidadania.gov.br/"><img src="./imagens/mds_branco.png" style="height: 60px" /></a>
                    </div>
                    <div class="col-md-2">
                        <a href="https://aplicacoes.mds.gov.br/sagi"><img src="./imagens/sagi_branco.png" width="" /></a>
                    </div>
                </div>
            </div>
        </footer>
        <div class="footer-logos" id="footer-brasil">
            <div id="wrapper-footer-brasil"><a href="http://www.acessoainformacao.gov.br/">
                    <span class="logo-acesso-footer"></span></a><a href="http://www.brasil.gov.br/">
                    <span class="logo-brasil-footer"></span></a></div>
        </div>
        <div id='local-janela'></div>

        <!-- Le javascript
            ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!-- <script type='text/javascript' src='http:///layout2014/js/jquery/1.11.2/jquery.min.js'></script> -->
        <script type='text/javascript' src='./lib/jquery/jquery.min.js'></script>

        <!-- <script src="./jquery/jquery-1.10.2.js"></script> -->
        <script src="./lib/jquery/jquery-ui.js"></script>

        <script type='text/javascript' src='./lib/bootstrap-3.3.6-dist/js/bootstrap.min.js'></script>

        	
<script>

$(document).ready(function(){    

	
var titulo = '<h3 class="text-info">Auxílio Emergencial ao Cidadão</h3>';

var txt='';

txt='<p><i class="fa fa-info-circle text-info"></i>&nbsp;Já está disponível o aplicativo para do Auxílio Emergencial, destinado aos trabalhadores informais,';
txt+=' microempreendedores individuais (MEI), autônomos e desempregados, que tem por objetivo fornecer ';
txt+=' proteção emergencial no período de enfrentamento à crise causada pela pandemia do Coronavírus – COVID 19.</p>';
txt+='<br><p><a href="https://auxilio.caixa.gov.br/">Se você está em busca do aplicativo utilize o botão abaixo</a> para ir diretamente para o site da caixa e ter ';
txt+='acesso a plataforma. Caso contrário, utilize o link logo abaixo para continuar na consulta do Meu Cadúnico.</p>';

txt+='<br><br><div>';
	txt+='<a style="text-align:center" href="https://auxilio.caixa.gov.br/" title="Ir para a plataforma do Auxílio Emergencial ao Cidadão">';
		txt+='<img style="display: block;margin-left: auto; margin-right: auto" src="./imagens/app-caixa.png" alt="Página de acesso ao cadastramento do aplicativo da Caixa"/>';
	txt+='</a>';
txt+='</div>';

txt+='<br><div style="text-align: center">';
	txt+='<a href="#" title="Permanecer na página do Meu Cadúnico" data-dismiss="modal" aria-label="Close">';
		txt+='Permanecer na página do Meu Cadúnico'
	txt+='</a>';
txt+='</div>';

//Não exibe mais a janela modal falando do auxílio
//setTimeout(() => {
	// abreJanelaModalTexto(titulo, txt,'',false,function(){	
	// });	
//}, 250);


	


}); 




$(function() {
	$( "#datepicker1" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "1900:",
		monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
		dateFormat: 'dd/mm/yy',
		dayNamesShort: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Sx', 'Sa'],
		dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Sx', 'Sa'],		
		regional: "pt"  
	});
});
$(function() {
	$( "#datepicker2" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "1900:",
		monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
		dateFormat: 'dd/mm/yy',
		dayNamesShort: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Sx', 'Sa'],
		dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Sx', 'Sa'],		
		regional: "pt"  
	});
});

</script>

        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-17852265-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </body>