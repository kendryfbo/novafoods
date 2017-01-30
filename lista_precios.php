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
	<title>Lista de Precios</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
        <script src="js/funcion_listados.js"></script>
        <!--script src="js/funcion_ventas_productos.js"></script-->
	<script src="js/jquery-ui-custom.min.js"></script>
	<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet"/>
</head>
<script>
$(document).ready(function() {	
	var stream="funcion="+4;
	$.ajax({
		type: "POST",
		url: "insert/ingresa_nota_venta.php",
		data:stream,
		success: function(data)	{
			$("#lista_precio_").html ("");
			$("#lista_precio_").append (data);
		}	
	});
	$("#lista_precio_").change(function() {
		var id_lista_precio= $('#lista_precio1 option:selected').attr('id');
                //alert("aqui");
                if(id_lista_precio=="") 
                        {
                                $("#lista_precio").focus ();
                                $('#valida-precios').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-precios').fadeOut('slow');},1000); 
                                $('#productos_finanzas').html('');
                                return false;
                        }
                        $("#lista_precio1").attr('disabled', true);
                //var lista_precio=$('#lista_precio option:selected').attr('id');
		var stream="id_lista_precio="+id_lista_precio+"&"+"funcion="+18;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			success: function(data)	{
                           // alert(data);
				$('#productos_finanzas').html('');
				$('#productos_finanzas').append(data);
			}
		});	
	});
        $('#busca_pro').keypress(function (e) {
		if(e.which ==13)
		{
			var busca_pro=$("#busca_pro").val();
			//alert(busca_pro);
			if($.trim($("#busca_pro").val())==="") 
			{
				//busca todos los productos
				var stream="busca_pro="+busca_pro+"&"+"funcion="+1;
				$.ajax({
					type: "POST",
					url: "combos/trae_productos.php",
					data:stream,
					success: function(data)	{	
						//alert(data);
						$('#list_prod_term_proforma').html("");	
						$('#list_prod_term_proforma').append(data);
					}			
				});
			}else{
				var stream="busca_pro="+busca_pro+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "combos/trae_productos.php",
					data:stream,
					success: function(data)	{	
						//alert(data);
						$('#list_prod_term_proforma').html("");	
						$('#list_prod_term_proforma').append(data);
					}			
				});
			}
		}
	});
         $('#precio').keypress(function (e) {
		if(e.which ==13)
		{
                    if($.trim($("#list_prod_term_proforma").val())==="") 
                    {
                            $("#list_prod_term_proforma").focus();
                            $('#valida-producto').fadeIn('slow'); 
                            setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
                            return false;
                    }
                    if($.trim($("#precio").val())==="") 
                    {
                            $("#precio").focus();
                            $('#valida-precio').fadeIn('slow'); 
                            setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
                            return false;
                    }
                    var lista_precio=$('#lista_precio1 option:selected').attr('id');
                    var id_lista_precio=$('#lista_precio1 option:selected').attr('id');
                    
                    if(lista_precio=="") 
                    {
                                $("#lista_precio").focus ();
                                $('#valida-precios').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-precios').fadeOut('slow');},1000); 
                                return false;
                    }
                    
                    var precio=$("#precio").val();
                    var id_producto=$('#list_prod_term_proforma option:selected').attr('id');
                    
                    var stream="id_producto="+id_producto+"&"+"lista_precio="+lista_precio+"&"+"precio="+precio;
                        //var stream="marca="+marca;
                        $.ajax({
                                type: "POST",
                                url: "comprobaciones/comprobar_prod_lista_precio.php",
                                data:stream,
                                success: function(data) {	
                                    //alert(data);
                                        if (data.indexOf("Error")==-1)
                                        {	
                                                
                                                var stream="id_producto="+id_producto+"&"+"lista_precio="+lista_precio+"&"+"precio="+precio+"&"+"funcion="+1;
                                                $.ajax({
                                                        type: "POST",
                                                        url: "insert/insertar_prod_lista_precio.php",
                                                        data:stream,
                                                        success: function(data)	{	
                                                                alert(data);
                                                                $("#precio").val();
                                                                var stream="funcion="+1;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "combos/trae_productos.php",
                                                                        data:stream,
                                                                        success: function(data)	{	
                                                                                //alert(data);
                                                                                $('#list_prod_term_proforma').html("");	
                                                                                $('#list_prod_term_proforma').append(data);
                                                                        }			
                                                                });
                                                                var stream="id_lista_precio="+id_lista_precio+"&"+"funcion="+18;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/ingresa_nota_venta.php",
                                                                        data:stream,
                                                                        success: function(data)	{
                                                                           // alert(data);
                                                                                $('#productos_finanzas').html('');
                                                                                $('#productos_finanzas').append(data);
                                                                        }
                                                                });
                                                        }			
                                                });
                                        }
                                        else
                                        {
                                                //Si posee uno actualiza si no no
                                                var permite_actualiza=$("#permite_actualiza").val();
                                                if(permite_actualiza==1){
                                                    //alert(permite_actualiza);
                                                    var stream="id_producto="+id_producto+"&"+"lista_precio="+lista_precio+"&"+"precio="+precio+"&"+"funcion="+2;
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "insert/insertar_prod_lista_precio.php",
                                                            data:stream,
                                                            success: function(data)	{	
                                                                    alert(data);
                                                                    
                                                                    
                                                                    $("#lista_precio1").attr('disabled',false);
                                                                    $("#list_prod_term_proforma").attr('disabled',false);
                                                                    
                                                                    $('#busca_pro').val("");
                                                                    $('#permite_actualiza').val("");
                                                                    $("#precio").val("");
                                                                    
                                                                    $('#busca_pro').html("");
                                                                    $('#permite_actualiza').html("");
                                                                    $('#precio').html("");
                                                                    
                                                                    var stream="funcion="+1;
                                                                    $.ajax({
                                                                            type: "POST",
                                                                            url: "combos/trae_productos.php",
                                                                            data:stream,
                                                                            success: function(data)	{	
                                                                                    //alert(data);
                                                                                    $('#list_prod_term_proforma').html("");	
                                                                                    $('#list_prod_term_proforma').append(data);
                                                                            }			
                                                                    });
                                                                    var stream="id_lista_precio="+id_lista_precio+"&"+"funcion="+18;
                                                                    $.ajax({
                                                                            type: "POST",
                                                                            url: "insert/ingresa_nota_venta.php",
                                                                            data:stream,
                                                                            success: function(data)	{
                                                                               // alert(data);
                                                                                    $('#productos_finanzas').html('');
                                                                                    $('#productos_finanzas').append(data);
                                                                            }
                                                                    });
                                                            }			
                                                    });
                                                }else{
                                                    $("#list_prod_term_proforma").focus ();
                                                    $('#valida-producto_r').fadeIn('slow'); 
                                                    setTimeout(function(){$('#valida-producto_r').fadeOut('slow');},1000); 
                                                    //$("#marca").val ("");
                                                    return false;
                                                }
                                                
                                        }
                                }			
                        });
                        //alert(stream);
                        
            }
	});
        
	$("#popdetallestk").dialog({
		autoOpen:false,
		modal:true,
		width:300,
		height:200,
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
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Lista de Precios</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_comercializacion.php"><input type="button" value="Volver&raquo;"/></a>
							</div>
						</div>
                                                <article class="module width_full">            
							<div class="module_content">
                                                            <table class="tableform">
                                                                <tr>
                                                                    <td style="width: 10%">
                                                                                <label>Lista de Precios</label>
                                                                        </td>
                                                                        <td id='lista_precio_'style="width: 20%">
                                                                        </td>	
                                                                    <td>
                                                                        <input type="hidden" id="id_Usuario"  value="<?php echo $id_Usuario?>"/>	
                                                                    </td>
                                                                        
                                                                </tr>
                                                            </table><br>
                                                            <table class="tableform">    
                                                                <tr>
                                                                    <td colspan="2">
                                                                            <article class="module width_full">            
                                                                                <div class="module_content">
                                                                                    <thead> 
													<tr>
														
														<td>
															<h3><font style="color: black"><b>Producto</b></h3>
															<input type="text" id="busca_pro" placeholder="Ingrese Producto a Filtrar y presione Enter"/>
															<select id="list_prod_term_proforma" class="limpiar">
															</select>
															<div id="valida-producto" style="display:none" class="errores">
																Debe Ingresar Producto
															</div> 
                                                                                                                        <div id="valida-producto_r" style="display:none" class="errores">
																Producto ya registrado
															</div> 
															<div id="stock" style="display:none" class="errores">
															</div> 
                                                                                                                        </font>
														</td>
														<td>
                                                                                                                    <h3><font style="color: black"><b>Precio</b></h3>
															<input type="text" id="precio" onkeypress="ValidaSoloNumeros()" class="limpiar"  placeholder="Precio"/>
                                                                                                                        <input type="text" id="permite_actualiza">
															<div id="valida-precio" style="display:none" class="errores">
																Debe Ingresar Precio
															</div> 
                                                                                                                        <br>(Presione Enter para Ingresar)
                                                                                                                        </font>
														</td>
														
														
													</tr>
													
												</thead> 
                                                                                </div>
                                                                            </article>
                                                                        </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                </article>
					 	<table class="tableform">
												
							<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter" > 
												<thead> 
													<tr>
														<th>
															Producto
														</th>
														<th>
															Precio
														</th>
														<th>
															Editar
														</th>
													</tr> 
													<tbody id='productos_finanzas'>
														<div id="valida-productos_proforma" style="display:none" class="errores">
															Sin Datos
														</div> 
													</tbody>
												</thead>
											 </table>
										</div>
									</article>
								</td>
							</tr>
						</table>	
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
<div id="popdetallestk">	
</div>
</body>
</html>