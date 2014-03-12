<?



// Verificar se estÃ¡ logado

if(!isset($_SESSION['usuario'])){ ?>

	

<script type="text/javascript">

<!-- window.location = 'index.php' -->

</script>	

	

	

<? } 



$campo = simplexml_load_file("xml/campos.xml");


//if (! isset($_GET["mes"])) { $_GET["mes"] = date("m");}
if (! isset($_GET["mes"])) { $_GET["mes"] = 0;}
if (! isset($_GET["ano"])) { $_GET["ano"] = date("Y");}

if($_GET["ano"]==0)
{
	$ano_inicial = 1000;
	$ano_final = date("Y");
}else{

	$ano_inicial = $_GET["ano"];
	$ano_final = $_GET["ano"];
	
}

if($_GET["mes"]==0)
{
	$mes_inicial = 1;
	$mes_final = 12;
}else{

	$mes_inicial = $_GET["mes"];
	$mes_final = $_GET["mes"];
	
}

$g_dataInicio = $ano_inicial . "-" . $mes_inicial . "-01 00:00:00";
$g_dataFinal = $ano_final . "-" . $mes_final . "-31 23:59:59";


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

	

$set_colunas = $conexao->query("UPDATE usuarios SET colunas_entradas = '(".$_POST['chk1'].") (".$_POST['chk2'].") (".$_POST['chk3'].") (".$_POST['chk4'].")' WHERE id = '".$USUARIO['id']."'");

?>	



<script type="text/javascript">

window.location = '?p=<?= $_GET['p'];?>'

</script>





<? }?>





<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<!-- 
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
-->
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<!-- 
<script type="text/javascript" src="scripts/jquery-1.8.2.min.js"></script>
-->
<script type="text/javascript" src="js/calendario.js"></script>

<script type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="js/jquery.mockjax.js"></script>

<script type="text/javascript" src="js/jquery.autocomplete.js"></script>

<script type="text/javascript" src="js/scpt-autocomplete-entradas.js"></script>

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

<!-- 
<table border="0" width="90%" style="font-size:12px;text-transform:uppercase">


<form name="colunas" method="post">

<input type="hidden" name="chk" />

<tr align="left">

<td width="50%"><input type="checkbox" name="chk1" <? if(strstr($USUARIO['colunas_entradas'],'(data)')){?>checked="checked"<? } ?> value="data" />DATA</td>

<td width="50%"><input type="checkbox" name="chk2" <? if(strstr($USUARIO['colunas_entradas'],'(nota)')){?>checked="checked"<? } ?> value="nota" />NOTA FISCAL</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk3" <? if(strstr($USUARIO['colunas_entradas'],'(estoquista)')){?>checked="checked"<? } ?> value="estoquista" />ESTOQUISTA</td>

<td width="50%"><input type="checkbox" name="chk4" <? if(strstr($USUARIO['colunas_entradas'],'(origem)')){?>checked="checked"<? } ?> value="origem" />ORIGEM</td>

</tr>


<tr align="left" height="40px" valign="bottom">

<td><img src="img/salvar.png" onClick="javascript:document.forms.colunas.submit();" width="100" style="cursor:pointer" /></td>

<td></td>

</tr>

</form>

</table>
-->
</center>





</div>







<!-- SUBMENU -->

<? include "submenu-clarofixo.php";?>

<!-- FIM DO SUBMENU -->

<? include("menu-lateral-estoque-clarofixo.php"); ?>

<center>


<?
include "includes/filtro-estoque-unificado-clarofixo.php";
include "lib/class.controleEstoque.php";

$estoque = new controleEstoque($conexao);
//var_dump($estoque);
?>




<form name="filtro" method="get">




<table border="0" width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">



<input type="hidden" name="p" value="<?= $_GET['p'];?>" />

<input type="hidden" name="o" value="<?= $_GET['o'];?>" />

<input type="hidden" name="m" value="<?= $_GET['m'];?>" />

<input type="hidden" name="es" value="<?= $_GET['es'];?>" />

<tr style="font-size:13px;">
<?

/* VARIAVEIS GET
 * 
 * p = PÃ¡gina a ser exibida (Aparelhos)
 * o = Ordem de exibiÃ§Ã£o dos registros (nome-do-campo + ASC or DESC)
 * m = NÃºmero de registros por pÃ¡gina
 * 
 * est = Filtro por Estoquista
 * v = Data Inicial
 * i = Data limite
 * nf = Filtro por Nota Fiscal
 * 
 * */


