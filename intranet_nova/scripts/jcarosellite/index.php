<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1">
<title>JCAROSELLITE</title>
<style type="text/css">
.bannerprev {
	width: 23px;
	height: 47px;
	margin-top: -80px;
	float: left;
	position: absolute;
	background-image: url(btnPrevBanner.png);
	background-repeat:no-repeat;
	background-position: top;
	text-indent: -99999px;
	z-index: 999;	
}
.bannerprev:hover {
	background-position: bottom;	
}
.bannernext {
	width: 25px;
	height: 47px;
	margin-top: -80px;
	margin-left: 415px;
	position: absolute;
	border: 0;
	background-image: url(btnNextBanner.png);
	background-repeat: no-repeat;
	background-position: top;
	text-indent: -99999px;
	z-index: 999;	
}
.bannernext:hover {
	background-position: bottom;	
}
.banners li {
	margin:0;
	padding:0;
	list-style:none;
}
.banners ul {
	margin:0;
	padding:0;
	list-style:none;
}

</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jcarousellite.js"></script>
<script>
$(function() {
    $(".informativos").jCarouselLite({
        btnNext: ".infonext",
        btnPrev: ".infoprev",
		vertical: true,
		circular: false
    });
});

$(function() {
    $(".banners").jCarouselLite({
        btnNext: ".bannernext",
        btnPrev: ".bannerprev",
		auto: 2500,
 	    speed: 800,
		visible: 1
    });
});
</script>
</head>
<body>
	<div class="banners">
		<ul>
            <li><a href="diversos/Futebol 20102.pdf" target="_blank"><img src="5.jpg" width="440" height="100" border="0" /></a></li>
            <li><img src="6.jpg" width="440" height="100" border="0" /></li>            
            <li><img src="7.jpg" width="440" height="100" border="0" /></li>
		</ul>
	</div>
	<div class="bannerprev">Anterior</div>        
	<div class="bannernext">Proximo</div>
</body>
</html>
         
