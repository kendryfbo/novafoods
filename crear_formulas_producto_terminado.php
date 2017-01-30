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
	<title>Formulas NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_formulas.js"></script>
</head> 
<body>
<script type="text/javascript">
function ValidaSoloNumeros() {
 if ( (event.keyCode != 46)  && ( event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
</script>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Creacion de Formulas</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
                                                            <input type="hidden"  id="display" value="" />
                                                            <input type="hidden"  id="sobre" value="" />
                                                            <input type="hidden"  id="contenido" value="" />
                                                            <input type="hidden"   id="umed" value="" />
                                                            
								<div>  
									<br>
									<div class="fright"><a href="principal_desarrollo.php"><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Seleccione El Producto Terminado</label>
										</td>
										<td>
											<select id="list_producto_terminado">
											</select>
											<div id="valida-prod_ter" style="display:none" class="errores">
												Debe Seleccionar Producto Terminado 
											</div>
										</td>
									</tr>
                                                                        
									
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
									</tr>
									<tr>
										<td>
											<label>Insumo / Materia Prima</label>
										</td>
										<td id='td_list_hijo_producto'>
										</td>
                                                                                
									</tr>
                                                                        <tr>
										<td>
											<label>Nivel</label>
										</td>
										<td>
											<select id='niveles'>
											  <option value="">Seleccione Nivel..</option>
											  <option value="1">Produccion Mezclado</option>
											  <option value="2">Produccion Envasado</option>
											  <option value="3">Premix</option>
                                                                                          <option value="4">Premix Colorantes</option>
											  <option value="5">Base</option>
											</select>
											<div id="valida-nivel" style="display:none" class="errores">
												Debe Ingresar Nivel
											</div> 
										</td>
									</tr>
									<input type="hidden" id='id'/>
									<tr>
										
										<td>
											<label>Tamaño Batch</label>
										</td>
										<td>
											<input type="text" id='tbatch' placeholder="Tamaño Batch " onkeypress="ValidaSoloNumeros()"/>
											<div id="valida-tbatch" style="display:none" class="errores">
												Debe Ingresar Tamaño Batch 
											</div>
										</td>
                                                                                <td>
                                                                                    <label>(Kg)</label>
                                                                                </td>
									</tr>
                                                                        <tr>
										
										<td>
											<label>Env. Uni</label>
										</td>
										<td>
											<input type="text" id='unidad' placeholder="Env. Uni" onkeypress="ValidaSoloNumeros()"/>
											<div id="valida-unidad" style="display:none" class="errores">
												Debe Ingresar Env. Uni 
											</div>
										</td>
                                                                                <td>
                                                                                    <label>(g)</label>
                                                                                </td>
									</tr>
                                                                        <tr>
										
										<td>
											<label></label>
										</td>
										<td>
											
                                                                                            <input type="submit" value="Calcular&raquo;" onClick='$(this).calcula_formulas();'/>
                                                                                        
										</td>
									</tr>
                                                                        <tr>
										
										<td>
											<label>Caja</label>
										</td>
										<td>
											<input type="text" id='caja' placeholder="Caja" onkeypress="ValidaSoloNumeros()"/>
											<div id="valida-caja" style="display:none" class="errores">
												Debe Ingresar Caja 
											</div>
										</td>
										
									</tr>
                                                                        <tr>
										<td>
											<label>Batch</label>
										</td>
										<td>
											<input type="text" id='batch' placeholder="Batch" onkeypress="ValidaSoloNumeros()" />
											<div id="valida-Batch" style="display:none" class="errores">
												Debe Ingresar Batch 
											</div>
										</td>
                                                                                <td>
                                                                                    <label>(Kg)</label>
                                                                                </td>
										
									</tr>
                                                                        <tr>
                                                                                <td>
											<label></label>
										</td>
										<td>
											<input type="submit" value="Ingresar&raquo;" onClick='$(this).ingresar_formulas();'/>
										</td>
                                                                        </tr>
									<!--td colspan="6" id='actualiza_form' style="display:none">
										<div class="fright"><input type="submit" value="Actualizar&raquo;" onClick='$(this).actualizar_formulas();'/>
										</div>
									</td>
									<td colspan="6" id='ingresa_form' >
										<div class="fright">
                                                                                    <input type="submit" value="Ingresar&raquo;" onClick='$(this).ingresar_formulas();'/>
										</div>
									</td-->
								</table>
								<div class="module_content">
									<table class="tablesorter" id='tabla_insumos' > 
									</table>
								</div>
                                                                <div class="module_content">
									<table class="tablesorter" id='tabla_Autorizacion' > 
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
 