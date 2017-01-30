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
	<title>Orden de Compra</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_ventas_productos.js"></script>
        <script src="js/funcion_orden_compra.js" type="text/javascript"></script> 
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
        $("#list_proveedor").change(function(){
		var id_proveedor = $('#list_proveedor option:selected').attr('id');
                //alert(id_proveedor);
		var id_tipo_proveedor = $('#list_tipo_proveedor option:selected').attr('id');
		var stream="id_proveedor="+id_proveedor+"&"+"id_tipo_proveedor="+id_tipo_proveedor;
                //var stream="id_proveedor="+id_proveedor;
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "select/trae_contacto_segun_proveedor.php",
			data:stream,
			success: function(data) {
                            //alert(data);
				for(i=0;i<data.length;i++)
				{
					$("#atencion").val(data[i].contacto);
                                        //alert(data[i].contacto);
					$("#rut_proveedor").val(data[i].rut);
                                        $('#condicion_venta').val(data[i].condicion_de_pago);
				}			
			}			
		});
	});
        //por producto
        $("#list_prod_term_oc").change(function(){
		var id_producto = $('#list_prod_term_oc option:selected').attr('id');
                
		var stream="id_producto="+id_producto;
                //var stream="id_proveedor="+id_proveedor;
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "select/trae_producto_oc.php",
			data:stream,
			success: function(data) {
                            //alert(data);
				for(i=0;i<data.length;i++)
				{
					$("#ult_precio").val(data[i].costo);
                                        $("#ult_precio").attr('disabled',true);
                                        //alert(data[i].contacto);
					//$("#rut_proveedor").val(data[i].rut);
                                        $('#list_umed').val(data[i].umed);
                                        $("#list_umed").attr('disabled',true);
				}			
			}			
		});
	});
	$('#num_oc').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#num_oc").val())==="") 
			{
				/*$("#num_nota_venta").focus();
				$('#valida-nota_venta').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nota_venta').fadeOut('slow');},1000); 
				return false;*/
                                $("#num_oc").val ("NUEVA");
                                var oc=$("#num_oc").val();
                                $("#btn_imprimir").hide();
                                $("#btn_oc").show();
			}
			if ($.trim($("#num_nota_venta").val())==="0") 
			{
				$('#num_nota_venta').val('')
				$("#num_nota_venta").focus ();
				$('#valida-nota_venta_0').fadeIn('slow'); 
				setTimeout(function(){$('#valida-nota_venta_mayor').fadeOut('slow');},1000); 
				return false;
			}
                        if(oc=="NUEVA"){
                            $("#num_nota_venta").attr('disabled',true);
                            
                            var id_usuario = "<?php echo $id_Usuario; ?>";
                            //alert(id_usuario);
                            var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
                            $.ajax({
                                type: "POST",
                                url: "select/trae_detalle_temporal_oc.php",
                                data:stream,
                                success: function(data) {							
                                    $('#productos_finanzas').html("");
                                    $('#productos_finanzas').append(data);
                                    
                                    $("#list_prod_term_oc").val ("");	
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
                                        url: "select/trae_subtotal_oc.php",//trae_subtotal_nota_venta
                                        data:stream,
                                        success: function(data) {
                                            var sub_tot =(data);
                                            //var sub_tot =parseInt(data);
                                            $('#subtotal_oc').val(sub_tot);
                                            var net=sub_tot;
                                            $('#neto_oc').val(net);
                                            
                                                                                    var dato=$('#subtotal_oc').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+3;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_subtotal').html(data);
                                                                                            $('#id_neto_oc').html(data);
                                                                                        }			
                                                                                    });
                                            
                                            
                                            var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                            $.ajax({
                                                type: "POST",
                                                url: "select/trae_subtotal_oc.php",//trae_subtotal_nota_venta
                                                data:stream,
                                                success: function(data) {
                                                    
                                                    
                                                    var iva_tot=sub_tot*19/100;
                                                    //alert(iva_tot);
                                                    //var iva_tot=parseInt(sub_tot*19/100);
                                                    //var iva_tot=parseDouble(sub_tot*19/100);
                                                    $('#iva_oc').val(iva_tot);
                                                    
                                                    var dato=$('#iva_oc').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+3;
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                        data:stream,
                                                                                        success: function(data) {
                                                                                            //alert(data);
                                                                                            $('#id_iva_oc').html(data);
                                                                                        }			
                                                                                    });
                                                                                    
                                                    var tot_tot=parseFloat($('#neto_oc').val())+parseFloat($('#iva_oc').val());
                                                    //var tot_tot=net+iva_tot;
                                                    
                                                    $('#total_oc').val(tot_tot);
                                                    var dato=$('#total_oc').val();
                                                                                    var stream="dato="+dato+"&"+"funcion="+3;
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
                                var numero_oc=$('#num_oc').val();
                                
                                var stream="numero_oc="+numero_oc
                                        +"&"+"funcion="+5;
                                $.ajax({
                                        type: "POST",
                                        url: "insert/inserta_orden_compra.php",
                                        data:stream,
                                        success: function(data)	{
                                            //alert(data);
                                                if (data==1)
                                                {
                                                        var action = confirm('Desea Traer Orden de Compra?');
                                                        if(action==true)
                                                        {
                                                               // var numero_nota_venta=$("#num_nota_venta").val ();
                                                                //var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+6;
                                                                var stream="numero_oc="+numero_oc
                                                                        +"&"+"funcion="+6;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/inserta_orden_compra.php",
                                                                        data:stream,
                                                                        cache: false,
                                                                        dataType: 'json',
                                                                        success: function(data)	{	
                                                                                for(i=0;i<data.length;i++)
                                                                                {
                                                                                        if (data[i].valor==1)
                                                                                        {
                                                                                                alert ("Orden de Compra Vacia Ingrese Otra");
                                                                                                $("#btn_imprimir").hide();
                                                                                                $("#btn_nota_nueva").hide();									
                                                                                                $(".limpiar").val ('');
                                                                                                $(".limpiar_2").val (0);				
                                                                                                $("#productos_finanzas").html ('');	
                                                                                                location.href = "crear_nota_venta.php";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                $('#fecha_oc').val(data[i].fecha1);
                                                                                                $('#fecha_despacho_oc').val(data[i].fecha2);
                                                                                                //$('#rut_proveedor').val(data[i].rut);
                                                                                                //alert(data[i].rut);
                                                                                                if(data[i].rut===""){
                                                                                                    $('#rut_proveedor').val('**-**');
                                                                                                }else{
                                                                                                    $('#rut_proveedor').val(data[i].rut);
                                                                                                }
                                                                                                $('#list_proveedor').val(data[i].proveedor);
                                                                                                $('#atencion').val(data[i].atencion);
                                                                                                //var id_cliente= (data[i].id_cliente);
                                                                                                //alert(id_cliente);//
                                                                                                $('#condicion_venta').val(data[i].Condicion);
                                                                                                $('#list_tip_mon').val(data[i].moneda);
                                                                                                $('#list_areas').val(data[i].area);
                                                                                                
                                                                                                
                                                                                                $('#subtotal_oc').val(data[i].subtot_oc);
                                                                                                $('#desc_oc').val(data[i].desc);
                                                                                                $('#desc_por_oc').val(data[i].por_desc);
                                                                                                $('#neto_oc').val(data[i].net_oc);
                                                                                                $('#iva_oc').val(data[i].iva_oc);
                                                                                                $('#ran_exenta').val(data[i].exen);
                                                                                                $('#ran_honorario').val(data[i].hon);
                                                                                                $('#honorario_oc').val(data[i].rte_oc);
                                                                                                $('#total_oc').val(data[i].total_oc);
                                                                                                $('#estado').val(0);
                                                                                                var status=(data[i].estado);
                                                                                                //********/
                                                                                                
                                                                                                $("#estado_0").show();
                                                                                                $("#estado_1").hide();
                                                                                                $("#estado_2").hide();
                                                                                                $("#estado_3").hide();
                                                                                                //alert(status);
                                                                                                if(data[i].exen==1){
                                                                                                    $("#ran_exenta").prop("checked", "checked");
                                                                                                }else{
                                                                                                    $("#ran_exenta").prop("checked", "");
                                                                                                }
                                                                                                if(data[i].hon==1){
                                                                                                    $("#ran_honorario").prop("checked", "checked");
                                                                                                }else{
                                                                                                    $("#ran_honorario").prop("checked", "");
                                                                                                }
                                                                                                
                                                                                                var dato=$('#subtotal_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#desc_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_descuento').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#neto_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_neto_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                               
                                                                                                var dato=$('#iva_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#honorario_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_honorario').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#total_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                //alert(centro_venta);
                                                                                                var stream="numero_oc="+numero_oc
                                                                                                    +"&"+"status="+status
                                                                                                    +"&"+"funcion="+7;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/inserta_orden_compra.php",
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
                                                                                                $("#btn_oc").hide();												
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                                        }
                                                }
                                                else if (data==2)
                                                {
                                                        var action = confirm('Desea Traer Orden de Compra?');
                                                        if(action==true)
                                                        {
                                                               // var numero_nota_venta=$("#num_nota_venta").val ();
                                                                //var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+6;
                                                                var stream="numero_oc="+numero_oc
                                                                        +"&"+"funcion="+6;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/inserta_orden_compra.php",
                                                                        data:stream,
                                                                        cache: false,
                                                                        dataType: 'json',
                                                                        success: function(data)	{	
                                                                                for(i=0;i<data.length;i++)
                                                                                {
                                                                                        if (data[i].valor==1)
                                                                                        {
                                                                                                alert ("Orden de Compra Vacia Ingrese Otra");
                                                                                                $("#btn_imprimir").hide();
                                                                                                $("#btn_nota_nueva").hide();									
                                                                                                $(".limpiar").val ('');
                                                                                                $(".limpiar_2").val (0);				
                                                                                                $("#productos_finanzas").html ('');	
                                                                                                location.href = "crear_nota_venta.php";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                $('#fecha_oc').val(data[i].fecha1);
                                                                                                $('#fecha_despacho_oc').val(data[i].fecha2);
                                                                                                //$('#rut_proveedor').val(data[i].rut);
                                                                                                //alert(data[i].rut);
                                                                                                if(data[i].rut===""){
                                                                                                    $('#rut_proveedor').val('**-**');
                                                                                                }else{
                                                                                                    $('#rut_proveedor').val(data[i].rut);
                                                                                                }
                                                                                                $('#list_proveedor').val(data[i].proveedor);
                                                                                                $('#atencion').val(data[i].atencion);
                                                                                                //var id_cliente= (data[i].id_cliente);
                                                                                                //alert(id_cliente);//
                                                                                                $('#condicion_venta').val(data[i].Condicion);
                                                                                                $('#list_tip_mon').val(data[i].moneda);
                                                                                                $('#list_areas').val(data[i].area);
                                                                                                
                                                                                                
                                                                                                $('#subtotal_oc').val(data[i].subtot_oc);
                                                                                                $('#desc_oc').val(data[i].desc);
                                                                                                $('#desc_por_oc').val(data[i].por_desc);
                                                                                                $('#neto_oc').val(data[i].net_oc);
                                                                                                $('#iva_oc').val(data[i].iva_oc);
                                                                                                $('#ran_exenta').val(data[i].exen);
                                                                                                $('#ran_honorario').val(data[i].hon);
                                                                                                $('#honorario_oc').val(data[i].rte_oc);
                                                                                                $('#total_oc').val(data[i].total_oc);
                                                                                                $('#estado').val(1);
                                                                                                var status=(data[i].estado);
                                                                                                $("#estado_0").hide();
                                                                                                $("#estado_1").show();
                                                                                                $("#estado_2").hide();
                                                                                                $("#estado_3").hide();
                                                                                                //alert(status);
                                                                                                if(data[i].exen==1){
                                                                                                    $("#ran_exenta").prop("checked", "checked");
                                                                                                }else{
                                                                                                    $("#ran_exenta").prop("checked", "");
                                                                                                }
                                                                                                if(data[i].hon==1){
                                                                                                    $("#ran_honorario").prop("checked", "checked");
                                                                                                }else{
                                                                                                    $("#ran_honorario").prop("checked", "");
                                                                                                }
                                                                                                
                                                                                                var dato=$('#subtotal_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#desc_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_descuento').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#neto_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_neto_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                               
                                                                                                var dato=$('#iva_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#honorario_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_honorario').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#total_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                //alert(centro_venta);
                                                                                                var stream="numero_oc="+numero_oc
                                                                                                    +"&"+"status="+status
                                                                                                    +"&"+"funcion="+7;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/inserta_orden_compra.php",
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
                                                                                                $("#btn_oc").hide();												
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                                        }				
                                                }
                                                else if (data==3)
                                                {
                                                        var action = confirm('Desea Traer Orden de Compra?');
                                                        if(action==true)
                                                        {
                                                               // var numero_nota_venta=$("#num_nota_venta").val ();
                                                                //var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+6;
                                                                var stream="numero_oc="+numero_oc
                                                                        +"&"+"funcion="+6;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/inserta_orden_compra.php",
                                                                        data:stream,
                                                                        cache: false,
                                                                        dataType: 'json',
                                                                        success: function(data)	{	
                                                                                for(i=0;i<data.length;i++)
                                                                                {
                                                                                        if (data[i].valor==1)
                                                                                        {
                                                                                                alert ("Orden de Compra Vacia Ingrese Otra");
                                                                                                $("#btn_imprimir").hide();
                                                                                                $("#btn_nota_nueva").hide();									
                                                                                                $(".limpiar").val ('');
                                                                                                $(".limpiar_2").val (0);				
                                                                                                $("#productos_finanzas").html ('');	
                                                                                                location.href = "crear_nota_venta.php";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                $('#fecha_oc').val(data[i].fecha1);
                                                                                                $('#fecha_despacho_oc').val(data[i].fecha2);
                                                                                                //$('#rut_proveedor').val(data[i].rut);
                                                                                                //alert(data[i].rut);
                                                                                                if(data[i].rut===""){
                                                                                                    $('#rut_proveedor').val('**-**');
                                                                                                }else{
                                                                                                    $('#rut_proveedor').val(data[i].rut);
                                                                                                }
                                                                                                $('#list_proveedor').val(data[i].proveedor);
                                                                                                $('#atencion').val(data[i].atencion);
                                                                                                //var id_cliente= (data[i].id_cliente);
                                                                                                //alert(id_cliente);//
                                                                                                $('#condicion_venta').val(data[i].Condicion);
                                                                                                $('#list_tip_mon').val(data[i].moneda);
                                                                                                $('#list_areas').val(data[i].area);
                                                                                                
                                                                                                
                                                                                                $('#subtotal_oc').val(data[i].subtot_oc);
                                                                                                $('#desc_oc').val(data[i].desc);
                                                                                                $('#desc_por_oc').val(data[i].por_desc);
                                                                                                $('#neto_oc').val(data[i].net_oc);
                                                                                                $('#iva_oc').val(data[i].iva_oc);
                                                                                                $('#ran_exenta').val(data[i].exen);
                                                                                                $('#ran_honorario').val(data[i].hon);
                                                                                                $('#honorario_oc').val(data[i].rte_oc);
                                                                                                $('#total_oc').val(data[i].total_oc);
                                                                                                var status=(data[i].estado);
                                                                                                $('#estado').val(2);
                                                                                                $("#estado_0").hide();
                                                                                                $("#estado_1").hide();
                                                                                                $("#estado_2").show();
                                                                                                $("#estado_3").hide();
                                                                                                //alert(status);
                                                                                                if(data[i].exen==1){
                                                                                                    $("#ran_exenta").prop("checked", "checked");
                                                                                                }else{
                                                                                                    $("#ran_exenta").prop("checked", "");
                                                                                                }
                                                                                                if(data[i].hon==1){
                                                                                                    $("#ran_honorario").prop("checked", "checked");
                                                                                                }else{
                                                                                                    $("#ran_honorario").prop("checked", "");
                                                                                                }
                                                                                                
                                                                                                var dato=$('#subtotal_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#desc_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_descuento').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#neto_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_neto_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                               
                                                                                                var dato=$('#iva_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#honorario_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_honorario').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#total_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                //alert(centro_venta);
                                                                                                var stream="numero_oc="+numero_oc
                                                                                                    +"&"+"status="+status
                                                                                                    +"&"+"funcion="+7;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/inserta_orden_compra.php",
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
                                                                                                $("#btn_oc").hide();												
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                                        }	
                                                }
                                                else if (data==4)
                                                {
                                                        var action = confirm('Desea Traer Orden de Compra?');
                                                        if(action==true)
                                                        {
                                                               // var numero_nota_venta=$("#num_nota_venta").val ();
                                                                //var stream="numero_nota_venta="+numero_nota_venta+"&"+"funcion="+6;
                                                                var stream="numero_oc="+numero_oc
                                                                        +"&"+"funcion="+6;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "insert/inserta_orden_compra.php",
                                                                        data:stream,
                                                                        cache: false,
                                                                        dataType: 'json',
                                                                        success: function(data)	{	
                                                                                for(i=0;i<data.length;i++)
                                                                                {
                                                                                        if (data[i].valor==1)
                                                                                        {
                                                                                                alert ("Orden de Compra Vacia Ingrese Otra");
                                                                                                $("#btn_imprimir").hide();
                                                                                                $("#btn_nota_nueva").hide();									
                                                                                                $(".limpiar").val ('');
                                                                                                $(".limpiar_2").val (0);				
                                                                                                $("#productos_finanzas").html ('');	
                                                                                                location.href = "crear_nota_venta.php";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                                $('#fecha_oc').val(data[i].fecha1);
                                                                                                $('#fecha_despacho_oc').val(data[i].fecha2);
                                                                                                //$('#rut_proveedor').val(data[i].rut);
                                                                                                //alert(data[i].rut);
                                                                                                if(data[i].rut===""){
                                                                                                    $('#rut_proveedor').val('**-**');
                                                                                                }else{
                                                                                                    $('#rut_proveedor').val(data[i].rut);
                                                                                                }
                                                                                                $('#list_proveedor').val(data[i].proveedor);
                                                                                                $('#atencion').val(data[i].atencion);
                                                                                                //var id_cliente= (data[i].id_cliente);
                                                                                                //alert(id_cliente);//
                                                                                                $('#condicion_venta').val(data[i].Condicion);
                                                                                                $('#list_tip_mon').val(data[i].moneda);
                                                                                                $('#list_areas').val(data[i].area);
                                                                                                
                                                                                                
                                                                                                $('#subtotal_oc').val(data[i].subtot_oc);
                                                                                                $('#desc_oc').val(data[i].desc);
                                                                                                $('#desc_por_oc').val(data[i].por_desc);
                                                                                                $('#neto_oc').val(data[i].net_oc);
                                                                                                $('#iva_oc').val(data[i].iva_oc);
                                                                                                $('#ran_exenta').val(data[i].exen);
                                                                                                $('#ran_honorario').val(data[i].hon);
                                                                                                $('#honorario_oc').val(data[i].rte_oc);
                                                                                                $('#total_oc').val(data[i].total_oc);
                                                                                                var status=(data[i].estado);
                                                                                                $('#estado').val(3);
                                                                                                $("#estado_0").hide();
                                                                                                $("#estado_1").hide();
                                                                                                $("#estado_2").hide();
                                                                                                $("#estado_3").show();
                                                                                                
                                                                                                //alert(status);
                                                                                                if(data[i].exen==1){
                                                                                                    $("#ran_exenta").prop("checked", "checked");
                                                                                                }else{
                                                                                                    $("#ran_exenta").prop("checked", "");
                                                                                                }
                                                                                                if(data[i].hon==1){
                                                                                                    $("#ran_honorario").prop("checked", "checked");
                                                                                                }else{
                                                                                                    $("#ran_honorario").prop("checked", "");
                                                                                                }
                                                                                                
                                                                                                var dato=$('#subtotal_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_subtotal').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#desc_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_descuento').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#neto_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_neto_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                               
                                                                                                var dato=$('#iva_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_iva_oc').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#honorario_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_honorario').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                var dato=$('#total_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        //alert(data);
                                                                                                        $('#id_total').html(data);
                                                                                                    }			
                                                                                                });
                                                                                                
                                                                                                //alert(centro_venta);
                                                                                                var stream="numero_oc="+numero_oc
                                                                                                    +"&"+"status="+status
                                                                                                    +"&"+"funcion="+7;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/inserta_orden_compra.php",
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
                                                                                                $("#btn_oc").hide();												
                                                                                        }						 
                                                                                }								
                                                                        }			
                                                                });
                                                        }
                                                }
                                        } 
                                });
                            }
		} 
	});
	$("#fecha_despacho_oc").datepicker({
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
        //rango_honorario
        $.fn.rango_honorario=function(){
            //alert("Hola");
            var ran_honorario=$('input:checkbox[name=ran_honorario]:checked').val();
            //alert(ran_exenta);
            
            //$("#fechas_fil").Show();
            
            if(ran_honorario==="1"){
               // $("#ran_exenta").prop('checked', true);
               // $("#ran_exenta").removeAttr('checked');
                //document.getElementById('honor').style.display = 'block';
                //document.getElementById('honor').style.display = 'block';
                var net=$("#neto_oc").val();
                
                        
                        
               var iva_actual=0;
               $("#iva_oc").val(iva_actual);
                        
                        var dato=$('#iva_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_iva_oc').html(data);
                            }			
                        });
                        
                        var rte=net*10/100;
                        //alert(rte);
                        var dato=rte;
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_honorario').html(data);
                            }			
                        });
                        
                        var total_actual=net-rte;
                        //$("#neto_oc").val()
                        $("#total_oc").val(total_actual);
                        
                        var dato=$('#total_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_total').html(data);
                            }			
                        });
                
            }else{
                        
               var net_actual=$("#neto_oc").val();
                var iva_actual=net_actual*19/100;
                        $("#iva_oc").val(iva_actual);
                        
                        var dato=$('#iva_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_iva_oc').html(data);
                            }			
                        });
                        
                        //alert(net_actual);alert(iva_actual);
                        
                        var stream="net_actual="+net_actual
                                +"&"+"iva_actual="+iva_actual
                                +"&"+"funcion="+4;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                //alert(data);
                                    var dato=0;
                                    var stream="dato="+dato+"&"+"funcion="+3;
                                    $.ajax({
                                        type: "POST",
                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                        data:stream,
                                        success: function(data) {
                                                $('#id_honorario').html(data);
                                        }			
                                    });
                                    
                                     $("#total_oc").val(data.trim());
                                     //var dato=$('#total_oc').val();
                                     var dato=data;
                                    var stream="dato="+dato+"&"+"funcion="+3;
                                    $.ajax({
                                        type: "POST",
                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                        data:stream,
                                        success: function(data) {
                                                $('#id_total').html(data);
                                        }			
                                    });
                            }			
                        });
               //document.getElementById('honor').style.display = 'none';
               //document.getElementById('honor').style.display = 'none';
            }
        }
        //rengo exenta
        $.fn.rango_exenta=function(){
            //alert("Hola");
            var ran_exenta=$('input:checkbox[name=ran_exenta]:checked').val();
            //alert(ran_exenta);
            
            //$("#fechas_fil").Show();
            
            if(ran_exenta==="1"){
                var net=$("#neto_oc").val();
                //$("#ran_honorario").prop('checked', false);
                //alert($("#ran_honorario").val());
                //$("#ran_honorario").removeAttr('checked');  
                
                        
               var iva_actual=0;
               $("#iva_oc").val(iva_actual);
                        
                        var dato=$('#iva_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_iva_oc').html(data);
                            }			
                        });
                        
                        
                        var total_actual=net;
                        $("#total_oc").val(total_actual);
                        
                        var dato=$('#total_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_total').html(data);
                            }			
                        });
                //document.getElementById('fechas_fil3').style.display = 'block';
                // document.getElementById('fil4').style.display = 'block';
            }else{
                var net_actual=$("#neto_oc").val();
                var iva_actual=net_actual*19/100;
                        $("#iva_oc").val(iva_actual);
                        
                        var dato=$('#iva_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_iva_oc').html(data);
                            }			
                        });
                        
                        //alert(net_actual);alert(iva_actual);
                        
                        var stream="net_actual="+net_actual
                                +"&"+"iva_actual="+iva_actual
                                +"&"+"funcion="+4;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                //alert(data);
                                     $("#total_oc").val(data.trim());
                                     //var dato=$('#total_oc').val();
                                     var dato=data;
                                    var stream="dato="+dato+"&"+"funcion="+3;
                                    $.ajax({
                                        type: "POST",
                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                        data:stream,
                                        success: function(data) {
                                                $('#id_total').html(data);
                                        }			
                                    });
                            }			
                        });
                        
                       /* var total_actual=parsenDouble(net_actual)+parsenDouble(iva_actual);
                        //alert(total_actual);
                        //var total_actual=parseDouble($("#neto_oc").val())+parseDouble($('#iva_oc').val());
                        $("#total_oc").val(total_actual);*/
                        
                        
               //document.getElementById('fil4').style.display = 'none';
               //document.getElementById('fechas_fil3').style.display = 'none';
            }
        }
        //Desc
        $('#desc_por_oc').keypress(function (e) {
		if(e.which ==13)
		{
                        //$("#precio").focus ();
                        var subt=$("#subtotal_oc").val();
                        var desc_oc=$("#desc_por_oc").val();
                        var desc_tota=subt*desc_oc/100;
                        //alert(desc_tota);
                        $("#desc_oc").val(desc_tota);
                        
                        var dato=$('#desc_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_descuento').html(data);
                            }			
                        });
                        //$('#').html(desc_tota);
                        
                        var net_actual=subt-desc_tota;
                        $("#neto_oc").val(net_actual);
                        
                        var dato=$('#neto_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_neto_oc').html(data);
                            }			
                        });
                        
                        
                        var iva_actual=net_actual*19/100;
                        $("#iva_oc").val(iva_actual);
                        
                        var dato=$('#iva_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_iva_oc').html(data);
                            }			
                        });
                        
                        
                        var total_actual=net_actual+iva_actual;
                        $("#total_oc").val(total_actual);
                        
                        var dato=$('#total_oc').val();
                        var stream="dato="+dato+"&"+"funcion="+3;
                        $.ajax({
                            type: "POST",
                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                            data:stream,
                            success: function(data) {
                                    $('#id_total').html(data);
                            }			
                        });
                        
                        
		}
	});
        //Cajas                                                                                                
        $('#cajas').keypress(function (e) {
		if(e.which ==13)
		{
                        $("#precio").focus ();
                        
		}
	});
        
        $('#precio').keypress(function (e) {
		if(e.which ==13)
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
                        if($.trim($("#precio").val())==="") 
                        {
                                $("#precio").focus();
                                $('#valida-precio').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
                                return false;
                        }
                        if($.trim($("#list_prod_term_oc").val())==="") 
                        {
                                $("#list_prod_term_oc").focus();
                                $('#valida-producto').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
                                return false;
                        }
                        if($.trim($("#list_prod_term_oc").val())==="0") 
                        {
                                $("#list_prod_term_oc").focus();
                                $('#valida-producto').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
                                return false;
                        }
                        var precio=$("#precio").val();
                        var descuento=$("#descuento").val();
                        var numero_oc=$("#num_oc").val();		
                        var ila_nota_venta=$.trim($("#ila_pro").val());
                        var cajas=$.trim($("#cajas").val());
                        var id_producto=$('#list_prod_term_oc option:selected').attr('id');
                        //var cliente=$('#id_cliente_nacional option:selected').attr('id');
                        //aqui
                        /*if(numero_oc=="") 
                        {
                                $("#num_oc").focus();
                                $('#valida-num_oc_Vacia').fadeIn('slow'); 
                                setTimeout(function(){$('#valida-num_oc_Vacia').fadeOut('slow');},1000); 
                                return false;
                        }*/
                        
                        //Nueva
                        if(numero_oc=="NUEVA"){
                            var stream="id_producto="+id_producto+"&"+"numero_oc="+numero_oc+"&"+"funcion="+2;
                            $.ajax({
                                    type: "POST",
                                    url: "comprobaciones/comprobar_producto_oc.php",
                                    data:stream,
                                    success: function(data) {
                                            if (data.indexOf("Error")==-1)
                                            {
                                                    var id_Usuario=$("#id_Usuario").val();	
                                                    var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"id_Usuario="+id_Usuario
                                                    +"&"+"ila_nota_venta="+ila_nota_venta
                                                    +"&"+"descuento="+descuento;
                                                     $.ajax({
                                                            type: "POST",
                                                            url: "insert/ingresa_producto_oc.php",
                                                            data:stream,
                                                            success: function(data) {	
                                                                    var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "select/trae_detalle_temporal_oc.php",
                                                                        data:stream,
                                                                        success: function(data) {							
                                                                            $('#productos_finanzas').html("");
                                                                            $('#productos_finanzas').append(data);
                                                                            
                                                                        var stream="id_usuario="+id_usuario+"&"+"funcion="+3;
                                                                                $.ajax({
                                                                                    type: "POST",
                                                                                    url: "select/trae_subtotal_oc.php",
                                                                                    data:stream,
                                                                                    success: function(data) {
                                                                                        
                                                                                        var sub_tot =(data);
                                                                                        
                                                                                        $('#subtotal_oc').val(sub_tot);
                                                                                        var net=sub_tot;
                                                                                        $('#neto_oc').val(net);
                                                                                        
                                                                                        var dato=$('#subtotal_oc').val();
                                                                                        var stream="dato="+dato+"&"+"funcion="+3;
                                                                                        $.ajax({
                                                                                            type: "POST",
                                                                                            url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                            data:stream,
                                                                                            success: function(data) {
                                                                                                $('#id_subtotal').html(data);
                                                                                                $('#id_neto_oc').html(data);
                                                                                            }			
                                                                                        });


                                                                                        var stream="id_usuario="+id_usuario+"&"+"funcion="+4;
                                                                                        $.ajax({
                                                                                            type: "POST",
                                                                                            url: "select/trae_subtotal_oc.php",
                                                                                            data:stream,
                                                                                            success: function(data) {
                                                                                                var iva_tot=sub_tot*19/100;
                                                                                                $('#iva_oc').val(iva_tot);

                                                                                                var dato=$('#iva_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
                                                                                                        $('#id_iva_oc').html(data);
                                                                                                    }			
                                                                                                });

                                                                                                
                                                                                                var tot_tot=parseFloat($('#neto_oc').val())+parseFloat($('#iva_oc').val());
                                                                                                
                                                                                                $('#total_oc').val(tot_tot);
                                                                                                var dato=$('#total_oc').val();
                                                                                                var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                    data:stream,
                                                                                                    success: function(data) {
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
                                                       $("#list_prod_term").val ("");	
                                                    $("#precio").val("");
                                                    $("#cajas").val("");
                                                                                            
                                                   
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
                        else{
                            
                            //alert($("#estado").val());
                            var status=$("#estado").val();
                            if(status==0){
                                //Ingresa + productos, pero si esta pendiente!
                                    var stream="id_producto="+id_producto+"&"+"numero_oc="+numero_oc+"&"+"funcion="+2;
                                    $.ajax({
                                            type: "POST",
                                            url: "comprobaciones/comprobar_producto_oc.php",
                                            data:stream,
                                            success: function(data) {
                                                //alert(data);
                                                    if (data.indexOf("Error")==-1)
                                                    {
                                                            var id_Usuario=$("#id_Usuario").val();	
                                                            var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto+"&"+"numero_oc="+numero_oc
                                                            +"&"+"ila_nota_venta="+ila_nota_venta
                                                            +"&"+"descuento="+descuento;
                                                             $.ajax({
                                                                    type: "POST",
                                                                    url: "insert/ingresa_producto_oc2.php",
                                                                    data:stream,
                                                                    success: function(data) {	
                                                                            var stream="numero_oc="+numero_oc
                                                                                                    +"&"+"status="+status
                                                                                                    +"&"+"funcion="+7;
                                                                                                $.ajax({
                                                                                                        type: "POST",
                                                                                                        url: "insert/inserta_orden_compra.php",
                                                                                                        data:stream,
                                                                                                        success: function(data)	{	
                                                                                                                $('#productos_finanzas').html("");	
                                                                                                                $('#productos_finanzas').append(data);	
                                                                                                                
                                                                                                                    var stream="numero_oc="+numero_oc+"&"+"funcion="+31;
                                                                                                                    $.ajax({
                                                                                                                        type: "POST",
                                                                                                                        url: "select/trae_subtotal_oc.php",
                                                                                                                        data:stream,
                                                                                                                        success: function(data) {

                                                                                                                            var sub_tot =(data);

                                                                                                                            $('#subtotal_oc').val(sub_tot);
                                                                                                                            var net=sub_tot;
                                                                                                                            $('#neto_oc').val(net);

                                                                                                                            var dato=$('#subtotal_oc').val();
                                                                                                                            var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                                            $.ajax({
                                                                                                                                type: "POST",
                                                                                                                                url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                                data:stream,
                                                                                                                                success: function(data) {
                                                                                                                                    $('#id_subtotal').html(data);
                                                                                                                                    $('#id_neto_oc').html(data);
                                                                                                                                }			
                                                                                                                            });


                                                                                                                            var iva_tot=sub_tot*19/100;
                                                                                                                                    $('#iva_oc').val(iva_tot);

                                                                                                                                    var dato=$('#iva_oc').val();
                                                                                                                                    var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                                                    $.ajax({
                                                                                                                                        type: "POST",
                                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                                        data:stream,
                                                                                                                                        success: function(data) {
                                                                                                                                            $('#id_iva_oc').html(data);
                                                                                                                                        }			
                                                                                                                                    });


                                                                                                                                    var tot_tot=parseFloat($('#neto_oc').val())+parseFloat($('#iva_oc').val());

                                                                                                                                    $('#total_oc').val(tot_tot);
                                                                                                                                    var dato=$('#total_oc').val();
                                                                                                                                    var stream="dato="+dato+"&"+"funcion="+3;
                                                                                                                                    $.ajax({
                                                                                                                                        type: "POST",
                                                                                                                                        url: "select/convierte_formato_numero1.php",//trae_subtotal_nota_venta
                                                                                                                                        data:stream,
                                                                                                                                        success: function(data) {
                                                                                                                                            $('#id_total').html(data);
                                                                                                                                        }			
                                                                                                                                    });
                                                                                                                        }			
                                                                                                                    });
                                                                                                        }			
                                                                                                });

                                                                    }
                                                               });
                                                               $("#list_prod_term").val ("");	
                                                            $("#precio").val("");
                                                            $("#cajas").val("");


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
				var stream="busca_pro="+busca_pro+"&"+"funcion="+5;
				$.ajax({
					type: "POST",
					url: "combos/trae_productos.php",
					data:stream,
					success: function(data)	{	
						//alert(data);
						$('#list_prod_term_oc').html("");	
						$('#list_prod_term_oc').append(data);
					}			
				});
			}else{
				var stream="busca_pro="+busca_pro+"&"+"funcion="+6;
				$.ajax({
					type: "POST",
					url: "combos/trae_productos.php",
					data:stream,
					success: function(data)	{	
						//alert(data);
						$('#list_prod_term_oc').html("");	
						$('#list_prod_term_oc').append(data);
					}			
				});
			}
		}
	});
        
	$( "#fecha_despacho_oc" ).datepicker( $.datepicker.regional[ "es" ]);
	$("#fecha_oc").datepicker({
		dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showAnimate: 'drop',
	});
	 $( "#fecha_despacho_oc" ).datepicker( $.datepicker.regional[ "es" ]);
});


function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which
  // backspace
  if (key == 8) return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    regexp = /.[0-9]{2}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // other key
  return false
 
}

function ValidaSoloNumeros() {
 if ( (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
       
}
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body" id="cabeza_oc">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Orden de Compra</p>
					</div>
					<div class="content">  
						
                                                
                                                    <table>
                                                        <tr>
                                                            <td colspan="2" >
                                                                
                                                                <div>  
                                                                        <div class="fright">
                                                                                <a href="principal_finanzas.php"><input type="button" value="Volver&raquo;"/></a>
                                                                                <a href="crear_orden_compra2.php"><input type="button" value="Nueva&raquo;"/></a>
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
                                                                                <!--tr>
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
                                                                                </tr-->
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Numero</label>
                                                                                        <input type="hidden" id="estado">
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="num_oc"  onkeypress="ValidaSoloNumeros()" placeholder="Numero"/>	
                                                                                            <!--input type="text" id="num_nota_venta"  onkeypress="ValidaSoloNumeros()" placeholder="Numero"/-->	
                                                                                            <input type="hidden" id="id_Usuario"  value="<?php echo $id_Usuario?>"/>	
                                                                                            <div id="valida-num_oc" style="display:none" class="errores">
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
                                                                                
                                                                                <!--tr>
                                                                                    <td>
                                                                                            <label>Version</label>                                                                                         
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="version" onkeypress="ValidaSoloNumeros()" value='0' readonly placeholder="Version"/>	
                                                                                    </td>
                                                                                </tr-->
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            </td>
                                                            <td style="width: 70%;text-align: center">
                                                                <div class="fright" id='estado_0' style="display:none"> 
                                                                    <img src="img/estado_0.png" width="40%"></img>                                                                                         
                                                                 </div>
                                                                <div class="fright" id='estado_1' style="display:none"> 
                                                                    <img src="img/estado_1.png" width="40%"></img>                                                                                         
                                                                 </div>
                                                                <div class="fright" id='estado_2' style="display:none"> 
                                                                    <img src="img/estado_2.png" width="40%"></img>                                                                                         
                                                                 </div>
                                                                <div class="fright" id='estado_3' style="display:none"> 
                                                                    <img src="img/estado_3.png" width="40%"></img>                                                                                         
                                                                 </div>
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
                                                                                            <input type="text" id="fecha_oc" size="12"  class='limpiar' placeholder="Fecha" value="<?php echo date('d-m-Y')?>" readonly/>
                                                                                            <div id="valida-fecha_oc" style="display:none" class="errores">
                                                                                                    Debe Ingresar Fecha de Nota de Venta
                                                                                            </div>  
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Fecha de Requerimento Planta</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="fecha_despacho_oc" size="12"  class='limpiar' placeholder="Fecha Despacho" readonly/>
                                                                                            <div id="valida-fecha_despacho_oc" style="display:none" class="errores">
                                                                                                    Debe Ingresar Fecha de Nota de Venta
                                                                                            </div> 
                                                                                    </td>
                                                                                    <!--td>
                                                                                            <label>Orden de Compra</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="orden_compra" size="12"  class='limpiar' placeholder="Orden de Compra"/>	
                                                                                    </td-->
                                                                                    
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>R.U.T.</label>
                                                                                    </td>
                                                                                    <!--td>
                                                                                            <label>Rut Cliente</label>
                                                                                    </td-->
                                                                                    <td>
                                                                                        <input type="text" id="rut_proveedor" size="12"  class='limpiar' placeholder="Rut Cliente" readonly/>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Proveedor</label>
                                                                                    </td>
                                                                                    <td >
                                                                                            <select id="list_proveedor" >
                                                                                            </select>
                                                                                            <div id="valida-proveedor" style="display:none" class="errores">
                                                                                                    Debe Seleccionar Proveedor
                                                                                            </div> 
                                                                                            <div id="valida-tipo_proveedor" style="display:none" class="errores">
                                                                                                    Debe Ingresar Tipo de Proveedor
                                                                                            </div>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Atención</label>
                                                                                    </td>
                                                                                    <td >
                                                                                        <input type="text" id="atencion" size="12"  class='limpiar' placeholder="Contacto"/>	
                                                                                    </td>
                                                                                                                                                                        
                                                                                </tr>
                                                                                <!--tr>
                                                                                    
                                                                                </tr-->
                                                                                <tr>
                                                                                    <td>
                                                                                            <label>Condicion de Venta</label>
                                                                                    </td>
                                                                                   <td >
                                                                                       <select id="condicion_venta"> 
                                                                                        </select> 
                                                                                        <div id="valida-condicion_venta" style="display:none" class="errores">
                                                                                                Debe Seleccionar Cond. de Venta 
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Moneda</label>
                                                                                    </td>
                                                                                    <td >
                                                                                        <select id="list_tip_mon">
                                                                                        </select>
                                                                                        <div id="valida-moneda" style="display:none" class="errores">
                                                                                                Debe Ingresar Tipo de moneda
                                                                                        </div> 
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Areas</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <select id="list_areas">
                                                                                            </select>
                                                                                            <div id="valida-area" style="display:none" class="errores">
                                                                                                    Debe Ingresar Area
                                                                                            </div> 
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
                                                                                <!--tr>
                                                                                        <td style="display:none" id='estado_proforma'>
                                                                                         <font color='#cc3366'>Nota de Venta Rechazada por Finanzas	</font>						 							 		 
                                                                                        </td>
                                                                                </tr-->
                                                                                <!--tr>
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
                                                                                </tr-->
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Producto</label><input type="text" id="busca_pro" placeholder="Ingrese Producto a Filtrar y presione Enter"/><br>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>U. Medida</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Cantidad</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Ult. Precio</label>
                                                                                    </td>
                                                                                    <td>
                                                                                            <label>Precio</label>
                                                                                    </td>
                                                                                    <!--td>
                                                                                        &nbsp;
                                                                                    </td-->                                                                                    
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        
                                                                                        <select id="list_prod_term_oc" class="limpiar">
                                                                                        </select>
                                                                                        <input type="hidden" id="ila_pro">
                                                                                        <div id="valida-producto" style="display:none" class="errores">
                                                                                                Debe Seleecionar Producto
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
                                                                                            <select id="list_umed" > 
                                                                                            </select>
                                                                                            <div id="valida-umed" style="display:none" class="errores">
                                                                                                    Debe Ingresar Unidad de Medida
                                                                                            </div>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text"  id="cajas" style="text-align: right" onkeypress="return NumCheck(event, this)" class="limpiar" placeholder="Cantidad"/>
                                                                                            <div id="valida-cajas" style="display:none" class="errores">
                                                                                                    Debe Ingresar Numero de Cajas
                                                                                            </div> 
                                                                                            <div id="valida-cajas_autorizad" style="display:none" class="errores">
                                                                                                Nota de Venta Autorizada No se puede ingresar mas Productos
                                                                                        </div>  
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" id="ult_precio" style="text-align: right" value='0' class="limpiar" readonly placeholder="Descuento" readonly/>
                                                                                    </td>
                                                                                    <td>
                                                                                            <input type="text" id="precio" style="text-align: right"  onkeypress="return NumCheck(event, this)"  placeholder="Precio"/>
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
															Descripción
														</th>
														<th style='text-align:right'>
															U.Medida
														</th>
														 <th style='text-align:right'>
															Cantidad
														</th>
														<th style='text-align:right'>
															Precio
														</th>
														<th style='text-align:right'>
															Total
														</th>
                                                                                                                <!--th style='text-align:right'>
															Recibido
														</th-->
														<th style='text-align:center'>
															Eliminar
														</th>
														<!--th>
															Editar
														</th-->	
													</tr> 
													<tbody id='productos_finanzas'>
														<div id="valida-productos_pedidos" style="display:none" class="errores">
															Debe Ingresar Productos para crear Orden de Compra
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
                                                                                                                <input type="hidden" id="subtotal_oc" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                        </td>
                                                                                                        <td style="text-align: right" id='id_subtotal'>
                                                                                                                
                                                                                                                
                                                                                                        </td>
                                                                                                        <td>                                                                                                                
                                                                                                                
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>                                                                                                        
                                                                                                        <td >
                                                                                                                <label>Descuento</label>
                                                                                                                <input type="hidden" id="desc_oc" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                        </td>
                                                                                                        <td style="text-align: right" id='id_descuento'>
                                                                                                                
                                                                                                        </td>
                                                                                                        <td  width="25%">                                                                                                                
                                                                                                            <input type="text" id="desc_por_oc" style="text-align: right" maxlength="4" size="4" class='limpiar_2' value="0" />%
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                         
                                                                                                                <td>
                                                                                                                        <label>Total Neto</label>
                                                                                                                        <input type="hidden" id="neto_oc" style="text-align: right" class='limpiar_2'  value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_neto_oc'>
                                                                                                                        
                                                                                                                </td>
                                                                                                         <td>                                                                                                                
                                                                                                                
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                                <td>
                                                                                                                        <label>Total IVA</label>
                                                                                                                        <input type="hidden" id="iva_oc" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_iva_oc'>
                                                                                                                        
                                                                                                                </td>
                                                                                                                <td>                                                                                                                
                                                                                                                    <!--input type="checkbox" name="ranfec" value="1" onClick='$(this).rango_fecha();'checked-->
                                                                                                                    <input type="checkbox" name="ran_exenta" id="ran_exenta" value="1" onClick='$(this).rango_exenta();'> Excenta
                                                                                                                        <br>
                                                                                                                        <input type="checkbox" id="ran_honorario" name="ran_honorario" value="1" onClick='$(this).rango_honorario();'> Honorarios
                                                                                                                </td>
                                                                                                    </tr>
                                                                                                    <tr >                                                                                                        
                                                                                                             <td >
                                                                                                                     <label>RTE (-)</label>
                                                                                                                     <input type="hidden" id="honorario_oc" style="text-align: right" class='limpiar_2' value="0" />
                                                                                                             </td>
                                                                                                             <td style="text-align: right" id='id_honorario'>

                                                                                                             </td>
                                                                                                             <td  width="25%" >                                                                                                                
                                                                                                                 10 % 
                                                                                                             </td>
                                                                                                    </tr>
                                                                                                    
                                                                                                    <tr>
                                                                                                                <td>
                                                                                                                        <label>Total Pago</label>
                                                                                                                        <input type="hidden" id="total_oc" style="text-align: right" class='limpiar_2' value="0" readonly/>
                                                                                                                </td>
                                                                                                                <td style="text-align: right" id='id_total'>
                                                                                                                        
                                                                                                                </td>
                                                                                                                <td>                                                                                                                
                                                                                                                
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                                <td colspan="3">
                                                                                                                        <div class="fright" id='btn_oc'> 
                                                                                                                                <!--input type="submit" onClick='$(this).crear_nota_venta();' value="Crear Nota de Venta &raquo;"/--> 
                                                                                                                                <input type="submit" onClick='$(this).ingresa_orden_compra2();' value="Crear Orden &raquo;"/> 
                                                                                                                        </div>
                                                                                                                        <!--div class="fright" id='btn_nota_modificada'  style="display:none"> 
                                                                                                                                <input type="submit" onClick='$(this).ingresa_nota_venta_versiones();' value="Actualizar Nota de Venta &raquo;"/> 
                                                                                                                        </div-->
                                                                                                                        <div class="fright" id='btn_imprimir'  style="display:none"> 
                                                                                                                                <input type="submit" onClick='$(this).imprimir_oc();' value="Imprimir &raquo;"/> 
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