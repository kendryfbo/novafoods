<?php
	$id_sabor=$_GET["id_sabor"];
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
	<title>Sabores NovaFoods</title>
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
	var id_sabor = "<?php echo $id_sabor;?>";	 
	var stream="id_sabor="+id_sabor;
	$.ajax({
		type: "POST",
		url: "select/trae_sabor.php",
		data:stream,
		dataType: 'json',
		success: function(data) {			 
			for(i=0;i<data.length;i++)
			{
				$('#sabor_esp').val(data[i].sabor_esp);				 
		 		$('#sabor_ing').val(data[i].sabor_ing); 
 			}
		}	
	});
});
</script>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Actualizar Sabor</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_sabores.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Sabor en Español</label>
										</td>
											<input type="hidden" id='id_sabor' value="<?php echo $id_sabor ?>"/>
										<td>
											<input type="text" id='sabor_esp' placeholder="Ingrese Sabor en Español"/> 
											<div id="valida-sabor_esp" style="display:none" class="errores">
												Debe Ingresar Sabor en Espñaol
											</div> 
											<div id="valida-sabor_reg_esp" style="display:none" class="errores">
												Sabor en Español Se Encuentra Registrado
											</div> 
										</td>
										<td>
											<label>Sabor en Ingles</label>
										</td>
										<td>
											<input type="text"  id='sabor_ing' placeholder="Ingrese Sabor en Ingles"/>
											<div id="valida-sabor_ing" style="display:none" class="errores">
												Debe Ingresar Sabor en Ingles
											</div>
											<div id="valida-sabor_reg_ing" style="display:none" class="errores">
												Sabor en Ingles se Encuentra Registrado
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualiza Sabor&raquo;" onClick='$(this).actualizar_sabor();'/>
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
 
