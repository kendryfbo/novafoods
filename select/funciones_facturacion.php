<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
 	$funcion=trim($_POST["funcion"]);
	
	if ($funcion==1)
	{
		$num_nota_venta=trim($_POST["num_nota_venta"]);
		$sql="select Numero_nota_venta from  nota_venta  where Numero_nota_venta=".$num_nota_venta;	
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{
 			echo "1";	
		}
		else
		{	
			$fila=mysql_fetch_array($ejecuta);
			$sql1="select Numero_nota_venta from  nota_venta  where Numero_nota_venta=".$fila[0]." and ingresada='Si' and aceptada='' and rechazada='' ";	
			$ejecuta1=mysql_query($sql1,$conexion->link);
			$numero_filas1 = mysql_num_rows($ejecuta1);
	 		if ($numero_filas1==1)
			{
				echo "2";	
			}
			else
			{
				$sql2="select Numero_nota_venta from  nota_venta  where Numero_nota_venta=".$fila[0]." and ingresada='Si' and aceptada='' and rechazada='Si' ";	
				$ejecuta2=mysql_query($sql2,$conexion->link);
				$numero_filas2 = mysql_num_rows($ejecuta2);
				if ($numero_filas2==1)
				{
					echo "3";	
				}
				else
				{
					$sql2="select Numero_nota_venta from  nota_venta  where Numero_nota_venta=".$fila[0]." and ingresada='' and aceptada='' and rechazada='' ";	
					$ejecuta2=mysql_query($sql2,$conexion->link);
					$numero_filas2 = mysql_num_rows($ejecuta2);
					if ($numero_filas2==1)
					{
						echo "1";	
					}
					else
					{
						$sql2="select Numero_nota_venta from nota_venta where Numero_nota_venta=".$fila[0]." and ingresada='Si' and aceptada='Si' and rechazada='' ";	
						$ejecuta2=mysql_query($sql2,$conexion->link);
						$fila=mysql_fetch_array($ejecuta2);
						echo $fila[0];
					}
				}
			}	
		}
	}
	else if ($funcion==2)
	{
		$num_nota_venta=trim($_POST["num_nota_venta"]);
		$sql1="select 
		cliente_nacional.nombre_cliente,
		vendedores.vendedor,
		centro_venta.centro_venta,
		condiciones_pago.condicion,
		condiciones_pago.dias_de_condicion
		from nota_venta 
		inner join cliente_nacional on cliente_nacional.id_cliente=nota_venta.id_cliente
		inner join vendedores on vendedores.id_vendedor=nota_venta.id_vendedor
		inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
		inner join condiciones_pago on condiciones_pago.id_condicion=nota_venta.id_condicion
		WHERE nota_venta.numero_nota_venta =".$num_nota_venta;
		$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$fecha = date('d-m-Y');
			$nuevafecha = strtotime ( '+'.$fila[4].'day' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'd-m-Y' , $nuevafecha );
			$salida[]=array("cliente"=>$fila[0],"vendedor"=>$fila[1],"cc_venta"=>$fila[2],"c_pago"=>$fila[3],"fecha_venc"=>$nuevafecha);
		}
		echo json_encode($salida);
	}
	else if ($funcion==3)
	{
		$num_nota_venta=trim($_POST["num_nota_venta"]);
		$sql2="select
			detalle_nota_venta.id_detalle_nota_venta,
			productos.nombre_producto,
			detalle_nota_venta.cantidad,
			detalle_nota_venta.total,
			detalle_nota_venta.precio,
			productos.codigo_producto 
			from detalle_nota_venta
			inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
			WHERE detalle_nota_venta.numero_nota_venta =".$num_nota_venta." and ingresado_factura='' ";
					
		$resultado2=mysql_query($sql2,$conexion->link);			
		echo "<thead> 
					<tr>
						<th width='100'>
							Codigo	
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
							Seleccionar
						</th>
					</tr> 
				</thead>";
		while ($mensaje2=mysql_fetch_array($resultado2))
		{
			echo "<tbody>
						<tr id=".$mensaje2[0].">
							<td>".$mensaje2[5]."</td>
							<td>".utf8_encode($mensaje2[1])."</td>
							<td>".$mensaje2[2]."</td>
							<td>".$mensaje2[4]."</td>
							<td>".$mensaje2[3]."</td>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' id=".$mensaje2[3]." value=".$mensaje2[0]."></td>	
							<input type='hidden' id='num_nota_venta' value='$num_nota_venta'>
						</tr>					
					</tbody>";
		}
		echo "<tr>
				<td>
					<input type='submit' onClick='$(this).aceptar_productos_factura();' value='Seleccionar &raquo;'/> 
				</td>
			</tr>";
	}
	else if ($funcion==4)
	{
		$id_detalle_nota_venta=trim($_POST["id_detalle_nota_venta"]);
		$factura=trim($_POST["factura"]);

		$sql2="select id_producto,Cantidad,Precio,total,numero_nota_venta,descuento_procentaje,descuento from detalle_nota_venta where id_detalle_nota_venta=".$id_detalle_nota_venta;	
		$ejecuta2=mysql_query($sql2,$conexion->link);
		$fila=mysql_fetch_array($ejecuta2);
		
		$sql="UPDATE detalle_nota_venta	 
		set 		 
		ingresado_factura='Si'
		where id_detalle_nota_venta=".$id_detalle_nota_venta;
		$resultado=mysql_query($sql,$conexion->link);

		$sql3="INSERT INTO detalle_factura (factura,id_producto,cantidad,total,precio,descuento_porcentaje,descuento)
				VALUES ('$factura','$fila[0]','$fila[1]','$fila[3]','$fila[2]','$fila[5]','$fila[6]')";
		$resultado3=mysql_query($sql3,$conexion->link);

		$sql4="select
				detalle_nota_venta.id_detalle_nota_venta,
				productos.nombre_producto,
				detalle_nota_venta.cantidad,
				detalle_nota_venta.total,
				detalle_nota_venta.precio,
				productos.codigo_producto,
				detalle_nota_venta.descuento_procentaje,
				detalle_nota_venta.descuento 
				from detalle_nota_venta
				inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
				WHERE detalle_nota_venta.id_detalle_nota_venta =".$id_detalle_nota_venta;					
		$resultado4=mysql_query($sql4,$conexion->link);
		$mensaje2=mysql_fetch_array($resultado4);
		
		echo "<tr id=".$mensaje2[0].">
					<td>".$mensaje2[5]."</td>
					<td>".utf8_encode($mensaje2[1])."</td>
					<td>".$mensaje2[2]."</td>
					<td>".$mensaje2[4]."</td>
					<td>".$mensaje2[3]."</td>
					<td>".$mensaje2[6]."</td>
					<td>".$mensaje2[7]."</td>
				</tr>";
	}
	else if ($funcion==5)
	{
		$num_nota_venta=trim($_POST["num_nota_venta"]);		
		$factura=trim($_POST["factura"]);
		$subtotal=trim($_POST["subtotal"]);
		$ila=trim($_POST["ila"]);
		$iva=trim($_POST["iva"]);
		$total=trim($_POST["total"]);
		$factura=trim($_POST["factura"]);
		$fecha=date("y-m-d H:i:s");
	
		$sql5="select
			cantidad,
			id_producto
			from detalle_factura
			WHERE factura =".$factura;					
		$resultado5=mysql_query($sql5,$conexion->link);
		while ($mensaje5=mysql_fetch_array($resultado5))
		{
			$valor=($mensaje5[0]*-1);
			$sql4="INSERT INTO bodega_producto_terminado (cantidad,estado,id_producto,fecha_movimiento,factura)
				VALUES
				('$valor','e','$mensaje5[1]','$fecha','$factura')";
			$resultado4=mysql_query($sql4,$conexion->link);
		} 
	  try{		  
			$sql44="select
			id_centro_venta,
			id_cliente, 
			id_condicion,
			id_vendedor
			from nota_venta
			WHERE numero_nota_venta =".$num_nota_venta;					
		$resultado44=mysql_query($sql44,$conexion->link);
		$mensaje44=mysql_fetch_array($resultado44);
		
		$sql1="UPDATE facturas	 
				set 	
				numero_nota_venta='".$num_nota_venta."',
				id_cliente='".$mensaje44[1]."',
				id_centro_venta='".$mensaje44[0]."',
				total='".$total."',
				iva='".$iva."',
				sub_total='".$subtotal."',
				id_vendedor='".$mensaje44[3]."',
				id_condicion='".$mensaje44[2]."',
				total_ila='".$ila."'
				where numero_factura=".$factura;
		$resultado1=mysql_query($sql1,$conexion->link);

		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==6)
	{
		$factura=trim($_POST["factura"]);	
		$sql4="SELECT IFNULL((SELECT SUM(detalle_factura.total) FROM detalle_factura WHERE detalle_factura.factura=".$factura." ) , 0) AS total";
		$ejecuta4=mysql_query($sql4,$conexion->link);
		$fila4=mysql_fetch_array($ejecuta4);
		echo $fila4[0];
	}
	else if ($funcion==7)
	{
		$factura=trim($_POST["factura"]);
		$id_detalle_nota_venta=trim($_POST["id_detalle_nota_venta"]);
		$ila_factura=trim($_POST["ila"]);
		$sql3="select marcas.ILA,detalle_nota_venta.id_producto
			from detalle_nota_venta
			inner join productos on productos.id_producto=detalle_nota_venta.id_producto
			inner join marcas on marcas.id_marca=productos.id_marca
			where id_detalle_nota_venta=".$id_detalle_nota_venta;				
		$resultado3=mysql_query($sql3,$conexion->link);
		$mensaje3=mysql_fetch_array($resultado3);
		if ($mensaje3[0]<>"")
		{
			$sql1="select sum(total) as suma
				from detalle_factura
				where id_producto=".$mensaje3[1]. " and  factura=".$factura;						
			$resultado1=mysql_query($sql1,$conexion->link);
			$mensaje1=mysql_fetch_array($resultado1);

			$sql2="select cantidad
				from tabla_impuestos_ventas
				where id='1' ";						
			$resultado2=mysql_query($sql2,$conexion->link);
			$mensaje2=mysql_fetch_array($resultado2);

			$ila=($mensaje1[0]*$mensaje2[0])/100;
			$ila=$ila+$ila_factura;
			echo $ila;
		}
		else
		{
			echo $ila_factura;
		}
	}
	else if ($funcion==8)
	{
		$factura=trim($_POST["factura"]);
                $centro_venta=trim($_POST["centro_venta"]);
		$sql="select numero_factura
			from facturas			
			where numero_factura=".$factura." and id_centro_venta=".$centro_venta;				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo "1";
		}
		else
		{
			$sql1="select numero_factura
				from facturas			
				where numero_factura=".$factura. " and anulada='Si' ";				
			$resultado1=mysql_query($sql1,$conexion->link);
			$mensaje1=mysql_fetch_array($resultado1);
			if ($mensaje1[0]=="")
			{
				echo "2";
			}
			else
			{
				echo "3";
			}		
		}	
	}
	else if ($funcion==9)
	{
		//$numero_nota_venta=trim($_POST["numero_nota_venta"]);	
                $numero_nota_venta=trim($_POST["num_nota_venta"]);
		$factura=trim($_POST["factura"]);	
		$id_usuario=trim($_POST["id_usuario"]);
                $centro_venta=trim($_POST["centro_venta"]);
		$fecha=date("y-m-d H:i:s");
		try{

			$sql5="INSERT INTO facturas (numero_factura,numero_nota_venta,id_usuario,fecha_factura,id_centro_venta)
					VALUES ('$factura','$numero_nota_venta','$id_usuario','$fecha',$centro_venta)";
			$resultado5=mysql_query($sql5,$conexion->link);
			/*echo "Factura Ingresada Faltan Productos";*/

			$sql1="UPDATE nota_venta	 
				set 		 
				facturada='Si'
				where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
			$resultado1=mysql_query($sql1,$conexion->link);
                        
                        echo "Factura Nº".$factura." de ".$centro_venta." Grabada Exitosamente!";
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
        else if ($funcion==91)
	{
		//$numero_nota_venta=trim($_POST["numero_nota_venta"]);	
                $numero_nota_venta=trim($_POST["num_nota_venta"]);
		$factura=trim($_POST["factura"]);	
		$id_usuario=trim($_POST["id_usuario"]);
                $centro_venta=trim($_POST["centro_venta"]);
		$fecha=date("y-m-d H:i:s");
		try{
                        $existe=0;
			$sql5="Select * from facturas where numero_factura=".$factura." and id_centro_venta=".$centro_venta;
                        //$sql5="Select * from facturas where numero_factura=".$factura." and numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
			$resultado5=mysql_query($sql5,$conexion->link);
                        while ($fila = mysql_fetch_array($resultado5))
			{
				$existe=1;
			}
                        echo $existe;
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==10)
	{
		$num_proforma=trim($_POST["num_proforma"]);
		$sql="select numero_proforma from  proforma  where numero_proforma=".$num_proforma;	
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{
 			echo "1";	
		}
		else
		{	
			$sql1="select numero_proforma from proforma where numero_proforma=".$num_proforma." and ingresada='Si' and aceptada='' and rechazada=''";	
			$ejecuta1=mysql_query($sql1,$conexion->link);
			$numero_filas1 = mysql_num_rows($ejecuta1);
	 		if ($numero_filas1==1)
			{
				echo "2";	
			}
			else
			{
				$sql2="select numero_proforma from proforma where numero_proforma=".$num_proforma." and ingresada='Si' and aceptada='' and rechazada='Si'";	
				$ejecuta2=mysql_query($sql2,$conexion->link);
				$numero_filas2 = mysql_num_rows($ejecuta2);
				if ($numero_filas2==1)
				{
					echo "3";	
				}
				else
				{
					$sql2="select numero_proforma from proforma where numero_proforma=".$num_proforma." and ingresada='' and aceptada='' and rechazada=''";	
					$ejecuta2=mysql_query($sql2,$conexion->link);
					$numero_filas2 = mysql_num_rows($ejecuta2);
					if ($numero_filas2==1)
					{
						echo "1";	
					}
					else
					{
						$sql2="select numero_proforma from proforma where numero_proforma=".$num_proforma." and ingresada='Si' and aceptada='Si' and   facturada='Si'";	
						$ejecuta2=mysql_query($sql2,$conexion->link);
						$numero_filas2 = mysql_num_rows($ejecuta2);
						if ($numero_filas2==1)
						{
							echo "4";	
						}
						else
						{
							$sql2="select numero_proforma from proforma where numero_proforma=".$num_proforma." and ingresada='Si' and aceptada='Si' and rechazada=''";	
							$ejecuta2=mysql_query($sql2,$conexion->link);
							$fila=mysql_fetch_array($ejecuta2);
							//echo $fila[0];
                                                        echo "5";	
						}
					}
				}
			}	
		}
	}
	else if ($funcion==11)
	{
		$num_proforma=trim($_POST["num_proforma"]);
		$sql1="select cliente.nombre,
		cliente.direccion,
		paises.pais,
		proforma.medio_de_transporte,
		suc_aduanas.id_suc_aduanas,
		proforma.puerto_destino,			
		tipos_de_monedas.tipo_moneda,
		centro_venta.centro_venta,
		proforma.descripcion_mercaderia,	
		proforma.clausula_venta,
		proforma.forma_pago,
		proforma.freight,
		proforma.insurance,
		proforma.total,
		proforma.descuento,
		proforma.Subtotal,
                aduanas.id_aduana
		from proforma 
		inner join cliente on proforma.id_cliente=cliente.id_cliente
                inner join suc_aduanas on proforma.puerto_embarque=suc_aduanas.id_suc_aduanas
                inner join aduanas on aduanas.id_aduana=suc_aduanas.id_aduana
		inner join paises on paises.id_pais=cliente.pais
		inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=proforma.id_tipo_moneda
		inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
		WHERE proforma.numero_proforma =".$num_proforma;
		$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$salida[]=array("cliente"=>utf8_encode($fila[0]),"direccion"=>utf8_encode($fila[1]),"pais"=>utf8_encode($fila[2]),
				"medio_transporte"=>$fila[3],"p_embarque"=>utf8_encode($fila[4]),"p_destino"=>utf8_encode($fila[5]),"t_moneda"=>$fila[6],
				"cent_venta"=>$fila[7],"descripcion"=>utf8_encode($fila[8]),"claus_venta"=>$fila[9],"cond_pago"=>$fila[10],
				"freight"=>$fila[11],"insurance"=>$fila[12],"total"=>$fila[13],"descuento"=>$fila[14],"Subtotal"=>$fila[15],
                                "aduana"=>$fila[16]);
		}
		echo json_encode($salida);
	}
	else if ($funcion==12)
	{
		$num_proforma=trim($_POST["num_proforma"]);
		$sql4="select
			detalle_proforma.id_detalle_proforma,
			productos.nombre_producto,
			detalle_proforma.cantidad,
			detalle_proforma.total,
			detalle_proforma.precio,
			productos.codigo_producto
			from detalle_proforma
			inner join productos on productos.id_producto=detalle_proforma.id_producto	
			WHERE detalle_proforma.numero_proforma =".$num_proforma;					
		$resultado4=mysql_query($sql4,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado4))
		{
                    $pre=number_format($mensaje2[4], 2, '.', ',');
                    $tot=number_format($mensaje2[3], 2, '.', ',');
                    echo "<tr id=".$mensaje2[0].">
					<td>".$mensaje2[5]."</td>
					<td>".utf8_encode($mensaje2[1])."</td>
					<td style='text-align:right'>".$mensaje2[2]."</td>
					<td style='text-align:right'>".$pre."</td>
					<td style='text-align:right'>".$tot."</td>
				</tr>";
		}
	}
	else if ($funcion==13)
	{
		$factura=trim($_POST["factura"]);	
		$sql="select numero_factura
			from factura_internacional			
			where numero_factura=".$factura;				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo "1";
		}
		else
		{
			echo "2";
		}	
	}
	else if ($funcion==14)
	{
		$factura=trim($_POST["factura"]);	
		$num_proforma=trim($_POST["num_proforma"]);
		$fecha_factura_vcto=trim($_POST["fecha_factura_vcto"]);
		$fecha_factura=trim($_POST["fecha_factura"]);
		$fecha_factura=date("Y-m-d",strtotime($fecha_factura));
		$fecha_factura_vcto=date("Y-m-d",strtotime($fecha_factura_vcto));
		$fecha=date("y-m-d H:i:s");
 		try{
		
			$sql1="select total,id_cliente
			from proforma			
			where numero_proforma=".$num_proforma;				
			$resultado1=mysql_query($sql1,$conexion->link);
			$mensaje1=mysql_fetch_array($resultado1);	

			/*$sql5="UPDATE factura_internacional
				set	
				fecha_factura='".$fecha_factura."',
				fecha_vencimiento='".$fecha_factura_vcto."',
				id_cliente='".$mensaje1[1]."',
				total='".$mensaje1[0]."'
				where numero_factura=".$factura;					
			$resultado5=mysql_query($sql5,$conexion->link);*/
                        $sql5="INSERT INTO factura_internacional (numero_factura,numero_proforma,fecha_factura,fecha_vencimiento)
					VALUES ('$factura','$num_proforma','$fecha_factura','$fecha_factura_vcto')";
				$resultado5=mysql_query($sql5,$conexion->link);
                        /*
			$sql="select Cantidad,id_producto,total,precio
			from detalle_proforma			
			where numero_proforma=".$num_proforma;				
			$resultado=mysql_query($sql,$conexion->link);
			while ($mensaje=mysql_fetch_array($resultado))
			{	 
				$sql5="INSERT INTO detalle_factura_internacional (numero_factura,cantidad,id_producto,total,precio)
					VALUES ('$factura','$mensaje[0]','$mensaje[1]','$mensaje[2]','$mensaje[3]')";
				$resultado5=mysql_query($sql5,$conexion->link);
								
				$cantidad=$mensaje[0]*-1;
				$sql5="INSERT INTO bodega_producto_terminado (cantidad,estado,id_producto,fecha_movimiento,factura_internacional)
					VALUES ('$cantidad','e','$mensaje[1]','$fecha','$factura')";
				$resultado5=mysql_query($sql5,$conexion->link);

			}*/
			$sql1="UPDATE proforma	 
				set 		 
				facturada='Si'
				where numero_proforma=".$num_proforma;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Factura Ingresada Nº".$factura;
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==15)
	{	 
		$factura=trim($_POST["factura"]);
                $centro_venta=trim($_POST["centro_venta"]);
                /*$sql="select
			cliente_nacional.nombre_cliente,
			condiciones_pago.Condicion,
			centro_venta.centro_venta,
			vendedores.vendedor,
			condiciones_pago.dias_de_condicion,
			facturas.sub_total,
			facturas.iva,
			facturas.total,
			facturas.total_ila,
			facturas.numero_nota_venta
			from facturas
			inner join cliente_nacional on cliente_nacional.id_cliente=facturas.id_cliente	
			inner join condiciones_pago	 on condiciones_pago.id_condicion=facturas.id_condicion	
			inner join centro_venta	 on centro_venta.id_centro_venta=facturas.id_centro_venta
			inner join vendedores on vendedores.id_vendedor=facturas.id_vendedor		
			WHERE facturas.numero_factura =".$factura." and facturas.id_centro_venta=".$centro_venta;*/
		$sql="select numero_nota_venta
			from facturas
			WHERE numero_factura =".$factura." and id_centro_venta=".$centro_venta;					
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			/*$fecha = date('d-m-Y');
			$nuevafecha = strtotime ( '+'.$fila[4].'day' , strtotime ($fecha));
			$nuevafecha = date ( 'd-m-Y' , $nuevafecha );*/

			$salida[]=array("numero_nota_venta"=>$fila[0]);
                        /*$salida[]=array("cliente"=>utf8_encode($fila[0]),"Condicion"=>utf8_encode($fila[1]),"centro_venta"=>utf8_encode($fila[2]),
				"vendedor"=>utf8_encode($fila[3]),"dias_pago"=>$fila[4],"nuevafecha"=>$nuevafecha,"sub_total"=>$fila[5],"iva"=>$fila[6],
				"total"=>$fila[7],"total_ila"=>$fila[8],"numero_nota_venta"=>$fila[9]);*/
		}
		echo json_encode($salida);
	}
	else if ($funcion==16)
	{
		$factura=trim($_POST["factura"]);
		$sql="select
			detalle_factura.id_datalle_factura,
			productos.nombre_producto,
			detalle_factura.cantidad,
			detalle_factura.total,
			detalle_factura.precio,
			productos.codigo_producto,
			descuento_porcentaje,
			descuento
			from detalle_factura
			inner join productos on productos.id_producto=detalle_factura.id_producto	
			WHERE detalle_factura.factura =".$factura;					
		$resultado=mysql_query($sql,$conexion->link);
		while ($mensaje=mysql_fetch_array($resultado))
		{
			echo "<tr id=".$mensaje[0].">
					<td>".$mensaje[5]."</td>
					<td>".utf8_encode($mensaje[1])."</td>					
					<td ><input type='number' class='cantidad".$mensaje[0]."' min='0' max=".$mensaje[2]." value='0'>
					<div id='valida-cantidad_mayor".$mensaje[0]."' style='display:none' class='errores'>
							Debe Ingresar Cantidad Menor a la Solicitada
					</div>
					<div id='valida-cantidad_vacia".$mensaje[0]."' style='display:none' class='errores'>
							Debe Ingresar Cantidad
					</div>
					<div id='valida-prod_ext".$mensaje[0]."' style='display:none' class='errores'>
						Estos Productos ya Existen no se pueden volver a Ingresar
					</div>
					<div id='valida-cantidad_cero".$mensaje[0]."' style='display:none' class='errores'>
							Debe Ingresar Cantidad mayor a cero!!!!!!!
					</div>
					</td>
					<td>".$mensaje[4]."</td>
					<td>".$mensaje[3]."</td>
					<td>".$mensaje[6]."</td>
					<td>".$mensaje[7]."</td>
					<td>
						<div class='fright'> 
							<input type='submit' onClick='$(this).ingresa_producto_nota_credito(".$mensaje[0].",".$mensaje[2].");' value='Aceptar&raquo;'/> 
						</div>
					</td>
				</tr>";
		}
	}
	else if ($funcion==17)
	{
		$factura=trim($_POST["factura"]);
		$proforma=trim($_POST["proforma"]);	
		$fecha_factura=date("Y-m-d",strtotime($fecha_factura));

		$sql="INSERT INTO factura_internacional (numero_factura,numero_proforma)
					VALUES ('$factura','$proforma')";
		$resultado=mysql_query($sql,$conexion->link);
	}
	else if ($funcion==18)
	{
		$factura=trim($_POST["factura"]);
		$sql="select 
			factura_internacional.numero_proforma,
			DATE_FORMAT(fecha_factura,'%d-%m-%Y'),
			DATE_FORMAT(fecha_vencimiento,'%d-%m-%Y'),
			cliente_internacional.nombre_cliente,
			cliente_internacional.direccion,
			paises.pais,
			proforma.medio_de_transporte,
			proforma.puerto_embarque,
			proforma.puerto_destino,
			proforma.forma_pago,
			centro_venta.centro_venta,
			proforma.descripcion_mercaderia,
			proforma.Subtotal,
			proforma.freight,
			proforma.insurance,
			proforma.total,
			proforma.descuento,
			proforma.clausula_venta,
			tipos_de_monedas.tipo_moneda
			from 
			factura_internacional
			inner join cliente_internacional on cliente_internacional.id_cliente=factura_internacional.id_cliente
			inner join paises on paises.id_pais=cliente_internacional.id_pais
			inner join proforma on proforma.numero_proforma=factura_internacional.numero_proforma
			inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta	
			inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=proforma.id_tipo_moneda
			where factura_internacional.numero_factura=".$factura;	
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
				$salida[]=array("numero_proforma"=>$fila[0],"fecha_factura"=>$fila[1],"fecha_vencimiento"=>$fila[2],"nombre_cliente"=>utf8_encode($fila[3])
					,"direccion"=>utf8_encode($fila[4]),"pais"=>utf8_encode($fila[5]),"medio_de_transporte"=>utf8_encode($fila[6]),
					"puerto_embarque"=>utf8_encode($fila[7]),"puerto_destino"=>utf8_encode($fila[8]),"forma_pago"=>utf8_encode($fila[9]),
					"centro_venta"=>utf8_encode($fila[10]),"observacion"=>utf8_encode($fila[11]),
					"Subtotal"=>$fila[12],"freight"=>$fila[13],"insurance"=>$fila[14],"total"=>$fila[15],"descuento"=>$fila[16],
					"clausula_venta"=>$fila[17],"tipo_moneda"=>$fila[18]);
			}
			
			echo json_encode($salida);
		}
	}
	else if ($funcion==19)
	{
		$factura=trim($_POST["factura"]);
		$sql="select
			detalle_factura_internacional.id_detalle_factura,
			productos.nombre_producto,
			detalle_factura_internacional.cantidad,
			detalle_factura_internacional.total,
			detalle_factura_internacional.precio,
			productos.codigo_producto
			from detalle_factura_internacional
			inner join productos on productos.id_producto=detalle_factura_internacional.id_producto	
			WHERE detalle_factura_internacional.numero_factura =".$factura;					
		$resultado=mysql_query($sql,$conexion->link);
		while ($mensaje=mysql_fetch_array($resultado))
		{
			echo "<tr id=".$mensaje[0].">
					<td>".$mensaje[5]."</td>
					<td>".utf8_encode($mensaje[1])."</td>
					<td>".$mensaje[2]."</td>
					<td>".$mensaje[4]."</td>
					<td>".$mensaje[3]."</td>
				</tr>";
		}
	}
	else if ($funcion==20)
	{
		$factura=trim($_POST["factura"]);
		$sql="select
			detalle_factura.id_datalle_factura,
			productos.nombre_producto,
			detalle_factura.cantidad,
			detalle_factura.total,
			detalle_factura.precio,
			productos.codigo_producto,
			descuento_porcentaje,
			descuento
			from detalle_factura
			inner join productos on productos.id_producto=detalle_factura.id_producto	
			WHERE detalle_factura.factura =".$factura;					
		$resultado=mysql_query($sql,$conexion->link);
		while ($mensaje=mysql_fetch_array($resultado))
		{
			echo "<tr id=".$mensaje[0].">
					<td>".$mensaje[5]."</td>
					<td>".utf8_encode($mensaje[1])."</td>		
					<td>".$mensaje[2]."</td>	
					<td>".$mensaje[4]."</td>	
					<td>".$mensaje[3]."</td>
					<td>".$mensaje[6]."</td>	
					<td>".$mensaje[7]."</td>	
				</tr>";
		}
	}
	else if ($funcion==21)
	{
		$factura=trim($_POST["factura"]);
		$sql1="UPDATE facturas	 
				set 		 
				anulada='Si'
			where numero_factura=".$factura;
		$resultado2=mysql_query($sql1,$conexion->link);
	}
	else if ($funcion==22)
	{
		$factura=trim($_POST["factura"]);
		$sql1="UPDATE factura_internacional	 
				set 		 
				anulada='Si'
			where numero_factura=".$factura;
		$resultado2=mysql_query($sql1,$conexion->link);
	}
	else if ($funcion==23)
	{
		$factura=trim($_POST["factura"]);	
		$sql="select numero_factura
			from factura_internacional			
			where numero_factura=".$factura;				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo "1";
		}
		else
		{
			$sql1="select numero_factura
				from factura_internacional			
				where numero_factura=".$factura. " and anulada='Si' ";				
			$resultado1=mysql_query($sql1,$conexion->link);
			$mensaje1=mysql_fetch_array($resultado1);
			if ($mensaje1[0]=="")
			{
				echo "2";
			}
			else
			{
				echo "3";
			}		
		}	
		
	}
        else if ($funcion==24)
	{
		$factura=trim($_POST["factura"]);	
		$sql="select numero_proforma
			from factura_internacional			
			where numero_factura=".$factura;				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]<>"")
		{
			echo $mensaje[0];
		}
		/*else
		{
			echo "2";
		}	*/
	}
?>	