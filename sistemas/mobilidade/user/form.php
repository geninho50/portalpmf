
        <!-- MODAL CADASTRAR-->

        <div id="MODALuser_cadastrar" class="modal fade bd-example-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="MODALuser_cadastrar">Cadastrar Morador Costa da Lagoa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="formuser" autocomplete="off" action="morador_costa_cadastrar.php">
                            <div class="form-row">
                                <div class="col col-md-12">
                                    <select class="form-control bg-info text-white" id="categoria" name="categoria">
                                        <option selected value="">Escolha a categoria do cadastro...</option>
                                        <option value="Morador">Morador</option>
                                        <option value="Estudante">Estudante</option>
                                        <option value="PCD">PCD</option>
                                        <option value="PCD com acompanhante">PCD com acompanhante</option>
                                        <option value="Gestante">Gestante</option>
                                        <option value="Idoso">Idoso</option>
                                        <option value="Acompanhante Aluno Infantil">Mãe de aluno do ensino Infantil Municipal</option>
                                    </select>
                                </div>
                            </div>
                            <div><br>
                                <span id="msg-error"></span>
                            </div>

                            <div id="div_form" style="display:none">
                                <div class="form-row">
                                    <div class="form-group col-5">
                                        <label class="col-form-label">Nome do Morador: </label>
                                        <input name="nome" type="text" id="nome" style="text-transform: uppercase;" class="form-control" size="70" autocomplete="off" placeholder="NOME COMPLETO" />
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="col-form-label">CPF: </label>
                                        <input name="cpf" type="text" id="cpf" class="cpf form-control" onchange="validacpfdb();" size="20" placeholder="CPF do cadastro" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="col-form-label">RG: </label>
                                        <input name="rg" type="text" id="rg" class="rg form-control" size="15" placeholder="RG (numeros)" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-2">
                                        <label class="col-form-label">Emissor </label>
                                        <input name="rg_orgao" type="text" id="rg_orgao" class="form-control" size="8" style="text-transform: uppercase;" placeholder="" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Nascimento: </label>
                                        <input name="data_nascimento" type="date" class="form-control" id="data_nascimento" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">E-mail: </label>
                                        <input name="email" type="email" class="form-control" id="email" size="40" placeholder="Indique o melhor E-mail" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Telefone: </label>
                                        <input name="telefone01" type="text" class="telefone form-control" id="telefone01" size="60" value="48" placeholder="Telefone de contato" autocomplete="off">
                                    </div>
                                </div>
                                <h5>Endereço</h5>
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

                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <img id="preview_1" class="img-fluid rounded" style="width: 100%">
                                    </div>
                                </div>

                                <!--                            
                                <div class="row" id="upload_identidade">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>Identidade</h5>
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file01" type="file" name="identidade01" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file01">Identidade lado 1</label>
                                            </div>
                                        </div>

                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file02" type="file" name="identidade02" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file02">Identidade lado 2</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <!--
                                <div class="row" id="upload_residencia">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>Comprovante Residência</h5>
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file03" type="file" name="residencia" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file03">Comprovante de Residência</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->
                                <!--
                                <div class="row" id="upload_pcd">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>PCD</h5>
                                        
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file03" type="file" name="upload_pcd" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file03">Atestado médico com CID</label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="acompanhante_´pcd" id="acompanhante_check">
                                            <label class="form-check-label" for="acompanhante_check">Necessita acompanhante</label>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <div class="row" id="upload_estudante" style="display:none">
                                    <div class="col-sm-12">
                                        <h5>Estudante</h5>
                                        <!--
                                        <div class="input-group mt-3">

                                            <div class="custom-file">
                                                <input id="file04" type="file" name="upload_estudante" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file04">Atestado de matrícula</label>
                                            </div>
                                        </div>
                                         -->

                                        <div class="form-row">
                                            <div class="form-group col-3">
                                                <label class="text-muted">Validade</label>
                                                <input name="validade1" type="date" id="validade_estudante" class="form-control" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row" id="upload_gestante" style="display:none">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>Gestante</h5>
                                        <!--
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file05" type="file" name="upload_gestante" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file05">Atestado médico</label>
                                            </div>
                                        </div>
                                        -->
                                        <div class="form-row">
                                            <div class="form-group col-3">
                                                <label class="text-muted">Data final Pré-natal</label>
                                                <input name="validade2" type="date" id="validade_gestante" class="form-control" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--
                                <div class="row" id="upload_mae">
                                    <div class="col-sm-12">
                                        <hr>
                                        <h5>Mãe de estudante</h5>
                                        <div class="input-group mt-3">
                                            <div class="custom-file">
                                                <input id="file06" type="file" name="upload_mae" class="custom-file-input" onchange="ValidateSingleInput(this);">
                                                <label class="custom-file-label" for="file06">Atestado de matrícula</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <button type="button" value="Limpar" class="btn btn-danger" onClick="limpa1()">Limpar</button>
                                    <button type="submit" value="Cadastrar" class="btn btn-success" onclick="return validar()">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- FIM MODAL cadastrar Usuários-->