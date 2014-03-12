<?php
$conexao30 = mysql_connect("localhost","root","v3nt0adm") or die("erro");
$db30 = mysql_select_db("vento");
$con30 = "SELECT * FROM operadores";
$res30 = mysql_query($con30,$conexao30)or die ("line erro");	
$i=0;

while($lin30 = mysql_fetch_array($res30)){
$operador_id= addslashes($lin30['operador_id']);
$login= addslashes($lin30['login']);
$senha= addslashes($lin30['senha']);
$nome= addslashes($lin30['nome']);
$cpf= addslashes($lin30['cpf']);
$telefone= addslashes($lin30['telefone']);
$data_admissao= addslashes($lin30['data_admissao']);
$data_desligamento= addslashes($lin30['data_desligamento']);
$grupo= addslashes($lin30['grupo']);
$status = addslashes($lin30['status']);

//echo $query['operadores_id'];z
$setStatus = array("ATIVO"=>1 , "DESLIGADO"=>0);


$conexao31 = mysql_connect("172.16.0.31","admin","v3nt0adm") or die ('<h1>ERRO</h1>');
$db31 = mysql_select_db("vento_zend");

$conOP = mysql_query("SELECT * FROM usuarios WHERE idOld = '".$operador_id."'");
$query = mysql_fetch_array($conOP);

if($query <= 0){
	
$funcionario = $query['operador_id'];
$insertTV = mysql_query("INSERT INTO usuarios VALUES (null,'".$nome."','".$email."','".$sexo."','".$login."','".hash('whirlpool',trim(stripslashes($senha)))."','".$foto."',2,'".$grupo."','".$setStatus[trim(stripslashes($status))]."','-','-','-','-','-','-','".$operador_id."')",$conexao31) or die("ola");
$i++;

}
}
echo "Operadores Inseridos: ".$i."<hr />";

?>
