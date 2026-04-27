<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");
$TidEntidade = $_SESSION['SuserEnt'];
$id			 = $_GET['aviso_id'];

//------------------
// Painel de avisos
//------------------
$TavisoSql	 = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id=$TidEntidade ORDER BY intranet_avisos_id DESC LIMIT 5";
$TretornoAvi = $drive->pedido($TavisoSql);

//----------------------------------------------------
// Seleciona os avisos de acordo com o usuario e o id
//----------------------------------------------------
$avisoSql	 = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id=$TidEntidade AND intranet_avisos_id=$id";
$retornoAvi  = $drive->pedido($avisoSql);

//-----------------
// Imprime o aviso
//-----------------
$aviso		  = pg_fetch_object($retornoAvi);
$idUserAviso  = $aviso->intranet_avisos_user_id;
$sqluserAviso = "SELECT user_nome FROM uni_usuarios WHERE user_id = $idUserAviso";
$TreturnUser  = $drive->pedido($sqluserAviso);
$nomeUser 	  = pg_fetch_object($TreturnUser);
if($aviso == false){
	echo "<script language= \"JavaScript\">
				location.href=\"inicio.php\"
			</script>";
	echo "<meta http-equiv='refresh' content=\"0;url='inicio.php\">";
	exit();
}else{
?>
    <div class="centro">      
        <div id="caminho_migalhas">intranet ></div>
        <div id="titulo_pagina"><?php echo $aviso->intranet_avisos_titulo; ?></div>    
        <div>
        	<div id="coluna_intranet_1">
                <div id="conteudo_pagina">
                <?php
                    echo "<b>Postado em:</b> ".inverteDateBd($aviso->intranet_avisos_data) ." &agrave;s ".$aviso->intranet_avisos_hora."<br>";
                    echo "<b>Por:</b> ".utf8_encode($nomeUser->user_nome)."<br /><br />";
                    echo $aviso->intranet_avisos_texto; 
                ?> 
                </div>
            </div><!-- fim coluna_intranet_1 --> 
            <div id="coluna_intranet_2">
            	<div id="painel_lateral">
                    <h1>avisos</h1>
                    <ul>
                        <?php
                        $i = 0;
                        while($avisoLista=pg_fetch_object($TretornoAvi)){
                            echo'
                                <li><a href="inicio.php?pagina=aviso&menu='.$_GET['menu'].'&aviso_id='.$avisoLista->intranet_avisos_id.'">'.$avisoLista->intranet_avisos_titulo.'</a></li>';
                            $i++;
                        }
                        echo'</ul>';
                        
                        if($i==0){
                            echo"
                                Acompanhe pela Intranet os &uacute;ltimos avisos e informa&ccedil;&otilde;es importantes da sua secretaria ou &oacute;rgão.
                            ";
                        }else{
                            echo"<br />
                                <a href=\"inicio.php?pagina=avisoconsulta\"><img src=\"../layout/imagens/intra_btn_mais.png\" border=\"0\" alt=\"mais\"></a>";	
                        }
                        ?>                                        
                </div>
            </div>    
        </div>
    </div>  
<?php } ?> 