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
	<title>Orden de Compra por Autorizar Finanzas</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
        <script src="js/funcion_orden_compra.js"></script>
        <!--script src="js/funcion_ventas_productos.js"></script-->
	</head> 
<body>
<?php
	//include_once("menu/principal_finanzas.php");
?>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body" id="cabeza_oc">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Listado de Ordenes de Compra por Autorizar por Finanzas</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright">
										<a href="principal_finanzas.php" ><input type="button" value="Volver&raquo;"/></a>
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
													Proveedor
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
													echo $negocio->muestra_Oc_por_autorizar();
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