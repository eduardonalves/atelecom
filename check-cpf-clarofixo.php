<?

include "conexao.php";

$conCPF = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '3' && cpf = '".$_GET['c']."' ");
$CPF = mysql_fetch_array($conCPF);

if($_GET['c'] != $_GET['o'] && $_GET['c'] != ''){
if(!$CPF){ echo '<b style="color:#00d505"></b>';} else {echo '<b style="color:#DD0000;font-size:12px;">CPF EXISTENTE!</b>';}
}
?>

