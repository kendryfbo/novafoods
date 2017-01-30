
<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();	
	$id_sector=$_POST["id_sector"]; 
	
	$sql1="select id_familia,codigo_familia,familia from familias where habilitado='s' and id_sector_producto=".$id_sector;
	$resultado1=mysql_query($sql1,$conexion->link);
	while ($fila=mysql_fetch_array($resultado1))
	{
			 
		echo "<tr>";
		echo "<td  class='width10' id='".$fila[0]."'>".utf8_encode($fila[1])."</td>"; 
		echo "<td class='width78' >".$fila[2]."</td>"; 
		echo "<td class='width10'><a href='#' onClick='$(this).actualiza_familia();' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
 		echo "<td class='width10'><a href='#' onClick='$(this).boora_familia();' title='Eliminar Informacion' class='icon-borrar info-tooltip'></a></td>";
		echo "</tr>";			
	 
		 
	 
	}							
?>	
 
 