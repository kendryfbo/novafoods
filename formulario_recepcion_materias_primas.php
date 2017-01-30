<?php
	include_once("clases/conexion.php");
	$conexion= new conexion();
	 session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	}
	$usuario=($_SESSION['usuario']);
	$id_Usuario=($_SESSION['id_Usuario']);  
	$fecha=date("d-m-Y");
	$id_bodega=trim($_GET["id_bodega"]);
	$numero_orden=trim($_GET["numero_orden"]);
	$proveedor=trim($_GET["proveedor"]);
	$sql='select 
	productos.nombre_producto,
	calidad.id_producto,
	orden_compra.id_proveedor
	from calidad	
	inner join orden_compra on orden_compra.numero_orden_compra=calidad.numero_orden_compra
	inner join productos on calidad.id_producto=productos.id_producto
	where calidad.id_bodega='.$id_bodega;
	$ejecuta=mysql_query($sql,$conexion->link);
	$número_filas = mysql_num_rows($ejecuta);

	$sql3="INSERT INTO formulario_recepcion_materias_primas (id_usuario)
				VALUES ('$id_Usuario')";
	$resultado=mysql_query($sql3,$conexion->link);
	$id_formulario=mysql_insert_id();
	if ($número_filas<>0)
	{	
		while ($fila = mysql_fetch_array($ejecuta))
		{ 
?>	 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href="css/estilo_tabla_formulario.css" rel="stylesheet" type="text/css"/>
	<link href="css/estilos.css" rel="stylesheet" type="text/css"/>
	<script src="js/jquery.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<script src="js/funcion_calidad.js"></script>
	<script src="js/jquery-ui-custom.min.js"></script>
	<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet"/>
</head>
<script>
$(document).ready(function() {
	$("#fecha_elaboracion").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		showAnimate: 'drop',
	});
	$( "#fecha_elaboracion" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_recepcion").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		showAnimate: 'drop',
	});
	$( "#fecha_recepcion" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_recepcion").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		showAnimate: 'drop',
	});
	$( "#fecha_recepcion" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_vencimiento").datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		showAnimate: 'drop',
	});
	$( "#fecha_vencimiento" ).datepicker( $.datepicker.regional[ "es" ]);
	$( "#tot_recepcionado").change(function() {
		var id_bodega = $("#id_bodega").val ();	 
		var cantidad=$("#tot_recepcionado").val ();	
		var stream="cantidad="+cantidad+"&"+"id_bodega="+id_bodega;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cantidad_reclamo.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
				}
				else
				{
					$("#tot_recepcionado").focus ();
					$('#valida-tot_recept_mayor').fadeIn('slow'); 
					setTimeout(function(){$('#valida-tot_recept_mayor').fadeOut('slow');},1000); 
					$("#tot_recepcionado").val ("");
					return false;
				}
			}
		});
	});
	$("#popdetallestk").dialog({
		autoOpen:false,
		modal:true,
		width:900,
		height:800,
		buttons:{
			"Cerrar":function(){
				$(this).dialog("close");
			}
		}			
	});
});
function ValidaSoloNumeros() {
	if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
		 event.returnValue = false;
	}
