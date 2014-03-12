<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<tr>
<td><b>Cliente Oi:<b></td>

<td>
<? if($editar == '1') {?>

<select name="oifixo">

<option value=""></option>

<option value="SIM" <? if($linha['oifixo'] == 'SIM'){?>selected="selected"<? } ?>>Sim</option>

<option value="NÃO" <? if($linha['oifixo'] == 'NÃO'){?>selected="selected"<? } ?>>N&atilde;o</option>

</select>


<? } else { ?>

<?= $linha['oifixo']; ?>

<input type="hidden" name="oifixo" value="<?= $linha['oifixo']; ?>" />

<? } ?>


</td>
</tr>
 


<tr>
<td><b>N&uacute;mero do telefone:<b></td>
<td>
<? if($editar == '1') {?>



	<input type="text" name="telOifixo" onKeyPress="mascara(this,telefone)" size="10" value="<?=$linha['telOifixo'];?>" /> 

<? } else { ?>

<?= $linha['telOifixo']; ?>

<input type="hidden" name="telOifixo" value="<?= $linha['telOifixo']; ?>" />

<? } ?>

</td>
</tr>


<tr>

<td><b>Forma de Pagamento:</b></td>

<td>



<? if($editar == '1') {?>



<select name="pagamento"  onchange="verificapagamento(this.value);">

<option value=""></option>

<option value="BOLETO" <? if($linha['pagamento'] == 'BOLETO'){?>selected="selected"<? } ?>>Boleto</option>

<option value="DÉBITO" <? if($linha['pagamento'] == 'DÉBITO'){?>selected="selected"<? } ?>>D&eacute;bito</option>

<option value="CONTA FIXO" <? if($linha['pagamento'] == 'CONTA FIXO'){?>selected="selected"<? } ?>>Conta Fixo</option>

</select>

<? } else { ?>



<?= $linha['pagamento']; ?>



<input type="hidden" value="<?= $linha['pagamento'];?>" name="pagamento" />

</td>



<? } ?>



</td>

</tr>


<tr>

<td><b>Valor:</b></td>

<td>

<? if($editar == '1') {?>

R$ <input type="text" name="valor" id="valor" <? if($linha['pagamento'] == 'DÉBITO'){?>disabled="disabled"<? } ?> size="30" value="<?= str_replace('.',',',$linha['valor']); ?>" />

<? } else { ?>



R$ <?= str_replace('.',',',$linha['valor']); ?>

<input type="hidden" name="valor" id="valor" value="<?= str_replace('.',',',$linha['valor']); ?>" />



</td>



<? } ?>



</td>

</tr>



<tr id="idbanco" <? if($linha['pagamento'] == 'BOLETO'){?> style="display:none" <? } ?>>

<td><b>Banco:</b></td>



<td>

<? if($editar == '1') {?>



<input type="text" id="banco" name="banco" size="20" value="<?= $linha['banco'];?>" /> <b>AG:</b> <input type="text" name="agencia" id="agencia" size="5" value="<?= $linha['agencia'];?>" /> <b>CC:</b> <input type="text" name="contacorrente" id="contacorrente" size="7" value="<?= $linha['conta_corrente'];?>" />



<? } else {?>



<?= $linha['banco'].' <b>AG:</b> '.$linha['agencia'].' <b>CC:</b> '.$linha['conta_corrente'];?>

<input type="hidden" size="40" name="banco" value="<?= $linha['banco']; ?>" />

<input type="hidden" size="40" name="agencia" value="<?= $linha['agencia']; ?>" />

<input type="hidden" size="40" name="contacorrente" value="<?= $linha['conta_corrente']; ?>" />





<? } ?>

 </td>

</tr>



<tr>

<td><b>Plano:</b></td>

<td>

