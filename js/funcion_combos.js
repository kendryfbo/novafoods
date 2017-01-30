 $(function(){
	/*****************combo tipo de usaurio ******///
	$.getJSON("combos/combo_tipo_usuario.php",function(resultado){
		
		$("#list_tipo_usuario").html("<option value='' selected>Seleccione Tipo de Usuario...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_tipo_usuario").append("<option id='"+resultado[i].id_tipo+"' value='"+resultado[i].tipo+"'>"+resultado[i].tipo+"</option>");
		}
	
	});
	/**********************///
	 		/*****************combo sector de usuario ******///
	$.getJSON("combos/combo_sector_usuario.php",function(resultado){
		
		$("#list_sector_usuario").html("<option value='' selected>Seleccione Sector de Usuario...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_sector_usuario").append("<option id='"+resultado[i].id_sector+"' value='"+resultado[i].sector+"'>"+resultado[i].sector+"</option>");
		}
	
	});
	 		/*****************combo sector de usuario ******///
	$.getJSON("combos/combo_sector_usuario.php",function(resultado){
		
		$("#list_sector_usuario").html("<option value='' selected>Seleccione Sector de Usuario...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_sector_usuario").append("<option id='"+resultado[i].id_sector+"' value='"+resultado[i].sector+"'>"+resultado[i].sector+"</option>");
		}
	
	});
	
		 		/*****************combo Bancos ******///
	$.getJSON("combos/combo_bancos.php",function(resultado){
		
		$("#list_bancos").html("<option value='' selected>Seleccione Banco...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_bancos").append("<option id='"+resultado[i].id_banco+"' value='"+resultado[i].banco+"'>"+resultado[i].banco+"</option>");
		}	
	});
	 		/*****************combo Vendedores ******///
	$.getJSON("combos/combo_vendedores.php",function(resultado){
		
		$("#list_vendedores").html("<option value='' selected>Seleccione Vendedor...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_vendedores").append("<option id='"+resultado[i].id_vendedor+"' value='"+resultado[i].vendedor+"'>"+resultado[i].vendedor+"</option>");
		}
	
	});
         		/*****************combo Lado ******///
	$.getJSON("combos/combo_lado.php",function(resultado){
		
		$("#list_lado").html("<option value='' selected>Seleccione ...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_lado").append("<option id='"+resultado[i].lado+"' value='"+resultado[i].lado+"'>"+resultado[i].lado+"</option>");
		}
	
	});
         		/*****************combo canal ******///
	$.getJSON("combos/combo_canal.php",function(resultado){
		
		$("#list_canal").html("<option value='' selected>Seleccione Canal...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_canal").append("<option id='"+resultado[i].id_canal+"' value='"+resultado[i].canal+"'>"+resultado[i].canal+"</option>");
		}
	
	});
	 		/*****************combo Aduanas ******///
	$.getJSON("combos/combo_aduanas.php",function(resultado){
		
		$("#list_aduanas").html("<option value='' selected>Seleccione Aduana...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_aduanas").append("<option id='"+resultado[i].id_aduana+"' value='"+resultado[i].nombre_aduana+"'>"+resultado[i].nombre_aduana+"</option>");
		}
	
	});
	/**********************///
	/*****************combo familia******///
	$.getJSON("combos/combo_familias.php",function(resultado){
		
		$("#list_familia").html("<option value='' selected>Seleccione Familia...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_familia").append("<option id='"+resultado[i].id_familia+"' value='"+resultado[i].familia+"'>"+resultado[i].familia+"</option>");
		}
	
	});
        /*****************combo familia Productos******///
	$.getJSON("combos/combo_familias_pt.php",function(resultado){
		
		$("#list_familia2").html("<option value='' selected>Seleccione Familia...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_familia2").append("<option id='"+resultado[i].id_familia+"' value='"+resultado[i].familia+"'>"+resultado[i].familia+"</option>");
		}
	
	});
	/**********************///
		/*****************combo Marca ******///
	$.getJSON("combos/combo_marcas.php",function(resultado){
		
		$("#list_marc").html("<option value='' selected>Seleccione Marca...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_marc").append("<option id='"+resultado[i].id_marca+"' value='"+resultado[i].marca+"'>"+resultado[i].marca+"</option>");
		}
	
	});
	/**********************///
        /*****************combo Tipo Producto ******///
	$.getJSON("combos/combo_tipo_producto.php",function(resultado){
		
		$("#list_tipo_producto").html("<option value='' selected>Seleccione Tipo de Producto...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_tipo_producto").append("<option id='"+resultado[i].id_tipo_producto+"' value='"+resultado[i].tipo_producto+"'>"+resultado[i].tipo_producto+"</option>");
		}
	
	});
	/**********************///
			/*****************combo Formatos ******///
	$.getJSON("combos/combo_formatos.php",function(resultado){
		
		$("#list_formatos").html("<option value='' selected>Seleccione Formato...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_formatos").append("<option id='"+resultado[i].id_formato+"' value='"+resultado[i].formato+"'>"+resultado[i].formato+"</option>");
		}
	
	});
	/**********************///
	/*****************combo umed ******///
	$.getJSON("combos/combo_umed.php",function(resultado){
		
		$("#list_umed").html("<option value='' selected>Seleccione Unidad de Medida...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_umed").append("<option id='"+resultado[i].id_umed+"' value='"+resultado[i].umed+"'>"+resultado[i].umed+"</option>");
		}
	
	});
	/**********************///
		/*****************combo Genero ******///
	$.getJSON("combos/combo_genero.php",function(resultado){
		
		$("#list_genero").html("<option value='' selected>Seleccione Genero...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_genero").append("<option id='"+resultado[i].id_genero+"' value='"+resultado[i].genero+"'>"+resultado[i].genero+"</option>");
		}
	
	});
	/**********************///
	/*****************combo Materiales ******///
	$.getJSON("combos/combo_materiales.php",function(resultado){
		
		$("#list_material").html("<option value='' selected>Seleccione Material...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_material").append("<option id='"+resultado[i].id_material+"' value='"+resultado[i].material+"'>"+resultado[i].material+"</option>");
		}
	
	});
	/*****************combo Colores ******///
	$.getJSON("combos/combo_colores.php",function(resultado){
		
		$("#list_color").html("<option value='' selected>Seleccione Color...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_color").append("<option id='"+resultado[i].id_color+"' value='"+resultado[i].color+"'>"+resultado[i].color+"</option>");
		}
	
	});
		/*****************combo Sabores ******///
	$.getJSON("combos/combo_sabores.php",function(resultado){
		
		$("#list_sabor").html("<option value='' selected>Seleccione Sabor...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_sabor").append("<option id='"+resultado[i].id_sabor+"' value='"+resultado[i].sabor+"'>"+resultado[i].sabor+"</option>");
		}
	
	});
	/*****************combo Familia mantencion ******///
	$.getJSON("combos/combo_familias_mantencion.php",function(resultado){
		
		$("#list_familia_mant").html("<option value='' selected>Seleccione Familia...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_familia_mant").append("<option id='"+resultado[i].id_familia+"' value='"+resultado[i].familia+"'>"+resultado[i].familia+"</option>");
		}
	
	});	
	/**********************///
		/*****************combo Familia Oficina ******///
	$.getJSON("combos/combo_familias_oficina.php",function(resultado){
		
		$("#list_familia_of").html("<option value='' selected>Seleccione Familia...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_familia_of").append("<option id='"+resultado[i].id_familia+"' value='"+resultado[i].familia+"'>"+resultado[i].familia+"</option>");
		}
	
	});	
			/*****************combo Familia POP ******///
	$.getJSON("combos/combo_familias_pop.php",function(resultado){
		
		$("#list_familia_pop").html("<option value='' selected>Seleccione Familia...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_familia_pop").append("<option id='"+resultado[i].id_familia+"' value='"+resultado[i].familia+"'>"+resultado[i].familia+"</option>");
		}
	
	});	
	/**********************///
		/*****************combo Familia Materia Prima ******///
	$.getJSON("combos/combo_familias_m_prima.php",function(resultado){
		
		$("#list_familia_mprima").html("<option value='' selected>Seleccione Familia...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_familia_mprima").append("<option id='"+resultado[i].id_familia+"' value='"+resultado[i].familia+"'>"+resultado[i].familia+"</option>");
		}
	
	});
        
        	/*****************combo Familia Insumo ******///
	$.getJSON("combos/combo_familias_insumo.php",function(resultado){
		
		$("#list_familia_ins").html("<option value='' selected>Seleccione Familia...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_familia_ins").append("<option id='"+resultado[i].id_familia+"' value='"+resultado[i].familia+"'>"+resultado[i].familia+"</option>");
		}
	
	});
				/*****************combo Tallas POP ******///
	$.getJSON("combos/combo_tallas.php",function(resultado){
		
		$("#list_tallas").html("<option value='' selected>Seleccione Talla...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_tallas").append("<option id='"+resultado[i].id_talla+"' value='"+resultado[i].talla+"'>"+resultado[i].talla+"</option>");
		}
	
	});	
	/**********************///
	/*****************combo Sectores de productos y/o familias ******///
	$.getJSON("combos/combo_sector.php",function(resultado){
		
		$("#list_sector").html("<option value='' selected>Seleccione Sector...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_sector").append("<option id='"+resultado[i].id_sector+"' value='"+resultado[i].sector+"'>"+resultado[i].sector+"</option>");
		}
	
	});
	/**********************///
		/*****************combo tipo de usaurio ******///
	$.getJSON("combos/combo_regiones.php",function(resultado){
		
		$("#list_regiones").html("<option value='' selected>Seleccione Region...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_regiones").append("<option id='"+resultado[i].id_region+"' value='"+resultado[i].region+"'>"+resultado[i].region+"</option>");
		}
	
	});
	/**********************///
		/*****************combo giros cliente******///
	$.getJSON("combos/combo_giro.php",function(resultado){
		
		$("#list_giros").html("<option value='' selected>Seleccione Giro...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_giros").append("<option id='"+resultado[i].id_giro+"' value='"+resultado[i].giro+"'>"+resultado[i].giro+"</option>");
		}
	
	});
	/**********************///
		/*****************combo Pais******///
	$.getJSON("combos/combo_pais.php",function(resultado){
		
		$("#list_pais").html("<option value='' selected>Seleccione Pais...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_pais").append("<option id='"+resultado[i].id_pais+"' value='"+resultado[i].pais+"'>"+resultado[i].pais+"</option>");
		}
	
	});
	/**********************///
		/*****************combo Idiomas******///
	$.getJSON("combos/combo_idiomas.php",function(resultado){
		
		$("#list_idiomas").html("<option value='' selected>Seleccione Idioma...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_idiomas").append("<option id='"+resultado[i].id_idioma+"' value='"+resultado[i].idioma+"'>"+resultado[i].idioma+"</option>");
		}
	
	});
	/**********************///
			/*****************combo Tipo de Monedas******///
	$.getJSON("combos/combo_monedas.php",function(resultado){
		
		$("#list_moneda").html("<option value='' selected>Seleccione Tipo de Moneda...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_moneda").append("<option id='"+resultado[i].id_moneda+"' value='"+resultado[i].moneda+"'>"+resultado[i].moneda+"</option>");
		}
	
	});
	/**********************///
	/*****************combo Cargos de empresas ******///
	$.getJSON("combos/combo_cargos.php",function(resultado){
		
		$("#list_cargo").html("<option value='' selected>Seleccione Cargo...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_cargo").append("<option id='"+resultado[i].id_cargo+"' value='"+resultado[i].cargo+"'>"+resultado[i].cargo+"</option>");
		}
	
	});
	/**********************///
	/*****************combo Tipo de Documento ******///
	$.getJSON("combos/combo_tipo_documento.php",function(resultado){
		
		$("#list_tipo_documento").html("<option value='' selected>Seleccione Tipo de Documento...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_tipo_documento").append("<option id='"+resultado[i].id_tipo_documento+"' value='"+resultado[i].tipo_documento+"'>"+resultado[i].tipo_documento+"</option>");
		}
	
	});
	/**********************///
	/*****************combo Producto Terminado ******///
	$.getJSON("combos/combo_producto_terminado.php",function(resultado){
		
		$("#list_producto_terminado").html("<option value='' selected>Seleccione el Producto...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_producto_terminado").append("<option id='"+resultado[i].id_producto+"' value='"+resultado[i].nombre_producto+"'>"+resultado[i].nombre_producto+"</option>");
		}
	
	});
		/*****************combo Producto Terminado ******///
	$.getJSON("combos/combo_producto_terminado.php",function(resultado){
		
		$("#list_prod_term_2").html("<option value='' selected>Seleccione el Producto...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_prod_term_2").append("<option id='"+resultado[i].id_producto+"' value='"+resultado[i].nombre_producto+"'>"+resultado[i].nombre_producto+"</option>");
		}
	
	});
	/**********************///
        	/*****************combo Producto OC ******///
	$.getJSON("combos/combo_productos_oc.php",function(resultado){
		
		$("#list_prod_term_oc").html("<option value='' selected>Seleccione el Producto...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_prod_term_oc").append("<option id='"+resultado[i].id_producto+"' value='"+resultado[i].nombre_producto+"'>"+resultado[i].nombre_producto+"</option>");
		}
	
	});
	/**********************///combo_productos_oc
	/*****************combo Centro de Ventas ******///
	$.getJSON("combos/combo_centro_venta.php",function(resultado){
		
		$("#centro_venta").html("<option value='' selected>Seleccione Centro de Venta...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#centro_venta").append("<option id='"+resultado[i].id_centro_venta+"' value='"+resultado[i].centro_venta+"'>"+resultado[i].centro_venta+"</option>");
		}	
	});
        
        /*****************combo Referencia ******///
	$.getJSON("combos/combo_referencia.php",function(resultado){
		
		$("#referencia").html("<option value='' selected>Seleccione Referencia...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#referencia").append("<option id='"+resultado[i].id_referencia+"' value='"+resultado[i].referencia+"'>"+resultado[i].referencia+"</option>");
		}	
	});
        
	/*****************combo Centro de Ventas Internacional******///
	$.getJSON("combos/combo_centro_venta2.php",function(resultado){
		
		$("#centro_venta2").html("<option value='' selected>Seleccione Centro de Venta...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#centro_venta2").append("<option id='"+resultado[i].id_centro_venta+"' value='"+resultado[i].centro_venta+"'>"+resultado[i].centro_venta+"</option>");
		}	
	});
		/*****************combo Cliente Internacional ******///
	$.getJSON("combos/combo_cliente_internacional.php",function(resultado){
		
		$("#id_cliente_internacional").html("<option value='0' selected>Seleccione Cliente...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#id_cliente_internacional").append("<option id='"+resultado[i].id_cliente+"' value='"+resultado[i].nombre+"'>"+resultado[i].nombre+"</option>");
		}	
	});
		/*****************combo Aduana ******///
	$.getJSON("combos/combo_aduanas.php",function(resultado){
		
		$("#lis_aduanas").html("<option value='0' selected>Seleccione Aduana...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#lis_aduanas").append("<option id='"+resultado[i].id_aduana+"' value='"+resultado[i].id_aduana+"'>"+resultado[i].nombre_aduana+"</option>");
		}	
	});
        	/*****************combo Suc _Aduana ******///
	$.getJSON("combos/combo_aduanas_suc.php",function(resultado){
		
		$("#lis_suc_aduanas").html("<option value='0' selected>Seleccione Sucursal/P.Embarque...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#lis_suc_aduanas").append("<option id='"+resultado[i].id_suc_aduanas+"' value='"+resultado[i].id_suc_aduanas+"'>"+resultado[i].direccion+"</option>");
		}	
	});
	/*****************combo Areas Egresos Internos******///
	$.getJSON("combos/combo_areas_egreso_pop.php",function(resultado){
		
		$("#list_areas").html("<option value='' selected>Seleccione Area...</option>");
		//alert ("pase");
		for(i=0;i<resultado.length;i++)
		{
			$("#list_areas").append("<option id='"+resultado[i].id_area+"' value='"+resultado[i].area+"'>"+resultado[i].area+"</option>");
		}
	
	});


});