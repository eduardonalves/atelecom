<?

session_start();
include "../../conexao.php";


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}

if($_GET['d'] == ''){ $dia = date("d"); } else if($_GET['d'] == 'Todos'){ $dia = '';} else { $dia = $_GET['d'];}
if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}



$conPRE35 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && plano LIKE '%Pré 35%' && monitor LIKE '%".$loginMONITOR."%'");
$totalPRE35 = mysql_num_rows($conPRE35);

$conPRE35ILIM = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && plano LIKE '%Pré Ilimitado 35%' && monitor LIKE '%".$loginMONITOR."%'");
$totalPRE35ILIM  = mysql_num_rows($conPRE35ILIM );

$conCONTROLE = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && plano LIKE '%Controle Fixo%' && monitor LIKE '%".$loginMONITOR."%'");
$totalCONTROLE = mysql_num_rows($conCONTROLE);

$conPOS33 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && plano LIKE '%Pós 33%' && monitor LIKE '%".$loginMONITOR."%'");
$totalPOS33 = mysql_num_rows($conPOS33);

$conPOSFAV = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && plano LIKE '%Pós Fale a Vontade%' && monitor LIKE '%".$loginMONITOR."%'");
$totalPOSFAV = mysql_num_rows($conPOSFAV);

$conPOSILIM = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && plano LIKE '%Pós Fixo Ilimitado%' && monitor LIKE '%".$loginMONITOR."%'");
$totalPOSILIM = mysql_num_rows($conPOSILIM);


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
        <title>Pacotes Claro Fixo</title>
        <link rel="stylesheet" href="style-clarotv-pacotes.css" type="text/css">
        <script src="amcharts.js" type="text/javascript"></script>         
        <script src="jquery.js" type="text/javascript"></script>         
        <script type="text/javascript">
            var chart;

            var chartData = [{
                country: "1",
                visits: <?= $totalPRE35;?>
            }, {
                country: "2",
                visits: <?= $totalPRE35ILIM;?>
            }, {
                country: "3",
                visits: <?= $totalCONTROLE;?>
            }, {
                country: "4",
                visits: <?= $totalPOS33;?>
            }, {
                country: "5",
                visits: <?= $totalPOSFAV;?>
            }, {
                country: "6",
                visits: <?= $totalPOSILIM;?>
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
        	<a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=Pr%E9+35&f=&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
    	    	<span class="qdr1" title="Visualizar vendas no plano Pré 35"></span> 
            </a>    
            <span class="leg1">Pré 35 <span style="font-size:10px">(<?= $totalPRE35;?>)</span></span> 
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=Pr%E9+Ilimitado+35&f=&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
	        	<span class="qdr2" title="Visualizar vendas no plano Pré Ilimitado 35"></span> 
            <span class="leg2">Pré 35 Ilim. <span style="font-size:10px">(<?= $totalPRE35ILIM;?>)</span></span>
        	</a>
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=Controle+Fixo&f=&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
            	<span class="qdr3" title="Visualizar vendas no plano Controle Fixo"></span> 
            </a>
            <span class="leg3">Controle <span style="font-size:10px">(<?= $totalCONTROLE;?>)</span></span>
        </div>
        
        <div id="legenda">
        	<a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=P%F3s+33+com+Isen%E7%E3o&f=&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
        		<span class="qdr4" title="Visualizar vendas no plano Pós 33 com Isenção"></span> 
            </a>
            <span class="leg4">Pós 33 <span style="font-size:10px">(<?= $totalPOS33;?>)</span></span> 
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=P%F3s+Fale+a+Vontade&f=&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
            	<span class="qdr5" title="Visualizar vendas no plano Pós Fale a Vontade"></span> 
            </a>
            <span class="leg5">Pós FAV <span style="font-size:10px">(<?= $totalPOSFAV;?>)</span></span> 
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=P%F3s+Fixo+Ilimitado&f=&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
        		<span class="qdr6" title="Visualizar vendas no plano Pós Fixo Ilimitado"></span> 
            </a>
            <span class="leg6">Pós Ilim. <span style="font-size:10px">(<?= $totalPOSILIM;?>)</span></span> 

        </div>
    </body>

</html>