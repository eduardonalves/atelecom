<?php

function getVendasExternas()
{
}

function getVendasInternas()
{
}


?>
<?



// Verificar se estÃ¡ logado

if(!isset($_SESSION['usuario'])){ ?>

	

<script type="text/javascript">

<!-- window.location = 'index.php' -->

</script>	

	

	

<? } 



$campo = simplexml_load_file("xml/campos.xml");





if($_GET['me'] != "" && $_GET['me'] != "todos"){ $mes = $_GET['me']; } else if($_GET['me'] == "todos"){ $mes = "";} else if($_GET['me'] == ""){$mes = date("m");}



if($_GET['an'] == "todos"){ $ano = "";} else if($_GET['an'] != ""){ $ano = $_GET['an']; } else {$ano = date("Y");}



$ordem = $_GET['o'];



if($ordem == ''){ $ordem = 'data DESC';}



else if($ordem == 'data_marcada ASC'){ $ordem = "(case when reagendamento1 = '' then data_marcada else reagendamento1 end) ASC";}



else if($ordem == 'data_marcada DESC'){ $ordem = "(case when reagendamento1 = '' then data_marcada else reagendamento1 end) DESC";}





if($_GET['v'] != ''){



$v0 = explode('/',$_GET['v']);

$v = $v0[2].$v0[1].$v0[0];



} else {



if($_GET['ve'] == '1' || $_GET['ve'] == ''){	

$v = $ano.$mes;	

}

}





$in0 = explode('/',$_GET['i']);

$in = $in0[2].$in0[1].$in0[0];





if($_GET['di'] != ''){

$di0 = explode('/',$_GET['di']);

$datafinalizada = $di0[2].$di0[1].$di0[0];

} else {



if($_GET['ve'] == '2'){	

$datafinalizada = $ano.$mes;	

}

}



$de0 = explode('/',$_GET['de']);

$dataentrega = $de0[2].$de0[1].$de0[0];





///////////////////////////////////////////
//////////////////////////////////////////



if(isset($_POST['chk'])){

	

$set_colunas = $conexao->query("UPDATE usuarios SET colunas_estoque = '(".$_POST['chk1'].") (".$_POST['chk2'].") (".$_POST['chk3'].") (".$_POST['chk4'].") (".$_POST['chk5'].") (".$_POST['chk6'].")' WHERE id = '".$USUARIO['id']."'");

?>	



<script type="text/javascript">

window.location = '?p=<?= $_GET['p'];?>'

</script>





<? }?>





<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<!-- <script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
-->
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>

<script type="text/javascript" src="js/calendario.js"></script>

<script type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="js/jquery.mockjax.js"></script>

<script type="text/javascript" src="js/jquery.autocomplete.js"></script>

<script type="text/javascript" src="js/scpt-autocomplete-estoque.js"></script>

<link rel="stylesheet" type=text/css href="css/ui-lightness/jquery-ui-1.7.3.custom.css" />

<link rel="stylesheet" type=text/css href="css/tables.css" />

<link rel="stylesheet" type=text/css href="css/geral.css" />

<link rel="stylesheet" type=text/css href="css/style-autocomplete.css" />



<script type="text/javascript">

	

	function loadsize(p){

		

	var o = p;	

	$('#pagesize').load('mysql_size.php', 1000, function(p){

	

	var size =  document.getElementById('pagesize').innerHTML;

	

	if(o != ''){

	if(o != size){ document.location.reload(); }

	}

	});

	

	

		}

	



	

</script>







<div id="pagesize" style="display:none"></div>







