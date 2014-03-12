<? 



session_start();





// Verificar se está logado

if(!isset($_SESSION['usuario'])){ ?>

	

<script type="text/javascript">

window.location = 'index.php'

</script>	

	

	

<? }  



$produto_id= '2';

$grupo= '0002';



$hoje = date("Ymd");

$dia = date("d");



if($_GET['m'] != ""){ $mes = $_GET['m']; } else {$mes = date("m");}



if($_GET['an'] != ""){ $ano = $_GET['an']; } else {$ano = date("Y");}



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







//////////////////////////////////

//////NOME DAS ESTATÍSTICAS///////

//////////////////////////////////



$es1 = 'Estatísticas por Dia';

$es2 = 'Instalações por Técnico';

$es3 = 'Vendas por Monitor';

$es4 = 'Vendas por Operador';

$es5 = 'Gravações Auditoria';



if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id']; $acessoUsuario = $USUARIO['acesso_usuario'];}
if(isset($_GET['tipovenda'])){
	 if($_GET['tipovenda']=="INTERNA"){
		
		$tipovendausuario = "&& tipoVenda = 'INTERNA'";
		$tipovendausuario2= "&&vendas_clarotv.tipoVenda = 'INTERNA'";
		$querytipovenda = "&& vendas_clarotv.tipoVenda = 'INTERNA'";

	 }else if($_GET['tipovenda']=="EXTERNA"){
		$tipovendausuario = "&& tipoVenda = 'EXTERNA'";
		$tipovendausuario2= "&&vendas_clarotv.tipoVenda = 'EXTERNA'";
		$querytipovenda = "&& vendas_clarotv.tipoVenda = 'EXTERNA'";

	 }else{
		$querytipovenda="";
		$tipovendausuario = "";
		$tipovendausuario2="";
	 }
}else{
	
	if($acessoUsuario =='INTERNO'){
		$tipovendausuario = "&& tipoVenda = 'INTERNA'";
		$tipovendausuario2= "&& vendas_clarotv.tipoVenda = 'INTERNA'";
	}else if($acessoUsuario =='EXTERNO'){
		$tipovendausuario =  "&& tipoVenda = 'EXTERNA'";
		$tipovendausuario2= "vendas_clarotv.tipoVenda = 'EXTERNA'";
	}else{
		
	}
} 

	if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){ 
			$idsupervisor = $USUARIO['id'];
			$querymonitores = $conexao->query("SELECT * FROM usuarios WHERE supervisor = '$idsupervisor' && acesso_usuario = '".$USUARIO['acesso_usuario']."'");
			$acessoUsuario = $USUARIO['acesso_usuario'];
			$j=0;
			while($row = mysql_fetch_assoc($querymonitores)){
				
				if($j ==0){
					$MONITORES1 = $MONITORES1.'  monitor='.$row['id'].' ' ;
					
					//faco uma segunda concatenação para se adaptar para o inner join da linha 910
					$MONITORES2 = $MONITORES2.'  vendas_clarotv.monitor='.$row['id'].' ' ;	
				}else{
					$MONITORES1 = $MONITORES1.'||  monitor='.$row['id'];
					
					//faco uma segunda concatenação para se adaptar para o inner join da linha 910
					$MONITORES2 = $MONITORES2.' ||  vendas_clarotv.monitor ='.$row['id'];
				}
				$j= $j+1;
			}

	}


?>





<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>

<script type="text/javascript" src="js/calendario.js"></script>

<script type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" type=text/css href="css/ui-lightness/jquery-ui-1.7.3.custom.css" />



<script type="text/javascript">



<? if($_GET['es'] == ''){?>

$(document).ready(function(e) {







$('.menulateral').animate({width:'189px'},1000,function(){

$('#mlateral').fadeIn(500);	



	

	                                                    });



                                });

<? } ?>





function mudacor(id){

	

	document.getElementById(id).style.backgroundColor = "#b8ddf0";

	

	}

	

function mudacorback(id,cor){

	

	document.getElementById(id).style.backgroundColor = cor;

	

	}	



 /*Cria uma função de nome mascara, onde o primeiro argumento passado é um dos

     objetos input O segundo é especificando o tipo de método no qual será tratado*/

    function mascara(o,f){

        v_obj=o;

        v_fun=f;

        setTimeout("execmascara()",1);

    }

    

    function execmascara(){

        /*Pegue o valor do objeto e atribua o resultado da função v_fun; cujo o conteúdo

        da mesma é a função que foi referida e que será utilizada para tratar dos dados*/

        v_obj.value=v_fun(v_obj.value);

    }

    

    function soNumeros(v){

        return v.replace(/\D/g,"");//Exclua tudo que não for numeral e retorne o valor

    }

    

	

    function data(v){

        //Remove tudo o que não é dígito

        v=v.replace(/\D/g,"");

        //Coloca parênteses em volta dos dois primeiros dígitos

        v=v.replace(/^(\d{2})(\d)/g,"$1/$2");

        //Coloca hífen entre o quarto e o quinto dígitos

        v=v.replace(/(\d{2})(\d)/,"$1/$2");

        return v;

    }	







