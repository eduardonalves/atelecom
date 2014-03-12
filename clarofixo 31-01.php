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

	

$set_colunas = $conexao->query("UPDATE usuarios SET colunas_clarofixo = '(".$_POST['chk1'].") (".$_POST['chk2'].") (".$_POST['chk3'].") (".$_POST['chk4'].") (".$_POST['chk5'].") (".$_POST['chk6'].") (".$_POST['chk7'].") (".$_POST['chk8'].") (".$_POST['chk9'].") (".$_POST['chk10'].") (".$_POST['chk11'].") (".$_POST['chk12'].") (".$_POST['chk13'].") (".$_POST['chk14'].") (".$_POST['chk15'].") (".$_POST['chk16'].") (".$_POST['chk17'].") (".$_POST['chk18'].") (".$_POST['chk19'].") (".$_POST['chk20'].") (".$_POST['chk21'].") (".$_POST['chk22'].") (".$_POST['chk23'].") (".$_POST['chk24'].") (".$_POST['chk25'].") (".$_POST['chk26'].") (".$_POST['chk27'].") (".$_POST['chk28'].") (".$_POST['chk29'].")' WHERE id = '".$USUARIO['id']."'");

?>	



<script type="text/javascript">

window.location = '?p=<?= $_GET['p'];?>'

</script>





<? }?>





<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />



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

<td width="50%"><input type="checkbox" name="chk1" <? if(strstr($USUARIO['colunas_clarofixo'],'(os)')){?>checked="checked"<? } ?> value="os" /> OS</td>

<td width="50%"><input type="checkbox" name="chk2" <? if(strstr($USUARIO['colunas_clarofixo'],'(esn)')){?>checked="checked"<? } ?> value="esn" />ESN</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk3" <? if(strstr($USUARIO['colunas_clarofixo'],'(tipoAssinatura)')){?>checked="checked"<? } ?> value="tipoAssinatura" /> Tipo de Assinatura</td>

<td width="50%"><input type="checkbox" name="chk4" <? if(strstr($USUARIO['colunas_clarofixo'],'(monitor)')){?>checked="checked"<? } ?> value="monitor" /> Monitor</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk5" <? if(strstr($USUARIO['colunas_clarofixo'],'(operador)')){?>checked="checked"<? } ?> value="operador" /> Operador</td>

<td width="50%"><input type="checkbox" name="chk6" <? if(strstr($USUARIO['colunas_clarofixo'],'(nome)')){?>checked="checked"<? } ?> value="nome" /> Cliente</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk7" <? if(strstr($USUARIO['colunas_clarofixo'],'(plano)')){?>checked="checked"<? } ?> value="plano" /> Plano</td>

<td width="50%"><input type="checkbox" name="chk8" <? if(strstr($USUARIO['colunas_clarofixo'],'(telefone)')){?>checked="checked"<? } ?> value="telefone" /> Telefone</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk9" <? if(strstr($USUARIO['colunas_clarofixo'],'(cpf)')){?>checked="checked"<? } ?> value="cpf" /> CPF</td>

<td width="50%"><input type="checkbox" name="chk10" <? if(strstr($USUARIO['colunas_clarofixo'],'(cidade)')){?>checked="checked"<? } ?> value="cidade" /> Cidade</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk11" <? if(strstr($USUARIO['colunas_clarofixo'],'(data)')){?>checked="checked"<? } ?> value="data" /> Data da Venda</td>

<td width="50%"><input type="checkbox" name="chk12" <? if(strstr($USUARIO['colunas_clarofixo'],'(vencimento)')){?>checked="checked"<? } ?> value="vencimento" /> Vencimento</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk13" <? if(strstr($USUARIO['colunas_clarofixo'],'(data_finalizada)')){?>checked="checked"<? } ?> value="data_finalizada" /> Data Finalizada</td>

