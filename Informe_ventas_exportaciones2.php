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
	<title>Informe de Exportaciones</title>
	<meta charset="ISO-8859-1" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>

	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_listados.js"></script>
        <script src="js/funcion_ventas_productos.js"></script>
	<script src="js/jquery.Rut.js" type="text/javascript"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
</head> 
<script>
$(document).ready(function() {
	$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
 dayNamesShort: ['Dom','Lun','Mar','Mi�','Juv','Vie','S�b'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S�'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
//$(function () {
//$("#fecha").datepicker();
//});

	$('#rut').Rut({
		on_error: function()
		{
			$("#rut").focus ();
			$('#valida-rut3').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut3').fadeOut('slow');},1000); 
			$("#rut").val ("");
		}
	}); 
	$("#fecha1").datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#fecha2").datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#fecha3").datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#fecha4").datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#fecha5").datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#fecha6").datepicker({
		dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});

});
function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
</script>
<body>
<?php
	include_once("menu/menu_comercializacion.php");
?>
<table class="table" >
	<td height="100%">
		<div class="body">		 
			<div class="modulo widht_modulo_full">
				<div class="title"><p>Informe de Exportaciones</p>
				</div>
				<div class="content">          
					<div>  
 						<div class="fright"><a href="listado_clientes.php"><input type="button" value="Volver &raquo;"/></a>
							</div>
						</div>
                                                <table class="tablesorter" id="tabla_2"> 
										<thead> 
											<tr>
												<th>
													Seleccione datos a Filtrar :
												</th>
											</tr> 
										</thead>
                                                                                        <tr>
												<td>
													<input type="checkbox" name="ranfec" value="1" onClick='$(this).rango_fecha();'> Rango de Fecha
                                                                                                        <input type="checkbox" name="rancli" value="" onClick='$(this).autoriza_prof_gte1();'> Cliente
                                                                                                        <input type="checkbox" name="ranpro" value="" onClick='$(this).autoriza_prof_gte1();'> Producto
												</td>
											</tr> 										
                                                                        </table><br>
                                                                        <div id='fechas_fil'>
                                                                            <input type='text' id='fecha2'  placeholder='Fecha' />
                                                                        </div><br>
						<table class="tableform"> 
							<!--tr>
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
							</tr-->
							<tr>
    							<td>
									<label>Nombre / Raz�n Social</label>
								</td>
								<td>
									<input type="text" id='nom_client' placeholder="Ingrese Nombre de Cliente" style="text-transform:uppercase;"/>
									<div id="valida-cliente" style="display:none" class="errores">
										Debe Ingresar Cliente 
									</div>
									<div id="valida-cliente_R" style="display:none" class="errores">
										Cliente Existente
									</div>	
							 	</td>
								<td>
									<label>Tipo Empresa</label>
								</td>
								<td>
									<input type="text" id='tip_emp' placeholder="Ingrese Tipo de Emrpesa" style="text-transform:uppercase;"/>
									<div id="valida-cliente" style="display:none" class="errores">
										Debe Ingresar Tipo de Empresa 
									</div>
							 	</td>
							</tr>
							<tr>
    							<td>
									<label>Pais</label>
								</td>
								<td>
									<select id="list_pais"> 
									</select> 
									<div id="valida-pais" style="display:none" class="errores">
										Debe Seleccionar Pais 
									</div>
								</td>
								<td>
									<label>Direccion</label>
								</td>
								<td>
									<input type="text" id='direccion' placeholder="Ingrese Direccion" style="text-transform:uppercase;"/>
									<div id="valida-direccion" style="display:none" class="errores">
										Debe Ingresar Direccion 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Tel�fono</label>
								</td>
								<td>
									<input type="text" id='fono' placeholder="Ingrese Telefono" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-telefono" style="display:none" class="errores">
										Debe Ingresar Telefono 
									</div>
								</td>
								<td>
									<label>Fax</label>
								</td>
								<td>
									<input type="text" id='fax' placeholder="Ingrese Fax" onkeypress="ValidaSoloNumeros()"/>
									<div id="fax" style="display:none" class="errores">
										Debe Ingresar Fax 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>P�gina Web</label>
								</td>
								<td>
									<input type="text" id='web' placeholder="Ingrese P�gina Web" style="text-transform:uppercase;"/>
									<div id="valida-web" style="display:none" class="errores">
										Debe Ingresar P�gina WEB 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Categoria</label>
								</td>
								<td>
									<select id="categoria">
										</select>
									<div id="valida-categoria" style="display:none" class="errores">
										Debe Seleccionar  Categoria 
									</div>
								</td>
								<td>
									<label>Condici�n de Pago </label>
								</td>
								<td>
									<select id="condicion_venta">
										</select>
									<div id="valida-condicion_venta" style="display:none" class="errores">
										Debe Seleccionar Condici�n de Pago 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Credito Maximo</label>
								</td>
								<td>
									<input type="text" id='credito' placeholder="Ingrese Credito" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-credito" style="display:none" class="errores">
										Debe Ingresar Credito 
									</div>
								</td>
							</tr>
							<tr>
    							<td>
									<label>Moneda Local</label>
								</td>
								<td>
									<input type="text" id='moneda' placeholder="Ingrese Moneda Local" style="text-transform:uppercase;"/>
									<div id="valida-moneda" style="display:none" class="errores">
										Debe Ingresar Moneda 
									</div>
								</td>
								<td>
									<label>Idioma</label>
								</td>
								<td>
									<select id="list_idiomas"> 
									</select> 
									<div id="valida-idioma" style="display:none" class="errores">
										Debe Seleccionar Idioma 
									</div>
								</td>
							</tr>
							<tr>
    							<td colspan=6>
									<table>
										<tr>
											<td colspan=8>
												<hr>
											</td>
										</tr>
										<tr>
											<td>
												<label>Gerente General</label>
											</td>
											<td colspan=7>
												<input type="text" id='contacto1' placeholder="Ingrese Gerente General" style="text-transform:uppercase;"/>
											</td>
										</tr>
										<tr>
											<td colspan=2>
												
											</td>
											<td>
												<label>e-Mail</label>
											</td>
											<td>
												<input type="text" id='email1' placeholder="Ingrese Email" style="text-transform:uppercase;"/>
											</td>
											<td>
												<label>Tel�fono</label>
											</td>
											<td>
												<input type="text" id='fono1' placeholder="Ingrese Tel�fono" />
											</td>
											<td>
												<label>Fecha Nacimiento</label>
											</td>
											<td>
												<input type="text" id='fecha1' placeholder="Ingrese F.Nacimiento"/>
											</td>
										</tr>
										<tr>
											<td colspan=8>
												<hr>
											</td>
										</tr>
										<tr>
											<td>
												<label>Gerente Finanzas</label>
											</td>
											<td colspan=7>
												<input type="text" id='contacto2' placeholder="Ingrese Gerente Finanzas" style="text-transform:uppercase;"/>
											</td>
										</tr>
										<tr>
											<td colspan=2>
												
											</td>
											<td>
												<label>e-Mail</label>
											</td>
											<td>
												<input type="text" id='email2' placeholder="Ingrese Email" style="text-transform:uppercase;"/>
											</td>
											<td>
												<label>Tel�fono</label>
											</td>
											<td>
												<input type="text" id='fono2' placeholder="Ingrese Tel�fono"/>
											</td>
											<td>
												<label>Fecha Nacimiento</label>
											</td>
											<td>
												<input type="text" id='fecha2' placeholder="Ingrese F.Nacimiento"/>
											</td>
										</tr>
										<tr>
											<td colspan=8>
												<hr>
											</td>
										</tr>
										<tr>
											<td>
												<label>Gerente Comercial</label>
											</td>
											<td colspan=7>
												<input type="text" id='contacto3' placeholder="Ingrese Gerente Comercial" style="text-transform:uppercase;"/>
											</td>
										</tr>
										<tr>
											<td colspan=2>
												
											</td>
											<td>
												<label>e-Mail</label>
											</td>
											<td>
												<input type="text" id='email3' placeholder="Ingrese Email" style="text-transform:uppercase;"/>
											</td>
											<td>
												<label>Tel�fono</label>
											</td>
											<td>
												<input type="text" id='fono3' placeholder="Ingrese Tel�fono"/>
											</td>
											<td>
												<label>Fecha Nacimiento</label>
											</td>
											<td>
												<input type="text" id='fecha3' placeholder="Ingrese F.Nacimiento"/>
											</td>
										</tr>
										<tr>
											<td colspan=8>
												<hr>
											</td>
										</tr>
										<tr>
											<td>
												<label>Jefe Producto</label>
											</td>
											<td colspan=7>
												<input type="text" id='contacto4' placeholder="Ingrese Jefe Producto" style="text-transform:uppercase;"/>
											</td>
										</tr>
										<tr>
											<td colspan=2>
												
											</td>
											<td>
												<label>e-Mail</label>
											</td>
											<td>
												<input type="text" id='email4' placeholder="Ingrese Email" style="text-transform:uppercase;"/>
											</td>
											<td>
												<label>Tel�fono</label>
											</td>
											<td>
												<input type="text" id='fono4' placeholder="Ingrese Tel�fono"/>
											</td>
											<td>
												<label>Fecha Nacimiento</label>
											</td>
											<td>
												<input type="text" id='fecha4' placeholder="Ingrese F.Nacimiento"/>
											</td>
										</tr>
										<tr>
											<td colspan=8>
												<hr>
											</td>
										</tr>
										<tr>
											<td>
												<label>Comercio Exterior</label>
											</td>
											<td colspan=7>
												<input type="text" id='contacto5' placeholder="Ingrese Comercio Exterior" style="text-transform:uppercase;"/>
											</td>
										</tr>
										<tr>
											<td colspan=2>
												
											</td>
											<td>
												<label>e-Mail</label>
											</td>
											<td>
												<input type="text" id='email5' placeholder="Ingrese Email" style="text-transform:uppercase;"/>
											</td>
											<td>
												<label>Tel�fono</label>
											</td>
											<td>
												<input type="text" id='fono5' placeholder="Ingrese Tel�fono"/>
											</td>
											<td>
												<label>Fecha Nacimiento</label>
											</td>
											<td>
												<input type="text" id='fecha5' placeholder="Ingrese F.Nacimiento"/>
											</td>
										</tr>
										<tr>
											<td colspan=8>
												<hr>
											</td>
										</tr>
										<tr>
											<td>
												<label>Contabilidad</label>
											</td>
											<td colspan=7>
												<input type="text" id='contacto6' placeholder="Ingrese Contador" style="text-transform:uppercase;"/>
											</td>
										</tr>
										<tr>
											<td colspan=2>
												
											</td>
											<td>
												<label>e-Mail</label>
											</td>
											<td>
												<input type="text" id='email6' placeholder="Ingrese Email" style="text-transform:uppercase;"/>
											</td>
											<td>
												<label>Tel�fono</label>
											</td>
											<td>
												<input type="text" id='fono6' placeholder="Ingrese Tel�fono"/>
											</td>
											<td>
												<label>Fecha Nacimiento</label>
											</td>
											<td>
												<input type="text" id='fecha6' placeholder="Ingrese F.Nacimiento"/>
											</td>
										</tr>
									</table>
								</td>
								<!--td>
									
								</td>
								<td>
									
								</td>
								<td>
									
								</td-->
							</tr>


							<!--tr>
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
							</tr-->
							
							
							<tr>
								<td colspan="4">
									<div class="fright"><input onClick='$(this).crear_cliente_int();' type="submit" value="Crear&raquo;"/>
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
 