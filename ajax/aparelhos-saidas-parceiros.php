<?php

include "../conexao.php"; 

$getParceiros = $conexao->query("Select DISTINCT id_parceiro, usuarios.nome, usuarios.login from saidas 
								
								INNER JOIN usuarios ON (usuarios.id=saidas.id_parceiro) ORDER BY usuarios.nome ASC"
								
								
								);
								
$arrParceiros = array();
$arrParceirosL = array();

while ($parceiro = mysql_fetch_array($getParceiros))
{

	array_push($arrParceiros, $parceiro["nome"]);
	array_push($arrParceirosL, $parceiro["login"]);
	
	
	//echo "<option value=\"" . $parceiro["nome"] . "\""; if($_GET["parc"]==$parceiro["nome"]){ echo " selected=\"selected\""; } echo ">". $parceiro["nome"] ."</option>";
}

	asort($arrParceiros);
	asort($arrParceirosL);
	
echo json_encode(array_merge($arrParceiros, $arrParceirosL));

?>
