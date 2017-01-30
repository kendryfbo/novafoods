<?php
	$id_formato=$_GET["id_formato"];
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
	<title>Formatos Novafoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_formato = "<?php echo $id_formato;?>";	 
	$.getJSON("select/trae_formato.php",{id_formato:id_formato},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#formato').val(data[i].formato);
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
					<div class="title"><p>Actualizacion de Formatos </p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_formatos.php"><input type="button" value="Volver &raquo;"/></a>
								</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='formato' placeholder="Ingrese Formato"/>
											<div id="valida-formato" style="display:none" class="errores">
												Debe Ingresar Formato
											</div> 
											<div id="valida-formato_r" style="display:none" class="errores">
												Formato Se Encuentra Registrado
											</div> 
										</td>
											<input type="hidden" id='id_formato' value="<?php echo $id_formato?>"/>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Formato&raquo;" onClick='$(this).actualizar_formato();'/>
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
 
