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
    $( "#list_familia_ins").change(function() {
        //alert("hola");
        var id_familia_mprima = $('#list_familia_ins option:selected').attr('id');
        //alert(id_familia_mprima);
        if(id_familia_mprima===undefined) 
        {
                    $("#list_familia_mprima").focus ();
                    $('#valida-list_familia_mprima').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-list_familia_mprima').fadeOut('slow');},1000); 
                    return false;
        }
        if($.trim($("#list_familia_ins").val())==="") 
		{
			$("#list_familia_ins").focus ();
			$('#valida-list_familia_ins').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_familia_ins').fadeOut('slow');},1000); 
			//$("#list_familia_mprima").val ("");
			return false;
		}
         //var familia_mprima = $('#list_familia_mprima option:selected').val();       
         //var codigo=familia_mprima.substring(0,3);
         
         //$("#cod_prod").val("MPR"+codigo+familia_mprima);
         var stream="id_familia_mprima="+id_familia_mprima;			 
                    $.ajax({
                        type: "POST",
                        url: "select/trae_pref_familia.php",
                        data:stream,
                        success: function(data){							
                            var codigo="INS"+data;
                            $.ajax({
                                type: "POST",
                                url: "select/trae_id_familia.php",
                                data:stream,
                                success: function(data){							
                                    //alert (data);
                                    var id=data;
                                    var c_id=id.length;
                                    if(c_id==1){
                                        id="00"+id;
                                    }
                                    if(c_id==2){
                                        id="0"+id;
                                    }
                                    if(c_id==3){
                                        id=id;
                                    }
                                    codigo=codigo+id;
                                    $.ajax({
                                        type: "POST",
                                        url: "select/trae_crl_familia.php",
                                        data:stream,
                                        success: function(data){							
                                            //alert (data);
                                            var crl=data;
                                            var c_crl=crl.length;
                                            if(c_crl==1){
                                                crl="00"+crl;
                                            }
                                            if(c_crl==2){
                                                crl="0"+crl;
                                            }
                                            if(c_crl==3){
                                                crl=crl;
                                            }
                                            $("#cod_prod").val(codigo+crl);
                                            $('#codigo').show();
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
			<div class="modulo widht_modulo_full">
				<div class="title"><p>Creacion de Insumo</p>
				</div>
				<div class="content">          
					<div>  
 						<div class="fright"><a href="listado_producto_terminado_ins.php" ><input type="button" value="Volver &raquo;"/></a>
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
									<label>Familia</label>
								</td>
								<td>
									<select id="list_familia_ins" onchange='$(this).select_familia();'>
									</select>
									<div id="valida-list_familia_ins" style="display:none" class="errores">
										Debe Seleccionar Familia
									</div> 
								</td>
							</tr>
							<tr>
                                                            <td>
									<label>Nombre Producto</label>
								</td>
								<td>
									<input type="text" id='producto' placeholder="Ingrese Producto" style="text-transform:uppercase;"/>
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
                                                                <td>
									<label>Stock min</label>
								</td>
								<td>
									<input type="text" id='stock_min' placeholder="Ingrese Stock Minimo" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-stock_min" style="display:none" class="errores">
										Debe Ingresar Stock Minimo
									</div> 
								</td>
							</tr>
							 <tr>
    							<td>
									<label>Dividir por</label>
								</td>
								<td>
									<input type="text" id='divide' placeholder="Ingrese Numero" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-divide" style="display:none" class="errores">
										Debe Ingresar Peso Neto
									</div> 
								</td>
								<td>
									<label>para convertir a cajas</label>
								</td
							</tr>
							 <tr>
    							<td>
									<label>pH a 30ºC</label>
								</td>
								<td>
									<input type="text" id='ph' placeholder="Ingrese pH" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-ph" style="display:none" class="errores">
										Debe Ingresar pH
									</div> 
								</td>
							</tr>
							 <tr>
    							<td>
									<label>Humedad max.</label>
								</td>
								<td>
									<input type="text" id='hume' placeholder="Ingrese Humedad" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-hume" style="display:none" class="errores">
										Debe Ingresar Humedad
									</div> 
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<div class="fright"><input onClick='$(this).ingresa_producto_insumo();' type="submit" value="Crear&raquo;"/>
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