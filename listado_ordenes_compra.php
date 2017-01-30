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
	<title>Orden de Compra NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js" type="text/javascript"></script>
	<script src="js/funcion_orden_compra.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	$( "#Ingreso_orden_imprimir" ).click(function() {
	  	if($.trim($("#num_ord_compra").val())==="") 
		{
			$("#num_ord_compra").focus ();
			$('#valida-num_orden').fadeIn('slow'); 
			setTimeout(function(){$('#valida-num_orden').fadeOut('slow');},1000); 
			return false;
		}
		var numero_orden = $('#num_ord_compra').val();
		var stream="numero_orden="+numero_orden;		
		$.ajax({
			type: "POST",
			url: "select/trae_orden_imprimir.php",
			data:stream,
			success: function(data)	{	
				$("#orden").html("");
				$("#orden").append(data);
			}			
		}); 
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
											<h1 align="center">Imprimir Orden de Compra</h1>
										</div>
										<div class="fright">
											<a href="crear_orden_compra.php" ><input type="button" value="Crear Nueva&raquo;" /></a>
										</div>
									</div>
									<br>
									<div class="module_content">
										<table class="tablesorter"> 
											<td width="62%" colspan="2">
												<label>Ingrese Numero de Orden de Compra</label>
											</td>
											<td>
												<input type="text" id="num_ord_compra"/>	
												<div id="valida-num_orden" style="display:none" class="errores">
													Debe Ingresar Numero de Orden
												</div> 
											</td>
											<td>
												<input type="button" value="Ingresar&raquo;" id='Ingreso_orden_imprimir'/>
											</td>
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