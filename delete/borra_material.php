<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_material=$_POST["id_material"];
 	
	try{
			$sql1="UPDATE materiales	 
				set 		 
				habilitado='n'
				where id_material=".$id_material;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Material Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		