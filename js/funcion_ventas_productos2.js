$(function(){
        //Filtros
        //Rango Fecha
        $.fn.rango_fecha2=function(){
            //alert("fecha");
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
        $.fn.rango_cliente2=function(){
            //alert("Cliente");
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
        $.fn.rango_producto2=function(){
            //alert("Producto");
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
       
        
        
        
        //Ventas Nacionales
        $.fn.Filtro_ventas_nac=function(){
            //alert("aqui");
            var ranfec=$('input:checkbox[name=ranfec]:checked').val();
            var rancli=$('input:checkbox[name=rancli]:checked').val();
            var ranpro=$('input:checkbox[name=ranpro]:checked').val();
            
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
               $.ajax({
			type: "POST",
			url: "select/trae_objetos_informe_export_detalle2.php",
			data:stream,
			success: function(data) {
                               $('#detalle_expor2').html("");
                               $('#detalle_expor').html("");
                               $('#detalle_expor').append(data);
                               var tot1=$("#tot1").val();
                               var stream="fecha1="+fecha1
                                    +"&"+"fecha2="+fecha2
                                    +"&"+"tot1="+tot1
                                    +"&"+"funcion="+61;
                               $.ajax({
                                    type: "POST",
                                    url: "select/trae_objetos_informe_export_detalle2.php",
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
			url: "select/trae_objetos_informe_export_detalle2.php",
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
                                    url: "select/trae_objetos_informe_export_detalle2.php",
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
	
});