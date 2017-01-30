 $(function(){
	 // **************************Imprime la orden de compra*************************************//		
	$.fn.detalle_orden_compra_calidad=function(){		
		var numero_orden = $(this).parents('tr').find("td").attr('id');
		location.href = "orden_compra_detalle_calidad.php?numero_orden="+numero_orden;
	}
	///********Funcion que aprueba el pedido de la orden de compra en Calidad******///
	$.fn.aprobar_orden_compra=function(){		
		var num_orden_compra=$('#num_ord_compra').val();
		var stream="num_orden_compra="+num_orden_compra;		
		$.ajax({
			type: "POST",
			url: "Update/cambio_estado_aprobacion_calidad.php",
			data:stream,
			success: function(data) {
				alert (data);
				location.href = "aprobar_calidad_materia_prima.php";
			}			
		});	
	}
	///********Funcion que Rechaza el pedido de la orden de compra en Calidad******///
	$.fn.rechazar_orden_compra=function(){		
		var num_orden_compra=$('#num_ord_compra').val();
		var stream="num_orden_compra="+num_orden_compra;		
		$.ajax({
			type: "POST",
			url: "Update/cambio_estado_rechazo_calidad.php",
			data:stream,
			success: function(data) {
				alert (data);
				location.href = "aprobar_calidad_materia_prima.php";
			}			
		});	
	}
	 // **************************muestra los productos de material pop para que sean aprobados e ingresan al stock*************************************//		
	$.fn.detalle_orden_productos_pop=function(numero_orden,id_bodega){		
		location.href = "orden_compra_detalle_productos_pop.php?numero_orden="+numero_orden+"&"+"id_bodega="+id_bodega;
	}
	 // **************************Cambia la cantidad que realmente se va a aprobar em material pop************************************//		
	$.fn.cambiar_cantidad_recepcionada_material_pop=function(id_bodega){		
		if($("#cambiar_cant"+id_bodega).is(':checked'))
		{  
			$("#td_input_cambiar_cant"+id_bodega).show();
			$("#td_cambiar_cant"+id_bodega).hide();			
        }  
	}
	 // **************************trae el valor de el input que realmente se va a aprobar em material pop************************************//		
	$.fn.cantidad_recepcionada_material_pop=function(id_bodega,valor_antiguo){	
		var valor_nuevo=$('#input_cant_camb'+id_bodega).val();
		if (!/^\d{1,9}(?:,\s?\d{3})*(?:\.\d*)?$/.test(valor_nuevo))
		{	
			$('#input_cant_camb'+id_bodega).val ("");
			$('#input_cant_camb'+id_bodega).focus();
			$('#valida-cantidad_prod'+id_bodega).fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_prod'+id_bodega).fadeOut('slow');},1000); 
			return false;
		}
		if (valor_nuevo>=valor_antiguo)
		{			
			$("#input_cant_camb"+id_bodega).focus ();
			$('#valida-cantidad_input'+id_bodega).fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_input'+id_bodega).fadeOut('slow');},1000); 
			$('#input_cant_camb'+id_bodega).val("");
			return false;
		}
		if (valor_nuevo==0)
		{	
			var num_orden_compra=$('#num_ord_compra').val();
			var stream="valor_nuevo="+valor_nuevo+"&"+"num_orden_compra="+num_orden_compra+"&"+"id_bodega="+id_bodega;		
			$.ajax({
				type: "POST",
				url: "Update/cambio_cantidad_estado_orden_compra_mat_pop_con_cero.php",
				data:stream,
				success: function(data) {
					var stream="numero_orden="+num_orden_compra;
					$.ajax({
						type: "POST",
						url: "select/trae_productos_pop_ingresados.php",
						data:stream,
						success: function(data) {
							$('#productos_pedidos').html("");
							$('#productos_pedidos').append(data);
							$('#td_cambiar_cant_2'+id_bodega).hide();						
						}			
					});
				}			
			});
		}
		else
		{
			var num_orden_compra=$('#num_ord_compra').val();
			var stream="valor_nuevo="+valor_nuevo+"&"+"num_orden_compra="+num_orden_compra+"&"+"id_bodega="+id_bodega;		
			$.ajax({
				type: "POST",
				url: "Update/cambio_cantidad_estado_orden_compra_mat_pop.php",
				data:stream,
				success: function(data) {
					var stream="numero_orden="+num_orden_compra;
					$.ajax({
						type: "POST",
						url: "select/trae_productos_pop_ingresados.php",
						data:stream,
						success: function(data) {
							$('#productos_pedidos').html("");
							$('#productos_pedidos').append(data);
							$('#td_cambiar_cant_2'+id_bodega).hide();						
						}			
					});
				}			
			});
		}
	}
	//**** Aprueba el ingreso de material y lo inserta en el stock****///
	$.fn.aprobar_ingreso_productos_orden_compra_mat_pop=function( ){	
		var num_orden_compra=$('#num_ord_compra').val();
		var stream="num_orden_compra="+num_orden_compra;		
		$.ajax({
			type: "POST",
			url: "insert/ingreso_sotck_bodega_pop.php",
			data:stream,
			success: function(data) {
				location.href = "aprobar_material_pop.php";
			}			
		});
	}
	 // **************************muestra los productos de material Mantencion para que sean aprobados e ingresan al stock*************************************//		
	$.fn.detalle_orden_productos_mantencion=function(numero_orden,id_bodega){		
		location.href = "orden_compra_detalle_productos_mantencion.php?numero_orden="+numero_orden+"&"+"id_bodega="+id_bodega;
	}
		 // **************************muestra los productos de material Prima para que sean aprobados e ingresan al stock*************************************//		
	$.fn.detalle_orden_productos_materia_prima=function(numero_orden,id_bodega){		
		location.href = "orden_compra_detalle_productos_prima.php?numero_orden="+numero_orden+"&"+"id_bodega="+id_bodega;
	}
	//**** Aprueba el ingreso de material y lo inserta en el stock****///
	$.fn.aprobar_ingreso_productos_orden_compra_mat_mantencion=function( ){	
		var num_orden_compra=$('#num_ord_compra').val();
		var stream="num_orden_compra="+num_orden_compra;		
		$.ajax({
			type: "POST",
			url: "insert/ingreso_stock_bodega_mantencion.php",
			data:stream,
			success: function(data) {
				location.href = "aprobar_material_mantencion.php";
			}			
		});
	}
	// **************************muestra los productos de material Oficina para que sean aprobados e ingresan al stock*************************************//		
	$.fn.detalle_orden_productos_oficina=function(numero_orden){		
		location.href = "orden_compra_detalle_productos_oficina.php?numero_orden="+numero_orden;
	}
	// **************************muestra los td de los input*************************************//		
	$.fn.mostrar_cantidades=function(id_pedido){		
		 $('#td_input'+id_pedido).show(); 
		 $('#td_boton'+id_pedido).show();//muestro mediante id
		 $('#th_titulo').show();//muestro mediante id
		 $('#td_check'+id_pedido).hide();//oculto mediante id		 
	}
	///****ingresa el valor de el input e la bodega de oficina***///
	$.fn.Ingreso_productos_bodega_oficina=function(id_pedido,numero_orden,cantidad_pedida){	
		var valor_ingresado=$("#cantidad"+id_pedido).val ();
		if (!/^\d{1,9}(?:,\s?\d{3})*(?:\.\d*)?$/.test(valor_ingresado))
		{	
			$('#cantidad'+id_pedido).val ("");
			$('#cantidad'+id_pedido).focus();
			$('#valida-cantidad_numerica'+id_pedido).fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_numerica'+id_pedido).fadeOut('slow');},1000); 
			return false;
		}
		if (valor_ingresado>=cantidad_pedida)
		{			
			$("#cantidad"+id_pedido).focus ();
			$('#valida-cantidad_mayor'+id_pedido).fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_mayor'+id_pedido).fadeOut('slow');},1000); 
			$('#cantidad'+id_pedido).val("");
			return false;
		}		
		var valor_faltante=cantidad_pedida-valor_ingresado;
		var stream="valor_faltante="+valor_faltante+"&"+"id_pedido="+id_pedido+"&"+"valor_ingresado="+valor_ingresado;		
		$.ajax({
			type: "POST",
			url: "update/cambio_cantidad_faltante_pedido.php",
			data:stream,
			success: function(data) {
				$("#cantidad"+id_pedido).attr ('disabled',true);
				$("#boton"+id_pedido).attr ('disabled',true);
			}			
		});
	}
	// **************************trae el valor de el input que realmente se va a aprobar em material pop************************************//		
	$.fn.aprobar_ingreso_productos_orden_compra_mat_oficina=function(){
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
		var numero_documento=$('#num_tipo_documento').val();
		var num_orden_compra=$('#num_ord_compra').val();
		var id_tipo_documento = $('#list_tipo_documento option:selected').attr('id');
		var stream="num_orden_compra="+num_orden_compra+"&"+"numero_documento="+numero_documento+"&"+"id_tipo_documento="+id_tipo_documento;		
		$.ajax({
			type: "POST",
			url: "insert/ingreso_sotck_bodega_oficina.php",
			data:stream,
			success: function(data) {
				alert ("Productos Ingresados");
				location.href = "aprobar_material_oficina.php";
			}			
		});
	}
	//**** Rechaza el ingreso de materia prima y no lo inserta en el stock****///
	$.fn.rechazar_cantidad_recepcionada_materia_prima=function(){	
		$("#popdetallestk").html("");
		$("#popdetallestk").dialog("open");
		$("#popdetallestk").dialog("option","title","Formulario De Reclamo Al Proveedor");
		var proveedor=$('#proveedor').val();
		var id_bodega=$('#id_bodega').val();
		var stream="id_bodega="+id_bodega+"&"+"proveedor="+proveedor;		
		$.ajax({
			type: "POST",
			url: "select/traer_formulario_reclamo.php",
			data:stream,
			success: function(data) {
				$("#popdetallestk").append(data);
			}			
		});
	}
	//**** Elimina la imagen que seleccione el usuario ****///
	$.fn.eliminar_imagen_reclamo=function(id_imagen){
		var stream="id_imagen="+id_imagen;		
		$.ajax({
			type: "POST",
			url: "delete/elimina_imagen_reclamo.php",
			data:stream,
			success: function(data) {
				$("#detalle_foto").find("#"+id_imagen).remove();
			}				
		});
	}	
	//**** con la funcion ingresa el reclamo a la base de datos ****///
	$.fn.ingresa_reclamo=function(numero_orden,id_bodega){
		 $(this).unbind('click');
		if($.trim($("#lote").val())==="") 
		{
			$("#lote").focus ();
			$('#valida-lote').fadeIn('slow'); 
			setTimeout(function(){$('#valida-lote').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cantidad").val())==="") 
		{
			$("#cantidad").focus ();
			$('#valida-cantidad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#descripcion").val())==="") 
		{
			$("#descripcion").focus ();
			$('#valida-descripcion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-descripcion').fadeOut('slow');},1000); 
			return false;
		}
		if($(".muestra_rechazada").is(':checked'))
		{  
	    } else {  
           
			$('#valida-rechazado').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rechazado').fadeOut('slow');},1000); 
			return false; 
		} 
		if($(".material_bloqueado").is(':checked'))
		{  
	    } else {             
			$('#valida-bloqueado').fadeIn('slow'); 
			setTimeout(function(){$('#valida-bloqueado').fadeOut('slow');},1000); 
			return false; 
        } 
		if($.trim($("#informante").val())==="") 
		{
			$("#informante").focus ();
			$('#valida-informante').fadeIn('slow'); 
			setTimeout(function(){$('#valida-informante').fadeOut('slow');},1000); 
			return false;
		}
		var cantidad=$("#cantidad").val ();	
		var stream="cantidad="+cantidad+"&"+"id_bodega="+id_bodega;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cantidad_reclamo.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					var informante=$("#informante").val ();
					var numero_reclamo=$("#num_reclamo").val ();
					var id_producto=$("#id_producto").val ();
					var id_proveedor=$("#id_proveedor").val ();
					var descripcion=$("#descripcion").val ();
					var lote=$("#lote").val ();
					var num_reclamo=$("#num_reclamo").val ();
					var cantidad=$("#cantidad").val ();		
					var rechazado=$('input:radio[name=muestra_rechazada]:checked').val();		
					var bloqueado=$('input:radio[name=material_bloqueado]:checked').val();
					var stream="id_producto="+id_producto+"&"+"id_proveedor="+id_proveedor+"&"+"lote="+lote
						+"&"+"cantidad="+cantidad+"&"+"rechazado="+rechazado+"&"+"bloqueado="+bloqueado+"&"+"numero_reclamo="+numero_reclamo
						+"&"+"descripcion="+descripcion+"&"+"informante="+informante+"&"+"numero_orden="+numero_orden+"&"+"id_bodega="+id_bodega;
					$.ajax({
						type: "POST",
						url: "insert/insertar_reclamo.php",
						data:stream,
						success: function(data) {
							$('#popdetallestk').dialog("close");
							// aqui envia el mail para mabel con la copia de el reclamo
							var stream="numero_orden="+numero_orden;
							$.ajax({
								type: "POST",
								url: "select/trae_productos_materia_prima_ingresados.php",
								data:stream,
								success: function(data) {
									$('#productos_pedidos').html("");
									$('#productos_pedidos').append(data);
									if ($('#productos_pedidos >tbody >tr').length == 0)
									{
										location.href = "aprobar_calidad_materia_prima.php";
									}
								}			
							});							
						}			
					});
				}
				else
				{
					$("#cantidad").focus ();
					$('#valida-cantidad_mayor').fadeIn('slow'); 
					setTimeout(function(){$('#valida-cantidad_mayor').fadeOut('slow');},1000); 
					$("#cantidad").val ("");
				 	return false;
				}			
			}			
		});
	}
	//carga el tipo de inspeccion y dasabilita el input
	 $("#tipo_insp").change(function(){
		var tipo_inspeccion = $('#tipo_insp option:selected').val();
		if (tipo_inspeccion=='visual')
		{
			$('#tam_muestra').attr('disabled',true);
			$("#tam_muestra").val ('');
		}
		else
		{
			$('#tam_muestra').attr('disabled',false);			
		}
	});	
		//****com`rueba el tamaño de la muestra no sea mayor al pedido****///
	$.fn.confirmar_tam_muestra=function(){
		var taman_muestra=$('#tam_muestra').val();
		var id_bodega=$('#id_bodega').val();
		var stream="taman_muestra="+taman_muestra+"&"+"id_bodega="+id_bodega;		
		$.ajax({
			type: "POST",
			url: "comprobaciones/combrobar_tamano_muestra.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					return true;
				}
				else
				{
					$("#tam_muestra").focus ();
					$('#valida-tam_muestra_mayor').fadeIn('slow'); 
					setTimeout(function(){$('#valida-tam_muestra_mayor').fadeOut('slow');},2000); 
					$("#tam_muestra").val ("");
				 	return false;
				}	
			}			
		}); 
	 
	}	
	//**** Aprueba el ingreso de materia prima y lo inserta en el stock****///
	$.fn.aceptar_cantidad_recepcionada_materia_prima=function(id_bodega,numero_orden){
		var proveedor=$('#proveedor').val();
		location.href = "formulario_recepcion_materias_primas.php?numero_orden="+numero_orden+"&"+"id_bodega="+id_bodega+"&"+"proveedor="+proveedor;
		/*$("#pop_formulario").html("");
		$("#pop_formulario").dialog("open");
		$("#pop_formulario").dialog("option","title","Recepcion de Materias Primas en Bodega");
		var proveedor=$('#proveedor').val();
		var id_usuario=$('#id_Usuario').val();
		var stream="id_bodega="+id_bodega+"&"+"proveedor="+proveedor+"&"+"id_usuario="+id_usuario;		
		$.ajax({
			type: "POST",
			url: "select/traer_formulario_recepcion_materias_primas.php",
			data:stream,
			success: function(data) {
				$("#pop_formulario").append(data);
			}			
		});*/
	}
	//****Ingresa los detalles de el material entrante****///
	$.fn.ingresa_detalles=function(){
		/*if($.trim($("#n_lote").val())==="") 
		{
			$("#n_lote").focus ();
			$('#valida-n_lote').fadeIn('slow'); 
			setTimeout(function(){$('#valida-n_lote').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#aspecto").val())==="") 
		{
			$("#aspecto").focus ();
			$('#valida-aspecto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-aspecto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_recepcion").val())==="") 
		{
			$("#fecha_recepcion").focus ();
			$('#valida-fecha_recepcion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_recepcion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#tipo_insp").val())==="") 
		{
			$("#tipo_insp").focus ();
			$('#valida-t_insp').fadeIn('slow'); 
			setTimeout(function(){$('#valida-t_insp').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#tot_recepcionado").val())==="") 
		{
			$("#tot_recepcionado").focus ();
			$('#valida-tot_recept').fadeIn('slow'); 
			setTimeout(function(){$('#valida-tot_recept').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_elaboracion").val())==="") 
		{
			$("#fecha_elaboracion").focus ();
			$('#valida-f_elab').fadeIn('slow'); 
			setTimeout(function(){$('#valida-f_elab').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#fecha_vencimiento").val())==="") 
		{
			$("#fecha_vencimiento").focus ();
			$('#valida-fecha_vencimiento').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_vencimiento').fadeOut('slow');},1000); 
			return false;
		}
		if( $('#tam_muestra').is(':disabled') == false) 
		{ 
			if($.trim($("#tam_muestra").val())==="") 
			{
				$("#tam_muestra").focus ();
				$('#valida-tam_muestra').fadeIn('slow'); 
				setTimeout(function(){$('#valida-tam_muestra').fadeOut('slow');},1000); 
				return false;
			}
		}    */
	
		var fecha_formulario=$("#fecha_formulario").val();
		var id_proveedor=$("#id_proveedor").val();
		var id_producto=$("#id_producto").val();
		var aspecto=$("#aspecto").val();
		var tot_recep=$("#tot_recepcionado").val();
		var f_elab=$("#fecha_elaboracion").val();
		var tipo_insp=$("#tipo_insp").val();
		var numero_orden_compra=$("#num_orden_compra").val();		
		var lote=$("#n_lote").val();
		var f_recep=$("#fecha_recepcion").val();
		var f_venc=$("#fecha_vencimiento").val();
		var tam_muestra=$("#tam_muestra").val();
		var numero_fomulario=$("#numero_fomulario").val();
		var id_bodega=$("#id_bodega").val();
		var stream="fecha_formulario="+fecha_formulario+"&"+"id_proveedor="+id_proveedor+"&"+"id_producto="+id_producto+"&"+"aspecto="+aspecto
			+"&"+"tot_recep="+tot_recep+"&"+"f_elab="+f_elab+"&"+"tipo_insp="+tipo_insp+"&"+"numero_orden_compra="+numero_orden_compra
			+"&"+"lote="+lote+"&"+"f_recep="+f_recep+"&"+"f_venc="+f_venc+"&"+"tam_muestra="+tam_muestra+"&"+"numero_fomulario="+numero_fomulario+"&"+"id_bodega="+id_bodega;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_formulario_materias_primas.php",
			data:stream,
			success: function(data) {
				$("#tabla_1").hide();
				$("#tabla_2").show();
			}			
		});	 
	}
	//solo si acepta sigue con la siguente muestra
	$.fn.aceptado_tabla_2=function(){
		$("#tabla_2").hide();
		$("#tabla_3").show();

	}
	//comprueba si ingreso los datos por ingreso de atributos en calidad
	$.fn.ingresa_inspeccion_atributos=function(){
		$("#tabla_3").hide();
		$("#tabla_4").show();

	}
	//comprueba si ingreso los datos por ingreso de atributos en calidad
	$.fn.termino_evaluacion=function(){
		var id_bodega=$("#id_bodega").val();
		var stream="id_bodega="+id_bodega;
		$.ajax({
			type: "POST",
			url: "update/ingreso_materia_prima_aceptada_x_calidad.php",
			data:stream,
			success: function(data) {
				alert (data);
				if (data.indexOf("Error")==-1)
				{	
					location.href = "aprobar_calidad_materia_prima.php";
				}
				else
				{
					// este error es por que no a aceptado el producto para ingresar
					alert ("Se a Producido un Error Favor Comunicarse con Informatica");
					location.href = "aprobar_calidad_materia_prima.php";
				}
			}			
		});	
		
	}
	
	
	
	
	 
 });