<?php
	$id_umed=$_GET["id_umed"];
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
	<title>Umed NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js"></script>
</head> 
<script>
$(document).ready(function() {
	var id_umed = "<?php echo $id_umed; ?>";	 
	$.getJSON("select/trae_umed.php",{id_umed:id_umed},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#umed').val(data[i].umed);
 		}					 
	});  
});
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Actualizacion de Unidades de Medida </p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_unidades_de_medida.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='umed' placeholder="Ingrese Unidad de Medida"/>
											<div id="valida-umed" style="display:none" class="errores">
												Debe Ingresar Unidad de Medida 
											</div> 
											<div id="valida-umed_r" style="display:none" class="errores">
												Unidad de Medida Se Encuentra Registrada
											</div> 
										</td>
											<input type="hidden" id="id_umed" value=<?php echo $id_umed ?>  />
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Umed&raquo;" onClick='$(this).actualizar_umed();'/>
											</div>
										</td>
									</tr>
								</table>
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
 
