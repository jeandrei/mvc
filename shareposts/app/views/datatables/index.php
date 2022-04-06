<!-- HEADER -->
<?php require APPROOT . '/views/inc/header.php';?>

<!-- jquery.dataTable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


<!-- FLASH MESSAGE -->
<!-- pessoa_message é o nome da menságem está lá no controller -->
<?php flash('mensagem'); ?>
<!-- mb-3 marging bottom -->

<!-- TÍTULO -->
<div class="row text-center">
    <h1><?php echo $data['titulo']; ?></h1>
</div>

<!-- LINHA PARA A MENSÁGEM DO JQUERY -->
<div class="container">
    <div class="row" style="height: 50px;  margin-bottom: 25px;">
        <div class="col-12">
            <div role="alert" id="messageBox" style="display:none"></div>
        </div>
    </div>
</div>


<!-- Tabela com os campos de cabeçalho -->
<div class="container mt-5">
		<h2 style="margin-bottom: 30px;">DataTable com dados do banco de dados em php</h2>
		<table id="jquery-datatable-ajax-php" class="display" style="width:100%">
	        <thead>
	            <tr>
	                <th>Email</th>
	                <th>Firstname</th>
	                <th>Lastname</th>
	                <th>Address</th>
	            </tr>
	        </thead>
	    </table>
	</div>




<!-- jquery.dataTable.min.js -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script>

$(document).ready(function() {   
    $('#jquery-datatable-ajax-php').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'POST',
        'ajax': {
            'url':'<?php echo URLROOT; ?>/datatables/datatable'//Arquivo php que faz a consulta no banco de dados                     
        },
            "oLanguage": {//tradução para o português
            "sProcessing":      "Procesando...",
            "sLengthMenu":      "Mostrando _MENU_ registros por página",
            "sEmptyTable":      "Nenhum dado disponível na tabela",
            "sZeroRecords":     "Ops! Nada encontrado.",
            "sInfo":            "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty":       "Mostrando de 0 até 0 de 0 records",
            "sInfoFiltered":    "(filtrado de _MAX_ total de registros)",
            "sSearch":          "Buscar:",
            "sUrl":             "",
            "sInfoThousands":   ",",
            "sLoadingRecords":  "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            }
        },
        'columns': [ //Colunas onde os dados serão populados
            { data: 'email' },
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'address' }
        ]
    });
} );



   


</script>



<!-- FOOTER -->
<?php require APPROOT . '/views/inc/footer.php'; ?>