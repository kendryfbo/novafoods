<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion=="1")
	{
		try{
			$sql="select id_producto,nombre_producto from productos where id_sector_producto=4 ORDER BY nombre_producto ASC";
			$ejecuta=mysql_query($sql,$conexion->link);
			
			echo "<option value='' selected>Seleccione Productos...</option>";
			while ($fila = mysql_fetch_array($ejecuta))	{
				
				
				echo "<option id=".$fila[0]." value=".utf8_encode($fila[1]).">".utf8_encode($fila[1])."</option>";

			}
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}			
	}
	else if ($funcion=="2")
	{	
		
		try{
			$busca_pro=trim($_POST["busca_pro"]);
			$sql="select id_producto,nombre_producto from productos where  id_sector_producto=4 and nombre_producto like '%".$busca_pro."%' ORDER BY nombre_producto ASC";
			$ejecuta=mysql_query($sql,$conexion->link);
			
			echo "<option value='' selected>Seleccione Productos...</option>";
			while ($fila = mysql_fetch_array($ejecuta))	{
				
				
				echo "<option id=".$fila[0]." value=".utf8_encode($fila[1]).">".utf8_encode($fila[1])."</option>";

			}
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
 		
	}
        else if ($funcion=="3")
	{	
		
		try{
			$id_condicion=trim($_POST["id_condicion"]);
			$sql="select productos.id_producto,productos.nombre_producto 
                             from productos
                             inner join lista_precio_nacional on lista_precio_nacional.id_producto=productos.id_producto
                             where  id_sector_producto=4 and id_lista=".$id_condicion." ORDER BY nombre_producto ASC";
			$ejecuta=mysql_query($sql,$conexion->link);
			
			//echo "<option value='' selected>Seleccione Productos...</option>";
			while ($fila = mysql_fetch_array($ejecuta))	{
				
				
				echo "<option id=".$fila[0]." value=".utf8_encode($fila[1]).">".utf8_encode($fila[1])."</option>";

			}
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
 		
	}
        else if ($funcion=="4")
	{	
		
		try{
			$id_condicion=trim($_POST["id_condicion"]);
			/*$sql="select productos.id_producto,productos.nombre_producto 
                             from productos
                             inner join lista_precio_nacional on lista_precio_nacional.id_producto=productos.id_producto
                             where  id_sector_producto=4 and id_lista=".$id_condicion." ORDER BY nombre_producto ASC";
			$ejecuta=mysql_query($sql,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))	{
				
				
				echo "<option id=".$fila[0]." value=".utf8_encode($fila[1]).">".utf8_encode($fila[1])."</option>";

			}*/
                        $sql="select 
                                productos.id_producto,
                                productos.nombre_producto,
                                lista_precio_nacional.precio
                                from productos
                                inner join lista_precio_nacional on lista_precio_nacional.id_producto=productos.id_producto
                                where  id_sector_producto=4 and id_lista=".$id_condicion;	
                        $ejecuta=mysql_query($sql,$conexion->link);
                        $numero_filas = mysql_num_rows($ejecuta);
                        if ($numero_filas==0)
                        {		 
                            $salida[]=array("valor"=>1);
                            echo json_encode($salida);
                        }else{
                            while ($fila = mysql_fetch_array($ejecuta))
                            {
				$salida[]=array("prod"=>utf8_encode($fila[1]),"id_prod"=>$fila[0],"v_unitario"=>$fila[2]); 
                            }
                            echo json_encode($salida);
                        }
                        
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
 		
	}
        if ($funcion=="5")
	{
		try{
			$sql="select id_producto,nombre_producto from productos where id_sector_producto<>4 ORDER BY nombre_producto ASC";
			$ejecuta=mysql_query($sql,$conexion->link);
			
			echo "<option value='' selected>Seleccione Productos...</option>";
			while ($fila = mysql_fetch_array($ejecuta))	{
				
				
				echo "<option id=".$fila[0]." value=".utf8_encode($fila[1]).">".utf8_encode($fila[1])."</option>";

			}
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}			
	}
	else if ($funcion=="6")
	{	
		
		try{
			$busca_pro=trim($_POST["busca_pro"]);
			$sql="select id_producto,nombre_producto from productos where  id_sector_producto<>4 and nombre_producto like '%".$busca_pro."%' ORDER BY nombre_producto ASC";
			$ejecuta=mysql_query($sql,$conexion->link);
			
			echo "<option value='' selected>Seleccione Productos...</option>";
			while ($fila = mysql_fetch_array($ejecuta))	{
				
				
				echo "<option id=".$fila[0]." value=".utf8_encode($fila[1]).">".utf8_encode($fila[1])."</option>";

			}
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
 		
	}
?>