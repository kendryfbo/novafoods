<?php
	$id_genero=$_GET["id_genero"];
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
	<title>Generos NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_genero = "<?php echo $id_genero;?>";	 
	$.getJSON("select/trae_genero.php",{id_genero:id_genero},function(data){	
		for(i=0;i<data.length;i++)
		{
			$('#genero').val(data[i].genero); 
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
					<div class="title"><p>Actualizacion de Generos</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_generos.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='genero' placeholder="Ingrese Genero"/>
											<div id="valida-genero" style="display:none" class="errores">
												Debe Ingresar Genero
											</div> 
											<div id="valida-genero_r" style="display:none" class="errores">
												Genero Se Encuentra Registrado
											</div> 
										</td>
											<input type="hidden" id='id_genero'value="<?php echo $id_genero?>"/>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualiza Genero&raquo;" onClick='$(this).actualizar_genero();'/>
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
 
