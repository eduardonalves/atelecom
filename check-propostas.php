<?

include "conexao.php";

$conPROPOSTAS = $conexao->query("SELECT * FROM vendas_clarotv WHERE proposta = '".$_GET['p']."'");
$PROPOSTAS = mysql_fetch_array($resPROPOSTAS);

if($_GET['p'] != '' && $_GET['p'] != $_GET['o']){
if(!$PROPOSTAS){ if($_GET['o'] == ''){echo '<b style="color:#00d505">OK</b><br>';}} else {echo '<b style="color:#DD0000">PROPOSTA EXISTENTE</b><br>';}
}
?>

