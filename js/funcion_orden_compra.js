 $(function(){
	//********desabilita el select luego de seleccionar el proceso***************/////
	 $("#list_tipo_proveedor").change(function(){
	 	var tipo_proveedor = $('#list_tipo_proveedor option:selected').attr('id');
		$.getJSON("select/trae_tipo_proveedor.php",{tipo_proveedor:tipo_proveedor},function(resultado){
			$("#list_proveedor").html("<option value='' selected>Seleccione Proveedor...</option>");
			for(i=0;i<resultado.length;i++)
			{
				$("#list_proveedor").append("<option id='"+resultado[i].id_proveedor+"' value='"+resultado[i].nombre_proveedor+"'>"+resultado[i].nombre_proveedor+"</option>");
			}		
		});
	});
	///****trae la condicion de pago al seleccionar el tipo de provedor***///
	 $("#list_proveedor").change(function(){
		var id_proveedor = $('#list_proveedor option:selected').attr('id');
		var tipo_proveedor = $('#list_tipo_proveedor option:selected').attr('id');
		var stream="id_proveedor="+id_proveedor+"&"+"tipo_proveedor="+tipo_proveedor;		
		$.ajax({
			type: "POST",
			url: "select/trae_condicion_pago_x_proveedor.php",
			data:stream,
			success: function(data)	{								
				$("#condicion_pago").val (data);
			}			
		});
	});	
	/*---Trae el Precio de el producto por el id de producto seleccionado*/
	$.fn.select_producto=function(){
		var id_producto = $('#lista_productos option:selected').attr('id');
		var stream="id_producto="+id_producto;
		$.ajax({
			dataType: "json",
			type: "POST",
			url: "select/trae_precio_x_producto.php",
			data:stream,
			success: function(data) {	
				for(i=0;i<data.length;i++)
				{
					$("#precio").val(data[i].costo_unitario);
					$("#umed").val(data[i].umed);
					$('#precio').prop('disabled', false);
					$('#cantidad').prop('disabled', false);
					$('#umed').prop('disabled', false);
				}
			}			
		});
	}
	//***** carga el precio de el producto con el input ****//
	$("#precio").change(function(){
		var precio_nuevo = $('#precio').val();
		var id_producto = $('#lista_productos option:selected').attr('id');
	 	var stream="precio_nuevo="+precio_nuevo+"&"+"id_producto="+id_producto;
		$.ajax({
			type: "POST",
			url: "insert/insertar_nuevo_precio.php",
			data:stream,
			success: function(data) {				
			}			
		});	
	});
	//***agrega el nuevo producto en la tabla para sacar el calculo****
	$.fn.ingresa_producto_finanzas=function(){
		if($.trim($("#cantidad").val())==="") 
		{
			$("#cantidad").focus ();
			$('#valida-cantidad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad').fadeOut('slow');},1000); 
			$("#cantidad").val ("");			 
			return false;
		}
		if($.trim($("#precio").val())==="") 
		{
			$("#precio").focus ();
			$('#valida-precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
			$("#precio").val ("");			 
			return false;
		}
		if($.trim($("#lista_productos").val())==="") 
		{
			$("#lista_productos").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			$("#lista_productos").val ("");			 
			return false;
		}
		var action = confirm('Esta seguro que desea Traer El Ultimo Precio Disponible ?');
		if(action==true)
		{
			var id_producto = $('#lista_productos option:selected').attr('id');
			var numero_orden_compra=$('#num_ord_compra').val();
			var stream="id_producto="+id_producto+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"funcion="+2;
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_producto_orden_compra.php",
				data:stream,
				success: function(data) {
					if (data.indexOf("Error")==-1)
					{
						var id_producto = $('#lista_productos option:selected').attr('id');
						var numero_orden_compra=$('#num_ord_compra').val();
						var cantidad=$('#cantidad').val();
						var precio=$('#precio').val();
						var id_usuario =$('#id_usuario').val();
						var stream="id_producto="+id_producto+"&"+"cantidad="+cantidad+"&"+"precio="+precio
							+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"id_usuario="+id_usuario+"&"+"funcion="+2;
							$.ajax({
							type: "POST",
							url: "insert/inserta_detalle_producto_orden_compra.php",
							data:stream,
							success: function(data) {
								$('#productos_pedidos').append(data);
								$('#list_areas').prop('disabled', true);
								$("#precio").val("");
								$("#cantidad").val("");
								$("#lista_productos").val("");
								$("#umed").val("");
								var numero_orden_compra=$('#numero_orden_compra').val();
								$('#num_ord_compra').val(numero_orden_compra);
								var stream="numero_orden_compra="+numero_orden_compra+"&"+"funcion="+2;
								$.ajax({
									type: "POST",
									url: "select/trae_sub_total.php",
									data:stream,
									success: function(data) {
										$('#subtotal').val(data);
										var descuento=$("#descuento").val();
										var subtotal=$('#subtotal').val(); 
										var total_descuento=(subtotal*descuento)/100;
										var total_neto=(subtotal-total_descuento);
										$('#neto').val(total_neto);
										var iva=(total_neto*19)/100;
										var valor_iva=(total_neto+iva);
										$('#totaliva').val(iva);
										$('#TotalPago').val(valor_iva);
									}			
								});
							}			
						});				
					}
					else
					{	
						$("#lista_productos").focus ();
						$('#valida-producto_orden').fadeIn('slow'); 
						setTimeout(function(){$('#valida-producto_orden').fadeOut('slow');},1000); 
						$("#lista_productos").val ("");	
						$("#precio").val("");
						$("#cantidad").val("");
						return false;
					}
				}
			});
		}
	}
	//***agrega el nuevo producto en la tabla para sacar el calculo****
	$.fn.ingresa_producto_finanzas_modificar=function(){
		if($.trim($("#cantidad").val())==="") 
		{
			$("#cantidad").focus ();
			$('#valida-cantidad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad').fadeOut('slow');},1000); 
			$("#cantidad").val ("");			 
			return false;
		}
		if($.trim($("#precio").val())==="") 
		{
			$("#precio").focus ();
			$('#valida-precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
			$("#precio").val ("");			 
			return false;
		}
		if($.trim($("#lista_productos").val())==="") 
		{
			$("#lista_productos").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			$("#lista_productos").val ("");			 
			return false;
		}
		var action = confirm('Esta seguro que desea Traer El Ultimo Precio Disponible ?');
		if(action==true)
		{
			var id_producto = $('#lista_productos option:selected').attr('id');
			var numero_orden_compra=$('#num_ord_compra').val();
			var stream="id_producto="+id_producto+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"funcion="+1;
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_producto_orden_compra.php",
				data:stream,
				success: function(data) {
					if (data.indexOf("Error")==-1)
					{
						var id_producto = $('#lista_productos option:selected').attr('id');
						var numero_orden_compra=$('#num_ord_compra').val();
						var cantidad=$('#cantidad').val();
						var precio=$('#precio').val();
						var id_usuario =$('#id_usuario').val();
						var stream="id_producto="+id_producto+"&"+"cantidad="+cantidad+"&"+"precio="+precio
							+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"id_usuario="+id_usuario+"&"+"funcion="+1;
							$.ajax({
							type: "POST",
							url: "insert/inserta_detalle_producto_orden_compra.php",
							data:stream,
							success: function(data) {
								$('#productos_pedidos').append(data);
								$('#list_areas').prop('disabled', true);
								$("#precio").val("");
								$("#cantidad").val("");
								$("#lista_productos").val("");
								$("#umed").val("");
								var stream="numero_orden_compra="+numero_orden_compra+"&"+"funcion="+1;
								$.ajax({
									type: "POST",
									url: "select/trae_sub_total.php",
									data:stream,
									success: function(data) {
										$('#subtotal').val(data);
										var descuento=$("#descuento").val();
										var subtotal=$('#subtotal').val(); 
										var total_descuento=(subtotal*descuento)/100;
										var total_neto=(subtotal-total_descuento);
										$('#neto').val(total_neto);
										var iva=(total_neto*19)/100;
										var valor_iva=(total_neto+iva);
										$('#totaliva').val(iva);
										$('#TotalPago').val(valor_iva);
									}			
								});
							}			
						});				
					}
					else
					{	
						$("#lista_productos").focus ();
						$('#valida-producto_orden').fadeIn('slow'); 
						setTimeout(function(){$('#valida-producto_orden').fadeOut('slow');},1000); 
						$("#lista_productos").val ("");	
						$("#precio").val("");
						$("#cantidad").val("");
						return false;
					}
				}
			});
		}
	}
	// **************************Elimina Productos de bodega mal ingresados*************************************//		
	$.fn.elimina_prod_detalle=function(id_pedido_orden_compra,numero_orden_compra){
		var stream="id_pedido_orden_compra="+id_pedido_orden_compra+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_bodega_mal_ingresados.php",
			data:stream,
			success: function(data) {						
				$("#productos_pedidos").find("#"+id_pedido_orden_compra).remove();
				var stream="numero_orden_compra="+numero_orden_compra+"&"+"funcion="+1;
				$.ajax({
					type: "POST",
					url: "select/trae_sub_total.php",
					data:stream,
					success: function(data) {
						$('#subtotal').val(data);
						var descuento=$("#descuento").val();
						var subtotal=$('#subtotal').val(); 
						var total_descuento=(subtotal*descuento)/100;
						var total_neto=(subtotal-total_descuento);
						$('#neto').val(total_neto);
						var iva=(total_neto*19)/100;
						var valor_iva=(total_neto+iva);
						$('#totaliva').val(iva);
						$('#TotalPago').val(valor_iva);
					}			
				});	
			}			
		});
	}
	// **************************Elimina Productos de bodega mal ingresados*************************************//		
	$.fn.elimina_prod_detalle_modificar=function(id_pedido_orden_compra,numero_orden_compra){
		var stream="id_pedido_orden_compra="+id_pedido_orden_compra+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_bodega_mal_ingresados.php",
			data:stream,
			success: function(data) {						
				$("#productos_pedidos").find("#"+id_pedido_orden_compra).remove();
				var stream="numero_orden_compra="+numero_orden_compra+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/trae_sub_total.php",
					data:stream,
					success: function(data) {
						$('#subtotal').val(data);
						var descuento=$("#descuento").val();
						var subtotal=$('#subtotal').val(); 
						var total_descuento=(subtotal*descuento)/100;
						var total_neto=(subtotal-total_descuento);
						$('#neto').val(total_neto);
						var iva=(total_neto*19)/100;	
						var valor_iva=(total_neto+iva);
						$('#totaliva').val(iva);
						$('#TotalPago').val(valor_iva);
					}			
				});	
			}			
		});
	}
	// **************************Ingreso de documento de salida de productos*************************************//		
	$.fn.ingresa_orden_compra=function(){
		if($.trim($("#list_proveedor").val())==="") 
		{
			$("#list_proveedor").focus ();
			$('#valida-proveedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-proveedor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_areas").val())==="") 
		{
			$("#list_areas").focus ();
			$('#valida-area').fadeIn('slow'); 
			setTimeout(function(){$('#valida-area').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_tip_mon").val())==="") 
		{
			$("#list_tip_mon").focus ();
			$('#valida-moneda').fadeIn('slow'); 
			setTimeout(function(){$('#valida-moneda').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_orden_compra").val())==="") 
		{
	 		$('#valida-fecha_orden').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_orden').fadeOut('slow');},1000); 
			return false;
		}
		if ($('#productos_pedidos  >tr').length == 0)
		{
   			$('#valida-productos_pedidos').fadeIn('slow'); 
			setTimeout(function(){$('#valida-productos_pedidos').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#num_ord_compra").val())==="") 
		{
   			$('#valida-orden_vacio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-orden_vacio').fadeOut('slow');},1000); 
			return false;
		}		
		if($("#exenta").is(':checked'))
		{
			var exenta=1;
		}
		else
		{	
			var exenta=0;
		}
		var id_tipo_proveedor = $('#list_tipo_proveedor option:selected').attr('id');
		var id_proveedor = $('#list_proveedor option:selected').attr('id');
		var id_area = $('#list_areas option:selected').attr('id');
		var id_moneda = $('#list_tip_mon option:selected').attr('id');
		var fecha_orden_compra = $('#fecha_orden_compra').val();
		var descuento = $('#descuento').val();
		var numero_orden_compra = $('#num_ord_compra').val();
		var stream="id_proveedor="+id_proveedor+"&"+"id_area="+id_area+"&"+"id_moneda="+id_moneda
			+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"descuento="+descuento+"&"+"id_tipo_proveedor="+id_tipo_proveedor
			+"&"+"fecha_orden_compra="+fecha_orden_compra+"&"+"exenta="+exenta+"&"+"funcion="+1;		
		$.ajax({
			type: "POST",
			url: "insert/inserta_orden_compra.php",
			data:stream,
			success: function(data)	{								
				alert(data);
				location.href = "listado_ordenes_compra.php";
			}			
		});
	}
        
        /**************************************************/
        //Orden de Compra 2
        $.fn.ingresa_orden_compra2=function(){
            var action = confirm('Esta seguro que desea Grabar Orden de Compra?');
            if(action==true)
            {
                if($.trim($("#fecha_oc").val())==="") 
		{
	 		$('#valida-fecha_oc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_oc').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha_despacho_oc").val())==="") 
		{
	 		$('#valida-fecha_despacho_oc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_despacho_oc').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_proveedor").val())==="") 
		{
			$("#list_proveedor").focus ();
			$('#valida-proveedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-proveedor').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#condicion_venta").val())==="") 
		{
			$("#condicion_venta").focus ();
			$('#valida-condicion_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-condicion_venta').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_tip_mon").val())==="") 
		{
			$("#list_tip_mon").focus ();
			$('#valida-moneda').fadeIn('slow'); 
			setTimeout(function(){$('#valida-moneda').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_areas").val())==="") 
		{
			$("#list_areas").focus ();
			$('#valida-area').fadeIn('slow'); 
			setTimeout(function(){$('#valida-area').fadeOut('slow');},1000); 
			return false;
		}
		
		/*if($.trim($("#fecha_orden_compra").val())==="") 
		{
	 		$('#valida-fecha_orden').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_orden').fadeOut('slow');},1000); 
			return false;
		}*/
		if ($('#productos_finanzas  >tr').length == 0)
		{
   			$('#valida-productos_pedidos').fadeIn('slow'); 
			setTimeout(function(){$('#valida-productos_pedidos').fadeOut('slow');},1000); 
			return false;
		}
		/*if($.trim($("#num_ord_compra").val())==="") 
		{
   			$('#valida-orden_vacio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-orden_vacio').fadeOut('slow');},1000); 
			return false;
		}*/		
		if($("#ran_exenta").is(':checked'))
		{
			var exenta=1;
		}
		else
		{	
			var exenta=0;
		}
                //alert(exenta);
                if($("#ran_honorario").is(':checked'))
		{
			var honorario=1;
		}
		else
		{	
			var honorario=0;
		}
                //alert(honorario);
                var fecha_oc = $('#fecha_oc').val();
                var fecha_despacho_oc = $('#fecha_despacho_oc').val();
                var id_proveedor = $('#list_proveedor option:selected').attr('id');
                var cond_pago = $('#condicion_venta option:selected').attr('id');
                var id_moneda = $('#list_tip_mon option:selected').attr('id');
                var id_area = $('#list_areas option:selected').attr('id');
                
                var subtotal = $('#subtotal_oc').val();
                var descuento = $('#desc_oc').val();
                var porc_desc = $('#desc_por_oc').val();
                var neto = $('#neto_oc').val();
                var iva = $('#iva_oc').val();
                var rte = $('#honorario_oc').val();
                var total = $('#total_oc').val();
                var id_Usuario = $('#id_Usuario').val();
                
                var stream="fecha_oc="+fecha_oc
                        +"&"+"fecha_despacho_oc="+fecha_despacho_oc
                        +"&"+"id_proveedor="+id_proveedor
			+"&"+"cond_pago="+cond_pago
                        +"&"+"id_moneda="+id_moneda
                        +"&"+"id_area="+id_area
			+"&"+"subtotal="+subtotal
                        +"&"+"descuento="+descuento
                        +"&"+"porc_desc="+porc_desc
                        +"&"+"neto="+neto
                        +"&"+"iva="+iva
                        +"&"+"rte="+rte
                        +"&"+"total="+total
                        +"&"+"exenta="+exenta
                        +"&"+"honorario="+honorario
                        +"&"+"id_Usuario="+id_Usuario
                        +"&"+"funcion="+11;
                $.ajax({
			type: "POST",
			url: "insert/inserta_orden_compra.php",
			data:stream,
			success: function(data)	{								
				alert(data);
				//location.href = "listado_ordenes_compra.php";
                                location.href = "crear_orden_compra2.php";
			}			
		});
                /*
		var id_tipo_proveedor = $('#list_tipo_proveedor option:selected').attr('id');
		var id_proveedor = $('#list_proveedor option:selected').attr('id');
		var id_area = $('#list_areas option:selected').attr('id');
		var id_moneda = $('#list_tip_mon option:selected').attr('id');
		var fecha_orden_compra = $('#fecha_orden_compra').val();
		var descuento = $('#descuento').val();
		var numero_orden_compra = $('#num_ord_compra').val();
		var stream="id_proveedor="+id_proveedor+"&"+"id_area="+id_area+"&"+"id_moneda="+id_moneda
			+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"descuento="+descuento+"&"+"id_tipo_proveedor="+id_tipo_proveedor
			+"&"+"fecha_orden_compra="+fecha_orden_compra+"&"+"exenta="+exenta+"&"+"funcion="+1;		
		$.ajax({
			type: "POST",
			url: "insert/inserta_orden_compra.php",
			data:stream,
			success: function(data)	{								
				alert(data);
				location.href = "listado_ordenes_compra.php";
			}			
		});*/
            }
		
	}
         $.fn.elimina_prod_detalle_oc2=function(numero_oc,id_detalle){
             //alert(numero_oc+" "+id_detalle);
                var action = confirm('Desea Eliminar Producto Seleccionado de la Orden de Compra?');
                if(action==true)
		{
                    var stream="id_detalle="+id_detalle
                            +"&"+"numero_oc="+numero_oc
                            +"&"+"funcion="+3;
                    $.ajax({
                            type: "POST",
                            url: "delete/borra_productos_oc_mal_ingresados.php",
                            data:stream,
                            success: function(data) {	
                                alert(data);
                                    $("#productos_finanzas").find("#"+id_detalle).remove();
                                    var stream="numero_oc="+numero_oc+"&"+"funcion="+5;
                                    $.ajax({
                                            type: "POST",
                                            url: "select/trae_subtotal_oc.php",
                                            data:stream,
                                            success: function(data) {
                                                    $('#subtotal_oc').val(data);			 
                                                    var subtot=$('#subtotal_oc').val();
                                                    var stream="numero_oc="+numero_oc
                                                                        +"&"+"funcion="+6;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/inserta_orden_compra.php",
                                                                        data:stream,
                                                                        cache: false,
                                                                        dataType: 'json',
                                                                        success: function(data)	{	
                                                                                for(i=0;i<data.length;i++)
                                                                                {
                                                                                        if (data[i].valor==1)
                                                                                        {
                                                                                                alert ("Orden de Compra Vacia Ingrese Otra");
                                                                                                $("#btn_imprimir").hide();
                                                                                                $("#btn_nota_nueva").hide();									
                                                                                                $(".limpiar").val ('');
                                                                                                $(".limpiar_2").val (0);				
                                                                                                $("#productos_finanzas").html ('');	
                                                                                                location.href = "crear_nota_venta.php";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                //$('#subtotal_oc').val(data[i].subtot_oc);
                                                                                                $('#desc_oc').val(data[i].desc);
                                                                                                var desc=(data[i].desc);
                                                                                                $('#desc_por_oc').val(data[i].por_desc);
                                                                                                
                                                                                                var net=subtot-desc;
                                                                                                $('#neto_oc').val(net);
                                                                                                //alert($('#neto_oc').val());
                                                                                                $('#ran_exenta').val(data[i].exen);
                                                                                                $('#ran_honorario').val(data[i].hon);
                                                                                                
                                                                                                //$('#iva_oc').val(data[i].iva_oc);
                                                                                                
                                                                                                $('#honorario_oc').val(data[i].rte_oc);
                                                                                                var honorar=(data[i].rte_oc);
                                                                                                
                                                                                                var iva=net*19/100;
                                                                                                $('#iva_oc').val(iva);
                                                                                                //alert($('#iva_oc').val());
                                                                                                
                                                                                               var tot=net+iva;
                                                                                               $('#total_oc').val(tot);
                                                                                                //var status=(data[i].estado);
                                                                                                //alert(status);
                                                                                                if(data[i].exen==1){
                                                                                                    $("#ran_exenta").prop("checked", "checked");
                                                                                                    $('#iva_oc').val('0');
                                                                                                }/*else{
                                                                                                    
                                                                                                    $("#ran_exenta").prop("checked", "");
                                                                                                    var iva=net*19/100;
                                                                                                    $('#iva_oc').val(iva);
                                                                                                    
                                                                                                }*/
                                                                                                if(data[i].hon==1){
                                                                                                    $("#ran_honorario").prop("checked", "checked");
                                                                                                   $('#iva_oc').val('0');
                                                                                                   var rte=net*10/100;
                                                                                                   $('#honorario_oc').val(rte);
                                                                                                   var tot_ac=net-rte;
                                                                                                   $('#total_oc').val(tot_ac);
                                                                                                }/*else{
                                                                                                    $("#ran_honorario").prop("checked", "");
                                                                                                    var iva=net*19/100;
                                                                                                    $('#iva_oc').val('0');
                                                                                                }*/
                                                                                                var iva_act=$('#iva_oc').val();
                                                                                                var honor_act=$('#honorario_oc').val();
                                                                                               // alert(net+" "+iva_act+" "+honor_act);
                                                                                                 //var tot=(net+iva_act)-honor_act;
                                                                                                 
                                                                                                
                                                                                                
                                                                                                
                                                                                                var dato=$('#subtotal_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#desc_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_descuento').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#neto_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_neto_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                               
                                                                                                var dato=$('#iva_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#honorario_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_honorario').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#total_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                if($("#ran_exenta").is(':checked'))
                                                                                                {
                                                                                                        var exenta=1;
                                                                                                }
                                                                                                else
                                                                                                {	
                                                                                                        var exenta=0;
                                                                                                }
                                                                                                //alert(exenta);
                                                                                                if($("#ran_honorario").is(':checked'))
                                                                                                {
                                                                                                        var honorario=1;
                                                                                                }
                                                                                                else
                                                                                                {	
                                                                                                        var honorario=0;
                                                                                                }
                                                                                                //alert(honorario);
                                                                                                var fecha_oc = $('#fecha_oc').val();
                                                                                                var fecha_despacho_oc = $('#fecha_despacho_oc').val();
                                                                                                var id_proveedor = $('#list_proveedor option:selected').attr('id');
                                                                                                var cond_pago = $('#condicion_venta option:selected').attr('id');
                                                                                                var id_moneda = $('#list_tip_mon option:selected').attr('id');
                                                                                                var id_area = $('#list_areas option:selected').attr('id');

                                                                                                var subtotal = $('#subtotal_oc').val();
                                                                                                var descuento = $('#desc_oc').val();
                                                                                                var porc_desc = $('#desc_por_oc').val();
                                                                                                var neto = $('#neto_oc').val();
                                                                                                var iva = $('#iva_oc').val();
                                                                                                var rte = $('#honorario_oc').val();
                                                                                                var total = $('#total_oc').val();
                                                                                                var id_Usuario = $('#id_Usuario').val();

                                                                                                var stream="fecha_oc="+fecha_oc
                                                                                                        +"&"+"fecha_despacho_oc="+fecha_despacho_oc
                                                                                                        +"&"+"id_proveedor="+id_proveedor
                                                                                                        +"&"+"cond_pago="+cond_pago
                                                                                                        +"&"+"id_moneda="+id_moneda
                                                                                                        +"&"+"id_area="+id_area
                                                                                                        +"&"+"subtotal="+subtotal
                                                                                                        +"&"+"descuento="+descuento
                                                                                                        +"&"+"porc_desc="+porc_desc
                                                                                                        +"&"+"neto="+neto
                                                                                                        +"&"+"iva="+iva
                                                                                                        +"&"+"rte="+rte
                                                                                                        +"&"+"total="+total
                                                                                                        +"&"+"exenta="+exenta
                                                                                                        +"&"+"honorario="+honorario
                                                                                                        +"&"+"id_Usuario="+id_Usuario
                                                                                                        +"&"+"numero_oc="+numero_oc
                                                                                                        +"&"+"funcion="+111;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/inserta_orden_compra.php",
                                                                                                        data:stream,
                                                                                                        success: function(data)	{								
                                                                                                                alert(data);
                                                                                                                //location.href = "listado_ordenes_compra.php";
                                                                                                                //location.href = "crear_orden_compra2.php";
                                                                                                        }			
                                                                                                });
                                                                                                
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                            }			
                                    });	
                            }			
                    });
                }
         }
         
        // **************************Elimina Productos de OC mal ingresados*************************************//		
	$.fn.elimina_prod_detalle_oc=function(numero_oc,id_detalle){
		//var numero_oc=$('#numero_oc').val();
                //alert(numero_oc+""+id_detalle);
                var action = confirm('Desea Eliminar Producto Seleccionado de la Orden de Compra?');
		if(action==true)
		{
                    var stream="id_detalle="+id_detalle+"&"+"funcion="+2;
                    $.ajax({
                            type: "POST",
                            url: "delete/borra_productos_oc_mal_ingresados.php",
                            data:stream,
                            success: function(data) {						
                                    $("#productos_finanzas").find("#"+id_detalle).remove();
                                    var stream="numero_oc="+numero_oc+"&"+"funcion="+5;
                                    $.ajax({
                                            type: "POST",
                                            url: "select/trae_subtotal_oc.php",
                                            data:stream,
                                            success: function(data) {
                                                    $('#subtotal_oc').val(data);			 
                                                    var subtot=$('#subtotal_oc').val();
                                                    var stream="numero_oc="+numero_oc
                                                                        +"&"+"funcion="+6;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/inserta_orden_compra.php",
                                                                        data:stream,
                                                                        cache: false,
                                                                        dataType: 'json',
                                                                        success: function(data)	{	
                                                                                for(i=0;i<data.length;i++)
                                                                                {
                                                                                        if (data[i].valor==1)
                                                                                        {
                                                                                                alert ("Orden de Compra Vacia Ingrese Otra");
                                                                                                $("#btn_imprimir").hide();
                                                                                                $("#btn_nota_nueva").hide();									
                                                                                                $(".limpiar").val ('');
                                                                                                $(".limpiar_2").val (0);				
                                                                                                $("#productos_finanzas").html ('');	
                                                                                                location.href = "crear_nota_venta.php";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                //$('#subtotal_oc').val(data[i].subtot_oc);
                                                                                                $('#desc_oc').val(data[i].desc);
                                                                                                var desc=(data[i].desc);
                                                                                                $('#desc_por_oc').val(data[i].por_desc);
                                                                                                
                                                                                                var net=subtot-desc;
                                                                                                $('#neto_oc').val(net);
                                                                                                //alert($('#neto_oc').val());
                                                                                                $('#ran_exenta').val(data[i].exen);
                                                                                                $('#ran_honorario').val(data[i].hon);
                                                                                                
                                                                                                //$('#iva_oc').val(data[i].iva_oc);
                                                                                                
                                                                                                $('#honorario_oc').val(data[i].rte_oc);
                                                                                                var honorar=(data[i].rte_oc);
                                                                                                
                                                                                                var iva=net*19/100;
                                                                                                $('#iva_oc').val(iva);
                                                                                                //alert($('#iva_oc').val());
                                                                                                
                                                                                               var tot=net+iva;
                                                                                               $('#total_oc').val(tot);
                                                                                                //var status=(data[i].estado);
                                                                                                //alert(status);
                                                                                                if(data[i].exen==1){
                                                                                                    $("#ran_exenta").prop("checked", "checked");
                                                                                                    $('#iva_oc').val('0');
                                                                                                }/*else{
                                                                                                    
                                                                                                    $("#ran_exenta").prop("checked", "");
                                                                                                    var iva=net*19/100;
                                                                                                    $('#iva_oc').val(iva);
                                                                                                    
                                                                                                }*/
                                                                                                if(data[i].hon==1){
                                                                                                    $("#ran_honorario").prop("checked", "checked");
                                                                                                   $('#iva_oc').val('0');
                                                                                                   var rte=net*10/100;
                                                                                                   $('#honorario_oc').val(rte);
                                                                                                   var tot_ac=net-rte;
                                                                                                   $('#total_oc').val(tot_ac);
                                                                                                }/*else{
                                                                                                    $("#ran_honorario").prop("checked", "");
                                                                                                    var iva=net*19/100;
                                                                                                    $('#iva_oc').val('0');
                                                                                                }*/
                                                                                                var iva_act=$('#iva_oc').val();
                                                                                                var honor_act=$('#honorario_oc').val();
                                                                                               // alert(net+" "+iva_act+" "+honor_act);
                                                                                                 //var tot=(net+iva_act)-honor_act;
                                                                                                 
                                                                                                
                                                                                                
                                                                                                
                                                                                                var dato=$('#subtotal_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#desc_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_descuento').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#neto_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_neto_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                               
                                                                                                var dato=$('#iva_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#honorario_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_honorario').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#total_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                if($("#ran_exenta").is(':checked'))
                                                                                                {
                                                                                                        var exenta=1;
                                                                                                }
                                                                                                else
                                                                                                {	
                                                                                                        var exenta=0;
                                                                                                }
                                                                                                //alert(exenta);
                                                                                                if($("#ran_honorario").is(':checked'))
                                                                                                {
                                                                                                        var honorario=1;
                                                                                                }
                                                                                                else
                                                                                                {	
                                                                                                        var honorario=0;
                                                                                                }
                                                                                                //alert(honorario);
                                                                                                var fecha_oc = $('#fecha_oc').val();
                                                                                                var fecha_despacho_oc = $('#fecha_despacho_oc').val();
                                                                                                var id_proveedor = $('#list_proveedor option:selected').attr('id');
                                                                                                var cond_pago = $('#condicion_venta option:selected').attr('id');
                                                                                                var id_moneda = $('#list_tip_mon option:selected').attr('id');
                                                                                                var id_area = $('#list_areas option:selected').attr('id');

                                                                                                var subtotal = $('#subtotal_oc').val();
                                                                                                var descuento = $('#desc_oc').val();
                                                                                                var porc_desc = $('#desc_por_oc').val();
                                                                                                var neto = $('#neto_oc').val();
                                                                                                var iva = $('#iva_oc').val();
                                                                                                var rte = $('#honorario_oc').val();
                                                                                                var total = $('#total_oc').val();
                                                                                                var id_Usuario = $('#id_Usuario').val();

                                                                                                var stream="fecha_oc="+fecha_oc
                                                                                                        +"&"+"fecha_despacho_oc="+fecha_despacho_oc
                                                                                                        +"&"+"id_proveedor="+id_proveedor
                                                                                                        +"&"+"cond_pago="+cond_pago
                                                                                                        +"&"+"id_moneda="+id_moneda
                                                                                                        +"&"+"id_area="+id_area
                                                                                                        +"&"+"subtotal="+subtotal
                                                                                                        +"&"+"descuento="+descuento
                                                                                                        +"&"+"porc_desc="+porc_desc
                                                                                                        +"&"+"neto="+neto
                                                                                                        +"&"+"iva="+iva
                                                                                                        +"&"+"rte="+rte
                                                                                                        +"&"+"total="+total
                                                                                                        +"&"+"exenta="+exenta
                                                                                                        +"&"+"honorario="+honorario
                                                                                                        +"&"+"id_Usuario="+id_Usuario
                                                                                                        +"&"+"numero_oc="+numero_oc
                                                                                                        +"&"+"funcion="+111;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/inserta_orden_compra.php",
                                                                                                        data:stream,
                                                                                                        success: function(data)	{								
                                                                                                                alert(data);
                                                                                                                //location.href = "listado_ordenes_compra.php";
                                                                                                                //location.href = "crear_orden_compra2.php";
                                                                                                        }			
                                                                                                });
                                                                                                
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                            }			
                                    });	
                            }			
                    });
                }
		
	}
        //Imprimir OC
        $.fn.imprimir_oc=function(){	
		var numero=$('#num_oc').val();
                //var centro_venta=$('#centro_venta option:selected').attr('id');
		//window.open('select/imprimir_datos_facturas.php?funcion='+2+'&numero='+numero);
                //$("#cabeza_proforma").html("");
                var stream="numero="+numero
                        +"&"+"funcion="+1;
               // alert(stream);
		$.ajax({
                    type: "POST",
                    url: "select/trae_oc_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_oc').html("");	
			$('#cabeza_oc').append(data);
                    }			
		});
	}
        $.fn.imprimir_oc2=function(numero){	
		//var numero=$('#num_oc').val();
                //var centro_venta=$('#centro_venta option:selected').attr('id');
		//window.open('select/imprimir_datos_facturas.php?funcion='+2+'&numero='+numero);
                //$("#cabeza_proforma").html("");
                var stream="numero="+numero
                        +"&"+"funcion="+2;
               // alert(stream);
		$.ajax({
                    type: "POST",
                    url: "select/trae_oc_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_oc').html("");	
			$('#cabeza_oc').append(data);
                    }			
		});
	}
        /*Autoriza Oc*/
        $.fn.autoriza_OC_GTE=function(){
            var desicion=$('input:radio[name=desicion]:checked').val();
            //alert(id_pedido_proforma+" - "+numero_proforma);
            //alert("nota venta");
            if(desicion==1){
                var stream="desicion="+desicion
                        +"&"+"funcion="+51;
		$.ajax({
			type: "POST",
			url: "select/trae_objetos.php",
			data:stream,
			success: function(data) {
                               $('#observa').html("");
                               $('#clave_autoriza').html("");
                               $('#clave_autoriza').append(data);
			}			
		});   
            }else{
                var stream="desicion="+desicion
                        +"&"+"funcion="+61;
		$.ajax({
			type: "POST",
			url: "select/trae_objetos.php",
			data:stream,
			success: function(data) {
                               $('#observa').html("");
                               $('#observa').append(data);
                               var stream="desicion="+desicion
                                +"&"+"funcion="+51;
                               $.ajax({
                                   
                                        type: "POST",
                                        url: "select/trae_objetos.php",
                                        data:stream,
                                        success: function(data) {
                                               //$('#observa').html("");
                                               $('#clave_autoriza').html("");
                                               $('#clave_autoriza').append(data);
                                        }			
                                }); 
			}			
		}); 
            }
	}
        
        $.fn.autoriza_OC_gte23=function(){
            
            if($.trim($("#clave").val())==="") 
		{
			$("#clave").focus ();
			$('#valida-clave').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave').fadeOut('slow');},1000); 
			return false;
		}
            var numero_oc=$('#oc').val();
            var desicion=$('input:radio[name=desicion]:checked').val();
            var clave=$('#clave').val();
            var version=$('#version').val();
            //alert(numero_proforma);
            
            if(desicion==1){
                var stream="numero_oc="+numero_oc
                        +"&"+"clave="+clave
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/valida_clave3.php",
			data:stream,
			success: function(data) {
                               //alert(data);
                               if(data==1){
                                   var stream="numero_oc="+numero_oc
                                    +"&"+"version="+version
                                        +"&"+"funcion="+1;
                                       $.ajax({
                                            type: "POST",
                                            url: "update/autoriza_OC_finanzas.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_oc_por_autorizar.php";
                                            }			
                                    })
                               }else{
                                   $("#clave").focus ();
                                    $('#valida-clave_incorrecta').fadeIn('slow'); 
                                    setTimeout(function(){$('#valida-clave_incorrecta').fadeOut('slow');},1000); 
                                    return false;
                               }
                               //location.href = "crear_proforma.php";
                               /*
                               */
			}			
		})
            }else{
                if($.trim($("#observacion").val())==="") 
		{
			$("#observacion").focus ();
			$('#valida-observacion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-observacion').fadeOut('slow');},1000); 
			return false;
		}
                var observacion=$('#observacion').val();
                var stream="numero_oc="+numero_oc
                        +"&"+"clave="+clave
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/valida_clave3.php",
			data:stream,
			success: function(data) {
                               //alert(data);
                               if(data==1){
                                   var stream="numero_oc="+numero_oc
                                            +"&"+"observacion="+observacion
                                        +"&"+"funcion="+3;
                                       $.ajax({
                                            type: "POST",
                                            url: "update/autoriza_OC_finanzas.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_oc_por_autorizar.php";
                                            }			
                                    })
                               }else{
                                   $("#clave").focus ();
                                    $('#valida-clave_incorrecta').fadeIn('slow'); 
                                    setTimeout(function(){$('#valida-clave_incorrecta').fadeOut('slow');},1000); 
                                    return false;
                               }
			}			
		})
            }
	}
        ///
        /*Elimina Temporal Oc*/
        $.fn.elimina_prod_detalle_oc=function(id_detalle_oc,id_usuario){
		var num_oc=	$('#num_oc').val();
                //alert(num_oc);
                if(num_oc=="NUEVA"){
                    var stream="id_detalle_oc="+id_detalle_oc
                            +"&"+"id_usuario="+id_usuario
                            +"&"+"funcion="+1;
                    $.ajax({
			type: "POST",
			url: "delete/borra_productos_oc_mal_ingresados.php",
			data:stream,
			success: function(data) {
                            alert(data);
                            var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
                            $.ajax({
                                type: "POST",
                                url: "select/trae_detalle_temporal_oc.php",
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
                                        url: "select/trae_subtotal_nota_venta.php",//trae_subtotal_nota_venta
                                        data:stream,
                                        success: function(data) {
                                            var sub_tot =parseInt(data);
                                            $('#subtotal_nota_venta').val(sub_tot);
                                            //ILA Total
                                            var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                            $.ajax({
                                                type: "POST",
                                                url: "select/trae_subtotal_nota_venta.php",//trae_subtotal_nota_venta
                                                data:stream,
                                                success: function(data) {
                                                    var ila_tot =parseInt(data);
                                                    $('#ila_nota_venta').val(ila_tot);
                                                    
                                                    var iva_tot=parseInt(sub_tot*19/100);
                                                    $('#iva_nota_venta').val(iva_tot);
                                                    var tot_tot=sub_tot+ila_tot+iva_tot;
                                                    $('#total_nota_venta').val(tot_tot);//+
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
                
	}
	// **************************Ingreso de documento de salida de productos*************************************//		
	$.fn.actualizar_orden_compra=function(){
		if($.trim($("#list_proveedor").val())==="") 
		{
			$("#list_proveedor").focus ();
			$('#valida-proveedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-proveedor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_areas").val())==="") 
		{
			$("#list_areas").focus ();
			$('#valida-area').fadeIn('slow'); 
			setTimeout(function(){$('#valida-area').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_tip_mon").val())==="") 
		{
			$("#list_tip_mon").focus ();
			$('#valida-moneda').fadeIn('slow'); 
			setTimeout(function(){$('#valida-moneda').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_orden_compra").val())==="") 
		{
	 		$('#valida-fecha_orden').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_orden').fadeOut('slow');},1000); 
			return false;
		}
		if ($('#productos_pedidos >tr').length == 0)
		{
   			$('#valida-productos_pedidos').fadeIn('slow'); 
			setTimeout(function(){$('#valida-productos_pedidos').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#num_ord_compra").val())==="") 
		{
   			$('#valida-orden_vacio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-orden_vacio').fadeOut('slow');},1000); 
			return false;
		}		
		if($("#exenta").is(':checked'))
		{
			var exenta=1;
		}
		else
		{	
			var exenta=0;
		}
		var id_tipo_proveedor = $('#list_tipo_proveedor option:selected').attr('id');
		var id_proveedor = $('#list_proveedor option:selected').attr('id');
		var id_area = $('#list_areas option:selected').attr('id');
		var id_moneda = $('#list_tip_mon option:selected').attr('id');
		var fecha_orden_compra = $('#fecha_orden_compra').val();
		var descuento = $('#descuento').val();
		var numero_orden_compra = $('#num_ord_compra').val();
		var stream="id_proveedor="+id_proveedor+"&"+"id_area="+id_area+"&"+"id_moneda="+id_moneda
			+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"descuento="+descuento+"&"+"id_tipo_proveedor="+id_tipo_proveedor
			+"&"+"fecha_orden_compra="+fecha_orden_compra+"&"+"exenta="+exenta+"&"+"funcion="+2;		
		$.ajax({
			type: "POST",
			url: "insert/inserta_orden_compra.php",
			data:stream,
			success: function(data)	{								
				alert(data);
				location.href = "listado_ordenes_compra.php";
			}			
		});
	}
	// **************************Imprime la orden de compra*************************************//		
	$.fn.orden_compra_imprimir=function(){		
		var numero_orden = $(this).parents('tr').find("td").attr('id');
		location.href = "orden_compra_imprimir.php?numero_orden="+numero_orden;
	}
	//***el select de forma se selecciona y se abre el oculto corrrepodiente***/
	$.fn.ingreso_tipo_foma=function(){
		var id_forma = $('#list_tipo_forma option:selected').attr('id');
		if (id_forma==1)
		{
			$('#tr_por_orden').show();
			$('#tr_tipo_forma').hide();
		}
		else
		{
			$('#tr_por_proveedor').show();
			$('#tr_tipo_forma').hide();
		}	
	}
		// **************************Ingresa los datos y trae los productos*************************************//		
	$.fn.ingreso_por_forma=function(opcion){		
		if (opcion==1)
		{
			if($.trim($("#orden_compra").val())==="") 
			{
				$("#orden_compra").focus ();
				$('#valida-orden').fadeIn('slow'); 
				setTimeout(function(){$('#valida-orden').fadeOut('slow');},1000); 
				return false;
			}
			var numero_orden_compra=$("#orden_compra").val();
			$("#orden_compra").val(numero_orden_compra);			
			var stream="numero_orden_compra="+numero_orden_compra;		
			$.ajax({
				type: "POST",
				url: "Comprobaciones/comprobar_orden_compra.php",
				data:stream,
				success: function(data)	{								
					if (data.indexOf("Error")==-1)
					{
						$("#orden_compra").focus ();
						$('#valida-orden_reg').fadeIn('slow'); 
						setTimeout(function(){$('#valida-orden_reg').fadeOut('slow');},1000); 
						$("#orden_compra").val("");
						return false;
					}
					else
					{	
						$('#tr_por_orden').hide();
						$('#tr_datos').show();						
					}
				}			
			});
		}
		else
		{
			if($.trim($("#list_tipo_proveedor").val())==="") 
			{
				$("#list_tipo_proveedor").focus ();
				$('#valida-tipo_proveedor').fadeIn('slow'); 
				setTimeout(function(){$('#valida-tipo_proveedor').fadeOut('slow');},1000); 
	 			return false;
			}
			if($.trim($("#list_proveedor").val())==="") 
			{
				$("#list_proveedor").focus ();
				$('#valida-proveedor').fadeIn('slow'); 
				setTimeout(function(){$('#valida-proveedor').fadeOut('slow');},1000); 
	 			return false;
			}
			if($.trim($("#ordenes_compra").val())==="") 
			{
				$("#ordenes_compra").focus ();
				$('#valida-orden_compra').fadeIn('slow'); 
				setTimeout(function(){$('#valida-orden_compra').fadeOut('slow');},1000); 
	 			return false;
			}
			var numero_orden_compra= $('#ordenes_compra option:selected').attr('id');
			$("#orden_compra").val(numero_orden_compra);	
			$('#tr_por_proveedor').hide();
			$('#tr_datos').show();
		}	
	}
	//**funcion que al ingresar los datos trae los productos que solicitaron con la orden de compra//
	$.fn.ingreso_datos_traer_productos=function(){
		if($.trim($("#list_tipo_documento").val())==="") 
		{
			$("#list_tipo_documento").focus ();
			$('#valida-tip_doc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-tip_doc').fadeOut('slow');},1000); 
	 		return false;
		}
		if($.trim($("#num_tipo_documento").val())==="") 
		{
			$("#num_tipo_documento").focus ();
			$('#valida-num_doc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-num_doc').fadeOut('slow');},1000); 
	 		return false;
		}
		var numero_orden=$("#orden_compra").val();
		var stream="numero_orden="+numero_orden;
		$.ajax({
			type: "POST",
			url: "select/trae_productos_orden_compra.php",
			data:stream,
			success: function(data) {
				$('#tr_datos').hide();
				$('#tr_productos_orden').show();
				$('#productos_pedidos').append(data);	
			}			
		});
	}
	// **************************trae los datos de toda la orden de compra para que sean recepcionados los productos*************************************//		
	$.fn.ingreso_documentos_productos=function(){
		var id_proveedor = $('#list_proveedor option:selected').attr('id');
		var stream="id_proveedor="+id_proveedor;
		$.ajax({
			type: "POST",
			url: "select/trae_ordenes_pendientes.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					$("#td_select_ordenes").html("");
					$('#td_select_ordenes').append(data);
					$('#td_select_ordenes_titi').show();
				}
				else
				{	
					$("#td_select_ordenes").html("");
					$('#td_select_ordenes').append("No Registra Ordenes de Compra Pendiente el Proveedor");
				}
			}			
		});
	}
	// **************************Trae los productos segun la orden de compra*************************************//		
	$.fn.trae_productos_x_orden=function(){	
		if($.trim($("#numero_documento").val())==="") 
		{
			$("#numero_documento").focus ();
			$('#valida-numero_documento').fadeIn('slow'); 
			setTimeout(function(){$('#valida-numero_documento').fadeOut('slow');},1000); 
			$("#ordenes_compra").val("");
			return false;
		}
		if($.trim($("#list_tipo_documento").val())==="") 
		{
			$("#list_tipo_documento").focus ();
			$('#valida-tipo_doc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-tipo_doc').fadeOut('slow');},1000); 
			$("#ordenes_compra").val("");
			return false;
		}
		var numero_orden= $('#ordenes_compra option:selected').attr('id');
		var stream="numero_orden="+numero_orden;
		$.ajax({
			type: "POST",
			url: "select/trae_productos_orden_compra.php",
			data:stream,
			success: function(data) {
				$("#productos_pedidos").html("");
				$('#productos_pedidos').append(data);	
				$('#ingreso_orden').hide();
			}			
		});
	}
	//*************funcion que ingres los productos a bodega segun lo que llega de material pop, mantencion *************///
	$.fn.Ingreso_productos_bodega_sin_posicion=function(id_pedido,numero_orden_compra){		
		var cantidad = $('#cantidad'+id_pedido).val();
		if (!/^\d{1,9}(?:,\s?\d{3})*(?:\.\d*)?$/.test(cantidad))
		{	
			$('#cantidad'+id_pedido).val ("");
			$('#cantidad'+id_pedido).focus();
			$('#valida-cantidad_numerica'+id_pedido).fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_numerica'+id_pedido).fadeOut('slow');},1000); 
			return false;
		}
		var stream="id_pedido="+id_pedido+"&"+"cantidad="+cantidad;		
		$.ajax({
			type: "POST",
			url: "select/compara_cantidades_producto.php",
			data:stream,
			success: function(data) {
			 	if (data.indexOf("ok")==-1)
				{
					$('#cantidad'+id_pedido).val ("");
					$('#cantidad'+id_pedido).focus();
					$('#valida-cantidad_mayor'+id_pedido).fadeIn('slow'); 
					setTimeout(function(){$('#valida-cantidad_mayor'+id_pedido).fadeOut('slow');},1000); 
					return false;
				}
				else
				{
		 			var numero_documento=$("#num_tipo_documento").val();
					var observacion=$("#observacion_text").val();
					var id_tipo_documento= $('#list_tipo_documento option:selected').attr('id');
					var stream="id_pedido="+id_pedido+"&"+"cantidad="+cantidad+"&"+"id_tipo_documento="+id_tipo_documento
						+"&"+"numero_documento="+numero_documento+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"observacion="+observacion;		
					$.ajax({
						type: "POST",
						url: "Update/Ingresa_cantidad_x_producto.php",
						data:stream,
						success: function(data) {
			 				$('#cantidad'+id_pedido).attr('disabled', true);
							$('#btn_ingreso'+id_pedido).attr('disabled', true);
							$('#btn_volver').attr('disabled', true);
							$('#td_btn_aceptar_productos').attr('disabled',false);
						}
					});
				}		
			}			
		});
	}	
	//*************funcion que ingresa los productos materia prima e insumos a calidad*************///
	$.fn.Ingreso_calidad=function(id_pedido,numero_orden_compra){		
	 	var cantidad = $("#cantidad"+id_pedido).val();
		var numero_documento=$("#num_tipo_documento").val();
		var observacion=$("#observacion_text").val();
		var id_tipo_documento= $('#list_tipo_documento option:selected').attr('id');
		var stream="id_pedido="+id_pedido+"&"+"cantidad="+cantidad+"&"+"id_tipo_documento="+id_tipo_documento
					+"&"+"numero_documento="+numero_documento+"&"+"numero_orden_compra="+numero_orden_compra+"&"+"observacion="+observacion;		
		$.ajax({
			type: "POST",
			url: "Update/Ingresa_cantidad_x_producto_calidad.php",
			data:stream,
			success: function(data) {
				$('#btn_ingreso'+id_pedido).attr('disabled', true);
				$('#btn_volver').attr('disabled', true);
				$('#td_btn_aceptar_productos').attr('disabled',false);
			}
		});
	}
	/***esta funcion enviara el mail a el encargado de el area para que rebice los materiales y ingresaran a stock de bodega*///
	$.fn.aceptar_ingreso_bodega_sin_posicion=function(){		
		//alert (numero_orden_compra);
		//funcion para enviar el mail 
		location.href = "ingreso_productos_bodega.php";
		
	}
	/*** solo muestra la observacion al apretar el check box*///
	$.fn.Ingreso_observacion=function(){		
		$('#observacion_text').show();
	}
	/**** ingresara los productos al pallet ***////
	$.fn.ingreso_producto_altillo=function(id_pedido){	
		var cantidad_pallet=$('cantidad_pallet'+id_pedido).val();
		var stream="cantidad_pallet="+cantidad_pallet;		
		/*$.ajax({
			type: "POST",
			url: "select/trae_posiciones_bodega.php",
			data:stream,
			success: function(data) {
				alert (data);
			}
		});	*/
	}
	/***carga el Detalle para que ea ingresado en el pallet******/
	$.fn.Ingreso_detalle_productos_pallet=function(){	
		var numero_orden=$('#numero_orden').val();
		var stream="numero_orden="+numero_orden;		
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_productos_ingresados.php",
			data:stream,
			success: function(data) {
				$('#tabla_detalle_pallet').append(data);
				//$('#btn_volver').attr('disabled', true);
		
			}
		});
	}
	// **************************Imprime la orden de compra*************************************//		
	$.fn.detalle_orden_compra_imprimir=function(){		
		var numero_orden = $(this).parents('tr').find("td").attr('id');
		location.href = "orden_compra_detalle_gerencia.php?numero_orden="+numero_orden;
	}
	///********Funcion que aprueba el pedido de la orden de compra en gerencia******///
	$.fn.comprobar_clave_usuario=function(tipo){
		if (tipo==1)
		{
			$("#rechazo").show();
			$("#popdetallestk").dialog("open");
			$("#aprobar").hide();
		}
		else
		{
			$("#aprobar").show();
			$("#popdetallestk").dialog("open");
			$("#rechazo").hide();
		}		
	}
	///********Funcion que comprueba la clave de aprobacion de grencia******///
	$.fn.comprobar_clave_aprobacion=function(){	
		if($.trim($("#clave").val())==="") 
		{
			$("#clave").focus ();
			$('#valida-clave_vacia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave_vacia').fadeOut('slow');},1000); 
			return false;
		}				
		var id_usuario=$('#id_usuario').val();
		var clave=$('#clave').val().toUpperCase();
		var stream="clave="+clave+"&"+"id_usuario="+id_usuario;		
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_clave_gerencia.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Ok")==-1)
				{
					$("#clave").focus ();
					$('#valida-clave_error').fadeIn('slow'); 
					setTimeout(function(){$('#valida-clave_error').fadeOut('slow');},1000); 
					$("#clave").val("");
					return false;
				}
				else
				{
					var num_orden_compra=$('#num_ord_compra').val();
					var stream="num_orden_compra="+num_orden_compra;		
					$.ajax({
						type: "POST",
						url: "Update/cambio_estado_aprobacion_gerencia.php",
						data:stream,
						success: function(data) {
							alert (data);
							location.href = "ordenes_compra_aprobar_gerencia.php";
						}			
					});				
				}
			}			
		});	
	}
	///********Funcion que Rechaza el pedido de la orden de compra en gerencia******///
	$.fn.comprobar_clave_rechazo=function(){		
		if($.trim($("#clave").val())==="") 
		{
			$("#clave").focus ();
			$('#valida-clave_vacia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave_vacia').fadeOut('slow');},1000); 
			return false;
		}				
		var id_usuario=$('#id_usuario').val();
		var clave=$('#clave').val().toUpperCase();
		var stream="clave="+clave+"&"+"id_usuario="+id_usuario;		
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_clave_gerencia.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Ok")==-1)
				{
					$("#clave").focus ();
					$('#valida-clave_error').fadeIn('slow'); 
					setTimeout(function(){$('#valida-clave_error').fadeOut('slow');},1000); 
					$("#clave").val("");
					return false;
				}
				else
				{
			 		var num_orden_compra=$('#num_ord_compra').val();
					var stream="num_orden_compra="+num_orden_compra;		
					$.ajax({
						type: "POST",
						url: "Update/cambio_estado_rechazo_gerencia.php",
						data:stream,
						success: function(data) {
							alert (data);
							location.href = "ordenes_compra_aprobar_gerencia.php";
						}			
					});				
				}
			}			
		});	
	}
		 // **************************muestra los productos de material Mantencion para que sean aprobados e ingresan al stock*************************************//		
	$.fn.detalle_orden_productos_mantencion=function(numero_orden,id_bodega){		
		location.href = "detalle_productos_sin_aprobar.php?numero_orden="+numero_orden+"&"+"id_bodega="+id_bodega;
	}
	
});