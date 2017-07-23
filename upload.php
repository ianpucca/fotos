<?php 
$target_dir = "arquivos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


$msgErro;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		$msgErro = "O arquivo é uma imagem - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		$msgErro = "O arquivo não é uma imagem.";
		$uploadOk = 0;
	}
}
// Check if file already exists
if (file_exists($target_file)) {
	$msgErro = "O arquivo já existe.";
	$uploadOk = 0;
}
/*
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}
*/
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
	$msgErro = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	header("Location: index.php?processing=false&msg=".$msgErro);
	exit();
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		header("Location: index.php?processing=true&msg=Arquivo enviado com sucesso.");
		exit();
	} else {
		header("Location: index.php?processing=false&msg=".$msgErro);
		exit();
	}
}
?>