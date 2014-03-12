<?

//include "conexao.php";

switch($_GET['pro']){
	
	case 1: $nomeProduto = "Claro TV"; $logo = "claro"; break;
	case 2: $nomeProduto = "Claro 3G"; $logo = "claro"; break;
	case 3: $nomeProduto = "Claro Fixo"; $logo = "claro"; break;
	case 4: $nomeProduto = "Oi TV"; $logo = "oi"; break;
	case 5: $nomeProduto = "Oi Fixo"; $logo = "oi"; break;
	case 6: $nomeProduto = "Oi Velox"; $logo = "oi"; break;
	
	}


if($_GET['d'] == ''){ $dia = 'Todos'; } else { $dia = $_GET['d'];}
if($_GET['m'] == ''){ $mes = date("m"); } else { $mes = $_GET['m'];}
if($_GET['a'] == ''){ $ano = date("Y"); } else { $ano = $_GET['a'];}


switch($mes){
	case "01": $mesN = "Jan"; break;
	case "02": $mesN = "Fev"; break;
	case "03": $mesN = "Mar"; break;
	case "04": $mesN = "Abr"; break;
	case "05": $mesN = "Mai"; break;
	case "06": $mesN = "Jun"; break;
	case "07": $mesN = "Jul"; break;
	case "08": $mesN = "Ago"; break;
	case "09": $mesN = "Set"; break;
	case "10": $mesN = "Out"; break;
	case "11": $mesN = "Nov"; break;
	case "12": $mesN = "Dez"; break;
	
	}

$class = "tr2";

$conVendas = $conexao->query("SELECT vendas_clarotv.id,vendas_clarotv.operador,vendas_clarotv.data,vendas_clarotv.status, operadores.nome AS operadornome FROM vendas_clarotv INNER JOIN operadores ON operadores.operador_id = vendas_clarotv.operador WHERE vendas_clarotv.produto = '".$_GET['pro']."' && vendas_clarotv.data LIKE '%".$ano.$mes."%' &&vendas_clarotv. monitor LIKE '%".$loginMONITOR."%' ORDER BY operadores.nome ASC, vendas_clarotv.data DESC");

$connumVendas = $conexao->query("SELECT id,operador,data,status FROM vendas_clarotv WHERE produto = '".$_GET['pro']."' && data LIKE '%".$ano.$mes."%' && monitor LIKE '%".$loginMONITOR."%'");

$numVendas = mysql_num_rows($connumVendas);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Vento Admin</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/tables.css" />

<link rel="shortcut icon" href="favicon.ico" />

</head>

<body>
<div id="submenu">
<table border="0" width="100%" cellpadding="0" cellspacing="0">

<tr>
<td width="40px" align="center"><img src="img/menu-bt-logo-<?= $logo;?>.png" /></td>
<td style="font-size:14px; color:#6b6262; font-weight:bold;"><?= $nomeProduto;?></td>
<td width="45px"><a href="#" class="bt"><?= $mesN;?></a></td>
<td width="45px"><a href="#" class="bt"><?= $ano;?></a></td>
<td width="115px" align="center"><a href="?p=grafico&pro=<?= $_GET['pro'];?>&m=<?= $mes;?>&a=<?= $ano;?>&d=<?= $dia;?>"><img src="img/icone-ver-grafico.png"  border="0" /></a></td>

</tr>

</table>
</div>

<div id="vendas">


<table border="0" width="100%">
<tr class="tr2" align="center">
<td colspan="4"><b>Vendas Encontradas: <?= ceil($numVendas);?></b></td>
</tr>

<tr class="tr1" align="center">
<td>Operador</td>
<td>Data</td>
<td>Status</td>
<td></td>
</tr>

<?
while($VENDA = mysql_fetch_array($conVendas)){

if($class == "tr2"){ $class = "tr3"; } else { $class = "tr2"; }

?>
<tr class="<?= $class;?>" align="center">
<td><?= $VENDA['operadornome']?></td>
<td><?= substr($VENDA['data'],6,2)."/".substr($VENDA['data'],4,2)."/".substr($VENDA['data'],0,4);?></td>
<td><?= $VENDA['status']?></td>
<td width="20px"><a href="?p=detalhes-venda&id=<?= $VENDA['id']?>&pro=<?= $_GET['pro'];?>"><img src="img/icone-mais.png" border="0" /></a></td>
</tr>

<? } ?>

</table>

</div>
</body>
</html>