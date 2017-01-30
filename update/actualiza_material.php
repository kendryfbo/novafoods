<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_material=$_POST["id_material"];
 	$material=trim($_POST["material"]);
	
	 try{
				$sql1="UPDATE materiales	 
				set 		 
				material='".$material."'
				where id_material=".$id_material;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Material Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>	