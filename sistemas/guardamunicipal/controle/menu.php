
<div id="menu">
    <ul class="menu">
		<li><a href="recado_principal.php" class="parent"><span>Home</span></a>
        <?
		if( strlen($linha['adm']) > 0 && $linha['adm']=='S' )
		{
		?>
		<li><a href="#" class="parent"><span>Administrador</span></a>
			<ul>
				<li><a href="#" class="parent"><span>Escala</span></a>
                    <ul>
                        <li><a href="#" class="parent"><span>Hora Extra</span></a>
                            <ul>
                                <li><a href="cadastro_escala_horaextra.php"><span>Cadastro Escala</span></a></li>
                                <li><a href="administrar_escala_horaextra.php"><span>Adm Escala</span></a></li>
								<li><a href="cadastro_faltas.php"><span>Cadastro de Falta</span></a></li>
								<li><a href="#"><span>Imprimir Escala</span></a></li>
								<li><a href="#" class="parent"><span>Adm Escala 100%</span></a>
									<ul>
										<li><a href="cadastro_intervalo.php"><span>Cadastro Intervalo</span></a></li>
										<li><a href="administrar_horaextra.php"><span>Gerenciar Escala 100%</span></a></li>
									</ul>
								</li>
                            </ul>
                        </li>
						<li><a href="cadastro_horaextra_off.php"><span>Hora Extra Off</span></a></li>
						<li><a href="#" class="parent"><span>Publicacoes Escala</span></a>
                            <ul>
                                <li><a href="cadastro_publicar_escala.php"><span>Publicar</span></a></li>
                                <li><a href="busca_publicar_escala.php"><span>Consultar</span></a></li>
                            </ul>
                        </li>
						<li><a href="#" class="parent"><span>Consultar Hora</span></a>
                            <ul>
                                <li><a href="busca_horatotal.php"><span>Consultar Hora Total</span></a></li>
                                <li><a href="busca_valores_horaextra.php"><span>Valor Pago Hora Extra</span></a></li>
								<li><a href="busca_media_geral.php"><span>Media Geral</span></a></li>
								<li><a href="listar_escala_media_qtd.php"><span>Lista Media/Qtd Escala</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
				<li><a href="#" class="parent"><span>Recados</span></a>
					<ul>
                         <li><a href="cadastro_recado.php"><span>Cadastro Recados</span></a></li>
                         <li><a href="busca_recado.php"><span>Consultar Recados</span></a></li>
                    </ul>
				</li>
				<li><a href="#" class="parent"><span>Servicos Online</span></a>
					<ul>
                         <li><a href="administrar_servicos_online.php"><span>Administrar</span></a></li>
                         <li><a href="cadastro_folga.php"><span>Cadastrar Folgas</span></a></li>
						 <li><a href="cadastro_coletivo_folga.php"><span>Cadastrar Folgas Coletivas</span></a></li>
						 <li><a href="#" class="parent"><span>Consultas</span></a>
						 	<ul>
								 <li><a href="busca_troca_servico.php"><span>Troca Servico</span></a></li>
								 <li><a href="busca_doacao_sangue.php"><span>Doacao Sangue</span></a></li>
								 <li><a href="busca_folga.php"><span>Folgas</span></a></li>
								 <li><a href="busca_pedido_folga.php"><span>Folgas Entre Datas</span></a></li>
							</ul>
						 </li>
                    </ul>
				</li>
				<li><a href="#" class="parent"><span>Atividade Extra</span></a>
					<ul>
						 <li><a href="cadastro_atividade_extra.php"><span>Cadastro Atividades</span></a></li>
						 <li><a href="busca_atividade_extra.php"><span>Consultar Atividades</span></a></li>
					</ul>
				</li>
				<li><a href="#" class="parent"><span>Monografia</span></a>
					<ul>
						 <li><a href="cadastro_monografia.php"><span>Cadastro Monografia</span></a></li>
						 <li><a href="busca_monografia.php"><span>Consultar Monografia</span></a></li>
					</ul>
				</li>
				
						<li><a href="#" class="parent"><span>Funcionario</span></a>
							<ul>
								<li><a href="busca_funcionario.php"><span>Consultar Senha</span></a></li>
								<li><a href="#"><span>Permissoes</span></a></li>
							</ul>
						</li>
						<li><a href="#" class="parent"><span>Valores</span></a>
							<ul>
								<li><a href="#"><span>Cadastro Valores</span></a></li>
								<li><a href="busca_informacoes_valores.php"><span>Consultar Valores</span></a></li>
							</ul>
						</li>
						<li><a href="#" class="parent"><span>Nivel</span></a>
							<ul>
								<li><a href="cadastro_nivel.php"><span>Cadastro Nivel</span></a></li>
								<li><a href="buscar_nivel.php"><span>Consultar Nivel</span></a></li>
							</ul>
						</li>
                        <li><a href="cadastro_enquete.php"><span>Enquete</span></a></li>
						<!-- <li><a href="#" class="parent"><span>Manutecao</span></a>
							<ul>
								<li><a href="#"><span>Cadastro Computador</span></a></li>
								<li><a href="#"><span>Consultar Computador</span></a></li>
								<li><a href="#"><span>Cadastro Chamado</span></a></li>
								<li><a href="#"><span>Listar Chamado</span></a></li>
							</ul>
						</li>-->
					</ul>
				</li>
		<?
		}
		if( strlen($linha['comando']) > 0 && $linha['comando']=='S' )
		{
		?>
		<li><a href="#" class="parent"><span>Comando</span></a>
            <ul>
				<li><a href="publicacoes_escala.php"><span>Publicacoes de Escala</span></a></li>
                <li><a href="#" class="parent"><span>Recados</span></a>
					<ul>
                         <li><a href="busca_recado.php"><span>Consultar Recados</span></a></li>
                    </ul>
				</li>
				<li><a href="#" class="parent"><span>Servicos Online</span></a>
					<ul>
                         <li><a href="administrar_servicos_online_chefe.php"><span>Administrar</span></a></li>
						 <li><a href="#" class="parent"><span>Consultas</span></a>
						 	<ul>
								 <li><a href="busca_troca_servico.php"><span>Troca Servico</span></a></li>
								 <li><a href="busca_doacao_sangue.php"><span>Doacao Sangue</span></a></li>
								 <li><a href="busca_folga.php"><span>Folgas</span></a></li>
								 <li><a href="busca_pedido_folga.php"><span>Folgas Entre Datas</span></a></li>
							</ul>
						 </li>
                    </ul>
				</li>
                <li><a href="#" class="parent"><span>Atividade Extra</span></a>
					<ul>
						 <li><a href="busca_atividade_extra.php"><span>Consultar Atividades</span></a></li>
					</ul>
				</li>
				<?
				if( strlen($linha['zonaazul']) > 0 && $linha['zonaazul']=='S' )
				{
				?>
				<li><a href="#" class="parent"><span>Zona Azul</span></a>
					<ul>
						<li><a href="cadastro_agente_zonaazul.php"><span>Cadastro Agente</span></a></li>
						<li><a href="busca_agente_zonaazul.php"><span>Consultar Agente</span></a></li>
						<li><a href="administrar_agente_zonaazul.php"><span>Administrar</span></a></li>
					 	<li><a href="cadastro_recado_agente.php"><span>Cadastro Recado</span></a></li>
						<li><a href="busca_recado_agente.php"><span>Consulta Recado</span></a></li>
						<li><a href="cadastro_anotacao.php"><span>Cadastro Anotacoes</span></a></li>
					</ul>
				</li>
				<?
				}
				/*if( strlen($linha['controleatestado']) > 0 && $linha['controleatestado']=='S' )
				{
				?>
				<li><a href="#" class="parent"><span>Controle Atestado</span></a>
					<ul>
						 <li><a href="#"><span>Administrar</span></a></li>
						 <li><a href="#"><span>Visualizar</span></a></li>
					</ul>
				</li>
				<?
				}*/
				?>
            </ul>
        </li>
		<?
		}
		/*if( strlen($linha['setorpessoal']) > 0 && $linha['setorpessoal']=='S' )
		{
		?>
		<li><a href="#" class="parent"><span>Setor Pessoal</span></a>
            <ul>
                <li><a href="#"><span>Cadastro Funcinario</span></a></li>
 			</ul>
        </li>
		<?
		}*/
		if( strlen($linha['guardaonline']) > 0 && $linha['guardaonline']=='S' )
		{
		?>
		<li><a href="#" class="parent"><span>Guarda Online</span></a>
            <ul>
                <li><a href="listar_escala_horaextra.php"><span>Hora Extra</span></a></li>
                <li><a href="publicacoes_escala.php"><span>Publicacoes de Escala</span></a></li>
				<li><a href="listar_atividade_extra.php"><span>Atividade Extra</span></a></li>
				<li><a href="cadastro_troca_servico.php"><span>Troca de Servico</span></a></li>
				<li><a href="listar_pedido_folga.php"><span>Pedido de Folga</span></a></li>
				<li><a href="cadastro_doacao_sangue.php"><span>Doacao de Sangue</span></a></li>
				<li><a href="listar_ocorrencias.php"><span>Ocorrencias</span></a></li>
				<li><a href="atualiza_senha.php"><span>Alterar Senha</span></a></li>
				<li><a href="cadastro_usuario_acesso.php"><span>Alterar Login de Acesso</span></a></li>
				<li><a href="listar_monografia.php"><span>Monografia GMs</span></a></li>
				<li><a href="busca_livros_usuario.php"><span>Biblioteca Online</span></a></li>
				<!--<li><a href="cadastro_ferias_agente.php"><span>Controle de Ferias</span></a></li>-->
                <li><a href="cadastro_dados_email.php"><span>Dados Adicionais</span></a></li>
				
                <li><a href="#" class="parent"><span>Comunicacao Interna</span></a>
                    <ul>
                        <li><a href="cadastro_comunicacao_interna.php"><span>Cadastrar CI</span></a></li>
                        <li><a href="acompanhar_ci.php"><span>Acompanhar Ci</span></a></li>
                    </ul>
                </li>
                
                <li><a href="#" class="parent"><span>Caixa de Recado</span></a>
                    <ul>
                        <li><a href="recado_principal.php"><span>Recados</span></a></li>
                        <li><a href="cadastro_recado_direto.php"><span>Compor Recado</span></a></li>
                    </ul>
                </li>
                <?
				if( strlen($linha['agentezonaazul']) > 0 && $linha['agentezonaazul']=='S' )
				{
				?>
				<li><a href="#" class="parent"><span>Zona Azul</span></a>
                    <ul>
                        <li><a href="adicionar_agente_zonaazul.php"><span>Cadastro Hora</span></a></li>
                    </ul>
                </li>
				<?
				}
				?>
                <!---<li><a href="busca_enquete.php"><span>Enquete</span></a></li>-->
 			</ul>
        </li>
		<?
		}
		if( strlen($linha['educacao']) > 0 && $linha['educacao']=='S' )
		{
		?>
		<li><a href="#" class="parent"><span>Educacao</span></a>
            <ul>
                <li><a href="#" class="parent"><span>Biblioteca</span></a>
					<ul>
                        <li><a href="cadastro_livro.php"><span>Cadastro de Livro</span></a></li>
                        <li><a href="busca_livros.php"><span>Consultar Livro</span></a></li>
						<li><a href="listar_reservas_livro.php"><span>Listar Reservas</span></a></li>
						<li><a href="listar_devulucao_livro.php"><span>Receber Livro</span></a></li>
                    </ul>
				</li>
 			</ul>
        </li>
		<?
		}
		if( strlen($linha['transporte']) > 0 && $linha['transporte']=='S' )
		{
		?>
		<li><a href="#" class="parent"><span>Transporte Solidario</span></a>
            <ul>
                <li><a href="administrar_transporte.php"><span>Adm Transporte</span></a></li>
				<li><a href="relatorio_mes.php"><span>Relatorio</span></a></li>
 			</ul>
        </li>
		<?
		}
		?>
		<li><a href="../classes/processaLogout.php" class="parent"><span>Logout</span></a>
    </ul>
</div>
<div><a href="http://apycom.com/"></a></div>


