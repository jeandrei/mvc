<?php require APPROOT . '/views/inc/header.php'; ?>    
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i>Back</a>
    <div class="card card-body bg-light mt-5">       
        <h2>Edit Post</h2>
        <p>Create a post with this form</p>                               
        <form id="editPost" action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">  
                    
            <!--EMAIL-->
            <div class="form-group">   
                <label 
                    for="title"><b class="obrigatorio">*</b> Título: 
                </label>                        
                <input 
                    type="text" 
                    name="title"
                    id="title"  
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
                    for="password"><b class="obrigatorio">*</b> Texto: 
                </label>                        
                <textarea name="body" id="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body'];?></textarea>
                
                <span class="invalid-feedback">
                    <?php echo $data['body_err']; ?>
                </span>
            </div>

            <input type="submit" class="btn btn-success" value="Submit">
            
        </form>
    </div>          
<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>  
 $(document).ready(function(){
	$('#editPost').validate({
		rules : {
			title : {
				required : true,
				minlength : 3
			},
            body : {
				required : true,
				minlength : 30
			}   
		},
		messages : {
			title : {
				required : 'Por favor informe um título.',
				minlength : 'O título deve ter no mínimo 3 caracteres.'
			},
            body : {
				required : 'Por favor informe o corpo do post.',
				minlength : 'O corpo do post deve ter no mínimo 30 caracteres.'
			}
        }
    });
});
</script>