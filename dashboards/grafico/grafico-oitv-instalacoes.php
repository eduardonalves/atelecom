<?

session_start();
include "../../conexao.php";


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}

if($_GET['d'] == ''){ $dia = date("d"); } else if($_GET['d'] == 'Todos'){ $dia = '';} else { $dia = $_GET['d'];}
if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}



$con1 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '4' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && plano = 'OI TV MEGA HD' && monitor LIKE '%".$loginMONITOR."%'");
$total1 = mysql_num_rows($con1);

$con2 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '4' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && plano = 'OI TV MEGA HBO/MAX HD' && monitor LIKE '%".$loginMONITOR."%'");
$total2  = mysql_num_rows($con2);

$con3 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '4' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && plano = 'OI TV MEGA TELECINE HD' && monitor LIKE '%".$loginMONITOR."%'");
$total3  = mysql_num_rows($con3);

$con4 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '4' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && plano = 'OI TV MEGA CINEMA HD' && monitor LIKE '%".$loginMONITOR."%'");
$total4  = mysql_num_rows($con4);

$con5 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '4' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && plano = 'OI TV MAIS HD' && monitor LIKE '%".$loginMONITOR."%'");
$total5  = mysql_num_rows($con5);

$con6 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '4' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && plano = 'OI TV MAIS TELECINE HD' && monitor LIKE '%".$loginMONITOR."%'");
$total6  = mysql_num_rows($con6);

$con7 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '4' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && plano = 'OI TV MAIS HBO/MAX HD' && monitor LIKE '%".$loginMONITOR."%'");
$total7  = mysql_num_rows($con7);

$con8 = $conexao->query("SELECT * FROM vendas_clarotv  WHERE produto = '4' && data_instalacao LIKE '%".$ano.$mes.$dia."%' && plano = 'OI TV MAIS CINEMA HD' && monitor LIKE '%".$loginMONITOR."%'");
$total8  = mysql_num_rows($con8);

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
        <link rel="stylesheet" href="style-oitv-planos.css" type="text/css">
        <script src="amcharts.js" type="text/javascript"></script>         
        <script src="jquery.js" type="text/javascript"></script>         
        <script type="text/javascript">
            var chart;

            var chartData = [{
                country: "1",
                visits: <?= $total1;?>
            }, {
                country: "2",
                visits: <?= $total2;?>
            },
			   {
                country: "3",
                visits: <?= $total3;?>
            },
			   {
                country: "4",
                visits: <?= $total4;?>
            },
			   {
                country: "5",
                visits: <?= $total5;?>
            },
			   {
                country: "6",
                visits: <?= $total6;?>
            },	
			   {
                country: "7",
                visits: <?= $total7;?>
            },											
			   {
                country: "8",
                visits: <?= $total8;?>
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
        <div id="chartdiv" style="width:400px; height:400px;"></div>
        
                <div id="legenda2">
        	<a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=oi&pro=4&t=OI+TV+MAIS+HBO%2FMAX+HD" target="_top">
            	<span class="qdr7" title="Visualizar vendas no plano Mais HBO/MAX HD"></span>
            </a> 
            <span class="leg7" >Mais HBO/MAX HD <span style="font-size:8px">(<?= $total7;?>)</span></span> 
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=oi&pro=4&t=OI+TV+MAIS+CINEMA+HD" target="_top">
            	<span class="qdr8" title="Visualizar vendas no plano Mais Cinema HD"></span>
            </a> 
            <span class="leg8">Mais Cinema HD <span style="font-size:8px">(<?= $total8;?>)</span></span>
            
        </div>
                <div id="legenda1">
        	<a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=oi&pro=4&t=OI+TV+MEGA+CINEMA+HD" target="_top">
            	<span class="qdr4" title="Visualizar vendas no plano Cinema HD"></span>
            </a> 
            <span class="leg4" >Cinema HD <span style="font-size:8px">(<?= $total4;?>)</span></span> 
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=oi&pro=4&t=OI+TV+MAIS+HD" target="_top">
            	<span class="qdr5" title="Visualizar vendas no plano Mais HD"></span>
            </a> 
            <span class="leg5">Mais HD <span style="font-size:8px">(<?= $total5;?>)</span></span>
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=oi&pro=4&t=OI+TV+MAIS+TELECINE+HD" target="_top">
            	<span class="qdr6" title="Visualizar vendas no plano Mais Telecine HD"></span>
            </a> 
            <span class="leg6">Mais Telecine HD <span style="font-size:8px">(<?= $total6;?>)</span></span>
            
        </div>
      
        
        <div id="legenda">
        	<a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=oi&pro=4&t=OI+TV+MEGA+HD" target="_top">
            	<span class="qdr1" title="Visualizar vendas no plano Mega HD"></span>
            </a> 
            <span class="leg1" >Mega HD <span style="font-size:8px">(<?= $total1;?>)</span></span> 
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=oi&pro=4&t=OI+TV+MEGA+HBO%2FMAX+HD" target="_top">
            	<span class="qdr2" title="Visualizar vendas no plano Mega HBO/MAX HD"></span>
            </a> 
            <span class="leg2">Mega HBO/MAX HD <span style="font-size:8px">(<?= $total2;?>)</span></span>
            
            <a href="../../adm?ve=2&me=<?= $mes;?>&an=<?= $ano;?>&p=oi&pro=4&t=OI+TV+MEGA+TELECINE+HD" target="_top">
            	<span class="qdr3" title="Visualizar vendas no plano Mega Telecine HD"></span>
            </a> 
            <span class="leg3">Mega Telecine HD <span style="font-size:8px">(<?= $total3;?>)</span></span>
            
        </div>
    </body>

</html>