<? if($editar == '1') {?>


<select name="plano" id="plano">

<option value=""></option>

<option value="OI TV MEGA HD" <? if($linha['plano'] == 'OI TV MEGA HD'){ ?> selected="selected" <? }?>>OI TV MEGA HD</option>

<option value="OI TV MEGA HBO/MAX HD" <? if($linha['plano'] == 'OI TV MEGA HBO/MAX HD'){ ?> selected="selected" <? }?>>OI TV MEGA HBO/MAX HD</option>

<option value="OI TV MEGA TELECINE HD" <? if($linha['plano'] == 'OI TV MEGA TELECINE HD'){ ?> selected="selected" <? }?>>OI TV MEGA TELECINE HD</option>

<option value="OI TV MEGA CINEMA HD" <? if($linha['plano'] == 'OI TV MEGA CINEMA HD'){ ?> selected="selected" <? }?>>OI TV MEGA CINEMA HD</option>

<option value="OI TV MAIS HD" <? if($linha['plano'] == 'OI TV MAIS HD'){ ?> selected="selected" <? }?>>OI TV MAIS HD</option>

<option value="OI TV MAIS TELECINE HD" <? if($linha['plano'] == 'OI TV MAIS TELECINE HD'){ ?> selected="selected" <? }?>>OI TV MAIS TELECINE HD</option>

<option value="OI TV MAIS HBO/MAX HD" <? if($linha['plano'] == 'OI TV MAIS HBO/MAX HD'){ ?> selected="selected" <? }?>>OI TV MAIS HBO/MAX HD</option>

<option value="OI TV MAIS CINEMA HD" <? if($linha['plano'] == 'OI TV MAIS CINEMA HD'){ ?> selected="selected" <? }?>>OI TV MAIS CINEMA HD</option>

</select>





<? } else { ?>



<?= $linha['plano']; ?>



<input type="hidden" name="plano" value="<?= $linha['plano']; ?>" />



<? } ?>

</td>

</tr>




<tr>

<td><b>Pacotes adicionais:</b></td>

<td>

<? if($editar == '1') {?>

<input type="checkbox" name="pct1" value="SEXYPRIVÊ" <? if(strstr($linha['pacotes_e_canais_adicionais'],'SEXYPRIVÊ')){ ?> checked="checked" <? }?>>Sexy Priv&ecirc; &nbsp;&nbsp;

<input type="checkbox" name="pct2" value="ÉTNICOS" <? if(strstr($linha['pacotes_e_canais_adicionais'], 'ÉTNICOS')){ ?> checked="checked" <? }?>>Étnicos &nbsp;&nbsp;

<input type="checkbox" name="pct3" value="TV CORINTHIANS" <? if(strstr($linha['pacotes_e_canais_adicionais'], 'TV CORINTHIANS')){ ?> checked="checked" <? }?>>Playboy TV &nbsp;&nbsp;

<input type="checkbox" name="pct4" value="PLAYBOY TV" <? if(strstr($linha['pacotes_e_canais_adicionais'], 'PLAYBOY TV')){ ?> checked="checked" <? }?>>Sexy Hot &nbsp;&nbsp;

<input type="checkbox" name="pct5" value="SEXY HOT" <? if(strstr($linha['pacotes_e_canais_adicionais'], 'SEXY HOT')){ ?> checked="checked" <? }?>>PLAYBOY TV &nbsp;&nbsp;

<input type="checkbox" name="pct6" value="SEXY HOT + PLAYBOY TV" <? if(strstr($linha['pacotes_e_canais_adicionais'], 'SEXY HOT + PLAYBOY TV')){ ?> checked="checked" <? }?>>Sexy Hot + Playboy TV &nbsp;&nbsp;

<input type="checkbox" name="pct7" value="COMBATE" <? if(strstr($linha['pacotes_e_canais_adicionais'], 'COMBATE')){ ?> checked="checked" <? }?>>Combate &nbsp;&nbsp;


<? } else { ?>

<?= $linha['pacotes_e_canais_adicionais']; ?>

<input type="hidden" name="pacotes_e_canais_adicionais" value="<?= $linha['pacotes_e_canais_adicionais']; ?>" />


<? } ?>

</td>

</tr>


<tr>

<td><b>Pacotes com escolha:</b></td>

<td>

<? if($editar == '1') {?>


<select name="pacoteEscolha" id="pacoteEscolha">

<option value=""></option>

<option value="01 ESTADUAL + SÉRIE A - 67,90" <? if($linha['pacoteEscolha'] == '01 ESTADUAL + SÉRIE A - 67,90'){ ?> selected="selected" <? }?>>01 ESTADUAL + S&Eacute;RIE A - 67,90</option>

<option value="02 ESTADUAIS + SÉRIE A - 67,90" <? if($linha['pacoteEscolha'] == '02 ESTADUAIS + SÉRIE A - 67,90'){ ?> selected="selected" <? }?>>02 ESTADUAIS + S&Eacute;RIE A - 67,90</option>

<option value="01 ESTADUAL + SÉRIE A + B - 82,90" <? if($linha['pacoteEscolha'] == '01 ESTADUAL + SÉRIE A + B - 82,90'){ ?> selected="selected" <? }?>>01 ESTADUAL + S&Eacute;RIE A + B - 82,90</option>

<option value="01 ESTADUAL + SÉRIE B - 82,90" <? if($linha['pacoteEscolha'] == '01 ESTADUAL + SÉRIE B - 82,90'){ ?> selected="selected" <? }?>>01 ESTADUAL + S&Eacute;RIE B - 82,90</option>


</select>





<? } else { ?>



<?= $linha['pacoteEscolha']; ?>



<input type="hidden" name="pacoteEscolha" value="<?= $linha['pacoteEscolha']; ?>" />



<? } ?>