//$getEstoquistas = $conexao->query("Select DISTINCT id_estoquista, usuarios.nome from entradas INNER JOIN usuarios ON (usuarios.id=entradas.id_estoquista) ORDER BY usuarios.nome");


?>
<td width="12%">Mostrar: <span style=" cursor:pointer; <? if(!$_GET['ano'] && !$_GET['mes']){?> font-weight:bold;<? } ?>" onclick="window.location = '?p=<?= $_GET['p'];?>&es=<?= $_GET['es'];?>'">Todos</span></td>

<td width="15%"> | M&ecirc;s: 

<select name="mes" onchange="javascript:document.forms.filtro.submit();">

<option value="0">Todos</option>
<option value="1" <?if($_GET["mes"]==1){ echo " selected=\"selected\"";}?>>Janeiro</option>
<option value="2" <?if($_GET["mes"]==2){ echo " selected=\"selected\"";}?>>Fevereiro</option>
<option value="3" <?if($_GET["mes"]==3){ echo " selected=\"selected\"";}?>>Mar&ccedil;o</option>
<option value="4" <?if($_GET["mes"]==4){ echo " selected=\"selected\"";}?>>Abril</option>
<option value="5" <?if($_GET["mes"]==5){ echo " selected=\"selected\"";}?>>Maio</option>
<option value="6" <?if($_GET["mes"]==6){ echo " selected=\"selected\"";}?>>Junho</option>
<option value="7" <?if($_GET["mes"]==7){ echo " selected=\"selected\"";}?>>Julho</option>
<option value="8" <?if($_GET["mes"]==8){ echo " selected=\"selected\"";}?>>Agosto</option>
<option value="9" <?if($_GET["mes"]==9){ echo " selected=\"selected\"";}?>>Setembro</option>
<option value="10" <?if($_GET["mes"]==10){ echo " selected=\"selected\"";}?>>Outubro</option>
<option value="11" <?if($_GET["mes"]==11){ echo " selected=\"selected\"";}?>>Novembro</option>
<option value="12" <?if($_GET["mes"]==12){ echo " selected=\"selected\"";}?>>Dezembro</option>

<?

for($i=0; $i<13; $i++)

{

	//echo "<option value=\"" . $i . "\""; if($_GET["est"]==$estoquista["nome"]){ echo " selected=\"selected\"";} echo ">". date($estoquista["nome"] ."</option>";
}

?>

</select>

</td>

<td> | Ano: 

<select name="ano" onchange="javascript:document.forms.filtro.submit();">

<!-- <option value="0"<? //if($_GET["ano"]==0){ echo " selected=\"selected\"";}?>>Todos</option> -->

<?

echo "aki: ";
$allSaidas = $estoque->getSaidas("saidas.data ASC");

$allAnos = array();

foreach($allSaidas as $oneSaida)
{
	$ano = substr($oneSaida["data"], 0, 4) ;

	if(! in_array($ano, $allAnos) )
	{
		array_push($allAnos, $ano);
		echo "<option value=\"$ano\" "; if($_GET["ano"]==$ano){ echo " selected=\"selected\"";} echo ">$ano</option>";
	}
}


?>
</select>

</td>

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





/*
?>

<!-- 

<table border="0" width="1000px" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">

<tr align="left">

<td>

<span style="color:#999; font-size:14px;">

<b><?= $quantreg; ?></b> <? if($quantreg == 1){?>Entrada encontrada<? } else {?> Entradas encontradas <? } ?>

</span>

</td>



<td width="30" align="center">



<img src="img/gear.png" width="20" style="cursor:pointer" onclick="mostrarcolunas();" title="Selecionar Colunas VisÃ­veis"  />

</td>

<td width="100px" align="right">

<form name="mostrar" method="get" action="">


<?
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

?>

<input type="hidden" name="p" value="<?= $_GET['p'];?>" />
<input type="hidden" name="v" value="<?= $_GET['v'];?>" />
<input type="hidden" name="i" value="<?= $_GET['i'];?>" />
<input type="hidden" name="est" value="<?= $_GET['est'];?>" />
<input type="hidden" name="nf" value="<?= $_GET['nf'];?>" />
<input type="hidden" name="o" value="<?= $_GET['o'];?>" />

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


->
<? */ ?><!-- -->

<hr size="1" color="#CCC" width="1000px" />


