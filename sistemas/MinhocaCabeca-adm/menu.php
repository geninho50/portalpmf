<?php
  function menu( $codigoUsuario ){
	  
    $gdb = new gdb();	  
   
	$gdb->open("   select count(*) as total 
                   from caixaEnvioMNC c 
				  Where ( select count(*) 
				            from  caixaRespostaMNC r 
						   where r.codigoMensagem = c.codigoMensagem and lido='n'	) > 0  
						     and c.codigoUsuario = '$codigoUsuario' "); 
  
    $numeroMensagem = $gdb->gs['TOTAL'][0]; ?>
	
	<nav id="menu">
		<ul class="links">					
			<li><a href="sistema.php?codigoUsuario=<?echo $codigoUsuario;?>">Inicio</a></li>		
			<li><a href="senhaSistema.php?codigoUsuario=<?echo $codigoUsuario;?>">Alterar senha</a></li>
			<li><a href="meusDados.php?codigoUsuario=<?echo $codigoUsuario;?>">Meus Dados</a></li>					
			<li><a href="certificado_oficina.php?codigoUsuario=<?echo $codigoUsuario;?>">Certificado da Oficina</a></li>
			<li><a href="caixa.php?codigoUsuario=<?echo $codigoUsuario;?>">Minha Caixa</a></li>
			<li <?php if( $numeroMensagem !=0 ){ print 'style="cursor:pointer;background:#C0C0C0;font-weight:bold;"'; } ?> ><a href="resposta.php?codigoUsuario=<?echo $codigoUsuario;?>">Mensagens<? if( $numeroMensagem !=0 ){ print "    (  <b>".$numeroMensagem." n&atilde;o lida(s)</b> )"; } ?></a></li>
			<li><a href="index.php?codigoUsuario=<?echo $codigoUsuario;?>">Sair</a></li>
		</ul>
	</nav>
<?php } ?>