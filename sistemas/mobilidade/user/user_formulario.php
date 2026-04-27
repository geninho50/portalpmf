<!-- MODAL CADASTRAR USUARIO !-->

<div id="MODALuser_cadastrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MODALuser_cadastrar">Cadastrar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <span id="msg-error"></span>

                <form method="post" id="formuser" action="/user/user_cadastrar.php">
                    <?php $url = $_SERVER["REQUEST_URI"]; ?>
                    <input name="pagina" type="hidden" value="<?php echo $url; ?>">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="text-align: right;">ORIGEM</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="orgao" style="background-color:rgb(202, 211, 224);" name="orgao">
                                <option selected value="">Escolha o orgao do cadastro...</option>
                                <option value="SMPU" >SMPU</option>
                                <option value="IPUF">IPUF</option>
                                <option value="PMF" disabled>PMF</option>
                                <option value="EXTERNO" disabled>EXTERNO</option>
                            </select>
                        </div>
                    </div>

                    <!-- Bloco  SMPU div_form_setor_smpu-->
                    <div id="div_form_setor_smpu" style="display:none">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Setor SMPU</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="smpusetor" style="background-color:rgb(218, 226, 237);" name="setor1" onchange="validaSetorDb()">
                                    <option selected value="">Escolha o setor do cadastro...</option>
                                    <optgroup label="DIOPE">
                                        <option value='SMPU/DIOPE/GP'>GÊRENCIA DE PROJETOS</option>
                                        <option value='SMPU/DIOPE'>DIR. DE OPERAÇÃO DE TRÂNSITO</option>
                                    </optgroup>

                                    <optgroup label="GABINETE">
                                        <option value='SMPU/GAB'>GABINTETE SECRETÁRIO</option>
                                        <option value='SMPU/GAB/ADJ'>GABINETE SECRETÁRIO ADJUNTO</option>
                                        <option value='SMPU/GAB/DF'>CHEFIA DE DEPTO. FINANCEIRO</option>
                                        <option value='SMPU/GAB/DA'>CHEFIA DE DEPTO. ADMINISTRATIVO</option>
                                        <option value='SMPU/GAB/CA'>CONSULTOR ADMINISTRATIVO</option>
                                        <option value='SMPU/GAB/ASSTEC'>ASSESSORIA TÉCNICA</option>
                                        <option value='SMPU/GAB/ASSJUR'>ASSESSOR JURÍDICO</option>
                                    </optgroup>

                                    <optgroup label="DEPARTAMENTO DE MOBILIDADE">
                                        <option value='SMPU/DM'>DIRETORIA DE MOBILIDADE</option>
                                        <option value='SMPU/DM/GVTE/DGV'>DEPTO. DE QUALIDADE E VISTORIA</option>
                                        <option value='SMPU/DM/GVTE/DF'>DEPTO. DE FISCALIZAÇÃO</option>
                                        <option value='SMPU/DM/GVTE'>GERÊNCIA DE VISTORIA E TRANSP. ESP.</option>
                                        <option value='SMPU/DM/GT'>GERÊNCIA DE TERMINAIS</option>

                                        <option value='SMPU/DM/DET'>DEPTO. DE CONTROLE DE TARIFAS/SUBSÍDIOS</option>
                                        <option value='SMPU/DM/DPP'>DEPTO. DE PESQUISA E ANÁLISE</option>
                                    </optgroup>

                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bloco  SMPU div_form_setor_ipuf-->
                    <div id="div_form_setor_ipuf" style="display:none">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Setor IPUF</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="ipufsetor" style="background-color:rgb(218, 226, 237);" name="setor2">
                                    <option selected value="">Escolha o setor</option>
                                    <optgroup label="DIR. GERAL">
                                        <option value="IPUF/DG/BIBLIOTECA">Biblioteca</option>
                                        <option value="IPUF/DG/CPD">CPD</option>
                                        <option value="IPUF/DG/DFC">DFC</option>
                                        <option value="IPUF/DG/PROTOCOLO">Protocolo</option>
                                        <option value="IPUF/DG/RH">Recursos Humanos</option>
                                        <option value="IPUF/DG/SEPHAN">SEPHAN</option>
                                    </optgroup>

                                    <optgroup label="DICGP">
                                        <option value="IPUF/DICGP/DCCG">DCCG</option>
                                        <option value="IPUF/DICGP/GEPAI">GEPAI</option>
                                    </optgroup>

                                    <optgroup label="DIPLA">
                                        <option value="IPUF/DIPLA/DAP">DAP</option>
                                        <option value="IPUF/DIPLA/DESEP">DESEP</option>
                                        <option value="IPUF/DIPLA/DMOB">DMOB</option>
                                        <option value="IPUF/DIPLA/DPLAN">DPLAN</option>
                                    </optgroup>

                                    <optgroup label="GAB. DA SUPERINTEDÊNCIA">
                                        <option value="IPUF/GAB/ARQUIVO">Arquivo</option>
                                        <option value="IPUF/GAB/ASSJUR">ASSJUR</option>
                                        <option value="IPUF/GAB/CTIPUF">CTIPUF</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bloco  PMF-->
                    <div id="div_form_pmf" style="display:none">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Secretaria</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="SECpmf" style="background-color:rgb(218, 226, 237);" name="SECpmf">
                                    <option selected value="">Escolha a secretaria PMF</option>
                                    <option value="SMI">SMI</option>
                                    <option value="CASACIVIL">CASACIVIL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="div_form_matricula" style="display:none">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Matricula</label>
                            <div class="col-sm-9">
                                <input name="matricula" type="text" class="form-control" id="matricula" onchange="validamatriculadb()" placeholder="Matricula PMF">
                            </div>
                        </div>
                    </div>

                    <!-- Bloco  SMPU div_form_entidade-->
                    <div id="div_form_entidade" style="display:none">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Entidade</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="entidade" style="background-color:rgb(218, 226, 237);" name="entidade">
                                    <option selected value="">Escolha a entidade ou empresa</option>
                                    <optgroup label="Juntas, Comissões e Conselhos">
                                    <option value='SMPU/DM/CMT'>Conselho Municipal de Trasnp.</option>
                                    <option value='SMPU/DM/DAI'>JARIT/JARI</option>
                                    <option value='IPUF/GAB/CONSELHODACIDADE'>Conselho da Cidade</option>
                                    <option value='IPUF/GAB/CONSELHODACIDADE/ELEICOES'>Eleições</option>
                                    </optgroup>
                                    <option value="RIZZO">Rizzo</option>
                                    <option value="AFLODEF">Aflodef</option>
                                    <option value="MORE">MORE</option>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div id="div_form" style="display:none">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Nome</label>
                            <div class="col-sm-9">
                                <input name="nome" type="text" class="form-control" style="text-transform: uppercase;" id="nome" onchange="validanomedb()" placeholder="Nome completo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Usuário</label>
                            <div class="col-sm-9">
                                <input name="usuario" id="usuario" type="text" class="form-control" onchange="validausuariodb();" maxlength="10" placeholder="Nome de usuário">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Email</label>
                            <div class="col-sm-9">
                                <input name="email" type="email" class="form-control" id="email" placeholder="Seu melhor E-mail">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">CPF</label>
                            <div class="col-sm-9">
                                <input name="cpf" type="text" id="cpf" class="cpf form-control" onchange="validacpfdb();" size="20" placeholder="CPF do cadastro" autocomplete="off" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;" style="text-align: right;">Senha</label>
                            <div class="col-sm-3">
                                <input name="senha" id="senha" type="password" class="form-control" maxlength="8" placeholder="senha">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="text-align: right;">Senha</label>
                            <div class="col-sm-3">
                                <input name="rep_senha" id="rep_senha" type="password" class="form-control" maxlength="8" placeholder="confirmar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                            <button type="button" value="Limpar" class="btn btn-danger" onClick="limpa1()">Limpar</button>
                            <button type="submit" value="Cadastrar" class="btn btn-success" onclick="return validar()">Cadastrar</button>
                        </div>
                    </div>


            </div>

            </form>
        </div>
    </div>
</div>
</div>


<!-- MODAL Apagar  Usuários-->