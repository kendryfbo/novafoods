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
	<title>Subfamilias NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
	<script src="js/funcion_combos.js"></script>
</head> 
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Creacion de SubFamilia</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_Sub_Familias.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
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
										<td>
											<label>SubFamilia</label>
										</td>
										<td>
											<input type="text"  id='subfamilia' placeholder="Ingrese subfamilia" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
											<div id="valida-subfamilia" style="display:none" class="errores">
												Debe Ingresar SubFamilia
											</div> 
											<div id="valida-subfamilia_reg" style="display:none" class="errores">
												SubFamilia Se Encuentra Registrada
											</div> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Crear Subfamilia&raquo;" onClick='$(this).ingresa_subfamilia();'/>
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
 
