<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$nom_prod=trim($_POST["nom_prod"]);
	$cod_prod=trim($_POST["cod_prod"]);
	$id_familia=trim($_POST["id_familia"]);
	$costo=trim($_POST["costo"]);
	$sector=trim($_POST["sector"]);
	$id_producto=trim($_POST["id_producto"]);
	
	switch ($sector) {
			
		case 1:
				 try{		
						mysql_query("SET NAMES 'utf8'");
						$sql1="UPDATE productos	 
							set 		 
							id_familia='".utf8_decode($id_familia)."',
							nombre_producto='".utf8_decode($nom_prod)."',
							costo_unitario='".utf8_decode($costo)."',
							id_sector_producto='".utf8_decode($sector)."',
							codigo_producto='".utf8_decode($cod_prod)."'
							where id_producto=".$id_producto;
						$resultado2=mysql_query($sql1,$conexion->link);
						echo "Producto Actualizado";
				
					}
						catch (Exception $e)
					{    
						 echo $e->getMessage();
					}
		break;
		case 2:
					 try{		
						mysql_query("SET NAMES 'utf8'");
						$id_umed=trim($_POST["id_umed"]);
						$sql1="UPDATE productos	 
							set 		 
							id_familia='".utf8_decode($id_familia)."',
							nombre_producto='".utf8_decode($nom_prod)."',
							costo_unitario='".utf8_decode($costo)."',
							id_umed='".utf8_decode($id_umed)."',
							id_sector_producto='".utf8_decode($sector)."',
							codigo_producto='".utf8_decode($cod_prod)."'
							where id_producto=".$id_producto;
						$resultado2=mysql_query($sql1,$conexion->link);
						echo "Producto Actualizado";
				
					}
						catch (Exception $e)
					{    
						 echo $e->getMessage();
					}

		break;

	}


					
?>		