<?

include "../conexao.php";

if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}
$operador = $_GET['o'];
if(isset($_GET['produto'])){
	$produto_id = $_GET['produto'];
}else{
	$produto_id=03;
}
$conVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador."' && data LIKE '%".$ano.$mes."%'  ORDER BY status ASC");
$totalVENDAS = mysql_num_rows($conVENDAS);


$conINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador ."' && status = 'FINALIZADA' && data_instalacao LIKE '%".$ano.$mes."%'");
$totalINST = mysql_num_rows($conINST);

$conRES = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador ."' && status = 'RESTRIÇÃO' && data LIKE '%".$ano.$mes."%'");
$totalRES = mysql_num_rows($conRES);

$conCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador ."' && status = 'CANCELADO' && data LIKE '%".$ano.$mes."%'");
$totalCANC = mysql_num_rows($conCANC);

$conDEVOLVIDO = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador."' && data LIKE '%".$ano.$mes."%' && status = 'DEVOLVIDO'");
$totalCONECT = mysql_num_rows($conDEVOLVIDO);

switch (date("m")) {
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
<?

// Valores
$v1 = $totalVENDAS;
$v2 = $totalINST;
$v3 = $totalDEVOLVIDO;
$v4 = $totalRES;
$v5 = $totalCANC;


// Nomes dos valores
$x1 = 'Vendas';
$x2 = 'Finalizadas';
$x3= 'Devolvidas';
$x4 = 'Restrições';
$x5 = 'Canceladas';


// Tamanho
$w = 600;
$h = 350;


/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
// Porcentagens
$p1 = ceil($v1*100/(max($v1,$v2,$v3,$v4,$v5)));
$p2 = ceil($v2*100/(max($v1,$v2,$v3,$v4,$v5)));
$p3 = ceil($v3*100/(max($v1,$v2,$v3,$v4,$v5)));
$p4 = ceil($v4*100/(max($v1,$v2,$v3,$v4,$v5)));
$p5 = ceil($v5*100/(max($v1,$v2,$v3,$v4,$v5)));

// Linhas
$l1 = ceil(((max($v1,$v2,$v3,$v4,$v5))*90)/100);
$l2 = ceil(((max($v1,$v2,$v3,$v4,$v5))*70)/100);
$l3 = ceil(((max($v1,$v2,$v3,$v4,$v5))*50)/100);
$l4 = ceil(((max($v1,$v2,$v3,$v4,$v5))*30)/100);
$l5 = ceil(((max($v1,$v2,$v3,$v4,$v5))*10)/100);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gráfico por Operador</title>


<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function(e) {
    
		
$('#chart1').animate({height:'<?= $p1;?>%'},1700);

$('#chart2').animate({height:'<?= $p2;?>%'},1500);
$('#chart4').animate({height:'<?= $p4;?>%'},1500);	
$('#chart5').animate({height:'<?= $p5;?>%'},1500);
	
$('#chart3').animate({height:'<?= $p3;?>%'},1700, function(){	
	
$('.v').animate({top:'-15px'},1000);	
	});
	
});


function showinfo(id){

document.getElementById(id).style.display = 'block';	
	
	}
	
function hideinfo(id){

document.getElementById(id).style.display = 'none';	
	
	}	


</script>


</head>

<style type="text/css">

body{font-family:Arial, Helvetica, sans-serif; margin:0 0 0 0;}


#top{width:<?= $w;?>px; text-align:center; color:#999; font-size:12px; font-weight:bold; background-color:#feffff; height:25px;}

