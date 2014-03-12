<?php

include "../conexao.php"; 

$getNotas = $conexao->query("Select DISTINCT nf from entradas");
								
$arrNotas = array();

while ($nota = mysql_fetch_array($getNotas))
{

	array_push($arrNotas, $nota["nf"]);
	
}

	asort($arrNotas);
	
echo json_encode($arrNotas);

?>
