<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$posicion=trim($_POST["posicion"]);
	$vereda=trim($_POST["vereda"]);

	 $sql="select estado_vereda.estado_vereda,veredas.id_familia
			from veredas
			inner join estado_vereda on estado_vereda.id_estado_vereda=veredas.id_estado_vereda
			WHERE veredas.id_vereda ='".$vereda. "' and veredas.posicion='".$posicion."'";
 	$ejecuta=mysql_query($sql,$conexion->link);
	//	echo "<td>".$sql."</td>";
	while ($fila = mysql_fetch_array($ejecuta))
	{	
	 
		if ($fila[1]<>0)
		{	
			$sql2="select familias.Familia,estado_vereda.id_estado_vereda,veredas.id
				from veredas
				inner join familias on familias.id_familia=veredas.id_familia
				inner join estado_vereda on estado_vereda.id_estado_vereda=veredas.id_estado_vereda
				WHERE id_vereda ='".$vereda. "' and posicion='".$posicion."'";
			$ejecuta2=mysql_query($sql2,$conexion->link);
			if ($fila2 = mysql_fetch_array($ejecuta2))
			{	
				if ($fila2[1]==1)
				{
					$pos = strpos($posicion, "_");
					$titulo=substr($posicion,0,$pos);
					$titulo2=substr($posicion,$pos+1,$titulo+1);
					echo "<tr>";
					echo "<td  bgcolor='#cacaca'><label>Altura ".$titulo." Posicion ".$titulo2."  </label></td>";
					echo "</tr>";
					echo "</tr>";
					echo "<td  bgcolor='#cacaca'><label>Estado</label></td>";
					echo "</tr>";
					echo "<td>".$fila[0]."</td>";
					echo "<tr>";
					echo "<td  bgcolor='#cacaca'><label>Familia</label></td>";
					echo "</tr>";
					echo ".<td>".$fila2[0]."</td>";
				}
				else
				{
					$pos = strpos($posicion, "_");
					$titulo=substr($posicion,0,$pos);
					$titulo2=substr($posicion,$pos+1,$titulo+1);
					$sql3="select cajas,kilos,productos.nombre_producto,id_produccion
					from detalle_veredas
					inner join productos on productos.id_producto=detalle_veredas.id_producto
					WHERE id_vereda=".$fila2[2];
					$ejecuta3=mysql_query($sql3,$conexion->link);
					if ($fila3 = mysql_fetch_array($ejecuta3))
					{	
				
						echo "<tr>";
						echo "<td  bgcolor='#cacaca'><label>Altura ".$titulo." Posicion ".$titulo2."  </label></td>";
						echo "</tr>";
						echo "</tr>";
						echo "<td  bgcolor='#cacaca'><label>Estado</label></td>";
						echo "</tr>";
						echo "<td>".$fila[0]."</td>";
						echo "<tr>";
						echo "<td  bgcolor='#cacaca'><label>Familia</label></td>";
						echo "</tr>";
						echo ".<td>".$fila2[0]."</td>";
						if ($fila3[0]<>0)
						{	
							$sql4="SELECT IFNULL((SELECT SUM( cantidad ) FROM bodega_producto_terminado	WHERE 										
							id_produccion=".$fila3[3].") , 0) AS suma_bodega";
							$resultado4=mysql_query($sql4,$conexion->link);
							$mensaje4 = mysql_fetch_array ($resultado4);
							echo "<tr>";
							echo "<td  bgcolor='#cacaca'><label>Cajas</label></td>";
							echo "</tr>";
							echo ".<td>".$mensaje4[0]."</td>";
						}
						else
						{
							echo "<tr>";
							echo "<td  bgcolor='#cacaca'><label>Kilos</label></td>";
							echo "</tr>";
							echo ".<td>".$fila3[1]."</td>";

						}
						echo "<tr>";
						echo "<td  bgcolor='#cacaca'><label>Producto</label></td>";
						echo "</tr>";
						echo ".<td>".$fila3[2]."</td>";
					}
				}
			}
		}
		else
		{	
			 $pos = strpos($posicion, "_");
				$titulo=substr($posicion,0,$pos);
				$titulo2=substr($posicion,$pos+1,$titulo+1);
				echo "<tr>";
				echo "<td  bgcolor='#cacaca'><label>Altura ".$titulo." Posicion ".$titulo2."  </label></td>";
				echo "</tr>";
				echo "<td  bgcolor='#cacaca'><label>Estado</label></td>";
				echo "</tr>";
				echo "<td>".$fila[0]."</td>";
				echo "<tr>";
				echo "<td  bgcolor='#cacaca'><label>Familia</label></td>";
				echo "</tr>";
				echo "<td>No Registra Familia Posicion</td>";
			 
	 
		}
		
			
	
	}
?>