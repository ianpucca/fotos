<?php 
$uploadOk = 1;
$msgErro;
$msgSucess;
$total = count($_FILES['upload']['name']);

// Loop through each file
for($i=0; $i<$total; $i++) {
  //Get the temp file path
  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

  //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "./arquivos/" . $_FILES['upload']['name'][$i];

    //Upload the file into the temp dir
    if(!move_uploaded_file($tmpFilePath, $newFilePath)) {
      $uploadOk = 0;
      $msgErro .= "Erro ao enviar arquivo ".$_FILES['upload']['name'][$i]."<br />";
    }
  }
}

if ($uploadOk == 0) {
  header("Location: main.php?processing=false&msg=".$msgErro);
  exit();
// if everything is ok, try to upload file
} else {
  header("Location: main.php?processing=true&msg=Arquivos enviado com sucesso.");
  exit();
}

?>