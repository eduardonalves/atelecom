<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Todas as Vendas</title>
</head>

<body>


<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:11px">
<tr style="font-weight:bold; color:#FFF;" bgcolor="#333333" align="center">
<td>OS</td>
<td>ESN</td>
<td>Cliente</td>
<td>CPF</td>
<td>Telefone</td>
<td>CEP</td>
<td>Tipo Venda</td>
<td>Data Venda</td>
<td>Data Finalizada</td>
<td>Plano</td>
<td>Pagamento</td>
<td>Status</td>
</tr>

<?  

include "../conexao.php";

$select = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '3' && status = 'FINALIZADA' && (data > 20130100 && data < 20130300) ORDER BY data DESC");

$color = '#f6f6f6';

while($row = mysql_fetch_array($select)){ 

if($color == '#f6f6f6'){ $color = '#ededed';} else { $color = '#f6f6f6';}

?>
	
    
    
<tr align="center" bgcolor="<?= $color;?>">
<td>&nbsp;<?= $row['os']; ?></td>
<td>&nbsp;<?= $row['esn']; ?></td>
<td>&nbsp;<?= $row['nome']; ?></td>
<td>&nbsp;<?= $row['cpf']; ?></td>
<td>&nbsp;<?= $row['telefone']; ?></td>
<td>&nbsp;<?= $row['cep']; ?></td>
<td>&nbsp;<?= $row['tipoVenda']; ?></td>
<td>&nbsp;<?= substr($row['data'],6,2)."/".substr($row['data'],4,2)."/".substr($row['data'],0,4); ?></td>
<td>&nbsp;<?= substr($row['data_instalacao'],6,2)."/".substr($row['data_instalacao'],4,2)."/".substr($row['data_instalacao'],0,4); ?></td>
<td>&nbsp;<?= $row['plano']; ?></td>
<td>&nbsp;<?= $row['pagamento']; ?></td>
<td>&nbsp;<?= $row['status']; ?></td>
</tr>

	
 <? }

?>

</table>
</body>
</html>