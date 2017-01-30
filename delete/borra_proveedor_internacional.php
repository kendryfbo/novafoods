<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_prov_int=$_POST["id_prov_int"];
 	
	try{
			$sql1="UPDATE proveedores_internacionales	 
				set 		 
				habilitado='n'
				where id_proveedor=".$id_prov_int;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Proveedor Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		