<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$precio=trim($_POST["precio"]);
		$cajas=trim($_POST["cajas"]);
		$id_usuario=trim($_POST["id_usuario"]);
		$id_producto=trim($_POST["id_producto"]);
		$numero_proforma=trim($_POST["numero_proforma"]);
		try{	
				$total=$precio*$cajas;
				
			/*	$sql="select					
					temporal_proforma.id_temporal_proforma
					from temporal_proforma
					WHERE temporal_proforma.id_temporal_proforma =".$numero_proforma;					
			$resultado=mysql_query($sql,$conexion->link);
			$mensaje=mysql_fetch_array($resultado);
			if ($mensaje[0]=="")
			{
				$sql1="INSERT INTO temporal_proforma (id_usuario)
					VALUES ('$id_usuario')";
				$resultado1=mysql_query($sql1,$conexion->link);
				$valor=mysql_insert_id();
			}
			else
			{
				$valor=$numero_proforma;
			}*/			
				mysql_query("SET NAMES 'utf8'");
				$sql3="INSERT INTO temporal_detalle_proforma (Cantidad,id_producto,Precio,total,id_usuario)
					VALUES ('$cajas','$id_producto','$precio','$total','$id_usuario')";
				$resultado=mysql_query($sql3,$conexion->link);
				$id_pedido_proforma=mysql_insert_id();
                         /*
                          * $sql2="select
					temporal_detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					temporal_detalle_proforma.cantidad,
					temporal_detalle_proforma.total,
					temporal_detalle_proforma.precio,
					productos.codigo_producto,
					temporal_proforma.id_temporal_proforma
					from temporal_detalle_proforma
					inner join productos on productos.id_producto=temporal_detalle_proforma.id_producto	
					inner join temporal_proforma on temporal_proforma.id_temporal_proforma=temporal_detalle_proforma.numero_proforma	
					WHERE temporal_detalle_proforma.id_detalle_proforma =".$id_pedido_proforma;					
                          */

			$sql2="select
					temporal_detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					temporal_detalle_proforma.cantidad,
					temporal_detalle_proforma.total,
					temporal_detalle_proforma.precio,
					productos.codigo_producto
					from temporal_detalle_proforma
					inner join productos on productos.id_producto=temporal_detalle_proforma.id_producto	
					WHERE temporal_detalle_proforma.id_usuario =".$id_usuario;					
                                $resultado2=mysql_query($sql2,$conexion->link);
                            while ($mensaje2 = mysql_fetch_array($resultado2)){
                            //$mensaje2=mysql_fetch_array($resultado2);	
                                $pre=number_format($mensaje2[4], 2, '.', '');
                                $tot=number_format($mensaje2[3], 2, '.', '');
					echo	"<tr id=".$mensaje2[0].">";
					echo	"<td>".$mensaje2[5]."</td>";
					echo	"<td>".utf8_encode($mensaje2[1])."</td>";
					echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
					echo	"<td style='text-align:right'>".$pre."</td>";
					echo	"<td style='text-align:right'>".$tot."</td>";
					echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma_temporal(".$mensaje2[0].",".$id_usuario.");'class='icon-borrar info-tooltip'></a></td>";
					//echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
					//echo	"<input type='hidden' id='num_prof' value=".$mensaje2[6]." >" ;
					echo "</tr>";	
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
		//$saldo=trim($_POST["saldo"]);
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
					WHERE detalle_proforma.numero_proforma =".$numero_proforma;					
                                $resultado2=mysql_query($sql2,$conexion->link);
                            while ($mensaje2 = mysql_fetch_array($resultado2)){
                            //$mensaje2=mysql_fetch_array($resultado2);	
                                $pre=number_format($mensaje2[4], 2, '.', '');
                                $tot=number_format($mensaje2[3], 2, '.', '');
					echo	"<tr id=".$mensaje2[0].">";
					echo	"<td>".$mensaje2[5]."</td>";
					echo	"<td>".utf8_encode($mensaje2[1])."</td>";
					echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
					echo	"<td style='text-align:right'>".$pre."</td>";
					echo	"<td style='text-align:right'>".$tot."</td>";
					echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-borrar info-tooltip'></a></td>";
					//echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
					//echo	"<input type='hidden' id='num_prof' value=".$mensaje2[6]." >" ;
					echo "</tr>";	
                            }
			/*
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
					//echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_proforma_version(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
					echo "</tr>";	*/

			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}

	}
					
?>		