<td width="50%"><input type="checkbox" name="chk14" <? if(strstr($USUARIO['colunas_clarofixo'],'(status)')){?>checked="checked"<? } ?> value="status" /> Status Auditoria</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk15" <? if(strstr($USUARIO['colunas_clarofixo'],'(pagamento)')){?>checked="checked"<? } ?> value="pagamento" /> Pagamento</td>

<td width="50%"><input type="checkbox" name="chk16" <? if(strstr($USUARIO['colunas_clarofixo'],'(aparelho)')){?>checked="checked"<? } ?> value="aparelho" /> Aparelho</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk17" <? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_cancelamento)')){?>checked="checked"<? } ?> value="motivo_cancelamento" /> Motivo Cancelamento</td>

<td width="50%"><input type="checkbox" name="chk18" <? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_restricao)')){?>checked="checked"<? } ?> value="motivo_restricao" /> Motivo Restrição</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk19" <? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_devolvido)')){?>checked="checked"<? } ?> value="motivo_devolvido" /> Motivo Devolvido</td>

<td width="50%"><input type="checkbox" name="chk20" <? if(strstr($USUARIO['colunas_clarofixo'],'(data_liberacao)')){?>checked="checked"<? } ?> value="data_liberacao" /> Data Liberação</td></tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk21" <? if(strstr($USUARIO['colunas_clarofixo'],'(data_entrega)')){?>checked="checked"<? } ?> value="data_entrega" /> Data Entrega</td>

<td width="50%"><input type="checkbox" name="chk22" <? if(strstr($USUARIO['colunas_clarofixo'],'(cep)')){?>checked="checked"<? } ?> value="cep" /> CEP</td>

</tr>

<tr align="left">
<td width="50%"><input type="checkbox" name="chk23" <? if(strstr($USUARIO['colunas_clarofixo'],'(pendencia)')){?>checked="checked"<? } ?> value="pendencia" /> Pendência</td>

<td width="50%"><input type="checkbox" name="chk24" <? if(strstr($USUARIO['colunas_clarofixo'],'(tipo_venda)')){?>checked="checked"<? } ?> value="tipo_venda" /> Tipo Venda</td>
</tr>

<tr align="left">
<td width="50%"><input type="checkbox" name="chk25" <? if(strstr($USUARIO['colunas_clarofixo'],'(agendamento_gravacao)')){?>checked="checked"<? } ?> value="agendamento_gravacao" /> Agend. Gravação</td>

<td width="50%"><input type="checkbox" name="chk26" <? if(strstr($USUARIO['colunas_clarofixo'],'(novo_numero)')){?>checked="checked"<? } ?> value="novo_numero" /> Novo Número</td>
</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk27" <? if(strstr($USUARIO['colunas_clarofixo'],'(agendamento_entrega)')){?>checked="checked"<? } ?> value="agendamento_entrega" /> Agend. Entrega</td>

<td width="50%"><input type="checkbox" name="chk28" <? if(strstr($USUARIO['colunas_clarofixo'],'(status_portal)')){?>checked="checked"<? } ?> value="status_portal" /> Status Portal</td>

</tr>

<tr align="left">

<td width="50%"><input type="checkbox" name="chk29" <? if(strstr($USUARIO['colunas_clarofixo'],'(documentacao)')){?>checked="checked"<? } ?> value="documentacao" /> Status Xerox</td>

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

<option value="2" <? if($_GET['ve'] == '2'){ ?> selected="selected" <? } ?>>Finalizada</option>

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

<td> | Plano: 

<select name="t" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>

<option value="FAV Local">FAV Local</option>

<option value="FAV Local com DDD">FAV Local com DDD</option>

<option value="FAV Local e DDD">FAV Local e DDD</option>

<option value="FAV Local e DDD com Móvel">FAV Local e DDD com Móvel</option>

<option value=""></option>

<option value="FAV Local + TV">FAV Local + TV</option>

<option value="FAV Local com DDD + TV">FAV Local com DDD + TV</option>

<option value="FAV Local e DDD + TV">FAV Local e DDD + TV</option>

