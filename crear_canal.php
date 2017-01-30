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
	<title>Canal Novafoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head>

<script>
    function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>

<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Canal de Cliente</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<br>
                                                                        <div class="fright"><a href="listado_canal_cliente.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
                                                                                 <td style="width: 10%">
											<label>Canal</label>
										</td>
										<td  style="width: 20%">
											<input type="text" id='canal' placeholder="Ingrese Canal" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-canal" style="display:none" class="errores">
												Debe Ingresar Canal
											</div> 
											<div id="valida-canal_reg" style="display:none" class="errores">
												Canal Se Encuentra Registrada
											</div> 
										</td>
                                                                                <td>
											<label></label>
										</td>
									</tr>
                                                                        <tr>
										<td>
											<label>Descuento</label>
										</td>
										<td>
											<input type="text" id='desc' onkeypress="ValidaSoloNumeros()" placeholder="Ingrese Porcentaje" > 
											<div id="valida-desc" style="display:none" class="errores">
												Debe Ingresar Porcentaje de Descuento
											</div> 
										</td>
                                                                                <td>
											<label>%</label>
										</td>
									</tr>
                                                                        <tr>
										
										<td colspan="2">
											<div class="fright"><input type="submit" value="Crear Canal&raquo;" onClick='$(this).ingresa_canal();'/>
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
 
