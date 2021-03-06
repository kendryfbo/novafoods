<?php
	date_default_timezone_set('UTC');
	$fecha=date("Y-m-d");
	include_once("clases/conexion.php"); 
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	} 
	$user=($_SESSION['usuario']);
	$id_Usuario=($_SESSION['id_Usuario']);  
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Informes</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_informes.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">	
	<link href="css/estilo_tabla.css" type="text/css" rel="stylesheet"/>
	<link href="css/jquery-ui.css" type="text/css" rel="stylesheet"/>
	<link href="css/datatables.css" type="text/css" rel="stylesheet"/>
	<script src="js/jquery-ui.js"></script>
	<script src="js/datatables.js"></script>
</head>
<script>
$(document).ready(function() {
	$('#dataTable_inc').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	});
	$("#fecha_inicio").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	 $( "#fecha_inicio" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_fin").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	 $( "#fecha_fin" ).datepicker( $.datepicker.regional[ "es" ]);
	
});
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Informe Ventas Por Cliente</p>
					</div>
					<div class="content">  
						<div>  
							<div class="fright">
								<a href="principal_gerencia.php" ><input type="button" value="Volver&raquo;"/></a>
							</div>
						</div>
					 	<table class="tableform">
							<tr>
								<td>
									<label>Tipo de Cliente</label>
								</td>
								<td>
									<label>Cliente</label>
								</td>
								<td>
									<label>Desde</label>
								</td>
								<td>
									<label>Hasta</label>
								</td>
							</tr>
							<tr>
								<td>
									<select id="tipo_cliente">
										<option selected id='0' >Seleccione Tipo de Cliente.....</option>
										<option id="1">Nacional</option>
										<option id="2">Internacional</option>
									</select>
									<div id="valida-cliente" style="display:none" class="errores">
										Debe Ingresar Cliente
									</div> 
								</td>
								<td id="cliente">
								</td>
								<td>
									<input type="text" id="fecha_inicio" placeholder="Desde" readonly/>
								</td>
								<td>
									<input type="text" id="fecha_fin" placeholder="Hasta" readonly/>
								</td>
								<td>
									<div class="fright"> 
										<input type="submit" onClick='$(this).trae_informe();' value="Crear Informe &raquo;"/> 
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="5" id="cargaData">
								</td>
							</tr>
						</table>
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>