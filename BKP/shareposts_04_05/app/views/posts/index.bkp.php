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
        <?php var_dump(count($post['files'])); echo fmod(12,3);?>
        
        <!-- Carousel wrapper -->
        <div
        id="carouselMultiItemExample"
        class="carousel slide carousel-dark text-center"
        data-mdb-ride="carousel"
        >
            <!-- Controls -->
            <div class="d-flex justify-content-center mb-4">
                <!-- Button Previous -->
                <button
                    class="carousel-control-prev position-relative"
                    type="button"
                    data-mdb-target="#carouselMultiItemExample"
                    data-mdb-slide="prev"
                >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <!-- Button Next -->
                <button
                    class="carousel-control-next position-relative"
                    type="button"
                    data-mdb-target="#carouselMultiItemExample"
                    data-mdb-slide="next"
                >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            
            </div>
            <!-- Controls -->
            <!-- Inner -->
            <div class="carousel-inner py-4">     
                <!-- Single item -->
                <div class="carousel-item active">
                    <!-- container -->
                    <div class="container">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->                           
                            <div class="col-lg-4">                                
                                <!-- card -->
                                <div class="card">
                                    <img
                                        src="https://mdbcdn.b-cdn.net/img/new/standard/nature/181.webp"
                                        class="card-img-top"
                                        alt="Waterfall"
                                    />
                                    <!-- card body -->
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk
                                        of the card's content.
                                        </p>
                                        <a href="#!" class="btn btn-primary">Button</a>
                                    </div>
                                    <!-- card body -->
                                </div>
                                <!-- card -->                                
                            </div>
                            <!-- col -->
                            
                        </div>
                        <!-- row -->                    
                    </div>
                     <!-- container -->
                </div>
                <!-- Single item -->                
            </div>
            <!-- Inner -->
        </div>
        <!-- Carousel wrapper -->
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
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

