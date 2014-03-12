<? include "../conexao.php";

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

$operador = $_GET['id'];

$produto_id = $_GET['pro'];

?>

<style type="text/css">

body{ font-family:Arial, Helvetica, sans-serif;}

.infoconteudo{position:absolute; overflow-y:scroll; width:768px; left:50%; margin:0 0 0 -375px; max-height:410px;}

</style>

<link rel="stylesheet" href="../css/geral.css" type="text/css" />
<link rel="stylesheet" href="../css/tables.css" type="text/css" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<!-- INFO OPERADORES -->


<div class="infotop">
<br />

<? 
$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$operador."'");

$OPERADORES = mysql_fetch_array($conOPERADORES);

$conINFOOPERADOR = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador."' && (data LIKE '%".$ano.$mes."%' || data_instalacao LIKE '%".$ano.$mes."%')  ORDER BY status ASC");

$conINFOOPERADOR2 = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador."' && data LIKE '%".$ano.$mes."%'  ORDER BY status ASC");

$conINFOOPERADORCONEC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador."' && data_instalacao LIKE '%".$ano.$mes."%' && status = 'CONECTADO'");

$conINFOOPERADORREST = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador."' && data LIKE '%".$ano.$mes."%' && status = 'RESTRIÇÃO'");

$conINFOOPERADORCANC = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador."' && data LIKE '%".$ano.$mes."%' && status = 'CANCELADO'");
$conINFOOPERADORCONECTADO = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '".$produto_id."' && operador = '".$operador."' && data LIKE '%".$ano.$mes."%' && status = 'DEVOLVIDO'");
$numINFOOPERADOR = mysql_num_rows($conINFOOPERADOR2);
$numINFOOPERADORCONEC = mysql_num_rows($conINFOOPERADORCONEC);
$numINFOOPERADORCANC = mysql_num_rows($conINFOOPERADORCANC);
$numINFOOPERADORREST = mysql_num_rows($conINFOOPERADORREST);$numINFOOPERADORCONECTADO = mysql_num_rows($conINFOOPERADORCONECTADO);

?>

<center>
<span style="font-size:14px; color:#999;"><b><?= $m.' '.$ano; ?></b><br />
<span style="color:#CCC; font-size:26px; font-weight:bold"><?= $OPERADORES['nome'];?></span>
<br />
<span style="font-size:12px"><? if($numINFOOPERADOR == 0){ echo '(Nenhuma Venda)';} else { 
echo '<b style="font-size:14px;">VENDAS: '.$numINFOOPERADOR.'</b> &nbsp; &nbsp; <b>Conectadas:</b> '.$numINFOOPERADORCONEC.' &nbsp; <b>Devolvidas:</b> '.$numINFOOPERADORCONECTADO.'. &nbsp; <b>Restrições:</b> '.$numINFOOPERADORREST.' &nbsp; <b>Canceladas:</b> '.$numINFOOPERADORCANC; } ?></span></span>

<table border="0" width="750px" cellpadding="0" cellspacing="0" id="tablelistaop<?= $OPERADORES['operador_id'];?>">

<tr align="right" valign="top" height="26px">
<td colspan="100">
<img src="img/icone-ver-grafico.png" style="cursor:pointer" onclick="carregargrafico(<?= $OPERADORES['operador_id'];?>)" />
</td>
</tr>


<tr class="tr1" align="center">
<td width="100px">Monitor</td>
<td>Cliente</td>
<td width="200px">Status</td>
<td width="100px">Data Venda</td>
<td width="100px">Data Finalizada</td>
<td width="26px"></td>
</tr>
</table>

<table border="0" width="750px" cellpadding="0" cellspacing="0" style="display:none" id="tablegraficoop<?= $OPERADORES['operador_id'];?>">

<tr align="right" valign="top" height="26px">
<td colspan="100">
<img src="img/icone-ver-lista.png" style="cursor:pointer" onclick="carregarlista(<?= $OPERADORES['operador_id'];?>)" />
</td>
</tr>


<tr class="tr1" align="center">
<td></td>
</tr>
</table>

<div id="graficoop<?= $OPERADORES['operador_id'];?>">
</div>


<div id="infoconteudoop<?= $OPERADORES['operador_id'];?>" class="infoconteudo">
<table border="0" width="750px" cellpadding="0" cellspacing="0">

<?

$class2 = "tr2";
while($INFOOPERADOR = mysql_fetch_array($conINFOOPERADOR)){
	
if ($class2=="tr2"){ //alterna a cor
  $class2 = "tr3";
} else {
  $class2="tr2";
}

$conINFOMONITOR = $conexao->query("SELECT nome FROM usuarios WHERE id = '".$INFOOPERADOR['monitor']."'");
$INFOMONITOR = mysql_fetch_assoc($conINFOMONITOR);
?>

<tr class="<?= $class2; ?>" align="center">
<td width="100px"><?= $INFOMONITOR['nome'];?></td>
<td><?= strtoupper($INFOOPERADOR['nome']);?></td>
<td width="200px"><?= strtoupper($INFOOPERADOR['status']);?></td>
<td width="100px"><?= substr($INFOOPERADOR['data'],6,2)."/".substr($INFOOPERADOR['data'],4,2)."/".substr($INFOOPERADOR['data'],0,4);?></td>
<td width="100px"><?= substr($INFOOPERADOR['data_instalacao'],6,2)."/".substr($INFOOPERADOR['data_instalacao'],4,2)."/".substr($INFOOPERADOR['data_instalacao'],0,4);?></td>
<td width="26px" title="Mais Detalhes" style="cursor:pointer"><img src="img/icone-mais.png" width="13" height="13" onclick="Popup=window.open('detalhes-venda-clarofixo.php?id=<?= $INFOOPERADOR['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>
</tr>

<? } ?>

</table>
</div>

</center>
</div>

</div>
<!-- FIM INFO OPERADORES -->
