<?php
  function menu( $codigoUsuario2 ){
	  
   $gdb = new gdb();	  
   
   $gdb->open("   select count(*) as total 
                   from caixaEnvioMNC c 
				  Where ( select count(*) 
				            from  caixaRespostaMNC r 
						   where r.codigoMensagem = c.codigoMensagem  ) = 0 ");						   
  
  $numeroMensagem = $gdb->gs['TOTAL'][0];
  
   // insertAcesso($ssid, $usid, $pagina, $entrada, $atualizacao, $ip, $sessaophp);

  ?>
	<nav id="menu">
		<ul class="links">
			<li><a href="sistemaAdmin.php?codigoUsuario=<?echo $codigoUsuario2;?>">Inicio</a></li>					
			<li><a href="meusDadosAdmin.php?codigoUsuario=<?echo $codigoUsuario2;?>">Meus Dados</a></li>					
			<li class="active"><a href="senhaSistemaAdmin.php?codigoUsuario=<?echo $codigoUsuario2;?>">Alterar senha</a></li>										
			<li><a href="filaEspera.php?codigoUsuario=<?echo $codigoUsuario2;?>">Fila de Espera</a></li>
			<li><a href="filaEsperaRevisao.php?codigoUsuario=<?echo $codigoUsuario2;?>">Fila de Espera Revisão</a></li>
			<li><a href="cursos.php?codigoUsuario=<?echo $codigoUsuario2;?>">Cursos</a></li>	
			<li><a href="participantes.php?codigoUsuario=<?echo $codigoUsuario2;?>">Participantes</a></li>
			<li><a href="participantesCaixas.php?codigoUsuario=<?echo $codigoUsuario2;?>">Caixas</a></li>
			<li><a href="cadastroUsuarios.php?codigoUsuario=<?echo $codigoUsuario2;?>">Cadastro de usuários</a></li>
			<li><?php  for( $x=0;$x<21;$x++ ) print '-'; ?></li>
			<li <?php if( $numeroMensagem !=0 ){ print 'style="cursor:pointer;background:#C0C0C0;font-weight:bold;"'; } ?> ><a href="mensagens.php?codigoUsuario=<?echo $codigoUsuario2;?>">Mensagens<? if( $numeroMensagem !=0 ){ print "    ( <b>".$numeroMensagem." não lida(s)</b> ) "; } ?></a></li>			
			<li><a href="../index.php?codigoUsuario=<?echo $codigoUsuario2;?>">Sair</a></li>
		</ul>
	</nav>
<?php } ?>	