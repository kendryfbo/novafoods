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
</head> 
<body>
<script>
$(document).ready(function() {
	$("#aceptar_numero").click(function() {	
		if($.trim($("#opcion").val())==="0") 
		{
			$("#opcion").focus();
			$('#valida-opcion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-opcion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#numero").val())==="") 
		{
			$("#numero").focus();
			$('#valida-numero').fadeIn('slow'); 
			setTimeout(function(){$('#valida-numero').fadeOut('slow');},1000); 
			return false;
		}
		var funcion=$('#opcion option:selected').val();
		var numero=$('#numero').val();
		var stream="numero="+numero+"&"+"funcion="+funcion;
		$.ajax({
			type: "GET",
			url: "comprobaciones/comprobar_datos_impresion.php",
			data:stream,
			success: function(data)	{
				if (data==1)
				{
					$("#numero").focus();
					$("#numero").val('');
					$('#valida-numero_no_ext').fadeIn('slow'); 
					setTimeout(function(){$('#valida-numero_no_ext').fadeOut('slow');},1000); 
					return false;
				}
				else
				{
					window.open('select/imprimir_datos_facturas.php?funcion='+funcion+'&numero='+numero);
				}
			}			
		});
	});
});
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<?php
	include_once("menu/menu_comercializacion.php");
?>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Imprimir Documentos</p>
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
											<td>
												<select id="opcion">
													<option value="0" selected >Elija Opcion....</option>
													<option value="1">Factura Nacional</option>
													<option value="2">Nota de Venta</option>
													<option value="3">Factura Internacional</option>
													<option value="4">Proforma</option>
												</select>	
												<div id="valida-opcion" style="display:none" class="errores">
													Favor Ingresar Opcion
												</div> 
											</td>
											<td>
												<input type="text" id="numero" onkeypress="ValidaSoloNumeros()" placeholder='Numero'/>
												<div id="valida-numero" style="display:none" class="errores">
													Favor Ingresar Numero de Documento
												</div> 
												<div id="valida-numero_no_ext" style="display:none" class="errores">
													  Numero de Documento No Existe en Opcion Ingresada
												</div> 
											<td>
											<td>
												<input type="submit" value="Ingresar&raquo;" id='aceptar_numero'/>
											</td>
										</tr>
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