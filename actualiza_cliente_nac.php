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
</head> 
<script>
$(document).ready(function() {
	var id_cliente = "<?php echo $id_cliente; ?>"; 
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
                        $('#hab').val(data[i].habil);
                        //alert($('#hab').val());
                        
		}	
                //var hab=$('#hab').val('');
                        if($.trim($("#hab").val())===""){
                            $('#si').hide();
                            $('#no').show();
                        }
                        if($.trim($("#hab").val())=="s"){
                            $('#si').show();
                            $('#no').hide();
                        }
                        if($.trim($("#hab").val())=="n"){
                            $('#si').hide();
                            $('#no').show();
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
		url: "select/trae_cond_pago.php",
		data:stream,
		success: function(data) {			 	
			$('#pago').html(data);			 
		}	 			
	});
        var stream="id_cliente="+id_cliente;
	$.ajax({
		type: "POST",
		url: "select/trae_lista_precio_cli_na.php",
		data:stream,
		success: function(data) {			 	
			$('#lista_precio').html(data);			 
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
                            <input type="hidden" id="hab">
				<div class="content">          
					<div>  
 						<div class="fright"><a href="listado_clientes.php"><input type="button" value="Volver &raquo;"/></a>
							</div>
						</div>
						<table class="tableform">
                                                        <tr>
                                                            <td colspan="2" style="text-align: center">
                                                                
                                                                <div  style="display:none" id='si'> 
                                                                    <font color="Blue">
                                                                        <h2>Autorizado!</h2>
                                                                    </font>
								</div>
                                                                <div  style="display:none" id='no'> 
                                                                    <font color="red">
                                                                        <h2 color="red">No Autorizado!</h2>
                                                                    </font>
								</div>
                                                                <br>
                                                            </td>
                                                        </tr>
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
									<label>Nombre</label>
								</td>
								<td>
									<input type="text" id='nom_client' placeholder="Ingrese Nombre de Cliente"/>
									<div id="valida-cliente" style="display:none" class="errores">
										Debe Ingresar Cliente 
									</div>
									<div id="valida-cliente_R" style="display:none" class="errores">
										Cliente Existente
									</div>	
							 	</td>
							</tr>
                                                        <tr>
    							<td>
									<label>Canal</label>
								</td>
								<td id='canal'>
								</td>
							</tr>
                                                        <tr>
                                                            <td>
									<label>Giro</label>
								</td>
								<td id='giro'>
								</td>
							</tr>
							<!--tr>
    							<td>
									<label>Direccion</label>
								</td>
								<td>
									<input type="text" id='direccion' placeholder="Ingrese Direccion"/>
									<div id="valida-direccion" style="display:none" class="errores">
										Debe Ingresar Direccion 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Region</label>
								</td>
								<td id='region'>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Comuna</label>
								</td>
								<td id='comuna'>									
								</td>
							</tr-->   
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
									<label>Contacto</label>
								</td>
								<td>
									<input type="text" id='contacto' placeholder="Ingrese Contacto"/>
									<div id="valida-contacto" style="display:none" class="errores">
										Debe Ingresar Contacto 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Cargo</label>
								</td>
								<td id='cargo'>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Email</label>
								</td>
								<td>
									<input type="text" id='email' placeholder="Ingrese Email"/>
									<div id="valida-mail" style="display:none" class="errores">
										Debe Ingresar Cargo 
									</div>
									<div id="valida-mail_2" style="display:none" class="errores">
										Debe Ingresar Email valido 
									</div>
								</td>
								<input type="hidden" id='id_cliente' value='<?php echo $id_cliente?>'/>
							</tr>
							<tr>
    							<td>
									<label>Credito Maximo</label>
								</td>
								<td>
									<input type="text" id='credito' disabled placeholder="Ingrese Credito"/>
									<div id="valida-credito" style="display:none" class="errores">
										Debe Ingresar Credito 
									</div>
								</td>
							</tr>
                                                        <tr>
                                                            <td>
									<label>Vendedor</label>
								</td>
								<td id='vendedor'>
								</td>
							</tr>
                                                        <td>
									<label>Condición de Pago</label>
								</td>
								<td id='pago'>
								</td>
							</tr>
                                                        <tr>
                                                            <td>
									<label>Lista de Precio</label>
								</td>
								<td id='lista_precio'>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<div class="fright"><input onClick='$(this).actualizar_cliente_nac();' type="submit" value="Actualizar&raquo;"/>
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
 