<?php

$conexao30 = mysql_connect("localhost","root","v3nt0adm") or die("erro");
$db30 = mysql_select_db("vento") or die ("erro");
$con30 = "SELECT * FROM tecnicos";
$res30 = mysql_query($con30,$conexao30)or die ("erro 30");
$i=0;

while($lin30 = mysql_fetch_array($res30)){

$id= addslashes($lin30['tecnico_id']);
 
if($id > 0){ 
$nome= addslashes($lin30['nome']);
$conexao31 = mysql_connect("172.16.0.31","admin","v3nt0adm") or die ('<h1>ERRO</h1>');
$db31 = mysql_select_db("vento_zend");
$select31 = mysql_query ("SELECT * FROM `tecnicos` WHERE id = '".addslashes ($id)."' && nome = '".addslashes($nome)."'",$conexao31) or die (" select");
$query = mysql_fetch_array($select31);

//echo $query['tecnico_id'];


if($query <= 0){
	
$funcionario = $query['id'];

$insertTV = mysql_query("INSERT INTO tecnicos VALUES ('".$id."','-','".$nome."','1')",$conexao31) or die('erro insert');
$i++;


}
}
}
echo"foi inserido".$i;



?>
