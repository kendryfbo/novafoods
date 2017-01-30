 $(function(){
	 //trae los insumos por familia
	$( "#list_familia" ).change(function() {
		var id_familia = $('#list_familia option:selected').attr('id');
		var stream="id_familia="+id_familia;
		$.ajax({
			type: "POST",
			url: "combos/combo_hijo_producto.php",
			data:stream,
			success: function(data) {					
				$("#td_list_hijo_producto").html("");
				$("#td_list_hijo_producto").append(data);
			}			
		});
	});
        /*
        $( "#list_producto_hijo" ).change(function() {
		var id_producto_hijo = $('#list_producto_hijo option:selected').attr('id');
                alert(id_producto_hijo);
		var stream="id_producto_hijo="+id_producto_hijo;
		$.ajax({
			type: "POST",
			url: "combos/combo_umed_producto_hijo.php",
			data:stream,
			success: function(data) {					
				//$("#td_list_hijo_producto").html("");
				//$("#td_list_hijo_producto").append(data);
                                $("#umed").append(data);
			}			
		});
	});*/
	//llena la tabla trae todos los insumos d la tabla formula por cada producto terminado
	$( "#list_producto_terminado" ).change(function() {
		/*if($.trim($("#niveles").val())==="") 
		{
			$("#niveles").focus ();
			$('#valida-nivel').fadeIn('slow'); 
			setTimeout(function(){$('#valida-nivel').fadeOut('slow');},1000); 
			$("#list_producto_terminado").val("");			
			return false;
		}*/
		var nivel=$("#niveles").val();
	 	var id_producto_terminado = $('#list_producto_terminado option:selected').attr('id');
		var stream="id_producto_terminado="+id_producto_terminado+"&"+"nivel="+nivel;
		$.ajax({
			type: "POST",
			url: "select/trae_insumos_x_producto.php",
			data:stream,
			success: function(data) { 
				$("#tabla_insumos").html("");
				$("#tabla_insumos").append(data);
                                
                                $.ajax({
                                    type: "POST",
                                    url: "select/trae_formato_producto.php",
                                    data:stream,
                                    success: function(data) { 
                                            //$("#tabla_insumos").html("");
                                            //alert(data);
                                            var id_formato = (data);
                                            var stream="id_formato="+id_formato;			 
                                            $.ajax({
                                                type: "POST",
                                                url: "select/trae_formato_display.php",
                                                data:stream,
                                                success: function(data){							
                                                    //alert (data);
                                                    $("#display").val(data);
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "select/trae_formato_sobre.php",
                                                        data:stream,
                                                        success: function(data){							
                                                            //alert (data);
                                                            $("#sobre").val(data);
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "select/trae_formato_contenido.php",
                                                                data:stream,
                                                                success: function(data){							
                                                                    //alert (data);
                                                                    $("#contenido").val(data);
                                                                    var dis=$("#display").val();
                                                                    var sob=$("#sobre").val();
                                                                    var con=$("#contenido").val();
                                                                    var net=(dis*sob*con)/1000;
                                                                    $("#peso_neto").val(net);

                                                                }			

                                                            });
                                                        }			

                                                    });

                                                }			

                                            });
                                    }			
                                });
			}			
		});
	});
        //Actualiza Formula por Desarrollo
        $.fn.actualiza_formula_por_desarrollo=function(){
            var id_producto_terminado = $('#list_producto_terminado option:selected').attr('id');
            //alert(id_producto_terminado);
		var stream="id_producto_terminado="+id_producto_terminado;
		$.ajax({
			type: "POST",
			url: "update/actualiza_formula1.php",
			data:stream,
			success: function(data) { 
		                alert(data);
                                location.href = "crear_formulas_producto_terminado.php";							
			}			
		});
	
	}
        //Aprobacion o Rechazo de Formula
        $.fn.autoriza_prof_gte1=function(){
            var desicion=$('input:radio[name=desicion]:checked').val();
            //alert(id_pedido_proforma+" - "+numero_proforma);
            //alert(desicion);
            if(desicion==1){
                var stream="desicion="+desicion
                        +"&"+"funcion="+1;
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
                        +"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "select/trae_objetos.php",
			data:stream,
			success: function(data) {
                               $('#observa').html("");
                               $('#observa').append(data);
                               var stream="desicion="+desicion
                                +"&"+"funcion="+1;
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
        //Apureba mediante clave o Rechaza
        $.fn.autoriza_prof_gte2=function(){
            
            if($.trim($("#clave").val())==="") 
		{
			$("#clave").focus ();
			$('#valida-clave').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave').fadeOut('slow');},1000); 
			return false;
		}
            var numero_proforma=$('#proforma').val();
            var desicion=$('input:radio[name=desicion]:checked').val();
            var clave=$('#clave').val();
            var version=$('#version').val();
            //alert(numero_proforma);
            
            if(desicion==1){
                var stream="numero_proforma="+numero_proforma
                        +"&"+"clave="+clave
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/valida_clave.php",
			data:stream,
			success: function(data) {
                               //alert(data);
                               if(data==1){
                                   var stream="numero_proforma="+numero_proforma
                                    +"&"+"version="+version
                                        +"&"+"funcion="+2;
                                       $.ajax({
                                            type: "POST",
                                            url: "update/autoriza_formula_producto.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_formulas_por_autorizar.php";
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
                var stream="numero_proforma="+numero_proforma
                        +"&"+"clave="+clave
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/valida_clave.php",
			data:stream,
			success: function(data) {
                               //alert(data);
                               if(data==1){
                                   var stream="numero_proforma="+numero_proforma
                                            +"&"+"observacion="+observacion
                                        +"&"+"funcion="+3;
                                       $.ajax({
                                            type: "POST",
                                            url: "update/autoriza_formula_producto.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_formulas_por_autorizar.php";
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
            }
        }
        
        //Revisa Formula por Aporbar
        // **************************Revisa_formula_por_autorizar *************************************//
	$.fn.Revisa_formula_por_autorizar=function(){
		var id_producto= $(this).parents('tr').find("td").attr('id');
                //alert("Revisa "+id_producto);
                var stream="id_producto="+id_producto;
		$.ajax({
			type: "POST",
			url: "select/trae_formula_por_autorizar.php",//trae_formula_industrial
			data:stream,
			success: function(data) { 
				$("#tabla_1").html("");
				$("#tabla_1").append(data);
                                
			}			
		});
        
	}
        
        //Revisa Formula Industrial
        // **************************Revisa_formula_por_autorizar *************************************//
	$.fn.Revisa_formula_industrial=function(){
		var id_producto= $(this).parents('tr').find("td").attr('id');
                //alert("Revisa "+id_producto);
                var stream="id_producto="+id_producto;
		$.ajax({
			type: "POST",
			url: "select/trae_formula_industrial.php",//
			data:stream,
			success: function(data) { 
				$("#tabla_1").html("");
				$("#tabla_1").append(data);
                                
			}			
		});
        
	}
	//Se seleccina un nivel y deja en blanco el producto para poder cargar la tabla de nuevo
        /*
	$( "#niveles" ).change(function() {
		$('#list_producto_terminado').val("");
		$("#tabla_insumos").html("");
	});*/
        
	//funcion que trae los valores antes de actualizar
	$.fn.actualiza_valores_formulas=function(id){
		$.getJSON("select/trae_valores_insumos_x_producto.php",{id:id},function(data){					
			for(i=0;i<data.length;i++)
			{
				$('#batch').val(data[i].batch);
				$('#caja').val(data[i].caja);
				$('#unidad').val(data[i].unidad);
				$('#niveles').attr('disabled',true);
				$('#list_producto_terminado').attr('disabled',true);
				$('#list_familia').attr('disabled',true);
				$('#td_list_hijo_producto').attr('disabled',true);
				$('#id').val(id);
				$("#actualiza_form").show();
				$("#ingresa_form").hide();
			}					 
		}); 		
	}
        $.fn.busca_umed_producto_hijo=function(){
            var id_producto_hijo = $('#list_producto_hijo option:selected').attr('id');
            //
                if(id_producto_hijo===undefined) 
                {
                    $("#list_producto_hijo").focus ();
                    $('#valida-pruducto_hijo').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-pruducto_hijo').fadeOut('slow');},1000); 
                    return false;
                }
            else{
                //alert(id_producto_hijo);
                var stream="id_producto_hijo="+id_producto_hijo;
		$.ajax({
			type: "POST",
			url: "combos/combo_umed_producto_hijo.php",
			data:stream,
			success: function(data) {					
				//$("#td_list_hijo_producto").html("");
				//$("#td_list_hijo_producto").append(data);
                                $("#umed").val(data);
			}			
		});
            }
		
        }
	//funcion que actualiza los valores de las formulas
	$.fn.actualizar_formulas=function(){
		if($.trim($("#batch").val())==="") 
		{
			$("#batch").focus ();
			$('#valida-Batch').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Batch').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#caja").val())==="") 
		{
			$("#caja").focus ();
			$('#valida-caja').fadeIn('slow'); 
			setTimeout(function(){$('#valida-caja').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#unidad").val())==="") 
		{
			$("#unidad").focus ();
			$('#valida-unidad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-unidad').fadeOut('slow');},1000); 
			return false;
		}
		var id=$('#id').val();
		var batch=$('#batch').val();
		var caja=$('#caja').val();
		var unidad=$('#unidad').val();
		var stream="id="+id+"&"+"batch="+batch+"&"+"caja="+caja+"&"+"unidad="+unidad;
		$.ajax({
			type: "POST",
			url: "update/actualiza_insumos_productos.php",
			data:stream,
			success: function(data) { 
				$("#ingresa_form").show();
				$("#actualiza_form").hide();
				var nivel=$("#niveles").val();
				var id_producto_terminado = $('#list_producto_terminado option:selected').attr('id');
				var stream="id_producto_terminado="+id_producto_terminado+"&"+"nivel="+nivel;
				$.ajax({
					type: "POST",
					url: "select/trae_insumos_x_producto.php",
					data:stream,
					success: function(data) { 
						$("#tabla_insumos").html("");
						$("#tabla_insumos").append(data);
						var batch=$('#batch').val("");
						var caja=$('#caja').val("");
						var unidad=$('#unidad').val("");
						$('#niveles').attr('disabled',false);
						$('#list_producto_terminado').attr('disabled',false);
						$('#list_familia').attr('disabled',false);
						$('#td_list_hijo_producto').attr('disabled',false);
					}			
				});
			}			
		});
	}
        $.fn.calcula_formulas=function(){
            if($.trim($("#list_producto_terminado").val())==="") 
		{
				$("#list_producto_terminado").focus ();
				$('#valida-prod_ter').fadeIn('slow'); 
				setTimeout(function(){$('#valida-prod_ter').fadeOut('slow');},1000); 
				return false;
		}
		if($.trim($("#list_familia").val())==="") 
		{
				$("#list_familia").focus ();
				$('#valida-familia').fadeIn('slow'); 
				setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
				return false;
		}
		if($.trim($("#list_producto_hijo").val())==="") 
		{
				$("#list_producto_hijo").focus ();
				$('#valida-pruducto_hijo').fadeIn('slow'); 
				setTimeout(function(){$('#valida-pruducto_hijo').fadeOut('slow');},1000); 
				return false;
		}
                if($.trim($("#niveles").val())==="") 
		{
				$("#niveles").focus ();
				$('#valida-nivel').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nivel').fadeOut('slow');},1000); 
				return false;
		}
                if($.trim($("#tbatch").val())==="") 
		{
				$("#tbatch").focus ();
				$('#valida-tbatch').fadeIn('slow'); 
				setTimeout(function(){$('#valida-tbatch').fadeOut('slow');},1000); 
				return false;
		}
                if($.trim($("#unidad").val())==="") 
		{
			$("#unidad").focus ();
			$('#valida-unidad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-unidad').fadeOut('slow');},1000); 
			return false;
		}
            var tbatch=$("#tbatch").val();    
            var unidad=$("#unidad").val();
            var display=$("#display").val();
            var sobre=$("#sobre").val();
            var contenido=$("#contenido").val();
            var umed=$("#umed").val();
            if(umed==1){
                var calcaj=(display*sobre)*unidad;
                $("#caja").val(calcaj);
                var ncajas=tbatch/(display*sobre*contenido)
                var calbat=calcaj*ncajas;
                $("#batch").val(calbat);
            }else{
                var calcaj=(unidad*(display*sobre))/1000;
                $("#caja").val(calcaj);
                var calbat=calcaj*((tbatch*1000)/(display*sobre*contenido));
                $("#batch").val(calbat);
            }
            
            
            //alert("Hola");
        }
	// funcion que ingresa las formulas y comprueba que el producto no este repetido 
	$.fn.ingresar_formulas=function(){
		if($.trim($("#list_producto_terminado").val())==="") 
		{
				$("#list_producto_terminado").focus ();
				$('#valida-prod_ter').fadeIn('slow'); 
				setTimeout(function(){$('#valida-prod_ter').fadeOut('slow');},1000); 
				return false;
		}
		if($.trim($("#list_familia").val())==="") 
		{
				$("#list_familia").focus ();
				$('#valida-familia').fadeIn('slow'); 
				setTimeout(function(){$('#valida-familia').fadeOut('slow');},1000); 
				return false;
		}
		if($.trim($("#list_producto_hijo").val())==="") 
		{
				$("#list_producto_hijo").focus ();
				$('#valida-pruducto_hijo').fadeIn('slow'); 
				setTimeout(function(){$('#valida-pruducto_hijo').fadeOut('slow');},1000); 
				return false;
		}
                if($.trim($("#niveles").val())==="") 
		{
				$("#niveles").focus ();
				$('#valida-nivel').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nivel').fadeOut('slow');},1000); 
				return false;
		}
                if($.trim($("#tbatch").val())==="") 
		{
				$("#tbatch").focus ();
				$('#valida-tbatch').fadeIn('slow'); 
				setTimeout(function(){$('#valida-tbatch').fadeOut('slow');},1000); 
				return false;
		}
                if($.trim($("#unidad").val())==="") 
		{
			$("#unidad").focus ();
			$('#valida-unidad').fadeIn('slow'); 
			setTimeout(function(){$('#valida-unidad').fadeOut('slow');},1000); 
			return false;
		}
		/*
		if($.trim($("#caja").val())==="") 
		{
			$("#caja").focus ();
			$('#valida-caja').fadeIn('slow'); 
			setTimeout(function(){$('#valida-caja').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#batch").val())==="") 
		{
			$("#batch").focus ();
			$('#valida-Batch').fadeIn('slow'); 
			setTimeout(function(){$('#valida-Batch').fadeOut('slow');},1000); 
			return false;
		}*/
		var id_producto_terminado = $('#list_producto_terminado option:selected').attr('id');
		var id_producto_hijo = $('#list_producto_hijo option:selected').attr('id');
		var nivel = $('#niveles option:selected').val();
		var stream="id_producto_terminado="+id_producto_terminado+"&"+"id_producto_hijo="+id_producto_hijo+"&"+"nivel="+nivel;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_insumo_en_formula.php",
			data:stream,
			success: function(data) { 
				if (data.indexOf("Error")==-1)
				{
					var batch=$('#batch').val();
					var caja=$('#caja').val();
					var unidad=$('#unidad').val();
					var stream="id_producto_terminado="+id_producto_terminado+"&"+"id_producto_hijo="+id_producto_hijo+"&"+"nivel="+nivel
						+"&"+"batch="+batch+"&"+"caja="+caja+"&"+"unidad="+unidad;
					$.ajax({
						type: "POST",
						url: "insert/inserta_mat_prima_producto_final.php",
						data:stream,
						success: function(data) {
							var stream="id_producto_terminado="+id_producto_terminado+"&"+"nivel="+nivel;
							$.ajax({
								type: "POST",
								url: "select/trae_insumos_x_producto.php",
								data:stream,
								success: function(data) { 
									$("#tabla_insumos").html("");
									$("#tabla_insumos").append(data);
								}			
							});
						}			
					});
				}
				else
				{
					$("#list_producto_hijo").focus ();
					$('#valida-pruducto_hijo_r').fadeIn('slow'); 
					setTimeout(function(){$('#valida-pruducto_hijo_r').fadeOut('slow');},2000);
					$("#list_producto_hijo").val ("");
					var batch=$('#batch').val("");
					var caja=$('#caja').val("");
					var unidad=$('#unidad').val("");
				}
			}			
		});
	}
	//funcion que elimina los valores mal ingresados en las formulas
	$.fn.eliminar_valores_formulas=function(id){
		var stream="id="+id;
		$.ajax({
			type: "POST",
			url: "delete/borra_insumo_x_producto.php",
			data:stream,
			success: function(data) { 
				$("#tabla_insumos").find("#"+id).remove();
			}			
		});
	
	}
        
});