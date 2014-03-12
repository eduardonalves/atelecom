<?

// Verificar se está logado
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
$dataautorizacao = $di0[2].$di0[1].$di0[0];
} else {

if($_GET['ve'] == '2'){	
$dataautorizacao = $ano.$mes;	
}
}


///////////////////////////////////////////
//////////////////////////////////////////

if(isset($_POST['chk'])){
	
$set_colunas = $conexao->query("UPDATE usuarios SET colunas_claro3g = '(".$_POST['chk1'].") (".$_POST['chk2'].") (".$_POST['chk3'].") (".$_POST['chk4'].") (".$_POST['chk5'].") (".$_POST['chk6'].") (".$_POST['chk7'].") (".$_POST['chk8'].") (".$_POST['chk9'].") (".$_POST['chk10'].") (".$_POST['chk11'].") (".$_POST['chk12'].") (".$_POST['chk13'].") (".$_POST['chk14'].") (".$_POST['chk15'].") (".$_POST['chk16'].") (".$_POST['chk17'].") (".$_POST['chk18'].") (".$_POST['chk19'].")' WHERE id = '".$USUARIO['id']."'");	
?>	

<script type="text/javascript">
window.location = '?p=<?= $_GET['p'];?>'
</script>


<? }?>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript" src="js/calendario.js"></script>
<script type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type=text/css href="css/ui-lightness/jquery-ui-1.7.3.custom.css" />
<link rel="stylesheet" type=text/css href="css/tables.css" />
<link rel="stylesheet" type=text/css href="css/geral.css" />


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
<td>COLUNAS VISÍVEIS</td>
</tr>
</table>

<center>
<table border="0" width="90%" style="font-size:12px;text-transform:uppercase">
<form name="colunas" method="post">
<input type="hidden" name="chk" />
<tr align="left">
<td width="50%"><input type="checkbox" name="chk1" <? if(strstr($USUARIO['colunas_claro3g'],'(msisdn)')){?>checked="checked"<? } ?> value="msisdn" /> MSISDN</td>
<td width="50%"><input type="checkbox" name="chk2" <? if(strstr($USUARIO['colunas_claro3g'],'(cod_autorizacao)')){?>checked="checked"<? } ?> value="cod_autorizacao" />Cod. Autorização</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk3" <? if(strstr($USUARIO['colunas_claro3g'],'(num_ordem)')){?>checked="checked"<? } ?> value="num_ordem" /> 
Núm. Ordem</td>
<td width="50%"><input type="checkbox" name="chk4" <? if(strstr($USUARIO['colunas_claro3g'],'(monitor)')){?>checked="checked"<? } ?> value="monitor" /> Monitor</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk5" <? if(strstr($USUARIO['colunas_claro3g'],'(operador)')){?>checked="checked"<? } ?> value="operador" /> Operador</td>
<td width="50%"><input type="checkbox" name="chk6" <? if(strstr($USUARIO['colunas_claro3g'],'(nome)')){?>checked="checked"<? } ?> value="nome" /> Cliente</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk7" <? if(strstr($USUARIO['colunas_claro3g'],'(plano)')){?>checked="checked"<? } ?> value="plano" /> Plano</td>
<td width="50%"><input type="checkbox" name="chk8" <? if(strstr($USUARIO['colunas_claro3g'],'(dbm)')){?>checked="checked"<? } ?> value="dbm" /> DBM</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk9" <? if(strstr($USUARIO['colunas_claro3g'],'(cpf)')){?>checked="checked"<? } ?> value="cpf" /> CPF</td>
<td width="50%"><input type="checkbox" name="chk10" <? if(strstr($USUARIO['colunas_claro3g'],'(cidade)')){?>checked="checked"<? } ?> value="cidade" /> Cidade</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk11" <? if(strstr($USUARIO['colunas_claro3g'],'(data)')){?>checked="checked"<? } ?> value="data" /> Data da Venda</td>
<td width="50%"><input type="checkbox" name="chk12" <? if(strstr($USUARIO['colunas_claro3g'],'(vencimento)')){?>checked="checked"<? } ?> value="vencimento" /> Vencimento</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk13" <? if(strstr($USUARIO['colunas_claro3g'],'(data_autorizacao)')){?>checked="checked"<? } ?> value="data_autorizacao" /> Data Autorização</td>
<td width="50%"><input type="checkbox" name="chk14" <? if(strstr($USUARIO['colunas_claro3g'],'(status)')){?>checked="checked"<? } ?> value="status" /> Status</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk15" <? if(strstr($USUARIO['colunas_claro3g'],'(pagamento)')){?>checked="checked"<? } ?> value="pagamento" /> Pagamento</td>
<td width="50%"><input type="checkbox" name="chk16" <? if(strstr($USUARIO['colunas_claro3g'],'(valor)')){?>checked="checked"<? } ?> value="valor" /> Valor</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk17" <? if(strstr($USUARIO['colunas_claro3g'],'(motivo_cancelamento)')){?>checked="checked"<? } ?> value="motivo_cancelamento" /> Motivo Cancelamento</td>
<td width="50%"><input type="checkbox" name="chk18" <? if(strstr($USUARIO['colunas_claro3g'],'(motivo_restricao)')){?>checked="checked"<? } ?> value="motivo_restricao" /> Motivo Restrição</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk19" <? if(strstr($USUARIO['colunas_claro3g'],'(tipo_venda)')){?>checked="checked"<? } ?> value="tipo_venda" /> Tipo Venda</td>
<td width="50%"></td>
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
<? include "submenu-claro3g.php";?>
<!-- FIM DO SUBMENU -->



