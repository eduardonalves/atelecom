<?php


$conexao30 = mysql_connect("localhost","root","v3nt0adm") or die("erro");
$db30 = mysql_select_db("vento") or die ("erro");

$con30 = "SELECT * FROM usuarios";
$res30 = mysql_query($con30,$conexao30)or die ("line erro");

	
$i=0;

while($lin30 = mysql_fetch_array($res30)){
 
$id= addslashes($lin30['id']);
 

if($id > 0){ 
 
$login= addslashes($lin30['login']);
$senha= addslashes($lin30['senha']);
$nome= addslashes($lin30['nome']);
$email= addslashes($lin30['email']);
$telefone= addslashes($lin30['telefone']);
$tipo_usuario= addslashes($lin30['tipo_usuario']);
$grupo= addslashes($lin30['grupo']);
$status = addslashes($lin30['status']);
$foto = addslashes($lin30['foto']);
$sexo = addslashes($lin30['sexo']);

$conexao31 = mysql_connect("172.16.0.31","admin","v3nt0adm") or die ('<h1>ERRO</h1>');
$db31 = mysql_select_db("vento_zend");

$select31 = mysql_query ("SELECT * FROM `usuarios` WHERE idOld = '".addslashes ($id)."' && nome = '".addslashes($nome)."'",$conexao31) or die (" select");
$query = mysql_fetch_array($select31);



$tipoUsuario= array("ADMINISTRADOR"=>1,"MONITOR"=>3,"CONTROLADOR"=>4,"COMERCIAL"=>10,"LOGISTICA"=>5,"FINANCEIRO"=>6,"AUDITOR"=>8,"ESTOQUISTA"=>9);
$setStatus = array("ATIVO"=>1 , "DESLIGADO"=>0);
//echo $query['operadores_id'];


if($query <= 0){
	
$funcionario = $query['id'];

$insertTV = mysql_query("INSERT INTO usuarios VALUES (null,'".$nome."','".$email."','".$sexo."','".$login."','".hash('whirlpool',trim(stripslashes($senha)))."','".$foto."','".$tipoUsuario[trim(stripslashes($tipo_usuario))]."','".$grupo."','".$setStatus[trim(stripslashes($status))]."','-','-','-','pt-br','-','-','".$id."' )")or die("erro insert");
$i++;


}
}
}
echo"foi inserido".$i;



?>