</script>
<table class='tableform' border='1' align='center' id='tabla_1'>
	<input type='hidden' id='proveedor' value="<?php echo $proveedor ?>"/>	
	<input type='hidden' id='id_bodega' value="<?php echo $id_bodega ?>"/>	
	<input type='hidden' id='numero_orden' value="<?php echo $numero_orden ?>"/>	
	<input type='hidden' id='id_producto' value="<?php echo $fila[1] ?>"/>	
	<input type='hidden' id='id_proveedor' value="<?php echo $fila[2] ?>"/>
	<tr>
		<div align='center' ><h1><p>Recepcion de Materias Primas en Bodega</p></h1>
		</div>
		<td  colspan='2'>
			<label>Fecha</label>
			<input type='text' id='fecha_formulario' readonly placeholder='Fecha' value="<?php echo $fecha?>"/>
		</td>
		<td>
			<label>N</label>	
			<input type='text' id='numero_fomulario' readonly  placeholder='Formulario'  value="<?php echo $id_formulario?>"/>
		</td>
		<td  colspan='2'>
			<label> Numero de Orden de Compra</label>
			<input type='text' id='num_orden_compra' readonly  value="<?php echo $numero_orden?>" placeholder='Orden' />
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<label>Proveedor</label>
			<input type='text' id='proveedor_reclamo' value="<?php echo $proveedor ?>" placeholder='Proveedor' readonly/>		
		</td>
		<td>
			<label>Lote Proveedor</label>
			<input type='text' id='n_lote'  placeholder='Numero de Lote Proveedor'/>
			<div id='valida-n_lote' style='display:none' class='errores'>
				Debe Ingresar Lote de Proveedor
			</div> 
		</td>
		<td>
			<label>Materia Prima</label>
			<input type='text' id='Producto'  placeholder='Producto' value="<?php echo $fila[0]?>"   readonly/>
		</td>		
	</tr>
	<tr>
		<td>
			<label>Aspecto</label>
			<input type='text' id='aspecto'  placeholder='Aspecto'/>
			<div id='valida-aspecto' style='display:none' class='errores'>
				Debe Ingresar Aspecto
			</div> 
		</td>
		<td>
			<label>Fecha de Recepcion</label>
			<input type='text' id='fecha_recepcion'  placeholder='Fecha de Recepcion' readonly/>
			<div id='valida-fecha_recepcion' style='display:none' class='errores'>
				Debe Ingresar Fecha de Recepcion
			</div> 
		</td>
		<td>
			<label>Tipo de Inspeccion</label>
			<select id="tipo_insp" placeholder='Tipo de Inspeccion'>
				<option	value=''>Seleccione Tipo de Inspeccion</option>
				<option value="visual">Visual</option>
				<option value="muestra">Muestra fisica</option>
 			</select>
			<div id='valida-t_insp' style='display:none' class='errores'>
				Debe Ingresar Tipo de Inspeccion
			</div> 
		</td>
		<td>
			<label>Total Recepcionado</label>
			<input type='text' id='tot_recepcionado' onkeypress='ValidaSoloNumeros()' placeholder='Total Recepcionado'/>
			<div id='valida-tot_recept' style='display:none' class='errores'>
				Debe Ingresar Total Recepcionado
			</div>
			<div id='valida-tot_recept_mayor' style='display:none' class='errores'>
				Debe Ingresar Total Recepcionado Menor Al Recepcionado
			</div> 
		</td>
	</tr>
	<tr>
		<td>
			<label>Fecha de Elaboracion</label>
			<input type='text' id='fecha_elaboracion' placeholder='Fecha de Elaboracion' readonly/>
			<div id='valida-f_elab' style='display:none' class='errores'>
				Debe Ingresar Fecha de Elaboracion
			</div> 
		</td>
		<td width='25%'>
			<label>Fecha de Vencimiento</label>
			<input type='text' id='fecha_vencimiento' placeholder='Fecha de Vencimiento' readonly/>
			<div id='valida-fecha_vencimiento' style='display:none' class='errores'>
				Debe Ingresar Fecha de Vencimiento
			</div> 
		</td>
		<td width='25%'>
			<label>Tama&ntilde;o de Muestra</label>
			<input type='text' id='tam_muestra' onchange='$(this).confirmar_tam_muestra();' onkeypress='ValidaSoloNumeros()' placeholder='Tama&ntilde;o de Muestra'/>
			<div id='valida-tam_muestra' style='display:none' class='errores'>
				Debe Ingresar Tama&ntilde;o de Muestra
			</div> 
			<div id='valida-tam_muestra_mayor' style='display:none' class='errores'>
				Debe Ingresar Tama&ntilde;o de Muestra Menor al Valor que Ingresa
			</div> 
		</td>
	</tr>						
	<tr>
		<td colspan='5'>
			<div class='fright'> 
				<input type='submit' onClick='$(this).ingresa_detalles();' value='Siguiente &raquo;'/> 
			</div>
		</td>
	</tr>
