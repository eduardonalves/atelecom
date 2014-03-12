<? 


switch($_GET['pro']){
	
	case 1: $produto = "clarotv"; $logo = "claro"; break;
	case 2: $produto = "claro3g"; $logo = "claro"; break;
	case 3: $produto = "clarofixo"; $logo = "claro"; break;
	case 4: $produto = "oi"; $logo = "oi"; break;
	case 5: $produto = "oi"; $logo = "oi"; break;
	case 6: $produto = "oi"; $logo = "oi"; break;
	
	}

$consulta = $conexao->query("SELECT * FROM vendas_clarotv WHERE id = '".$_GET['id']."'");

$linha = mysql_fetch_array($consulta);





$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");

$USUARIO = mysql_fetch_array($conUSUARIO);


?>


<table border="0" width="100%" style="font-size:14px; background:#000; color:#fff;">



<form name="editar" action="" method="post">



<tr align="center" style="color:#999; font-size:18px; font-weight:bold;\">

<td colspan="2"><? if($editar == '1'){?> Editar Venda <? } else { ?>Detalhes da Venda <? } ?> <hr size="1" color="#ccc" /></td>

</tr>


<? if($linha['protocolo']) {?>
<tr align="center" style="color:#999; font-size:16px;">

<td colspan="2"><b>Protocolo:</b>
<?= $linha['protocolo']; ?></td>
</tr>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>
<? } ?>

<tr>

<td><b>Proposta:</b></td>

<td>

<? if($editar == '1') {?>

<span id="loadpropostas" style="font-size:12px;"></span>

<input type="text" name="proposta" size="40" maxlength="10" value="<?= $linha['proposta']; ?>" onKeyUp="checkpropostas(this.value)" onChange="checkpropostas(this.value)" />

<? } else { ?>



<?= $linha['proposta']; ?>

<input type="hidden" name="proposta" size="40" value="<?= $linha['proposta']; ?>" />



</td>



<? } ?>

</tr>





<tr>

<td><b>Nº Contrato:</b></td>

<td>

<? if($editar == '1') {?>

<span id="loadcontratos" style="font-size:12px;"></span>

<input type="text" name="contrato" size="40" maxlength="10" value="<?= $linha['contrato']; ?>" onKeyUp="checkcontratos(this.value)" onChange="checkcontratos(this.value)" />

<? } else { ?>



<?= $linha['contrato']; ?>

<input type="hidden" name="contrato" size="40" value="<?= $linha['contrato']; ?>" />



</td>



<? } ?>

</tr>



<tr>

<td><b>O.S.:</b></td>

<td>

<? if($editar_instalacao == '1') {?>

<input type="text" name="os" size="40" maxlength="12" value="<?= $linha['os']; ?>" />

<? } else { ?>



<?= $linha['os']; ?>

<input type="hidden" name="os" size="40" value="<?= $linha['os']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr>

<td><b>Cliente:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="nome" size="40" value="<?= $linha['nome']; ?>" />

<? } else { ?>



<?= ucwords($linha['nome']); ?>

<input type="hidden" name="nome" size="40" value="<?= $linha['nome']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>Nascimento:</b></td>

<td>

<? 

$linhanascimento = explode('/',$linha['nascimento']);	



if($editar == '1') {

	

	

?>

<select name="nascd" id="nascd">

<option value=""></option>

<? $d = 1; while($d <= 31){ $dn = $d++;?>

<option value="<?= sprintf("%02d", $dn); ?>" <? if($linhanascimento[0] == sprintf("%02d", $dn)){?> selected="selected"<? } ?>> <?= sprintf("%02d", $dn); ?></option>

<? } ?>

</select>



<select name="nascm" id="nascm">

<option value=""></option>

<? $m = 1; while($m <= 12){ $mn = $m++;?>

<option value="<?= sprintf("%02d", $mn); ?>"  <? if($linhanascimento[1] == sprintf("%02d", $mn)){?> selected="selected"<? } ?>> <?= sprintf("%02d", $mn); ?></option>

<? } ?>

</select>



<select name="nasca" id="nasca">

<option value=""></option>

<? $a = date('Y'); while($a > 1900){ $an = $a--;?>

<option value="<?= $an; ?>" <? if($linhanascimento[2] == $an){?> selected="selected"<? } ?>> <?= $an; ?></option>

<? } ?>

</select>

<? } else { ?>



<?= ucwords($linha['nascimento']); ?>

<input type="hidden" name="nascd" value="<?= $linhanascimento[0]; ?>" />

<input type="hidden" name="nascm" value="<?= $linhanascimento[1]; ?>" />

<input type="hidden" name="nasca" value="<?= $linhanascimento[2]; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>CPF/CNPJ:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="icpf" size="40" onKeyPress="mascara(this,cpf)" maxlength="14" value="<?= $linha['cpf']; ?>" />

<? } else { ?>



<?= $linha['cpf']; ?>

<input type="hidden" name="icpf" size="40" onKeyPress="mascara(this,cpf)" maxlength="14" value="<?= $linha['cpf']; ?>" />



</td>



<? } ?>

</td>

</tr>





<tr>

<td><b>RG:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="rg" size="40" value="<?= $linha['rg']; ?>" />

<? } else { ?>



<?= $linha['rg']; ?>

<input type="hidden" name="rg" size="40" value="<?= $linha['rg']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>Org. Exp.:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="orgexp" size="40" value="<?= $linha['org_exp']; ?>" />

<? } else { ?>



<?= $linha['org_exp']; ?>

<input type="hidden" name="orgexp" size="40"  value="<?= $linha['org_exp']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>Profissão:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="profissao" size="40" value="<?= $linha['profissao']; ?>" />

<? } else { ?>



<?= $linha['profissao']; ?>

<input type="hidden" name="profissao" size="40" value="<?= $linha['profissao']; ?>" />



</td>



<? } ?>

