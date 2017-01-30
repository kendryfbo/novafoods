$(function(){
	// *********se selecciona la marca y da el formato correspondiente**************************//		
	$.fn.selecciona_marca=function(){
		$('#cod_prod').val("");
		$('#producto').val("");
		$('#id_producto').val("");	
		$('#list_sabores').prop('selectedIndex',0);
		var id_marca = $('#list_marc option:selected').attr('id');
		var stream="id_marca="+id_marca+"&"+"funcion="+1;		 
		$.ajax({
			type: "POST",
			url: "select/trae_select_termino_proceso.php",
			data:stream,
			success: function(data){							
				$('#listado_formatos').html("");
				$('#listado_formatos').append(data);
			}			
		});
	}
		// *********se selecciona el formato y da el sabor correspondiente**************************//		
	$.fn.selecciona_formato=function(){
		$('#cod_prod').val("");
		$('#producto').val("");
		$('#id_producto').val("");	
		var id_formato = $('#list_formato option:selected').attr('id');
		var id_marca = $('#list_marc option:selected').attr('id');
		var stream="id_formato="+id_formato+"&"+"funcion="+2+"&"+"id_marca="+id_marca;		 
		$.ajax({
			type: "POST",
			url: "select/trae_select_termino_proceso.php",
			data:stream,
			success: function(data){							
				$('#listado_sabores').html("");
				$('#listado_sabores').append(data);
			}			
		});
	}
	// *********se selecciona y trae el producto correspondiente**************************//	
	$.fn.selecciona_sabor=function(){
		$('#cod_prod').val("");
		$('#producto').val("");
		$('#id_producto').val("");		
		var id_formato = $('#list_formato option:selected').attr('id');
		var id_sabor = $('#list_sabores option:selected').attr('id');
		var id_marca = $('#list_marc option:selected').attr('id');
		var stream="id_formato="+id_formato+"&"+"id_sabor="+id_sabor+"&"+"id_marca="+id_marca+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "select/trae_select_termino_proceso.php",
			data:stream,
			success: function(data){
				$('#cod_prod').val(data);
			}			
		});
		var stream="id_formato="+id_formato+"&"+"id_sabor="+id_sabor+"&"+"id_marca="+id_marca+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "select/trae_select_termino_proceso.php",
			data:stream,
			success: function(data){
				$('#producto').val(data);
			}			
		});
		var stream="id_formato="+id_formato+"&"+"id_sabor="+id_sabor+"&"+"id_marca="+id_marca+"&"+"funcion="+5;
		$.ajax({
			type: "POST",
			url: "select/trae_select_termino_proceso.php",
			data:stream,
			success: function(data){
				$('#id_producto').val(data);
			}			
		});
	}
	//***** borra los datos de el lote al cambiar de fecha para que no cargue una antigua****//
	$("#fecha_vencimiento").click(function(){
		$("#lote").val("");
	});	
	//***** borra los datos de el lote al cambiar de Maquina para que no cargue una antigua****//
	$("#maq").click(function(){
		$("#lote").val("");
	});
		//***** borra los datos de el lote al cambiar de Operador para que no cargue una antigua****//
	$("#oper").click(function(){
		$("#lote").val("");
	});
		//***** borra los datos de el lote al cambiar de Codigo para que no cargue una antigua****//
	$("#cod").click(function(){
		$("#lote").val("");
	});
	// *********se selecciona el batch y da el lote de los productos tomando todos los demas valore necesarios*****************//	
	$.fn.numero_lote_productos=function(){
		if($.trim($("#fecha_vencimiento").val())==="") 
		{
			$('#valida-fecha_vencimiento').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_vencimiento').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#maq").val())==="") 
		{
			$("#maq").focus();
			$('#valida-maq').fadeIn('slow'); 
			setTimeout(function(){$('#valida-maq').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#oper").val())==="") 
		{
			$("#oper").focus();
			$('#valida-oper').fadeIn('slow'); 
			setTimeout(function(){$('#valida-oper').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cod").val())==="") 
		{
			$("#cod").focus();
			$('#valida-cod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#Batch").val())==="") 
		{
			$("#Batch").focus();
			$('#valida-Batch').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Batch').fadeOut('slow');},1000); 
			return false;
		}
		var fecha_vencimiento=$("#fecha_vencimiento").val();
		var fecha_vencimiento=fecha_vencimiento.replace('-','');
		var fecha_vencimiento=fecha_vencimiento.replace('-','');
		var maq=$("#maq").val();
		var oper=$("#oper").val();
		var cod=$("#cod").val();
		var batch=$("#Batch").val();
		var lote=fecha_vencimiento+maq+oper+cod+batch;
		$("#lote").val(lote);
	}
	// *********Ingresa el pallet a tabla produccion al apretar aceptar*****************//	
	$.fn.ingresar_pallet_produccion=function(){
		if($.trim($("#num_pallet_fis").val())==="") 
		{
			$("#num_pallet_fis").focus();
			$('#valida-num_pallet_fis').fadeIn('slow'); 
			setTimeout(function(){$('#valida-num_pallet_fis').fadeOut('slow');},1000); 
			return false;
		}	 
		if($('input:radio:checked').length ===0)
		{
			$('#valida-turno').fadeIn('slow'); 
			setTimeout(function(){$('#valida-turno').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#unid_prod").val())==="") 
		{
			$("#unid_prod").focus();
			$('#valida-unid_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-unid_prod').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#unid_rech").val())==="") 
		{
			$("#unid_rech").focus();
			$('#valida-unid_rech').fadeIn('slow'); 
			setTimeout(function(){$('#valida-unid_rech').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#cod_prod").focus();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#producto").val())==="") 
		{
			$("#producto").focus();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_vencimiento").val())==="") 
		{
			$("#fecha_vencimiento").focus();
			$('#valida-fecha_vencimiento').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_vencimiento').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#lote").val())==="") 
		{
			$("#lote").focus();
			$('#valida-lote').fadeIn('slow'); 
			setTimeout(function(){$('#valida-lote').fadeOut('slow');},1000); 
			return false;
		}		
		var numero_pallet=$("#num_pallet_fis").val();
		var fecha_produccion=$("#fecha_produccion").val();
		var turno=$('input:radio[name=turno]:checked').attr('id');
		var unidades_producidas=$("#unid_prod").val();
		var unidades_rechazadas=$("#unid_rech").val();
		var id_producto=$("#id_producto").val();
		var fecha_vencimiento=$("#fecha_vencimiento").val();
		var maq=$("#maq").val();
		var oper=$("#oper").val();
		var cod=$("#cod").val();
		var batch=$("#Batch").val();
		var lote=$("#lote").val();
		var idUsuario=$("#idUsuario").val();
		var stream="numero_pallet="+numero_pallet+"&"+"fecha_produccion="+fecha_produccion+"&"+"turno="+turno+"&"+"unidades_producidas="+unidades_producidas
			+"&"+"unidades_rechazadas="+unidades_rechazadas+"&"+"id_producto="+id_producto+"&"+"fecha_vencimiento="+fecha_vencimiento
			+"&"+"maq="+maq+"&"+"oper="+oper+"&"+"cod="+cod+"&"+"batch="+batch+"&"+"lote="+lote+"&"+"idUsuario="+idUsuario;
		$.ajax({
			type: "POST",
			url: "insert/ingreso_pallet_produccion.php",
			data:stream,
			success: function(data){
				if (data.indexOf("Error")==-1)
				{	
					alert ("Productos Ingresados");
					location.href = "principal_operaciones.php";
				}
				else
				{
					alert ("Se a Producido Un Error Favor LLamar a Informatica");
				}					
			}			
		});	 
	}
	//Busca los productos terminados
	 $("#buscar").click(function(){
		$("#id_familia").val("");
		$("#id_producto").val("");
		$("#saldo").val("");
		$("#popdetallestk").html("");
		$("#popdetallestk").dialog("open");
		$("#popdetallestk").dialog("option","title","Elegir Producto");
		var stream="";
		$.ajax({
			type: "POST",
			url: "select/traer_productos_produccion.php",
			data:stream,
			success: function(data){
				$("#popdetallestk").append(data);			
			}			
		});	
	});
	// *********trae el pallet de la tabla produccion al apretar buscar*****************//	
	$.fn.aceptar_prod_produccion=function(){
		if($('input:radio:checked').length ===0)
		{
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		var id_produccion=$('input:radio:checked').val();
		var stream="id_produccion="+id_produccion;
		$.ajax({
			dataType: "json",
			type: "POST",
			url: "select/trae_datos_produccion.php",
			data:stream,
			success: function(data) {	
				for(i=0;i<data.length;i++)
				{
					$("#id_familia").val(data[i].id_familia);
					$("#fecha_produccion").val(data[i].fecha_produccion);
					$("#turno").val(data[i].turno);
					$("#marca").val(data[i].marca);
					$("#formato").val(data[i].formato);
					$("#cod_prod").val(data[i].codigo_producto);
					$("#lote").val(data[i].lote);
					$("#unidades").val(data[i].unidades);
					$("#saldo").val(data[i].unidades);
					$("#id_produccion").val(id_produccion);
					$("#id_producto").val(data[i].id_producto);
					$("#sabor").val(data[i].sabor);
					var producto_pallet=(data[i].marca+" "+data[i].formato+" "+data[i].sabor);					
					$("#prod_pallet").val(producto_pallet);
					$("#num_pallet_fis").val(data[i].numero_pallet);
					$("#fecha_vencimiento").val(data[i].fecha_vencimiento);
					$("#rechazadas").val("");
					$("#popdetallestk").dialog("close");
				}
			}			
		});
	}	
	////****** funcion que resta lo ingresado al input y da el valor final en la creacion de pallet***///
	$.fn.rechazas_crear_pallet=function(){
		if($.trim($("#unidades").val())==="") 
		{
			$("#unidades").focus();
			$('#valida-unidades').fadeIn('slow'); 
			setTimeout(function(){$('#valida-unidades').fadeOut('slow');},1000); 
			$("#rechazadas").val("");
			return false;
		}	
		var rechazadas=$("#rechazadas").val();
		var unidades=$("#unidades").val();
		var saldo=unidades-rechazadas;
		$("#saldo").val(saldo);
		
	}
	//crea el codigo de el producto terminado
	 $("#crear_codigo_barra_prod_terminado").click(function(){
		if($.trim($("#tam_pallet").val())==="") 
		{
			$('#valida-tam').fadeIn('slow'); 
			setTimeout(function(){$('#valida-tam').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#id_familia").val())==="") 
		{
			$('#valida-familia_1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia_1').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#id_familia").val())==='0') 
		{
			$('#valida-familia_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia_2').fadeOut('slow');},1000); 
			return false;
		}	
		var id_familia=	$("#id_familia").val();	
		var stream="id_familia="+id_familia+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "comprobaciones/verifica_familias_veredas.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					var id_familia=	$("#id_familia").val();	
					var stream="id_familia="+id_familia+"&"+"funcion="+3;
					$.ajax({
						type: "POST",
						url: "comprobaciones/verifica_familias_veredas.php",
						data:stream,
						success: function(data) {
							var numero=data;
							var saldo=$('#saldo').val();
							var id_producto=$('#id_producto').val();
							var id_produccion=$('#id_produccion').val();
							var stream="numero="+numero+"&"+"saldo="+saldo+"&"+"id_producto="+id_producto+"&"+"funcion="+2+"&"+"id_produccion="+id_produccion;
							$.ajax({
								type: "GET",
								url: "select/codigoBarras_img.php",
								data:stream,
								success: function(data) {
									var imagen=data;
									$("#img_codigo_barra_imprimir").html("<img src='"+imagen+"' align='center' width='120' height='100'/>");
									$("#imprimir_pallet_terminado").show();
									$("#crear_codigo_barra_prod_terminado").hide();
										
								}
							});
						}
					});
				}
				else
				{					
					alert ("En Bodega No se Encuentra La Familia Que Esta Ingresando");					
				}	
			}
		});
	});
});		