#content{position:absolute; width:<?= $w;?>px; height:<?= $h;?>px; cursor:default; background: #feffff; /* Old browsers */
background: -moz-linear-gradient(top,  #feffff 0%, #f6f6f6 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#feffff), color-stop(100%,#f6f6f6)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #feffff 0%,#f6f6f6 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #feffff 0%,#f6f6f6 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #feffff 0%,#f6f6f6 100%); /* IE10+ */
background: linear-gradient(to bottom,  #feffff 0%,#f6f6f6 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#feffff', endColorstr='#f6f6f6',GradientType=0 ); /* IE6-9 */
}

#l1{position:absolute; width:100%; height:1px; background-color:#CCC; bottom:90%}
#n1{position:absolute; padding-left:5px; font-size:16px; color:#bbb; bottom:90%}

#l2{position:absolute; width:100%; height:1px; background-color:#CCC; bottom:70%}
#n2{position:absolute; padding-left:5px; font-size:16px; color:#bbb; bottom:70%}

#l3{position:absolute; width:100%; height:1px; background-color:#CCC; bottom:50%}
#n3{position:absolute; padding-left:5px; font-size:16px; color:#bbb; bottom:50%}

#l4{position:absolute; width:100%; height:1px; background-color:#CCC; bottom:30%}
#n4{position:absolute; padding-left:5px; font-size:16px; color:#bbb; bottom:30%}

#l5{position:absolute; width:100%; height:1px; background-color:#CCC; bottom:10%}
#n5{position:absolute; padding-left:5px; font-size:16px; color:#bbb; bottom:10%}


#chart1{position:absolute; width:60px; height:0%; background: #fcf400; /* Old browsers */
background: -moz-linear-gradient(top,  #fcf400 0%, #ffcc00 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fcf400), color-stop(100%,#ffcc00)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #fcf400 0%,#ffcc00 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #fcf400 0%,#ffcc00 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #fcf400 0%,#ffcc00 100%); /* IE10+ */
background: linear-gradient(to bottom,  #fcf400 0%,#ffcc00 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcf400', endColorstr='#ffcc00',GradientType=0 ); /* IE6-9 */
 left:10%; bottom:0%;}

#chart2{position:absolute; width:60px; height:0%; background: #0080bc; /* Old browsers */
background: -moz-linear-gradient(top,  #0080bc 0%, #003399 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0080bc), color-stop(100%,#003399)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #0080bc 0%,#003399 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #0080bc 0%,#003399 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #0080bc 0%,#003399 100%); /* IE10+ */
background: linear-gradient(to bottom,  #0080bc 0%,#003399 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0080bc', endColorstr='#003399',GradientType=0 ); /* IE6-9 */
 left:30%; bottom:0%;}

#chart3{position:absolute; width:60px; height:0%; background: rgb(249,187,17); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(249,187,17,1) 1%, rgba(249,125,17,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,rgba(249,187,17,1)), color-stop(100%,rgba(249,125,17,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(249,187,17,1) 1%,rgba(249,125,17,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(249,187,17,1) 1%,rgba(249,125,17,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(249,187,17,1) 1%,rgba(249,125,17,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(249,187,17,1) 1%,rgba(249,125,17,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9bb11', endColorstr='#f97d11',GradientType=0 ); /* IE6-9 */

 left:50%; bottom:0px;}
 
 #chart4{position:absolute; width:60px; height:0%; background: #ff3019; /* Old browsers */
background: -moz-linear-gradient(top,  #ff3019 0%, #cf0404 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff3019), color-stop(100%,#cf0404)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ff3019 0%,#cf0404 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=0 ); /* IE6-9 */
 left:70%; bottom:0px;}
 
 #chart5{position:absolute; width:60px; height:0%; background: rgb(249,187,17); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(249,187,17,1) 1%, rgba(249,125,17,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,rgba(249,187,17,1)), color-stop(100%,rgba(249,125,17,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(249,187,17,1) 1%,rgba(249,125,17,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(249,187,17,1) 1%,rgba(249,125,17,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(249,187,17,1) 1%,rgba(249,125,17,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(249,187,17,1) 1%,rgba(249,125,17,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9bb11', endColorstr='#f97d11',GradientType=0 ); /* IE6-9 */

 left:90%; bottom:0px;}
 


.chart:hover{ border:#fdfdfd solid 1px; border-bottom:0px;
	
	-webkit-box-shadow: 1px 1px 3px 2px #BBB ;
box-shadow: 1px 1px 3px 2px #aaa;  }

.info{ position:absolute; min-width:80px; padding-left:3px; padding-right:3px; height:35px; vertical-align:middle; left:30px; font-size:10px; top:5px; text-align:center; background-color:#FFF; z-index:100; display:none;

-webkit-box-shadow: 0px 0px 2px 1px #BBB ;
box-shadow: 0px 0px 2px 1px #BBB; }


#i1{<? if($p1>23){?>
-webkit-border-radius: 4px 4px 4px 0px;
border-radius: 4px 4px 4px 0px; 
<? } else { ?>
-webkit-border-radius: 0px 4px 4px 4px;
border-radius: 0px 4px 4px 4px; 
<? } ?>
}

#i2{<? if($p2>23){?>
-webkit-border-radius: 4px 4px 4px 0px;
border-radius: 4px 4px 4px 0px; 
<? } else { ?>
-webkit-border-radius: 0px 4px 4px 4px;
border-radius: 0px 4px 4px 4px; 
<? } ?>
}

