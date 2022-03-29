<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>


<!-- FLASH MESSAGE -->
<!-- pessoa_message é o nome da menságem está lá no controller -->
<?php flash('pessoa_message'); ?>
<!-- mb-3 marging bottom -->

<!-- TÍTULO -->
<div class="row text-center">
    <h1><?php echo $data['titulo']; ?></h1>
</div>


<!-- FORMULÁRIO -->
<form id="filtrar" action="<?php echo URLROOT; ?>/pessoas/add" method="post" enctype="multipart/form-data">
    <!-- PRIMEIRA LINHA -->
    <div class="row">        
        <div class="col-md-8">                        
            <!--pessoaNome-->
            <div class="mb-3">   
                <label 
                    for="pessoaNome"><b class="obrigatorio">*</b> Nome: 
                </label>                        
                <input 
                    type="text" 
                    name="pessoaNome" 
                    id="pessoaNome" 
                    class="form-control <?php echo (!empty($data['pessoaNome_err'])) ? 'is-invalid' : ''; ?>"                             
                    value="<?php echo $data['pessoaNome_err'];?>"
                >
                <span class="invalid-feedback">
                    <?php echo $data['pessoaNome_err']; ?>
                </span>
            </div>
        </div><!-- col -->
   
        <div class="col-md-4"> 
            <!--pessoaEmail-->
            <div class="mb-3">   
                <label 
                    for="pessoaEmail"><b class="obrigatorio">*</b> Email: 
                </label>                        
                <input 
                    type="text" 
                    name="pessoaEmail" 
                    id="pessoaEmail" 
                    class="form-control <?php echo (!empty($data['pessoaEmail_err'])) ? 'is-invalid' : ''; ?>"                             
                    value="<?php echo $data['pessoaEmail'];?>"
                >
                <span class="invalid-feedback">
                    <?php echo $data['pessoaEmail_err']; ?>
                </span>
            </div>           
        </div><!-- col -->
    </div><!-- row -->

    <!-- TERCEIRA LINHA -->
    <div class="row">
        <div class="col-md-4"> 
            <!--pessoaTelefone-->
            <div class="mb-3">   
                <label 
                    for="pessoaTelefone"><b class="obrigatorio">*</b> Telefone: 
                </label>                        
                <input 
                    type="text" 
                    name="pessoaTelefone" 
                    id="pessoaTelefone" 
                    class="form-control <?php echo (!empty($data['pessoaTelefone_err'])) ? 'is-invalid' : ''; ?>"                             
                    value="<?php echo $data['pessoaTelefone'];?>"
                >
                <span class="invalid-feedback">
                    <?php echo $data['pessoaTelefone_err']; ?>
                </span>
            </div>           
        </div><!-- col -->

        <div class="col-md-4"> 
            <!--pessoaCelular-->
            <div class="mb-3">   
                <label 
                    for="pessoaCelular"><b class="obrigatorio">*</b> Celular: 
                </label>                        
                <input 
                    type="text" 
                    name="pessoaCelular" 
                    id="pessoaCelular" 
                    class="form-control <?php echo (!empty($data['pessoaCelular_err'])) ? 'is-invalid' : ''; ?>"                             
                    value="<?php echo $data['pessoaCelular'];?>"
                >
                <span class="invalid-feedback">
                    <?php echo $data['pessoaCelular_err']; ?>
                </span>
            </div>           
        </div><!-- col -->

    </div><!-- row -->





            
        
    
    
</form>





<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>