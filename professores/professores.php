<?php

$turma_id = $_GET['turma_id'];

include_once 'db.inc.php';   

   try
  {
    $sql = 'SELECT * FROM professor WHERE turma_id = :turma_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':turma_id', $turma_id);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Erro ao tentar listar as turmas.';
    include 'error.html.php';
    exit();
  }

  $professores = $s->fetchAll();
  
  if(empty($professores)){
    die("<option>Sem professores para esta turma</option>");
  }

  echo ("<option>Escolha um professor</option>");
  foreach($professores as $professor){
    echo "<option value='".$professor['id']."'>".$professor['nome']."</option>";

}

?>
