

 $(function(){
	 /*$( "#lista_precio" ).change(function() {
            var lista_precio=$('#lista_precio option:selected').attr('id');
            if(lista_precio=="") 
		{
			$("#lista_precio").focus ();
			$('#valida-precios').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precios').fadeOut('slow');},1000); 
			return false;
		}else{
                    //alert("hola");
                    //alert(lista_precio);
                    
                }
        });*/
	 /*******Filtra por region***********/
	 $( "#list_reg" ).change(function() {
		if($.trim($("#list_reg").val())==="") 
		{
			$("#list_reg").focus ();
			$('#valida-list_reg').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_reg').fadeOut('slow');},1000); 
			return false;
		}
                
		var id_reg = $('#list_reg option:selected').attr('id');
		//alert(id_reg);
		var stream="id_reg="+id_reg;
		$.ajax({
			type: "POST",
			url: "combos/trae_provincia.php",
			data:stream,
			success: function(data)	{	
				//alert(data);
				$('#list_prov').html("");	
				$('#list_prov').append(data);
			}			
		});
	});
	 /*******Filtra por Provincia***********/
	 $( "#list_prov" ).change(function() {
		if($.trim($("#list_prov").val())==="") 
		{
			$("#list_prov").focus ();
			$('#valida-#list_prov').fadeIn('slow'); 
			setTimeout(function(){$('#valida-#list_prov').fadeOut('slow');},1000); 
			return false;
		}
		var id_prov = $('#list_prov option:selected').attr('id');
		//alert(id_prov);
		var stream="id_prov="+id_prov;
		$.ajax({
			type: "POST",
			url: "combos/trae_comuna.php",
			data:stream,
			success: function(data)	{	
				//alert(data);
				$('#list_com').html("");	
				$('#list_com').append(data);
			}			
		});
	});
	 /*******Filtra por Comuna da prefijo sucursal aduana***********/
	 $( "#list_com" ).change(function() {
		if($.trim($("#list_com").val())==="") 
		{
			$("#list_com").focus ();
			$('#valida-list_com').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_com').fadeOut('slow');},1000); 
			return false;
		}
		//var id_prov = $('#list_prov option:selected').attr('id');
		//alert(id_prov);
		var com=$("#list_com").val()
		var stream="com="+com;
		$.ajax({
			type: "POST",
			url: "combos/trae_pref_suc_aduana.php",
			data:stream,
			success: function(data)	{	
				//alert(data);
				$('#dire').show();
				$("#dire").val(data);
				//$('#dire').html("");	
				//$('#dire').append(data);
			}			
		});
	});
	// ******************************Marcas Funciones ***********************//
	
	// **************************Ingreso*************************************//		
	$.fn.ingresa_marca=function(){
		if($.trim($("#marca").val())==="") 
		{
			$("#marca").focus ();
			$('#valida-marca').fadeIn('slow'); 
			setTimeout(function(){$('#valida-marca').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_familia2").val())==="") 
		{
			$("#list_familia2").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_ila").val())==="") 
		{
			$("#list_ila").focus ();
			$('#valida-ila').fadeIn('slow'); 
			setTimeout(function(){$('#valida-ila').fadeOut('slow');},1000); 
			return false;
		}
		var marca=$("#marca").val().toUpperCase();  
		var stream="marca="+marca;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_marca.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var marca=$("#marca").val().toUpperCase() 
					var id_familia = $('#list_familia2 option:selected').attr('id');
					var ila = $('#list_ila option:selected').attr('id');
					var stream="marca="+marca+"&"+"id_familia="+id_familia+"&"+"ila="+ila;
					$.ajax({
						type: "POST",
						url: "insert/inserta_marca.php",
						data:stream,
						success: function(data) {							
							alert (data);
							$("#marca").val ("");
							location.href = "listado_marcas.php";							
						}			
					});
				}
				else
				{
					$("#marca").focus ();
					$('#valida-marca_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-marca_r').fadeOut('slow');},1000); 
					$("#marca").val ("");
				 	return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_marca=function(){
		var id_marca = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_marca.php?id_marca="+id_marca;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_marca=function( ){		
		if($.trim($("#marca").val())==="") 
		{
			$("#marca").focus ();
			$('#valida-marca').fadeIn('slow'); 
			setTimeout(function(){$('#valida-marca').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_familia").val())==="") 
		{
			$("#list_familia").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_ila").val())==="") 
		{
			$("#list_ila").focus ();
			$('#valida-ila').fadeIn('slow'); 
			setTimeout(function(){$('#valida-ila').fadeOut('slow');},1000); 
			return false;
		}
		marca=$("#marca").val().toUpperCase();
		id_marca=$("#id_marca").val();
		var stream="marca="+marca+"&"+"id_marca="+id_marca;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_marca.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var marca=$("#marca").val().toUpperCase(); 
					var id_marca = $("#id_marca").val();
					var id_familia = $('#list_familia option:selected').attr('id');
					var ila = $('#list_ila option:selected').attr('id');
					var stream="marca="+marca+"&"+"id_familia="+id_familia+"&"+"ila="+ila+"&"+"id_marca="+id_marca;		
					$.ajax({
						type: "POST",
						url: "update/actualiza_marca.php",
						data:stream,
						success: function(data)	{								
							alert (data);
							$("#marca").val ("");
							location.href = "listado_marcas.php";													
						}			
					});
				}
				else
				{
					$("#marca").focus ();
					$('#valida-marca_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-marca_r').fadeOut('slow');},1000); 
					$("#marca").val ("");
				 	return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_marca=function(){
		var id_marca = $(this).parents('tr').find("td").attr('id');
		var stream="id_marca="+id_marca;
		var action = confirm('Esta seguro que desea eliminar esta Marca?');
		if(action==true)
		{
			var stream="id_marca="+id_marca;
			$.ajax({
				type: "POST",
				url: "delete/borra_marca.php",
				data:stream,
				success: function(data)	{
					alert (data);
					location.href = "listado_marcas.php";
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************Familias Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_familia=function(){
		if($.trim($("#familia").val())==="") 
		{
			$("#familia").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cod_familia").val())==="") 
		{
			$("#cod_familia").focus ();
			$('#valida-cod_familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_familia').fadeOut('slow');},1000); 
			return false;
		}
		var familia=$("#familia").val().toUpperCase();
		var id_familia="";
		var id_sector =$("#id_sector").val();
		var stream="familia="+familia+"&"+"id_sector="+id_sector+"&"+"id_familia="+id_familia;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_familia.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					var familia=$("#familia").val().toUpperCase(); 
					var cod_familia=$("#cod_familia").val().toUpperCase(); 
					var id_sector =$("#id_sector").val();
					var stream="familia="+familia+"&"+"cod_familia="+cod_familia+"&"+"id_sector="+id_sector;			 
					$.ajax({
						type: "POST",
						url: "insert/inserta_familia.php",
						data:stream,
						success: function(data){							
							alert (data);
							location.href = "listado_Familias.php";							
						}			
					});
				}
				else
				{
					$("#familia").focus ();
					$('#valida-familia_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-familia_reg').fadeOut('slow');},1000); 
					$("#familia").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_familia=function( ){
		var id_familia = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_familia.php?id_familia="+id_familia;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_familia=function( ){			
		if($.trim($("#familia").val())==="") 
		{
			$("#familia").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cod_familia").val())==="") 
		{
			$("#cod_familia").focus ();
			$('#valida-cod_familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_familia').fadeOut('slow');},1000); 
			return false;
		}
		var familia=$("#familia").val().toUpperCase();
		var id_familia=$("#id_familia").val();
		var id_sector =$("#id_sector").val();
		var stream="familia="+familia+"&"+"id_familia="+id_familia+"&"+"id_sector="+id_sector;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_familia.php",
			data:stream,
			success: function(data){
				if (data.indexOf("Error")==-1)
				{	
					var id_familia=$("#id_familia").val(); 
					var familia=$("#familia").val().toUpperCase(); 
					var cod_familia=$("#cod_familia").val().toUpperCase(); 
					var stream="familia="+familia+"&"+"cod_familia="+cod_familia+"&"+"id_familia="+id_familia;			 
					$.ajax({
						type: "POST",
						url: "update/actualiza_familia.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_Familias.php";							
						}			
					});
				}
				else
				{
					$("#familia").focus ();
					$('#valida-familia_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-familia_reg').fadeOut('slow');},1000); 
					$("#familia").val ("");
			 		return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.boora_familia=function(){
		var id_familia = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar esta Familia?');
		if(action==true)
		{
			var stream="id_familia="+id_familia;
			$.ajax({
				type: "POST",
				url: "delete/borra_familia.php",
				data:stream,
				success: function(data)
				{
					alert (data);
					location.href = "listado_Familias.php";						
				}			
			});
		}
	}
	// ****************************************************************//
	//*****************Sub familia************************************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_subfamilia=function(){
		if($.trim($("#list_familia").val())==="") 
		{
			$("#list_familia").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 				 
			return false;
		}
		if($.trim($("#subfamilia").val())==="") 
		{
			$("#subfamilia").focus ();
			$('#valida-subfamilia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-subfamilia').fadeOut('slow');},1000);
			return false;
		}
		var subfamilia=$("#subfamilia").val().toUpperCase();
		var stream="subfamilia="+subfamilia;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_subfamilia.php",
			data:stream,
			success: function(data){
		 		if (data.indexOf("Error")==-1)
				{	
					var id_familia = $('#list_familia option:selected').attr('id');
					var subfamilia=$("#subfamilia").val().toUpperCase(); 
					var stream="id_familia="+id_familia+"&"+"subfamilia="+subfamilia;			 
					$.ajax({
						type: "POST",
						url: "insert/inserta_subfamilia.php",
						data:stream,
						success: function(data) {							
							alert (data);
						 	location.href = "listado_Sub_Familias.php";							
						}			
					});
				}
				else
				{
					$("#subfamilia").focus ();
					$('#valida-subfamilia_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-subfamilia_reg').fadeOut('slow');},1000); 
					$("#subfamilia").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_subfamilia=function(){
		var id_subfamilia = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_subfamilia.php?id_subfamilia="+id_subfamilia;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_subfamilia=function( ){		
		
		if($.trim($("#list_familia").val())==="") 
		{
			$("#list_familia").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#subfamilia").val())==="") 
		{
			$("#subfamilia").focus ();
			$('#valida-subfamilia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-subfamilia').fadeOut('slow');},1000); 
			return false;
		}
		var subfamilia=$("#subfamilia").val().toUpperCase();
		var id_subfamilia=$("#id_subfamilia").val();
		var stream="subfamilia="+subfamilia+"&"+"id_subfamilia="+id_subfamilia;	
		
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_subfamilia.php",
			data:stream,
			success: function(data){
		 		if (data.indexOf("Error")==-1)
				{	
					var id_subfamilia=$("#id_subfamilia").val().toUpperCase(); 
					var id_familia = $('#list_familia option:selected').attr('id');
					var subfamilia=$("#subfamilia").val().toUpperCase(); 
					var stream="id_subfamilia="+id_subfamilia+"&"+"id_familia="+id_familia+"&"+"subfamilia="+subfamilia;
		
					$.ajax({
						type: "POST",
						url: "update/actualiza_subfamilia.php",
						data:stream,
						success: function(data)
						{							
							alert (data);
					 		location.href = "listado_sub_Familias.php";							
						}			
					});
				}
				else
				{
					$("#subfamilia").focus ();
					$('#valida-subfamilia_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-subfamilia_reg').fadeOut('slow');},1000); 
					$("#subfamilia").val ("");
				 	return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_subfamilia=function(){
		var id_subfamilia = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar esta SubFamilia?');
		if(action==true)
		{
			var stream="id_subfamilia="+id_subfamilia;
			$.ajax({
				type: "POST",
				url: "delete/borra_subfamilia.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_sub_Familias.php";						
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************Colores Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_color=function(){
		if($.trim($("#color").val())==="") 
		{
			$("#color").focus ();
			$('#valida-color').fadeIn('slow'); 
			setTimeout(function(){$('#valida-color').fadeOut('slow');},1000); 
			return false;
		}
		var color=$("#color").val().toUpperCase();  
		var stream="color="+color;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_color.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var color=$("#color").val().toUpperCase(); 
					var stream="color="+color;			
					$.ajax({
						type: "POST",
						url: "insert/inserta_color.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_colores.php";							
						}			
					});
				}
				else
				{
					$("#color").focus ();
					$('#valida-color_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-color_r').fadeOut('slow');},1000); 
					$("#color").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_color=function()	{
		var id_color = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_color.php?id_color="+id_color;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_color=function( ){		
		if($.trim($("#color").val())==="") 
		{
			$("#color").focus ();
			$('#valida-color').fadeIn('slow'); 
			setTimeout(function(){$('#valida-color').fadeOut('slow');},1000); 
			return false;
		}
		var color=$("#color").val().toUpperCase();
		var id_color=$("#id_color").val();
		var stream="color="+color+"&"+"id_color="+id_color;			
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_color.php",
			data:stream,
			success: function(data){
		 		if (data.indexOf("Error")==-1)
				{	
					var color=$("#color").val().toUpperCase();
					var id_color=$("#id_color").val();
					var stream="color="+color+"&"+"id_color="+id_color;		
					$.ajax({
						type: "POST",
						url: "update/actualiza_color.php",
						data:stream,
						success: function(data)
						{							
							alert (data);
					 		location.href = "listado_colores.php";							
						}			
					});
				}
				else
				{
					$("#color").focus ();
					$('#valida-color_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-color_r').fadeOut('slow');},1000); 
					$("#color").val ("");
				 	return false;
				}
			}			
		});
	}
		// **************************Eliminar *************************************//
	$.fn.eliminar_color=function(){
		var id_color = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Color?');
		if(action==true)
		{
			var stream="id_color="+id_color;
			$.ajax({
				type: "POST",
				url: "delete/borra_color.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_colores.php";						
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************Materiales Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_material=function(){
		if($.trim($("#material").val())==="") 
		{
			$("#material").focus ();
			$('#valida-material').fadeIn('slow'); 
			setTimeout(function(){$('#valida-material').fadeOut('slow');},1000); 
			return false;
		}
		var material=$("#material").val().toUpperCase();  
		var stream="material="+material;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_material.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var material=$("#material").val().toUpperCase(); 
					var stream="material="+material;			
					$.ajax({
						type: "POST",
						url: "insert/inserta_material.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_materiales.php";							
						}			
					});
				}
				else
				{
					$("#material").focus ();
					$('#valida-material_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-material_r').fadeOut('slow');},1000); 
					$("#material").val ("");
					return false;
				}
			}			
		});
	}	
	// **************************Actualiza*************************************//		
	$.fn.actualiza_material=function(){
		var id_material = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_material.php?id_material="+id_material;
	}
		// **************************Eliminar *************************************//
	$.fn.eliminar_material=function(){
		var id_material = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Material?');
		if(action==true)
		{
			var stream="id_material="+id_material;
			$.ajax({
				type: "POST",
				url: "delete/borra_material.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_materiales.php";						
				}			
			});
		}
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_material=function( ){		
		
		if($.trim($("#material").val())==="") 
		{
			$("#material").focus ();
			$('#valida-material').fadeIn('slow'); 
			setTimeout(function(){$('#valida-material').fadeOut('slow');},1000); 
			return false;
		}
		var material=$("#material").val().toUpperCase();
		var id_material=$("#id_material").val();
		var stream="material="+material+"&"+"id_material="+id_material;			
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_material.php",
			data:stream,
			success: function(data){
		 		if (data.indexOf("Error")==-1)
				{	
					var material=$("#material").val().toUpperCase();
					var id_material=$("#id_material").val();
					var stream="material="+material+"&"+"id_material="+id_material;		
					$.ajax({
						type: "POST",
						url: "update/actualiza_material.php",
						data:stream,
						success: function(data)
						{							
							alert (data);
					 		location.href = "listado_materiales.php";							
						}			
					});
				}
				else
				{
					$("#material").focus ();
					$('#valida-material_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-material_r').fadeOut('slow');},1000); 
					$("#material").val ("");
				 	return false;
				}
			}			
		});
	}
	// ****************************************************************//
	// ******************************Talla Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_talla=function(){
		if($.trim($("#talla").val())==="") 
		{
			$("#talla").focus ();
			$('#valida-talla').fadeIn('slow'); 
			setTimeout(function(){$('#valida-talla').fadeOut('slow');},1000); 
			return false;
		}
		var talla=$("#talla").val().toUpperCase();  
		var stream="talla="+talla;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_talla.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var talla=$("#talla").val().toUpperCase(); 
					var stream="talla="+talla;			
					$.ajax({
						type: "POST",
						url: "insert/inserta_talla.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_tallas.php";							
						}			
					});
				}
				else
				{
					$("#talla").focus ();
					$('#valida-talla_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-talla_r').fadeOut('slow');},1000); 
					$("#talla").val ("");
					return false;
				}
			}			
		});
	}	
	// **************************Actualiza*************************************//		
	$.fn.actualiza_talla=function(){
		var id_talla = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_talla.php?id_talla="+id_talla;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_talla=function( ){		
		if($.trim($("#talla").val())==="") 
		{
			$("#talla").focus ();
			$('#valida-talla').fadeIn('slow'); 
			setTimeout(function(){$('#valida-talla').fadeOut('slow');},1000); 
			return false;
		}
		var talla=$("#talla").val().toUpperCase();
		var id_talla=$("#id_talla").val();
		var stream="talla="+talla+"&"+"id_talla="+id_talla;		
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_talla.php",
			data:stream,
			success: function(data){
		 		if (data.indexOf("Error")==-1)
				{	
					var talla=$("#talla").val().toUpperCase();
					var id_talla=$("#id_talla").val();
					var stream="talla="+talla+"&"+"id_talla="+id_talla;		
					$.ajax({
						type: "POST",
						url: "update/actualiza_talla.php",
						data:stream,
						success: function(data)
						{							
							alert (data);
					 		location.href = "listado_tallas.php";							
						}			
					});
				}
				else
				{
					$("#talla").focus ();
					$('#valida-talla_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-talla_r').fadeOut('slow');},1000); 
					$("#talla").val ("");
				 	return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_talla=function(){
		var id_talla = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar esta Talla?');
		if(action==true)
		{
			var stream="id_talla="+id_talla;
			$.ajax({
				type: "POST",
				url: "delete/borra_talla.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_tallas.php";						
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************Genero Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_genero=function(){
		if($.trim($("#genero").val())==="") 
		{
			$("#genero").focus ();
			$('#valida-genero').fadeIn('slow'); 
			setTimeout(function(){$('#valida-genero').fadeOut('slow');},1000); 
			return false;
		}
		var genero=$("#genero").val().toUpperCase();  
		var stream="genero="+genero;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_genero.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var genero=$("#genero").val().toUpperCase(); 
					var stream="genero="+genero;			
					$.ajax({
						type: "POST",
						url: "insert/inserta_genero.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_generos.php";							
						}			
					});
				}
				else
				{
					$("#genero").focus ();
					$('#valida-genero_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-genero_r').fadeOut('slow');},1000); 
					$("#genero").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_genero=function(){
		var id_genero = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_genero.php?id_genero="+id_genero;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_genero=function( ){		
		if($.trim($("#genero").val())==="") 
		{
			$("#genero").focus ();
			$('#valida-genero').fadeIn('slow'); 
			setTimeout(function(){$('#valida-genero').fadeOut('slow');},1000); 
			return false;
		}
		var genero=$("#genero").val().toUpperCase();
		var id_genero=$("#id_genero").val();
		var stream="genero="+genero+"&"+"id_genero="+id_genero;		
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_genero.php",
			data:stream,
			success: function(data){
		 		if (data.indexOf("Error")==-1)
				{	
					var genero=$("#genero").val().toUpperCase();
					var id_genero=$("#id_genero").val();
					var stream="genero="+genero+"&"+"id_genero="+id_genero;		
					$.ajax({
						type: "POST",
						url: "update/actualiza_genero.php",
						data:stream,
						success: function(data)
						{							
							alert (data);
					 		location.href = "listado_generos.php";							
						}			
					});
				}
				else
				{
					$("#genero").focus ();
					$('#valida-genero_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-genero_r').fadeOut('slow');},1000); 
					$("#genero").val ("");
				 	return false;
				}
			}			
		});
	}
		// **************************Eliminar *************************************//
	$.fn.eliminar_genero=function(){
		var id_genero = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Genero?');
		if(action==true)
		{
			var stream="id_genero="+id_genero;
			$.ajax({
				type: "POST",
				url: "delete/borra_genero.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_generos.php";						
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************Formato Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_formato=function(){
		
                if($.trim($("#display").val())==="") 
                {
                    $("#display").focus ();
                    $('#valida-display').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-display').fadeOut('slow');},1000); 
                    return false;
                }
                if($.trim($("#display").val())==="0") 
                {
                    $("#display").focus ();
                    $('#valida-display2').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-display2').fadeOut('slow');},1000); 
                    $("#display").val ("");
                    return false;
                }
                if($.trim($("#sobre").val())==="") 
                {
                    $("#sobre").focus ();
                    $('#valida-sobre').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-sobre').fadeOut('slow');},1000); 
                    return false;
                }
                if($.trim($("#sobre").val())==="0") 
                {
                    $("#sobre").focus ();
                    $('#valida-sobre2').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-sobre2').fadeOut('slow');},1000); 
                    $("#sobre").val ("");
                    return false;
                }
                if($.trim($("#contenido").val())==="") 
                {
                    $("#contenido").focus ();
                    $('#valida-contenido').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-contenido').fadeOut('slow');},1000); 
                    return false;
                }
                if($.trim($("#contenido").val())==="0") 
                {
                    $("#contenido").focus ();
                    $('#valida-contenido2').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-contenido2').fadeOut('slow');},1000); 
                    $("#contenido").val ("");
                    return false;
                }
                var list_umed = $('#list_umed option:selected').attr('id');
                        //alert(list_umed);
                if(list_umed===undefined) 
                {
                    $("#list_umed").focus ();
                    $('#valida-list_umed').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-list_umed').fadeOut('slow');},1000); 
                    return false;
                }
                if($.trim($("#formato").val())==="") 
		{
			$("#formato").focus ();
			$('#valida-formato').fadeIn('slow'); 
			setTimeout(function(){$('#valida-formato').fadeOut('slow');},1000); 
			$("#formato").val ("");
			return false;
		}
                var dis=$("#display").val();
                var sob=$("#sobre").val();
                var con=$("#contenido").val();
		var formato=$("#formato").val().toUpperCase();  
		var stream="formato="+formato;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_formato.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					//var formato=$("#formato").val().toUpperCase(); 
                                        var formato=$("#formato").val(); 
					var stream="formato="+formato
                                                +"&"+"dis="+dis
                                                +"&"+"sob="+sob
                                                +"&"+"con="+con
                                                +"&"+"list_umed="+list_umed;
					$.ajax({
						type: "POST",
						url: "insert/inserta_formato.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_formatos.php";							
						}			
					});
				}
				else
				{
					$("#formato").focus ();
					$('#valida-formato_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-formato_r').fadeOut('slow');},1000); 
					$("#formato").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_formato=function(){
		var id_formato = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_formato.php?id_formato="+id_formato;
	}
		// ********************Actualiza*******************************************//
	$.fn.actualizar_formato=function( ){		
		if($.trim($("#formato").val())==="") 
		{
			$("#formato").focus ();
			$('#valida-formato').fadeIn('slow'); 
			setTimeout(function(){$('#valida-formato').fadeOut('slow');},1000); 
			$("#formato").val ("");
			return false;
		}
		var formato=$("#formato").val().toUpperCase();
		var id_formato =$("#id_formato").val() ;
		var stream="formato="+formato+"&"+"id_formato="+id_formato;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_formato.php",
			data:stream,
				success: function(data) {							
				if (data.indexOf("Error")==-1)
				{	
					var id_formato =$("#id_formato").val();
					var formato=$("#formato").val().toUpperCase();
					var stream="formato="+formato+"&"+"id_formato="+id_formato;			
					$.ajax({
						type: "POST",
						url: "update/actualiza_formato.php",
						data:stream,
						success: function(data)
						{								
							alert (data);
							$("#marca").val ("");
							location.href = "listado_formatos.php";													
						}			
					});
				}
				else
				{
					$("#formato").focus ();
					$('#valida-formato_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-formato_r').fadeOut('slow');},1000); 
					$("#formato").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_formato=function(){
		var id_formato= $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Formato?');
		if(action==true)
		{
			var stream="id_formato="+id_formato;
			$.ajax({
				type: "POST",
				url: "delete/borra_formato.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_formatos.php";						
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************umed Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_umed=function(){
		if($.trim($("#umed").val())==="") 
		{
			$("#umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			$("#umed").val ("");
			return false;
		}
		var umed=$("#umed").val().toUpperCase();
		var stream="umed="+umed;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_umed.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var umed=$("#umed").val().toUpperCase();
					var stream="umed="+umed;			
					$.ajax({
						type: "POST",
						url: "insert/inserta_umed.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_unidades_de_medida.php";							
						}			
					});
				}
				else
				{
					$("#umed").focus ();
					$('#valida-umed_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-umed_r').fadeOut('slow');},1000); 
					$("#umed").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_umed=function()
	{
		var id_umed = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_umed.php?id_umed="+id_umed;
	}
		// ********************Actualiza*******************************************//
	$.fn.actualizar_umed=function( ){		
		if($.trim($("#umed").val())==="") 
		{
			$("#umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			$("#umed").val ("");
			return false;
		}
		var umed=$("#umed").val().toUpperCase();
		var id_umed =$("#id_umed").val() ;
		var stream="umed="+umed+"&"+"id_umed="+id_umed;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_umed.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var id_umed =$("#id_umed").val();
					var umed=$("#umed").val().toUpperCase();
					var stream="id_umed="+id_umed+"&"+"umed="+umed;			
					$.ajax({
						type: "POST",
						url: "update/actualiza_umed.php",
						data:stream,
						success: function(data){								
							alert (data);
							$("#umed").val ("");
							location.href = "listado_unidades_de_medida.php";													
						}			
					});
				}
				else
				{
					$("#umed").focus ();
					$('#valida-umed_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-umed_r').fadeOut('slow');},1000); 
					$("#umed").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_umed=function(){
		var id_umed= $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar esta Unidad de Medida?');
		if(action==true)
		{
			var stream="id_umed="+id_umed;
			$.ajax({
				type: "POST",
				url: "delete/borra_umed.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_unidades_de_medida.php";						
				}			
			});
		}
	}
	// ******************************Sabores Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_sabor=function(){
	 	if($.trim($("#sabor_esp").val())==="") 
		{
			$("#sabor_esp").focus ();
			$('#valida-sabor_esp').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sabor_esp').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#sabor_ing").val())==="") 
		{
			$("#sabor_ing").focus ();
			$('#valida-sabor_ing').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sabor_ing').fadeOut('slow');},1000); 
			return false;
		}
		var sabor_esp=$("#sabor_esp").val().toUpperCase();
		var id_sabor="";
		var stream="sabor_esp="+sabor_esp+"&"+"id_sabor="+id_sabor;
	 	$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_sabor_esp.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{	
					var sabor_ing=$("#sabor_ing").val().toUpperCase();
					var id_sabor="";
					var stream="sabor_ing="+sabor_ing+"&"+"id_sabor="+id_sabor;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_sabor_ing.php",
						data:stream,
						success: function(data) {	
							if (data.indexOf("Error")==-1)
							{	
								var sabor_ing=$("#sabor_ing").val().toUpperCase(); 
								var sabor_esp=$("#sabor_esp").val().toUpperCase();
								var stream="sabor_ing="+sabor_ing+"&"+"sabor_esp="+sabor_esp;			
								$.ajax({
									type: "POST",
									url: "insert/inserta_sabor.php",
									data:stream,
									success: function(data) {							
										alert (data);
										location.href = "listado_sabores.php";							
									}			
								});				
							}
							else
							{								
								$("#sabor_ing").focus ();
								$('#valida-sabor_reg_ing').fadeIn('slow'); 
								setTimeout(function(){$('#valida-sabor_reg_ing').fadeOut('slow');},1000); 
								$("#sabor_ing").val ("");
								return false;
							}
						}
					}); 	
				}
				else
				{
					$("#sabor_esp").focus ();
					$('#valida-sabor_reg_esp').fadeIn('slow'); 
					setTimeout(function(){$('#valida-sabor_reg_esp').fadeOut('slow');},1000); 
					$("#sabor_esp").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_sabor=function()	{
		var id_sabor = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_sabor.php?id_sabor="+id_sabor;
	}
	// **************************Actualizar*************************************//		
	$.fn.actualizar_sabor=function(){
	 	if($.trim($("#sabor_esp").val())==="") 
		{
			$("#sabor_esp").focus ();
			$('#valida-sabor_esp').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sabor_esp').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#sabor_ing").val())==="") 
		{
			$("#sabor_ing").focus ();
			$('#valida-sabor_ing').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sabor_ing').fadeOut('slow');},1000); 
			return false;
		}
		var sabor_esp=$("#sabor_esp").val().toUpperCase();
		var id_sabor=$("#id_sabor").val();
		var stream="sabor_esp="+sabor_esp+"&"+"id_sabor="+id_sabor;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_sabor_esp.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{	
					var sabor_ing=$("#sabor_ing").val().toUpperCase();
					var id_sabor=$("#id_sabor").val();
					var stream="sabor_ing="+sabor_ing+"&"+"id_sabor="+id_sabor;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_sabor_ing.php",
						data:stream,
						success: function(data) {	
							if (data.indexOf("Error")==-1)
							{	
								var sabor_ing=$("#sabor_ing").val().toUpperCase(); 
								var sabor_esp=$("#sabor_esp").val().toUpperCase();
								var id_sabor=$("#id_sabor").val();
								var stream="sabor_ing="+sabor_ing+"&"+"sabor_esp="+sabor_esp+"&"+"id_sabor="+id_sabor;			
								$.ajax({
									type: "POST",
									url: "update/actualiza_sabor.php",
									data:stream,
									success: function(data) {							
										alert (data);
										location.href = "listado_sabores.php";							
									}			
								});					
							}
							else
							{								
								$("#sabor_ing").focus ();
								$('#valida-sabor_reg_ing').fadeIn('slow'); 
								setTimeout(function(){$('#valida-sabor_reg_ing').fadeOut('slow');},1000); 
								$("#sabor_ing").val ("");
								return false;
							}
						}
					});			
				}
				else
				{
					$("#sabor_esp").focus ();
					$('#valida-sabor_reg_ing').fadeIn('slow'); 
					setTimeout(function(){$('#valida-sabor_reg_ing').fadeOut('slow');},1000); 
					$("#sabor_esp").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_sabor=function(){
		var id_sabor= $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Sabor?');
		if(action==true)
		{
			var stream="id_sabor="+id_sabor;
			$.ajax({
				type: "POST",
				url: "delete/borra_sabor.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_sabores.php";						
				}			
			});
		}
	}
		// ******************************Productos Matantencion ***********************//
	// **************************Select Familia on change producto de Matencion *************************************//	
	$.fn.select_familia=function(){
		$('#codigo').hide();
		$("#cod_prod_mant").val("");
		var id_familia = $('#list_familia_mant option:selected').attr('id');
		var cod_producto_mant="mante";
		var cod_producto_mant=(cod_producto_mant+"_"+id_familia);
		var stream="cod_producto_mant="+cod_producto_mant;
		$.ajax({
			type: "POST",
			url: "select/trae_id_producto.php",
			data:stream,
			success: function(data)	{
				$('#codigo').show();
				$("#cod_prod_mant").val(data);		 			
			}	
		});
	}
	// *************************Ingresa Los Productos de Mantecion a la Base*************************************//	
	$.fn.ingresa_producto_mant=function(){
		if($.trim($("#producto_mant").val())==="") 
		{
			$("#producto_mant").focus ();
			$('#valida-producto_mant').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto_mant').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_familia_mant").val())==="") 
		{
			$("#list_familia_mant").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#costo_producto_mant").val())==="") 
		{
			$("#costo_producto_mant").focus ();
			$('#valida-costo_producto_mant').fadeIn('slow'); 
			setTimeout(function(){$('#valida-costo_producto_mant').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cod_prod_mant").val())==="") 
		{
			$("#cod_prod_mant").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		var nom_prod=$("#producto_mant").val();
		var stream="nom_prod="+nom_prod+"&"+"id_producto=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{	
					var cod_prod=$("#cod_prod_mant").val();	
					var stream="cod_prod="+cod_prod;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_codigo_producto.php",
						data:stream,
						success: function(data) {					
							if (data.indexOf("Error")==-1)
							{	
								var nom_prod=$("#producto_mant").val();
								var id_familia=$('#list_familia_mant option:selected').attr('id');
								var costo=$("#costo_producto_mant").val();
								var id_sector=1;
								var stream="nom_prod="+nom_prod+"&"+"cod_prod="+cod_prod+"&"+"id_familia="+id_familia
									+"&"+"costo="+costo+"&"+"id_sector="+id_sector;					
								$.ajax({
									type: "POST",
									url: "insert/inserta_producto.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_productos_mantencion.php";						
									}			
								});							
							}
							else
							{
								$('#valida-cod_prod_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cod_prod_r').fadeOut('slow');},1000); 
							}
						 }	
					});
				}
				else
				{
					$('#valida-producto_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-producto_r').fadeOut('slow');},1000); 
				}
			 }			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_productos_mantencion=function()	{
		var id_prod_mant = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_productos_mantencion.php?id_prod_mant="+id_prod_mant;
	}
	// *************************Actualiza Los Productos de Mantecion a la Base*************************************//	
	$.fn.actualizar_producto_mant=function(){
		if($.trim($("#producto_mant").val())==="") 
		{
			$("#producto_mant").focus ();
			$('#valida-producto_mant').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto_mant').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#familias").val())==="") 
		{
			$("#familias").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#costo_producto_mant").val())==="") 
		{
			$("#costo_producto_mant").focus ();
			$('#valida-costo_producto_mant').fadeIn('slow'); 
			setTimeout(function(){$('#valida-costo_producto_mant').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cod_prod_mant").val())==="") 
		{
			$("#cod_prod_mant").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#sector_prod").val())==="") 
		{
			$("#sector_prod").focus ();
			$('#valida-sector').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sector').fadeOut('slow');},1000); 
			return false;
		}	
		var nom_prod=$("#producto_mant").val();
		var id_producto=$("#id_prod_mant").val();		
		var stream="nom_prod="+nom_prod+"&"+"id_producto="+id_producto;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{	
					var cod_prod=$("#cod_prod_mant").val();
					var nom_prod=$("#producto_mant").val();
					var id_producto=$("#id_prod_mant").val();
					var id_familia=$('#familias option:selected').attr('id');
					var id_sector=$('#sector_prod option:selected').attr('id');
					var costo=$("#costo_producto_mant").val();
					var sector=1;
					var stream="nom_prod="+nom_prod+"&"+"cod_prod="+cod_prod+"&"+"id_familia="+id_familia+"&"+"costo="+costo
						+"&"+"sector="+sector+"&"+"id_producto="+id_producto+"&"+"id_sector="+id_sector;					
					$.ajax({
						type: "POST",
						url: "update/actualiza_producto_mantencion.php",
						data:stream,
						success: function(data){
							alert (data);
							location.href = "listado_productos_mantencion.php";						
						}			
					});
				}
				else
				{
					$('#valida-producto_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-producto_r').fadeOut('slow');},1000); 
				}
			 }	
		});
	}
	
	// **************************Eliminar *************************************//
	$.fn.eliminar_producto=function(){
		var id_producto= $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este producto?');
		if(action==true)
		{
			var stream="id_producto="+id_producto;
			$.ajax({
				type: "POST",
				url: "delete/borra_producto.php",
				data:stream,
				success: function(data){
					alert (data);
					location.reload();					
				}			
			});
		}
	}
		// ******************************Productos Oficina ***********************//
	// **************************Select Umed on change producto de Oficina *************************************//	
	$.fn.select_umed=function(){
		if($.trim($("#list_familia_of").val())==="") 
		{
			$("#list_familia_of").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			$("#list_umed").val ("");
			return false;
		}	
		$('#codigo').hide();
		$("#cod_prod_of").val("");
		$("#cod_prod_of").val("ofic");
		var id_familia = $('#list_familia_of option:selected').attr('id');
		var cod_producto_mant=$("#cod_prod_of").val();
		var id_umed = $('#list_umed option:selected').attr('id');
		var cod_producto_mant=(cod_producto_mant+"_"+id_familia+id_umed);
		var stream="cod_producto_mant="+cod_producto_mant;
		$.ajax({
			type: "POST",
			url: "select/trae_id_producto.php",
			data:stream,
			success: function(data)	{
				$('#codigo').show();
				$("#cod_prod_of").val(data);		 			
			}	
		});
	}
	// *************************Ingresa Los Productos de Oficina a la Base*************************************//	
	$.fn.ingresa_producto_ofi=function(){
		if($.trim($("#producto_of").val())==="") 
		{
			$("#producto_of").focus ();
			$('#valida-producto_of').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto_of').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_umed").val())==="") 
		{
			$("#list_umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_familia_of").val())==="") 
		{
			$("#list_familia_of").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#costo_producto_of").val())==="") 
		{
			$("#costo_producto_of").focus ();
			$('#valida-costo_producto_of').fadeIn('slow'); 
			setTimeout(function(){$('#valida-costo_producto_of').fadeOut('slow');},1000); 
			return false;
		}		
		if($.trim($("#cod_prod_of").val())==="") 
		{
			$("#cod_prod_of").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		var nom_prod=$("#producto_of").val();
		var stream="nom_prod="+nom_prod+"&"+"id_producto=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{	
					var cod_prod=$("#cod_prod_of").val();	
					var stream="cod_prod="+cod_prod;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_codigo_producto.php",
						data:stream,
						success: function(data) {					
							if (data.indexOf("Error")==-1)
							{	
								var nom_prod=$("#producto_of").val();
								var id_familia=$('#list_familia_of option:selected').attr('id');
								var costo=$("#costo_producto_of").val();
								var id_umed=$('#list_umed option:selected').attr('id');
								var id_sector=2;
								var stream="nom_prod="+nom_prod+"&"+"cod_prod="+cod_prod+"&"+"id_familia="+id_familia
									+"&"+"costo="+costo+"&"+"id_umed="+id_umed+"&"+"id_sector="+id_sector;					
								$.ajax({
									type: "POST",
									url: "insert/inserta_producto.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_productos_oficina.php";						
									}			
								});							
							}
							else
							{
								$('#valida-cod_prod_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cod_prod_r').fadeOut('slow');},1000); 
							}
						 }	
					});
				}
				else
				{
					$('#valida-producto_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-producto_r').fadeOut('slow');},1000); 
				}
			 }			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_productos_oficina=function()	{
		var id_prod_of = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_productos_oficina.php?id_prod_of="+id_prod_of;
	}
	// *************************Actualiza Los Productos de Oficina a la Base*************************************//	
	$.fn.actualizar_producto_of=function(){
		if($.trim($("#producto").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#familias").val())==="") 
		{
			$("#familias").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#costo_producto").val())==="") 
		{
			$("#costo_producto").focus ();
			$('#valida-costo_producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-costo_producto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#cod_prod").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#select_umed").val())==="") 
		{
			$("#select_umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#sector_prod").val())==="") 
		{
			$("#sector_prod").focus ();
			$('#valida-sector').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sector').fadeOut('slow');},1000); 
			return false;
		}	
		var nom_prod=$("#producto").val();
		var id_producto=$("#id_prod_of").val();		
		var stream="nom_prod="+nom_prod+"&"+"id_producto="+id_producto;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{	
					var cod_prod=$("#cod_prod").val();
					var nom_prod=$("#producto").val();
					var id_producto=$("#id_prod_of").val();
					var id_familia=$('#familias option:selected').attr('id');
					var costo=$("#costo_producto").val();
					var id_sector=$('#sector_prod option:selected').attr('id');
	 				var id_umed=$('#select_umed option:selected').attr('id');
					var stream="nom_prod="+nom_prod+"&"+"cod_prod="+cod_prod+"&"+"id_familia="+id_familia+"&"+"costo="+costo
						+"&"+"id_sector="+id_sector+"&"+"id_producto="+id_producto+"&"+"id_umed="+id_umed;					
					$.ajax({
						type: "POST",
						url: "update/actualiza_producto_oficina.php",
						data:stream,
						success: function(data){
							alert (data);
							location.href = "listado_productos_oficina.php";						
						}			
					});
				}
				else
				{
					$('#valida-producto_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-producto_r').fadeOut('slow');},1000); 
				}
			 }	
		});
	}
		// **************************Select Familia pop que desactiva los select de genero y talla *************************************//
	$.fn.select_familia_pop=function(){
		var familia=$('#list_familia_pop option:selected').val();
		if (familia=='VESTUARIO')
		{
			$('#list_tallas').prop('disabled', false);
			$("#list_genero").prop('disabled', false);				
		}
		else
		{
			$('#list_tallas').prop('disabled', true);
			$("#list_genero").prop('disabled', true);
		}
		var id_familia=$('#list_familia_pop option:selected').attr('id');
		var stream="id_familia="+id_familia;
		$.ajax({
			type: "POST",
			url: "select/trae_select_subfamilia.php",
			data:stream,
			success: function(data)	{
				$('#subfamillia').empty();
				$('#subfamillia').append(data);
 			}	
		});
	}
		// *************************Ingresa Los Productos de Oficina a la Base*************************************//	
	$.fn.ingresa_producto_pop=function(){
		if($.trim($("#producto").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_familia_pop").val())==="") 
		{
			$("#list_familia_pop").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		var familia=$('#list_familia_pop option:selected').val();
		if (familia=='VESTUARIO')
		{
			if($.trim($("#list_tallas").val())==="") 
			{
				$("#list_tallas").focus ();
				$('#valida-talla').fadeIn('slow'); 
				setTimeout(function(){$('#valida-talla').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#list_genero").val())==="") 
			{
				$("#list_genero").focus ();
				$('#valida-genero').fadeIn('slow'); 
				setTimeout(function(){$('#valida-genero').fadeOut('slow');},1000); 
				return false;
			}
			var id_talla=$('#list_tallas option:selected').attr('id');
			var id_genero=$('#list_genero option:selected').attr('id');
		}
		else
		{
			var id_talla=0;
			var id_genero=0;
		}
		if($.trim($("#list_umed").val())==="") 
		{
			$("#list_umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#Subfamilia").val())==="") 
		{
			$("#Subfamilia").focus ();
			$('#valida-subfamila').fadeIn('slow'); 
			setTimeout(function(){$('#valida-subfamila').fadeOut('slow');},1000); 
			return false;
		}
		var nom_prod=$("#producto").val();
		var stream="nom_prod="+nom_prod+"&"+"id_producto=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{	
					var cod_prod=$("#cod_prod").val();	
					var stream="cod_prod="+cod_prod;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_codigo_producto.php",
						data:stream,
						success: function(data) {					
							if (data.indexOf("Error")==-1)
							{	
								var nom_prod=$("#producto").val();
								var cod_prod=$("#cod_prod").val();	
								var id_material=$('#list_material option:selected').attr('id');
								var id_color=$('#list_color option:selected').attr('id');
								var id_marca=$('#list_marc option:selected').attr('id');
								var id_formato=$('#list_formatos option:selected').attr('id');
								var id_familia=$('#list_familia_pop option:selected').attr('id');
								var id_umed=$('#list_umed option:selected').attr('id');
								var id_subfamilia=$('#Subfamilia option:selected').attr('id');
								var id_sector=3;
								var stream="nom_prod="+nom_prod+"&"+"cod_prod="+cod_prod+"&"+"id_material="+id_material+"&"+"id_color="+id_color
									+"&"+"id_marca="+id_marca+"&"+"id_subfamilia="+id_subfamilia+"&"+"id_formato="+id_formato+"&"+"id_familia="+id_familia
									+"&"+"id_talla="+id_talla+"&"+"id_umed="+id_umed+"&"+"id_genero="+id_genero+"&"+"id_sector="+id_sector;					
								$.ajax({
									type: "POST",
									url: "insert/inserta_producto.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_productos_pop.php";						
									}			
								});					
							}
							else
							{
								$('#valida-cod_prod_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cod_prod_r').fadeOut('slow');},1000); 
							}
						}	
					});
				}
				else
				{
					$('#valida-producto_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-producto_r').fadeOut('slow');},1000); 
				}
			 }			
		});	
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_productos_pop=function()	{
		var id_prod_pop = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_productos_pop.php?id_prod_pop="+id_prod_pop;
	}
	// **************************Select Material y desabilita *************************************//	
	$.fn.select_material_pop=function(){
		$('#list_material').prop('disabled', true);
		var id_material = $('#list_material option:selected').attr('id');
		var material = $('#list_material option:selected').val();
		$('#producto').val(material);
		$('#cod_prod').val('MPOP_'+id_material);
	}
	// **************************Select color y ve que el anterior este seleccionado  *************************************//	
	$.fn.select_color_pop=function(){
		if($.trim($("#list_material").val())==="") 
		{
			$("#list_material").focus ();
			$('#valida-material').fadeIn('slow'); 
			setTimeout(function(){$('#valida-material').fadeOut('slow');},1000); 
			$("#list_color").val ("");
			return false;
		}	
		$('#list_color').prop('disabled', true);
		var id_color = $('#list_color option:selected').attr('id');
		var color = $('#list_color option:selected').val();
		var codigo=$('#cod_prod').val();
		var producto=$('#producto').val();
		$('#producto').val(producto+" "+color);
		$('#cod_prod').val(codigo+id_color);
	}
	// **************************Select color y ve que el anterior este seleccionado *************************************//	
	$.fn.select_marca_pop=function(){
		if($.trim($("#list_material").val())==="") 
		{
			$("#list_material").focus ();
			$('#valida-material').fadeIn('slow'); 
			setTimeout(function(){$('#valida-material').fadeOut('slow');},1000); 
			$("#list_marc").val ("");
			return false;
		}
		if($.trim($("#list_color").val())==="") 
		{
			$("#list_color").focus ();
			$('#valida-color').fadeIn('slow'); 
			setTimeout(function(){$('#valida-color').fadeOut('slow');},1000); 
			$("#list_marc").val ("");
			return false;
		}
		$('#list_marc').prop('disabled', true);
		var id_marca = $('#list_marc option:selected').attr('id');
		var codigo=$('#cod_prod').val();
		$('#cod_prod').val(codigo+id_marca);
		var marca = $('#list_marc option:selected').val();
		var producto=$('#producto').val();
		$('#producto').val(producto+" "+marca);
	}
	// **************************Select Formato y ve que el anterior este seleccionado*************************************//	
	$.fn.select_formato_pop=function(){
		if($.trim($("#list_material").val())==="") 
		{
			$("#list_material").focus ();
			$('#valida-material').fadeIn('slow'); 
			setTimeout(function(){$('#valida-material').fadeOut('slow');},1000); 
			$("#list_formatos").val ("");
			return false;
		}
		if($.trim($("#list_color").val())==="") 
		{
			$("#list_color").focus ();
			$('#valida-color').fadeIn('slow'); 
			setTimeout(function(){$('#valida-color').fadeOut('slow');},1000); 
			$("#list_formatos").val ("");
			return false;
		}
		if($.trim($("#list_marc").val())==="") 
		{
			$("#list_marc").focus ();
			$('#valida-marc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-marc').fadeOut('slow');},1000); 
			$("#list_formatos").val ("");
			return false;
		}
		$('#list_formatos').prop('disabled', true);
		var id_formato = $('#list_formatos option:selected').attr('id');
		var cod_producto_mant=$('#cod_prod').val();
		var formato = $('#list_formatos option:selected').val();
		var producto=$('#producto').val();
		$('#producto').val(producto+" "+formato);
		var stream="cod_producto_mant="+cod_producto_mant;
		$.ajax({
			type: "POST",
			url: "select/trae_id_producto.php",
			data:stream,
			success: function(data)	{
				$('#codigo').show();
				$("#cod_prod").val(data);
 			}	
		});		
	}
	// ******************************Producto ***********************//
	// **************************Ingreso marca*************************************//	
	$.fn.select_marca=function(){
		var marca = $('#list_marc option:selected').val();
		var id_marca = $('#list_marc option:selected').attr('id');
		$("#producto").val(marca);
	   	var codigo=marca.substring(0,3);
                var c_marca=id_marca.length;
                if(c_marca==1){
                    //alert(c_marca);
                    id_marca="00"+id_marca;
                }
                if(c_marca==2){
                    //alert(c_marca);
                    id_marca="0"+id_marca;
                }
                if(c_marca==3){
                    //alert(c_marca);
                    id_marca=id_marca;
                }
                
                $('#codigo').show();
		$("#cod_prod").val(codigo+id_marca);
                //$("#cod_prod").val(codigo+" "+id_marca);
		$('#list_marc').prop('disabled', true);
	}
        //Select MArca Prmezcla
        $.fn.select_marca_pre=function(){
                if($.trim($("#list_marc").val())==="") 
		{
			$("#list_marc").focus ();
			$('#valida-marca').fadeIn('slow'); 
			setTimeout(function(){$('#valida-marca').fadeOut('slow');},1000); 
			return false;
		}
		var marca = $('#list_marc option:selected').val();
		var id_marca = $('#list_marc option:selected').attr('id');
		$("#producto").val("PREM "+marca);
	   	var codigo=marca.substring(0,3);
                var c_marca=id_marca.length;
                if(c_marca==1){
                    //alert(c_marca);
                    id_marca="00"+id_marca;
                }
                if(c_marca==2){
                    //alert(c_marca);
                    id_marca="0"+id_marca;
                }
                if(c_marca==3){
                    //alert(c_marca);
                    id_marca=id_marca;
                }
                
                $('#codigo').show();
		$("#cod_prod").val("PRE"+codigo+id_marca);
                //$("#cod_prod").val(codigo+" "+id_marca);
		$('#list_marc').prop('disabled', true);
	}
	// **************************Ingreso Formato*************************************//	
	$.fn.select_formato=function(){
		if($.trim($("#list_marc").val())==="") 
		{
			$("#list_marc").focus ();
			$('#valida-marca').fadeIn('slow'); 
			setTimeout(function(){$('#valida-marca').fadeOut('slow');},1000); 
			$("#list_formatos").val ("");
			return false;
		}
		var producto=$("#producto").val();
		var formato = $('#list_formatos option:selected').val();
		var id_formato = $('#list_formatos option:selected').attr('id');
		$("#producto").val(producto+" "+formato);
		var cod_prod=$("#cod_prod").val();
                
                var c_formato=id_formato.length;
                if(c_formato==1){
                    //alert(c_marca);
                    id_formato="00"+id_formato;
                }
                if(c_formato==2){
                    //alert(c_marca);
                    id_formato="0"+id_formato;
                }
                if(c_formato==3){
                    //alert(c_marca);
                    id_formato=id_formato;
                }
		$("#cod_prod").val(cod_prod+id_formato);
		$('#list_formatos').prop('disabled', true);
	}
	// **************************Eleccion sabor*************************************//	
	$.fn.select_sabor=function(){
		if($.trim($("#list_marc").val())==="") 
		{
			$("#list_marc").focus ();
			$('#valida-marca').fadeIn('slow'); 
			setTimeout(function(){$('#valida-marca').fadeOut('slow');},1000); 
			$("#list_sabor").val ("");
			return false;
		}
		if($.trim($("#list_formatos").val())==="") 
		{
			$("#list_formatos").focus ();
			$('#valida-formato').fadeIn('slow'); 
			setTimeout(function(){$('#valida-formato').fadeOut('slow');},1000); 
			$("#list_sabor").val ("");
			return false;
		}
		var producto=$("#producto").val();
		var sabor = $('#list_sabor option:selected').val();
                var id_sabor = $('#list_sabor option:selected').attr('id');
		$("#producto").val(producto+" "+sabor);
                
                
		//var cod_producto_mant=$("#cod_prod").val();
                var cod_prod=$("#cod_prod").val();
                
                var c_sabor=id_sabor.length;
                if(c_sabor==1){
                    //alert(c_marca);
                    id_sabor="00"+id_sabor;
                }
                if(c_sabor==2){
                    //alert(c_marca);
                    id_sabor="0"+id_sabor;
                }
                if(c_sabor==3){
                    //alert(c_marca);
                    id_sabor=id_sabor;
                }
		$("#cod_prod").val(cod_prod+id_sabor);
		/*var stream="cod_producto_mant="+cod_producto_mant;
		$.ajax({
			type: "POST",
			url: "select/trae_id_producto.php",
			data:stream,
			success: function(data)	{
				$('#codigo').show();
				$("#cod_prod").val(data);
 			}	
		});*/
		$('#list_sabor').prop('disabled', true);
	}
        //Selec Sabor Premezcls
        $.fn.select_sabor_pre=function(){
		if($.trim($("#list_marc").val())==="") 
		{
			$("#list_marc").focus ();
			$('#valida-marca').fadeIn('slow'); 
			setTimeout(function(){$('#valida-marca').fadeOut('slow');},1000); 
			$("#list_sabor").val ("");
			return false;
		}
		
		var producto=$("#producto").val();
		var sabor = $('#list_sabor option:selected').val();
                var id_sabor = $('#list_sabor option:selected').attr('id');
		$("#producto").val(producto+" "+sabor);
                
                
		//var cod_producto_mant=$("#cod_prod").val();
                var cod_prod=$("#cod_prod").val();
                
                var c_sabor=id_sabor.length;
                if(c_sabor==1){
                    //alert(c_marca);
                    id_sabor="00"+id_sabor;
                }
                if(c_sabor==2){
                    //alert(c_marca);
                    id_sabor="0"+id_sabor;
                }
                if(c_sabor==3){
                    //alert(c_marca);
                    id_sabor=id_sabor;
                }
		$("#cod_prod").val(cod_prod+id_sabor);
		/*var stream="cod_producto_mant="+cod_producto_mant;
		$.ajax({
			type: "POST",
			url: "select/trae_id_producto.php",
			data:stream,
			success: function(data)	{
				$('#codigo').show();
				$("#cod_prod").val(data);
 			}	
		});*/
		$('#list_sabor').prop('disabled', true);
	}
		// **************************Eleccion Material Actualizacion material pop*************************************//	
	/*$.fn.select_material_pop_actualizar=function(){
 		$("#producto").val ("");
		var material = $('#materiales option:selected').val();
		$("#producto").val(material);
		$('#colores').prop('disabled', false);
	}*/
	// **************************Eleccion color Actualizacion material pop*************************************//
	/*$.fn.select_color_pop_actualizar=function(){
 	 
		var colores = $('#colores option:selected').val();
		var producto=$("#producto").val();
		$("#producto").val(producto+" "+colores);
		$('#materiales').prop('disabled', true);
		$('#colores').prop('disabled', true);
	}*/	
	// **************************Ingreso Producto Externo*************************************//		
	$.fn.ingresa_producto_ext=function(){ 
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#cod_prod").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_sabor").val())==="") 
		{
			$("#list_sabor").focus ();
			$('#valida-sabor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sabor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_umed").val())==="") 
		{
			$("#list_umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#peso_neto").val())==="") 
		{
			$("#peso_neto").focus ();
			$('#valida-p_neto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-p_neto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#p_bruto").val())==="") 
		{
			$("#p_bruto").focus ();
			$('#valida-p_bruto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-p_bruto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#volumen").val())==="") 
		{
			$("#volumen").focus ();
			$('#valida-volumen').fadeIn('slow'); 
			setTimeout(function(){$('#valida-volumen').fadeOut('slow');},1000); 
			return false;
		}
		var cod_prod=$("#cod_prod").val();
		var nom_prod=$("#producto").val();
		var id_umed = $('#list_umed option:selected').attr('id');
		var id_marca = $('#list_marc option:selected').attr('id');
		var sabor = $('#list_sabor option:selected').attr('id');
		var id_formato = $('#list_formatos option:selected').attr('id');
 		var peso_neto=$("#peso_neto").val();
		var peso_bruto=$("#p_bruto").val();
		var volumen=$("#volumen").val();
		var id_sector=4;
		var stream="nom_prod="+nom_prod+"&"+"id_producto=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{			
					var cod_prod=$("#cod_prod").val();	
					var stream="cod_prod="+cod_prod;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_codigo_producto.php",
						data:stream,
						success: function(data) {					
							if (data.indexOf("Error")==-1)
							{	
								var stream="cod_prod="+cod_prod+"&"+"nom_prod="+nom_prod+"&"+"id_umed="+id_umed+"&"+"id_marca="+id_marca
								+"&"+"sabor="+sabor+"&"+"id_formato="+id_formato+"&"+"peso_neto="+peso_neto+"&"+"peso_bruto="+peso_bruto
									+"&"+"volumen="+volumen+"&"+"id_sector="+id_sector;
								$.ajax({
									type: "POST",
									url: "insert/inserta_producto.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_producto_externo.php";						
									}			
								});				
							}
							else
							{
								$('#valida-cod_prod_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cod_prod_r').fadeOut('slow');},1000); 
							}
						}	
					});	
				}
				else
				{
					$('#valida-prod').fadeIn('slow'); 
					setTimeout(function(){$('#valida-prod').fadeOut('slow');},1000); 
				}
			 }			
		});	 
	}
	// **************************Ingreso Producto Terminado*************************************//		
	$.fn.ingresa_producto_term=function(){ 
                if($.trim($("#list_tipo_producto").val())==="") 
		{
			$("#list_tipo_producto").focus ();
			$('#valida-list_tipo_producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_tipo_producto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#cod_prod").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_sabor").val())==="") 
		{
			$("#list_sabor").focus ();
			$('#valida-sabor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sabor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_umed").val())==="") 
		{
			$("#list_umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#peso_neto").val())==="") 
		{
			$("#peso_neto").focus ();
			$('#valida-p_neto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-p_neto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#p_bruto").val())==="") 
		{
			$("#p_bruto").focus ();
			$('#valida-p_bruto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-p_bruto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#volumen").val())==="") 
		{
			$("#volumen").focus ();
			$('#valida-volumen').fadeIn('slow'); 
			setTimeout(function(){$('#valida-volumen').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#cajas_bat").val())==="") 
		{
			$("#cajas_bat").focus ();
			$('#valida-cajas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cajas').fadeOut('slow');},1000); 
			return false;
		}
		var cod_prod=$("#cod_prod").val();
		var nom_prod=$("#producto").val();
		var id_umed = $('#list_umed option:selected').attr('id');
                var id_tipo_producto = $('#list_tipo_producto option:selected').attr('id');
		var id_marca = $('#list_marc option:selected').attr('id');
		var sabor = $('#list_sabor option:selected').attr('id');
		var id_formato = $('#list_formatos option:selected').attr('id');
 		var peso_neto=$("#peso_neto").val();
		var peso_bruto=$("#p_bruto").val();
		var volumen=$("#volumen").val();
		var cajas=$("#cajas_bat").val();
		var id_sector=4;
		var stream="nom_prod="+nom_prod+"&"+"id_producto=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {
                            
				if (data.indexOf("Error")==-1)
				{			
					var cod_prod=$("#cod_prod").val();	
					var stream="cod_prod="+cod_prod;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_codigo_producto.php",
						data:stream,
						success: function(data) {					
                                                    //alert(data);
							if (data.indexOf("Error")==-1)
							{	
								var stream="cod_prod="+cod_prod+"&"+"nom_prod="+nom_prod+"&"+"id_umed="+id_umed+"&"+"id_marca="+id_marca
								+"&"+"sabor="+sabor+"&"+"id_formato="+id_formato+"&"+"peso_neto="+peso_neto+"&"+"peso_bruto="+peso_bruto
									+"&"+"volumen="+volumen+"&"+"id_sector="+id_sector+"&"+"cajas="+cajas+"&"+"id_tipo_producto="+id_tipo_producto;
								$.ajax({
									type: "POST",
									url: "insert/inserta_producto.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_producto_terminado.php";						
									}			
								});				
							}
							else
							{
								$('#valida-cod_prod_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cod_prod_r').fadeOut('slow');},1000); 
							}
						}	
					});	
				}
				else
				{
					$('#valida-prod').fadeIn('slow'); 
					setTimeout(function(){$('#valida-prod').fadeOut('slow');},1000); 
				}
			 }			
		});	 
	}
        //Ingreso Premezcla
        $.fn.ingresa_producto_premezcla=function(){ 
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#cod_prod").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_sabor").val())==="") 
		{
			$("#list_sabor").focus ();
			$('#valida-sabor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sabor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_umed").val())==="") 
		{
			$("#list_umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			return false;
		}
		var cod_prod=$("#cod_prod").val();
		var nom_prod=$("#producto").val();
		var id_umed = $('#list_umed option:selected').attr('id');
		var id_marca = $('#list_marc option:selected').attr('id');
		var sabor = $('#list_sabor option:selected').attr('id');
		var id_sector=6;
		var stream="nom_prod="+nom_prod+"&"+"id_producto=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {
                            
				if (data.indexOf("Error")==-1)
				{			
					var cod_prod=$("#cod_prod").val();	
					var stream="cod_prod="+cod_prod;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_codigo_producto.php",
						data:stream,
						success: function(data) {					
                                                    //alert(data);
							if (data.indexOf("Error")==-1)
							{	
								var stream="cod_prod="+cod_prod
                                                                        +"&"+"nom_prod="+nom_prod
                                                                        +"&"+"id_umed="+id_umed
                                                                        +"&"+"id_marca="+id_marca
                                                                        +"&"+"sabor="+sabor
									+"&"+"id_sector="+id_sector;
								$.ajax({
									type: "POST",
									url: "insert/inserta_producto.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_premix.php";						
									}			
								});				
							}
							else
							{
								$('#valida-cod_prod_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cod_prod_r').fadeOut('slow');},1000); 
							}
						}	
					});	
				}
				else
				{
					$('#valida-prod').fadeIn('slow'); 
					setTimeout(function(){$('#valida-prod').fadeOut('slow');},1000); 
				}
			 }			
		});	 
	}
        /**Materia Prima*/
        $.fn.ingresa_producto_mat_prima=function(){ 
		
		if($.trim($("#list_familia_mprima").val())==="") 
		{
			$("#list_familia_mprima").focus ();
			$('#valida-list_familia_mprima').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_familia_mprima').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#producto").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_umed").val())==="") 
		{
			$("#list_umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#stock_min").val())==="") 
		{
			$("#p_bruto").focus ();
			$('#valida-stock_min').fadeIn('slow'); 
			setTimeout(function(){$('#valida-stock_min').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#divide").val())==="") 
		{
			$("#divide").focus ();
			$('#valida-divide').fadeIn('slow'); 
			setTimeout(function(){$('#valida-divide').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#ph").val())==="") 
		{
			$("#ph").focus ();
			$('#valida-ph').fadeIn('slow'); 
			setTimeout(function(){$('#valida-ph').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#hume").val())==="") 
		{
			$("#hume").focus ();
			$('#valida-hume').fadeIn('slow'); 
			setTimeout(function(){$('#valida-hume').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#cod_prod").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#cod_prod").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		var cod_prod=$("#cod_prod").val();
                var id_familia_mprima = $('#list_familia_mprima option:selected').attr('id');
		var nom_prod=$("#producto").val().toUpperCase();
		var id_umed = $('#list_umed option:selected').attr('id');
		var stock_min=$("#stock_min").val();
                var divide=$("#divide").val();
                var ph=$("#ph").val();
                var hume=$("#hume").val();
                
		var id_sector=7;
		var stream="nom_prod="+nom_prod+"&"+"id_producto=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {
                            
				if (data.indexOf("Error")==-1)
				{			
					var cod_prod=$("#cod_prod").val();	
					var stream="cod_prod="+cod_prod;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_codigo_producto.php",
						data:stream,
						success: function(data) {					
                                                    //alert(data);
							if (data.indexOf("Error")==-1)
							{	
								var stream="cod_prod="+cod_prod+"&"+"nom_prod="+nom_prod+"&"+"id_umed="+id_umed+"&"+"id_familia_mprima="+id_familia_mprima
								+"&"+"stock_min="+stock_min+"&"+"divide="+divide+"&"+"ph="+ph+"&"+"hume="+hume
									+"&"+"id_sector="+id_sector;
								$.ajax({
									type: "POST",
									url: "insert/inserta_producto.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_producto_terminado_mp.php";						
									}			
								});				
							}
							else
							{
								$('#valida-cod_prod_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cod_prod_r').fadeOut('slow');},1000); 
							}
						}	
					});	
				}
				else
				{
					$('#valida-prod').fadeIn('slow'); 
					setTimeout(function(){$('#valida-prod').fadeOut('slow');},1000); 
				}
			 }			
		});	 
	}
        /**Materia Prima*/
        $.fn.ingresa_producto_insumo=function(){ 
		
		if($.trim($("#list_familia_ins").val())==="") 
		{
			$("#list_familia_ins").focus ();
			$('#valida-list_familia_ins').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_familia_ins').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#producto").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_umed").val())==="") 
		{
			$("#list_umed").focus ();
			$('#valida-umed').fadeIn('slow'); 
			setTimeout(function(){$('#valida-umed').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#stock_min").val())==="") 
		{
			$("#p_bruto").focus ();
			$('#valida-stock_min').fadeIn('slow'); 
			setTimeout(function(){$('#valida-stock_min').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#divide").val())==="") 
		{
			$("#divide").focus ();
			$('#valida-divide').fadeIn('slow'); 
			setTimeout(function(){$('#valida-divide').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#ph").val())==="") 
		{
			$("#ph").focus ();
			$('#valida-ph').fadeIn('slow'); 
			setTimeout(function(){$('#valida-ph').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#hume").val())==="") 
		{
			$("#hume").focus ();
			$('#valida-hume').fadeIn('slow'); 
			setTimeout(function(){$('#valida-hume').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#cod_prod").val())==="") 
		{
			$("#producto").focus ();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#cod_prod").val())==="") 
		{
			$("#cod_prod").focus ();
			$('#valida-cod_prod').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cod_prod').fadeOut('slow');},1000); 
			return false;
		}
		var cod_prod=$("#cod_prod").val();
                var id_familia_mprima = $('#list_familia_ins option:selected').attr('id');
		var nom_prod=$("#producto").val().toUpperCase();
		var id_umed = $('#list_umed option:selected').attr('id');
		var stock_min=$("#stock_min").val();
                var divide=$("#divide").val();
                var ph=$("#ph").val();
                var hume=$("#hume").val();
                
		var id_sector=8;
		var stream="nom_prod="+nom_prod+"&"+"id_producto=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto.php",
			data:stream,
			success: function(data) {
                            
				if (data.indexOf("Error")==-1)
				{			
					var cod_prod=$("#cod_prod").val();	
					var stream="cod_prod="+cod_prod;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_codigo_producto.php",
						data:stream,
						success: function(data) {					
                                                    //alert(data);
							if (data.indexOf("Error")==-1)
							{	
								var stream="cod_prod="+cod_prod+"&"+"nom_prod="+nom_prod+"&"+"id_umed="+id_umed+"&"+"id_familia_mprima="+id_familia_mprima
								+"&"+"stock_min="+stock_min+"&"+"divide="+divide+"&"+"ph="+ph+"&"+"hume="+hume
									+"&"+"id_sector="+id_sector;
								$.ajax({
									type: "POST",
									url: "insert/inserta_producto.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_producto_terminado_ins.php";						
									}			
								});				
							}
							else
							{
								$('#valida-cod_prod_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cod_prod_r').fadeOut('slow');},1000); 
							}
						}	
					});	
				}
				else
				{
					$('#valida-prod').fadeIn('slow'); 
					setTimeout(function(){$('#valida-prod').fadeOut('slow');},1000); 
				}
			 }			
		});	 
	}
        
        
	// ************************** on change de carga comuna por la region *************************************//
	$.fn.select_region=function(){	
		var id_region =$(this).find(':selected').attr('id')
		$.getJSON("combos/combo_comunas.php",{id_region:id_region},function(resultado){
			$("#list_comuna").html("<select id='list_comuna'><option value='' selected>Seleccione Comuna...</option>");
			for(i=0;i<resultado.length;i++)
			{
				$("#list_comuna").append("<option id='"+resultado[i].id_comuna+"' value='"+resultado[i].comuna+"'>"+resultado[i].comuna+"</option></select>");
			}
	
		});	 	 
	}
	// ************************** Crear Cliente*************************************//
	$.fn.crear_cliente_nac=function(){
		if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#nom_client").val())==="") 
		{
			$("#nom_client").focus ();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
	 	if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}	 	 
		if($.trim($("#list_regiones").val())==="") 
		{
			$("#list_regiones").focus ();
			$('#valida-region').fadeIn('slow'); 
			setTimeout(function(){$('#valida-region').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_comuna").val())==="") 
		{
			$("#list_comuna").focus ();
			$('#valida-comuna').fadeIn('slow'); 
			setTimeout(function(){$('#valida-comuna').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_giros").val())==="") 
		{
			$("#list_giros").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#contacto").val())==="") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_cargo").val())==="") 
		{
			$("#list_cargo").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#email").val())==="") 
		{
			$("#email").focus ();
			$('#valida-mail').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
			return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
      	{
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}
		var rut=$("#rut").val();
		var nombre_cliente=$("#nom_client").val();
		var direccion=$("#direccion").val();
		var id_region = $('#list_regiones option:selected').attr('id');
		var id_comuna = $('#list_comuna option:selected').attr('id');
		var telefono=$("#fono").val();
		var id_giro = $('#list_giros option:selected').attr('id');
		var contacto=$("#contacto").val();
		var id_cargo=$('#list_cargo option:selected').attr('id');
		var email=$("#email").val();
		var fax=$("#fax").val();
		var stream="rut="+rut;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cliente_nacional.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{			
					var stream="rut="+rut+"&"+"nombre_cliente="+nombre_cliente+"&"+"direccion="+direccion+"&"+"id_region="+id_region+"&"+"id_comuna="+id_comuna
					+"&"+"telefono="+telefono+"&"+"id_giro="+id_giro+"&"+"contacto="+contacto+"&"+"id_cargo="+id_cargo+"&"+"email="+email+"&"+"fax="+fax;
					$.ajax({
						type: "POST",
						url: "insert/inserta_cliente_nacional.php",
						data:stream,
						success: function(data){
							alert (data);
							location.href = "listado_clientes.php";						
						}			
					});
				}
				else
				{
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
				}
			 }			
		});		 	 
	}
		// **************************Actualizar Cliente*************************************//
	$.fn.actualiza_cliente_nac=function()	{
		var id_cliente= $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_cliente_nac.php?id_cliente="+id_cliente;
	}
        	// **************************Actualizar Proveedor*************************************//
	$.fn.actualiza_proveedor=function()	{
		var id_proveedor_nacional= $(this).parents('tr').find("td").attr('id');
                //alert(id_proveedor_nacional);
		location.href = "actualiza_proveedor_nac.php?id_proveedor_nacional="+id_proveedor_nacional;
                //location.href = "actualiza_cliente_nac.php?id_cliente="+id_cliente;
	}
        $.fn.crea_sucural_cliente=function(id_cliente)	{
		//var id_cliente= $(this).parents('tr').find("td").attr('id');
		location.href = "crear_sucursal_cliente.php?id_cliente="+id_cliente;
	}
        $.fn.crea_sucural_cliente_volver=function(id_cliente)	{
		//var id_cliente= $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_cliente_nac.php?id_cliente="+id_cliente;
	}
        $.fn.crea_sucural_cliente_registra=function(id_cliente)	{
                if($.trim($("#suc").val())==="") 
		{
			$("#suc").focus ();
			$('#valida-suc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-suc').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_reg").val())==="") 
		{
			$("#list_reg").focus ();
			$('#valida-list_reg').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_reg').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_prov").val())==="") 
		{
			$("#list_prov").focus ();
			$('#valida-list_prov').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_prov').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_com").val())==="") 
		{
			$("#list_com").focus ();
			$('#valida-list_com').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_com').fadeOut('slow');},1000); 
			return false;
		}
                var id_region = $('#list_reg option:selected').attr('id');
                var id_providencia = $('#list_prov option:selected').attr('id');
                var id_comuna = $('#list_com option:selected').attr('id');
                var sucursal=$("#suc").val().toUpperCase();
                var id_cliente=$("#id_cliente").val();
                var stream="sucursal="+sucursal
                        +"&"+"id_cliente="+id_cliente;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_sucursal_cliente.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{			
					var stream="sucursal="+sucursal
                                                +"&"+"id_region="+id_region
                                                +"&"+"id_providencia="+id_providencia
                                                +"&"+"id_comuna="+id_comuna
                                                +"&"+"id_cliente="+id_cliente;
					$.ajax({
						type: "POST",
						url: "insert/inserta_cliente_nacional_sucursal.php",
						data:stream,
						success: function(data){
							alert (data);
							//location.href = "listado_clientes.php";	
                                                        location.href = "actualiza_cliente_nac.php?id_cliente="+id_cliente;
						}			
					});
				}
				else
				{
					$('#valida-suc_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-suc_r').fadeOut('slow');},1000); 
				}
			 }			
		});
		//var id_cliente= $(this).parents('tr').find("td").attr('id');
		//location.href = "actualiza_cliente_nac.php?id_cliente="+id_cliente;
	}
	// ************************** Actualizar Cliente*************************************//
	$.fn.actualizar_cliente_nac=function(){
		if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#nom_client").val())==="") 
		{
			$("#nom_client").focus ();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#canal_emp").val())==="") 
		{
			$("#canal_emp").focus ();
			$('#valida-canal_emp').fadeIn('slow'); 
			setTimeout(function(){$('#valida-canal_emp').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#giro_emp").val())==="0") 
		{
			$("#giro_emp").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
                /*
	 	if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}	 	 
		if($.trim($("#regiones").val())==="") 
		{
			$("#regiones").focus ();
			$('#valida-region').fadeIn('slow'); 
			setTimeout(function(){$('#valida-region').fadeOut('slow');},1000); 
			return false;
		}
		if($("#list_comuna").val()==="") 
		{
			$("#list_comuna").focus ();
			$('#valida-comuna').fadeIn('slow'); 
			setTimeout(function(){$('#valida-comuna').fadeOut('slow');},1000); 
			return false;
		}*/	 
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
                /*if($.trim($("#fax").val())==="") 
		{
			$("#fax").focus ();
			$('#valida-fax').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fax').fadeOut('slow');},1000); 
			return false;
		}*/
		
		if($.trim($("#contacto").val())==="") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#lista_cargos").val())==="") 
		{
			$("#lista_cargos").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#email").val())==="") 
		{
			$("#email").focus ();
			$('#valida-mail').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
			return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
      	{
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}
		if($.trim($("#credito").val())==="") 
		{
			$("#credito").focus ();
			$('#valida-credito').fadeIn('slow'); 
			setTimeout(function(){$('#valida-credito').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#vendedor_emp").val())==="") 
		{
			$("#vendedor_emp").focus ();
			$('#valida-vendedor_emp').fadeIn('slow'); 
			setTimeout(function(){$('#valida-vendedor_emp').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#lista_pagos").val())==="") 
		{
			$("#lista_pagos").focus ();
			$('#valida-lista_pagos').fadeIn('slow'); 
			setTimeout(function(){$('#valida-lista_pagos').fadeOut('slow');},1000); 
			return false;
		}
                var lista_precio=$('#lista_precio option:selected').attr('id');
                //alert(lista_precio);
                if(lista_precio=="") 
		{
			$("#lista_precio").focus ();
			$('#valida-lista_precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-lista_precio').fadeOut('slow');},1000); 
			return false;
		}
		var rut=$("#rut").val();
		var id_cliente=$("#id_cliente").val();
		var nombre_cliente=$("#nom_client").val();
                var canal=$('#canal_emp option:selected').attr('id');
                var id_giro = $('#giro option:selected').attr('id');
		/*var direccion=$("#direccion").val();
		var id_region = $('#regiones option:selected').attr('id');
		var id_comuna = $('#list_comuna option:selected').attr('id');*/
		var telefono=$("#fono").val();
		
		var contacto=$("#contacto").val();
		var cargo=$('#lista_cargos option:selected').attr('id');
		var email=$("#email").val();
		var fax=$("#fax").val();
		var credito=$("#credito").val();
                var vendedor=$('#vendedor_emp option:selected').attr('id');
                var pago=$('#lista_pagos option:selected').attr('id');
                
		var stream="rut="+rut+"&"+"id_cliente="+id_cliente;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cliente_nacional.php",
			data:stream,
			success: function(data) {	
                            //alert(data);
				if (data.indexOf("Error")==-1)
				{			
					var stream="rut="+rut
                                                +"&"+"nombre_cliente="+nombre_cliente
                                                +"&"+"canal="+canal
                                                +"&"+"id_giro="+id_giro
                                                +"&"+"telefono="+telefono
                                                +"&"+"fax="+fax
                                                +"&"+"contacto="+contacto
                                                +"&"+"cargo="+cargo
                                                +"&"+"email="+email
                                                +"&"+"credito="+credito
                                                +"&"+"vendedor="+vendedor
                                                +"&"+"pago="+pago
                                                +"&"+"lista_precio="+lista_precio
						+"&"+"id_cliente="+id_cliente;
                                        /*var stream="rut="+rut
                                                +"&"+"nombre_cliente="+nombre_cliente
                                                +"&"+"direccion="+direccion+"&"+"id_region="+id_region+"&"+"id_comuna="+id_comuna
					+"&"+"telefono="+telefono+"&"+"id_giro="+id_giro+"&"+"contacto="+contacto+"&"+"cargo="+cargo+"&"+"email="+email+"&"+"fax="+fax
						+"&"+"id_cliente="+id_cliente+"&"+"credito="+credito;*/
					$.ajax({
						type: "POST",
						url: "update/actualiza_cliente_nacional.php",
						data:stream,
						success: function(data){
							alert (data);
							location.href = "listado_clientes.php";						
						}			
					});
				}
				else
				{
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
				}
			 }			
		});		 	 
	}
	// **************************Eliminar *************************************//
	$.fn.borra_cliente_nac=function(){
		var id_cliente_nac = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Cliente?');
		if(action==true)
		{
			var stream="id_cliente_nac="+id_cliente_nac;
			$.ajax({
				type: "POST",
				url: "delete/borra_cliente_nac.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_clientes.php";						
				}			
			});
		}
	}
        // **************************Eliminar *************************************//
	$.fn.borra_proveedor=function(){
		var id_proveedor = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Proveedor?');
		if(action==true)
		{
			var stream="id_proveedor="+id_proveedor;
			$.ajax({
				type: "POST",
				url: "delete/borra_proveedor.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_proveedores.php";						
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************Giro Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_giro=function(){
		if($.trim($("#giro").val())==="") 
		{
			$("#giro").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
		var giro=$("#giro").val().toUpperCase();
		var stream="giro="+giro;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_giro.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					var giro=$("#giro").val().toUpperCase(); 
					var stream="giro="+giro;			 
					$.ajax({
						type: "POST",
						url: "insert/inserta_giro.php",
						data:stream,
						success: function(data){							
							alert (data);
							location.href = "listado_giros.php";							
						}			
					});
				}
				else
				{
					$("#giro").focus ();
					$('#valida-giro_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-giro_reg').fadeOut('slow');},1000); 
					$("#giro").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_giro=function( ){
		var id_giro = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_giro.php?id_giro="+id_giro;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_giro=function( ){			
		if($.trim($("#giro").val())==="") 
		{
			$("#giro").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
		var giro=$("#giro").val().toUpperCase();
		var id_giro=$("#id_giro").val();
		var stream="giro="+giro+"&"+"id_giro="+id_giro;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_giro.php",
			data:stream,
			success: function(data){
				if (data.indexOf("Error")==-1)
				{	
					var giro=$("#giro").val().toUpperCase();
					var id_giro=$("#id_giro").val();
					var stream="giro="+giro+"&"+"id_giro="+id_giro;			 
					$.ajax({
						type: "POST",
						url: "update/actualiza_giro.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_giros.php";							
						}			
					});
				}
				else
				{
					$("#giro").focus ();
					$('#valida-giro_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-giro_reg').fadeOut('slow');},1000); 
					$("#giro").val ("");
			 		return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_giro=function(){
		var id_giro = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Giro?');
		if(action==true)
		{
			var stream="id_giro="+id_giro;
			$.ajax({
				type: "POST",
				url: "delete/borra_giro.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_giros.php";						
				}			
			});
		}
	}
	// ******************************Cargos Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_cargo=function(){
		if($.trim($("#cargo").val())==="") 
		{
			$("#cargo").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		var cargo=$("#cargo").val().toUpperCase();
		var stream="cargo="+cargo;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cargo.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					var cargo=$("#cargo").val().toUpperCase(); 
					var stream="cargo="+cargo;			 
					$.ajax({
						type: "POST",
						url: "insert/inserta_cargo.php",
						data:stream,
						success: function(data){							
							alert (data);
							location.href = "listado_cargos.php";							
						}			
					});
				}
				else
				{
					$("#cargo").focus ();
					$('#valida-cargo_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-cargo_reg').fadeOut('slow');},1000); 
					$("#giro").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_cargo=function( ){
		var id_cargo = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_cargo.php?id_cargo="+id_cargo;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_cargo=function( ){			
		if($.trim($("#cargo").val())==="") 
		{
			$("#cargo").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		var cargo=$("#cargo").val().toUpperCase();
		var id_cargo=$("#id_cargo").val();
		var stream="cargo="+cargo+"&"+"id_cargo="+id_cargo;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cargo.php",
			data:stream,
			success: function(data){
				if (data.indexOf("Error")==-1)
				{	
					var cargo=$("#cargo").val().toUpperCase();
					var id_cargo=$("#id_cargo").val();
					var stream="cargo="+cargo+"&"+"id_cargo="+id_cargo;			 
					$.ajax({
						type: "POST",
						url: "update/actualiza_cargo.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_cargos.php";							
						}			
					});
				}
				else
				{
					$("#cargo").focus ();
					$('#valida-cargo_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-cargo_reg').fadeOut('slow');},1000); 
					$("#giro").val ("");
			 		return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_cargo=function(){
		var id_cargo = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Cargo?');
		if(action==true)
		{
			var stream="id_cargo="+id_cargo;
			$.ajax({
				type: "POST",
				url: "delete/borra_cargo.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_cargos.php";						
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************Idioma Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_idioma=function(){
		if($.trim($("#idioma").val())==="") 
		{
			$("#idioma").focus ();
			$('#valida-idioma').fadeIn('slow'); 
			setTimeout(function(){$('#valida-idioma').fadeOut('slow');},1000); 
			return false;
		}
		var idioma=$("#idioma").val().toUpperCase();
		var stream="idioma="+idioma;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_idioma.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					var idioma=$("#idioma").val().toUpperCase(); 
					var stream="idioma="+idioma;			 
					$.ajax({
						type: "POST",
						url: "insert/inserta_idioma.php",
						data:stream,
						success: function(data){							
							alert (data);
							location.href = "listado_idiomas.php";							
						}			
					});
				}
				else
				{
					$("#idioma").focus ();
					$('#valida-idioma_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-idioma_reg').fadeOut('slow');},1000); 
					$("#idioma").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_idioma=function( ){
		var id_idioma = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_idioma.php?id_idioma="+id_idioma;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_idioma=function( ){			
		if($.trim($("#idioma").val())==="") 
		{
			$("#idioma").focus ();
			$('#valida-idioma').fadeIn('slow'); 
			setTimeout(function(){$('#valida-idioma').fadeOut('slow');},1000); 
			return false;
		}
		var idioma=$("#idioma").val().toUpperCase();
		var id_idioma=$("#id_idioma").val();
		var stream="idioma="+idioma+"&"+"id_idioma="+id_idioma;		 
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_idioma.php",
			data:stream,
			success: function(data){
				if (data.indexOf("Error")==-1)
				{	
					var idioma=$("#idioma").val().toUpperCase();
					var id_idioma=$("#id_idioma").val();
					var stream="idioma="+idioma+"&"+"id_idioma="+id_idioma;			 
					$.ajax({
						type: "POST",
						url: "update/actualiza_idioma.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_idiomas.php";							
						}			
					});
				}
				else
				{
					$("#idioma").focus ();
					$('#valida-idioma_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-idioma_reg').fadeOut('slow');},1000); 
					$("#idioma").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_idioma=function(){
		var id_idioma = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Idioma?');
		if(action==true)
		{
			var stream="id_idioma="+id_idioma;
			alert (stream);
			$.ajax({
				type: "POST",
				url: "delete/borra_idioma.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_idiomas.php";						
				}			
			});
		}
	}
	// ************************** Crear Cliente Nacional*************************************//
	$.fn.crear_cliente_nacional=function(){
		if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#nom_client").val())==="") 
		{
			$("#nom_client").focus ();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_canal").val())==="") 
		{
			$("#list_canal").focus ();
			$('#valida-list_canal').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_canal').fadeOut('slow');},1000); 
			return false;
		}
		/*if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_regiones").val())==="") 
		{
			$("#list_regiones").focus ();
			$('#valida-region').fadeIn('slow'); 
			setTimeout(function(){$('#valida-region').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_comuna").val())==="") 
		{
			$("#list_comuna").focus ();
			$('#valida-comuna').fadeIn('slow'); 
			setTimeout(function(){$('#valida-comuna').fadeOut('slow');},1000); 
			return false;
		}*/
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_giros").val())==="") 
		{
			$("#list_giros").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#contacto").val())==="") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#list_cargo").val())==="") 
		{
			$("#list_cargo").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#email").val())==="") 
		{
			$("#email").focus ();
			$('#valida-mail').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
			return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
      	{
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}	 	 	 
		if($.trim($("#credito").val())==="") 
		{
			$("#credito").focus ();
			$('#valida-credito').fadeIn('slow'); 
			setTimeout(function(){$('#valida-credito').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_vendedores").val())==="") 
		{
			$("#list_vendedores").focus ();
			$('#valida-list_vendedores').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_vendedores').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#condicion_venta").val())==="") 
		{
			$("#condicion_venta").focus ();
			$('#valida-condicion_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-condicion_venta').fadeOut('slow');},1000); 
			return false;
		}
                var id_lista_precio=$('#lista_precio option:selected').attr('id');
                alert(id_lista_precio);
                if(id_lista_precio=="") 
		{
			$("#lista_precio").focus ();
			$('#valida-precios').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precios').fadeOut('slow');},1000); 
			return false;
		}
		var rut=$("#rut").val();
		var stream="rut="+rut+"&"+"id_cliente=";
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cliente_nacional.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var nombre_cliente=$("#nom_client").val().toUpperCase();
                                        var id_canal=$('#list_canal option:selected').attr('id');
					var direccion=$("#direccion").val();
					var id_region=$('#list_regiones option:selected').attr('id');
					var id_comuna=$('#list_comuna option:selected').attr('id');
					var fono=$("#fono").val();
					var celular=$("#celular").val();
					var id_giro=$('#list_giros option:selected').attr('id');
					var fax=$("#fax").val();
					var id_cargo=$('#list_cargo option:selected').attr('id');
					var email=$("#email").val();
					var contacto=$("#contacto").val().toUpperCase();
					var credito=$("#credito").val();
                                        var id_vendedores=$('#list_vendedores option:selected').attr('id');
                                        var id_condicion=$('#condicion_venta option:selected').attr('id');
                                        var id_lista_precio=$('#lista_precio option:selected').attr('id');
                                        
					var stream="rut="+rut+"&"+"nombre_cliente="+nombre_cliente
                                                +"&"+"fono="+fono+"&"+"celular="+celular+"&"+"id_giro="+id_giro+"&"+"id_cargo="+id_cargo
						+"&"+"email="+email+"&"+"credito="+credito+"&"+"fax="+fax
                                                +"&"+"contacto="+contacto
                                                +"&"+"id_vendedores="+id_vendedores
                                                +"&"+"id_condicion="+id_condicion
                                                +"&"+"id_lista_precio="+id_lista_precio
                                                +"&"+"id_canal="+id_canal;
                                        /*
                                         * var stream="rut="+rut+"&"+"nombre_cliente="+nombre_cliente+"&"+"direccion="+direccion+"&"+"id_region="+id_region
						+"&"+"id_comuna="+id_comuna+"&"+"fono="+fono+"&"+"celular="+celular+"&"+"id_giro="+id_giro+"&"+"id_cargo="+id_cargo
						+"&"+"email="+email+"&"+"credito="+credito+"&"+"fax="+fax+"&"+"contacto="+contacto;
                                         */
					//alert (stream);	
					$.ajax({
						type: "POST",
						url: "insert/inserta_cliente_nacional.php",
						data:stream,
						success: function(data){
							alert (data);
							location.href = "listado_clientes.php";						
						}			
					});
				}
				else
				{
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
				}
			 }			
		});	
	}	
	// ************************** Crear Cliente Internacional*************************************//
	$.fn.crear_cliente_int=function(){
		/*if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
			return false;
		}*/
		if($.trim($("#nom_client").val())==="") 
		{
			$("#nom_client").focus ();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_pais").val())==="") 
		{
			$("#list_pais").focus ();
			$('#valida-pais').fadeIn('slow'); 
			setTimeout(function(){$('#valida-pais').fadeOut('slow');},1000); 
			return false;
		}

		if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#categoria").val())==="") 
		{
			$("#categoria").focus ();
			$('#valida-categoria').fadeIn('slow'); 
			setTimeout(function(){$('#valida-categoria').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#condicion_venta").val())==="") 
		{
			$("#condicion_venta").focus ();
			$('#valida-condicion_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-condicion_venta').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#credito").val())==="") 
		{
		$("credito").focus ();
		$('#valida-credito').fadeIn('slow'); 
		setTimeout(function(){$('#valida-credito').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#list_idiomas").val())==="") 
		{
			$("#list_idiomas").focus ();
			$('#valida-idioma').fadeIn('slow'); 
			setTimeout(function(){$('#valida-idioma').fadeOut('slow');},1000); 
			return false;
		}

		/*if($.trim($("#email").val())==="") 
		{
		$("#email").focus ();
		$('#valida-mail').fadeIn('slow'); 
		setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
		return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
      	{
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}	 	 	 
			
		
		if($.trim($("#contacto").val())==="") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#credito").val())==="") 
		{
			$("#credito").focus ();
			$('#valida-credito').fadeIn('slow'); 
			setTimeout(function(){$('#valida-credito').fadeOut('slow');},1000); 
			return false;
		}*/
		var nombre_cliente=$("#nom_client").val();
		var tip_emp=$("#tip_emp").val();
		var id_pais = $('#list_pais option:selected').attr('id');
		var direccion=$("#direccion").val();
		var telefono=$("#fono").val();
		var fax=$("#fax").val();
		var web=$("#web").val();
		var categoria = $('#categoria option:selected').attr('id');
		var condicion_venta = $('#condicion_venta option:selected').attr('id');
		var credito=$("#credito").val();
		var moneda=$("#moneda").val();
		var id_idioma = $('#list_idiomas option:selected').attr('id');

		var contacto1=$("#contacto1").val();
		var email1=$("#email1").val();
		var fono1=$("#fono1").val();
		var fecha1=$("#fecha1").val();
		var contacto2=$("#contacto2").val();
		var email2=$("#email2").val();
		var fono2=$("#fono2").val();
		var fecha2=$("#fecha2").val();
		var contacto3=$("#contacto3").val();
		var email3=$("#email3").val();
		var fono3=$("#fono3").val();
		var fecha3=$("#fecha3").val();
		var contacto4=$("#contacto4").val();
		var email4=$("#email4").val();
		var fono4=$("#fono4").val();
		var fecha4=$("#fecha4").val();
		var contacto5=$("#contacto5").val();
		var email5=$("#email5").val();
		var fono5=$("#fono5").val();
		var fecha5=$("#fecha5").val();
		var contacto6=$("#contacto6").val();
		var email6=$("#email6").val();
		var fono6=$("#fono6").val();
		var fecha6=$("#fecha6").val();


		/*var email=$("#email").val();
		
		var contacto=$("#contacto").val();
		var rut=$("#rut").val();*/
		
		var stream="nombre_cliente="+nombre_cliente+"&"+"funcion="+1;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_cliente_internacional.php",
						data:stream,
						success: function(data) {					
							if (data.indexOf("Error")==-1)
							{			
								var stream="nombre_cliente="+nombre_cliente
									+"&"+"tip_emp="+tip_emp
									+"&"+"id_pais="+id_pais
									+"&"+"direccion="+direccion
									+"&"+"telefono="+telefono
									+"&"+"fax="+fax
									+"&"+"web="+web
									+"&"+"categoria="+categoria
									+"&"+"condicion_venta="+condicion_venta
									+"&"+"credito="+credito
									+"&"+"moneda="+moneda
									+"&"+"id_idioma="+id_idioma
									+"&"+"contacto1="+contacto1
									+"&"+"email1="+email1
									+"&"+"fono1="+fono1
									+"&"+"fecha1="+fecha1
									+"&"+"contacto2="+contacto2
									+"&"+"email2="+email2
									+"&"+"fono2="+fono2
									+"&"+"fecha2="+fecha2
									+"&"+"contacto3="+contacto3
									+"&"+"email3="+email3
									+"&"+"fono3="+fono3
									+"&"+"fecha3="+fecha3
									+"&"+"contacto4="+contacto4
									+"&"+"email4="+email4
									+"&"+"fono4="+fono4
									+"&"+"fecha4="+fecha4
									+"&"+"contacto5="+contacto5
									+"&"+"email5="+email5
									+"&"+"fono5="+fono5
									+"&"+"fecha5="+fecha5
									+"&"+"contacto6="+contacto6
									+"&"+"email6="+email6
									+"&"+"fono6="+fono6
									+"&"+"fecha6="+fecha6;
								//alert(stream);
								$.ajax({
									type: "POST",
									url: "insert/inserta_cliente_internacional.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_clientes.php";						
									}			
								});
							}
							else
							{
								$('#valida-cliente_R').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cliente_R').fadeOut('slow');},1000); 
								$("#nom_client").val('');
								return false;
							}
						 }			
					});


		/*var stream="rut="+rut+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cliente_internacional.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{		
							
				}
				else
				{
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
					$("#rut").val('');
					return false;
				}
			}			
		});	*/
	}
	// **************************Actualizar Cliente*************************************//
	$.fn.actualiza_cliente_inter=function()	{
		var id_cliente_int= $(this).parents('tr').find("td").attr('id');
		//location.href = "actualiza_cliente_int.php?id_cliente_int="+id_cliente_int;
                //location.href = "crear_cliente_internacional.php?id_cliente_int="+id_cliente_int;
                var stream="id_cliente_int="+id_cliente_int
                                    +"&"+"funcion="+1;
                               $.ajax({
                                    type: "POST",
                                    url: "select/trae_objetos_cliente_internacional.php",
                                    data:stream,
                                    success: function(data) {
                                           //$('#detalle_expor2').html("");
                                           $('#cliente_actu').html("");
                                           $('#cliente_actu').append(data);
                                          // var tot1=$("#tot1").val();
                                           //var tot2=$("#tot2").val();
                                           //var sum=tot1+tot2;
                                           

                                    }			
                            });
	}
        /*
         $.fn.actualiza_cliente_int=function()	{
		var id_cliente_int= $(this).parents('tr').find("td").attr('id');
		//location.href = "actualiza_cliente_int.php?id_cliente_int="+id_cliente_int;
                location.href = "crear_cliente_internacional.php?id_cliente_int="+id_cliente_int;
	}
         */
	// ************************** Actualizar Cliente Internacional*************************************//
	$.fn.actualizar_cliente_int=function(){
		if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('##valida-rut').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#nom_client").val())==="") 
		{
			$("#nom_client").focus ();
			$('#valida-cliente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}
	 	if($.trim($("#paises").val())==="0") 
		{
			$("#paises").focus ();
			$('#valida-paises').fadeIn('slow'); 
			setTimeout(function(){$('#valida-paises').fadeOut('slow');},1000); 
			return false;
		}	 	 
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#email").val())==="") 
		{
		$("#email").focus ();
		$('#valida-mail').fadeIn('slow'); 
		setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
		return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
      	{
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}		
		if($.trim($("#idiomas").val())==="0") 
		{
			$("#idiomas").focus ();
			$('#valida-idiomas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-idiomas').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#contacto").val())==="0") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#credito").val())==="0") 
		{
			$("#credito").focus ();
			$('#valida-credito').fadeIn('slow'); 
			setTimeout(function(){$('#valida-credito').fadeOut('slow');},1000); 
			return false;
		}
		var nombre_cliente=$("#nom_client").val();
		var id_pais = $('#paises option:selected').attr('id');
		var telefono=$("#fono").val();
		var id_idioma = $('#idiomas option:selected').attr('id');
		var email=$("#email").val();
		var contacto=$("#contacto").val();
		var direccion=$("#direccion").val();
		var id_cliente_int=$("#id_cliente_int").val();
		var rut=$("#rut").val();
		var credito=$("#credito").val();
		var stream="rut="+rut+"&"+"id_cliente_int="+id_cliente_int+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_cliente_internacional.php",
			data:stream,
			success: function(data) {	
				if (data.indexOf("Error")==-1)
				{		
					var stream="nombre_cliente="+nombre_cliente+"&"+"id_cliente_int="+id_cliente_int+"&"+"funcion="+2;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_cliente_internacional.php",
						data:stream,
						success: function(data) {					
							if (data.indexOf("Error")==-1)
							{			
								var stream="nombre_cliente="+nombre_cliente+"&"+"id_pais="+id_pais+"&"+"telefono="+telefono+"&"+"id_idioma="+id_idioma
									+"&"+"email="+email+"&"+"direccion="+direccion+"&"+"id_cliente_int="+id_cliente_int+"&"+"contacto="+contacto
									+"&"+"rut="+rut+"&"+"credito="+credito;
								$.ajax({
									type: "POST",
									url: "update/actualiza_cliente_internacional.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_clientes.php";						
									}			
								}); 
							}
							else
							{
								$('#valida-cliente_R').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cliente_R').fadeOut('slow');},1000);
								$("#nom_client").val('');
								return false;
							}
						 }			
					});	
				}
				else
				{
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
					$("#rut").val('');
					return false;
				}
			}			
		});	
	}
	// **************************Eliminar *************************************//
	$.fn.borra_cliente_int=function(){
		var id_cliente_int = $(this).parents('tr').find("td").attr('id');
                //alert(id_cliente_int);
		var action = confirm('Esta seguro que desea eliminar este Cliente?');
		if(action==true)
		{
			var stream="id_cliente_int="+id_cliente_int;
			$.ajax({
				type: "POST",
				url: "delete/borra_cliente_int.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_clientes.php";						
				}			
			});
		}
	}
	// ************************** Crear crear_Proveedor_nacional*************************************//
	$.fn.ingresa_prov_nacional=function(){
		if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#proveedor").val())==="") 
		{
			$("#proveedor").focus ();
			$('#valida-Proveedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Proveedor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_reg").val())==="") 
		{
			$("#list_reg").focus ();
			$('#valida-list_reg').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_reg').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_prov").val())==="") 
		{
			$("#list_prov").focus ();
			$('#valida-list_prov').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_prov').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_com").val())==="") 
		{
			$("#list_com").focus ();
			$('#valida-list_com').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_com').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#giro").val())==="") 
		{
			$("#giro").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#contacto").val())==="") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_cargo").val())==="") 
		{
			$("#list_cargo").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#celular").val())==="") 
		{
			$("#celular").focus ();
			$('#valida-celular').fadeIn('slow'); 
			setTimeout(function(){$('#valida-celular').fadeOut('slow');},1000); 
			return false;
		}
		
			
		
		if($.trim($("#email").val())==="") 
		{
			$("#email").focus ();
			$('#valida-mail').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
			return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
                {
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}	 	 	 
		if($.trim($("#condicion_venta").val())==="") 
		{
			$("#condicion_venta").focus ();
			$('#valida-condicion_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-condicion_venta').fadeOut('slow');},1000); 
			return false;
		}	
		var rut=$("#rut").val();
                //var id_proveedor="";
               alert(rut);
		var stream="rut="+rut;
                 //+"&"+"proveedor"+proveedor;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_proveedor_nacional.php",
			data:stream,
			success: function(data) {
                            alert(data);
				//if (data==0)
                                if (data.indexOf("Error")==-1)
				{	
					 var proveedor=$("#proveedor").val().toUpperCase();
					var direccion=$("#direccion").val().toUpperCase();
					var id_region=$('#list_reg option:selected').attr('id');
                                        var id_prov=$('#list_prov option:selected').attr('id');
					var id_comuna=$('#list_com option:selected').attr('id');
					var fono=$("#fono").val();
                                        var fax=$("#fax").val();
                                        var giro=$("#giro").val().toUpperCase();
                                        var contacto=$("#contacto").val().toUpperCase();
                                        var id_cargo=$('#list_cargo option:selected').attr('id');
					var celular=$("#celular").val();
					var email=$("#email").val();
                                        var cond_pago=$('#condicion_venta option:selected').attr('id');//$("#condicion_venta").val();
					var contacto_cobra=$("#contacto_cobra").val().toUpperCase();
					var email2=$("#email2").val();
                                        var tipo=2;
					var stream="rut="+rut
                                                +"&"+"proveedor="+proveedor
                                                +"&"+"direccion="+direccion
                                                +"&"+"id_region="+id_region
                                                +"&"+"id_prov="+id_prov
						+"&"+"id_comuna="+id_comuna
                                                +"&"+"fono="+fono
                                                +"&"+"fax="+fax
                                                +"&"+"giro="+giro
                                                +"&"+"contacto="+contacto
                                                +"&"+"id_cargo="+id_cargo
                                                +"&"+"celular="+celular
                                                +"&"+"email="+email
                                                +"&"+"cond_pago="+cond_pago
                                                +"&"+"contacto_cobra="+contacto_cobra
                                                +"&"+"email2="+email2
                                                +"&"+"tipo="+tipo;
					$.ajax({
						type: "POST",
						url: "insert/inserta_proveedor.php",
						data:stream,
						success: function(data){
							alert (data);
							location.href = "listado_proveedores.php";						
						}			
					});
				}
				else
                                //if (data==1)
				{
					//$('#valida-rut2').fadeIn('slow');
                                        //alert("Existe");
                                        $("#rut").focus ();
                                        $('#rut').val(''); 
                                        $('#valida-rut2').fadeIn('slow'); 
                                        setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
					//setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
				}
			 }			
		});		 	 
	}
	// **************************Actualizar Proveedor*************************************//
	$.fn.actualiza_proveedor_nacional=function(){
		var id_proveedor_nacional= $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_proveedor_nac.php?id_proveedor_nacional="+id_proveedor_nacional;
	}
	$.fn.actualizar_prov_nacional=function(){
		if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#proveedor").val())==="") 
		{
			$("#proveedor").focus ();
			$('#valida-Proveedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Proveedor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_reg").val())==="0") 
		{
			$("#list_reg").focus ();
			$('#valida-list_reg').fadeIn('slow'); 
			setTimeout(function(){$('#valida-region').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_prov").val())==="") 
		{
			$("#list_prov").focus ();
			$('#valida-list_prov').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_prov').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_com").val())==="") 
		{
			$("#list_com").focus ();
			$('#valida-list_com').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_com').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#giro").val())==="") 
		{
			$("#giro").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#contacto").val())==="") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_cargo").val())==="") 
		{
			$("#list_cargo").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#celular").val())==="") 
		{
			$("#celular").focus ();
			$('#valida-celular').fadeIn('slow'); 
			setTimeout(function(){$('#valida-celular').fadeOut('slow');},1000); 
			return false;
		}
		
			
		
		if($.trim($("#email").val())==="") 
		{
			$("#email").focus ();
			$('#valida-mail').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
			return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
      	{
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}	 	 	 
		if($.trim($("#condicion_venta").val())==="") 
		{
			$("#condicion_venta").focus ();
			$('#valida-condicion_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-condicion_venta').fadeOut('slow');},1000); 
			return false;
		}
		var rut=$("#rut").val();
		var id_proveedor=$("#id_proveedor").val();	
		var stream="rut="+rut+"&"+"id_proveedor="+id_proveedor;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_proveedor_nacional.php",
			data:stream,
			success: function(data) {	
                            //alert(data);
				if (data.indexOf("Error")==-1)
				{	
					var proveedor=$("#proveedor").val();
					var direccion=$("#direccion").val();
					var id_region=$('#list_reg option:selected').attr('id');
					var id_provincia=$('#list_prov option:selected').attr('id');
                                        var id_comuna=$('#list_com option:selected').attr('id');
					var fono=$("#fono").val();
                                        var fax=$("#fax").val();
                                        var giro=$("#giro").val();
                                        var contacto=$("#contacto").val();
                                        var id_cargo=$('#list_cargo option:selected').attr('id');
					var celular=$("#celular").val();
					var email=$("#email").val();					
					var cond_pago=$('#condicion_venta option:selected').attr('id');
                                        var contacto2=$("#contacto_cobra").val();
                                        var email2=$("#email2").val();	                                        
					var id_proveedor=$("#id_proveedor").val();	
                                        
					var stream="rut="+rut
                                                +"&"+"proveedor="+proveedor
                                                +"&"+"direccion="+direccion
                                                +"&"+"id_region="+id_region
						+"&"+"id_provincia="+id_provincia
                                                +"&"+"id_comuna="+id_comuna
                                                +"&"+"fono="+fono
                                                +"&"+"fax="+fax
                                                +"&"+"giro="+giro
                                                +"&"+"contacto="+contacto
                                                +"&"+"id_cargo="+id_cargo
                                                +"&"+"celular="+celular
						+"&"+"email="+email
                                                +"&"+"cond_pago="+cond_pago
                                                +"&"+"contacto2="+contacto2
                                                +"&"+"email2="+email2
                                                +"&"+"id_proveedor="+id_proveedor;
					$.ajax({
						type: "POST",
						url: "update/actualiza_proveedor_nacional.php",
						data:stream,
						success: function(data){
							alert (data);
							location.href = "listado_proveedores.php";						
						}			
					});
				}
				else
				{
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
				}
			 }			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_prov_nac=function(){
		var id_prov_nac = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Proveedor?');
		if(action==true)
		{
			var stream="id_prov_nac="+id_prov_nac;
			$.ajax({
				type: "POST",
				url: "delete/borra_proveedor_nacional.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_proveedores_nacionales.php";						
				}			
			});
		}
	}
	// ************************** Crear prov_internacional*************************************//
	$.fn.ingresa_prov_internacional=function(){
		/*if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
			return false;
		}*/
		if($.trim($("#proveedor").val())==="") 
		{
			$("#proveedor").focus ();
			$('#valida-Proveedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Proveedor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_pais").val())==="") 
		{
			$("#list_pais").focus ();
			$('#valida-pais').fadeIn('slow'); 
			setTimeout(function(){$('#valida-pais').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#giro").val())==="") 
		{
			$("#giro").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#contacto").val())==="") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#list_cargo").val())==="") 
		{
			$("#list_cargo").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#email").val())==="") 
		{
			$("#email").focus ();
			$('#valida-mail').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
			return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
      	{
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}	 	 	 
		if($.trim($("#condicion_venta").val())==="") 
		{
			$("#condicion_venta").focus ();
			$('#valida-condicion_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-condicion_venta').fadeOut('slow');},1000); 
			return false;
		}
		//var rut=$("#rut").val();
                var proveedor=$("#proveedor").val();
		var stream="proveedor="+proveedor+"&"+"funcion="+3;
                //var stream="rut="+rut+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_proveedor_internacional.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					
					/*var stream="proveedor="+proveedor+"&"+"funcion="+1;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_proveedor_internacional.php",
						data:stream,
						success: function(data) {
							if (data.indexOf("Error")==-1)
							{*/	
								var proveedor=$("#proveedor").val().toUpperCase();
								var direccion=$("#direccion").val().toUpperCase();
								var id_pais=$('#list_pais option:selected').attr('id');
								var fono=$("#fono").val();
                                                                var fax=$("#fax").val();
								var giro=$("#giro").val();
                                                                var contacto=$("#contacto").val().toUpperCase();
								var id_cargo=$('#list_cargo option:selected').attr('id');
                                                                var celular=$("#celular").val();
								var email=$("#email").val();
								var cond_pago=$('#condicion_venta option:selected').attr('id');
								//var cond_pago=$("#cond_pago").val();
                                                                var contacto2=$("#contacto_cobra").val().toUpperCase();
                                                                var email2=$("#email2").val();
                                                                
								var stream="proveedor="+proveedor
                                                                        +"&"+"direccion="+direccion
                                                                        +"&"+"id_pais="+id_pais
                                                                        +"&"+"fono="+fono
                                                                        +"&"+"fax="+fax
									+"&"+"giro="+giro
                                                                        +"&"+"contacto="+contacto
                                                                        +"&"+"id_cargo="+id_cargo
                                                                        +"&"+"celular="+celular
                                                                        +"&"+"email="+email
                                                                        +"&"+"cond_pago="+cond_pago
                                                                        +"&"+"contacto2="+contacto2
                                                                        +"&"+"email2="+email2;								
								$.ajax({
									type: "POST",
									url: "insert/inserta_proveedor_internacional.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_proveedores.php";
                                                                                //location.href = "listado_proveedores_internacionales.php";
									}			
								});
							/*}
							else
							{
								$('#valida-Proveedor_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-Proveedor_r').fadeOut('slow');},1000); 
								$('#proveedor').val('');								
								return false;
							}
						 }			
					});	*/
				}
				else
				{
					$('#valida-Proveedor_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-Proveedor_r').fadeOut('slow');},1000); 
								$('#proveedor').val('');								
								return false;
                                                                /*$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000);
					$("#rut").val("");
					return false;*/
				}
			}			
		});	
	}
	// **************************Actualizar Cliente*************************************//
	$.fn.actualiza_proveedor_inertnacional=function(){
		var id_proveedor_internacional= $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_proveedor_internacional.php?id_proveedor_internacional="+id_proveedor_internacional;
	}
	// ************************** Crear prov_internacional*************************************//
	$.fn.actualizar_prov_internacional=function(){
		/*if($.trim($("#rut").val())==="") 
		{
			$("#rut").focus ();
			$('#valida-rut').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
			return false;
		}*/
		if($.trim($("#proveedor").val())==="") 
		{
			$("#proveedor").focus ();
			$('#valida-Proveedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Proveedor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#direccion").val())==="") 
		{
			$("#direccion").focus ();
			$('#valida-direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-direccion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_pais").val())==="") 
		{
			$("#list_pais").focus ();
			$('#valida-pais').fadeIn('slow'); 
			setTimeout(function(){$('#valida-pais').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-telefono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-telefono').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#giro").val())==="") 
		{
			$("#giro").focus ();
			$('#valida-giro').fadeIn('slow'); 
			setTimeout(function(){$('#valida-giro').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#contacto").val())==="") 
		{
			$("#contacto").focus ();
			$('#valida-contacto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contacto').fadeOut('slow');},1000); 
			return false;
		}	
		if($.trim($("#list_cargo").val())==="") 
		{
			$("#list_cargo").focus ();
			$('#valida-cargo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cargo').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#email").val())==="") 
		{
			$("#email").focus ();
			$('#valida-mail').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail').fadeOut('slow');},1000); 
			return false;
		}
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) 
      	{
			$("#email").focus ();
			$('#valida-mail_2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-mail_2').fadeOut('slow');},1000); 
			$("#email").val ("");
			return false;
		}	 	 	 
		if($.trim($("#condicion_venta").val())==="") 
		{
			$("#condicion_venta").focus ();
			$('#valida-condicion_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-condicion_venta').fadeOut('slow');},1000); 
			return false;
		}
		/*var rut=$("#rut").val();
		var id_proveedor=$("#id_proveedor").val();
		var stream="rut="+rut+"&"+"id_proveedor="+id_proveedor+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_proveedor_internacional.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var proveedor=$("#proveedor").val();				
					var stream="proveedor="+proveedor+"&"+"id_proveedor="+id_proveedor+"&"+"funcion="+2;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_proveedor_internacional.php",
						data:stream,
						success: function(data) {
							if (data.indexOf("Error")==-1)
							{*/	
								var proveedor=$("#proveedor").val();
								var direccion=$("#direccion").val();
								var id_pais=$('#list_pais option:selected').attr('id');
								var fono=$("#fono").val();
                                                                var fax=$("#fax").val();
								var giro=$("#giro").val()
                                                                var contacto=$("#contacto").val();
								var id_cargo=$('#lista_cargos option:selected').attr('id');
                                                                var celular=$("#celular").val();
								var email=$("#email").val();
								var cond_pago=$('#condicion_venta option:selected').attr('id');
                                                                var contacto2=$("#contacto_cobra").val();
                                                                var email2=$("#email2").val();
                                                                
								var id_proveedor=$("#id_proveedor").val();
								var stream="proveedor="+proveedor
                                                                        +"&"+"direccion="+direccion
                                                                        +"&"+"id_pais="+id_pais
                                                                        +"&"+"fono="+fono
                                                                        +"&"+"fax="+fax
									+"&"+"giro="+giro
                                                                        +"&"+"contacto="+contacto
                                                                        +"&"+"id_cargo="+id_cargo
                                                                        +"&"+"celular="+celular
                                                                        +"&"+"email="+email                                                                        
                                                                        +"&"+"cond_pago="+cond_pago
                                                                        +"&"+"contacto2="+contacto2
                                                                        +"&"+"email2="+email2
									+"&"+"id_proveedor="+id_proveedor;
                                                                /*var stream="proveedor="+proveedor+"&"+"direccion="+direccion+"&"+"id_pais="+id_pais+"&"+"fono="+fono
									+"&"+"giro="+giro+"&"+"id_cargo="+id_cargo+"&"+"email="+email+"&"+"contacto="+contacto+"&"+"cond_pago="+cond_pago
									+"&"+"id_proveedor="+id_proveedor+"&"+"rut="+rut;*/
								$.ajax({
									type: "POST",
									url: "update/actualiza_proveedor_internacional.php",
									data:stream,
									success: function(data){
										alert (data);
										location.href = "listado_proveedores.php";						
                                                                                //location.href = "listado_proveedores_internacionales.php";						
									}			
								});
							/*}
							else
							{
								$('#valida-Proveedor_r').fadeIn('slow'); 
								setTimeout(function(){$('#valida-Proveedor_r').fadeOut('slow');},1000); 
								$('#proveedor').val('');								
								return false;
							}
						 }			
					});	
				}
				else
				{
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000);
					$("#rut").val("");
					return false;
				}
			 }			
		});	*/
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_proveedor_int=function(){
		var id_prov_int = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Proveedor?');
		if(action==true)
		{
			var stream="id_prov_int="+id_prov_int;
			$.ajax({
				type: "POST",
				url: "delete/borra_proveedor_internacional.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "listado_proveedores_internacionales.php";						
				}			
			});
		}
	}
						
	//cambia segun el select el producto de sector//
	$.fn.cambiar_sector_productos=function(){
		var id_producto= $(this).parents('tr').find("td").attr('id');
		var id_sector=$('.list_sector option:selected').attr('id');
		/*var stream="id_producto="+id_producto+"&"+"id_sector="+id_sector;
			$.ajax({
				type: "POST",
				url: "update/cambio_sector_producto.php",
				data:stream,
				success: function(data){
					alert (data);
					location.reload();						
				}			
			});*/
			alert (id_sector);
 	}
	// ******************************Clave Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_clave=function(){
		if($.trim($("#clave").val())==="") 
		{
			$("#clave").focus ();
			$('#valida-clave').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave').fadeOut('slow');},1000); 
			return false;
		}
		var id_usuario=$("#id_usuario").val();
		var clave=$("#clave").val();
		var stream="id_usuario="+id_usuario+"&"+"clave="+clave;		 
		$.ajax({
			type: "POST",
			url: "insert/ingreso_clave.php",
			data:stream,
			success: function(data){							
				alert (data);
				location.href = "principal.php";							
			}			
		});
	}
	// **************************Comprobar*************************************//		
	$.fn.comprobar_clave_antigua=function(){
		var id_usuario=$('#id_usuario').val();
		var clave=$('#clave_antigua').val().toUpperCase();
		var stream="clave="+clave+"&"+"id_usuario="+id_usuario;		
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_clave_gerencia.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Ok")==-1)
				{
					$("#clave_antigua").focus ();
					$('#valida-clave_antigua_error').fadeIn('slow'); 
					setTimeout(function(){$('#valida-clave_antigua_error').fadeOut('slow');},1000); 
					$("#clave_antigua").val("");
					return false;
				}
			}			
		});
	
	}
	// **************************Actualizar*************************************//		
	$.fn.cambio_clave_aprobacion=function(){
		if($.trim($("#clave_antigua").val())==="") 
		{
			$("#clave_antigua").focus ();
			$('#valida-clave_vacia_antigua').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave_vacia_antigua').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#clave").val())==="") 
		{
			$("#clave").focus ();
			$('#valida-clave').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave').fadeOut('slow');},1000); 
			return false;
		}
		var id_usuario=$("#id_usuario").val();
		var clave=$("#clave").val();
		var stream="id_usuario="+id_usuario+"&"+"clave="+clave;		 
		$.ajax({
			type: "POST",
			url: "update/actualiza_clave_gestion.php",
			data:stream,
			success: function(data){							
				alert (data);
				location.href = "principal.php";							
			}			
		});
	}
	// ******************************Vendedores Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_Vendedor=function(){
		if($.trim($("#Vendedor").val())==="") 
		{
			$("#Vendedor").focus ();
			$('#valida-Vendedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Vendedor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#iniciales").val())==="") 
		{
			$("#iniciales").focus ();
			$('#valida-iniciales').fadeIn('slow'); 
			setTimeout(function(){$('#valida-iniciales').fadeOut('slow');},1000); 
			return false;
		}
		var Vendedor=$("#Vendedor").val().toUpperCase();  
		var stream="Vendedor="+Vendedor+"&"+"funcion="+1;	
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_vendedor.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var iniciales=$("#iniciales").val().toUpperCase();  
					var stream="iniciales="+iniciales+"&"+"funcion="+2;	
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_vendedor.php",
						data:stream,
						success: function(data) {
							if (data.indexOf("Error")==-1)
							{
								var Vendedor=$("#Vendedor").val().toUpperCase(); 
								var iniciales=$("#iniciales").val().toUpperCase();  
								var stream="Vendedor="+Vendedor+"&"+"iniciales="+iniciales+"&"+"funcion="+3;	
								$.ajax({
									type: "POST",
									url: "comprobaciones/comprobar_vendedor.php",
									data:stream,
									success: function(data) {							
										alert (data);
										location.href = "vendedores.php";							
									}			
								});
							}
							else
							{
								$("#iniciales").focus ();
								$('#valida-iniciales_reg').fadeIn('slow'); 
								setTimeout(function(){$('#valida-iniciales_reg').fadeOut('slow');},1000); 
								$("#iniciales").val ("");
								return false;
							}
						}			
					});
				}
				else
				{
					$("#Vendedor").focus ();
					$('#valida-Vendedor_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Vendedor_reg').fadeOut('slow');},1000); 
					$("#Vendedor").val ("");
				 	return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_vendedor=function(){
		var id_vendedor = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_vendedor.php?id_vendedor="+id_vendedor;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_vendedor=function( ){		
		if($.trim($("#Vendedor").val())==="") 
		{
			$("#Vendedor").focus ();
			$('#valida-Vendedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Vendedor').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#iniciales").val())==="") 
		{
			$("#iniciales").focus ();
			$('#valida-iniciales').fadeIn('slow'); 
			setTimeout(function(){$('#valida-iniciales').fadeOut('slow');},1000); 
			return false;
		}
		var Vendedor=$("#Vendedor").val().toUpperCase(); 
		var id_vendedor=$("#id_vendedor").val(); 
		var stream="Vendedor="+Vendedor+"&"+"id_vendedor="+id_vendedor+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_vendedor.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var iniciales=$("#iniciales").val().toUpperCase();  
					var stream="iniciales="+iniciales+"&"+"id_vendedor="+id_vendedor+"&"+"funcion="+5;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_vendedor.php",
						data:stream,
						success: function(data) {
							if (data.indexOf("Error")==-1)
							{
								var stream="id_vendedor="+id_vendedor+"&"+"iniciales="+iniciales+"&"+"Vendedor="+Vendedor+"&"+"funcion="+6;	
								$.ajax({
									type: "POST",
									url: "comprobaciones/comprobar_vendedor.php",
									data:stream,
									success: function(data) {							
										alert (data);
										location.href = "vendedores.php";							
									}			
								});
							}
							else
							{
								$("#iniciales").focus ();
								$('#valida-iniciales_reg').fadeIn('slow'); 
								setTimeout(function(){$('#valida-iniciales_reg').fadeOut('slow');},1000); 
								$("#iniciales").val ("");
								return false;
							}
						}			
					});
				}
				else
				{
					$("#Vendedor").focus ();
					$('#valida-Vendedor_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Vendedor_reg').fadeOut('slow');},1000); 
					$("#Vendedor").val ("");
				 	return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_vendedor=function(){
		var id_vendedor = $(this).parents('tr').find("td").attr('id');
		var stream="id_vendedor="+id_vendedor;
		var action = confirm('Esta seguro que desea eliminar este Vendedor?');
		if(action==true)
		{
			var stream="id_vendedor="+id_vendedor+"&"+"funcion="+7;	
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_vendedor.php",
				data:stream,
				success: function(data)	{
					alert (data);
					location.href = "vendedores.php";
				}			
			});
		}
	}	
	// ******************************Condiciones de Pago Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_condicion=function(){
		if($.trim($("#Condicion").val())==="") 
		{
			$("#Condicion").focus ();
			$('#valida-Condicion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Condicion').fadeOut('slow');},1000); 
			return false;
		}
		var Condicion=$("#Condicion").val().toUpperCase();  
		var stream="Condicion="+Condicion+"&"+"funcion="+1;	
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_condicion_pago.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="Condicion="+Condicion+"&"+"funcion="+2;	
					alert (stream);
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_condicion_pago.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "condiciones_pago.php";							
						}			
					});
				}
				else
				{
					$("#Condicion").focus ();
					$('#valida-Condicion_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Condicion_reg').fadeOut('slow');},1000); 
					$("#Condicion").val ("");
					return false;
				}
			}			
		});
	}
        
        //*Ingresa Canal Cliente*//
        $.fn.ingresa_canal=function(){
		if($.trim($("#canal").val())==="") 
		{
			$("#canal").focus ();
			$('#valida-canal').fadeIn('slow'); 
			setTimeout(function(){$('#valida-canal').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#desc").val())==="") 
		{
			$("#desc").focus ();
			$('#valida-desc').fadeIn('slow'); 
			setTimeout(function(){$('#valida-desc').fadeOut('slow');},1000); 
			return false;
		}
		var canal=$("#canal").val().toUpperCase();  
                var desc=$('#desc').val(); 
		var stream="canal="+canal+"&"+"funcion="+1;	
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_canal.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="canal="+canal
                                                +"&"+"desc="+desc
                                                +"&"+"funcion="+2;	
					//alert (stream);
					$.ajax({
						type: "POST",
						url: "insert/insertar_canal.php",
                                                //url: "comprobaciones/comprobar_canal.php",insertar_canal
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "listado_canal_cliente.php";							
						}			
					});
				}
				else
				{
					$("#canal").focus ();
					$('#valida-canal_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-canal_reg').fadeOut('slow');},1000); 
					$("#canal").val ("");
					return false;
				}
			}			
		});
	}
        
	// **************************Actualiza*************************************//		
	$.fn.actualiza_cond=function(){
		var id_condicion = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_condicion_pago.php?id_condicion="+id_condicion;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_cond=function( ){		
		if($.trim($("#Condicion").val())==="") 
		{
			$("#Condicion").focus ();
			$('#valida-Condicion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Condicion').fadeOut('slow');},1000); 
			return false;
		}
		var Condicion=$("#Condicion").val().toUpperCase(); 
		var id_condicion=$("#id_condicion").val(); 
		var stream="Condicion="+Condicion+"&"+"id_condicion="+id_condicion+"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_condicion_pago.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="Condicion="+Condicion+"&"+"id_condicion="+id_condicion+"&"+"funcion="+5;
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_condicion_pago.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "condiciones_pago.php";							
						}			
					});
				}
				else
				{
					$("#Condicion").focus ();
					$('#valida-Condicion_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Condicion_reg').fadeOut('slow');},1000); 
					$("#Condicion").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.eliminar_cond=function(){
		var id_condicion = $(this).parents('tr').find("td").attr('id');
		var stream="id_condicion="+id_condicion;
		var action = confirm('Esta seguro que desea eliminar esta Condicion de Pago?');
		if(action==true)
		{
			var stream="id_condicion="+id_condicion+"&"+"funcion="+6;	
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_condicion_pago.php",
				data:stream,
				success: function(data)	{
					alert (data);
					location.href = "condiciones_pago.php";
				}			
			});
		}
	}
        
        /**Desabilita Canal*/
        // **************************Eliminar *************************************//
	$.fn.eliminar_canal=function(){
		var id_condicion = $(this).parents('tr').find("td").attr('id');
		var stream="id_condicion="+id_condicion;
                //alert(id_condicion);
		var action = confirm('Esta seguro que desea eliminar Canal?');
		if(action==true)
		{
			var stream="id_condicion="+id_condicion+"&"+"funcion="+6;	
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_canal.php",
				data:stream,
				success: function(data)	{
					alert (data);
					location.href = "listado_canal_cliente.php";
				}			
			});
		}
	}
        
        /*Actualiza Precio*/
        $.fn.actualizar_precio=function(){
		var id_condicion = $(this).parents('tr').find("td").attr('id');
		var stream="id_condicion="+id_condicion;
                //alert(id_condicion);
                var stream="id_condicion="+id_condicion+"&"+"funcion="+3;
				$.ajax({
					type: "POST",
					url: "combos/trae_productos.php",
					data:stream,
					success: function(data)	{	
						//alert(data);
						$('#list_prod_term_proforma').html("");	
						$('#list_prod_term_proforma').append(data);
                                                
                                                var stream="id_condicion="+id_condicion+"&"+"funcion="+4;
                                                $.ajax({
                                                    type: "POST",
                                                    url: "combos/trae_productos.php",
                                                    data:stream,
                                                    cache: false,
                                                    dataType: 'json',
                                                    success: function(data)	{	
                                                        for(i=0;i<data.length;i++)
                                                        {
                                                            $('#busca_pro').val(data[i].prod);
                                                            $('#precio').val(data[i].v_unitario);
                                                            $('#permite_actualiza').val(1);
                                                            
                                                            //$("#precio").attr('disabled', true);                                                                                                                                            
                                                        }
                                                        $("#list_prod_term_proforma").attr('disabled', true);
                                                            //$("#lista_precio").attr('disabled', true);
                                                    }			
                                                });
                                                /*var stream="numero_proforma="+numero_proforma+"&"+"funcion="+5;
                                                                                                                    $.ajax({
                                                                                                                            type: "POST",
                                                                                                                            url: "insert/insertar_proforma.php",
                                                                                                                            data:stream,
                                                                                                                            cache: false,
                                                                                                                            dataType: 'json',
                                                                                                                            success: function(data)	{	
                                                                                                                                    for(i=0;i<data.length;i++)
                                                                                                                                    {
                                                                                                                                            $('#id_direccion_cliente_internacional').html('');
                                                                                                                                            $('#id_direccion_pais').html('');
                                                                                                                                            $('#fecha_proforma').val(data[i].fecha_proforma);
                                                                                                                                            $('#id_cliente_internacional').val(data[i].cliente);
                                                                                                                                            $("#id_cliente_internacional").attr('disabled', true);
                                                                                                                                            
                                                                                                                                    }
                                                                                                                            }			
                                                                                                                    });*/
					}			
				});
		/*var action = confirm('Esta seguro que desea eliminar Canal?');
		if(action==true)
		{
			var stream="id_condicion="+id_condicion+"&"+"funcion="+6;	
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_canal.php",
				data:stream,
				success: function(data)	{
					alert (data);
					location.href = "listado_canal_cliente.php";
				}			
			});
		}*/
	}
        
	/**************Seleciona Region******************/
	/*$.fn.sel_reg=function(){
		//alert("aqui");

		if($.trim($("#list_reg").val())==="") 
		{
			$("#list_reg").focus ();
			$('#valida-list_reg').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_reg').fadeOut('slow');},1000); 
			return false;
		}
		var id_reg = $('#list_reg option:selected').attr('id');
		var stream="id_reg="+id_reg;
		$.ajax({
			type: "POST",
			url: "combos/trae_provincia.php",
			data:stream,
			success: function(data)	{	
				$('list_prov').html("");	
				$('list_prov').append(data);
			}			
		});


	}*/

	// ******************************Condiciones de Pago Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.crear_aduana=function(){
		if($.trim($("#Aduana").val())==="") 
		{
			$("#Aduana").focus ();
			$('#valida-Aduana').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Aduana').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#rut_aduana").val())==="") 
		{
			$("#rut_aduana").focus ();
			$('#valida-rut_aduana').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut_aduana').fadeOut('slow');},1000); 
			return false;
		}
		/*if($.trim($("#Direccion").val())==="") 
		{
			$("#Direccion").focus ();
			$('#valida-Direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Direccion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#Ciudad").val())==="") 
		{
			$("#Ciudad").focus ();
			$('#valida-Ciudad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Ciudad').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#Fono").val())==="") 
		{
			$("#Fono").focus ();
			$('#valida-Fono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Fono').fadeOut('slow');},1000); 
			return false;
		}*/
		var Aduana=$("#Aduana").val();  
		var rut_aduana=$("#rut_aduana").val();
		var direccion=$("#Direccion").val();
		var Ciudad=$("#Ciudad").val();
		var Fono=$("#Fono").val();
		var stream="Aduana="+Aduana+"&"+"funcion="+1;	
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_aduana.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="Aduana="+Aduana+"&"+"rut_aduana="+rut_aduana+"&"+"direccion="+direccion+"&"+"Ciudad="+Ciudad+"&"+"Fono="+Fono+"&"+"funcion="+2;	
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_aduana.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href="aduanas.php";							
						}			
					});
				}
				else
				{
					$("#Aduana").focus ();
					$('#valida-Aduana_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Aduana_reg').fadeOut('slow');},1000); 
					$("#Aduana").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Crea Sucursal Aduana*************************************//		
	$.fn.crear_suc_aduana=function(){
		//alert("aqui");
		if($.trim($("#list_aduanas").val())==="") 
		{
			$("#list_aduanas").focus ();
			$('#valida-list_aduanas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_aduanas').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_reg").val())==="") 
		{
			$("#list_reg").focus ();
			$('#valida-list_reg').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_reg').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_prov").val())==="") 
		{
			$("#list_prov").focus ();
			$('#valida-list_prov').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_prov').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_com").val())==="") 
		{
			$("#list_com").focus ();
			$('#valida-list_com').fadeIn('slow'); 
			setTimeout(function(){$('#valida-list_com').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#fono").val())==="") 
		{
			$("#fono").focus ();
			$('#valida-fono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fono').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#dire").val())==="") 
		{
			$("#dire").focus ();
			$('#valida-dire').fadeIn('slow'); 
			setTimeout(function(){$('#valida-dire').fadeOut('slow');},1000); 
			return false;
		}
		var id_adu = $('#list_aduanas option:selected').attr('id');
		var dire=$("#dire").val();  
		var id_reg = $('#list_reg option:selected').attr('id');
		var id_prov = $('#list_prov option:selected').attr('id');
		var id_com = $('#list_com option:selected').attr('id');
		var Fono=$("#fono").val();
		//alert("aqui");
		var stream="dire="+dire
			+"&"+"id_adu="+id_adu
			+"&"+"funcion="+1;	
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_suc_aduana.php",
			data:stream,
			success: function(data) {
				//alert(data);
				if (data.indexOf("Error")==-1)
				{
					var stream="id_adu="+id_adu
						+"&"+"dire="+dire
						+"&"+"id_reg="+id_reg
						+"&"+"id_prov="+id_prov
						+"&"+"id_com="+id_com
						+"&"+"Fono="+Fono
						+"&"+"funcion="+2;	
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_suc_aduana.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href="listado_sucursales_aduanas.php";							
						}			
					});
				}
				else
				{
					$("#dire").focus ();
					$('#valida-dire').fadeIn('slow'); 
					setTimeout(function(){$('#valida-dire').fadeOut('slow');},1000); 
					$("#dire").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_aduana=function(){
		var id_aduana = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_aduana.php?id_aduana="+id_aduana;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_aduana=function(){		
		if($.trim($("#Aduana").val())==="") 
		{
			$("#Aduana").focus ();
			$('#valida-Aduana').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Aduana').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#rut_aduana").val())==="") 
		{
			$("#rut_aduana").focus ();
			$('#valida-rut_aduana').fadeIn('slow'); 
			setTimeout(function(){$('#valida-rut_aduana').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#Direccion").val())==="") 
		{
			$("#Direccion").focus ();
			$('#valida-Direccion').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Direccion').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#Ciudad").val())==="") 
		{
			$("#Ciudad").focus ();
			$('#valida-Ciudad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Ciudad').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#Fono").val())==="") 
		{
			$("#Fono").focus ();
			$('#valida-Fono').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Fono').fadeOut('slow');},1000); 
			return false;
		}
		var Aduana=$("#Aduana").val();  
		var rut_aduana=$("#rut_aduana").val();
		var direccion=$("#Direccion").val();
		var Ciudad=$("#Ciudad").val();
		var Fono=$("#Fono").val();
		var id_aduana=$("#id_aduana").val();
		var stream="Aduana="+Aduana+"&"+"id_aduana="+id_aduana+"&"+"funcion="+3;	
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_aduana.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="Aduana="+Aduana+"&"+"rut_aduana="+rut_aduana+"&"+"direccion="+direccion+"&"+"Ciudad="+Ciudad+"&"+"Fono="+Fono+"&"+"id_aduana="+id_aduana+"&"+"funcion="+4;	
					$.ajax({
						type: "POST",
						url: "comprobaciones/comprobar_aduana.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href="aduanas.php";							
						}			
					});
				}
				else
				{
					
					$("#Aduana").focus ();
					$('#valida-Aduana_reg').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Aduana_reg').fadeOut('slow');},1000); 
					$("#Aduana").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Eliminar *************************************//
	$.fn.elimina_aduana=function(){
		var id_aduana = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar esta Aduana?');
		if(action==true)
		{
			var stream="id_aduana="+id_aduana+"&"+"funcion="+5;	
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_aduana.php",
				data:stream,
				success: function(data) {							
					alert (data);
					location.href="aduanas.php";							
				}			
			});
		}
	}
        //Elimina Sucural de Aduana
        $.fn.elimina_suc_aduana=function(){
		var id_suc_aduana = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar Sucursal de Aduana?');
		if(action==true)
		{
			var stream="id_suc_aduana="+id_suc_aduana+"&"+"funcion="+6;	
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_aduana.php",
				data:stream,
				success: function(data) {							
					alert (data);
					location.href="listado_sucursales_aduanas.php";							
				}			
			});
		}
	}
	// ****************************************************************//
	// ******************************Banco Funciones ***********************//
	// **************************Ingreso*************************************//		
	$.fn.ingresa_banco=function(){
		if($.trim($("#banco").val())==="") 
		{
			$("#banco").focus ();
			$('#valida-banco').fadeIn('slow'); 
			setTimeout(function(){$('#valida-banco').fadeOut('slow');},1000); 
			return false;
		}
		var banco=$("#banco").val().toUpperCase();  
		var stream="banco="+banco;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_banco.php",
			data:stream,
			success: function(data) {					
				if (data.indexOf("Error")==-1)
				{	
					var banco=$("#banco").val().toUpperCase(); 
					var stream="banco="+banco;			
					alert (stream);
					$.ajax({
						type: "POST",
						url: "insert/inserta_banco.php",
						data:stream,
						success: function(data) {							
							alert (data);
							location.href = "bancos.php";							
						}			
					});
				}
				else
				{
					$("#banco").focus ();
					$('#valida-banco_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-banco_r').fadeOut('slow');},1000); 
					$("#banco").val ("");
					return false;
				}
			}			
		});
	}
	// **************************Actualiza*************************************//		
	$.fn.actualiza_banco=function()	{
		var id_banco = $(this).parents('tr').find("td").attr('id');
		location.href = "actualiza_banco.php?id_banco="+id_banco;
	}
	// ********************Actualiza*******************************************//
	$.fn.actualizar_banco=function( ){		
		if($.trim($("#banco").val())==="") 
		{
			$("#banco").focus ();
			$('#valida-banco').fadeIn('slow'); 
			setTimeout(function(){$('#valida-banco').fadeOut('slow');},1000); 
			return false;
		}
		var banco=$("#banco").val().toUpperCase();
		var id_banco=$("#id_banco").val();
		var stream="banco="+banco+"&"+"id_banco="+id_banco;			
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_banco.php",
			data:stream,
			success: function(data){
		 		if (data.indexOf("Error")==-1)
				{	
					var banco=$("#banco").val().toUpperCase();
					var id_banco=$("#id_banco").val();
					var stream="banco="+banco+"&"+"id_banco="+id_banco;		
					$.ajax({
						type: "POST",
						url: "update/actualiza_banco.php",
						data:stream,
						success: function(data)
						{							
							alert (data);
					 		location.href = "bancos.php";							
						}			
					});
				}
				else
				{
					$("#banco").focus ();
					$('#valida-banco_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-banco_r').fadeOut('slow');},1000); 
					$("#color").val ("");
				 	return false;
				}
			}			
		});
	}
		// **************************Eliminar *************************************//
	$.fn.eliminar_banco=function(){
		var id_banco = $(this).parents('tr').find("td").attr('id');
		var action = confirm('Esta seguro que desea eliminar este Banco?');
		if(action==true)
		{
			var stream="id_banco="+id_banco;
			$.ajax({
				type: "POST",
				url: "delete/borra_banco.php",
				data:stream,
				success: function(data){
					alert (data);
					location.href = "bancos.php";						
				}			
			});
		}
	}
});		