<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>



<!-- ADD NEW -->
<div class="row mb-3">
    <div class="col-md-6">
        <h1><?php echo $data['titulo']; ?></h1>
    </div>  

    <div class="col-md-6"> 
        <button type="button" id="addPessoa" class="btn btn-primary float-end" data-toggle="modal" data-target="#addPessoaModal" onClick="clearInput()">
        <i class="fa fa-pencil"></i> Adicionar Pessoa</button> 
    </div>
</div>


<!-- FORMULÁRIO -->
<form id="filtrar" action="<?php echo URLROOT; ?>/pessoas/index" method="get" enctype="multipart/form-data">
  <div class="row mt-2">
    <div class="col-md-3">
      <label for="pessoaNome">
        Buscar por Nome:
      </label>
      <input
        type="text"
        name="pessoaNome"
        id="pessoaNome"
        class="form-control"
        value="<?php echo $_GET['pessoaNome'];?>"
      >
      <span class="invalid-feedback">

      </span>
    </div>


    <div class="col-md-3">
      <label for="pessoaMunicipio">
        Buscar por Município:
      </label>
      <input
        type="text"
        name="pessoaMunicipio"
        id="pessoaMunicipio"
        class="form-control"
        value="<?php echo $_GET['pessoaMunicipio'];?>"
      >
      <span class="invalid-feedback">

      </span>
    </div>
  </div> 
  
  <div class="col-md-6 align-self-end mt-2" style="padding-left:5;">           
      <button class="btn btn-primary" id="pesquisar">Pesquisar</button>
      <input type="button" class="btn btn-primary" value="Limpar" onClick="limpar()">                                                
  </div>   


</form>
<!-- FORMULÁRIO -->


<!-- MENSAGEM -->
<div class="alert" id="msgAdd"></div>



<!-- TABELA -->
<table class="table table-striped" id="tabelaPessoas"></table>



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
                        class="form-control <?php echo (!empty($data['pessoaNome_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="pessoaNome"
                        id="pessoaNome"
                        value="<?php echo $data['pessoaNome']; ?>"                       
                        placeholder="Informe o nome"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['pessoaNome_err']; ?>
                    </div>                   
                </div>
            </div> 
            <!--NOME-->

            <!--EMAIL-->
            <div class="row">
              <div class="form-group col-md-10">
                  <label for="pessoaEmail"><sup class="obrigatorio">*</sup> Email:</label>  
                  <input 
                      class="form-control <?php echo (!empty($data['pessoaEmail_err'])) ? 'is-invalid' : ''; ?>"
                      type="text" 
                      name="pessoaEmail"
                      id="pessoaEmail"
                      value="<?php echo $data['pessoaEmail']; ?>"                       
                      placeholder="Email"
                  >
                  <div class="invalid-feedback">
                      <?php echo $data['pessoaEmail_err']; ?>
                  </div>                   
              </div>
            </div>                        
            <!--EMAIL-->


            <!--TELEFONE E CELULAR-->
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="pessoaTelefone"><sup class="obrigatorio">*</sup> Telefone:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['pessoaTelefone_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="pessoaTelefone"
                        id="pessoaTelefone"
                        value="<?php echo $data['pessoaTelefone']; ?>"                       
                        placeholder="Informe o telefone"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['pessoaTelefone_err']; ?>
                    </div>                   
                </div>           
            
           
                <div class="form-group col-md-6">
                    <label for="pessoaCelular"><sup class="obrigatorio">*</sup> Celular:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['pessoaCelular_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="pessoaCelular"
                        id="pessoaCelular"
                        value="<?php echo $data['pessoaCelular']; ?>"                       
                        placeholder="Informe o celular"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['pessoaCelular_err']; ?>
                    </div>                   
                </div>
            </div> 
            <!--TELEFONE E CELULAR-->


            <!--MUNICIPIO BAIRRO E LOGRADOURO-->
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="pessoaMunicipio"><sup class="obrigatorio">*</sup> Município:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['pessoaMunicipio_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="pessoaMunicipio"
                        id="pessoaMunicipio"
                        value="<?php echo $data['pessoaMunicipio']; ?>"                       
                        placeholder="Informe o município"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['pessoaMunicipio_err']; ?>
                    </div>                   
                </div>   
                
                <div class="form-group col-md-6">
                    <label for="pessoaLogradouro"><sup class="obrigatorio">*</sup> Logradouro:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['pessoaLogradouro_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="pessoaLogradouro"
                        id="pessoaLogradouro"
                        value="<?php echo $data['pessoaLogradouro']; ?>"                       
                        placeholder="Informe o logradouro"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['pessoaLogradouro_err']; ?>
                    </div>                   
                </div>      
            
           
                <div class="form-group col-md-3">
                <label for="bairroId"><sup class="obrigatorio">*</sup> Bairro:</label>                        
                  <select
                      name="bairroId"
                      id="bairroId"
                      class="form-select <?php echo (!empty($data['bairroId_err'])) ? 'is-invalid' : ''; ?>"
                  >
                  <option value="null">Selecione o Bairro</option> 
                  </select>
                  <span class="text-danger">
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
                        class="form-control <?php echo (!empty($data['pessoaUf_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="pessoaUf"
                        id="pessoaUf"
                        value="<?php echo $data['pessoaUf']; ?>"                       
                        placeholder="Informe Estado"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['pessoaUf_err']; ?>
                    </div>                   
                </div>   
                
                <div class="form-group col-md-3">
                    <label for="pessoaNascimento"><sup class="obrigatorio">*</sup> Nascimento:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['pessoaNascimento_err'])) ? 'is-invalid' : ''; ?>"
                        type="date" 
                        name="pessoaNascimento"
                        id="pessoaNascimento"
                        value="<?php echo $data['pessoaNascimento']; ?>"                       
                        placeholder="Informe a data de nascimento"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['pessoaNascimento_err']; ?>
                    </div>                   
                </div>     

                <div class="form-group col-md-3">
                    <label for="pessoaCpf"><sup class="obrigatorio">*</sup> CPF:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['pessoaUf_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="pessoaCpf"
                        id="pessoaCpf"
                        value="<?php echo $data['pessoaCpf']; ?>"                       
                        placeholder="Informe o CPF"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['pessoaCpf_err']; ?>
                    </div>                   
                </div>
            
           
                
            </div> 
            <!--UF NASCIMENTO CPF-->



        </div>
        <!-- FIM MODAL BODY -->

        <!-- BOTÕES -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary gravar" data-dismiss="modal" disabled>Gravar</button>
        </div>
        <!-- FIM BOTÕES -->
      </form>
      
    </div>
  </div>
  
</div>
<!-- MODAL -->




<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>

 

  $(document).ready(function(){
    carregaDados();
  });

  function carregaDados(){    
    $.ajax({
      url:'<?php echo URLROOT; ?>/modals/pessoas',
      method:'GET',     
      success: function(retorno_php){
        document.getElementById('tabelaPessoas').innerHTML = retorno_php;
      }
    });
  }




  const pesquisar = document.getElementById('pesquisar');   
  pesquisar.addEventListener('click', (e) => {  
   e.preventDefault();  
   search();
  });
  function search(){
    let nome=$("#pessoaNome").val();
    let municipio=$("#pessoaMunicipio").val();
    $.ajax({     
      url:'<?php echo URLROOT; ?>/modals/search',
      method:'GET',
      data:{
        nome:nome,
        municipio:municipio
      },
      success: function(retorno_php){
        document.getElementById('tabelaPessoas').innerHTML = retorno_php;
      }
    });
  }
 
</script>