<br />
<br />

<center>



<form name="filtro" method="get">
<table border="0" width="1000px" style="font-size:12px; color:#FFF; font-weight:bold" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr>
<td></td>
<td bgcolor="#565656" width="380px" align="center">
<select name="ve" onchange="javascript:document.forms.filtro.submit();">
<option value="1" <? if($_GET['ve'] == '1'){ ?> selected="selected" <? } ?>>Vendas</option>
<option value="2" <? if($_GET['ve'] == '2'){ ?> selected="selected" <? } ?>>Autorizada</option>
</select>
&nbsp; &nbsp;
Mês: 
<select name="me" onchange="javascript:document.forms.filtro.submit();">
<option value="todos">Todos</option>
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
&nbsp; &nbsp;
Ano: 
<select name="an" onchange="javascript:document.forms.filtro.submit();">
<option value="todos" <? if($ano == 'todos'){ ?> selected="selected" <? } ?>>Todos</option>

<? $a = date('Y'); while($a > '2011'){ $an = $a--; ?>

<option value="<?= $an; ?>" <? if($ano == $an){ ?> selected="selected" <? } ?>><?= $an; ?></option>

<? } ?>
</select>
</td>
</tr>
</table>

<table border="0" width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">

<input type="hidden" name="p" value="<?= $_GET['p'];?>" />
<input type="hidden" name="o" value="<?= $_GET['o'];?>" />
<input type="hidden" name="m" value="<?= $_GET['m'];?>" />

<tr style="font-size:13px">
<td>Mostrar: <span style=" cursor:pointer; <? if(!$_GET['t'] && !$_GET['f'] && !$_GET['s'] && !$_GET['v'] && !$_GET['i'] && !$_GET['b'] && !$_GET['di'] ){?> font-weight:bold;<? } ?>" onclick="window.location = '?p=<?= $_GET['p'];?>'">Todos</span></td>
<td> | Plano Escolhido: 
<select name="t" onchange="javascript:document.forms.filtro.submit();">
<option value=""></option>
<option value="10GB" <? if($_GET['t'] == '10GB'){?>selected="selected"<? }?>>10GB</option>
<option value="5GB" <? if($_GET['t'] == '5GB'){?>selected="selected"<? }?>>5GB</option>
<option value="3GB" <? if($_GET['t'] == '3GB'){?>selected="selected"<? }?>>3GB</option>
<option value="2GB" <? if($_GET['t'] == '2GB'){?>selected="selected"<? }?>>2GB</option>
</select>
</td>

<td>
 | Forma de Pagamento:
<select name="f" onchange="javascript:document.forms.filtro.submit();">
<option value=""></option>
<option value="BOLETO" <? if($_GET['f'] == 'BOLETO'){?>selected="selected"<? }?>>Boleto</option>
<option value="DÉBITO" <? if($_GET['f'] == 'DÉBITO'){?>selected="selected"<? }?>>Débito</option>
</select>
</td>

<td>
 | Status:
