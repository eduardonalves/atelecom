<?
date_default_timezone_set("Brazil/East");
session_start();


require_once('lib/class.Logon.php');
require_once('lib/class.PassaporteDeAcesso.php');
/*
$passaporte = new PassaporteDeAcesso($conexao);
$passaporte->validarMaquina();
*/




if(!isset($_SESSION['nomobile'])){

include_once "includes/ifmobile.php";

}



include_once "conexao.php";








// Verificar se está logado

if(isset($_SESSION['usuario'])){ ?>

	

<script type="text/javascript">

window.location = 'adm'

</script>	

	

	

<? } 



if(isset($_POST['login'])){

if(!$_POST['resetarsenha']){

$login = $_POST['login'];

$senha =  md5($_POST['senha']);



$consulta = $conexao->query("SELECT * FROM usuarios where login = '".$login."' && senha = '".$senha."' && status != 'DESLIGADO'");

$linha = mysql_fetch_array($consulta);



if($linha == 0){ $erro = "1";} else{


$_SESSION['usuario'] = $linha['id'];

// Cria logon aqui


$genLogon = new Logon($conexao);
$genLogon->maxLogons = 8; // Numero maximo de logins simultaneos
$genLogon->efetuarLogon($linha['login'], $linha['nome'] );


$data = date("Y-m-d H:i:s");



//LOG ENTRADA


$insert_entrada = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$linha['id']."','Entrou no sistema.')");


?>



<script type="text/javascript">

window.location = 'adm?a=1';

</script>



<?

}

}

else{
	
	$email = $_POST['email'];
	
	//echo $email;
	
	//Verificar se o endereço está cadastrado no sistema.
	
	$consulta = $conexao->query("SELECT * from usuarios where email = '".$email."'");
	
	$linha = mysql_fetch_array($consulta);
	
	if($linha == 0){
		die("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />ERRO: e-mail não cadastrado no sistema.");}
	else{
		require_once("lib/PHPMailer-master/class.phpmailer.php");
		$mail = new PHPMailer();

		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->SMTPDebug = 2; // 2 to enable SMTP debug information 
		$mail->SMTPAuth = TRUE; // enable SMTP authentication
		$mail->SMTPSecure = "ssl"; //Secure conection
		$mail->Port = 465; // set the SMTP port
		$mail->Username = "email@gmail.com"; // SMTP account username
		$mail->Password = "senha"; // SMTP account password
		$mail->Host     = "smtp.gmail.com"; // SMTP server
		$mail->CharSet  = "UTF-8";
		
		$mail->From     = "email@gmail.com";
		$mail->FromName = "Vento Admin";
		$mail->AddAddress($email, "Usuário(a)");

		$mail->Subject  = "Vento Admin - Redefinição de Senha";
		$mail->Body     = "Olá Usuário(a)! \n\nAcesse o link a seguir para completar o processo de redefinição de sua senha no Vento Admin. \n\nLink: \n\nSe você não solicitou redefinição de senha no Vento Admin, por favor desconsidere este e-mail.";
		$mail->WordWrap = 50;

		if($mail->Send())
			echo "E-mail enviado com sucesso";
		else
			echo "Erro ao enviar e-mail, tente novamente mais tarde.";
		
		$mail->SmtpClose();
}
	
	
	//Caso esteja, enviar e-mail com link para resetar senha.
	
	//Se não estiver cadastrado, informar na tela e recarregar página.
	
	
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

function esquecisenha(str){
	
	if(str=='esqueci'){
		$(".camposlogin").css('display','none');
		$("#login").val('');
		$("#senha").val('');
		$(".campossenha").css('display','');
		$("#resetarsenha").val(true);
	}
	else if(str=='voltar'){
		$(".campossenha").css('display','none');
		$("#email").val('');
		$(".camposlogin").css('display','');
		$("#resetarsenha").val(false);
		}
	
	}
	
function validaEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function enviarEmail(email){
	
	if(validaEmail(email))
		document.forms['logar'].submit();
	else
		alert('Endereço de e-mail Inválido!');
	
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

<form name="logar" action="" method="post">

<input type="hidden" name="resetarsenha" id="resetarsenha">

<tr class="camposlogin">

<td>Login:</td>

<td><input type="text" name="login" id="login" size="25" /></td>

</tr>



<tr class="camposlogin">

<td>Senha:</td>

<td><input type="password" name="senha" id="senha" size="25" /></td>

</tr>

<tr class="campossenha" style="display: none;">

<td>E-mail:</td>

<td><input type="text" name="email" id="email" size="25" /></td>

</tr>

<tr class="campossenha" style="display: none;">

<td></td>

<td style="color:#006; font-size:12px; font-weight:bold">Entre com seu endereço de e-mail. <br />Encaminharemos um link para resetar sua senha.</td>

</tr>

<tr class="camposlogin">

<td></td>

<td><input type="submit" name="entrar" value="Entrar" /> <? if($erro == '1'){?><span style="color:#006; font-size:12px; font-weight:bold">Login ou Senha inválido!</span><? } ?>
<a href="#" onclick="esquecisenha('esqueci')" style="font-size: 70%; float: right;"> Esqueci minha senha</a>
</td>

</tr>

<tr class="campossenha" style="display: none;">

<td></td>

<td><input type="button" name="enviar" value="Enviar" onclick="enviarEmail(document.getElementById('email').value)"/> <? if($errosenha == '1'){?><span style="color:#006; font-size:12px; font-weight:bold">E-mail inválido!</span><? } ?>
<a href="#" onclick="esquecisenha('voltar')" style="font-size: 70%; float: right;"> Voltar</a>
</td>

</tr>

</form>

</table>

</div>



</div>



</body>

</html>
