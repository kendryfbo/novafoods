<?php
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	}
	$user=($_SESSION['usuario']);
	$idUsuario=($_SESSION['id_Usuario']);  
?>	
<!DOCTYPE html> 
<html lang="es"> 
<head>
	<title>Familias NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
	<script src="js/funcion_combos.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	$( "#list_sector").change(function() {
		 var id_sector = $('#list_sector option:selected').attr('id');
		 var stream="id_sector="+id_sector;		
	 	$.ajax({
			type: "POST",
			url: "select/trae_listado_familias.php",
			data:stream,
			success: function(data)	{								
			 	$("#familias").empty();
				$('#familias').append(data);
				$('#btn_crear').show();
			}			
		});
	});
	$( "#crea").click(function() {
		 var id_sector = $('#list_sector option:selected').attr('id');
		 window.location="crear_familia.php?id_sector="+id_sector;
	});
});
</script>
<body>
<?php
	include_once("menu/menu_desarrollo.php");
?>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Listado de Familias</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright" style="display:none" id='btn_crear'>
										<input type="button" id='crea' value="Crear Nueva&raquo;" />
									</div>
								</div>
								<br>
								<div class="module_content">
								<table  class="tablesorter">
									 	<tr>
											<td>
												Sector
											</td>																		
											<td>
												<select id="list_sector" name='sector'>									
												</select>	
											</td>										
										</tr>
									</table>
									<table class="tablesorter"> 
										<thead> 
											<tr>
												<th>
													Codigo
												</th>
												<th>
													Familia
												</th>
												<th>
													Editar
												</th>
												<th>
													Eliminar
												</th>
											</tr> 
										</thead>
										<tbody id='familias'>				
										<tbody>
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