
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Vento Admin</title>

</head>



<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

<style type="text/css">



body{background:url(img/bg.jpg) top repeat-x; margin:0 0 0 0; font-family:Arial, Helvetica, sans-serif;}



#nuvens{background:url(img/nuvens.png) top repeat-x; width:100%;

height:500px; top:0px;}


left:0%; top:50%; opacity:0;

}



#formlogin{position:absolute; bottom:30px; left:50%; width:260px; margin: 0 0 0 -130px;}

</style>



<body>

<link rel="shortcut icon" href="img/icone.ico" />
<div id="nuvens">

</div>

<div id="intall-box" style=" padding:10px; text-align:center; border:#7F7F7F 1px solid; position: relative; height:300px; background-color:#FFFFFF; width:700px; margin-left:auto; margin-right:auto; top:50%; margin-top:-300px;">
	<img src="img/stop.png" alt="Computador sem acesso" style="width:100px; margin-top:20px;" />
	<h3 style="color:#A52A2A;">Este computador não possui autorização de acesso ao sistema.</h3>
	<br />
	<span style="font-size:13px;">
	Você possui <?php echo $this->quantidades['disponiveis']; ?> de <?php echo $this->quantidades['total']; ?> passaportes disponíveis. Você deseja instalar um passaporte para esta maquina ?
	</span>
	<br />
	<br />
	<br />
	<?php if ($this->quantidades['disponiveis'] > 0) {
		 ?>
	<form action="index.php" method="post" name="add-passaporte">
	<input type="hidden" name="passaction" value="add">
	<span style="font-size:13px;">
	<label for="ckid">Número do passaporte: </label><input type="text" name="ckid" style="margin-right:0px" />
	</span>
	<input type="submit" value="Instalar Passaporte " style=" border: 1px solid #7F7F7F; cursor:pointer;" />
	</form>
	<?php } else { ?>
	
	<span style="font-size:13px; color:#A52A2A;">
	Você já instalou todos os passaportes disponíveis para sua versão. <br />Caso deseje adquirir passaportes, entre em contato com o revendedor.
	</span>
	<?php } ?>
</div>

</body>
</html>
