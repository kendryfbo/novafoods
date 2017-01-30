$(function(){
		//********Trae el tipo de Cliente segun opcion elegida en los informes***************/////
	 $("#tipo_cliente").change(function(){
	 	var id_tipo_cliente = $('#tipo_cliente option:selected').attr('id');
		if (id_tipo_cliente=="1")
		{
			var stream="id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "combos/traer_tipo_cliente.php",
				data:stream,
				success: function(data)	{	
					$("#cliente").html("");
					$("#cliente").append(data);
				}			
			});
		}
		else if  (id_tipo_cliente=="2")
		{
			var stream="id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "combos/traer_tipo_cliente.php",
				data:stream,
				success: function(data)	{	
					$("#cliente").html("");
					$("#cliente").append(data);
				}			
			});
		}
		else if  (id_tipo_cliente=="0")
		{
			$("#cliente").html("");
		}			 
	});
	///********Es el Crea el informe por tipo de cliente y fecha******///
	$.fn.trae_informe=function(){	
		if($('#tipo_cliente option:selected').attr('id')==="0") 
		{
			$("#tipo_cliente").focus();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_fin").val())==="") 
		{
			$("#fecha_fin").focus();
		}
		if($.trim($("#fecha_inicio").val())==="") 
		{
			$("#fecha_inicio").focus();
		}
		var id_tipo_cliente = $('#tipo_cliente option:selected').attr('id');
		if (id_tipo_cliente=="1")
		{
			var cliente_nacional=$('#cliente_nacional option:selected').attr('id');
			var fecha_inicio=$("#fecha_inicio").val();
			var fecha_fin=$("#fecha_fin").val();
			var stream="cliente_nacional="+cliente_nacional+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin+"&"+"id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "informes/informe_ventas_x_cliente.php",
				data:stream,
				success: function(data)	{
					if (data.indexOf("Error")==-1)
					{
						$("#cargaData").html(data);
					}
					else
					{
						alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
					}
				}			
			});
		}
		else if  (id_tipo_cliente=="2")
		{
			var cliente_internacional=$('#cliente_internacional option:selected').attr('id');
			var fecha_inicio=$("#fecha_inicio").val();
			var fecha_fin=$("#fecha_fin").val();
			var stream="cliente_internacional="+cliente_internacional+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin+"&"+"id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "informes/informe_ventas_x_cliente.php",
				data:stream,
				success: function(data)	{
					if (data.indexOf("Error")==-1)
					{
						$("#cargaData").html(data);
					}
					else
					{
						alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
					}
				}			
			});
		}
	}
	$.fn.trae_informe_notas_ventas=function(){	
		if($('#tipo_cliente option:selected').attr('id')==="0") 
		{
			$("#tipo_cliente").focus();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_fin").val())==="") 
		{
			$("#fecha_fin").focus();
			return false;
		}
		if($.trim($("#fecha_inicio").val())==="") 
		{
			$("#fecha_inicio").focus();
			return false;
		}
		var id_tipo_cliente = $('#tipo_cliente option:selected').attr('id');
		if (id_tipo_cliente=="1")
		{
			var cliente_nacional=$('#cliente_nacional option:selected').attr('id');
			var fecha_inicio=$("#fecha_inicio").val();
			var fecha_fin=$("#fecha_fin").val();
			var stream="cliente_nacional="+cliente_nacional+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin+"&"+"id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "informes/informe_ventas_x_cliente.php",
				data:stream,
				success: function(data)	{
					if (data.indexOf("Error")==-1)
					{
						$("#cargaData").html(data);
					}
					else
					{
						alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
					}
				}			
			});
		}
		else if  (id_tipo_cliente=="2")
		{
			var cliente_internacional=$('#cliente_internacional option:selected').attr('id');
			var fecha_inicio=$("#fecha_inicio").val();
			var fecha_fin=$("#fecha_fin").val();
			var stream="cliente_internacional="+cliente_internacional+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin+"&"+"id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "informes/informe_ventas_x_cliente.php",
				data:stream,
				success: function(data)	{
					if (data.indexOf("Error")==-1)
					{
						$("#cargaData").html(data);
					}
					else
					{
						alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
					}
				}			
			});
		}
	}
	$.fn.trae_informe_notas_credito=function(){	
		if($('#tipo_cliente option:selected').attr('id')==="0") 
		{
			$("#tipo_cliente").focus();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_fin").val())==="") 
		{
			$("#fecha_fin").focus();
			return false;
		}
		if($.trim($("#fecha_inicio").val())==="") 
		{
			$("#fecha_inicio").focus();
			return false;
		}
		var id_tipo_cliente = $('#tipo_cliente option:selected').attr('id');
		if (id_tipo_cliente=="1")
		{
			var cliente_nacional=$('#cliente_nacional option:selected').attr('id');
			var fecha_inicio=$("#fecha_inicio").val();
			var fecha_fin=$("#fecha_fin").val();
			var stream="cliente_nacional="+cliente_nacional+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin+"&"+"id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "informes/trae_informe_notas_credito.php",
				data:stream,
				success: function(data)	{
					if (data.indexOf("Error")==-1)
					{
						$("#cargaData").html(data);
					}
					else
					{
						alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
					}
				}			
			});
		}
		else if  (id_tipo_cliente=="2")
		{
			var cliente_internacional=$('#cliente_internacional option:selected').attr('id');
			var fecha_inicio=$("#fecha_inicio").val();
			var fecha_fin=$("#fecha_fin").val();
			var stream="cliente_internacional="+cliente_internacional+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin+"&"+"id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "informes/trae_informe_notas_credito.php",
				data:stream,
				success: function(data)	{
					if (data.indexOf("Error")==-1)
					{
						$("#cargaData").html(data);
					}
					else
					{
						alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
					}
				}			
			});
		}
	}
	$.fn.trae_informe_facturas=function(){	
		if($('#tipo_cliente option:selected').attr('id')==="0") 
		{
			$("#tipo_cliente").focus();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_fin").val())==="") 
		{
			$("#fecha_fin").focus();
			return false;
		}
		if($.trim($("#fecha_inicio").val())==="") 
		{
			$("#fecha_inicio").focus();
			return false;
		}
		var id_tipo_cliente = $('#tipo_cliente option:selected').attr('id');
		if (id_tipo_cliente=="1")
		{
			var cliente_nacional=$('#cliente_nacional option:selected').attr('id');
			var fecha_inicio=$("#fecha_inicio").val();
			var fecha_fin=$("#fecha_fin").val();
			var stream="cliente_nacional="+cliente_nacional+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin+"&"+"id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "informes/trae_informe_notas_facturas.php",
				data:stream,
				success: function(data)	{
					if (data.indexOf("Error")==-1)
					{
						$("#cargaData").html(data);
					}
					else
					{
						alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
					}
				}			
			});
		}
		else if  (id_tipo_cliente=="2")
		{
			var cliente_internacional=$('#cliente_internacional option:selected').attr('id');
			var fecha_inicio=$("#fecha_inicio").val();
			var fecha_fin=$("#fecha_fin").val();
			var stream="cliente_internacional="+cliente_internacional+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin+"&"+"id_tipo_cliente="+id_tipo_cliente;
			$.ajax({
				type: "POST",
				url: "informes/trae_informe_notas_facturas.php",
				data:stream,
				success: function(data)	{
					if (data.indexOf("Error")==-1)
					{
						$("#cargaData").html(data);
					}
					else
					{
						alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
					}
				}			
			});
		}
	}
	$.fn.trae_informe_productos=function(){	
		if($('#list_prod_term').val()==="0") 
		{
			$("#list_prod_term").focus();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		if($('#list_prod_term').val()==="") 
		{
			$("#list_prod_term").focus();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fecha_fin").val())==="") 
		{
			$("#fecha_fin").focus();
			return false;
		}
		if($.trim($("#fecha_inicio").val())==="") 
		{
			$("#fecha_inicio").focus();
			return false;
		}
		var id_producto = $('#list_prod_term option:selected').attr('id');
		var fecha_inicio=$("#fecha_inicio").val();
		var fecha_fin=$("#fecha_fin").val();
		var stream="id_producto="+id_producto+"&"+"fecha_inicio="+fecha_inicio+"&"+"fecha_fin="+fecha_fin;
		$.ajax({
			type: "POST",
			url: "informes/trae_informe_productos.php",
			data:stream,
			success: function(data)	{
				if (data.indexOf("Error")==-1)
				{
						$("#cargaData").html(data);
				}
				else
				{
					alert ("Debe Ingresar Una Fecha Final Mayor a la de Inicio !!!!");
				}
			}			
		});
	}
});	