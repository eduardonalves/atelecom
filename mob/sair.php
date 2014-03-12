<?





include "../conexao.php";



session_start();



$data = date("Y-m-d H:i:s");



//LOG ENTRADA



$insert_entrada = $conexao->query("INSERT into log_sistema (data,usuario,evento) VALUES ('".$data."','".$_SESSION['usuario']."','Saiu do sistema.')");





session_destroy();





?>





<script type="text/javascript">

window.location = 'index'

</script>	