</td>

</tr>





<tr>

<td><b>Sexo:</b></td>

<td>

<? if($editar == '1') {?>

<input type="radio" name="sexo" id="sexo1" <? if($linha['sexo'] == 'Masculino'){?> checked="checked" <? } ?> value="Masculino" /> Masculino 

<input type="radio" name="sexo" id="sexo2" <? if($linha['sexo'] == 'Feminino'){?> checked="checked" <? } ?> value="Feminino" /> Feminino

<? } else { ?>



<?= $linha['sexo']; ?>

<input type="hidden" name="sexo" size="40" value="<?= $linha['sexo']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>Estado Civil:</b></td>

<td>

<? if($editar == '1') {?>

<select name="estadocivil" id="estadocivil" >

<option value="Solteiro" <? if($linha['estado_civil'] == 'Solteiro'){?> selected="selected" <? } ?>>Solteiro</option>

<option value="Casado" <? if($linha['estado_civil'] == 'Casado'){?> selected="selected" <? } ?>>Casado</option>

<option value="Desquitado" <? if($linha['estado_civil'] == 'Desquitado'){?> selected="selected" <? } ?>>Desquitado</option>

<option value="Separado" <? if($linha['estado_civil'] == 'Separado'){?> selected="selected" <? } ?>>Separado</option>

<option value="Divorciado" <? if($linha['estado_civil'] == 'Divorciado'){?> selected="selected" <? } ?>>Divorciado</option> 

<option value="Viúvo" <? if($linha['estado_civil'] == 'Viúvo'){?> selected="selected" <? } ?>>Viúvo</option> 

</select>

<? } else { ?>



<?= $linha['estado_civil']; ?>

<input type="hidden" name="estadocivil" size="40" maxlength="14" value="<?= $linha['estado_civil']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>Email:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="email" size="40" value="<?= $linha['email']; ?>" />

<? } else { ?>



<?= strtolower($linha['email']); ?>

<input type="hidden" name="email" size="40" value="<?= $linha['email']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>Telefone:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="itelefone" size="20" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $linha['telefone']; ?>" />

<select name="tipotel1">

<option value=""></option>

<option value="Residencial" <? if($linha['tipo_tel1'] == 'Residencial'){?> selected="selected" <? } ?>>Residencial</option> 

<option value="Celular" <? if($linha['tipo_tel1'] == 'Celular'){?> selected="selected" <? } ?>>Celular</option>

<option value="Comercial" <? if($linha['tipo_tel1'] == 'Comercial'){?> selected="selected" <? } ?>>Comercial</option>

</select>

<? } else { ?>



<?= $linha['telefone'].' <span style="color:#343434; font-size: 12px;">('.$linha['tipo_tel1'].')</span>'; ?>

<input type="hidden" name="itelefone" value="<?= $linha['telefone']; ?>" />

<input type="hidden" name="tipotel1" value="<?= $linha['tipo_tel1']?>" />

</td>



<? } ?>

</td>

</tr>



<? if($linha['telefone2'] != '' || $editar == '1' ){?>

<tr>

<td><b>Telefone2:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="itelefone2" size="20" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $linha['telefone2']; ?>" />



<select name="tipotel2">

<option value=""></option>

<option value="Residencial" <? if($linha['tipo_tel2'] == 'Residencial'){?> selected="selected" <? } ?>>Residencial</option> 

<option value="Celular" <? if($linha['tipo_tel2'] == 'Celular'){?> selected="selected" <? } ?>>Celular</option>

<option value="Comercial" <? if($linha['tipo_tel2'] == 'Comercial'){?> selected="selected" <? } ?>>Comercial</option>

</select>

<? } else { ?>



<?= $linha['telefone2'].' <span style="color:#343434; font-size: 12px;">('.$linha['tipo_tel2'].')</span>'; ?>

<input type="hidden" name="itelefone2" value="<?= $linha['telefone2']; ?>" />

<input type="hidden" name="tipotel2" value="<?= $linha['tipo_tel2']?>" />



</td>

<? } ?>

</td>

</tr>

<? } ?>







