<?php
	date_default_timezone_set('UTC');
	$fecha=date("Y-m-d");
	include_once("clases/conexion.php"); 
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	} 
	$user=($_SESSION['usuario']);
	$id_Usuario=($_SESSION['id_Usuario']);  
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Guia de Despacho</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_ventas_productos.js"></script>	
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
</head>
<script>
$(document).ready(function() {	
	$('#num_proforma').keypress(function (e) {
		if(e.which==13)
		{
			var numero_proforma=$("#num_proforma").val();
			var action = confirm('Desea Traer Proforma?');
			if(action==true)
			{
				if ($.trim($("#num_proforma").val())==="0") 
				{
					$('#num_proforma').val('')
					$("#num_proforma").focus ();
					$('#valida-num_proforma').fadeIn('slow'); 
					setTimeout(function(){$('#valida-num_proforma').fadeOut('slow');},1000); 
					return false;
				}
				if ($.trim($("#num_proforma").val())==="") 
				{
					$('#num_proforma').val('')
					$("#num_proforma").focus ();
					$('#valida-num_proforma').fadeIn('slow'); 
					setTimeout(function(){$('#valida-num_proforma').fadeOut('slow');},1000); 
					return false;
				}
				var numero_proforma=$("#num_proforma").val();
                                //alert(numero_proforma);
				var stream="numero_proforma="+numero_proforma+"&"+"funcion="+11;
				$.ajax({
					type: "POST",
					url: "insert/insertar_proforma.php",
					data:stream,
					success: function(data)	{	
						if (data==1)
						{
							var action = confirm('Desea Traer Guia de Despacho de Esta Proforma?');
							if(action==true)
							{
								var numero_proforma=$("#num_proforma").val();
                                                                $("#num_proforma").attr('disabled',true);
								$('#modifcar_guia').show();	
								$('#crear_guia').hide();
                                                                //alert(data);
                                                                
								var stream="numero_proforma="+numero_proforma+"&"+"funcion="+12;
								$.ajax({
									type: "POST",
									url: "insert/insertar_proforma.php",
									data:stream,
									cache: false,
									dataType: 'json',
									success: function(data)	{	
										for(i=0;i<data.length;i++)
										{ 	
											if (data[i].valor==1)
											{
												alert ("Proforma Vacia Ingrese Otra");
												location.href = "guia_despacho.php";
											}
											else
											{
												//alert("hola");
                                                                                                $('#num_guia').val(data[i].numero_guia_despacho);	
                                                                                                $('#id_cliente_internacional').val(data[i].cliente);	
                                                                                                $('#list_aduanas').val(data[i].nombre_aduana);
                                                                                                $('#lis_suc_aduanas').val(data[i].nombre_suc_aduana);
                                                                                                $('#rut_aduana').val(data[i].rut);
                                                                                                $('#direccion').val(data[i].direccion);
                                                                                                $('#fono').val(data[i].fono);
                                                                                                $('#m_nave').val(data[i].nave);
                                                                                                $('#bk').val(data[i].bk);
                                                                                                $('#contenedor').val(data[i].contenedor);	
                                                                                                $('#sello').val(data[i].sello);	
                                                                                                $('#chofer').val(data[i].chofer);	
                                                                                                $('#movil').val(data[i].movil);	
                                                                                                $('#patente').val(data[i].patente);
                                                                                                $('#dus').val(data[i].dus);
                                                                                                $('#kn').val(data[i].kn);
                                                                                                $('#kb').val(data[i].kb);
												$('#ciudad').val(data[i].ciudad);	
												$('#fecha_guia').val(data[i].fecha);	
												
																							
												var stream="numero_proforma="+numero_proforma+"&"+"funcion="+8;
												$.ajax({
													type: "POST",
													url: "insert/insertar_proforma.php",
													data:stream,
													success: function(data)	{	
														$('#productos_finanzas').html("");	
														$('#productos_finanzas').append(data);		
													}			
												});
											}												
										}
									}
								});
							}
						}
						else if (data==2)//aqui
						{					
							var numero_proforma=$("#num_proforma").val();
                                                        var stream="numero_proforma="+numero_proforma+"&"+"funcion="+22;
                                                        $.ajax({
                                                                type: "POST",
                                                                url: "insert/insertar_proforma.php",
                                                                data:stream,
                                                                success: function(data)	{
                                                                    
                                                                        if (data==1)
                                                                        {
                                                                            //alert("muestra");
                                                                            $("#num_proforma").attr('disabled',true);						
                                                                            var stream="numero_proforma="+numero_proforma+"&"+"funcion="+5;
                                                                            $.ajax({
                                                                                    type: "POST",
                                                                                    url: "insert/insertar_proforma.php",
                                                                                    data:stream,
                                                                                    cache: false,
                                                                                    dataType: 'json',
                                                                                    success: function(data)	{	
                                                                                            for(i=0;i<data.length;i++)
                                                                                            {
                                                                                                    if (data[i].valor==1)
                                                                                                    {
                                                                                                            alert ("Proforma Vacia Ingrese Otra");
                                                                                                            location.href = "guia_despacho.php";
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                            $('#id_cliente_internacional').val(data[i].cliente);
                                                                                                            $('#direccion').val(data[i].direccion);
                                                                                                            $('#list_aduanas').val(data[i].agencia);
                                                                                                            $('#lis_suc_aduanas').val(data[i].aduana);
                                                                                                            $('#rut_aduana').val(data[i].rut_agencia);
                                                                                                            $('#ciudad').val(data[i].ciudad);
                                                                                                            $('#fono').val(data[i].fono);
                                                                                                            var stream="numero_proforma="+numero_proforma+"&"+"funcion="+8;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "insert/insertar_proforma.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data)	{	
                                                                                                                            $('#productos_finanzas').html("");	
                                                                                                                            $('#productos_finanzas').append(data);		
                                                                                                                    }			
                                                                                                            });
                                                                                                    }
                                                                                            }
                                                                                    }
                                                                            });
                                                                        }else{
                                                                            //alert("No Autorizada");
                                                                            $('#num_proforma').val('')
                                                                            $("#num_proforma").focus ();
                                                                            $('#valida-num_proforma_no').fadeIn('slow'); 
                                                                            setTimeout(function(){$('#valida-num_proforma_no').fadeOut('slow');},1000); 
                                                                            return false;
                                                                            
                                                                        }
                                                                    }
                                                        });
                                                        
						}						
					}			
				});
			}			
		}
	});	
	 $("#list_aduanas").change(function(){
		var id_aduana = $('#list_aduanas option:selected').attr('id');
		var stream="id_aduana="+id_aduana+"&"+"funcion="+9;		
		$.ajax({
			type: "POST",
			url: "insert/insertar_proforma.php",
			data:stream,
			cache: false,
			dataType: 'json',
			success: function(data)	{								
				for(i=0;i<data.length;i++)
				{
					$('#rut_aduana').val(data[i].rut);
					$('#direccion').val(data[i].direccion);
					$('#ciudad').val(data[i].ciudad);
					$('#fono').val(data[i].fono);
				}
			}			
		});
	});
	$("#fecha_guia").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});	
});
function ValidaSoloNumeros() {
 if ( (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<input type="hidden" id="id_guia"/>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Guia de Despacho</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_comercializacion.php"><input type="button" value="Volver&raquo;"/></a>
								<a href="guia_despacho.php"><input type="button" value="Nueva Guia&raquo;"/></a>
							</div>
						</div>
					 	<table class="tableform">
							<tr>
								<td>
									<label>Numero Proforma</label>
								</td>
								<td>
									<label>Numero de Guia</label>
								</td>
								<td>
									<label>Fecha</label>
								</td>
							</tr>
								<td>
 									<input type="text" id="num_proforma"  placeholder="Numero Proforma" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-num_proforma" style="display:none" class="errores">
										Debe Ingresar Numero de Proforma
									</div> 
                                                                        <div id="valida-num_proforma_no" style="display:none" class="errores">
										Proforma No Autorizada
									</div> 
								</td>
								<td>
									<input type="text" id="num_guia"  placeholder="Numero de Guia" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-num_guia" style="display:none" class="errores">
										Debe Ingresar Numero de Guia
									</div> 
									<div id="valida-respetido" style="display:none" class="errores">
										Numero de Guia Ingresado ya Existe
									</div> 
                                                                        <div id="valida-erroneo" style="display:none" class="errores">
										Numero de Guia Errado
									</div> 
								</td>
								<td>
									<input type="text" id="fecha_guia"  value="<?php echo date('d-m-Y')?>" placeholder="Fecha" readonly/>
									<div id="valida-fecha_proforma" style="display:none" class="errores">
										Debe Ingresar Fecha de Proforma
									</div> 
								</td>
							<tr>
								<td>
									<label>Cliente</label>
								</td>
								<td>
									<label>Aduana</label>
								</td>
							</tr>
								<td>
									<select id="id_cliente_internacional">
									</select>
									<div id="valida-c_inter" style="display:none" class="errores">
										Debe Ingresar Cliente Internacional
									</div>
								</td>
								<td>
									<select id="list_aduanas">
									</select>
									<div id="valida-aduanas" style="display:none" class="errores">
										Debe Ingresar Aduana
									</div> 
								</td>
                                                                <td>
									<label>Sucursal/Puerto de Embarque</label>
									<select id='lis_suc_aduanas'>
									</select>
									<!--input type="text" id="p_embarque" placeholder="Puerto de Embarque"/-->
									<div id="valida-p_enbarque" style="display:none" class="errores">
										Debe Ingresar Puerto de Embarque
									</div>
								</td>
							<tr>
								<td>
									<label>Rut</label>
									<input type="text" id="rut_aduana"  placeholder="Rut Aduana" readonly/>
								</td>
								<td>
									<label>Direccion</label>
									<input type="text" id="direccion"  placeholder="Direccion Aduana" readonly/>
								</td>
								<td>
									<label>Ciudad</label>
									<input type="text" id="ciudad"  placeholder="Ciudad Aduana" readonly/>
								</td>
								<td>
									<label>Fono</label>
									<input type="text" id="fono"  placeholder="Fono Aduana" readonly/>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"> 
												<thead> 
													<tr>
														<th width="100">
															Codigo de	Producto
														</th>
														<th>
															Producto
														</th>
														<th>
															Solicitado
														</th>
													</tr> 
													<tbody id='productos_finanzas'>
													</tbody>
												</thead>
											 </table>
										</div>
									</article>
								</td>
							</tr>
							<tr>
                                                                <td>
                                                                        <label>M Nave:</label>
									<input type="text" id="m_nave" placeholder="Nave"/>
									<div id="valida-m_nave" style="display:none" class="errores">
										Debe Ingresar M Nave
									</div>
								</td>
                                                                <td>
                                                                        <label>BK:</label>
									<input type="text" id="bk" placeholder="Nave"/>
									<div id="valida-bk" style="display:none" class="errores">
										Debe Ingresar BK
									</div>
								</td>
								<td>
									<label>Contenedor</label>
									<input type="text" id="contenedor"  placeholder="Contenedor"/>
									<div id="valida-contenedor" style="display:none" class="errores">
										Debe Ingresar Contenedor
									</div>
								</td>
                                                                <td>
									<label>sello</label>
									<input type="text" id="sello"  placeholder="Contenedor"/>
									<div id="valida-sello" style="display:none" class="errores">
										Debe Ingresar Sello
									</div>
								</td>
                                                            </tr>
                                                            <tr>
								<td>
									<label>Chofer:</label>
									<input type="text" id="chofer"  placeholder="Chofer"/>
									<div id="valida-chofer" style="display:none" class="errores">
										Debe Ingresar Chofer
									</div>
								</td>
                                                                <td>
									<label>Movil</label>
									<input type="text" id="movil"  placeholder="Movil"/>
									<div id="valida-movil" style="display:none" class="errores">
										Debe Ingresar Movil
									</div>
								</td>
								<td>
									<label>Patente:</label>
									<input type="text" id="patente"  placeholder="Patente"/>
									<div id="valida-patente" style="display:none" class="errores">
										Debe Ingresar Patente
									</div>
								</td>
                                                                <td>
									<label>DUS:</label>
									<input type="text" id="dus"  placeholder="Patente"/>
									<div id="valida-dus" style="display:none" class="errores">
										Debe Ingresar DUS
									</div>
								</td>
							</tr>
                                                        <tr>
                                                            <td>
									<label>KN</label>
									<input type="text" id="kn"  placeholder="Chofer"/>
									<div id="valida-kn" style="display:none" class="errores">
										Debe Ingresar KN
									</div>
								</td>
								<td>
									<label>KB:</label>
									<input type="text" id="kb"  placeholder="Patente"/>
									<div id="valida-kb" style="display:none" class="errores">
										Debe Ingresar KB
									</div>
								</td>

                                                        </tr>
							<tr>
								<td colspan="5">
									<div class="fright" id='crear_guia'> 
										<input type="submit" onClick='$(this).ingresa_guia_despacho();' value="Crear Guia de Despacho&raquo;"/> 
									</div>
									<div class="fright" style="display:none" id='modifcar_guia'> 
										<input type="submit" onClick='$(this).modificar_guia_despacho();' value="Modificar Guia de Despacho&raquo;"/> 
									</div>
								</td>
							</tr>
						</div>
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>