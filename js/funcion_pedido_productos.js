 $(function(){
	$.fn.producto_sector=function(){
		var id_sector = $('#list_sector_pedidos option:selected').attr('id');
		var stream="id_sector="+id_sector;
		$.ajax({
			type: "POST",
			url: "select/trae_select_productos_x_sector.php",
			data:stream,
			success: function(data) {					
				$("#productos").html(data);	
			}			
		});
	}
	$.fn.select_producto=function(){
		var id_producto = $('#lista_productos option:selected').attr('id');
		var stream="id_producto="+id_producto;
		$.ajax({
			type: "POST",
			url: "select/trae_stock_productos.php",
			data:stream,
			success: function(data) {					
				$("#stock").html(data);	
				$('#stock').fadeIn('slow'); 
				setTimeout(function(){$('#stock').fadeOut('slow');},2000); 
			}			
		});
	}
	$.fn.productos_requerimiento_produccion=function(){
		if($.trim($("#list_proceso").val())==="") 
		{
			$("#list_proceso").focus ();
			$('#valida-proceso').fadeIn('slow'); 
			setTimeout(function(){$('#valida-proceso').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cantidad").val())==="") 
		{
			$("#cantidad").focus ();
			$('#valida-cantidad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#lista_productos").val())==="") 
		{
			$("#lista_productos").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		var id_producto = $('#lista_productos option:selected').attr('id');
		var id_proceso = $('#list_proceso option:selected').attr('id');
		var cantidad =$("#cantidad").val();	
		var stream="id_producto="+id_producto+"&"+"cantidad="+cantidad+"&"+"cantidad="+cantidad;
		alert (stream);
		/*$.ajax({
			type: "POST",
			url: "select/trae_stock_productos.php",
			data:stream,
			success: function(data) {					
				$("#stock").html(data);	
			}			
		});*/
	}
	//********desabilita el select luego de seleccionar el proceso***************/////
	 $("#list_proceso").change(function(){
	 	$('#list_proceso').prop('disabled', true);
	});
	/*****************combo Producto pop que se enccuentra en el pedido de material******///
	$.getJSON("combos/combo_material_pop.php",function(resultado){
		
		$("#list_prod_pop").html("<option value='' selected>Seleccione el Producto...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_prod_pop").append("<option id='"+resultado[i].id_producto+"' value='"+resultado[i].nombre_producto+"'>"+resultado[i].nombre_producto+"</option>");
		}	
	});
	//esta funcion luego de seleccionar el producto trae su stock
	$.fn.select_lista_material_pop=function(){
		var id_producto= $('#list_prod_pop option:selected').attr('id');
		var stream="id_producto="+id_producto+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "select/trae_stock_productos.php",
			data:stream,
			success: function(data) {	
		 		$("#stock").html(data);	
				$('#stock').fadeIn('slow'); 
				setTimeout(function(){$('#stock').fadeOut('slow');},1000); 
			}			
		});	
	}
	//Ingresa los Productos el detalle de material pop
	$.fn.agregar_productos_salida=function(){
		var stock =$("#inpt_stock").val();	
		var cantidad =$("#cantidad").val();	
		/*if (cantidad>stock)
		{
			///esto funciona para valida que la cantidad solicitada no sea mayor a la q el stock
			$("#cantidad").focus("");
			$("#cantidad").val("");
			$('#valida-cant_mayor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cant_mayor').fadeOut('slow');},1000); 
			return false;
		}*/
		if($.trim($("#cantidad").val())==="") 
		{
			$("#cantidad").focus("");
			$('#valida-cant').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cant').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_prod_pop").val())==="") 
		{
			$("#list_prod_pop").focus("");
			$('#valida-prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-prod').fadeOut('slow');},1000); 
			return false;
		}
		var id_producto=$('#list_prod_pop option:selected').attr('id');
		var num_egreso=$("#num_egreso").val();
		var stream="id_producto="+id_producto+"&"+"num_egreso="+num_egreso+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto_salida.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="id_producto="+id_producto+"&"+"cantidad="+cantidad+"&"+"num_egreso="+num_egreso+"&"+"funcion="+2;
					$.ajax({
						type: "POST",
						url: "insert/ingreso_orden_egreso.php",
						data:stream,
						success: function(data) {	
							$("#prod3").html("");
							$("#prod3").append(data);
						}			
					});
				}
				else
				{
					$("#list_prod_pop").focus ();
					$('#valida-prod_exst').fadeIn('slow'); 
					setTimeout(function(){$('#valida-prod_exst').fadeOut('slow');},1000); 
					$("#list_prod_pop").val ("");	
					$("#cantidad").val("");
					return false;
				}
			}			
		});
	}
	//elimina los productos egresados mal
	$.fn.borrar_producto_pop_egreso=function(id_detalle_egreso){
		var stream="id_detalle_egreso="+id_detalle_egreso+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_egreso_mal_ingresados_egreso.php",
			data:stream,
			success: function(data) {						
				$("#prod3").find("#"+id_detalle_egreso).remove();
			}			
		});
	}	
	//Crea la Solicitud de egreso de material pop
	$.fn.crear_solicitud_egreso=function(){
		if ($('#prod3 > tr').length == 0)
		{
   			$('#valida-sin_prod_tbl').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sin_prod_tbl').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#observacion").val())==="") 
		{
			$("#observacion").focus("");
			$('#valida-obs').fadeIn('slow'); 
			setTimeout(function(){$('#valida-obs').fadeOut('slow');},1000); 
			return false;
		}
		var id_area = $('#list_areas option:selected').attr('id');
		var num_egreso=$("#num_egreso").val();
		var fecha=$("#fecha").val();
		var observacion=$("#observacion").val();
		var stream="num_egreso="+num_egreso+"&"+"fecha="+fecha+"&"+"observacion="+observacion+"&"+"id_area="+id_area+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_orden_egreso.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "principal_comercializacion.php";
				//aqui deberia enviar el mail al gerente que ahi un egreso listo para salir
			}			
		});	
	}
	//trae el detalle de la orden de egreso
	$.fn.egreso_detalles=function(id_egreso){
		window.location.href = 'detalle_pop.php?id_egreso='+id_egreso;		
	}
	//trae La observacion si el egreso es interno
	$.fn.observacion_egreso=function(id_egreso){
		var stream="id_egreso="+id_egreso+"&"+"funcion="+5;
		$.ajax({
			type: "POST",
			url: "select/trae_orden_material_pop_aprobar_egreso.php",
			data:stream,
			success: function(data) {						
			//alert (data);		
				$("#popdetallestk").append(data);
				$("#popdetallestk").dialog("open");
			}			
		});	
	} 
	//trae el detalle de la orden de egreso
	$.fn.aceptar_material_pop=function(){		
		var id_egreso=$("#id_egreso").val();
		var stream="id_egreso="+id_egreso+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_orden_egreso.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "aprobar_material_pop_gerencia.php";
				//aqui deberia enviar el mail que el material esta aceptado
			}			
		});			
	}
		//trae el detalle de la orden de egreso ya aprobados por gerencia
	$.fn.egreso_detalles_aprobado=function(id_egreso){
		window.location.href = 'detalle_pop_aprobado_gerencia.php?id_egreso='+id_egreso;		
	}
	//comprueba la cantidad ingresada de el input
	$.fn.cantidad_ingresa=function(){
		cantidad=$(this).val();
		id_detalle_egreso=$(this).attr('class');
		var stream="id_detalle_egreso="+id_detalle_egreso+"&"+"cantidad="+cantidad+"&"+"funcion="+6;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_orden_egreso.php",
			data:stream,
			success: function(data) {
				if (data==1)
				{
					alert ("La Cantidad Ingresada Es Mayor a la Solicitada");
					$("."+id_detalle_egreso).focus("");
					$("."+id_detalle_egreso).val("");
 				}
			}			
		});
	}
	//acepta la cantidad que va a entregar 
	$.fn.aceptar_cantidad_pop=function(id_egreso){
		$.each($('input[type=text]'),function(){
			id_detalle_egreso=$(this).attr('class');
			cantidad=$(this).val();
			var stream="id_detalle_egreso="+id_detalle_egreso+"&"+"cantidad="+cantidad+"&"+"funcion="+5;
			$.ajax({
				type: "POST",
				url: "insert/ingreso_orden_egreso.php",
				data:stream,
				success: function(data) {						
					location.href = "material_pop_aprobado_gerencia.php";
				}			
			});	
		});		 	
	}
	//esta funcion carga el 2% de la proforma ingresada en el input
	$("#num_proforma").change(function(){		 
		var numero_proforma=$("#num_proforma").val();
		var stream="numero_proforma="+numero_proforma+"&"+"funcion="+6;
		$.ajax({
			type: "POST",
			url: "select/trae_orden_material_pop_aprobar_egreso.php",
			data:stream,
			success: function(data) {	
				if (data==1)
				{
					$("#num_proforma").focus();
					$("#num_proforma").val("");
					$('#valida-num_prof').fadeIn('slow'); 
					setTimeout(function(){$('#valida-num_prof').fadeOut('slow');},1000); 
					return false;
				}
				else 
				{
					var porcentaje=(data*0.02) 
					$("#porcentaje").html("");
					$("#porcentaje").append(porcentaje);
					var stream="numero_proforma="+numero_proforma+"&"+"funcion="+7;
					$.ajax({
						type: "POST",
						url: "select/trae_orden_material_pop_aprobar_egreso.php",
						data:stream,
						success: function(data) {
							$('#id_cliente_internacional').append('<option selected="selected">'+data+'</option>');  
					 	 
						}			
					});
				}				 
			}			
		});
	});	
	//Crea la Solicitud de egreso de material pop Internacional
	$.fn.crear_solicitud_egreso_internacional=function(){
		if ($('#prod3 > tr').length == 0)
		{
   			$('#valida-sin_prod_tbl').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sin_prod_tbl').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#num_proforma").val())==="") 
		{
			$("#num_proforma").focus("");
			$('#valida-num_prof_vac').fadeIn('slow'); 
			setTimeout(function(){$('#valida-num_prof_vac').fadeOut('slow');},1000); 
			return false;
		}
		var numero_proforma=$("#num_proforma").val();
		var fecha=$("#fecha").val();
		var num_egreso=$("#num_egreso").val();
		var stream="num_egreso="+num_egreso+"&"+"fecha="+fecha+"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+8;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_orden_egreso.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "principal_comercializacion.php";
				//aqui deberia enviar el mail al gerente que ahi un egreso listo para salir
			}			
		});	
	}
	//Crea la Solicitud de egreso de material pop Nacional
	$.fn.crear_solicitud_egreso_nacional=function(){
		if ($('#prod3 > tr').length == 0)
		{
   			$('#valida-sin_prod_tbl').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sin_prod_tbl').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#id_cliente_nacional").val())==="") 
		{
			$("#id_cliente_nacional").focus("");
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}		
		var fecha=$("#fecha").val();
		var num_egreso=$("#num_egreso").val();
		var stream="num_egreso="+num_egreso+"&"+"fecha="+fecha+"&"+"funcion="+9;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_orden_egreso.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "principal_comercializacion.php";
				//aqui deberia enviar el mail al gerente que ahi un egreso listo para salir
			}			
		});	
	}
		//Rechaza el Material POP Solicitado
	$.fn.rechazar_material_pop=function(){
		var num_egreso=$("#id_egreso").val();
		var stream="num_egreso="+num_egreso+"&"+"funcion="+10;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_orden_egreso.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "principal_gerencia.php";
				//aqui deberia enviar el mail al gerente que ahi un egreso esta rechazado
			}			
		});			
	}
	//Acepta la Nota de venta
	$.fn.aceptar_nota_venta=function(Numero_nota_venta){
		var stream="Numero_nota_venta="+Numero_nota_venta+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "select/trae_datos_notas_ventas_aprobacion_gerencia.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "autorizar_nota_venta.php";
				//aqui deberia enviar email de autorizacion de la nota de venta de parte de gerencia
			}			
		});	
	}
	//Rechaza la nota de venta
	$.fn.rechazar_nota_venta=function(Numero_nota_venta){
		var stream="Numero_nota_venta="+Numero_nota_venta+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "select/trae_datos_notas_ventas_aprobacion_gerencia.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "autorizar_nota_venta.php";
				//aqui deberia enviar el mail avisando que la nota fue rechazada
			}			
		});	
	}
	//trae los detales de cada producto 
	$.fn.detalles_nota_venta=function(Numero_nota_venta){
		var stream="Numero_nota_venta="+Numero_nota_venta+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "select/trae_datos_notas_ventas_aprobacion_gerencia.php",
			data:stream,
			success: function(data) {						
				$("#popdetallestk").html("");
				$("#popdetallestk").dialog("open");			 
				$("#popdetallestk").append(data);
			}			
		});	
	}
	//Acepta la proforma
	$.fn.aceptar_proforma=function(numero_proforma){
		var stream="numero_proforma="+numero_proforma+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "select/trae_datos_proforma_aprobacion.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "autorizar_proforma.php";
				//aqui deberia enviar email de autorizacion de la nota de venta de parte de gerencia
			}			
		});	
	}
	//Rechaza laproforma
	$.fn.rechazar_proforma=function(numero_proforma){
		var stream="numero_proforma="+numero_proforma+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "select/trae_datos_proforma_aprobacion.php",
			data:stream,
			success: function(data) {						
				alert (data);
				location.href = "autorizar_proforma.php";
				//aqui deberia enviar el mail avisando que la nota fue rechazada
			}			
		});	
	}
	//trae los detales de cada producto de la proforma
	$.fn.detalles_proforma=function(numero_proforma){
		var stream="numero_proforma="+numero_proforma+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "select/trae_datos_proforma_aprobacion.php",
			data:stream,
			success: function(data) {						
				$("#popdetallestk").html("");
				$("#popdetallestk").dialog("open");			 
				$("#popdetallestk").append(data);
			}			
		});	
	}
});