<option value="FAV Local e DDD com Móvel + TV">FAV Local e DDD com Móvel + TV</option>

</select>

</td>



<td>

 | Pagamento:

<select name="f" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>
<!-- 
<option value="BOLETO" <? if($_GET['f'] == 'BOLETO'){?>selected="selected"<? }?>>Boleto</option>

<option value="CARTÃO DE CRÉDITO" <? if($_GET['f'] == 'CARTÃO DE CRÉDITO'){?>selected="selected"<? }?>>Cartão de Crédito</option>

<option value="PRONTA ENTREGA" <? if($_GET['f'] == 'PRONTA ENTREGA'){?>selected="selected"<? }?>>Pronta Entrega</option>
-->
<?php

if(! ($USUARIO["tipo_usuario"]=="MONITOR" && $USUARIO["acesso_usuario"]=="EXTERNO") )
{
	
?>

<option value="BOLETO">BOLETO</option>

<option value="CARTÃO DE CRÉDITO">CARTÃO DE CRÉDITO</option>

<option value="DEPÓSITO">DEPÓSITO</option>

<option value="GRÁTIS">GRÁTIS</option>

<option value="PAGSEGURO">PAGSEGURO</option>

<?php

}

?>

<option value="DINHEIRO">DINHEIRO</option>


</select>

</td>



<td>

 | Status Auditoria:

<select name="s" onchange="javascript:document.forms.filtro.submit();">

<option value=""></option>
<option value="PRE-ANALISE" <? if($_GET['s'] == 'PRE-ANALISE'){?>selected="selected"<? }?>>Pré-Análise</option>

<option value="GRAVAR" <? if($_GET['s'] == 'GRAVAR'){?>selected="selected"<? }?>>Gravar</option>

<option value="GRAVADO" <? if($_GET['s'] == 'GRAVADO'){?>selected="selected"<? }?>>Gravado</option>

<option value="BOLETO GERADO" <? if($_GET['s'] == 'BOLETO GERADO'){?>selected="selected"<? }?>>Boleto Gerado</option>

<option value="ENVIAR GRAVAÇÃO" <? if($_GET['s'] == 'ENVIAR GRAVAÇÃO'){?>selected="selected"<? }?>>Enviar Gravação</option>

<option value="FINALIZADA" <? if($_GET['s'] == 'FINALIZADA'){?>selected="selected"<? }?>>Finalizada</option>

<option value="RESTRIÇÃO" <? if($_GET['s'] == 'RESTRIÇÃO'){?>selected="selected"<? }?>>Restrição</option>

<option value="CANCELADO" <? if($_GET['s'] == 'CANCELADO'){?>selected="selected"<? }?>>Cancelado</option>

<option value="DEVOLVIDO" <? if($_GET['s'] == 'DEVOLVIDO'){?>selected="selected"<? }?>>Devolvido</option>

<option value="PENDENTE" <? if($_GET['s'] == 'PENDENTE'){?>selected="selected"<? }?>>Pendente</option>

<option value="SEM COBERTURA" <? if($_GET['s'] == 'SEM COBERTURA'){?>selected="selected"<? } ?>>Sem Cobertura</option>

<option value="SEM CONTATO" <? if($_GET['s'] == 'SEM CONTATO'){?>selected="selected"<? }?>>Sem Contato</option>

<option value="REDIRECIONADO" <? if($_GET['s'] == 'REDIRECIONADO'){?>selected="selected"<? }?>>Redirecionado</option>

</select>

</td>





<td> | Venda de: <input type="text" name="v" id="calendario" onKeyPress="mascara(this,data)" value="<?= $_GET['v'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



<td>Até: <input type="text" name="i" id="calendario2" onKeyPress="mascara(this,data)" value="<?= $_GET['i'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



</tr>



</table>

<table width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">

<tr align="left" height="40" style="font-size:13px">



<td width="180px">Data Entrega: <input type="text" name="de" id="calendario3" onKeyPress="mascara(this,data)" value="<?= $_GET['de'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



