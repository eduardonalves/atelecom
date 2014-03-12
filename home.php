<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="css/dashboard_style.css" />
<link rel="stylesheet" type="text/css" href="css/tables.css" />
<link rel="stylesheet" type="text/css" href="css/geral.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>

<script type="text/javascript">



//////////////////////////////////////////
//////////////////////////////////////////


$(document).ready(function(){ 	
	  function hideResponse(){
		  setTimeout(function(){
		  $("#response").fadeOut("slow", function () {
	  });
	
}, 2000);}
	
	$("#response").hide();
	$(function() {
	$("#list .sections").sortable({ opacity: 0.5, cursor: 'move',update: function() {
			var order = $(this).sortable("serialize") + '&update=order'; 
			$.post("dashboard-update.php", order, function(response){
				$("#response").html(response);
				$("#response").fadeIn('slow');
				hideResponse();
			}); 															 
		}								  
		});
	});
});


//////////////////////////////////////
////////////////////////////////
//////////////////////////

function fechardash(id,del){
	
$(id).fadeOut(500);

 $.post('dashboard-delete.php',{id: del},function(del){
 //mostrando o retorno do post
				$("#response").html(del);
				$("#response").fadeIn('slow', function(){
				
                setTimeout(function(){$("#response").fadeOut("slow")},2000);
				
                                                          });

});
}


function ativardash(add){
 $.post('dashboard-add.php',{id: add, user: '<?= $USUARIO['id'];?>'},function(add){

window.location = '?p=<?= $_GET['p'];?>&pst=1';

 });


}
//////////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////
function mostrardashboardconfig(){ 

$('#dashconfig').fadeIn(1); 
$('#blackout').fadeIn(500);	
$('#dashconfig').animate({left:'50%',opacity:'1'},500);

 }

function esconderdashboardconfig(){  $('#dashconfig').fadeOut(500); $('#blackout').fadeOut(500); $('#dashconfig').animate({left:'-50%',opacity:'0'},500);
 }
		
</script>

<style type="text/css">

#dashconfig{position:fixed; padding-bottom:20px; width:400px; background-color:#FFF; top:100px; margin: 0 0 0 -200px; z-index:300; 
<? if($_GET['pst'] != 1){?> left:-50%; display:none; opacity:0; <? } else { ?> left:50%; <? } ?>

-webkit-border-radius: 10px;
border-radius: 10px;

-webkit-box-shadow:  0px 0px 10px 2px #999;
        
box-shadow:  0px 0px 10px 2px #999;
}

#blackout{position:fixed; top:0px; left:0px; width:100%; height:100%; background-color:#000; z-index:200; opacity: 0.6;<? if($_GET['pst'] == 1){?> display:; <? } else {?> display:none; <? } ?>}
</style>

<center>

<table width="1000px" border="0">

<tr height="40px" valign="bottom" align="left">
<td style="font-size:14px; color:#999;">DASHBOARD</td>
<td width="30px"><img src="img/gear.png" width="20" style="cursor:pointer" onclick="mostrardashboardconfig();" title="Escolher Dashboards" /></td>
</tr>
<tr>
<td colspan="2"> <hr size="1" color="#CCCCCC" width="1000px" /></td>
</tr>

</table>


<div id="blackout"></div>

<div id="dashconfig">
<div class="close" onclick="esconderdashboardconfig();">X</div>

<table border="0" width="100%">

<tr align="center" height="40px" style="color:#999; font-weight:bold; font-size:14px">
<td>ESCOLHER DASHBOARDS</td>
</tr>
</table>

<form name="dashboardconfig" method="post">
<table border="0" width="90%" align="center">

<?
if($USUARIO['grupo'] == ''){$conGRUPO = array('0001','0002','0003','0004'); }

else {
$conGRUPO = explode('|',$USUARIO['grupo']);
}
for($i=0;$i<count($conGRUPO);$i++){
	
$conDASHS = $conexao->query("SELECT * FROM sys_dashboard WHERE grupo = '".$conGRUPO[$i]."' ORDER BY id ASC");
$class = "tr2";
while($DASHS = mysql_fetch_assoc($conDASHS)){

if ($class=="tr2"){ //alterna a cor
  $class = "tr3";
} else {
  $class="tr2";
}


$conUSERDASHS = $conexao->query("SELECT * FROM sys_dashboard_user WHERE usuario = '".$USUARIO['id']."' && dashboard = '".$DASHS['id']."'") ;
$USERDASHS = mysql_fetch_array($conUSERDASHS);

if($USERDASHS == 0){ $DASHstatus = 'DESATIVADO';} else { $DASHstatus = 'ATIVADO'; } 

?>


<tr class="<?= $class; ?>" align="center">
<td><?= stripslashes($DASHS['titulo']);?></td>
<td> <span id="onoffdash<?= $DASHS['id'];?>"><?= $DASHstatus; ?></span> </td>
<td> 

<span id="iconeativado<?= $DASHS['id'];?>" <? if($DASHstatus == 'DESATIVADO'){?> style="display:none" <? } ?>>
<img src="img/icone-ativado.jpg" width="45" align="absmiddle" style="cursor:pointer" onclick="fechardash('#listOrder_<?= $DASHS['id'] ?>','<?= $USERDASHS['id']?>'); document.getElementById('onoffdash<?= $DASHS['id'];?>').innerHTML = 'DESATIVADO'; document.getElementById('iconeativado<?= $DASHS['id'];?>').style.display = 'none'; document.getElementById('iconedesativado<?= $DASHS['id'];?>').style.display = ''" />
</span>

<span id="iconedesativado<?= $DASHS['id'];?>" <? if($DASHstatus == 'ATIVADO'){?> style="display:none" <? } ?>>
<img src="img/icone-desativado.jpg" width="45" align="absmiddle" style="cursor:pointer" onclick="ativardash(<?= $DASHS['id'];?>)" />
</span>

</td>
</tr>

<? } }?>


</table>
</form>

</div>

<? //if($USUARIO['acesso_usuario'] == 'INTERNO'){?>

<table border="0" width="1050px"><tr align="left"><td>
	<div id="container">
	  <div id="list">
		<div class="sections">
		<div id="response"> </div>
		  <?php
			$conUSERDASH  = $conexao->query("SELECT * FROM sys_dashboard_user WHERE usuario = '".$USUARIO['id']."' ORDER BY ordem ASC");
			while($USERDASH = mysql_fetch_assoc($conUSERDASH))
			{
				
			$conDASH = $conexao->query("SELECT * FROM sys_dashboard WHERE id = '".$USERDASH['dashboard']."'") ;
			$DASH = mysql_fetch_assoc($conDASH);	
			
				$id = stripslashes($DASH['id']);
				$text = stripslashes($DASH['titulo']);			
			?>
		  
		  <div id="listOrder_<?php echo $id ?>" class="box_inner">
			  <div id="section_head">
				<?php echo $text?>	
				<span class="id" onclick="fechardash('#listOrder_<?php echo $id ?>','<?= $USERDASH['id']?>');document.getElementById('onoffdash<?= $id;?>').innerHTML = 'DESATIVADO'; document.getElementById('iconeativado<?= $id;?>').style.display = 'none'; document.getElementById('iconedesativado<?= $id;?>').style.display = ''">X</span>
			  </div>
			  <div id="section_body">
              <iframe src="dashboards/<?= $DASH['conteudo']?>.php" frameborder="0" width="355px" height="250px"></iframe>
			  </div>
		  </div>
		  <?php } ?>
			
		</div>
		</div>
	</div>
</td></tr></table>
<? //} ?>

</center>