<script type="text/javascript">



 /*Cria uma funÃ§Ã£o de nome mascara, onde o primeiro argumento passado Ã© um dos

     objetos input O segundo Ã© especificando o tipo de mÃ©todo no qual serÃ¡ tratado*/

    function mascara(o,f){

        v_obj=o;

        v_fun=f;

        setTimeout("execmascara()",1);

    }

    

    function execmascara(){

        /*Pegue o valor do objeto e atribua o resultado da funÃ§Ã£o v_fun; cujo o conteÃºdo

        da mesma Ã© a funÃ§Ã£o que foi referida e que serÃ¡ utilizada para tratar dos dados*/

        v_obj.value=v_fun(v_obj.value);

    }

    

    function soNumeros(v){

        return v.replace(/\D/g,"");//Exclua tudo que nÃ£o for numeral e retorne o valor

    }

	

    function data(v){

        //Remove tudo o que nÃ£o Ã© dÃ­gito

        v=v.replace(/\D/g,"");

        //Coloca parÃªnteses em volta dos dois primeiros dÃ­gitos

        v=v.replace(/^(\d{2})(\d)/g,"$1/$2");

        //Coloca hÃ­fen entre o quarto e o quinto dÃ­gitos

        v=v.replace(/(\d{2})(\d)/,"$1/$2");

        return v;

    }	

	

	

	

	

function keypressed(){

if(event.keyCode=='13'){document.forms.filtro.submit();}

}	







function mostrarcolunas(){ 



$('#colunas').fadeIn(1); 

$('#blackout').fadeIn(500);	

$('#colunas').animate({left:'50%',opacity:'1'},500);



 }



function escondercolunas(){  $('#colunas').fadeOut(500); $('#blackout').fadeOut(500); $('#colunas').animate({left:'-50%',opacity:'0'},500);

 }





	

</script>





<style type="text/css">



#blackout{position:fixed; top:0px; left:0px; width:100%; height:100%; background-color:#000; z-index:200; opacity: 0.6; display:none; }



#colunas{position:fixed; padding-bottom:20px; width:400px; background-color:#FFF; top:30px; left:-50%; margin: 0 0 0 -200px; z-index:300; display:none; opacity: 0;



-webkit-border-radius: 10px;

border-radius: 10px;



-webkit-box-shadow:  0px 0px 10px 2px #999;

        

box-shadow:  0px 0px 10px 2px #999;

}



