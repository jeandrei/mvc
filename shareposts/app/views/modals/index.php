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

<script>
  function getBairros(){  
  $.ajax({
    url:'<?php echo URLROOT; ?>/modals/getBairros',
      method:'POST',         
      async: false,
      dataType: 'json'
    }).done(function (response){
      ret_val = response;
    }).fail(function (jqXHR, textStatus, errorThrown) {
      ret_val = null;
    });
   return ret_val;
}
  let bairros = getBairros();
</script>
<!-- Require o modal de adicionar pessoa addPessoaModal -->
<?php require 'addPessoaModal.php'; ?>

<!-- Require o modal edit editPessoaModal -->
<?php require 'editPessoaModal.php'; ?>

<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>

  const UISelectors = {
    addModal: "#addPessoaModal",
    editModal:"#editPessoaModal",
    flashMessage: "#msg",
    tabela: "#tabelaPessoas",
    btnGravar:"#gravar",
    btnUpdate:"#btnUpdate",
    btnFecharAddModel:"#btnFecharAddModel",
    btnFecharEditModel:"#btnFecharEditModel",
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
    pessoaCpf:"#pessoaCpf",
    updatePessoaNome:"#updatePessoaNome",
    updatePessoaEmail:"#updatePessoaEmail",
    updatePessoaTelefone:"#updatePessoaTelefone",
    updatePessoaCelular:"#updatePessoaCelular",
    updatePessoaMunicipio:"#updatePessoaMunicipio",
    updatePessoaLogradouro:"#updatePessoaLogradouro",
    updateBairroId:"#updateBairroId",
    updatePessoaUf:"#updatePessoaUf",
    updatePessoaNascimento:"#updatePessoaNascimento",
    updatePessoaCpf:"#updatePessoaCpf"
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



  //Pega os dados do formulário
  function getFormDataUpdate(){
    const data = {
      updatePessoaNome:$(UISelectors.updatePessoaNome).val(),
      updatePessoaEmail:$(UISelectors.updatePessoaEmail).val(),
      updatePessoaTelefone:$(UISelectors.updatePessoaTelefone).val(),
      updatePessoaCelular:$(UISelectors.updatePessoaCelular).val(),
      updatePessoaMunicipio:$(UISelectors.updatePessoaMunicipio).val(),
      updatePessoaLogradouro:$(UISelectors.updatePessoaLogradouro).val(),
      updateBairroId:$(UISelectors.updateBairroId).val(),
      updatePessoaUf:$(UISelectors.updatePessoaUf).val(),
      updatePessoaNascimento:$(UISelectors.updatePessoaNascimento).val(),
      updatePessoaCpf:$(UISelectors.updatePessoaCpf).val()
      
    }
    return data;
  }

  //Botão de Gravar do Modal
  const gravarBtn = document.querySelector(UISelectors.btnGravar);

  //Botão de Update do Modal Update
  const btnUpdate = document.querySelector(UISelectors.btnUpdate);
  
  // Botão fechar do Modal
  const btnFecharAddModel = document.querySelector(UISelectors.btnFecharAddModel);

  //Botão de pesquisar da página inicial
  const btnPesquisar = document.querySelector(UISelectors.btnPesquisar);

  //Botão Adicionar da página Inicial 
  const btnAdicionar = document.querySelector(UISelectors.btnAdicionar);

    
  //Limpa os campos ao clicar em adicionar
  btnAdicionar.addEventListener('click',clearFields);

  //Botão fechar do Modal Add
  btnFecharAddModel.addEventListener('click',closeModalAdd);

  //Botão fechar do Modal Edit
  btnFecharEditModel.addEventListener('click',closeModalEdit);

  

  
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
            showModalAdd();
          } else {
            $(UISelectors.flashMessage)
                    .removeClass()                       
                    .addClass(responseObj.classe)
                    .html(responseObj.message)
                    .fadeIn(4000).fadeOut(4000);
            closeModalAdd();            
          }                     
      }
    });
    carregaDados();
  });
   

  btnUpdate.addEventListener('click', (e) => {  

    e.preventDefault(); 
    const id = $("#hiddendata").val();    
    //pego os dados do formulário
    const data = getFormDataUpdate();    
    $.ajax({     
      url:'<?php echo URLROOT; ?>/modals/update/'+id,
      method:'POST',
      //passo os dados do formulário
      data,
      success: function(retorno_php){  
        let responseObj = JSON.parse(retorno_php);
        
        if(responseObj.error!==false){               
             
              for (let [key, value] of entries(responseObj.error)) {                           
                  
                  $("#"+key+"_err") 
                      .addClass("text-danger")
                      .html(value)                  
                  if(value){                   
                    $("#"+key) 
                      .addClass("is-invalid")
                  } else {
                    $("#"+key) 
                      .removeClass("is-invalid")
                  }  
              }
            showModalEdit();
          } else {
            $(UISelectors.flashMessage)
                    .removeClass()                       
                    .addClass(responseObj.classe)
                    .html(responseObj.message)
                    .fadeIn(4000).fadeOut(4000);
            closeModalEdit();            
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

 
  function showModalAdd(){
    $(UISelectors.addModal).modal('show');
  }

  function closeModalAdd(){
    $(UISelectors.addModal).modal('hide');
  }

  function showModalEdit(){
    $(UISelectors.editModal).modal('show');
  }

  function closeModalEdit(){
    $(UISelectors.editModal).modal('hide');
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


  function excluir(id){
    const con = confirm('Tem Certeza que deseja excluir o registro?');
    $.ajax({     
      url:'<?php echo URLROOT; ?>/modals/delete/'+id,
      method:'POST',      
      success: function(retorno_php){        
        search();       
      }
    });
  }

  function edit(id){
   //passa o id lá para o model no input hiddendata
   $('#hiddendata').val(id);
   

   $.post(`<?php echo URLROOT; ?>/modals/edit/${id}`,function(data,status){
    let result=JSON.parse(data);    
    $('#updatePessoaNome').val(result.pessoaNome);
    $('#updatePessoaEmail').val(result.pessoaEmail);
    $('#updatePessoaTelefone').val(result.pessoaTelefone);
    $('#updatePessoaCelular').val(result.pessoaCelular);
    $('#updatePessoaMunicipio').val(result.pessoaMunicipio);
    $('#updatePessoaLogradouro').val(result.pessoaLogradouro);
    $('#updateBairroId').val(result.bairroId);
    $('#updatePessoaUf').val(result.pessoaUf);
    $('#updatePessoaNascimento').val(result.pessoaNascimento);
    $('#updatePessoaCpf').val(result.pessoaCpf);    
   })

   showModalEdit();
  } 

 
</script>