<select name="s" onchange="javascript:document.forms.filtro.submit();">
<option value=""></option>
<option value="ATIVADO" <? if($_GET['s'] == 'ATIVADO'){?>selected="selected"<? }?>>Ativado</option>
<option value="AUTORIZADA" <? if($_GET['s'] == 'AUTORIZADA'){?>selected="selected"<? }?>>Autorizada</option>
<option value="CANCELADO" <? if($_GET['s'] == 'CANCELADO'){?>selected="selected"<? }?>>Cancelado</option>
<option value="DEVOLVIDO" <? if($_GET['s'] == 'DEVOLVIDO'){?>selected="selected"<? }?>>Devolvido</option>
<option value="GRAVAR" <? if($_GET['s'] == 'GRAVAR'){?>selected="selected"<? }?>>Gravar</option>
<option value="GRAVADO" <? if($_GET['s'] == 'GRAVADO'){?>selected="selected"<? }?>>Gravado</option>
<option value="PRE-ANALISE" <? if($_GET['s'] == 'PRE-ANALISE'){?>selected="selected"<? }?>>Pré-Análise</option>
<option value="PRE-APROVADO" <? if($_GET['s'] == 'PRE-APROVADO'){?>selected="selected"<? }?>>Pré-Aprovado</option>
<option value="PÓS VENDAS" <? if($_GET['s'] == 'PÓS VENDAS'){?>selected="selected"<? }?>>Pós Vendas</option>
<option value="RESTRIÇÃO" <? if($_GET['s'] == 'RESTRIÇÃO'){?>selected="selected"<? }?>>Restrição</option>
<option value="SEM CONTATO" <? if($_GET['s'] == 'SEM CONTATO'){?>selected="selected"<? }?>>Sem Contato</option>

</select>
</td>


<td> | Venda de: <input type="text" name="v" id="calendario" onKeyPress="mascara(this,data)" value="<?= $_GET['v'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>

<td>Até: <input type="text" name="i" id="calendario2" onKeyPress="mascara(this,data)" value="<?= $_GET['i'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>

</tr>

</table>
<table width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr align="left" height="40" style="font-size:13px">

<td width="200px">Data Autorização: <input type="text" name="di" id="calendario3" onKeyPress="mascara(this,data)" value="<?= $_GET['di'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>


