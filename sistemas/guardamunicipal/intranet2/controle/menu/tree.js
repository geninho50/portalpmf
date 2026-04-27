var bAdm = false;
var bPlanejamento = false;
var bChefia = false;
var bGuarda = false;
var bSetorPessoal = false;
var bRondaEscolar = false;
var bDigitacao = false;
var bCentral = false;

// Sets do Menu Principal
function setAdm(valor)
{
	bAdm= valor;
}
function setPlanejamento(valor)
{
	bPlanejamento = valor;
}
function setChefia(valor)
{
	bChefia = valor;
}
function setGuarda(valor)
{
	bGuarda = valor;
}
function setSetorPessoal(valor)
{
	bSetorPessoal = valor;
}
function setRondaEscolar(valor)
{
	bRondaEscolar = valor;
}
function setDigitacao(valor)
{
	bDigitacao = valor;
}
function setCentral(valor)
{
	bCentral = valor;
}
function setDigital(valor)
{
	bDigital = valor;
}
function setLogistica(valor)
{
	bLogistica = valor;
}


function criaMenu()
{
	if (document.getElementById)
	{
		var gmf = new WebFXTree('SIGA');
		gmf.setBehavior('classic');

		if( bAdm == true )
		{
			var adm = new WebFXTreeItem('Administrador');
            gmf.add(adm);
				var funcionario = new WebFXTreeItem('Funcionário');
					adm.add(funcionario);
					var valores = new WebFXTreeItem('Valores');
						funcionario.add(valores);
						valores.add(new WebFXTreeItem('Cadastro Valores','cadastro_valores.php','','menu/images/novoitem.gif','','principal'));
						valores.add(new WebFXTreeItem('Cadastro Cargo','cadastro_cargo.php','','menu/images/novoitem.gif','','principal'));
						valores.add(new WebFXTreeItem('Cadastro Chave','listar_guarda_chave.php','','menu/images/novoitem.gif','','principal'));
						valores.add(new WebFXTreeItem('Lista Média/Qtd Horas','busca_informacoes_valores.php','','menu/images/pesquisar.gif','','principal'));
					var nivel = new WebFXTreeItem('Nivel');
						funcionario.add(nivel);
						nivel.add(new WebFXTreeItem('Cadastro Nível','cadastro_nivel.php','','menu/images/novoitem.gif','','principal'));
						nivel.add(new WebFXTreeItem('Consultar Nível','busca_nivel.php','','menu/images/pesquisar.gif','','principal'));
				var permissao = new WebFXTreeItem('Permissão');
					adm.add(permissao);
					permissao.add(new WebFXTreeItem('SIGA','cadastro_funcionario.php','','menu/images/novoitem.gif','','principal'));
					permissao.add(new WebFXTreeItem('Serviços Online','permissao_servicoonline.php','','menu/images/novoitem.gif','','principal'));
					permissao.add(new WebFXTreeItem('Gerar MD5','gerar_md5.php','','menu/images/novoitem.gif','','principal'));
				var sistema = new WebFXTreeItem('Sistema');
					adm.add(sistema);
					sistema.add(new WebFXTreeItem('Cadastro Grupo','cadastro_grupo.php','','menu/images/novoitem.gif','','principal'));
		}
		
		
		if( bPlanejamento == true )
		{
			var adm = new WebFXTreeItem('Planejamento');
            gmf.add(adm);

				var escala = new WebFXTreeItem('Escala');
					adm.add(escala);
					
					var hora = new WebFXTreeItem('Hora Extra');
							escala.add(hora);
							hora.add(new WebFXTreeItem('Cadastrar Escala','cadastro_escala_horaextra.php','','menu/images/novoitem.gif','','principal'));
							hora.add(new WebFXTreeItem('Adm Escala','administrar_escala_horaextra.php','','menu/images/novopreso.gif','','principal'));
							hora.add(new WebFXTreeItem('Cadastrar Falta','cadastro_faltas.php','','menu/images/novoitem.gif','','principal'));
							hora.add(new WebFXTreeItem('Imprimir Escala','imprimir_escala_horaextra.php','','menu/images/impressora4.jpg','','principal'));
							hora.add(new WebFXTreeItem('Hora Off-line','cadastro_horaextra_off.php','','menu/images/novoitem.gif','','principal'));
					var final = new WebFXTreeItem('Publicações de Escala');
						escala.add(final);
						final.add(new WebFXTreeItem('Publicar','cadastro_extras_banco.php','','menu/images/novoitem.gif','','principal'));
						final.add(new WebFXTreeItem('Consultar','busca_extras_banco.php','','menu/images/pesquisar.gif','','principal'));
						final.add(new WebFXTreeItem('Consultar','publicacoes_escala.php','','menu/images/pesquisar.gif','','principal'));

					var hora = new WebFXTreeItem('Consultar Hora');
						escala.add(hora);
						hora.add(new WebFXTreeItem('Consultar','busca_horatotal.php','','menu/images/pesquisar.gif','','principal'));
						hora.add(new WebFXTreeItem('Valores Pago Hora Extra','busca_valores_horaextra.php','','menu/images/pesquisar.gif','','principal'));
						hora.add(new WebFXTreeItem('Soma Geral','busca_media_geral.php','','menu/images/pesquisar.gif','','principal'));
					
					var servico = new WebFXTreeItem('Servicos Online');
						adm.add(servico);
						servico.add(new WebFXTreeItem('Administrar','administrar_servicos_online.php','','menu/images/novopreso.gif','','principal'));
						servico.add(new WebFXTreeItem('Cadastrar Folgas','cadastro_folga.php','','menu/images/novoitem.gif','','principal'));
						servico.add(new WebFXTreeItem('Cadastrar Folgas Coletivas','cadastro_coletivo_folga.php','','menu/images/novoitem.gif','','principal'));
					var consultarservico = new WebFXTreeItem('Consultar');
						servico.add(consultarservico);
						consultarservico.add(new WebFXTreeItem('Troca de Serviço','busca_troca_servico.php','','menu/images/atualizar.png','','principal'));
						consultarservico.add(new WebFXTreeItem('Doação de Sangue','busca_doacao_sangue.php','','menu/images/sangue.jpg','','principal'));
						consultarservico.add(new WebFXTreeItem('Folgas','busca_folga.php','','menu/images/pesquisar.gif','','principal'));
						consultarservico.add(new WebFXTreeItem('Folgas entre Datas','busca_pedido_folga.php','','menu/images/pesquisar.gif','','principal'));

					var atividade = new WebFXTreeItem('Atividade Extra');
						adm.add(atividade);
						atividade.add(new WebFXTreeItem('Cadastro Atividade','cadastro_atividade_extra.php','','menu/images/novoitem.gif','','principal'));
						atividade.add(new WebFXTreeItem('Consultar Atividade','busca_atividade_extra.php','','menu/images/pesquisar.gif','','principal'));
					
					var evento = new WebFXTreeItem('Eventos');
						adm.add(evento);
						evento.add(new WebFXTreeItem('Cadastro Eventos','cadastro_evento.php','','menu/images/novoitem.gif','','principal'));
						evento.add(new WebFXTreeItem('Gerência Eventos','adm_evento.php','','menu/images/novopreso.gif','','principal'));
						var consultar = new WebFXTreeItem('Consultas');
						evento.add(consultar);
						consultar.add(new WebFXTreeItem('Por Data','busca_evento.php','','menu/images/pesquisar.gif','','principal'));
						consultar.add(new WebFXTreeItem('Por Mes','busca_evento_mes.php','','menu/images/pesquisar.gif','','principal'));
						consultar.add(new WebFXTreeItem('Por Nome','busca_evento_nome.php','','menu/images/pesquisar.gif','','principal'));
		}
		
		if( bChefia == true )
		{
			var chefia = new WebFXTreeItem('Chefia');
            gmf.add(chefia);

				chefia.add(new WebFXTreeItem('Publicações de Escala','publicacoes_escala.php','','menu/images/novoitem.gif','','principal'));
				
				var recado = new WebFXTreeItem('Recados');
					chefia.add(recado);
					recado.add(new WebFXTreeItem('Consultar Recados','busca_recado.php','','menu/images/pesquisar.gif','','principal'));
				var servico = new WebFXTreeItem('Servicos Online');
					chefia.add(servico);
					servico.add(new WebFXTreeItem('Administrar','administrar_servicos_online.php','','menu/images/novopreso.gif','','principal'));
				var consultarservico = new WebFXTreeItem('Consultar');
					servico.add(consultarservico);
					consultarservico.add(new WebFXTreeItem('Troca de Servico','busca_troca_servico.php','','menu/images/atualizar.png','','principal'));
					consultarservico.add(new WebFXTreeItem('Doacao de Sangue','busca_doacao_sangue.php','','menu/images/sangue.jpg','','principal'));
					consultarservico.add(new WebFXTreeItem('Folgas','busca_folga.php','','menu/images/pesquisar.gif','','principal'));
					consultarservico.add(new WebFXTreeItem('Folgas entre Datas','busca_pedido_folga.php','','menu/images/pesquisar.gif','','principal'));
				var atividade = new WebFXTreeItem('Atividade Extra');
					chefia.add(atividade);
					atividade.add(new WebFXTreeItem('Consultar Atividade','busca_atividade_extra.php','','menu/images/pesquisar.gif','','principal'));
				var chamada = new WebFXTreeItem('Chamada');
					chefia.add(chamada);
					chamada.add(new WebFXTreeItem('Chamada','cadastro_chamada_vespertino.php','','menu/images/novoitem.gif','','principal'));
					chamada.add(new WebFXTreeItem('Chamada Justificada','cadastro_chamada_justificada.php','','menu/images/novoitem.gif','','principal'));
				
				var relatorio = new WebFXTreeItem('Relatório');
				chefia.add(relatorio);
					var ocorrencia = new WebFXTreeItem('Ocorrências');
					relatorio.add(ocorrencia);
					ocorrencia.add(new WebFXTreeItem('VTR','relatorio_ocorrencia_vtr.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Guarda','relatorio_guarda.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Rua','relatorio_guarda.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Período','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Numero Registro','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Palavra Chave','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var guincho = new WebFXTreeItem('Guinchamento');
					relatorio.add(guincho);
					guincho.add(new WebFXTreeItem('Placa/Modelo','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					guincho.add(new WebFXTreeItem('Período','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var quantitativo = new WebFXTreeItem('Quantitativo');
					relatorio.add(quantitativo);
					quantitativo.add(new WebFXTreeItem('Período','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Data e Hora','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Tipificação','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Finalizadas sem despacho','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('VTR','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Bairro','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Rua','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Ano','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Mês','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Solicitante','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Setor','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var p18 = new WebFXTreeItem('P18');
					relatorio.add(p18);
					p18.add(new WebFXTreeItem('J4','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('J5','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('J6','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('J8','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('P18','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('Indisponível','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var p18 = new WebFXTreeItem('Operaçao de Trânsito');
					relatorio.add(p18);
					p18.add(new WebFXTreeItem('Operação de Trânsito','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('Quantitativo','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var atividade = new WebFXTreeItem('Atividade');
					relatorio.add(atividade);
					atividade.add(new WebFXTreeItem('Guarda','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					atividade.add(new WebFXTreeItem('Data','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					atividade.add(new WebFXTreeItem('Atividade Geral','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var escola = new WebFXTreeItem('Escola');
					relatorio.add(escola);
					escola.add(new WebFXTreeItem('Escola','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					escola.add(new WebFXTreeItem('Data','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
		}
		
		
		if( bGuarda == true )
		{
			//Inicio do Menu Guarda
			var guarda = new WebFXTreeItem('Guarda Online');
				gmf.add(guarda);
				guarda.add(new WebFXTreeItem('Hora Extra','listar_escala_horaextra.php','','menu/images/icone1.gif','','principal'));
				guarda.add(new WebFXTreeItem('Publicações de Escala','publicacoes_escala.php','','menu/images/download.jpg','','principal'));
				guarda.add(new WebFXTreeItem('Atividade Extra','listar_atividade_extra.php','','menu/images/icone1.gif','','principal'));
				guarda.add(new WebFXTreeItem('Troca de Serviço','cadastro_troca_servico.php','','menu/images/novoitem.gif','','principal'));
				guarda.add(new WebFXTreeItem('Pedido de Folga','listar_pedido_folga.php','','menu/images/novoitem.gif','','principal'));
				guarda.add(new WebFXTreeItem('Doação de Sangue','cadastro_doacao_sangue.php','','menu/images/sangue.jpg','','principal'));
				guarda.add(new WebFXTreeItem('Atualizar Senha','atualiza_senha.php','','menu/images/atualizar.png','','principal'));
				//guarda.add(new WebFXTreeItem('Atualizar Chave de Segurança','atualiza_chave_seguranca.php','','menu/images/atualizar.png','','principal'));
				guarda.add(new WebFXTreeItem('Material Digital','listar_monografia.php','','menu/images/atualizar.png','','principal'));
			
			var recado = new WebFXTreeItem('Caixa de Recado');
				guarda.add(recado);
				recado.add(new WebFXTreeItem('Recado','recado_principal.php','','menu/images/info.gif','','principal'));
				recado.add(new WebFXTreeItem('Compor Recado','cadastro_recado_direto.php','','menu/images/novoitem.gif','','principal'));
		}
		
		if( bSetorPessoal == true )
		{
			//Inicio do Menu Guarda
			var setorpessoal = new WebFXTreeItem('Setor Pessoal');
				gmf.add(setorpessoal);
				
				var elogios = new WebFXTreeItem('Elogios');
				setorpessoal.add(elogios);
				elogios.add(new WebFXTreeItem('Cadastro Elogios','cadastro_elogios.php','','menu/images/icone1.gif','','principal'));
				elogios.add(new WebFXTreeItem('Consultar Elogios','busca_elogios.php','','menu/images/pesquisar.gif','','principal'));
				
				var func = new WebFXTreeItem('Funcionário');
				setorpessoal.add(func);
				func.add(new WebFXTreeItem('Cadastro Funcionario','cadastro_usuario.php','','menu/images/icone1.gif','','principal'));
				func.add(new WebFXTreeItem('Consultar Funcionario','busca_funcionario.php','','menu/images/pesquisar.gif','','principal'));
					
				setorpessoal.add(new WebFXTreeItem('Consultar Atividades Diárias','administrar_horaextra.php','','menu/images/pesquisar.gif','','principal'));
				setorpessoal.add(new WebFXTreeItem('Controle Ferias','controle_ferias.php','','menu/images/novoitem.gif','','principal'));
				setorpessoal.add(new WebFXTreeItem('Controle Licença','cadastro_licenca.php','','menu/images/novoitem.gif','','principal'));
				setorpessoal.add(new WebFXTreeItem('Chamada','cadastro_chamada.php','','menu/images/icone1.gif','','principal'));
		}
		if( bRondaEscolar == true )
		{
			//Inicio do Menu Guarda
			var escola = new WebFXTreeItem('Ronda Escolar');
				gmf.add(escola);
				escola.add(new WebFXTreeItem('Cadastro Escola','cadastro_escola.php','','menu/images/novoitem.gif','','principal'));
				escola.add(new WebFXTreeItem('Listar Escola','busca_escola.php','','menu/images/pesquisar.gif','','principal'));
				var relatorio = new WebFXTreeItem('Relatório Escola');
				escola.add(relatorio);
				relatorio.add(new WebFXTreeItem('Nome Escola','relatorio_nome_escola.php','','menu/images/pesquisar.gif','','principal'));
				relatorio.add(new WebFXTreeItem('Tipificação','cadastro_escola.php','','menu/images/pesquisar.gif','','principal'));
				relatorio.add(new WebFXTreeItem('Ano','cadastro_escola.php','','menu/images/pesquisar.gif','','principal'));
				relatorio.add(new WebFXTreeItem('VTR','cadastro_escola.php','','menu/images/pesquisar.gif','','principal'));
				relatorio.add(new WebFXTreeItem('Data','cadastro_escola.php','','menu/images/pesquisar.gif','','principal'));
				relatorio.add(new WebFXTreeItem('Período','cadastro_escola.php','','menu/images/pesquisar.gif','','principal'));
		}
		
		if( bDigitacao == true )
		{
			//Inicio do Menu Guarda
			var digitacao = new WebFXTreeItem('Digitação');
				gmf.add(digitacao);
				digitacao.add(new WebFXTreeItem('Cadastro Caixa','cadastro_caixa_bloco.php','','menu/images/novoitem.gif','','principal'));
				digitacao.add(new WebFXTreeItem('Cadastro Bloco','pre_cadastro_bloco.php','','menu/images/novoitem.gif','','principal'));
				digitacao.add(new WebFXTreeItem('Receber Auto','receber_auto_infracao.php','','menu/images/novoitem.gif','','principal'));
				var relatorio = new WebFXTreeItem('Relatório');
				digitacao.add(relatorio);
					var bloco = new WebFXTreeItem('Consultar Bloco');
					relatorio.add(bloco);
					bloco.add(new WebFXTreeItem('Guarda','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					bloco.add(new WebFXTreeItem('Bloco','relatorio_bloco.php','','menu/images/pesquisar.gif','','principal'));
					bloco.add(new WebFXTreeItem('Caixa','relatorio_caixa.php','','menu/images/pesquisar.gif','','principal'));
					bloco.add(new WebFXTreeItem('AIT','relatorio_ait.php','','menu/images/pesquisar.gif','','principal'));
				relatorio.add(new WebFXTreeItem('Quantidade Dia','relatorio_qtd_dia.php','','menu/images/pesquisar.gif','','principal'));
				relatorio.add(new WebFXTreeItem('Quantidade AIT','relatorio_quantitativo_aitgm.php','','menu/images/pesquisar.gif','','principal'));
		}
		if( bCentral == true )
		{
			//Inicio do Menu Guarda
			var central = new WebFXTreeItem('Central');
				gmf.add(central);
				central.add(new WebFXTreeItem('Central Ocorrências','central_ocorrencias.php','','menu/images/novoitem.gif','','principal'));
				central.add(new WebFXTreeItem('Desbloquear Guarnição','desbloquear_guarnicao.php','','menu/images/novoitem.gif','','principal'));
				var relatorio = new WebFXTreeItem('Relatório');
				central.add(relatorio);
					var ocorrencia = new WebFXTreeItem('Ocorrências');
					relatorio.add(ocorrencia);
					ocorrencia.add(new WebFXTreeItem('VTR','relatorio_ocorrencia_vtr.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Guarda','relatorio_guarda.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Rua','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Período','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Numero Registro','relatorio_ocorrencia_numero.php','','menu/images/pesquisar.gif','','principal'));
					ocorrencia.add(new WebFXTreeItem('Palavra Chave','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var guincho = new WebFXTreeItem('Guinchamento');
					relatorio.add(guincho);
					guincho.add(new WebFXTreeItem('Placa/Modelo','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					guincho.add(new WebFXTreeItem('Período','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var quantitativo = new WebFXTreeItem('Quantitativo');
					relatorio.add(quantitativo);
					quantitativo.add(new WebFXTreeItem('Período','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Data e Hora','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Tipificação','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Finalizadas sem despacho','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('VTR','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Bairro','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Rua','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Ano','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Mês','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Solicitante','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					quantitativo.add(new WebFXTreeItem('Setor','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var p18 = new WebFXTreeItem('P18');
					relatorio.add(p18);
					p18.add(new WebFXTreeItem('J4','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('J5','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('J6','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('J8','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('P18','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('Indisponível','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var p18 = new WebFXTreeItem('Operaçao de Trânsito');
					relatorio.add(p18);
					p18.add(new WebFXTreeItem('Operação de Trânsito','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					p18.add(new WebFXTreeItem('Quantitativo','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var atividade = new WebFXTreeItem('Atividade');
					relatorio.add(atividade);
					atividade.add(new WebFXTreeItem('Guarda','relatorio_atividade_guarda.php','','menu/images/pesquisar.gif','','principal'));
					atividade.add(new WebFXTreeItem('Data','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					atividade.add(new WebFXTreeItem('Atividade Geral','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					
					var escola = new WebFXTreeItem('Escola');
					relatorio.add(escola);
					escola.add(new WebFXTreeItem('Escola','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
					escola.add(new WebFXTreeItem('Data','relatorio_bloco_guarda.php','','menu/images/pesquisar.gif','','principal'));
		}
		
		if( bDigital == true )
		{
			//Inicio do Menu Guarda
			var digital = new WebFXTreeItem('Digital');
				gmf.add(digital);
				digital.add(new WebFXTreeItem('Cadastro Material','cadastro_digital.php','','menu/images/novoitem.gif','','principal'));
				digital.add(new WebFXTreeItem('Consultar Material','busca_digital.php','','menu/images/pesquisar.gif','','principal'));
				var monografia = new WebFXTreeItem('Monografia');
						digital.add(monografia);
						monografia.add(new WebFXTreeItem('Cadastro Monografia','cadastro_monografia.php','','menu/images/novoitem.gif','','principal'));
						monografia.add(new WebFXTreeItem('Consultar Monografia','busca_monografia.php','','menu/images/pesquisar.gif','','principal'));
		}
		
		if( bLogistica == true )
		{
			//Inicio do Menu Guarda
			var logistica = new WebFXTreeItem('Logistica');
				gmf.add(logistica);
				var cadastro = new WebFXTreeItem('Cadastro');
						logistica.add(cadastro);
						cadastro.add(new WebFXTreeItem('Espécie Veículo','cadastro_especie_veiculo.php','','menu/images/novoitem.gif','','principal'));
						cadastro.add(new WebFXTreeItem('Tipo Veículo','cadastro_tipo_veiculo.php','','menu/images/novoitem.gif','','principal'));
						cadastro.add(new WebFXTreeItem('Cadastro Veículo','cadastro_viatura.php','','menu/images/novoitem.gif','','principal'));	
						cadastro.add(new WebFXTreeItem('Cadastro Grupo Material','cadastro_grupo_material.php','','menu/images/novoitem.gif','','principal'));
						cadastro.add(new WebFXTreeItem('Cadastro Subgrupo Material','cadastro_subgrupo_material.php','','menu/images/novoitem.gif','','principal'));
						cadastro.add(new WebFXTreeItem('Cadastro Material','cadastro_material.php','','menu/images/novoitem.gif','','principal'));
						cadastro.add(new WebFXTreeItem('Cadastro Municição','cadastro_municao.php','','menu/images/novoitem.gif','','principal'));	
				logistica.add(new WebFXTreeItem('Pagamento Diário','pre_pagamento_diario.php','','menu/images/novoitem.gif','','principal'));
				logistica.add(new WebFXTreeItem('Devolução Diária','devolucao_material_diario.php','','menu/images/pesquisar.gif','','principal'));
				logistica.add(new WebFXTreeItem('Cautela Material','pre_cautela_material.php','','menu/images/pesquisar.gif','','principal'));
				logistica.add(new WebFXTreeItem('Listar Cautela','busca_digital.php','','menu/images/pesquisar.gif','','principal'));
				logistica.add(new WebFXTreeItem('CheckList','busca_digital.php','','menu/images/pesquisar.gif','','principal'));
				logistica.add(new WebFXTreeItem('Devolução Material','busca_digital.php','','menu/images/pesquisar.gif','','principal'));
				logistica.add(new WebFXTreeItem('Consultar Material','busca_digital.php','','menu/images/pesquisar.gif','','principal'));
				logistica.add(new WebFXTreeItem('Devolução Material','busca_digital.php','','menu/images/pesquisar.gif','','principal'));
		}
		document.write(gmf);
	}
}