<td width="190px"> | Data Finalizada: <input type="text" name="di" id="calendario4" onKeyPress="mascara(this,data)" value="<?= $_GET['di'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>



<td width="210px" align="center"> | Com Gravação: <input type="radio" name="g" value="1" <? if($_GET['g'] == '1'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> Sim <input type="radio" name="g" value="0" <? if($_GET['g'] == '0'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> Não</td>

<td> | Tipo Venda: <select name="tpv" onchange="javascript:document.forms.filtro.submit();">
				   	<option></option>
                    <option <? if($_GET['tpv'] == 'INTERNA'){?>selected="selected"<? } ?>>INTERNA</option>
                    <option <? if($_GET['tpv'] == 'EXTERNA'){?>selected="selected"<? } ?>>EXTERNA</option>
                    </select></td>


<td>| Buscar: <input type="text" size="11" value="<?= $_GET['b']; ?>" name="b" onkeyup="keypressed()" /> &nbsp;</td>

<tr align="left" height="40" style="font-size:13px">

<td valign="middle">Status Portal:</td>

<td>

<?php 

include_once "lib/class.Accents.php";
include_once "lib/class.planilhaQualidade.php";
include_once "lib/class.Qualidade.php";

$planilhas = new planilhaQualidade($conexao);
$saidaTexto = new Accents( Accents::UTF_8, Accents::ISO_8859_1 );

?>

<select name="ebt">
		
	<option value="n" <?php if (isset($_GET["ebt"]) && $_GET["ebt"]=='n'){ echo "selected=\"selected\""; }?>>Todos</option>

	<?php
	
	foreach($planilhas->getTiposPlanilhas() as $key=>$value)
	{
	?>
	
	<option value="<?php echo $key; ?>" <?php if (isset($_GET["ebt"]) && $_GET["ebt"]=="$key"){ echo "selected=\"selected\""; }?>><?php echo $saidaTexto->clear($value); ?></option>
	
	<?php
	}
	?>

</select>

</td>

<td valign="top" width="70%" colspan="3" align="left"><img src="img/bt_ok.png" style="margin-left:20px; margin-top:7px; cursor:pointer; position:relative; padding-top:2px;" onclick="javascript:document.forms.filtro.submit();" valign="bootom" /></td>

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



include "includes/filtro-clarofixo.php";

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

<input type="hidden" name="de" value="<?= $_GET['de'];?>" />

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



<? if(strstr($USUARIO['colunas_clarofixo'],'(os)')){?>

<td title="N&uacute;mero da OS" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'os DESC'){ echo 'os DESC'; } else { echo 'os ASC'; }?>'">OS <? if($_GET['o'] == 'os DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'os ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(esn)')){?>

<td title="Código da ESN" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&o=<? if($_GET['o'] != 'esn DESC'){ echo 'esn DESC'; } else { echo 'esn ASC'; }?>'">ESN <? if($_GET['o'] == 'esn DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'esn ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(tipoAssinatura)')){?>

<td title="Tipo de Assinatura" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&o=<? if($_GET['o'] != 'tipoAssinatura DESC'){ echo 'tipoAssinatura DESC'; } else { echo 'tipoAssinatura ASC'; }?>'">Tipo Assinatura <? if($_GET['o'] == 'tipoAssinatura DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'tipoAssinatura ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(monitor)')){?>

<td title="Nome do Monitor" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'monitor DESC'){ echo 'monitor DESC'; } else { echo 'monitor ASC'; }?>'">Monitor <? if($_GET['o'] == 'monitor DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'monitor ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(operador)')){?>

<td title="Nome do Operador" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'operador DESC'){ echo 'operador DESC'; } else { echo 'operador ASC'; }?>'">Operador <? if($_GET['o'] == 'operador DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'operador ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(nome)')){?>

<td title="Nome do Cliente" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'nome DESC'){ echo 'nome DESC'; } else { echo 'nome ASC'; }?>'">Cliente <? if($_GET['o'] == 'nome DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'nome ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(cpf)')){?>

<td title="CPF do Cliente" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'cpf DESC'){ echo 'cpf DESC'; } else { echo 'cpf ASC'; }?>'">CPF/CNPJ <? if($_GET['o'] == 'cpf DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'cpf ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(telefone)')){?>

<td title="Telefone do Cliente" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'telefone DESC'){ echo 'telefone DESC'; } else { echo 'telefone ASC'; }?>'">Telefone <? if($_GET['o'] == 'telefone DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'telefone ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(novo_numero)')){?>

<td title="Novo Némero de Telefone do Cliente" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'novoNumero DESC'){ echo 'novoNumero DESC'; } else { echo 'novoNumero ASC'; }?>'">Novo Número <? if($_GET['o'] == 'novoNumero DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'novoNumero ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(cidade)')){?>

<td title="Cidade do Cliente" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'cidade DESC'){ echo 'cidade DESC'; } else { echo 'cidade ASC'; }?>'">Cidade <? if($_GET['o'] == 'cidade DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'cidade ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(cep)')){?>

<td title="CEP" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'cep DESC'){ echo 'cep DESC'; } else { echo 'cep ASC'; }?>'">CEP <? if($_GET['o'] == 'cep DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'cep ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(plano)')){?>

<td title="PLANO" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'plano DESC'){ echo 'plano DESC'; } else { echo 'plano ASC'; }?>'">Plano <? if($_GET['o'] == 'plano DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'plano ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(aparelho)')){?>

<td title="PLANO" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'aparelho DESC'){ echo 'aparelho DESC'; } else { echo 'aparelho ASC'; }?>'">Aparelho <? if($_GET['o'] == 'aparelho DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'aparelho ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(vencimento)')){?>

<td title="Dia do Vencimento da Fatura" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'ABS(vencimento) DESC'){ echo 'ABS(vencimento) DESC'; } else { echo 'ABS(vencimento) ASC'; }?>'">Vencimento <? if($_GET['o'] == 'ABS(vencimento) DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'ABS(vencimento) ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(data)')){?>

<td title="Data da Venda" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'data ASC' || $_GET['o'] == ''){ echo 'data ASC'; } else { echo 'data DESC'; }?>'">Data Venda <? if($_GET['o'] == 'data DESC' || $_GET['o'] == ''){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'data ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(data_entrega)')){?>

