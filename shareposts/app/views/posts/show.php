<?php require APPROOT . '/views/inc/header.php';?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i>Voltar</a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
 Escrito por <?php echo $data['user']->name;?> on <?php echo date('d/m/Y h:i:s', strtotime($data['post']->created_at)); ?> 
</div>
<p><?php echo $data['post']->body; ?></p>
<?php if($data['post']->user_id == $_SESSION[SE.'user_id']) : ?>
<hr>



<form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Editar</a>
    <input type="submit" value="Deletar" class="btn btn-danger">
</form>

    

<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>

