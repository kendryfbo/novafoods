<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	
	if ($funcion==1)
	{
		$sql="SELECT MAX(numero_nota_credito) FROM nota_de_credito";	
		$ejecuta=mysql_query($sql,$conexion->link);
		$fila=mysql_fetch_array($ejecuta);
		echo $fila[0]+1;
	}
	else if ($funcion==2)
	{
		$id_Usuario=trim($_POST["id_Usuario"]);
		try
		{
			$sql3="INSERT INTO nota_de_credito(id_usuario)
			VALUES ('$id_Usuario')";
			$resultado=mysql_query($sql3,$conexion->link);
			$valor=mysql_insert_id();
			echo $valor;
		}
		catch (Exception $e)
		{    
		echo $e->getMessage();
		}
	}
	else if ($funcion==3)
	{
		$nota_credito=trim($_POST["nota_credito"]);
		$centro_venta=trim($_POST["centro_venta"]);
		$fecha_nota_venta=trim($_POST["fecha_nota_venta"]);
		$id_cliente_nacional=trim($_POST["id_cliente_nacional"]);
		$factura_nota_credito=trim($_POST["factura_nota_credito"]);
		$obs_nota_credito=trim($_POST["obs_nota_credito"]);
		$subtotal_nota=trim($_POST["subtotal_nota"]);
		$ila_nota=trim($_POST["ila_nota"]);
		$iva_nota=trim($_POST["iva_nota"]);
		$total_nota=trim($_POST["total_nota"]);
		$fecha_nota_venta=date("Y-m-d",strtotime($fecha_nota_venta));

		try{
			$sql1="UPDATE nota_de_credito	 
				set 		 
				id_centro_venta='".$centro_venta."',
				fecha_nota_venta='".$fecha_nota_venta."',
				numero_factura='".$factura_nota_credito."',
				observacion_nota_credito='".utf8_decode($obs_nota_credito)."',
				subtotal='".$subtotal_nota."',
				id_cliente='".$id_cliente_nacional."',
				total_ila='".$ila_nota."',
				total_iva='".$iva_nota."',
				total='".$total_nota."'
				where numero_nota_credito=".$nota_credito;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Nota de Credito Ingresada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==4)
	{
			
		$id_cliente_internacional=trim($_POST["id_cliente_internacional"]);
		$sql="select					
		cliente_internacional.direccion,
		paises.pais
		from cliente_internacional	
		inner join paises on paises.id_pais=cliente_internacional.id_pais
		WHERE cliente_internacional.id_cliente =".$id_cliente_internacional;			
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
				$salida[]=array("direccion"=>utf8_encode($fila[0]),"pais"=>utf8_encode($fila[1]));
			}
			echo json_encode($salida);
		}		
	}
	else if ($funcion==5)
	{	
		$sql="SELECT MAX(numero_nota_credito) FROM nota_de_credito_exportacion	";	
		$ejecuta=mysql_query($sql,$conexion->link);
		$fila=mysql_fetch_array($ejecuta);
		echo $fila[0]+1;
	}
	else if ($funcion==6)
	{
		$nota_credito=trim($_POST["nota_credito"]);
		$centro_venta=trim($_POST["centro_venta"]);
		$fecha_nota_venta=trim($_POST["fecha_nota_venta"]);
		$id_cliente_internacional=trim($_POST["id_cliente_internacional"]);
		$factura_nota_credito=trim($_POST["factura_nota_credito"]);
		$obs_nota_credito=trim($_POST["obs_nota_credito"]);
		$total_nota=trim($_POST["total_nota"]);
		$fecha_nota_venta=date("Y-m-d",strtotime($fecha_nota_venta));
		$tip_moneda=trim($_POST["tip_moneda"]);		

		try{
			$sql1="UPDATE nota_de_credito_exportacion	 
				set 		 
				id_centro_venta='".$centro_venta."',
				fecha_nota_venta='".$fecha_nota_venta."',
				numero_factura='".$factura_nota_credito."',
				observacion_nota_credito='".utf8_decode($obs_nota_credito)."',
				id_cliente='".$id_cliente_internacional."',
				id_tipo_moneda='".$tip_moneda."',
				total='".$total_nota."'
				where numero_nota_credito=".$nota_credito;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Nota de Credito Ingresada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==7)
	{
		$id_Usuario=trim($_POST["id_Usuario"]);
		try
		{
			$sql3="INSERT INTO nota_de_credito_exportacion(id_usuario)
			VALUES ('$id_Usuario')";
			$resultado=mysql_query($sql3,$conexion->link);
			$valor=mysql_insert_id();
			echo $valor;
		}
		catch (Exception $e)
		{    
		echo $e->getMessage();
		}
	}
	else if ($funcion==8)
	{
		$id_datalle_factura=trim($_POST["id_datalle_factura"]);
		$cantidad=trim($_POST["cantidad"]);
		$sql="select					
		id_datalle_nota_credito
		from detalle_nota_credito	
		WHERE id_datalle_nota_credito =".$id_datalle_factura;			
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{		 
			echo "1";
		}
		else
		{
			try
			{
				$sql="INSERT INTO detalle_nota_credito
				SELECT * FROM detalle_factura WHERE id_datalle_factura=".$id_datalle_factura;	
				$ejecuta=mysql_query($sql,$conexion->link);			

			}
			catch (Exception $e)
			{    
			echo $e->getMessage();
			}

			$sql3="select					
			precio,
			descuento,
			descuento_porcentaje
			from detalle_nota_credito	
			WHERE id_datalle_nota_credito =".$id_datalle_factura;			
			$ejecuta3=mysql_query($sql3,$conexion->link);
			$mensaje3=mysql_fetch_array($ejecuta3);

			$total=($mensaje3[0]*$cantidad);
			$descuento_valor=($total*$mensaje3[2])/100;
			$sql1="UPDATE detalle_nota_credito	 
						set 		 
						cantidad='".$cantidad."',
						total='".$total."',
						descuento='".$descuento_valor."',
						descuento_porcentaje='".$mensaje3[2]."'
					 	where id_datalle_nota_credito=".$id_datalle_factura;
			$resultado2=mysql_query($sql1,$conexion->link);	
		}
	}
	else if ($funcion==9)
	{
		$factura_nota_credito=trim($_POST["factura_nota_credito"]);
		$sql="select					
		numero_factura
		from facturas	
		WHERE numero_factura =".$factura_nota_credito;			
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{		 
			echo "1";
		}
		else
		{
			$sql1="select					
			numero_factura
			from nota_de_credito	
			WHERE numero_factura =".$factura_nota_credito;			
			$ejecuta1=mysql_query($sql1,$conexion->link);
			$numero_filas1 = mysql_num_rows($ejecuta1);
			if ($numero_filas1<>0)
			{		 
				echo "2";
			}
			else
			{
				echo "3";
			}
		}
	}
	else if ($funcion==10)
	{
		$factura=trim($_POST["factura"]);
		$sql="select
			detalle_nota_credito.id_datalle_nota_credito,
			productos.nombre_producto,
			detalle_nota_credito.cantidad,
			detalle_nota_credito.total,
			detalle_nota_credito.precio,
			productos.codigo_producto,
			descuento_porcentaje,
			descuento
			from detalle_nota_credito
			inner join productos on productos.id_producto=detalle_nota_credito.id_producto	
			WHERE detalle_nota_credito.factura =".$factura;					
		$resultado=mysql_query($sql,$conexion->link);
		while ($mensaje=mysql_fetch_array($resultado))
		{
			echo "<tr id=".$mensaje[0].">
					<td>".$mensaje[5]."</td>
					<td>".utf8_encode($mensaje[1])."</td>					
					<td >".$mensaje[2]."</td>
					<td>".$mensaje[4]."</td>
					<td>".$mensaje[3]."</td>
					<td>".$mensaje[6]."</td>
					<td>".$mensaje[7]."</td>
			</tr>";
		}
	}
	else if ($funcion==11)
	{
			$factura=trim($_POST["factura"]);
			$sql4="SELECT IFNULL((SELECT SUM( total ) FROM detalle_nota_credito WHERE factura='".$factura."' ) , 0) AS suma_bod";	
			$ejecuta4=mysql_query($sql4,$conexion->link);
			$mensaje4=mysql_fetch_array($ejecuta4);
			echo $mensaje4[0];
	}
	else if ($funcion==12)
	{
		$id_datalle_factura=trim($_POST["id_datalle_factura"]);
		$ila_factura=trim($_POST["ila_factura"]);	 
		$sql2="select marcas.ILA,detalle_nota_credito.id_producto
		from detalle_nota_credito
		inner join productos on productos.id_producto=detalle_nota_credito.id_producto
		inner join marcas on marcas.id_marca=productos.id_marca
		where detalle_nota_credito.id_datalle_nota_credito=".$id_datalle_factura;				
		$resultado2=mysql_query($sql2,$conexion->link);
		$mensaje2=mysql_fetch_array($resultado2);
		if ($mensaje2[0]<>"")
		{
			$sql1="select sum(total) as suma
				from detalle_nota_credito
				where id_datalle_nota_credito=".$id_datalle_factura;						
			$resultado1=mysql_query($sql1,$conexion->link);
			$mensaje1=mysql_fetch_array($resultado1);
	
			$sql4="select cantidad
				from tabla_impuestos_ventas
				where id='1' ";						
			$resultado4=mysql_query($sql4,$conexion->link);
			$mensaje4=mysql_fetch_array($resultado4);
		
			$ila=($mensaje1[0]*$mensaje4[0])/100;
			$ila=($ila+$ila_factura);
			echo $ila;
		}
		else
		{
			echo $ila_factura;
		}	
	}
        else if ($funcion==121)
	{
		//$numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $id_nc=trim($_POST["id_nc"]);
                /*
                $sql3="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                        //$sql2="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta;
			$resultado3=mysql_query($sql3,$conexion->link);
			while ($fila3 = mysql_fetch_array($resultado3))
			{
					//$numero_crl=$fila2[0]+1;
                                        $numero_crl=$fila3[0];
													
			}
                        //echo $numero_crl;
                */
		$sql2="select
					detalle_nota_credito.id_datalle_nota_credito,
					productos.nombre_producto,
					detalle_nota_credito.cantidad,
					detalle_nota_credito.total,
					detalle_nota_credito.precio,
					productos.codigo_producto,
					detalle_nota_credito.descuento,
					detalle_nota_credito.porcentaje,
					detalle_nota_credito.id_producto
					from detalle_nota_credito
					inner join productos on productos.id_producto=detalle_nota_credito.id_producto	
					WHERE detalle_nota_credito.id_nc=".$id_nc;
                                    //WHERE detalle_nota_venta.numero_nota_venta=".$numero_nota_venta." and detalle_nota_venta.id_centro_venta=".$centro_venta;
					//$sql="SELECT facturada FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			$prec=number_format($mensaje2[4], 0, '', '.');
                        $deslin=number_format($mensaje2[6], 0, '', '.');
                        $totlin=number_format($mensaje2[3], 0, '', '.');
                        
                        echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
			echo	"<td style='text-align:right'>".$prec."</td>";
			
			echo	"<td style='text-align:right'>".$mensaje2[7]." % </td>";
			echo	"<td style='text-align:right'>".$deslin." </td>";
                        echo	"<td style='text-align:right'>".$totlin."</td>";
								
			echo "</tr>";	
		}
	}
        else if ($funcion==1211)
	{
		//$numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $id_nc=trim($_POST["id_nc"]);
                /*
                $sql3="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                        //$sql2="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta;
			$resultado3=mysql_query($sql3,$conexion->link);
			while ($fila3 = mysql_fetch_array($resultado3))
			{
					//$numero_crl=$fila2[0]+1;
                                        $numero_crl=$fila3[0];
													
			}
                        //echo $numero_crl;
                */
		$sql2="select
					id_datalle_nota_credito,
					cantidad,
					total,
					precio,
					descuento,
					porcentaje,
					obs_gen
					from detalle_nota_credito
					WHERE id_nc=".$id_nc;
                                    //WHERE detalle_nota_venta.numero_nota_venta=".$numero_nota_venta." and detalle_nota_venta.id_centro_venta=".$centro_venta;
					//$sql="SELECT facturada FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			$prec=number_format($mensaje2[3], 0, '', '.');
                        $deslin=number_format($mensaje2[5], 0, '', '.');
                        $totlin=number_format($mensaje2[2], 0, '', '.');
                        
                        echo	"<tr>";
			echo	"<td>******</td>";
			echo	"<td>".utf8_encode($mensaje2[6])."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[1]."</td>";
			echo	"<td style='text-align:right'>".$prec."</td>";
			
			echo	"<td style='text-align:right'>".$mensaje2[4]." % </td>";
			echo	"<td style='text-align:right'>".$deslin." </td>";
                        echo	"<td style='text-align:right'>".$totlin."</td>";
								
			echo "</tr>";	
		}
	}
	else if ($funcion==13)
	{
		$nota_credito=trim($_POST["nota_credito"]);
                $centro_venta=trim($_POST["centro_venta"]);
		$sql="SELECT id_nc FROM nota_de_credito where numero_nota_credito=".$nota_credito." and id_centro_venta=".$centro_venta;	
		$ejecuta=mysql_query($sql,$conexion->link);
		//$fila=mysql_fetch_array($ejecuta);
                $id=0;
                while ($fila = mysql_fetch_array($ejecuta))
		{
			$id=$fila[0];
		}
                echo $id;
                /*
		if($nota_credito>$fila[0])
		{
			echo "1";
		}
		else if ($nota_credito==$fila[0])
		{
			echo "2";
		}		
		else if ($nota_credito<$fila[0])
		{
			echo "2";
		}*/
	}
        else if ($funcion==131)
	{
		$id=trim($_POST["id_nc"]);
                $sql1="select 
		nota_de_credito.numero_factura,
                referencia.referencia,
                nota_de_credito.observacion,
                nota_de_credito.subtotal,
                nota_de_credito.total_ila,
                nota_de_credito.total_iva,
                nota_de_credito.total
		from nota_de_credito 
                inner join referencia on referencia.id_referencia=nota_de_credito.referencia
		WHERE id_nc=".$id;
		$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			
			$salida[]=array("factura"=>$fila[0],"refer"=>utf8_encode($fila[1]),"obs"=>$fila[2]
                                ,"sub"=>$fila[3],"ila"=>$fila[4],"iva"=>$fila[5],"tot"=>$fila[6]);
		}
		echo json_encode($salida);
                //echo json_decode($salida);
	}
	else if ($funcion==14)
	{
		$nota_credito=trim($_POST["nota_credito"]);
		$sql="SELECT * FROM nota_de_credito where numero_nota_credito=".$nota_credito;	
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{		 
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==15)
	{
		$nota_credito=trim($_POST["nota_credito"]);
		$sql="select 
			centro_venta.centro_venta,
			DATE_FORMAT(nota_de_credito.fecha_nota_venta,'%d-%m-%Y'),
			cliente_nacional.nombre_cliente,
			nota_de_credito.numero_factura,
			nota_de_credito.observacion_nota_credito,
			nota_de_credito.subtotal,
			nota_de_credito.total_ila,
			nota_de_credito.total_iva,
			nota_de_credito.total
			from 
			nota_de_credito
			inner join centro_venta on centro_venta.id_centro_venta=nota_de_credito.id_centro_venta
			inner join cliente_nacional on cliente_nacional.id_cliente=nota_de_credito.id_cliente
			where nota_de_credito.numero_nota_credito=".$nota_credito;	
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
				$salida[]=array("centro_venta"=>utf8_encode($fila[0]),"fecha_nota_venta"=>$fila[1],"nombre_cliente"=>utf8_encode($fila[2])
					,"numero_factura"=>$fila[3],"observacion_nota_credito"=>utf8_encode($fila[4]),"subtotal"=>utf8_encode($fila[5])
					,"total_ila"=>utf8_encode($fila[6]),"total_iva"=>utf8_encode($fila[7]),"total"=>utf8_encode($fila[8]));
			}
			
			echo json_encode($salida);
		}
	}
?>