#i3{<? if($p3>23){?>
-webkit-border-radius: 4px 4px 4px 0px;
border-radius: 4px 4px 4px 0px; 
<? } else { ?>
-webkit-border-radius: 0px 4px 4px 4px;
border-radius: 0px 4px 4px 4px; 
<? } ?>
}

#i4{<? if($p4>23){?>
-webkit-border-radius: 4px 4px 4px 0px;
border-radius: 4px 4px 4px 0px; 
<? } else { ?>
-webkit-border-radius: 0px 4px 4px 4px;
border-radius: 0px 4px 4px 4px; 
<? } ?>
}
#i5{<? if($p5>23){?>
-webkit-border-radius: 4px 4px 4px 0px;
border-radius: 4px 4px 4px 0px; 
<? } else { ?>
-webkit-border-radius: 0px 4px 4px 4px;
border-radius: 0px 4px 4px 4px; 
<? } ?>
}
#x{ position:absolute; width:100%; color:#565656; top:100%; height:20px; font-size:10px; background: #ffffff; /* Old browsers */
background: -moz-linear-gradient(top,  #ffffff 0%, #f1f1f1 50%, #e1e1e1 51%, #f6f6f6 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(50%,#f1f1f1), color-stop(51%,#e1e1e1), color-stop(100%,#f6f6f6)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 ); /* IE6-9 */

}

#x1{position:absolute; left:10%; top:2px;}
#x2{position:absolute; left:30%; top:2px;}
#x3{position:absolute; left:50%; top:2px;}
#x4{position:absolute; left:70%; top:2px;}
#x5{position:absolute; left:90%; top:2px;}

.v{position:absolute; top:5px; text-align:center; font-size:12px; width:100%}

</style>


<script>
$(function() {
  var ele = $('#v1');
  var clr = null;
  var rand = 0;
  (loop = function() { 
    clearTimeout(clr);
    (inloop = function() {
		if(rand < <?= $v1;?>){
      ele.html(rand+=<?= ceil($v1/40);?>);} else {ele.html(<?= $v1;?>)}
      if(!(rand % <?= $v1;?>)) {
        return;
      }
      clr = setTimeout(inloop, 30);
    })();  
  })();
});

$(function() {
  var ele2 = $('#v2');
  var clr2 = null;
  var rand2 = 0;
  (loop2 = function() { 
    clearTimeout(clr2);
    (inloop2 = function() {
		if(rand2 < <?= $v2;?>){
      ele2.html(rand2+=<?= ceil($v2/40);?>);} else {ele2.html(<?= $v2;?>)}
      if(!(rand2 % <?= $v2;?>)) {
        return;
      }
      clr2 = setTimeout(inloop2, 30);
    })();  
  })();
});

$(function() {
  var ele3 = $('#v3');
  var clr3 = null;
  var rand3 = 0;
  (loop3 = function() { 
    clearTimeout(clr3);
    (inloop3 = function() {
		if(rand3 < <?= $v3;?>){
      ele3.html(rand3+=<?= ceil($v3/40);?>);} else {ele3.html(<?= $v3;?>)}
      if(!(rand3 % <?= $v3;?>)) {
        return;
      }
      clr3 = setTimeout(inloop3, 30);
    })();  
  })();
});

