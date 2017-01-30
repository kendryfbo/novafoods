<?php
$id_material=$_GET["id_material"];
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
	<title>Materiales NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_material = "<?php echo $id_material;?>";	 
	$.getJSON("select/trae_material.php",{id_material:id_material},function(data){	
		for(i=0;i<data.length;i++)
		{
			$('#material').val(data[i].material);
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
					<div class="title"><p>Actualizacion de Materiales</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_materiales.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='material' placeholder="Ingrese material" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-material" style="display:none" class="errores">
												Debe Ingresar el material
											</div> 
											<div id="valida-material_r" style="display:none" class="errores">
												Su material Se Encuentra Registrado
											</div> 
										</td>
											<input type="hidden" id="id_material" value='<?php echo $id_material?>'/>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Material &raquo;"	onClick='$(this).actualizar_material();' />
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
 