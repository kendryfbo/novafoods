<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$id_producto=trim($_POST["id_producto"]);
	$cod_prod=trim($_POST["cod_prod"]);
	$nom_prod=trim($_POST["nom_prod"]);
	$id_familia=trim($_POST["id_familia"]);
	$costo=trim($_POST["costo"]);
	$id_sector=trim($_POST["id_sector"]);
	$id_umed=trim($_POST["id_umed"]);
	
		try{		
			mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE productos	 
				set 		 
				id_familia='".utf8_decode($id_familia)."',
				nombre_producto='".$nom_prod."',
				costo_unitario='".utf8_decode($costo)."',
				id_sector_producto='".utf8_decode($id_sector)."',
				codigo_producto='".utf8_decode($cod_prod)."'
				where id_producto=".$id_producto;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Producto Actualizado";
				
			}
				catch (Exception $e)
			{    
				echo $e->getMessage();
			}
	
						
?>		