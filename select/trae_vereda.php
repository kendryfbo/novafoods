<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$sql1="select 
		id_vereda,
		cantidad_posiciones,
		largo,
		MAX(largo), 
		sector_vereda,
		id
		from veredas
		group by id_vereda ASC ";
	$ejecuta=mysql_query($sql1,$conexion->link);
	
	while ($fila = mysql_fetch_array($ejecuta))
	{	
		echo "<tr><td bgcolor='#cacaca'><label>Vereda ".$fila[0]."</label></td></tr>";	
		echo "<tr><td >";	
		$temporal=$fila[1];	
		for($s=1;$s<=$fila[3];$s++)
		{
			echo "<td>".$s."</td>";	
		}
		echo "</td></tr>";
		 
		for($j=1;$j<=$fila[1];$j++)
		{
			echo "<tr><td width='10%'>A_".$temporal."</td>";
			
			$sql2="select 
			largo,
			id
			from veredas
			where id_vereda=".$fila[0]." and sector_vereda=".$temporal;
			$ejecuta2=mysql_query($sql2,$conexion->link);
			if ($fila2 = mysql_fetch_array($ejecuta2))
			{
				for($i=1;$i<=$fila2[0];$i++)
				{
					echo "<td><input type='checkbox' id=".$temporal."_".$i." value=".$fila[0]."></td>";
				}
			}
				$temporal--;
				echo "</tr>";			
		}
			$col=$fila[3]+1;
			echo "<tr><td bgcolor='#cacaca' colspan='".$col."'>&nbsp;&nbsp;</td></tr>";
	}
			/*$sql2="select *	from altillo_lugares
					where id_altillo=".$altillo. " and lugar_altillo=".$fila[0]. " and posicion='".$posicion."'";
			$ejecuta2=mysql_query($sql2,$conexion->link);
			$número_filas2 = mysql_num_rows($ejecuta2);
			if ($número_filas2<>0)
			{
				while ($fila2 = mysql_fetch_array($ejecuta2))
				{
					if ($posicion<>$fila2[2])
					{
						echo "<td id='".$fila[1]."' onclick='$(this).detalle_espacio(".$fila[0].",".$j.");'>".$fila[0]."_".$j."</td>";
					}
					else
					{
						echo "<td id='".$fila[1]."' bgcolor='#00CCCC' >".$fila[0]."_".$j."</td>";
					}
				}
			}
			else
			{
				echo "<td>".$j."</td>";

				//echo "<tr><td></td></tr>";
			}
			
		}
		
			echo "</tr>";
			 $temporal--;
 				 
	}	*/
 		
		
		
		
		/*if ($número_filas<>0)
		{
			while ($fila = mysql_fetch_array($ejecuta))
			{
				for($i=1;$i<=1;$i++)
				{
					echo "<tr id='".$fila[1]."' ><td colspan='1' rowspan='1'>Sector ".$fila[1]."</td>";
			
					for($j=1;$j<=$fila[2];$j++)
					{
						$posicion=$fila[1]."_".$j;
						$sql2="select *	from altillo_lugares
						where id_altillo=".$altillo. " and lugar_altillo=".$fila[1]. " and posicion='".$posicion."'";
						$ejecuta2=mysql_query($sql2,$conexion->link);
						$número_filas2 = mysql_num_rows($ejecuta2);
						if ($número_filas2<>0)
						{
							while ($fila2 = mysql_fetch_array($ejecuta2))
							{
								if ($posicion<>$fila2[2])
								{
									echo "<td id='".$fila[1]."' onClick='$(this).detalle(".$fila[1].",".$j.");'>".$fila[1]."_".$j."</td>";
								}
								else
								{
									echo "<td id='".$fila[1]."' bgcolor='#00CCCC' >".$fila[1]."_".$j."</td>";
								}
							}
						}
						else
						{
							echo "<td id='".$fila[1]."' onClick='$(this).detalle(".$fila[1].",".$j.");'>".$fila[1]."_".$j."</td>";
						}
					}
				}
			}
		}
		else
		{
			echo "Altillo Aun no Se Envuentra Ingresado";
		}*/
 
				
?>