</td>

</tr>



<tr>

<td><b>Eventos da temporada:</b></td>

<td>

<? if($editar == '1') {?>


<select name="eventosTemporada" id="eventosTemporada">

<option value=""></option>

<option value="BIG BROTHER BRASIL 13" <? if($linha['eventosTemporada'] == 'BIG BROTHER BRASIL 13'){ ?> selected="selected" <? }?>>BIG BROTHER BRASIL 13</option>

</select>


<? } else { ?>



<?= $linha['eventosTemporada']; ?>



<input type="hidden" name="eventosTemporada" value="<?= $linha['eventosTemporada']; ?>" />



<? } ?>

</td>

</tr>



<tr>

<td><b>Ofertas Oi TV:</b></td>

<td>

<? if($editar == '1') {?>


<select name="ofertasOitv" id="ofertasOitv">

<option value=""></option>

<option value="(PREÇO TABELA_AQUISIÇÃO_HD) TV ALONE (BOLETO)" <? if($linha['ofertasOitv'] == '(PREÇO TABELA_AQUISIÇÃO_HD) TV ALONE (BOLETO)'){ ?> selected="selected" <? }?>>(PRE&Ccedil;O TABELA_AQUISI&Ccedil;&Atilde;O_HD) TV ALONE (BOLETO)</option>

<option value="(Preço Tabela_Aquisição_HD) Fixo + TV (Boleto)" <? if($linha['ofertasOitv'] == '(Preço Tabela_Aquisição_HD) Fixo + TV (Boleto)'){ ?> selected="selected" <? }?>>(Pre&ccedil;o Tabela_Aquisi&ccedil;&atilde;o_HD) Fixo + TV (Boleto)</option>

<option value="(Preço Tabela_Aquisição_HD) TV Alone (DACC)" <? if($linha['ofertasOitv'] == '(Preço Tabela_Aquisição_HD) TV Alone (DACC)'){ ?> selected="selected" <? }?>>(Pre&ccedil;o Tabela_Aquisi&ccedil;&atilde;o_HD) TV Alone (DACC)</option>

<option value="(Preço Tabela_Aquisição_HD) Fixo + TV (DACC/Oi Fixo)" <? if($linha['ofertasOitv'] == '(Preço Tabela_Aquisição_HD) Fixo + TV (DACC/Oi Fixo)'){ ?> selected="selected" <? }?>>(Pre&ccedil;o Tabela_Aquisi&ccedil;&atilde;o_HD) Fixo + TV (DACC/Oi Fixo)</option>

<option value="(PREÇO TABELA_AQUISIÇÃO_HD) TV ALONE (BOLETO)" <? if($linha['ofertasOitv'] == '(PREÇO TABELA_AQUISIÇÃO_HD) TV ALONE (BOLETO)'){ ?> selected="selected" <? }?>>(PRE&Ccedil;O TABELA_AQUISI&Ccedil;&Atilde;O_HD) TV ALONE (BOLETO)</option>

<option value="(Preço Tabela_Aquisição_HD) OCT + TV (DACC/Oi Fixo)" <? if($linha['ofertasOitv'] == '(Preço Tabela_Aquisição_HD) OCT + TV (DACC/Oi Fixo)'){ ?> selected="selected" <? }?>>(Pre&ccedil;o Tabela_Aquisi&ccedil;&atilde;o_HD) OCT + TV (DACC/Oi Fixo)</option>

</select>


<? } else { ?>



<?= $linha['ofertasOitv']; ?>



<input type="hidden" name="ofertasOitv" value="<?= $linha['ofertasOitv']; ?>" />



<? } ?>

</td>

</tr>



<tr>

<td><b>Pontos Adi.:</b></td>

<td>

<? if($editar == '1') {?>



<input type="radio" name="pontos" value="0" <? if($linha['pontos'] == '0'){?>checked="checked" <? } ?>/> 0

<input type="radio" name="pontos" value="1" <? if($linha['pontos'] == '1'){?>checked="checked" <? } ?>/> 1

<input type="radio" name="pontos" value="2" <? if($linha['pontos'] == '2'){?>checked="checked" <? } ?>/> 2

<input type="radio" name="pontos" value="3" <? if($linha['pontos'] == '3'){?>checked="checked" <? } ?>/> 3

<input type="radio" name="pontos" value="4" <? if($linha['pontos'] == '4'){?>checked="checked" <? } ?>/> 4



<? } else { ?>



<?= $linha['pontos']; ?>

<input type="hidden" name="pontos" value="<?= $linha['pontos']; ?>" />





<? } ?>



