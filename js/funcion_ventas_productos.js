$(function(){
        /*$.fn.fil_lista_precio=function(){
            if($.trim($("#lista_precio").val())==="") 
		{
			$("#lista_precio").focus ();
			$('#valida-precios').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precios').fadeOut('slow');},1000); 
			return false;
		}
            alert("hola");
        }*/
        
	/*******Filtra por aduana***********/
	 $( "#lis_aduanas" ).change(function() {
		// alert("aqui");
		if($.trim($("#lis_aduanas").val())==="") 
		{
			$("#lis_aduanas").focus ();
			$('#valida-#lis_aduanas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-lis_aduanas').fadeOut('slow');},1000); 
			return false;
		}
		var id_adu = $('#lis_aduanas option:selected').attr('id');
//		alert(id_adu);
		var stream="id_adu="+id_adu;
		$.ajax({
			type: "POST",
			url: "combos/trae_suc_aduana.php",
			data:stream,
			success: function(data)	{	
				//alert(data);
				$('#lis_suc_aduanas').html("");	
				$('#lis_suc_aduanas').append(data);
			}			
		});
	});

	///ingresal las opciones de el impuesto segun el usuario
	$( "#clausula_venta").change(function() {
		var impuesto = $('#clausula_venta option:selected').attr('id');
		if (impuesto==1)
		{
			$('#tit_total').html("");
			var tipo_impuesto= $('#clausula_venta option:selected').val();
			$('#tit_total').append('<label>Total '+tipo_impuesto+'</label>');
			$('#freight').prop('disabled', false);
			$('#insurance').prop('disabled', false);
		}
		else if (impuesto==2)
		{
			$('#tit_total').html("");
			var tipo_impuesto= $('#clausula_venta option:selected').val();
			$('#tit_total').append('<label>Total '+tipo_impuesto+'</label>');
			$('#freight').prop('disabled', true);
			$('#insurance').prop('disabled', true);	
			$('#freight').val('0');
			$('#insurance').val('0');
			var freight=$("#freight").val();
			var insurance=$("#insurance").val();
			if (freight=="")
			{
				freight=0;
			}
			if (insurance=="")
			{
				insurance=0;
			}
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total=parseFloat(freight)+parseFloat(insurance);
			var total_neto=(subtotal-total_descuento);
			var total2=parseFloat(total)+parseFloat(total_neto);
			$('#total').val(total2);
		}
		else if (impuesto==3)
		{
			$('#tit_total').html("");
			var tipo_impuesto= $('#clausula_venta option:selected').val();
			$('#tit_total').append('<label>Total '+tipo_impuesto+'</label>');
			$('#insurance').prop('disabled', true);
			$('#freight').prop('disabled', false);
			$('#insurance').val('0');
			var freight=$("#freight").val();
			var insurance=$("#insurance").val();
			if (freight=="")
			{
				freight=0;
			}
			if (insurance=="")
			{
				insurance=0;
			}
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total=parseFloat(freight)+parseFloat(insurance);
			var total_neto=(subtotal-total_descuento);
			var total2=parseFloat(total)+parseFloat(total_neto);
			$('#total').val(total2);
		}		
	});
	//funcion que trae el stock de los prooductos que se van pidiendo
	$("#list_prod_term").change(function() {
                var numero_nota_venta=$("#num_nota_venta").val();
                if(numero_nota_venta=="") 
                        {
                                $("#num_nota_venta").focus();
                                $("#list_prod_term_proforma").val ("");
                                $('#valida-nota_venta_Vacia').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-nota_venta_Vacia').fadeOut('slow');},1000); 
                                return false;
                        }
                var cliente=$('#id_cliente_nacional option:selected').attr('id');
                //alert(cliente);
                if(cliente===undefined) 
                        {
                                $("#id_cliente_nacional").focus();
                                $("#list_prod_term_proforma").val ("");
                                $('#valida-c_nac').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
                                return false;
                        }
  		if($.trim($("#lista_precio option:selected").attr('id'))=="") 
		{
			$("#list_prod_term").val ("");	
			$("#precio").val("");
			$("#cajas").val("");
			$("#descuento").val (0);
			$("#lista_precio").focus();
			$('#valida-precios').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precios').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#lista_precio option:selected").attr('id'))=="0") 
		{
			$("#list_prod_term").val ("");	
			$("#precio").val("");
			$("#cajas").val("");
			$("#descuento").val (0);
			$("#lista_precio").focus();
			$('#valida-precios').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precios').fadeOut('slow');},1000); 
			return false;
		}		
		//var lista_precio=$('#lista_precio option:selected').attr('id');
                var lista_precio=$('#lista_cli option:selected').attr('id');
                
		var id_producto=$('#list_prod_term option:selected').attr('id');
                //alert(lista_precio+"-"+id_producto);
		//var stream="id_producto="+id_producto+"&"+"funcion="+1;
                var stream="id_producto="+id_producto+"&"+"lista_precio="+lista_precio+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/trae_stcok_producto.php",
					data:stream,
					success: function(data) {
						$('#precio').val(data); 
                                                var stream="id_producto="+id_producto+"&"+"funcion="+4;
                                                $.ajax({
                                                        type: "POST",
                                                        url: "select/trae_stcok_producto.php",
                                                        data:stream,
                                                        success: function(data) {
                                                                $('#ila_pro').val(data); 
                                                                $("#cajas").focus();
                                                        }			
                                                });
					}			
				});
                /*
		$.ajax({
			type: "POST",
			url: "select/trae_stcok_producto.php",
			data:stream,
			success: function(data) {
				$('#stock').html(""); 
				$('#stock').append(data); 
				$('#stock').fadeIn('slow'); 
				setTimeout(function(){$('#stock').fadeOut('slow');},3000); 
				var stream="id_producto="+id_producto+"&"+"lista_precio="+lista_precio+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/trae_stcok_producto.php",
					data:stream,
					success: function(data) {
						$('#precio').val(data); 
					}			
				});
			}			
		});*/	
	});
	//funcion que trae el stock de los prooductos que se van pidiendo
	$("#list_prod_term_proforma").change(function() {
		var id_producto=$('#list_prod_term_proforma option:selected').attr('id');
		var stream="id_producto="+id_producto+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/trae_stcok_producto.php",
			data:stream,
			success: function(data) {
				$('#stock').html(""); 
				$('#stock').append(data); 
				$('#stock').fadeIn('slow'); 
				setTimeout(function(){$('#stock').fadeOut('slow');},3000); 				
			}			
		});	
	});
	///********Ingresa los Productos a la tabla de proforma******///
	$.fn.ingresa_producto_proforma=function(){		
		if($.trim($("#cajas").val())==="") 
		{
			$("#cajas").focus();
			$('#valida-cajas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cajas').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#precio").val())==="") 
		{
			$("#precio").focus();
			$('#valida-precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#precio").val())==="0") 
		{
			$("#precio").focus();
			$('#valida-precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_prod_term_proforma").val())==="") 
		{
			$("#list_prod_term_proforma").focus();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		var precio=$("#precio").val();
		var numero_proforma=$("#num_proforma").val();		
		var cajas=$("#cajas").val();
		var id_usuario=$("#id_usuario").val();		
		var id_producto=$('#list_prod_term_proforma option:selected').attr('id');
		var stream="id_producto="+id_producto+"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto_proforma.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto
						+"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+1+"&"+"id_usuario="+id_usuario;
					$.ajax({
						type: "POST",
						url: "insert/ingresa_producto_proforma.php",
						data:stream,
						success: function(data) {							
							$('#productos_finanzas').append(data);		
							$("#list_prod_term_proforma").val ("");	
							$("#precio").val("");
							$("#cajas").val("");
							$("#descuento").val (0);
							var num_prof=$('#num_prof').val();		
							$('#num_proforma').val(num_prof);		
							var numero_proforma=$('#num_proforma').val();							
							var stream="numero_proforma="+numero_proforma+"&"+"funcion="+1;
							$.ajax({
								type: "POST",
								url: "select/trae_subtotal_proforma.php",
								data:stream,
								success: function(data) {
									$('#subtotal').val(data);
									var freight=$("#freight").val();
									var insurance=$("#insurance").val();
									var descuento=$("#descuento").val();
									var subtotal=$('#subtotal').val(); 
									var total_descuento=(subtotal*descuento)/100;
									var total=parseFloat(freight)+parseFloat(insurance);
									var total_neto=(subtotal-total_descuento);
									var total2=parseFloat(total)+parseFloat(total_neto);
									$('#total').val(total2);
								}			
							});
						}			
					});
				}
				else
				{
					$("#list_prod_term_proforma").focus ();
					$('#valida-productos_repetidos').fadeIn('slow'); 
					setTimeout(function(){$('#valida-productos_repetidos').fadeOut('slow');},1000); 
					$("#list_prod_term_proforma").val ("");	
					$("#precio").val("");
					$("#cajas").val("");
					return false;
				}				
			}			
		});
	}
	///Funcion que ingresa el descuento segun lo anotado en el text
	$("#descuento").change(function() {
		if ($('#subtotal').val()=="0")
		{
			$('#descuento').val("0");
		}
		else if  ($('#descuento').val()=="")
		{
			$('#descuento').val("0");
		}
			var freight=$("#freight").val();
			var insurance=$("#insurance").val();
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total=parseFloat(freight)+parseFloat(insurance);
			var total_neto=(subtotal-total_descuento);
			var total2=parseFloat(total)+parseFloat(total_neto);
			$('#total').val(total2.toFixed(3));
                        $('#fob').val(total2.toFixed(3));
	});
	///Funcion que suma el valor de freight 
	$("#freight").change(function() {
		if ($('#subtotal').val()=="0")
		{
			$('#freight').val("0");
		}
		else if  ($('#freight').val()=="")
		{
			$('#freight').val("0");
		}
			var freight=$("#freight").val();
			var insurance=$("#insurance").val();
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total=parseFloat(freight)+parseFloat(insurance);
			var total_neto=(subtotal-total_descuento);
			var total2=parseFloat(total)+parseFloat(total_neto);
			$('#total').val(total2);		 
	});
	///Funcion que suma el valor de insurance 
	$("#insurance").change(function() {
		if ($('#subtotal').val()=="0")
		{
			$('#insurance').val("0");
		}
		else if  ($('#insurance').val()=="")
		{
			$('#insurance').val("0");
		}
			var freight=$("#freight").val();
			var insurance=$("#insurance").val();
			var descuento=$("#descuento").val();
			var subtotal=$('#subtotal').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total=parseFloat(freight)+parseFloat(insurance);
			var total_neto=(subtotal-total_descuento);
			var total2=parseFloat(total)+parseFloat(total_neto);
			$('#total').val(total2);
	});
        //Filtros
        //Rango Fecha
        $.fn.rango_fecha=function(){
            //alert("Hola");
            var ranfec=$('input:checkbox[name=ranfec]:checked').val();
            
            //$("#fechas_fil").Show();
            
            if(ranfec==="1"){
                document.getElementById('fechas_fil').style.display = 'block';
                //document.getElementById('fil4').style.display = 'block';
               
            }else{
               //$('#fechas_fil').html("");
               document.getElementById('fechas_fil').style.display = 'none';
               //document.getElementById('fil4').style.display = 'none';
            }
        }
        //Rango Cliente
        $.fn.rango_cliente=function(){
            //alert("Hola");
            var rancli=$('input:checkbox[name=rancli]:checked').val();
            
            //$("#fechas_fil").Show();
            
            if(rancli==="1"){
                document.getElementById('fechas_fil2').style.display = 'block';
               //document.getElementById('fil4').style.display = 'block';
            }else{
               //document.getElementById('fil4').style.display = 'none';
               document.getElementById('fechas_fil2').style.display = 'none';
            }
        }
        $.fn.rango_producto=function(){
            //alert("Hola");
            var ranpro=$('input:checkbox[name=ranpro]:checked').val();
            
            //$("#fechas_fil").Show();
            
            if(ranpro==="1"){
                document.getElementById('fechas_fil3').style.display = 'block';
               //document.getElementById('fil4').style.display = 'block';
            }else{
               //document.getElementById('fil4').style.display = 'none';
               document.getElementById('fechas_fil3').style.display = 'none';
            }
        }
        ///Ver detalle Ventas Exportacion
        $.fn.Detalle_ventas_export=function(numero){
            
		//var numero=$('#num_proforma').val();
                //alert(numero);
                var stream="numero="+numero
                        +"&"+"funcion="+10;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               //$('#observa').html("");
                               $('#detalle_expor2').html("");
                               $('#detalle_expor2').append(data);
			}			
		});
		//window.open('select/imprimir_datos_facturas.php?funcion='+4+'&numero='+numero);
                //$("#cabeza_proforma").html("");
                
                /*var stream="numero="+numero+"&"+"funcion="+2;
		$.ajax({
                    type: "POST",
                    url: "select/trae_proforma_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_proforma').html("");	
			$('#cabeza_proforma').append(data);
                    }			
		});*/
	}
        
        $.fn.Filtro_ventas_export=function(){
            //alert("Hola");
            var ranfec=$('input:checkbox[name=ranfec]:checked').val();
            var rancli=$('input:checkbox[name=rancli]:checked').val();
            var ranpro=$('input:checkbox[name=ranpro]:checked').val();
            //alert("fecha"+ranfec+","+"cliente"+rancli+","+"producto"+ranpro);
            /*if(ranfec==1 && rancli==1 && ranpro==1){
                
            }*/
            if(ranfec==1 && rancli===undefined && ranpro===undefined){
                if($.trim($("#fecha1").val())==="") 
		{
			$("#fecha1").focus ();
			$('#valida-fecha1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha1').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha2").val())==="") 
		{
			$("#fecha2").focus ();
			$('#valida-fecha2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha2').fadeOut('slow');},1000); 
			return false;
		}
                var fecha1=$("#fecha1").val();
                var fecha2=$("#fecha2").val();
                var stream="fecha1="+fecha1
                        +"&"+"fecha2="+fecha2
                        +"&"+"funcion="+1;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
                               //notas de Credito
                               var tot1=$("#tot1").val();
                               //alert(tot1);
                               var stream="fecha1="+fecha1
                                    +"&"+"fecha2="+fecha2
                                    +"&"+"tot1="+tot1
                                    +"&"+"funcion="+6;
                               $.ajax({
                                    type: "POST",
                                    url: "select/trae_objetos_informe_export_detalle.php",
                                    data:stream,
                                    success: function(data) {
                                           //$('#detalle_expor2').html("");
                                           $('#detalle_credito').html("");
                                           $('#detalle_credito').append(data);
                                          // var tot1=$("#tot1").val();
                                           //var tot2=$("#tot2").val();
                                           //var sum=tot1+tot2;
                                           

                                    }			
                            });
			}			
		});
            }
            //por Cliente
            if(rancli==1 && ranfec===undefined && ranpro===undefined){
                if($.trim($("#id_cliente_internacional").val())==="0") 
		{
				$("#id_cliente_internacional").focus ();
                                $('#valida-cliente').fadeIn('slow'); 
				setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1300); 
				return false;
		}
                var id_cliente_int=$('#id_cliente_internacional option:selected').attr('id');
                var stream="id_cliente_int="+id_cliente_int
                        +"&"+"funcion="+2;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
			}			
		});
            }
            //Por Producto
            if(ranpro==1 && ranfec===undefined && rancli===undefined){
                if($.trim($("#list_prod_term_proforma").val())==="") 
		{
				$("#list_prod_term_proforma").focus ();
                                $('#valida-producto').fadeIn('slow'); 
				setTimeout(function(){$('#valida-producto').fadeOut('slow');},1300); 
				return false;
		}
                var list_prod_term_proforma=$('#list_prod_term_proforma option:selected').attr('id');
                var stream="list_prod_term_proforma="+list_prod_term_proforma
                        +"&"+"funcion="+3;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
			}			
		});
            }
            //Por fecha y Cliente
            if(ranfec==1 && rancli==1 && ranpro===undefined){
                if($.trim($("#fecha1").val())==="") 
		{
			$("#fecha1").focus ();
			$('#valida-fecha1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha1').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha2").val())==="") 
		{
			$("#fecha2").focus ();
			$('#valida-fecha2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha2').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#id_cliente_internacional").val())==="0") 
		{
				$("#id_cliente_internacional").focus ();
                                $('#valida-cliente').fadeIn('slow'); 
				setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1300); 
				return false;
		}
                var id_cliente_int=$('#id_cliente_internacional option:selected').attr('id');
                var fecha1=$("#fecha1").val();
                var fecha2=$("#fecha2").val();
                var stream="fecha1="+fecha1
                        +"&"+"fecha2="+fecha2
                        +"&"+"id_cliente_int="+id_cliente_int
                        +"&"+"funcion="+4;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
			}			
		});
            }
            //Por fecha y Producto
            if(ranfec==1 && ranpro==1 && rancli===undefined){
                if($.trim($("#fecha1").val())==="") 
		{
			$("#fecha1").focus ();
			$('#valida-fecha1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha1').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha2").val())==="") 
		{
			$("#fecha2").focus ();
			$('#valida-fecha2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha2').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_prod_term_proforma").val())==="") 
		{
				$("#list_prod_term_proforma").focus ();
                                $('#valida-producto').fadeIn('slow'); 
				setTimeout(function(){$('#valida-producto').fadeOut('slow');},1300); 
				return false;
		}
                var list_prod_term_proforma=$('#list_prod_term_proforma option:selected').attr('id');
                var fecha1=$("#fecha1").val();
                var fecha2=$("#fecha2").val();
                var stream="fecha1="+fecha1
                        +"&"+"fecha2="+fecha2
                        +"&"+"list_prod_term_proforma="+list_prod_term_proforma
                        +"&"+"funcion="+5;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
			}			
		});
            }
        }
        
        //Ventas Nacionales
        $.fn.Filtro_ventas_nac=function(){
            //alert("Hola");
            var ranfec=$('input:checkbox[name=ranfec]:checked').val();
            var rancli=$('input:checkbox[name=rancli]:checked').val();
            var ranpro=$('input:checkbox[name=ranpro]:checked').val();
            //alert("fecha"+ranfec+","+"cliente"+rancli+","+"producto"+ranpro);
            /*if(ranfec==1 && rancli==1 && ranpro==1){
                
            }*/
            //alert("aqui");
            if(ranfec==1 && rancli===undefined && ranpro===undefined){
                if($.trim($("#fecha1").val())==="") 
		{
			$("#fecha1").focus ();
			$('#valida-fecha1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha1').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha2").val())==="") 
		{
			$("#fecha2").focus ();
			$('#valida-fecha2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha2').fadeOut('slow');},1000); 
			return false;
		}
                var fecha1=$("#fecha1").val();
                var fecha2=$("#fecha2").val();
                var stream="fecha1="+fecha1
                        +"&"+"fecha2="+fecha2
                        +"&"+"funcion="+11;
                //alert(stream);
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
                               //notas de Credito
                               var tot1=$("#tot1").val();
                               var stream="fecha1="+fecha1
                                    +"&"+"fecha2="+fecha2
                                    +"&"+"tot1="+tot1
                                    +"&"+"funcion="+61;
                               $.ajax({
                                    type: "POST",
                                    url: "select/trae_objetos_informe_export_detalle.php",
                                    data:stream,
                                    success: function(data) {
                                           $('#detalle_credito').html("");
                                           $('#detalle_credito').append(data);
                                    }			
                            });
			}			
		});
            }
            /*POR FECHA Y PRODUCTO*/
            if(ranfec==1 && rancli===undefined && ranpro==1){
                if($.trim($("#fecha1").val())==="") 
		{
			$("#fecha1").focus ();
			$('#valida-fecha1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha1').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha2").val())==="") 
		{
			$("#fecha2").focus ();
			$('#valida-fecha2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha2').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_prod_term_proforma").val())==="") 
		{
				$("#list_prod_term_proforma").focus ();
                                $('#valida-producto').fadeIn('slow'); 
				setTimeout(function(){$('#valida-producto').fadeOut('slow');},1300); 
				return false;
		}
                var list_prod_term_proforma=$('#list_prod_term_proforma option:selected').attr('id');
                
                var fecha1=$("#fecha1").val();
                var fecha2=$("#fecha2").val();
                var stream="fecha1="+fecha1
                        +"&"+"fecha2="+fecha2
                        +"&"+"list_prod_term_proforma="+list_prod_term_proforma
                        +"&"+"funcion="+111;
                //alert(stream);
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
                               //notas de Credito
                               var tot1=$("#tot1").val();
                               //alert(tot1);
                               
                               
                               var stream="fecha1="+fecha1
                                    +"&"+"fecha2="+fecha2
                                    +"&"+"tot1="+tot1
                                    +"&"+"list_prod_term_proforma="+list_prod_term_proforma
                                    +"&"+"funcion="+611;
                               $.ajax({
                                    type: "POST",
                                    url: "select/trae_objetos_informe_export_detalle.php",
                                    data:stream,
                                    success: function(data) {
                                           //$('#detalle_expor2').html("");
                                           $('#detalle_credito').html("");
                                           $('#detalle_credito').append(data);
                                          // var tot1=$("#tot1").val();
                                           //var tot2=$("#tot2").val();
                                           //var sum=tot1+tot2;
                                           

                                    }			
                            });
			}			
		});
            }
            /*Por Fecha y Cliente*/
            if(ranfec==1 && ranpro===undefined && rancli==1){
                if($.trim($("#fecha1").val())==="") 
		{
			$("#fecha1").focus ();
			$('#valida-fecha1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha1').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha2").val())==="") 
		{
			$("#fecha2").focus ();
			$('#valida-fecha2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha2').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#id_cliente_nacional").val())==="") 
		{
				$("#id_cliente_nacional").focus ();
                                $('#valida-cliente').fadeIn('slow'); 
				setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1300); 
				return false;
		}
                var id_cliente=$('#id_cliente_nacional option:selected').attr('id');
                
                var fecha1=$("#fecha1").val();
                var fecha2=$("#fecha2").val();
                var stream="fecha1="+fecha1
                        +"&"+"fecha2="+fecha2
                        +"&"+"id_cliente="+id_cliente
                        +"&"+"funcion="+112;
                //alert(stream);
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
                               //notas de Credito
                               var tot1=$("#tot1").val();
                               //alert(tot1);
                               
                               
                               var stream="fecha1="+fecha1
                                    +"&"+"fecha2="+fecha2
                                    +"&"+"tot1="+tot1
                                    +"&"+"id_cliente="+id_cliente
                                    +"&"+"funcion="+612;
                               $.ajax({
                                    type: "POST",
                                    url: "select/trae_objetos_informe_export_detalle.php",
                                    data:stream,
                                    success: function(data) {
                                           //$('#detalle_expor2').html("");
                                           $('#detalle_credito').html("");
                                           $('#detalle_credito').append(data);
                                          // var tot1=$("#tot1").val();
                                           //var tot2=$("#tot2").val();
                                           //var sum=tot1+tot2;
                                           

                                    }			
                            });
			}			
		});
            }
            //por Cliente
            if(rancli==1 && ranfec===undefined && ranpro===undefined){
                if($.trim($("#id_cliente_internacional").val())==="0") 
		{
				$("#id_cliente_internacional").focus ();
                                $('#valida-cliente').fadeIn('slow'); 
				setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1300); 
				return false;
		}
                var id_cliente_int=$('#id_cliente_internacional option:selected').attr('id');
                var stream="id_cliente_int="+id_cliente_int
                        +"&"+"funcion="+2;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
			}			
		});
            }
            //Por Producto
            if(ranpro==1 && ranfec===undefined && rancli===undefined){
                if($.trim($("#list_prod_term_proforma").val())==="") 
		{
				$("#list_prod_term_proforma").focus ();
                                $('#valida-producto').fadeIn('slow'); 
				setTimeout(function(){$('#valida-producto').fadeOut('slow');},1300); 
				return false;
		}
                var list_prod_term_proforma=$('#list_prod_term_proforma option:selected').attr('id');
                var stream="list_prod_term_proforma="+list_prod_term_proforma
                        +"&"+"funcion="+3;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
			}			
		});
            }
            //Por fecha y Cliente
            if(ranfec==1 && rancli==1 && ranpro===undefined){
                if($.trim($("#fecha1").val())==="") 
		{
			$("#fecha1").focus ();
			$('#valida-fecha1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha1').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha2").val())==="") 
		{
			$("#fecha2").focus ();
			$('#valida-fecha2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha2').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#id_cliente_internacional").val())==="0") 
		{
				$("#id_cliente_internacional").focus ();
                                $('#valida-cliente').fadeIn('slow'); 
				setTimeout(function(){$('#valida-cliente').fadeOut('slow');},1300); 
				return false;
		}
                var id_cliente_int=$('#id_cliente_internacional option:selected').attr('id');
                var fecha1=$("#fecha1").val();
                var fecha2=$("#fecha2").val();
                var stream="fecha1="+fecha1
                        +"&"+"fecha2="+fecha2
                        +"&"+"id_cliente_int="+id_cliente_int
                        +"&"+"funcion="+4;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
			}			
		});
            }
            //Por fecha y Producto
            if(ranfec==1 && ranpro==1 && rancli===undefined){
                if($.trim($("#fecha1").val())==="") 
		{
			$("#fecha1").focus ();
			$('#valida-fecha1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha1').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#fecha2").val())==="") 
		{
			$("#fecha2").focus ();
			$('#valida-fecha2').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha2').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#list_prod_term_proforma").val())==="") 
		{
				$("#list_prod_term_proforma").focus ();
                                $('#valida-producto').fadeIn('slow'); 
				setTimeout(function(){$('#valida-producto').fadeOut('slow');},1300); 
				return false;
		}
                var list_prod_term_proforma=$('#list_prod_term_proforma option:selected').attr('id');
                var fecha1=$("#fecha1").val();
                var fecha2=$("#fecha2").val();
                var stream="fecha1="+fecha1
                        +"&"+"fecha2="+fecha2
                        +"&"+"list_prod_term_proforma="+list_prod_term_proforma
                        +"&"+"funcion="+5;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
			}			
		});
            }
        }
        ///Ver detalle Ventas Nacional
        $.fn.Detalle_ventas_nac=function(numero){
            
		//var numero=$('#num_proforma').val();
                //alert(numero);
                var stream="numero="+numero
                        +"&"+"funcion="+100;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               //$('#observa').html("");
                               $('#detalle_expor2').html("");
                               $('#detalle_expor2').append(data);
			}			
		});
		//window.open('select/imprimir_datos_facturas.php?funcion='+4+'&numero='+numero);
                //$("#cabeza_proforma").html("");
                
                /*var stream="numero="+numero+"&"+"funcion="+2;
		$.ajax({
                    type: "POST",
                    url: "select/trae_proforma_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_proforma').html("");	
			$('#cabeza_proforma').append(data);
                    }			
		});*/
	}
        //Detalle Nota Credito
        $.fn.Detalle_ventas_nac_cre=function(numero,cv){
            
		//var numero=$('#num_proforma').val();
                //alert(numero+" "+cv);
               var stream="numero="+numero
                        +"&"+"cv="+cv
                        +"&"+"funcion="+1001;
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle.php",
			data:stream,
			success: function(data) {
                               //$('#observa').html("");
                               $('#detalle_credito2').html("");
                               $('#detalle_credito2').append(data);
			}			
		});
	}
	// funcion que ingresa la proforma ya terminada
	$.fn.ingresa_proforma=function(){	
		var saldo=$("#saldo").val();
		var total=$("#total").val();
		/*if (total>saldo)
		{
			$('#valida_saldo').fadeIn('slow'); 
			setTimeout(function(){$('#valida_saldo').fadeOut('slow');},1000); 
			return false;
		}
		else
		{*/
			if($.trim($("#fecha_proforma").val())==="") 
			{
				$('#valida-fecha_proforma').fadeIn('slow'); 
				setTimeout(function(){$('#valida-fecha_proforma').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#centro_venta2").val())==="") 
			{
				 $("html, body").animate({scrollTop:"0px"});
                                $('#valida-c_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1300); 
				return false;
			}
			if($.trim($("#id_cliente_internacional").val())==="0") 
			{
				$("html, body").animate({scrollTop:"0px"});
                                $('#valida-c_inter').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_inter').fadeOut('slow');},1300); 
				return false;
			}
			if($.trim($("#medio_transporte").val())==="") 
			{
				$("html, body").animate({scrollTop:"0px"});
                                $('#valida-m_trans').fadeIn('slow'); 
				setTimeout(function(){$('#valida-m_trans').fadeOut('slow');},1000); 
				return false;
			}
                        //alert($("#lis_aduanas").val());
                        if($.trim($("#lis_aduanas").val())==="0") 
			{
				$("html, body").animate({scrollTop:"0px"});
                                $('#valida-lis_aduanas').fadeIn('slow'); 
				setTimeout(function(){$('#valida-lis_aduanas').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#lis_suc_aduanas").val())==="") 
			{
				$("html, body").animate({scrollTop:"0px"});
                                $('#valida-p_enbarque').fadeIn('slow'); 
				setTimeout(function(){$('#valida-p_enbarque').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#p_destino").val())==="") 
			{
				$("html, body").animate({scrollTop:"0px"});
                                $('#valida-p_destino').fadeIn('slow'); 
				setTimeout(function(){$('#valida-p_destino').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#list_tip_mon").val())==="") 
			{
				$("html, body").animate({scrollTop:"0px"});
                                $('#valida-moneda').fadeIn('slow'); 
				setTimeout(function(){$('#valida-moneda').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#condicion_venta").val())==="") 
			{
				$("html, body").animate({scrollTop:"0px"});
                                $('#valida-condicion_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-condicion_venta').fadeOut('slow');},1000); 
				return false;
			}
                        //alert($("#clausula_venta").val());
			if($.trim($("#clausula_venta").val())==="") 
			{
				$("html, body").animate({scrollTop:"0px"});
                                $('#valida-clausula_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-clausula_venta').fadeOut('slow');},1000); 
				return false;
			}
			if ($('#productos_finanzas >tr').length == 0)
			{
				$('#valida-productos_pedidos').fadeIn('slow'); 
				setTimeout(function(){$('#valida-productos_pedidos').fadeOut('slow');},1000); 
				return false;
			}
			if ($("#clausula_venta option:selected").attr('id')=='1')
			{
				if($.trim($("#freight").val())==="0") 
				{
					$('#valida_freight').fadeIn('slow'); 
					setTimeout(function(){$('#valida_freight').fadeOut('slow');},1000); 
					return false;
				}
				if($.trim($("#insurance").val())==="0") 
				{
					$('#valida_insurance').fadeIn('slow'); 
					setTimeout(function(){$('#valida_insurance').fadeOut('slow');},1000); 
					return false;
				}			
			}
			else if ($("#clausula_venta option:selected").attr('id')=='3')
			{
				if($.trim($("#insurance").val())==="0") 
				{
					$('#valida_insurance').fadeIn('slow'); 
					setTimeout(function(){$('#valida_insurance').fadeOut('slow');},1000); 
					return false;
				}
			}
			var numero_proforma=$("#num_proforma").val();
			var fecha_proforma=$("#fecha_proforma").val();
			var id_centro_venta=$('#centro_venta2 option:selected').attr('id');
			var id_cliente_int=$('#id_cliente_internacional option:selected').attr('id');
			var medio_transporte=$('#medio_transporte option:selected').attr('id');
                        var puerto_embarque=$('#lis_suc_aduanas option:selected').attr('id');
			//var puerto_embarque=$("#p_embarque").val();
			var puerto_destino=$("#p_destino").val();
			var id_tipo_moneda=$('#list_tip_mon option:selected').attr('id');
			var cond_pago=$("#condicion_venta").val();
                        //var cond_pago=$("#c_pago").val();
			var descripcion=$("#descripcion").val();
			var subtotal=$("#subtotal").val();
                        var fob=$("#fob").val();
			var descuento=$("#descuento").val();
			var freight=$("#freight").val();
			var insurance=$("#insurance").val();
			var total=$("#total").val();
			var version=$("#version").val()
                        if(version==""){
                            version=0;
                        }
                        //alert("Version:"+version);
			var clausula_venta=$("#clausula_venta").val();
                        var id_usuario=$("#id_usuario").val()
                        
			var stream="numero_proforma="+numero_proforma+"&"+"fecha_proforma="+fecha_proforma+"&"+"id_centro_venta="+id_centro_venta
				+"&"+"id_cliente_int="+id_cliente_int+"&"+"medio_transporte="+medio_transporte+"&"+"puerto_embarque="+puerto_embarque
				+"&"+"puerto_destino="+puerto_destino+"&"+"id_tipo_moneda="+id_tipo_moneda+"&"+"cond_pago="+cond_pago+"&"+"descripcion="+descripcion
				+"&"+"subtotal="+subtotal+"&"+"fob="+fob
                                +"&"+"descuento="+descuento+"&"+"freight="+freight+"&"+"insurance="+insurance+"&"+"total="+total
				+"&"+"clausula_venta="+clausula_venta+"&"+"version="+version
                                +"&"+"id_usuario="+id_usuario
                                +"&"+"funcion="+2;
			$.ajax({
				type: "POST",
				url: "insert/insertar_proforma.php",
				data:stream,
				success: function(data) {
					alert (data);
					location.href = "crear_proforma.php";
					//tiene que enviar un correo con las cantidades que se pidieron en la proforma
				}				
			});
		/*}*/
	}
	$.fn.proforma_actualizar=function(){	
		if($.trim($("#fecha_proforma").val())==="") 
		{
			$('#valida-fecha_proforma').fadeIn('slow'); 
			setTimeout(function(){$('#valida-fecha_proforma').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#centro_venta").val())==="") 
		{
			$('#valida-c_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#id_cliente_internacional").val())==="0") 
		{
			$('#valida-c_inter').fadeIn('slow'); 
			setTimeout(function(){$('#valida-c_inter').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#medio_transporte").val())==="") 
		{
			$('#valida-m_trans').fadeIn('slow'); 
			setTimeout(function(){$('#valida-m_trans').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#p_embarque").val())==="") 
		{
			$('#valida-p_enbarque').fadeIn('slow'); 
			setTimeout(function(){$('#valida-p_enbarque').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#p_destino").val())==="") 
		{
			$('#valida-p_destino').fadeIn('slow'); 
			setTimeout(function(){$('#valida-p_destino').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_tip_mon").val())==="") 
		{
			$('#valida-moneda').fadeIn('slow'); 
			setTimeout(function(){$('#valida-moneda').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#c_pago").val())==="") 
		{
			$('#valida-c_pago').fadeIn('slow'); 
			setTimeout(function(){$('#valida-c_pago').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#clausula_venta").val())==="") 
		{
			$('#valida-clausula_venta').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clausula_venta').fadeOut('slow');},1000); 
			return false;
		}
		if ($('#productos_finanzas >tr').length == 0)
		{
			$('#valida-productos_pedidos').fadeIn('slow'); 
			setTimeout(function(){$('#valida-productos_pedidos').fadeOut('slow');},1000); 
			return false;
		}
		if ($("#clausula_venta option:selected").attr('id')=='1')
		{
			if($.trim($("#freight").val())==="0") 
			{
				$('#valida_freight').fadeIn('slow'); 
				setTimeout(function(){$('#valida_freight').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#insurance").val())==="0") 
			{
				$('#valida_insurance').fadeIn('slow'); 
				setTimeout(function(){$('#valida_insurance').fadeOut('slow');},1000); 
				return false;
			}			
		}
		else if ($("#clausula_venta option:selected").attr('id')=='3')
		{
			if($.trim($("#insurance").val())==="0") 
			{
				$('#valida_insurance').fadeIn('slow'); 
				setTimeout(function(){$('#valida_insurance').fadeOut('slow');},1000); 
				return false;
			}
		}
		var numero_proforma=$("#num_proforma").val();
		var fecha_proforma=$("#fecha_proforma").val();
		var id_centro_venta=$('#centro_venta option:selected').attr('id');
		var id_cliente_int=$('#id_cliente_internacional option:selected').attr('id');
		var medio_transporte=$('#medio_transporte option:selected').attr('id');
		var puerto_embarque=$("#p_embarque").val();
		var puerto_destino=$("#p_destino").val();
		var id_tipo_moneda=$('#list_tip_mon option:selected').attr('id');
		var cond_pago=$("#c_pago").val();
		var descripcion=$("#descripcion").val();
		var subtotal=$("#subtotal").val();
		var descuento=$("#descuento").val();
		var freight=$("#freight").val();
		var insurance=$("#insurance").val();
		var total=$("#total").val();
		var version=$("#version").val();
		var clausula_venta=$("#clausula_venta").val();
		var stream="numero_proforma="+numero_proforma+"&"+"fecha_proforma="+fecha_proforma+"&"+"id_centro_venta="+id_centro_venta
			+"&"+"id_cliente_int="+id_cliente_int+"&"+"medio_transporte="+medio_transporte+"&"+"puerto_embarque="+puerto_embarque
			+"&"+"puerto_destino="+puerto_destino+"&"+"id_tipo_moneda="+id_tipo_moneda+"&"+"cond_pago="+cond_pago+"&"+"descripcion="+descripcion
			+"&"+"subtotal="+subtotal+"&"+"descuento="+descuento+"&"+"freight="+freight+"&"+"insurance="+insurance+"&"+"total="+total
			+"&"+"clausula_venta="+clausula_venta+"&"+"version="+version+"&"+"funcion="+16;
		$.ajax({
			type: "POST",
			url: "insert/insertar_proforma.php",
			data:stream,
			success: function(data) {
				alert (data);
				location.href = "crear_proforma.php";
				//tiene que enviar un correo con las cantidades que se pidieron en la proforma
			}				
		});
	}	
	// **************************Elimina *************************************//	
	$.fn.ingresa_producto_proforma_modificar=function(id_pedido_proforma,numero_proforma){
		if($.trim($("#cajas").val())==="") 
		{
			$("#cajas").focus();
			$('#valida-cajas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cajas').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#precio").val())==="") 
		{
			$("#precio").focus();
			$('#valida-precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#precio").val())==="0") 
		{
			$("#precio").focus();
			$('#valida-precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_prod_term_proforma").val())==="") 
		{
			$("#list_prod_term_proforma").focus();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		var precio=$("#precio").val();
		var numero_proforma=$("#num_proforma").val();		
		var cajas=$("#cajas").val();
		var id_usuario=$("#id_usuario").val();	
		var saldo=$("#saldo").val();		
		var id_producto=$('#list_prod_term_proforma option:selected').attr('id');
		var stream="id_producto="+id_producto+"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto_proforma.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto
						+"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+2+"&"+"id_usuario="+id_usuario+"&"+"saldo="+saldo;
					$.ajax({
						type: "POST",
						url: "insert/ingresa_producto_proforma.php",
						data:stream,
						success: function(data) {	
							if (data==1)
							{
								$("#saldo").focus();
								$('#valida_saldo').fadeIn('slow'); 
								setTimeout(function(){$('#valida_saldo').fadeOut('slow');},1000); 
								return false;
							}
							else if (data==2)
							{
								var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto
								+"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+3+"&"+"id_usuario="+id_usuario+"&"+"saldo="+saldo;
								$.ajax({
									type: "POST",
									url: "insert/ingresa_producto_proforma.php",
									data:stream,
									success: function(data) {
										$('#productos_finanzas').append(data);		
										$("#list_prod_term_proforma").val ("");	
										$("#precio").val("");
										$("#cajas").val("");
										$("#descuento").val (0);
										var stream="numero_proforma="+numero_proforma+"&"+"funcion="+2;
										$.ajax({
											type: "POST",
											url: "select/trae_subtotal_proforma.php",
											data:stream,
											success: function(data) {
												$('#subtotal').val(data);
												var freight=$("#freight").val();
												var insurance=$("#insurance").val();
												var descuento=$("#descuento").val();
												var subtotal=$('#subtotal').val(); 
												var total_descuento=(subtotal*descuento)/100;
												var total=parseFloat(freight)+parseFloat(insurance);
												var total_neto=(subtotal-total_descuento);
												var total2=parseFloat(total)+parseFloat(total_neto);
												$('#total').val(total2);
											}			
										});
									}			
								});
							}
						}			
					});
				}
				else
				{
					$("#list_prod_term_proforma").focus ();
					$('#valida-productos_repetidos').fadeIn('slow'); 
					setTimeout(function(){$('#valida-productos_repetidos').fadeOut('slow');},1000); 
					$("#list_prod_term_proforma").val ("");	
					$("#precio").val("");
					$("#cajas").val("");
					return false;
				}				
			}			
		});
	}
        /***********Autoriza Proforma por Comex*************/
	$.fn.autoriza_prof_comex=function(){
            var numero_proforma=$('#num_proforma').val();
            //alert(id_pedido_proforma+" - "+numero_proforma);
            //alert("Autoriza Comex Proforma "+numero_proforma);
            
		var stream="numero_proforma="+numero_proforma
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "update/autoriza_proforma_comex.php",
			data:stream,
			success: function(data) {
                               alert(data);
                               location.href = "crear_proforma.php";
			}			
		});
	}
        /**Autoriza NV Comex*/
        $.fn.autoriza_nv_gte1=function(){
            var desicion=$('input:radio[name=desicion]:checked').val();
            //alert(id_pedido_proforma+" - "+numero_proforma);
            //alert("nota venta");
            if(desicion==1){
                var stream="desicion="+desicion
                        +"&"+"funcion="+3;
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
                        +"&"+"funcion="+4;
		$.ajax({
			type: "POST",
			url: "select/trae_objetos.php",
			data:stream,
			success: function(data) {
                               $('#observa').html("");
                               $('#observa').append(data);
                               var stream="desicion="+desicion
                                +"&"+"funcion="+3;
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
        //Finan
        /**Autoriza NV Comex*/
        $.fn.autoriza_nv_gte22=function(){
            var desicion=$('input:radio[name=desicion]:checked').val();
            //alert(id_pedido_proforma+" - "+numero_proforma);
            //alert("nota venta");
            if(desicion==1){
                var stream="desicion="+desicion
                        +"&"+"funcion="+5;
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
                        +"&"+"funcion="+6;
		$.ajax({
			type: "POST",
			url: "select/trae_objetos.php",
			data:stream,
			success: function(data) {
                               $('#observa').html("");
                               $('#observa').append(data);
                               var stream="desicion="+desicion
                                +"&"+"funcion="+5;
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
        
        /***********Autoriza Proforma por Comex*************/
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
        //NV
        //Finanzas
        /***Autorizacion Nota Venta clave Finanzas**/
        $.fn.autoriza_nv_gte23=function(){
            
            if($.trim($("#clave").val())==="") 
		{
			$("#clave").focus ();
			$('#valida-clave').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave').fadeOut('slow');},1000); 
			return false;
		}
            var numero_nv=$('#nv').val();
            var desicion=$('input:radio[name=desicion]:checked').val();
            var clave=$('#clave').val();
            var version=$('#version').val();
            //alert(numero_proforma);
            
            if(desicion==1){
                var stream="numero_nv="+numero_nv
                        +"&"+"clave="+clave
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/valida_clave3.php",
			data:stream,
			success: function(data) {
                               //alert(data);
                               if(data==1){
                                   var stream="numero_nv="+numero_nv
                                    +"&"+"version="+version
                                        +"&"+"funcion="+1;
                                       $.ajax({
                                            type: "POST",
                                            url: "update/autoriza_nv_finanzas.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_nota_venta_por_autorizar2.php";
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
                var stream="numero_nv="+numero_nv
                        +"&"+"clave="+clave
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/valida_clave3.php",
			data:stream,
			success: function(data) {
                               //alert(data);
                               if(data==1){
                                   var stream="numero_nv="+numero_nv
                                            +"&"+"observacion="+observacion
                                        +"&"+"funcion="+3;
                                       $.ajax({
                                            type: "POST",
                                            url: "update/autoriza_nv_finanzas.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_nota_venta_por_autorizar2.php";
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
        /***Autorizacion Nota Venta clave comex**/
        $.fn.autoriza_nv_gte2=function(){
            
            if($.trim($("#clave").val())==="") 
		{
			$("#clave").focus ();
			$('#valida-clave').fadeIn('slow'); 
			setTimeout(function(){$('#valida-clave').fadeOut('slow');},1000); 
			return false;
		}
            var numero_nv=$('#nv').val();
            var desicion=$('input:radio[name=desicion]:checked').val();
            var clave=$('#clave').val();
            var version=$('#version').val();
            //alert(numero_proforma);
            
            if(desicion==1){
                var stream="numero_nv="+numero_nv
                        +"&"+"clave="+clave
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/valida_clave2.php",
			data:stream,
			success: function(data) {
                               //alert(data);
                               if(data==1){
                                   var stream="numero_nv="+numero_nv
                                    +"&"+"version="+version
                                        +"&"+"funcion="+1;
                                       $.ajax({
                                            type: "POST",
                                            url: "update/autoriza_nv_comex.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_nota_venta_por_autorizar.php";
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
                var stream="numero_nv="+numero_nv
                        +"&"+"clave="+clave
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/valida_clave2.php",
			data:stream,
			success: function(data) {
                               //alert(data);
                               if(data==1){
                                   var stream="numero_nv="+numero_nv
                                            +"&"+"observacion="+observacion
                                        +"&"+"funcion="+3;
                                       $.ajax({
                                            type: "POST",
                                            url: "update/autoriza_nv_comex.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_nota_venta_por_autorizar.php";
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
        /***Autorizacion Proforma clave**/
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
                                            url: "update/autoriza_proforma_comex.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_proformas_por_autorizar.php";
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
                                            url: "update/autoriza_proforma_comex.php",
                                            data:stream,
                                            success: function(data) {
                                                   alert(data);
                                                   location.href = "listado_proformas_por_autorizar.php";
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
            /*
		var stream="numero_proforma="+numero_proforma
                        +"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "update/autoriza_proforma_comex.php",
			data:stream,
			success: function(data) {
                               alert(data);
                               location.href = "crear_proforma.php";
			}			
		});*/
	}
	// **************************Elimina Productos de bodega mal ingresados*************************************//		
	$.fn.elimina_prod_detalle_proforma=function(id_pedido_proforma,numero_proforma){
            //alert(id_pedido_proforma+" - "+numero_proforma);
		var stream="id_pedido_proforma="+id_pedido_proforma
                        +"&"+"numero_proforma="+numero_proforma
                        +"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_proforma_mal_ingresados.php",
			data:stream,
			success: function(data) {
                                //alert(data);
				$("#productos_finanzas").find("#"+id_pedido_proforma).remove();
				var stream="numero_proforma="+numero_proforma+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_proforma.php",
					data:stream,
					success: function(data) {
						$('#subtotal').val(data);
						var freight=$("#freight").val();
						var insurance=$("#insurance").val();
						var descuento=$("#descuento").val();
						var subtotal=$('#subtotal').val(); 
						var total_descuento=(subtotal*descuento)/100;
						var total=parseFloat(freight)+parseFloat(insurance);
						var total_neto=(subtotal-total_descuento);
						var total2=parseFloat(total)+parseFloat(total_neto);
						$('#total').val(total2);
					}			
				});	
			}			
		});
	}
        // **************************Elimina Productos de Detalle Proforma Temporal mal ingresados*************************************//		
	$.fn.elimina_prod_detalle_proforma_temporal=function(id_pedido_proforma,id_usuario){
            //alert(usuario);
		var stream="id_pedido_proforma="+id_pedido_proforma
                        +"&"+"id_usuario="+id_usuario
                        +"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_proforma_mal_ingresados.php",
			data:stream,
			success: function(data) {						
				$("#productos_finanzas").find("#"+id_pedido_proforma).remove();
                               // alert(usuario);
				var stream="id_usuario="+id_usuario
                                        +"&"+"funcion="+3;
                                //var stream="usuario="+usuario+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_proforma.php",
					data:stream,
					success: function(data) {
						$('#subtotal').val(data);
						var freight=$("#freight").val();
						var insurance=$("#insurance").val();
						var descuento=$("#descuento").val();
						var subtotal=$('#subtotal').val(); 
						var total_descuento=(subtotal*descuento)/100;
						var total=parseFloat(freight)+parseFloat(insurance);
						var total_neto=(subtotal-total_descuento);
						var total2=parseFloat(total)+parseFloat(total_neto);
						$('#total').val(total2);
					}			
				});	
			}			
		});
	}
	// **************************Elimina Productos de bodega mal ingresados*************************************//		
	$.fn.editar_prod_detalle_proforma_version=function(id_detalle_proforma,numero_proforma){
		var stream="id_detalle_proforma="+id_detalle_proforma+"&"+"funcion="+24;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			cache: false,
			dataType: 'json',
			success: function(data) {
				for(i=0;i<data.length;i++)
				{
					$('#cajas').val(data[i].Cantidad);
					$('#precio').val(data[i].Precio);	
					$("#list_prod_term_proforma").val(data[i].nombre_producto);
				}
				$("#productos_finanzas").find("#"+id_detalle_proforma).remove();
				var stream="numero_proforma="+numero_proforma+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_proforma.php",
					data:stream,
					success: function(data) {
						$('#subtotal').val(data);
						var freight=$("#freight").val();
						var insurance=$("#insurance").val();
						var descuento=$("#descuento").val();
						var subtotal=$('#subtotal').val(); 
						var total_descuento=(subtotal*descuento)/100;
						var total=parseFloat(freight)+parseFloat(insurance);
						var total_neto=(subtotal-total_descuento);
						var total2=parseFloat(total)+parseFloat(total_neto);
						$('#total').val(total2);
					}			
				});	
			}			
		});
	}	
	// **************************Elimina Productos de bodega mal ingresados*************************************//		
	$.fn.editar_prod_detalle_proforma=function(id_detalle_proforma,numero_proforma){
		var stream="id_detalle_proforma="+id_detalle_proforma+"&"+"funcion="+29;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			cache: false,
			dataType: 'json',
			success: function(data) {
				for(i=0;i<data.length;i++)
				{
					$('#cajas').val(data[i].Cantidad);
					$('#precio').val(data[i].Precio);	
					$("#list_prod_term_proforma").val(data[i].nombre_producto);
				}
				$("#productos_finanzas").find("#"+id_detalle_proforma).remove();
				var stream="numero_proforma="+numero_proforma+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_proforma.php",
					data:stream,
					success: function(data) {
						$('#subtotal').val(data);
						var freight=$("#freight").val();
						var insurance=$("#insurance").val();
						var descuento=$("#descuento").val();
						var subtotal=$('#subtotal').val(); 
						var total_descuento=(subtotal*descuento)/100;
						var total=parseFloat(freight)+parseFloat(insurance);
						var total_neto=(subtotal-total_descuento);
						var total2=parseFloat(total)+parseFloat(total_neto);
						$('#total').val(total2);
					}			
				});	
			}			
		});
	}
	///********Ingresa los Productos a la tabla de Nota de Venta Detalle******///
	$.fn.ingresa_producto_nota_venta=function(){
		if($.trim($("#cajas").val())==="") 
		{
			$("#cajas").focus();
			$('#valida-cajas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cajas').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#precio").val())==="0") 
		{
			$("#precio").focus();
			$('#valida-precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_prod_term").val())==="") 
		{
			$("#list_prod_term").focus();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		var precio=$("#precio").val();
		var descuento=$("#descuento").val();
		var numero_nota_venta=$("#num_nota_venta").val();		
		var cajas=$.trim($("#cajas").val());
		var id_producto=$('#list_prod_term option:selected').attr('id');
		/*var stock_producto=$.trim($('#stock_producto'+id_producto).val());
		if (stock_producto<=0)
		{
			$("#list_prod_term").focus("");
			$("#cajas").val("");			
			$("#list_prod_term").val("");
			$("#precio").val("");				
			$('#valida-stock_cero').fadeIn('slow'); 
			setTimeout(function(){$('#valida-stock_cero').fadeOut('slow');},1000); 
			return false;
		}*/
		var stream="id_producto="+id_producto+"&"+"numero_nota_venta="+numero_nota_venta+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "comprobaciones/comprobar_producto_nota_venta.php",
			data:stream,
			success: function(data) {
				if (data.indexOf("Error")==-1)
				{
					var id_Usuario=$("#id_Usuario").val();	
					var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"id_Usuario="+id_Usuario
					+"&"+"descuento="+descuento;
                                        /*var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"id_Usuario="+id_Usuario
					+"&"+"numero_nota_venta="+numero_nota_venta+"&"+"stock_producto="+stock_producto+"&"+"descuento="+descuento;*/
					$.ajax({
						type: "POST",
						url: "insert/ingresa_producto_nota_venta.php",
						data:stream,
						success: function(data) {	
							if (data==1)
							{
								$("#cajas").val("");			
								$('#valida-stock_mayor').fadeIn('slow'); 
								setTimeout(function(){$('#valida-stock_mayor').fadeOut('slow');},1000); 
							}
							else if (data==2)
							{
								$("#cajas").val("");			
								$('#valida-cantidad_es_0').fadeIn('slow'); 
								setTimeout(function(){$('#valida-cantidad_es_0').fadeOut('slow');},1000); 
							}
							else
							{
								$('#productos_finanzas').append(data);								
								$("#list_prod_term").val ("");	
								$("#precio").val("");
								$("#cajas").val("");
								$("#descuento").val(0);
								var valor_numero_nota=$("#valor_id_nota").val();
								$("#num_nota_venta").val(valor_numero_nota);
								var numero_nota_venta=$("#num_nota_venta").val();	
								var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+1;
								$.ajax({
									type: "POST",
									url: "select/trae_subtotal_nota_venta.php",
									data:stream,
									success: function(data) {
										$('#subtotal_nota_venta').val(data);
										var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+2;
										$.ajax({
											type: "POST",
											url: "select/trae_subtotal_nota_venta.php",
											data:stream,
											success: function(data) {
												$('#ila_nota_venta').val(data);
												var ila=$('#ila_nota_venta').val();
												var ila=ila+0;
												var subtotal=$('#subtotal_nota_venta').val();
												var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
												var iva=(subtotal_1*19)/100;
												var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
												$('#iva_nota_venta').val(iva);
												$('#total_nota_venta').val(valor_iva);
											}			
										});
									}			
								});
							}
						}			
					});
				}
				else
				{
					$("#list_prod_term").focus ();
					$('#valida-productos_repetidos').fadeIn('slow'); 
					setTimeout(function(){$('#valida-productos_repetidos').fadeOut('slow');},1000); 
					$("#list_prod_term").val ("");	
					$("#precio").val("");
					$("#cajas").val("");
					return false;
				}				
			}			
		});
	}		
	$.fn.editar_prod_detalle_nota_venta=function(id_detalle_nota_venta,numero_nota_venta){
		var stream="id_detalle_nota_venta="+id_detalle_nota_venta+"&"+"funcion="+23;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			cache: false,
			dataType: 'json',
			success: function(data) {
				for(i=0;i<data.length;i++)
				{
					$('#cajas').val(data[i].Cantidad);
					$('#precio').val(data[i].Precio);
					$('#descuento').val(data[i].descuento);
					$("#list_prod_term").val(data[i].nombre_producto);
				}
				$("#productos_finanzas").find("#"+id_detalle_nota_venta).remove();
				var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+1;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_nota_venta.php",
					data:stream,
					success: function(data) {
					$('#subtotal_nota_venta').val(data);
					var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+2;
						$.ajax({
							type: "POST",
							url: "select/trae_subtotal_nota_venta.php",
							data:stream,
							success: function(data) {
								$('#ila_nota_venta').val(data);
								var ila=$('#ila_nota_venta').val();
								var ila=ila+0;
								var subtotal=$('#subtotal_nota_venta').val();
								var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
								var iva=(subtotal_1*19)/100;
								var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
								$('#iva_nota_venta').val(iva);
								$('#total_nota_venta').val(valor_iva);
							}			
						});
					}			
				});
			}			
		});
	}
	$.fn.editar_prod_detalle_nota_venta_modificar=function(id_detalle_nota_venta,numero_nota_venta){
		var stream="id_detalle_nota_venta="+id_detalle_nota_venta+"&"+"funcion="+28;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			cache: false,
			dataType: 'json',
			success: function(data) {
				for(i=0;i<data.length;i++)
				{
					$('#cajas').val(data[i].Cantidad);
					$('#precio').val(data[i].Precio);
					$('#descuento').val(data[i].descuento);
					$("#list_prod_term").val(data[i].nombre_producto);
				}
				$("#productos_finanzas").find("#"+id_detalle_nota_venta).remove();
				var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+3;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_nota_venta.php",
					data:stream,
					success: function(data) {
					$('#subtotal_nota_venta').val(data);
					var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+4;
						$.ajax({
							type: "POST",
							url: "select/trae_subtotal_nota_venta.php",
							data:stream,
							success: function(data) {
								$('#ila_nota_venta').val(data);
								var ila=$('#ila_nota_venta').val();
								var ila=ila+0;
								var subtotal=$('#subtotal_nota_venta').val();
								var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
								var iva=(subtotal_1*19)/100;
								var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
								$('#iva_nota_venta').val(iva);
								$('#total_nota_venta').val(valor_iva);
							}			
						});
					}			
				});
			}			
		});
	}
	$.fn.editar_prod_detalle_nota_venta_modificar=function(id_detalle_nota_venta,numero_nota_venta){
		var stream="id_detalle_nota_venta="+id_detalle_nota_venta+"&"+"funcion="+26;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			cache: false,
			dataType: 'json',
			success: function(data) {
				for(i=0;i<data.length;i++)
				{
					$('#cajas').val(data[i].Cantidad);
					$('#precio').val(data[i].Precio);
					$('#descuento').val(data[i].descuento);
					$("#list_prod_term").val(data[i].nombre_producto);
				}
				$("#productos_finanzas").find("#"+id_detalle_nota_venta).remove();
				$("#prod_nota_venta_modificar").show();	
				var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+3;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_nota_venta.php",
					data:stream,
					success: function(data) {
					$('#subtotal_nota_venta').val(data);
					var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+4;
						$.ajax({
							type: "POST",
							url: "select/trae_subtotal_nota_venta.php",
							data:stream,
							success: function(data) {
								$('#ila_nota_venta').val(data);
								var ila=$('#ila_nota_venta').val();
								var ila=ila+0;
								var subtotal=$('#subtotal_nota_venta').val();
								var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
								var iva=(subtotal_1*19)/100;
								var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
								$('#iva_nota_venta').val(iva);
								$('#total_nota_venta').val(valor_iva);
							}			
						});
					}			
				});
			}			
		});
	}	
	//ingresa los productos de una nota de venta antigua para crear la version que sigue
	$.fn.ingresa_producto_nota_venta_antigua=function(){
		var action = confirm('Desea Cambiar de de Version Nota de Venta?');
		if(action==true)
		{
			$("#numero_nota_venta_usuario").attr('disabled',true);
			$("#btn_nota_nueva").hide();
			$("#btn_nota_modificada").show();
			var numero_nota_venta_usuario=$("#numero_nota_venta_usuario").val();		
			var stream="numero_nota_venta_usuario="+numero_nota_venta_usuario+"&"+"funcion="+15;
			$.ajax({
				type: "POST",
				url: "insert/ingresa_nota_venta.php",
				data:stream,
				success: function(data) {
					$("#prod_nota_antiguos").hide();
					$("#prod_nota_venta_modificar").show();
				}			
			});
		}
	}
	//ingresa los productos de una nota de venta antigua para crear la version que sigue
	$.fn.ingresa_producto_nota_venta_modificar=function(){
		var action = confirm('Desea Cambiar de de Version Nota de Venta?');
		if(action==true)
		{
			if($.trim($("#cajas").val())==="") 
			{
				$("#cajas").focus();
				$('#valida-cajas').fadeIn('slow'); 
				setTimeout(function(){$('#valida-cajas').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#precio").val())==="0") 
			{
				$("#precio").focus();
				$('#valida-precio').fadeIn('slow'); 
				setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#list_prod_term").val())==="") 
			{
				$("#list_prod_term").focus();
				$('#valida-producto').fadeIn('slow'); 
				setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
				return false;
			}
			var precio=$("#precio").val();
			var descuento=$("#descuento").val();
			var numero_nota_venta=$("#num_nota_venta").val();		
			var cajas=$.trim($("#cajas").val());
			var id_producto=$('#list_prod_term option:selected').attr('id');
			var stock_producto=$.trim($('#stock_producto'+id_producto).val());
			if (stock_producto<=0)
			{
				$("#list_prod_term").focus("");
				$("#cajas").val("");			
				$("#list_prod_term").val("");
				$("#precio").val("");				
				$('#valida-stock_cero').fadeIn('slow'); 
				setTimeout(function(){$('#valida-stock_cero').fadeOut('slow');},1000); 
				return false;
			}
			var stream="id_producto="+id_producto+"&"+"numero_nota_venta="+numero_nota_venta;
			$.ajax({
				type: "POST",
				url: "comprobaciones/comprobar_producto_nota_venta.php",
				data:stream,
				success: function(data) {
					if (data.indexOf("Error")==-1)
					{
						var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto
						+"&"+"numero_nota_venta="+numero_nota_venta+"&"+"stock_producto="+stock_producto+"&"+"descuento="+descuento;
						$.ajax({
							type: "POST",
							url: "insert/ingresa_producto_nota_venta.php",
							data:stream,
							success: function(data) {	
								if (data==1)
								{
									$("#cajas").val("");			
									$('#valida-stock_mayor').fadeIn('slow'); 
									setTimeout(function(){$('#valida-stock_mayor').fadeOut('slow');},1000); 
								}
								else if (data==2)
								{
									$("#cajas").val("");			
									$('#valida-cantidad_es_0').fadeIn('slow'); 
									setTimeout(function(){$('#valida-cantidad_es_0').fadeOut('slow');},1000); 
								}
								else
								{
									$('#productos_finanzas').append(data);		
									$("#list_prod_term").val ("");	
									$("#precio").val("");
									$("#cajas").val("");
									$("#descuento").val(0);
									var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+1;
									$.ajax({
										type: "POST",
										url: "select/trae_subtotal_nota_venta.php",
										data:stream,
										success: function(data) {
											$('#subtotal_nota_venta').val(data);
											var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+2;
											$.ajax({
												type: "POST",
												url: "select/trae_subtotal_nota_venta.php",
												data:stream,
												success: function(data) {
													$('#ila_nota_venta').val(data);
													var ila=$('#ila_nota_venta').val();
													var ila=ila+0;
													var subtotal=$('#subtotal_nota_venta').val();
													var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
													var iva=(subtotal_1*19)/100;
													var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
													$('#iva_nota_venta').val(iva);
													$('#total_nota_venta').val(valor_iva);
												}			
											});
										}			
									});
								}
							}			
						});
					}
					else
					{
						$("#list_prod_term").focus ();
						$('#valida-productos_repetidos').fadeIn('slow'); 
						setTimeout(function(){$('#valida-productos_repetidos').fadeOut('slow');},1000); 
						$("#list_prod_term").val ("");	
						$("#precio").val("");
						$("#cajas").val("");
						return false;
					}				
				}			
			});
		}
	}
	// funcion que ingresa la Nota de venta ya terminada
	$.fn.crear_nota_venta=function(){		
		var action = confirm('Esta seguro de Crear Nota de Venta?');
		if(action==true)
		{
			if($.trim($("#centro_venta").val())==="") 
			{
				$('#valida-c_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
				return false;
			}
                        if($.trim($("#centro_venta").val())==="") 
			{
				$('#valida-c_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
				return false;
			}
                        if($.trim($("#num_nota_venta").val())==="") 
			{
				$('#valida-nota_venta_Vacia').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nota_venta_Vacia').fadeOut('slow');},1000); 
				return false;
			}
                        if($.trim($("#fecha_despacho_nota_venta").val())==="") 
			{
				$('#valida-fecha_desp_nota_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-fecha_desp_nota_venta').fadeOut('slow');},1000); 
				return false;
			}
                        if ($('#productos >tbody >tr').length == 0)
			{
				$('#valida-productos_pedidos').fadeIn('slow'); 
				setTimeout(function(){$('#valida-productos_pedidos').fadeOut('slow');},1000); 
				return false;
			}
			
			
			if($.trim($("#id_cliente_nacional").val())==="") 
			{
				$('#valida-c_nac').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
				return false;
			}
                        if($.trim($("#suc_cli").val())==="") 
			{
				$('#valida-suc_cli').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
				return false;
			}
			
			if($.trim($("#pago_cli").val())==="") 
			{
				$('#valida-pago_cli').fadeIn('slow'); 
				setTimeout(function(){$('#valida-cond_venta').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#vend_cli").val())==="") 
			{
				$('#valida-vend_cli').fadeIn('slow'); 
				setTimeout(function(){$('#valida-vendedor').fadeOut('slow');},1000); 
				return false;
			}
                        var id_centro_venta=$('#centro_venta option:selected').attr('id');
                        var numero_nota_venta=$("#num_nota_venta").val();
                        var version=$("#version").val();
                        
			var fecha_nota_venta=$("#fecha_nota_venta").val();
			var fecha_despacho_nota_venta=$("#fecha_despacho_nota_venta").val();
                        var orden_compra=$("#orden_compra").val();
                        			
			var id_cliente_nacional=$('#id_cliente_nacional option:selected').attr('id');
                        var id_suc_cli=$('#suc_cli option:selected').attr('id');
                        var id_pago_cli=$('#pago_cli option:selected').attr('id');
                        var id_vendedor=$('#vend_cli option:selected').attr('id');
			var observacion_despacho=$("#obs_despacho").val();
                        
			var subtotal=$('#subtotal_nota_venta').val(); 
			var ila=$('#ila_nota_venta').val(); 
			var iva=$('#iva_nota_venta').val(); 
			var total_nota_venta=$('#total_nota_venta').val(); 
				
			var id_Usuario=$("#id_Usuario").val();	
			
			var stream="id_centro_venta="+id_centro_venta
                                +"&"+"numero_nota_venta="+numero_nota_venta
                                +"&"+"version="+version
                                +"&"+"fecha_nota_venta="+fecha_nota_venta
                                +"&"+"fecha_despacho_nota_venta="+fecha_despacho_nota_venta
				+"&"+"orden_compra="+orden_compra
                                +"&"+"id_cliente_nacional="+id_cliente_nacional
                                +"&"+"id_suc_cli="+id_suc_cli
                                +"&"+"id_pago_cli="+id_pago_cli
                                +"&"+"id_vendedor="+id_vendedor
				+"&"+"observacion_despacho="+observacion_despacho
                                +"&"+"subtotal="+subtotal
                                +"&"+"ila="+ila
                                +"&"+"iva="+iva
                                +"&"+"total_nota_venta="+total_nota_venta
                                +"&"+"id_Usuario="+id_Usuario
                                +"&"+"funcion="+2;
                        /*var stream="numero_nota_venta="+numero_nota_venta+"&"+"fecha_nota_venta="+fecha_nota_venta+"&"+"id_centro_venta="+id_centro_venta
					+"&"+"id_cliente_nacional="+id_cliente_nacional+"&"+"fecha_despacho_nota_venta="+fecha_despacho_nota_venta+"&"+"id_condicion_venta="+id_condicion_venta
				+"&"+"observacion_despacho="+observacion_despacho+"&"+"subtotal="+subtotal+"&"+"ila="+ila+"&"+"iva="+iva+"&"+"total_nota_venta="+total_nota_venta
				+"&"+"id_vendedor="+id_vendedor+"&"+"orden_compra="+orden_compra+"&"+"version="+version+"&"+"id_Usuario="+id_Usuario+"&"+"funcion="+2;*/
                        //alert(stream);
			$.ajax({
				type: "POST",
				url: "insert/ingresa_nota_venta.php",
				data:stream,
				success: function(data) {
					alert (data);
					location.href = "crear_nota_venta.php";
					// aqui tiene que enviar un mail para que sea autorizada la nota de  venta a finanzas a don andres con el detalle de la nota al mail
				}				
			});
		}
	}
	// *************************Ingresa la nota de venta modificada de version*************************************//
	$.fn.ingresa_nota_venta_versiones=function(){
		var action = confirm('Esta seguro de Actualizar Nota de Venta?');
		if(action==true)
		{
			if ($('#productos >tbody >tr').length == 0)
			{
				$('#valida-productos_pedidos').fadeIn('slow'); 
				setTimeout(function(){$('#valida-productos_pedidos').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#fecha_nota_venta").val())==="") 
			{
				$('#valida-fecha_nota_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-fecha_nota_venta').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#centro_venta").val())==="") 
			{
				$('#valida-c_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#id_cliente_nacional").val())==="") 
			{
				$('#valida-c_nac').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#fecha_despacho_nota_venta").val())==="") 
			{
				$('#valida-fecha_desp_nota_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-fecha_desp_nota_venta').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#condicion_venta").val())==="") 
			{
				$('#valida-cond_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-cond_venta').fadeOut('slow');},1000); 
				return false;
			}
			if($.trim($("#list_vendedores").val())==="") 
			{
				$('#valida-vendedor').fadeIn('slow'); 
				setTimeout(function(){$('#valida-vendedor').fadeOut('slow');},1000); 
				return false;
			}
			var numero_nota_venta=$("#num_nota_venta").val();
			var fecha_nota_venta=$("#fecha_nota_venta").val();
			var id_centro_venta=$('#centro_venta option:selected').attr('id');
			var id_vendedor=$('#list_vendedores option:selected').attr('id');
			var id_cliente_nacional=$('#id_cliente_nacional option:selected').attr('id');
			var fecha_despacho_nota_venta=$("#fecha_despacho_nota_venta").val();
			var id_condicion_venta=$('#condicion_venta option:selected').attr('id');
			var observacion_despacho=$("#obs_despacho").val();
			var subtotal=$('#subtotal_nota_venta').val(); 
			var ila=$('#ila_nota_venta').val(); 
			var iva=$('#iva_nota_venta').val(); 
			var total_nota_venta=$('#total_nota_venta').val(); 
			var orden_compra=$("#orden_compra").val();	
			var id_Usuario=$("#id_Usuario").val();	
			var version=$("#version").val();
			var stream="numero_nota_venta="+numero_nota_venta+"&"+"fecha_nota_venta="+fecha_nota_venta+"&"+"id_centro_venta="+id_centro_venta
					+"&"+"id_cliente_nacional="+id_cliente_nacional+"&"+"fecha_despacho_nota_venta="+fecha_despacho_nota_venta+"&"+"id_condicion_venta="+id_condicion_venta
				+"&"+"observacion_despacho="+observacion_despacho+"&"+"subtotal="+subtotal+"&"+"ila="+ila+"&"+"iva="+iva+"&"+"total_nota_venta="+total_nota_venta
				+"&"+"id_vendedor="+id_vendedor+"&"+"orden_compra="+orden_compra+"&"+"version="+version+"&"+"id_Usuario="+id_Usuario+"&"+"funcion="+27;
			$.ajax({
				type: "POST",
				url: "insert/ingresa_nota_venta.php",
				data:stream,
				success: function(data) {
					alert (data);
					location.href = "crear_nota_venta.php";
					// aqui tiene que enviar un mail para que sea autorizada la nota de  venta a finanzas a don andres con el detalle de la nota al mail
				}				
			});
		}
	}
        
	// **************************Elimina Productos de bodega mal ingresados*************************************//		
        //$.fn.elimina_prod_detalle_nota_venta=function(id_detalle_nota_venta,numero_nota_venta){
	$.fn.elimina_prod_detalle_nota_venta=function(id_detalle_nota_venta,id_usuario){
		var numero_nota_venta=	$('#num_nota_venta').val();
                alert(numero_nota_venta);
                if(numero_nota_venta=="NUEVA"){
                    var stream="id_detalle_nota_venta="+id_detalle_nota_venta
                            +"&"+"funcion="+1;
                    $.ajax({
			type: "POST",
			url: "delete/borra_productos_nota_venta_mal_ingresados.php",
			data:stream,
			success: function(data) {
                            alert(data);
                            var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
                            $.ajax({
                                type: "POST",
                                url: "select/trae_detalle_temporal_notaventa.php",
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
                /*
		var stream="id_detalle_nota_venta="+id_detalle_nota_venta+"&"+"funcion="+1;;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_nota_venta_mal_ingresados.php",
			data:stream,
			success: function(data) {						
				$("#productos_finanzas").find("#"+id_detalle_nota_venta).remove();
				var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+1;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_nota_venta.php",
					data:stream,
					success: function(data) {
						$('#subtotal_nota_venta').val(data);			 
						var subtotal=$('#subtotal_nota_venta').val(); 
						var subtotal=subtotal+0;
						var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+2;
						$.ajax({
							type: "POST",
							url: "select/trae_subtotal_nota_venta.php",
							data:stream,
							success: function(data) {
								$('#ila_nota_venta').val(data);
								var ila=$('#ila_nota_venta').val();
								var ila=ila+0;
								var subtotal=$('#subtotal_nota_venta').val();
								var subtotal=subtotal+0;
								var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
								var iva=(subtotal_1*19)/100;
								var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
								$('#iva_nota_venta').val(iva);
								$('#total_nota_venta').val(valor_iva);
							}			
						})
					}			
				});	
			}			
		});*/
	}
	// **************************Elimina Productos de bodega mal ingresados*************************************//		
	$.fn.elimina_prod_detalle_nota_venta_modificar=function(id_detalle_nota_venta,numero_nota_venta){
		var numero_nota_venta=$('#num_nota_venta').val();
		var stream="id_detalle_nota_venta="+id_detalle_nota_venta+"&"+"funcion="+2;
		$.ajax({
			type: "POST",
			url: "delete/borra_productos_nota_venta_mal_ingresados.php",
			data:stream,
			success: function(data) {						
				$("#productos_finanzas").find("#"+id_detalle_nota_venta).remove();
				var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+3;
				$.ajax({
					type: "POST",
					url: "select/trae_subtotal_nota_venta.php",
					data:stream,
					success: function(data) {
						$('#subtotal_nota_venta').val(data);			 
						var subtotal=$('#subtotal_nota_venta').val(); 
						var subtotal=subtotal+0;
						var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+4;
						$.ajax({
							type: "POST",
							url: "select/trae_subtotal_nota_venta.php",
							data:stream,
							success: function(data) {
								$('#ila_nota_venta').val(data);
								var ila=$('#ila_nota_venta').val();
								var ila=ila+0;
								var subtotal=$('#subtotal_nota_venta').val();
								var subtotal=subtotal+0;
								var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
								var iva=(subtotal_1*19)/100;
								var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
								$('#iva_nota_venta').val(iva);
								$('#total_nota_venta').val(valor_iva);
							}			
						})
					}			
				});	
			}			
		});
	}
	//elimina productos de modifacion a la tabla de bodega productos teminados
	$.fn.elimina_prod_detalle_nota_venta_modif=function(id_producto,id_detalle){
		var action = confirm('Crear Version Nueva de Esta Nota de Venta?');
		if(action==true)
		{
			var num_nota_venta=$("#num_nota_venta").val();		
			var stream="num_nota_venta="+num_nota_venta+"&"+"funcion="+13;
			$.ajax({
				type: "POST",
				url: "insert/ingresa_nota_venta.php",
				data:stream,
				success: function(data) {
					$("#version").val(data);
					var stream="numero_nota_venta="+num_nota_venta+"&"+"funcion="+25;
					$.ajax({
						type: "POST",
						url: "insert/ingresa_nota_venta.php",
						data:stream,
						success: function(data)	{	
							$('#productos_finanzas ').html("");	
							$('#productos_finanzas').append(data);	
							$("#prod_nota_modificar").hide();	
							$("#prod_nota_venta_modificar").show();	
						}			
					});
				}			
			});
		}
	}
	$.fn.ingresa_prod_detalle_nota_venta_modificar=function(valor){
		if($.trim($("#cajas").val())==="") 
		{
			$("#cajas").focus();
			$('#valida-cajas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-cajas').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#precio").val())==="0") 
		{
			$("#precio").focus();
			$('#valida-precio').fadeIn('slow'); 
			setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#list_prod_term").val())==="") 
		{
			$("#list_prod_term").focus();
			$('#valida-producto').fadeIn('slow'); 
			setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
			return false;
		}
		var id_producto=$('#list_prod_term option:selected').attr('id');
		var stream="id_producto="+id_producto+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "select/trae_stcok_producto.php",
			data:stream,
			success: function(data) {
				var stock_producto=data;
				var precio=$("#precio").val();
				var descuento=$("#descuento").val();
				var numero_nota_venta=$("#num_nota_venta").val();		
				var cajas=$.trim($("#cajas").val());
				if (stock_producto<=0)
				{
					$("#list_prod_term").focus("");
					$("#cajas").val("");			
					$("#list_prod_term").val("");
					$("#precio").val("");				
					$('#valida-stock_cero').fadeIn('slow'); 
					setTimeout(function(){$('#valida-stock_cero').fadeOut('slow');},1000); 
					return false;
				}
				var stream="id_producto="+id_producto+"&"+"numero_nota_venta="+numero_nota_venta+"&"+"funcion="+1;
				$.ajax({
					type: "POST",
					url: "comprobaciones/comprobar_producto_nota_venta.php",
					data:stream,
					success: function(data) {
						if (data.indexOf("Error")==-1)
						{
							var id_Usuario=$("#id_Usuario").val();	
							var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"id_Usuario="+id_Usuario
							+"&"+"numero_nota_venta="+numero_nota_venta+"&"+"stock_producto="+stock_producto+"&"+"descuento="+descuento;
							$.ajax({
								type: "POST",
								url: "insert/ingresa_producto_nota_venta_modificada.php",
								data:stream,
								success: function(data) {	
									if (data==1)
									{
										$("#cajas").val("");			
										$('#valida-stock_mayor').fadeIn('slow'); 
										setTimeout(function(){$('#valida-stock_mayor').fadeOut('slow');},1000); 
									}
									else if (data==2)
									{
										$("#cajas").val("");			
										$('#valida-cantidad_es_0').fadeIn('slow'); 
										setTimeout(function(){$('#valida-cantidad_es_0').fadeOut('slow');},1000); 
									}
									else
									{
										$('#productos_finanzas').append(data);								
										$("#list_prod_term").val ("");	
										$("#precio").val("");
										$("#cajas").val("");
										$("#descuento").val(0);
										var valor_numero_nota=$("#valor_id_nota").val();
										$("#num_nota_venta").val(valor_numero_nota);
										var numero_nota_venta=$("#num_nota_venta").val();	
										var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+3;
										$.ajax({
											type: "POST",
											url: "select/trae_subtotal_nota_venta.php",
											data:stream,
											success: function(data) {
												$('#subtotal_nota_venta').val(data);
												var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+4;
												$.ajax({
													type: "POST",
													url: "select/trae_subtotal_nota_venta.php",
													data:stream,
													success: function(data) {
														$('#ila_nota_venta').val(data);
														var ila=$('#ila_nota_venta').val();
														var ila=ila+0;
														var subtotal=$('#subtotal_nota_venta').val();
														var subtotal_1=parseFloat(ila)+parseFloat(subtotal);
														var iva=(subtotal_1*19)/100;
														var valor_iva=parseFloat(subtotal_1)+parseFloat(iva);
														$('#iva_nota_venta').val(iva);
														$('#total_nota_venta').val(valor_iva);
													}			
												});
											}			
										});
									}
								}			
							});
						}
						else
						{
							$("#list_prod_term").focus ();
							$('#valida-productos_repetidos').fadeIn('slow'); 
							setTimeout(function(){$('#valida-productos_repetidos').fadeOut('slow');},1000); 
							$("#list_prod_term").val ("");	
							$("#precio").val("");
							$("#cajas").val("");
							return false;
						}				
					}			
				});
			}
		});
	}	
	//Imprime Los datos de la Nota de Venta
	$.fn.imprimir_nota_venta=function(){	
		var numero=$('#num_nota_venta').val();
                var centro_venta=$('#centro_venta option:selected').attr('id');
		//window.open('select/imprimir_datos_facturas.php?funcion='+2+'&numero='+numero);
                //$("#cabeza_proforma").html("");
                var stream="numero="+numero
                        +"&"+"centro_venta="+centro_venta
                        +"&"+"funcion="+1;
               // alert(stream);
		$.ajax({
                    type: "POST",
                    url: "select/trae_nota_venta_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_nota_venta').html("");	
			$('#cabeza_nota_venta').append(data);
                    }			
		});
	}
        $.fn.imprimir_nota_venta1=function(numero){	
		var stream="numero="+numero
                        +"&"+"funcion="+2;
               // alert(stream);
		$.ajax({
                    type: "POST",
                    url: "select/trae_nota_venta_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_nota_venta').html("");	
			$('#cabeza_nota_venta').append(data);
                    }			
		});
	}
        $.fn.imprimir_nota_venta2=function(numero){	
		var stream="numero="+numero
                        +"&"+"funcion="+3;
               // alert(stream);
		$.ajax({
                    type: "POST",
                    url: "select/trae_nota_venta_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_nota_venta').html("");	
			$('#cabeza_nota_venta').append(data);
                    }			
		});
	}
	$.fn.imprimir_factura=function(){	
		var numero=$('#factura').val();
		window.open('select/imprimir_datos_facturas.php?funcion='+1+'&numero='+numero);
	}
	$.fn.imprimir_proforma=function(){	
		var numero=$('#num_proforma').val();
		//window.open('select/imprimir_datos_facturas.php?funcion='+4+'&numero='+numero);
                //$("#cabeza_proforma").html("");
                var stream="numero="+numero+"&"+"funcion="+1;
		$.ajax({
                    type: "POST",
                    url: "select/trae_proforma_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_proforma').html("");	
			$('#cabeza_proforma').append(data);
                    }			
		});
	}
        $.fn.imprimir_proforma_para_autorizar=function(numero){
            
		//var numero=$('#num_proforma').val();
                //alert(numero);
		//window.open('select/imprimir_datos_facturas.php?funcion='+4+'&numero='+numero);
                //$("#cabeza_proforma").html("");
                var stream="numero="+numero+"&"+"funcion="+2;
		$.ajax({
                    type: "POST",
                    url: "select/trae_proforma_impresion.php",
                    data:stream,
                    success: function(data){	
			//alert(data);
			$('#cabeza_proforma').html("");	
			$('#cabeza_proforma').append(data);
                    }			
		});
	}
        
        
        /*Imprime en PDF Proforma*/
        /*
         $.fn.imprimir_proforma=function(){	
		var numero=$('#num_proforma').val();
		window.open('select/imprimir_datos_facturas.php?funcion='+4+'&numero='+numero);
	}
         */
	$.fn.imprimir_fact_int=function(){	
		if($.trim($("#factura").val())==="") 
		{
			$('#valida-factura_1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-factura_1').fadeOut('slow');},1000); 
			return false;
		}
		var numero=$('#factura').val();
		window.open('select/imprimir_datos_facturas.php?funcion='+3+'&numero='+numero);
	}
	
	
	///Funcion que ingresa el descuento segun lo anotado en el text en nota de venta
	/*$("#descuento_nota_venta").change(function() {
		if ($('#subtotal_nota_venta').val()=="0")
		{
			$('#descuento_nota_venta').val("0");
		}
		else if  ($('#descuento_nota_venta').val()=="")
		{
			$('#descuento_nota_venta').val("0");
		}
			var descuento=$("#descuento_nota_venta").val();
			var subtotal=$('#subtotal_nota_venta').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total_neto=(subtotal-total_descuento);
			$('#subtotal_nota_venta').val(total_neto);
			var iva=(total_neto*19)/100;
			var valor_iva=(total_neto+iva);
			$('#iva_nota_venta').val(iva);
			$('#total_nota_venta').val(valor_iva);
		});*/
		///Funcion que ingresa el Precio de el ila en la nota de venta
	$("#ila_nota_venta").change(function() {
		if ($('#subtotal_nota_venta').val()=="0")
		{
			$('#ila_nota_venta').val("0");
		}
		else if  ($('#ila_nota_venta').val()=="")
		{
			$('#ila_nota_venta').val("0");
		}
			var ila=$("#ila_nota_venta").val();
			var descuento=$("#descuento_nota_venta").val();
			var subtotal=$('#subtotal_nota_venta').val(); 
			var total_descuento=(subtotal*descuento)/100;
			var total_neto=(subtotal-total_descuento);
			$('#subtotal_nota_venta').val(total_neto);
			var iva=(total_neto*19)/100;
			//var valor_iva=parseFloat(total_neto)+parseFloat(iva)+parseFloat(ila); esto sera lo de el ila que aun no se incluye
			var valor_iva=(total_neto+iva);
			$('#iva_nota_venta').val(iva);
			$('#total_nota_venta').val(valor_iva);
		});		

	//con el boton se limpian los campos de la factura
	$("#nueva").click(function() {
		 $('.limpiar').val('');
		 $('#num_nota_venta').attr('disabled',false);
		  $('#factura').attr('disabled',false);
		 $('#productos_finanzas').html('');
	});
	//acepta los productos de la seleccion y calcula la factura
	$.fn.ingresa_productos_factura=function(){	
		if($.trim($("#num_nota_venta").val())==="") 
		{
			$("#num_nota_venta").focus();
			$('#valida-nota_sin_ing').fadeIn('slow'); 
			setTimeout(function(){$('#valida-nota_sin_ing').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#factura").val())==="") 
		{
			$("#factura").focus();
			$('#valida-factura').fadeIn('slow'); 
			setTimeout(function(){$('#valida-factura').fadeOut('slow');},1000); 
			return false;
		}
		var num_nota_venta=$('#num_nota_venta').val();
		var stream="num_nota_venta="+num_nota_venta+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "select/funciones_facturacion.php",
			data:stream,
			success: function(data)	{
				$("#popdetallestk").html("");
				$("#popdetallestk").append(data);
				$("#popdetallestk").dialog("open");				
			}			
		}); 
	}
	//selecciona los productos de el checkbox para sacar calculo 
	$.fn.aceptar_productos_factura=function(){
		var action = confirm('Esta seguro que desea Ingresar estos Productos a la Factura ?');		
		if(action==true)
		{
			$("input:checkbox:checked").each(function(){
				var id_detalle_nota_venta=$(this).val();
				var factura=$("#factura").val();
				var stream="id_detalle_nota_venta="+id_detalle_nota_venta+"&"+"factura="+factura+"&"+"funcion="+4;
				$.ajax({
					type: "POST",
					url: "select/funciones_facturacion.php",
					data:stream,
					success: function(data)	{
						$('#productos_finanzas').append(data);
						$("#popdetallestk").dialog("close");					 
						var stream="factura="+factura+"&"+"funcion="+6;
						$.ajax({
							type: "POST",
							url: "select/funciones_facturacion.php",
							data:stream,
							success: function(data)	{
								$("#subtotal").val(data);
								var ila=$("#ila").val();								
								var stream="factura="+factura+"&"+"id_detalle_nota_venta="+id_detalle_nota_venta+"&"+"ila="+ila+"&"+"funcion="+7;
								$.ajax({
									type: "POST",
									url: "select/funciones_facturacion.php",
									data:stream,
									success: function(data)	{	
										$('#ila').val(data);									 
										var subtotal=$('#subtotal').val();
										var ila=$('#ila').val();
										var ila=ila+0;
										var iva=((parseFloat(ila)+parseFloat(subtotal))*19)/100;
										$('#iva').val(iva);
										var total=parseFloat(subtotal)+parseFloat(iva)+parseFloat(ila);
										$('#total').val(total);
									}			
								});					 
							}			
						});	
					}			
				});		
			});				
		}
	}
	//Esta Funcion ve los productos seleccionados en la facturacion para que queden registrados	
	$.fn.ingresa_factura=function(){
		if($.trim($("#centro_venta").val())==="") 
                {
                                        $('#valida-c_venta').fadeIn('slow'); 
                                        setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
                                        return false;
                }
                if($.trim($("#factura").val())==="") 
                {
                                        $('#valida-factura').fadeIn('slow'); 
                                        setTimeout(function(){$('#valida-factura').fadeOut('slow');},1000); 
                                        return false;
                }
                
                /*if ($('#factura').is(":not(:disabled)"))
		{
			$("#factura").focus ();
			$('#valida-factura').fadeIn('slow'); 
			setTimeout(function(){$('#valida-factura').fadeOut('slow');},1000); 
			return false;			
		}*/
                if ($.trim($("#num_nota_venta").val())==="") 
			{
				$('#num_nota_venta').val('')
				$("#num_nota_venta").focus ();
				$('#valida-importar').fadeIn('slow'); 
				setTimeout(function(){$('#valida-importar').fadeOut('slow');},1000); 
				return false;
			}
                        
                                
		if ($('#productos_finanzas >tr').length == 0)
		{
   			$('#valida-productos_factura').fadeIn('slow'); 
			setTimeout(function(){$('#valida-productos_factura').fadeOut('slow');},1000); 
			return false;
		}
                
                
                
		var action = confirm('Esta seguro que desea Grabar esta Factura?');
                //var action = confirm('Esta seguro que desea Terminar esta Factura?');
		if(action==true)
		{
			var centro_venta=$('#centro_venta option:selected').attr('id');
                        var factura=$('#factura').val();
                        //var numero_nota_venta=$('#num_nota_venta').val();
			//var num_nota_venta=$('#num_nota_venta').val();
                        var num_nota_venta=$('#num_nota_venta').val();
			var subtotal=$("#subtotal").val();
			var ila=$("#ila").val();
			var iva=$("#iva").val();
			var total=$("#total").val();
                        var id_usuario=$("#id_Usuario").val();
                        //var id_usuario = "<?php echo $id_Usuario; ?>";
                        //alert(id_usuario);
			var stream="num_nota_venta="+num_nota_venta+"&"+"factura="+factura+"&"+"subtotal="+subtotal+"&"+"ila="+ila
				+"&"+"iva="+iva+"&"+"total="+total+"&"
                                +"factura="+factura+"&"
                                +"centro_venta="+centro_venta+"&"
                                +"id_usuario="+id_usuario+"&"
                                +"funcion="+91;
                        //alert(stream);
			$.ajax({
				type: "POST",
				url: "select/funciones_facturacion.php",
				data:stream,
				success: function(data)	{
					 //alert(data);
                                         if(data==1){
                                            //alert("Factura ya existe")
                                            $('#factura').val('')
                                            $("#factura").focus ();
                                            $('#valida-factura_rep').fadeIn('slow'); 
                                            setTimeout(function(){$('#valida-factura_rep').fadeOut('slow');},1000); 
                                            return false;
                                            
                                         }else{
                                             var stream="num_nota_venta="+num_nota_venta+"&"+"factura="+factura+"&"+"subtotal="+subtotal+"&"+"ila="+ila
                                            +"&"+"iva="+iva+"&"+"total="+total+"&"
                                            +"factura="+factura+"&"
                                            +"centro_venta="+centro_venta+"&"
                                            +"id_usuario="+id_usuario+"&"
                                            +"funcion="+9;
                                                $.ajax({
                                                       type: "POST",
                                                       url: "select/funciones_facturacion.php",
                                                       data:stream,
                                                       success: function(data)	{
                                                                //alert ("Factura Ingresada");
                                                                alert (data);
                                                                location.href = "facturacion.php";
                                                       }			
                                               });
                                         }
                                         
				}			
			});
		}
	}
	//Ve el numero de la proforma y la comprueba , ademas trae los datos
	$.fn.ingresa_proforma_facturacion=function(){
		var num_proforma=$('#num_proforma').val();
		var stream="num_proforma="+num_proforma+"&"+"funcion="+10;
		$.ajax({
			type: "POST",
			url: "select/funciones_facturacion.php",
			data:stream,
			success: function(data)	{
                                //alert(data);
				if (data==1)
				{
					$("#num_proforma").focus("");
					$("#num_proforma").val("");
					$('#valida-Proforma_no_exs').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Proforma_no_exs').fadeOut('slow');},1000); 
					return false;
				}
				else if (data==2)
				{
					$("#num_proforma").focus("");
					$("#num_proforma").val("");
					$('#valida-Proforma_no_aceptada').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Proforma_no_aceptada').fadeOut('slow');},1000); 					
				}
				else if (data==3)
				{
					$("#num_proforma").focus("");
					$("#num_proforma").val("");
					$('#valida-Proforma_rechazada').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Proforma_rechazada').fadeOut('slow');},1000); 					
				}
				else if (data==4)
				{
					$("#num_proforma").focus("");
					$("#num_proforma").val("");
					$('#valida-Proforma_facturada').fadeIn('slow'); 
					setTimeout(function(){$('#valida-Proforma_facturada').fadeOut('slow');},1000); 					
				}
				else 
				{
					//$("#num_proforma").val(num_proforma);
                                        //$("#num_proforma").val(data);
					$("#num_proforma").attr('disabled',true);
                                        //alert(num_proforma+" a qui");
					var stream="num_proforma="+num_proforma+"&"+"funcion="+11;
					$.ajax({
						type: "POST",
						url: "select/funciones_facturacion.php",
						data:stream,
						cache: false,
						dataType: 'json',
						success: function(data){
							for(i=0;i<data.length;i++)
							{
								$('#cliente').val(data[i].cliente);
								$('#direccion').val(data[i].direccion);
								$('#pais').val(data[i].pais);
								$('#medio_transporte').val(data[i].medio_transporte);
								$('#lis_suc_aduanas').val(data[i].p_embarque);
                                                                //$('#p_embarque').val(data[i].p_embarque);
                                                                $('#list_aduanas').val(data[i].aduana);
								$('#p_destino').val(data[i].p_destino);
								$('#t_moneda').val(data[i].t_moneda);
								$('#cent_venta').val(data[i].cent_venta);
								$('#descripcion').val(data[i].descripcion);
								$('#claus_venta').val(data[i].claus_venta);
								$('#cond_pago').val(data[i].cond_pago);
								$('#freight').val(data[i].freight);
								$('#insurance').val(data[i].insurance);
								$('#total').val(data[i].total);
								$('#descuento').val(data[i].descuento);
								$('#subtotal').val(data[i].Subtotal);
								var stream="num_proforma="+num_proforma+"&"+"funcion="+12;
								$.ajax({
									type: "POST",
									url: "select/funciones_facturacion.php",
									data:stream,
									success: function(data)	{
										$('#productos_finanzas').append(data);
									}
								});									
							}	
						}
					});					
				}		
			}			
		});		
	}
	//crea la factura internacional que se esta ingresando
	$.fn.ingresa_factura_expor=function(){
		if($.trim($("#factura").val())==="") 
		{
			$('#factura').focus();
	 		$('#valida-factura_1').fadeIn('slow'); 
			setTimeout(function(){$('#valida-factura_1').fadeOut('slow');},1000); 
			return false;
		}
		var factura=$('#factura').val();
		var num_proforma=$("#num_proforma").val();
		var fecha_factura=$("#fecha_factura").val();
		var fecha_factura_vcto=$("#fecha_factura_vcto").val();
		var stream="factura="+factura+"&"+"num_proforma="+num_proforma+"&"+"fecha_factura="+fecha_factura
			+"&"+"fecha_factura_vcto="+fecha_factura_vcto+"&"+"funcion="+14;
                //alert(stream);
		$.ajax({
			type: "POST",
			url: "select/funciones_facturacion.php",
			data:stream,
			success: function(data)	{
				alert (data);
				location.href = "factura_export.php";			
			}
		});	
	}
		//edita el precio de la lista precio
	$.fn.actualizar_precio=function(){
		$("#popdetallestk").html("");
		$("#popdetallestk").dialog("open");
		$("#popdetallestk").dialog("option","title","Actualizar Precio");
		$("#popdetallestk").append("<table class='tableform'><tr><td><label>Precio</label></td><td><input type='hidden' id='id_lista'/><input type='text' id='precio' placeholder='precio'/></td><td><input type='submit' onClick='$(this).ingresa_precio_lista();' value='Cambiar &raquo;'/></td></tr></table>");
		var id_lista = $(this).parents('tr').find("td").attr('id');
		$('#id_lista').val(id_lista);	
		var stream="id_lista="+id_lista+"&"+"funcion="+19;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			success: function(data)	{
				$('#precio').val(data);				
			}
		});	
	}	
	//Cambia el precio de la lista precio
	$.fn.ingresa_precio_lista=function(){
		var precio=$("#precio").val();
		var id_lista = $('#id_lista').val();	
		var id_Usuario = $('#id_Usuario').val();			
		var stream="id_lista="+id_lista+"&"+"precio="+precio+"&"+"id_Usuario="+id_Usuario+"&"+"funcion="+20;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			success: function(data)	{
				$('#precio').val(data);
				location.href = "lista_precios.php";			
			}
		});	
	}
		//ingresa guia de despacho
	$.fn.ingresa_guia_despacho=function(){
		if($.trim($("#num_proforma").val())==="") 
		{
			$("#num_proforma").focus ();
			$('#valida-num_proforma').fadeIn('slow'); 
			setTimeout(function(){$('#valida-num_proforma').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#num_guia").val())==="") 
		{
			$("#num_guia").focus ();
			$('#valida-num_guia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-num_guia').fadeOut('slow');},1000); 
			return false;
		}
                /*
		if($.trim($("#list_aduanas").val())==="") 
		{
			$("#list_aduanas").focus ();
			$('#valida-aduanas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-aduanas').fadeOut('slow');},1000); 
			return false;
		}*/
		if($.trim($("#m_nave").val())==="") 
		{
			$("#m_nave").focus ();
			$('#valida-m_nave').fadeIn('slow'); 
			setTimeout(function(){$('#valida-m_nave').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#bk").val())==="") 
		{
			$("#bk").focus ();
			$('#valida-bk').fadeIn('slow'); 
			setTimeout(function(){$('#valida-bk').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#contenedor").val())==="") 
		{
			$("#contenedor").focus ();
			$('#valida-contenedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contenedor').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#sello").val())==="") 
		{
			$("#sello").focus ();
			$('#valida-sello').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sello').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#chofer").val())==="") 
		{
			$("#chofer").focus ();
			$('#valida-chofer').fadeIn('slow'); 
			setTimeout(function(){$('#valida-chofer').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#movil").val())==="") 
		{
			$("#movil").focus ();
			$('#valida-movil').fadeIn('slow'); 
			setTimeout(function(){$('#valida-movil').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#patente").val())==="") 
		{
			$("#patente").focus ();
			$('#valida-patente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-patente').fadeOut('slow');},1000); 
			return false;
		}if($.trim($("#dus").val())==="") 
		{
			$("#dus").focus ();
			$('#valida-dus').fadeIn('slow'); 
			setTimeout(function(){$('#valida-dus').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#kn").val())==="") 
		{
			$("#kn").focus ();
			$('#valida-kn').fadeIn('slow'); 
			setTimeout(function(){$('#valida-kn').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#kb").val())==="") 
		{
			$("#kb").focus ();
			$('#valida-kb').fadeIn('slow'); 
			setTimeout(function(){$('#valida-kb').fadeOut('slow');},1000); 
			return false;
		}
		//var id_aduana =$('#list_aduanas option:selected').attr('id');
		var num_proforma=$("#num_proforma").val();
		var num_guia=$("#num_guia").val();
		var nave=$("#m_nave").val();
                var bk=$("#bk").val();
		var contenedor=$("#contenedor").val();
                var sello=$("#sello").val();
                var chofer=$("#chofer").val();
		var movil=$("#movil").val();
		var patente=$("#patente").val();	
                var dus=$("#dus").val();
                var kn=$("#kn").val();
                var kb=$("#kb").val();
		//var proforma=$("#num_proforma").val();	
		var stream="num_guia="+num_guia+"&"+"funcion="+13;
		$.ajax({
			type: "POST",
			url: "insert/insertar_proforma.php",
			data:stream,
			success: function(data)	{	
				if (data==1)
				{
					$("#num_guia").focus ();
					$('#valida-respetido').fadeIn('slow'); 
                                        //$("#num_guia").val();
					setTimeout(function(){$('#valida-respetido').fadeOut('slow');},1000); 
					return false;
				}
				else
				{
					var stream="num_proforma="+num_proforma
                                                +"&"+"num_guia="+num_guia
                                                +"&"+"nave="+nave
                                                +"&"+"bk="+bk
                                                +"&"+"contenedor="+contenedor
						+"&"+"sello="+sello
                                                +"&"+"chofer="+chofer
                                                +"&"+"movil="+movil
                                                +"&"+"patente="+patente
                                                +"&"+"dus="+dus
                                                +"&"+"kn="+kn
                                                +"&"+"kb="+kb
                                                +"&"+"funcion="+10;
					//alert (stream);
					$.ajax({
						type: "POST",
						url: "insert/insertar_proforma.php",
						data:stream,
						success: function(data)	{
							alert (data);
							location.href = "guia_despacho.php";	
						}
					});
				}
			}
		});	
	}	
	//Modifica guia de despacho
	$.fn.modificar_guia_despacho=function(){
		if($.trim($("#num_guia").val())==="") 
		{
			$("#num_guia").focus ();
			$('#valida-num_guia').fadeIn('slow'); 
			setTimeout(function(){$('#valida-num_guia').fadeOut('slow');},1000); 
			return false;
		}
		/*if($.trim($("#list_aduanas").val())==="") 
		{
			$("#list_aduanas").focus ();
			$('#valida-aduanas').fadeIn('slow'); 
			setTimeout(function(){$('#valida-aduanas').fadeOut('slow');},1000); 
			return false;
		}*/
		if($.trim($("#m_nave").val())==="") 
		{
			$("#m_nave").focus ();
			$('#valida-m_nave').fadeIn('slow'); 
			setTimeout(function(){$('#valida-m_nave').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#bk").val())==="") 
		{
			$("#bk").focus ();
			$('#valida-bk').fadeIn('slow'); 
			setTimeout(function(){$('#valida-bk').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#contenedor").val())==="") 
		{
			$("#contenedor").focus ();
			$('#valida-contenedor').fadeIn('slow'); 
			setTimeout(function(){$('#valida-contenedor').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#sello").val())==="") 
		{
			$("#sello").focus ();
			$('#valida-sello').fadeIn('slow'); 
			setTimeout(function(){$('#valida-sello').fadeOut('slow');},1000); 
			return false;
		}if($.trim($("#chofer").val())==="") 
		{
			$("#chofer").focus ();
			$('#valida-chofer').fadeIn('slow'); 
			setTimeout(function(){$('#valida-chofer').fadeOut('slow');},1000); 
			return false;
		}
                
		if($.trim($("#movil").val())==="") 
		{
			$("#movil").focus ();
			$('#valida-movil').fadeIn('slow'); 
			setTimeout(function(){$('#valida-movil').fadeOut('slow');},1000); 
			return false;
		}
		if($.trim($("#patente").val())==="") 
		{
			$("#patente").focus ();
			$('#valida-patente').fadeIn('slow'); 
			setTimeout(function(){$('#valida-patente').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#dus").val())==="") 
		{
			$("#dus").focus ();
			$('#valida-dus').fadeIn('slow'); 
			setTimeout(function(){$('#valida-dus').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#kn").val())==="") 
		{
			$("#kn").focus ();
			$('#valida-kn').fadeIn('slow'); 
			setTimeout(function(){$('#valida-kn').fadeOut('slow');},1000); 
			return false;
		}
                if($.trim($("#kb").val())==="") 
		{
			$("#kb").focus ();
			$('#valida-kb').fadeIn('slow'); 
			setTimeout(function(){$('#valida-kb').fadeOut('slow');},1000); 
			return false;
		}
		//var id_aduana =$('#list_aduanas option:selected').attr('id');
		var num_proforma=$("#num_proforma").val();
		var num_guia=$("#num_guia").val();
		var nave=$("#m_nave").val();
                var bk=$("#bk").val();
		var contenedor=$("#contenedor").val();
                var sello=$("#sello").val();
                var chofer=$("#chofer").val();
		var movil=$("#movil").val();
		var patente=$("#patente").val();	
                var dus=$("#dus").val();
                var kn=$("#kn").val();
                var kb=$("#kb").val();
		//var id_guia=$("#id_guia").val();		
                //var stream="num_guia="+num_guia+"&"+"id_guia="+id_guia+"&"+"funcion="+13;
		var stream="num_guia="+num_guia
                        +"&"+"funcion="+13;
		$.ajax({
			type: "POST",
			url: "insert/insertar_proforma.php",
			data:stream,
			success: function(data)	{	
				if (data==1)
				{
					var stream="num_guia="+num_guia
                                                +"&"+"nave="+nave
                                                +"&"+"bk="+bk
                                                +"&"+"contenedor="+contenedor
                                                +"&"+"sello="+sello
						+"&"+"chofer="+chofer
                                                +"&"+"movil="+movil
                                                +"&"+"patente="+patente
                                                +"&"+"dus="+dus
                                                +"&"+"kn="+kn
                                                +"&"+"kb="+kb
                                                +"&"+"funcion="+14;
					$.ajax({
						type: "POST",
						url: "insert/insertar_proforma.php",
						data:stream,
						success: function(data)	{
							alert (data);
							location.href = "guia_despacho.php";	
						}
					});
				}
				else
				{
					$("#num_guia").focus ();
					$('#valida-erroneo').fadeIn('slow'); 
					setTimeout(function(){$('#valida-erroneo').fadeOut('slow');},1000); 
					return false;
				}
			}
		});	
	}
});