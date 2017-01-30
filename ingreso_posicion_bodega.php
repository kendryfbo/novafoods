<?php 
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	}
	$user=($_SESSION['usuario']);
	$idUsuario=($_SESSION['id_Usuario']);  	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>NovaFoods</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_ingreso_productos_bodega.js" type="text/javascript"></script>
	<script src="js/jquery-ui-custom.min.js"></script>
	<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jQuery.print.js"></script>
</head>
<script>
$(document).ready(function() {
	$("#codigo_barra").focus();
	$("#popdetallestk").dialog({ 
		autoOpen:false,
		modal:true,
		width:450,
		height:250,
		buttons:{
			"Cerrar":function(){
				$(this).dialog("close");
			}
		}	
	});
});
function ValidaSoloNumeros() {
 if ( (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body> 
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div class="title"><p>Ingresar Articulo en Posicion de Bodega</p>
								</div>
								<div class="module_content">
									<div id='area_imprimir'>
										<table class="tablesorter"> 
											<div class="fright"><a href="principal_operaciones.php"><input type="button" value="Volver &raquo;"/></a>
											</div>
											<tr>
												<td>
													Ingrese Codigo de Barra
												</td>
												<td>
													<input type="text" id='codigo_barra' onkeypress="ValidaSoloNumeros()" placeholder="Numero de Codigo"/>
													<div id="valida-cod_barra" style="display:none" class="errores">
														Debe Ingressar Algun Codigo de Barra !!!
													</div> 
													<div id="valida-codigo" style="display:none" class="errores">
														Codigo de Barra no Existe
													</div> 
												</td>
												<td>
													<input type="button" id='aceptar_ingreso' value="Aceptar"/>
												</td>	
											</tr>
										</table>
										<table class="tablesorter" id='detalle_productos'> 										
										</table>
									</div>
								</div>
							</article>
						</section>
					</div>	
				</div>
			</div>
		</td>	
	</tr>	
</table>
<div id="popdetallestk"> 
</div> 
</body>
</html>