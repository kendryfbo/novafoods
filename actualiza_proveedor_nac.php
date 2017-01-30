<?php
	$id_proveedor_nacional=$_GET["id_proveedor_nacional"];
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
	<title>Proveedores NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_listados.js"></script>
	<script src="js/jquery.Rut.js" type="text/javascript"></script>
        <script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
</head>
<script>
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<script>
$(document).ready(function() {

	$('#rut').Rut({
		on_error: function()
		{
			$("#rut").focus ();
			$('#valida-rut3').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut3').fadeOut('slow');},1000); 
			$("#rut").val ("");
		}
	}); 
});
</script>
<script>
$(document).ready(function() {
	var id_proveedor_nacional = "<?php echo $id_proveedor_nacional; ?>";
        //alert(id_proveedor_nacional);
	$.getJSON("select/trae_proveedor_nacional.php",{id_proveedor_nacional:id_proveedor_nacional},function(data){		
		for(i=0;i<data.length;i++)
		{
			$('#rut').val(data[i].rut);
			$('#proveedor').val(data[i].nombre);
	 		$('#direccion').val(data[i].direccion);
			$('#fono').val(data[i].fono);	
			$('#giro').val(data[i].giro);	
			$('#celular').val(data[i].Celular);	
			$('#contacto').val(data[i].Contacto);
			$('#fax').val(data[i].Fax);	
			$('#email').val(data[i].email);	
			$('#condicion_venta').val(data[i].condicion_de_pago);
                        //$('#list_reg').val(data[i].region);
                        $('#list_cargo').val(data[i].carg);
                        $('#contacto_cobra').val(data[i].contacto2);
                        $('#email2').val(data[i].email2);
                        //$('#list_prov').val(data[i].provinc);
                        //alert(data[i].provinc); 
		}		
	});
        
        $("#rut").attr('disabled',true);
        
        var id_proveedor_nacional = "<?php echo $id_proveedor_nacional;?>"; 
	var stream="id_proveedor_nacional="+id_proveedor_nacional;
	$.ajax({
		type: "POST",
		url: "select/trae_region_prov.php",
		data:stream,
		success: function(data) {			 	
			$('#list_reg').html(data);			 
		}	 			
	});
        var id_proveedor_nacional = "<?php echo $id_proveedor_nacional;?>"; 
	var stream="id_proveedor_nacional="+id_proveedor_nacional;
	$.ajax({
		type: "POST",
		url: "select/trae_provincia_prov.php",
		data:stream,
		success: function(data) {			 	
			$('#list_prov').html(data);			 
		}	 			
	});//
        var id_proveedor_nacional = "<?php echo $id_proveedor_nacional;?>"; 
	var stream="id_proveedor_nacional="+id_proveedor_nacional;
	$.ajax({
		type: "POST",
		url: "select/trae_comuna_prov.php",
		data:stream,
		success: function(data) {			 	
			$('#list_com').html(data);			 
		}	 			
	});//trae_region_prov
}); 
</script>
<body>
<table class="table">
	<td height="100%">
		<div class="body">		 
			<div class="modulo widht_modulo_full">
				<div class="title"><p>Actualiza de Proveedor Nacional</p>
				</div>
				<div class="content">          
					<div>  
 						<div class="fright"><a href="listado_proveedores.php" ><input type="button" value="Volver &raquo;"/></a>
							</div>
						</div>
                                    <input type="hidden" id="id_proveedor" value="<?php echo $id_proveedor_nacional;?>">
						<table class="tableform"> 
                                                        <tr>
								<td>
									<label>Rut</label>
								</td>
								<td>											
									<input type="text" id="rut"  placeholder="Ingrese Rut"/>
									<div id="valida-rut" style="display:none"  class="errores">
										Debe Ingresar el Rut.
									</div> 
									<div id="valida-rut2" style="display:none" class="errores">
										Rut Se Encuentra Ingresado
									</div>
									<div id="valida-rut3" style="display:none" class="errores">
										Rut Incorrecto
									</div>
								</td>
							</tr>
					 		<tr>
    							<td>
									<label>Nombre Proveedor</label>
								</td>
								<td>
									<input type="text" id='proveedor' placeholder="Ingrese Proveedor" style="text-transform:uppercase;"/>
									<div id="valida-Proveedor" style="display:none" class="errores">
										Debe Ingresar Proveedor
									</div> 
								</td>       
							</tr>
							<tr>
    							<td>
									<label>Direccion</label>
								</td>
								<td>
									<input type="text" id='direccion' placeholder="Ingrese Direccion"  style="text-transform:uppercase;"/>
									<div id="valida-direccion" style="display:none" class="errores">
										Debe Ingresar Direccion 
									</div>
								</td>
							</tr>
                                                        <tr>
										<td>
											<label>Región</label>
										</td>
										<td>
											<select id="list_reg" onClick='$(this).sel_reg();'> 
											</select> 
											<div id="valida-list_reg" style="display:none" class="errores">
												Debe Seleccionar Región 
											</div> 
										</td>
							</tr>
							</tr>
										<td>
											<label>Provincia</label>
										</td>
										<td>
											<select id="list_prov"> 
											</select> 
											<div id="valida-list_prov" style="display:none" class="errores">
												Debe Seleccionar Provincia 
											</div>
										</td>
										
							</tr>
							</tr>
										<td>
											<label>Comuna</label>
										</td>
										<td>
											<select id="list_com"> 
											</select> 
											<div id="valida-list_com" style="display:none" class="errores">
												Debe Seleccionar Comuna 
											</div>
										</td>
										
							</tr>
							
							<tr>
    							<td>
									<label>Telefono</label>
								</td>
								<td>
									<input type="text" id='fono' placeholder="Ingrese Telefono" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-telefono" style="display:none" class="errores">
										Debe Ingresar Telefono 
									</div>
								</td>
							</tr> 
							
                                                        <tr>
    							<td>
									<label>Fax</label>
								</td>
								<td>
									<input type="text" id='fax' placeholder="Ingrese Fax" onkeypress="ValidaSoloNumeros()"/>
								 </td>
							</tr>
							 <tr>
								<td>
									<label>Giro</label>
								</td>
								<td>
									<input type="text" id='giro' placeholder="Ingrese Giro" style="text-transform:uppercase;"/>
									<div id="valida-giro" style="display:none" class="errores">
										Debe Ingresar Giro
									</div>
								</td>	
							</tr>
							
							<tr>
    							<td>
									<label>Contacto</label>
								</td>
								<td>
									<input type="text" id='contacto' placeholder="Ingrese Contacto"  style="text-transform:uppercase;"/>
									<div id="valida-contacto" style="display:none" class="errores">
										Debe Ingresar Contacto
									</div>
								 </td>
							</tr>
							<tr>
    							<td>
									<label>Cargo</label>
								</td>
								<td>
									<select id="list_cargo"> 
									</select> 
									<div id="valida-cargo" style="display:none" class="errores">
										Debe Ingresar Cargo 
									</div>
								</td>
							</tr>
                                                        <tr>
    							<td>
									<label>Celular</label>
								</td>
								<td>
									<input type="text" id='celular' placeholder="Ingrese Celular" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-celular" style="display:none" class="errores">
										Debe Ingresar Celular 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Email</label>
								</td>
								<td>
									<input type="text" id='email' placeholder="Ingrese Email"/>
									<div id="valida-mail" style="display:none" class="errores">
										Debe Ingresar Email 
									</div>
									<div id="valida-mail_2" style="display:none" class="errores">
										Debe Ingresar Email valido 
									</div>
								</td>
							</tr>
                                                        <tr>
                                                            <td>
									<label>Condición de Pago</label>
								</td>
								<td>
									<select id="condicion_venta"> 
									</select> 
									<div id="valida-condicion_venta" style="display:none" class="errores">
										Debe Seleccionar Cond. de Venta 
									</div>
								</td>
							</tr>
                                                        <tr>
    							<td>
									<label>Contacto Cobranza</label>
								</td>
								<td>
									<input type="text" id='contacto_cobra' placeholder="Ingrese Contacto de Cobranza" style="text-transform:uppercase;"/>
									<div id="valida-celular" style="display:none" class="errores">
										Debe Ingresar Celular 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Email Cobranza</label>
								</td>
								<td>
									<input type="text" id='email2' placeholder="Ingrese Email de Cobranza"/>
									<div id="valida-mail" style="display:none" class="errores">
										Debe Ingresar Email 
									</div>
									<div id="valida-mail_2" style="display:none" class="errores">
										Debe Ingresar Email valido 
									</div>
								</td>
							</tr>
							
							<tr>
								<td colspan="4">
									<div class="fright"><input onClick='$(this).actualizar_prov_nacional();' type="submit" value="Actualizar&raquo;"/>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>		
			</div>
		 </div>
	 </td>
</table>
</body>
</html>