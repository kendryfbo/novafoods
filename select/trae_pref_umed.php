<?php
	
	include_once("../clases/conexion.php");
	$conexion= new conexion();
        $list_umed=trim($_POST["list_umed"]);
	 $sql1="select * from umed 
			WHERE id_umed =".$list_umed;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$pref=$fila[3];
                //$salida[]=array("umed"=>$fila[1]);
	}
	//echo json_encode($salida);
	 echo$pref;
		 


?>