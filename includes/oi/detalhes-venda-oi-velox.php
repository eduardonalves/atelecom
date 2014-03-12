<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script type="text/javascript">
function verificavalor(){

    plano = document.getElementById('plano').value;

if(plano == '1MB'){document.getElementById('valor').value = '29,90'; }
else if(plano == '2MB'){document.getElementById('valor').value = '49,90'; }
else if(plano == '5MB'){document.getElementById('valor').value = '59,90'; }
else if(plano == '10MB'){document.getElementById('valor').value = '69,90'; }
else if(plano == '15MB'){document.getElementById('valor').value = '79,90'; }
else{ document.getElementById('valor').value = '';}
    

}
</script>

<tr>

<td><b>Plano:</b></td>

<td>

<? if($editar == '1') {?>


<select name="plano" id="plano" onchange="verificavalor()">

<option value=""></option>

<option value="1MB" <? if($linha['plano'] == '1MB'){ ?> selected="selected" <? }?>>1MB</option>
<option value="2MB" <? if($linha['plano'] == '2MB'){ ?> selected="selected" <? }?>>2MB</option>
<option value="5MB" <? if($linha['plano'] == '5MB'){ ?> selected="selected" <? }?>>5MB</option>
<option value="10MB" <? if($linha['plano'] == '10MB'){ ?> selected="selected" <? }?>>10MB</option>
<option value="15MB" <? if($linha['plano'] == '15MB'){ ?> selected="selected" <? }?>>15MB</option>

</select>





<? } else { ?>



<?= $linha['plano']; ?>



<input type="hidden" name="plano" value="<?= $linha['plano']; ?>" />



<? } ?>

</td>

</tr>


<tr>

<td><b>Valor:</b></td>

<td>

<? if($editar == '1') {?>

R$ <input type="text" name="valor" id="valor" readonly="readonly" size="10" value="<?= str_replace('.',',',$linha['valor']); ?>" />

<? } else { ?>



R$ <?= str_replace('.',',',$linha['valor']); ?>

<input type="hidden" name="valor" id="valor" value="<?= str_replace('.',',',$linha['valor']); ?>" />



</td>



<? } ?>



</td>

</tr>



<tr>

<td><b>Vencimento:</b></td>

<td>

<? if($editar == '1') {?>



<input type="text" name="vencimento" size="4" value="<?=$linha['vencimento'];?>" /> 



<? } else { ?>



<?= $linha['vencimento']; ?>

<input type="hidden" name="vencimento" size="4" value="<?=$linha['vencimento'];?>" /> 





<? } ?>



</td>

</tr>





<tr>

<td><b>Agendamento:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="datamarcada" size="20" placeholder="ex: dd/mm/aaaa" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_marcada']){echo substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4);} ?>" />

<? } else { ?>



<? if($linha['data_marcada']){echo substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4);} ?>

<input type="hidden" name="datamarcada" size="20" onKeyPress="mascara(this,data)" maxlength="10" value="<?= substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4); ?>" />



<? } ?>

</td>

</tr>



<? 
$tipoOBS = '3';
include "includes/observacoes.php";
?>


<? if($linha['obs']){?>
<tr><td colspan="2"><hr size="1" style="border-bottom: 1px dashed #EDEDED;" color="#FFF" /></td></tr>		

<tr>
<td><b>Obs.:</b></td>
<td>

<?= $linha['obs'];?>
</td>
</tr>

<? } ?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<tr>

<td><b>Status:</b></td>

<td>


