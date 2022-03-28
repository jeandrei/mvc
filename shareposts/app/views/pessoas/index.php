<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>




<script>
/**
 * Funções para manipulação do formulário
 * limpar - limpa os campos com valores do formulário
 * focofield - seta o foco em um campo do formulário
 * 
 */
function limpar(){
        document.getElementById('pessoaNome').value = "";                
        focofield("pessoaNome");
    }    
    
    window.onload = function(){
        focofield("pessoaNome");
    }     

</script>




<!-- FLASH MESSAGE -->
<!-- pessoa_message é o nome da menságem está lá no controller -->
<?php flash('pessoa_message'); ?>
<!-- mb-3 marging bottom -->




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
  </div> 
  
  <div class="col-md-6 align-self-end mt-2" style="padding-left:5;">
           
      <input type="submit" class="btn btn-primary" value="Atualizar">                   
      <input type="button" class="btn btn-primary" value="Limpar" onClick="limpar()">       
                                                       
  </div> 
</form>




<!-- ADD NEW -->
<div class="row mb-3">
    <div class="col-md-6">
        <h1><?php echo $data['titulo']; ?></h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/pessoas/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Adicionar Pessoa
        </a>
    </div>
</div>


<?php 


$results = '';
if(!empty($data['results'])){
  foreach($data['results'] as $row){
    $results.=' <tr>
                  <td>'.$row['pessoaNome'].'</td>
                  <td>'.$row['pessoaNascimento'].'</td>
                  <td>'.$row['pessoaMunicipio'].'</td>
                  <td>'.$row['pessoaLogradouro'].'</td>
                  <td>'.$row['pessoaBairro'].'</td>
                  <td>'.$row['pessoaDeficiencia'].'</td>
                  <td>
                    <a href="'.URLROOT.'/pessoas/edit/'.$row['pessoaId'].'">
                      <buton type="button" class="btn btn-primary">Editar</button>
                    </a>
                    <a href="'.URLROOT.'/pessoas/delete/'.$row['pessoaId'].'">
                      <buton type="button" class="btn btn-danger">Excluir</button>
                    </a>
                  </td>
                 
                </tr>
              ';
  }
}else {
  $results = '<tr>
  <td colspan="6" class="text-center">
      Nenhuma vaga encontrada
  </td>';  
}   
 

?>



<!-- TABELA -->
<table class="table table-striped">
  <thead>
    <tr>      
      <th scope="col">Nome</th>
      <th scope="col">Nascimento</th>
      <th scope="col">Municipio</th>
      <th scope="col">Logradouro</th>
      <th scope="col">Bairro</th>
      <th scope="col">PCD</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
      <?php echo $results; ?>
  </tbody>
</table>




<!-- PAGINAÇÃO -->
<?php
    $pagination = $data['pagination'];     
    // no index a parte da paginação é só essa    
    echo '<p>'.$pagination->links_html.'</p>';   
    echo '<p style="clear: left; padding-top: 10px;">Total de Registros: '.$pagination->total_results.'</p>';   
    echo '<p>Total de Paginas: '.$pagination->total_pages.'</p>';
    echo '<p style="clear: left; padding-top: 10px; padding-bottom: 10px;">-----------------------------------</p>';
?>



<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>