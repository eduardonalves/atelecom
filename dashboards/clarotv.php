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

if($ordem == ''){ $ordem = 'vendas_clarotv.data DESC';}

else if($ordem == 'vendas_clarotv.data_marcada ASC'){ $ordem = "(case when vendas_clarotv.reagendamento1 = '' then vendas_clarotv.data_marcada else vendas_clarotv.reagendamento1 end) ASC";}

else if($ordem == 'vendas_clarotv.data_marcada DESC'){ $ordem = "(case when vendas_clarotv.reagendamento1 = '' then vendas_clarotv.data_marcada else vendas_clarotv.reagendamento1 end) DESC";}


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
$di = $di0[2].$di0[1].$di0[0];
} else {

if($_GET['ve'] == '2'){	
$di = $ano.$mes;	
}
}


///////////////////////////////////////////
//////////////////////////////////////////

if(isset($_POST['chk'])){
	
$set_colunas = $conexao->query("UPDATE usuarios SET colunas_clarotv = '(".$_POST['chk1'].") (".$_POST['chk2'].") (".$_POST['chk3'].") (".$_POST['chk4'].") (".$_POST['chk5'].") (".$_POST['chk6'].") (".$_POST['chk7'].") (".$_POST['chk8'].") (".$_POST['chk9'].") (".$_POST['chk10'].") (".$_POST['chk11'].") (".$_POST['chk12'].") (".$_POST['chk13'].") (".$_POST['chk14'].") (".$_POST['chk15'].") (".$_POST['chk16'].") (".$_POST['chk17'].") (".$_POST['chk18'].") (".$_POST['chk19'].") (".$_POST['chk20'].") (".$_POST['chk21'].") (".$_POST['chk22'].") (".$_POST['chk23'].") (".$_POST['chk24'].") (".$_POST['chk25'].") (".$_POST['chk26'].") (".$_POST['chk27'].")' WHERE id = '".$USUARIO['id']."'");	
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


function check(){
 if ($('#imprimir :checkbox:checked').length > 0){
    // one or more checkboxes are checked
	
	$('#printbt').html('<input type="image" src="img/print-icon.png" width="24" onclick="document.imprimir.submit();" title="Imprimir todas as OS selecionadas" name="P" value="P" />');
	
  }
  else{
   // no checkboxes are checked
   
   	$('#printbt').html('<img src="img/print-icon.png" width="24" title="Selecione as OS que deseja imprimir" style="opacity:0.4" />');

  }
  
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
<td width="50%"><input type="checkbox" name="chk1" <? if(strstr($USUARIO['colunas_clarotv'],'(os)')){?>checked="checked"<? } ?> value="os" /> 
<?= strtoupper($campo->os);?></td>
<td width="50%"><input type="checkbox" name="chk2" <? if(strstr($USUARIO['colunas_clarotv'],'(vencimento)')){?>checked="checked"<? } ?> value="vencimento" /> <?= $campo->vencimento;?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk3" <? if(strstr($USUARIO['colunas_clarotv'],'(contrato)')){?>checked="checked"<? } ?> value="contrato" /> <?= strtoupper($campo->contrato);?></td>
<td><input type="checkbox" name="chk4" <? if(strstr($USUARIO['colunas_clarotv'],'(valor)')){?>checked="checked"<? } ?> value="valor" /> <?= strtoupper($campo->valor);?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk5" <? if(strstr($USUARIO['colunas_clarotv'],'(nome)')){?>checked="checked"<? } ?> value="nome" /> <?= strtoupper($campo->cliente);?></td>
<td><input type="checkbox" name="chk6" <? if(strstr($USUARIO['colunas_clarotv'],'(pagamento)')){?>checked="checked"<? } ?> value="pagamento" /> <?= strtoupper($campo->pagamento);?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk7" <? if(strstr($USUARIO['colunas_clarotv'],'(cpf)')){?>checked="checked"<? } ?> value="cpf" /> <?= strtoupper($campo->cpf);?></td>
<td><input type="checkbox" name="chk8" <? if(strstr($USUARIO['colunas_clarotv'],'(data)')){?>checked="checked"<? } ?> value="data" /> <?= strtoupper($campo->data);?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk9" <? if(strstr($USUARIO['colunas_clarotv'],'(telefone)')){?>checked="checked"<? } ?> value="telefone" /> <?= strtoupper($campo->telefone);?></td>
<td><input type="checkbox" name="chk10" <? if(strstr($USUARIO['colunas_clarotv'],'(data_marcada)')){?>checked="checked"<? } ?> value="data_marcada" /> <?= strtoupper($campo->data_marcada);?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk11" <? if(strstr($USUARIO['colunas_clarotv'],'(email)')){?>checked="checked"<? } ?> value="email" /> <?= strtoupper($campo->email);?></td>
<td><input type="checkbox" name="chk12" <? if(strstr($USUARIO['colunas_clarotv'],'(data_instalacao)')){?>checked="checked"<? } ?> value="data_instalacao" /> <?= strtoupper(utf8_decode($campo->data_instalacao));?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk13" <? if(strstr($USUARIO['colunas_clarotv'],'(endereco)')){?>checked="checked"<? } ?>  value="endereco" /> <?= strtoupper(utf8_decode($campo->endereco));?></td>
<td><input type="checkbox" name="chk14" <? if(strstr($USUARIO['colunas_clarotv'],'(tipo_instalacao)')){?>checked="checked"<? } ?> value="tipo_instalacao" /> <?= strtoupper(utf8_decode($campo->tipo_instalacao));?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk15" <? if(strstr($USUARIO['colunas_clarotv'],'(cep)')){?>checked="checked"<? } ?> value="cep" /> <?= strtoupper($campo->cep);?></td>
<td><input type="checkbox" name="chk16" <? if(strstr($USUARIO['colunas_clarotv'],'(tecnico)')){?>checked="checked"<? } ?> value="tecnico" /> <?= strtoupper(utf8_decode($campo->tecnico));?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk17" <? if(strstr($USUARIO['colunas_clarotv'],'(plano)')){?>checked="checked"<? } ?> value="plano" /> <?= strtoupper($campo->plano);?></td>
<td><input type="checkbox" name="chk18" <? if(strstr($USUARIO['colunas_clarotv'],'(pontos)')){?>checked="checked"<? } ?> value="pontos" /> <?= strtoupper($campo->pontos);?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk19" <? if(strstr($USUARIO['colunas_clarotv'],'(status)')){?>checked="checked"<? } ?> value="status" /> <?= strtoupper($campo->status);?></td>
<td><input type="checkbox" name="chk20" <? if(strstr($USUARIO['colunas_clarotv'],'(proposta)')){?>checked="checked"<? } ?> value="proposta" /> <?= strtoupper($campo->proposta);?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk21" <? if(strstr($USUARIO['colunas_clarotv'],'(monitor)')){?>checked="checked"<? } ?> value="monitor" /> <?= strtoupper($campo->monitor);?></td>
<td><input type="checkbox" name="chk22" <? if(strstr($USUARIO['colunas_clarotv'],'(operador)')){?>checked="checked"<? } ?> value="operador" /> <?= strtoupper($campo->operador);?></td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk23" <? if(strstr($USUARIO['colunas_clarotv'],'(cidade)')){?>checked="checked"<? } ?> value="cidade" /> <?= strtoupper($campo->cidade);?></td>
<td><input type="checkbox" name="chk24" <? if(strstr($USUARIO['colunas_clarotv'],'(motivo_cancelamento)')){?>checked="checked"<? } ?> value="motivo_cancelamento" /> Motivo Cancelamento</td>
</tr>
<tr align="left">
<td><input type="checkbox" name="chk25" <? if(strstr($USUARIO['colunas_clarotv'],'(tipo_venda)')){?>checked="checked"<? } ?> value="tipo_venda" /> Tipo Venda</td>
<td width="50%"><input type="checkbox" name="chk26" <? if(strstr($USUARIO['colunas_clarotv'],'(motivo_analise)')){?>checked="checked"<? } ?> value="motivo_analise" /> Motivo Análise</td>
</tr>
<tr align="left">
<td width="50%"><input type="checkbox" name="chk27" <? if(strstr($USUARIO['colunas_clarotv'],'(agendamento_gravacao)')){?>checked="checked"<? } ?> value="agendamento_gravacao" /> Agend. Gravação</td>
<td></td>
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
<? include "submenu-clarotv.php";?>
<!-- FIM DO SUBMENU -->



<br />

<center>



<form name="filtro" method="get">
<table border="0" width="1000px" style="font-size:12px; color:#FFF; font-weight:bold" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr>
<td></td>
<td bgcolor="#565656" width="380px" align="center">
<select name="ve" onchange="javascript:document.forms.filtro.submit();">
<option value="1" <? if($_GET['ve'] == '1'){ ?> selected="selected" <? } ?>>Vendas</option>
<option value="2" <? if($_GET['ve'] == '2'){ ?> selected="selected" <? } ?>>Instalações</option>
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
<td> | Tipo de Instalação: 
<select name="t" onchange="javascript:document.forms.filtro.submit();">
<option value=""></option>
<option value="Interna" <? if($_GET['t'] == 'Interna'){?>selected="selected"<? }?>>Interna</option>
<option value="Externa" <? if($_GET['t'] == 'Externa'){?>selected="selected"<? }?>>Externa</option>
</select>
</td>

<td>
 | Forma de Pagamento:
<select name="f" onchange="javascript:document.forms.filtro.submit();">
<option value=""></option>
<option value="BOLETO" <? if($_GET['f'] == 'BOLETO'){?>selected="selected"<? }?>>Boleto</option>
<option value="DÉBITO" <? if($_GET['f'] == 'DÉBITO'){?>selected="selected"<? }?>>Débito</option>
<option value="CARTÃO DE CRÉDITO" <? if($_GET['f'] == 'CARTÃO DE CRÉDITO'){?>selected="selected"<? }?>>Cartão</option>

</select>
</td>

<td>
 | Status:
<select name="s" onchange="javascript:document.forms.filtro.submit();">
<option value=""></option>
<option value="PRE-ANALISE" <? if($_GET['s'] == 'PRE-ANALISE'){?>selected="selected"<? }?>>Pré-Análise</option>
<option value="ANÁLISE" <? if($_GET['s'] == 'ANÁLISE'){?>selected="selected"<? }?>>Análise</option>
<option value="RESTRIÇÃO" <? if($_GET['s'] == 'RESTRIÇÃO'){?>selected="selected"<? }?>>Restrição</option>

<option value="GRAVAR" <? if($_GET['s'] == 'GRAVAR'){?>selected="selected"<? }?>>Gravar</option>
<option value="SEM CONTATO" <? if($_GET['s'] == 'SEM CONTATO'){?>selected="selected"<? }?>>Sem Contato</option>
<option value="DEVOLVIDO" <? if($_GET['s'] == 'DEVOLVIDO'){?>selected="selected"<? }?>>Devolvido</option>

<option value="APROVADO" <? if($_GET['s'] == 'APROVADO'){?>selected="selected"<? }?>>Aprovado</option>
<option value="INSTALAR" <? if($_GET['s'] == 'INSTALAR'){?>selected="selected"<? }?>>Instalar</option>
<option value="REAGENDADA" <? if($_GET['s'] == 'REAGENDADA'){?>selected="selected"<? }?>>Reagendada</option>


<option value="CONECTADO" <? if($_GET['s'] == 'CONECTADO'){?>selected="selected"<? }?>>Conectado</option>

<option value="CANCELADO" <? if($_GET['s'] == 'CANCELADO'){?>selected="selected"<? }?>>Cancelado</option>

</select>
</td>


<td> | Venda de: <input type="text" name="v" id="calendario" onKeyPress="mascara(this,data)" value="<?= $_GET['v'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>

<td>Até: <input type="text" name="ate" id="calendario2" onKeyPress="mascara(this,data)" value="<?= $_GET['ate'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>

</tr>

</table>
<table width="1000px" bgcolor="#f6f6f6" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr align="left" height="40" style="font-size:13px">

<td width="175px">Agendamento: <input type="text" name="i" id="calendario3" onKeyPress="mascara(this,data)" value="<?= $_GET['i'];?>" maxlength="10" size="7" onchange="javascript:document.forms.filtro.submit();" /></td>

<td width="190px"> | Data Instalada: <input type="text" name="di" id="calendario4" class="datepicker" onKeyPress="mascara(this,data)" value="<?= $_GET['di'];?>" maxlength="10" size="8" onchange="javascript:document.forms.filtro.submit();" /></td>

<td width="210px" align="center"> | Com Gravação: <input type="radio" name="g" value="1" <? if($_GET['g'] == '1'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> Sim <input type="radio" name="g" value="0" <? if($_GET['g'] == '0'){?> checked="checked" <? }?> onchange="javascript:document.forms.filtro.submit();" /> Não</td>

<td> | Tipo Venda: <select name="tpv" onchange="javascript:document.forms.filtro.submit();">
				   	<option></option>
                    <option <? if($_GET['tpv'] == 'INTERNA'){?>selected="selected"<? } ?>>INTERNA</option>
                    <option <? if($_GET['tpv'] == 'EXTERNA'){?>selected="selected"<? } ?>>EXTERNA</option>
                    </select></td>

<td>| Buscar: <input type="text" size="13" value="<?= $_GET['b']; ?>" name="b" onkeyup="keypressed()" /> &nbsp;

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

include "includes/filtro-clarotv.php";
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

<form name="imprimir" id="imprimir" method="post" action="print/os-clarotv" target="_blank">
<table border="0" width="1000px" onmouseover="loadsize(document.getElementById('pagesize').innerHTML);">
<tr bgcolor="#565656" style="color:#FFF; font-size:14px; font-weight:bold; cursor:pointer;" align="center" class="tr1">

<? if(strstr($USUARIO['colunas_clarotv'],'(os)')){?>
<td title="N&uacute;mero da OS" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.os DESC'){ echo 'vendas_clarotv.os DESC'; } else { echo 'vendas_clarotv.os ASC'; }?>'">OS <? if($_GET['o'] == 'vendas_clarotv.os DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.os ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(proposta)')){?>
<td title="N&uacute;mero da Proposta" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.proposta DESC'){ echo 'vendas_clarotv.proposta DESC'; } else { echo 'vendas_clarotv.proposta ASC'; }?>'">Proposta <? if($_GET['o'] == 'vendas_clarotv.proposta DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.proposta ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(contrato)')){?>
<td title="N&uacute;mero do Contrato" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.contrato DESC'){ echo 'vendas_clarotv.contrato DESC'; } else { echo 'vendas_clarotv.contrato ASC'; }?>'">Contrato <? if($_GET['o'] == 'vendas_clarotv.contrato DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.contrato ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(monitor)')){?>
<td title="Nome do Monitor" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.monitor DESC'){ echo 'vendas_clarotv.monitor DESC'; } else { echo 'vendas_clarotv.monitor ASC'; }?>'">Monitor <? if($_GET['o'] == 'vendas_clarotv.monitor DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.monitor ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(operador)')){?>
<td title="Nome do Operador" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.operador DESC'){ echo 'vendas_clarotv.operador DESC'; } else { echo 'vendas_clarotv.operador ASC'; }?>'">Operador <? if($_GET['o'] == 'vendas_clarotv.operador DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.operador ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(nome)')){?>
<td title="Nome do Cliente" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.nome DESC'){ echo 'vendas_clarotv.nome DESC'; } else { echo 'vendas_clarotv.nome ASC'; }?>'">Cliente <? if($_GET['o'] == 'vendas_clarotv.nome DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.nome ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(cpf)')){?>
<td title="CPF do Cliente" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.cpf DESC'){ echo 'vendas_clarotv.cpf DESC'; } else { echo 'vendas_clarotv.cpf ASC'; }?>'">CPF/CNPJ <? if($_GET['o'] == 'vendas_clarotv.cpf DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.cpf ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(telefone)')){?>
<td title="Telefone do Cliente" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.telefone DESC'){ echo 'vendas_clarotv.telefone DESC'; } else { echo 'vendas_clarotv.telefone ASC'; }?>'">Telefone <? if($_GET['o'] == 'vendas_clarotv.telefone DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.telefone ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(email)')){?>
<td title="Email do Cliente" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.email DESC'){ echo 'vendas_clarotv.email DESC'; } else { echo 'vendas_clarotv.email ASC'; }?>'">Email <? if($_GET['o'] == 'vendas_clarotv.email DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.email ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(endereco)')){?>
<td title="Endereço do Cliente" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.endereco DESC'){ echo 'vendas_clarotv.endereco DESC'; } else { echo 'vendas_clarotv.endereco ASC'; }?>'">Endereço <? if($_GET['o'] == 'vendas_clarotv.endereco DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.endereco ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(cidade)')){?>
<td title="Cidade do Cliente" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.cidade DESC'){ echo 'vendas_clarotv.cidade DESC'; } else { echo 'vendas_clarotv.cidade ASC'; }?>'">Cidade <? if($_GET['o'] == 'vendas_clarotv.cidade DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.cidade ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(cep)')){?>
<td title="CEP" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.cep DESC'){ echo 'vendas_clarotv.cep DESC'; } else { echo 'vendas_clarotv.cep ASC'; }?>'">CEP <? if($_GET['o'] == 'vendas_clarotv.cep DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.cep ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(plano)')){?>
<td title="PLANO" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.plano DESC'){ echo 'vendas_clarotv.plano DESC'; } else { echo 'vendas_clarotv.plano ASC'; }?>'">Plano <? if($_GET['o'] == 'vendas_clarotv.plano DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.plano ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(vencimento)')){?>
<td title="Dia do Vencimento da Fatura" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'ABS(vendas_clarotv.vencimento) DESC'){ echo 'ABS(vendas_clarotv.vencimento) DESC'; } else { echo 'ABS(vendas_clarotv.vencimento) ASC'; }?>'">Vencimento <? if($_GET['o'] == 'ABS(vendas_clarotv.vencimento) DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'ABS(vendas_clarotv.vencimento) ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(valor)')){?>
<td title="Valor da Instalação" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'ABS(vendas_clarotv.valor) DESC'){ echo 'ABS(vendas_clarotv.valor) DESC'; } else { echo 'ABS(vendas_clarotv.valor) ASC'; }?>'">Valor <? if($_GET['o'] == 'ABS(vendas_clarotv.valor) DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'ABS(vendas_clarotv.valor) ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(data)')){?>
<td title="Data da Venda" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.data ASC' || $_GET['o'] == ''){ echo 'vendas_clarotv.data ASC'; } else { echo 'vendas_clarotv.data DESC'; }?>'">Data Venda <? if($_GET['o'] == 'vendas_clarotv.data DESC' || $_GET['o'] == ''){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.data ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(data_marcada)')){?>
<td title="Data Agendada para Instala&ccedil;&atilde;o" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'ABS(vendas_clarotv.data_marcada) DESC'){ echo 'ABS(vendas_clarotv.data_marcada) DESC'; } else { echo 'ABS(vendas_clarotv.data_marcada) ASC'; }?>'">Agendamento <? if($_GET['o'] == 'ABS(vendas_clarotv.data_marcada) DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'ABS(vendas_clarotv.data_marcada) ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(data_instalacao)')){?>
<td title="Data da Instala&ccedil;&atilde;o" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.data_instalacao DESC'){ echo 'vendas_clarotv.data_instalacao DESC'; } else { echo 'vendas_clarotv.data_instalacao ASC'; }?>'">Data Instalada <? if($_GET['o'] == 'vendas_clarotv.data_instalacao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.data_instalacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(tipo_instalacao)')){?>
<td title="Tipo de Instala&ccedil;&atilde;o" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.tipo_instalacao DESC'){ echo 'vendas_clarotv.tipo_instalacao DESC'; } else { echo 'vendas_clarotv.tipo_instalacao ASC'; }?>'">Tipo Instala&ccedil;&atilde;o <? if($_GET['o'] == 'vendas_clarotv.tipo_instalacao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.tipo_instalacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(pagamento)')){?>
<td title="Forma de Pagamento" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.pagamento DESC'){ echo 'vendas_clarotv.pagamento DESC'; } else { echo 'vendas_clarotv.pagamento ASC'; }?>'">Pagamento <? if($_GET['o'] == 'vendas_clarotv.pagamento DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.pagamento ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(tecnico)')){?>
<td title="Forma de Pagamento" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.tecnico_id DESC'){ echo 'vendas_clarotv.tecnico_id DESC'; } else { echo 'vendas_clarotv.tecnico_id ASC'; }?>'">Técnico <? if($_GET['o'] == 'vendas_clarotv.tecnico_id DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.tecnico_id ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(pontos)')){?>
<td title="Número de Pontos Adicionais" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.pontos DESC'){ echo 'vendas_clarotv.pontos DESC'; } else { echo 'vendas_clarotv.pontos ASC'; }?>'">Pontos Adi. <? if($_GET['o'] == 'vendas_clarotv.pontos DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.pontos ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(motivo_cancelamento)')){?>
<td title="Motivo Cancelamento" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.motivo_cancelamento DESC'){ echo 'vendas_clarotv.motivo_cancelamento DESC'; } else { echo 'vendas_clarotv.motivo_cancelamento ASC'; }?>'">Motivo Cancelamento <? if($_GET['o'] == 'vendas_clarotv.motivo_cancelamento DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.motivo_cancelamento ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(motivo_analise)')){?>
<td title="Motivo Análise" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.motivo_analise DESC'){ echo 'vendas_clarotv.motivo_analise DESC'; } else { echo 'vendas_clarotv.motivo_analise ASC'; }?>'">Motivo Análise <? if($_GET['o'] == 'vendas_clarotv.motivo_analise DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.motivo_analise ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>


<? if(strstr($USUARIO['colunas_clarotv'],'(tipo_venda)')){?>
<td onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.tipoVenda DESC'){ echo 'vendas_clarotv.tipoVenda DESC'; } else { echo 'vendas_clarotv.tipoVenda ASC'; }?>'">Tipo Venda <? if($_GET['o'] == 'vendas_clarotv.tipoVenda DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.tipoVenda ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(agendamento_gravacao)')){?>
<td title="Agendamento Gravação" onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.agendGravacao DESC'){ echo 'vendas_clarotv.agendGravacao DESC'; } else { echo 'vendas_clarotv.agendGravacao ASC'; }?>'">Agend. Gravação <? if($_GET['o'] == 'vendas_clarotv.agendGravacao DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.agendGravacao ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>


<? if(strstr($USUARIO['colunas_clarotv'],'(status)')){?>
<td onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.status DESC'){ echo 'vendas_clarotv.status DESC'; } else { echo 'vendas_clarotv.status ASC'; }?>'">Status <? if($_GET['o'] == 'vendas_clarotv.status DESC'){ ?><img src="img/seta-d.png" /> <? } else if($_GET['o'] == 'vendas_clarotv.status ASC'){ ?> <img src="img/seta-u.png" /> <? } ?></td>
<? } ?>

<td></td>

<td onclick="window.location = '?p=clarotv&m=<?= $_GET['m'];?>&t=<?= $_GET['t'];?>&f=<?= $_GET['f'];?>&s=<?= $_GET['s'];?>&v=<?= $_GET['v'];?>&i=<?= $_GET['i'];?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>&o=<? if($_GET['o'] != 'vendas_clarotv.gravacao DESC'){ echo 'vendas_clarotv.gravacao DESC'; } else { echo 'vendas_clarotv.gravacao ASC'; }?>'"></td>

<? if($USUARIO['editar_dados'] == 1 || $USUARIO['editar_instalacao'] == 1){?>
<td></td>
<? } ?>

<td id="printbt">
<img src="img/print-icon.png" title="Selecione as OS que deseja imprimir" style="opacity:0.4" />
</td>

<td>
<img src="print/img/claro.jpg" width="0" />
<img src="print/img/embratel.jpg" width="0" />
</td>

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

<? if(strstr($USUARIO['colunas_clarotv'],'(os)')){?>
<td title="N&uacute;mero da OS" <? if(strstr($_GET['o'],'os')){ ?> class="tdselected" <? } ?>><?= $VENDA['os'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(proposta)')){?>
<td title="N&uacute;mero da Proposta" <? if(strstr($_GET['o'],'proposta')){ ?>class="tdselected" <? } ?>><?= $VENDA['proposta'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(contrato)')){?>
<td title="N&uacute;mero do Contrato" <? if(strstr($_GET['o'],'contrato')){ ?>class="tdselected" <? } ?>><?= $VENDA['contrato'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(monitor)')){?>
<td title="Nome do Monitor" <? if(strstr($_GET['o'],'monitor')){ ?>class="tdselected" <? } ?>><?= $MONITOR['nome'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(operador)')){?>
<td title="Nome do Operador" <? if(strstr($_GET['o'],'operador')){ ?>class="tdselected" <? } ?>><?= $OPERADOR['nome'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(nome)')){?>
<td title="Nome do Cliente" <? if(strstr($_GET['o'],'nome')){ ?>class="tdselected" <? } ?>><?= ucwords(strtolower($VENDA['nome']));?></td>
<? } ?> 

<? if(strstr($USUARIO['colunas_clarotv'],'(cpf)')){?>
<td title="CPF/CNPJ do Cliente" <? if(strstr($_GET['o'],'cpf')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['cpf']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(telefone)')){?>
<td title="Telefone do Cliente" <? if(strstr($_GET['o'],'telefone')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['telefone']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(email)')){?>
<td title="Email do Cliente" <? if(strstr($_GET['o'],'email')){ ?>class="tdselected" <? } ?>><?= strtolower($VENDA['email']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(endereco)')){?>
<td title="Endereço do Cliente" <? if(strstr($_GET['o'],'endereco')){ ?>class="tdselected" <? } ?>><?= ucwords(strtolower($VENDA['endereco']));?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(cidade)')){?>
<td title="Cidade do Cliente" <? if(strstr($_GET['o'],'cidade')){ ?>class="tdselected" <? } ?>><?= ucwords(strtolower($VENDA['cidade']));?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(cep)')){?>
<td title="CEP" <? if(strstr($_GET['o'],'cep')){ ?>class="tdselected" <? } ?>><?= $VENDA['cep'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(plano)')){?>
<td title="Plano" <? if(strstr($_GET['o'],'plano')){ ?>class="tdselected" <? } ?>><?= $VENDA['plano'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(vencimento)')){?>
<td title="Dia de Vencimento das Faturas" <? if(strstr($_GET['o'],'vencimento')){ ?>class="tdselected" <? } ?>><?= $VENDA['vencimento'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(valor)')){?>
<td title="Valor" <? if(strstr($_GET['o'],'valor')){ ?>class="tdselected" <? } ?>>R$ <?= str_replace('.',',',$VENDA['valor']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(data)')){?>
<td title="Data da Venda" <? if(strstr($_GET['o'],'data ') || $_GET['o'] == ''){ ?>class="tdselected"  <? } ?>><?= substr($VENDA['data'],6,2)."/".substr($VENDA['data'],4,2)."/".substr($VENDA['data'],0,4);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(data_marcada)')){?>

<? 


if($VENDA['reagendamentos'] > 0){ 

$conDatasReagendamentos = $conexao->query("SELECT DATE_FORMAT(agendamento,'%d/%m/%Y') AS agendamento FROM reagendamentoinstalacao WHERE venda = '".$VENDA['id']."'");
$titleAgendamento = substr($VENDA['agendamento'],6,2)."/".substr($VENDA['agendamento'],4,2)."/".substr($VENDA['agendamento'],0,4);

while($DatasReagendamentos = mysql_fetch_array($conDatasReagendamentos)){ 

$titleAgendamento .= " :: ".$DatasReagendamentos['agendamento']; }

 } else {
	 
	 $titleAgendamento = "Data Agendada para Instala&ccedil;&atilde;o";
	 
	 }

?>
<td title="<?= $titleAgendamento; ?>" <? if($VENDA['status'] != 'CONECTADO' && $VENDA['status'] != 'RESTRIÇÃO' && $VENDA['status'] != 'CANCELADO' && $VENDA['data_marcada'] < date("Ymd")){ ?> style="color:#E00; font-weight:bold" <? } ?> <? if(strstr($_GET['o'],'data_marcada')){ ?>class="tdselected"<? } ?>>

<? if($VENDA['data_marcada']){ echo substr($VENDA['data_marcada'],6,2)."/".substr($VENDA['data_marcada'],4,2)."/".substr($VENDA['data_marcada'],0,4);}?>

<? if($VENDA['reagendamentos'] > 0){ ?> <img src="img/time_machine_shaped.png" align="absmiddle" width="16" /> <? } ?>

</td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(data_instalacao)')){?>
<td title="Data Agendada para Instala&ccedil;&atilde;o" <? if(strstr($_GET['o'],'data_instalacao')){ ?>class="tdselected" <? } ?>>
<?= substr($VENDA['data_instalacao'],6,2)."/".substr($VENDA['data_instalacao'],4,2)."/".substr($VENDA['data_instalacao'],0,4);?>
</td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(tipo_instalacao)')){?>
<td title="Tipo de Instala&ccedil;&atilde;o" <? if(strstr($_GET['o'],'tipo_instalacao')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['tipo_instalacao']);?></td>
<? } ?>


<? if(strstr($USUARIO['colunas_clarotv'],'(pagamento)')){?>
<td title="Forma de Pagamento" <? if(strstr($_GET['o'],'pagamento')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['pagamento']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(tecnico)')){?>
<td title="Nome do Técnico" <? if(strstr($_GET['o'],'tecnico')){ ?>class="tdselected" <? } ?>><? $conTEC = $conexao->query("SELECT * FROM tecnicos WHERE tecnico_id = '".$VENDA['tecnico_id']."'"); $TEC = mysql_fetch_array($conTEC); echo $TEC['nome'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(pontos)')){?>
<td title="Número de Pontos Adicionais" <? if(strstr($_GET['o'],'pontos')){ ?>class="tdselected" <? } ?>><?= $VENDA['pontos'];?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(motivo_cancelamento)')){?>
<td title="Motivo Cancelamento" <? if(strstr($_GET['o'],'motivo_cancelamento')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['motivo_cancelamento']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(motivo_analise)')){?>
<td title="Motivo Análise" <? if(strstr($_GET['o'],'motivo_analise')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['motivo_analise']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(tipo_venda)')){?>
<td title="Status" <? if(strstr($_GET['o'],'tipoVenda')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['tipoVenda']);?></td>
<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(agendamento_gravacao)')){?>

<td title="Agendamento Gravação" <? if(strstr($_GET['o'],'agendGravacao')){ ?>class="tdselected" <? } ?>>

<? if($VENDA['agendGravacao'] != '0000-00-00 00:00:00'){ echo strtoupper($VENDA['agendGravacao']); }?></td>

<? } ?>

<? if(strstr($USUARIO['colunas_clarotv'],'(status)')){?>
<td title="Status" <? if(strstr($_GET['o'],'status')){ ?>class="tdselected" <? } ?>><?= strtoupper($VENDA['status']);?></td>
<? } ?>


<td width="26px" style="cursor:default" title=" <?= str_replace('"',"'",$VENDA['obs_gravacao']);?> ">
<? if($VENDA['obs_gravacao']){?>
<img src="img/coment.png" width="16" height="16" />
<? } ?>
</td>



<td width="26px" style="cursor:pointer">
<? if($USUARIO['inserir_gravacao'] == 1 && $VENDA['gravacao'] == '' && $VENDA['status'] == 'GRAVAR'){?>
<img src="img/icone-gravar.png" title="Inserir Gravação" width="13" height="13" onclick="Popup=window.open('http://172.16.0.30/vento-adm/upload-gravacao.php?p=<?= $VENDA['proposta']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=470,height=350,left=430,top=100');" />
<? } ?>

<? if($VENDA['gravacao'] != ''){?>

<img src="img/icone-ouvir.png" title="Ouvir Gravação" width="13" height="13" onclick="javascript:window.open('http://172.16.0.30/audio/clarotv/orig/<?= $VENDA['gravacao'];?>','_blank')" />

<? } ?>
</td>


<? if($USUARIO['editar_dados'] == 1 || $USUARIO['editar_instalacao'] == 1){?>
<td width="26px" title="Editar Dados" style="cursor:pointer"><img src="img/icone-editar.png" width="13" height="13" onclick="Popup=window.open('detalhes-venda-clarotv.php?e=1&id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>
<? } ?>

<td><input type="checkbox" name="id[]" onchange="check();" value="<?= $VENDA['id'];?>" /></td>

<td width="26px" title="Mais Detalhes" style="cursor:pointer"><img src="img/icone-mais.png" width="13" height="13" onclick="Popup=window.open('detalhes-venda-clarotv.php?id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>

</tr>



<? } ?>

</table>
</form>
<hr size="1" color="#CCC" width="1000px" />


<table border="0" width="1000px">
<tr valign="middle" height="20px">
<td></td>
<?php if($pg != '1'){ ?>
<td width="70px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="cursor:pointer; font-size:13px" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg - 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>')">

&laquo; Anterior</td><? } else{ ?>

<td width="70px" align="center" bgcolor="#fbfbfb" style="cursor:default; font-size:13px; color:#cdcdcd">&laquo; Anterior</td> 

<? } ?>

<? 

$numpaginas = ceil($quantreg / $numreg);

$i = 1; while($i <= $numpaginas && $i<=45){
 $numpag = $i++;	

if($numpag == $pg){ ?>
	
<td width="15px" align="center" bgcolor="#0096ff" style="cursor:pointer; color:#FFF; font-size:13px; font-weight:bold" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>	
    
	<? }else{ ?>
 
<td width="15px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="font-size:13px; cursor:pointer" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo $numpag; ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>')"><? echo $numpag; ?></td>


<? }} ?>

<?php if(($inicial + $numreg) < $quantreg ){ ?>
<td width="70px" align="center" bgcolor="#ededed" onMouseOver="this.style.background = '#f6f6f6'" onMouseOut="this.style.background = '#ededed'" style="cursor:pointer; font-size:13px" onClick="window.location = ('?p=<?= $_GET['p']; ?>&m=<?= $_GET['m'];?>&o=<?= $_GET['o']; ?>&t=<?= $_GET['t']; ?>&f=<?= $_GET['f']; ?>&s=<?= $_GET['s']; ?>&v=<?= $_GET['v']; ?>&i=<?= $_GET['i']; ?>&b=<?= $_GET['b'];?>&tpv=<?= $_GET['tpv']; ?>&pg=<?php echo ($pg + 1); ?>&di=<?= $_GET['di']; ?>&me=<?= $_GET['me']; ?>&an=<?= $_GET['an']; ?>&ve=<?= $_GET['ve']; ?>&ate=<?= $_GET['ate']; ?>&g=<?= $_GET['g']; ?>')">
Próximo &raquo;</td><? } else {?>

<td width="70px" align="center" bgcolor="#fbfbfb" style="cursor:default; font-size:13px; color:#cdcdcd">Próximo &raquo;</td> 

<? } ?>
<td width="10px"></td>
</tr>

</table>

</center>
<br />
<br />