function mostrarinfo(id){

	

	$('#blackout').fadeIn(500);

	$('#preload').fadeIn(500);

    

		

	$('#infooperador').fadeIn(1);

	$('#infooperador').animate({left:'50%',opacity:'1'},500);

	

	$('#infooperador .load').load("includes/infooperador-claro3g.php?id="+id+"&pro=<?= $produto_id;?>&m=<?= $mes;?>&an=<?= $ano;?>", function(){

		

			$('#preload').fadeOut(500);



		

		

		});



	



	

}



function ocultarinfo(id){

	

	$('#blackout').fadeOut(500);

	$('#infooperador').fadeOut(500);

	$('#infooperador').animate({left:'-50%',opacity:'0'},500);

	$('#infooperador .load').load("includes/infooperador.php");

	

}





function carregargrafico(id){
	



	document.getElementById('infoconteudoop'+id).style.display = 'none';

	document.getElementById('tablelistaop'+id).style.display = 'none';

	document.getElementById('tablegraficoop'+id).style.display = '';

	

	document.getElementById('graficoop'+id).innerHTML = '<iframe src="graficos/vendas-por-operador-claro3g?o='+id+'&m=<?= $mes;?>&a=<?= $ano;?>" width="620px" height="410px" frameborder="0" scrolling="no" ></iframe>';

	

	

	}

	

	

function carregarlista(id){

	



	document.getElementById('infoconteudoop'+id).style.display = '';

	document.getElementById('tablelistaop'+id).style.display = '';

	document.getElementById('tablegraficoop'+id).style.display = 'none';

	

	document.getElementById('graficoop'+id).innerHTML = '';

	

	

	}	





</script>





<style type="text/css">



#blackout{position:fixed; top:0px; left:0px; width:100%; height:100%; background-color:#000; z-index:200; opacity: 0.6; display:none; }



.info{ position:fixed; margin:0 0 0 -400px; left:-50%; top:50px; width:800px; height:550px; background-color:#FFF; z-index:250; opacity:0; overflow:auto; display:none;

-webkit-border-radius: 10px;

border-radius: 10px;



-webkit-box-shadow:  0px 0px 10px 2px #999;

        

box-shadow:  0px 0px 10px 2px #999;

 }

 

 



.closeinfo{position:absolute; right:6px; top:3px;     background: none repeat scroll 0 0 #B6B6B6;

	border-radius: 15px;

	color: #FFFFFF;

	float: right;

	height: 15px;

	line-height: 15px;

	padding: 3px;

	margin-top:4px;

	text-align: center;

	width: 15px;

	cursor:pointer;}





.infoconteudo{position:absolute; overflow-y:scroll; width:768px; left:50%; margin:0 0 0 -375px; max-height:410px;}



#preload{ position:absolute; top:50%; left:50%; width:45px; height:45px; margin: -22px 0 0 -22px; display:none}





</style>







<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" href="css/tables.css" />



<div id="blackout"></div>



<div id="infooperador" class="info">

<div class="closeinfo" style="cursor:pointer" onclick="ocultarinfo('#infooperador<?= $OPERADORES['operador_id']?>','0')">X</div>

<div id="preload"><img src="img/preload.gif" /></div>

<div class="load">

</div>

</div>



<!-- SUBMENU -->

<? include "submenu-clarofixo.php";?>

<!-- FIM DO SUBMENU -->







<table width="100%" border="0" cellpadding="0" cellspacing="0">



<tr valign="top">



<!-- /////////// Menu Lateral ////////// -->

<td class="menulateral" width="<? if(!$_GET['es']){?> 0px <? } else {?> 189px <? } ?>" bgcolor="#999999">



<table width="100%" <? if(!$_GET['es']){?> style="display:none" <? } ?> id="mlateral" border="0" cellpadding="0" cellspacing="0">



<tr height="100px">

<td></td>

</tr>



<tr height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=1'" class="<? if($_GET['es'] == '1'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td> &nbsp;  &nbsp; <?= $es1; ?></td>

</tr>



<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=3'"  class="<? if($_GET['es'] == '3'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td> &nbsp;  &nbsp; <?= $es3; ?></td>

</tr>



<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=4'"  class="<? if($_GET['es'] == '4' || $_GET['es'] == ''){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td> &nbsp;  &nbsp; <?= $es4; ?></td>

</tr>



<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=5'"  class="<? if($_GET['es'] == '5'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">

<td> &nbsp;  &nbsp; <?= $es5; ?></td>

</tr>



</table>



</td>







<!-- /////////// Estatísticas ////////// -->

<td>



<center>

<table border="0" width="90%">



<tr valign="bottom" height="40px" align="left">

<td style="font-size:14px; color:#999;">ESTAT&Iacute;STICAS (CLARO 3G)</td>

<td align="right"><img src="img/voltar.png" style="cursor:pointer" onclick="window.location = '?p=clarotv'" /></td>

</tr>



<tr>

<td colspan="2"><hr size="1" color="#CCCCCC" /></td>

</tr>



</table>





<table border="0" width="90%"  bgcolor="#f6f6f6">

<form name="filtro" method="get">

<input type="hidden" name="p" value="<?= $_GET['p'];?>" />

<tr style="font-size:13px" valign="middle" align="left">

<td>Mês: 

<select name="m">

<option value="01" <? if($mes == '01'){ ?> selected="selected" <? } ?>>JANEIRO</option>

<option value="02" <? if($mes == '02'){ ?> selected="selected" <? } ?>>FEVEREIRO</option>

