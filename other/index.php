<?php

session_start();
include 'db/conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.min.css">
    <link rel="stylesheet" href="//rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css">
    <title>Consulta</title>
</head>
<body>
<div class="container">
<h1>Tabla usuarios</h1>


<div id="toolbar">
		<select class="form-control">
				<option value="">Export Basic</option>
				<option value="all">Export All</option>
				<option value="selected">Export Selected</option>
		</select>
</div>
<table id="table" 
			 data-toggle="table"
			 data-search="true"
			 data-filter-control="true" 
			 data-show-export="true"
			 data-click-to-select="true"
			 data-toolbar="#toolbar"
       class="table-responsive">
	<thead>
		<tr>
			<th data-field="state" data-checkbox="true"></th>
			<th data-field="prenom" data-filter-control="input" data-sortable="true">Nombre</th>
			<th data-field="date" data-filter-control="input" data-sortable="true">Apellido</th>
			<th data-field="examen" data-filter-control="input" data-sortable="true">Cédula</th>
		</tr>
	</thead>
    <tbody>

<?php

$list = mysqli_query($conexion," SELECT * FROM usuarios");?>

<td class="bs-checkbox "><input data-index="0" name="btSelectItem" type="checkbox"></td>
    <?php      while ($datos2 = mysqli_fetch_array($list)){
        $id = $datos2['id'];
        $nombre = $datos2['nombre'];
        $apellido = $datos2['apellido'];
        $cedula = $datos2['cedula'];
           
        echo "<tr><td>".$id."</td>".
             "<td>".$nombre."</td>".
             "<td>".$apellido."</td>".
             "<td>".$cedula."</td></tr>";
    }
    ?>

	</tbody>
</table>
</div>


<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js"></script>
<script src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js"></script>


<script>

var $table = $('#table');
    $(function () {
        $('#toolbar').find('select').change(function () {
            $table.bootstrapTable('refreshOptions', {
                exportDataType: $(this).val()
            });
        });
    })

		var trBoldBlue = $("table");

	$(trBoldBlue).on("click", "tr", function (){
			$(this).toggleClass("bold-blue");
	});
</script>
</body>
</html>