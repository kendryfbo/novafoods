<?php
	$id_cargo=$_GET["id_cargo"];
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
	<title>Cargos Novafoods</title>
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
	var id_cargo = "<?php echo $id_cargo;?>";	 
	$.getJSON("select/trae_cargo_actualizar.php",{id_cargo:id_cargo},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#cargo').val(data[i].cargo);
 		}					 
	});  
});
</script>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Actualizar Cargo de Empresa</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="listado_cargos.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
									<input type="hidden" id='id_cargo' value='<?php echo $id_cargo ?>'/> 
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Giro</label>
										</td>
										<td>
											<input type="text" id='cargo' placeholder="Ingrese cargo" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-cargo" style="display:none" class="errores">
												Debe Ingresar Cargo
											</div> 
											<div id="valida-cargo_reg" style="display:none" class="errores">
												Cargo Se Encuentra Registrado
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar Cargo&raquo;" onClick='$(this).actualizar_cargo();'/>
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
 