<option value="03" <? if($mes == '03'){ ?> selected="selected" <? } ?>>MARÇO</option>

<option value="04" <? if($mes == '04'){ ?> selected="selected" <? } ?>>ABRIL</option>

<option value="05" <? if($mes == '05'){ ?> selected="selected" <? } ?>>MAIO</option>

<option value="06" <? if($mes == '06'){ ?> selected="selected" <? } ?>>JUNHO</option>

<option value="07" <? if($mes == '07'){ ?> selected="selected" <? } ?>>JULHO</option>

<option value="08" <? if($mes == '08'){ ?> selected="selected" <? } ?>>AGOSTO</option>

<option value="09" <? if($mes == '09'){ ?> selected="selected" <? } ?>>SETEMBRO</option>

<option value="10" <? if($mes == '10'){ ?> selected="selected" <? } ?>>OUTUBRO</option>

<option value="11" <? if($mes == '11'){ ?> selected="selected" <? } ?>>NOVEMBRO</option>

<option value="12" <? if($mes == '12'){ ?> selected="selected" <? } ?>>DEZEMBRO</option>

</select>



| Ano: 

<select name="an">

<? $a = date('Y'); while($a > '2011'){ $an = $a--; ?>



<option value="<?= $an; ?>" <? if($ano == $an){ ?> selected="selected" <? } ?>><?= $an; ?></option>



<? } ?>

</select>
<? if($USUARIO['tipo_usuario']=="ADMINISTRADOR"){ ?>
| Tipo de Venda: 

<select name="tipovenda">



<option value="TODAS" <? if(isset($_GET['tipovenda'])){ if($_GET['tipovenda'] == "TODAS"){ ?> selected="selected" <? }} ?>>Todas</option>

<option value="INTERNA" <? if(isset($_GET['tipovenda'])){ if($_GET['tipovenda'] == "INTERNA"){ ?> selected="selected" <? }} ?>>Interna</option>

<option value="EXTERNA" <? if(isset($_GET['tipovenda'])){ if($_GET['tipovenda'] == "EXTERNA"){ ?> selected="selected" <? }} ?>>Externa</option>



</select>
<? } ?>

<input type="hidden" name="es" value="<?= $_GET['es'];?>" />





<!-- 

| De:



<input type="text" id="calendario" onKeyPress="mascara(this,data)" maxlength="10" size="15" name="d" />



Até:



<input type="text" id="calendario2" onKeyPress="mascara(this,data)" maxlength="10" size="15" name="t" /> -->

&nbsp;

<img src="img/bt_ok.png" style="position:absolute; margin-top:3px; cursor:pointer" onclick="javascript:document.forms.filtro.submit();" />

</td>

</tr>

</form>

</table>





<br />



<? if($_GET['es'] == '1'){?>

<!-- 

////////////////////////////

////ESTATÍSTICAS POR DIA//// 

////////////////////////////

-->





<table border="0" width="90%">





<tr class="tr1">

<td colspan="7" align="center"><b style="color:#FFF"><?= $es1;?></b></td>

</tr>



<tr align="center" style="font-size:10px">

<td width="10px" bgcolor="#ededed">DIA</td>

<td bgcolor="#fcfbce" width="100px">Número de Vendas</td>

<td bgcolor="#ffe186"> &nbsp; Percentual de Vendas &nbsp; </td>

<td bgcolor="#ceedfc" width="100px">Número de Autorizadas</td>

<td bgcolor="#77c8f0"> &nbsp; Percentual de Autorizadas &nbsp; </td>

<td bgcolor="#ffe3e3" width="100px">Número de Cancelamentos</td>

<td bgcolor="#ff9d9d"> &nbsp; Percentual de Cancelamento &nbsp; </td>

</tr>



<? 



if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){ 
	
	//seleciono o total de vendas de todos os monitores daquele supervisor
	$conVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data LIKE '%".$ano.$mes."%' && ($MONITORES1)");
	$totalVENDAS = mysql_num_rows($conVENDAS);
	//seleciono o total de vendas instaladas de todos os monitores daquele supervisor
	$conINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data_autorizacao LIKE '%".$ano.$mes."%' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS') && ($MONITORES1)");
	$totalINST = mysql_num_rows($conINST);
	
	//seleciono o total de vendas canceladas de todos os monitores daquele supervisor
	$conCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && status = 'CANCELADO' && data LIKE '%".$ano.$mes."%' && ($MONITORES1)");
	$totalCANC = mysql_num_rows($conCANC);
}else{
	//senão deixo como estava, selecionando por monitor único
	$conVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data LIKE '%".$ano.$mes."%' && monitor LIKE '%".$loginMONITOR."%'");

	$totalVENDAS = mysql_num_rows($conVENDAS);


	$conINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data_autorizacao LIKE '%".$ano.$mes."%' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS') && monitor LIKE '%".$loginMONITOR."%'");

	$totalINST = mysql_num_rows($conINST);


	$conCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && status = 'CANCELADO' && data LIKE '%".$ano.$mes."%' && monitor LIKE '%".$loginMONITOR."%'");

	$totalCANC = mysql_num_rows($conCANC);

}





$i = 1;



//if($mes == '01' || $mes == '03' || $mes == '05' || $mes == '07' || $mes == '08' || $mes == '10' || $mes == '12'){ $max = '31';} else if($mes == '02'){$max = '29';} else { $max = '30'; }



