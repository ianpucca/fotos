<?php 
session_start();
if(strcmp($_SESSION['adm'], 'true') == 0){
	$path="arquivos/".$_GET['file'];
	if(unlink($path)){
		header("Location: main.php?processing=true&msg=Arquivo apagado com sucesso.");
	}else{
		header("Location: main.php?processing=true&msg=Erro ao apagar o arquivo.");
	}
}else{
	header("Location: main.php?processing=false&msg=Você não possui permissão para relizar esta ação.");
}
?>