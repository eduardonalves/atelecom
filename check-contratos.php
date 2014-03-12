<?

include "conexao.php";

$conCONTRATOS = $conexao->query("SELECT * FROM vendas_clarotv WHERE contrato = '".$_GET['c']."'");
$CONTRATOS = mysql_fetch_array($conCONTRATOS);

if($_GET['c'] != $_GET['o'] && $_GET['c'] != ''){
if(!$CONTRATOS){ echo '<b style="color:#00d505"></b>';} else {echo '<br><b style="color:#DD0000">CONTRATO EXISTENTE</b>';}
}
?>

