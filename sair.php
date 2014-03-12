<?

session_start();

include "conexao.php";
include_once "lib/class.Logon.php";



$genLogon = new Logon($conexao);
$genLogon->efetuarLogoff($_SESSION['lgnid']);



$data = date("Y-m-d H:i:s");

//LOG ENTRADA

$insert_entrada = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$_SESSION['usuario']."','Saiu do sistema.')");

session_start();
session_destroy();


?>


<script type="text/javascript">
window.location = 'index'
</script>	