<td title="Data da Entrega" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'data_marcada ASC' || $_GET['o'] == ''){ echo 'data_marcada ASC'; } else { echo 'data_marcada DESC'; }?>'">Data Entrega <? if($_GET['o'] == 'data_marcada DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'data_marcada ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(data_finalizada)')){?>

<td title="Data da Autorização" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'data_instalacao DESC'){ echo 'data_instalacao DESC'; } else { echo 'data_instalacao ASC'; }?>'">Data Finallizada <? if($_GET['o'] == 'data_instalacao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'data_instalacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(pagamento)')){?>

<td title="Forma de Pagamento" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'pagamento DESC'){ echo 'pagamento DESC'; } else { echo 'pagamento ASC'; }?>'">Pagamento <? if($_GET['o'] == 'pagamento DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'pagamento ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_restricao)')){?>

<td title="Motivo Restrição" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'motivo_restricao DESC'){ echo 'motivo_restricao DESC'; } else { echo 'motivo_restricao ASC'; }?>'">Motivo Restrição <? if($_GET['o'] == 'motivo_restricao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'motivo_restricao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_cancelamento)')){?>

<td title="Motivo Cancelamento" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'motivo_cancelamento DESC'){ echo 'motivo_cancelamento DESC'; } else { echo 'motivo_cancelamento ASC'; }?>'">Motivo Cancelamento <? if($_GET['o'] == 'motivo_cancelamento DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'motivo_cancelamento ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_devolvido)')){?>

<td title="Motivo Devoldido" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'motivo_devolvido DESC'){ echo 'motivo_devolvido DESC'; } else { echo 'motivo_devolvido ASC'; }?>'">Motivo Devolvido <? if($_GET['o'] == 'motivo_devolvido DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'motivo_devolvido ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(pendencia)')){?>

<td title="Pendencia" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'pendencia DESC'){ echo 'pendencia DESC'; } else { echo 'pendencia ASC'; }?>'">Pendência <? if($_GET['o'] == 'pendencia DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'pendencia ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(data_liberacao)')){?>

<td title="Motivo Devoldido" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'dataLiberacao DESC'){ echo 'dataLiberacao DESC'; } else { echo 'dataLiberacao ASC'; }?>'">Data Liberação <? if($_GET['o'] == 'dataLiberacao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'dataLiberacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(tipo_venda)')){?>

<td title="Tipo Venda" onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'tipoVenda DESC'){ echo 'tipoVenda DESC'; } else { echo 'tipoVenda ASC'; }?>'">Tipo Venda <? if($_GET['o'] == 'tipoVenda DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'tipoVenda ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(agendamento_gravacao)')){?>

<td onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'agendGravacao DESC'){ echo 'agendGravacao DESC'; } else { echo 'agendGravacao ASC'; }?>'">Agend. Gravação <? if($_GET['o'] == 'agendGravacao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'agendGravacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(agendamento_entrega)')){?>

<td onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'agendEntrega DESC'){ echo 'agendEntrega DESC'; } else { echo 'agendEntrega ASC'; }?>'">Agend. Entrega <? if($_GET['o'] == 'agendEntrega DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'agendEntrega ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(status)')){?>

<td onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'status DESC'){ echo 'status DESC'; } else { echo 'status ASC'; }?>'">Status Auditoria <? if($_GET['o'] == 'status DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'status ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(status_portal)')){?>

<td onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'status_qualidade DESC'){ echo 'status_qualidade DESC'; } else { echo 'status_qualidade ASC'; }?>'">Status Portal<? if($_GET['o'] == 'status_qualidade DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'status_qualidade ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(documentacao)')){?>

<td onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'status_processo DESC'){ echo 'status_processo DESC'; } else { echo 'status_processo ASC'; }?>'">Status Xerox <? if($_GET['o'] == 'status_processo DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'status_processo ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>

