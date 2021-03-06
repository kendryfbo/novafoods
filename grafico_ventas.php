<?php
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_line.php');
include_once("../clases/conexion.php");
$conexion= new conexion();  
$sql="SELECT IFNULL((SELECT SUM( total ) FROM facturas group by total ) , 0) AS suma_bod
		from facturas";				
$resultado=mysql_query($sql,$conexion->link);
$mensaje=mysql_fetch_array($resultado);
 
$datay1 = array(20,15,23,15,80,20,45,10,5,45,6000);
$datay2 = array(12,9,12,8,41,15,30,8,48,36,14,25);

// Setup the graph
$graph = new Graph(900,400);
$graph->SetScale("textlin");
 
$theme_class=new UniversalTheme;
 
$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Evolucion de Ventas');
$graph->SetBox(false);
 
$graph->img->SetAntiAliasing();
 
$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
 
$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('Enero','Febrero','Marzo','Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Noviembre', 'Octubre', 'Diciembre'));
$graph->xgrid->SetColor('#E3E3E3');
 
// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Gerencia');
 
// Create the second line
$p2 = new LinePlot($datay2);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('Vendedores');
 
$graph->legend->SetFrameWeight(1);
 
// Output line
$graph->Stroke();
?>
 
 