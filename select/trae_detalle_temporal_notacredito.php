<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
        $id_Usuario=trim($_POST["id_Usuario"]);
        //echo "Usurario".$id_usuario;
	if ($funcion==1)
	{
		
		try{	
			
                        
			$sql2="select
					temporal_detalle_nc.id_detalle_nc,
					productos.nombre_producto,
					temporal_detalle_nc.cantidad,
					temporal_detalle_nc.total,
					temporal_detalle_nc.precio,
					productos.codigo_producto,
					temporal_detalle_nc.descuento,
					temporal_detalle_nc.porcentaje,
                                        temporal_detalle_nc.id_usuario,
                                        temporal_detalle_nc.obs_gen
					from temporal_detalle_nc
					inner join productos on productos.id_producto=temporal_detalle_nc.id_producto	
					WHERE temporal_detalle_nc.id_usuario =".$id_Usuario;
			mysql_query("SET NAMES 'UTF8'");		
			$resultado2=mysql_query($sql2,$conexion->link);
                        while ($mensaje2 = mysql_fetch_array($resultado2))
			{
			//$mensaje2=mysql_fetch_array($resultado2);
					$prec=number_format($mensaje2[4], 0, '', '.');
                                        $deslin=number_format($mensaje2[6], 0, '', '.');
                                        $totlin=number_format($mensaje2[3], 0, '', '.');
                                        $desobs=$mensaje2[9];
                                        $cantidad=$mensaje2[2];
                                        
					echo	"<tr id=".$mensaje2[0].">";
					echo	"<td>".utf8_encode($mensaje2[5])."</td>";
					echo	"<td>".$mensaje2[1]."</td>";
					echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
					echo	"<td style='text-align:right'>".$prec."</td>";
					
					echo	"<td style='text-align:right'>".$mensaje2[7]." %</td>";
					echo	"<td style='text-align:right'>".$deslin." </td>";
                                        echo	"<td  style='text-align:right'>".$totlin."</td>";
					//echo	"<input type='hidden' id='valor_id_nota' value=".$numero_nota_venta." >" ;
                                        echo	"<td  style='text-align:center'><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_temporal_nota_credito(".$mensaje2[0].",".$mensaje2[8].");'class='icon-borrar info-tooltip'></a></td>";						

					
					echo "</tr>";	
                                        if($desobs<>""){
                                            echo	"<tr id=".$mensaje2[0].">";
                                                    echo	"<td>****</td>";
                                                    echo	"<td>".utf8_encode($desobs)."</td>";
                                                    echo	"<td style='text-align:right'>".$cantidad."</td>";
                                                    echo	"<td style='text-align:right'>".$prec."</td>";

                                                    echo	"<td style='text-align:right'>0 %</td>";
                                                    echo	"<td style='text-align:right'>0 </td>";
                                                    echo	"<td  style='text-align:right'>".$totlin."</td>";
                                                    //echo	"<input type='hidden' id='valor_id_nota' value=".$numero_nota_venta." >" ;
                                                    echo	"<td  style='text-align:center'><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_temporal_nota_credito(".$mensaje2[0].",".$mensaje2[8].");'class='icon-borrar info-tooltip'></a></td>";						
                                                     echo	"<td></td>";						
                                            echo "</tr>";	
                                        }
                            }
                            

			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
	}
	else if ($funcion==2)
	{
		$precio=trim($_POST["precio"]);
		$cajas=trim($_POST["cajas"]);
		$id_producto=trim($_POST["id_producto"]);
		$numero_proforma=trim($_POST["numero_proforma"]);
		$saldo=trim($_POST["saldo"]);
		$total=$precio*$cajas;
		
		$sql4="SELECT IFNULL((SELECT SUM(total) FROM detalle_proforma WHERE numero_proforma='".$numero_proforma."'),0) AS suma_bod ";		$resultado4=mysql_query($sql4,$conexion->link);
		$mensaje4=mysql_fetch_array($resultado4);
		$total_comparar_saldo=$total+$mensaje4[0];
		
		/*if ($total_comparar_saldo>$saldo)
		{
			echo "1";
		}
		else
		{
			echo "2";
		}*/
		echo "2";
	}
	else if ($funcion==3)
	{
		
		$precio=trim($_POST["precio"]);
		$cajas=trim($_POST["cajas"]);
		$id_producto=trim($_POST["id_producto"]);
		$numero_proforma=trim($_POST["numero_proforma"]);
		$saldo=trim($_POST["saldo"]);
		$total=$precio*$cajas;
		try{	
				mysql_query("SET NAMES 'utf8'");
				$sql3="INSERT INTO detalle_proforma (Cantidad,id_producto,Precio,numero_proforma,total)
					VALUES ('$cajas','$id_producto','$precio','$numero_proforma','$total')";
				$resultado=mysql_query($sql3,$conexion->link);
				$id_pedido_proforma=mysql_insert_id();

			$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					detalle_proforma.cantidad,
					detalle_proforma.total,
					detalle_proforma.precio,
					productos.codigo_producto
					from detalle_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.id_detalle_proforma =".$id_pedido_proforma;					
			$resultado2=mysql_query($sql2,$conexion->link);
			$mensaje2=mysql_fetch_array($resultado2);
										
					echo	"<tr id=".$mensaje2[0].">";
					echo	"<td>".$mensaje2[5]."</td>";
					echo	"<td>".utf8_encode($mensaje2[1])."</td>";
					echo	"<td>".$mensaje2[2]."</td>";
					echo	"<td>".$mensaje2[4]."</td>";
					echo	"<td>".$mensaje2[3]."</td>";
					echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-borrar info-tooltip'></a></td>";
					echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_proforma_version(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
					echo "</tr>";	

			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}

	}
					
?>		