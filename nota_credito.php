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
	<title>Nota de Credito</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_ventas_productos.js"></script>	
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<script src="js/jquery-ui-custom.min.js"></script>
	<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet" />
</head>
<script>
$(document).ready(function() {	
	$("#fecha_nota_venta").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
        //
        $('#factura').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#factura").val())==="0") 
			{
				$("#factura").focus();
				$('#valida-factura_0').fadeIn('slow'); 
				setTimeout(function(){$('#valida-factura_0').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#factura").val())==="") 
			{
				$("#factura").focus();
				$('#valida-factura').fadeIn('slow'); 
				setTimeout(function(){$('#valida-factura').fadeOut('slow');},1000); 
				$("#factura").val('');
				return false;
			}
                        if($.trim($("#centro_venta").val())==="") 
			{
				$("#centro_venta").focus();
				$('#valida-c_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
				//$("#factura").val('');
				return false;
			}
                        if($.trim($("#n_credito").val())==="") 
			{
				//$("#n_credito").val("NUEVA");
                                $("#n_credito").focus();
				$('#valida-n_credito_crear').fadeIn('slow'); 
				setTimeout(function(){$('#valida-n_credito_crear').fadeOut('slow');},1000); 
				//$("#n_credito").val('');
				return false;
			}
                        if($.trim($("#referencia").val())==="") 
			{
				$("#referencia").focus();
				$('#valida-referencia').fadeIn('slow'); 
				setTimeout(function(){$('#valida-referencia').fadeOut('slow');},1000); 
				//$("#factura").val('');
				return false;
			}
                        if($.trim($("#observacion_nc").val())==="") 
			{
				$("#factura").val('');
                                $("#observacion_nc").focus();
				$('#valida-observacion_nc').fadeIn('slow'); 
				setTimeout(function(){$('#valida-observacion_nc').fadeOut('slow');},1000); 
				//$("#factura").val('');
				return false;
			}
                        
			var numero_nota_venta=$("#num_nota_venta").val();
                        var centro_venta=$('#centro_venta option:selected').attr('id');
                        //alert(centro_venta);
                        var referencia=$('#referencia option:selected').attr('id');
                        var id_usuario = "<?php echo $id_Usuario; ?>";
			var factura=$("#factura").val();
                        //alert(referencia);
                        if(referencia==2){
                            $("#insert_prod").show();
                        }else{
                            $("#insert_prod").hide();
                        }
                        
                        if(referencia==3){
                            $("#insert_desc").show();
                        }else{
                            $("#insert_desc").hide();
                        }
                        
			var stream="factura="+factura
                                    +"&"+"centro_venta="+centro_venta
                                    +"&"+"funcion="+8;
			$.ajax({
				type: "POST",
				url: "select/funciones_facturacion.php",
				data:stream,
				success: function(data)	{
                                    //alert(data);
					if (data==1)
					{
						/*var action = confirm('Desea Crear Esta Factura ?');
						if(action==true)
						{
							var id_usuario = "<?php echo $id_Usuario; ?>";
							var factura=$("#factura").val();
							var fecha_factura=$("#fecha_factura").val();						
							var stream="factura="+factura+"&"+"id_usuario="+id_usuario+"&"+"numero_nota_venta="+numero_nota_venta
								+"&"+"fecha_factura="+fecha_factura+"&"+"funcion="+9;
							$("#imprimir_factura").hide();				
							$.ajax({
								type: "POST",
								url: "select/funciones_facturacion.php",
								data:stream,
								success: function(data)	{
									alert (data);
									$("#factura").attr('disabled',true);
								}
							});	
						}
						else
						{
							$("#factura").val('');
						}*/
					}
					else if (data==2)
					{
						var action = confirm('Desea Importar Factura?');
                                                //var action = confirm('Esta Factura se Encuentra Registrada desea Traer?');
						if(action==true)
						{
                                                    //valida si ya esta asignada a una nota de Credito
                                                    
                                                    
							$('#div_anular').show();
							//$('#imprimir_factura').show();	
							$('#ingresar_factura').hide();		
							$('#prod_select').hide();
							$("#factura").attr('disabled',true);
							$("#num_nota_venta").attr('disabled',true);
                                                        $("#referencia").attr('disabled',true);
                                                        $("#centro_venta").attr('disabled',true);
							var factura=$("#factura").val();
                                                        
							var stream="factura="+factura
                                                                +"&"+"centro_venta="+centro_venta
                                                                +"&"+"funcion="+15;
                                                       // alert(stream);
							$.ajax({
								type: "POST",
								url: "select/funciones_facturacion.php",
								data:stream,
								cache: false,
								dataType: 'json',
								success: function(data){
                                                                    //alert(data);
                                                                    //aqui voy 222
									for(i=0;i<data.length;i++)
									{
										$('#num_nota_venta').val(data[i].numero_nota_venta);
                                                                                /*$('#cliente').val(data[i].cliente);
										$('#cond_venta').val(data[i].Condicion);
										$('#c_venta').val(data[i].centro_venta);
										$('#vendedores').val(data[i].vendedor);
										$('#dia_pago').val(data[i].dias_pago);
										$('#fecha_venc_fac').val(data[i].nuevafecha);
										$('#subtotal').val(data[i].sub_total);
										$('#iva').val(data[i].iva);
										$('#ila').val(data[i].total);
										$('#total').val(data[i].total_ila);			
										$('#num_nota_venta').val(data[i].numero_nota_venta);			
										var stream="factura="+factura+"&"+"funcion="+20;
										$.ajax({
											type: "POST",
											url: "select/funciones_facturacion.php",
											data:stream,
											success: function(data)	{
												$('#productos_finanzas ').html("");	
												$('#productos_finanzas').append(data);		
											}
										});	*/
                                                                                
									}
                                                                        $("#num_nota_venta").attr('disabled',true);
                                                                        
                                                                            var numero_nota_venta=$("#num_nota_venta").val ();
                                                                            var stream="numero_nota_venta="+numero_nota_venta
                                                                                    +"&"+"centro_venta="+centro_venta
                                                                                    +"&"+"funcion="+6;
                                                                            $.ajax({
                                                                                    type: "POST",
                                                                                    url: "insert/ingresa_nota_venta.php",
                                                                                    data:stream,
                                                                                    cache: false,
                                                                                    dataType: 'json',
                                                                                    success: function(data)	{	
                                                                                            for(i=0;i<data.length;i++)
                                                                                            {
                                                                                                    if (data[i].valor==1)
                                                                                                    {
                                                                                                            alert ("Nota de Venta Vacia Ingrese Otra");
                                                                                                            $("#btn_imprimir").hide();
                                                                                                            $("#btn_nota_nueva").hide();									
                                                                                                            $(".limpiar").val ('');
                                                                                                            $(".limpiar_2").val (0);				
                                                                                                            $("#productos_finanzas").html ('');	
                                                                                                            location.href = "crear_nota_venta.php";
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                            //aqui voy
                                                                                                            $('#fecha_nota_venta').val(data[i].fecha_nota_venta);
                                                                                                            $('#id_cliente_nacional').val(data[i].cliente);
                                                                                                            var id_cliente= (data[i].id_cliente);
                                                                                                            //alert(id_cliente);//
                                                                                                            $('#centro_venta').val(data[i].centro_venta);
                                                                                                            $('#orden_compra').val(data[i].orden_compra);
                                                                                                            $('#fecha_despacho_nota_venta').val(data[i].fecha_despacho);
                                                                                                            //$('#condicion_venta').val(data[i].Condicion);
                                                                                                            var Condicion=(data[i].Condicion);
                                                                                                            $('#rut_cliente').val(data[i].rut);
                                                                                                            //$('#list_vendedores').val(data[i].vendedor);
                                                                                                            var vendedor=(data[i].vendedor);
                                                                                                            $('#obs_despacho').val(data[i].observacion);
                                                                                                            
                                                                                                            ///Valida su referencia
                                                                                                            //alert(referencia);
                                                                                                            if(referencia==1 || referencia==3){
                                                                                                                $('#subtotal_nota_venta').val(data[i].sub_total);
                                                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_subtotal').html(data);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#iva_nota_venta').val(data[i].iva);
                                                                                                                    var dato=$('#iva_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_iva').html(data);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#total_nota_venta').val(data[i].total);
                                                                                                                    var dato=$('#total_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_total').html(data);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#ila_nota_venta').val(data[i].ila);
                                                                                                                    var dato=$('#ila_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_ila').html(data);
                                                                                                                        }			
                                                                                                                    });
                                                                                                            }else{
                                                                                                                $('#subtotal_nota_venta').val(0);
                                                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_subtotal').html(0);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#iva_nota_venta').val(0);
                                                                                                                    var dato=$('#iva_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_iva').html(0);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#total_nota_venta').val(0);
                                                                                                                    var dato=$('#total_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_total').html(0);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#ila_nota_venta').val(0);
                                                                                                                    var dato=$('#ila_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_ila').html(0);
                                                                                                                        }			
                                                                                                                    });
                                                                                                                    
                                                                                                            }
                                                                                                            

                                                                                                            $('#version').val(data[i].version);
                                                                                                            var suc=(data[i].suc);
                                                                                                            //alert(suc);
                                                                                                            var stream="suc="+suc;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_sucursal_cli_nac2.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#suc').html();
                                                                                                                            $('#suc').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            //
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_pago_cliente_nac.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#pago').html();
                                                                                                                            $('#pago').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_vendedor_cli_na.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#vend').html();
                                                                                                                            $('#vend').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_canal_cliente_nac.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#canal').html();
                                                                                                                            $('#canal').html(data);	
                                                                                                                            var id_canal=$('#canal_cli option:selected').attr('id');
                                                                                                                             var stream="id_canal="+id_canal;
                                                                                                                                $.ajax({
                                                                                                                                                type: "POST",
                                                                                                                                                url: "select/trae_descuento_canal_cliente_nac.php",
                                                                                                                                                data:stream,
                                                                                                                                                success: function(data){
                                                                                                                                                        //alert (data);
                                                                                                                                                        $("#descuento").val (data);	
                                                                                                                                                }			
                                                                                                                                        });

                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_lista_cliente_nac_nota.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#lista_precio').html();
                                                                                                                            $('#lista_precio').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                           var centro_venta=$('#centro_venta option:selected').attr('id');
                                                                                                            //alert(centro_venta);
                                                                                                            if(referencia==1){
                                                                                                            //if(referencia==1 || referencia==3){
                                                                                                                var stream="numero_nota_venta="+numero_nota_venta
                                                                                                                    +"&"+"centro_venta="+centro_venta
                                                                                                                    +"&"+"funcion="+121;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/ingresa_nota_venta.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data)	{	
                                                                                                                                    $('#productos_finanzas').html("");	
                                                                                                                                    $('#productos_finanzas').append(data);		
                                                                                                                            }			
                                                                                                                    });
                                                                                                                    //$("#btn_imprimir").show();
                                                                                                                    //$("#prod_nota_modificar").show();												
                                                                                                                    $("#prod_nota_nuevos").hide();	
                                                                                                                    //$("#btn_nota_modificada").show();	
                                                                                                                    $("#btn_nota_nueva").hide();
                                                                                                                    
                                                                                                                    //Regsitra en Temporal
                                                                                                                    var stream="id_cliente="+id_cliente;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/trae_lista_cliente_nac_nota.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data) {
                                                                                                                                    $('#lista_precio').html();
                                                                                                                                    $('#lista_precio').html(data);			 
                                                                                                                            }	 			
                                                                                                                    });
                                                                                                                    $("#des_referencia").focus();
                                                                                                            }
                                                                                                            //Insert Import
                                                                                                            if(referencia==1){
                                                                                                            //if(referencia==1 || referencia==3){
                                                                                                                var observacion_nc=$("#observacion_nc").val ();
                                                                                                                //var stream="id_cliente="+id_cliente;
                                                                                                                var stream="numero_nota_venta="+numero_nota_venta
                                                                                                                +"&"+"centro_venta="+centro_venta
                                                                                                                +"&"+"id_usuario="+id_usuario
                                                                                                                +"&"+"factura="+factura
                                                                                                                +"&"+"referencia="+referencia
                                                                                                                +"&"+"observacion_nc="+observacion_nc
                                                                                                                +"&"+"funcion="+1;
                                                                                                                $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "insert/ingreso_temp_nc.php",
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                                //$('#lista_precio').html();
                                                                                                                                //$('#lista_precio').html(data);	
                                                                                                                                alert(data);
                                                                                                                        }	 			
                                                                                                                });
                                                                                                                $("#ingresa_nc").show();
                                                                                                            }
                                                                                                            
                                                                                                    }						 
                                                                                            }								
                                                                                    }			
                                                                            });
								}
							});
						}
						else
						{
							$("#factura").val('');
						}	
					}
					else if (data==3)
					{
						var action = confirm('Esta Factura se Encuentra Anulada desea Traer?');
						if(action==true)
						{
							$('#imprimir_factura').show();	
							$('#ingresar_factura').hide();		
							$("#anulada_td").show();	
							$('#prod_select').hide();
							$("#factura").attr('disabled',true);
							$("#num_nota_venta").attr('disabled',true);
							var factura=$("#factura").val();
							var stream="factura="+factura+"&"+"funcion="+15;
							$.ajax({
								type: "POST",
								url: "select/funciones_facturacion.php",
								data:stream,
								cache: false,
								dataType: 'json',
								success: function(data){
									for(i=0;i<data.length;i++)
									{
										$('#cliente').val(data[i].cliente);
										$('#cond_venta').val(data[i].Condicion);
										$('#c_venta').val(data[i].centro_venta);
										$('#vendedores').val(data[i].vendedor);
										$('#dia_pago').val(data[i].dias_pago);
										$('#fecha_venc_fac').val(data[i].nuevafecha);
										$('#subtotal').val(data[i].sub_total);
										$('#iva').val(data[i].iva);
										$('#ila').val(data[i].total);
										$('#total').val(data[i].total_ila);			
										$('#num_nota_venta').val(data[i].numero_nota_venta);			
									}
									var factura=$("#factura").val();
									var stream="factura="+factura+"&"+"funcion="+20;
									$.ajax({
										type: "POST",
										url: "select/funciones_facturacion.php",
										data:stream,
										success: function(data)	{
											$('#productos_finanzas ').html("");	
											$('#productos_finanzas').append(data);		
										}
									});	
								}
							});
						}
						else
						{
							$("#factura").val('');
						}
					}
				}			
			});	
		}
	});
        /*
	$('#factura_nota_credito').keypress(function (e) {
		if(e.which==13)
		{
			var action = confirm('Desea Traer Factura?');
			if(action==true)
			{
				if($.trim($("#factura_nota_credito").val())==="") 
				{
					$("#factura_nota_credito").focus();
					$('#valida-fact').fadeIn('slow'); 
					setTimeout(function(){$('#valida-fact').fadeOut('slow');},1000); 
					return false;
				}
				if ($.trim($("#factura_nota_credito").val())==="0") 
				{
					$('#factura_nota_credito').val('')
					$("#factura_nota_credito").focus ();
					$('#valida-fact_0').fadeIn('slow'); 
					setTimeout(function(){$('#valida-fact_0').fadeOut('slow');},1000); 
					return false;
				}
				var factura_nota_credito=$("#factura_nota_credito").val ();
				var stream="factura_nota_credito="+factura_nota_credito+"&"+"funcion="+9;
				$.ajax({
					type: "POST",
					url: "insert/funciones_notas_credito.php",
					data:stream,
					success: function(data)	{
						if (data==1)
						{
							$("#factura_nota_credito").focus();
							$("#factura_nota_credito").val('');
							$('#valida-fact_ext').fadeIn('slow'); 
							setTimeout(function(){$('#valida-fact_ext').fadeOut('slow');},1000); 
							return false;
						}
						else if (data==2)
						{
							$("#factura_nota_credito").focus();
							$("#factura_nota_credito").val('');
							$('#valida-fact_ing').fadeIn('slow'); 
							setTimeout(function(){$('#valida-fact_ing').fadeOut('slow');},1000); 
						}
						else if (data==3)
						{
							$("#ingreso_prod").show();
							$("#total_nota").attr('readonly',true);
							$("#iva_nota").attr('readonly',true);
							$("#ila_nota").attr('readonly',true);
							$("#subtotal_nota").attr('readonly',true);							
							var stream="factura_nota_credito="+factura_nota_credito+"&"+"funcion="+21;
							$.ajax({
								type: "POST",
								url: "insert/ingresa_nota_venta.php",
								data:stream,
								cache: false,
								dataType: 'json',
								success: function(data)	{
									for(i=0;i<data.length;i++)
									{
										$('#id_cliente_nacional').val(data[i].nombre_cliente);
										$('#centro_venta').val(data[i].centro_venta);
										var stream="factura="+factura_nota_credito+"&"+"funcion="+16;
										$.ajax({
											type: "POST",
											url: "select/funciones_facturacion.php",
											data:stream,
											success: function(data)	{
												$('#productos_finanzas').html("");	
												$('#productos_finanzas').append(data);		
											}
										});	
									}
								}
							});	
						}
					}
				});					
			}
		}
	});	*/
        
        $('#cajas').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#estado").val())>"0") 
                        {
                                $("#cajas").focus();
                                $('#valida-cajas_autorizad').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-cajas_autorizad').fadeOut('slow');},1000); 
                                return false;
                        }
                        if($.trim($("#cajas").val())==="") 
                        {
                                $("#cajas").focus();
                                $('#valida-cajas').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-cajas').fadeOut('slow');},1000); 
                                return false;
                        }
                        if($.trim($("#precio").val())==="0") 
                        {
                                $("#precio").focus();
                                $('#valida-precio').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
                                return false;
                        }
                        if($.trim($("#list_prod_term").val())==="") 
                        {
                                $("#list_prod_term").focus();
                                $('#valida-producto').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
                                return false;
                        }
                        var precio=$("#precio").val();
                        var descuento=$("#descuento").val();
                        var n_credito=$("#n_credito").val();		
                        var ila_nota_venta=$.trim($("#ila_pro").val());
                        var cajas=$.trim($("#cajas").val());
                        var id_producto=$('#list_prod_term option:selected').attr('id');
                        var cliente=$('#id_cliente_nacional option:selected').attr('id');
                        
                        var numero_nota_venta=$("#num_nota_venta").val();
                        var centro_venta=$('#centro_venta option:selected').attr('id');
                        //alert(centro_venta);
                        var referencia=$('#referencia option:selected').attr('id');
                        //var id_usuario = "<?php echo $id_Usuario; ?>";
			var factura=$("#factura").val();
                        var observacion_nc=$("#observacion_nc").val ();
                        
                        //aqui
                        /*if(numero_nota_venta=="") 
                        {
                                $("#num_nota_venta").focus();
                                $('#valida-nota_venta_Vacia').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-nota_venta_Vacia').fadeOut('slow');},1000); 
                                return false;
                        }
                        if(cliente=="") 
                        {
                                $("#num_nota_venta").focus();
                                $('#valida-c_nac').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
                                return false;
                        }*/
                        //Nueva
                        if(n_credito=="NUEVA"){
                            var id_usuario = "<?php echo $id_Usuario; ?>";
                            var stream="id_producto="+id_producto
                                    +"&"+"id_usuario="+id_usuario+"&"+"funcion="+3;
                            $.ajax({
                                    type: "POST",
                                    url: "comprobaciones/comprobar_producto_nota_venta.php",
                                    data:stream,
                                    success: function(data) {
                                        //alert("aqui");
                                            if (data.indexOf("Error")==-1)
                                            {
                                                
                                                    var id_Usuario = "<?php echo $id_Usuario; ?>";
                                                    //var id_Usuario=$("#id_Usuario").val();	
                                                    var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"id_Usuario="+id_Usuario
                                                    +"&"+"ila_nota_venta="+ila_nota_venta
                                                    +"&"+"numero_nota_venta="+numero_nota_venta
                                                    +"&"+"centro_venta="+centro_venta
                                                    +"&"+"referencia="+referencia
                                                    +"&"+"factura="+factura
                                                    +"&"+"observacion_nc="+observacion_nc
                                                    +"&"+"descuento="+descuento;
                                                    //alert(stream);
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "insert/ingresa_producto_nota_credito_temp.php",
                                                            data:stream,
                                                            success: function(data) {	
                                                                    var stream="id_Usuario="+id_Usuario+"&"+"funcion="+1;
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "select/trae_detalle_temporal_notacredito.php",
                                                                        data:stream,
                                                                        success: function(data) {
                                                                            //alert(data);
                                                                            $('#productos_finanzas').html("");
                                                                            $('#productos_finanzas').append(data);

                                                                            $("#list_prod_term_proforma").val ("");	
                                                                            $("#precio").val("");
                                                                            $("#cajas").val("");
                                                                            //$("#descuento").val (0);

                                                                            /*var num_prof=$('#num_prof').val();		
                                                                            $('#num_proforma').val(num_prof);		
                                                                            var numero_proforma=$('#num_proforma').val();*/							
                                                                            //sub TOTAL
                                                                            var stream="id_usuario="+id_usuario+"&"+"funcion="+3;
                                                                            $.ajax({
                                                                                type: "POST",
                                                                                url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                data:stream,
                                                                                success: function(data) {
                                                                                    ///Por aqui
                                                                                    var sub_tot =parseInt(data);
                                                                                    $('#subtotal_nota_venta').val(sub_tot);
                                                                                    
                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_subtotal').html(data);
                                                                                        }			
                                                                                    });
                                                                                    //ILA Total
                                                                                    var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            var ila_tot =parseInt(data);
                                                                                            $('#ila_nota_venta').val(ila_tot);
                                                                                            var dato=$('#ila_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_ila').html(data);
                                                                                                }			
                                                                                            });

                                                                                            var iva_tot=parseInt(sub_tot*19/100);
                                                                                            $('#iva_nota_venta').val(iva_tot);
                                                                                            var dato=$('#iva_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_iva').html(data);
                                                                                                }			
                                                                                            });
                                                                                            
                                                                                            var tot_tot=sub_tot+ila_tot+iva_tot;
                                                                                            $('#total_nota_venta').val(tot_tot);
                                                                                            var dato=$('#total_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                   // alert(data);
                                                                                                    $('#id_total').html(data);
                                                                                                }			
                                                                                            });
                                                                                        }			
                                                                                    });
                                                                                }			
                                                                            });
                                                                        }			
                                                                    });
                                                            }			
                                                    });
                                            }
                                            else
                                            {
                                                    $("#list_prod_term").focus ();
                                                    $('#valida-productos_repetidos').fadeIn('slow'); 
                                                    setTimeout(function(){$('#valida-productos_repetidos').fadeOut('slow');},1000); 
                                                    $("#list_prod_term").val ("");	
                                                    $("#precio").val("");
                                                    $("#cajas").val("");
                                                    return false;
                                            }				
                                    }			
                            });
                        }
                        
		}
	});
        
        
	$('#subtotal_nota').keypress(function (e) {
		if(e.which ==13)
		{
			var subtotal=$('#subtotal_nota').val();
			var ila=$('#ila_nota').val();	
			var iva=parseFloat(subtotal)*0.19;
			$('#iva_nota').val(iva);
			var total=(parseFloat(ila)+parseFloat(iva)+parseFloat(subtotal));
			$('#total_nota').val(total);
		}
	});	
	$('#ila_nota').keypress(function (e) {
		if(e.which ==13)
		{
			var subtotal=$('#subtotal_nota').val();
			var ila=$('#ila_nota').val();	
			var iva=parseFloat(subtotal)*0.19;
			$('#iva_nota').val(iva);
			var total=(parseFloat(ila)+parseFloat(iva)+parseFloat(subtotal));
			$('#total_nota').val(total);
		}
	});	
	/*var stream="funcion="+1;
	$.ajax({
		type: "POST",
		url: "insert/funciones_notas_credito.php",
		data:stream,
		success: function(data)	{
			$('#n_credito').val(data);		
		}
	});*/	
	$('#n_credito').keypress(function (e) {
		if(e.which ==13)
		{	
			if($.trim($("#centro_venta").val())==="") 
			{
				$("#centro_venta").focus();
				$('#valida-c_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
				//$("#factura").val('');
				return false;
			}
                        
                        if($.trim($("#n_credito").val())==="") 
			{
				$("#n_credito").val("NUEVA");
                                $('#n_credito').attr('disabled',true);
                                $('#centro_venta').attr('disabled',true);
                                $("#ingresa_nc").show();
                                //buscar temporal
                                var centro_venta=$('#centro_venta option:selected').attr('id');
                                var id_usuario = "<?php echo $id_Usuario; ?>";
                                var stream="centro_venta="+centro_venta
                                +"&"+"id_usuario="+id_usuario
                                +"&"+"funcion="+2;
                                //alert(stream);
                                $.ajax({
                                    type: "POST",
                                    url: "insert/ingreso_temp_nc.php",
                                    data:stream,
                                    cache: false,
                                    dataType: 'json',
                                    success: function(data) {
                                        //alert(data);
                                        for(i=0;i<data.length;i++)
					{
                                            //alert(data[i]);
                                            var obj=(data);
                                            //console.log(data);
                                            //if (obj=='[object Object]')
                                            //if (data=='0')
                                            //if(data.isEmptyObject({}))
                                            //if(console.log(data);)
                                            //{
                                                //alert('vacio');
                                                
                                                /*$("#n_credito").focus();
                                                $("#n_credito").val('');
                                                $('#valida-n_credito_mal').fadeIn('slow'); 
                                                setTimeout(function(){$('#valida-n_credito_mal').fadeOut('slow');},1000); 
                                                return false;*/
                                               // $('#n_credito').attr('disabled',false);
                                                //$('#centro_venta').attr('disabled',false);
                                                //var habi=1;
                                            //}else{
                                                
                                                $('#referencia').val(data[i].refer);
                                                
                                                $('#factura').val(data[i].factu);
                                                $('#num_nota_venta').val(data[i].nv);
                                                $('#observacion_nc').val(data[i].obs);
                                                $('#des_referencia').val(data[i].obsdes);
                                                $('#descuento_gen').val(data[i].mondes);
                                                
                                            
                                            
					}
                                        //if(habi==1){
                                            
                                        //}else{
                                        var des_referencia=$("#des_referencia").val ();
                                        var Monto=$("#descuento_gen").val ();
                                        var id_Usuario = "<?php echo $id_Usuario; ?>";
                                        var stream="id_Usuario="+id_Usuario+"&"+"funcion="+1;
                                        //alert(des_referencia);
                                         $.ajax({
                                            type: "POST",
                                            url: "select/trae_detalle_temporal_notacredito_descuento.php",
                                            data:stream,
                                            success: function(data)	{
                                                $('#productos_finanzas').html("");	
                                                $('#productos_finanzas').append(data);		
                                            }			
                                         });
                                         
                                         
                                            $('#referencia').attr('disabled',true);
                                            $('#factura').attr('disabled',true);
                                            var numero_nota_venta=$("#num_nota_venta").val ();
                                            var referencia=$('#referencia option:selected').attr('id');
                                            if(referencia==2){
                                                $("#insert_prod").show();
                                            }
                                                                            var stream="numero_nota_venta="+numero_nota_venta
                                                                                    +"&"+"centro_venta="+centro_venta
                                                                                    +"&"+"funcion="+6;
                                                                            $.ajax({
                                                                                    type: "POST",
                                                                                    url: "insert/ingresa_nota_venta.php",
                                                                                    data:stream,
                                                                                    cache: false,
                                                                                    dataType: 'json',
                                                                                    success: function(data)	{	
                                                                                            for(i=0;i<data.length;i++)
                                                                                            {
                                                                                                    if (data[i].valor==1)
                                                                                                    {
                                                                                                            alert ("Nota de Venta Vacia Ingrese Otra");
                                                                                                            $("#btn_imprimir").hide();
                                                                                                            $("#btn_nota_nueva").hide();									
                                                                                                            $(".limpiar").val ('');
                                                                                                            $(".limpiar_2").val (0);				
                                                                                                            $("#productos_finanzas").html ('');	
                                                                                                            location.href = "crear_nota_venta.php";
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                            //aqui voy
                                                                                                            $('#fecha_nota_venta').val(data[i].fecha_nota_venta);
                                                                                                            $('#id_cliente_nacional').val(data[i].cliente);
                                                                                                            var id_cliente= (data[i].id_cliente);
                                                                                                            //alert(id_cliente);//
                                                                                                            $('#centro_venta').val(data[i].centro_venta);
                                                                                                            $('#orden_compra').val(data[i].orden_compra);
                                                                                                            $('#fecha_despacho_nota_venta').val(data[i].fecha_despacho);
                                                                                                            //$('#condicion_venta').val(data[i].Condicion);
                                                                                                            var Condicion=(data[i].Condicion);
                                                                                                            $('#rut_cliente').val(data[i].rut);
                                                                                                            //$('#list_vendedores').val(data[i].vendedor);
                                                                                                            var vendedor=(data[i].vendedor);
                                                                                                            $('#obs_despacho').val(data[i].observacion);
                                                                                                            //sub TOTAL
                                                                            var stream="id_usuario="+id_usuario+"&"+"funcion="+3;
                                                                            $.ajax({
                                                                                type: "POST",
                                                                                url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                data:stream,
                                                                                success: function(data) {
                                                                                    ///Por aqui
                                                                                    var sub_tot =parseInt(data);
                                                                                    $('#subtotal_nota_venta').val(sub_tot);
                                                                                    
                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_subtotal').html(data);
                                                                                        }			
                                                                                    });
                                                                                    //ILA Total
                                                                                    var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            var ila_tot =parseInt(data);
                                                                                            $('#ila_nota_venta').val(ila_tot);
                                                                                            var dato=$('#ila_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_ila').html(data);
                                                                                                }			
                                                                                            });

                                                                                            var iva_tot=parseInt(sub_tot*19/100);
                                                                                            $('#iva_nota_venta').val(iva_tot);
                                                                                            var dato=$('#iva_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_iva').html(data);
                                                                                                }			
                                                                                            });
                                                                                            
                                                                                            var tot_tot=sub_tot+ila_tot+iva_tot;
                                                                                            $('#total_nota_venta').val(tot_tot);
                                                                                            var dato=$('#total_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                   // alert(data);
                                                                                                    $('#id_total').html(data);
                                                                                                }			
                                                                                            });
                                                                                        }			
                                                                                    });
                                                                                }			
                                                                            });
                                                                                                            
                                                                                                            

                                                                                                            $('#version').val(data[i].version);
                                                                                                            var suc=(data[i].suc);
                                                                                                            //alert(suc);
                                                                                                            var stream="suc="+suc;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_sucursal_cli_nac2.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#suc').html();
                                                                                                                            $('#suc').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            //
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_pago_cliente_nac.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#pago').html();
                                                                                                                            $('#pago').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_vendedor_cli_na.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#vend').html();
                                                                                                                            $('#vend').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_canal_cliente_nac.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#canal').html();
                                                                                                                            $('#canal').html(data);	
                                                                                                                            var id_canal=$('#canal_cli option:selected').attr('id');
                                                                                                                             var stream="id_canal="+id_canal;
                                                                                                                                $.ajax({
                                                                                                                                                type: "POST",
                                                                                                                                                url: "select/trae_descuento_canal_cliente_nac.php",
                                                                                                                                                data:stream,
                                                                                                                                                success: function(data){
                                                                                                                                                        //alert (data);
                                                                                                                                                        $("#descuento").val (data);	
                                                                                                                                                }			
                                                                                                                                        });

                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_lista_cliente_nac_nota.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#lista_precio').html();
                                                                                                                            $('#lista_precio').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                           var centro_venta=$('#centro_venta option:selected').attr('id');
                                                                                                            //alert(centro_venta);
                                                                                                            if(referencia==1 || referencia==2){
                                                                                                            //if(referencia==1 || referencia==2 || referencia==3){    
                                                                                                                //id_usuario
                                                                                                                
                                                                                                                var stream="id_Usuario="+id_Usuario+"&"+"funcion="+1;
                                                                                                                    /*var stream="numero_nota_venta="+numero_nota_venta
                                                                                                                    +"&"+"centro_venta="+centro_venta
                                                                                                                    +"&"+"id_usuario="+id_usuario
                                                                                                                    +"&"+"funcion="+1211;*/
                                                                                                                    //if(des_referencia<>""){
                                                                                                                     //   alert(des_referencia);
                                                                                                                    //}
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "select/trae_detalle_temporal_notacredito.php",
                                                                                                                            //url: "insert/ingresa_nota_venta.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data)	{
                                                                                                                                //alert(data);
                                                                                                                                    $('#productos_finanzas').html("");	
                                                                                                                                    $('#productos_finanzas').append(data);		
                                                                                                                            }			
                                                                                                                    });
                                                                                                                    /*var stream="numero_nota_venta="+numero_nota_venta
                                                                                                                    +"&"+"centro_venta="+centro_venta
                                                                                                                    +"&"+"id_usuario="+id_usuario
                                                                                                                    +"&"+"funcion="+1211;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/ingresa_nota_venta.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data)	{
                                                                                                                                //alert(data);
                                                                                                                                    $('#productos_finanzas').html("");	
                                                                                                                                    $('#productos_finanzas').append(data);		
                                                                                                                            }			
                                                                                                                    });*/
                                                                                                                    //$("#btn_imprimir").show();
                                                                                                                    //$("#prod_nota_modificar").show();												
                                                                                                                    $("#prod_nota_nuevos").hide();	
                                                                                                                    //$("#btn_nota_modificada").show();	
                                                                                                                    $("#btn_nota_nueva").hide();
                                                                                                                    
                                                                                                                    //Regsitra en Temporal
                                                                                                                    var stream="id_cliente="+id_cliente;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/trae_lista_cliente_nac_nota.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data) {
                                                                                                                                    $('#lista_precio').html();
                                                                                                                                    $('#lista_precio').html(data);			 
                                                                                                                            }	 			
                                                                                                                    });
                                                                                                                    $("#des_referencia").focus();
                                                                                                            }
                                                                                                            if(referencia==3){
                                                                                                                $("#insert_desc").show();
                                                                                                                $("#ila_nota_venta1").show();
                                                                                                            }
                                                                                                    }						 
                                                                                            }								
                                                                                    }			
                                                                            });
                                        //}
                                        
                                    }	 			
                                });
                                
                                
			}else{
                            var nota_credito=$('#n_credito').val();
                             var centro_venta=$('#centro_venta option:selected').attr('id');
                             
                            var stream="nota_credito="+nota_credito
                                    +"&"+"centro_venta="+centro_venta
                                    +"&"+"funcion="+13;
                            $.ajax({
                                    type: "POST",
                                    url: "insert/funciones_notas_credito.php",
                                    data:stream,
                                    success: function(data){
                                        //alert(data);
                                        var id_nc=(data);
                                        var stream="id_nc="+id_nc+"&"+"funcion="+131;
                                        $.ajax({
                                            type: "POST",
                                            url: "insert/funciones_notas_credito.php",
                                            data:stream,
                                            cache: false,
                                            dataType: 'json',
                                            success: function(data)	{	
                                                //alert(data);
                                                for(i=0;i<data.length;i++)
                                                {
                                                    $('#factura').val(data[i].factura);
                                                    $('#referencia').val(data[i].refer);
                                                    //alert($('#referencia').val());
                                                    $('#observacion_nc').val(data[i].obs);
                                                    //alert(data[i].refer);
                                                    $('#subtotal_nota_venta').val(data[i].sub);
                                                    $('#ila_nota_venta').val(data[i].ila);
                                                    $('#iva_nota_venta').val(data[i].iva);
                                                    $('#total_nota_venta').val(data[i].tot);
                                                                                                                    
                                                }
                                                var referencia=$('#referencia option:selected').attr('id');
                                                //alert(referencia);
                                                var factura=$("#factura").val();
                                                var stream="factura="+factura
                                                                +"&"+"centro_venta="+centro_venta
                                                                +"&"+"funcion="+15;
                                                    $.ajax({
								type: "POST",
								url: "select/funciones_facturacion.php",
								data:stream,
								cache: false,
								dataType: 'json',
								success: function(data){
                                                                    //alert(data);
                                                                    //aqui voy 222
									for(i=0;i<data.length;i++)
									{
										$('#num_nota_venta').val(data[i].numero_nota_venta);
                                                                                
									}
                                                                        //alert($('#num_nota_venta').val());
                                                                        
                                                                         $("#num_nota_venta").attr('disabled',true);
                                                                        
                                                                            var numero_nota_venta=$("#num_nota_venta").val ();
                                                                            var stream="numero_nota_venta="+numero_nota_venta
                                                                                    +"&"+"centro_venta="+centro_venta
                                                                                    +"&"+"funcion="+6;
                                                                            $.ajax({
                                                                                    type: "POST",
                                                                                    url: "insert/ingresa_nota_venta.php",
                                                                                    data:stream,
                                                                                    cache: false,
                                                                                    dataType: 'json',
                                                                                    success: function(data)	{	
                                                                                            for(i=0;i<data.length;i++)
                                                                                            {
                                                                                                    if (data[i].valor==1)
                                                                                                    {
                                                                                                            alert ("Nota de Venta Vacia Ingrese Otra");
                                                                                                            $("#btn_imprimir").hide();
                                                                                                            $("#btn_nota_nueva").hide();									
                                                                                                            $(".limpiar").val ('');
                                                                                                            $(".limpiar_2").val (0);				
                                                                                                            $("#productos_finanzas").html ('');	
                                                                                                            //location.href = "crear_nota_venta.php";
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                            //aqui voy
                                                                                                            $('#fecha_nota_venta').val(data[i].fecha_nota_venta);
                                                                                                            $('#id_cliente_nacional').val(data[i].cliente);
                                                                                                            var id_cliente= (data[i].id_cliente);
                                                                                                            //alert(id_cliente);//
                                                                                                            $('#centro_venta').val(data[i].centro_venta);
                                                                                                            $('#orden_compra').val(data[i].orden_compra);
                                                                                                            $('#fecha_despacho_nota_venta').val(data[i].fecha_despacho);
                                                                                                            //$('#condicion_venta').val(data[i].Condicion);
                                                                                                            var Condicion=(data[i].Condicion);
                                                                                                            $('#rut_cliente').val(data[i].rut);
                                                                                                            //$('#list_vendedores').val(data[i].vendedor);
                                                                                                            var vendedor=(data[i].vendedor);
                                                                                                            $('#obs_despacho').val(data[i].observacion);
                                                                                                            
                                                                                                            ///Valida su referencia
                                                                                                            //alert(referencia);
                                                                                                            if(referencia==1 || referencia==2 || referencia==3){
                                                                                                                //$('#subtotal_nota_venta').val(data[i].sub_total);
                                                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_subtotal').html(data);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    //$('#iva_nota_venta').val(data[i].iva);
                                                                                                                    var dato=$('#iva_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_iva').html(data);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    //$('#total_nota_venta').val(data[i].total);
                                                                                                                    var dato=$('#total_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_total').html(data);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    //$('#ila_nota_venta').val(data[i].ila);
                                                                                                                    var dato=$('#ila_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_ila').html(data);
                                                                                                                        }			
                                                                                                                    });
                                                                                                            }else{
                                                                                                                $('#subtotal_nota_venta').val(0);
                                                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_subtotal').html(0);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#iva_nota_venta').val(0);
                                                                                                                    var dato=$('#iva_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_iva').html(0);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#total_nota_venta').val(0);
                                                                                                                    var dato=$('#total_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_total').html(0);
                                                                                                                        }			
                                                                                                                    });

                                                                                                                    $('#ila_nota_venta').val(0);
                                                                                                                    var dato=$('#ila_nota_venta').val();
                                                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {
                                                                                                                            //alert(data);
                                                                                                                            $('#id_ila').html(0);
                                                                                                                        }			
                                                                                                                    });
                                                                                                                    
                                                                                                            }
                                                                                                            

                                                                                                            $('#version').val(data[i].version);
                                                                                                            var suc=(data[i].suc);
                                                                                                            //alert(suc);
                                                                                                            var stream="suc="+suc;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_sucursal_cli_nac2.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#suc').html();
                                                                                                                            $('#suc').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            //
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_pago_cliente_nac.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#pago').html();
                                                                                                                            $('#pago').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_vendedor_cli_na.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#vend').html();
                                                                                                                            $('#vend').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_canal_cliente_nac.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#canal').html();
                                                                                                                            $('#canal').html(data);	
                                                                                                                            var id_canal=$('#canal_cli option:selected').attr('id');
                                                                                                                             var stream="id_canal="+id_canal;
                                                                                                                                $.ajax({
                                                                                                                                                type: "POST",
                                                                                                                                                url: "select/trae_descuento_canal_cliente_nac.php",
                                                                                                                                                data:stream,
                                                                                                                                                success: function(data){
                                                                                                                                                        //alert (data);
                                                                                                                                                        $("#descuento").val (data);	
                                                                                                                                                }			
                                                                                                                                        });

                                                                                                                    }	 			
                                                                                                            });
                                                                                                            var stream="id_cliente="+id_cliente;
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "select/trae_lista_cliente_nac_nota.php",
                                                                                                                    data:stream,
                                                                                                                    success: function(data) {
                                                                                                                            $('#lista_precio').html();
                                                                                                                            $('#lista_precio').html(data);			 
                                                                                                                    }	 			
                                                                                                            });
                                                                                                           var centro_venta=$('#centro_venta option:selected').attr('id');
                                                                                                            if(referencia==3){
                                                                                                                var stream="id_nc="+id_nc
                                                                                                                    +"&"+"funcion="+1211;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/funciones_notas_credito.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data)	{	
                                                                                                                                    $('#productos_finanzas').html("");	
                                                                                                                                    $('#productos_finanzas').append(data);		
                                                                                                                            }			
                                                                                                                    });
                                                                                                            }else{
                                                                                                                var stream="id_nc="+id_nc
                                                                                                                    +"&"+"funcion="+121;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/funciones_notas_credito.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data)	{	
                                                                                                                                    $('#productos_finanzas').html("");	
                                                                                                                                    $('#productos_finanzas').append(data);		
                                                                                                                            }			
                                                                                                                    });
                                                                                                            }
                                                                                                                
                                                                                                                    //$("#btn_imprimir").show();
                                                                                                                    //$("#prod_nota_modificar").show();												
                                                                                                                    $("#prod_nota_nuevos").hide();	
                                                                                                                    //$("#btn_nota_modificada").show();	
                                                                                                                    $("#btn_nota_nueva").hide();
                                                                                                                    
                                                                                                                    //Regsitra en Temporal
                                                                                                                    var stream="id_cliente="+id_cliente;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/trae_lista_cliente_nac_nota.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data) {
                                                                                                                                    $('#lista_precio').html();
                                                                                                                                    $('#lista_precio').html(data);			 
                                                                                                                            }	 			
                                                                                                                    });
                                                                                                                    $("#des_referencia").focus();
                                                                                                            //}
                                                                                                            
                                                                                                            
                                                                                                    }						 
                                                                                            }								
                                                                                    }			
                                                                            });
                                                                         
                                                                }
                                                    });
                                                    
                                            }
                                        });	
                                            /*
                                            if (data==1)
                                            {
                                                    var id_Usuario=$('#id_Usuario').val();			
                                                    var stream="id_Usuario="+id_Usuario+"&"+"funcion="+2;
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "insert/funciones_notas_credito.php",
                                                            data:stream,
                                                            success: function(data)	{
                                                                    $('#n_credito').val(data);
                                                                    $('#n_credito').attr('disabled',true);
                                                            }
                                                    });	
                                            }
                                            else if (data==2)
                                            {
                                                    var stream="nota_credito="+nota_credito+"&"+"funcion="+14;
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "insert/funciones_notas_credito.php",
                                                            data:stream,
                                                            success: function(data)	{
                                                                    if (data==1)
                                                                    {
                                                                            $("#n_credito").focus();
                                                                            $("#n_credito").val('');
                                                                            $('#valida-n_credito_mal').fadeIn('slow'); 
                                                                            setTimeout(function(){$('#valida-n_credito_mal').fadeOut('slow');},1000); 
                                                                            return false;
                                                                    }
                                                                    else if (data==2)
                                                                    {
                                                                            $("#aceptar_nota_cred").hide();
                                                                            var stream="nota_credito="+nota_credito+"&"+"funcion="+15;
                                                                            $.ajax({
                                                                                    type: "POST",
                                                                                    url: "insert/funciones_notas_credito.php",
                                                                                    data:stream,
                                                                                    cache: false,
                                                                                    dataType: 'json',
                                                                                    success: function(data)	{
                                                                                            for(i=0;i<data.length;i++)
                                                                                            {
                                                                                                    if (data[i].valor==1)
                                                                                                    {
                                                                                                            alert ("Nota de Credito Vacia Ingrese Otra");
                                                                                                            location.href = "nota_credito.php";
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                            $('#imprimir').show();
                                                                                                            $('#centro_venta').val(data[i].centro_venta);
                                                                                                            $('#fecha_nota_venta').val(data[i].fecha_nota_venta);
                                                                                                            $('#id_cliente_nacional').val(data[i].nombre_cliente);
                                                                                                            $('#factura_nota_credito').val(data[i].numero_factura);
                                                                                                            $('#obs_nota_credito').val(data[i].observacion_nota_credito);		
                                                                                                            $('#subtotal_nota').val(data[i].subtotal);		
                                                                                                            $('#ila_nota').val(data[i].total_ila);		
                                                                                                            $('#iva_nota').val(data[i].total_iva);		
                                                                                                            $('#total_nota').val(data[i].total);													
                                                                                                            var factura=$('#factura_nota_credito').val();
                                                                                                            if (factura!=0)
                                                                                                            {
                                                                                                                    var stream="factura="+factura+"&"+"funcion="+10;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/funciones_notas_credito.php",
                                                                                                                            data:stream,
                                                                                                                            success: function(data)	{
                                                                                                                                    $('#productos_finanzas_2').html("");	
                                                                                                                                    $('#productos_finanzas_2').append(data);		
                                                                                                                            }
                                                                                                                    });															
                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                                    $('#productos_finanzas_2').html("");	
                                                                                                                    $('#productos_finanzas_2').append("No Tiene Productos Esta Nota de Credito");	
                                                                                                            }
                                                                                                    }	
                                                                                            }
                                                                                    }
                                                                            });	
                                                                    }
                                                            }
                                                    });	
                                            }*/
                                    }
                            });
                        }
                        				
		}
	});	
        
        //Por porcentaje
        /*   <!--input type="text" id="des_referencia" placeholder="Ingrese Descripcion de Descuento"/-->
                                                                                            <textarea id="des_referencia" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Descuento (%)</label>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" id="descuento" style="text-align: right" value='' onkeypress="ValidaSoloNumeros()" maxlength="6" size="6" class="limpiar" placeholder="Descuento" >
         </td>*/
         $('#ila_nota_venta').keypress(function (e) {
		if(e.which ==13)
		{
			
                        if($.trim($("#ila_nota_venta").val())==="") 
                        {
                                $("#ila_nota_venta").focus();
                                $('#valida-ila_nota_venta').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-ila_nota_venta').fadeOut('slow');},1000); 
                                return false;
                        }
                        
                        var ila_nota_venta=$("#ila_nota_venta").val();
                        ila_nota_venta=ila_nota_venta*0.1;
                        $("#ila_nota_venta").val(ila_nota_venta);
                        
                        var ila_tot =parseInt(ila_nota_venta);
                                                                                            $('#ila_nota_venta').val(ila_tot);
                                                                                            var dato=$('#ila_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_ila').html(data);
                                                                                                }			
                                                                                            });
                        
                        var subtotal_nota_venta=$("#subtotal_nota_venta").val();
                        
                        var iva_nota_venta=$("#iva_nota_venta").val();
                        var tot_tot=parseInt(subtotal_nota_venta)+parseInt(iva_nota_venta)+parseInt(ila_nota_venta);
                        $('#total_nota_venta').val(tot_tot);
                        
                        
                                                                                            
                                                                                            var dato=$('#total_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                   // alert(data);
                                                                                                    $('#id_total').html(data);
                                                                                                }			
                                                                                            });
                                                                                            $("#ila_nota_venta1").hide();
                        /*<tr>                                                                                                        
                                                                                                        <td >
                                                                                                                <label>Sub Total</label>
                                                                                                                <input type="hidden" id="subtotal_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                        </td>
                                                                                                        <td style="text-align: right" id='id_subtotal'>                                                                                                                
                                                                                                                
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                         
                                                                                                                <td>
                                                                                                                        <label>Total IABA</label>
                                                                                                                        
                                                                                                                        <div class="fright" style="display:none" id='ila_nota_venta1'> 
                                                                                                                            <input type="text" id="ila_nota_venta" style="text-align: right" class='limpiar_2'  value="0" />
                                                                                                                        </div>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_ila'>
                                                                                                                        
                                                                                                                </td>
                                                                                                         
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                                <td>
                                                                                                                        <label>Total IVA</label>
                                                                                                                        <input type="hidden" id="iva_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_iva'>
                                                                                                                        
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                    <tr>
                                                                                                                <td>
                                                                                                                        <label>Total Factura</label>
                                                                                                                        <input type="hidden" id="total_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_total'>
                                                                                                                        
                                                                                                                </td>
                                                                                                    </tr>*/
                        /*
                        //Nueva
                        if(n_credito=="NUEVA"){
                            var id_usuario = "<?php echo $id_Usuario; ?>";
                            var stream="id_producto="+id_producto
                                    +"&"+"id_usuario="+id_usuario+"&"+"funcion="+3;
                            $.ajax({
                                    type: "POST",
                                    url: "comprobaciones/comprobar_producto_nota_venta.php",
                                    data:stream,
                                    success: function(data) {
                                        //alert("aqui");
                                            if (data.indexOf("Error")==-1)
                                            {
                                                
                                                    var id_Usuario = "<?php echo $id_Usuario; ?>";
                                                    
                                                    var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"id_Usuario="+id_Usuario
                                                    +"&"+"ila_nota_venta="+ila_nota_venta
                                                    +"&"+"numero_nota_venta="+numero_nota_venta
                                                    +"&"+"centro_venta="+centro_venta
                                                    +"&"+"referencia="+referencia
                                                    +"&"+"factura="+factura
                                                    +"&"+"descuento="+descuento
                                                    +"&"+"observacion_nc="+observacion_nc
                                                    +"&"+"monto="+monto
                                                    +"&"+"des_referencia="+des_referencia;
                                                    alert(stream);
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "insert/ingresa_producto_nota_credito_temp.php",
                                                            data:stream,
                                                            success: function(data) {	
                                                                    var stream="id_Usuario="+id_Usuario+"&"+"funcion="+1;
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "select/trae_detalle_temporal_notacredito.php",
                                                                        data:stream,
                                                                        success: function(data) {
                                                                            //alert(data);
                                                                            $('#productos_finanzas').html("");
                                                                            $('#productos_finanzas').append(data);

                                                                            $("#list_prod_term_proforma").val ("");	
                                                                            $("#precio").val("");
                                                                            $("#cajas").val("");
                                                                            							
                                                                            //sub TOTAL
                                                                            var stream="id_usuario="+id_usuario+"&"+"funcion="+3;
                                                                            $.ajax({
                                                                                type: "POST",
                                                                                url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                data:stream,
                                                                                success: function(data) {
                                                                                    ///Por aqui
                                                                                    var sub_tot =parseInt(data);
                                                                                    $('#subtotal_nota_venta').val(sub_tot);
                                                                                    
                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_subtotal').html(data);
                                                                                        }			
                                                                                    });
                                                                                    //ILA Total
                                                                                    var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            var ila_tot =parseInt(data);
                                                                                            $('#ila_nota_venta').val(ila_tot);
                                                                                            var dato=$('#ila_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_ila').html(data);
                                                                                                }			
                                                                                            });

                                                                                            var iva_tot=parseInt(sub_tot*19/100);
                                                                                            $('#iva_nota_venta').val(iva_tot);
                                                                                            var dato=$('#iva_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_iva').html(data);
                                                                                                }			
                                                                                            });
                                                                                            
                                                                                            var tot_tot=sub_tot+ila_tot+iva_tot;
                                                                                            $('#total_nota_venta').val(tot_tot);
                                                                                            var dato=$('#total_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                   // alert(data);
                                                                                                    $('#id_total').html(data);
                                                                                                }			
                                                                                            });
                                                                                        }			
                                                                                    });
                                                                                }			
                                                                            });
                                                                        }			
                                                                    });
                                                            }			
                                                    });
                                            }
                                            else
                                            {
                                                    $("#list_prod_term").focus ();
                                                    $('#valida-productos_repetidos').fadeIn('slow'); 
                                                    setTimeout(function(){$('#valida-productos_repetidos').fadeOut('slow');},1000); 
                                                    $("#list_prod_term").val ("");	
                                                    $("#precio").val("");
                                                    $("#cajas").val("");
                                                    return false;
                                            }				
                                    }			
                            });
                        }*/
                        
		}
	});                                                                           
        $('#descuento_gen').keypress(function (e) {
		if(e.which ==13)
		{
			
                        if($.trim($("#des_referencia").val())==="") 
                        {
                                $("#des_referencia").focus();
                                $('#valida-des_referencia').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-des_referencia').fadeOut('slow');},1000); 
                                return false;
                        }
                        if($.trim($("#descuento_gen").val())==="0") 
                        {
                                $("#descuento_gen").focus();
                                $('#valida-descuento_gen').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-descuento_gen').fadeOut('slow');},1000); 
                                return false;
                        }
                        if($.trim($("#descuento_gen").val())==="") 
                        {
                                $("#descuento").focus();
                                $('#valida-descuento').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-descuento').fadeOut('slow');},1000); 
                                return false;
                        }
                        //calcula descuento general
                        //subtotal_nota_venta
                        var monto=$("#descuento_gen").val();
                        var des_referencia=$("#des_referencia").val();
                        
                        var precio=$("#des_referencia").val();
                        var descuento=$("#descuento_gen").val();
                        var n_credito=$("#n_credito").val();		
                        var ila_nota_venta=$.trim($("#ila_pro").val());
                        var cajas=$.trim($("#cajas").val());
                        var id_producto=$('#list_prod_term option:selected').attr('id');
                        var cliente=$('#id_cliente_nacional option:selected').attr('id');
                        
                        var numero_nota_venta=$("#num_nota_venta").val();
                        var centro_venta=$('#centro_venta option:selected').attr('id');
                        //alert(centro_venta);
                        var referencia=$('#referencia option:selected').attr('id');
                        //var id_usuario = "<?php echo $id_Usuario; ?>";
			var factura=$("#factura").val();
                        var observacion_nc=$("#observacion_nc").val ();
                       if(referencia==3){
                                                                                                                $("#insert_desc").show();
                                                                                                                $("#ila_nota_venta1").show();
                                                                                                            } 
                        //aqui
                        /*if(numero_nota_venta=="") 
                        {
                                $("#num_nota_venta").focus();
                                $('#valida-nota_venta_Vacia').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-nota_venta_Vacia').fadeOut('slow');},1000); 
                                return false;
                        }
                        if(cliente=="") 
                        {
                                $("#num_nota_venta").focus();
                                $('#valida-c_nac').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
                                return false;
                        }*/
                        //Nueva
                        if(n_credito=="NUEVA"){
                            var id_usuario = "<?php echo $id_Usuario; ?>";
                            var stream="id_producto="+id_producto
                                    +"&"+"id_usuario="+id_usuario+"&"+"funcion="+3;
                            $.ajax({
                                    type: "POST",
                                    url: "comprobaciones/comprobar_producto_nota_venta.php",
                                    data:stream,
                                    success: function(data) {
                                        //alert("aqui");
                                            if (data.indexOf("Error")==-1)
                                            {
                                                /*var =$("#descuento_gen").val();
                        var =$("#des_referencia").val();*/
                                                    var id_Usuario = "<?php echo $id_Usuario; ?>";
                                                    //var id_Usuario=$("#id_Usuario").val();	
                                                    var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"id_Usuario="+id_Usuario
                                                    +"&"+"ila_nota_venta="+ila_nota_venta
                                                    +"&"+"numero_nota_venta="+numero_nota_venta
                                                    +"&"+"centro_venta="+centro_venta
                                                    +"&"+"referencia="+referencia
                                                    +"&"+"factura="+factura
                                                    +"&"+"descuento="+descuento
                                                    +"&"+"observacion_nc="+observacion_nc
                                                    +"&"+"monto="+monto
                                                    +"&"+"des_referencia="+des_referencia;
                                                    //alert(stream);
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "insert/ingresa_producto_nota_credito_temp.php",
                                                            data:stream,
                                                            success: function(data) {	
                                                                    var stream="id_Usuario="+id_Usuario+"&"+"funcion="+1;
                                                                        $.ajax({
                                                                        type: "POST",
                                                                        url: "select/trae_detalle_temporal_notacredito_descuento.php",
                                                                        data:stream,
                                                                        success: function(data)	{
                                                                            $('#productos_finanzas').html("");	
                                                                            $('#productos_finanzas').append(data);		
                                                                        }			
                                                                     });
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "select/trae_detalle_temporal_notacredito.php",
                                                                        data:stream,
                                                                        success: function(data) {
                                                                            //alert(data);
                                                                            $('#productos_finanzas').html("");
                                                                            $('#productos_finanzas').append(data);

                                                                            $("#list_prod_term_proforma").val ("");	
                                                                            $("#precio").val("");
                                                                            $("#cajas").val("");
                                                                            //$("#descuento").val (0);

                                                                            /*var num_prof=$('#num_prof').val();		
                                                                            $('#num_proforma').val(num_prof);		
                                                                            var numero_proforma=$('#num_proforma').val();*/							
                                                                            //sub TOTAL
                                                                            var stream="id_usuario="+id_usuario+"&"+"funcion="+3;
                                                                            $.ajax({
                                                                                type: "POST",
                                                                                url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                data:stream,
                                                                                success: function(data) {
                                                                                    ///Por aqui
                                                                                    var sub_tot =parseInt(data);
                                                                                    $('#subtotal_nota_venta').val(sub_tot);
                                                                                    
                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_subtotal').html(data);
                                                                                        }			
                                                                                    });
                                                                                    //ILA Total
                                                                                    var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            var ila_tot =parseInt(data);
                                                                                            $('#ila_nota_venta').val(ila_tot);
                                                                                            var dato=$('#ila_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_ila').html(data);
                                                                                                }			
                                                                                            });

                                                                                            var iva_tot=parseInt(sub_tot*19/100);
                                                                                            $('#iva_nota_venta').val(iva_tot);
                                                                                            var dato=$('#iva_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_iva').html(data);
                                                                                                }			
                                                                                            });
                                                                                            
                                                                                            var tot_tot=sub_tot+ila_tot+iva_tot;
                                                                                            $('#total_nota_venta').val(tot_tot);
                                                                                            var dato=$('#total_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                   // alert(data);
                                                                                                    $('#id_total').html(data);
                                                                                                }			
                                                                                            });
                                                                                        }			
                                                                                    });
                                                                                }			
                                                                            });
                                                                        }			
                                                                    });
                                                            }			
                                                    });
                                            }
                                            else
                                            {
                                                    $("#list_prod_term").focus ();
                                                    $('#valida-productos_repetidos').fadeIn('slow'); 
                                                    setTimeout(function(){$('#valida-productos_repetidos').fadeOut('slow');},1000); 
                                                    $("#list_prod_term").val ("");	
                                                    $("#precio").val("");
                                                    $("#cajas").val("");
                                                    return false;
                                            }				
                                    }			
                            });
                        }
                        
		}
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
						$('#list_prod_term').html("");	
						$('#list_prod_term').append(data);
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
						$('#list_prod_term').html("");	
						$('#list_prod_term').append(data);
					}			
				});
			}
		}
	});
	 $("#popdetallestk").dialog({
		autoOpen:false,
		modal:true,
		width:900,
		buttons:{
			"Cerrar":function(){
				$(this).dialog("close");
				$("input:checkbox").prop('checked', false);
			}
		}			
	});
});
$.fn.imprimir_nota_credito=function(){
	var numero = $("#n_credito").val ();
	window.open('select/imprimir_datos_facturas.php?funcion='+5+'&numero='+numero);
}
//funcion que ingresa la nota de venta a la tabla
$.fn.ingresa_nota_credito=function(){
        var nota_credito=$('#n_credito').val();
        
        var subtotal=$('#subtotal_nota_venta').val();
        var ila=$('#ila_nota_venta').val();
        var iva=$('#iva_nota_venta').val();
        var total=$('#total_nota_venta').val();
        var observacion_nc=$('#observacion_nc').val();
        var centro_venta=$('#centro_venta option:selected').attr('id');
        if(nota_credito=="NUEVA"){
            //alert('aqui');
            $('#perm_ingreso').val(1);
            $('#n_credito').attr('disabled',false);
            alert("Ingrese Nota de Credito, para Grabar");
            $('#n_credito').val('');
            $('#n_credito').focus();
        }else{
             var perm_ingreso=$('#perm_ingreso').val();
            if(perm_ingreso=='1'){
                //alert("Puede Grabar ahora Grabar");
                //alert(nota_credito+centro_venta);
                var stream="nota_credito="+nota_credito+"&"+"centro_venta="+centro_venta+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_temp_nc.php",
			data:stream,
			success: function(data)	{
				//alert (data);
                                if(data==0){
                                    
                                   var id_usuario = "<?php echo $id_Usuario; ?>";
                                   var stream="centro_venta="+centro_venta
                                    +"&"+"nota_credito="+nota_credito
                                    +"&"+"observacion_nc="+observacion_nc
                                    +"&"+"id_usuario="+id_usuario
                                    +"&"+"subtotal="+subtotal
                                    +"&"+"ila="+ila
                                    +"&"+"iva="+iva
                                    +"&"+"total="+total
                                    +"&"+"funcion="+4;
                                    $.ajax({
                                            type: "POST",
                                            url: "insert/ingreso_temp_nc.php",
                                            data:stream,
                                            success: function(data)	{
                                                    alert (data);
                                                    location.href = "nota_credito.php";
                                            }
                                    });
                                    
                                }else{
                                    //alert("NC ya Existe");
                                    $("#n_credito").focus();
                                    $('#valida-n_credito_mal').fadeIn('slow'); 
                                    setTimeout(function(){$('#valida-n_credito_mal').fadeOut('slow');},1000); 
                                    $("#n_credito").val('');
                                    return false;
                                }
				//location.href = "nota_credito.php";
			}
		});
            }
        }

}
$.fn.ingresa_producto_nota_credito=function(id_datalle_factura,cantidad_bd){
	var cantidad=$(".cantidad"+id_datalle_factura).val();
	if ($('#n_credito').is(":not(:disabled)"))
	{
		$("#n_credito").focus ();
		$('#valida-n_credito_crear').fadeIn('slow'); 
		setTimeout(function(){$('#valida-n_credito_crear').fadeOut('slow');},1000); 
		return false;			
	}
	if (cantidad>cantidad_bd)
	{
		$(".cantidad"+id_datalle_factura).focus();
		$(".cantidad"+id_datalle_factura).val('');
		$('#valida-cantidad_mayor'+id_datalle_factura).fadeIn('slow'); 
		setTimeout(function(){$('#valida-cantidad_mayor'+id_datalle_factura).fadeOut('slow');},1000); 
		return false;
	}
	if($.trim($(".cantidad"+id_datalle_factura).val())==="") 
	{
		$(".cantidad"+id_datalle_factura).focus();
		$(".cantidad"+id_datalle_factura).val('');
		$('#valida-cantidad_vacia'+id_datalle_factura).fadeIn('slow'); 
		setTimeout(function(){$('#valida-cantidad_vacia'+id_datalle_factura).fadeOut('slow');},1000); 
		return false;
	}
	if($.trim($(".cantidad"+id_datalle_factura).val())==="0") 
	{
		$(".cantidad"+id_datalle_factura).focus();
		$(".cantidad"+id_datalle_factura).val('');
		$('#valida-cantidad_cero'+id_datalle_factura).fadeIn('slow'); 
		setTimeout(function(){$('#valida-cantidad_cero'+id_datalle_factura).fadeOut('slow');},1000); 
		return false;
	}
	var stream="cantidad="+cantidad+"&"+"id_datalle_factura="+id_datalle_factura+"&"+"funcion="+8;
	$.ajax({
		type: "POST",
		url: "insert/funciones_notas_credito.php",
		data:stream,
		success: function(data)	{
			if (data==1)
			{
	 			$('#valida-prod_ext'+id_datalle_factura).fadeIn('slow'); 
				setTimeout(function(){$('#valida-prod_ext'+id_datalle_factura).fadeOut('slow');},1000); 
				return false;
			}
			else
			{
				var factura_nota_credito=$("#factura_nota_credito").val();
				var stream="factura="+factura_nota_credito+"&"+"funcion="+10;
				$.ajax({
					type: "POST",
					url: "insert/funciones_notas_credito.php",
					data:stream,
					success: function(data)	{
						$("#productos_finanzas").find("#"+id_datalle_factura).remove();
						$('#productos_finanzas_2').html("");	
						$('#productos_finanzas_2').append(data);	
						$("#popdetallestk").dialog("close");
						var stream="factura="+factura_nota_credito+"&"+"funcion="+11;
						$.ajax({
							type: "POST",
							url: "insert/funciones_notas_credito.php",
							data:stream,
							success: function(data)	{
								$("#subtotal_nota").val(data);
								var subtotal=$("#subtotal_nota").val();
								var iva=(subtotal*19)/100;
								$("#iva_nota").val(iva);
								var ila_factura=$("#ila_nota").val();
								var stream="id_datalle_factura="+id_datalle_factura+"&"+"ila_factura="+ila_factura+"&"+"funcion="+12;
								$.ajax({
									type: "POST",
									url: "insert/funciones_notas_credito.php",
									data:stream,
									success: function(data)	{
										$("#ila_nota").val(data);
										var ila_factura=$("#ila_nota").val();
										$("#total_nota").val(parseInt(ila_factura)+parseInt(subtotal)+parseInt(iva));
			 						}
								});									
							}
						});	
					}
				});	
			}
		}
	});
 }
 $.fn.elimina_prod_detalle_temporal_nota_credito=function(id_detalle_nc,id_usuario){
		var n_credito=	$('#n_credito').val();
                //alert(n_credito);
                var id_Usuario=id_usuario;
                if(n_credito=="NUEVA"){
                    var stream="id_detalle_nc="+id_detalle_nc
                            +"&"+"funcion="+3;
                    $.ajax({
			type: "POST",
			url: "delete/borra_productos_nota_venta_mal_ingresados.php",
			data:stream,
			success: function(data) {
                            alert(data);
                            var stream="id_Usuario="+id_Usuario+"&"+"funcion="+1;
                            $.ajax({
                                type: "POST",
                                url: "select/trae_detalle_temporal_notacredito.php",
                                data:stream,
                                success: function(data) {							
                                    $('#productos_finanzas').html("");
                                    $('#productos_finanzas').append(data);
                                    
                                    $("#list_prod_term_proforma").val ("");	
                                    $("#precio").val("");
                                    $("#cajas").val("");
                                    $("#descuento").val (0);
                                    
                                    /*var num_prof=$('#num_prof').val();		
                                    $('#num_proforma').val(num_prof);		
                                    var numero_proforma=$('#num_proforma').val();*/							
                                    //sub TOTAL
                                                                            var stream="id_usuario="+id_usuario+"&"+"funcion="+3;
                                                                            $.ajax({
                                                                                type: "POST",
                                                                                url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                data:stream,
                                                                                success: function(data) {
                                                                                    ///Por aqui
                                                                                    var sub_tot =parseInt(data);
                                                                                    $('#subtotal_nota_venta').val(sub_tot);
                                                                                    
                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_subtotal').html(data);
                                                                                        }			
                                                                                    });
                                                                                    //ILA Total
                                                                                    var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/trae_subtotal_nota_credito.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            var ila_tot =parseInt(data);
                                                                                            $('#ila_nota_venta').val(ila_tot);
                                                                                            var dato=$('#ila_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_ila').html(data);
                                                                                                }			
                                                                                            });

                                                                                            var iva_tot=parseInt(sub_tot*19/100);
                                                                                            $('#iva_nota_venta').val(iva_tot);
                                                                                            var dato=$('#iva_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_iva').html(data);
                                                                                                }			
                                                                                            });
                                                                                            
                                                                                            var tot_tot=sub_tot+ila_tot+iva_tot;
                                                                                            $('#total_nota_venta').val(tot_tot);
                                                                                            var dato=$('#total_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                   // alert(data);
                                                                                                    $('#id_total').html(data);
                                                                                                }			
                                                                                            });
                                                                                        }			
                                                                                    });
                                                                                }			
                                                                            });
                                }			
                            });
                            
                        }                            			
                    });
                }else{
                    
                }
                /*
		var stream="id_detalle_nota_venta="+id_detalle_nota_venta+"&"+"funcion="+1;;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_nota_venta_mal_ingresados.php",
			data:stream,
			success: function(data) {						
				$("#productos_finanzas").find("#"+id_detalle_nota_venta).remove();
				var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+1;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_nota_venta.php",
					data:stream,
					success: function(data) {
						$('#subtotal_nota_venta').val(data);			 
						var subtotal=$('#subtotal_nota_venta').val(); 
						var subtotal=subtotal+0;
						var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+2;
						$.ajax({
							type: "POST",
							url: "select/trae_subtotal_nota_venta.php",
							data:stream,
							success: function(data) {
								$('#ila_nota_venta').val(data);
								var ila=$('#ila_nota_venta').val();
								var ila=ila+0;
								var subtotal=$('#subtotal_nota_venta').val();
								var subtotal=subtotal+0;
								var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
								var iva=(subtotal_1*19)/100;
								var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
								$('#iva_nota_venta').val(iva);
								$('#total_nota_venta').val(valor_iva);
							}			
						})
					}			
				});	
			}			
		});*/
	}