<td width="210px" align="center"> | Com Gravação: <input type="radio" name="g" value="1" <? if($_GET['g'] == '1'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> Sim <input type="radio" name="g" value="0" <? if($_GET['g'] == '0'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> Não</td>

<td width="180px"> | Tipo Venda: 
<select name="tpv" onchange="javascript:document.forms.filtro.submit();">
<option value=""></option>
<option value="INTERNA" <? if($_GET['tpv'] == 'INTERNA'){?> selected="selected" <? } ?>>INTERNA</option>
<option value="EXTERNA" <? if($_GET['tpv'] == 'EXTERNA'){?> selected="selected" <? } ?>>EXTERNA</option>
</select>
</td>

<td>| Buscar: <input type="text" size="40" value="<?= $_GET['b']; ?>" name="b" onkeyup="keypressed()" /> &nbsp;

<img src="img/bt_ok.png" style="cursor:pointer; position:absolute; padding-top:2px;" onclick="javascript:document.forms.filtro.submit();" valign="bootom" /></td>
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

include "includes/auto-status-3g.php";
include "includes/filtro-claro3g.php";
?>

<table border="0" width="1000px" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr align="left">
<td>
<span style="color:#999; font-size:14px;">
<b><?= $quantreg; ?></b> <? if($quantreg == 1){?>Venda encontrada<? } else {?> Vendas encontradas <? } ?>
</span>
</td>

<td width="30" align="center">

<img src="img/gear.png" width="20" style="cursor:pointer" onclick="mostrarcolunas();" title="Selecionar Colunas Visíveis"  />
</td>
<td width="100px" align="right">
<form name="mostrar" method="get" action="">

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
<input type="hidden" name="me" value="<?= $_GET['me'];?>" />
<input type="hidden" name="an" value="<?= $_GET['an'];?>" />
<input type="hidden" name="ve" value="<?= $_GET['ve'];?>" />
<input type="hidden" name="tpv" value="<?= $_GET['tpv'];?>" />


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

<? if(strstr($USUARIO['colunas_claro3g'],'(msisdn)')){?>
<td title="N&uacute;mero da MSISDN" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'msisdn DESC'){ echo 'msisdn DESC'; } else { echo 'msisdn ASC'; }?>'">MSISDN <? if($_GET['o'] == 'msisdn DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'msisdn ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(cod_autorizacao)')){?>
<td title="Código da Autorização" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&tpv=<?= $_GET['tpv'];?>&o=<? if($_GET['o'] != 'cod_autorizacao DESC'){ echo 'cod_autorizacao DESC'; } else { echo 'cod_autorizacao ASC'; }?>'">Cód. Autorização <? if($_GET['o'] == 'cod_autorizacao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'cod_autorizacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(num_ordem)')){?>
<td title="N&uacute;mero da Ordem" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&o=<? if($_GET['o'] != 'num_ordem DESC'){ echo 'num_ordem DESC'; } else { echo 'num_ordem ASC'; }?>'">Número Ordem <? if($_GET['o'] == 'num_ordem DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'num_ordem ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(monitor)')){?>
<td title="Nome do Monitor" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'monitor DESC'){ echo 'monitor DESC'; } else { echo 'monitor ASC'; }?>'">Monitor <? if($_GET['o'] == 'monitor DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'monitor ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(operador)')){?>
<td title="Nome do Operador" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'operador DESC'){ echo 'operador DESC'; } else { echo 'operador ASC'; }?>'">Operador <? if($_GET['o'] == 'operador DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operador ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(nome)')){?>
<td title="Nome do Cliente" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'nome DESC'){ echo 'nome DESC'; } else { echo 'nome ASC'; }?>'">Cliente <? if($_GET['o'] == 'nome DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'nome ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(cpf)')){?>
<td title="CPF do Cliente" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'cpf DESC'){ echo 'cpf DESC'; } else { echo 'cpf ASC'; }?>'">CPF/CNPJ <? if($_GET['o'] == 'cpf DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'cpf ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(dbm)')){?>
<td title="Telefone do Cliente" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'telefone DESC'){ echo 'telefone DESC'; } else { echo 'telefone ASC'; }?>'">DBM <? if($_GET['o'] == 'telefone DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'telefone ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(cidade)')){?>
<td title="Cidade do Cliente" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'cidade DESC'){ echo 'cidade DESC'; } else { echo 'cidade ASC'; }?>'">Cidade <? if($_GET['o'] == 'cidade DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'cidade ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(plano)')){?>
<td title="PLANO" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'plano DESC'){ echo 'plano DESC'; } else { echo 'plano ASC'; }?>'">Plano <? if($_GET['o'] == 'plano DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'plano ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(vencimento)')){?>
<td title="Dia do Vencimento da Fatura" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'ABS(vencimento) DESC'){ echo 'ABS(vencimento) DESC'; } else { echo 'ABS(vencimento) ASC'; }?>'">Vencimento <? if($_GET['o'] == 'ABS(vencimento) DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'ABS(vencimento) ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(valor)')){?>
<td title="Valor do Plano" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'ABS(valor) DESC'){ echo 'ABS(valor) DESC'; } else { echo 'ABS(valor) ASC'; }?>'">Valor <? if($_GET['o'] == 'ABS(valor) DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'ABS(valor) ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(data)')){?>
<td title="Data da Venda" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'data ASC' || $_GET['o'] == ''){ echo 'data ASC'; } else { echo 'data DESC'; }?>'">Data Venda <? if($_GET['o'] == 'data DESC' || $_GET['o'] == ''){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'data ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(data_autorizacao)')){?>
<td title="Data da Autorização" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'data_autorizacao DESC'){ echo 'data_autorizacao DESC'; } else { echo 'data_autorizacao ASC'; }?>'">Data Autorização <? if($_GET['o'] == 'data_autorizacao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'data_autorizacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(pagamento)')){?>
<td title="Forma de Pagamento" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'pagamento DESC'){ echo 'pagamento DESC'; } else { echo 'pagamento ASC'; }?>'">Pagamento <? if($_GET['o'] == 'pagamento DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'pagamento ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(motivo_restricao)')){?>
<td title="Motivo Restrição" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'motivo_restricao DESC'){ echo 'motivo_restricao DESC'; } else { echo 'motivo_restricao ASC'; }?>'">Motivo Restrição <? if($_GET['o'] == 'motivo_restricao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'motivo_restricao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(motivo_cancelamento)')){?>
<td title="Motivo Cancelamento" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'motivo_cancelamento DESC'){ echo 'motivo_cancelamento DESC'; } else { echo 'motivo_cancelamento ASC'; }?>'">Motivo Cancelamento <? if($_GET['o'] == 'motivo_cancelamento DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'motivo_cancelamento ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(tipo_venda)')){?>
<td title="Tipo Venda" onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'tipoVenda DESC'){ echo 'tipoVenda DESC'; } else { echo 'tipoVenda ASC'; }?>'">Tipo Venda <? if($_GET['o'] == 'tipoVenda DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'tipoVenda ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(status)')){?>
<td onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'status DESC'){ echo 'status DESC'; } else { echo 'status ASC'; }?>'">Status <? if($_GET['o'] == 'status DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'status ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<td></td>