<div style="width:1000px; padding-top:5px; padding-bottom:3px; background-color:#565656; text-align:center;color:#FFF; font-size:14px; font-weight:bold;" class="tr1">
Relat&oacute;rio de estoque por parceiro
</div>

<table border="0" width="1000px" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">

<tr bgcolor="#565656" style="color:#FFF; font-size:14px; font-weight:bold; cursor:pointer;" align="center">


<!--  ##### COLUNAS #### -->

<? //if(strstr($USUARIO['colunas_entradas'],'(data)')){?>

<td title="Estoquista">Monitor </td>

<? //} ?>



<?// if(strstr($USUARIO['colunas_entradas'],'(nota)')){?>

<td title="Parceiro">Total</td>

<?// } ?>


<?// if(strstr($USUARIO['colunas_entradas'],'(estoquista)')){?>

<td title="Data da SaÃ­da">Vendidos</td>

<?// } ?>


<?// if(strstr($USUARIO['colunas_entradas'],'(origem)')){?>

<td title="Data da SaÃ­da">Em estoque</td>

<? //} ?>

<?// if(strstr($USUARIO['colunas_entradas'],'(origem)')){?>

<td title="Data da SaÃ­da">Devolvidos</td>

<? //} ?>


<td></td>
</tr>
<?php

//$estoque = getEstoqueExterno($monitor["login"], "$status", "$dataInicio", "$dataFinal");
//$estoque = new controleEstoque($conexao);


if($USUARIO["tipo_usuario"]=="SUPERVISOR")
{
	$supervisor_id = $USUARIO["id"];

	}else{
		
		$supervisor_id="";
	}

$monitores = $estoque->getParceirosComSaidas($g_dataInicio, $g_dataFinal, $supervisor_id);

