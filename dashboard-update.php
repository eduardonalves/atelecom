<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php 
session_start();

include("conexao.php");

if ($_POST['update'] == "order"){

$array	= $_POST['listOrder'];

$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);

			$conDASH = $conexao->query("SELECT * FROM sys_dashboard_user WHERE usuario = '".$USUARIO['id']."'");
			$DASH = mysql_fetch_assoc($resDASH);
				
	
			
	$x = 1;
	foreach ($array as $key => $value) {
	$update = $conexao->query("UPDATE sys_dashboard_user SET ordem = " . $x . " WHERE usuario = '".$USUARIO['id']."' && dashboard = " . $value);
	$x ++;
	}
	

	
	echo 'Modifica&ccedil;&otilde;es Salvas com Sucesso!';


}
?>