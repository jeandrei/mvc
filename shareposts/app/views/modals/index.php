<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>

<!-- MENSAGEM -->
<div class="row">
  <div class="col-12">
    <div id="msg"></div>
  </div>
</div>


<!-- ADD NEW -->
<div class="row mb-3">
    <div class="col-md-6">
        <h1><?php echo $data['titulo']; ?></h1>
    </div>  

    <div class="col-md-6"> 
        <button type="button" id="btnAdicionar" class="btn btn-primary float-end" data-toggle="modal" data-target="#addPessoaModal">
        <i class="fa fa-pencil"></i> Adicionar Pessoa</button> 
    </div>
</div>


<!-- FORMULÁRIO -->
<form id="filtrar" action="<?php echo URLROOT; ?>/pessoas/index" method="get" enctype="multipart/form-data">
  <div class="row mt-2">
    <div class="col-md-3">
      <label for="buscaNome">
        Buscar por Nome:
      </label>
      <input
        type="text"
        name="buscaNome"
        id="buscaNome"
        class="form-control"
        value="<?php echo $_GET['buscaNome'];?>"
      >
      <span class="invalid-feedback">

      </span>
    </div>


    <div class="col-md-3">
      <label for="buscaMunicipio">
        Buscar por Município:
      </label>
      <input
        type="text"
        name="buscaMunicipio"
        id="buscaMunicipio"
        class="form-control"
        value="<?php echo $_GET['buscaMunicipio'];?>"
      >
      <span class="invalid-feedback">

      </span>
    </div>
  </div> 
  
  <div class="col-md-6 align-self-end mt-2" style="padding-left:5;">           
      <button class="btn btn-primary" id="btnPesquisar">Pesquisar</button>
      <input type="button" class="btn btn-primary" value="Limpar" onClick="limpar()">                                                
  </div>   


