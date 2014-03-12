<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<? 

include "conexao.php";

$conSUPERVISORES = $conexao->query("SELECT * FROM usuarios WHERE id = '".$_GET['monitor']."' && status != 'DESLIGADO'");


?>
<span><? echo $conSUPERVISORES['supervisor']; ?></span>
<input type="text" value="<? echo $conSUPERVISORES['supervisor'];?>"/>


