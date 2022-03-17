<?php require APPROOT . '/views/inc/header.php'; ?>    
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i>Voltar</a>
    <div class="card card-body bg-light mt-5">       
        <h2>Adicionar Postagem</h2>
        <p>Crie um Postagem</p>                               
        <form action="<?php echo URLROOT; ?>/posts/add" method="post">  
                    
            <!--EMAIL-->
            <div class="form-group">   
                <label 
                    for="title"><b class="obrigatorio">*</b> Título: 
                </label>                        
                <input 
                    type="text" 
                    name="title" 
                    placeholder="Informe um título para o post",
                    class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"                             
                    value="<?php echo $data['title'];?>"
                >
                <span class="invalid-feedback">
                    <?php echo $data['title_err']; ?>
                </span>
            </div>

            <!--Body-->
            <div class="form-group">   
                <label 
                    for="body"><b class="obrigatorio">*</b> Texto: 
                </label>                        
                <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body'];?></textarea>
                
                <span class="invalid-feedback">
                    <?php echo $data['body_err']; ?>
                </span>
            </div>

            <input type="submit" class="btn btn-success" value="Enviar">
            
        </form>
    </div>          
<?php require APPROOT . '/views/inc/footer.php'; ?>