.close{position:absolute; right:6px; top:3px; font-size:12px;     background: none repeat scroll 0 0 #B6B6B6;

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



</style>



<div id="blackout"></div>



<div id="colunas">





<div class="close" onclick="escondercolunas();">X</div>

<table border="0" width="100%">



<tr align="center" height="40px" style="color:#999; font-weight:bold; font-size:14px;">

<td>COLUNAS VISÃVEIS</td>

</tr>

</table>



<center>

<table border="0" width="90%" style="font-size:12px;text-transform:uppercase">

<form name="colunas" method="post">

<input type="hidden" name="chk" />

<tr align="left">

<td width="50%"><input type="checkbox" name="chk1" <? if(strstr($USUARIO['colunas_estoque'],'(parceiro)')){?>checked="checked"<? } ?> value="parceiro" />PARCEIRO</td>

<td width="50%"><input type="checkbox" name="chk2" <? if(strstr($USUARIO['colunas_estoque'],'(estoquista)')){?>checked="checked"<? } ?> value="estoquista" />ESTOQUISTA</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk3" <? if(strstr($USUARIO['colunas_estoque'],'(aparelho)')){?>checked="checked"<? } ?> value="aparelho" />APARELHO</td>

<td width="50%"><input type="checkbox" name="chk4" <? if(strstr($USUARIO['colunas_estoque'],'(esn)')){?>checked="checked"<? } ?> value="esn" />ESN</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk5" <? if(strstr($USUARIO['colunas_estoque'],'(status)')){?>checked="checked"<? } ?> value="status" />STATUS</td>

<td width="50%"><input type="checkbox" name="chk6" <? if(strstr($USUARIO['colunas_estoque'],'(data)')){?>checked="checked"<? } ?> value="data" />DATA</td>

</tr>

<tr align="left" height="40px" valign="bottom">

<td><img src="img/salvar.png" onClick="javascript:document.forms.colunas.submit();" width="100" style="cursor:pointer" /></td>

<td></td>

</tr>

</form>

</table>

</center>





</div>







<!-- SUBMENU -->

<? include "submenu-clarofixo.php";?>

<!-- FIM DO SUBMENU -->

<? include ("menu-lateral-estoque-clarofixo.php"); ?>

<center>

<form name="filtro" method="get">




<table border="0" width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">



<input type="hidden" name="p" value="<?= $_GET['p'];?>" />

<input type="hidden" name="o" value="<?= $_GET['o'];?>" />

<input type="hidden" name="m" value="<?= $_GET['m'];?>" />

<input type="hidden" name="es" value="<?= $_GET['es'];?>" />



<tr style="font-size:13px">
<?

/* VARIAVEIS GET
 * 
 * p = PÃ¡gina a ser exibida (Aparelhos)
 * o = Ordem de exibiÃ§Ã£o dos registros (nome-do-campo + ASC or DESC)
 * m = NÃºmero de registros por pÃ¡gina
 * 
 * status = Filtro por Status
 * parc = Filtro por Parceiro
 * 
 * */

?>
<td>Mostrar: <span style=" cursor:pointer; <? if(!$_GET['mc'] && !$_GET['mod'] && !$_GET['qt'] ){?> font-weight:bold;<? } ?>" onclick="window.location = '?p=<?= $_GET['p'];?>&es=<?= $_GET['es'];?>'">Todos</span></td>



<?php

	function isParceiro()
	{

		global $USUARIO;
		
		if(strtoupper($USUARIO["tipo_usuario"])=="MONITOR" && strtoupper($USUARIO["acesso_usuario"])== "EXTERNO")
		{
			
			$_GET["parc"] = $USUARIO["nome"];
			return "readonly=\"true\"";
		
		}else{
			
			return false;
		}

	}
	
	?>

<td>
 | Parceiro (Nome ou Login):

<div>
	<input id="autocomplete-ajax" <? echo isParceiro(); ?> type="text" value="<?=$_GET["parc"]?>" name="parc" />
</div>

<div id="selection"></div>
<!-- 
<select name="parc" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<?
/*$getParceiros = $conexao->query("Select DISTINCT id_parceiro, usuarios.nome from saidas INNER JOIN usuarios ON (usuarios.id=saidas.id_parceiro) ORDER BY usuarios.nome");
while ($parceiro = mysql_fetch_array($getParceiros))
{

	echo "<option value=\"" . $parceiro["nome"] . "\""; if($_GET["parc"]==$parceiro["nome"]){ echo " selected=\"selected\""; } echo ">". $parceiro["nome"] ."</option>";
}
*/
?>

</select>
-->

</td>

<? $getStatus = $conexao->query("Select DISTINCT status from ESNsSaida"); ?>
<td> | Status: 

<select name="status" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<?

while ($status = mysql_fetch_array($getStatus))
{

	echo "<option value=\"" . $status["status"] . "\""; if($_GET["status"]==$status["status"]){ echo " selected=\"selected\"";} echo ">". $status["status"] ."</option>";
}

?>

</select>

</td>

<?php $getAparelhos = $conexao->query("Select DISTINCT (itenssaida.id_aparelho), aparelhos.id_aparelho,
							aparelhos.marca, aparelhos.modelo FROM itenssaida
							 INNER JOIN aparelhos ON (itenssaida.id_aparelho=aparelhos.id_aparelho)"); ?>
<td> | Aparelho: 

<select name="id_aparelho" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<?

while ($tipoAparelho = mysql_fetch_array($getAparelhos))
{

	echo "<option value=\"" . $tipoAparelho["id_aparelho"] . "\""; if($_GET["id_aparelho"]==$tipoAparelho["id_aparelho"]){ echo " selected=\"selected\"";} echo ">". $tipoAparelho["marca"] . " - " . $tipoAparelho["modelo"] ."</option>";
}

?>

</select>

</td>


<td> | Sa&iacute;da de: <input type="text" name="v" id="calendario" onKeyPress="mascara(this,data)" value="<?= $_GET['v'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



<td>At&eacute;: <input type="text" name="i" id="calendario2" onKeyPress="mascara(this,data)" value="<?= $_GET['i'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>

</tr>



</table>

</form>





<br />

<?

$pg = $_GET['pg'];

if($_GET['m'] == ''){

$numreg = 30;

} else {

$numreg = $_GET['m'];	

}

    if (!isset($_GET['pg']) or ($_GET['pg']==0)) {

        $pg = 1;

    }

	else

	{

	$pg = $_GET['pg'];

	}

    $inicial = ($pg-1) * $numreg;



include "includes/filtro-estoque.php";

?>



<table border="0" width="1000px" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">

<tr align="left">

<td>

<span style="color:#999; font-size:14px;">


<?php

?>
<?php switch(strtolower($_GET["status"])) {
	
	case "com parceiro":
	?>
<b><?= $quantreg; ?></b> <? if($quantreg == 1){?>Produto em estoque de Parceiro encontrado<? } else {?> Produtos em estoque de parceiro encontrados <? } ?>
	
	<?php
	break;
	
	case "vendido":
	?>
<b><?= $quantreg; ?></b> <? if($quantreg == 1){?>Produto vendido de Parceiro encontrado<? } else {?> Produtos vendidos de parceiro encontrados <? } ?>
	<?php
	
	break;
	
	default:
	?>

<b><?= $quantreg; ?></b> <? if($quantreg == 1){?>Produto em estoque de Parceiro<? } else {?> Produtos em estoque externo encontrados <? } ?>
<br>
<b><?= count($estoqueComParceiro); ?></b> <? if(count($estoqueComParceiro) == 1){?>Produto em estoque<? } else {?> Produtos em estoque <? } ?>
<br>
<b><?= count($estoqueVendido); ?></b> <? if(count($estoqueVendido) == 1){?>Produto vendido<? } else {?> Produtos vendidos <? } ?>
<br>
<b><?= count($estoqueDevolvido); ?></b> <? if(count($estoqueDevolvido) == 1){?>Produto devolvido<? } else {?> Produtos devolvidos <? } ?>

	<?php
	
}
	?>
</span>

</td>



<td width="30" align="center">



<img src="img/gear.png" width="20" style="cursor:pointer" onclick="mostrarcolunas();" title="Selecionar Colunas VisÃ­veis"  />

</td>

<td width="100px" align="right">

<form name="mostrar" method="get" action="">


<? /*
<input type="hidden" name="g" value="<?= $_GET['g'];?>" />

<input type="hidden" name="p" value="<?= $_GET['p'];?>" />

<input type="hidden" name="o" value="<?= $_GET['o'];?>" />

<input type="hidden" name="b" value="<?= $_GET['b'];?>" />

<input type="hidden" name="i" value="<?= $_GET['i'];?>" />

<input type="hidden" name="v" value="<?= $_GET['v'];?>" />

<input type="hidden" name="s" value="<?= $_GET['s'];?>" />

<input type="hidden" name="t" value="<?= $_GET['t'];?>" />

<input type="hidden" name="f" value="<?= $_GET['f'];?>" />

<input type="hidden" name="di" value="<?= $_GET['di'];?>" />

<input type="hidden" name="de" value="<?= $_GET['de'];?>" />

<input type="hidden" name="me" value="<?= $_GET['me'];?>" />

<input type="hidden" name="an" value="<?= $_GET['an'];?>" />

<input type="hidden" name="ve" value="<?= $_GET['ve'];?>" />

<input type="hidden" name="tpv" value="<?= $_GET['tpv'];?>" />

*/?>

<input type="hidden" name="p" value="<?= $_GET['p'];?>" />
<input type="hidden" name="v" value="<?= $_GET['v'];?>" />
<input type="hidden" name="i" value="<?= $_GET['i'];?>" />
<input type="hidden" name="status" value="<?= $_GET['status'];?>" />
<input type="hidden" name="parc" value="<?= $_GET['parc'];?>" />
<input type="hidden" name="o" value="<?= $_GET['o'];?>" />

<input type="hidden" name="es" value="<?= $_GET['es'];?>" />

<span style="font-size:13px">Mostrar: </span>







<select name="m" onchange="javascript:document.forms.mostrar.submit();">

<option value="15" <? if($_GET['m'] == '15'){?>selected="selected"<? }?>>15</option>

<option value="30" <? if($_GET['m'] == '30' || $_GET['m'] == ''){?>selected="selected"<? }?>>30</option>

<option value="40" <? if($_GET['m'] == '40'){?>selected="selected"<? }?>>40</option>

<option value="60" <? if($_GET['m'] == '60'){?>selected="selected"<? }?>>60</option>

</select>



</form>





</td>

</tr>

</table>





<hr size="1" color="#CCC" width="1000px" />



<table border="0" width="1000px" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">

<tr bgcolor="#565656" style="color:#FFF; font-size:14px; font-weight:bold; cursor:pointer;" align="center" class="tr1">


<!--  ##### COLUNAS #### -->

<? if(strstr($USUARIO['colunas_estoque'],'(parceiro)')){?>

<td title="Parceiro" onclick="window.location = '?p=estoque-clarofixo&es=<?= $_GET['es'];?>&m=<?= $_GET['m'];?>&mc=<?= $_GET['mc'];?>&mod=<?= $_GET['mod'];?>&mqt=<?= $_GET['mqt'];?>&pqt=<?= $_GET['pqt'];?>&pg=<?php echo ($pg - 1); ?>&o=<? if($_GET['o'] != 'parceiro DESC'){ echo 'parceiro DESC'; } else { echo 'parceiro ASC'; }?>'">Parceiro <? if($_GET['o'] == 'parceiro DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'parceiro ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_estoque'],'(estoquista)')){?>

<td title="Estoquista" onclick="window.location = '?p=estoque-clarofixo&es=<?= $_GET['es'];?>&m=<?= $_GET['m'];?>&mc=<?= $_GET['mc'];?>&mod=<?= $_GET['mod'];?>&mqt=<?= $_GET['mqt'];?>&pqt=<?= $_GET['pqt'];?>&pg=<?php echo ($pg - 1); ?>&o=<? if($_GET['o'] != 'estoquista DESC'){ echo 'estoquista DESC'; } else { echo 'estoquista ASC'; }?>'">Estoquista <? if($_GET['o'] == 'estoquista DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'estoquista ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_estoque'],'(aparelho)')){?>

<td title="Aparelho" onclick="window.location = '?p=estoque-clarofixo&es=<?= $_GET['es'];?>&m=<?= $_GET['m'];?>&mc=<?= $_GET['mc'];?>&mod=<?= $_GET['mod'];?>&mqt=<?= $_GET['mqt'];?>&pqt=<?= $_GET['pqt'];?>&pg=<?php echo ($pg - 1); ?>&o=<? if($_GET['o'] != 'aparelho DESC'){ echo 'aparelho DESC'; } else { echo 'aparelho ASC'; }?>'">Aparelho <? if($_GET['o'] == 'aparelho DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'aparelho ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_estoque'],'(esn)')){?>

<td title="Esn" onclick="window.location = '?p=estoque-clarofixo&es=<?= $_GET['es'];?>&m=<?= $_GET['m'];?>&mc=<?= $_GET['mc'];?>&mod=<?= $_GET['mod'];?>&mqt=<?= $_GET['mqt'];?>&pqt=<?= $_GET['pqt'];?>&pg=<?php echo ($pg - 1); ?>&o=<? if($_GET['o'] != 'esn DESC'){ echo 'esn DESC'; } else { echo 'esn ASC'; }?>'">Esn <? if($_GET['o'] == 'esn DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'esn ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_estoque'],'(status)')){?>

<td title="Status" onclick="window.location = '?p=estoque-clarofixo&es=<?= $_GET['es'];?>&m=<?= $_GET['m'];?>&mc=<?= $_GET['mc'];?>&mod=<?= $_GET['mod'];?>&mqt=<?= $_GET['mqt'];?>&pqt=<?= $_GET['pqt'];?>&pg=<?php echo ($pg - 1); ?>&o=<? if($_GET['o'] != 'status DESC'){ echo 'status DESC'; } else { echo 'status ASC'; }?>'">Status <? if($_GET['o'] == 'status DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'status ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_estoque'],'(data)')){?>

<td title="Data" onclick="window.location = '?p=estoque-clarofixo&es=<?= $_GET['es'];?>&m=<?= $_GET['m'];?>&mc=<?= $_GET['mc'];?>&mod=<?= $_GET['mod'];?>&mqt=<?= $_GET['mqt'];?>&pqt=<?= $_GET['pqt'];?>&pg=<?php echo ($pg - 1); ?>&o=<? if($_GET['o'] != 'data DESC'){ echo 'data DESC'; } else { echo 'data ASC'; }?>'">Data <? if($_GET['o'] == 'data DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'data ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>

<? if(strtoupper($USUARIO['tipo_usuario']) == "ADMINISTRADOR"){?>



<? } ?>


</tr>



<?



$class = "tr2";


foreach ($estoque["dados"] as $aparelho ){

	
/*
$conMONITOR = $conexao->query("SELECT * FROM usuarios WHERE id = '".$VENDA['monitor']."'");	

$MONITOR = mysql_fetch_assoc($conMONITOR);

	

$conOPERADOR = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$VENDA['operador']."'");	

$OPERADOR = mysql_fetch_assoc($conOPERADOR);
*/


if ($class=="tr2"){ //alterna a cor

  $class = "tr3";

} else {

  $class="tr2";

}	

?>



<tr class="<?= $class;?>" align="center">


<? if(strstr($USUARIO['colunas_estoque'],'(parceiro)')){?>

<td title="Marca" <? if(strstr($_GET['o'],'parceiro')){ ?> class="tdselected" <? } ?>><?= $aparelho['parceiro'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_estoque'],'(estoquista)')){?>

<td title="Modelo" <? if(strstr($_GET['o'],'estoquista')){ ?>class="tdselected" <? } ?>><?= $aparelho['estoquista'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_estoque'],'(aparelho)')){?>

<td title="Quantidade em Estoque" <? if(strstr($_GET['o'],'aparelho')){ ?>class="tdselected" <? } ?>><? echo $aparelho['marca'] . " - " . $aparelho['modelo'];?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_estoque'],'(esn)')){?>

<td title="Quantidade em Estoque" <? if(strstr($_GET['o'],'esn')){ ?>class="tdselected" <? } ?>><? echo $aparelho['esn'];?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_estoque'],'(status)')){?>

<td title="Quantidade em Estoque" <? if(strstr($_GET['o'],'status')){ ?>class="tdselected" <? } ?>><? echo $aparelho['status'];?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_estoque'],'(data)')){?>

<td title="Quantidade em Estoque" <? if(strstr($_GET['o'],'data')){ ?>class="tdselected" <? } ?>><? echo $aparelho['data'];?></td>

<? } ?>


<? if(strtoupper($USUARIO['tipo_usuario']) == "ADMINISTRADOR"){?>


<!-- <td><!-- COLUNA DO EXCLUIR</td> -->

<? } ?>





</tr>







<? } ?>



</table>



<hr size="1" color="#CCC" width="1000px" />





<table border="0" width="1000px">

<tr valign="middle" height="20px">

<td></td>

<?php if($pg != '1'){ ?>


<td width="70px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="cursor:pointer; font-size:13px" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')">



&laquo; Anterior</td><? } else{ ?>



<td width="70px" align="center" bgcolor="#fbfbfb" style="cursor:default; font-size:13px; color:#cdcdcd">&laquo; Anterior</td> 



<? } ?>



<? 



$numpaginas = ceil($quantreg / $numreg);



$i = 1; while($i <= $numpaginas && $i<=45){

 $numpag = $i++;	



if($numpag == $pg){ ?>

	

<td width="15px" align="center" bgcolor="#0096ff" style="cursor:pointer; color:#FFF; font-size:13px; font-weight:bold" onClick="window.location = ('?p=<?= $_GET['p']; ?>&es=<?= $_GET['es']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>	

    

	<? }else{ ?>

 

<td width="15px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="font-size:13px; cursor:pointer" onClick="window.location = ('?p=<?= $_GET['p']; ?>&es=<?= $_GET['es']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>





<? }} ?>



<?php if(($inicial + $numreg) < $quantreg ){ ?>

<td width="70px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="cursor:pointer; font-size:13px" onClick="window.location = ('?p=<?= $_GET['p']; ?>&es=<?= $_GET['es']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg + 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')">

Pr&oacute;ximo &raquo;</td><? } else {?>



<td width="70px" align="center" bgcolor="#fbfbfb" style="cursor:default; font-size:13px; color:#cdcdcd">Pr&oacute;ximo &raquo;</td> 



<? } ?>

<td width="10px"></td>

</tr>



</table>

</td>
</tr>
</table>

</center>

<br />

<br />

