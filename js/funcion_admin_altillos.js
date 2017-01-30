 $(function(){
//--*********carga el select de id altillo*****--//
	$("#list_vereda").html("<option  selected>Seleccione Vereda...</option>");
	for(var i=1;i<=10;i++)
	{
		$("#list_vereda").append("<option value='"+i+"'>"+i+"</option>");
	}
	//--*********carga las carcteristicas al seleccionar el id *****--//
	$('#list_vereda').change(function(){
		$('#num_vereda').hide();
		$('#caract_vereda').show();
	});
	$.fn.ingresa_alto=function(){
		if($.trim($("#altura").val())==="") 
		{
			$("#altura").focus ();
			$('#valida-alto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-alto').fadeOut('slow');},1000); 
			$("#altura").val ("");			 
			return false;
		}
		var vereda=$('#list_vereda').val();
		var altura=$('#altura').val();
		$('#caract_vereda').hide();
		$('#largo_vereda').show();
		$('#list_lugar').val(altura);
		var temporal=$('#altura').val();
 		var stream="vereda="+vereda;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_ingreso_vereda.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{	
					$('#tbl_altura_altillo').append("<tr><td  bgcolor='#cacaca'><label>Vereda " +vereda+ "</label></td></tr>");
					for(var i=1;i<=altura;i++)
					{
						var id_posicion_bodega = temporal;
						var stream="vereda="+vereda+"&"+"id_posicion_bodega="+id_posicion_bodega;
						$('#tbl_altura_altillo').append("<tr id='"+vereda+temporal+"'><td  width='10%'>A-"+temporal+"</td>");
						temporal--;
	 				}
				}
				else
				{
					alert ("Esta Vereda se Encuentra Registrada");
					$('#num_altillo').show();
					$('#caract_altillo').hide();
					$('#largo_altillo').hide();
					location.href="crear_bodega.php";
				}
			}
		});	
		var temporal2=$('#altura').val();
		for(var i=1;i<=altura;i++)
		{
			$("#list_lugar").append("<option value='"+temporal2+"'>"+temporal2+"</option>");
			temporal2--;
		}
	}	
	//--*********carga el largo de el altillo segun la posicion*****--//
	$.fn.ingresa_largo=function(){
		if($.trim($("#largo").val())==="") 
		{
			$("#largo").focus ();
			$('#valida-largo').fadeIn('slow'); 
			setTimeout(function(){$('#valida-largo').fadeOut('slow');},1000); 
			return false;
		}
		var vereda=$('#list_vereda').val();
		var largo=$('#largo').val();
        var lugar=$('#list_lugar').val();
		var id_posicion_bodega = $('#list_lugar').val();
		var altura=$('#altura').val();
        for(var i=1;i<=largo;i++)
		{	
			$("#"+vereda+lugar+"").append("<td>"+i+"</td></tr>");
		}	
		var stream="id_posicion_bodega="+id_posicion_bodega+"&"+"largo="+largo+"&"+"vereda="+vereda+"&"+"altura="+altura;
		$.ajax({
			type: "POST",
			url: "update/ingreso_largo_vereda_bodega.php",
			data:stream,
			success: function(data) {
			}
		});				
        $("#list_lugar option:selected").remove();
		var selected_value = $('#list_lugar').val();
		if(selected_value)
		{
		}
		else
		{		 	
			var vereda=$('#list_vereda').val();
			$("#list_vereda").find("option[value='"+vereda+"']").remove(); 
			$('#num_vereda').show();
	 		$("#largo_vereda").hide();	
		}
	}
	//ingresa las Caracteristicas a cada espacio
	$('#ingreso_caracteristicas').click(function(){
		if($.trim($("#list_familia").val())==="") 
		{
			$("#list_familia").focus ();
			$('#valida-familia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
			return false;
		}
		/*if($.trim($("#kilos").val())==="") 
		{
			$("#kilos").focus ();
			$('#valida-kilos').fadeIn('slow'); 
			setTimeout(function(){$('#valida-kilos').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#altura").val())==="") 
		{
			$("#altura").focus ();
			$('#valida-altura').fadeIn('slow'); 
			setTimeout(function(){$('#valida-altura').fadeOut('slow');},1000); 
			return false;
		}*/
	 	$("input:checkbox:checked").each(function(){
            var posicion=$(this).attr('id');
			var sector=$(this).val();
			var id_familia = $('#list_familia option:selected').attr('id');
			var stream="posicion="+posicion+"&"+"sector="+sector+"&"+"id_familia="+id_familia;	
			$.ajax({
				type: "POST",
				url: "update/actualiza_caracteristicas_bodega.php",
				data:stream,
				success: function(data)	{
					if(data==1)
					{
						alert("La Posicion "+posicion+" Se Encuentra Ocupada");
					}
					else if(data==2)
					{
						alert("Se actualizó el registro");
						/*location.href = "ingresar_carcteristicas_veredas.php";	*/	
				    }
					else if(data==3)
					{
						alert("No se actualizó el registro");
				    }																		
				}			
			});
		});
 
	});
	$.fn.detalle_espacio=function( ){
		var vereda=$("#list_vereda").val();
		var posicion= $(this).attr('id');
		var stream="posicion="+posicion+"&"+"vereda="+vereda;	
		$.ajax({
			type: "POST",
			url: "select/traer_detalle_posicion.php",
			data:stream,
			success: function(data)	{								
			
				//alert (data);
				$("#tbl_detalle_posicion").html("");
				
				$("#tbl_detalle_posicion").append(data);
				 
				//$("#"+posicion).attr("bgcolor","#FFFFFF");  
				//$("#marca").val ("");
				//location.href = "ver_bodega.php";													
			}			
		});
		 //$(this).attr("bgcolor","#FFFFFF");   
	 
  

	}
 
	//funcion que muestra el detalle de la posicion para el usuario que familia,kilos,altura ocupada
	/*$.fn.detalle_espacio=function(sector_altillo,posicion){
		var numero_altillo = $('#select_altillo option:selected').attr('id');		
		var valor_de_posicion=sector_altillo+"_"+posicion;
		var stream="valor_de_posicion="+valor_de_posicion+"&"+"numero_altillo="+numero_altillo;
		$.ajax({
			type: "POST",
			url: "select/traer_detalle_altillo_bodega.php",
			data:stream,
			success: function(data) {
				$("#tbl_detalle_altillo").html("");
				$("#tbl_detalle_altillo").append(data);
			}
		});	
	}*/
	//Funcion que  trae las propiedades de el espacio
	$.fn.trae_espacio_modificar=function(id_posicion){
		var sector=1;
		var stream="id_posicion="+id_posicion+"&"+"sector="+sector;
		$.ajax({
			type: "POST",
			url: "update/actualiza_caracteristicas_altillo.php",
			data:stream,
			success: function(data) {
				$("#tbl_detalle_altillo > tbody").html("");
				$("#tbl_detalle_altillo > tbody").append(data);
			}
		});	
	}
		//Funcion que modifica las propiedades de el espacio
	$.fn.modificar_espacio=function(id_posicion){
		if($.trim($("#kilos").val())==="") 
		{
			$("#kilos").focus ();
			$('#valida-kilos').fadeIn('slow'); 
			setTimeout(function(){$('#valida-kilos').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#altura").val())==="") 
		{
			$("#altura").focus ();
			$('#valida-altura').fadeIn('slow'); 
			setTimeout(function(){$('#valida-altura').fadeOut('slow');},1000); 
			return false;
		}
	 	var id_familia = $('#familias option:selected').attr('id');
		var kilos=$('#kilos').val();
		var altura=$('#altura').val();
		var sector=2;
		var stream="id_posicion="+id_posicion+"&"+"sector="+sector+"&"+"id_familia="+id_familia+"&"+"kilos="+kilos+"&"+"altura="+altura;
		$.ajax({
			type: "POST",
			url: "update/actualiza_caracteristicas_altillo.php",
			data:stream,
			success: function(data) {
				var numero_altillo = $('#select_altillo option:selected').attr('id');		
				var valor_de_posicion = data;		
				var stream="valor_de_posicion="+valor_de_posicion+"&"+"numero_altillo="+numero_altillo;
				$.ajax({
					type: "POST",
					url: "select/traer_detalle_altillo_bodega.php",
					data:stream,
					success: function(data) {
						$("#tbl_detalle_altillo").html("");
						$("#tbl_detalle_altillo").append(data);
					}
				});
			}
		});	
	}
	




	// funcion que se selecciona un espacio y llena la tabla con los espacios q se van ocupandoo
/*	$.fn.detalle=function(id_altillo,posicion){
		var lugar = $(this).attr('id');
		var numero_altillo = $('#select_altillo option:selected').attr('id');		
		var valor_de_posicion=id_altillo+"_"+posicion;
		var stream="valor_de_posicion="+valor_de_posicion+"&"+"numero_altillo="+numero_altillo+"&"+"lugar="+lugar;
		$.ajax({
				type: "POST",
				url: "insert/ingreso_posicion_bodega.php",
				data:stream,
				success: function(data) {
				 	var altillo = $('#select_altillo option:selected').attr('id');
					var stream="altillo="+altillo;
					$.ajax({
						type: "POST",
						url: "select/traer_altillo_bodega.php",
						data:stream,
						success: function(data) {
							$("#tbl_altura_altillo").html("");
							$("#tbl_altura_altillo").append(data);
						}
					});	
				}
			});	
 
	}   */
	var stream="";
	$.ajax({
		type: "POST",
		url: "combos/combo_altillo.php",
		data:stream,
		success: function(data) {
			$("#select_altillo").append(data);
		}
	});	

	
		/*****************combo Altillos ******///
/*	$.getJSON("combos/combo_altillo.php",function(resultado){
		
		$("#list_vereda_traer").html("<option value='' selected>Seleccione Altillo...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_vereda_traer").append("<option id='"+resultado[i].id_altillo+"' value='"+resultado[i].id_altillo+"'>"+resultado[i].id_altillo+"</option>");
		}
	
	});*/
	/**********************///
	
});	