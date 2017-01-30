<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$lado=$_POST["lado"];
        $sql1="select 
		MAX(columna)
		from bodega
		where lado= ".$lado.
		" group by columna ASC ";
	$ejecuta=mysql_query($sql1,$conexion->link);
	
	while ($fila = mysql_fetch_array($ejecuta))
        {
            $col=$fila[0];
            
        }
        //echo $col;
        //echo"<table  width='100%'>";
        echo"<table class='tablesorter' width='100%'>";
            echo "<tr>";
            echo "<td style='text-align:center' ></td>";
        for($j=1;$j<=$col;$j++)
            {
                
                echo "<td  style='text-align:center'>".$j."</td>";
                
            }
            echo"</tr>";
        
        
        $sql2="select 
		fila
		from bodega
		where lado= ".$lado.
		" group by fila desc ";
	$ejecuta2=mysql_query($sql2,$conexion->link);
	
            
            
	while ($fila2 = mysql_fetch_array($ejecuta2))
        {
            //$col=$fila[0];
            
            echo "<tr>";
            echo "<td  style='text-align:center'>N ".$fila2[0]."</td>";
            $fila=$fila2[0];
            for($j=1;$j<=$col;$j++)
            {
                $sql3="select 
		codigo,status
		from bodega
		where lado= ".$lado." and columna=".$j." and fila=".$fila;
                $ejecuta3=mysql_query($sql3,$conexion->link);
                $numero_filas = mysql_num_rows($ejecuta3);
                    //$salida[]=array("valor"=>0);
                if ($numero_filas==0)
                {		 
                            //$salida[]=array("valor"=>0);
                            //echo json_encode($salida);
                            echo "<td></td>";
                }
                else
                {
                    while ($fila3 = mysql_fetch_array($ejecuta3))
                    {
                        $cod=$fila3[0];
                        $status=$fila3[1];
                    }
                    //echo "<td >".utf8_encode($cod)."</td>";
                
                    if($status<>0){
                        echo "<td style='text-align:center'><a href='#' onClick='$(this).Detalle_ventas_export(".$cod.");' title='$cod' info-tooltip'><img src='img/palet1.png' width='20' height='20'></a></td>";
                    }else{
                        echo "<td style='text-align:center'><a href='#' onClick='$(this).Detalle_ventas_export(".$cod.");' title='$cod' info-tooltip'><img src='img/palet0.png' width='20' height='20'></a></td>";
                    }
                }
                
                
                //echo "<td><a href='#' onClick='$(this).Detalle_ventas_export(".$cod.");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                //echo "<td >".$j."</td>";
            }
            echo"</tr>";
        }
        echo"</table>";
        /*
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

			
	}*/
?>