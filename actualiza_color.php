<?php
$id_color=$_GET["id_color"];
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
	<title>Colores NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_color = "<?php echo $id_color;?>";	 
	$.getJSON("select/trae_color.php",{id_color:id_color},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#color').val(data[i].color);
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
					<div class="title"><p>Actualizacion de Colores</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_colores.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='color' placeholder="Ingrese Color" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-color" style="display:none" class="errores">
												Debe Ingresar el Color
											</div> 
											<div id="valida-color_r" style="display:none" class="errores">
												Su color Se Encuentra Registrado
											</div> 
										</td>
											<input type="hidden" id="id_color" value='<?php echo $id_color ?>'/>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Color &raquo;" onClick='$(this).actualizar_color();'/>
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
 