<? if(!isset($_GET['e'] )){$_GET['e'] ="";} ?>
<? if($editar == '1' && ($USUARIO['tipo_usuario'] == 'ADMINISTRADOR' || ($USUARIO['id'] == '23' || $USUARIO['id'] == '3145'))){ ?>
	<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
		<option value=""></option>
		<option value="ANÁLISE" <? if($linha['status'] == 'ANÁLISE'){?>selected="selected"<? } ?>>Análise</option>
		<option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>
		<option value="PRÉ-ANÁLISE" <? if($linha['status'] == 'PRÉ-ANÁLISE'){?>selected="selected"<? } ?>>Pré-Análise</option>
		<option value="PENDENTE" <? if($linha['status'] == 'PENDENTE'){?>selected="selected"<? } ?>>Pendente</option>
		<option value="FINALIZADA" <? if($linha['status'] == 'FINALIZADA'){?>selected="selected"<? } ?>>Finalizada</option>
		<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
		<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>
		<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
		<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
		<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
		
		<option value="PÓS VENDAS" <? if($linha['status'] == 'PÓS VENDAS'){?>selected="selected"<? } ?>>Pós Vendas</option>
		<option value="CONECTADO" <? if($linha['status'] == 'CONECTADO'){?>selected="selected"<? } ?>>Conectado</option>
	</select>
<? } else if(($editar == '1') && ($USUARIO['tipo_usuario'] == 'AUDITOR') && ($linha['status'] == 'PRÉ-ANÁLISE') ){ ?>
		<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
			<option value=""></option><option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>
			<option value="PENDENTE" <? if($linha['status'] == 'PENDENTE'){?>selected="selected"<? } ?>>Pendente</option>
			<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
		</select>
<? }elseif(($editar == '1') && ($USUARIO['tipo_usuario'] == 'AUDITOR') && ($linha['status'] == 'GRAVAR') && ($linha['gravacao'] != '') ){?>
		<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
			<option value=""></option>
			<option value="ANÁLISE" <? if($linha['status'] == 'ANÁLISE'){?>selected="selected"<? } ?>>Análise</option>
			<option value="FINALIZADA" <? if($linha['status'] == 'FINALIZADA'){?>selected="selected"<? } ?>>Finalizada</option>
		</select>
<?}elseif(($editar == '1') && ($USUARIO['tipo_usuario'] == 'AUDITOR') && ($linha['status'] == 'FINALIZADA')){ ?>
		<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
			<option value=""></option>
			<option value="CONECTADO" <? if($linha['status'] == 'CONECTADO'){?>selected="selected"<? } ?>>Conectado</option>
			<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
		</select>
<? }elseif(($editar == '1') && ($USUARIO['tipo_usuario'] == 'AUDITOR') && ($linha['status'] == 'GRAVAR')){ ?>
		<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
			<option value=""></option>
			<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
			<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
			<option value="FINALIZADA" <? if($linha['status'] == 'FINALIZADA'){?>selected="selected"<? } ?>>Finalizada</option></select>
<? }elseif(($editar == '1') && ($USUARIO['tipo_usuario'] == 'AUDITOR') && ($linha['status'] == 'RECUPERADO')){ ?>
		<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
			<option value=""></option><option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>
		</select>
<? }elseif(($editar == '1') && ($USUARIO['tipo_usuario'] == 'AUDITOR') && ($linha['status'] == 'PENDENTE')){?>
		<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
			<option value=""></option>
			<option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>
			
		</select>
<? }elseif(($editar == '1') && ($USUARIO['tipo_usuario'] == 'AUDITOR') && ($linha['status'] == 'ANÁLISE')){?>
		<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
			<option value=""></option>
			<option value="FINALIZADA" <? if($linha['status'] == 'FINALIZADA'){?>selected="selected"<? } ?>>Finalizada</option>
			<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
		</select>
<? }elseif((($USUARIO['tipo_usuario'] == 'MONITOR') && ($linha['status'] == 'DEVOLVIDO')) || (($USUARIO['tipo_usuario'] == 'MONITOR') && ($linha['status'] == 'SEM CONTATO'))){ ?>
		<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">
			<option value=""></option><option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){ ?>selected="selected"<? } ?>>Venda Recuperada</option>
			<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){ ?>selected="selected"<? } ?>>Cancelado</option>
		</select>
<? }	else { ?>
	<?= $linha['status']; ?><input type="hidden" name="status" value="<?= $linha['status']; ?>" /></td><? } ?>

</td>

</tr>

