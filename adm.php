<? 
include_once "conexao.php";

date_default_timezone_set("Brazil/East");

//header("Content-type: text/html; charset=UTF-8", true);


error_reporting(0);

session_start();

spl_autoload_register("autoload");

function autoload($class) {
    
    
    include_once "lib/class." . $class . ".php";

}


if(!isset($_SESSION['nomobile'])){

include_once "includes/ifmobile.php";

}


$pagina = $_GET['p'];



if($pagina == ''){ $pagina = 'home';}


$conUSUARIO = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_SESSION['usuario']."'");

$USUARIO = mysql_fetch_assoc($conUSUARIO);


include_once "lib/class.Usuarios.php";
include_once "lib/class.VentoAdmin.php";
include_once "lib/class.Venda.php";
include_once "lib/class.VendaStatus.php";

// ---->>>>>>>> atualiza logon aquiii


//$genLogon = new Logon($conexao);
//$genLogon->tempo_expiracao = 60; // Tempo em minutos para expiracao de login
//$genLogon->atualizarLogon($_SESSION['lgnid'], $USUARIO['login'], $USUARIO['nome']);



// Verificar se está logado

if(!isset($_SESSION['usuario'])){ ?>

	

<script type="text/javascript">

window.location = 'index.php'

</script>	

	

	

<? } 





?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" height="100%">

<head>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<title>Vento Admin</title>


<!-- 
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
 -->
 
 <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/geral.css" />


<script type="text/javascript">



<? if($_GET['a'] == '1'){?>

$(document).ready(function(e) {



    $('#loginbg').animate({top:'55%',opacity:'1'},1500, function(){

    $('#loginbg').animate({top:'-20%',opacity:'0'},1000, function(){  

	$('#pagina').fadeIn(500); }); 

	

	});

});

<? } else {?>



$(document).ready(function(e) {

  

	$('#pagina').fadeIn(1);

	



});



<? } ?>

function sldown(id){

	

	$(id).stop().animate({height:'80px',opacity:'1'}, 500);

	

	

	}



function slup(id){

	

	$(id).stop().animate({height:'0px',opacity:'0'}, 500);

	

	}

	



	

</script>



<style type="text/css">



body{background:url(img/bg.jpg) top repeat-x; margin:0 0 0 0; font-family:Arial, Helvetica, sans-serif;}



#nuvens{position:absolute; background:url(img/nuvens.png) top repeat-x; width:100%;

height:500px; top:0px;}



#loginbg{position:absolute; width:500px; height:300px; background:url(img/vento-login-bg.png) no-repeat; margin:-150px 0 0 -250px;

left:50%; top:50%; opacity:1; z-index:1000;

}



#formlogin{position:absolute; bottom:50px; left:50%; width:260px; margin: 0 0 0 -130px; z-index:1000;}





/* fim login */







</style>



<link rel="shortcut icon" href="favicon.ico" />



</head>

<?php flush(); ?>

<body height="100%" onLoad="slup('#opcoes');loadpage();">



<div id="nuvens"></div>





<? if($_GET['a'] == '1'){?>

<!-- login -->



<div id="loginbg">



<div id="formlogin">



<table border="0" width="100%">



<tr align="center">

<td style="color:#006; font-weight:bold; font-size:20px">Bem Vind<? if($USUARIO['sexo'] == 'F'){ echo 'a';} else { echo 'o';}?>!</td>

</tr>



<tr align="center">

<td style="color:#006; font-weight:bold; font-size:28px"><?= $USUARIO['nome']; ?></td>

</tr>





</table>

</div>



</div>



<!-- fim login -->



<? } ?>



<div id="pagina" <? if($_GET['a'] == 1){?> style="display:none;" <? } ?>>



<div id="topobg">



<div id="topo">



<div id="logo">

<img src="img/LOGO-VENTO-p.png" border="0" style="cursor:pointer" onClick="window.location = 'adm'" />

</div>



<div id="usuario" onClick="sldown('#opcoes')" onMouseOut="slup('#opcoes')">

<table border="0">

<tr>

<td width="45px" align="left"><? if($USUARIO['foto'] != ''){ ?> <img src="img/fotos/<?= $USUARIO['foto'];?>.jpg" /> <? } else { ?><img src="img/U-<? if($USUARIO['sexo'] == 'F'){ echo 'F';} else { echo 'M';}?>.jpg" /> <? } ?></td>

<td style="font-size:14px;"><?= $USUARIO['nome']; ?></td>

<td width="18px" align="center"><img src="img/seta1.png" title="Opções" /></td>

</tr>

</table>



<div id="opcoes" onMouseOver="sldown('#opcoes')" >



<table border="0" width="100%" style="font-size:12px">



<tr>

<td><hr size="1" color="#CCCCCC" /></td>

</tr>



<tr align="center" class="opcoes">

<td onClick="window.location = '?p=configuracoes'">CONFIGURAÇÕES</td>

</tr>



<tr>

<td><hr size="1" color="#CCCCCC" /></td>

</tr>



<tr align="center" class="opcoes">

<td onClick="window.location = 'sair'">SAIR</td>

</tr>



<tr height="5px">

<td></td>

</tr>



</table>





</div>





</div>

</div>

</div>





<!-- 

/////////////////////

////////MENU/////////

/////////////////////

-->



<div id="menu">

<table border="0" align="center" height="45px" cellpadding="0" cellspacing="0" style="cursor:pointer;">



<tr align="center">



<td class="<? if($pagina == '' || $pagina == 'home'){?>menuselected<? } else{ ?>menu<? } ?>" onClick="window.location = '?p=home'">&nbsp; &nbsp; HOME &nbsp; &nbsp;</td>



<?



if($USUARIO['grupo'] == ''){



$conMENU = $conexao->query("SELECT * FROM menu ORDER BY ordem");

while($MENU = mysql_fetch_array($conMENU)){ ?>



<td class="<? if(strstr($pagina,$MENU['link'])){?>menuselected<? } else { ?>menu<? } ?>" onClick="window.location = '?p=<?= $MENU['link'] ?>'">&nbsp; &nbsp; <?= strtoupper($MENU['menu']); ?> &nbsp; &nbsp;</td>

<? }

} else{

	

$conGRUPO = explode('|',$USUARIO['grupo']);



for($i=0;$i<count($conGRUPO);$i++){

	

$conMENU = $conexao->query("SELECT * FROM menu WHERE grupo = '".$conGRUPO[$i]."' ORDER BY menu.ordem");

$MENU = mysql_fetch_array($conMENU);



?>

<td class="<? if(strstr($pagina,$MENU['link'])){?>menuselected<? } else { ?>menu<? } ?>" onClick="window.location = '?p=<?= $MENU['link'] ?>'">&nbsp; &nbsp; <?= strtoupper($MENU['menu']); ?> &nbsp; &nbsp;</td>



<? }} ?>



<td></td>

</tr>



</table>

</div>



<div id="conteudo">

<?

	

include_once $pagina.".php";





?>



</div>





<div id="rodape">

<table align="center" height="34px"><tr valign="middle"><td class="rodape">

Vento Consulting &copy; 2013 - versão 2.0

</td></tr></table>

</div>

</div>

<div id="loggg">
</div>


</body>

</html>