<? if($linha['telefone3'] != '' || $editar == '1' ){?>

<tr>

<td><b>Telefone3:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="itelefone3" size="20" onKeyPress="mascara(this,telefone)" maxlength="14" value="<?= $linha['telefone3']; ?>" />



<select name="tipotel3">

<option value=""></option>

<option value="Residencial" <? if($linha['tipo_tel3'] == 'Residencial'){?> selected="selected" <? } ?>>Residencial</option> 

<option value="Celular" <? if($linha['tipo_tel3'] == 'Celular'){?> selected="selected" <? } ?>>Celular</option>

<option value="Comercial" <? if($linha['tipo_tel3'] == 'Comercial'){?> selected="selected" <? } ?>>Comercial</option>

</select>

<? } else { ?>



<?= $linha['telefone3'].' <span style="color:#343434; font-size: 12px;">('.$linha['tipo_tel3'].')</span>'; ?>

<input type="hidden" name="itelefone3" value="<?= $linha['telefone3']; ?>" />

<input type="hidden" name="tipotel3" value="<?= $linha['tipo_tel3']?>" />





</td>



<? } ?>

</td>

</tr>

<? } ?>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>





<tr>

<td><b>Endereço:</b></td>

<td>



<? if($editar == '1') {?>

<input type="text" size="27" name="endereco" value="<?= $linha['endereco']; ?>" /> Nº: <input type="text" size="5" name="numero" value="<?= $linha['numero']; ?>" /> <br /> Lote: <input type="text" size="5" name="lote" value="<?= $linha['lote']; ?>" /> Quadra: <input type="text" size="5" name="quadra" value="<?= $linha['quadra']; ?>" />

<? } else { ?>



<? echo ucwords($linha['endereco']); if($linha['numero']){echo ', '.$linha['numero'];} if($linha['lote']){echo ' - Lote: '.$linha['lote'];} if($linha['quadra']){echo ' - Quadra: '.$linha['quadra'];} ?>

<input type="hidden" size="40" name="endereco" value="<?= $linha['endereco']; ?>" />

<input type="hidden" size="40" name="numero" value="<?= $linha['numero']; ?>" />

<input type="hidden" size="40" name="lote" value="<?= $linha['lote']; ?>" />

<input type="hidden" size="40" name="quadra" value="<?= $linha['quadra']; ?>" />



</td>



<? } ?>

</td>

</tr>



<tr>

<td><b>Complemento:</b></td>

<td>



<? if($editar == '1') {?>

<input type="text" size="40" name="complemento" value="<?= $linha['complemento']; ?>" />

<? } else { ?>



<?= ucwords($linha['complemento']); ?>

<input type="hidden" size="40" name="complemento" value="<?= $linha['complemento']; ?>" />



</td>



<? } ?>

</td>

</tr>





<tr>

<td><b>Bairro:</b></td>

<td>



<? if($editar == '1') {?>

<input type="text" size="40" name="bairro" value="<?= $linha['bairro']; ?>" />

<? } else { ?>



<?= ucwords($linha['bairro']); ?>

<input type="hidden" size="40" name="bairro" value="<?= $linha['bairro']; ?>" />



</td>



<? } ?>

</td>

</tr>





<tr>

<td><b>Cidade:</b></td>

<td>



