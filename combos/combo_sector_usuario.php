<?php
 
include_once("../clases/conexion.php");
$conexion=new conexion();


$sql="select * from sector ORDER BY sector ASC";
$ejecuta=mysql_query($sql,$conexion->link);
 
 
while ($fila = mysql_fetch_array($ejecuta))
{
	
	$salida[]=array("id_sector"=>$fila[0],"sector"=>$fila[1]);

}
echo json_encode($salida);


?>