foreach($monitores as $monitor)
{
	$total_monitor = $estoque->getQuantTotalParceiro($monitor["id"], "", $g_dataInicio, $g_dataFinal);
	$total_monitor_vendidos = $estoque->getQuantTotalParceiroVendidos($monitor["id"], $g_dataInicio, $g_dataFinal);
	$total_monitor_estoque = $estoque->getQuantTotalParceiroEstoque($monitor["id"], $g_dataInicio, $g_dataFinal);
	$total_monitor_devolvido = $estoque->getQuantTotalParceiroDevolvido($monitor["id"], $g_dataInicio, $g_dataFinal);
	?>
<tr>

	<td style="background-color:#999999; text-align:left; padding-left:10px;color:#FFF; font-size:12px; font-weight:bold;">Parceiro: <?=$monitor["nome"];?></td>
	<td style="background-color:#999999; text-align:center;color:#FFF; font-size:12px; font-weight:bold;"><?=$total_monitor[0]["quantidade_total"];?></td>
	<td style="background-color:#999999; text-align:center;color:#FFF; font-size:12px; font-weight:bold;"><?=$total_monitor_vendidos?></td>
	<td style="background-color:#999999; text-align:center;color:#FFF; font-size:12px; font-weight:bold;"><?=$total_monitor_estoque?></td>
	<td style="background-color:#999999; text-align:center;color:#FFF; font-size:12px; font-weight:bold;"><?=$total_monitor_devolvido?></td>
	<td style="background-color:#999999; text-align:center;color:#FFF; font-size:12px; font-weight:bold;"></td>

</tr>


<?
	$saidas = $estoque->getSaidas("id_parceiro ASC", "", "", $monitor["id"], $g_dataInicio, $g_dataFinal);
	//print_r($saidas);
	
	$itens = array();
	$saidas_ids="";
	
	foreach($saidas as $saida)
	{
		
	$class = "tr3";

	$itensToFilter = $estoque->getItensDeSaida($saida["id_saida"], "", "", "itens.id_aparelho");
	
	if($saidas_ids!="") { $saidas_ids .= ","; }
			
	$saidas_ids .= $saida["id_saida"];
	//print_r($itensToFilter);
	foreach($itensToFilter as $ln)
	{
		if( !isset( $itens[$ln["modelo"]] ) )
		{
			$itens[$ln["modelo"]] = array();
			//echo $monitor["nome"] . " -- " . $ln["modelo"] . "<br>";
		}
		
		array_push($itens[$ln["modelo"]], $ln);
	}
	}// FOR SAIDA 
	
		
		$itensAgrupados = array();
		$cont = 0;
		
		
		foreach($itens as $item)
		{
			$cont++;
			//print_r($item);
			array_push($itensAgrupados, $item[0]);
			
			$qtotal = 0;
			$qtotalVendido = 0;
			$qtotalEstoque = 0;
			$qtotalDevolvido = 0;
			
			
			//print_r($item);
			foreach($item as $line)
			{	
				$qtotal += $line["qtde"];
				
				
				$query = "Select count(esn.status) as qt from ESNsSaida AS esn
				WHERE esn.id_saida=". $line["id_itenssaida"] . " && status='Vendido'";
	
				$sql_result2 = $conexao->query($query);
				$qt = mysql_fetch_array($sql_result2);

				$quantidade += $qt[0];
									
				$qtotalVendido += $qt[0];

				$query = "Select count(esn.status) as qt from ESNsSaida AS esn
				WHERE esn.id_saida=". $line["id_itenssaida"] . " && status='Em Estoque'";
	
				$sql_result2 = $conexao->query($query);
				$qt = mysql_fetch_array($sql_result2);

				$quantidade += $qt[0];
				
				$qtotalEstoque += $qt[0];

				$query = "Select count(esn.status) as qt from ESNsSaida AS esn
				WHERE esn.id_saida=". $line["id_itenssaida"] . " && status='Devolvido'";
	
				$sql_result2 = $conexao->query($query);
				$qt = mysql_fetch_array($sql_result2);

				$quantidade += $qt[0];
				
				$qtotalDevolvido += $qt[0];

			}// each item
			
			$itensAgrupados[$cont-1]["ap_total"] += $qtotal;
			$itensAgrupados[$cont-1]["ap_vendidos"] += $qtotalVendido;
			$itensAgrupados[$cont-1]["ap_estoque"] += $qtotalEstoque;
			$itensAgrupados[$cont-1]["ap_devolvidos"] += $qtotalDevolvido;
		}// each itens
		//print_r($itensFiltrados);
		//echo $saidas_ids;
		//print_r($itensAgrupados);
		foreach($itensAgrupados as $linhas)
		{
		
		if ($class=="tr2"){ //alterna a cor

		  $class = "tr3";

		} else {

		  $class="tr2";

		}
	?>

		
			<tr class="<?= $class;?>" align="center">



			<?// if(strstr($USUARIO['colunas_entradas'],'(data)')){?>

			<td title="Marca" <? if(strstr($_GET['o'],'data')){ ?> class="tdselected" <? } ?>><?= $linhas["modelo"];?></td>

			<?// } ?>



			<?// if(strstr($USUARIO['colunas_entradas'],'(nota)')){?>

			<td title="Modelo" <? if(strstr($_GET['o'],'nota')){ ?>class="tdselected" <? } ?>><?= $linhas["ap_total"];?></td>

			<?// } ?>



			<?// if(strstr($USUARIO['colunas_entradas'],'(estoquista)')){?>

			<td title="Quantidade Vendidos" <? if(strstr($_GET['o'],'estoquista')){ ?>class="tdselected" <? } ?>><?=$linhas["ap_vendidos"];?></td>

			<?// } ?>

			<?// if(strstr($USUARIO['colunas_entradas'],'(origem)')){?>

			<td title="Quantidade em Estoque" <? if(strstr($_GET['o'],'origem')){ ?>class="tdselected" <? } ?>><?= $linhas["ap_estoque"];?></td>

			<?// } ?>

			<?// if(strstr($USUARIO['colunas_entradas'],'(origem)')){?>

			<td title="Quantidade Devolucoes" <? if(strstr($_GET['o'],'origem')){ ?>class="tdselected" <? } ?>><?= $linhas["ap_devolvidos"];?></td>

			<?// } ?>

			<? if(strtoupper($USUARIO['tipo_usuario']) == "ADMINISTRADOR"){?>

			<? } ?>


			<td width="26px" title="Mais Detalhes" style="cursor:pointer"><img src="img/icone-mais.png" width="13" height="13" onclick="Popup=window.open('detalhes-saida.php?id=<?=$saidas_ids?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>




			</tr>

	
	<?		
		
	}// each itensagrupados

}//each monitores

?>


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

	

<td width="15px" align="center" bgcolor="#0096ff" style="cursor:pointer; color:#FFF; font-size:13px; font-weight:bold" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>	

    

	<? }else{ ?>

 

<td width="15px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="font-size:13px; cursor:pointer" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>





<? }} ?>



<?php if(($inicial + $numreg) < $quantreg ){ ?>

<td width="70px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="cursor:pointer; font-size:13px" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg + 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')">

PrÃ³ximo &raquo;</td><? } else {?>



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

