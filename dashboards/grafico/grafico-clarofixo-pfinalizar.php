<?

session_start();
include "../../conexao.php";


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}

if($_GET['d'] == ''){ $dia = date("d"); } else if($_GET['d'] == 'Todos'){ $dia = '';} else { $dia = $_GET['d'];}
if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}



$conENVIARGRAVACAO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data LIKE '%".$ano.$mes.$dia."%' && status = 'ENVIAR GRAVACAO' && monitor LIKE '%".$loginMONITOR."%'");
$totalENVIARGRAVACAO = mysql_num_rows($conENVIARGRAVACAO);

$conBOLETOGERADO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data LIKE '%".$ano.$mes.$dia."%' && status = 'BOLETO GERADO' && monitor LIKE '%".$loginMONITOR."%'");
$totalBOLETOGERADO  = mysql_num_rows($conBOLETOGERADO);


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
        <title>Claro Fixo</title>
        <link rel="stylesheet" href="style-clarofixo.css" type="text/css">
        <script src="amcharts.js" type="text/javascript"></script>         
        <script src="jquery.js" type="text/javascript"></script>         
        <script type="text/javascript">
            var chart;

            var chartData = [{
                country: "1",
                visits: <?= $totalENVIARGRAVACAO;?>
            }, {
                country: "2",
                visits: <?= $totalBOLETOGERADO;?>
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
        
        <div id="legenda">
        	<a href="../../adm?ve=1&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=&f=&s=ENVIAR+GRAVA%C7%C3O&v=&i=&de=&di=&tpv=&b=" target="_top">
            	<span class="qdr1" title="Visualizar vendas no status Enviar Gravação"></span>
            </a> 
            <span class="leg1" >Env. Grav. <span style="font-size:10px">(<?= $totalENVIARGRAVACAO;?>)</span></span> 
            
            <a href="../../adm?ve=1&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=&f=&s=BOLETO+GERADO&v=&i=&de=&di=&tpv=&b=" target="_top">
            	<span class="qdr2" title="Visualizar vendas no status Boleto Gerado"></span>
            </a> 
            <span class="leg2">Boleto Gerado <span style="font-size:10px">(<?= $totalBOLETOGERADO;?>)</span></span> 
            
        </div>
    </body>

</html>