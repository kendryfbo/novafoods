<?php
 
include_once("../clases/conexion.php");
$conexion=new conexion();


$sql="select * from tipo_usuarios ORDER BY tipo_usuario ASC";
$ejecuta=mysql_query($sql,$conexion->link);
 
 
while ($fila = mysql_fetch_array($ejecuta))
{
	
	$salida[]=array("id_tipo"=>$fila[0],"tipo"=>$fila[1]);

}
echo json_encode($salida);


?>