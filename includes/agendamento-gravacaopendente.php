<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<tr>
<td><b>Agend. Pendente:</b></td>

<td>
<? 

$dataAgendada0pendente = explode('-',$linha['agendamentoPendente']);

$dataAgendadapendente = substr($dataAgendada0pendente[2],0,2).'/'.$dataAgendada0pendente[1].'/'.$dataAgendada0pendente[0];

$horaAgendada0pendente = explode(':',$linha['agendamentoPendente']);
$horaAgendadapendente = substr($horaAgendada0pendente[0],-2,2);
$minutoAgendadopendente = $horaAgendada0pendente[1];

$conReagendamentos1 = $conexao->query("SELECT COUNT(*) FROM `reagendamentoPendente` WHERE venda ='".$_GET['id']."'");
$conReagend1 = mysql_fetch_array($conReagendamentos1);
$contagem =$conReagend1;

if($_GET['e'] == '1' && $USUARIO['inserir_gravacao'] == '1'){

	
?>

<input type="text" name="agendamentoPendente"  onKeyUp="validadata(this.value,agendamentoPendente)" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($dataAgendadapendente != '00/00/0000' && $dataAgendadapendente != ''){ echo $dataAgendadapendente;}?>" /> às 
<select name="agendamentoPendenteHora">
<option></option>
<? for($h=8;$h<22;$h++){?>
<option <? if($horaAgendadapendente == sprintf("%02d", $h) && $dataAgendadapendente != '00/00/0000' && $dataAgendadapendente != ''){?>selected="selected"<? } ?>><?= sprintf("%02d", $h); ?></option>
<? } ?>

</select>
<b>:</b>
<select name="agendamentoPendenteMinuto">
<option></option>
<? for($m = 00;$m<60;$m=$m+5){?>
<option <? if($minutoAgendadopendente == sprintf("%02d", $m) && $dataAgendadapendente != '00/00/0000' && $dataAgendadapendente != ''){?>selected="selected"<? } ?>><?= sprintf("%02d", $m); ?></option>
<? } ?>
</select>


<? } else{?>

<?= $dataAgendadapendente; ?> <? if($horaAgendadapendente > 7){ echo ' às '.$horaAgendadapendente.':'.$minutoAgendadopendente; }?>

<? } ?>

</td>
</td>
</tr>
<tr>
<td><b>Obs. Pendente:</b></td>
<td>
<? if($_GET['e'] == '1' && $USUARIO['inserir_gravacao'] == '1'){?>
	
	<input type="text" name="obsPendente" value="<? if(isset($linha['obsPendente'])){echo $linha['obsPendente'];} ?>"/>

<?} else {?>
	<?= $linha['obsPendente'];?>
<?}?>
</td>
</tr>
