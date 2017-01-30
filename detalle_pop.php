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
	$id_egreso=$_GET['id_egreso']; 
?>	
<!DOCTYPE html> 
<html lang="es"> 
<head>
	<title>POP NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_pedido_productos.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_egreso = "<?php echo $id_egreso; ?>"; 
	var stream="id_egreso="+id_egreso+"&"+"funcion="+2;
	$.ajax({
		type: "POST",
		url: "select/trae_orden_material_pop_aprobar_egreso.php",
		data:stream,
		success: function(data)	{	
			$("#orden").append(data);
		}			
	});
});
</script>
<body>
<?php
	include_once("menu/menu_gerencia.php");
?>
<input type="hidden" id="id_egreso" value='<?php echo $id_egreso ?>'/>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div class="module_content">
									<table class='tablesorter'>
										<thead> 
											<tr>
												<th>
													Producto
												</th>
												<th>
													Cantidad
												</th>
											</tr> 
										</thead>
										<tbody id='orden'>
										</tbody>
									<table>
								</div>
								<div>
									<div class="fright">
										<input onClick='$(this).aceptar_material_pop();' type="submit" value="Aceptar Solicitud POP&raquo;"/>
									</div> 
								</div> 
								<div>
									<div class="fright">
										<input onClick='$(this).rechazar_material_pop();' type="submit" value="Rechazar Solicitud POP&raquo;"/>
									</div> 
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