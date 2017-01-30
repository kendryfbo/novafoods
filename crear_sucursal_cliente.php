<?php
	$id_cliente=$_GET["id_cliente"];
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
	<title>Clientes NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_listados.js"></script>
	<script src="js/jquery.Rut.js" type="text/javascript"></script>
        <script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_cliente = "<?php echo $id_cliente; ?>"; 
        //alert(id_cliente);
	$.getJSON("select/trae_cliente_nac.php",{id_cliente:id_cliente},function(data){		
		for(i=0;i<data.length;i++)
		{
			$('#nom_client').val(data[i].nombre);
			$('#rut').val(data[i].rut);
			//$('#direccion').val(data[i].direccion);
	 		$('#fono').val(data[i].telefono);
			$('#fax').val(data[i].fax);	
			$('#contacto').val(data[i].c1);
			$('#cargo').val(data[i].cargo);
			$('#email').val(data[i].m1);
			$('#list_comuna').val(data[i].comuna);	
			$('#credito').val(data[i].credito);	
		}		
	});	
	// nota: se tiene que tratar aparte comuna y region ya que antes no estaban registrados
	var id_cliente = "<?php echo $id_cliente;?>"; 
	var stream="id_cliente="+id_cliente;
	$.ajax({
		type: "POST",
		url: "select/trae_region.php",
		data:stream,
		success: function(data) {			 	
			$('#region').html(data);			 
		}	 			
	});	
	var stream="id_cliente="+id_cliente;
	$.ajax({
		type: "POST",
		url: "select/trae_cargo.php",
		data:stream,
		success: function(data) {	
		//	alert (data);
			$('#cargo').html(data);			 
		}	 			
	}); 
 	var stream="id_cliente="+id_cliente;
	$.ajax({
		type: "POST",
		url: "select/trae_comuna.php",
		data:stream,
		success: function(data) {			 	
			$('#comuna').html(data);			 
		}	 			
	});
	var stream="id_cliente="+id_cliente;
	$.ajax({
		type: "POST",
		url: "select/trae_giro.php",
		data:stream,
		success: function(data) {			 	
			$('#giro').html(data);			 
		}	 			
	});
        
        var stream="id_cliente="+id_cliente;
	$.ajax({
		type: "POST",
		url: "select/trae_canal.php",
		data:stream,
		success: function(data) {			 	
			$('#canal').html(data);			 
		}	 			
	});//
        var stream="id_cliente="+id_cliente;
	$.ajax({
		type: "POST",
		url: "select/trae_vendedor_cli.php",
		data:stream,
		success: function(data) {			 	
			$('#vendedor').html(data);			 
		}	 			
	});
        var stream="id_cliente="+id_cliente;
	$.ajax({
		type: "POST",
		url: "select/trae_sucursales_cli.php",
		data:stream,
		success: function(data) {			 	
			$('#sucursales').html(data);			 
		}	 			
	});
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
function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
</script>
<body>
<table class="table" >
	<td height="100%">
		<div class="body">		 
			<div class="modulo widht_modulo_full">
				<div class="title"><p>Actualizar Cliente Nacional</p>
				</div>
				<div class="content">          
					<div>  
 						<!--div class="fright"><a href="listado_clientes.php"><input type="button" value="Volver &raquo;"/></a>
							</div-->
                                            <div class='fright'><input  onClick='$(this).crea_sucural_cliente_volver(<?php echo$id_cliente; ?>);' type='submit' value='Volver&raquo;'/>
                                            </div>
						</div>
						<table class="tablesorter"> 
					 		<tr>
    							<td>
									<label>Cliente</label>
								</td>
								<td>
                                                                    <input type="text" id='nom_client' placeholder="Ingrese Nombre de Cliente" readonly/>
                                                                    <input type="hidden" id="id_cliente"	value="<?php echo$id_cliente; ?>">
							 	</td>
							</tr>
							<tr>
    							<td>
									<label>Sucursal</label>
								</td>
								<td>
									<input type="text" id='suc' placeholder="Ingrese Sucursal de Cliente" style="text-transform:uppercase;"/>
									<div id="valida-suc" style="display:none" class="errores">
										Debe Ingresar Sucursal 
									</div>
									<div id="valida-suc_r" style="display:none" class="errores">
										Sucursal Existente
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
								<td colspan="4">
									<div class="fright"><input onClick='$(this).crea_sucural_cliente_registra();' type="submit" value="Crear&raquo;"/>
									</div>
								</td>
							</tr>
                                                        <tr>
                                                                <td colspan="4" id='sucursales'>
									
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
 