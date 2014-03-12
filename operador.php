<?php


$conexao30 = mysql_connect("localhost","root","v3nt0adm") or die("erro");
$db30 = mysql_select_db("vento") or die ("erro");

$con30 = "SELECT * FROM operadores";
$res30 = mysql_query($con30,$conexao30)or die ("line erro");

	
$i=0;

while($lin30 = mysql_fetch_array($res30)){

$operador_id= addslashes($lin30['operador_id']);

if($operador_id > 0){ 
 
$operador_id= addslashes($lin30['operador_id']);
$login= addslashes($lin30['login']);
$senha= hash('whirlpool',$lin30['senha']);
$nome= addslashes($lin30['nome']);
$cpf= addslashes($lin30['cpf']);
$telefone= addslashes($lin30['telefone']);
$data_admissao= addslashes($lin30['data_admissao']);
$data_desligamento= addslashes($lin30['data_desligamento']);
$grupo= addslashes($lin30['grupo']);
$status = addslashes($lin30['status']);
$sexo = addslashes($lin30['sexo']);

$conexao31 = mysql_connect("172.16.0.31","admin","v3nt0adm") or die ('<h1>ERRO</h1>');
$db31 = mysql_select_db("vento_zend");

$select31 = mysql_query ("SELECT * FROM `usuarios` WHERE idOld = '".addslashes ($operador_id)."' && nome = '".addslashes($nome)."'",$conexao31) or die (" select");
$query = mysql_fetch_array($select31);

//echo $query['operadores_id'];

if($status=="ATIVO"){
$status='1';
}
else{
$status='0';}

if($query <= 0){
	
$funcionario = $query['operador_id'];

$insertTV = mysql_query("INSERT INTO usuarios VALUES (null,'".$nome."','-','-','".$login."','".$senha."','-','2','".$grupo."','".$status."','-','".$telefone."','".$cpf."','-','".$data_admissao."','".$data_desligamento."','".$operador_id."')",$conexao31)or die("erro insert");
$i++;


}
}
}
echo"foi inserido".$i;



?>
