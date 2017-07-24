<html>
<head>
	<title>Fotos</title>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
	<script src="css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
	<script type="text/javascript">
		$(function (){
			/*
			$(".alert").fadeTo(5000, 500).slideUp(500, function(){
				console.log("hide");
				$(".alert").alert('close');
			});
			*/
		});
		

		function updateList(){
			var input = document.getElementById('file');
			var output = document.getElementById('fileList');
			for (var i = 0; i < input.files.length; ++i) {
				output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
			}
		}
	</script>
	<br />
	<div class="container">
		<?php
		if(isset($_GET['processing']) && isset($_GET['msg'])){
			if($_GET['processing'] == 'true') {
				echo "<div class='alert alert-success' align='center' style='width: 100%'>";
			}else{
				echo "<div class='alert alert-danger' align='center' style='width: 100%'>";
			}
			echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
			echo "<strong>".$_GET['msg']."</strong>";
			echo "</div>";
		}
		?>
		<div class="panel panel-default">
			<div class="panel-heading" align="center" style="width: 100%;">
				<h4>Selecione um arquivo</h4>
				<form id="formUpload" name="formUpload" action="upload2.php" method="post" enctype="multipart/form-data">
					<div class="form-inline">
						<div class="form-group">
							<input name="upload[]" id="file" type="file" multiple="multiple" onchange="updateList()" />
						</div>
						<button type="submit" class="btn btn-success" id="js-upload-submit"><i class="glyphicon glyphicon-upload"></i><span>Enviar</span></button>
						<br />
						<div id="fileList" align="center"></div>
					</div>
				</form>
			</div>
			<div class="panel-body" align="center">	
				<div class="span7">   
					<div class="widget stacked widget-table action-table">
						<div class="widget-header" align="left">
							<h4><span class="glyphicon glyphicon-list" aria-hidden="true"><i class="icon-th-list"></i></span>&nbsp;&nbsp;Arquivos</h4>
						</div>
						<div class="widget-content">
							<table class="table table-striped table-bordered">
								<thead>
									<th style="width: 10%">#</th>
									<th style="width: 80%">Nome</th>
									<th style="width: 10%">Tamanho</th>
									<th>Opções</th>
								</thead>
								<tbody>
									<?php 

									function formatSizeUnits($bytes)
									{
										if ($bytes >= 1073741824)
										{
											$bytes = number_format($bytes / 1073741824, 2) . ' GB';
										}
										elseif ($bytes >= 1048576)
										{
											$bytes = number_format($bytes / 1048576, 2) . ' MB';
										}
										elseif ($bytes >= 1024)
										{
											$bytes = number_format($bytes / 1024, 2) . ' KB';
										}
										elseif ($bytes > 1)
										{
											$bytes = $bytes . ' bytes';
										}
										elseif ($bytes == 1)
										{
											$bytes = $bytes . ' byte';
										}
										else
										{
											$bytes = '0 bytes';
										}

										return $bytes;
									}


									$i = 1;
									if ($handle = opendir('./arquivos')) {
										while (false !== ($entry = readdir($handle))) {
											if ($entry != "." && $entry != "..") {
												echo " <tr> ";
												echo " 	<td>".$i."</td> ";
												echo " 	<td title=\"Clique para fazer download\"><a href=\"download.php?file=".$entry."\">".$entry."</a></td> ";
												echo "  <td>".formatSizeUnits(filesize('./arquivos/'.$entry))."</td>";
												echo " 	<td title=\"Apagar\"><a href=\"delete.php?file=".$entry."\" class=\"btn btn-danger\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td> ";
												echo " </tr> ";
												$i++;
											}
										}
										closedir($handle);
									}
									?>
								</tbody>
							</table>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>