<? if($editar == '1') {

	

$uf = $linha['uf'];	

?>



<input type="text" size="26" name="cidade" value="<?= $linha['cidade']; ?>" /> - <select name="uf">

<option value="AC" <? if($uf == 'AC'){ echo 'selected="selected"'; } ?>>AC</option>  

<option value="AL" <? if($uf == 'AL'){ echo 'selected="selected"'; } ?>>AL</option>  

<option value="AM" <? if($uf == 'AM'){ echo 'selected="selected"'; } ?>>AM</option>  

<option value="AP" <? if($uf == 'AP'){ echo 'selected="selected"'; } ?>>AP</option>  

<option value="BA" <? if($uf == 'BA'){ echo 'selected="selected"'; } ?>>BA</option>  

<option value="CE" <? if($uf == 'CE'){ echo 'selected="selected"'; } ?>>CE</option>  

<option value="DF" <? if($uf == 'DF'){ echo 'selected="selected"'; } ?>>DF</option>  

<option value="ES" <? if($uf == 'ES'){ echo 'selected="selected"'; } ?>>ES</option>  

<option value="GO" <? if($uf == 'GO'){ echo 'selected="selected"'; } ?>>GO</option>  

<option value="MA" <? if($uf == 'MA'){ echo 'selected="selected"'; } ?>>MA</option>  

<option value="MG" <? if($uf == 'MG'){ echo 'selected="selected"'; } ?>>MG</option>  

<option value="MS" <? if($uf == 'MS'){ echo 'selected="selected"'; } ?>>MS</option>  

<option value="MT" <? if($uf == 'MT'){ echo 'selected="selected"'; } ?>>MT</option>  

<option value="PA" <? if($uf == 'PA'){ echo 'selected="selected"'; } ?>>PA</option>  

<option value="PB" <? if($uf == 'PB'){ echo 'selected="selected"'; } ?>>PB</option>  

<option value="PE" <? if($uf == 'PE'){ echo 'selected="selected"'; } ?>>PE</option>  

<option value="PI" <? if($uf == 'PI'){ echo 'selected="selected"'; } ?>>PI</option>  

<option value="PR" <? if($uf == 'PR'){ echo 'selected="selected"'; } ?>>PR</option>  

<option value="RJ" <? if($uf == 'RJ' || $uf == ''){ echo 'selected="selected"'; } ?>>RJ</option>  

<option value="RN" <? if($uf == 'RN'){ echo 'selected="selected"'; } ?>>RN</option>  

<option value="RO" <? if($uf == 'RO'){ echo 'selected="selected"'; } ?>>RO</option>  

<option value="RR" <? if($uf == 'RR'){ echo 'selected="selected"'; } ?>>RR</option>  

<option value="RS" <? if($uf == 'RS'){ echo 'selected="selected"'; } ?>>RS</option>  

<option value="SC" <? if($uf == 'SC'){ echo 'selected="selected"'; } ?>>SC</option>  

<option value="SE" <? if($uf == 'SE'){ echo 'selected="selected"'; } ?>>SE</option>  

<option value="SP" <? if($uf == 'SP'){ echo 'selected="selected"'; } ?>>SP</option>  

<option value="TO" <? if($uf == 'TO'){ echo 'selected="selected"'; } ?>>TO</option> 

</select>

<? } else { ?>





<?= ucwords($linha['cidade'].' - '.$linha['uf']); ?>

<input type="hidden" size="26" name="cidade" value="<?= $linha['cidade']; ?>" />

<input type="hidden" size="26" name="uf" value="<?= $linha['uf']; ?>" />



</td>



<? } ?>

</td>

</tr>





<tr>

<td><b>CEP:</b></td>

<td>



<? if($editar == '1') {?>

<input type="text" size="40" name="icep" onKeyPress="mascara(this,cep)" maxlength="9" value="<?= $linha['cep']; ?>" />

<? } else { ?>



<?= $linha['cep']; ?>

<input type="hidden" size="40" name="icep" onKeyPress="mascara(this,cep)" maxlength="9" value="<?= $linha['cep']; ?>" />



</td>



<? } ?>

</td>

</tr>





<tr>

<td><b>Ponto Ref.:</b></td>

<td><? if($editar == '1') {?>

<textarea name="pontoref" rows="3" cols="30"><?= $linha['ponto_referencia']; ?></textarea>

<? } else { ?>



<?= $linha['ponto_referencia']; ?>

<input type="hidden" name="pontoref" value="<?= $linha['ponto_referencia']; ?>" />





<? } ?></td>

</tr>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr align="left">

<td><b>Monitor:</b></td>

<td>

<? if($editar == '1') {?>

<select type="text" id="monitor" name="monitor" onChange="checkoperador(this.value,'<?= $linha['operador'];?>')">

<option value=""></option>

<? 



$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE grupo LIKE '%0001%' && tipo_usuario = 'MONITOR' ORDER BY nome ASC");

while($MONITORES = mysql_fetch_array($conMONITORES)){



?>

<option value="<?= $MONITORES['id'];?>" <? if($linha['monitor'] == $MONITORES['id']){?> selected="selected" <? } ?>><?= $MONITORES['nome'];?></option>

<? } ?>



</select> 



<? } else {



$conMONITORES = $conexao->query("SELECT * FROM usuarios WHERE id = '".$linha['monitor']."' ORDER BY nome ASC");

$MONITORES = mysql_fetch_array($conMONITORES);	

	?>



<?= $MONITORES['nome']; ?>

<input type="hidden" name="monitor" value="<?= $linha['monitor']; ?>" />



<? } ?>



</td>

</tr>





<tr align="left">

<td><b>Operador:</b></td>

<td>



<? 

$conOPERADORES1 = $conexao->query("SELECT * FROM operadores WHERE operador_id = '".$linha['operador']."' ORDER BY nome ASC");

$OPERADORES1 = mysql_fetch_array($conOPERADORES1);	



