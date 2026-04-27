<?php
    header('X-Frame-Options: GOFORIT'); 
?>

<html>

	<head> 
	</head>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<body>
		<iframe src="http://192.168.1.19/glpi/" id = "iframe" height="100%" width="100%"></iframe>
		
</body>

<script type="text/javascript">
		var troca = true;
		var src = [ 
			"http://192.168.1.19/glpi/plugins/projet/front/projet.php?sort=1&order=ASC&contains[0]=&searchtype[0]=contains&field2[0]=view&contains2[0]=&searchtype2[0]=contains&start=0", 
			"http://radar.ciasc.gov.br",
			"http://monitor.ciasc.gov.br",
			"http://192.168.1.19/nagios"
		];
		var i = 0;

	function mudar_iframe(){
		if(troca == true){
			if(i >= src.length){ i = 0; }
			document.getElementById("iframe").setAttribute("src", src[i]);
			i++
		}
	}

	setInterval(function () {mudar_iframe()}, 7000);

	$( "#iframe" ).mouseover(function() { 
		troca = false; 
		$("body").css("background", "black");
	});
	$( "#iframe" ).mouseout(function() { 
		troca = true; 
		$("body").css("background", "white");
	});
	
</script>