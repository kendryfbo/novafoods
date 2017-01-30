<?php
	$id_marca=$_GET["id_marca"];
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
	<title>Marcas NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
	<script src="js/funcion_combos.js"></script>
</head> 
<body>
<script>
$(document).ready(function() {
	var id_marca = "<?php echo $id_marca; ?>";	 
	var stream="id_marca="+id_marca;
	$.ajax({
		type: "POST",
		url: "select/trae_marca.php",
		data:stream,
		dataType: 'json',
		success: function(data) {	
			for(i=0;i<data.length;i++)
			{
				$('#marca').val(data[i].marca);				 
		 		$('#list_familia').val(data[i].familia); 
				$('#list_ila').val(data[i].ila);
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
					<div class="title"><p>Actualizar Marca</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
						 			<div class="fright"><a href="listado_marcas.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='marca' placeholder="Ingrese el Marca"/>
											<input type="hidden" id="id_marca" value="<?php echo $id_marca?>"/>
											<div id="valida-marca" style="display:none" class="errores">
												Debe Marca
											</div> 
											<div id="valida-marca_r" style="display:none" class="errores">
												Marca Se Encuentra Registrada
											</div> 
										</td>
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
									</tr>
									<tr>
										<td>
											<label>ILA</label>
										</td>
										<td>
											<select id="list_ila">
											  <option value='' selected>Ingrese Opcion</option>");
											  <option id="SI">SI</option>
											  <option id="NO">NO</option> 
											</select>
											<div id="valida-ila" style="display:none" class="errores">
												Debe ingresar ILA
											</div> 
										</td> 
									</tr>
									<td colspan="2">
										<div class="fright"><input type="submit" value="Actualiza Marca &raquo;" onClick='$(this).actualizar_marca();'/>
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
 