$.fn.ingresa_prod_nota_cred=function(){
	$("#popdetallestk").dialog("open");
}
function ValidaSoloNumeros() {
 if ( (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<input type="hidden" id="id_Usuario" value="<?php echo $id_Usuario?>"/>	
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Nota de Credito</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_comercializacion.php"><input type="button" value="Volver&raquo;"/></a>
								<a href="nota_credito.php"><input type="button" value="Nueva&raquo;"/></a>
							</div>
						</div>
                                                
                                                <table class="tableform">
                                                        <tr>
                                                            <td style="width: 10%">
                                                                <article class="module width_full">            
                                                                    <div class="module_content">
                                                                        <table class="tablesorter" id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Centro de Venta</label>
                                                                                        <input type="hidden" id="id_Usuario"  value="<?php echo $id_Usuario?>"/>
                                                                                    </td>
                                                                                    <td>
                                                                                            <select id="centro_venta" class='limpiar'>
                                                                                            </select>
                                                                                            <div id="valida-c_venta" style="display:none" class="errores">
                                                                                                    Debe Seleccionar Centro de Venta
                                                                                            </div> 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Nota de Credito</label>
                                                                                            
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="n_credito" onkeypress="ValidaSoloNumeros()" placeholder="Nota de Credito"/>	
                                                                                            <input type="hidden" id="perm_ingreso"  onkeypress="ValidaSoloNumeros()" placeholder="Numero"/>	
                                                                                            <div id="valida-n_credito_crear" style="display:none" class="errores">
                                                                                                    Debes Crear Nota de Credito
                                                                                            </div> 
                                                                                            <div id="valida-n_credito_mal" style="display:none" class="errores">
                                                                                                    Nota de Credito no Existente
                                                                                            </div>
                                                                                            
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                            <td >
                                                                &nbsp;
                                                            </td>
                                                            <td style="width: 30%">
                                                                <article class="module width_full">            
                                                                    <div class="module_content">
                                                                        <table class="tablesorter" id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Referencia</label>
                                                                                    </td>
                                                                                    <td>
                                                                                        
                                                                                        
                                                                                            <select id="referencia" class='limpiar'>
                                                                                            </select>
                                                                                            <div id="valida-referencia" style="display:none" class="errores">
                                                                                                    Debe Seleccionar Centro de Venta
                                                                                            </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Factura</label>
                                                                                    </td>
                                                                                    <td>
                                                                                        
                                                                                        
                                                                                            <input type="text" id="factura" class='limpiar' placeholder="Factura" onkeypress="ValidaSoloNumeros()"/>	
                                                                                            <input type="hidden" id="num_nota_venta"  onkeypress="ValidaSoloNumeros()" placeholder="Numero"/>	
                                                                                            <div id="valida-factura_0" style="display:none" class="errores">
                                                                                                    Numero de Factura no Puede ser 0 
                                                                                            </div> 
                                                                                            <div id="valida-factura" style="display:none" class="errores">
                                                                                                    Debe Ingresar Factura
                                                                                            </div> 
                                                                                            <div id="valida-factura_rep" style="display:none" class="errores">
                                                                                                     Factura ya se encuentra Registrada
                                                                                            </div> 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Observación</label>
                                                                                    </td>
                                                                                    <td>
                                                                                        
                                                                                        
                                                                                            <textarea rows="2" cols="40" id='observacion_nc'class='limpiar' placeholder="Observación de Nota de Credito" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>	
                                                                                            
                                                                                            <div id="valida-observacion_nc" style="display:none" class="errores">
                                                                                                    Debe Ingresar Observación
                                                                                            </div> 
                                                                                            
                                                                                    </td>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <article class="module width_full">            
                                                                    <div class="module_content">
                                                                        <table class="tablesorter" id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Fecha</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="fecha_nota_venta" size="12"  class='limpiar' placeholder="Fecha" value="<?php echo date('d-m-Y')?>" readonly/>
                                                                                            <div id="valida-fecha_nota_venta" style="display:none" class="errores">
                                                                                                    Debe Ingresar Fecha de Nota de Venta
                                                                                            </div>  
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Fecha de Despacho</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="fecha_despacho_nota_venta" size="12"  class='limpiar' placeholder="Fecha Despacho" readonly/>
                                                                                            <div id="valida-fecha_desp_nota_venta" style="display:none" class="errores">
                                                                                                    Debe Ingresar Fecha de Nota de Venta
                                                                                            </div> 
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Orden de Compra</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="orden_compra" size="12"  class='limpiar' placeholder="Orden de Compra"/>	
                                                                                    </td>
                                                                                    
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>R.U.T.</label>
                                                                                    </td>
                                                                                    <!--td>
                                                                                            <label>Rut Cliente</label>
                                                                                    </td-->
                                                                                    <td>
                                                                                        <input type="text" id="rut_cliente" size="12"  class='limpiar' placeholder="Rut Cliente" readonly/>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Cliente</label>
                                                                                    </td>
                                                                                    <td >
                                                                                            <select id="id_cliente_nacional" class='limpiar'>
                                                                                            </select>
                                                                                            <!--Aqui se Selecciona el cliente y tiene que ir a ver cuantas facturas tiene pendiente al finalizar el tema de las factura ver el tema de el cliente-->
                                                                                            <div id="valida-c_nac" style="display:none" class="errores">
                                                                                                    Debe Seleccionar Cliente 
                                                                                            </div> 
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Sucursal</label>
                                                                                    </td>
                                                                                    <td id='suc'>
                                                                                    </td>
                                                                                                                                                                        
                                                                                </tr>
                                                                                <!--tr>
                                                                                    
                                                                                </tr-->
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Condicion de Venta</label>
                                                                                    </td>
                                                                                   <td id='pago'>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Vendedor</label>
                                                                                    </td>
                                                                                    <td id='vend'>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Observación / Indicacion Despacho</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <textarea rows="2" cols="40" id='obs_despacho'class='limpiar' placeholder="Observación/Indicacion"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                        </tr>
                                                        
							<tr>
								<td style="display:none" id="anulada_td" >
								<input type="text" id="anulada"  value='Anulada' readonly style="border:1px solid #FD0C0C"/>	
								</td>
							</tr>
                                                        <tr>
                                                            <td colspan="3" style="display:none" id="insert_prod" >
                                                                <article class="module width_full">            
                                                                    <div class="module_content">
                                                                        <table class="tablesorter" id='productos'> 
                                                                            <thead>
                                                                                <!--tr>
                                                                                        <td style="display:none" id='estado_proforma'>
                                                                                         <font color='#cc3366'>Nota de Venta Rechazada por Finanzas	</font>						 							 		 
                                                                                        </td>
                                                                                </tr-->
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Lista de Precios</label>
                                                                                    </td>
                                                                                    <td id='lista_precio'>
                                                                                    </td>
                                                                                    <td>
                                                                                        <label>Canal</label>
                                                                                    </td>
                                                                                    <td id='canal'>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Producto</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Cantidad</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Descuento</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>V. Unitario</label>
                                                                                    </td>
                                                                                    <!--td>
                                                                                        &nbsp;
                                                                                    </td-->                                                                                    
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <input type="text" id="busca_pro" placeholder="Ingrese Producto a Filtrar y presione Enter"/><br>
                                                                                        <select id="list_prod_term" class="limpiar">
                                                                                        </select>
                                                                                        <input type="hidden" id="ila_pro">
                                                                                        <div id="valida-producto" style="display:none" class="errores">
                                                                                                Debe Ingresar Producto
                                                                                        </div> 
                                                                                        <div id="valida-stock_cero" style="display:none" class="errores">
                                                                                                Cantidad de stock es 0 
                                                                                        </div> 
                                                                                        <div id="valida-stock_mayor" style="display:none" class="errores">
                                                                                                La Cantidad que ingresa es Mayor al Stock
                                                                                        </div> 
                                                                                        <div id="valida-cantidad_es_0" style="display:none" class="errores">
                                                                                                La Cantidad que Esta Ingresando es 0 !!!!!!!
                                                                                        </div> 
                                                                                           
                                                                                        <div id="stock" style="display:none" class="errores">
                                                                                        </div> 
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text"  id="cajas" style="text-align: right" onkeypress="ValidaSoloNumeros()" class="limpiar" placeholder="Cantidad"/>
                                                                                            <div id="valida-cajas" style="display:none" class="errores">
                                                                                                    Debe Ingresar Numero de Cajas
                                                                                            </div> 
                                                                                            <div id="valida-cajas_autorizad" style="display:none" class="errores">
                                                                                                Nota de Venta Autorizada No se puede ingresar mas Productos
                                                                                        </div>  
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" id="descuento" style="text-align: right" value='0' class="limpiar" placeholder="Descuento" readonly/>(%)
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="precio" style="text-align: right" class="limpiar" readonly placeholder="Precio"/>
                                                                                            <div id="valida-precio" style="display:none" class="errores">
                                                                                                    Precio No Ingresado en Lsita de Precios
                                                                                            </div> 
                                                                                    </td>
                                                                                    <!--td>
                                                                                        <div class="fright" id='prod_nota_modificar'  style="display:none">
                                                                                                <input type="submit" onclick='$(this).elimina_prod_detalle_nota_venta_modif();' value="Agregar Productos &raquo;"/>
                                                                                        </div>
                                                                                        <div class="fright" id='prod_nota_nuevos'>
                                                                                                <input type="submit" onclick='$(this).ingresa_producto_nota_venta();' value="Agregar Productos &raquo;"/>
                                                                                        </div>
                                                                                        <div class="fright" style="display:none" id='prod_nota_antiguos'>
                                                                                                <input type="submit" onclick='$(this).ingresa_producto_nota_venta_antigua();' value="Agregar Productos &raquo;"/>
                                                                                        </div>
                                                                                        <div class="fright" style="display:none" id='prod_nota_venta_modificar'>
                                                                                                <input type="submit" onclick='$(this).ingresa_prod_detalle_nota_venta_modificar();' value="Agregar Productos &raquo;"/>
                                                                                        </div>
                                                                                    </td-->                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                        </tr>
                                                    
                                                    
                                                        <!--Porcenteje dde descuento
                                                         style="display:none"
                                                        -->
                                                        <tr>
                                                            <td colspan="3" id="insert_desc"  style="display:none">
                                                                <article class="module width_full">            
                                                                    <div class="module_content">
                                                                        <table class="tablesorter" id='productos'> 
                                                                            <thead>
                                                                                <tr>
                                                                                    <td colspan="4">
                                                                                            <label>Tipo de Descuento</label>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Descripción :</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <!--input type="text" id="des_referencia" placeholder="Ingrese Descripcion de Descuento"/-->
                                                                                            <textarea id="des_referencia" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Monto</label>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" id="descuento_gen" style="text-align: right" value='' onkeypress="ValidaSoloNumeros()" maxlength="6" size="6" class="limpiar" placeholder="Descuento" >
                                                                                    </td>
                                                                                    <!--td>
                                                                                        <td>
                                                                                            <label>Descuento (%)</label>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text" id="descuento" style="text-align: right" value='' onkeypress="ValidaSoloNumeros()" maxlength="6" size="6" class="limpiar" placeholder="Descuento" >
                                                                                        </td>
                                                                                        &nbsp;
                                                                                    </td-->                                                                                    
                                                                                </tr>
                                                                                
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                        </tr>
							
							
							<tr>
								<td colspan="3">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"> 
											<thead> 
												<tr>
													<th width="100">
															Codigo
														</th>
														<th>
															Producto
														</th>
														<th style='text-align:right'>
															Cantidad
														</th>
														 <th style='text-align:right'>
															Precio
														</th>
														<th style='text-align:right'>
															%
														</th>
														<th style='text-align:right'>
															Descuento
														</th>
                                                                                                                <th style='text-align:right'>
															Total
														</th>
								 
												</tr> 
											</thead>
											<tbody  id='productos_finanzas'>
											</tbody>
													<div id="valida-productos_factura" style="display:none" class="errores">
													Debe Ingresa Productos a Factura
													</div> 
											</table>
										</div>
									</article>
								</td>
							</tr>
							
                                                        <tr>
                                                            <td style="width: 70%">
                                                                &nbsp;
                                                            </td>
                                                            <td >
                                                                &nbsp;
                                                            </td>
                                                            <td>
                                                                <article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter" id='productos'> 
												<thead> 
                                                                                                    <tr>                                                                                                        
                                                                                                        <td >
                                                                                                                <label>Sub Total</label>
                                                                                                                <input type="hidden" id="subtotal_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                        </td>
                                                                                                        <td style="text-align: right" id='id_subtotal'>                                                                                                                
                                                                                                                
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                         
                                                                                                                <td>
                                                                                                                        <label>Total IABA</label>
                                                                                                                        
                                                                                                                        <div class="fright" style="display:none" id='ila_nota_venta1'> 
                                                                                                                            <input type="text" id="ila_nota_venta" style="text-align: right" class='limpiar_2'  value="0" />
                                                                                                                        </div>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_ila'>
                                                                                                                        
                                                                                                                </td>
                                                                                                         
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                                <td>
                                                                                                                        <label>Total IVA</label>
                                                                                                                        <input type="hidden" id="iva_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_iva'>
                                                                                                                        
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                    <tr>
                                                                                                                <td>
                                                                                                                        <label>Total Factura</label>
                                                                                                                        <input type="hidden" id="total_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_total'>
                                                                                                                        
                                                                                                                </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                               <!--td colspan="5">
                                                                                                                    <div class="fright"> 
                                                                                                                            <input type="submit" onClick='$(this).ingresa_factura();' id='ingresar_factura' value="Crear Factura &raquo;"/> 
                                                                                                                    </div>
                                                                                                                    <div class="fright" style="display:none" id='imprimir_factura'> 
                                                                                                                            <input type="submit" onClick='$(this).imprimir_factura();' value="Imprimir &raquo;"/> 
                                                                                                                    </div>
                                                                                                            </td-->
                                                                                                        </tr>
                                                                                                </thead>
                                                                                        </table>
                                                                                </div>
                                                                </article>
                                                            </td>
                                                        </tr>
						</table>
                                                    
					 	<!--table class="tableform">
							<tr>
								
								<td>
									<label>Centro de Venta</label>
									<select id="centro_venta" class='limpiar'>
									</select>
									<div id="valida-c_venta" style="display:none" class="errores">
										Debe Ingresar Centro de Venta
									</div> 
								</td>
								<td>
									<label>Fecha</label>
									<input type="text" id="fecha_nota_venta" placeholder="Fecha" value="<?php echo date('d-m-Y')?>" readonly/>
									<div id="valida-fecha_nota_venta" style="display:none" class="errores">
										Debe Ingresar Fecha de Nota de Credito
									</div>
								</td>
								<td>
									<label>Cliente</label>
									<select id="id_cliente_nacional" class='limpiar'>
									</select>
									<!--Aqui se Selecciona el cliente y tiene que ir a ver cuantas facturas tiene pendiente al finalizar el tema de las factura ver el tema de el cliente-->
									<!--div id="valida-c_nac" style="display:none" class="errores">
										Debe Ingresar Cliente 
									</div> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Factura</label>
									<input type="text" id="factura_nota_credito" onkeypress="ValidaSoloNumeros()" placeholder="Factura"/>	
									<div id="valida-fact" style="display:none" class="errores">
										Debe Ingresar Factura 
									</div>
									<div id="valida-fact_ing" style="display:none" class="errores">
										Factura ya se encuentra ingresada
									</div>
									<div id="valida-fact_0" style="display:none" class="errores">
										 Factura en Cero !!!!
									</div>
									<div id="valida-fact_ext" style="display:none" class="errores">
										Debe Ingresar Factura Existente
									</div>
								</td>
								<td colspan='2'>
									<label>Detalle de Nota de Credito</label>
									<textarea rows="2" cols="40" id='obs_nota_credito' class='limpiar' placeholder="Observacion"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan='4' id='ingreso_prod' style="display:none">
									<div class="fright"> 
									<input type="submit" onClick='$(this).ingresa_prod_nota_cred();' value="Ingresa Productos &raquo;"/> 
								</td>
							</tr>
							<tr>
								<td>
									<label>Sub Total</label>
								</td>
								<td>
									<input type="text" id="subtotal_nota" class='limpiar_2' onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-sub_t" style="display:none" class="errores">
										Debe Ingresar Sub Total 
									</div> 
								</td>
								<td>
									<label>Total ILA</label>
								</td>
								<td>
									<input type="text" id="ila_nota" class='limpiar_2'  value="0" onkeypress="ValidaSoloNumeros()"/>
								</td>
							</tr>
							<tr>
								<td>
									<label>Total IVA</label>
								</td>
								<td>
									<input type="text" id="iva_nota" class='limpiar_2' value="0" readonly />
								</td>
								<td>
									<label>Total</label>
								</td>
								<td>
									<input type="text" id="total_nota" class='limpiar_2' value="0" readonly/>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter" > 
												<thead> 
													<tr>
														<th width="100">
															Codigo de Producto
														</th>
														<th>
															Producto
														</th>
														<th>
															Solicitado
														</th>
														 <th>
															Precio
														</th>
														<th>
															Total
														</th>
														<th>
															%
														</th>
														<th>
															Descuento
														</th>
													</tr> 
													<tbody id='productos_finanzas_2'>
													</tbody>
												</thead>												
											</table>
										</div>
									</article>
								</td>
							</tr>
						</table-->
						<div class="fright" style="display:none" id='ingresa_nc'> 
							<input type="submit" id='aceptar_nota_cred' onClick='$(this).ingresa_nota_credito();' value="Ingresar &raquo;"/> 
						</div>
						<div class="fright" style="display:none" id='imprimir'> 
							<input type="submit" id='imprimir_nota_cred' onClick='$(this).imprimir_nota_credito();' value="Imprimir &raquo;"/> 
						</div>
					</div>		
				</div>
			</div>
		</td>
	</tr>	
</table>
<div id="popdetallestk" title='Producto a Ingresar a Nota de Credito' style="display:none" >
	<tr>
		<td colspan="5">
			<article class="module width_full">            
				<div class="module_content">
					<table class="tablesorter" id='productos'> 
						<thead> 
							<tr>
								<th width="100">
									Codigo de Producto
								</th>
								<th>
									Producto
								</th>
								<th>
									Solicitado
								</th>
								 <th>
									Precio
								</th>
								<th>
									Total
								</th>
								<th>
									%
								</th>
								<th>
									Descuento
								</th>
								<th>
									Seleccionar
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
</div> 
</body>
</html>