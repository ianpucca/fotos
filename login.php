<?php 
$usuario = $_GET['usuario'];
$senha = $_GET['senha'];
if($usuario != null && $senha != null){
	if(strcmp($usuario,"usuario") == 0 && strcmp($senha,"usuario1234") == 0){
		echo "true";
	}else{
		echo "false";
	}
}else{
	echo "Informe usuario/senha.";
}
?>