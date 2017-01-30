<?php
	$id_vendedor=$_GET["id_vendedor"];
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
	<title>Vendedor NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_vendedor = "<?php echo $id_vendedor; ?>";
	$.getJSON("select/trae_Vendedor.php",{id_vendedor:id_vendedor},function(data){	
		for(i=0;i<data.length;i++)
		{
			$('#Vendedor').val(data[i].vendedor);
			$('#iniciales').val(data[i].iniciales);
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
					<div class="title"><p>Actualizacion de Vendedor </p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="Vendedores.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Vendedor</label>
										</td>
										<td>
											<input type="text" id='Vendedor' placeholder="Ingrese Vendedor" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-Vendedor" style="display:none" class="errores">
												Debe Ingresar Vendedor
											</div> 
											<div id="valida-Vendedor_reg" style="display:none" class="errores">
												Vendedor Se Encuentra Registrado
											</div> 
										</td>
										<td>
											<label>Iniciales</label>
										</td>
										<td>
											<input type="text" id='iniciales' placeholder="Ingrese Iniciales" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-iniciales" style="display:none" class="errores">
												Debe Ingresar Iniciales
											</div> 
											<div id="valida-iniciales_reg" style="display:none" class="errores">
												Iniciales Se Encuentran Registradas
											</div> 
										</td>
											<input type="hidden" id="id_vendedor" value='<?php echo $id_vendedor?>'/>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Vendedor&raquo;" onClick='$(this).actualizar_vendedor();'/>
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
 
