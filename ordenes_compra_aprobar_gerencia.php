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
	<title>Gerencia NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js" type="text/javascript"></script>
	<script src="js/funcion_orden_compra.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var stream="";
	$.ajax({
		type: "POST",
		url: "select/trae_orden_gerencia_aprobar.php",
		data:stream,
		success: function(data)	{	
			$("#orden").append(data);
		}			
	}); 
});
</script>
<body>
<?php
	include_once("menu/menu_finanzas.php");
?>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fleft">
										<br>
										<h1>Ordenes de Compra</h1>
									</div>
								</div>
								<br>
								<div class="module_content">
									<table class="tablesorter"> 
										<thead> 
											<tr>
												<th>
													Fecha
												</th>
												<th>
													Estado Orden de Compra
												<th>
													Detalle
												</th>
											</tr> 
										</thead>
										<tbody id='orden'>
										</tbody>
									</table>
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