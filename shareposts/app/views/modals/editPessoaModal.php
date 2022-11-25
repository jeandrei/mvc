
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" id="editPessoaModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Atualizar Pessoa</h5>        
      </div>
      
      <form method="post" enctype="multipart/form-data"> 
        <!-- MODAL BODY-->
        <div class="modal-body"> 
            
            <!--NOME-->
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="updatePessoaNome"><sup class="obrigatorio">*</sup> Nome:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="updatePessoaNome"
                        id="updatePessoaNome"
                        value="<?php echo $data['updatePessoaNome']; ?>"                       
                        placeholder="Informe o nome"
                    >
                    <span class="text-danger" id="pessoaNome_err">
                      <?php echo $data['updatePessoaNome_err']; ?>
                    </span>                   
                </div>
            </div> 
            <!--NOME-->

            <!--EMAIL-->
            <div class="row">
              <div class="form-group col-md-10">
                  <label for="updatePessoaEmail"><sup class="obrigatorio">*</sup> Email:</label>  
                  <input 
                      class="form-control"
                      type="text" 
                      name="updatePessoaEmail"
                      id="updatePessoaEmail"
                      value="<?php echo $data['updatePessoaEmail']; ?>"                       
                      placeholder="Email"
                  >
                  <span class="text-danger" id="updatePessoaEmail_err">
                    <?php echo $data['updatePessoaEmail_err']; ?>
                  </span>                 
              </div>
            </div>                        
            <!--EMAIL-->


            <!--TELEFONE E CELULAR-->
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="updatePessoaTelefone"><sup class="obrigatorio">*</sup> Telefone:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="updatePessoaTelefone"
                        id="updatePessoaTelefone"
                        value="<?php echo $data['updatePessoaTelefone']; ?>"                       
                        placeholder="Informe o telefone"
                    >
                    <span class="text-danger" id="updatePessoaTelefone_err">
                      <?php echo $data['updatePessoaTelefone_err']; ?>
                    </span>                    
                </div>           
            
           
                <div class="form-group col-md-6">
                    <label for="updatePessoaCelular"><sup class="obrigatorio">*</sup> Celular:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="updatePessoaCelular"
                        id="updatePessoaCelular"
                        value="<?php echo $data['updatePessoaCelular']; ?>"                       
                        placeholder="Informe o celular"
                    >
                    <span class="text-danger" id="updatePessoaCelular_err">
                      <?php echo $data['updatePessoaCelular_err']; ?>
                    </span>                     
                </div>
            </div> 
            <!--TELEFONE E CELULAR-->


            <!--MUNICIPIO BAIRRO E LOGRADOURO-->
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="updatePessoaMunicipio"><sup class="obrigatorio">*</sup> Município:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="updatePessoaMunicipio"
                        id="updatePessoaMunicipio"
                        value="<?php echo $data['updatePessoaMunicipio']; ?>"                       
                        placeholder="Informe o município"
                    >
                    <span class="text-danger" id="updatePessoaMunicipio_err">
                      <?php echo $data['updatePessoaMunicipio_err']; ?>
                    </span>                    
                </div>   
                
                <div class="form-group col-md-6">
                    <label for="updatePessoaLogradouro"><sup class="obrigatorio">*</sup> Logradouro:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="updatePessoaLogradouro"
                        id="updatePessoaLogradouro"
                        value="<?php echo $data['updatePessoaLogradouro']; ?>"                       
                        placeholder="Informe o logradouro"
                    >
                    <span class="text-danger" id="updatePessoaLogradouro_err">
                      <?php echo $data['updatePessoaLogradouro_err']; ?>
                    </span>                   
                </div>      
            
           
                <div class="form-group col-md-3">
                <label for="updateBairroId"><sup class="obrigatorio">*</sup> Bairro:</label>                        
                  <select
                      name="updateBairroId"
                      id="updateBairroId"
                      class="form-select <?php echo (!empty($data['updateBairroId_err'])) ? 'is-invalid' : ''; ?>"
                  >
                  <option value="1">Selecione o Bairro</option> 
                  </select>
                  <span class="text-danger" id="updateBairroId_err">
                    <?php echo $data['updateBairroId_err']; ?>
                  </span>          
                </div>
            </div> 
            <!--MUNICIPIO BAIRRO E LOGRADOURO-->

            <!--UF NASCIMENTO CPF-->
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="updatePessoaUf"><sup class="obrigatorio">*</sup> Estado:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="updatePessoaUf"
                        id="updatePessoaUf"
                        value="<?php echo $data['updatePessoaUf']; ?>"                       
                        placeholder="Informe Estado"
                    >
                    <span class="text-danger" id="updatePessoaUf_err">
                      <?php echo $data['updatePessoaUf_err']; ?>
                    </span>                 
                </div>   
                
                <div class="form-group col-md-3">
                    <label for="updatePessoaNascimento"><sup class="obrigatorio">*</sup> Nascimento:</label>  
                    <input 
                        class="form-control"
                        type="date" 
                        name="updatePessoaNascimento"
                        id="updatePessoaNascimento"
                        value="<?php echo $data['updatePessoaNascimento']; ?>"                       
                        placeholder="Informe a data de nascimento"
                    >
                    <span class="text-danger" id="updatePessoaNascimento_err">
                      <?php echo $data['updatePessoaNascimento_err']; ?>
                    </span>                   
                </div>     

                <div class="form-group col-md-3">
                    <label for="updatePessoaCpf"><sup class="obrigatorio">*</sup> CPF:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="updatePessoaCpf"
                        id="updatePessoaCpf"
                        value="<?php echo $data['updatePessoaCpf']; ?>"                       
                        placeholder="Informe o CPF"
                    >
                    <span class="text-danger" id="updatePessoaCpf_err">
                      <?php echo $data['updatePessoaCpf_err']; ?>
                    </span>                   
                </div>
            
           
                
            </div> 
            <!--UF NASCIMENTO CPF-->



        </div>
        <!-- FIM MODAL BODY -->

        <!-- BOTÕES -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btnFecharEditModel" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary gravar" id='btnUpdate' data-dismiss="modal">Update</button>
            <input type="hidden" id="hiddendata">
        </div>
        <!-- FIM BOTÕES -->
      </form>
      
    </div>
  </div>
  
</div>
<!-- MODAL -->