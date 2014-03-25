<?
date_default_timezone_set("Brazil/East");
session_start();


if(!isset($_SESSION['nomobile'])){

include_once "includes/ifmobile.php";

}

include_once "conexao.php";

// Verificar se recebeu a token de redefinição de senha

if(isset($_GET['token'])){
	
	$token = explode('.', $_GET['token']); //Divide a token
	
	$hash = $token[0].".".$token[1]; //pega o hash
	$time = $token[1]; //pega a hora
	
	//Se passaram 5 minutos desde a geração do hash o link expira
	if((time() - $time > 300) || ($time > time()))
		die("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /> <meta http-equiv='refresh' content='3; URL=http://atelecom.vento-consulting.com/' /> <script> alert('Este link expirou. Solicite um novo link para redefinição de sua senha.'); </script>");
	
	//Se as senhas foram devidamente recebidas...
	if(isset($_POST['novasenha']) && isset($_POST['confirmarsenha'])){
		
		$senha = md5($_POST['novasenha']); //gera uma nova senha md5
		
		$redefine_senha = $conexao->query("UPDATE usuarios SET senha = '".$senha."' WHERE hash = '".$hash."'"); //atualiza a senha no registro que corresponde ao hash recebido
		
		if($redefine_senha){
			echo("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /> <meta http-equiv='refresh' content='0; URL=http://atelecom.vento-consulting.com/' /> <script> alert('Senha alterada com sucesso!'); </script>");
		}
		else
			die("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /> <meta http-equiv='refresh' content='0; URL=http://atelecom.vento-consulting.com/' /> <script> alert('Ocorreu um erro ao processar pedido de redefinição de senha.'); </script>");
		}
		
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Vento Admin</title>

</head>



<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

<script type="text/javascript">

$(document).ready(function(e) {

    $('#loginbg').animate({left:'50%',opacity:'1'},1000);

});

function verificasenhas(senha1, senha2){
	
	if(senha1 != senha2){
		$(function(){$('#erro').css('display','');});
	}
	else
		document.forms['redefinir'].submit();
	
	}

</script>

<style type="text/css">

body{background:url(img/bg.jpg) top repeat-x; margin:0 0 0 0; font-family:Arial, Helvetica, sans-serif;}

#nuvens{background:url(img/nuvens.png) top repeat-x; width:100%;

height:500px; top:0px;}

#loginbg{position:absolute; width:500px; height:300px; background:url(img/vento-login-bg.png) no-repeat; margin:-150px 0 0 -250px;

left:0%; top:50%; opacity:0;

}

#formlogin{position:absolute; bottom:30px; left:50%; width:260px; margin: 0 0 0 -130px;}

</style>

<body>

<link rel="shortcut icon" href="img/icone.ico" />

<div id="nuvens">

</div>

<div id="loginbg">

<div id="formlogin">

<table border="0">

<form name="redefinir" action="" method="post">

<tr>

<td>Nova Senha:</td>

<td><input type="password" name="novasenha" id="novasenha" size="25" /></td>

</tr>

<tr>

<td>Confirmar Senha:</td>

<td><input type="password" name="confirmarsenha" id="confirmarsenha" size="25" /></td>

</tr>

<tr>

<td></td>

<td><input type="button" name="enviar" value="Enviar" onclick="verificasenhas(document.getElementById('novasenha').value, document.getElementById('confirmarsenha').value)"/><span style="color:#006; font-size:12px; font-weight:bold; display: none;" id='erro'> As senhas não correspondem.</span>
</td>

</tr>

</form>

</table>

</div>

</div>

</body>

</html>
