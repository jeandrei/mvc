<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" id="addPessoaModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Adicionar Pessoa</h5>        
      </div>
      
      <form method="post" enctype="multipart/form-data"> 
        <!-- MODAL BODY-->
        <div class="modal-body"> 
            
            <!--NOME-->
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="pessoaNome"><sup class="obrigatorio">*</sup> Nome:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="pessoaNome"
                        id="pessoaNome"
                        value="<?php echo $data['pessoaNome']; ?>"                       
                        placeholder="Informe o nome"
                    >
                    <span class="text-danger" id="pessoaNome_err">
                      <?php echo $data['pessoaNome_err']; ?>
                    </span>                   
                </div>
            </div> 
            <!--NOME-->

            <!--EMAIL-->
            <div class="row">
              <div class="form-group col-md-10">
                  <label for="pessoaEmail"><sup class="obrigatorio">*</sup> Email:</label>  
                  <input 
                      class="form-control"
                      type="text" 
                      name="pessoaEmail"
                      id="pessoaEmail"
                      value="<?php echo $data['pessoaEmail']; ?>"                       
                      placeholder="Email"
                  >
                  <span class="text-danger" id="pessoaEmail_err">
                    <?php echo $data['pessoaEmail_err']; ?>
                  </span>                 
              </div>
            </div>                        
            <!--EMAIL-->


            <!--TELEFONE E CELULAR-->
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="pessoaTelefone"><sup class="obrigatorio">*</sup> Telefone:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="pessoaTelefone"
                        id="pessoaTelefone"
                        value="<?php echo $data['pessoaTelefone']; ?>"                       
                        placeholder="Informe o telefone"
                    >
                    <span class="text-danger" id="pessoaTelefone_err">
                      <?php echo $data['pessoaTelefone_err']; ?>
                    </span>                    
                </div>           
            
           
                <div class="form-group col-md-6">
                    <label for="pessoaCelular"><sup class="obrigatorio">*</sup> Celular:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="pessoaCelular"
                        id="pessoaCelular"
                        value="<?php echo $data['pessoaCelular']; ?>"                       
                        placeholder="Informe o celular"
                    >
                    <span class="text-danger" id="pessoaCelular_err">
                      <?php echo $data['pessoaCelular_err']; ?>
                    </span>                     
                </div>
            </div> 
            <!--TELEFONE E CELULAR-->


            <!--MUNICIPIO BAIRRO E LOGRADOURO-->
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="pessoaMunicipio"><sup class="obrigatorio">*</sup> Município:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="pessoaMunicipio"
                        id="pessoaMunicipio"
                        value="<?php echo $data['pessoaMunicipio']; ?>"                       
                        placeholder="Informe o município"
                    >
                    <span class="text-danger" id="pessoaMunicipio_err">
                      <?php echo $data['pessoaMunicipio_err']; ?>
                    </span>                    
                </div>   
                
                <div class="form-group col-md-6">
                    <label for="pessoaLogradouro"><sup class="obrigatorio">*</sup> Logradouro:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="pessoaLogradouro"
                        id="pessoaLogradouro"
                        value="<?php echo $data['pessoaLogradouro']; ?>"                       
                        placeholder="Informe o logradouro"
                    >
                    <span class="text-danger" id="pessoaLogradouro_err">
                      <?php echo $data['pessoaLogradouro_err']; ?>
                    </span>                   
                </div>      
            
           
                <div class="form-group col-md-3">
                <label for="bairroId"><sup class="obrigatorio">*</sup> Bairro:</label>                        
                  <select
                      name="bairroId"
                      id="bairroId"
                      class="form-select <?php echo (!empty($data['bairroId_err'])) ? 'is-invalid' : ''; ?>"
                  >
                  <option value="1">Selecione o Bairro</option> 
                  </select>
                  <span class="text-danger" id="bairroId_err">
                    <?php echo $data['bairroId_err']; ?>
                  </span>          
                </div>
            </div> 
            <!--MUNICIPIO BAIRRO E LOGRADOURO-->

            <!--UF NASCIMENTO CPF-->
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="pessoaUf"><sup class="obrigatorio">*</sup> Estado:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="pessoaUf"
                        id="pessoaUf"
                        value="<?php echo $data['pessoaUf']; ?>"                       
                        placeholder="Informe Estado"
                    >
                    <span class="text-danger" id="pessoaUf_err">
                      <?php echo $data['pessoaUf_err']; ?>
                    </span>                 
                </div>   
                
                <div class="form-group col-md-3">
                    <label for="pessoaNascimento"><sup class="obrigatorio">*</sup> Nascimento:</label>  
                    <input 
                        class="form-control"
                        type="date" 
                        name="pessoaNascimento"
                        id="pessoaNascimento"
                        value="<?php echo $data['pessoaNascimento']; ?>"                       
                        placeholder="Informe a data de nascimento"
                    >
                    <span class="text-danger" id="pessoaNascimento_err">
                      <?php echo $data['pessoaNascimento_err']; ?>
                    </span>                   
                </div>     

                <div class="form-group col-md-3">
                    <label for="pessoaCpf"><sup class="obrigatorio">*</sup> CPF:</label>  
                    <input 
                        class="form-control"
                        type="text" 
                        name="pessoaCpf"
                        id="pessoaCpf"
                        value="<?php echo $data['pessoaCpf']; ?>"                       
                        placeholder="Informe o CPF"
                    >
                    <span class="text-danger" id="pessoaCpf_err">
                      <?php echo $data['pessoaCpf_err']; ?>
                    </span>                   
                </div>
            
           
                
            </div> 
            <!--UF NASCIMENTO CPF-->



        </div>
        <!-- FIM MODAL BODY -->

        <!-- BOTÕES -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btnFecharAddModel" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary gravar" id='gravar' data-dismiss="modal">Gravar</button>
        </div>
        <!-- FIM BOTÕES -->
      </form>
      
    </div>
  </div>
  
</div>
<!-- MODAL -->