<?php
	date_default_timezone_set('UTC');
	$fecha=date("Y-m-d");
	include_once("clases/conexion.php"); 
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	} 
	$user=($_SESSION['usuario']);
	$id_Usuario=($_SESSION['id_Usuario']);  
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nota de Venta</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_ventas_productos.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
</head>
<script>
$(document).ready(function() {
	var id_usuario = "<?php echo $id_Usuario; ?>";
	var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
	$.ajax({
		type: "POST",
		url: "insert/ingresa_nota_venta.php",
		data:stream,
		success: function(data)	{								
			//$("#num_nota_venta").val (data);
		}			
	});	
	$('#num_nota_venta').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#num_nota_venta").val())==="") 
			{
				/*$("#num_nota_venta").focus();
				$('#valida-nota_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nota_venta').fadeOut('slow');},1000); 
				return false;*/
                                $("#num_nota_venta").val ("NUEVA");
                                var not=$("#num_nota_venta").val();
			}
			if ($.trim($("#num_nota_venta").val())==="0") 
			{
				$('#num_nota_venta').val('')
				$("#num_nota_venta").focus ();
				$('#valida-nota_venta_0').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nota_venta_mayor').fadeOut('slow');},1000); 
				return false;
			}
                        if(not=="NUEVA"){
                            $("#num_nota_venta").attr('disabled',true);
                            
                            var id_usuario = "<?php echo $id_Usuario; ?>";
                            //alert(id_usuario);
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
                                            
                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_subtotal').html(data);
                                                                                        }			
                                                                                    });
                                            
                                            //ILA Total
                                            var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                            $.ajax({
                                                type: "POST",
                                                url: "select/trae_subtotal_nota_venta.php",//trae_subtotal_nota_venta
                                                data:stream,
                                                success: function(data) {
                                                    var ila_tot =parseInt(data);
                                                    $('#ila_nota_venta').val(ila_tot);
                                                    var dato=$('#ila_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_ila').html(data);
                                                                                        }			
                                                                                    });
                                                    
                                                    var iva_tot=parseInt(sub_tot*19/100);
                                                    $('#iva_nota_venta').val(iva_tot);
                                                    var dato=$('#iva_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_iva').html(data);
                                                                                        }			
                                                                                    });
                                                                                    
                                                    var tot_tot=sub_tot+ila_tot+iva_tot;
                                                    $('#total_nota_venta').val(tot_tot);
                                                    var dato=$('#total_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_total').html(data);
                                                                                        }			
                                                                                    });
                                                }			
                                            });
                                        }			
                                    });
                                }			
                            });
                        }else{
                                var numero_nota_venta=$('#num_nota_venta').val();
                                
                                if($.trim($("#centro_venta").val())==="") 
                                {
                                        $('#valida-c_venta').fadeIn('slow'); 
                                        setTimeout(function(){$('#valida-c_venta').fadeOut('slow');},1000); 
                                        return false;
                                }
                                var centro_venta=$('#centro_venta option:selected').attr('id');
                               /*$.fn.imprimir_proforma_para_autorizar=function(numero){
            
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
	}*/
                                //alert("aqui"+numero_nota_venta);
                                var stream="numero_nota_venta="+numero_nota_venta
                                        +"&"+"centro_venta="+centro_venta
                                        +"&"+"funcion="+5;
                                $.ajax({
                                        type: "POST",
                                        url: "insert/ingresa_nota_venta.php",
                                        data:stream,
                                        success: function(data)	{
                                            //alert(data);
                                                if (data==1)
                                                {
                                                        var action = confirm('Desea Traer Nota De Venta?');
                                                        if(action==true)
                                                        {
                                                                var numero_nota_venta=$("#num_nota_venta").val ();
                                                                //var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+6;
                                                                var stream="numero_nota_venta="+numero_nota_venta
                                                                        +"&"+"centro_venta="+centro_venta
                                                                        +"&"+"funcion="+6;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/ingresa_nota_venta.php",
                                                                        data:stream,
                                                                        cache: false,
                                                                        dataType: 'json',
                                                                        success: function(data)	{	
                                                                                for(i=0;i<data.length;i++)
                                                                                {
                                                                                        if (data[i].valor==1)
                                                                                        {
                                                                                                alert ("Nota de Venta Vacia Ingrese Otra");
                                                                                                $("#btn_imprimir").hide();
                                                                                                $("#btn_nota_nueva").hide();									
                                                                                                $(".limpiar").val ('');
                                                                                                $(".limpiar_2").val (0);				
                                                                                                $("#productos_finanzas").html ('');	
                                                                                                location.href = "crear_nota_venta.php";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                $('#fecha_nota_venta').val(data[i].fecha_nota_venta);
                                                                                                $('#id_cliente_nacional').val(data[i].cliente);
                                                                                                var id_cliente= (data[i].id_cliente);
                                                                                                //alert(id_cliente);//
                                                                                                $('#centro_venta').val(data[i].centro_venta);
                                                                                                $('#estado').val(data[i].estado);
                                                                                                $('#orden_compra').val(data[i].orden_compra);
                                                                                                $('#fecha_despacho_nota_venta').val(data[i].fecha_despacho);
                                                                                                //$('#condicion_venta').val(data[i].Condicion);
                                                                                                var Condicion=(data[i].Condicion);
                                                                                                $('#rut_cliente').val(data[i].rut);
                                                                                                //$('#list_vendedores').val(data[i].vendedor);
                                                                                                var vendedor=(data[i].vendedor);
                                                                                                $('#obs_despacho').val(data[i].observacion);
                                                                                                $('#subtotal_nota_venta').val(data[i].sub_total);
                                                                                                var dato=$('#subtotal_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#iva_nota_venta').val(data[i].iva);
                                                                                                var dato=$('#iva_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#total_nota_venta').val(data[i].total);
                                                                                                var dato=$('#total_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#ila_nota_venta').val(data[i].ila);
                                                                                                var dato=$('#ila_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_ila').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#version').val(data[i].version);
                                                                                                var suc=(data[i].suc);
                                                                                                //alert(suc);
                                                                                                var stream="suc="+suc;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_sucursal_cli_nac2.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#suc').html();
                                                                                                                $('#suc').html(data);			 
                                                                                                        }	 			
                                                                                                });
                                                                                                //
                                                                                                var stream="id_cliente="+id_cliente;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_pago_cliente_nac.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#pago').html();
                                                                                                                $('#pago').html(data);			 
                                                                                                        }	 			
                                                                                                });
                                                                                                var stream="id_cliente="+id_cliente;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_vendedor_cli_na.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#vend').html();
                                                                                                                $('#vend').html(data);			 
                                                                                                        }	 			
                                                                                                });
                                                                                                var stream="id_cliente="+id_cliente;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_canal_cliente_nac.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#canal').html();
                                                                                                                $('#canal').html(data);	
                                                                                                                var id_canal=$('#canal_cli option:selected').attr('id');
                                                                                                                
                                                                                                        }	 			
                                                                                                });
                                                                                                var stream="id_cliente="+id_cliente;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_lista_cliente_nac_nota.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#lista_precio').html();
                                                                                                                $('#lista_precio').html(data);			 
                                                                                                        }	 			
                                                                                                });
                                                                                               var centro_venta=$('#centro_venta option:selected').attr('id');
                                                                                                //alert(centro_venta);
                                                                                                var stream="numero_nota_venta="+numero_nota_venta
                                                                                                        +"&"+"centro_venta="+centro_venta
                                                                                                        +"&"+"funcion="+12;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/ingresa_nota_venta.php",
                                                                                                        data:stream,
                                                                                                        success: function(data)	{	
                                                                                                                $('#productos_finanzas').html("");	
                                                                                                                $('#productos_finanzas').append(data);		
                                                                                                        }			
                                                                                                });
                                                                                                $("#btn_imprimir").show();
                                                                                                //$("#prod_nota_modificar").show();												
                                                                                                $("#prod_nota_nuevos").hide();	
                                                                                                //$("#btn_nota_modificada").show();	
                                                                                                $("#btn_nota_nueva").hide();												
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                                        }
                                                }
                                                else if (data==2)
                                                {
                                                        var action = confirm('Desea Cambiar Esta Nota De Venta?');
                                                        if(action==true)
                                                        {
                                                                //$("#num_nota_venta").attr('disabled',true);
                                                                var numero_nota_venta=$("#num_nota_venta").val ();
                                                                var stream="numero_nota_venta="+numero_nota_venta
                                                                        +"&"+"centro_venta="+centro_venta
                                                                        +"&"+"funcion="+6;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/ingresa_nota_venta.php",
                                                                        data:stream,
                                                                        cache: false,
                                                                        dataType: 'json',
                                                                        success: function(data)	{	
                                                                                for(i=0;i<data.length;i++)
                                                                                {
                                                                                        if (data[i].valor==1)
                                                                                        {
                                                                                                alert ("Nota de Venta Vacia Ingrese Otra");
                                                                                                $("#btn_imprimir").hide();
                                                                                                $("#btn_nota_nueva").hide();									
                                                                                                $(".limpiar").val ('');
                                                                                                $(".limpiar_2").val (0);				
                                                                                                $("#productos_finanzas").html ('');	
                                                                                                location.href = "crear_nota_venta.php";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                //aqui voy
                                                                                                $('#fecha_nota_venta').val(data[i].fecha_nota_venta);
                                                                                                $('#id_cliente_nacional').val(data[i].cliente);
                                                                                                var id_cliente= (data[i].id_cliente);
                                                                                                //alert(id_cliente);//
                                                                                                $('#centro_venta').val(data[i].centro_venta);
                                                                                                $('#estado').val(data[i].estado);
                                                                                                $('#orden_compra').val(data[i].orden_compra);
                                                                                                $('#fecha_despacho_nota_venta').val(data[i].fecha_despacho);
                                                                                                //$('#condicion_venta').val(data[i].Condicion);
                                                                                                var Condicion=(data[i].Condicion);
                                                                                                $('#rut_cliente').val(data[i].rut);
                                                                                                //$('#list_vendedores').val(data[i].vendedor);
                                                                                                var vendedor=(data[i].vendedor);
                                                                                                $('#obs_despacho').val(data[i].observacion);
                                                                                                $('#subtotal_nota_venta').val(data[i].sub_total);
                                                                                                var dato=$('#subtotal_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#iva_nota_venta').val(data[i].iva);
                                                                                                var dato=$('#iva_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#total_nota_venta').val(data[i].total);
                                                                                                var dato=$('#total_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#ila_nota_venta').val(data[i].ila);
                                                                                                var dato=$('#ila_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_ila').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#version').val(data[i].version);
                                                                                                var suc=(data[i].suc);
                                                                                                //alert(suc);
                                                                                                var stream="suc="+suc;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_sucursal_cli_nac2.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#suc').html();
                                                                                                                $('#suc').html(data);			 
                                                                                                        }	 			
                                                                                                });
                                                                                                //
                                                                                                var stream="id_cliente="+id_cliente;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_pago_cliente_nac.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#pago').html();
                                                                                                                $('#pago').html(data);			 
                                                                                                        }	 			
                                                                                                });
                                                                                                var stream="id_cliente="+id_cliente;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_vendedor_cli_na.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#vend').html();
                                                                                                                $('#vend').html(data);			 
                                                                                                        }	 			
                                                                                                });
                                                                                                var stream="id_cliente="+id_cliente;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_canal_cliente_nac.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#canal').html();
                                                                                                                $('#canal').html(data);	
                                                                                                                var id_canal=$('#canal_cli option:selected').attr('id');
                                                                                                                
                                                                                                        }	 			
                                                                                                });
                                                                                                var stream="id_cliente="+id_cliente;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "select/trae_lista_cliente_nac_nota.php",
                                                                                                        data:stream,
                                                                                                        success: function(data) {
                                                                                                                $('#lista_precio').html();
                                                                                                                $('#lista_precio').html(data);			 
                                                                                                        }	 			
                                                                                                });
                                                                                               var centro_venta=$('#centro_venta option:selected').attr('id');
                                                                                                //alert(centro_venta);
                                                                                                var stream="numero_nota_venta="+numero_nota_venta
                                                                                                        +"&"+"centro_venta="+centro_venta
                                                                                                        +"&"+"funcion="+12;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/ingresa_nota_venta.php",
                                                                                                        data:stream,
                                                                                                        success: function(data)	{	
                                                                                                                $('#productos_finanzas').html("");	
                                                                                                                $('#productos_finanzas').append(data);		
                                                                                                        }			
                                                                                                });
                                                                                                $("#btn_imprimir").show();
                                                                                                //$("#prod_nota_modificar").show();												
                                                                                                $("#prod_nota_nuevos").hide();	
                                                                                                //$("#btn_nota_modificada").show();	
                                                                                                $("#btn_nota_nueva").hide();
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                                        }					
                                                }
                                                else if (data==3)
                                                {
                                                        $('#num_nota_venta').val('')
                                                        $("#num_nota_venta").focus ();
                                                        $('#valida-nota_venta_correlativo').fadeIn('slow'); 
                                                        setTimeout(function(){$('#valida-nota_venta_correlativo').fadeOut('slow');},1000); 
                                                        var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
                                                        $.ajax({
                                                                type: "POST",
                                                                url: "insert/ingresa_nota_venta.php",
                                                                data:stream,
                                                                success: function(data)	{								
                                                                        $("#num_nota_venta").val (data);
                                                                }			
                                                        });	
                                                }
                                                else if (data==4)
                                                {
                                                        var numero_nota_venta=$("#num_nota_venta").val ();
                                                        var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+6;
                                                        $.ajax({
                                                                type: "POST",
                                                                url: "insert/ingresa_nota_venta.php",
                                                                data:stream,
                                                                cache: false,
                                                                dataType: 'json',
                                                                success: function(data)	{	
                                                                        for(i=0;i<data.length;i++)
                                                                        {
                                                                                if (data[i].valor==1)
                                                                                {
                                                                                        alert ("Nota de Venta Vacia Ingrese Otra");
                                                                                        $("#btn_imprimir").hide();
                                                                                        $("#btn_nota_nueva").hide();									
                                                                                        $(".limpiar").val ('');
                                                                                        $(".limpiar_2").val (0);				
                                                                                        $("#productos_finanzas").html ('');	
                                                                                        location.href = "crear_nota_venta.php";
                                                                                }
                                                                                else
                                                                                {
                                                                                        $('#fecha_nota_venta').val(data[i].fecha_nota_venta);
                                                                                        $('#id_cliente_nacional').val(data[i].cliente);
                                                                                        $('#centro_venta').val(data[i].centro_venta);
                                                                                        $('#orden_compra').val(data[i].orden_compra);
                                                                                        $('#fecha_despacho_nota_venta').val(data[i].fecha_despacho);
                                                                                        $('#condicion_venta').val(data[i].Condicion);
                                                                                        $('#rut_cliente').val(data[i].rut);
                                                                                        $('#list_vendedores').val(data[i].vendedor);
                                                                                        $('#obs_despacho').val(data[i].observacion);
                                                                                        $('#subtotal_nota_venta').val(data[i].sub_total);
                                                                                                var dato=$('#subtotal_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#iva_nota_venta').val(data[i].iva);
                                                                                                var dato=$('#iva_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#total_nota_venta').val(data[i].total);
                                                                                                var dato=$('#total_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                $('#ila_nota_venta').val(data[i].ila);
                                                                                                var dato=$('#ila_nota_venta').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+1;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_ila').html(data);
                                                                                                    }			
                                                                                                });
                                                                                        $('#version').val(data[i].version);
                                                                                        var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+30;
                                                                                        $.ajax({
                                                                                                type: "POST",
                                                                                                url: "insert/ingresa_nota_venta.php",
                                                                                                data:stream,
                                                                                                success: function(data)	{	
                                                                                                        $('#productos_finanzas ').html("");	
                                                                                                        $('#productos_finanzas').append(data);		
                                                                                                }			
                                                                                        });
                                                                                        $("#estado_proforma").show();
                                                                                        $("#btn_nota_nueva").hide();	
                                                                                        $("#prod_nota_nuevos").hide();												
                                                                                }						 
                                                                        }								
                                                                }			
                                                        });
                                                }
                                        } 
                                });
                            }
		} 
	});
	// se trae el rut de cliente se aprovecha la pagina por ser un requerimiento posterior
	/*var stream="funcion="+4;
	$.ajax({
		type: "POST",
		url: "insert/ingresa_nota_venta.php",
		data:stream,
		success: function(data)	{
			$("#lista_precio").html ("");
			$("#lista_precio").append (data);
		}	
	});*/
	$("#fecha_despacho_nota_venta").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	$("#id_cliente_nacional").change(function() {
		// se trae el rut de cliente se aprovecha la pagina por ser un requerimiento posterior
		var id_cliente = $('#id_cliente_nacional option:selected').attr('id');
                if ($.trim($("#id_cliente_nacional").val())==="") 
			{
				//$('#id_cliente_nacional').val('')
				$("#id_cliente_nacional").focus ();
				$('#valida-c_nac').fadeIn('slow'); 
				setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
				return false;
			}
                var stream="id_cliente="+id_cliente;
                $.ajax({
                        type: "POST",
                        url: "select/trae_sucursal_cli_nac.php",
                        data:stream,
                        success: function(data) {
                                $('#suc').html();
                                $('#suc').html(data);			 
                        }	 			
                });
                
                var stream="id_cliente="+id_cliente;
                $.ajax({
                        type: "POST",
                        url: "select/trae_pago_cliente_nac.php",
                        data:stream,
                        success: function(data) {
                                $('#pago').html();
                                $('#pago').html(data);			 
                        }	 			
                });
                var stream="id_cliente="+id_cliente;
                $.ajax({
                        type: "POST",
                        url: "select/trae_vendedor_cli_na.php",
                        data:stream,
                        success: function(data) {
                                $('#vend').html();
                                $('#vend').html(data);			 
                        }	 			
                });
                var stream="id_cliente="+id_cliente;
                $.ajax({
                        type: "POST",
                        url: "select/trae_canal_cliente_nac.php",
                        data:stream,
                        success: function(data) {
                                $('#canal').html();
                                $('#canal').html(data);	
                                var id_canal=$('#canal_cli option:selected').attr('id');
                                //alert(id_canal);
                                var stream="id_canal="+id_canal;
                                $.ajax({
						type: "POST",
						url: "select/trae_descuento_canal_cliente_nac.php",
						data:stream,
						success: function(data){
							//alert (data);
							$("#descuento").val (data);	
						}			
					});
                        }	 			
                });
                var stream="id_cliente="+id_cliente;
                $.ajax({
                        type: "POST",
                        url: "select/trae_lista_cliente_nac_nota.php",
                        data:stream,
                        success: function(data) {
                                $('#lista_precio').html();
                                $('#lista_precio').html(data);			 
                        }	 			
                });
                
		var stream="id_cliente="+id_cliente+"&"+"funcion="+3;
		$.ajax({
			type: "POST",
			url: "insert/ingresa_nota_venta.php",
			data:stream,
			success: function(data)	{		
				$("#rut_cliente").val (data);	
                                /*
				var stream="id_cliente="+id_cliente+"&"+"funcion="+1;
				$.ajax({
					type: "POST",
					url: "select/trae_suma_factura_pagos.php",
					data:stream,
					success: function(data)	{		
						alert (data);							
					}	
				});*/
			}	
		});
                $("#list_prod_term_proforma").focus();
	});	
        $('#cajas').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#estado").val())>"0") 
                        {
                                $("#cajas").focus();
                                $('#valida-cajas_autorizad').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-cajas_autorizad').fadeOut('slow');},1000); 
                                return false;
                        }
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
                        var ila_nota_venta=$.trim($("#ila_pro").val());
                        var cajas=$.trim($("#cajas").val());
                        var id_producto=$('#list_prod_term option:selected').attr('id');
                        var cliente=$('#id_cliente_nacional option:selected').attr('id');
                        //aqui
                        if(numero_nota_venta=="") 
                        {
                                $("#num_nota_venta").focus();
                                $('#valida-nota_venta_Vacia').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-nota_venta_Vacia').fadeOut('slow');},1000); 
                                return false;
                        }
                        if(cliente=="") 
                        {
                                $("#num_nota_venta").focus();
                                $('#valida-c_nac').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-c_nac').fadeOut('slow');},1000); 
                                return false;
                        }
                        //Nueva
                        if(numero_nota_venta=="NUEVA"){
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
                                                    +"&"+"ila_nota_venta="+ila_nota_venta
                                                    +"&"+"descuento="+descuento;
                                                    /*var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"id_Usuario="+id_Usuario
                                                    +"&"+"numero_nota_venta="+numero_nota_venta+"&"+"stock_producto="+stock_producto+"&"+"descuento="+descuento;*/
                                                    $.ajax({
                                                            type: "POST",
                                                            url: "insert/ingresa_producto_nota_venta.php",
                                                            data:stream,
                                                            success: function(data) {	
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
                                                                            //$("#descuento").val (0);

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
                                                                                    ///Por aqui
                                                                                    var sub_tot =parseInt(data);
                                                                                    $('#subtotal_nota_venta').val(sub_tot);
                                                                                    
                                                                                    var dato=$('#subtotal_nota_venta').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+1;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_subtotal').html(data);
                                                                                        }			
                                                                                    });
                                                                                    //ILA Total
                                                                                    var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/trae_subtotal_nota_venta.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            var ila_tot =parseInt(data);
                                                                                            $('#ila_nota_venta').val(ila_tot);
                                                                                            var dato=$('#ila_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_ila').html(data);
                                                                                                }			
                                                                                            });

                                                                                            var iva_tot=parseInt(sub_tot*19/100);
                                                                                            $('#iva_nota_venta').val(iva_tot);
                                                                                            var dato=$('#iva_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                    //alert(data);
                                                                                                    $('#id_iva').html(data);
                                                                                                }			
                                                                                            });
                                                                                            
                                                                                            var tot_tot=sub_tot+ila_tot+iva_tot;
                                                                                            $('#total_nota_venta').val(tot_tot);
                                                                                            var dato=$('#total_nota_venta').val();
                                                                                            var stream="dato="+dato+"&"+"funcion="+1;
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                data:stream,
                                                                                                success: function(data) {
                                                                                                   // alert(data);
                                                                                                    $('#id_total').html(data);
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
	});
        
        //bUSCA nOT vENT
        
        
        $('#busca_pro').keypress(function (e) {
		if(e.which ==13)
		{
			var busca_pro=$("#busca_pro").val();
			//alert(busca_pro);
			if($.trim($("#busca_pro").val())==="") 
			{
				//busca todos los productos
				var stream="busca_pro="+busca_pro+"&"+"funcion="+1;
				$.ajax({
					type: "POST",
					url: "combos/trae_productos.php",
					data:stream,
					success: function(data)	{	
						//alert(data);
						$('#list_prod_term').html("");	
						$('#list_prod_term').append(data);
					}			
				});
			}else{
				var stream="busca_pro="+busca_pro+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "combos/trae_productos.php",
					data:stream,
					success: function(data)	{	
						//alert(data);
						$('#list_prod_term').html("");	
						$('#list_prod_term').append(data);
					}			
				});
			}
		}
	});
        
	$( "#fecha_despacho_nota_venta" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_nota_venta").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	 $( "#fecha_despacho_nota_venta" ).datepicker( $.datepicker.regional[ "es" ]);
});
function ValidaSoloNumeros() {
 if ( (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body" id="cabeza_nota_venta">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Nota de Venta</p>
					</div>
					<div class="content">  
						
                                                
                                                    <table>
                                                        <tr>
                                                            <td colspan="2" >
                                                                
                                                                <div>  
                                                                        <div class="fright">
                                                                                <a href="principal_comercializacion.php"><input type="button" value="Volver&raquo;"/></a>
                                                                                <a href="crear_nota_venta.php"><input type="button"  value="Nueva Nota de Venta&raquo;"/></a>
                                                                        </div>
                                                                </div>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td style="width: 30%">
                                                                <article class="module width_full">            
                                                                    <div class="module_content">
                                                                        <table class="tablesorter" id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Centro de Venta</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <select id="centro_venta" class='limpiar'>
                                                                                            </select>
                                                                                            <div id="valida-c_venta" style="display:none" class="errores">
                                                                                                    Debe Seleccionar Centro de Venta
                                                                                            </div> 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Numero</label>
                                                                                        <input type="hidden" id="estado">
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="num_nota_venta"  onkeypress="ValidaSoloNumeros()" placeholder="Numero"/>	
                                                                                            <input type="hidden" id="id_Usuario"  value="<?php echo $id_Usuario?>"/>	
                                                                                            <div id="valida-nota_venta" style="display:none" class="errores">
                                                                                                    Debe Ingresar Nota de Venta
                                                                                            </div> 
                                                                                            <div id="valida-nota_venta_mayor" style="display:none" class="errores">
                                                                                                    El Numero que Ingrea es Mayor al de El Correlativo
                                                                                            </div>
                                                                                            <div id="valida-nota_venta_0" style="display:none" class="errores">
                                                                                                    El Numero No Puede Ser 0 !!!!
                                                                                            </div> 
                                                                                            <div id="valida-nota_venta_crear" style="display:none" class="errores">
                                                                                                    Debe Crear Nota de Venta
                                                                                            </div> 
                                                                                            <div id="valida-nota_venta_correlativo" style="display:none" class="errores">
                                                                                                    Numero Mas Alto que de el Correlativo
                                                                                            </div> 
                                                                                            <div id="valida-nota_venta_Vacia" style="display:none" class="errores">
                                                                                                    Debe ingresar Nota de Venta o Crear nueva
                                                                                            </div> 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Version</label>                                                                                         
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="version" onkeypress="ValidaSoloNumeros()" value='0' readonly placeholder="Version"/>	
                                                                                    </td>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                            <td style="width: 70%">
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td colspan="2">
                                                                <article class="module width_full">            
                                                                    <div class="module_content">
                                                                        <table class="tablesorter" id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Fecha</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="fecha_nota_venta" size="12"  class='limpiar' placeholder="Fecha" value="<?php echo date('d-m-Y')?>" readonly/>
                                                                                            <div id="valida-fecha_nota_venta" style="display:none" class="errores">
                                                                                                    Debe Ingresar Fecha de Nota de Venta
                                                                                            </div>  
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Fecha de Despacho</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="fecha_despacho_nota_venta" size="12"  class='limpiar' placeholder="Fecha Despacho" readonly/>
                                                                                            <div id="valida-fecha_desp_nota_venta" style="display:none" class="errores">
                                                                                                    Debe Ingresar Fecha de Nota de Venta
                                                                                            </div> 
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Orden de Compra</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="orden_compra" size="12"  class='limpiar' placeholder="Orden de Compra"/>	
                                                                                    </td>
                                                                                    
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>R.U.T.</label>
                                                                                    </td>
                                                                                    <!--td>
                                                                                            <label>Rut Cliente</label>
                                                                                    </td-->
                                                                                    <td>
                                                                                        <input type="text" id="rut_cliente" size="12"  class='limpiar' placeholder="Rut Cliente" readonly/>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Cliente</label>
                                                                                    </td>
                                                                                    <td >
                                                                                            <select id="id_cliente_nacional" class='limpiar'>
                                                                                            </select>
                                                                                            <!--Aqui se Selecciona el cliente y tiene que ir a ver cuantas facturas tiene pendiente al finalizar el tema de las factura ver el tema de el cliente-->
                                                                                            <div id="valida-c_nac" style="display:none" class="errores">
                                                                                                    Debe Seleccionar Cliente 
                                                                                            </div> 
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Sucursal</label>
                                                                                    </td>
                                                                                    <td id='suc'>
                                                                                    </td>
                                                                                                                                                                        
                                                                                </tr>
                                                                                <!--tr>
                                                                                    
                                                                                </tr-->
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Condicion de Venta</label>
                                                                                    </td>
                                                                                   <td id='pago'>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Vendedor</label>
                                                                                    </td>
                                                                                    <td id='vend'>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Observación / Indicacion Despacho</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <textarea rows="2" cols="40" id='obs_despacho'class='limpiar' placeholder="Observación/Indicacion"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <article class="module width_full">            
                                                                    <div class="module_content">
                                                                        <table class="tablesorter" id='productos'> 
                                                                            <thead>
                                                                                <tr>
                                                                                        <td style="display:none" id='estado_proforma'>
                                                                                         <font color='#cc3366'>Nota de Venta Rechazada por Finanzas	</font>						 							 		 
                                                                                        </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Lista de Precios</label>
                                                                                    </td>
                                                                                    <td id='lista_precio'>
                                                                                    </td>
                                                                                    <td>
                                                                                        <label>Canal</label>
                                                                                    </td>
                                                                                    <td id='canal'>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Producto</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Cantidad</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Descuento</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>V. Unitario</label>
                                                                                    </td>
                                                                                    <!--td>
                                                                                        &nbsp;
                                                                                    </td-->                                                                                    
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <input type="text" id="busca_pro" placeholder="Ingrese Producto a Filtrar y presione Enter"/><br>
                                                                                        <select id="list_prod_term" class="limpiar">
                                                                                        </select>
                                                                                        <input type="hidden" id="ila_pro">
                                                                                        <div id="valida-producto" style="display:none" class="errores">
                                                                                                Debe Ingresar Producto
                                                                                        </div> 
                                                                                        <div id="valida-stock_cero" style="display:none" class="errores">
                                                                                                Cantidad de stock es 0 
                                                                                        </div> 
                                                                                        <div id="valida-stock_mayor" style="display:none" class="errores">
                                                                                                La Cantidad que ingresa es Mayor al Stock
                                                                                        </div> 
                                                                                        <div id="valida-cantidad_es_0" style="display:none" class="errores">
                                                                                                La Cantidad que Esta Ingresando es 0 !!!!!!!
                                                                                        </div> 
                                                                                           
                                                                                        <div id="stock" style="display:none" class="errores">
                                                                                        </div> 
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text"  id="cajas" style="text-align: right" onkeypress="ValidaSoloNumeros()" class="limpiar" placeholder="Cantidad"/>
                                                                                            <div id="valida-cajas" style="display:none" class="errores">
                                                                                                    Debe Ingresar Numero de Cajas
                                                                                            </div> 
                                                                                            <div id="valida-cajas_autorizad" style="display:none" class="errores">
                                                                                                Nota de Venta Autorizada No se puede ingresar mas Productos
                                                                                        </div>  
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" id="descuento" style="text-align: right" value='0' class="limpiar" placeholder="Descuento" readonly/>(%)
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="precio" style="text-align: right" class="limpiar" readonly placeholder="Precio"/>
                                                                                            <div id="valida-precio" style="display:none" class="errores">
                                                                                                    Precio No Ingresado en Lsita de Precios
                                                                                            </div> 
                                                                                    </td>
                                                                                    <!--td>
                                                                                        <div class="fright" id='prod_nota_modificar'  style="display:none">
                                                                                                <input type="submit" onclick='$(this).elimina_prod_detalle_nota_venta_modif();' value="Agregar Productos &raquo;"/>
                                                                                        </div>
                                                                                        <div class="fright" id='prod_nota_nuevos'>
                                                                                                <input type="submit" onclick='$(this).ingresa_producto_nota_venta();' value="Agregar Productos &raquo;"/>
                                                                                        </div>
                                                                                        <div class="fright" style="display:none" id='prod_nota_antiguos'>
                                                                                                <input type="submit" onclick='$(this).ingresa_producto_nota_venta_antigua();' value="Agregar Productos &raquo;"/>
                                                                                        </div>
                                                                                        <div class="fright" style="display:none" id='prod_nota_venta_modificar'>
                                                                                                <input type="submit" onclick='$(this).ingresa_prod_detalle_nota_venta_modificar();' value="Agregar Productos &raquo;"/>
                                                                                        </div>
                                                                                    </td-->                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter" id='productos'> 
												<thead> 
													<tr>
														<th width="100">
															Codigo
														</th>
														<th>
															Producto
														</th>
														<th style='text-align:right'>
															Cantidad
														</th>
														 <th style='text-align:right'>
															Precio
														</th>
														<th style='text-align:right'>
															%
														</th>
														<th style='text-align:right'>
															Descuento
														</th>
                                                                                                                <th style='text-align:right'>
															Total
														</th>
														<th style='text-align:center'>
															Eliminar
														</th>
														<!--th>
															Editar
														</th-->	
													</tr> 
													<tbody id='productos_finanzas'>
														<div id="valida-productos_pedidos" style="display:none" class="errores">
															Debe Ingresar Productos para crear Nota de Venta
														</div> 
														<div id="valida-productos_repetidos" style="display:none" class="errores">
															Productos ya se Encuentran en la  Nota de Venta
														</div> 
													</tbody>
												</thead>
											 </table>
										</div>
									</article>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 70%">
                                                                &nbsp;
                                                            </td>
                                                            <td>
                                                                <article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter" id='productos'> 
												<thead> 
                                                                                                    <tr>                                                                                                        
                                                                                                        <td >
                                                                                                                <label>Sub Total</label>
                                                                                                                <input type="hidden" id="subtotal_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                        </td>
                                                                                                        <td style="text-align: right" id='id_subtotal'>
                                                                                                                
                                                                                                                
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                         
                                                                                                                <td>
                                                                                                                        <label>Total IABA</label>
                                                                                                                        <input type="hidden" id="ila_nota_venta" style="text-align: right" class='limpiar_2'  value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_ila'>
                                                                                                                        
                                                                                                                </td>
                                                                                                         
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                                <td>
                                                                                                                        <label>Total IVA</label>
                                                                                                                        <input type="hidden" id="iva_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_iva'>
                                                                                                                        
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                    <tr>
                                                                                                                <td>
                                                                                                                        <label>Total Factura</label>
                                                                                                                        <input type="hidden" id="total_nota_venta" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_total'>
                                                                                                                        
                                                                                                                </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                                <td colspan="2">
                                                                                                                        <div class="fright" id='btn_nota_nueva'> 
                                                                                                                                <input type="submit" onClick='$(this).crear_nota_venta();' value="Crear Nota de Venta &raquo;"/> 
                                                                                                                        </div>
                                                                                                                        <div class="fright" id='btn_nota_modificada'  style="display:none"> 
                                                                                                                                <input type="submit" onClick='$(this).ingresa_nota_venta_versiones();' value="Actualizar Nota de Venta &raquo;"/> 
                                                                                                                        </div>
                                                                                                                        <div class="fright" id='btn_imprimir'  style="display:none"> 
                                                                                                                                <input type="submit" onClick='$(this).imprimir_nota_venta();' value="Imprimir &raquo;"/> 
                                                                                                                        </div>
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                </thead>
                                                                                        </table>
                                                                                </div>
                                                                </article>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                         
					 	<table class="tableform">
							
								
							<!--tr>
								
								
								
								
							</tr>
							<tr>
								
								
								
							</tr>
							<tr>
								
								
							</tr>
								<td>
									<label>Cajas</label>
							 											
								</td>
								<td>
									<label>Precio</label>
									
								</td>
								<td>
									<label>Descuento</label>
									
								</td>
								<td>
									<label>Producto</label>
									
								</td>
								<td>
									
								</td>
							</tr-->
			 				<!--tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter" id='productos'> 
												<thead> 
													<tr>
														<th width="100">
															Codigo de Producto
														</th>
														<th>
															Producto
														</th>
														<th>
															Solicitado
														</th>
														 <th>
															Precio
														</th>
														<th>
															Total
														</th>
														<th>
															%
														</th>
														<th>
															Descuento
														</th>													
														<th>
															Eliminar
														</th>
														<th>
															Editar
														</th>	
													</tr> 
													<tbody id='productos_finanzas'>
														<div id="valida-productos_pedidos" style="display:none" class="errores">
															Debe Ingresar Productos para crear Nota de Venta
														</div> 
														<div id="valida-productos_repetidos" style="display:none" class="errores">
															Productos ya se Encuentran en la  Nota de Venta
														</div> 
													</tbody>
												</thead>
											 </table>
										</div>
									</article>
								</td>
							</tr-->
							<!--tr>
								<td>
									&nbsp;
								</td>
								<td colspan="1">
									<label>Sub Total</label>
								</td>
								<td>
									<input type="text" id="subtotal_nota_venta" class='limpiar_2' value="0" readonly/>
								</td>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								 <tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>Total ILA</label>
									</td>
									<td>
										<input type="text" id="ila_nota_venta" class='limpiar_2'  value="0" readonly/>
									</td>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>Total IVA</label>
									</td>
									<td>
										<input type="text" id="iva_nota_venta" class='limpiar_2' value="0" readonly/>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>Total Factura</label>
									</td>
									<td>
										<input type="text" id="total_nota_venta" class='limpiar_2' value="0" readonly/>
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<div class="fright" id='btn_nota_nueva'> 
											<input type="submit" onClick='$(this).ingresa_nota_venta();' value="Crear Nota de Venta &raquo;"/> 
										</div>
										<div class="fright" id='btn_nota_modificada'  style="display:none"> 
											<input type="submit" onClick='$(this).ingresa_nota_venta_versiones();' value="Actualizar Nota de Venta &raquo;"/> 
										</div>
										<div class="fright" id='btn_imprimir'  style="display:none"> 
											<input type="submit" onClick='$(this).imprimir_nota_venta();' value="Imprimir &raquo;"/> 
										</div>
									</td>
								</tr-->
							</table>
						</div>
					</div>		
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>