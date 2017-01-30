<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion==1)
	{
		$id_usuario=trim($_POST["id_usuario"]);
                $numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $centro_venta=trim($_POST["centro_venta"]);
                $factura=trim($_POST["factura"]);
                $referencia=trim($_POST["referencia"]);
                $observacion_nc=trim($_POST["observacion_nc"]);
                
                /* var stream="numero_nota_venta="++"&"+"="+centro_venta+"&"+"factura="++"&"+"="+referencia+"&"+"funcion="+1;                */
		try{
				$sql1="SELECT 
				detalle_nota_venta.Cantidad,
				detalle_nota_venta.id_producto,
				detalle_nota_venta.Precio,
				detalle_nota_venta.total,
				detalle_nota_venta.descuento_procentaje,
				detalle_nota_venta.descuento
				FROM detalle_nota_venta
                                inner join nota_venta on nota_venta.numero=detalle_nota_venta.crl_nota_venta
                                where nota_venta.numero_nota_venta=".$numero_nota_venta." and  nota_venta.id_centro_venta=".$centro_venta;
			$ejecuta1=mysql_query($sql1,$conexion->link);
			while ($fila1=mysql_fetch_array($ejecuta1))
			{
				$sql4="INSERT INTO temporal_detalle_nc (factura,nv,id_cv,Cantidad,id_producto,Precio,total,porcentaje,descuento,id_usuario,referencia,observacion)
				VALUES
				('$factura','$numero_nota_venta','$centro_venta',$fila1[0],'$fila1[1]','$fila1[2]','$fila1[3]','$fila1[4]','$fila1[5]','$id_usuario','$referencia','$observacion_nc')";
				$resultado4=mysql_query($sql4,$conexion->link);
			}
                        echo"Importado Exitosamente!";

		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		
                $id_usuario=trim($_POST["id_usuario"]);
                $centro_venta=trim($_POST["centro_venta"]);
		try{                
                    $sql="select					
                    referencia.referencia,
                    temporal_detalle_nc.factura,
                    temporal_detalle_nc.nv,
                    temporal_detalle_nc.observacion,
                    temporal_detalle_nc.obs_gen,
                    temporal_detalle_nc.precio
                    from temporal_detalle_nc
                    inner join referencia on referencia.id_referencia=temporal_detalle_nc.referencia
                    WHERE temporal_detalle_nc.id_usuario='".$id_usuario."' and temporal_detalle_nc.id_cv='".$centro_venta."'";	
                    mysql_query("SET NAMES 'UTF8'");
                    $ejecuta=mysql_query($sql,$conexion->link);
                    //$numero_filas = mysql_num_rows($ejecuta);
                    //$salida[]=array("valor"=>0);
                    /*if ($numero_filas==0)
                    {		 
                            $salida[]=array("valor"=>0);
                            echo json_encode($salida);
                    }
                    else
                    {*/
                            while ($fila = mysql_fetch_array($ejecuta))
                            {
                                    $salida[]=array("refer"=>$fila[0],"factu"=>$fila[1],"nv"=>$fila[2],"obs"=>$fila[3],"obsdes"=>$fila[4],"mondes"=>$fila[5]);
                                    //$salida[]=array("refer"=>utf8_encode($fila[0]),"factu"=>utf8_encode($fila[1]),"nv"=>utf8_encode($fila[2]),"obs"=>utf8_encode($fila[3]));
                                    /*$salida[]=array("nombre_cliente"=>utf8_encode($fila[0]),"centro_venta"=>utf8_encode($fila[1]),"sub_total"=>$fila[2]
                                            ,"iva"=>$fila[3],"total_ila"=>$fila[4],"total"=>$fila[5]);*/
                            }
                            echo json_encode($salida);
                   // }
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
                $exis=0;
		$sql2="select * from 
			nota_de_credito
			where numero_nota_credito=".$nota_credito." and id_centro_venta=".$centro_venta;                
			$ejecuta2=mysql_query($sql2,$conexion->link);
                        
		while ($fila = mysql_fetch_array($ejecuta2))
                            {
                                    $exis=1;
                            }
                echo $exis;
	}
	else if ($funcion==4)
	{
		$nota_credito=trim($_POST["nota_credito"]);
                $observacion_nc=trim($_POST["observacion_nc"]);
                $id_usuario=trim($_POST["id_usuario"]);
                $centro_venta=trim($_POST["centro_venta"]);
                $subtotal=trim($_POST["subtotal"]);
                $ila=trim($_POST["ila"]);
                $iva=trim($_POST["iva"]);
                $total=trim($_POST["total"]);
               
		try{                
                    $sql="select					
                    referencia.id_referencia,
                    temporal_detalle_nc.factura,
                    temporal_detalle_nc.nv,
                    temporal_detalle_nc.observacion,
                    temporal_detalle_nc.obs_gen
                    from temporal_detalle_nc
                    inner join referencia on referencia.id_referencia=temporal_detalle_nc.referencia
                    WHERE temporal_detalle_nc.id_usuario=".$id_usuario." and temporal_detalle_nc.id_cv=".$centro_venta;			
                    $ejecuta=mysql_query($sql,$conexion->link);
                    $numero_filas = mysql_num_rows($ejecuta);
                    while ($fila = mysql_fetch_array($ejecuta))
                    {
                        $referen=$fila[0];
                        $factura=$fila[1];
                        $obs=$fila[3];      
                        $obs_gen=$fila[4];      
                    }
                    
                    
                    $sql3="INSERT INTO nota_de_credito (numero_nota_credito,id_centro_venta,numero_factura,observacion,referencia,id_usuario,subtotal,total_ila,total_iva,total)
                        VALUES ('$nota_credito','$centro_venta','$factura','$obs','$referen','$id_usuario','$subtotal','$ila','$iva','$total')";
                    $resultado3=mysql_query($sql3,$conexion->link);
                            
                            //busca_cel
                            $sql2="select id_nc from 
                            nota_de_credito
                            where numero_nota_credito=".$nota_credito." and id_centro_venta=".$centro_venta;                
                            $ejecuta2=mysql_query($sql2,$conexion->link);
                            while ($fila = mysql_fetch_array($ejecuta2))
                            {
                                    $crl=$fila[0];
                            }
                    //graba_detalle
                    if($obs_gen<>""){
                        $sql4="select
                            temporal_detalle_nc.cantidad,
                            temporal_detalle_nc.id_producto,
                            temporal_detalle_nc.precio,
                            temporal_detalle_nc.total,
                            temporal_detalle_nc.porcentaje,
                            temporal_detalle_nc.descuento
                            from temporal_detalle_nc
                            inner join referencia on referencia.id_referencia=temporal_detalle_nc.referencia
                            WHERE temporal_detalle_nc.id_usuario=".$id_usuario." and temporal_detalle_nc.id_cv=".$centro_venta;			
                            $ejecuta4=mysql_query($sql4,$conexion->link);
                            //$numero_filas = mysql_num_rows($ejecuta4);
                            while ($fila4 = mysql_fetch_array($ejecuta4))
                            {
                                //$factura=$fila4[1];
                                //$obs=$fila4[3];

                                $sql5="INSERT INTO detalle_nota_credito (cantidad,id_producto,precio,total,porcentaje,descuento,id_nc,obs_gen)
                                VALUES ('1','0','$subtotal','$subtotal','0','0','$crl','$obs_gen')";
                                $resultado5=mysql_query($sql5,$conexion->link);
                            }
                    }else{
                        $sql4="select
                            temporal_detalle_nc.cantidad,
                            temporal_detalle_nc.id_producto,
                            temporal_detalle_nc.precio,
                            temporal_detalle_nc.total,
                            temporal_detalle_nc.porcentaje,
                            temporal_detalle_nc.descuento
                            from temporal_detalle_nc
                            inner join referencia on referencia.id_referencia=temporal_detalle_nc.referencia
                            WHERE temporal_detalle_nc.id_usuario=".$id_usuario." and temporal_detalle_nc.id_cv=".$centro_venta;			
                            $ejecuta4=mysql_query($sql4,$conexion->link);
                            //$numero_filas = mysql_num_rows($ejecuta4);
                            while ($fila4 = mysql_fetch_array($ejecuta4))
                            {
                                //$factura=$fila4[1];
                                //$obs=$fila4[3];

                                $sql5="INSERT INTO detalle_nota_credito (cantidad,id_producto,precio,total,porcentaje,descuento,id_nc)
                                VALUES ('$fila4[0]','$fila4[1]','$fila4[2]','$fila4[3]','$fila4[4]','$fila4[5]','$crl')";
                                $resultado5=mysql_query($sql5,$conexion->link);
                            }
                    }        
                            
                            
                    //Limpia temp
                    $sql6="delete from temporal_detalle_nc WHERE id_usuario=".$id_usuario." and id_cv=".$centro_venta; 
                    $resultado6=mysql_query($sql6,$conexion->link);
                                    
                            //echo json_encode($salida);
                            echo"Grabado Exitosamente!";
                    
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
                //echo"grabado";
	}
	else if ($funcion==5)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $centro_venta=trim($_POST["centro_venta"]);
		/*$sql2="SELECT MAX(id_temporal_nota_venta) FROM temporal_nota_venta";						
		$ejecuta2=mysql_query($sql2,$conexion->link);			
		$fila2 = mysql_fetch_array($ejecuta2);
		$valor=$fila2[0]+1;
		if ($numero_nota_venta < $valor)
		{*/
			$sql="SELECT facturada FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;						
			$ejecuta=mysql_query($sql,$conexion->link);			
			$fila = mysql_fetch_array($ejecuta);
			if ($fila[0]<>"")
			{
				echo '1';
			}
			else
			{ 
				$sql1="SELECT rechazada FROM nota_venta where numero_nota_venta=".$numero_nota_venta;						
				$ejecuta1=mysql_query($sql1,$conexion->link);			
				$fila1 = mysql_fetch_array($ejecuta1);
				if ($fila1[0]<>"")
				{
					echo '4';
				}
				else
				{
					echo '2';
				}
			}
		/*}
		else 
		{
			echo '3';
		}*/
	}
        else if ($funcion==51)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $centro_venta=trim($_POST["centro_venta"]);
                
                $sql="SELECT estado FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta." and estado=2";						
			$ejecuta=mysql_query($sql,$conexion->link);			
			$fila = mysql_fetch_array($ejecuta);
			if ($fila[0]<>"")
			{
				echo '2';
			}
			else
                        { 
                            echo '1';
                        }
                /*
		$sql2="SELECT MAX(id_temporal_nota_venta) FROM temporal_nota_venta";						
		$ejecuta2=mysql_query($sql2,$conexion->link);			
		$fila2 = mysql_fetch_array($ejecuta2);
		$valor=$fila2[0]+1;
		if ($numero_nota_venta < $valor)
		{
			$sql="SELECT facturada FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;						
			$ejecuta=mysql_query($sql,$conexion->link);			
			$fila = mysql_fetch_array($ejecuta);
			if ($fila[0]<>"")
			{
				echo '1';
			}
			else
			{ 
				$sql1="SELECT rechazada FROM nota_venta where numero_nota_venta=".$numero_nota_venta;						
				$ejecuta1=mysql_query($sql1,$conexion->link);			
				$fila1 = mysql_fetch_array($ejecuta1);
				if ($fila1[0]<>"")
				{
					echo '4';
				}
				else
				{
					echo '2';
				}
			}
		}
		else 
		{
			echo '3';
		}*/
	}
	else if ($funcion==6)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $centro_venta=trim($_POST["centro_venta"]);
		$sql="select 
				cliente.nombre,
				DATE_FORMAT(nota_venta.fecha_emision,'%Y-%m-%d') as fecha,
				centro_venta.centro_venta,
				nota_venta.orden_compra_externa,
				DATE_FORMAT(nota_venta.fecha_despacho,'%Y-%m-%d') as fecha,
				condiciones_pago.Condicion,
				cliente.rut,
				vendedores.vendedor,
				nota_venta.observacion_despacho,
				nota_venta.sub_total,
				nota_venta.iva,
				nota_venta.total,
				nota_venta.total_ila,
				nota_venta.version,
                                suc_clientes.id_suc_cliente,
                                cliente.id_cliente,
                                nota_venta.estado
				from 
				nota_venta
				inner join cliente on cliente.id_cliente=nota_venta.id_cliente
				inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
				inner join vendedores on vendedores.id_vendedor=nota_venta.id_vendedor
				inner join condiciones_pago on condiciones_pago.id_condicion=nota_venta.id_condicion
                                inner join suc_clientes on suc_clientes.id_suc_cliente=nota_venta.suc_cliente
				where nota_venta.numero_nota_venta=".$numero_nota_venta." and nota_venta.id_centro_venta=".$centro_venta;	
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
				$salida[]=array("cliente"=>utf8_encode($fila[0]),"fecha_nota_venta"=>$fila[1],"centro_venta"=>$fila[2],
				"orden_compra"=>$fila[3],"fecha_despacho"=>$fila[4],"Condicion"=>$fila[5],"rut"=>$fila[6],"vendedor"=>$fila[7],
                                    "observacion"=>$fila[8],"sub_total"=>$fila[9],"iva"=>$fila[10],"total"=>$fila[11],"ila"=>$fila[12],
                                    "version"=>$fila[13],"suc"=>$fila[14],"id_cliente"=>$fila[15],"estado"=>$fila[16]);
			}
			echo json_encode($salida);
		}
	}
	else if ($funcion==7)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql2="select
					detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					detalle_nota_venta.cantidad,
					detalle_nota_venta.total,
					detalle_nota_venta.precio,
					productos.codigo_producto,
					detalle_nota_venta.descuento,
					detalle_nota_venta.descuento_procentaje,
					ingresado_factura,
					nota_venta.facturada
					from detalle_nota_venta
					inner join nota_venta on nota_venta.numero_nota_venta=detalle_nota_venta.numero_nota_venta
					inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
					WHERE detalle_nota_venta.numero_nota_venta =".$numero_nota_venta;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".$mensaje2[4]."</td>";
			echo	"<td>".number_format($mensaje2[3])."</td>";
			echo	"<td>".$mensaje2[7]." % </td>";
			echo	"<td>".$mensaje2[6]." </td>";
			if ($mensaje2[9]<>'Si')
			{
				echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_nota_venta(".$mensaje2[0].",".$numero_nota_venta.");'class='icon-borrar info-tooltip'></a></td>";
				echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_nota_venta(".$mensaje2[0].",".$numero_nota_venta.");' class='icon-editar info-tooltip'></a></td>";
	
			}
			else
			{
				echo	"<td></td>";
			}			
			echo "</tr>";	
		}
	}	
	else if ($funcion==8)
	{
		$numero_nota_venta_usuario=trim($_POST["numero_nota_venta_usuario"]);
		$sql="select
		numero_nota_venta
		from nota_venta
		WHERE numero_nota_venta=".$numero_nota_venta_usuario;
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
	else if ($funcion==9)
	{
		$numero_nota_venta_usuario=trim($_POST["numero_nota_venta_usuario"]);
		$sql="SELECT 
			version,
			id_cliente,
			fecha_emision,
			id_centro_venta,
			id_vendedor,
			sub_total,
			iva,
			total,
			id_usuario,
			total_ila,
			fecha_despacho,
			id_condicion,
			observacion_despacho,
			id_nota_venta,
			orden_compra_externa
			FROM nota_venta where numero_nota_venta=".$numero_nota_venta_usuario. " order by id_nota_venta DESC  limit 1";
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila=mysql_fetch_array($ejecuta))
		{	
			$version=$fila[0]+1;
			$sql3="INSERT INTO nota_venta (numero_nota_venta,version,id_cliente,fecha_emision,id_centro_venta,id_vendedor,sub_total,iva,total,
			id_usuario,total_ila,fecha_despacho,id_condicion,observacion_despacho,orden_compra_externa)
			VALUES
			('$numero_nota_venta_usuario',$version,'$fila[1]','$fila[2]','$fila[3]','$fila[4]','$fila[5]','$fila[6]','$fila[7]','$fila[8]'
				,'$fila[9]','$fila[10]','$fila[11]','$fila[12]','$fila[14]')";
			$resultado=mysql_query($sql3,$conexion->link);
			$valor=mysql_insert_id();
			$sql1="SELECT 
				Cantidad,
				id_producto,
				Precio,
				total,
				descuento_procentaje,
				descuento
				FROM detalle_nota_venta where numero_nota_venta=".$fila[13];
			$ejecuta1=mysql_query($sql1,$conexion->link);
			while ($fila1=mysql_fetch_array($ejecuta1))
			{
				$sql4="INSERT INTO detalle_nota_venta (numero_nota_venta,Cantidad,id_producto,Precio,total,descuento_procentaje,descuento)
				VALUES
				('$valor',$fila1[0],'$fila1[1]','$fila1[2]','$fila1[3]','$fila1[4]','$fila1[5]')";
				$resultado4=mysql_query($sql4,$conexion->link);
			}
			$sql10="UPDATE nota_venta	 
				set 		 
				ingresada=''
				where id_nota_venta=".$fila[13];
			$resultado10=mysql_query($sql10,$conexion->link);
		}
	}
	else if ($funcion==10)
	{
		$numero_nota_venta_usuario=trim($_POST["numero_nota_venta_usuario"]);
		$sql1="SELECT 
				id_nota_venta
				FROM nota_venta where numero_nota_venta=".$numero_nota_venta_usuario. " order by id_nota_venta desc limit 1 ";
		$ejecuta1=mysql_query($sql1,$conexion->link);
		$fila1=mysql_fetch_array($ejecuta1);
		echo $fila1[0];
	}
	else if ($funcion==11)
	{
		$numero_nota_venta_usuario=trim($_POST["numero_nota_venta_usuario"]);
		$sql1="SELECT 
				version
				FROM nota_venta where numero_nota_venta=".$numero_nota_venta_usuario. " order by id_nota_venta desc limit 1 ";
		$ejecuta1=mysql_query($sql1,$conexion->link);
		$fila1=mysql_fetch_array($ejecuta1);
		echo $fila1[0];
	}
	else if ($funcion==12)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $centro_venta=trim($_POST["centro_venta"]);
                
                $sql3="SELECT numero,estado FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                        //$sql2="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta;
			$resultado3=mysql_query($sql3,$conexion->link);
			while ($fila3 = mysql_fetch_array($resultado3))
			{
					//$numero_crl=$fila2[0]+1;
                                        $numero_crl=$fila3[0];
                                        $estado=$fila3[1];
													
			}
                        //echo $numero_crl;
                
		$sql2="select
					detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					detalle_nota_venta.cantidad,
					detalle_nota_venta.total,
					detalle_nota_venta.precio,
					productos.codigo_producto,
					detalle_nota_venta.descuento,
					detalle_nota_venta.descuento_procentaje,
					detalle_nota_venta.id_producto
					from detalle_nota_venta
					inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
					WHERE detalle_nota_venta.crl_nota_venta=".$numero_crl;
                                    //WHERE detalle_nota_venta.numero_nota_venta=".$numero_nota_venta." and detalle_nota_venta.id_centro_venta=".$centro_venta;
					//$sql="SELECT facturada FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[4]."</td>";
			
			echo	"<td style='text-align:right'>".$mensaje2[7]." % </td>";
			echo	"<td style='text-align:right'>".number_format($mensaje2[6])." </td>";
                        echo	"<td style='text-align:right'>".number_format($mensaje2[3])."</td>";
			if ($mensaje2[9]<>'Si')
			{
                            if($estado<1){
                                echo "<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_nota_venta_modif(".$numero_nota_venta.",".$mensaje2[0].");'class='icon-borrar info-tooltip'></a></td>";
                            }
                            
				//echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).elimina_prod_detalle_nota_venta_modif(".$mensaje2[0].",".$numero_nota_venta.");' class='icon-editar info-tooltip'></a></td>";
			}
			else
			{
				echo "<td></td>";
			}					
			echo "</tr>";	
		}
	}
        else if ($funcion==121)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $centro_venta=trim($_POST["centro_venta"]);
                
                $sql3="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                        //$sql2="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta;
			$resultado3=mysql_query($sql3,$conexion->link);
			while ($fila3 = mysql_fetch_array($resultado3))
			{
					//$numero_crl=$fila2[0]+1;
                                        $numero_crl=$fila3[0];
													
			}
                        //echo $numero_crl;
                
		$sql2="select
					detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					detalle_nota_venta.cantidad,
					detalle_nota_venta.total,
					detalle_nota_venta.precio,
					productos.codigo_producto,
					detalle_nota_venta.descuento,
					detalle_nota_venta.descuento_procentaje,
					detalle_nota_venta.id_producto
					from detalle_nota_venta
					inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
					WHERE detalle_nota_venta.crl_nota_venta=".$numero_crl;
                                    //WHERE detalle_nota_venta.numero_nota_venta=".$numero_nota_venta." and detalle_nota_venta.id_centro_venta=".$centro_venta;
					//$sql="SELECT facturada FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[4]."</td>";
			
			echo	"<td style='text-align:right'>".$mensaje2[7]." % </td>";
			echo	"<td style='text-align:right'>".number_format($mensaje2[6])." </td>";
                        echo	"<td style='text-align:right'>".number_format($mensaje2[3])."</td>";
								
			echo "</tr>";	
		}
	}
	else if ($funcion==13)
	{
		$num_nota_venta=trim($_POST["num_nota_venta"]);
		$sql="INSERT INTO nota_venta_historica		
			SELECT *
			FROM nota_venta where numero_nota_venta=".$num_nota_venta;
		$ejecuta=mysql_query($sql,$conexion->link);		
		
		$sql2="SELECT 
				version
				FROM nota_venta where numero_nota_venta=".$num_nota_venta;
		$resultado2=mysql_query($sql2,$conexion->link);
		$mensaje2=mysql_fetch_array($resultado2);
		$version=($mensaje2[0]+1);

		$sql6="SELECT 
				*
				FROM detalle_nota_venta where numero_nota_venta=".$num_nota_venta;
		$resultado6=mysql_query($sql6,$conexion->link);
		while ($mensaje6=mysql_fetch_array($resultado6))
		{
			$sql1="INSERT INTO detalle_nota_venta_historica	
			(numero_nota_venta,Cantidad,id_producto,Precio,total,ingresado_factura,descuento_procentaje,descuento)
			values
			('$mensaje6[1]','$mensaje6[2]','$mensaje6[3]','$mensaje6[4]','$mensaje6[5]','$mensaje6[6]','$mensaje6[7]','$mensaje6[8]')";	
			$ejecuta1=mysql_query($sql1,$conexion->link);
			$valor=mysql_insert_id();
			$sql3="UPDATE detalle_nota_venta_historica	 
					set 		 
					version=".$mensaje2[0].
					" where id_detalle_nota_venta=".$valor;
			$resultado3=mysql_query($sql3,$conexion->link);
		}
		$sql3="UPDATE nota_venta	 
					set 		 
					version=".$version.
					" where numero_nota_venta=".$num_nota_venta;
		$resultado3=mysql_query($sql3,$conexion->link);
					
		$sql3="UPDATE detalle_nota_venta_historica	 
					set 		 
					version=".$mensaje2[0].
					" where id_detalle_nota_venta=".$mensaje6[0];
		$resultado3=mysql_query($sql3,$conexion->link);
		echo $version;		
	}
	else if ($funcion==14)
	{
		$numero_nota_venta_antiguo=trim($_POST["numero_nota_venta_antiguo"]);
		$fecha_nota_venta=trim($_POST["fecha_nota_venta"]);
		$id_centro_venta=trim($_POST["id_centro_venta"]);
		$id_cliente_nacional=trim($_POST["id_cliente_nacional"]);
		$fecha_despacho_nota_venta=trim($_POST["fecha_despacho_nota_venta"]);
		$id_condicion_venta=trim($_POST["id_condicion_venta"]);
		$observacion_despacho=trim($_POST["observacion_despacho"]);
		$subtotal=trim($_POST["subtotal"]);
		$ila=trim($_POST["ila"]);
		$iva=trim($_POST["iva"]);
		$total_nota_venta=trim($_POST["total_nota_venta"]);
		$id_vendedor=trim($_POST["id_vendedor"]);
		$fecha_nota_venta_2=date("Y-m-d",strtotime($fecha_nota_venta));
		$fecha_despacho_nota_venta_2=date("Y-m-d",strtotime($fecha_despacho_nota_venta));
		$orden_compra=trim($_POST["orden_compra"]);
		$version=trim($_POST["version"]);	
		$numero_nota_venta_nuevo=trim($_POST["numero_nota_venta_nuevo"]);	
		$sql1="UPDATE nota_venta	 
					set 		 
					id_cliente='".$id_cliente_nacional."',
					fecha_emision='".$fecha_nota_venta_2."',
					id_centro_venta='".$id_centro_venta."',
					sub_total='".$subtotal."',
					iva='".$iva."',
					total='".$total_nota_venta."',
					total_ila='".$ila."',
					id_vendedor='".$id_vendedor."',
					version='".$version."',
					orden_compra_externa='".$orden_compra."',
					ingresada='Si',
					fecha_despacho='".$fecha_despacho_nota_venta_2."',
					id_condicion='".$id_condicion_venta."',
					observacion_despacho='".utf8_decode($observacion_despacho)."'
					where id_nota_venta=".$numero_nota_venta_nuevo;
		$resultado2=mysql_query($sql1,$conexion->link);			
		$sql2="select 
					numero_nota_venta,
					Cantidad,
					id_producto,
					Precio,
					total
					from detalle_nota_venta
					where numero_nota_venta=".$numero_nota_venta_nuevo;
		$ejecuta2=mysql_query($sql2,$conexion->link);
		 
		while ($fila2=mysql_fetch_array($ejecuta2))
		{
			$cantidad=$fila2[1]*-1;
			$fecha=date("y-m-d H:i:s");
			$sql3="INSERT INTO bodega_producto_terminado (cantidad,estado,id_producto,fecha_movimiento,Numero_nota_venta)
			VALUES ('$cantidad','e','$fila2[2]','$fecha','$numero_nota_venta_nuevo')";
			$resultado3=mysql_query($sql3,$conexion->link);
		}
			$sql="DELETE FROM bodega_producto_terminado	
			WHERE Numero_nota_venta=".$numero_nota_venta_antiguo;
			$resultado2=mysql_query($sql,$conexion->link);	
		echo "Nota de Venta Ingresada Ingresada"; 
	}
	else if ($funcion==15)
	{
		$fecha=date("y-m-d H:i:s");
		$numero_nota_venta_usuario=trim($_POST["numero_nota_venta_usuario"]);
		$sql="SELECT 
			version,
			id_cliente,
			fecha_emision,
			id_centro_venta,
			id_vendedor,
			sub_total,
			iva,
			total,
			id_usuario,
			total_ila,
			fecha_despacho,
			id_condicion,
			observacion_despacho,
			id_nota_venta,
			orden_compra_externa
			FROM nota_venta where numero_nota_venta=".$numero_nota_venta_usuario. " order by id_nota_venta DESC  limit 1";
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila=mysql_fetch_array($ejecuta))
		{				
			$sql5="DELETE FROM bodega_producto_terminado	
			WHERE Numero_nota_venta=".$fila[13];
			$resultado5=mysql_query($sql5,$conexion->link);	

			$version=$fila[0]+1;
			$sql3="INSERT INTO nota_venta (numero_nota_venta,version,id_cliente,fecha_emision,id_centro_venta,id_vendedor,sub_total,iva,total,
			id_usuario,total_ila,fecha_despacho,id_condicion,observacion_despacho,orden_compra_externa)
			VALUES
			('$numero_nota_venta_usuario',$version,'$fila[1]','$fila[2]','$fila[3]','$fila[4]','$fila[5]','$fila[6]','$fila[7]','$fila[8]'
				,'$fila[9]','$fila[10]','$fila[11]','$fila[12]','$fila[14]')";
			$resultado=mysql_query($sql3,$conexion->link);
			$valor=mysql_insert_id();
			$sql1="SELECT 
				Cantidad,
				id_producto,
				Precio,
				total,
				descuento_procentaje,
				descuento
				FROM detalle_nota_venta where numero_nota_venta=".$fila[13];
			$ejecuta1=mysql_query($sql1,$conexion->link);
			while ($fila1=mysql_fetch_array($ejecuta1))
			{
				$sql4="INSERT INTO detalle_nota_venta (numero_nota_venta,Cantidad,id_producto,Precio,total,descuento_procentaje,descuento)
				VALUES
				('$valor',$fila1[0],'$fila1[1]','$fila1[2]','$fila1[3]','$fila1[4]','$fila1[5]')";
				$resultado4=mysql_query($sql4,$conexion->link);
				$cantidad=$fila1[0]*-1;
				$sql4="INSERT INTO bodega_producto_terminado (Cantidad,estado,id_producto,fecha_movimiento,Numero_nota_venta)
				VALUES
				($cantidad,'e','$fila1[1]','$fecha','$valor')";
				$resultado4=mysql_query($sql4,$conexion->link);
			}
			$sql10="UPDATE nota_venta	 
				set 		 
				ingresada=''
				where id_nota_venta=".$fila[13];
			$resultado10=mysql_query($sql10,$conexion->link);
		}
	}
	else if ($funcion==16)
	{
		$id_nota_venta=trim($_POST["id_nota_venta"]);
		$numero_nota_venta_usuario=trim($_POST["numero_nota_venta_usuario"]);
		$sql2="select
					detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					detalle_nota_venta.cantidad,
					detalle_nota_venta.total,
					detalle_nota_venta.precio,
					productos.codigo_producto,
					detalle_nota_venta.descuento,
					detalle_nota_venta.descuento_procentaje,
					detalle_nota_venta.id_producto,
					nota_venta.facturada
					from detalle_nota_venta
					inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
					inner join nota_venta on nota_venta.id_nota_venta=detalle_nota_venta.numero_nota_venta
					WHERE detalle_nota_venta.numero_nota_venta =".$id_nota_venta;
				
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".$mensaje2[4]."</td>";
			echo	"<td>".number_format($mensaje2[3])."</td>";
			echo	"<td>".$mensaje2[7]." % </td>";
			echo	"<td>".$mensaje2[6]." </td>";
			if ($mensaje2[9]<>'Si')
			{
				echo	"<td><a href='#' title='Borrar Informacion' 
				onClick='$(this).elimina_prod_detalle_nota_venta(".$mensaje2[0].",".$numero_nota_venta_usuario.");'class='icon-borrar info-tooltip'></a></td>";	
				echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_nota_venta(".$mensaje2[0].",".$numero_nota_venta_usuario.");' class='icon-editar info-tooltip'></a></td>";
			}
			else
			{
				echo	"<td></td>";
			}	
			echo "</tr>";		
		}
	}
	else if ($funcion==17)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$id_Usuario=trim($_POST["id_Usuario"]);
		$sql3="INSERT INTO nota_venta (id_usuario)
			VALUES
			('$id_Usuario')";
		$resultado=mysql_query($sql3,$conexion->link);
		$valor=mysql_insert_id();
		echo $valor;
	}
	else if ($funcion==18)
	{
		$id_lista_precio=trim($_POST["id_lista_precio"]);
                //echo$id_lista_precio;
		$sql2="select	lista_precio_nacional.id_lista,
				productos.nombre_producto,
				lista_precio_nacional.precio
					from lista_precio_nacional
					inner join productos on productos.id_producto=lista_precio_nacional.id_producto	
					WHERE lista_precio_nacional.tipo_lista =".$id_lista_precio." order by productos.nombre_producto Asc ";			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td  id=".$mensaje2[0]." >".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td><a href='#' onClick='$(this).actualizar_precio();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";	
			echo "</tr>";	
		}
                /*$id_lista_precio=trim($_POST["id_lista_precio"]);
		$sql2="select					
					lista_precio_nacional.id_lista,
					productos.nombre_producto,
					lista_precio_nacional.precio
					from lista_precio_nacional
					inner join productos on productos.id_producto=lista_precio_nacional.id_producto	
					WHERE lista_precio_nacional.Numero_lista =".$id_lista_precio." order by productos.nombre_producto Asc ";			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td  id=".$mensaje2[0]." >".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td><a href='#' onClick='$(this).actualizar_precio();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";	
			echo "</tr>";	
		}*/
	}
	else if ($funcion==19)
	{
		$id_lista=trim($_POST["id_lista"]);
		$sql="select					
					precio
					from lista_precio_nacional
					WHERE id_lista=".$id_lista;			
		$resultado=mysql_query($sql,$conexion->link);
		$fila=mysql_fetch_array($resultado);
		echo $fila[0];		
	}
	else if ($funcion==20)
	{
		$id_lista=trim($_POST["id_lista"]);
		$precio=trim($_POST["precio"]);
		$id_Usuario=trim($_POST["id_Usuario"]);	
		$sql="UPDATE lista_precio_nacional	 
		set 		 
		precio=".$precio.", 
		id_usuario_modicador=".$id_Usuario." 
		where id_lista=".$id_lista;
		$resultado=mysql_query($sql,$conexion->link);

		$sql1="select					
		precio
		from lista_precio_nacional
		WHERE id_lista =".$id_lista;			
		$resultado1=mysql_query($sql1,$conexion->link);
		$mensaje1=mysql_fetch_array($resultado1);
		echo $mensaje1[0];
	}
	else if ($funcion==21)
	{
		$factura_nota_credito=trim($_POST["factura_nota_credito"]);
		$sql="select					
		cliente_nacional.nombre_cliente,
		centro_venta.centro_venta,
		facturas.sub_total,
		facturas.iva,
		facturas.total_ila,
		facturas.total
		from facturas
		inner join cliente_nacional on cliente_nacional.id_cliente=facturas.id_cliente
		inner join centro_venta on centro_venta.id_centro_venta=facturas.id_centro_venta
		WHERE facturas.numero_factura =".$factura_nota_credito;			
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
				$salida[]=array("nombre_cliente"=>utf8_encode($fila[0]),"centro_venta"=>utf8_encode($fila[1]),"sub_total"=>$fila[2]
					,"iva"=>$fila[3],"total_ila"=>$fila[4],"total"=>$fila[5]);
			}
			echo json_encode($salida);
		}
	}
	else if ($funcion==22)
	{
		$factura_nota_credito=trim($_POST["factura_nota_credito"]);
		$sql="SELECT cliente.nombre,
                    cliente.direccion,
                    paises.pais,
                    proforma.total, 
                    centro_venta.centro_venta,
                    tipos_de_monedas.tipo_moneda
                    FROM factura_internacional
                    INNER JOIN proforma ON proforma.numero_proforma = factura_internacional.numero_proforma
                    INNER JOIN cliente ON cliente.id_cliente = proforma.id_cliente
                    INNER JOIN paises ON paises.id_pais = cliente.pais
                    INNER JOIN centro_venta ON centro_venta.id_centro_venta = proforma.id_centro_venta
                    inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=proforma.id_tipo_moneda
                    WHERE factura_internacional.numero_factura=".$factura_nota_credito;
                /*
                $sql="select					
		cliente.nombre,
		cliente.direccion,
		paises.pais,
		factura_internacional.total,
		centro_venta.centro_venta,
		tipos_de_monedas.tipo_moneda
		from factura_internacional
		inner join cliente on cliente.id_cliente=proforma.id_cliente
		inner join paises on paises.id_pais=cliente.pais
		inner join proforma on proforma.numero_proforma=factura_internacional.numero_proforma
		inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
		inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=proforma.id_tipo_moneda
		WHERE factura_internacional.numero_factura =".$factura_nota_credito;                 */
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
				//$salida[]=array("nombre_cliente"=>utf8_encode($fila[0]),"direccion"=>utf8_encode($fila[1]),"total"=>$fila[3],"centro_venta"=>$fila[4]);
                                $salida[]=array("nombre_cliente"=>utf8_encode($fila[0]),"direccion"=>utf8_encode($fila[1]),"pais"=>utf8_encode($fila[2])
					,"total"=>$fila[3],"centro_venta"=>$fila[4],"tipo_moneda"=>$fila[5]);
			}
			echo json_encode($salida);
		}
	}
	else if ($funcion==23)
	{
		$id_detalle_nota_venta=trim($_POST["id_detalle_nota_venta"]);
		$sql="select					
		temporal_detalle_nota_venta.Cantidad,
		temporal_detalle_nota_venta.Precio,
		productos.nombre_producto,
		temporal_detalle_nota_venta.descuento_procentaje,
		temporal_detalle_nota_venta.id_producto
		from temporal_detalle_nota_venta		
		inner join productos on temporal_detalle_nota_venta.id_producto=productos.id_producto
		WHERE temporal_detalle_nota_venta.id_detalle_nota_venta=".$id_detalle_nota_venta;			
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
		   $salida[]=array("Cantidad"=>$fila[0],"Precio"=>$fila[1],"nombre_producto"=>utf8_encode($fila[2]),"descuento"=>$fila[3],"id_producto"=>$fila[4]);
		}		
		$sql1="delete from temporal_detalle_nota_venta WHERE id_detalle_nota_venta=".$id_detalle_nota_venta;			
		$ejecuta1=mysql_query($sql1,$conexion->link);
		echo json_encode($salida);
	}
	else if ($funcion==24)
	{
		$id_detalle_proforma=trim($_POST["id_detalle_proforma"]);
		$sql="select					
		detalle_proforma.Cantidad,
		detalle_proforma.Precio,
		productos.nombre_producto
		from detalle_proforma		
		inner join productos on detalle_proforma.id_producto=productos.id_producto
		WHERE detalle_proforma.id_detalle_proforma=".$id_detalle_proforma;			
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
		   $salida[]=array("Cantidad"=>$fila[0],"Precio"=>$fila[1],"nombre_producto"=>utf8_encode($fila[2]));
		}		
		$sql1="delete from detalle_proforma WHERE id_detalle_proforma=".$id_detalle_proforma;			
		$ejecuta1=mysql_query($sql1,$conexion->link);
		echo json_encode($salida);
	}
	else if ($funcion==25)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql2="select
					detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					detalle_nota_venta.cantidad,
					detalle_nota_venta.total,
					detalle_nota_venta.precio,
					productos.codigo_producto,
					detalle_nota_venta.descuento,
					detalle_nota_venta.descuento_procentaje,
					detalle_nota_venta.id_producto,
					nota_venta.facturada
					from detalle_nota_venta
					inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
					inner join nota_venta on nota_venta.numero_nota_venta=detalle_nota_venta.numero_nota_venta	
					WHERE detalle_nota_venta.numero_nota_venta =".$numero_nota_venta;					
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".$mensaje2[4]."</td>";
			echo	"<td>".number_format($mensaje2[3])."</td>";
			echo	"<td>".$mensaje2[7]." % </td>";
			echo	"<td>".$mensaje2[6]." </td>";
			if ($mensaje2[9]<>'Si')
			{
				echo "<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_nota_venta_modificar(".$mensaje2[0].",".$numero_nota_venta.");'class='icon-borrar info-tooltip'></a></td>";
				echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_nota_venta_modificar(".$mensaje2[0].",".$numero_nota_venta.");' class='icon-editar info-tooltip'></a></td>";
			}
			else
			{
				echo "<td></td>";
			}					
			echo "</tr>";	
		}
	}
	else if ($funcion==26)
	{
		$id_detalle_nota_venta=trim($_POST["id_detalle_nota_venta"]);
		$sql="select					
		detalle_nota_venta.Cantidad,
		detalle_nota_venta.Precio,
		productos.nombre_producto,
		detalle_nota_venta.descuento_procentaje,
		detalle_nota_venta.id_producto
		from detalle_nota_venta		
		inner join productos on detalle_nota_venta.id_producto=productos.id_producto
		WHERE detalle_nota_venta.id_detalle_nota_venta=".$id_detalle_nota_venta;			
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
		   $salida[]=array("Cantidad"=>$fila[0],"Precio"=>$fila[1],"nombre_producto"=>utf8_encode($fila[2]),"descuento"=>$fila[3],"id_producto"=>$fila[4]);
		}		
		$sql1="delete from detalle_nota_venta WHERE id_detalle_nota_venta=".$id_detalle_nota_venta;			
		$ejecuta1=mysql_query($sql1,$conexion->link);
		echo json_encode($salida);	
	}
	else if ($funcion==27)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$fecha_nota_venta=trim($_POST["fecha_nota_venta"]);
		$id_centro_venta=trim($_POST["id_centro_venta"]);
		$id_cliente_nacional=trim($_POST["id_cliente_nacional"]);
		$fecha_despacho_nota_venta=trim($_POST["fecha_despacho_nota_venta"]);
		$id_condicion_venta=trim($_POST["id_condicion_venta"]);
		$observacion_despacho=utf8_decode(trim($_POST["observacion_despacho"]));
		$subtotal=trim($_POST["subtotal"]);
		$ila=trim($_POST["ila"]);
		$iva=trim($_POST["iva"]);
		$total_nota_venta=trim($_POST["total_nota_venta"]);
		$id_vendedor=trim($_POST["id_vendedor"]);
		$fecha_nota_venta_2=date("Y-m-d",strtotime($fecha_nota_venta));
		$fecha_despacho_nota_venta_2=date("Y-m-d",strtotime($fecha_despacho_nota_venta));
		$orden_compra=trim($_POST["orden_compra"]);
		$version=trim($_POST["version"]);	
		$id_Usuario=trim($_POST["id_Usuario"]);			

		/*$sql6="INSERT INTO temporal_nota_venta (id_usuario)
				VALUES ('$id_Usuario')";
		$resultado6=mysql_query($sql6,$conexion->link);
		$numero_nota_venta=mysql_insert_id();*/
	
		try{

			/**$sql3="INSERT INTO nota_venta (numero_nota_venta,id_cliente,fecha_emision,id_centro_venta,sub_total,iva,total,total_ila,id_vendedor,version,
			orden_compra_externa,ingresada,fecha_despacho,id_condicion,observacion_despacho)
				VALUES ('$numero_nota_venta','$id_cliente_nacional','$fecha_nota_venta_2','$id_centro_venta','$subtotal','$iva','$total_nota_venta','$ila','$id_vendedor','$version','$orden_compra','Si','$fecha_despacho_nota_venta_2','$id_condicion_venta','$observacion_despacho')";
			$resultado3=mysql_query($sql3,$conexion->link);*/
			
				$sql1="UPDATE nota_venta	 
					set 		 
					id_cliente='".$id_cliente_nacional."',
					fecha_emision='".$fecha_nota_venta_2."',
					id_centro_venta='".$id_centro_venta."',
					sub_total='".$subtotal."',
					iva='".$iva."',
					total='".$total_nota_venta."',
					total_ila='".$ila."',
					id_vendedor='".$id_vendedor."',
					version='".$version."',
					orden_compra_externa='".$orden_compra."',
					ingresada='Si',
					fecha_despacho='".$fecha_despacho_nota_venta_2."',
					id_condicion='".$id_condicion_venta."',
					observacion_despacho='".utf8_decode($observacion_despacho)."'
					where numero_nota_venta=".$numero_nota_venta;
				$resultado2=mysql_query($sql1,$conexion->link);
		/*	$sql4="UPDATE temporal_detalle_nota_venta	 
					set 		 
					numero_nota_venta='".$numero_nota_venta."'
					where numero_nota_venta=".$numero_nota_venta_tempo;
			$resultado4=mysql_query($sql4,$conexion->link);	*/

			/*$sql2="INSERT INTO detalle_nota_venta 
			SELECT * FROM temporal_detalle_nota_venta where numero_nota_venta=".$numero_nota_venta;
			$ejecuta2=mysql_query($sql2,$conexion->link);*/
			echo "Nota de Venta Actualizada Numero ".$numero_nota_venta;
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==28)
	{
		$id_detalle_nota_venta=trim($_POST["id_detalle_nota_venta"]);
		$sql="select					
		detalle_nota_venta.Cantidad,
		detalle_nota_venta.Precio,
		productos.nombre_producto,
		detalle_nota_venta.descuento_procentaje,
		detalle_nota_venta.id_producto
		from detalle_nota_venta		
		inner join productos on detalle_nota_venta.id_producto=productos.id_producto
		WHERE detalle_nota_venta.id_detalle_nota_venta=".$id_detalle_nota_venta;			
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
		   $salida[]=array("Cantidad"=>$fila[0],"Precio"=>$fila[1],"nombre_producto"=>utf8_encode($fila[2]),"descuento"=>$fila[3],"id_producto"=>$fila[4]);
		}		
		$sql1="delete from detalle_nota_venta WHERE id_detalle_nota_venta=".$id_detalle_nota_venta;			
		$ejecuta1=mysql_query($sql1,$conexion->link);
		echo json_encode($salida);
	}
	else if ($funcion==29)
	{
		$id_detalle_proforma=trim($_POST["id_detalle_proforma"]);
		$sql="select					
		temporal_detalle_proforma.Cantidad,
		temporal_detalle_proforma.Precio,
		productos.nombre_producto
		from temporal_detalle_proforma		
		inner join productos on temporal_detalle_proforma.id_producto=productos.id_producto
		WHERE temporal_detalle_proforma.id_detalle_proforma=".$id_detalle_proforma;			
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
		   $salida[]=array("Cantidad"=>$fila[0],"Precio"=>$fila[1],"nombre_producto"=>utf8_encode($fila[2]));
		}		
		$sql1="delete from temporal_detalle_proforma WHERE id_detalle_proforma=".$id_detalle_proforma;			
		$ejecuta1=mysql_query($sql1,$conexion->link);
		echo json_encode($salida);
	}
	else if ($funcion==30)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql2="select
					detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					detalle_nota_venta.cantidad,
					detalle_nota_venta.total,
					detalle_nota_venta.precio,
					productos.codigo_producto,
					detalle_nota_venta.descuento,
					detalle_nota_venta.descuento_procentaje,
					ingresado_factura,
					nota_venta.facturada
					from detalle_nota_venta
					inner join nota_venta on nota_venta.numero_nota_venta=detalle_nota_venta.numero_nota_venta
					inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
					WHERE detalle_nota_venta.numero_nota_venta =".$numero_nota_venta;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".$mensaje2[4]."</td>";
			echo	"<td>".number_format($mensaje2[3])."</td>";
			echo	"<td>".$mensaje2[7]." % </td>";
			echo	"<td>".$mensaje2[6]." </td>";
			echo	"<td></td>";
			echo "</tr>";	
		}
	}
        else if ($funcion==31)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
                $centro_venta=trim($_POST["centro_venta"]);
                $numero_crl=0;
                $sql3="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                        //$sql2="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta;
			$resultado3=mysql_query($sql3,$conexion->link);
			while ($fila3 = mysql_fetch_array($resultado3))
			{
					//$numero_crl=$fila2[0]+1;
                                        $numero_crl=$fila3[0];
													
			}
                        //echo $numero_crl;
                if($numero_crl<>0){
                    $sql2="select
					detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					detalle_nota_venta.cantidad,
					detalle_nota_venta.total,
					detalle_nota_venta.precio,
					productos.codigo_producto,
					detalle_nota_venta.descuento,
					detalle_nota_venta.descuento_procentaje,
					detalle_nota_venta.id_producto
					from detalle_nota_venta
					inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
					WHERE detalle_nota_venta.crl_nota_venta=".$numero_crl;
                                    //WHERE detalle_nota_venta.numero_nota_venta=".$numero_nota_venta." and detalle_nota_venta.id_centro_venta=".$centro_venta;
					//$sql="SELECT facturada FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                    $resultado2=mysql_query($sql2,$conexion->link);
                    while ($mensaje2=mysql_fetch_array($resultado2))
                    {						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
		
			echo "</tr>";	
                    }
                }else{
                        echo"<tr>";
                            echo"<td  style='text-align:center' colspan='3'><h2>Despacho no Existe!</h2></td>";		
			echo "</tr>";
                }
                    
	}
?>	