</table>
<?php }
	 } ?>
<table  class='tableform' border='1' align='center' id='tabla_2'  style='display:none'>
	<tr>
		<td colspan='4'>1.-Inspeccion en la Recepci&oacute;n:</td>
	</tr>
	<tr>
		<td colspan='2'>
			Estado e Higiene del Cami&oacute;n (limpio ,Sin Contaminantes)
		</td>
		 <td rowspan='4' colspan='2' align='center'>
			<input type='radio' name='decision_1' value='aceptado' onClick='$(this).aceptado_tabla_2();'>Aceptado<br>
			<input type='radio' name='decision_1' value='rechazado' onClick='$(this).rechazar_cantidad_recepcionada_materia_prima();'>Rechazado
		 </td>
		<tr>
			<td colspan='2'>
				Estado e Higiene de los Embalajes: Limpio,Sin evidencias de Contaminacion
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				Materias Primas: Libre de elementos extra&ntilde;os en muestreo terreno y laboratorio
			</td>
		</tr>
	</tr>
</table>
<table  class='tableform' border='1' align='center' id='tabla_3' style='display:none'>
	<tr>
		<td colspan='4'>2.-Analisis del Producto:</td>
	</tr>
	<tr>
		<tr>
			<td colspan='4' align='center'>
				Inspeccion por Atributos
			</td>
		</tr>
		<td  align='center' width='20%'>
			Defectos Criticos
				AQL:4.0
		</td>
		 <td align='center'>
			Unidades de Aceptacion
		 </td>
		  <td align='center'>
			Unidades de Rechazo
		 </td>
		  <td align='center'>
			Decision
		 </td>
		<tr>
			<td>
				Presencia de Grumos
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Aceptacion'/>
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Rechazo'/>
			</td>
				<td rowspan='5'  align='center'>
				<input type='radio' name='decision_1' value='aceptado'>Aceptado<br>
				<input type='radio' name='decision_1' value='rechazado' onClick='$(this).rechazar_cantidad_recepcionada_materia_prima();'>Rechazado
			 </td>
		</tr>
		<tr>
			<td>
				Polvo Compactado
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Aceptacion'/>
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Rechazo'/>
			</td>
		</tr>
		<tr>
			<td>
				Aspecto del Polvo
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Aceptacion'/>
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Rechazo'/>
			</td>
		</tr>
		<tr>
			<td>
				Olor Del Polvo
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Aceptacion'/>
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Rechazo'/>
			</td>
		</tr>
		<tr>
			<td>
				Color del Polvo
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Aceptacion'/>
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Rechazo'/>
			</td>
		</tr>
		<tr>
			<td align='center'>
				Defectos Mayores AQL :6.5
			</td>
			<td align='center'>
				Unidades de Aceptacion
			</td>
			<td  align='center'>
				Unidades de Rechazado
			</td>
			<td align='center'>
				Decision
			 </td>
		</tr>
		<tr>
			<td>
				Embalaje Defectuoso
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Aceptacion'/>
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Rechazo'/>
			</td>
			<td rowspan='2'  align='center'>
				<input type='radio' name='decision_2' value='aceptado'>Aceptado<br>
				<input type='radio' name='decision_2' value='rechazado' onClick='$(this).rechazar_cantidad_recepcionada_materia_prima();'>Rechazado
			 </td>
		</tr>
		<tr>
			<td>
				Rotulacion Defectuosa
			</td>
				<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Aceptacion'/>
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Unidades de Rechazo'/>
			</td>
		</tr>
	</tr>
	<tr>
		<td colspan='5'>
			<div class='fright'> 
				<input type='submit' onClick='$(this).ingresa_inspeccion_atributos();' value='Siguiente &raquo;'/> 
			</div>
		</td>
	</tr>
