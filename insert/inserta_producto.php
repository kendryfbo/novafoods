<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$nom_prod=trim($_POST["nom_prod"]);
	$cod_prod=trim($_POST["cod_prod"]);
	$id_sector=trim($_POST["id_sector"]);

			
	switch ($id_sector) {
			
			case 1:
				 try{	
						$id_familia=trim($_POST["id_familia"]);
						$costo=trim($_POST["costo"]);
						mysql_query("SET NAMES 'utf8'");
						$sql3="INSERT INTO productos (id_familia,codigo_producto,nombre_producto,costo_unitario,id_sector_producto)
						VALUES
						('$id_familia','$cod_prod','$nom_prod','$costo',1)";
						$resultado=mysql_query($sql3,$conexion->link);
					
						echo "Producto Ingresado";
					}
						catch (Exception $e)
					{    
						 echo $e->getMessage();
					}
			break;
			case 2:
				 try{	
							$id_familia=trim($_POST["id_familia"]);
							$costo=trim($_POST["costo"]);
							$id_umed=trim($_POST["id_umed"]);
							mysql_query("SET NAMES 'utf8'");
							$sql3="INSERT INTO productos (id_familia,codigo_producto,nombre_producto,costo_unitario,id_sector_producto,id_umed)
							VALUES
							('$id_familia','$cod_prod','$nom_prod','$costo',2,'$id_umed')";
							$resultado=mysql_query($sql3,$conexion->link);
						
							echo "Producto Ingresado";
						}
							catch (Exception $e)
						{    
							 echo $e->getMessage();
						}
			break;
			case 3:
				 try{	
							$id_familia=trim($_POST["id_familia"]);
							$id_material=trim($_POST["id_material"]);
							$id_color=trim($_POST["id_color"]);
							$id_marca=trim($_POST["id_marca"]);
							$id_formato=trim($_POST["id_formato"]);
							$id_talla=trim($_POST["id_talla"]);
							$id_umed=trim($_POST["id_umed"]);
							$id_genero=trim($_POST["id_genero"]);
							$id_subfamilia=trim($_POST["id_subfamilia"]);
							mysql_query("SET NAMES 'utf8'");
							$sql3="INSERT INTO productos (id_sector_producto,id_familia,codigo_producto,nombre_producto,id_umed,id_marca,id_formato,id_color,id_talla,id_genero,id_subfamilia,id_material)
							VALUES
							('$id_sector','$id_familia','$cod_prod','$nom_prod','$id_umed','$id_marca','$id_formato','$id_color','$id_talla',
							'$id_genero','$id_subfamilia','$id_material')";
							$resultado=mysql_query($sql3,$conexion->link);
						
							echo "Producto Ingresado";
						}
							catch (Exception $e)
						{    
							 echo $e->getMessage();
						}
			break;
			case 4:
				 try{	
							$id_umed=trim($_POST["id_umed"]);
                                                        $id_tipo_producto=trim($_POST["id_tipo_producto"]);
                                                        $id_marca=trim($_POST["id_marca"]);
                                                        $sabor=trim($_POST["sabor"]);
                                                        $id_formato=trim($_POST["id_formato"]);
                                                        $peso_neto=trim($_POST["peso_neto"]);
                                                        $peso_bruto=trim($_POST["peso_bruto"]);
                                                        $volumen=trim($_POST["volumen"]);
                                                        $cajas=trim($_POST["cajas"]);
                                                        mysql_query("SET NAMES 'utf8'");
                                                        $sql3="INSERT INTO productos (id_sector_producto,codigo_producto,nombre_producto,id_umed,id_marca,id_formato,id_sabor,peso_neto,peso_bruto,volumen,CajasxBach,tipo_producto)
                                                        VALUES
                                                        ('$id_sector','$cod_prod','$nom_prod','$id_umed','$id_marca','$id_formato','$sabor','$peso_neto','$peso_bruto','$volumen','$cajas','$id_tipo_producto')";
                                                        $resultado=mysql_query($sql3,$conexion->link);
                                                        echo "Producto Ingresado";
						}
							catch (Exception $e)
						{    
							 echo $e->getMessage();
						}
			break;
			case 5:
				 try{	
						$id_umed=trim($_POST["id_umed"]);
						$id_familia_mprima=trim($_POST["id_familia_mprima"]);
						$stock_min=trim($_POST["stock_min"]);
						$divide=trim($_POST["divide"]);
						$ph=trim($_POST["ph"]);
						$hume=trim($_POST["hume"]);
                                                
						mysql_query("SET NAMES 'utf8'");
						$sql3="INSERT INTO productos (id_sector_producto,codigo_producto,nombre_producto,id_umed,id_familia,Stock_min,div_cajas,ph,hummax)
						VALUES
						('$id_sector','$cod_prod','$nom_prod','$id_umed','$id_familia_mprima','$stock_min','$divide','$ph','$hume')";
						$resultado=mysql_query($sql3,$conexion->link);
						echo "Producto Ingresado";
						}
							catch (Exception $e)
						{    
							 echo $e->getMessage();
						}
			break;
                        case 6:
				 try{	
							$id_umed=trim($_POST["id_umed"]);
                                                        $id_marca=trim($_POST["id_marca"]);
                                                        $sabor=trim($_POST["sabor"]);
                                                        
                                                        mysql_query("SET NAMES 'utf8'");
                                                        $sql3="INSERT INTO productos (id_sector_producto,codigo_producto,nombre_producto,id_umed,id_marca,id_sabor)
                                                        VALUES
                                                        ('$id_sector','$cod_prod','$nom_prod','$id_umed','$id_marca','$sabor')";
                                                        $resultado=mysql_query($sql3,$conexion->link);
                                                        echo "Premezcla Ingresada";
						}
							catch (Exception $e)
						{    
							 echo $e->getMessage();
						}
			break;
                        case 7:
				 try{	
							$id_umed=trim($_POST["id_umed"]);
						$id_familia_mprima=trim($_POST["id_familia_mprima"]);
						$stock_min=trim($_POST["stock_min"]);
						$divide=trim($_POST["divide"]);
						$ph=trim($_POST["ph"]);
						$hume=trim($_POST["hume"]);
                                                
						mysql_query("SET NAMES 'utf8'");
						$sql3="INSERT INTO productos (id_sector_producto,codigo_producto,nombre_producto,id_umed,id_familia,Stock_min,div_cajas,ph,hummax)
						VALUES
						('$id_sector','$cod_prod','$nom_prod','$id_umed','$id_familia_mprima','$stock_min','$divide','$ph','$hume')";
                                                        $resultado=mysql_query($sql3,$conexion->link);
                                                     $sql2="UPDATE familias set crl=crl+1 where id_familia=".$id_familia_mprima;
                                                $resultado2=mysql_query($sql2,$conexion->link);
                                                        echo "Materia Prima Ingresada";
						}
							catch (Exception $e)
						{    
							 echo $e->getMessage();
						}
			break;
                        case 8:
				 try{	
						$id_umed=trim($_POST["id_umed"]);
						$id_familia_mprima=trim($_POST["id_familia_mprima"]);
						$stock_min=trim($_POST["stock_min"]);
						$divide=trim($_POST["divide"]);
						$ph=trim($_POST["ph"]);
						$hume=trim($_POST["hume"]);
                                                
						mysql_query("SET NAMES 'utf8'");
						$sql3="INSERT INTO productos (id_sector_producto,codigo_producto,nombre_producto,id_umed,id_familia,Stock_min,div_cajas,ph,hummax)
						VALUES
						('$id_sector','$cod_prod','$nom_prod','$id_umed','$id_familia_mprima','$stock_min','$divide','$ph','$hume')";
                                                        $resultado=mysql_query($sql3,$conexion->link);
                                                        echo "Insumo Ingresado";
                                                
                                                        $sql2="UPDATE familias set crl=crl+1 where id_familia=".$id_familia_mprima;
                                                $resultado2=mysql_query($sql2,$conexion->link);
						}   
							catch (Exception $e)
						{    
							 echo $e->getMessage();
						}
			break;
   
	}
?>
	