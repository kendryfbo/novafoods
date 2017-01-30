<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_prov_nac=$_POST["id_prov_nac"];
 	
	try{
			$sql1="UPDATE proveedores_nacionales	 
				set 		 
				habilitado='n'
				where id_proveedor=".$id_prov_nac;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Proveedor Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		