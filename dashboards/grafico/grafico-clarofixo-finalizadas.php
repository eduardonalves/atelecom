<?

session_start();
include "../../conexao.php";


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}

if($_GET['d'] == ''){ $dia = date("d"); } else if($_GET['d'] == 'Todos'){ $dia = '';} else { $dia = $_GET['d'];}
if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Finalizadas Claro Fixo</title>
        <script src="jquery.js" type="text/javascript"></script>  
        <script src="../../js/jquery-1.8.2.min.js" type="text/javascript"></script>         
       
        <script type="text/javascript">

			function togglechart(f,t){
				
				$(f).toggle(1000);
				$(t).toggle(1000);
				
				}


        
        </script>
        
        
        <style type="text/css">
		
		.frame{ position:absolute; top:0px; left:0px;}
		
		.btl{ position:absolute; background:#cbcbcb; left:5px; top:40%; padding:5px 6px 0px 5px;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		z-index:10;
 			}
			
		.btr{ position:absolute; background:#cbcbcb; right:5px; top:40%; padding:5px 6px 0px 5px;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		z-index:10;
 			}	
			
			.btl:hover,.btr:hover{background:#bababa; cursor:pointer; }
		</style>
        
    </head>
    
    <body>



<!-- Gráfico 1: FORMA DE PAGAMENTO -->
<div id="fameholder1">

<div class="btr">
<img src="../../img/arrow-r.png" onClick="togglechart('#fameholder1','#fameholder2');" />
</div>

<iframe id="frame1" class="frame" src="grafico-clarofixo-pagamento.php?d=<?= $_GET['d'];?>&m=<?= $_GET['m'];?>&a=<?= $_GET['a'];?>" scrolling="no" frameborder="0" width="100%" height="320px" ></iframe>

</div>
<!-- Fim Gráfico 1: FORMA DE PAGAMENTO -->


<!-- Gráfico 2: TIPO VENDA -->

<div id="fameholder2" style="display:none">
<div class="btl">
<img src="../../img/arrow-l.png" onClick="togglechart('#fameholder2','#fameholder1');"/>
</div>

<div class="btr">
<img src="../../img/arrow-r.png" onClick="togglechart('#fameholder2','#fameholder3');" />
</div>

<iframe id="frame2" class="frame" src="grafico-clarofixo-tipovenda.php?d=<?= $_GET['d'];?>&m=<?= $_GET['m'];?>&a=<?= $_GET['a'];?>" scrolling="no" frameborder="0" width="100%" height="320px" ></iframe>

</div>
<!-- Fim Gráfico 2: TIPO VENDA -->


<!-- Gráfico 3: PLANOS -->

<div id="fameholder3" style="display:none">
<div class="btl">
<img src="../../img/arrow-l.png" onClick="togglechart('#fameholder3','#fameholder2');"/>
</div>

<iframe id="frame3" class="frame" src="grafico-clarofixo-pacotes.php?d=<?= $_GET['d'];?>&m=<?= $_GET['m'];?>&a=<?= $_GET['a'];?>" scrolling="no" frameborder="0" width="100%" height="320px" ></iframe>

</div>
<!-- Fim Gráfico 3: PLANOS -->

    </body>

</html>