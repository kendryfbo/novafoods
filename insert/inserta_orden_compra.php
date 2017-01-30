<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$id_proveedor=trim($_POST["id_proveedor"]);
		$id_area=trim($_POST["id_area"]);
		$id_moneda=trim($_POST["id_moneda"]);
		$descuento=trim($_POST["descuento"]);
		$numero_orden_compra=trim($_POST["numero_orden_compra"]);
		$id_tipo_proveedor=trim($_POST["id_tipo_proveedor"]);
		$exenta=trim($_POST["exenta"]);
		$fecha_orden_compra=$_POST["fecha_orden_compra"];
		$fecha2=date("Y-m-d",strtotime($fecha_orden_compra));
		
	  try{
			
			mysql_query("SET NAMES 'utf8'");
			$sql="INSERT INTO orden_compra (numero_orden_compra,id_proveedor,id_tipo_moneda,id_area,id_estado_orden_compra,id_tipo_proveedor,fecha_orden_compra,
			exenta,descuento)
			VALUES ('$numero_orden_compra','$id_proveedor','$id_moneda','$id_area','2','$id_tipo_proveedor','$fecha2','$exenta','$descuento')";
			$resultado=mysql_query($sql,$conexion->link);		
			
			$sql1="SELECT cantidad,cantidad_ingresa,cantidad_faltante,total,id_producto,numero_orden_compra,valor_unitario,id_estado_producto
					FROM temporal_detalle_productos_orden_compra
					where numero_orden_compra=".$numero_orden_compra;
			$resultado1=mysql_query($sql1,$conexion->link);
			while ($fila1 = mysql_fetch_array($resultado1))
			{
				$sql4="INSERT INTO detalle_productos_orden_compra (cantidad,cantidad_ingresa,cantidad_faltante,total,id_producto,numero_orden_compra,valor_unitario,id_estado_producto)
					VALUES ('$fila1[0]','$fila1[1]','$fila1[2]','$fila1[3]','$fila1[4]','$fila1[5]','$fila1[6]','$fila1[7]')";
				$resultado=mysql_query($sql4,$conexion->link);
			}
				/*mysql_query("SET NAMES 'utf8'");
				$sql1="UPDATE orden_compra	 
					set 		 
					id_proveedor='".$id_proveedor."',
					id_tipo_moneda='".$id_moneda."',
					id_area='".$id_area."',
					id_estado_orden_compra=2,
					id_tipo_proveedor='".$id_tipo_proveedor."',
					fecha_orden_compra='".$fecha2."',	
					exenta='".$exenta."',
					descuento='".$descuento."'
					where numero_orden_compra=".$numero_orden_compra;
					$resultado2=mysql_query($sql1,$conexion->link);	*/		
					echo " Orden de Compra Ingresada ".$numero_orden_compra;
				 
				
			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
	}
        else if ($funcion==11)
	{
		$fecha_oc=$_POST["fecha_oc"];
		$fecha1=date("Y-m-d",strtotime($fecha_oc));
                
                $fecha_despacho_oc=$_POST["fecha_despacho_oc"];
		$fecha2=date("Y-m-d",strtotime($fecha_despacho_oc));
                
                $id_proveedor=trim($_POST["id_proveedor"]);
                $cond_pago=trim($_POST["cond_pago"]);
                $id_moneda=trim($_POST["id_moneda"]);
		$id_area=trim($_POST["id_area"]);
		
		$subtotal=trim($_POST["subtotal"]);
		$descuento=trim($_POST["descuento"]);
		$porc_desc=trim($_POST["porc_desc"]);
                
                $neto=trim($_POST["neto"]);
                $iva=trim($_POST["iva"]);
                $rte=trim($_POST["rte"]);
                $total=trim($_POST["total"]);
                
                $honorario=trim($_POST["honorario"]);
		$exenta=trim($_POST["exenta"]);
                $id_Usuario=trim($_POST["id_Usuario"]);
                
                $sql2="SELECT MAX(numero_orden_compra	) FROM orden_compra";						
				$ejecuta2=mysql_query($sql2,$conexion->link);			
				$fila2 = mysql_fetch_array($ejecuta2);
				$crl=$fila2[0]+1;	
				//echo $valor;
		
		
	  try{
			
			mysql_query("SET NAMES 'utf8'");
			$sql="INSERT INTO orden_compra (numero_orden_compra,fecha_orden_compra,fecha_despacho_oc,id_proveedor,cond_pago,id_tipo_moneda,id_area,subtotal,descuento,porc_desc,neto,iva,rte,total,estado,id_usuario,exenta,honorario)
			VALUES ('$crl','$fecha1','$fecha2','$id_proveedor','$cond_pago','$id_moneda','$id_area','$subtotal','$descuento','$porc_desc','$neto','$iva','$rte','$total','0','$id_Usuario','$exenta','$honorario')";
			$resultado=mysql_query($sql,$conexion->link);		
			//temporal_det_oc
                        //echo$sql;
			$sql1="SELECT id_producto,cantidad,precio,total
					FROM temporal_det_oc    
					where id_usuario=".$id_Usuario;
			$resultado1=mysql_query($sql1,$conexion->link);
			while ($fila1 = mysql_fetch_array($resultado1))
			{
				$sql4="INSERT INTO detalle_oc (id_producto, cantidad,recibido,precio,total,id_oc)
					VALUES ('$fila1[0]','$fila1[1]','0','$fila1[2]','$fila1[3]','$crl')";
				$resultado=mysql_query($sql4,$conexion->link);
			}
                        $sql1="DELETE FROM temporal_det_oc	
			WHERE id_usuario=".$id_Usuario;
			$resultado1=mysql_query($sql1,$conexion->link);
                        
                        /*$sql1="SELECT cantidad,cantidad_ingresa,cantidad_faltante,total,id_producto,numero_orden_compra,valor_unitario,id_estado_producto
					FROM temporal_detalle_productos_orden_compra
					where numero_orden_compra=".$numero_orden_compra;
			$resultado1=mysql_query($sql1,$conexion->link);
			while ($fila1 = mysql_fetch_array($resultado1))
			{
				$sql4="INSERT INTO detalle_productos_orden_compra (cantidad,cantidad_ingresa,cantidad_faltante,total,id_producto,numero_orden_compra,valor_unitario,id_estado_producto)
					VALUES ('$fila1[0]','$fila1[1]','$fila1[2]','$fila1[3]','$fila1[4]','$fila1[5]','$fila1[6]','$fila1[7]')";
				$resultado=mysql_query($sql4,$conexion->link);
			}*/
				/*mysql_query("SET NAMES 'utf8'");
				$sql1="UPDATE orden_compra	 
					set 		 
					id_proveedor='".$id_proveedor."',
					id_tipo_moneda='".$id_moneda."',
					id_area='".$id_area."',
					id_estado_orden_compra=2,
					id_tipo_proveedor='".$id_tipo_proveedor."',
					fecha_orden_compra='".$fecha2."',	
					exenta='".$exenta."',
					descuento='".$descuento."'
					where numero_orden_compra=".$numero_orden_compra;
					$resultado2=mysql_query($sql1,$conexion->link);	*/		
					//echo " Orden de Compra Ingresada ".$numero_orden_compra;
                                        echo " Orden de Compra Ingresada ".$crl;
				 
				
			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
	}
        //aqui
         else if ($funcion==111)
	{
		$fecha_oc=$_POST["fecha_oc"];
		$fecha1=date("Y-m-d",strtotime($fecha_oc));
                
                $fecha_despacho_oc=$_POST["fecha_despacho_oc"];
		$fecha2=date("Y-m-d",strtotime($fecha_despacho_oc));
                
                $id_proveedor=trim($_POST["id_proveedor"]);
                $cond_pago=trim($_POST["cond_pago"]);
                $id_moneda=trim($_POST["id_moneda"]);
		$id_area=trim($_POST["id_area"]);
		
		$subtotal=trim($_POST["subtotal"]);
		$descuento=trim($_POST["descuento"]);
		$porc_desc=trim($_POST["porc_desc"]);
                
                $neto=trim($_POST["neto"]);
                $iva=trim($_POST["iva"]);
                $rte=trim($_POST["rte"]);
                $total=trim($_POST["total"]);
                
                $honorario=trim($_POST["honorario"]);
		$exenta=trim($_POST["exenta"]);
                $id_Usuario=trim($_POST["id_Usuario"]);
                $numero_oc=trim($_POST["numero_oc"]);
                
		
		
	  try{
			
			mysql_query("SET NAMES 'utf8'");
			$sql="update orden_compra set subtotal='$subtotal',descuento='$descuento',porc_desc='$porc_desc',neto='$neto',iva='$iva',rte='$rte',total='$total',exenta='$exenta',honorario='$honorario' where numero_orden_compra=".$numero_oc;
			$resultado=mysql_query($sql,$conexion->link);		
			
                        //$sql1="UPDATE cargos	 set 		 cargo='".utf8_decode($cargo)."' where id_cargo=".$id_cargo;
                        
                                        echo " Orden de Compra Nº".$numero_oc." Modificada!";
				 
				
			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
	}
	else if ($funcion==2)
	{
		$id_proveedor=trim($_POST["id_proveedor"]);
		$id_area=trim($_POST["id_area"]);
		$id_moneda=trim($_POST["id_moneda"]);
		$descuento=trim($_POST["descuento"]);
		$numero_orden_compra=trim($_POST["numero_orden_compra"]);
		$id_tipo_proveedor=trim($_POST["id_tipo_proveedor"]);
		$exenta=trim($_POST["exenta"]);
		$fecha_orden_compra=$_POST["fecha_orden_compra"];
		$fecha2=date("Y-m-d",strtotime($fecha_orden_compra));
		
	  try{
			
			mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE orden_compra	 
				set 		 
				id_proveedor='".$id_proveedor."',
				id_tipo_moneda='".$id_moneda."',
				id_area='".$id_area."',
				id_estado_orden_compra=2,
				id_tipo_proveedor='".$id_tipo_proveedor."',
				fecha_orden_compra='".$fecha2."',	
				exenta='".$exenta."',
				descuento='".$descuento."'
				where numero_orden_compra=".$numero_orden_compra;
			$resultado2=mysql_query($sql1,$conexion->link);	
			echo " Orden de Compra Actualizada ".$numero_orden_compra;
				 
				
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}

	}
        else if ($funcion==5)
	{
		$numero_oc=trim($_POST["numero_oc"]);
                //$centro_venta=trim($_POST["centro_venta"]);
		/*$sql2="SELECT MAX(id_temporal_nota_venta) FROM temporal_nota_venta";						
		$ejecuta2=mysql_query($sql2,$conexion->link);			
		$fila2 = mysql_fetch_array($ejecuta2);
		$valor=$fila2[0]+1;
		if ($numero_nota_venta < $valor)
		{*/
			$sql="SELECT estado FROM orden_compra where numero_orden_compra=".$numero_oc;						
			$ejecuta=mysql_query($sql,$conexion->link);			
			$fila = mysql_fetch_array($ejecuta);
			if ($fila[0]<>"")
			{
                                if($fila[0]==0){
                                    echo '1';
                                }
                                else if($fila[0]==1){
                                    echo '2';
                                }
                                else if($fila[0]==2){
                                    echo '3';
                                }
                                else if($fila[0]==3){
                                    echo '4';
                                }
			}
			
		/*}
		else 
		{
			echo '3';
		}*/
	}
        else if ($funcion==6)
	{
		$numero_oc=trim($_POST["numero_oc"]);
                //$centro_venta=trim($_POST["centro_venta"]);
		$sql="select 
				DATE_FORMAT(orden_compra.fecha_orden_compra,'%Y-%m-%d') as fecha,
                                DATE_FORMAT(orden_compra.fecha_despacho_oc,'%Y-%m-%d') as fecha,
				proveedor.rut,
				proveedor.nombre,
				proveedor.contacto1,
				condiciones_pago.Condicion,
				tipos_de_monedas.tipo_moneda,
				areas.area,
				orden_compra.subtotal,
				orden_compra.descuento,
				orden_compra.porc_desc,
				orden_compra.neto,
				orden_compra.iva,
				orden_compra.rte,
                                orden_compra.total,
                                orden_compra.estado,
                                orden_compra.exenta,
                                orden_compra.honorario
				from 
				orden_compra
				inner join proveedor on proveedor.id_proveedor=orden_compra.id_proveedor
				inner join condiciones_pago on condiciones_pago.id_condicion=orden_compra.cond_pago
                                inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=orden_compra.id_tipo_moneda
                                inner join areas on areas.id_area=orden_compra.id_area
				where orden_compra.numero_orden_compra=".$numero_oc;	
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{		 
			$salida[]=array("valor"=>1);
		 	echo json_encode($salida);
		}
		else
		{
			while ($fila = mysql_fetch_array($ejecuta))
			{
				$salida[]=array("fecha1"=>utf8_encode($fila[0]),"fecha2"=>utf8_encode($fila[1]),"rut"=>utf8_encode($fila[2]),
                                    "proveedor"=>$fila[3],"atencion"=>$fila[4],"Condicion"=>$fila[5],"moneda"=>$fila[6],"area"=>$fila[7],
                                    "subtot_oc"=>$fila[8],"desc"=>$fila[9],"por_desc"=>$fila[10],"net_oc"=>$fila[11],"iva_oc"=>$fila[12],
                                    "rte_oc"=>$fila[13],"total_oc"=>$fila[14],"estado"=>$fila[15],"exen"=>$fila[16],"hon"=>$fila[17]);
			}
			echo json_encode($salida);
                        /*
                         rut_proveedor
                        list_proveedor
                         atencion
                         * condicion_venta
                         * list_tip_mon
                         * list_areas
                         * 
                         * subtotal_oc
                         * desc_oc
                         * desc_por_oc
                         * neto_oc
                         * iva_oc
                         * ran_exenta
                         * ran_honorario
                         * honorario_oc
                         * total_oc
                         */
		}
	}
        else if ($funcion==7)
	{
		$numero_oc=trim($_POST["numero_oc"]);
                $status=trim($_POST["status"]);
                
               
                
		$sql2="select
					detalle_oc.id_detalle,
					productos.nombre_producto,
					detalle_oc.cantidad,
					detalle_oc.total,
					detalle_oc.precio,
					productos.codigo_producto,
                                        umed.umed
					from detalle_oc
					inner join productos on productos.id_producto=detalle_oc.id_producto	
                                        inner join umed on umed.id_umed=productos.id_umed	
					WHERE detalle_oc.id_oc=".$numero_oc;
                                    //WHERE detalle_nota_venta.numero_nota_venta=".$numero_nota_venta." and detalle_nota_venta.id_centro_venta=".$centro_venta;
					//$sql="SELECT facturada FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                                    $resultado2=mysql_query($sql2,$conexion->link);
                                    while ($mensaje2=mysql_fetch_array($resultado2))
                                    {						
                                            echo	"<tr id=".$mensaje2[0].">";
                                            echo	"<td>".utf8_encode($mensaje2[5])."</td>";
                                            echo	"<td>".utf8_encode($mensaje2[1])."</td>";
                                            echo	"<td>".utf8_encode($mensaje2[6])."</td>";
                                            echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
                                            echo	"<td style='text-align:right'>".$mensaje2[4]."</td>";
                                            echo	"<td style='text-align:right'>".$mensaje2[3]."</td>";
                                            
                                            if ($status==1)
                                            {
                                                
                                                    
                                                echo "<td></td>";

                                                    //echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).elimina_prod_detalle_nota_venta_modif(".$mensaje2[0].",".$numero_nota_venta.");' class='icon-editar info-tooltip'></a></td>";
                                            }
                                            else
                                            {
                                                    
                                                    echo "<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_oc2(".$numero_oc.",".$mensaje2[0].");'class='icon-borrar info-tooltip'></a></td>";
                                            }					
                                            echo "</tr>";	
                                    }
	}
?>	