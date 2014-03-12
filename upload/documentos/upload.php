<?php
date_default_timezone_set("Brazil/East");

include_once "conexao.php";
/*
PekeUpload
Copyright (c) 2013 Pedro Molina
*/

// Define a destination
$targetFolder = 'upload/documentos/'; // Relative to the root


if (!empty($_FILES)) {
	$tempFile = $_FILES['file']['tmp_name'];
	$targetPath = dirname(__FILE__) . '/' . $targetFolder;
	
	$time = time();

	// Validate the file type
	$fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'pdf'); // File extensions
	$fileParts = pathinfo($_FILES['file']['name']);
		
	//$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];
	$filename = $_POST["data"] . "." .$fileParts['extension'];
	$targetFile = rtrim($targetPath,'/') . '/' . $filename;
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		$conexao->query("UPDATE vendas_clarotv SET gravacao='"  .$_FILES['file']['name'] . "' where id='" . $_POST['venda_id'] . "'");
		echo '1';
	} else {
		echo 'Tipo de arquivo inv&aacute;lido.';
	}
}
?>
