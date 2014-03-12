<?

session_start();
include "../../conexao.php";


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}

if($_GET['d'] == ''){ $dia = date("d"); } else if($_GET['d'] == 'Todos'){ $dia = '';} else { $dia = $_GET['d'];}
if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}



$conANALISE = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '1' && data LIKE '%".$ano.$mes.$dia."%' && status = 'ANÁLISE' && monitor LIKE '%".$loginMONITOR."%'");
$totalANALISE = mysql_num_rows($conANALISE);

$conAPROVADO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '1' && data LIKE '%".$ano.$mes.$dia."%' && status = 'APROVADO' && monitor LIKE '%".$loginMONITOR."%'");
$totalAPROVADO = mysql_num_rows($conAPROVADO);

$conDEVOLVIDO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '1' && data LIKE '%".$ano.$mes.$dia."%' && status = 'DEVOLVIDO' && monitor LIKE '%".$loginMONITOR."%'");
$totalDEVOLVIDO = mysql_num_rows($conDEVOLVIDO);

$conGRAVADO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '1' && data LIKE '%".$ano.$mes.$dia."%' && status = 'GRAVADO' && monitor LIKE '%".$loginMONITOR."%'");
$totalGRAVADO = mysql_num_rows($conGRAVADO);

$conGRAVAR = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '1' && data LIKE '%".$ano.$mes.$dia."%' && status = 'GRAVAR' && monitor LIKE '%".$loginMONITOR."%'");
$totalGRAVAR = mysql_num_rows($conGRAVAR);

$conSEMCONTATO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '1' && data LIKE '%".$ano.$mes.$dia."%' && status = 'SEM CONTATO' && monitor LIKE '%".$loginMONITOR."%'");
$totalSEMCONTATO = mysql_num_rows($conSEMCONTATO);


switch ($mes) {
        case "01":    $m = Janeiro;     break;
        case "02":    $m = Fevereiro;   break;
        case "03":    $m = Março;       break;
        case "04":    $m = Abril;       break;
        case "05":    $m = Maio;        break;
        case "06":    $m = Junho;       break;
        case "07":    $m = Julho;       break;
        case "08":    $m = Agosto;      break;
        case "09":    $m = Setembro;    break;
        case "10":    $m = Outubro;     break;
        case "11":    $m = Novembro;    break;
        case "12":    $m = Dezembro;    break; 
 }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Pacotes Claro TV</title>
        <link rel="stylesheet" href="style-clarotv-pacotes.css" type="text/css">
        <script src="amcharts.js" type="text/javascript"></script>         
        <script src="jquery.js" type="text/javascript"></script>         
        <script type="text/javascript">
            var chart;

            var chartData = [{
                country: "1",
                visits: <?= $totalANALISE;?>
            }, {
                country: "2",
                visits: <?= $totalAPROVADO;?>
            }, {
                country: "3",
                visits: <?= $totalDEVOLVIDO;?>
            }, {
                country: "3",
                visits: <?= $totalGRAVADO;?>
            }, {
                country: "3",
                visits: <?= $totalGRAVAR;?>
            }, {
                country: "3",
                visits: <?= $totalSEMCONTATO;?>
            }];


            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();

                // title of the chart
                chart.addTitle("", 16);

                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "0%";
                chart.startDuration = 2;
                chart.labelRadius = 15;

                // the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE                                 
                chart.write("chartdiv");
            });
        
		$(document).ready(function(){
			
			$("tspan").fadeOut(1);
			
			$("#chartdiv tspan").live("click",function(){ 
			
			$(this).css('display','none');
			
			});
			
			
			});
        
        </script>
    </head>
    
    <body>
        <div id="chartdiv" style="width:400px; height:380px;"></div>
        
		<div id="legenda1">
        <span class="qdr1"></span> <span class="leg1">Análise <span style="font-size:10px">(<?= $totalANALISE;?>)</span></span> 
        <span class="qdr2"></span> <span class="leg2">Aprovado <span style="font-size:10px">(<?= $totalAPROVADO;?>)</span></span>
        <span class="qdr3"></span> <span class="leg3">Devolvido <span style="font-size:10px">(<?= $totalDEVOLVIDO;?>)</span></span>
        </div>
		
        <div id="legenda">
        <span class="qdr4"></span> <span class="leg4">Gravado <span style="font-size:10px">(<?= $totalGRAVADO;?>)</span></span> 
        <span class="qdr5"></span> <span class="leg5">Gravar <span style="font-size:10px">(<?= $totalGRAVAR;?>)</span></span>
        <span class="qdr6"></span> <span class="leg6">S/Contato <span style="font-size:10px">(<?= $totalSEMCONTATO;?>)</span></span>
        </div>
    </body>

</html>