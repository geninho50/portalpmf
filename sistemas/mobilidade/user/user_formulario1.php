<!-- MODAL CADASTRAR USUARIO !-->

<div id="MODALuser_cadastrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MODALuser_cadastrar">Cadastrar Usuário 1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formuser" action="/user/user_cadastrar.php">
                    <div class="form-row">
                        <div class="col col-md-12">
                            <select class="form-control bg-info text-white" id="form_categoria" name="categoria">
                                <option selected value="">Escolha a categoria do cadastro...</option>
                                <option value="Diretor">Diretor</option>
                                <option value="Gerente">Gerente</option>
                                <option value="Chefe Departamento">Chefe Departamento</option>
                                <option value="Terceirizado">Terceirizado</option>
                                <option value="Estagiário">Estagiário</option>
                                <option value="Colaborador Externo">Colaborador Externo</option>
                            </select>
                        </div>
                    </div>

<!-- Bloco -->

                    <div id="div_form" style="display:none">

                        <span id="msg-error"></span>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input name="nome" type="text" class="form-control" style="text-transform: uppercase;" id="nome" placeholder="Nome completo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Usuário</label>
                            <div class="col-sm-10">
                                <input name="usuario" id="usuario" type="text" class="form-control" maxlength="10" placeholder="Nome de usuário">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input name="email" type="email" class="form-control" id="email" placeholder="Seu melhor E-mail">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Matricula:</label>
                            <div class="col-sm-10">
                                <input name="matricula" id="matricula" type="text" class="form-control" placeholder="Matricula PMF">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">CPF:</label>
                            <div class="col-sm-10">
                                <input name="cpf" id="cpf" type="text" class="form-control" placeholder="CPF">
                            </div>
                        </div>



                        <div class="form-group row" id="form_nivel_acesso" style="display:none">
                            <label class="col-sm-2 col-form-label">Nível de acesso:</label>
                            <div class="col-sm-10">
                                <select class="form-control bg-info text-white" id="nivel_acesso" name="nivel_acesso">
                                    <option selected value="0">Pre-cadastro</option>
                                    <option value="1">Público</option>
                                    <option value="3">Colaborador</option>
                                    <option value="5">Analista</option>
                                    <option value="7">Administrador</option>
                                    <option value="9">SuperUsuario</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Senha:</label>
                            <div class="col-sm-4">
                                <input name="senha" id="senha" type="password" class="form-control" maxlength="8" placeholder="senha">
                            </div>
                            <label class="col-sm-2 col-form-label">Senha:</label>
                            <div class="col-sm-4">
                                <input name="rep_senha" id="rep_senha" type="password" class="form-control" maxlength="8" placeholder="confirmar">
                            </div>
                        </div>
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


<!-- MODAL Apagar  Usuários-->