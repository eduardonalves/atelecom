<? include "../conexao.php";



session_start();





// Verificar se está logado

if(isset($_SESSION['usuario']) || $redirect == '1'){ ?>

	

<script type="text/javascript">

window.location = 'adm'

</script>	

	

	

<? } 



if(isset($_POST['login'])){

	

// Login e Senha postada	

$login = $_POST['login'];

$senha = md5($_POST['senha']);





// Consulta se usuario existe e se a senha esta correta

$consulta = $conexao->query("SELECT * FROM usuarios WHERE login = '".$login."' && senha = '".$senha."' && status != 'DESLIGADO'");

$linha = mysql_fetch_array($consulta);





// Confere se usuario tem permissão para acesso externo

if($linha['tipo_usuario'] == 'ADMINISTRADOR' || $linha['tipo_usuario'] == 'LOGISTICA' || $linha['tipo_usuario'] == 'MONITOR'){



$linhaIP = 1;	



	

} else{

	

// Consulta se o IP é permitido	

$ip = $_SERVER["REMOTE_ADDR"];	

$consultaIP = $conexao->query("SELECT * FROM ip_externo where ip = '".$ip."'");

$linhaIP = mysql_fetch_array($consultaIP);



}





// Se o usuario e a senha não estiverem corretos

if($linha == 0){ $erro = "1";} 



// Se o IP não for permitido

else if($linhaIP == 0){ $erro = "2"; }



else{

	

// Se tudo estiver correto, inicia a sessão

$_SESSION['usuario'] = $linha['id'];





//LOG ENTRADA

$data = date("Y-m-d H:i:s");

$insert_entrada = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$linha['id']."','Entrou no sistema.')");



$redirect = '1';



?>



<script type="text/javascript">

window.location = 'adm'

</script>



<?



}



	

}



?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

	    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<title>Vento Admin</title>

		

		<style type="text/css">



body{  background:url(img/bg.jpg) repeat-x; background-color:#9ae4ff;

margin:0 0 0 0; font-family:Arial, Helvetica, sans-serif; height:100%; }



#logo{ position:absolute; width:300px; margin: 0 0 0 -160px; left:50%; top:20px; z-index:5;}



#login{ position:absolute; width:300px; margin: 0 0 0 -150px; left:50%; top:140px; z-index:5;}



input[type="text"], input[type="password"]{ width:100%; height:37px; border:0px; padding-left:3px; background:none;}



.field{ background:#FFF; }



input[type="submit"]{ width:100%; height:45px; border:1px solid #CCC; color:#545454; font-size:17px; font-weight:bold; cursor:pointer;

background: #e3e3e3; /* Old browsers */

/* IE9 SVG, needs conditional override of 'filter' to 'none' */

background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Q4ZDhkOCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjM3JSIgc3RvcC1jb2xvcj0iI2VlZWVlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjcwJSIgc3RvcC1jb2xvcj0iI2YxZjFmMSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlM2UzZTMiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);

background: -moz-linear-gradient(top,  #d8d8d8 0%, #eeeeee 37%, #f1f1f1 70%, #e3e3e3 100%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#d8d8d8), color-stop(37%,#eeeeee), color-stop(70%,#f1f1f1), color-stop(100%,#e3e3e3)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #d8d8d8 0%,#eeeeee 37%,#f1f1f1 70%,#e3e3e3 100%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #d8d8d8 0%,#eeeeee 37%,#f1f1f1 70%,#e3e3e3 100%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #d8d8d8 0%,#eeeeee 37%,#f1f1f1 70%,#e3e3e3 100%); /* IE10+ */

background: linear-gradient(to bottom,  #d8d8d8 0%,#eeeeee 37%,#f1f1f1 70%,#e3e3e3 100%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d8d8d8', endColorstr='#e3e3e3',GradientType=0 ); /* IE6-8 */

}





.loginInv{ position:absolute; background-color:#ffc2c2; color:#900; font-weight:bold; width:100%; padding-top:5px; padding-bottom:5px; left:0px;}



.clouds{ position:fixed; background:url(img/nuvens.png) 0 0 repeat-x; width:100%; min-height:100%;}



</style>

<link rel="shortcut icon" href="favicon.ico" />

	</head>



	<body>

	

		<div id="logo"><img src="img/LOGO-VENTO-p.png" /></div>

		<div class="clouds"></div>



<div id="login">

<form name="logar" action="" method="post">

<table border="0" width="300px" cellpadding="0" cellspacing="0">

<tr class="field">

<td width="29px"><img src="img/user-icon.jpg" /></td>

<td><input type="text" name="login" placeholder="USUÁRIO" ></td>

</tr>



<tr height="10px">

<td colspan="2"></td>

</tr>



<tr class="field">

<td width="29px"><img src="img/pass-icon.jpg" /></td>

<td><input type="password" name="senha" placeholder="SENHA"></td>

</tr>



<tr height="10px">

<td colspan="2"></td>

</tr>



<tr align="center">

<td colspan="2">

<input type="submit" name="entrar"  value="ENTRAR" />

<br /><br />

<? if($erro == '1'){?> <span class="loginInv">Login ou Senha inválido!</span><? } ?>

<? if($erro == '2'){?> <span class="loginInv">Acesso Negado!</span><? } ?>

</td>

</tr>







<tr height="50px" valign="bottom" align="center" style="font-size:10px; color:#3d829f;">

<td colspan="2">VERSÃO MOBILE 1.0 - VENTO CONSULTING &copy; 2013</td>

</tr>



</table>

</form>

</div>

		

	</body>

</html>