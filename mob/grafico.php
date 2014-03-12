<?php
	include "inc/libchart/classes/libchart.php";
	include "inc/rel.php";
	
	system('rm img/graficos/*', $retval);
	
	
	
	switch($_GET['pro']){

	

	case 1: $nomeProduto = "Claro TV"; $logo = "claro"; break;

	case 2: $nomeProduto = "Claro 3G"; $logo = "claro"; break;

	case 3: $nomeProduto = "Claro Fixo"; $logo = "claro"; break;

	case 4: $nomeProduto = "Oi TV"; $logo = "oi"; break;

	case 5: $nomeProduto = "Oi Fixo"; $logo = "oi"; break;

	case 6: $nomeProduto = "Oi Velox"; $logo = "oi"; break;

	

	}
	
	$chart = new HorizontalBarChart(300, 400);
	
	
	$dataSet = new XYDataSet();
	
	
	$i='1';
	foreach($label as $l){
		
		$dataSet->addPoint(new Point($l, $bar[$i]));
		$i++;
	}
		
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 20, 25, 70));
	$chart->setTitle($nomeProduto);
	
	$tempo = time();
	$chart->render("img/graficos/".$tempo.".png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
	<title>Claro Fixo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	
</head>
<body>
	<div id="submenu">

		<table border="0" width="100%" cellpadding="0" cellspacing="0">

		<tr>

		<td width="40px" align="center"><img src="img/menu-bt-logo-<?= $logo;?>.png" /></td>	

		<td style="font-size:14px; color:#6b6262; font-weight:bold;"><?= $nomeProduto;?></td>			

		<td></td>
		</tr>



		</table>

	</div>

	<center><img alt="Consolidado Claro Fixo"  src="img/graficos/<?= $tempo; ?>.png"/></center>
</body>
</html>
