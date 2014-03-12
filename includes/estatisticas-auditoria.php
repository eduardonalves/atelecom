<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<? $max = date("d",mktime(0, 0, 0, ($mes + 1), 0, $ano)); 

$conDiasNTrab = $conexao->query("SELECT dias_nt FROM metas WHERE periodo = '".$ano.$mes."' && produto = '".$produto_id."'"); 
$diasNT = mysql_fetch_array($conDiasNTrab);
?>

<table border="0" width="90%" style="font-size:10px">

<tr align="center" class="tr1">
<td>Auditor</td>
<? for($i=1;$i<=$max;$i++){?>
<td><?= sprintf('%02d',$i);?></td>
<? } ?>
<td>Total</td>
</tr>

<?

$CAD = "";
for($d=1;$d<=$max;$d++){
	
$CAD .= ", COUNT(IF(vendas_clarotv.gravacao LIKE '%".$ano.$mes.sprintf('%02d',$d)."%', 1, NULL)) AS num_gravacoes".$d;	

$CAD .= ", COUNT(IF(vendas_clarotv.status != 'CANCELADO' && vendas_clarotv.status != 'DEVOLVIDO' && vendas_clarotv.gravacao LIKE '%".$ano.$mes.sprintf('%02d',$d)."%', 1, NULL)) AS num_gravacoes_boas".$d;

$CAD .= ", COUNT(IF((vendas_clarotv.status = 'CANCELADO' || vendas_clarotv.status = 'DEVOLVIDO') && vendas_clarotv.gravacao LIKE '%".$ano.$mes.sprintf('%02d',$d)."%', 1, NULL)) AS num_gravacoes_ruins".$d;		
}

$conAUDITORES = $conexao->query("SELECT * $CAD,  
								COUNT(IF(vendas_clarotv.gravacao LIKE '%".$ano.$mes."%', 1, NULL)) AS total_gravacoes,
								usuarios.nome as auditor
									 FROM vendas_clarotv 
									 INNER JOIN usuarios ON usuarios.id = vendas_clarotv.auditor
									 WHERE produto = '".$produto_id."' &&
									 vendas_clarotv.gravacao LIKE '%".$ano.$mes."%' 
									 GROUP BY vendas_clarotv.auditor
									 ORDER BY usuarios.nome ASC	  
								  "); 

/*$conAUDITORES = $conexao->query("SELECT *
										FROM vendas_clarotv
										WHERE produto = '3' &&
										data LIKE '%".$ano.$mes."%'
										GROUP BY auditor
										ORDER BY id
										"); */

$class="tr2";								  
while($AUDITORES = mysql_fetch_array($conAUDITORES)){
	
if ($class=="tr2"){ //alterna a cor
  $class = "tr3";

} else{ $class="tr2";   }	

?>

<tr align="center" class="<?= $class;?>">
<td><?= $AUDITORES['auditor'];?></td>

<? for($i=1;$i<=$max;$i++){?>


<td <? if(date("Ymd") == $ano.$mes.$i){?>class="tdselected" title="Hoje" <? } else if(strstr($diasNT['dias_nt'],sprintf('%02d',$i))){?> class="tddisable" title="Dia Não Trabalhado" <? }?>>
<span style=" <? if($AUDITORES['num_gravacoes_boas'.$i] > 0 && $AUDITORES['num_gravacoes_boas'.$i] <= 14){?>color:#F00;<? } 
				 else if($AUDITORES['num_gravacoes_boas'.$i] > 14 && $AUDITORES['num_gravacoes_boas'.$i] <= 19) { ?> color:#F90;<? } 
				 else if($AUDITORES['num_gravacoes_boas'.$i] > 19) { ?> color:#0C0;<? } ?> ">
<?= ceil($AUDITORES['num_gravacoes_boas'.$i]);?>
</span>
<br />

<span style=" font-size:9px;">
<?= ceil($AUDITORES['num_gravacoes_ruins'.$i]);?>
</span>

<br />
<span style="font-weight:bold;">
<?= ceil($AUDITORES['num_gravacoes'.$i]);?>
</span>


</td>

<? } ?>


<td><b><?= ceil($AUDITORES['total_gravacoes']);?></b></td>

</tr>


<? } ?>






</table>

<br />
<br />
