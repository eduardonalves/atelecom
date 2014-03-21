<?php

    //Conexão com Banco
    include_once("conexao.php");
    
    $origem = $_POST['selectOrigem'];
    
    $origem = strtolower($origem);
    
    if (strstr($origem, "claro"))
    {
		
		require "includes/inserir-entrada-claro.php";
		
	}else if (strstr($origem, "parceiro")) {
		
		require "includes/inserir-entrada-parceiro.php";
		
	}
   
?>