$(function() {
  var ele4 = $('#v4');
  var clr4 = null;
  var rand4 = 0;
  (loop4 = function() { 
    clearTimeout(clr4);
    (inloop4 = function() {
		if(rand4 < <?= $v4;?>){
      ele4.html(rand4+=<?= ceil($v4/40);?>);} else {ele4.html(<?= $v4;?>)}
      if(!(rand4 % <?= $v4;?>)) {
        return;
      }
      clr4 = setTimeout(inloop4, 30);
    })();  
  })();
});

$(function() {
  var ele5 = $('#v5');
  var clr5 = null;
  var rand5 = 0;
  (loop5 = function() { 
    clearTimeout(clr5);
    (inloop5 = function() {
		if(rand5 < <?= $v5;?>){
      ele5.html(rand5+=<?= ceil($v5/40);?>);} else {ele5.html(<?= $v5;?>)}
      if(!(rand5 % <?= $v5;?>)) {
        return;
      }
      clr5 = setTimeout(inloop5, 30);
    })();  
  })();
});
</script>

<body>


<div id="top">
</div>

<div id="content">

<div id="l1"></div>
<div id="n1"><?= $l1;?></div>
<div id="l2"></div>
<div id="n2"><?= $l2;?></div>
<div id="l3"></div>
<div id="n3"><?= $l3;?></div>
<div id="l4"></div>
<div id="n4"><?= $l4;?></div>
<div id="l5"></div>
<div id="n5"><?= $l5;?></div>

<div id="chart1" class="chart" onmouseover="showinfo('i1')" onmouseout="hideinfo('i1')">
<div id="v1" class="v"><?= $v1;?></div>
<div id="i1" class="info" onmouseover="showinfo('i1')" onmouseout="hideinfo('i1')">
<b><?= $m.' '.$ano;?></b><br />
<?= $x1;?>: <b><?= $v1;?></b>
</div>
</div>

<div id="chart2" class="chart" onmouseover="showinfo('i2')" onmouseout="hideinfo('i2')">
<div id="v2" class="v"><?= $v2;?></div>
<div id="i2" class="info" onmouseover="showinfo('i2')" onmouseout="hideinfo('i2')">
<b><?= $m.' '.$ano;?></b><br />
<?= $x2;?>: <b><?= $v2;?></b>
</div>
</div>

<div id="chart3" class="chart" onmouseover="showinfo('i3')" onmouseout="hideinfo('i3')">
<div id="v3" class="v"><?= $v3;?></div>
<div id="i3" class="info" onmouseover="showinfo('i3')" onmouseout="hideinfo('i3')">
<b><?= $m.' '.$ano;?></b><br />
<?= $x3;?>: <b><?= $v3;?></b>
</div>
</div>

<div id="chart4" class="chart" onmouseover="showinfo('i4')" onmouseout="hideinfo('i4')">
<div id="v4" class="v"><?= $v4;?></div>
<div id="i4" class="info" onmouseover="showinfo('i4')" onmouseout="hideinfo('i4')">
<b><?= $m.' '.$ano;?></b><br />
<?= $x4;?>: <b><?= $v4;?></b>
</div>
</div>

<div id="chart5" class="chart" onmouseover="showinfo('i5')" onmouseout="hideinfo('i5')">
<div id="v5" class="v"><?= $v5;?></div>
<div id="i5" class="info" onmouseover="showinfo('i5')" onmouseout="hideinfo('i5')">
<b><?= $m.' '.$ano;?></b><br />
<?= $x5;?>: <b><?= $v5;?></b>
</div>
</div>

<div id="x">

<div id="x1"><?= $x1;?></div>
<div id="x2"><?= $x2;?></div>
<div id="x3"><?= $x3;?></div>
<div id="x4"><?= $x4;?></div>
<div id="x5"><?= $x5;?></div>

</div>


</div>


</body>
</html>