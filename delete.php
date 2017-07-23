<?php 
	$path="arquivos/".$_GET['file'];
    if(unlink($path)){
    	header("Location: index.php?processing=true&msg=Arquivo apagado com sucesso.");
    }else{
		header("Location: index.php?processing=true&msg=Erro ao apagar o arquivo.");
    }
 ?>