if($editar == '1' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR') {

	



?>

<!--

<div id="loadoperadores" style="position:relative"></div> 

-->

<select type="text" id="operador" name="operador">

<option value="<?= $linha['operador']; ?>"><?= $OPERADORES1['nome'];?></option>

<option value="<?= $linha['operador']; ?>"></option>

<? 



$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE grupo LIKE '%0001%' && status != 'DESLIGADO' ORDER BY nome ASC");

while($OPERADORES = mysql_fetch_array($conOPERADORES)){



?>



<option value="<?= $OPERADORES['operador_id'];?>" <? if($linha['operador'] == $OPERADORES['operador_id']){?> selected="selected" <? } ?>>

<?= $OPERADORES['nome'];?>

</option>



<? } ?>



</select>

<? } else {

		

	?>



<?= $OPERADORES1['nome']; ?>

<input type="hidden" name="operador" value="<?= $linha['operador']; ?>" />



<? } ?>



</td>

</tr>



<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr>

<td><b>Data da Venda:</b></td>

<td>

<? if($editar == '1') {?>

<input type="text" name="idata" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>" />

<? } else { ?>



<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>



<input type="hidden" name="idata" size="40" onKeyPress="mascara(this,data)" maxlength="10" value="<?= substr($linha['data'],6,2)."/".substr($linha['data'],4,2)."/".substr($linha['data'],0,4); ?>" />



<? } ?>



</td>

</tr>



<tr>

<td><b>Plano:</b></td>

<td>

<?= $linha['plano']; ?>

</td>

</tr>





<tr>

<td><b>Pontos Adi.:</b></td>

<td>

<? if($editar == '1') {?>



<input type="radio" name="pontos" value="0" <? if($linha['pontos'] == '0'){?>checked="checked" <? } ?>/> 0

<input type="radio" name="pontos" value="1" <? if($linha['pontos'] == '1'){?>checked="checked" <? } ?>/> 1

<input type="radio" name="pontos" value="2" <? if($linha['pontos'] == '2'){?>checked="checked" <? } ?>/> 2







<? } else { ?>



<?= $linha['pontos']; ?>

<input type="hidden" name="pontos" value="<?= $linha['pontos']; ?>" />





<? } ?>



</td>

</tr>



<? if($linha['pontos'] > 0) {?>

<tr>

<td><b>OS Ponto 1:</b></td>

<td>

<? if($editar_instalacao == '1') {?>



<input type="text" name="os2" size="40" value="<?= $linha['os2']; ?>" />





<? } else { ?>



<?= $linha['os2']; ?>

<input type="hidden" name="os2" value="<?= $linha['os2']; ?>" />





<? } ?>



</td>

</tr>

<? } ?>



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

<? if($editar == '1' && $linha['data_marcada']== '') {?>

<input type="text" name="datamarcada" id="datamarcada" size="20" onKeyUp="validadata(this.value,datamarcada)" onKeyPress="mascara(this,data)" maxlength="10" />

<? } else { ?>



<?= substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4); ?>

<input type="hidden" name="datamarcada" size="20" onKeyUp="validadata(this.value,datamarcada)" onKeyPress="mascara(this,data)" maxlength="10" value="<?= substr($linha['data_marcada'],6,2)."/".substr($linha['data_marcada'],4,2)."/".substr($linha['data_marcada'],0,4); ?>" />



<? } ?>

</td>

</tr>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<?

