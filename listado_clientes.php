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
	<title>Clientes Novafoods</title>
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
	<tr id="cliente_actu">
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Listado de Clientes</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div class="module_content">	
									<table  class="tablesorter">
									 	<tr>
											<td>
												Tipo Cliente
											</td>																		
											<form action="#" method="post">
												<td>
													<select id="tipo" name="tipo">
														<option value="0" selected >Elija Opcion....</option>
														<option value="1">Nacional</option>
														<option value="2">Internacionacional</option>
													</select>	
												</td>
												<td>
													<input type="submit" value="Ingresar&raquo;"/>
												</td>
											</form>
										</tr>
									</table>
								</div>						 
								<br>
								<div class="module_content">							
									<table class="tablesorter"> 
										<thead> 
											<tr>
												<th>
													Cliente
												</th>
												<th>
													Revisar
												</th>
												<th>
													Eliminar
												</th>
											</tr> 
										</thead>
										<tbody>
											<tr>
												<?php
													if (isset($_POST["tipo"]) && !empty($_POST["tipo"]))
													{
														$opcion=$_POST['tipo'];   
													}
													else
													{  
														$opcion=0;
													}						 
													switch ($opcion) {
														case 0:
															echo "";
															break;
														case 1:
														?>
															<div class="fright">
																<a href="crear_cliente_nacional.php"><input type="button" value="Crear Cliente Nacional&raquo;" /></a>
                                                                                                                        </div>
                                                                                                                        <br><br><br>
                                                                                                                        
                                                                                                                        <div class="fright">
																<a href="listado_canal_cliente.php"><input type="button" value="Canal&raquo;" /></a>
															</div>
														<?php
															include_once("clases/negocio.php");
															$negocio=new negocio();
															echo $negocio->muestra_cliente_nac();
															break;
														case 2:
														?>
															<div class="fright">
																<a href="crear_cliente_internacional.php"><input type="button" value="Crear Cliente&raquo;" /></a>
															</div>														
														<?php
															include_once("clases/negocio.php");
															$negocio=new negocio();
															echo $negocio->muestra_cliente_int();
															break;
													}										
												?>
											</tr>
										<tbody>
									 </table>
								</div>
							</article>
						</section>
					</div>	
				</div>
			</td>	
		</tr>	
	</table>
</body>
</html>