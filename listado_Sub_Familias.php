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
	<title>Subfamilias NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<body>
<?php
	include_once("menu/menu_comercializacion.php");
?>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Listado de SubFamilias</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
									<div class="fright">
										<a href="crear_subfamilia.php"><input type="button" value="Crear Nueva&raquo;"/></a>
									</div>
								</div>
								<br>
								<div class="module_content">
									<table class="tablesorter"> 
										<thead> 
											<tr>
												<th>
													SubFamilia
												</th>
												<th>
													Familia
												</th>											 
												<th>
													Editar
												</th>
												<th>
													Eliminar
												</th>		
											</tr> 
										</thead>
										<tbody>
											<tr>
												<?php
													include_once("clases/negocio.php");
													$negocio=new negocio();
													echo $negocio->muestra_subfamilias();
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