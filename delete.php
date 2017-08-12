<?php 
	$path="arquivos/".$_GET['file'];
    if(unlink($path)){
    	header("Location: main.php?processing=true&msg=Arquivo apagado com sucesso.");
    }else{
		header("Location: main.php?processing=true&msg=Erro ao apagar o arquivo.");
    }
 ?>