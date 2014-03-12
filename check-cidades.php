<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<select type="text" id="cidade" name="cidade">
<option value=""></option>
<? 

include "conexao.php";

$conCIDADE = $conexao->query("SELECT * FROM tb_cidades WHERE uf = '".$_GET['uf']."' ORDER BY nome ASC");
while($CIDADE = mysql_fetch_array($conCIDADE)){

?>

<option value="<?= $CIDADE['nome'];?>">
<?= $CIDADE['nome'];?>
</option>

<? } ?>

</select> <span class="campoobrigatorio" title="Campo Obrigatório">*</span>

<span class="erro" id="ecidade" style="display:none">Por favor, selecione a cidade da instalação!</span>
