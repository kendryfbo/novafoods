<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$tipo_insp=trim($_POST["tipo_insp"]);
	$fecha_formulario=trim($_POST["fecha_formulario"]);
	$id_proveedor=trim($_POST["id_proveedor"]);
	$id_producto=trim($_POST["id_producto"]);
	$aspecto=trim($_POST["aspecto"]);
	$tot_recep=trim($_POST["tot_recep"]);
	$f_elab=trim($_POST["f_elab"]);
	$numero_orden_compra=trim($_POST["numero_orden_compra"]);
	$lote=trim($_POST["lote"]);
	$f_recep=trim($_POST["f_recep"]);
	$f_venc=trim($_POST["f_venc"]);
	$tam_muestra=trim($_POST["tam_muestra"]);
	$numero_fomulario=trim($_POST["numero_fomulario"]);		
	$fecha_formulario2=date("Y-m-d",strtotime($fecha_formulario));
	$f_elab2=date("Y-m-d",strtotime($f_elab));
	$f_recep2=date("Y-m-d",strtotime($f_recep));
	$f_venc2=date("Y-m-d",strtotime($f_venc));
	$id_bodega=trim($_POST["id_bodega"]);
	try
	{
		$sql3="UPDATE formulario_recepcion_materias_primas	 
			set 		 
			fecha_formulario='".$fecha_formulario2."',
			id_proveedor='".$id_proveedor."',
			id_producto='".$id_producto."',
			aspecto='".utf8_decode($aspecto)."',
			total_recepcionado='".$tot_recep."',
			fecha_elaboracion='".$f_elab2."',
			tipo_inspeccion='".utf8_decode($tipo_insp)."',
			numero_orden_compra='".$numero_orden_compra."',
			lote='".utf8_decode($lote)."',
			fecha_recepcion='".$f_recep2."',
			fecha_vencimiento='".$f_venc2."',
			tamano_muestra='".$tam_muestra."'
			where id_formulario_materia_prima=".$numero_fomulario;
		$resultado=mysql_query($sql3,$conexion->link);	

	}
		catch (Exception $e)
	{    
		echo $e->getMessage();
	}
	if ($tipo_insp=='muestra')
	{	
		$sql="select cantidad,id_pedido_orden_compra,numero_orden_compra from calidad
			where id_bodega=".$id_bodega;
		$resultado=mysql_query($sql,$conexion->link);
		while ($mensaje=mysql_fetch_array($resultado))
		{
			$sql5="select cantidad_faltante from detalle_productos_orden_compra
			where id_pedido_orden_compra=".$mensaje[1];
			$resultado5=mysql_query($sql5,$conexion->link);
			while ($mensaje5=mysql_fetch_array($resultado5))
			{
				$cantidad_nueva=$mensaje[0]-$tam_muestra;
				if ($cantidad_nueva==0)
				{
					$cantidad_faltante_nueva=$mensaje5[0]+$tam_muestra;					
					$sql4="UPDATE detalle_productos_orden_compra	 
					set 		 
					cantidad_ingresa=0,
					cantidad_faltante=".$cantidad_faltante_nueva.",
					id_estado_producto=13
					where id_pedido_orden_compra=".$mensaje[1];
					$resultado4=mysql_query($sql4,$conexion->link);
					
					$sql6="UPDATE orden_compra	 
					set 		 
					id_estado_orden_compra=5
					where numero_orden_compra=".$mensaje[2];
					$resultado6=mysql_query($sql6,$conexion->link);		

					$sql7="UPDATE calidad	  	
					set
					rechazada='si'
					WHERE id_bodega=".$id_bodega;
					$resultado7=mysql_query($sql7,$conexion->link);
				}
				else
				{
					$cantidad_faltante_nueva=$mensaje[0]-$tam_muestra;
					$sql3="UPDATE calidad	 
					set 		 
					cantidad=".$cantidad_faltante_nueva." where id_bodega=".$id_bodega;
					$resultado3=mysql_query($sql3,$conexion->link);
					
					$cantidad_nueva_sumada=$mensaje5[0]+$tam_muestra;					
					$sql4="UPDATE detalle_productos_orden_compra	 
					set 		 
					cantidad_ingresa=0,
					cantidad_faltante=".$cantidad_nueva_sumada.",
					id_estado_producto=13
					where id_pedido_orden_compra=".$mensaje[1];
					$resultado4=mysql_query($sql4,$conexion->link);
					
					$sql6="UPDATE orden_compra	 
					set 		 
					id_estado_orden_compra=5
					where numero_orden_compra=".$mensaje[2];
					$resultado6=mysql_query($sql6,$conexion->link);	
					
				}			
			}

		}

	}
	
	?>