</td>

</tr>



<? if($linha['pontos'] > 1) {?>

<tr>

<td><b>OS Ponto 2:</b></td>

<td>

<? if($editar_instalacao == '1') {?>



<input type="text" name="os3" size="40" value="<?= $linha['os3']; ?>" />





<? } else { ?>



<?= $linha['os3']; ?>

<input type="hidden" name="os3" value="<?= $linha['os3']; ?>" />





<? } ?>



</td>

</tr>

<? } ?>



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

<input type="text" name="datamarcada" size="20" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($linha['data_marcada']){echo substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4);} ?>" />

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


<? if($editar == '1' && ($USUARIO['tipo_usuario'] == 'ADMINISTRADOR' || ($USUARIO['id'] == '23' || $USUARIO['id'] == '3145'))){?>  


<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">

<option value=""></option>
<option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>
<option value="APROVADO" <? if($linha['status'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="INSTALAR" <? if($linha['status'] == 'INSTALAR'){?>selected="selected"<? } ?>>Instalar</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>
<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>
<option value="CONECTADO" <? if($linha['status'] == 'CONECTATO'){?>selected="selected"<? } ?>>Conectado</option>
<option value="PENDENTE" <? if($linha['status'] == 'PENDENTE'){?>selected="selected"<? } ?>>Pendente</option>


</select>


<? } else {?>


<? if(($editar == '1') && $linha['status'] == 'GRAVAR') { ?>

<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">

<option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>
<option value="APROVADO" <? if($linha['status'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
<option value="PENDENTE" <? if($linha['status'] == 'PENDENTE'){?>selected="selected"<? } ?>>Pendente</option>
</select>

<? } else if(($editar == '1') && $linha['status'] == 'APROVADO') { ?>

<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">

<option value="APROVADO" <? if($linha['status'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="INSTALAR" <? if($linha['status'] == 'INSTALAR'){?>selected="selected"<? } ?>>Instalar</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<option value="PENDENTE" <? if($linha['status'] == 'PENDENTE'){?>selected="selected"<? } ?>>Pendente</option>
</select>

<? } else if(($editar == '1') && $linha['status'] == 'INSTALAR') { ?>

<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">

<option value="INSTALAR" <? if($linha['status'] == 'INSTALAR'){?>selected="selected"<? } ?>>Instalar</option>
<option value="CONECTADO" <? if($linha['status'] == 'CONECTATO'){?>selected="selected"<? } ?>>Conectado</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>

</select>

<? } else if(($_GET['e'] == '1') && $linha['status'] == 'DEVOLVIDO' && ($USUARIO['tipo_usuario'] == 'MONITOR' || $USUARIO['tipo_usuario'] == 'ADMINISTRADOR')) { ?>

<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">

<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Venda Recuperada</option>
<option value="CANCELADO" <? if($linha['status'] == 'CANCELADO'){?>selected="selected"<? } ?>>Cancelado</option>

</select>

<? } else if(($editar == '1') && $linha['status'] == 'SEM CONTATO') { ?>

<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">

<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
<option value="APROVADO" <? if($linha['status'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>

</select>

<? } else if(($editar == '1') && $linha['status'] == 'RESTRIÇÃO') { ?>

<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">

<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
<option value="RECUPERADO" <? if($linha['status'] == 'RECUPERADO'){?>selected="selected"<? } ?>>Recuperado</option>

</select>

<? } else if(($editar == '1') && $linha['status'] == 'PRÉ-ANÁLISE') { ?>


<select name="status"  id="selectStatus" onChange="checkstatus(this.value)">

<option value="GRAVAR" <? if($linha['status'] == 'GRAVAR'){?>selected="selected"<? } ?>>Gravar</option>
<option value="APROVADO" <? if($linha['status'] == 'APROVADO'){?>selected="selected"<? } ?>>Aprovado</option>
<option value="DEVOLVIDO" <? if($linha['status'] == 'DEVOLVIDO'){?>selected="selected"<? } ?>>Devolvido</option>
<option value="SEM CONTATO" <? if($linha['status'] == 'SEM CONTATO'){?>selected="selected"<? } ?>>Sem Contato</option>
<option value="PENDENTE" <? if($linha['status'] == 'PENDENTE'){?>selected="selected"<? } ?>>Pendente</option>
<option value="RESTRIÇÃO" <? if($linha['status'] == 'RESTRIÇÃO'){?>selected="selected"<? } ?>>Restrição</option>
</select>
<? } else { ?>

<?= $linha['status']; ?>

<input type="hidden" name="status" value="<?= $linha['status']; ?>" />

</td>

<? }} ?>

</td>

</tr>