$conReagendamentos = $conexao->query("SELECT *,
												DATE_FORMAT(reagendamentoinstalacao.data, '%d/%m/%Y às %H:%i:%s') AS dataevento,
												DATE_FORMAT(reagendamentoinstalacao.agendamento, '%d/%m/%Y') AS dataagendamento,
												usuarios.nome AS nomeusuario
												FROM reagendamentoinstalacao 
												INNER JOIN usuarios 
												ON usuarios.id = reagendamentoinstalacao.usuario
												WHERE reagendamentoinstalacao.venda = '".$_GET['id']."'
												ORDER BY reagendamentoinstalacao.id ASC
												
												");
$qntReagendamentos = mysql_num_rows($conReagendamentos);
$i = 0;												
while($Reagendamentos = mysql_fetch_array($conReagendamentos)){

$i++;
?>

<tr <? if($i < $qntReagendamentos){?> style="color:#CCC" <? } ?>>
<td><b>Reagendamento<?= $i;?>:</b></td>
<td><?= $Reagendamentos['dataagendamento'];?></td>
</tr>

<tr <? if($i < $qntReagendamentos){?> style="color:#CCC" <? } ?>>
<td><b>Obs.:</b></td>
<td>
<span style=" <? if($i < $qntReagendamentos){?>color:#CCC; <? } else { ?>color:#787878; <? } ?>font-size:11px;">
<b><?= $Reagendamentos['nomeusuario'];?></b> - <?= $Reagendamentos['dataevento'];?>
</span><br />
<?= $Reagendamentos['obs'];?>

</td>
</tr>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<? } ?>


<? if($linha['data_marcada'] != '' && ($editar == '1')){?>

<tr id="re1">

<td><b>Reagendamento:</b></td>

<td>


<input type="text" name="reagendamento" id="reagendamento" size="20" onKeyUp="validadata(this.value,reagendamento)" onKeyPress="mascara(this,data)" maxlength="10"  />


</td>

</tr>


<tr id="ob1">

<td><b>Obs. Reagend.:</b></td>

<td>

<textarea name="obsreagendamento" rows="3" cols="30"></textarea>

</td>

</tr>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<? } ?>






<?

$conGravacaoRetirada = $conexao->query("SELECT *, 
												usuarios.nome AS nome,
												DATE_FORMAT(log_sistema.data, '%d/%m/%Y às %H:%i:%s') AS dataevento
												FROM log_sistema 
												INNER JOIN usuarios
												ON usuarios.id = log_sistema.usuario
												WHERE  
												log_sistema.evento LIKE '%Excluiu uma gravação%' && 
												log_sistema.evento LIKE '%(ID: ".$_GET['id'].")%' 
												ORDER BY log_sistema.id ASC
										");
										
while($GravacaoRetirada = mysql_fetch_array($conGravacaoRetirada)){										

$gravacaoRE = explode('[',$GravacaoRetirada['evento']);
$gravacaoRE = explode(']',$gravacaoRE[1]);
$gravacaoRE = $gravacaoRE[0];

?>

<tr>
<td><b>Gravação retirada:</b></td>
<td>
<img src="img/play-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Ouvir Gravação" onClick="javascript:window.location = 'http://172.16.0.30/audio/<?= $produto;?>/orig/<?= $gravacaoRE;?>'" /> <span style="font-size:13px;">Ouvir Gravação </span>
<br />
<span style="color:#787878; font-size:11px;">
<b>Retirada por:</b> <?= $GravacaoRetirada['nome'];?>&nbsp;
em <?= $GravacaoRetirada['dataevento'];?>
</span>
</td>
</tr>


<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>


<? } ?>



<tr>

<td><b>Gravação:</b></td>

<td>

<? if($linha['gravacao'] != '') {?>



<img src="img/play-icon.png" width="20" align="absmiddle" style="cursor:pointer" title="Ouvir Gravação" onClick="javascript:window.location = 'http://172.16.0.30/audio/<?= $produto;?>/orig/<?= $linha['gravacao'];?>'" /> <span style="font-size:13px;">Ouvir Gravação </span>

<? } ?>

</td>

</tr>



<tr>

<td><b>Auditor:</b></td>

<td>

<? 

$conAUDITOR = $conexao->query("SELECT * FROM usuarios WHERE id='".$linha['auditor']."'");

$AUDITOR = mysql_fetch_array($conAUDITOR);



echo $AUDITOR['nome'];

?></td>

</tr>



<? if($USUARIO['inserir_gravacao'] == '1' || $USUARIO['tipo_usuario'] == 'LOGISTICA' || $USUARIO['tipo_usuario'] == 'MONITOR' || $USUARIO['tipo_usuario'] == 'COMERCIAL'){?>

<tr>

<td><b>Obs. Gravação:</b></td>

<td>

<? if($_GET['e'] == '1' && $USUARIO['inserir_gravacao'] == '1'){?>



<textarea name="obsgravacao" rows="3" cols="30"><?= $linha['obs_gravacao'];?></textarea>



<? } else{?>



<?= $linha['obs_gravacao'];?>

<input type="hidden" name="obsgravacao" value="<?= $linha['obs_gravacao'];?>" />



<? } ?>

</td>

</tr>

<? } ?>




<tr>
<td><b>Agend. Gravação:</b></td>
<td>
<? 

$dataAgendada0 = explode('-',$linha['agendGravacao']);
$dataAgendada = substr($dataAgendada0[2],0,2).'/'.$dataAgendada0[1].'/'.$dataAgendada0[0];

$horaAgendada0 = explode(':',$linha['agendGravacao']);
$horaAgendada = substr($horaAgendada0[0],-2,2);
$minutoAgendado = $horaAgendada0[1];

if($_GET['e'] == '1' && $USUARIO['inserir_gravacao'] == '1'){
	
?>

<input type="text" name="agendagravacao"  onKeyUp="validadata(this.value,agendagravacao)" onKeyPress="mascara(this,data)" maxlength="10" value="<? if($dataAgendada != '00/00/0000' && $dataAgendada != ''){ echo $dataAgendada;}?>" /> às 
<select name="agendagravacaohora">
<option></option>
<? for($h=8;$h<22;$h++){?>
<option <? if($horaAgendada == sprintf("%02d", $h) && $dataAgendada != '00/00/0000' && $dataAgendada != ''){?>selected="selected"<? } ?>><?= sprintf("%02d", $h); ?></option>
<? } ?>

</select>
<b>:</b>
<select name="agendagravacaominutos">
<option></option>
<? for($m = 00;$m<60;$m++){?>
<option <? if($minutoAgendado == sprintf("%02d", $m) && $dataAgendada != '00/00/0000' && $dataAgendada != ''){?>selected="selected"<? } ?>><?= sprintf("%02d", $m); ?></option>
<? } ?>
</select>

<? } else{?>

<? if($dataAgendada != '00/00/0000'){ echo $dataAgendada; }?> <? if($horaAgendada > 7){ echo ' às '.$horaAgendada.':'.$minutoAgendado; }?>

<? } ?>

</td>
</tr>




<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr>

<td><b>Tipo de Instalação:</b></td>

<td>



<? if($editar == '1') {?>



<select name="tipoinstalacao">

<option value=""></option>

<option value="INTERNA" <? if($linha['tipo_instalacao'] == 'INTERNA'){?>selected="selected"<? } ?>>Interna</option>

<option value="EXTERNA" <? if($linha['tipo_instalacao'] == 'EXTERNA'){?>selected="selected"<? } ?>>Externa</option>

</select>

<? } else { ?>



<?= $linha['tipo_instalacao']; ?>

<input type="hidden" name="tipoinstalacao" value="<?= $linha['tipo_instalacao'];?>" />



</td>



<? } ?>



</td>

</tr>





<tr>

<td><b>Data Finalizada:</b></td>

<td>

<? if($linha['data_instalacao'] != ''){ echo substr($linha['data_instalacao'],6,2)."/".substr($linha['data_instalacao'],4,2)."/".substr($linha['data_instalacao'],0,4);} ?>


</td>
</tr>



<tr>

<td><b>Obs.:</b></td>

<td>
<?= $linha['obs']; ?>
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



<tr>

<td><b>Forma de Pagamento:</b></td>

<td>



<? if($editar == '1') {?>



<select name="pagamento"  onchange="verificapagamento(this.value);">

<option value="BOLETO" <? if($linha['pagamento'] == 'BOLETO'){?>selected="selected"<? } ?>>Boleto</option>

<option value="DÉBITO" <? if($linha['pagamento'] == 'DÉBITO'){?>selected="selected"<? } ?>>Débito</option>

<option value="CARTÃO DE CRÉDITO" <? if($linha['pagamento'] == 'CARTÃO DE CRÉDITO'){?>selected="selected"<? } ?>>Cartão de Crédito</option>


</select>

<? } else { ?>



<?= $linha['pagamento']; ?>



<input type="hidden" value="<?= $linha['pagamento'];?>" name="pagamento" />

</td>



<? } ?>



</td>

</tr>





<tr id="idbanco" <? if($linha['pagamento'] != 'DÉBITO'){?> style="display:none" <? } ?>>

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





<tr id="idpagamentoinstalacao" <? if($linha['pagamento'] == 'DÉBITO'){?> style="display:none" <? } ?>>

<td><b>Pagamento Instalação:</b></td>

<td>



<? if($editar == '1'){?>



<select name="pagamentoinstalacao">

<option value=""></option>

<option value="DINHEIRO" <? if($linha['pagamento_instalacao'] == 'DINHEIRO'){?> selected="selected" <? } ?>>Dinheiro</option>

<option value="CARTÃO DE CRÉDITO" <? if($linha['pagamento_instalacao'] == 'CARTÃO DE CRÉDITO'){?> selected="selected" <? } ?>>Cartão de Crédito</option>

</select>



<? } else { ?>



<?= $linha['pagamento_instalacao'];?>

<input type="hidden" name="pagamentoinstalacao" value="<?= $linha['pagamento_instalacao']; ?>" />



<? } ?>

</td>

</tr>







<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>



<tr>

<td><b>Status:</b></td>

<td>
<?= $linha['status']; ?>
<br>
<br>

</td>

</tr>





<? if($linha['status'] == 'CANCELADO' || $editar_instalacao == '1' || $editar == '1' || ($USUARIO['tipo_usuario'] == 'LOGISTICA' || $USUARIO['tipo_usuario'] == 'MONITOR')){?>

<tr id="mcancel" <? if($linha['status'] != 'CANCELADO'){ ?> style="display:none" <? } ?>>

<td><b>Motivo:</b></td>

<td>

<? if($editar_instalacao == '1' || $editar == '1' || ($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'MONITOR')) { ?>

<select name="motivocancelamento" id="motivocancelamento">

<option value=""></option>

<option value="Inviabilidade Técnica" <? if($linha['motivo_cancelamento'] == 'Inviabilidade Técnica'){?>selected="selected"<? } ?>>Inviabilidade Técnica</option>

<option value="Falta de Dinheiro" <? if($linha['motivo_cancelamento'] == 'Falta de Dinheiro'){?>selected="selected"<? } ?>>Falta de Dinheiro</option>

<option value="Venda Perdida para a Concorrência" <? if($linha['motivo_cancelamento'] == 'Venda Perdida para a Concorrência'){?>selected="selected"<? } ?>>Venda Perdida para a Concorrência</option>

<option value="Desistência do Cliente" <? if($linha['motivo_cancelamento'] == 'Desistência do Cliente'){?>selected="selected"<? } ?>>Desistência do Cliente</option>

<option value="Endereço Não Encontrado" <? if($linha['motivo_cancelamento'] == 'Endereço Não Encontrado'){?>selected="selected"<? } ?>>Endereço Não Encontrado</option>

<option value="Área de Risco" <? if($linha['motivo_cancelamento'] == 'Área de Risco'){?>selected="selected"<? } ?>>Área de Risco</option>

<option value="Cancelado no VSALES" <? if($linha['motivo_cancelamento'] == 'Cancelado no VSALES'){?>selected="selected"<? } ?>>Cancelado no VSALES

</option>

<option value="Número Inválido" <? if($linha['motivo_cancelamento'] == 'Número Inválido'){?>selected="selected"<? } ?>>Número Inválido</option>



</select>

<? } else {?>



<?= $linha['motivo_cancelamento']; ?>



<? } ?>

</td>

</tr>

<? } ?>




<?
// motivo analise

 if($linha['status'] == 'ANÁLISE' || $editar_instalacao == '1' || $editar == '1' || ($USUARIO['tipo_usuario'] == 'LOGISTICA' || $USUARIO['tipo_usuario'] == 'MONITOR')){?>

<tr id="manalise" <? if($linha['status'] != 'ANÁLISE'){ ?> style="display:none" <? } ?>>

<td><b>Motivo:</b></td>

<td>

<? if($editar_instalacao == '1' || $editar == '1' || ($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'MONITOR')) { ?>

<select name="motivoanalise" id="motivoanalise">

<option value=""></option>

<option value="CEP Nulo" <? if($linha['motivo_analise'] == 'CEP Nulo'){?>selected="selected"<? } ?>>CEP Nulo</option>

<option value="Duplicidade" <? if($linha['motivo_analise'] == 'Duplicidade'){?>selected="selected"<? } ?>>Duplicidade</option>

<option value="Tipo de Conta Corrente Inválida" <? if($linha['motivo_analise'] == 'Tipo de Conta Corrente Inválida'){?>selected="selected"<? } ?>>Tipo de Conta Corrente Inválida</option>

<option value="Quarentena" <? if($linha['motivo_analise'] == 'Quarentena'){?>selected="selected"<? } ?>>Quarentena</option>

<option value="Conta Inválida" <? if($linha['motivo_analise'] == 'Conta Inválida'){?>selected="selected"<? } ?>>Conta Inválida</option>

<option value="Endereço Não Encontrado" <? if($linha['motivo_analise'] == 'Endereço Não Encontrado'){?>selected="selected"<? } ?>>Endereço Não Encontrado</option>



</select>

<? } else {?>



<?= $linha['motivo_analise']; ?>



<? } ?>

</td>

</tr>

<? } ?>




<? 

// obs recuperacao

if($linha['obs_recuperacao'] != '' || $editar_instalacao == '1' || $editar == '1' || ($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'MONITOR')){?>

<tr><td colspan="2"><hr size="1" color="#ccc" /></td></tr>

<tr id="obsrecupe" <? if($linha['obs_recuperacao'] == ''){ ?> style="display:none" <? } ?>>

<td><b>Obs. Recuperação:</b></td>

<td>

<? if( (($editar == '1' || $editar_instalacao == '1') || ($_GET['e'] == '1' && $USUARIO['tipo_usuario'] == 'MONITOR')) && $linha['obs_recuperacao'] == '') { ?>

<textarea name="obsrecuperacao" id="obsrecuperacao" rows="3" cols="30"></textarea>

<? } else {?>


<?= $linha['obs_recuperacao']; ?> <br />

<? 

$conVendaRecuperada = $conexao->query("SELECT nome FROM usuarios WHERE id = '".$linha['usuario_recuperacao']."'");
$usuarioRecuperada = mysql_fetch_array($conVendaRecuperada);

$dataRecuperada = substr($linha['data_recuperacao'],8,2).'/'.substr($linha['data_recuperacao'],5,2).'/'.substr($linha['data_recuperacao'],0,4).' às '.substr($linha['data_recuperacao'],11);

?>

<span style="color:#787878; font-size:11px;">
<b>Recuperada por:</b> <?= $usuarioRecuperada['nome'];?>&nbsp;
em <?= $dataRecuperada;?>
</span>



<? } ?>

</td>

</tr>

<? } ?>






</form>

</table>