$max = date("d",mktime(0, 0, 0, ($mes + 1), 0, $ano)); 







$class="tr2";



while($i <= $max){



if ($class=="tr2"){ //alterna a cor

  $class = "tr3";



} else{ $class="tr2";   }



$n = $i++;



if($n < 10){ $n = '0'.$n;}


if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){ 

	$conNUMVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data = '".$ano.$mes.$n."' && ($MONITORES1)");

	$NUMVENDAS = mysql_num_rows($conNUMVENDAS);



	$conNUMINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data_autorizacao = '".$ano.$mes.$n."' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS') && ($MONITORES1)");

	$NUMINST = mysql_num_rows($conNUMINST);



	$conNUMCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && status = 'CANCELADO' && data = '".$ano.$mes.$n."' && ($MONITORES1)");

	$NUMCANC = mysql_num_rows($conNUMCANC);

}else{

	$conNUMVENDAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data = '".$ano.$mes.$n."' && monitor LIKE '%".$loginMONITOR."%'");

	$NUMVENDAS = mysql_num_rows($conNUMVENDAS);



	$conNUMINST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data_autorizacao = '".$ano.$mes.$n."' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS') && monitor LIKE '%".$loginMONITOR."%'");

	$NUMINST = mysql_num_rows($conNUMINST);



	$conNUMCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && status = 'CANCELADO' && data = '".$ano.$mes.$n."' && monitor LIKE '%".$loginMONITOR."%'");

	$NUMCANC = mysql_num_rows($conNUMCANC);

}






if($totalVENDAS > 0){ $porcentVENDAS = ($NUMVENDAS/$totalVENDAS)*100;}

if($totalINST > 0){ $porcentINST = ($NUMINST/$totalINST)*100;}

if($totalCANC > 0){ $porcentCANC = ($NUMCANC/$totalCANC)*100;}



 ?>

<tr align="center" id="<?= $n; ?>" class="<?= $class;?>" style="font-size:10px; height:23px">

<td <? if($dia == $n && $mes == date('m')){?> title="Hoje" style="font-weight:bold" <? } ?>><?= $n.'/'.$mes; ?></td>

<td><?= $NUMVENDAS; ?></td>

<td align="left"><?= ceil($porcentVENDAS); ?>% <div style="width:<?= ceil(($porcentVENDAS)*2);?>px; background-color:#f8cb40; height:3px;"></div></td>

<td><?= $NUMINST; ?></td>

<td align="left"><?= ceil($porcentINST); ?>% <div style="width:<?= ceil(($porcentINST)*2);?>px; background-color:#0095dd; height:3px;"></div></td>

<td><?= $NUMCANC; ?></td>

<td align="left"><?= ceil($porcentCANC); ?>% <div style="width:<?= ceil(($porcentCANC)*2);?>px; background-color:#ec2626; height:3px;"></div></td>

</tr>



<? } ?>



<tr align="center" style="font-size:10px; font-weight:bold" bgcolor="#CCCCCC">

<td>TOTAL</td>

<td><?= $totalVENDAS; ?></td>

<td align="left">100%</td>

<td><?= $totalINST; ?></td>

<td align="left">100%</td>

<td><?= $totalCANC; ?></td>

<td align="left">100%</td>

</tr>





</table>





<br /><br />



<? } ?>







