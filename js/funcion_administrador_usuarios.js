 $(function(){
	 	//***Crear los datos de los usuarios-******
	$.fn.crear_usuario=function(){
		if($.trim($("#rut").val())==="") 
		{
		$("#rut").focus ();
		$('#valida-rut').fadeIn('slow'); 
		setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#usuario").val())==="") 
		{
		$("#usuario").focus ();
		$('#valida-usuario').fadeIn('slow'); 
		setTimeout(function(){$('#valida-usuario').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#nombre").val())==="") 
		{
		$("#nombre").focus ();
		$('#valida-nombre').fadeIn('slow'); 
		setTimeout(function(){$('#valida-nombre').fadeOut('slow');},1000); 
		return false;
		}
		if($("#password").val()==="") 
		{
		$("#password").focus ();
		$('#valida-password').fadeIn('slow'); 
		setTimeout(function(){$('#valida-password').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#apellido").val())==="") 
		{
		$("#apellido").focus ();
		$('#valida-apellido').fadeIn('slow'); 
		setTimeout(function(){$('#valida-apellido').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#Email").val())==="") 
		{
		$("#Email").focus ();
		$('#valida-#Email').fadeIn('slow'); 
		setTimeout(function(){$('#valida-#Email').fadeOut('slow');},1000); 
		return false;
		}
		if($("#Email").val().indexOf('@', 0) == -1 || $("#Email").val().indexOf('.', 0) == -1) 
      	{
			$("#Email").focus ();
			$('#valida-Email2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Email2').fadeOut('slow');},1000); 
			$("#Email").val ("");
			return false;
		}
		if($("#list_tipo_usuario").val()==="") 
		{
			$("#list_tipo_usuario").focus ();
			$('#valida-tipo_usuario').fadeIn('slow'); 
			setTimeout(function(){$('#valida-tipo_usuario').fadeOut('slow');},1000); 
		 
			return false;
		}
		if($("#list_sector_usuario").val()==="") 
		{
			$("#list_sector_usuario").focus ();
			$('#valida-sector_usuario').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sector_usuario').fadeOut('slow');},1000); 
		 
			return false;
		}
		var id_sector_usuario = $('#list_sector_usuario option:selected').attr('id');
		var id_tipo_usuario = $('#list_tipo_usuario option:selected').attr('id');
		var id_usuario_modificar=$("#id_usuario_modificar").val();
		var stream="rut="+$("#rut").val()+"&"+"id_usuario_modificar="+id_usuario_modificar;
		$.ajax({
			type: "POST",
			url: "select/comprobar_rut.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="usuario="+$("#usuario").val()+"&"+"id_usuario_modificar="+id_usuario_modificar;
					$.ajax({
						type: "POST",
						url: "select/comprobar_usuario.php",
						data:stream,
						success: function(data) {
							if (data.indexOf("Error")==-1)
							{
						
								var stream="rut="+$("#rut").val()+"&"+"usuario="+$("#usuario").val()+"&"+"nombre="+$("#nombre").val()
								+"&"+"password="+$("#password").val()+"&"+"apellido="+$("#apellido").val().toUpperCase()+"&"+"email="+$("#Email").val().toUpperCase()
									+"&"+"id_tipo_usuario="+id_tipo_usuario+"&"+"id_sector_usuario="+id_sector_usuario;
								$.ajax({
									type: "POST",
									url: "insert/inserta_usuario.php",
									data:stream,
									success: function(data) {
										alert (data);
										location.href = "listado_usuarios.php";
									}				
								});
							}
							else
							{
								$("#usuario").focus ();
								$('#valida-usuario2').fadeIn('slow'); 
								setTimeout(function(){$('#valida-usuario2').fadeOut('slow');},1000); 
								$("#usuario").val ("");
								return false;
							}
						}
					});
				}
				else
				{
					$("#rut").focus ();
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
					$("#rut").val ("");
					return false;
				}
			}			
		});
	}
		//***Edita los datos de los usuarios-******
	$.fn.actualizar_usuario=function(){
		if($.trim($("#rut").val())==="") 
		{
		$("#rut").focus ();
		$('#valida-rut').fadeIn('slow'); 
		setTimeout(function(){$('#valida-rut').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#usuario").val())==="") 
		{
		$("#usuario").focus ();
		$('#valida-usuario').fadeIn('slow'); 
		setTimeout(function(){$('#valida-usuario').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#nombre").val())==="") 
		{
		$("#nombre").focus ();
		$('#valida-nombre').fadeIn('slow'); 
		setTimeout(function(){$('#valida-nombre').fadeOut('slow');},1000); 
		return false;
		}
		if($("#password").val()==="") 
		{
		$("#password").focus ();
		$('#valida-password').fadeIn('slow'); 
		setTimeout(function(){$('#valida-password').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#apellido").val())==="") 
		{
		$("#apellido").focus ();
		$('#valida-apellido').fadeIn('slow'); 
		setTimeout(function(){$('#valida-apellido').fadeOut('slow');},1000); 
		return false;
		}
		if($.trim($("#Email").val())==="") 
		{
		$("#Email").focus ();
		$('#valida-#Email').fadeIn('slow'); 
		setTimeout(function(){$('#valida-#Email').fadeOut('slow');},1000); 
		return false;
		}
		if($("#Email").val().indexOf('@', 0) == -1 || $("#Email").val().indexOf('.', 0) == -1) 
      	{
			$("#Email").focus ();
			$('#valida-Email2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Email2').fadeOut('slow');},1000); 
			$("#Email").val ("");
			return false;
		}
		if($("#list_tipo_usuario").val()==="") 
		{
			$("#list_tipo_usuario").focus ();
			$('#valida-tipo_usuario').fadeIn('slow'); 
			setTimeout(function(){$('#valida-tipo_usuario').fadeOut('slow');},1000); 
			return false;
		}
		if($("#list_sector_usuario").val()==="") 
		{
			$("#list_sector_usuario").focus ();
			$('#valida-sector_usuario').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sector_usuario').fadeOut('slow');},1000); 
		 	return false;
		}
		var id_sector_usuario = $('#list_sector_usuario option:selected').attr('id');
		var id_tipo_usuario = $('#list_tipo_usuario option:selected').attr('id');
		var id_usuario_modificar=$("#id_usuario_modificar").val();
		var stream="rut="+rut+"&"+"id_usuario_modificar="+id_usuario_modificar;
		$.ajax({
			type: "POST",
			url: "select/comprobar_rut.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="usuario="+$("#usuario").val()+"&"+"id_usuario_modificar="+id_usuario_modificar;
					$.ajax({
						type: "POST",
						url: "select/comprobar_usuario.php",
						data:stream,
						success: function(data) {
							if (data.indexOf("Error")==-1)
							{
						
								var stream="rut="+$("#rut").val()+"&"+"usuario="+$("#usuario").val().toUpperCase()+"&"+"nombre="+$("#nombre").val()
								+"&"+"password="+$("#password").val()+"&"+"apellido="+$("#apellido").val().toUpperCase()
								+"&"+"email="+$("#Email").val().toUpperCase()+"&"+"id_usuario_modificar="+id_usuario_modificar
									+"&"+"id_tipo_usuario="+id_tipo_usuario+"&"+"id_sector_usuario="+id_sector_usuario;
								$.ajax({
									type: "POST",
									url: "update/actualiza_usuario.php",
									data:stream,
									success: function(data) {
										alert (data);
										location.href = "listado_usuarios.php";
									}			
								});			
							}
							else
							{
								$("#usuario").focus ();
								$('#valida-usuario2').fadeIn('slow'); 
								setTimeout(function(){$('#valida-usuario2').fadeOut('slow');},1000); 
								$("#usuario").val ("");
								return false;
							}
						}
					});				
				}
				else
				{
					alert (data);
					$("#rut").focus ();
					$('#valida-rut2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-rut2').fadeOut('slow');},1000); 
					$("#rut").val ("");
					return false;
				}
			}			
		});
	}	
			//***cambio de estado por el interruptor-******
	$.fn.cambio_estado=function(id_usuario){
		var stream="id_usuario="+id_usuario;		 
		$.ajax({
			type: "POST",
			url: "update/actualiza_estado_usuario.php",
			data:stream,
			success: function(data) {					
						
				$('#estado').empty()
				$('#estado').append(data);	
					
			}			
		});
	}
		//***cambio de Paginas por el interruptor******
 	$.fn.ingresa_pagina=function(id_usuario,id_pagina,funcion){
		var stream="id_usuario="+id_usuario+"&"+"id_pagina="+id_pagina+"&"+"funcion="+funcion;	
		$.ajax({
			type: "POST",
			url: "delete/borra_pagina_x_usuario.php",
			data:stream,
			success: function(data) {					
				$('#paginas tbody').empty();
				$('#paginas tbody').append(data);								
			}			
		});
	}	
		//--*********comprueba el usuario *****--//
	$('#usuario').change(function(){
		var usuario=$("#usuario").val().toUpperCase();
		var id_usuario=$("#id_usuario_modificar").val();
		var stream="usuario="+usuario+"&"+"id_usuario="+id_usuario;
 		$.ajax({
			type: "POST",
			url: "select/comprobar_usuario.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
				}
				else
				{	
					$("#usuario").focus ();
					$('#valida-usuario2').fadeIn('slow'); 
					setTimeout(function(){$('#valida-usuario2').fadeOut('slow');},1000); 
					$("#usuario").val ("");					
					return false;
				}
			}			
		});
	});
	//--*********envia el id que se va a modificar a la pagina *****--//
	$.fn.envia_actualizar_usuario=function(){
		var id_usuario_modificar=$(this).parents("tr").find("td").first().attr("id");
		location.href = "gestion_paginas.php?id_usuario_modificar="+id_usuario_modificar; 	 
	}
		// **************************Elimina Ususarios de bodega mal ingresados*************************************//		
	$.fn.elimina_usuarios=function(){
		var id_usuario=$(this).parents("tr").find("td").first().attr("id");		
		var stream="id_usuario="+id_usuario;
		$.ajax({
			type: "POST",
			url: "delete/borra_usuario.php",
			data:stream,
			success: function(data) {						
				location.href = "listado_usuarios.php";
			}			
		});
	} 	 
});	