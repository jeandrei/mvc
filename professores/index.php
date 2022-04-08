<!--BOOTSTRAP-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




<!--jquery-->
<script src="js/jquery-3.1.1.js"></script>

<script type="text/javascript">


        //CARREGA AS TURMAS
        $(document).ready(function(){ 
                                            
            $('#escola_id').change(function(){   
                $('#professor_id').html( "<option>Escolha uma turma</option>" );            
                $('#turma_id').load('turmas.php?escola_id='+$('#escola_id').val() );

            });
        });

        //CARREGA OS PROFESSORES
        $(document).ready(function(){
            $('#turma_id').change(function(){                
                $('#professor_id').load('professores.php?turma_id='+$('#turma_id').val() );
            });
        });

        //CARREGA DADOS DE LINK E DISCIPLINA
        $(document).ready(function(){
            $('#professor_id').change(function(){                
                $('#result').load('result.php?escola_id='+$('#escola_id').val()+'&turma_id='+$('#turma_id').val()+'&professor_id='+$('#professor_id').val());
            });
        });

</script>






<?php

//inclui o banco de dados
include_once 'db.inc.php';
//inclui a biblioteca de funções
include_once 'helpers.php';


//SELECIONA TODAS AS ESCOLAS
try
  {
    $sql = 'SELECT * FROM escola';
    $s = $pdo->prepare($sql);    
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Erro ao tentar listar as escolas.';
    include 'error.html.php';
    exit();
  }

  $escolas = $s->fetchAll();
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
</head>
<body>
    
<div class="jumbotron text-center">
    <h1>Conteúdos postados pelos professores</h1>
    <p>Selecione a Escola, Turma e Professor!</p>
</div>


<form name="formulario" id="formulario">   
    <div class="container">
            <div class="row">
                
                <div class="col-sm-4">
                    <h3>Escola</h3>
                    <select 
                    name="escola_id" 
                    id="escola_id" 
                    class="form-control"                                        
                    >
                        <option value="NULL">Selecione a Escola</option>
                        <?php                                      
                        foreach($escolas as $escola) : ?> 
                            <option value="<?php echo $escola['id']; ?>"
                                        <?php if(isset($_POST['escola_id'])){
                                        echo $_POST['escola_id'] == $escola['id'] ? 'selected':'';
                                        }
                                        ?>
                            >
                                <?php echo $escola['nome'];?>
                            </option>
                        <?php endforeach; ?>  
                    </select>
                </div>
                
                
                <div class="col-sm-4">
                    <h3>Turma</h3>                                          
                    <select name="turma_id" id="turma_id" class="form-control" >
                        <option value="0">Escolha uma escola</option>
                    </select>
                </div>
                
                
                <div class="col-sm-4">
                    <h3>Professor</h3>
                    <select name="professor_id" id="professor_id" class="form-control" >
                        <option value="0">Escolha uma turma</option>
                    </select>
                </div>
                
               
            </div>

        
        <hr>             


        <div class="row">
            <div class="col-12 d-flex justify-content-center text-center">
            <div id="result" name="result"></div>
        </div>
    
    </div>    

</form>

    
</body>
</html>