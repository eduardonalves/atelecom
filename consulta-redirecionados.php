<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redirecionados</title>
</head>

<body>


<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px">
<tr style="font-weight:bold; color:#FFF;" bgcolor="#333333" align="center">
<td>Monitor</td>
<td>Operador</td>
<td>Nome</td>
<td>CPF</td>
<td>Telefone</td>
<td>Telefone2</td>
<td>Data Venda</td>
<td>Status</td>
</tr>

<?  

include "conexao.php";

$select = $conexao->query("SELECT *, 
									operadores.nome AS operador,
									usuarios.nome AS monitor,
									vendas_clarotv.nome AS nome,
									vendas_clarotv.cpf AS cpf,
									vendas_clarotv.telefone AS telefone,
									vendas_clarotv.telefone2 AS telefone2,
									vendas_clarotv.data AS data,
									vendas_clarotv.status AS status 
									FROM vendas_clarotv 
									INNER JOIN operadores ON operadores.operador_id = vendas_clarotv.operador 
									JOIN usuarios ON usuarios.id = vendas_clarotv.monitor
									WHERE produto = '3' && vendas_clarotv.status = 'REDIRECIONADO' 
									ORDER BY vendas_clarotv.data DESC");

$color = '#f6f6f6';

while($row = mysql_fetch_array($select)){ 

if($color == '#f6f6f6'){ $color = '#ededed';} else { $color = '#f6f6f6';}

?>
	
    
    
<tr align="center" bgcolor="<?= $color;?>">
<td><?= $row['monitor']; ?></td>
<td><?= $row['operador']; ?></td>
<td><?= $row['nome']; ?></td>
<td><?= $row['cpf']; ?></td>
<td><?= $row['telefone']; ?></td>
<td><?= $row['telefone2']; ?></td>
<td><?= substr($row['data'],6,2)."/".substr($row['data'],4,2)."/".substr($row['data'],0,4); ?></td>
<td><?= $row['status']; ?></td>

</tr>

	
 <? }

?>

</table>
</body>
</html>