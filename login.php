<?php 
$usuario = $_GET['usuario'];
$senha = $_GET['senha'];
if($usuario != null && $senha != null){
	session_start();
	$_SESSION['usuario'] = $usuario;
	if(strcmp($usuario,"adm") == 0 && strcmp($senha,"adm1234") == 0){
		echo "true";
		$_SESSION['adm'] = "true";
	}else if(strcmp($usuario,"usuario") == 0 && strcmp($senha,"usuario1234") == 0){
		echo "true";
		$_SESSION['adm'] = "false";
	}else{
		echo "false";
		session_destroy();
	}

}else{
	echo "Informe usuario/senha.";
	session_destroy();
}
?>