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
	<script src="js/jquery.js"></script>
	<script src="js/funcion_pedido_productos.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	$('input[type=radio]').change(function() {       
	  //1 es rechazado y 2 es aceptado
		var valor=(this.value);
		var stream="valor="+valor;
		$.ajax({
			type: "POST",
			url: "select/trae_egresos_pop.php",
			data:stream,
			success: function(data)	{	
				$('#orden').html('');
				$('#orden').append(data);
			}			
		});
	});
});
</script>
<body>
<?php
	include_once("menu/menu_comercializacion.php");
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
									<input type="radio" name="estado" class="estado" value="1">Rechazado
									<input type="radio" name="estado" class="estado" value="2">aprobado	
									<table class='tablesorter'>
										<thead> 
											<tr>
												<th>
													Numero
												</th>
												<th>
													Fecha
												</th>
											</tr> 
										</thead>
										<tbody id='orden'>
										</tbody>
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