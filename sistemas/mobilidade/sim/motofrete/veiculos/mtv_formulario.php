       <!-- MODAL CADASTRAR-->

       <div id="MODALuser_cadastrar" class="modal fade bd-example-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="MODALuser_cadastrar">Motofretista: Cadastrar Veículo - MOTO</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <form method="post" id="formuser" autocomplete="off" action="mtv_cadastrar.php">
                           <div><br>
                               <span id="msg-error"></span>

                           </div>

                             
                           <div class="form-row">

                        <div class="col-sm-3">
                        <label class="col-form-label">Proprietário: </label>

                            <select class="form-control" id="orgao" style="background-color:rgb(202, 211, 224);" name="orgao">
                                <option selected value="">Escolha</option>
                                <option value="CNPJ" >CNPJ</option>
                                <option value="CPF">CPF</option>
                           
                            </select>


                            </div>



                               <div class="form-group col-3">
                                        <label class="col-form-label">CNPJ: </label>
                                        <input name="cnpj" type="text" id="cnpj" class="cnpj form-control" size="20" onchange="valida_CNPJ_db();" placeholder="CNPJ da empresa"  autocomplete="off" />
                                    </div>                                                                                    

                                <div class="form-group col-3">
                                        <label class="col-form-label">CPF: </label>
                                        <input name="cpf" type="text" id="cpf" class="cpf form-control" onchange="validacpfdb();" size="20" placeholder="CPF do cadastro" autocomplete="off" />
                                    </div>

                           </div>



                           <div class="form-row">
                               <div class="form-group col-md-2">
                                   <label class="col-form-label">Placa: </label>
                                   <input name="placa_prefix" type="text" id="placa_prefix" class="placa_prefix form-control input-group-prepend" size="3" placeholder="LETRAS" autocomplete="off" />
                               </div>
                               <div class="form-group col-md-4">
                                   <label class="col-form-label">Numero Placa:</label>
                                   <input name="placa_num" type="text" id="placa_num" class="placa_num form-control" size="8" placeholder="NÚMEROS" autocomplete="off" />
                               </div>
                               <div class="form-group col-md-6">
                                   <label class="col-form-label">CRV: </label>
                                   <input name="crv" type="text" class="form-control" id="crv" size="40" placeholder="CRV" autocomplete="off">
                               </div>
                           </div>

                           <div class="form-row">
                               <div class="form-group col-md-6">
                                   <label class="col-form-label">Renavam: </label>
                                   <input name="renavam" type="text" id="renavam" class="renavam form-control input-group-prepend" size="3" placeholder="RENAVAM" autocomplete="off" />
                               </div>
                               <div class="form-group col-md-6">
                                   <label class="col-form-label">Chassi:</label>
                                   <input name="chassi" type="text" id="chassi" class="chassi form-control" size="8" placeholder="CHASSI" autocomplete="off" />
                               </div>
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