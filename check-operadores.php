<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<select type="text" id="operador" name="operador">
<option value=""></option>
<? 

include "conexao.php";

$conOPERADORES = $conexao->query("SELECT * FROM operadores WHERE grupo LIKE '%".$_GET['g']."%' && monitor = '".$_GET['m']."' && status != 'DESLIGADO' ORDER BY nome ASC");
while($OPERADORES = mysql_fetch_array($conOPERADORES)){

?>

<option value="<?= $OPERADORES['operador_id'];?>" <? if($_GET['o'] == $OPERADORES['operador_id']){?> selected="selected" <? } ?>>
<?= $OPERADORES['nome'];?>
</option>

<? } ?>

</select> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="eoperador" style="display:none">Por favor, selecione o operador que fez a venda!</span>