<?php
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
<!DOCTYPE html> 
<html lang="es"> 
<head>
	<title>POP NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet"/>
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui-custom.min.js"></script>
	<script src="js/funcion_ingreso_productos_bodega.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
	var stream="funcion="+4;
	$.ajax({
		type: "POST",
		url: "select/trae_orden_material_pop_aprobar_ingreso.php",
		data:stream,
		success: function(data)	{	
			$("#orden").append(data);
		}			
	});
});
</script>
 </head> 
<body>
<?php
	include_once("menu/menu_gerencia.php");
?>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div class="module_content">
									<table class='tablesorter' id='orden'>										 
									<table>
								</div>
							</article>
						</section>
					</div>	
				</div>
			</div>
		</td>	
	</tr>	
</table>
</body>
</html>