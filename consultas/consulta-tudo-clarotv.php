<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Todas as Vendas</title>
</head>

<body>


<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px">
<tr style="font-weight:bold; color:#FFF;" bgcolor="#333333" align="center">
<td>Telefone</td>
<td>CEP</td>
<td>Bairro</td>
<td>Cidade</td>
<td>Status</td>
</tr>

<?  

include "../conexao.php";

$select = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '1' ORDER BY data DESC");

$color = '#f6f6f6';

while($row = mysql_fetch_array($select)){ 

if($color == '#f6f6f6'){ $color = '#ededed';} else { $color = '#f6f6f6';}

?>
	
    
    
<tr align="center" bgcolor="<?= $color;?>">
<td><?= $row['telefone']; ?></td>
<td><?= $row['cep']; ?></td>
<td><?= $row['bairro']; ?></td>
<td><?= $row['cidade']; ?></td>
<td><?= $row['status']; ?></td>
</tr>

	
 <? }

?>

</table>
</body>
</html>