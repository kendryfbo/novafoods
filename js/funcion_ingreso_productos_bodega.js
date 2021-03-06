 $(function(){
  // **************************ingresa los productos de materia prima por posicion a bodega segun el bodeguero*************************************//		
	$.fn.ingreso_cantidad_pallet=function(id_calidad){		
		var stream="id_calidad="+id_calidad+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "comprobaciones/verifica_familias_veredas.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					$("#td_ingreso").html("");
					$("#dialog").dialog("open");
					$("#td_ingreso").append("<td colspan='3'><div class='fright'><input onClick='$(this).traer_espacios_bodega("+id_calidad+");' type='submit' value='Ingresar&raquo;'></div></td>");
				}
				else
				{					
					alert ("En Bodega No se Encuentra La Familia Que Esta Ingresando");					
				}	
			}
		});
	}
	//se ingresa la cantidad de pallet que se usaran para dar los espacios de bodega
	$.fn.traer_espacios_bodega=function(id_calidad){		
		if($.trim($("#cantidad_pallet").val())=="") 
		{
			$("#cantidad_pallet").focus();
			$('#valida-cantidad_pallet').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_pallet').fadeOut('slow');},1000); 
			$("#cantidad_pallet").val("");
			return false;
		}
		if($.trim($("#cantidad_pallet").val())==0) 
		{
			$("#cantidad_pallet").focus();
			$('#valida-cantidad_pallet_cero').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_pallet_cero').fadeOut('slow');},1000);
			$("#cantidad_pallet").val("");
			return false;
		}
		var cantidad_pallet=$("#cantidad_pallet").val();		
		var stream="id_calidad="+id_calidad+"&"+"cantidad_pallet="+cantidad_pallet;		
		$.ajax({
			type: "POST",
			url: "comprobaciones/verifica_cantidades_pallets_familias_veredas.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="id_calidad="+id_calidad+"&"+"cantidad_pallet="+cantidad_pallet+"&"+"funcion="+1;
					$.ajax({
						type: "POST",
						url: "select/selecciona_posicion_altillo.php",
						data:stream,
						success: function(data) {
							$("#id_calidad").val(id_calidad);
							$("#id_familia").val(data);
							$("#num_pallet").html("<option value='' selected>Seleccione Pallet...</option>");
							for (var i=1;i<=cantidad_pallet;i++)
							{
								$("#num_pallet").append("<option>"+i+"</option>");
								$("#td_ingreso").hide();
								$("#tbl_pallet").hide();
								$("#img_cod_barra").show();
							}
						}
					});
				}
				else
				{
					alert ("La Cantidad Que Esta Ingresando de Pallets Es Mayor a La Que se Encuentra en Bodega");
					$("#cantidad_pallet").val("");
				}
			}
		});
	}	
	//es la funcion que trae el codigo de barra segun el numero de pallet en el select 
	$( "#id_pallet" ).click(function() {
		 if($.trim($("#num_pallet").val())=="") 
		{
			alert ("Ingrese Numero de Pallet");
				return false;
		}
		var cantidad_pallet=$("#cantidad_pallet").val();
		var id_calidad=$("#id_calidad").val();
		var id_familia=$("#id_familia").val();
		var num_pallet = $('#num_pallet option:selected').attr('id');
		var stream="id_calidad="+id_calidad+"&"+"cantidad_pallet="+cantidad_pallet+"&"+"funcion="+2+"&"+"id_familia="+id_familia;
		$("#num_pallet option:selected").remove();
		$.ajax({
			type: "POST",
			url: "select/selecciona_posicion_altillo.php",
			data:stream,
			success: function(data){
		 		var numero=data;
				var stream="numero="+numero+"&"+"funcion="+1;
				$.ajax({
					type: "GET",
					url: "select/codigoBarras_img.php",
					data:stream,
					success: function(data) {
						var imagen=data;
						$("#tabla_codigo_barra").show()
						$("#img_codigo_barra_imprimir").html("<img src='"+imagen+"' align='center' width='120' height='100'/>");
						//// aqui imprime el codigo de barra por id de posicion
						var stream="numero="+numero;
							$.ajax({
							type: "GET",
							url: "select/traer_datos_codigo_barra.php",
							data:stream,
							dataType: 'json',
							success: function(data) {	
								for(i=0;i<data.length;i++)
								{
									$('#numero').html(numero);				 
									$('#producto').html(data[i].nombre_producto); 
									$('#cantidad').html(data[i].kilos+" "+data[i].umed);
									if ($('#num_pallet option').length==1)
									{
										var id_calidad=$("#id_calidad").val();
										var stream="id_calidad="+id_calidad;
										$.ajax({
											type: "POST",
											url: "update/actualiza_materia_prima_ingreso.php",
											data:stream,
											success: function(data){
												alert (data);
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
	});
	//Funcion que va a buscar los codigos de barra 
	$("#buscar_codigo").click(function() {
		if($.trim($("#codigo_barra").val())=="") 
		{
			$("#codigo_barra").focus();
			$('#valida-cod_barra').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_barra').fadeOut('slow');},1000); 
			return false;
		}
		var	numero_codigo_barra=$('#codigo_barra').val();	
		var stream="numero_codigo_barra="+numero_codigo_barra;
		$.ajax({
			type: "POST",
			url: "comprobaciones/combrobar_numero_codigo_barra.php",
			data:stream,
			success: function(data){
				if (data.indexOf("Error")==-1)
				{
					var stream="numero_codigo_barra="+numero_codigo_barra;
					$.ajax({
						type: "GET",
						url: "select/traer_imprimir_datos_numero_codigo_barra.php",
						data:stream,
						dataType: 'json',
						success: function(data){
							for(i=0;i<data.length;i++)
							{
								$("#img_codigo_barra_imprimir").html("<img src='"+data[i].imagen+"' align='center' width='120' height='100'/>");
								$("#producto").html(data[i].nombre_producto);
								$("#cantidad").html(data[i].kilos+" "+data[i].umed);
								$("#imprimir").show();
							}
						}	
					});
				}
				else
				{
					$("#codigo_barra").focus ();
					$('#valida-codigo').fadeIn('slow'); 
					setTimeout(function(){$('#valida-codigo').fadeOut('slow');},1000); 
					$("#codigo_barra").val ("");			 
					return false;
				}
			}	
		});
	});
	//Funcion que cambia de estado reservado a ocupado la posicion 
	$("#aceptar_ingreso").click(function() {
		if($.trim($("#codigo_barra").val())=="") 
		{
			$("#codigo_barra").focus();
			$('#valida-cod_barra').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_barra').fadeOut('slow');},1000); 
			return false;
		}
		var	numero_codigo_barra=$('#codigo_barra').val();	
		var stream="numero_codigo_barra="+numero_codigo_barra;
		$.ajax({
			type: "POST",
			url: "comprobaciones/combrobar_numero_codigo_barra.php",
			data:stream,
			success: function(data){
				if (data.indexOf("Error")==-1)
				{
					var stream="numero_codigo_barra="+numero_codigo_barra;
					$.ajax({
						type: "POST",
						url: "comprobaciones/traer_datos_ingreso_salida_cod_barra.php",
						data:stream,
						success: function(data){
							$("#detalle_productos").html("");
							$("#detalle_productos").append(data);
						}
					});
				}
				else
				{
					$("#codigo_barra").focus ();
					$('#valida-codigo').fadeIn('slow'); 
					setTimeout(function(){$('#valida-codigo').fadeOut('slow');},1000); 
					$("#codigo_barra").val ("");			 
					return false;
				}
			}
		});
	});	
	//Acepta el ingreso de los productos a bodega de productos terminados
	$.fn.aceptar_producto_terminado_bodega=function(){
		var numero_codigo_barra=$("#codigo_barra").val(); 
		var stream="numero_codigo_barra="+numero_codigo_barra+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "update/ingreso_retiro_producto_posicion_bodega.php",
			data:stream,
			success: function(data){
				$("#codigo_barra").val("");	
				$("#detalle_productos").html("");				
			}
		});
	}	
	//boton retirar que abre un dialog para poder ingresar la cantidad deseada
	$.fn.retirar_producto_bodega=function(tipo){
		if (tipo==1)
		{
			$("#popdetallestk").html("");
			$("#popdetallestk").dialog("open");
			$("#popdetallestk").dialog("option","title","Ingrese Cantidad a Retirar");
			$("#popdetallestk").append("<table><tr><td>Ingrese Cantidad</td><td><input type='text' id='cantidad_retirar' onkeypress='ValidaSoloNumeros()' placeholder='Cantidad'/><div id='valida-cantidad_retirar' style='display:none' class='errores'>Debe Ingresar Cantidad que va a Retirar!!!</div></td></tr><tr><td><input type='button' onClick='$(this).ingresa_cantidad_salida_pt();' value='Aceptar'/></td></tr></table>");
		}
		else
		{
			$("#popdetallestk").html("");
			$("#popdetallestk").dialog("open");
			$("#popdetallestk").dialog("option","title","Ingrese Cantidad a Retirar");
			$("#popdetallestk").append("<table><tr><td>Ingrese Cantidad</td><td><input type='text' id='cantidad_retirar' onkeypress='ValidaSoloNumeros()' placeholder='Cantidad'/><div id='valida-cantidad_retirar' style='display:none' class='errores'>Debe Ingresar Cantidad que va a Retirar!!!</div></td></tr><tr><td><input type='button' onClick='$(this).ingresa_cantidad_salida_mp();' value='Aceptar'/></td></tr></table>");

		}
	}	
	//acepta el ingreso de la cantidad ingresad
	$.fn.ingresa_cantidad_salida_pt=function(){
		if($.trim($("#cantidad_retirar").val())=="") 
		{
			$("#cantidad_retirar").focus();
			$('#valida-cantidad_retirar').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_retirar').fadeOut('slow');},1000); 
			return false;
		}		
		var cantidad_retirar=$("#cantidad_retirar").val();
		var numero_codigo_barra=$("#codigo_barra").val(); 
		var stream="numero_codigo_barra="+numero_codigo_barra+"&"+"cantidad_retirar="+cantidad_retirar+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "comprobaciones/combrobar_cantidades_retiro_productos.php",
			data:stream,
			success: function(data){
				if (data==1)
				{
					alert ("Su Cantidad es Mayor a la de Bodega");
					$("#cantidad_retirar").val("");
				}
				else
				{
					location.href = "ingreso_posicion_bodega.php";
				}
			}
		});
	}
	//boton que ingresa la cantidad a la posicionde bodega
	$.fn.aceptar_producto_materia_prima=function(){
		var numero_codigo_barra=$("#codigo_barra").val(); 
		var stream="numero_codigo_barra="+numero_codigo_barra+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "update/ingreso_retiro_producto_posicion_bodega.php",
			data:stream,
			success: function(data){
				$("#codigo_barra").val("");	
				$("#detalle_productos").html("");
			}
		});
	}
		//acepta el ingreso de la cantidad ingresad
	$.fn.ingresa_cantidad_salida_mp=function(){
		if($.trim($("#cantidad_retirar").val())=="") 
		{
			$("#cantidad_retirar").focus();
			$('#valida-cantidad_retirar').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cantidad_retirar').fadeOut('slow');},1000); 
			return false;
		}
		var cantidad_retirar=$("#cantidad_retirar").val();
		var numero_codigo_barra=$("#codigo_barra").val(); 
		var stream="numero_codigo_barra="+numero_codigo_barra+"&"+"cantidad_retirar="+cantidad_retirar+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "comprobaciones/combrobar_cantidades_retiro_productos.php",
			data:stream,
			success: function(data){
				if (data==1)
				{
					alert ("Su Cantidad es Mayor a la de Bodega");
					$("#cantidad_retirar").val("");
				}
				else 
				{
					location.href = "ingreso_posicion_bodega.php";
				}				
			}
		});	
	}
		//Agrega los Productos a la tabla ingreso_manual_material_pop antes de ser ingresados al stock
	$.fn.agregar_productos_ingreso_manual=function(){
		if($.trim($("#cantidad").val())=="") 
		{
			$("#cantidad").focus();
			$('#valida-cant').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cant').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_prod_pop").val())=="") 
		{
			$("#list_prod_pop").focus();
			$('#valida-prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-prod').fadeOut('slow');},1000); 
			return false;
		}
		var id_producto=$('#list_prod_pop option:selected').attr('id');
		var cantidad=$("#cantidad").val(); 
		var num_ingreso=$("#num_ingreso").val(); 
		var stream="num_ingreso="+num_ingreso+"&"+"id_producto="+id_producto+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto_salida.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="id_producto="+id_producto+"&"+"cantidad="+cantidad+"&"+"num_ingreso="+num_ingreso+"&"+"funcion="+2;
					$.ajax({
						type: "POST",
						url: "insert/ingresos_manuales_mat_pop.php",
						data:stream,
						success: function(data){
							$("#prod3").html('');		
							$("#prod3").append(data);		
							$('#list_prod_pop').val('');
							$("#cantidad").val(''); 
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
	//acepta el ingreso de material para que sea aprobado por gerencia
	$.fn.crear_ingreso_manual_material_pop=function(){
		if ($('#prod3 > tr').length == 0)
		{
   			$('#valida-sin_prod_tbl').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sin_prod_tbl').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#observacion").val())=="") 
		{
			$("#observacion").focus();
			$('#valida-obs').fadeIn('slow'); 
			setTimeout(function(){$('#valida-obs').fadeOut('slow');},1000); 
			return false;
		}
		var num_ingreso=$("#num_ingreso").val(); 
		var observacion=$("#observacion").val(); 
		var stream="num_ingreso="+num_ingreso+"&"+"observacion="+observacion+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "insert/ingresos_manuales_mat_pop.php",
			data:stream,
			success: function(data) {	
				alert (data);
				location.href = "principal_comercializacion.php";
				//aqui tiene que enviar un correo para que sepa que ahi un producto a espera de aprobacion 
			}			
		});		
	}
	//Borra el producto mal ingresado
	$.fn.borrar_producto_pop_ingreso=function(id_detalle_ingreso){
		var stream="id_detalle_ingreso="+id_detalle_ingreso+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_egreso_mal_ingresados_egreso.php",
			data:stream,
			success: function(data) {	
				$("#prod3").find("#"+id_detalle_ingreso).remove();
			}			
		});			
	}
	//Se ve la observacion de el ingreso
	$.fn.ver_observacion_ingreso=function(id_ingreso){
		var stream="id_ingreso="+id_ingreso+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "select/trae_orden_material_pop_aprobar_ingreso.php",
			data:stream,
			success: function(data) {	
				$("#popdetallestk").dialog("option","title","Detalles");
				$("#popdetallestk").dialog("open");
				$("#popdetallestk").html("");
				$("#popdetallestk").append(data);			
			}			
		});			
	}
	//Aprueba el ingreso de el material
	$.fn.aprobacion_ingreso=function(id_ingreso){
		var stream="id_ingreso="+id_ingreso+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "select/trae_orden_material_pop_aprobar_ingreso.php",
			data:stream,
			success: function(data) {	
				 alert (data);
				 location.href = "aprobar_material_pop_gerencia_ingreso.php";
				 //aqui deberia enviar un correo avisando que esta aprobado el ingreso
			}			
		});	
	}
	//Acepta el material para ingreso al stock 
	$.fn.ingreso_stock_pop=function(id_ingreso){
		var stream="id_ingreso="+id_ingreso+"&"+"funcion="+5;
		$.ajax({
			type: "POST",
			url: "select/trae_orden_material_pop_aprobar_ingreso.php",
			data:stream,
			success: function(data) {	
				 alert (data);
				 location.href = "material_pop_aprobado_ingreso_gerencia.php";
			}			
		});	
	}
	
	
 });	