 $(function(){
	/*****************combo tipo de usuario ******///
	$.getJSON("combos/combo_sector_pedido.php",function(resultado){
		
		$("#list_sector_pedidos").html("<option value='' selected>Seleccione Sector...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_sector_pedidos").append("<option id='"+resultado[i].id_sector+"' value='"+resultado[i].sector+"'>"+resultado[i].sector+"</option>");
		}
	
	});
	/**********************///
	/*****************combo tipo de Proceso ******///
	$.getJSON("combos/combo_procesos.php",function(resultado){
		
		$("#list_proceso").html("<option value='' selected>Seleccione el Proceso...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_proceso").append("<option id='"+resultado[i].id_proceso+"' value='"+resultado[i].proceso+"'>"+resultado[i].proceso+"</option>");
		}
	
	});
	/**********************///
	/**********************///
	
		/*****************combo tipo de Moneda Orden de Compra ******///
	$.getJSON("combos/combo_tipo_moneda.php",function(resultado){
		
		$("#list_tip_mon").html("<option value='' selected>Seleccione Tipo de Moneda...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_tip_mon").append("<option id='"+resultado[i].id_tipo_moneda+"' value='"+resultado[i].tipo_moneda+"'>"+resultado[i].tipo_moneda+"</option>");
		}
	
	});
	/**********************///
	/*****************combo arear ******///
	$.getJSON("combos/combo_areas.php",function(resultado){
		
		$("#list_areas").html("<option value='' selected>Seleccione Area...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_areas").append("<option id='"+resultado[i].id_area+"' value='"+resultado[i].area+"'>"+resultado[i].area+"</option>");
		}
	
	});
	/**********************///
	/*****************combo Sector del Producto ******///
	$.getJSON("combos/combo_sector_productos.php",function(resultado){
		
		$("#list_sector").html("<option value='' selected>Seleccione Sector...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_sector").append("<option id='"+resultado[i].id_sector+"' value='"+resultado[i].sector+"'>"+resultado[i].sector+"</option>");
		}
	
	});
	/**********************///
	/*****************combo Productos terminado proforma y nota de venta******///
	$.getJSON("combos/combo_productos_pedidos.php",function(resultado){
		
		$("#list_prod_term").html("<option value='' selected>Seleccione Producto...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_prod_term").append("<option id='"+resultado[i].id_producto+"' value='"+resultado[i].nombre_producto+"'>"+resultado[i].nombre_producto+"</option>");
		}
	
	});
		/*****************combo Productos terminado proforma y nota de venta******///
	$.getJSON("combos/combo_producto_terminado.php",function(resultado){
		//$.getJSON("combos/combo_productos_pedidos.php",function(resultado){
		$("#list_prod_term_proforma").html("<option value='' selected>Seleccione Producto...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_prod_term_proforma").append("<option id='"+resultado[i].id_producto+"' value='"+resultado[i].nombre_producto+"'>"+resultado[i].nombre_producto+"</option>");
		}
	
	});
	/**********************///



		/*****************combo condicion de pago nota venta******///
	$.getJSON("combos/combo_condiciones_pago.php",function(resultado){
		
		$("#condicion_venta").html("<option value='' selected>Seleccione Condicion de Venta...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#condicion_venta").append("<option id='"+resultado[i].Numero+"' value='"+resultado[i].Condicion+"'>"+resultado[i].Condicion+"</option>");
		}
	
	});
	/**********************///
		/*****************combo categorias******///
	$.getJSON("combos/combo_categoria.php",function(resultado){
		
		$("#categoria").html("<option value='' selected>Seleccione Categoria...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#categoria").append("<option id='"+resultado[i].id_categoria+"' value='"+resultado[i].id_categoria+"'>"+resultado[i].categoria+"</option>");
		}
	
	});
	/**********************///

		/*****************combo aduanas******///
	$.getJSON("combos/combo_aduanas.php",function(resultado){
		
		$("#list_aduanas").html("<option value='' selected>Seleccione Aduana...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_aduanas").append("<option id='"+resultado[i].id_aduana+"' value='"+resultado[i].id_aduana+"'>"+resultado[i].nombre_aduana+"</option>");
		}
	
	});
	/**********************///
	/*****************combo region******///
	$.getJSON("combos/combo_region.php",function(resultado){
		
		$("#list_reg").html("<option value='' selected>Seleccione Region...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_reg").append("<option id='"+resultado[i].id_re+"' value='"+resultado[i].id_re+"'>"+resultado[i].str_descripcion+"</option>");
		}
	
	});
	/**********************///

		/*****************Combo Cliente Nacional******///
	$.getJSON("combos/combo_cliente_nacional.php",function(resultado){
		
		$("#id_cliente_nacional").html("<option value='' selected>Seleccione Cliente...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#id_cliente_nacional").append("<option id='"+resultado[i].id_cliente+"' value='"+resultado[i].nombre_cliente+"'>"+resultado[i].nombre_cliente+"</option>");
		}
	
	});
	/**********************///
        	/*****************Combo Proveedor******///
	$.getJSON("combos/combo_proveedor.php",function(resultado){
		
		$("#list_proveedor").html("<option value='' selected>Seleccione Proveedor...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_proveedor").append("<option id='"+resultado[i].id_proveedor+"' value='"+resultado[i].nombre+"'>"+resultado[i].nombre+"</option>");
		}
	
	});
	/**********************///
	
	
	});