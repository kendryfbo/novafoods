<?php
ob_start();
$altura = 80;
$cod = $_GET['numero'];
$funcion = $_GET['funcion'];

function string_name(){
$strings='abcdefghijklmNopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$long = 15;
$nuevo_string = '';
for ($i=0; $i <= $long; $i++){
$rand = rand(0, strlen($strings)-1);
$nuevo_string .= $strings[$rand];
}
return $nuevo_string;
}

function tamano($numero,$altura)
{
$cifras = strlen($numero) + 1;
$dim['x'] = 7 + $cifras*6 + 9;
$dim['y'] = $altura + 1;
return $dim;
}

$dimensiones = tamano($cod,$altura);
$imagen = imagecreate($dimensiones['x'], $dimensiones['y']);

$blanco = imagecolorallocate($imagen,255,255,255);
$negro = imagecolorallocate($imagen,0,0,0);

imagefill($imagen, 0, 0, $blanco);
imagerectangle($imagen, 0, 0, imageSX($imagen) - 1, imageSY($imagen) - 1, $negro);

function cifra($num)
{
return str_pad(decbin($num + 5), 4, '0', STR_PAD_LEFT);
}

function barra($y2, $x_ini, $codigo)
{
global $imagen, $negro, $blanco;
for($i = 0; $i <=3; $i++)
{
if($codigo[$i] == 0)
{
$color = $blanco;
}else{
$color = $negro;
}
$x = $x_ini + $i;
imageline($imagen, $x, 5, $x, $y2, $color);
}
}

function codigo($numero)
{
global $imagen, $negro, $blanco, $altura;

$x = 5;
barra($altura - 5, $x, "1010");
$x = $x + 7;

for($e = 0; $e<=strlen($numero) - 1; $e++)
{
barra($altura - 15, $x, cifra($numero[$e]));
imagestring($imagen, 2, $x, $altura - 15, $numero[$e], $negro);
$x = $x + 6;
}
$x = $x + 1;
barra($altura - 5, $x, "1011");
}

codigo($cod, $altura);
//header("Content-type: image/png");
imagepng($imagen);
//$dataimagen=array("data_img"=>$imagenxx);
//echo $imagenxx;
$nuevo_nombre=string_name();
$out = ob_get_contents();
ob_end_clean();
file_put_contents('codigos/'.$nuevo_nombre.'.png',$out); 
$dataImg='select/codigos/'.$nuevo_nombre.'.png';
include_once("../clases/conexion.php");
$conexion= new conexion();

if ($funcion==1)
{
	$sql="UPDATE detalle_veredas	 
	set 		 
	img_codigo_barra='".$dataImg."',
	tipo_producto='mp'
	where id=".$cod;
	$resultado=mysql_query($sql,$conexion->link);
}
else
{	
	$id_producto = $_GET['id_producto'];
	$saldo = $_GET['saldo'];
	$id_produccion = $_GET['id_produccion'];	
	
	$sql="select id_vereda from detalle_veredas
	where id=".$cod;
	$resultado=mysql_query($sql,$conexion->link);
 
	if ($mensaje = mysql_fetch_array($resultado))
	{
		$sql2="UPDATE veredas	 
		set 		 
		id_estado_vereda=2
		where id=".$mensaje[0];
		$resultado=mysql_query($sql2,$conexion->link);
		
		$sql3="UPDATE produccion	 
		set 		 
		espera='Si'
		where id_produccion=".$id_produccion;
		$resultado=mysql_query($sql3,$conexion->link);	

		$sql4="UPDATE detalle_veredas	 
		set 		 
		cajas=".$saldo.",
		id_producto=".$id_producto.",
		img_codigo_barra='".$dataImg."',
		tipo_producto='pt',
		id_produccion=".$id_produccion."
		where id=".$cod;
		$resultado=mysql_query($sql4,$conexion->link);
	}
}
echo $dataImg;
?>