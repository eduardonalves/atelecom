<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Vendas Gravadas FIXO</title>
</head>

<body>


<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px">
<tr style="font-weight:bold; color:#FFF;" bgcolor="#333333" align="center">
<td>ID</td>
<td>Monitor</td>
<td>Operador</td>
<td>Nome</td>
<td>CPF</td>
<td>DDD</td>
<td>Telefone</td>
<td>Data Venda</td>
<td>Status</td>
</tr>

<?  

include "../conexao.php";

$select = $conexao->query("SELECT *, 
									vendas_clarotv.id AS idvenda,
									operadores.nome AS operador,
									monitor.nome AS monitornome,
									vendas_clarotv.nome AS nome,
									vendas_clarotv.cpf AS cpf,
									vendas_clarotv.telefone AS telefone,
									vendas_clarotv.telefone2 AS telefone2,
									vendas_clarotv.data AS data,
									vendas_clarotv.status AS status 
									FROM vendas_clarotv 
									INNER JOIN operadores ON operadores.operador_id = vendas_clarotv.operador 
									JOIN usuarios AS monitor ON monitor.id = vendas_clarotv.monitor
									WHERE vendas_clarotv.produto = '3' && vendas_clarotv.status = 'REDIRECIONADO'&&
									vendas_clarotv.data > 20130000 && vendas_clarotv.data < 20130118
									ORDER BY vendas_clarotv.data DESC");

$color = '#f6f6f6';

while($row = mysql_fetch_array($select)){ 

if($color == '#f6f6f6'){ $color = '#ededed';} else { $color = '#f6f6f6';}

$tipo = substr(str_replace('-','',$row['telefone']),5,1);


if($tipo < 6){
?>
	
    
    
<tr align="center" bgcolor="<?= $color;?>">
<td><?= $row['idvenda']; ?></td>
<td><?= $row['monitornome']; ?></td>
<td><?= $row['operador']; ?></td>
<td><?= $row['nome']; ?></td>
<td><?= $row['cpf']; ?></td>
<td><?= substr($row['telefone'],1,2); ?></td>
<td><?= substr(str_replace('-','',$row['telefone']),5); ?></td>
<td><?= substr($row['data'],6,2)."/".substr($row['data'],4,2)."/".substr($row['data'],0,4); ?></td>
<td><?= $row['status']; ?></td>

</tr>

	
 <? }}

?>

</table>
</body>
</html>