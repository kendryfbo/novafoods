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
	<title>Facturacion</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
        <script src="js/funcion_combos.js"></script>
        <script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_ventas_productos.js"></script>
	<script src="js/jquery-ui-custom.min.js"></script>
	<link type="text/css" href="css/jquery-ui-custom.css" rel="stylesheet" />
</head>
<script>
$(document).ready(function() {	
	$("#fecha_factura").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$( "#fecha_factura" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_nota_venta").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	 $( "#fecha_venc_fac" ).datepicker( $.datepicker.regional[ "es" ]);
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
	//Valida nota de venta y trae los datos
        $('#num_nota_venta').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#num_nota_venta").val())==="") 
			{
				$("#num_nota_venta").focus();
				$('#valida-nota_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nota_venta').fadeOut('slow');},1000); 
				return false;
                                /*$("#num_nota_venta").val ("NUEVA");
                                var not=$("#num_nota_venta").val();*/
			}
			if ($.trim($("#num_nota_venta").val())==="0") 
			{
				$('#num_nota_venta').val('')
				$("#num_nota_venta").focus ();
				$('#valida-nota_venta_0').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nota_venta_mayor').fadeOut('slow');},1000); 
				return false;
			}
                        
                                var numero_nota_venta=$('#num_nota_venta').val();
                                
                                if($.trim($("#centro_venta").val())==="") 
                                {
                                        $('#valida-c_venta').fadeIn('slow'); 
                                        setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
                                        return false;
                                }
                                var centro_venta=$('#centro_venta option:selected').attr('id');
                               
                                //alert("aqui"+numero_nota_venta);
                                var stream="numero_nota_venta="+numero_nota_venta
                                        +"&"+"centro_venta="+centro_venta
                                        +"&"+"funcion="+51;
                                $.ajax({
                                        type: "POST",
                                        url: "insert/ingresa_nota_venta.php",
                                        data:stream,
                                        success: function(data)	{
                                            //alert(data);
                                                if (data==1)
                                                {
                                                        //aqui voy1
                                                                $('#num_nota_venta').val('')
                                                                $("#num_nota_venta").focus ();
                                                                $('#valida-nota_venta_no_autorizada').fadeIn('slow'); 
                                                                setTimeout(function(){$('#valida-nota_venta_no_autorizada').fadeOut('slow');},1000); 
                                                                return false;
                                                        
                                                }
                                                else if (data==2)
                                                {
                                                        var action = confirm('Desea Importar Nota De Venta?');
                                                        //var action = confirm('Desea Cambiar Esta Nota De Venta?');
                                                        if(action==true)
                                                        {
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
                                                                                                $("#btn_imprimir").show();
                                                                                                //$("#prod_nota_modificar").show();												
                                                                                                $("#prod_nota_nuevos").hide();	
                                                                                                //$("#btn_nota_modificada").show();	
                                                                                                $("#btn_nota_nueva").hide();
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                                        }					
                                                }
                                                else if (data==3)
                                                {
                                                        $('#num_nota_venta').val('')
                                                        $("#num_nota_venta").focus ();
                                                        $('#valida-nota_venta_correlativo').fadeIn('slow'); 
                                                        setTimeout(function(){$('#valida-nota_venta_correlativo').fadeOut('slow');},1000); 
                                                        var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
                                                        $.ajax({
                                                                type: "POST",
                                                                url: "insert/ingresa_nota_venta.php",
                                                                data:stream,
                                                                success: function(data)	{								
                                                                        $("#num_nota_venta").val (data);
                                                                }			
                                                        });	
                                                }
                                                else if (data==4)
                                                {
                                                        var numero_nota_venta=$("#num_nota_venta").val ();
                                                        var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+6;
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
                                                                                        $('#fecha_nota_venta').val(data[i].fecha_nota_venta);
                                                                                        $('#id_cliente_nacional').val(data[i].cliente);
                                                                                        $('#centro_venta').val(data[i].centro_venta);
                                                                                        $('#orden_compra').val(data[i].orden_compra);
                                                                                        $('#fecha_despacho_nota_venta').val(data[i].fecha_despacho);
                                                                                        $('#condicion_venta').val(data[i].Condicion);
                                                                                        $('#rut_cliente').val(data[i].rut);
                                                                                        $('#list_vendedores').val(data[i].vendedor);
                                                                                        $('#obs_despacho').val(data[i].observacion);
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
                                                                                        $('#version').val(data[i].version);
                                                                                        var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+30;
                                                                                        $.ajax({
                                                                                                type: "POST",
                                                                                                url: "insert/ingresa_nota_venta.php",
                                                                                                data:stream,
                                                                                                success: function(data)	{	
                                                                                                        $('#productos_finanzas ').html("");	
                                                                                                        $('#productos_finanzas').append(data);		
                                                                                                }			
                                                                                        });
                                                                                        $("#estado_proforma").show();
                                                                                        $("#btn_nota_nueva").hide();	
                                                                                        $("#prod_nota_nuevos").hide();												
                                                                                }						 
                                                                        }								
                                                                }			
                                                        });
                                                }
                                        } 
                                });
                           // }
		} 
	});
        /*
	$('#num_nota_venta').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#num_nota_venta").val())==="") 
			{
				$("#num_nota_venta").focus();
				$('#valida-nota_sin_ing').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nota_sin_ing').fadeOut('slow');},1000); 
				$("#factura").val('');
				return false;
			}
			var num_nota_venta=$("#num_nota_venta").val();
			var stream="num_nota_venta="+num_nota_venta+"&"+"funcion="+1;
			$.ajax({
				type: "POST",
				url: "select/funciones_facturacion.php",
				data:stream,
				success: function(data)	{								
					if (data==1)
					{
						$("#num_nota_venta").focus("");
						$("#num_nota_venta").val("");
						$('#valida-nota_vanta_no_exs').fadeIn('slow'); 
						setTimeout(function(){$('#valida-nota_vanta_no_exs').fadeOut('slow');},1000); 
						return false;
					}
					else if (data==2)
					{
						$("#num_nota_venta").focus("");
						$("#num_nota_venta").val("");
						$('#valida-nota_venta_no_aceptada').fadeIn('slow'); 
						setTimeout(function(){$('#valida-nota_venta_no_aceptada').fadeOut('slow');},1000); 					
					}
					else if (data==3)
					{
						$("#num_nota_venta").focus("");
						$("#num_nota_venta").val("");
						$('#valida-nota_venta_rechazada').fadeIn('slow'); 
						setTimeout(function(){$('#valida-nota_venta_rechazada').fadeOut('slow');},1000); 					
					}
					else 
					{
						$("#num_nota_venta").attr('disabled',true);
						var stream="num_nota_venta="+data+"&"+"funcion="+2;
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
									$('#vendedores').val(data[i].vendedor);
									$('#c_venta').val(data[i].cc_venta);
									$('#cond_venta').val(data[i].c_pago);
									$('#fecha_venc_fac').val(data[i].fecha_venc);
								}	
							}
						});					
					}
				}			
			});
		}
	});		*/
	//Valida de nota de venta y trae los datos
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
			var numero_nota_venta=$("#num_nota_venta").val();
                        var centro_venta=$('#centro_venta option:selected').attr('id');
			var factura=$("#factura").val();
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
						var action = confirm('Esta Factura se Encuentra Registrada desea Traer?');
						if(action==true)
						{
							$('#div_anular').show();
							$('#imprimir_factura').show();	
							$('#ingresar_factura').hide();		
							$('#prod_select').hide();
							$("#factura").attr('disabled',true);
							$("#num_nota_venta").attr('disabled',true);
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
                                                                                                            $("#btn_imprimir").show();
                                                                                                            //$("#prod_nota_modificar").show();												
                                                                                                            $("#prod_nota_nuevos").hide();	
                                                                                                            //$("#btn_nota_modificada").show();	
                                                                                                            $("#btn_nota_nueva").hide();
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
	$( "#anular" ).click(function() {
		var factura=$("#factura").val();
		if($.trim($("#factura").val())==="") 
		{
			$("#factura").focus();
			$('#valida-factura').fadeIn('slow'); 
			setTimeout(function(){$('#valida-factura').fadeOut('slow');},1000); 
			$("#factura").val('');
			return false;
		}
		if($.trim($("#factura").val())==="0") 
		{
			$("#factura").focus();
			$('#valida-factura_0').fadeIn('slow'); 
			setTimeout(function(){$('#valida-factura_0').fadeOut('slow');},1000); 
			$("#factura").val('');
			return false;
		}
		var stream="factura="+factura+"&"+"funcion="+21;
		$.ajax({
			type: "POST",
			url: "select/funciones_facturacion.php",
			data:stream,
			success: function(data)	{
				alert ("Factura Anulada");	
				location.href = "facturacion.php";
			}
		});
	});
});
function ValidaSoloNumeros() {
 if ( (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Factura</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_comercializacion.php"><input type="button" value="Volver&raquo;"/></a>
								<a href="facturacion.php"><input type="button" value="Nueva&raquo;"/></a>
								<div id='div_anular_'  style="display:none">
									<a href="#"><input type="button" id='anular' value="Anular&raquo;"/></a>
								</div>
							</div>
						</div>
						<table class="tableform">
                                                        <tr>
                                                            <td style="width: 30%">
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
                                                                                            <label>Factura</label>
                                                                                    </td>
                                                                                    <td>
                                                                                        
                                                                                        
                                                                                            <input type="text" id="factura" class='limpiar' placeholder="Factura" onkeypress="ValidaSoloNumeros()"/>	
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
                                                                                        <label>Nota Venta</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="num_nota_venta"  onkeypress="ValidaSoloNumeros()" placeholder="Numero"/>	
                                                                                            <input type="hidden" id="id_Usuario"  value="<?php echo $id_Usuario?>"/>	
                                                                                            <div id="valida-nota_venta" style="display:none" class="errores">
                                                                                                    Debe Ingresar Nota de Venta
                                                                                            </div> 
                                                                                            <div id="valida-nota_venta_mayor" style="display:none" class="errores">
                                                                                                    El Numero que Ingrea es Mayor al de El Correlativo
                                                                                            </div>
                                                                                            <div id="valida-nota_venta_0" style="display:none" class="errores">
                                                                                                    El Numero No Puede Ser 0 !!!!
                                                                                            </div> 
                                                                                            <div id="valida-nota_venta_no_autorizada" style="display:none" class="errores">
                                                                                                    Nota de Venta no Autorizada!
                                                                                            </div> 
                                                                                            <div id="valida-importar" style="display:none" class="errores">
                                                                                                    Debe Importar Nota de Venta!
                                                                                            </div> 
                                                                                    </td>
                                                                                </tr>
                                                                                <!--tr>
                                                                                    <td>
                                                                                            <label>Version</label>                                                                                         
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="version" onkeypress="ValidaSoloNumeros()" value='0' readonly placeholder="Version"/>	
                                                                                    </td>
                                                                                </tr-->
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                            <td style="width: 70%">
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
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
							<!--tr>
								<td>
									<label>Numero de Venta</label>
				 					<input type="text" id="num_nota_venta" class='limpiar' placeholder="Numero de Venta" onkeypress="ValidaSoloNumeros()"/>	
									<input type="hidden" id="dia_pago"/>	
									<div id="valida-nota_vanta_no_exs" style="display:none" class="errores">
										Debe Ingresar Nota de Venta Existente
									</div> 
									<div id="valida-nota_venta_no_aceptada" style="display:none" class="errores">
										Debe Ingresar Nota de Venta Que Haya Sido Aceptada
									</div> 
									<div id="valida-nota_venta_rechazada" style="display:none" class="errores">
										Esta Nota De Venta Fue Rechazada
									</div> 
									<div id="valida-nota_sin_ing" style="display:none" class="errores">
										Debe Ingresar Nota De Venta  
									</div> 
								</td>
								
								<td>
									<label>Vendedor</label>
									<input type="text" id="vendedores" class='limpiar' placeholder="Vendedor" Readonly/>	
								</td>
							</tr-->
							<!--    tr>
								<td>
									<label>Fecha Emision</label>
								</td>
								<td>
									<label>Centro de Venta</label>
								</td>							
							</tr>
								<td>
									<input type="text" id="fecha_factura" placeholder="Fecha" value="<?php echo date('d-m-Y')?>" readonly/>
								</td>
								<td>
									<input type="text" id="c_venta" class='limpiar' placeholder="Centro de Venta" Readonly/>	
								</td>
							<tr>
								<td>
									<label>Cliente</label>
								</td>
								<td>
									<label>Fecha de Vencimiento</label>
								</td>
								<td>
									<label>Condicion de Venta</label>
								</td>
							</tr>
							<tr>
								<td>
 									<input type="text" id="cliente" class='limpiar' placeholder="Cliente" Readonly/>
								</td>
								<td>
									<input type="text" id="fecha_venc_fac" class='limpiar' readonly/>
								</td>
								<td>
									<input type="text" id="cond_venta" class='limpiar' placeholder="Condicion de Venta" Readonly/>	
								</td>
							</tr>
							<tr>
								<td>
									<input type="submit" onClick='$(this).ingresa_productos_factura();' id='prod_select' value="Seleccionar Productos&raquo;"/> 
								</td>
							</tr-->
							<tr>
								<td colspan="5">
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
							<!--tr>
								<td>
									&nbsp;
								</td>
								<td colspan="1">
									<label>Sub Total</label>
								</td>
								<td>
									<input type="text" id="subtotal" value="0" class='limpiar_valores'  readonly/>
								</td>
								 <tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>Total ILA</label>
									</td>
									<td>
										<input type="text" id="ila"  class='limpiar_valores'  value="0" readonly/>
									</td>		
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>Total IVA</label>
									</td>
									<td>
										<input type="text" id="iva" class='limpiar_valores'  value="0" readonly/>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>Total Factura</label>
									</td>
									<td>
										<input type="text" id="total" value="0" class='limpiar_valores' readonly/>
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<div class="fright"> 
											<input type="submit" onClick='$(this).ingresa_factura();' id='ingresar_factura' value="Crear Factura &raquo;"/> 
										</div>
										<div class="fright" style="display:none" id='imprimir_factura'> 
											<input type="submit" onClick='$(this).imprimir_factura();' value="Imprimir &raquo;"/> 
										</div>
									</td>
								</tr-->
                                                                <tr>
                                                            <td style="width: 70%">
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
                                                                                                                        <input type="hidden" id="ila_nota_venta" style="text-align: right" class='limpiar_2'  value="0" readonly/>
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
                                                                                                               <td colspan="5">
                                                                                                                    <div class="fright"> 
                                                                                                                            <input type="submit" onClick='$(this).ingresa_factura();' id='ingresar_factura' value="Crear Factura &raquo;"/> 
                                                                                                                    </div>
                                                                                                                    <div class="fright" style="display:none" id='imprimir_factura'> 
                                                                                                                            <input type="submit" onClick='$(this).imprimir_factura();' value="Imprimir &raquo;"/> 
                                                                                                                    </div>
                                                                                                            </td>
                                                                                                        </tr>
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
			</div>
		</td>
	</tr>
</table>
<div id="popdetallestk" title='Producto a Ingresar a Factura'>
</div> 
</body>
</html>