</form>
<!-- FORMULÁRIO -->





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
            <button type="button" class="btn btn-secondary" id="btnFechar" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary gravar" id='gravar' data-dismiss="modal">Gravar</button>
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

  const UISelectors = {
    modal: "#addPessoaModal",
    msg: "#msg",
    tabela: "#tabelaPessoas",
    btnGravar:"#gravar",
    btnFechar:"#btnFechar",
    btnPesquisar:"#btnPesquisar",
    btnAdicionar:"#btnAdicionar",
    buscaNome:"#buscaNome",
    buscaMunicipio:"#buscaMunicipio",
    pessoaNome:"#pessoaNome",
    pessoaEmail:"#pessoaEmail",
    pessoaTelefone:"#pessoaTelefone",
    pessoaCelular:"#pessoaCelular",
    pessoaMunicipio:"#pessoaMunicipio",
    pessoaLogradouro:"#pessoaLogradouro",
    bairroId:"#bairroId",
    pessoaUf:"#pessoaUf",
    pessoaNascimento:"#pessoaNascimento",
    pessoaCpf:"#pessoaCpf"
  }

  //Pega os dados do formulário
  function getFormData(){
    const data = {
      pessoaNome:$(UISelectors.pessoaNome).val(),
      pessoaEmail:$(UISelectors.pessoaEmail).val(),
      pessoaTelefone:$(UISelectors.pessoaTelefone).val(),
      pessoaCelular:$(UISelectors.pessoaCelular).val(),
      pessoaMunicipio:$(UISelectors.pessoaMunicipio).val(),
      pessoaLogradouro:$(UISelectors.pessoaLogradouro).val(),
      bairroId:$(UISelectors.bairroId).val(),
      pessoaUf:$(UISelectors.pessoaUf).val(),
      pessoaNascimento:$(UISelectors.pessoaNascimento).val(),
      pessoaCpf:$(UISelectors.pessoaCpf).val()
    }
    return data;
  }

  //Botão de Gravar do Modal
  const gravarBtn = document.querySelector(UISelectors.btnGravar);
  
  // Botão fechar do Modal
  const btnFechar = document.querySelector(UISelectors.btnFechar);

  //Botão de pesquisar da página inicial
  const btnPesquisar = document.querySelector(UISelectors.btnPesquisar);

  //Botão Adicionar da página Inicial 
  const btnAdicionar = document.querySelector(UISelectors.btnAdicionar);

    
  //Limpa os campos ao clicar em adicionar
  btnAdicionar.addEventListener('click',clearFields);

  //Botão fechar do Modal
  btnFechar.addEventListener('click',closeModal);

  
  // Ao Carregar o documento carregamos os dados existentes
  $(document).ready(function(){
    carregaDados();
  });
  
 
  btnPesquisar.addEventListener('click', (e) => {  
   e.preventDefault();  
   search();
  });

  
  gravarBtn.addEventListener('click', (e) => {
    e.preventDefault();    
    //pego os dados do formulário
    const data = getFormData();
    $.ajax({     
      url:'<?php echo URLROOT; ?>/modals/add',
      method:'POST',
      //passo os dados do formulário
      data,
      success: function(retorno_php){
        //document.getElementById('teste').innerHTML = retorno_php;
        let responseObj = JSON.parse(retorno_php);

        if(responseObj.error!==false){           
                                                     
              /**
              IMPORTANTE TEM QUE TER ID NO SPAN PARA FUNCIONAR
              aqui key traz a chave exemplo pessoaNome_err
              e value traz o erro exemplo Por favor informe o nome
              então na linha  $("#"+key) ele monta $("#pessoaNome_err")
              para cada erro que tiver no array responseObj.error que vem
              do controller
              */ 
              for (let [key, value] of entries(responseObj.error)) {                            
                  // aqui ele monta o erro pessoaNome_err
                  $("#"+key+"_err") 
                      .addClass("text-danger")
                      .html(value)
                  //se tiver algo no value quer dizer que tem erro e adicionamos a classe in-invalid caso contrário removemos a classe
                  if(value){
                    // aqui ele monta o id do input #pessoaNome
                    $("#"+key) 
                      .addClass("is-invalid")
                  } else {
                    $("#"+key) 
                      .removeClass("is-invalid")
                  }
                     
                      
              }
            showModal();
          } else {
            $("#msg")
                    .removeClass()                       
                    .addClass(responseObj.classe)
                    .html(responseObj.message);
                    /* .fadeIn(4000).fadeOut(4000); */
            closeModal();            
          }        

                
      }
    });
    carregaDados();
  });
   


  
  /**
   * Função que carrega os dados existentes
   * Envia a solicitação para o controller modals/pessoas
   * Retorna o html com a tabela e os dados
   * e insere no id da tabela
   */
  function carregaDados(){    
    $.ajax({
      url:'<?php echo URLROOT; ?>/modals/pessoas',
      method:'GET',     
      success: function(retorno_php){        
        $(UISelectors.tabela).html(retorno_php);
      }
    });
  }


  /**
   * Função que chama o controller modals/search
   * passando através do GET o nome da pessoa e o município
   * lá no controller chama o model que faz a busca e retorna um 
   * html com a tabela e os dados que são inseridos no id da tabela
   */
  function search(){
    let nome=$(UISelectors.buscaNome).val();
    let municipio=$(UISelectors.buscaMunicipio).val();
    $.ajax({     
      url:'<?php echo URLROOT; ?>/modals/search',
      method:'GET',
      data:{
        nome:nome,
        municipio:municipio
      },
      success: function(retorno_php){
       $(UISelectors.tabela).html(retorno_php);
      }
    });
  }


  //Função necessária para rodar esse for  for (let [key, value] of entries(responseObj.error)) {
  function* entries(obj) {
      for (let key of Object.keys(obj)) {
          yield [key, obj[key]];
      }
  }

  function showModal(){
    $(UISelectors.modal).modal('show');
  }

  function closeModal(){
    $(UISelectors.modal).modal('hide');
  }
  
  function clearFields(){
    const data =  getFormData();   
    for (const key of Object.keys(data)) {        
      $("#"+key).val('');
      $("#"+key).removeClass("is-invalid");
      $("#"+key+"_err")
                      .removeClass("text-danger")
                      .html('')
    }
  }


  
 
</script>