</table>
<table  class='tableform' border='1' align='center' id='tabla_4' style='display:none'>
	<tr>
		<td colspan='4'>3.-Analisis de Laboratorio:</td>
	</tr>
	<tr>
		<tr>
			<td colspan='4' align='center'>
				Inspeccion por Variables: Solucion al 0.2 % (Puntaje segun tabla de 1 a 7)
			</td>
		</tr>
		<tr>
			<td colspan='4'>
				Tipos de Solucion:
			</td>
		</tr>
		<td  align='center' width='20%'>
			Tipos de Solucion:
		</td>
		 <td align='center'>
			Valor
		 </td>
		  <td align='center'  colspan='2'>
			Aceptado (A) Rechazado (R)
		 </td>
		<tr>
			<td>
				Solubilidad del polvo
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td colspan='2'>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Aceptado/Rechazado'/>
			</td>
		</tr>
		<tr>
			<td>
				Turbidez de la solucion
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td colspan='2'>
					<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Aceptado/Rechazado'/>
			</td>
		</tr>
		<tr>
			<td>
				PH Solucion
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td colspan='2'>
					<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Aceptado/Rechazado'/>
			</td>
		</tr>
		<tr>
			<td>
				% Humedad
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td colspan='2'>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Aceptado/Rechazado'/>
			</td>
		</tr>
		<tr>
			<td colspan='4'  align='center'>
				Analisis Organoleptico: Solucion al 0.2 % (Puntaje segun tabla 1 a 7)
			</td>
		</tr>
		<tr>
			<td align='center'>
				Sensorial
			</td>
			<td align='center'>
				Valor
			</td>
			<td align='center'  colspan='2'>
				Aceptado (A) Rechazado (R)
			</td>
		</tr>
		<tr>
			<td>
				Color de la Solucion
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td colspan='2'>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Aceptado/Rechazado'/>
			</td>
		</tr>
		<tr>
			<td>
				Olor de la Solucion
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td colspan='2'>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Aceptado/Rechazado'/>
			</td>
		</tr>
		<tr>
			<td>
				Sabor de la Solucion
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td colspan='2'>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Aceptado/Rechazado'/>
			</td>
		</tr>
	</tr>
	<tr>
		<tr>
			<td colspan='4' align='center'>
				Granulometria para Recepcion de Azucar Semola
			</td>
		</tr>
		<td  align='center' width='10%'>
			Numero de Malla Mesh
		</td>
		 <td align='center'>
			Resultado
		 </td>
		  <td align='center'>
			% de Azucar Retenido
		 </td>
		   <td align='center'>
			% de Aceptacion
		 </td>
		<tr>
			<td align='center'>
				20
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td  align='center'>
				0
			</td>
			<td>
				Pasa a Traves de Malla 100% Min
			</td>
		</tr>
		<tr>
			<td align='center'>
				30
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td  align='center'>
				0 - 6 
			</td>
			<td>
				Retiene hasta 6 % Max
			</td>
		</tr>
		<tr>
			<td align='center'>
				40
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td  align='center'>
				0 - 40 
			</td>
			<td>
				Retiene hasta 40 % Max
			</td>
		</tr>
		<tr>
			<td align='center'>
				100
			</td>
			<td>
				<input type='text' onkeypress='ValidaSoloNumeros()' placeholder='Valor'/>
			</td>
			<td  align='center'>
				0 - 90 
			</td>
			<td>
				Pasa a Traves de malla 10 % Max
			</td>
		</tr>
	</tr>
	<tr>
		<td colspan='5'>
			<div class='fright'> 
				<input type='submit' onClick='$(this).termino_evaluacion();' value='Aceptar&raquo;'/> 
			</div>
		</td>
	</tr>
</table>
<div id="popdetallestk">
</div>
</body>
</html>