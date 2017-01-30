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
	<title>Productos NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_listados.js"></script>
</head>
<script>
$(document).ready(function() {
    $( "#list_formatos").change(function() {
        //alert("hola");
        if($.trim($("#list_marc").val())==="") 
		{
			$("#list_marc").focus ();
			$('#valida-marca').fadeIn('slow'); 
			setTimeout(function(){$('#valida-marca').fadeOut('slow');},1000); 
			$("#list_formatos").val ("");
			return false;
		}
                
         var id_formato = $('#list_formatos option:selected').attr('id');
         //alert(id_formato);
         var stream="id_formato="+id_formato;			 
                    $.ajax({
                        type: "POST",
                        url: "select/trae_formato_display.php",
                        data:stream,
                        success: function(data){							
                            //alert (data);
                            $("#display").val(data);
                            $.ajax({
                                type: "POST",
                                url: "select/trae_formato_sobre.php",
                                data:stream,
                                success: function(data){							
                                    //alert (data);
                                    $("#sobre").val(data);
                                    $.ajax({
                                        type: "POST",
                                        url: "select/trae_formato_contenido.php",
                                        data:stream,
                                        success: function(data){							
                                            //alert (data);
                                            $("#contenido").val(data);
                                            var dis=$("#display").val();
                                            var sob=$("#sobre").val();
                                            var con=$("#contenido").val();
                                            var net=(dis*sob*con)/1000;
                                            $("#peso_neto").val(net);

                                        }			

                                    });
                                }			

                            });
                            			
                        }			
                        
                    });
                    /*
                         * 

                         */
    }); 
});
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<td height="100%">
		<div class="body">	
                    <input type="hidden"  id="display" value="" />
                    <input type="hidden"  id="sobre" value="" />
                    <input type="hidden"  id="contenido" value="" />
			<div class="modulo widht_modulo_full">
				<div class="title"><p>Creacion de Premezcla</p>
				</div>
				<div class="content">          
					<div>  
 						<div class="fright"><a href="javascript:history.back()"><input type="button" value="Volver &raquo;"/></a>
							</div>
						</div>
						<table class="tableform"> 
					 		<tr id='codigo' style="display:none">
    							<td>
									<label>Codigo de Producto</label>
								</td>
								<td>
									<input type="text" id='cod_prod' placeholder="Ingrese Codigo de Producto" readonly/>
									<div id="valida-cod_prod_r" style="display:none" class="errores">
										Su Codigo de Producto Se Encuentra Registrado Favor Volver a Ingresar
									</div>
									<div id="valida-cod_prod" style="display:none" class="errores">
										Codigo no ingresado Favor Volver a Ingresar
									</div> 
								</td>
							</tr>
                                                        <tr>
                                                            <td>
									<label>Nombre Producto</label>
								</td>
								<td>
									<input type="text" id='producto' placeholder="Ingrese Producto" readonly/>
									<div id="valida-prod" style="display:none" class="errores">
										Producto Ya Se Encuentra Ingresado Favor Volver a Ingresar
									</div> 
									<div id="valida-producto" style="display:none" class="errores">
										Producto no ingresado Favor Volver a Ingresar
									</div> 
								</td>
							</tr>
                                                        <tr>
                                                                <td>
									<label>Marca</label>
								</td>
								<td>
									<select id="list_marc" onchange='$(this).select_marca_pre();'>
									</select>
									<div id="valida-marca" style="display:none" class="errores">
										Debe Ingresar Marca
									</div> 
								</td>       
							</tr>
							
							
							  
							
							 <tr>
								<td>
									<label>Sabor</label>
								</td>
								<td>
									<select id="list_sabor" onchange='$(this).select_sabor_pre();'> 
									</select> 
									<div id="valida-sabor" style="display:none" class="errores">
										Debe Ingresar Sabor
									</div>
								</td>	
							</tr>
                                                        <tr>
								<td>
									<br><label>Unidad de Medida</label>
								</td>
								<td>
									<select id="list_umed" > 
									</select>
									<div id="valida-umed" style="display:none" class="errores">
										Debe Ingresar Unidad de Medida
									</div>
								</td>	
							 </tr> 
							 
							<tr>
								<td colspan="4">
									<div class="fright"><input onClick='$(this).ingresa_producto_premezcla();' type="submit" value="Crear&raquo;"/>
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