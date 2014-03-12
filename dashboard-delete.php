<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?
include "conexao.php";

extract($_POST);
	
	
if($id > 0){	

$delete = $conexao->query("DELETE FROM sys_dashboard_user WHERE id = '".$id."' LIMIT 1") or die("Ocorreu um erro ao modificar suas configurações");


echo 'Modificações Salvas com Sucesso';



}
?>
