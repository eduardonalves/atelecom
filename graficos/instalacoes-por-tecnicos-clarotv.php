<!DOCTYPE html>
<html>

<head>
<meta charset=utf-8 />
<title>Avinash</title>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>


<? 

$numero = 99;
$add = ceil($numero/50);

?>




<body>
  <div id="haha"></div>
  
<script>
$(function() {
  var ele = $('#haha');
  var clr = null;
  var rand = 0;
  (loop = function() { 
    clearTimeout(clr);
    (inloop = function() {
		if(rand < <?= $numero;?>){
      ele.html(rand+=<?= $add;?>);} else {ele.html(<?= $numero;?>)}
      if(!(rand % <?= $numero;?>)) {
        return;
      }
      clr = setTimeout(inloop, 30);
    })();  
  })();
});
</script>



</body>
</html>