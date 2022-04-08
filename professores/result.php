<?php

$escola_id = $_GET['escola_id'];
$turma_id = $_GET['turma_id'];
$professor_id = $_GET['professor_id'];

include_once 'db.inc.php';

   try
  {
    $sql = '
              SELECT professor.nome as professor,escola.nome as escola, turma.turma, disciplina.disciplina, professor.link 
              FROM professor,escola, turma, disciplina 
              WHERE 
              escola.id = turma.escola_id
              AND
              professor.turma_id = turma.id 
              AND professor.disciplina_id = disciplina.id 
              AND professor.id = :professor_id AND professor.turma_id = :turma_id
            ';
    $s = $pdo->prepare($sql);
    $s->bindValue(':professor_id', $professor_id);
    $s->bindValue(':turma_id', $turma_id);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Erro ao tentar listar as turmas.';
    include 'error.html.php';
    exit();
  }

  // se for mais de um registro usa o fetchAll()
  //$professor = $s->fetchAll();
  
  $professor = $s->fetch();

  if(empty($professor)){
    die("<p>Sem professore para esta turma.");
  }

 echo "<p>Escola: " . $professor["escola"] . "<p>Professor: " . $professor["professor"] . "<p>Turma: " . $professor["turma"] . "<p>Disciplina: " . $professor["disciplina"]; 
 echo "<p> Link de acesso: <a href='" . $professor["link"] . "'>Clique aqui</a>"



?>
