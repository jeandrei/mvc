<?php require APPROOT . '/views/inc/header.php';?>
<style>
/* style do carrocel */
@media (min-width: 768px) {
  .carousel-inner {
    display: flex;
  }
  .carousel-item {
    margin-right: 0;
    flex: 0 0 33.333333%;
    display: block;
  }
}

.carousel-inner{
    padding: 1em;
}
.card{
    margin: 0 .5em;
    box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
    border: none;
}
.carousel-control-prev, .carousel-control-next{
    background-color: #e1e1e1;
    width: 6vh;
    height: 6vh;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}


</style>
<!-- post_message é o nome da menságem está lá no controller -->
<?php flash('post_message'); ?>
<!-- mb-3 marging bottom -->
<div class="row mb-3">
    <div class="col-md-8">
        <h1>Postagens</h1>
    </div>
    <div class="col-md-4">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-end">
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
        <!-- se existir algum arquivo -->
        <?php if($post['files']) : ?>   
            <!-- Monta o carrocel -->
            <div id="carouselExampleControls" class="carousel" data-bs-ride="carousel">
                <div class="carousel-inner">             
                <?php $i=0;?>
                <?php foreach($post['files'] as $file) : ?>                 
                    <div class="carousel-item <?php echo ($i==0)?"active":""?>">
                    <div class="card">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($file["file"]); ?>" class="d-block w-100" alt="..." >
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $file['title'];?></h5>
                            <p class="card-text"><?php echo $file['body'];?></p>                           
                        </div>
                    </div>                  
                    </div>
                <?php $i=1;?>
                <?php endforeach; ?>                
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- fim carrocel -->
        <?php endif;?>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post['id']; ?>" class="btn btn-dark">
        Mais</a>

        
    </div>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>
/* jquery do carrocel 
fonte: https://codingyaar.com/bootstrap-carousel-multiple-items-increment-by-1/*/
var carouselWidth = $(".carousel-inner")[0].scrollWidth;
var cardWidth = $(".carousel-item").width();
var scrollPosition = 0;

$(".carousel-control-next").on("click", function () {
  if (scrollPosition < (carouselWidth - cardWidth * 4)) { //check if you can go any further
    scrollPosition += cardWidth;  //update scroll position
    $(".carousel-inner").animate({ scrollLeft: scrollPosition },600); //scroll left
  }
});

$(".carousel-control-prev").on("click", function () {
  if (scrollPosition > 0) {
    scrollPosition -= cardWidth;
    $(".carousel-inner").animate(
      { scrollLeft: scrollPosition },
      600
    );
  }
});

var multipleCardCarousel = document.querySelector(
  "#carouselExampleControls"
);
if (window.matchMedia("(min-width: 768px)").matches) {
  //rest of the code
  var carousel = new bootstrap.Carousel(multipleCardCarousel, {
    interval: false
  });
} else {
  $(multipleCardCarousel).addClass("slide");
}

</script>

