<?

session_start();
include "../../conexao.php";


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}

if($_GET['d'] == ''){ $dia = date("d"); } else if($_GET['d'] == 'Todos'){ $dia = '';} else { $dia = $_GET['d'];}
if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}



$conBOLETO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && pagamento LIKE '%BOLETO%' && monitor LIKE '%".$loginMONITOR."%'");
$totalBOLETO = mysql_num_rows($conBOLETO);

$conCARTAO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && pagamento LIKE '%CARTÃO DE CRÉDITO%' && monitor LIKE '%".$loginMONITOR."%'");
$totalCARTAO  = mysql_num_rows($conCARTAO);

/*
 * $conPENTREGA = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && pagamento LIKE '%PRONTA ENTREGA%' && monitor LIKE '%".$loginMONITOR."%'");
 * $totalPENTREGA = mysql_num_rows($conPENTREGA);
 * */

$conDEPOSITO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && pagamento LIKE '%DEPÓSITO%' && monitor LIKE '%".$loginMONITOR."%'");
$totalDEPOSITO  = mysql_num_rows($conDEPOSITO);

$conGRATIS = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && pagamento LIKE '%GRÁTIS%' && monitor LIKE '%".$loginMONITOR."%'");
$totalGRATIS  = mysql_num_rows($conGRATIS);

$conPAGSEGURO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && pagamento LIKE '%PAGSEGURO%' && monitor LIKE '%".$loginMONITOR."%'");
$totalPAGSEGURO  = mysql_num_rows($conPAGSEGURO);

$conDINHEIRO = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '3' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && status = 'FINALIZADA' && pagamento LIKE '%DINHEIRO%' && monitor LIKE '%".$loginMONITOR."%'");
$totalDINHEIRO  = mysql_num_rows($conDINHEIRO);

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
                visits: <?= $totalBOLETO;?>
            }, {
                country: "2",
                visits: <?= $totalCARTAO;?>
            }, {
                country: "3",
                visits: <?= $totalDEPOSITO;?>
            }, {
                country: "4",
                visits: <?= $totalGRATIS;?>
            }, {
                country: "5",
                visits: <?= $totalPAGSEGURO;?>
            }, {
                country: "6",
                visits: <?= $totalDINHEIRO;?>

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
        <div id="chartdiv" style="positions:relative;width:420px; height:400px;margin-top:-135px;"></div>
        
        <div id="legenda" class="new">
			<div class="i">
        	<a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=&f=BOLETO&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
    	    	<div class="qdr1" title="Visualizar vendas com pagamento por Boleto"></div> 
    	    	<div class="leg1">Boleto </div>
    	    	<div class="leg6" style="font-size:10px">(<?= $totalBOLETO;?>)</div>
            </a>    
            </div>
            
            <div class="i">
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=&f=CART%C3O+DE+CR%C9DITO&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
	        	<div class="qdr2" title="Visualizar vendas com pagamento por Cartão de Crédito"></div> 
				<div class="leg2">Cartão </div>
				<div class="leg6" style="font-size:10px">(<?= $totalCARTAO;?>)</div>
        	</a>
        	</div>

            <div class="i">
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=&f=PRONTA+ENTREGA&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
            	<div class="qdr3" title="Visualizar vendas com pagamento por Depósito"></div> 
            	<div class="leg3">Depósito </div>
            	<div class="leg6" style="font-size:10px">(<?= $totalDEPOSITO;?>)</div>
            </a>
            </div>
            
            <div class="i">
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=&f=PRONTA+ENTREGA&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
            	<div class="qdr4" title="Visualizar vendas gratis"></div> 
            	<div class="leg4">Grátis </div>
            	<div class="leg6" style="font-size:10px">(<?= $totalGRATIS;?>)</div>
            </a>
            </div>
            

            <div class="i" style="clear:both">
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=&f=PAGSEGURO&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
            	<span class="qdr5" title="Visualizar vendas com pagamento por Pagseguro"></span> 
            	<span class="leg5">Pagseguro </span>
            	<span class="leg6" style="font-size:10px">(<?= $totalPAGSEGURO;?>)</span>
            </a>
            </div>
            

            <div class="i">
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=clarofixo&o=&m=&t=&f=DINHEIRO&s=&v=&i=&de=&di=&tpv=&b=" target="_top">
            	<span class="qdr6" title="Visualizar vendas com pagamento em dinheiro"></span> 
            	<span class="leg6">Dinheiro </span>
            	<span class="leg6" style="font-size:10px">(<?= $totalDINHEIRO;?>)</span>
            </a>
            </div>
            

        </div>
        
        
    </body>

</html>
