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
<!DOCTYPE html> 
<html lang="es"> 
<head>
	<title>Condicion Novafoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Nueva Condicion de Pago</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
									<div class="fright"><a href="condiciones_pago.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Condicion de Pago</label>
										</td>
										<td>
											<input type="text" id='Condicion' placeholder="Ingrese Condicion" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-Condicion" style="display:none" class="errores">
												Debe Ingresar Condicion
											</div> 
											<div id="valida-Condicion_reg" style="display:none" class="errores">
												Condicion Se Encuentra Registrada
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Crear Condicion&raquo;" onClick='$(this).ingresa_condicion();'/>
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
 
