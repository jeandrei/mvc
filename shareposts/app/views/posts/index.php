<?php require APPROOT . '/views/inc/header.php';?>
<!-- post_message é o nome da menságem está lá no controller -->
<?php flash('post_message'); ?>
<!-- mb-3 marging bottom -->
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Postagens</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Adicionar Postagem
        </a>
    </div>
</div>

<?php foreach($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post['title']; ?></h4>
        <div class="bg-light p-2 mb-3">
          Escrito por <?php echo $post['name']; ?> em <?php echo date('d/m/Y h:i:s', strtotime($post['created_at'])); ?>
        </div>
        <p class="card-text"><?php echo $post['body']; ?></p>

        <!-- ******************************************************************* -->
        
        <?php if($post['files']) : ?>
            <!-- Gallery -->
            <div class="row">                              
                <?php foreach($post['files'] as $file) : ?> 
                    <!-- col -->  
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">                        
                        <!-- card -->
                        <?php echo ($file['title']) ? "<div class='card mb-3'>":""?>                        
                            <img
                            src="data:image/jpeg;base64,<?php echo base64_encode($file["file"]); ?>" width="375" height="250"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="Boat on Calm Water"
                            />
                            <?php if($file['title']) : ?>
                                <!-- card body -->
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $file['title'];?></h5>
                                    <p class="card-text"><?php echo $file['body'];?></p>
                                </div>
                                <!-- card body -->
                            <?php endif; ?>                          
                        <?php echo ($file['title']) ? "</div>":""?>
                        <!-- card -->                        
                    </div>
                    <!-- col -->  
                <?php endforeach; ?>  
            </div>
            <!-- row -->
        <?php endif; ?>    
       

        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post['id']; ?>" class="btn btn-dark">
        Mais</a>

        
    </div>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>

