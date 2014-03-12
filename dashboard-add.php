<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?

include "conexao.php";

extract($_POST);
	
	
if($id > 0){	

$conNumDash = $conexao->query("SELECT * FROM sys_dashboard_user WHERE usuario = '".$user."'");
$NumDash = mysql_num_rows($conNumDash);

$ordem = ceil($NumDash + 1);

$add = $conexao->query("INSERT INTO sys_dashboard_user (dashboard,ordem,usuario) VALUES ('".$id."','".$ordem."','".$user."')") or die("Ocorreu um erro ao modificar suas configurações");




}
?>
