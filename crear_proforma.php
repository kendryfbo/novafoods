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
	<title>Proforma</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_combos.js"></script>
	<script src="js/funcion_combos_pedidos.js" type="text/javascript"></script>
	<script src="js/funcion_ventas_productos.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <!--script src="js/jquery.min_scroll.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script-->


</head>

<script>
///actualizado por isaac Lagos
$(document).ready(function() {
	$("#fecha_proforma").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            showAnimate: 'drop',
	});
	var id_usuario = "<?php echo $id_Usuario; ?>";
	var stream="funcion="+3;
	$.ajax({
		type: "POST",
		url: "insert/insertar_proforma.php",
		data:stream,
		success: function(data)	{								
			//$("#num_proforma").val (data);
                        $('#num_proforma').html("");	
		}			
	});
        
    /*    $('#num_proforma').keypress(function (e) {
		if(e.which ==13)
		{
                    //alert("aqui");
                    if($.trim($("#num_proforma").val())==="") 
                    {
                            $("#num_proforma").val ("NUEVA");
                    }
                    
                }
	});*/
        
        $('#precio').keypress(function (e) {
		if(e.which ==13)
		{
                    //alert("aqui");
                    if($.trim($("#num_proforma").val())==="") 
			{
				$("#num_proforma").focus();
				$('#valida-num_proforma').fadeIn('slow'); 
				setTimeout(function(){$('#valida-num_proforma').fadeOut('slow');},1000); 
				return false;
                                /*$("#num_proforma").val ("NUEVA");
                                var prof=$("#num_proforma").val();*/
			}
                    if($.trim($("#cajas").val())==="") 
                    {
                            $("#cajas").focus();
                            $('#valida-cajas').fadeIn('slow'); 
                            setTimeout(function(){$('#valida-cajas').fadeOut('slow');},1000); 
                            return false;
                    }
                    if($.trim($("#list_prod_term_proforma").val())==="") 
                    {
                            $("#list_prod_term_proforma").focus();
                            $('#valida-producto').fadeIn('slow'); 
                            setTimeout(function(){$('#valida-producto').fadeOut('slow');},1000); 
                            return false;
                    }
                    if($.trim($("#precio").val())==="") 
                    {
                            $("#precio").focus();
                            $('#valida-precio').fadeIn('slow'); 
                            setTimeout(function(){$('#valida-precio').fadeOut('slow');},1000); 
                            return false;
                    }
                    var prof=$("#num_proforma").val();
                    //alert(prof);
                    if(prof=="NUEVA"){
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
                                    //alert(data);
                                        if (data.indexOf("Error")==-1)
                                        {
                                                var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto
                                                        +"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+1+"&"+"id_usuario="+id_usuario;
                                                $.ajax({
                                                    //trae_detalle_temporal_proforma
                                                        type: "POST",
                                                        url: "insert/ingresa_producto_proforma.php",
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
                                                                var numero_proforma=$('#num_proforma').val();	*/						
                                                                var stream="id_usuario="+id_usuario+"&"+"funcion="+3;
                                                                $.ajax({
                                                                        type: "POST",
                                                                        url: "select/trae_subtotal_proforma.php",
                                                                        data:stream,
                                                                        success: function(data) {
                                                                                $('#subtotal').val(data);
                                                                                var subtotals=$('#subtotal').val();
                                                                                var sub_tot =parseFloat(subtotals);
                                                                                sub_tot=sub_tot.toFixed(2);
                                                                                $('#subtotal').val(sub_tot);
                                                                                $('#fob').val(sub_tot)
                                                                                //$('#fob').val(data);
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
                    }else{
                        //alert("aqui");
                        var est=$('#estado').val();
                        if(est==0){
                                var precio=$("#precio").val();
                                var numero_proforma=$("#num_proforma").val();		
                                var cajas=$("#cajas").val();
                                var id_usuario=$("#id_usuario").val();		
                                var id_producto=$('#list_prod_term_proforma option:selected').attr('id');
                                
                                var stream="id_producto="+id_producto+"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+2;
                                $.ajax({
                                        type: "POST",
                                        url: "comprobaciones/comprobar_producto_proforma.php",
                                        data:stream,
                                        success: function(data) {
                                            //alert(data);
                                                if (data.indexOf("Error")==-1)
                                                {
                                                        var stream="precio="+precio+"&"+"cajas="+cajas+"&"+"id_producto="+id_producto
                                                                +"&"+"numero_proforma="+numero_proforma+"&"+"funcion="+3+"&"+"id_usuario="+id_usuario;
                                                        $.ajax({
                                                            //trae_detalle_temporal_proforma
                                                                type: "POST",
                                                                url: "insert/ingresa_producto_proforma.php",
                                                                data:stream,
                                                                success: function(data) {
                                                                        $('#productos_finanzas').html("");	
                                                                        $('#productos_finanzas').append(data);		
                                                                        $("#list_prod_term_proforma").val ("");	
                                                                        $("#precio").val("");
                                                                        $("#cajas").val("");
                                                                        $("#descuento").val (0);
                                                                        //var num_prof=$('#num_prof').val();		
                                                                        //$('#num_proforma').val(num_prof);		
                                                                        //var numero_proforma=$('#num_proforma').val();						
                                                                        var stream="numero_proforma="+numero_proforma+"&"+"funcion="+2;
                                                                        $.ajax({
                                                                                type: "POST",
                                                                                url: "select/trae_subtotal_proforma.php",
                                                                                data:stream,
                                                                                success: function(data) {
                                                                                        $('#subtotal').val(data);
                                                                                        var subtotals=$('#subtotal').val();
                                                                                        var sub_tot =parseFloat(subtotals);
                                                                                        sub_tot=sub_tot.toFixed(2);
                                                                                        $('#subtotal').val(sub_tot);
                                                                                        $('#fob').val(sub_tot)
                                                                                        //$('#fob').val(data);
                                                                                        var freight=$("#freight").val();
                                                                                        var insurance=$("#insurance").val();
                                                                                        var descuento=$("#descuento").val();
                                                                                        var subtotal=$('#subtotal').val(); 
                                                                                        var total_descuento=(subtotal*descuento)/100;
                                                                                        var total=parseFloat(freight)+parseFloat(insurance);
                                                                                        var total_neto=(subtotal-total_descuento);
                                                                                        var total2=parseFloat(total)+parseFloat(total_neto);
                                                                                        $('#total').val(total2);
                                                                                        /*var total2 =parseFloat(total2);
                                                                                        total2=total2.toFixed(2);
                                                                                        $('#total').val(total2);*/
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
                        }else{
                            alert("No se puede ingresar Productos");
                        }
                    }
                }
	});
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
						$('#list_prod_term_proforma').html("");	
						$('#list_prod_term_proforma').append(data);
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
						$('#list_prod_term_proforma').html("");	
						$('#list_prod_term_proforma').append(data);
					}			
				});
			}
		}
	});
	
	$('#num_proforma').keypress(function (e) {
		if(e.which ==13)
		{
			if($.trim($("#num_proforma").val())==="") 
			{
				/*$("#num_proforma").focus();
				$('#valida-num_proforma').fadeIn('slow'); 
				setTimeout(function(){$('#valida-num_proforma').fadeOut('slow');},1000); 
				return false;*/
                                $("#num_proforma").val ("NUEVA");
                                var prof=$("#num_proforma").val();
			}
			if ($.trim($("#num_proforma").val())==="0") 
			{
				$('#num_proforma').val('')
				$("#num_proforma").focus ();
				$('#valida-num_proforma_cero').fadeIn('slow'); 
				setTimeout(function(){$('#valida-num_proforma_cero').fadeOut('slow');},1000); 
				return false;
			}
                        if(prof=="NUEVA"){
                            $("#num_proforma").attr('disabled',true);
                            
                            var id_usuario=$("#id_usuario").val();
                            var stream="id_usuario="+id_usuario+"&"+"funcion="+1;
                            $.ajax({
                                type: "POST",
                                url: "select/trae_detalle_temporal_proforma.php",
                                data:stream,
                                success: function(data) {							
                                    $('#productos_finanzas').append(data);		
                                    $("#list_prod_term_proforma").val ("");	
                                    $("#precio").val("");
                                    $("#cajas").val("");
                                    $("#descuento").val (0);
                                    
                                    /*var num_prof=$('#num_prof').val();		
                                    $('#num_proforma').val(num_prof);		
                                    var numero_proforma=$('#num_proforma').val();*/							
                                    var stream="id_usuario="+id_usuario+"&"+"funcion="+3;
                                    $.ajax({
                                        type: "POST",
                                        url: "select/trae_subtotal_proforma.php",
                                        data:stream,
                                        success: function(data) {
                                            //DecimalFormat decim = new DecimalFormat("#.###");
                                            $('#subtotal').val(data);
                                            var subtotals=$('#subtotal').val();
                                            
                                            var sub_tot =parseFloat(subtotals);
                                            sub_tot=sub_tot.toFixed(2);
                                            $('#subtotal').val(sub_tot);
                                            $('#fob').val(sub_tot);
                                            
                                            var freight=$("#freight").val();
                                            var insurance=$("#insurance").val();
                                            var descuento=$("#descuento").val();
                                            var subtotal=$('#subtotal').val(); 
                                            var total_descuento=(subtotal*descuento)/100;
                                            var total=parseFloat(freight)+parseFloat(insurance);
                                            var total_neto=(subtotal-total_descuento);
                                            var total2=parseFloat(total)+parseFloat(total_neto);
                                            $('#total').val(total2);
                                            total2 =parseFloat(total2);
                                            total2=total2.toFixed(2);
                                            $('#total').val(total2);
                                        }			
                                    });
                                }			
                            });
                        }else{
                            var numero_proforma=$("#num_proforma").val();
                            var stream="numero_proforma="+numero_proforma+"&"+"funcion="+4;
                            $.ajax({
                                    type: "POST",
                                    url: "insert/insertar_proforma.php",
                                    data:stream,
                                    success: function(data)	{	
                                            if (data==2)
                                            {
                                                    $('#num_proforma').val('')
                                                    $("#num_proforma").focus ();
                                                    $('#valida-proforma_alto').fadeIn('slow'); 
                                                    setTimeout(function(){$('#valida-proforma_alto').fadeOut('slow');},1000); 
                                                    return false;						
                                            }
                                            else if (data==3)
                                            {
                                                    var action = confirm('Desea Traer Proforma?');
                                                    if(action==true)
                                                    {
                                                            $('#imprimir').show();
                                                            //$("#num_proforma").attr('disabled',true);
                                                            $("#ingresa_producto_proforma").hide();							 
                                                            $("#cambio_proforma_version").show();	
                                                            var numero_proforma=$("#num_proforma").val();
                                                            var stream="numero_proforma="+numero_proforma+"&"+"funcion="+5;
                                                            $.ajax({
                                                                    type: "POST",
                                                                    url: "insert/insertar_proforma.php",
                                                                    data:stream,
                                                                    cache: false,
                                                                    dataType: 'json',
                                                                    success: function(data)	{	
                                                                            for(i=0;i<data.length;i++)
                                                                            {
                                                                                    if (data[i].valor==1)
                                                                                    {
                                                                                            alert ("Proforma Vacia Ingrese Otra");
                                                                                            location.href = "crear_proforma.php";
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                            var stream="numero_proforma="+numero_proforma+"&"+"funcion="+19;
                                                                                            $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "insert/insertar_proforma.php",
                                                                                                    data:stream,
                                                                                                    success: function(data)	{	
                                                                                                        //alert(data);
                                                                                                            if (data==1)
                                                                                                            {
                                                                                                                    var numero_proforma=$("#num_proforma").val();
                                                                                                                    var stream="numero_proforma="+numero_proforma+"&"+"funcion="+5;
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
                                                                                                                                            $('#centro_venta').val(data[i].centro_venta);
                                                                                                                                            $("#centro_venta").attr('disabled', true);
                                                                                                                                            $('#version').val(data[i].version);
                                                                                                                                            $('#medio_transporte').val(data[i].medio_de_transporte);
                                                                                                                                            $('#p_embarque').val(data[i].puerto_embarque);
                                                                                                                                            $('#p_destino').val(data[i].puerto_destino);
                                                                                                                                            $('#c_pago').val(data[i].forma_pago);
                                                                                                                                            $('#descripcion').val(data[i].descripcion_mercaderia);
                                                                                                                                            $('#medio_transporte').val(data[i].medio_de_transporte);
                                                                                                                                            $("#medio_transporte").attr('disabled', true);
                                                                                                                                            $('#id_direccion_cliente_internacional').append(data[i].direccion);
                                                                                                                                            $('#id_direccion_pais').append(data[i].pais);
                                                                                                                                            $('#list_tip_mon').val(data[i].tipo_moneda);
                                                                                                                                            $("#list_tip_mon").attr('disabled', true);
                                                                                                                                            $('#subtotal').val(data[i].sub_total);
                                                                                                                                            var subtotals=$('#subtotal').val();
                                                                                                                                            var sub_tot =parseFloat(subtotals);
                                                                                                                                            sub_tot=sub_tot.toFixed(2);
                                                                                                                                            $('#subtotal').val(sub_tot);
                                                                                                                                            //var isaacaqui;
                                                                                                                                            $('#fob').val(data[i].tot_fob);
                                                                                                                                            var subfob=$('#fob').val();
                                                                                                                                            var sub_fob =parseFloat(subfob);
                                                                                                                                            sub_fob=sub_fob.toFixed(2);
                                                                                                                                            $('#fob').val(sub_fob);
                                                                                                                                            
                                                                                                                                            $('#total').val(data[i].total);
                                                                                                                                            var totaltotals=$('#total').val();
                                                                                                                                            var total_tot =parseFloat(totaltotals);
                                                                                                                                            total_tot=total_tot.toFixed(2);
                                                                                                                                            $('#total').val(total_tot);
                                                                                                                                            
                                                                                                                                            $('#clausula_venta').val(data[i].clausula_venta);
                                                                                                                                            $("#clausula_venta").attr('disabled', true);
                                                                                                                                            $('#descuento').val(data[i].descuento);
                                                                                                                                            $('#insurance').val(data[i].insurance);
                                                                                                                                            var subinsurance=$('#insurance').val();
                                                                                                                                            var sub_insurance =parseFloat(subinsurance);
                                                                                                                                            sub_insurance=sub_insurance.toFixed(2);
                                                                                                                                            $('#insurance').val(sub_insurance);
                                                                                                                                            
                                                                                                                                            $('#freight').val(data[i].freight);
                                                                                                                                            var subfreight=$('#freight').val();
                                                                                                                                            var sub_freight =parseFloat(subfreight);
                                                                                                                                            sub_freight=sub_freight.toFixed(2);
                                                                                                                                            $('#freight').val(sub_freight);
                                                                                                                                            
                                                                                                                                            $("#ingresa_producto_proforma").hide();	
                                                                                                                                            $("#cambio_proforma_version").show();	
                                                                                                                                            $("#ingresar").hide();	
                                                                                                                                            $("#actualizar").hide();
                                                                                                                                            var stream="numero_proforma="+numero_proforma+"&"+"funcion="+15;
                                                                                                                                            $.ajax({
                                                                                                                                                    type: "POST",
                                                                                                                                                    url: "insert/insertar_proforma.php",
                                                                                                                                                    data:stream,
                                                                                                                                                    success: function(data)	{	
                                                                                                                                                            $('#productos_finanzas').html("");	
                                                                                                                                                            $('#productos_finanzas').append(data);
                                                                                                                                                    }			
                                                                                                                                            });
                                                                                                                                    }
                                                                                                                            }			
                                                                                                                    });
                                                                                                            }
                                                                                                            else if (data==2)
                                                                                                            {
                                                                                                                    var numero_proforma=$("#num_proforma").val();
                                                                                                                    var stream="numero_proforma="+numero_proforma+"&"+"funcion="+5;
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
                                                                                                                                            $('#centro_venta2').val(data[i].centro_venta);
                                                                                                                                            $('#version').val(data[i].version);
                                                                                                                                            $('#medio_transporte').val(data[i].medio_de_transporte);
                                                                                                                                            //alert(data[i].puerto_embarque);
                                                                                                                                            $('#lis_aduanas').val(data[i].aduana);
                                                                                                                                            $('#lis_suc_aduanas').val(data[i].puerto_embarque);
                                                                                                                                            //$('#p_embarque').val(data[i].puerto_embarque);
                                                                                                                                            $('#p_destino').val(data[i].puerto_destino);
                                                                                                                                            $('#condicion_venta').val(data[i].forma_pago);
                                                                                                                                            //$('#c_pago').val(data[i].forma_pago);
                                                                                                                                            $('#descripcion').val(data[i].descripcion_mercaderia);
                                                                                                                                            $('#medio_transporte').val(data[i].medio_de_transporte);
                                                                                                                                            $('#id_direccion_cliente_internacional').append(data[i].direccion);
                                                                                                                                            $('#id_direccion_pais').append(data[i].pais);
                                                                                                                                            $('#list_tip_mon').val(data[i].tipo_moneda);
                                                                                                                                            $('#subtotal').val(data[i].sub_total);
                                                                                                                                            //alert(data[i].tot_fob);
                                                                                                                                            $('#fob').val(data[i].tot_fob);
                                                                                                                                            $('#estado').val(data[i].est);
                                                                                                                                            $('#total').val(data[i].total);
                                                                                                                                            $('#clausula_venta').val(data[i].clausula_venta);
                                                                                                                                            $('#descuento').val(data[i].descuento);
                                                                                                                                            $('#insurance').val(data[i].insurance);
                                                                                                                                            $('#freight').val(data[i].freight);
                                                                                                                                            $("#ingresa_producto_proforma").hide();	
                                                                                                                                            $("#cambio_proforma_version").show();	
                                                                                                                                            $("#ingresar").hide();	
                                                                                                                                            //$("#actualizar").show();
                                                                                                                                            var status=$('#estado').val();
                                                                                                                                            if(status==0){
                                                                                                                                                $("#autoriza_comex").show();
                                                                                                                                            }
                                                                                                                                            
                                                                                                                                            var stream="numero_proforma="+numero_proforma+"&"+"funcion="+15;
                                                                                                                                            $.ajax({
                                                                                                                                                    type: "POST",
                                                                                                                                                    url: "insert/insertar_proforma.php",
                                                                                                                                                    data:stream,
                                                                                                                                                    success: function(data)	{	
                                                                                                                                                            $('#productos_finanzas').html("");	
                                                                                                                                                            $('#productos_finanzas').append(data);
                                                                                                                                                    }			
                                                                                                                                            });
                                                                                                                                    }
                                                                                                                            }			
                                                                                                                    });
                                                                                                            }
                                                                                                            else if (data==3)
                                                                                                            {
                                                                                                                    var numero_proforma=$("#num_proforma").val();
                                                                                                                    var stream="numero_proforma="+numero_proforma+"&"+"funcion="+5;
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
                                                                                                                                            $('#centro_venta').val(data[i].centro_venta);
                                                                                                                                            $("#centro_venta").attr('disabled', true);
                                                                                                                                            $('#version').val(data[i].version);
                                                                                                                                            $('#medio_transporte').val(data[i].medio_de_transporte);
                                                                                                                                            $('#p_embarque').val(data[i].puerto_embarque);
                                                                                                                                            $('#p_destino').val(data[i].puerto_destino);
                                                                                                                                            $('#c_pago').val(data[i].forma_pago);
                                                                                                                                            $('#descripcion').val(data[i].descripcion_mercaderia);
                                                                                                                                            $('#medio_transporte').val(data[i].medio_de_transporte);
                                                                                                                                            $("#medio_transporte").attr('disabled', true);
                                                                                                                                            $('#id_direccion_cliente_internacional').append(data[i].direccion);
                                                                                                                                            $('#id_direccion_pais').append(data[i].pais);
                                                                                                                                            $('#list_tip_mon').val(data[i].tipo_moneda);
                                                                                                                                            $("#list_tip_mon").attr('disabled', true);
                                                                                                                                            $('#subtotal').val(data[i].sub_total);
                                                                                                                                            $('#total').val(data[i].total);
                                                                                                                                            $('#clausula_venta').val(data[i].clausula_venta);
                                                                                                                                            $("#clausula_venta").attr('disabled', true);
                                                                                                                                            $('#descuento').val(data[i].descuento);
                                                                                                                                            $('#insurance').val(data[i].insurance);
                                                                                                                                            $('#freight').val(data[i].freight);
                                                                                                                                            $("#ingresa_producto_proforma").hide();	
                                                                                                                                            $("#cambio_proforma_version").show();	
                                                                                                                                            $("#ingresar").hide();	
                                                                                                                                            $("#actualizar").hide();
                                                                                                                                            var stream="numero_proforma="+numero_proforma+"&"+"funcion="+21;
                                                                                                                                            $.ajax({
                                                                                                                                                    type: "POST",
                                                                                                                                                    url: "insert/insertar_proforma.php",
                                                                                                                                                    data:stream,
                                                                                                                                                    success: function(data)	{	
                                                                                                                                                            $('#productos_finanzas').html("");	
                                                                                                                                                            $('#productos_finanzas').append(data);
                                                                                                                                                            $('#estado_proforma').show();	
                                                                                                                                                            $("#ingresar").hide();										 
                                                                                                                                                            $("#ingresa_producto_proforma").hide();	
                                                                                                                                                            $('#cambio_proforma_version').hide();	
                                                                                                                                                            $('#imprimir').hide();
                                                                                                                                                    }			
                                                                                                                                            });
                                                                                                                                    }
                                                                                                                            }			
                                                                                                                    });
                                                                                                            }
                                                                                                    }			
                                                                                            });										
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
	
	$( "#id_cliente_internacional").change(function() {
		var id_cliente_internacional = $('#id_cliente_internacional option:selected').attr('id');
		var stream="id_cliente_internacional="+id_cliente_internacional+"&"+"funcion="+1;
		$.ajax({
			type: "POST",
			url: "select/traer_datos_cliente.php",
			data:stream,
			success: function(data) {							
				$("#id_direccion_cliente_internacional").html("");
				$("#id_direccion_cliente_internacional").append(data);
				var stream="id_cliente_internacional="+id_cliente_internacional+"&"+"funcion="+2;
				$.ajax({
					type: "POST",
					url: "select/traer_datos_cliente.php",
					data:stream,
					success: function(data) {							
						$("#id_direccion_pais").html("");
						$("#id_direccion_pais").append(data);
						var stream="numero_proforma="+numero_proforma+"&"+"funcion="+20;
						$.ajax({
							type: "POST",
							url: "insert/insertar_proforma.php",
							data:stream,
							success: function(data)	{	
								if (data==1)
								{
								}
								else
								{
									var stream="id_cliente="+id_cliente_internacional+"&"+"funcion="+2;
									//alert (stream);
									$.ajax({
										type: "POST",
										url: "select/trae_suma_factura_pagos.php",
										data:stream,
										success: function(data) {
											if (data<0)
											{
												$("#ingresar").hide();	
												$("#saldo").val(data);
												$("#ingresa_producto_proforma").hide();									
											}
											else
											{
												$("#ingresar").show();	
												$("#saldo").val(data);
												$("#ingresa_producto_proforma").show();	
											}
										}			
									});	
								}
							}			
						});	
					}			
				});							
			}			
		});
	});
});

function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
$.fn.cambio_proforma_version_modifca=function(){
	var action = confirm('Desea Cambiar de Version Proforma?');
	if(action==true)
	{
		var numero_proforma=$("#num_proforma").val();
		var stream="numero_proforma="+numero_proforma+"&"+"funcion="+7;
		$.ajax({
			type: "POST",
			url: "insert/insertar_proforma.php",
			data:stream,
			success: function(data)	{
				$('#version').val(data);
				var stream="numero_proforma="+numero_proforma+"&"+"funcion="+6;
				$.ajax({
					type: "POST",
					url: "insert/insertar_proforma.php",
					data:stream,
					success: function(data)	{	
						$('#productos_finanzas').html("");	
						$('#productos_finanzas').append(data);		
						$('#cambio_proforma_version').hide();	
						$('#ingresa_producto_proforma_modificar').show();	
					}			
				});
			}
		});
	}
}
</script>
<body>
<table class="table">
	<tr>
		<input type="hidden" id="id_usuario" value="<?php echo $id_Usuario?>" />
                <input type="hidden"  id="estado" value="" />
		<td height="100%">
			<div class="body" id="cabeza_proforma">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Crear Proforma</p>
					</div>
					<div class="content">  
						<br>         
						<div>  
							<div class="fright">
								<a href="principal_comercializacion.php"><input type="button" value="Volver&raquo;"/></a>
								<a href="crear_proforma.php"><input type="button" value="Nueva&raquo;"/></a>
							</div>
						</div>
						<table class="tableform">
							<tr>
						 		<td>
									<label>Version</label>
									<input type="text" id="version" placeholder="Version" value='' readonly/>	
								</td>
								<td style="display:none" id='estado_proforma'>
								 <font color='#cc3366'>Proforma Rechazada por Finanzas	</font>						 							 		 
								</td>
							</tr>
							<tr>
								<td>
									<label>Numero Proforma</label>
								</td>
								<td>
									<label>Fecha</label>
								</td>
								<td>
									<label>Centro de Venta</label>
								</td>							
							</tr>
								<td>
 									<input type="text" id="num_proforma"  placeholder="Numero" onkeypress="ValidaSoloNumeros()"/>
									<div id="valida-proforma_alto" style="display:none" class="errores">
										Numero de Proforma es mas alto que el Correlativo
									</div> 
									<div id="valida-num_proforma_crear" style="display:none" class="errores">
										Debe Crear Proforma
									</div> 
									<div id="valida-num_proforma" style="display:none" class="errores">
										Debe Ingresar Numero de Proforma
									</div> 
									<div id="valida-num_proforma_cero" style="display:none" class="errores">
										Numero de Proforma no puede ser 0
									</div> 
								</td>
								<td>
									<input type="text" id="fecha_proforma"  value="<?php echo date('d-m-Y')?>" placeholder="Fecha" readonly/>
									<div id="valida-fecha_proforma" style="display:none" class="errores">
										Debe Ingresar Fecha de Proforma
									</div> 
								</td>
								<td>
									<select id="centro_venta2">
									</select>
									<div id="valida-c_venta" style="display:none" class="errores">
										Debe Ingresar Centro de Venta
									</div> 
								</td>
								<tr>
								<td>
									<label>Cliente</label>
								</td>
								<td>
									<label>Direccion</label>
								</td>
								<td>
									<label>Pais</label>
								</td>							
							</tr>
								<td>
 									<select id="id_cliente_internacional">
									</select>
									<div id="valida-c_inter" style="display:none" class="errores">
										Debe Ingresar Cliente Internacional
									</div> 
								</td>
								<td id="id_direccion_cliente_internacional">								
								</td>
								<td id="id_direccion_pais">									 
								</td>
							<tr>
								<td>
									<label>Medio de Transporte</label>
									<select id='medio_transporte'>
										<option selected value='' >Seleccione Medio de Transporte.....</option>
										<option id="Maritimo">Maritimo</option>
										<option id="Terrestre">Terrestre</option>
										<option id="Aereo">Aereo</option>
									</select>
									<div id="valida-m_trans" style="display:none" class="errores">
										Debe Ingresar Medio de Transporte
									</div> 
								</td>
								<td>
									<label>Agencia de Aduanas</label>
									<select id='lis_aduanas'>
									</select>
									<div id="valida-lis_aduanas" style="display:none" class="errores">
										Debe Seleccionar Agencia de Aduanas
									</div> 
								</td>
								<td>
									<label>Sucursal/Puerto de Embarque</label>
									<select id='lis_suc_aduanas'>
									</select>
									<!--input type="text" id="p_embarque" placeholder="Puerto de Embarque"/-->
									<div id="valida-p_enbarque" style="display:none" class="errores">
										Debe Ingresar Puerto de Embarque
									</div>
								</td>
								
							</tr>
							<tr>
								<td>
									<label>Puerto de Destino</label>
									<input type="text" id="p_destino" placeholder="Puerto de Destino"/>
									<div id="valida-p_destino" style="display:none" class="errores">
										Debe Ingresar Puerto de Destino
									</div>
								</td>
							</tr>
							<tr>
									<td>
										<label>Descripcion de la Mercaderia</label>
										<textarea rows="3" cols="30" id='descripcion' placeholder="Descripcion"></textarea>
									</td>
									<td>
										<label>Tipo de Moneda</label>
										<select id="list_tip_mon">
										</select>
										<div id="valida-moneda" style="display:none" class="errores">
											Debe Ingresar Tipo de Moneda
										</div> 
									</td>
									<td>
										<label>Condicion de Pago</label>
										<select id="condicion_venta">
										</select>

										<!--input type="text" id="c_pago" placeholder="Condicion de Pago"/-->
										<div id="valida-condicion_venta" style="display:none" class="errores">
											Debe Seleccionar Condicion de Pago
										</div> 
									</td>
								</tr>
								<tr>
									<td>
										<label>Clausula de Venta</label>
										<select id='clausula_venta'>
											<option selected value='' >Seleccione Clausula.....</option>
											<option id='1'>C.I.F.</option>
											<option id='2'>FOB</option>
											<option id='3'>CFR</option>
									</select>
									<div id="valida-clausula_venta" style="display:none" class="errores">
											Debe Ingresar Clausula de Venta
										</div> 
									</td>
							</tr>
							<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"> 
												<thead> 
													<tr>
														<td>
															<h2><font style="color: white"><b>Cajas</b></h2>
															<input type="text"  id="cajas" onkeypress="ValidaSoloNumeros()" class="limpiar" placeholder="Cantidad"/>
															<div id="valida-cajas" style="display:none" class="errores">
																Debe Ingresar Numero de Cajas
															</div> 
                                                                                                                        </font>
														</td>
														<td>
															<h2><font style="color: white"><b>Producto</b></h2>
															<input type="text" id="busca_pro" placeholder="Ingrese Producto a Filtrar y presione Enter"/>
															<select id="list_prod_term_proforma" class="limpiar">
															</select>
															<div id="valida-producto" style="display:none" class="errores">
																Debe Ingresar Producto
															</div> 
															<div id="stock" style="display:none" class="errores">
															</div> 
                                                                                                                        </font>
														</td>
														<td>
                                                                                                                    <h2><font style="color: white"><b>Precio</b></h2>
															<input type="text" id="precio" onkeypress="ValidaSoloNumeros()" class="limpiar"  placeholder="Precio"/>
                                                                                                                        
															<div id="valida-precio" style="display:none" class="errores">
																Debe Ingresar Precio
															</div> 
                                                                                                                        <br>(Presione Enter para Ingresar)
                                                                                                                        </font>
														</td>
														
														
													</tr>
													<!--tr>
														<td>
														</td>
														<td>
														</td>
														<td>
															<!--div class="fright" id='ingresa_producto_proforma'>
																<input type="submit" onclick='$(this).ingresa_producto_proforma();' value="Agregar Productos &raquo;"/>
															</div>
															<div class="fright" style="display:none" id='ingresa_producto_proforma_modificar'>
																<input type="submit" onclick='$(this).ingresa_producto_proforma_modificar();' value="Agregar Productos &raquo;"/>
															</div>
															<div class="fright" style="display:none" id='cambio_proforma_version'>
																<input type="submit" onclick='$(this).cambio_proforma_version_modifca();' value="Agregar Productos &raquo;"/>
															</div>
														</td>
													</tr-->
												</thead> 
											</table>
										</div>
									</article>
								</td>								
							</tr>
			 				<tr>
								<td colspan="5">
									<article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"> 
												<thead> 
													<tr>
														<th width="100">
															Codigo 
														</th>
														<th>
															Producto
														</th>
														<th>
															Cantidad
														</th>
														 <th>
															Precio
														</th>
														<th>
															Total
														</th>
														<th>
															Eliminar
														</th>	
														<!--th>
															Editar
														</th-->	
													</tr> 
													<tbody id='productos_finanzas'>
														<div id="valida-productos_pedidos" style="display:none" class="errores">
															Debe Ingresar Productos para crear Proforma
														</div> 
														<div id="valida-productos_repetidos" style="display:none" class="errores">
															Productos ya se Encuentran en la Proforma
														</div> 
													</tbody>
												</thead>
											 </table>
										</div>
									</article>
								</td>
							</tr>
                                                        <tr>
								<td>
									&nbsp;
								</td>
								<td >
                                                                    &nbsp;
								</td>
								<td>
                                                                        <article class="module width_full">            
										<div class="module_content">
											<table class="tablesorter"> 
												<thead> 
													<tr>
                                                                                                                <td colspan="1">
                                                                                                                        <label>Sub Total</label>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                        <input type="text" id="subtotal" value="0" style="text-align: right" readonly/>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                                &nbsp;
                                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        <tr>    
                                                                                                                        <td>
                                                                                                                                <label>DESCUENTO</label>
                                                                                                                        </td>
                                                                                                                        <td >
                                                                                                                                <input type="text" id="descuento" value="0" style="text-align: right" onkeypress="ValidaSoloNumeros()" maxlength="2"/>
                                                                                                                        </td>							 
                                                                                                                        <td>								
                                                                                                                                <label>%</label>									
                                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                <td colspan="1">
                                                                                                                        <label>F.O.B.</label>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                        <input type="text" id="fob" value="0" style="text-align: right" readonly/>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                                &nbsp;
                                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                        <td>
                                                                                                                                <label>FREIGHT</label>
                                                                                                                        </td>
                                                                                                                        <td>
                                                                                                                                <input type="text" id="freight" value="0" style="text-align: right" onkeypress="ValidaSoloNumeros()"/>
                                                                                                                                <div id="valida_freight" style="display:none" class="errores">
                                                                                                                                        Debe Ingresar Freight
                                                                                                                                </div> 
                                                                                                                        </td>
                                                                                                                        <td>
                                                                                                                                &nbsp;
                                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                        <td>
                                                                                                                                <label>INSURANCE</label>
                                                                                                                        </td>
                                                                                                                        <td>
                                                                                                                                <input type="text" id="insurance" value="0" style="text-align: right" onkeypress="ValidaSoloNumeros()"/>
                                                                                                                                <div id="valida_insurance" style="display:none" class="errores">
                                                                                                                                        Debe Ingresar insurance
                                                                                                                                </div>
                                                                                                                        </td>
                                                                                                                        <td>
                                                                                                                                &nbsp;
                                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                        <td  id='tit_total'>
                                                                                                                        </td>
                                                                                                                        <td>
                                                                                                                                <input type="text" id="total" value="0" style="text-align: right" readonly/>
                                                                                                                        </td>
                                                                                                                        <td>
                                                                                                                                &nbsp;
                                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                        <td colspan="5">
                                                                                                                                <div class="fright" id='ingresar'> 
                                                                                                                                        <input type="submit" onClick='$(this).ingresa_proforma();' value="Crear Proforma &raquo;"/> 
                                                                                                                                </div>
                                                                                                                                <div class="fright"  style="display:none" id='actualizar'> 
                                                                                                                                        <input type="submit" onClick='$(this).proforma_actualizar();' value="Actualizar Proforma &raquo;"/> 
                                                                                                                                </div>
                                                                                                                                <div class="fright" style="display:none" id='imprimir'> 
                                                                                                                                        <input type="submit" onClick='$(this).imprimir_proforma();' value="Imprimir &raquo;"/> 
                                                                                                                                </div>
                                                                                                                                <div class="fright" style="display:none" id='autoriza_comex'> 
                                                                                                                                        <input type="submit" onClick='$(this).autoriza_prof_comex();' value="Autoriza Comex &raquo;"/> 
                                                                                                                                </div>
                                                                                                                        </td>
                                                                                                                </tr>
												</thead> 
											</table>
										</div>
									</article>
								</td>
                                                        </tr>
                                                    
							<!--tr>
								<td>
									&nbsp;
								</td>
								<td colspan="1">
									<label>Sub Total</label>
								</td>
								<td>
									<input type="text" id="subtotal" value="0" readonly/>
								</td>
                                                        <tr>
                                                        </tr>    
									<td>
										&nbsp;
									</td>
									<td>
										<label>DESCUENTO</label>
									</td>
									<td>
										<input type="text" id="descuento" onkeypress="ValidaSoloNumeros()" maxlength="2"/>
									</td>							 
									<td>								
										<label>% Desc</label>									
									</td>
							</tr>
                                                        <tr>
								<td>
									&nbsp;
								</td>
								<td colspan="1">
									<label>F.O.B.</label>
								</td>
								<td>
									<input type="text" id="fob" value="0" readonly/>
								</td>
                                                        <tr>
								 <tr>
									<td>
										&nbsp;
									</td>
									<td>
										<label>FREIGHT</label>
									</td>
									<td>
										<input type="text" id="freight" value="0" onkeypress="ValidaSoloNumeros()"/>
										<div id="valida_freight" style="display:none" class="errores">
											Debe Ingresar Freight
										</div> 
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
										<label>INSURANCE</label>
									</td>
									<td>
										<input type="text" id="insurance" value="0" onkeypress="ValidaSoloNumeros()"/>
										<div id="valida_insurance" style="display:none" class="errores">
											Debe Ingresar insurance
										</div>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td  id='tit_total'>
									</td>
									<td>
										<input type="text" id="total" value="0" readonly/>
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<div class="fright" id='ingresar'> 
											<input type="submit" onClick='$(this).ingresa_proforma();' value="Crear Proforma &raquo;"/> 
										</div>
										<div class="fright"  style="display:none" id='actualizar'> 
											<input type="submit" onClick='$(this).proforma_actualizar();' value="Actualizar Proforma &raquo;"/> 
										</div>
										<div class="fright" style="display:none" id='imprimir'> 
											<input type="submit" onClick='$(this).imprimir_proforma();' value="Imprimir &raquo;"/> 
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