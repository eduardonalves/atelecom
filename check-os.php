<?

include "conexao.php";

$conOS = $conexao->query("SELECT * FROM vendas_clarotv WHERE os = '".$_GET['os']."'");
$OS = mysql_fetch_array($conOS);

if($_GET['os']){
if(!$OS){ echo '<b style="color:#00d505"></b>';} else {echo '<br><b style="color:#DD0000">OS EXISTENTE</b>';}
}
?>

