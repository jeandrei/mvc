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



DATATALES INDEX



<!-- jquery.dataTable.min.js -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function() {
    $('#jquery-datatable-ajax-php').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'<?php echo URLROOT; ?>/admins/index'//Arquivo php que faz a consulta no banco de dados
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