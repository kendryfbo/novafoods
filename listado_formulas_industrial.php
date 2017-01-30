<?php
	include_once("clases/conexion.php"); 
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
	<title>Formula Industrial</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_formulas.js"></script>
</head> 
<body>
<?php
	include_once("menu/menu_desarrollo.php");
?>
<table class="table"id="tabla_1">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Listado de Formulas Industrial</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								
								<div class="module_content">
									<table class="tablesorter" id="tabla_2"> 
										<thead> 
											<tr>
												<th>
													Version
												</th>
												<th>
													Producto
												</th>
												<th>
													Revisar
												</th>
											</tr> 
										</thead>
										<tbody>
											<tr>
												<?php
													include_once("clases/negocio.php");
													$negocio=new negocio();
													echo $negocio->muestra_formulas_Industrial();
												?>
											</tr>
										<tbody>
									 </table>
								</div>
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