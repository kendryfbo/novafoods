	<?php
	$id_producto=$_POST["id_producto"];
	
	include_once("../clases/conexion.php");
	$conexion= new conexion();
        
        $sql1="select 
                    umed.umed,
                    productos.costo_unitario
                    from productos 
                    inner join umed on umed.id_umed=productos.id_umed
                    WHERE productos.id_producto =".$id_producto;
 		//$sql1="select rut_proveedor,contacto from proveedores_nacionales WHERE id_proveedor =".$id_proveedor; 	
			$ejecuta=mysql_query($sql1,$conexion->link);

			while ($fila = mysql_fetch_array($ejecuta))
			{
				$salida[]=array("umed"=>utf8_encode($fila[0]),"costo"=>utf8_encode($fila[1]));

			}
			echo json_encode($salida);


?>