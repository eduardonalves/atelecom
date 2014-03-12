<html>
<body style="font-family:Arial;">

<?php 

$conexao30 = mysql_connect("localhost","root","v3nt0adm") or die("erro");


$db30 = mysql_select_db("vento");

$con30 = "SELECT * FROM vendas_clarotv";
$res30 = mysql_query($con30,$conexao30)or die ("line erro1");

$i = 0;

while($lin30 = mysql_fetch_array($res30)){

$tipoPessoa = addslashes($lin30['pessoa']);
$cpf = addslashes($lin30['cpf']);
$nome = addslashes($lin30['nome']);
$nomeMae = addslashes($lin30['nome_mae']);
$nascimento = addslashes($lin30['nascimento']);
$rg = addslashes($lin30['rg']);
$rgOrgExp = addslashes($lin30['org_exp']);
$rgDataExp = addslashes($lin30['data_exp']);			  
$profissao = addslashes($lin30['profissao']);
$sexo = addslashes($lin30['sexo']);
$estadoCivil = addslashes($lin30['estado_civil']);
$email = addslashes($lin30['email']);
$telefone = addslashes($lin30['telefone']);
$telComercial = addslashes($lin30['telefone2']);
$telCelular = addslashes($lin30['telefone3']);
//$telAdicional = $lin30['telAdic'];
//(tipoPessoa,nome,nomeMae,nascimento,cpf,rg,rgOrgExp,rgDataExp,profissao,sexo,estadoCivil,email,telefone,telComercial,telComercial,telComercial);

$conexao31 = mysql_connect("172.16.0.31","admin","v3nt0adm") or die ('<h1>ERRO</h1>');

$db31 = mysql_select_db("vento_zend") or die ("line erro2");
	
$select31 = mysql_query ("SELECT * FROM clientes WHERE cpf = '".$cpf."' && nome = '".$nome."'",$conexao31) or die ("line erro3");
$query = mysql_fetch_array($select31);


if($query == 0){

$insertcli = mysql_query("INSERT INTO clientes VALUES (NULL,'".$tipoPessoa."','".$nome."','".$nomeMae."','".$nascimento."','".$cpf."','".$rg."','".$rgOrgExp."','".$rgDataExp."','".$profissao."','".$sexo."','".$estadoCivil."','".$email."','".$telefone."','".$telComercial."','".$telCelular."','000','-','-')",$conexao31)or die (mysql_error());

       $i++;

}


}

echo "Dados inseridos:".$i;

?>

</body>
</html>