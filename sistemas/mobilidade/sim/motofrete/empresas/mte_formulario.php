       <!-- MODAL CADASTRAR-->

        <div id="MODALuser_cadastrar" class="modal fade bd-example-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="MODALuser_cadastrar">Motofretista: Cadastrar Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="formuser" autocomplete="off" action="mte_cadastrar.php">
                            <div><br>
                                <span id="msg-error"></span>

                            </div>

                                <div class="form-row">
                                    <div class="form-group col-9">
                                        <label class="col-form-label">Razão Social: </label>
                                        <input name="razao_social" type="text" id="razao_social" style="text-transform: uppercase;" class="form-control" size="70" autocomplete="off" placeholder="RAZÃO SOCIAL DA EMPRESA" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Data de abertura: </label>
                                        <input name="data_abertura" type="date" class="form-control" id="data_abertura" />
                                    </div>
                                                                
                                </div>
                                <div class="form-row">
                                <div class="form-group col-3">
                                        <label class="col-form-label">CNPJ: </label>
                                        <input name="cnpj" type="text" id="cnpj" class="cnpj form-control" size="20" onchange="valida_CNPJ_db();" placeholder="CNPJ da empresa"  autocomplete="off" />
                                    </div>                                                                                    
                                </div>
                                <div class="form-row">
                                 
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">E-mail: </label>
                                        <input name="email" type="email" class="form-control" id="email" size="40" placeholder="Indique o melhor E-mail" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Telefone 1: </label>
                                        <input name="telefone01" type="text" class="telefone form-control" id="telefone01" size="60" placeholder="Telefone de contato" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Telefone 2: </label>
                                        <input name="telefone02" type="text" class="telefone form-control" id="telefone02" size="60" placeholder="Telefone de contato" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-3">
                                        <label class="col-form-label">CEP:</label>
                                        <input name="cep" id="cep" type="text" class="cep form-control" maxlength="9" size="10" placeholder="CEP" />

                                    </div>
                                    <div class="form-group col-5">
                                        <label class="col-form-label">Rua </label>
                                        <input name="rua" type="text" id="rua" class="form-control bg-light" size="70" placeholder="Rua" />
                                    </div>

                                    <div class="form-group col-4">
                                        <label class="col-form-label">Bairro: </label>
                                        <input name="bairro" type="text" id="bairro" class="form-control bg-light" size="70" placeholder="Bairro" />

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-8">
                                        <label class="col-form-label">Complemento: </label>
                                        <input name="complemento" type="text" id="complemento" class="form-control" size="70" placeholder="Número ou referência" />
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="col-form-label">Cidade: </label>
                                        <input name="cidade" type="text" id="cidade" class="form-control bg-light" size="70" placeholder="Cidade" />
                                    </div>
                                    <div class="form-group col-1">
                                        <label class="col-form-label">UF: </label>
                                        <input name="uf" type="text" id="uf" class="form-control bg-light" size="4" placeholder="UF" />
                                    </div>

                                </div>
                                <div>
                                    <span id="msg-error2"></span>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <button type="button" value="Limpar" class="btn btn-danger" onClick="limpa1()">Limpar</button>
                                    <button type="submit" value="Cadastrar" class="btn btn-success" onclick="return validar()">Cadastrar</button>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- FIM MODAL cadastrar Usuários-->
