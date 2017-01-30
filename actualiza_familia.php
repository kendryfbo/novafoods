<?php
	$id_familia=$_GET["id_familia"];
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
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head>
<script>
$(document).ready(function() {
	var id_familia = "<?php echo $id_familia; ?>";	 
	$.getJSON("select/trae_familia.php",{id_familia:id_familia},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#familia').val(data[i].familia);
			$('#cod_familia').val(data[i].codigo_familia); 
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
					<div class="title"><p>Actualizar Familia</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_Familias.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Familia</label>
										</td>
										<td>
											<input type="text" id='familia' placeholder="Ingrese Familia" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-familia" style="display:none" class="errores">
												Debe Ingresar Familia
											</div> 
											<div id="valida-familia_reg" style="display:none" class="errores">
												Familia Se Encuentra Registrada
											</div> 
										</td>
										<td>
											<label>Codigo</label>
										</td>
										<td>
											<input type="text"  id='cod_familia' placeholder="Ingrese Codigo" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
											<div id="valida-cod_familia" style="display:none" class="errores">
												Debe Ingresar Codigo de Familia
											</div> 
											</td>
											<input type="hidden" id='id_familia' value="<?php echo $id_familia ?>"/>
											<td colspan="2">
												<div class="fright"><input type="submit" value="Actualiza Familia&raquo;" onClick='$(this).actualizar_familia();'/>
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
 
