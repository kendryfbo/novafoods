<?php
	$id_talla=$_GET["id_talla"];
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
	<title>Tallas NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_talla = "<?php echo $id_talla; ?>";	 
	$.getJSON("select/trae_talla.php",{id_talla:id_talla},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#talla').val(data[i].talla);
 		}					 
	});  
});
</script>
<body>
<table class="table" >
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Actualizacion de Tallas </p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_tallas.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='talla' placeholder="Ingrese  Talla"/>
											<div id="valida-talla" style="display:none" class="errores">
												Debe Ingresar Talla
											</div> 
											<div id="valida-talla_r" style="display:none" class="errores">
												Talla Se Encuentra Registrada
											</div> 
										</td>
											<input type="hidden" id="id_talla" value='<?php echo $id_talla?>'/>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Talla&raquo;" onClick='$(this).actualizar_talla();'/>
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
 