<? if($_GET['es'] == '3'){?>



<!-- 

/////////////////////////////

////VENDAS POR MONITORES//// 

/////////////////////////////

-->



<table border="0" width="90%">



<tr class="tr1">

<td colspan="4" align="center"><b style="color:#FFF"><?= $es3;?></b></td>

</tr>



<? 
if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){
	$conMONITORES = $conexao->query("SELECT usuarios.nome AS nomemonitor,

											usuarios.id AS idmonitor, 

											COUNT(if(vendas_clarotv.data LIKE '%".$ano.$mes."%',1,NULL)) AS vendasfeitas, 

											COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

													  (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS')),1,NULL)) AS vendasfinalizadas, 

											COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

													  (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

													  vendas_clarotv.pagamento = 'BOLETO'),1,NULL)) AS vendasfinalizadasboleto,

											COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

													  (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

													  vendas_clarotv.pagamento = 'CARTÃO DE CRÉDITO'),1,NULL)) AS vendasfinalizadascartao,

											COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

													  (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

													  vendas_clarotv.pagamento = 'PRONTA ENTREGA'),1,NULL)) AS vendasfinalizadaspe

											FROM vendas_clarotv 

											INNER JOIN usuarios 

											ON vendas_clarotv.monitor=usuarios.id 

											WHERE vendas_clarotv.produto = '".$produto_id."' && 

												  vendas_clarotv.monitor != '' && 

												  (vendas_clarotv.data LIKE '%".$ano.$mes."%' || 

												   vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%') && 

												  ($MONITORES2) 

											GROUP BY vendas_clarotv.monitor 

											ORDER BY usuarios.nome ");


}else{
	$conMONITORES = $conexao->query("SELECT usuarios.nome AS nomemonitor,

											usuarios.id AS idmonitor, 

											COUNT(if(vendas_clarotv.data LIKE '%".$ano.$mes."%',1,NULL)) AS vendasfeitas, 

											COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

													  (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS')),1,NULL)) AS vendasfinalizadas, 

											COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

													  (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

													  vendas_clarotv.pagamento = 'BOLETO'),1,NULL)) AS vendasfinalizadasboleto,

											COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

													  (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

													  vendas_clarotv.pagamento = 'CARTÃO DE CRÉDITO'),1,NULL)) AS vendasfinalizadascartao,

											COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

													  (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

													  vendas_clarotv.pagamento = 'PRONTA ENTREGA'),1,NULL)) AS vendasfinalizadaspe

											FROM vendas_clarotv 

											INNER JOIN usuarios 

											ON vendas_clarotv.monitor=usuarios.id 

											WHERE vendas_clarotv.produto = '".$produto_id."' && 

												  vendas_clarotv.monitor != '' && 

												  (vendas_clarotv.data LIKE '%".$ano.$mes."%' || 

												   vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%') && 

												  vendas_clarotv.monitor LIKE '%".$loginMONITOR."%' 
												  $querytipovenda

											GROUP BY vendas_clarotv.monitor 

											ORDER BY usuarios.nome ");

}
while($MONITORES = mysql_fetch_array($conMONITORES)){





?>



<tr bgcolor="#999999" style="font-size:14px; color:#FFF; font-weight:bold" align="left"><td colspan="4">Monitor: <?= $MONITORES['nomemonitor'];?></td></tr>



<tr style="font-size:10px; cursor:default" align="center">

<td bgcolor="#ededed">Nome do Operador</td>

<td bgcolor="#fcfbce" width="100px">Vendas Feitas</td>

<td bgcolor="#ceedfc" width="100px">Vendas Finalizadas</td>

<td bgcolor="#ceedfc" width="120px">Boleto / Cartão / PE</td>

</tr>



<?



$conOPERADORES = $conexao->query("SELECT operadores.nome AS nomeoperador,

								  operadores.operador_id AS idoperador,

								  operadores.status AS statusoperador, 

								  COUNT(if(vendas_clarotv.data LIKE '%".$ano.$mes."%',1,NULL)) AS vendasfeitas, 

								  COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

									   	    (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS')),1,NULL)) AS vendasfinalizadas, 

								  COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

										    (vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

											vendas_clarotv.pagamento = 'BOLETO'),1,NULL)) AS vendasfinalizadasboleto,

								  COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

											(vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

											vendas_clarotv.pagamento = 'CARTÃO DE CRÉDITO'),1,NULL)) AS vendasfinalizadascartao,

								  COUNT(if((vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%' && 

											(vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') &&

											vendas_clarotv.pagamento = 'PRONTA ENTREGA'),1,NULL)) AS vendasfinalizadaspe

								  FROM vendas_clarotv 

								  INNER JOIN operadores 

								  ON vendas_clarotv.operador=operadores.operador_id 

								  WHERE vendas_clarotv.produto = '".$produto_id."' && 

								  		vendas_clarotv.monitor = '".$MONITORES['idmonitor']."' &&

										(vendas_clarotv.data LIKE '%".$ano.$mes."%' || 

										 vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%')
										 $querytipovenda

  								  GROUP BY operadores.operador_id 

								  ORDER BY vendasfinalizadas DESC

								  

								  ");





$class = "tr2";

while($OPERADORES = mysql_fetch_array($conOPERADORES)){





if($OPERADORES['vendasfeitas'] > 0){



if ($class=="tr2"){ //alterna a cor

  $class = "tr3";;

} else {

  $class = "tr2";;

}

?>



<tr align="center" class="<?= $class; ?>">



<td style="cursor:pointer; height:23px" onclick="mostrarinfo('<?= $OPERADORES['idoperador']?>','0')">

<? if($OPERADORES['statusoperador'] == 'DESLIGADO') {?><span style="color:#A9A9A9;"><?= $OPERADORES['nomeoperador'];?></span> <? } else { echo $OPERADORES['nomeoperador']; } ?>

</td>







<td><?= ceil($OPERADORES['vendasfeitas']);?></td>

<td><?= ceil($OPERADORES['vendasfinalizadas']);?></td>

<td title="<?= ceil($OPERADORES['vendasfinalizadasboleto'])." / ".

	ceil($OPERADORES['vendasfinalizadascartao'])." / ".

	ceil($OPERADORES['vendasfinalizadaspe']);?>">

     <?= ceil(($OPERADORES['vendasfinalizadasboleto']*100)/$OPERADORES['vendasfinalizadas'])."% / ".

		ceil(($OPERADORES['vendasfinalizadascartao']*100)/$OPERADORES['vendasfinalizadas'])."% / ".

		ceil(($OPERADORES['vendasfinalizadaspe']*100)/$OPERADORES['vendasfinalizadas'])."%";?>

</td>

</tr>



<? }}?>







<?







?>

<tr align="center" style="font-size:10px; font-weight:bold;" bgcolor="#CCCCCC">

<td>Total</td>

<td><?= $MONITORES['vendasfeitas'];?></td>

<td><?= $MONITORES['vendasfinalizadas'];?></td>

<td><?= ceil(($MONITORES['vendasfinalizadasboleto']*100)/$MONITORES['vendasfinalizadas'])."% / ".

		ceil(($MONITORES['vendasfinalizadascartao']*100)/$MONITORES['vendasfinalizadas'])."% / ".

		ceil(($MONITORES['vendasfinalizadaspe']*100)/$MONITORES['vendasfinalizadas'])."%";?>

</td>

</tr>



<tr height="10px">

<td colspan="100"></td>

</tr>



<? } ?>



</table>



<br />

<br />

<? } ?>





