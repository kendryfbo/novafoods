<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$vereda=$_POST["vereda"];
	$sql1="select 
		id_vereda,
		cantidad_posiciones,
		largo,
		MAX(largo), 
		sector_vereda,
		id
		from veredas
		where id_vereda= ".$vereda.
		" group by id_vereda ASC ";
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
			id_estado_vereda
			from veredas
			where id_vereda=".$fila[0]." and sector_vereda=".$temporal;
			$ejecuta2=mysql_query($sql2,$conexion->link);
			$i=1;
			while ($fila2 = mysql_fetch_array($ejecuta2))
			{

				/*for($i=1;$i<=$fila2[0];$i++)
				{*/	


					if ($fila2[1]==1)
					{
						echo "<td  bgcolor='#00FF00' id=".$temporal."_".$i." onclick='$(this).detalle_espacio();'></td>";	
					}
					elseif ($fila2[1]==2)
					{
						echo "<td  bgcolor='#FFF700' id=".$temporal."_".$i." onclick='$(this).detalle_espacio();'></td>";
					}
					elseif ($fila2[1]==3)
					{
						echo "<td  bgcolor='#FF0011' id=".$temporal."_".$i." onclick='$(this).detalle_espacio();'></td>";
					}
				 $i++;					
			}
				$temporal--;
				echo "</tr>";			
		}
			$col=$fila[3]+1;
			echo "<tr><td bgcolor='#cacaca' colspan='".$col."'>&nbsp;&nbsp;</td></tr>";

			
	}
?>