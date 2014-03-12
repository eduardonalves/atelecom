<? include "../conexao.php"; 







$pagina = $_GET['p'];







if($pagina == ''){ $pagina = 'home';}







session_start();







// Verificar se está logado







if(!isset($_SESSION['usuario'])){ ?>







<script type="text/javascript">







window.location = 'index'







</script>	











<? } 







$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");



$USUARIO = mysql_fetch_assoc($conUSUARIO);

if($USUARIO['tipo_usuario'] == 'MONITOR'){ $loginMONITOR = $USUARIO['id'];}














if($_GET['action'] == "nomobile"){



	



$_SESSION['nomobile'] = 1;	

header('Location: http://vem.vento-consulting.com/');



	



}











?>



























<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<title>Vento Admin</title>



<link rel="stylesheet" type="text/css" href="css/style.css" />



<link rel="shortcut icon" href="favicon.ico" />







</head>







<body>







<div id="top">



<center>



<table border="0" cellpadding="0" cellspacing="0" width="99%">



<tr align="center">



<td width="55px"><? if(isset($_GET['p']) && $_GET['p'] != 'menu'){ ?><img src="img/voltar-bt.png" border="0" onClick="javascript: history.go(-1)" style="cursor:pointer" /> <? } ?></td>



<td><img src="img/logo-topo.png" onClick="window.location = 'adm'" /></td>



<td width="55px"><a href="sair.php"><img src="img/sair-bt.png" border="0" /></a></td>



</tr>



</table>



</center>



</div>















<!-- <iframe width="100%" height="100%" frameborder="0" src="<? if(isset($_GET['p']) && $_GET['p'] != 'menu'){ echo $_GET['p'].".php"; } else { echo "menu.php";  }?>?pro=<?= $_GET['pro'];?>"></iframe> -->







<div id="content">



<? if(isset($_GET['p']) && $_GET['p'] != 'menu'){ include $_GET['p'].".php"; } else { include "menu.php";  }?>



</div>







<div id="footer">



<table border="0" width="100%" cellpadding="0" cellspacing="0">



<tr align="center">



<td> &nbsp; VERSÃO MOBILE 1.0 - VENTO CONSULTING © 2013 <br /> 



<a href="?action=nomobile">Ir para VERSÃO CLÁSSICA</a></td>



<td width="35px" align="left"><img src="img/config-bt.png" /></td>



</tr>



</table>



</div>







</body>



</html>
