<?php
$id_subfamilia=$_GET["id_subfamilia"];
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
	<title>Subfamilias NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
	<script src="js/funcion_combos.js"></script>
</head>
<script>
$(document).ready(function() {
	var id_subfamilia = "<?php echo $id_subfamilia; ?>";	 
	$.getJSON("select/trae_subfamilia.php",{id_subfamilia:id_subfamilia},function(data){					
		for(i=0;i<data.length;i++)
		{		 
			$('#list_familia').val(data[i].familia);
			$('#subfamilia').val(data[i].subfamilia); 
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
					<div class="title"><p>Actualizacion de SubFamilias</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fleft"><h1>Actualizar SubFamilia</h1>
									</div>
									<div class="fright"><a href="listado_Sub_Familias.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Familia</label>
										</td>
										<td>
											<select id="list_familia">
											</select>
											<div id="valida-familia" style="display:none" class="errores">
												Debe Ingresar Familia
											</div> 
										</td>
										<td>
											<label>SubFamilia</label>
										</td>
										<td>
											<input type="text" id='subfamilia' placeholder="Ingrese subfamilia" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
											<div id="valida-subfamilia" style="display:none" class="errores">
												Debe Ingresar SubFamilia
											</div> 
											<div id="valida-subfamilia_reg" style="display:none" class="errores">
												SubFamilia Se Encuentra Registrada
											</div> 
										</td>
											<input type="hidden" id='id_subfamilia' value="<?php echo $id_subfamilia ?>"/>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Subfamilia&raquo;" onClick='$(this).actualizar_subfamilia();'/>
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
 
