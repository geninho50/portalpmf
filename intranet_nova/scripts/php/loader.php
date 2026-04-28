<style type="text/css">
div#loading{
	width:300px; 
	height:100px;
	border:3px solid #E9E5DA;
	position:absolute;
	background-color:#000;
	margin-left:100px;
	margin-top:10px;
	z-index:9999;
}

div#total{
	height: 105%;
	width: 100%;
	background-image:url(../layout/imagens/overlay.png);
	position: absolute;
	border:3px solid #E9E5DA;
	left: 0px;
	top: 0px;
	opacity: 0.80;
	z-index:9998;
}
</style>

<div id="total">
</div>
<div id="loading">
    <p align="center">
        <img src="../layout/imagens/loading.gif" border="0" /><br />
        <font color="#FFFFFF">
            <b>Aguarde - <?=$TmsgLoader?></b><br />
            <b>Esta operação pode levar alguns minutos!</b>
        </font>
    </p>
</div>