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
	<title>Notas de Venta por Autorizar Finanzas</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
        <script src="js/funcion_ventas_productos.js"></script>
	</head> 
<body>
<?php
	include_once("menu/menu_comercializacion.php");
?>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body" id="cabeza_nota_venta">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Listado de Notas de Venta por Autorizar por Finanzas</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright">
										<!--a href="crear_vendedor.php" ><input type="button" value="Crear Nuevo&raquo;"/></a-->
									</div>
								</div>
								<br>
								<div class="module_content">
									<table class="tablesorter"> 
										<thead> 
											<tr>
												<th>
													Numero
												</th>
												<th>
													Cliente
												</th>
                                                                                                <th>
													Centro de Venta
												</th>
												<th>
													Ver
												</th>
												<!--th>
													Eliminar
												</th-->
											</tr> 
										</thead>
										<tbody>
											<tr>
												<?php
													include_once("clases/negocio.php");
													$negocio=new negocio();
													echo $negocio->muestra_nv_por_autorizar2();
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