<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	if (isset($_FILES["file"]))
	{
		$file=$_FILES["file"];
		$nombre=$file["name"];
		$tipo=$file["type"];
		$ruta_provisional=$file["tmp_name"];
		$size=$file["size"];
		$dimensiones=getimagesize($ruta_provisional);
		$width=$dimensiones[0];
		$height=$dimensiones[1];
		//$carpeta="C:/xampp/htdocs/novafoods/imagen_ajax/imagenes_reclamos/";
		$carpeta="../imagenes/";

		if ($tipo!='image/jpg' && $tipo!='image/jpeg' && $tipo!='image/png' && $tipo!='image/gif')
		{
			echo "Error el Archivo no es un Imagen";
		}
		else if ($size > 1024*1024)
		{
			echo "Error el tamño maximo permitido es 1 mb";
		}
		else if ($width > 500 && $width < 60 && $height>500 && $height<60)
		{
			echo "Error la anchura y la altura de la imagen debe de ser inferior 500 px y mayor a  60 px";
		}
		else
		{
			$sql="SELECT id_reclamo FROM formulario_reclamos order by id_reclamo desc limit 1";
			$resultado=mysql_query($sql,$conexion->link);
			if ($mensaje=mysql_fetch_array($resultado));
			{
				$extension = end(explode('.',$nombre)); 
				$onlyName = substr($nombre,0,strlen($nombre)-(strlen($extension)+1)); 
				$name = $mensaje[0]."_".utf8_decode($onlyName).".".$extension; 
				$src=$carpeta.$name;
				move_uploaded_file($ruta_provisional,$src);
				//echo "<img src=imagenes/".$name.">";
				echo "Imagen Subida";
				$sql1="INSERT INTO imagenes_reclamos (id_reclamo,nombre_imagen)
				VALUES ('$mensaje[0]','$name')";
				$resultado1=mysql_query($sql1,$conexion->link);
			}
			
		}

	}
?>