<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PMMA</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="../js/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<body>
	<?php

    include_once("../../banco/gdb.php");

     $gdb = new gdb();  

     $select = "select idpmma as pmma,
		     		   p1,
					   p2,
				       p3,
				       situacao,
				       bairro,
				       p6,	
				       p7,
				       p8,
				       email,
				       receberemailsim,
				       percepcao1,
				       percepcao2,
				       percepcao3,
				       percepcao4,
				       percepcao5,
				       percepcao6,
				       percepcao7,
				       percepcao8,
				       percepcao9,
				       percepcao10,
				       percepcao11,
				       percepcao12,
				       percepcao13,
				       percepcao14,
				       percepcao15
				from  pmma
				order by idpmma;";


	$gdb->open($select);



     ?>

<div id="wrapper">
	<!-- end #menu -->
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">PMMA</a></h1>
		</div>
	</div>
	

		<div class="table-responsive">

			<table class="table table-striped table-bordered table-hover" width="" cellspacing="0" cellpadding="0" border="0">
						<? 
							foreach($gdb->gs['PMMA'] as $key=>$value){
								if ($nome != $value) {
									$nome = $value;
								?>
								  <tr>
								  	  <th scope="col" style="background-color: #668B8B; color: white;">P1</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">P2</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">P3</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">P4</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">P5</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">P6</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">P7</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">P8</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">Email</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">Receber Email?</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">2.1</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">2.2</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">2.3</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">2.4</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">2.5</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">2.6</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">2.7</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">3.1</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">3.2</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">3.3</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">3.4</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">3.5</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">3.6</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">3.7</th>
								      <th scope="col" style="background-color: #668B8B; color: white;">3.8</th>
								      

 								<!--	<td colspan="17" style="background-color: #668B8B; color: white;" align="left"><? print $value ?></td> -->
 								  </tr> 
 								  <?
									}; ?>
								
								<tr>	  
								   <td align="left"><? print $gdb->gs['P1'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['P2'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['P3'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['SITUACAO'][$key]; ?></td> 
								   <td align="center"><? print $gdb->gs['BAIRRO'][$key]; ?></td>
								   <td align="left"><? print $gdb->gs['P6'][$key]; ?></td> 
								   <td align="center"><? print $gdb->gs['P7'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['P8'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['EMAIL'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['RECEBEREMAILSIM'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO1'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO2'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO3'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO4'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO5'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO6'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO7'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO8'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO9'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO10'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO11'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO12'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO13'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO14'][$key]; ?></td>
								   <td align="center"><? print $gdb->gs['PERCEPCAO15'][$key]; ?></td>
								   
								</tr>

							<? }

							?>

					</table>


 	</div>

 </div>


<div id="copyright" class="container">
	<p><img src="../images/pmf.png" width="20%"><a href="http://www.pmf.sc.gov.br"></a></p>
	</div>

</body>

<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.maskedinput.min.js" type="text/javascript"></script>

</html>