<?
if($USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){



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


$ultimoDia = date("d",mktime(0, 0, 0, ($mes + 1), 0, $ano)); 
$primeiroDia = date("w", mktime(0,0,0,$mes,01,$ano));

$anteUltimoDia = date("d",mktime(0, 0, 0, ($mes), 0, $ano)); 

$dias = $_POST['dia'];
$dias_nt = "";
foreach ($dias as $d){
	
	$dias_nt .= $d.' | ';
	
	}
	

//// Números de dias não trabalhados

$dnt = explode(' | ',$dias_nt);

$menos = "0";
foreach($dnt as $dd){
	
	if($dd >= 01){
	$menos++;
	}
	}


$dias_uteis = ceil($ultimoDia - $menos);

	
/////////////////////////////////////////

$produto = $_GET['pro'];

$conMetas = $conexao->query("SELECT * FROM metas WHERE produto = '".$produto."' && periodo = '".$ano.$mes."'");
$rowMetas = mysql_fetch_array($conMetas);
	
if($rowMetas > 0){ $metaExiste = 1;}

$meta = $_POST['meta'];
$meta_int = $_POST['metaInt'];
$meta_sup = $_POST['metaSup'];
$meta_emp = $_POST['metaEmp'];


if(isset($_POST['salvar'])){

if($metaExiste != '1'){
	
$insert = $conexao->query("INSERT INTO metas VALUES (NULL,'".date("Y-m-d H:i:s")."','".$produto."','".$ano.$mes."','".$meta."','".$meta_int."','".$meta_sup."','".$meta_emp."','".$dias_uteis."','".$dias_nt."')");	
	
	
} else{
	
$update = $conexao->query("UPDATE metas SET data='".date("Y-m-d H:i:s")."', produto='".$produto."', periodo='".$ano.$mes."', meta='".$meta."', meta_int='".$meta_int."', meta_sup='".$meta_sup."', meta_emp='".$meta_emp."', dias_uteis='".$dias_uteis."', dias_nt='".$dias_nt."' WHERE produto='".$produto."' && periodo='".$ano.$mes."'");	
	
	
	}

?>
<script type="text/javascript">

alert('Metas salvas com sucesso!');
window.location = '?p=<?= $_GET['p'];?>&pro=<?= $produto;?>&m=<?= $mes;?>&an=<?= $ano;?>';

</script>



<?
}


/////////////////////////////////////////


?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">


/* ------ CALENDÁRIO ----- */
#calendariodnt{ position:absolute; width:420px;  padding:5px; border:1px solid #CCC;

background: #f9f9f9; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y5ZjlmOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjE0JSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjE2JSIgc3RvcC1jb2xvcj0iI2Y2ZjZmNiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjczJSIgc3RvcC1jb2xvcj0iI2VkZWRlZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlMGUwZTAiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #f9f9f9 0%, #ffffff 14%, #f6f6f6 16%, #ededed 73%, #e0e0e0 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f9f9f9), color-stop(14%,#ffffff), color-stop(16%,#f6f6f6), color-stop(73%,#ededed), color-stop(100%,#e0e0e0)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #f9f9f9 0%,#ffffff 14%,#f6f6f6 16%,#ededed 73%,#e0e0e0 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #f9f9f9 0%,#ffffff 14%,#f6f6f6 16%,#ededed 73%,#e0e0e0 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #f9f9f9 0%,#ffffff 14%,#f6f6f6 16%,#ededed 73%,#e0e0e0 100%); /* IE10+ */
background: linear-gradient(to bottom,  #f9f9f9 0%,#ffffff 14%,#f6f6f6 16%,#ededed 73%,#e0e0e0 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9f9f9', endColorstr='#e0e0e0',GradientType=0 ); /* IE6-8 */


 -moz-user-select: none; 
 -khtml-user-select: none; 
 -webkit-user-select: none; 
 -o-user-select: none; 
 
 -webkit-border-radius: 4px;
border-radius: 4px;

-webkit-box-shadow:  1px 1px 4px 2px #EDEDED;
        
        box-shadow:  1px 1px 4px 2px #EDEDED;
}

.semana{ position:relative; width:50px; background:#008CBF; color:#FFF; font-weight:bold; padding-top:4px; padding-bottom:4px; float:left; margin:5px; font-size:14px; cursor:default; text-align:center; }

.dia{ position:relative; width:50px; padding-top:4px; padding-bottom:4px; background:#00C3F9; float:left; margin:5px; cursor:pointer; text-align:center; }

.dia:hover{ background:#01DBFF;}

.diam{ position:relative; width:50px; padding-top:4px; padding-bottom:4px; background:#0F3677; color:#FFF; float:left; margin:5px; cursor:pointer; text-align:center; }

.diam:hover{ background:#0F3699;}


.dianull{ position:relative; width:50px; padding-top:4px; padding-bottom:4px; background:#ededed; color:#CCC; float:left; margin:5px; cursor:default; text-align:center; }
/* ---------------------------------- */


input[type="submit"]{ padding:7px; border:1px solid #CCC; color:#777;
 background: #ededed; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSI4JSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUzJSIgc3RvcC1jb2xvcj0iI2ZjZmNmYyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlZGVkZWQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #ffffff 8%, #fcfcfc 53%, #ededed 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(8%,#ffffff), color-stop(53%,#fcfcfc), color-stop(100%,#ededed)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 ); /* IE6-8 */
}

input[type="submit"]:hover{ border:1px solid #AAA; color:#434343; cursor:pointer;}

input[type="submit"]:active{ background:#ededed;}



</style>


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
    	
	

///////////////////////////////////////////
///////////////////////////////////////////




function checkdia(d){
	
 $('#ck'+d).attr("checked",true);
 $('#d'+d).hide();
 $('#dm'+d).show();
	
	}
	
function uncheckdia(d){
	
 $('#ck'+d).attr("checked",false);
 $('#d'+d).show();
 $('#dm'+d).hide();
	
	}	

</script>



<center>

<table border="0" width="90%" height="500px">
<tr valign="top">
<td>

<table border="0" width="1000px">

<tr valign="bottom" height="40px" align="left">
<td style="font-size:14px; color:#999;" colspan="2">DEFINIR METAS PARA O MÊS DE <b><?= strtoupper($m).' DE '.$ano;?></b></td>

</tr>

<tr>
<td colspan="2"><hr size="1" color="#CCCCCC" /></td>
</tr>


<tr style="font-size:13px" height="40px" valign="middle" align="left" bgcolor="#f6f6f6">
<td  align="center" width="100px">Produto:</td>
<td>
<form name="selectproduto" action="" method="get">
<input type="hidden" name="p" value="<?= $_GET['p'];?>" />
<input type="hidden" name="es" value="<?= $_GET['es'];?>" />

<select name="pro" onchange="javascript:document.forms.selectproduto.submit();">
<option value=""></option>
<option value="1" <? if($produto == '1'){?> selected="selected" <? } ?>>Claro TV</option>
<option value="2" <? if($produto == '2'){?> selected="selected" <? } ?>>Claro 3G</option>
<option value="3" <? if($produto == '3'){?> selected="selected" <? } ?>>Claro Fixo</option>
<option value="4" <? if($produto == '4'){?> selected="selected" <? } ?>>Oi TV</option>
<option value="5" <? if($produto == '5'){?> selected="selected" <? } ?>>Oi Fixo</option>
<option value="6" <? if($produto == '6'){?> selected="selected" <? } ?>>Oi Velox</option>

</select>
</form>
</td>
</tr>

</table>

<table border="0" width="1000px">
<form name="filtro" method="get">
<input type="hidden" name="p" value="<?= $_GET['p'];?>" />
<input type="hidden" name="es" value="<?= $_GET['es'];?>" />

<tr style="font-size:13px" height="40px" valign="middle" align="left" bgcolor="#f6f6f6">
<td>
&nbsp; &nbsp; &nbsp;

Mês: 
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
<input type="hidden" name="pro" value="<?= $_GET['pro'];?>" />

&nbsp;
<img src="img/bt_ok.png" style="position:absolute; margin-top:3px; cursor:pointer" onclick="javascript:document.forms.filtro.submit();" />
</td>
</tr>
</form>

<tr>
<td colspan="2"><hr size="1" color="#CCCCCC" /></td>
</tr>
</table>


<form name="meta" method="post" action="">
<table border="0" width="470px" <? if($produto == ''){?> style="display:none" <? } ?>>




<tr>
<td width="150px">Meta:</td>
<td><input type="text"  name="meta" value="<?= $rowMetas['meta'];?>" onkeyup="mascara(this,soNumeros)" onchange="mascara(this,soNumeros)" maxlength="5" size="7" /></td>
</tr>

<tr>
<td width="150px">Meta Interm.:</td>
<td><input type="text" name="metaInt" value="<?= $rowMetas['meta_int'];?>" onkeyup="mascara(this,soNumeros)" onchange="mascara(this,soNumeros)" maxlength="5"  size="7" /></td>
</tr>

<tr>
<td width="150px">Super Meta:</td>
<td><input type="text" name="metaSup" value="<?= $rowMetas['meta_sup'];?>" onkeyup="mascara(this,soNumeros)" onchange="mascara(this,soNumeros)" maxlength="5"  size="7" /></td>
</tr>

<tr>
<td width="150px">Meta Empresa:</td>
<td><input type="text" name="metaEmp" value="<?= $rowMetas['meta_emp'];?>" onkeyup="mascara(this,soNumeros)" onchange="mascara(this,soNumeros)" maxlength="5"  size="7" /></td>
</tr>


<tr height="30px">
<td colspan="2"></td>
</tr>

<tr height="340px" valign="top">
<td colspan="2">
<b>Selecione os dias em que não haverá expediente:</b><br />
<br />

<div id="calendariodnt">

<div class="semana">
Dom
</div>
<div class="semana">
Seg
</div>
<div class="semana">
Ter
</div>
<div class="semana">
Qua
</div>
<div class="semana">
Qui
</div>
<div class="semana">
Sex
</div>
<div class="semana">
S&aacute;b
</div>

<? for($i=1;$i<=$primeiroDia;$i++){ ?>
<div class="dianull"><?= $anteUltimoDia-$primeiroDia+$i;?></div>
<? } ?>


<? for($i=1;$i<=$ultimoDia;$i++){ ?>

<div id="d<?= sprintf("%02d",$i);?>" class="dia" <? if(strstr($rowMetas['dias_nt'],sprintf("%02d",$i))){?> style="display:none" <? } ?> onclick="checkdia('<?= sprintf("%02d",$i);?>')"><?= sprintf("%02d",$i);?></div>
<div id="dm<?= sprintf("%02d",$i);?>" class="diam" <? if(!strstr($rowMetas['dias_nt'],sprintf("%02d",$i))){?> style="display:none" <? } ?> onclick="uncheckdia('<?= sprintf("%02d",$i);?>')"><?= sprintf("%02d",$i);?></div>

<? } ?>

</div>
</td>
</tr>

<tr><td>
<? for($i=1;$i<=$ultimoDia;$i++){ ?>

<input type="checkbox" id="ck<?= sprintf("%02d",$i);?>" name="dia[]"  <? if(strstr($rowMetas['dias_nt'],sprintf("%02d",$i))){?> checked="checked" <? } ?> value="<?= sprintf("%02d",$i);?>" style="display:none" />

<? } ?>
</td></tr>

<tr align="left">
<td colspan="2">
<input type="submit" name="salvar" value="Salvar" />
</tr>

</table>

<input type="hidden" name="p" value="<?= $_GET['p'];?>" />
<input type="hidden" name="pro" value="<?= $_GET['pro'];?>" />
<input type="hidden" name="es" value="<?= $_GET['es'];?>" />


</form>

</td></tr></table>

</center>

<br />
<br />


<? } ?>