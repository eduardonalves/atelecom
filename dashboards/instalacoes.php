<?

include "../conexao.php";

$campo = simplexml_load_file("../xml/campos.xml");


$hoje = date('Ymd');

$idPRODUTO = '1';
$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");
$USUARIO = mysql_fetch_assoc($conUSUARIO);
$acessoUsuario = $USUARIO['acesso_usuario'];
if($acessoUsuario =="INTERNO"){
	$tipovenda="INTERNA";
}else{
	$tipovenda="EXTERNA";
}
if($USUARIO['tipo_usuario'] ==  "MONITOR"){

		$conVENDA = $conexao->query("SELECT *,
							vendas_clarotv.data AS data,
							vendas_clarotv.id AS id,
							
							IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
								FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) AS data_marcada	
							FROM vendas_clarotv
							WHERE produto = '".$idPRODUTO."' && IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
								FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) LIKE '%".$hoje."%' && status = 'INSTALAR' && tipo_instalacao = '".$tipovenda."' && monitor='".$USUARIO['id']."' ORDER BY data ASC");
								
}else if($USUARIO['tipo_usuario'] == 'SUPERVISOR'){
	
	$idsupervisor = $USUARIO['id'];
	$querymonitores = $conexao->query("SELECT * FROM usuarios WHERE supervisor = '$idsupervisor' && acesso_usuario = '".$USUARIO['acesso_usuario']."'");
	$j=0;
	while($row = mysql_fetch_assoc($querymonitores)){
		
		if($j ==0){
			$MONITORES1 = $MONITORES1.'  monitor='.$row['id'].' ' ;

		}else{
			$MONITORES1 = $MONITORES1.'||  monitor='.$row['id'];
		}
		$j= $j+1;
	}
	
	
	$conVENDA = $conexao->query("SELECT *,
							vendas_clarotv.data AS data,
							vendas_clarotv.id AS id,
							
							IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
								FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) AS data_marcada	
							FROM vendas_clarotv
							WHERE produto = '".$idPRODUTO."' && IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
								FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) LIKE '%".$hoje."%' && status = 'INSTALAR' && tipo_instalacao = '".$tipovenda."' && ($MONITORES1) ORDER BY data ASC");
}else{
	$conVENDA = $conexao->query("SELECT *,
							vendas_clarotv.data AS data,
							vendas_clarotv.id AS id,
							
							IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
								FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) AS data_marcada	
							FROM vendas_clarotv
							WHERE produto = '".$idPRODUTO."' && IF(vendas_clarotv.reagendamentos > 0,  
							(SELECT DATE_FORMAT(agendamento,'%Y%m%d') 
								FROM reagendamentoinstalacao 
								WHERE venda = vendas_clarotv.id
						        ORDER BY id DESC LIMIT 0,1),
								vendas_clarotv.data_marcada ) LIKE '%".$hoje."%' && status = 'INSTALAR' && tipo_instalacao = 'INTERNA' ORDER BY data ASC");
}



$numVENDA = mysql_num_rows($conVENDA);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Instalações</title>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">


function check(){
 if ($('#imprimir :checkbox:checked').length > 0){
    // one or more checkboxes are checked
	
	$('#printbt').html('<input type="image" src="../img/print-icon.png" onclick="document.imprimir.submit();" title="Imprimir todas as OS selecionadas" name="P" value="P" />');
	
  }
  else{
   // no checkboxes are checked
   
   	$('#printbt').html('<img src="../img/print-icon.png" title="Selecione as OS que deseja imprimir" style="opacity:0.4" />');

  }
  
}

</script>

</head>
<link rel="stylesheet" type=text/css href="../css/tables.css" />


<body style="font-family:Arial, Helvetica, sans-serif">

<div id="conteudo">
<form name="imprimir" id="imprimir" method="post" action="../print/os-clarotv" target="_blank">
<table border="0" width="100%" cellpadding="0" cellspacing="0">

<tr align="center" style="font-size:12px; color:#999;" height="20px" valign="top">
<td colspan="100">
<?

if($numVENDA == '0'){ echo "Nenhuma Instalação Pendente para Hoje!";}

else if($numVENDA == '1'){ echo "<b>1</b> Instalação Pendente para Hoje!";}

else{ echo "<b>".$numVENDA."</b> Instalações Pendentes para Hoje!"; }
?>


</td>
</tr>

<tr class="tr1" align="center">
<td width="150px"><?= $campo->cliente ?></td>
<td><?= $campo->cidade ?></td>
<td><?= $campo->status ?></td>
<td id="printbt"><img src="../img/print-icon.png" title="Selecione as OS que deseja imprimir" style="opacity:0.4" /></td>
<td></td>
</tr>
<?
$class = "tr2";
while($VENDA = mysql_fetch_assoc($conVENDA)){

if ($class=="tr2"){ //alterna a cor
  $class = "tr3";
} else {
  $class="tr2";
}	
?>

<tr class="<?= $class;?>" align="center" style="text-transform:uppercase">
<td title="<?= strtoupper($VENDA['nome']);?>"><? echo substr($VENDA['nome'],0,17); if(strlen($VENDA['nome']) > 17){ echo '...';}?></td>
<td title="<?= strtoupper($VENDA['cidade']);?>"><? echo substr($VENDA['cidade'],0,16); if(strlen($VENDA['cidade']) > 16){ echo '...';}?></td>
<td><?= $VENDA['status'];?></td>
<td><input type="checkbox" name="id[]" onchange="check();" value="<?= $VENDA['id'];?>" /></td>
<td width="26px" title="Mais Detalhes" style="cursor:pointer"><img src="../img/icone-mais.png" width="13" height="13" onclick="Popup=window.open('../detalhes-venda-clarotv.php?id=<?= $VENDA['id']; ?>','Popup','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=630,height=600,left=430,top=30');" /></td>
</tr>

<tr height="1px" bgcolor="#CCC">
<td colspan="100"></td>
</tr>


<? } ?>

</table>
</form>
</div>

</body>
</html>