<td onclick="window.location = '?p=claro3g&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'gravacao DESC'){ echo 'gravacao DESC'; } else { echo 'gravacao ASC'; }?>'"></td>

<? if($USUARIO['editar_dados'] == 1 || $USUARIO['editar_instalacao'] == 1){?>
<td></td>
<? } ?>

<td></td>

</tr>

<?

$class = "tr2";
while($VENDA = mysql_fetch_assoc($conVENDA)){
	
$conMONITOR = $conexao->query("SELECT * FROM usuarios WHERE id = '".$VENDA['monitor']."'");	
$MONITOR = mysql_fetch_assoc($conMONITOR);
	
$conOPERADOR = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$VENDA['operador']."'");	
$OPERADOR = mysql_fetch_assoc($conOPERADOR);

if ($class=="tr2"){ //alterna a cor
  $class = "tr3";
} else {
  $class="tr2";
}	
?>

<tr class="<?= $class;?>" align="center">

<? if(strstr($USUARIO['colunas_claro3g'],'(msisdn)')){?>
<td title="N&uacute;mero do MSISDN" <? if(strstr($_GET['o'],'msisdn')){ ?> class="tdselected" <? } ?>><?= $VENDA['msisdn'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(cod_autorizacao)')){?>
<td title="Código Autorização" <? if(strstr($_GET['o'],'cod_autorizacao')){ ?>class="tdselected" <? } ?>><?= $VENDA['cod_autorizacao'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(num_ordem)')){?>
<td title="N&uacute;mero da Ordem" <? if(strstr($_GET['o'],'num_ordem')){ ?>class="tdselected" <? } ?>><?= $VENDA['num_ordem'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(monitor)')){?>
<td title="Nome do Monitor" <? if(strstr($_GET['o'],'monitor')){ ?>class="tdselected" <? } ?>><?= $MONITOR['nome'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(operador)')){?>
<td title="Nome do Operador" <? if(strstr($_GET['o'],'operador')){ ?>class="tdselected" <? } ?>><?= $OPERADOR['nome'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(nome)')){?>
<td title="Nome do Cliente" <? if(strstr($_GET['o'],'nome')){ ?>class="tdselected" <? } ?>><?= ucwords(strtolower($VENDA['nome']));?></td>
<? } ?> 

<? if(strstr($USUARIO['colunas_claro3g'],'(cpf)')){?>
<td title="CPF/CNPJ do Cliente" <? if(strstr($_GET['o'],'cpf')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['cpf']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(dbm)')){?>
<td title="Telefone Principal do Cliente" <? if(strstr($_GET['o'],'telefone')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['telefone']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(cidade)')){?>
<td title="Cidade do Cliente" <? if(strstr($_GET['o'],'cidade')){ ?>class="tdselected" <? } ?>><?= ucwords(strtolower($VENDA['cidade']));?></td>
<? } ?>


<? if(strstr($USUARIO['colunas_claro3g'],'(plano)')){?>
<td title="Plano" <? if(strstr($_GET['o'],'plano')){ ?>class="tdselected" <? } ?>><?= $VENDA['plano'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(vencimento)')){?>
<td title="Dia de Vencimento das Faturas" <? if(strstr($_GET['o'],'vencimento')){ ?>class="tdselected" <? } ?>><?= $VENDA['vencimento'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(valor)')){?>
<td title="Valor" <? if(strstr($_GET['o'],'valor')){ ?>class="tdselected" <? } ?>>R$ <?= str_replace('.',',',$VENDA['valor']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(data)')){?>
<td title="Data da Venda" <? if(strstr($_GET['o'],'data ') || $_GET['o'] == ''){ ?>class="tdselected"  <? } ?>><?= substr($VENDA['data'],6,2)."/".substr($VENDA['data'],4,2)."/".substr($VENDA['data'],0,4);?></td>
<? } ?>


<? if(strstr($USUARIO['colunas_claro3g'],'(data_autorizacao)')){?>
<td title="Data da Autorização" <? if(strstr($_GET['o'],'data_autorizacao')){ ?>class="tdselected" <? } ?>>
<?= substr($VENDA['data_autorizacao'],6,2)."/".substr($VENDA['data_autorizacao'],4,2)."/".substr($VENDA['data_autorizacao'],0,4);?>
</td>
<? } ?>


<? if(strstr($USUARIO['colunas_claro3g'],'(pagamento)')){?>
<td title="Forma de Pagamento" <? if(strstr($_GET['o'],'pagamento')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['pagamento']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(motivo_restricao)')){?>
<td title="Motivo Restrição" <? if(strstr($_GET['o'],'motivo_restricao')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['motivo_restricao']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(motivo_cancelamento)')){?>
<td title="Motivo Cancelamento" <? if(strstr($_GET['o'],'motivo_cancelamento')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['motivo_cancelamento']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(tipo_venda)')){?>
<td title="Tipo Venda" <? if(strstr($_GET['o'],'tipoVenda')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['tipoVenda']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_claro3g'],'(status)')){?>
<td title="Status" <? if(strstr($_GET['o'],'status')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['status']);?></td>
<? } ?>

<? $conOBS = $conexao->query("SELECT DATE_FORMAT(observacoes.data, '%d/%m/%Y às %H:%i:%s') AS data,
										  observacoes.observacao AS obs, 
										  usuarios.nome AS usuario
				   				   FROM observacoes 
				                   INNER JOIN usuarios ON usuarios.id = observacoes.id_usuario 
				                   WHERE observacoes.id_venda = '".$VENDA['id']."'
								   ORDER BY observacoes.id DESC
										  
										  ");
   $OBS = mysql_fetch_array($conOBS);
?>
<td width="26px" style="cursor:default" title=" <?= str_replace('"',"'",$OBS['obs']).' 
('.$OBS['usuario'].' em '.$OBS['data'].')';?> ">
<? if($OBS['obs']){?>
<img src="img/coment.png" width="16" height="16" />
<? } ?>
</td>

<td width="26px" style="cursor:pointer">
<? if($USUARIO['inserir_gravacao'] == 1 && $VENDA['status'] == 'GRAVAR' && $VENDA['gravacao'] == ''){?>
<img src="img/icone-gravar.png" title="Inserir Gravação" width="13" height="13" onclick="Popup=window.open('upload-gravacao-simples-claro3g.php?id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=470,height=350,left=430,top=100');" />
<? } ?>

<? if($VENDA['gravacao'] != ''){?>

<img src="img/icone-ouvir.png" title="Ouvir Gravação" width="13" height="13" onclick="javascript:window.open('../audio/claro3g/<?= $VENDA['gravacao'];?>','_blank')" />

<? } ?>
</td>


<? if($USUARIO['editar_dados'] == 1 || $USUARIO['editar_instalacao'] == 1){?>
<td width="26px" title="Editar Dados" style="cursor:pointer"><img src="img/icone-editar.png" width="13" height="13" onclick="Popup=window.open('detalhes-venda-claro3g.php?e=1&id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>
<? } ?>

<td width="26px" title="Mais Detalhes" style="cursor:pointer"><img src="img/icone-mais.png" width="13" height="13" onclick="Popup=window.open('detalhes-venda-claro3g.php?id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>

</tr>



<? } ?>

</table>

<hr size="1" color="#CCC" width="1000px" />


<table border="0" width="1000px">
<tr valign="middle" height="20px">
<td></td>
<?php if($pg != '1'){ ?>
<td width="70px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="cursor:pointer; font-size:13px" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')">

&laquo; Anterior</td><? } else{ ?>

<td width="70px" align="center" bgcolor="#fbfbfb" style="cursor:default; font-size:13px; color:#cdcdcd">&laquo; Anterior</td> 

<? } ?>

<? 

$numpaginas = ceil($quantreg / $numreg);

$i = 1; while($i <= $numpaginas && $i<=45){
 $numpag = $i++;	

if($numpag == $pg){ ?>
	
<td width="15px" align="center" bgcolor="#0096ff" style="cursor:pointer; color:#FFF; font-size:13px; font-weight:bold" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>	
    
	<? }else{ ?>
 
<td width="15px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="font-size:13px; cursor:pointer" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>


<? }} ?>

<?php if(($inicial + $numreg) < $quantreg ){ ?>
<td width="70px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="cursor:pointer; font-size:13px" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv'];?>&pg=<?php echo ($pg + 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')">
Próximo &raquo;</td><? } else {?>

<td width="70px" align="center" bgcolor="#fbfbfb" style="cursor:default; font-size:13px; color:#cdcdcd">Próximo &raquo;</td> 

<? } ?>
<td width="10px"></td>
</tr>

</table>

</center>
<br />
<br />
