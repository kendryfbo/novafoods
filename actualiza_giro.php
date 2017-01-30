<?php
	$id_giro=$_GET["id_giro"];
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
	<title>Giros Novafoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<body>
<script>
$(document).ready(function() {
	var id_giro = "<?php echo $id_giro;?>";	 
	$.getJSON("select/trae_giro_actualizar.php",{id_giro:id_giro},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#giro').val(data[i].giro);
 		}					 
	});  
});
</script>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Actualizar Giro de Empresa</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_giros.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
									<input type="hidden" id='id_giro' value='<?php echo $id_giro ?>'/> 
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Giro</label>
										</td>
										<td>
											<input type="text" id='giro' placeholder="Ingrese Giro" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-giro" style="display:none" class="errores">
												Debe Ingresar Giro
											</div> 
											<div id="valida-giro_reg" style="display:none" class="errores">
												Giro Se Encuentra Registrado
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Giro&raquo;" onClick='$(this).actualizar_giro();'/>
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
 
