<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$largo=trim($_POST["largo"]);
	$id_posicion_bodega=trim($_POST["id_posicion_bodega"]);
	$vereda=trim($_POST["vereda"]);
	$altura=trim($_POST["altura"]);
 
  

	/*$sql1="UPDATE altillos	 
			set 		 
			largo='".$largo."'
			where posicion='".$id_posicion_bodega."'";
	$resultado2=mysql_query($sql1,$conexion->link);
	$id=mysql_insert_id();*/

	//$sql1="select *	from veredas where id=".$id;
 	//$ejecuta=mysql_query($sql1,$conexion->link);
	for($j=1;$j<=$largo;$j++)
	{ 
		$posicion=$id_posicion_bodega."_".$j;
		$sql3="INSERT INTO veredas (posicion,sector_vereda,id_vereda,largo,cantidad_posiciones)
		VALUES ('$posicion','$id_posicion_bodega','$vereda','$largo','$altura')";
		$resultado=mysql_query($sql3,$conexion->link);
	
	}
?>		