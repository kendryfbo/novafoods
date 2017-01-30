<?php
	$id_idioma=$_GET["id_idioma"];
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
	var id_idioma = "<?php echo $id_idioma;?>";	 
	$.getJSON("select/trae_idioma_actualizar.php",{id_idioma:id_idioma},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#idioma').val(data[i].idioma);
 		}					 
	});  
});
</script>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Actualizar Idioma</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_idiomas.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
									<input type="hidden" id='id_idioma' value='<?php echo $id_idioma?>'/> 
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Idioma</label>
										</td>
										<td>
											<input type="text" id='idioma' placeholder="Ingrese Idioma" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-idioma" style="display:none" class="errores">
												Debe Ingresar idioma
											</div> 
											<div id="valida-idioma_reg" style="display:none" class="errores">
												idioma Se Encuentra Registrado
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar idioma&raquo;" onClick='$(this).actualizar_idioma();'/>
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
 
