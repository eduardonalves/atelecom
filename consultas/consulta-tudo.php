<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Todas as Vendas</title>
</head>

<body>


<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px">
<tr style="font-weight:bold; color:#FFF;" bgcolor="#333333" align="center">
<td>Nome</td>
<td>Telefone</td>
<td>CEP</td>
</tr>

<?  

include "../conexao.php";

$select = $conexao->query("SELECT DISTINCT nome,telefone,cep FROM vendas_clarotv WHERE cpf != '' && cpf != '000.000.000-00' ORDER BY data DESC");

$color = '#f6f6f6';

while($row = mysql_fetch_array($select)){ 

if($color == '#f6f6f6'){ $color = '#ededed';} else { $color = '#f6f6f6';}

?>
	
    
    
<tr align="center" bgcolor="<?= $color;?>">
<td><?= $row['nome']; ?></td>
<td><?= $row['telefone']; ?></td>
<td><?= $row['cep']; ?></td>

</tr>

	
 <? }

?>

</table>
</body>
</html>