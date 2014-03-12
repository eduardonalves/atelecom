<?

session_start();
include "../../conexao.php";


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}


if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}



$con10 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '2' && data_autorizacao LIKE '%".$ano.$mes."%' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS' || status = 'ATIVADO') && plano LIKE '%10GB%' && monitor LIKE '%".$loginMONITOR."%'");
$total10 = mysql_num_rows($con10);

$con5 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '2' && data_autorizacao LIKE '%".$ano.$mes."%' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS' || status = 'ATIVADO') && plano LIKE '%5GB%' && monitor LIKE '%".$loginMONITOR."%'");
$total5  = mysql_num_rows($con5 );

$con3 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '2' && data_autorizacao LIKE '%".$ano.$mes."%' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS' || status = 'ATIVADO') && plano LIKE '%3GB%' && monitor LIKE '%".$loginMONITOR."%'");
$total3 = mysql_num_rows($con3);

$con2 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '2' && data_autorizacao LIKE '%".$ano.$mes."%' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS' || status = 'ATIVADO') && plano LIKE '%2GB%' && monitor LIKE '%".$loginMONITOR."%'");
$total2 = mysql_num_rows($con2);


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
                visits: <?= $total10;?>
            }, {
                country: "2",
                visits: <?= $total5;?>
            }, {
                country: "3",
                visits: <?= $total3;?>
            }, {
                country: "4",
                visits: <?= $total2;?>
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
        <div id="chartdiv" style="width:420px; height:400px;"></div>
        
        <div id="legenda1">
    	    <span class="qdr1"></span> <span class="leg1">10GB <span style="font-size:10px">(<?= $total10;?>)</span></span> 
	        <span class="qdr2"></span> <span class="leg2">5GB <span style="font-size:10px">(<?= $total5;?>)</span></span>
        	<span class="qdr3"></span> <span class="leg3">3GB <span style="font-size:10px">(<?= $total3;?>)</span></span>
        </div>
        
        <div id="legenda">
        	<span class="qdr4"></span> <span class="leg4">2GB <span style="font-size:10px">(<?= $total2;?>)</span></span> 
        </div>
    </body>

</html>