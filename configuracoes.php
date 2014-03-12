
<?
header("Content-type: text/html; charset=UTF-8", true);
if(isset($_POST['nome'])){
	
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);


if(!$nome || !$email || !$senha){
	
?>

<script type="text/javascript">

window.alert("ERRO: Todos os campos devem ser preenchidos");


</script>

<?	
	
}else{


$inserir = $conexao->query("UPDATE usuarios SET nome = '".$nome."', email = '".$email."', senha = '".$senha."' WHERE id = '".$USUARIO['id']."'") or die("Erro ao atualizar os dados!");

?>

<script type="text/javascript">

window.alert("Configurações realizadas com sucesso!");

window.location = '?p=configuracoes';
</script>

<?
	
}}


//////////////////////////////////
//////Menu Lateral Labels///////
//////////////////////////////////

$es1 = 'Dados de Usuário';
$es2 = 'Definir Metas';
$es3 = 'Lista Operadores';
$es4 = 'Status Portal';
$es5 = 'Lista Usuários';

?>


<style type="text/css">

input[type="submit"]{ padding:7px; border:1px solid #CCC; color:#777;
 background: #ededed; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSI4JSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUzJSIgc3RvcC1jb2xvcj0iI2ZjZmNmYyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlZGVkZWQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #ffffff 8%, #fcfcfc 53%, #ededed 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(8%,#ffffff), color-stop(53%,#fcfcfc), color-stop(100%,#ededed)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ffffff 8%,#fcfcfc 53%,#ededed 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 ); /* IE6-8 */
}

input[type="submit"]:hover{ border:1px solid #AAA; color:#434343; cursor:pointer;}

input[type="submit"]:active{ background:#ededed;}

</style>


<center>

<table border="0" width="100%">
<tr>
<td>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr valign="top">

<!-- /////////// Menu Lateral ////////// -->
<td class="menulateral" width="189px" bgcolor="#999999">

<table width="100%" id="mlateral" border="0" cellpadding="0" cellspacing="0">

<tr height="100px">
<td></td>
</tr>

<tr height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=1'" class="<? if($_GET['es'] == '1' || $_GET['es'] == ''){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es1; ?></td>
</tr>

<? if($USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){?>
<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=2'"  class="<? if($_GET['es'] == '2'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es2; ?></td>
</tr>
<? } ?>

<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=3'"  class="<? if($_GET['es'] == '3'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es3; ?></td>
</tr>


<? if($USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){?>
<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=5'"  class="<? if($_GET['es'] == '5'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es5; ?></td>
</tr>
<? } ?>

<!--  if invalidado para desabilitar modulo qualidade -->
<? if($USUARIO['tipo_usuario'] == 'ADMINISTRADOR' && 1==2){?>
<tr  height="35px" style="cursor:pointer" onclick="window.location='?p=<?= $_GET['p'];?>&m=<?= $_GET['m'];?>&an=<?= $_GET['an'];?>&es=4'"  class="<? if($_GET['es'] == '4' || $_GET['es'] == '4-update'){ ?>menulateralselected<? } else { ?>menulateral<? } ?>">
<td> &nbsp;  &nbsp; <?= $es4; ?></td>
</tr>
<? } ?>

</table>

</td>

<td>

<? if($_GET['es'] == '1' || !$_GET['es']){ ?>
<center>
<table width="90%" border="0" height="500px">
<tr valign="top">
<td>

<table width="1000px" border="0" align="center">

<form name="config" action="" method="post">
<tr height="60px" valign="bottom" align="left">
<td colspan="2" style=" font-size:18px; color:#999; font-weight:bold">Configura&ccedil;&otilde;es <hr size="1" color="#CCCCCC" /></td>
</tr>


<tr align="left">
<td>Nome:</td>
<td><input type="text" name="nome" value="<?= $USUARIO['nome']; ?>" size="40"></td>
</tr>

<tr align="left">
<td>Email:</td>
<td><input type="text" name="email" value="<?= $USUARIO['email']; ?>" size="40"></td>
</tr>



<tr align="left">
<td>Login:</td>
<td><?= $USUARIO['login']; ?></td>
</tr>

<tr align="left">
<td>Senha:</td>
<td><input type="password" name="senha" value="" size="40"></td>
</tr>

<tr height="50px" valign="bottom" align="left">
<td></td>
<td><input type="submit" name="salvar" value="Salvar" /></td>
</tr>
</form>
</table>

</td></tr></table>
</center>

<? } else if($_GET['es'] == '2' && $USUARIO['tipo_usuario'] == 'ADMINISTRADOR'){ include "definir-metas.php"; } 

else if($_GET['es'] == '3'){ include "lista-operadores.php"; } 

else if($_GET['es'] == '5'){ include "lista-usuarios.php"; } 

else if($_GET['es'] == '4'){ include "status-portal.php"; } 

else if($_GET['es'] == '4-update'){ include "status-portal-update.php"; } 

?>

</td>
</tr>
</table>
</center>
