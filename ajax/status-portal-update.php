<?php

require_once '../conexao.php';

spl_autoload_register("autoload");

function autoload($class) {
    
    
    include_once "../lib/class." . $class . ".php";

}

$objPlanilhas = new planilhaQualidade($conexao);

$upStatus = $objPlanilhas->atualizaNumero($_POST);
echo $upStatus;
//print_r($_POST);
?>