<? if($_GET['es'] == '4' || $_GET['es'] == ''){

	

/////////////////////////////////////////

//////////////////ORDER//////////////////

/////////////////////////////////////////





$ordem = $_GET['o'];

if($ordem == ''){ $ordem = 'conectadas DESC';}	



	

	?>



<!-- 

/////////////////////////////

////VENDAS POR OPERADORES//// 

/////////////////////////////

-->



<?



$conMetas = $conexao->query("SELECT * FROM metas WHERE produto = '".$produto_id."' && periodo = '".$ano.$mes."'");

$rowMetas = mysql_fetch_array($conMetas);



//// Números de dias não trabalhados

$dnt = explode(' | ',$rowMetas['dias_nt']);





if($mes == date("m")){



$menos = "0";

foreach($dnt as $dd){

	

	if($dd <= date("d") && $dd >= 01){

	$menos++;

	}

	}

	

}



else if($mes > date("m")){ $menos = '0';}	

	

 else{

	

foreach($dnt as $dd){

	

	if($dd >= 01){

	$menos++;

				}

					}	

}



	

?>









<table border="0" width="90%">



<tr style="font-size:10px; cursor:pointer" align="center" class="tr1">

<td title="Data Início" onclick="window.location = '?p=estatisticas-clarofixo&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>&o=<? if($_GET['o'] == 'operadorData ASC'){ echo 'operadorData DESC'; } else { echo 'operadorData ASC'; }?>'">Data Início <? if($_GET['o'] == 'operadorData ASC'){ ?><img src="img/seta-u.png" /> <? } else if($_GET['o'] == 'operadorData DESC'){ ?> <img src="img/seta-d.png" /> <? } ?></td>



<td title="Tipo Contrato" onclick="window.location = '?p=estatisticas-clarofixo&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>&o=<? if($_GET['o'] == 'operadorContrato ASC'){ echo 'operadorContrato DESC'; } else { echo 'operadorContrato ASC'; }?>'">Tipo Contrato <? if($_GET['o'] == 'operadorContrato ASC'){ ?><img src="img/seta-u.png" /> <? } else if($_GET['o'] == 'operadorContrato DESC'){ ?> <img src="img/seta-d.png" /> <? } ?></td>



<td title="Nome do Operador" onclick="window.location = '?p=estatisticas-clarofixo&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>&o=<? if($_GET['o'] != 'operadores.nome DESC'){ echo 'operadores.nome DESC'; } else { echo 'operadores.nome ASC'; }?>'">Nome do Operador <? if($_GET['o'] == 'operadores.nome ASC'){ ?><img src="img/seta-u.png" /> <? } else if($_GET['o'] == 'operadores.nome DESC'){ ?> <img src="img/seta-d.png" /> <? } ?></td>



<td title="Vendas Feitas" onclick="window.location = '?p=estatisticas-clarofixo&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>&o=<? if($_GET['o'] == 'vendas ASC'){ echo 'vendas DESC'; } else { echo 'vendas ASC'; }?>'">Vendas Feitas <? if($_GET['o'] == 'vendas ASC'){ ?><img src="img/seta-u.png" /> <? } else if($_GET['o'] == 'vendas DESC'){ ?> <img src="img/seta-d.png" /> <? } ?></td>



<td title="Vendas Finalizadas" onclick="window.location = '?p=estatisticas-clarofixo&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>&o=<? if($_GET['o'] == 'conectadas DESC' || $_GET['o'] == ''){ echo 'conectadas ASC'; } else { echo 'conectadas DESC'; }?>'">Vendas Autorizadas <? if($_GET['o'] == 'conectadas DESC' || $_GET['o'] == ''){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'conectadas ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>



<td title="Vendas Esperadas" >Vendas Esperadas</td>



<td title="Prognose">Prognose </td>





<td title="Meta de Qualidade" onclick="window.location = '?p=estatisticas-clarofixo&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>&o=<? if($_GET['o'] == 'metaqualidade ASC'){ echo 'metaqualidade DESC'; } else { echo 'metaqualidade ASC'; }?>'">Meta de Qualidade <? if($_GET['o'] == 'metaqualidade ASC'){ ?><img src="img/seta-u.png" /> <? } else if($_GET['o'] == 'metaqualidade DESC'){ ?> <img src="img/seta-d.png" /> <? } ?></td>





<td title="Aproveitamento" onclick="window.location = '?p=estatisticas-clarofixo&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=<?= $_GET['es'];?>&o=<? if($_GET['o'] == 'aproveitamento ASC'){ echo 'aproveitamento DESC'; } else { echo 'aproveitamento ASC'; }?>'">Aproveitamento <? if($_GET['o'] == 'aproveitamento ASC'){ ?><img src="img/seta-u.png" /> <? } else if($_GET['o'] == 'aproveitamento DESC'){ ?> <img src="img/seta-d.png" /> <? } ?></td></tr>



<?



$conMetaqualidade = "COUNT(IF((vendas_clarotv.status = 'DEVOLVIDO' || 

									 		   vendas_clarotv.status = 'CANCELADO' ||

									           vendas_clarotv.status = 'SEM CONTATO') &&

									 		   vendas_clarotv.data LIKE '%".$ano.$mes."%', 1, NULL)) AS metaqualidade,";

											   