<? } ?>

<td></td>

<td onclick="window.location = '?p=clarofixo&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'gravacao DESC'){ echo 'gravacao DESC'; } else { echo 'gravacao ASC'; }?>'"></td>



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



<? if(strstr($USUARIO['colunas_clarofixo'],'(os)')){?>

<td title="N&uacute;mero da OS" <? if(strstr($_GET['o'],'os')){ ?> class="tdselected" <? } ?>><?= $VENDA['os'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(esn)')){?>

<td title="Código ESN" <? if(strstr($_GET['o'],'esn')){ ?>class="tdselected" <? } ?>><?= $VENDA['esn'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(tipoAssinatura)')){?>

<td title="Tipo de Assinatura" <? if(strstr($_GET['o'],'tipoAssinatura')){ ?>class="tdselected" <? } ?>><?= $VENDA['tipoAssinatura'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(monitor)')){?>

<td title="Nome do Monitor" <? if(strstr($_GET['o'],'monitor')){ ?>class="tdselected" <? } ?>><?= $MONITOR['nome'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(operador)')){?>

<td title="Nome do Operador" <? if(strstr($_GET['o'],'operador')){ ?>class="tdselected" <? } ?>><?= $OPERADOR['nome'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(nome)')){?>

<td title="Nome do Cliente" <? if(strstr($_GET['o'],'nome')){ ?>class="tdselected" <? } ?>><?= ucwords(strtolower($VENDA['nome']));?></td>

<? } ?> 



<? if(strstr($USUARIO['colunas_clarofixo'],'(cpf)')){?>

<td title="CPF/CNPJ do Cliente" <? if(strstr($_GET['o'],'cpf')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['cpf']);?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(telefone)')){?>

<td title="Telefone do Cliente" <? if(strstr($_GET['o'],'telefone')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['telefone']);?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(novo_numero)')){?>

<td title="Novo Número de Telefone do Cliente" <? if(strstr($_GET['o'],'novoNumero')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['novoNumero']);?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(cidade)')){?>

<td title="Cidade do Cliente" <? if(strstr($_GET['o'],'cidade')){ ?>class="tdselected" <? } ?>><?= ucwords(strtolower($VENDA['cidade']));?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(cep)')){?>

<td title="CEP" <? if(strstr($_GET['o'],'cep')){ ?>class="tdselected" <? } ?>><?= ucwords(strtolower($VENDA['cep']));?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(plano)')){?>

<td title="Plano" <? if(strstr($_GET['o'],'plano')){ ?>class="tdselected" <? } ?>><?= $VENDA['plano'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(aparelho)')){?>

<td title="Aparelho" <? if(strstr($_GET['o'],'aparelho')){ ?>class="tdselected" <? } ?>>

<?php

	if(ctype_digit($VENDA['aparelho']) && $VENDA['aparelho']!="0"){
	
		include_once "lib/class.controleEstoque.php";

		$estoque = new controleEstoque($conexao);
		$apInfo = $estoque->getAparelho($VENDA['aparelho']);
		echo $apInfo["marca"] . " - " . $apInfo["modelo"];
		//echo $VENDA['aparelho'];
		
	}else{
		
		echo $VENDA['aparelho'];
	
	};

 ?>

</td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(vencimento)')){?>

<td title="Dia de Vencimento das Faturas" <? if(strstr($_GET['o'],'vencimento')){ ?>class="tdselected" <? } ?>><?= $VENDA['vencimento'];?></td>

<? } ?>





<? if(strstr($USUARIO['colunas_clarofixo'],'(data)')){?>

<td title="Data da Venda" <? if(strstr($_GET['o'],'data ') || $_GET['o'] == ''){ ?>class="tdselected"  <? } ?>><?= substr($VENDA['data'],6,2)."/".substr($VENDA['data'],4,2)."/".substr($VENDA['data'],0,4);?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(data_entrega)')){?>

<td title="Data Entrega" <? if(strstr($_GET['o'],'data_marcada')){ ?>class="tdselected" <? } ?>>

<?= substr($VENDA['data_marcada'],6,2)."/".substr($VENDA['data_marcada'],4,2)."/".substr($VENDA['data_marcada'],0,4);?>

</td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(data_finalizada)')){?>

<td title="Data Finalizada" <? if(strstr($_GET['o'],'data_instalacao')){ ?>class="tdselected" <? } ?>>

<?= substr($VENDA['data_instalacao'],6,2)."/".substr($VENDA['data_instalacao'],4,2)."/".substr($VENDA['data_instalacao'],0,4);?>

</td>

<? } ?>





<? if(strstr($USUARIO['colunas_clarofixo'],'(pagamento)')){?>

<td title="Forma de Pagamento" <? if(strstr($_GET['o'],'pagamento')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['pagamento']);?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_restricao)')){?>

<td title="Motivo Restrição" <? if(strstr($_GET['o'],'motivo_restricao')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['motivo_restricao']);?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_cancelamento)')){?>

<td title="Motivo Cancelamento" <? if(strstr($_GET['o'],'motivo_cancelamento')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['motivo_cancelamento']);?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(motivo_devolvido)')){?>

<td title="Motivo Devolvido" <? if(strstr($_GET['o'],'motivo_devolvido')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['motivo_devolvido']);?></td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(pendencia)')){?>

<td title="Pendencia" <? if(strstr($_GET['o'],'pendencia')){ ?>class="tdselected" <? } ?>><?= $VENDA['pendencia'];?></td>

<? } ?>



<? if(strstr($USUARIO['colunas_clarofixo'],'(data_liberacao)')){?>

<td title="Data Liberação" <? if(strstr($_GET['o'],'dataLiberacao')){ ?>class="tdselected" <? } ?>>

<?= substr($VENDA['dataLiberacao'],6,2)."/".substr($VENDA['dataLiberacao'],4,2)."/".substr($VENDA['dataLiberacao'],0,4);?>

</td>

<? } ?>


<? if(strstr($USUARIO['colunas_clarofixo'],'(tipo_venda)')){?>

<td title="Tipo Venda" <? if(strstr($_GET['o'],'tipoVenda')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['tipoVenda']);?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(agendamento_gravacao)')){?>

<td title="Agendamento Gravação" <? if(strstr($_GET['o'],'agendGravacao')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['agendGravacao']);?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(agendamento_entrega)')){?>

<td title="Agendamento Entrega" <? if(strstr($_GET['o'],'agendEntrega')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['agendEntrega']);?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(status)')){?>

<td title="Status" <? if(strstr($_GET['o'],'status')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['status']);?></td>

<? } ?>

<?php
include_once "lib/class.Accents.php";
include_once "lib/class.planilhaQualidade.php";
include_once "lib/class.Qualidade.php";
$planilhas = new planilhaQualidade($conexao);
$saidaTexto = new Accents( Accents::UTF_8, Accents::ISO_8859_1 );
?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(status_portal)')){?>

<td title="Status Portal" <? if(strstr($_GET['o'],'status_portal')){ ?>class="tdselected" <? } ?>><? echo $saidaTexto->clear( $planilhas->getTiposPlanilhas($VENDA["status_qualidade"]));?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarofixo'],'(documentacao)')){?>

<td title="Documenta&ccedil;&atilde;o" <? if(strstr($_GET['o'],'documentacao')){ ?>class="tdselected" <? } ?>><? echo $saidaTexto->clear( $planilhas->getTiposProcessos($VENDA["status_processo"]));?></td>

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

<img src="img/icone-gravar.png" title="Inserir Gravação" width="13" height="13" onclick="Popup=window.open('upload-gravacao-simples-clarofixo.php?id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=470,height=350,left=430,top=100');" />

<? } ?>



<? if($VENDA['gravacao'] != ''){?>



<img src="img/icone-ouvir.png" title="Ouvir Gravação" width="13" height="13" onclick="javascript:window.open('http://172.16.0.30/audio/clarofixo/orig/<?= $VENDA['gravacao'];?>','_blank')" />



<? } ?>

</td>





<? if($USUARIO['editar_dados'] == 1 || $USUARIO['editar_instalacao'] == 1  || $USUARIO['id']==3179){?>

<td width="26px" title="Editar Dados" style="cursor:pointer"><img src="img/icone-editar.png" width="13" height="13" onclick="Popup=window.open('detalhes-venda-clarofixo.php?e=1&id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>

<? } ?>



<td width="26px" title="Mais Detalhes" style="cursor:pointer"><img src="img/icone-mais.png" width="13" height="13" onclick="Popup=window.open('detalhes-venda-clarofixo.php?id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>



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

	

<td width="15px" align="center" bgcolor="#0096ff" style="cursor:pointer; color:#FFF; font-size:13px; font-weight:bold" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>	

    

	<? }else{ ?>

 

<td width="15px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="font-size:13px; cursor:pointer" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>





<? }} ?>



<?php if(($inicial + $numreg) < $quantreg ){ ?>

<td width="70px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="cursor:pointer; font-size:13px" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg + 1); ?>&di=<?= $_GET['di']; ?>&de=<?= $_GET['de']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&g=<?= $_GET['g']; ?>')">

Próximo &raquo;</td><? } else {?>



<td width="70px" align="center" bgcolor="#fbfbfb" style="cursor:default; font-size:13px; color:#cdcdcd">Próximo &raquo;</td> 



<? } ?>

<td width="10px"></td>

</tr>



</table>



</center>

<br />

<br />

