<?

date_default_timezone_set("Brazil/East");

session_start();

include "conexao.php";



// Verificar se está logado

if(!isset($_SESSION['usuario'])){ ?>

	

<script type="text/javascript">

window.location = 'index.php'

window.close();

</script>	
<? } 


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");

$USUARIO = mysql_fetch_array($conUSUARIO);

if($_GET['id']){

$consulta = $conexao->query("SELECT * FROM vendas_clarotv WHERE id = '".$_GET['id']."'");

$linha = mysql_fetch_array($consulta);

} else { ?>

		

<script type="text/javascript">



window.alert('Venda não encontrada!');

window.close();



</script>



	

<? }









if(isset($_POST['upload'])){

	



$auditorpost = $_POST['auditor'];



$arquivo = $_POST["nome_arquivo"];



if($_POST["uploaded"]){ 



$update = $conexao->query("UPDATE vendas_clarotv SET gravacao = '".$arquivo."', auditor = '".$auditorpost."' WHERE id = '".$_GET['id']."'");



//LOG



$datadehoje = date("Y-m-d H:i:s");

$insert_log = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$datadehoje."','".$_SESSION['usuario']."','Inseriu uma nova gravação no sistema (ID: ".$_GET['id'].").')");



?>

	

<script type="text/javascript">



window.alert('O arquivo "<?= $gravacao ?>" foi enviado com sucesso!');

window.location = 'http://vem.vento-consulting.com/detalhes-venda-oi.php?id=<?= $_GET['id'];?>';

</script>	



<?


	

	}


}
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>UpLoad Gravação</title>

</head>



<body style="font-family:Arial, Helvetica, sans-serif">





<table border="0" width="100%">



<tr valign="bottom" height="40px">

<td style="font-size:18px; color:#999">INSERIR GRAVAÇÃO</td>

</tr>



<tr>

<td><hr size="1" color="#CCCCCC" /></td>

</tr>



</table>



<table border="0">

<form name="gravacoes" action="http://172.16.0.30/vento-adm/upload-gravacao-simples-oi-br.php?id=<?php echo $_GET["id"]?>" enctype="multipart/form-data" method="post">







<tr>

<td>Contrato:</td> <td><input type="text" readonly="readonly" size="40" name="contrato" value="<?= $linha['contrato'];?>" /></td>

</tr>



<tr>

<td>Cliente:</td> <td><input type="text" readonly="readonly" size="40" name="cliente" value="<?= strtoupper($linha['nome']);?>" /></td>

</tr>



<tr>

<td>Telefone:</td> <td><input type="text" readonly="readonly" size="40" name="telefone" value="<?= $linha['telefone'];?>" /> <span style="color:#999; font-size:12px;">(DBM)</span></td>

</tr>



<tr height="50px" valign="bottom">

<td>Gravação:</td> <td><input type="file" name="gravacao[]" size="40" /></td>

</tr>





<tr align="left">

<td>Auditor:</td> 

<td>

<select name="auditor">

<option value=""></option>

<? $conAUDITOR = $conexao->query("SELECT * FROM usuarios WHERE tipo_usuario='AUDITOR' ORDER BY nome ASC");

while($AUDITOR = mysql_fetch_array($conAUDITOR)){

?>

<option value="<?= $AUDITOR['id'];?>" <? if($USUARIO['id'] == $AUDITOR['id']){ ?> selected="selected" <? }?>><?= $AUDITOR['nome'];?></option>

<? } ?>

</select>

</td>

</tr>



<tr id="uploadid" height="40px" valign="bottom">

<td></td>

<td><input type="submit" name="upload" value="Enviar" /></td>

</tr>



</form>

</table>



</body>

</html>