$conPorcentagemmetaqualidade =	"((COUNT(IF((vendas_clarotv.status = 'DEVOLVIDO' || 

									 		   vendas_clarotv.status = 'CANCELADO' ||

									           vendas_clarotv.status = 'SEM CONTATO') &&

									 		   vendas_clarotv.data LIKE '%".$ano.$mes."%', 1, NULL)) * 100) / COUNT(IF(vendas_clarotv.data LIKE '%".$ano.$mes."%', 1, NULL))) AS porcentagemmetaqualidade,";

											   

											   


if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){
	$conOPERADORES1 = $conexao->query("SELECT *, COUNT(IF(vendas_clarotv.data LIKE '%".$ano.$mes."%', 1, NULL)) AS vendas,

										 COUNT(IF((vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') && 

												  vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%', 1, NULL)) AS conectadas,

										 ((COUNT(IF((vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') && 

													vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%', 1, NULL)) * 100) /

													COUNT(IF(vendas_clarotv.data LIKE '%".$ano.$mes."%', 1, NULL))) AS aproveitamento,

													".$conMetaqualidade."	".$conPorcentagemmetaqualidade."

										 operadores.nome AS operador,

										 operadores.operador_id AS operadorID,

										 operadores.tipo_contrato AS operadorContrato,

										 operadores.data_admissao AS operadorData

										 FROM vendas_clarotv 

										 INNER JOIN operadores ON operadores.operador_id = vendas_clarotv.operador

										 WHERE produto = '".$produto_id."' &&

										 (data LIKE '%".$ano.$mes."%' || data_autorizacao LIKE '%".$ano.$mes."%')

										 $tipovendausuario2 && 

										 ($MONITORES2)
										
										 GROUP BY vendas_clarotv.operador

										 ORDER BY ".$ordem."	  

									  "); 


}else{
	$conOPERADORES1 = $conexao->query("SELECT *, COUNT(IF(vendas_clarotv.data LIKE '%".$ano.$mes."%', 1, NULL)) AS vendas,

										 COUNT(IF((vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') && 

												  vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%', 1, NULL)) AS conectadas,

										 ((COUNT(IF((vendas_clarotv.status = 'AUTORIZADA' || vendas_clarotv.status = 'PÓS VENDAS') && 

													vendas_clarotv.data_autorizacao LIKE '%".$ano.$mes."%', 1, NULL)) * 100) /

													COUNT(IF(vendas_clarotv.data LIKE '%".$ano.$mes."%', 1, NULL))) AS aproveitamento,

													".$conMetaqualidade."	".$conPorcentagemmetaqualidade."

										 operadores.nome AS operador,

										 operadores.operador_id AS operadorID,

										 operadores.tipo_contrato AS operadorContrato,

										 operadores.data_admissao AS operadorData

										 FROM vendas_clarotv 

										 INNER JOIN operadores ON operadores.operador_id = vendas_clarotv.operador

										 WHERE produto = '".$produto_id."' &&

										 (data LIKE '%".$ano.$mes."%' || data_autorizacao LIKE '%".$ano.$mes."%')  

										 $tipovendausuario2 && 

										 vendas_clarotv.monitor LIKE '%".$loginMONITOR."%'
										 
										 $querytipovenda

										 GROUP BY vendas_clarotv.operador

										 ORDER BY ".$ordem."	  

									  "); 
}


$class = "tr2";

while($OPERADORES1 = mysql_fetch_array($conOPERADORES1)){



$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$OPERADORES1['operadorID']."'");



$OPERADORES = mysql_fetch_array($conOPERADORES);





//$conVENDASFEITAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$OPERADORES['operador_id']."' && data LIKE '%".$ano.$mes."%'");

//$totalVENDASFEITAS = mysql_num_rows($conVENDASFEITAS);



//$conVENDASCONECTADAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$OPERADORES['operador_id']."' && data_autorizacao LIKE '%".$ano.$mes."%' && status = 'AUTORIZADA'");

//$totalVENDASCONECTADAS = mysql_num_rows($conVENDASCONECTADAS);



if($OPERADORES1['vendas'] > 0 || $OPERADORES1['conectadas'] > 0){



if ($class=="tr2"){ //alterna a cor

  $class = "tr3";;

} else {

  $class = "tr2";;

}





/// vendas esperadas e prognose

$meta = $rowMetas['meta'];

$meta_int = $rowMetas['meta_int'];

$meta_sup = $rowMetas['meta_sup'];



$diasUteis = $rowMetas['dias_uteis'];

if($mes == date("m")){ $diaAtual = ceil(date("d")-$menos); } else { $diaAtual = ceil($rowMetas['dias_uteis']); }

$vendasEsperadas = ceil(($meta/($diasUteis))*($diaAtual));

$prognose = ceil(($OPERADORES1['conectadas'] / ($diaAtual))  * $diasUteis);



$TotalVendasEsperadas =  $TotalVendasEsperadas + $vendasEsperadas;
?>



<tr align="center" class="<?= $class; ?>">

<td><?= $OPERADORES1['operadorData'];?></td>



<td><?= $OPERADORES1['operadorContrato'];?></td>



<td style="cursor:pointer; height:23px" onclick="mostrarinfo('<?= $OPERADORES['operador_id']?>','0')">

<? if($OPERADORES['status'] == 'DESLIGADO') {?><span style="color:#A9A9A9;"><?= $OPERADORES['nome'];?></span> <? } else { echo $OPERADORES1['operador']; } ?>

</td>



<td><?= $OPERADORES1['vendas'];?></td>



<td><?= $OPERADORES1['conectadas'];?></td>



<td><span <? if($OPERADORES1['conectadas'] < $vendasEsperadas){ ?>style="color:#D00"<? } else { ?> style="color:#0C0"  <? } ?>> <?= $vendasEsperadas;?> </span> </td>



<td> <span <? if($prognose < $meta){ ?> style="color:#D00" title="Meta não alcançada"<? } else if($prognose >= $meta && $prognose < $meta_int) { ?> style="color:#09C" title="Meta Batida" <? } else if($prognose >= $meta_int && $prognose < $meta_sup) { ?> style="color:#FB0" title="Meta Intermediária Batida"<? } else if($prognose >= $meta_sup) { ?> style="color:#0C0" title="Super Meta Batida" <? } ?>> <b><?= $prognose;?></b> </span></td>



<td title="Vendas Canceladas, Devolvidas ou Sem Contato"> <?= $OPERADORES1['metaqualidade'];?>



<span style="font-size:10px; color:#999; font-weight:normal">

<?= " (".ceil($OPERADORES1['porcentagemmetaqualidade'])."%)";?></span></td>



<td> <span <? if($OPERADORES1['aproveitamento'] < 30){ ?>style="color:#D00"<? } else { ?> style="color:#0C0"  <? } ?>> <?= ceil($OPERADORES1['aproveitamento'])."%";?> </span>







</td>

</tr>



<? }}?>







<?

////////// TOTAL /////////
if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){

	$conVENDASFEITASM = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data LIKE '%".$ano.$mes."%' && ($MONITORES1)");

	$totalVENDASFEITASM = mysql_num_rows($conVENDASFEITASM);



	$conVENDASCONECTADASM = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data_autorizacao LIKE '%".$ano.$mes."%' && status = 'AUTORIZADA' && ($MONITORES1)");

	$totalVENDASCONECTADASM = mysql_num_rows($conVENDASCONECTADASM);



	$conTotalmetaqualidade = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data LIKE '%".$ano.$mes."%' && (status = 'DEVOLVIDO' || status = 'CANCELADO' || status = 'SEM CONTATO') && ($MONITORES1)");



	$totalMetaqualidade = mysql_num_rows($conTotalmetaqualidade);

}else{

	$conVENDASFEITASM = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data LIKE '%".$ano.$mes."%' && monitor LIKE '%".$loginMONITOR."%'");

	$totalVENDASFEITASM = mysql_num_rows($conVENDASFEITASM);



	$conVENDASCONECTADASM = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data_autorizacao LIKE '%".$ano.$mes."%' && (status = 'AUTORIZADA' || status = 'PÓS VENDAS')&& monitor LIKE '%".$loginMONITOR."%'");

	$totalVENDASCONECTADASM = mysql_num_rows($conVENDASCONECTADASM);



	$conTotalmetaqualidade = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' $tipovendausuario && data LIKE '%".$ano.$mes."%' && (status = 'DEVOLVIDO' || status = 'CANCELADO' || status = 'SEM CONTATO') && monitor LIKE '%".$loginMONITOR."%'");



	$totalMetaqualidade = mysql_num_rows($conTotalmetaqualidade);
}



/// vendas esperadas e prognose total

$metaEmpresa = '1350';

$vendasEsperadasEmpresa = ceil(($metaEmpresa/($diasUteis))*($diaAtual));

$prognoseEmpresa = ceil(($totalVENDASCONECTADASM / ($diaAtual))  * $diasUteis);



?>

<tr align="center" style="font-size:10px; font-weight:bold;" bgcolor="#CCCCCC">

<td colspan="3">Total</td>

<td><?= $totalVENDASFEITASM;?></td>

<td><?= $totalVENDASCONECTADASM;?></td>

<td><span <? if($totalVENDASCONECTADASM < $TotalVendasEsperadas ){ ?>style="color:#D00"<? } else { ?> style="color:#0C0"  <? } ?>> <?= $TotalVendasEsperadas;?> </span> </td>



<td> <span <? if($prognoseEmpresa < $metaEmpresa){ ?>style="color:#D00"<? } else { ?> style="color:#0C0"  <? } ?>> <?= $prognoseEmpresa;?> </span></td>



<td><?= $totalMetaqualidade;?> (<?= ceil(($totalMetaqualidade*100)/$totalVENDASFEITASM);?>%)</td>



<td><?= ceil(($totalVENDASCONECTADASM * 100)/$totalVENDASFEITASM).'%';?></td>

</tr>



<tr height="10px">

<td colspan="100"></td>

</tr>





</table>



<br />

<br />



<? } ?>





<? if($_GET['es'] == '5'){ include "includes/estatisticas-auditoria.php"; } ?>





</center>

</td></tr>

</table>



</center>



