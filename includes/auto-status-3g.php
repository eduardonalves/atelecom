<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?

$dataLimite=date('Ymd', strtotime("-11 days"));

$VERdatas = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '2' && status = 'AUTORIZADA' && data_autorizacao < '".$dataLimite."'");
while($MUDAstatus = mysql_fetch_array($VERdatas)){

$UPDATEstatus = $conexao->query("UPDATE vendas_clarotv SET status = 'PÓS VENDAS' WHERE id = '".$MUDAstatus['id']."'");

}

$VERdatas2 = $conexao->query("SELECT * FROM vendas_clarotv WHERE produto = '2' && status = 'PÓS VENDAS' && data_autorizacao >= '".$dataLimite."'");
while($MUDAstatus2 = mysql_fetch_array($VERdatas2)){

$UPDATEstatus2 = $conexao->query("UPDATE vendas_clarotv SET status = 'AUTORIZADA' WHERE id = '".$MUDAstatus2['id']."'");

}

?>