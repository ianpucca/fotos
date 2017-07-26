<html>
<head>
	<title>Fotos</title>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
	<script src="css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<link href="css/lightbox.css" rel="stylesheet">
	<script src="js/lightbox.js"></script>
</head>
<body>
	<script type="text/javascript">
		function sortTable(n) {
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("tableFotos");
			switching = true;
			
			dir = "asc"; 
			while (switching) {
				switching = false;
				rows = table.getElementsByTagName("TR");
				for (i = 1; i < (rows.length - 1); i++) {
					shouldSwitch = false;
					x = rows[i].getElementsByTagName("TD")[n];
					y = rows[i + 1].getElementsByTagName("TD")[n];
					if (dir == "asc") {
						if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
							shouldSwitch= true;
							break;
						}
					} else if (dir == "desc") {
						if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
							shouldSwitch= true;
							break;
						}
					}
				}
				if (shouldSwitch) {
					rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
					switching = true;
					switchcount ++;      
				} else {
					if (switchcount == 0 && dir == "asc") {
						dir = "desc";
						switching = true;
					}
				}
			}
		}

		function updateList(){
			var input = document.getElementById('file');
			var output = document.getElementById('fileList');
			for (var i = 0; i < input.files.length; ++i) {
				output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
			}
		}

		

		function filtrarTabela() {
			var input, filter, table, tr, td, i;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("tableFotos");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				if (td) {
					if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}       
			}
		}

		function showProgressBar(){
			$("#progress").show();
		}

		function deleteFile(file){
			if(confirm("Tem certeza que deseja remover o arquivo "+file+"?")){
				window.location = "delete.php?file="+file;
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
		<div class="panel panel-default" id="panelFotos">
			<div class="panel-heading" align="center" style="width: 100%;">
				<h4>Selecione um arquivo</h4>
				<form id="formUpload" name="formUpload" action="upload2.php" method="post" enctype="multipart/form-data" onsubmit="showProgressBar();">
					<div class="form-inline">
						<div class="form-group">
							<input name="upload[]" id="file" type="file" multiple="multiple" onchange="updateList()" required/>
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
						<div class="progress" id="progress" style="display: none">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
								Processando, aguarde...
							</div>
						</div>
						<div class="widget-header" align="left">
							<h4><span class="glyphicon glyphicon-list" aria-hidden="true"><i class="icon-th-list"></i></span>&nbsp;&nbsp;Arquivos</h4>
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							<input type="text" id="myInput" onkeyup="filtrarTabela()" placeholder="Filtrar arquivos" size="100px">
						</div>
						<br />
						<div class="widget-content">
							<table id="tableFotos" class="table table-striped table-bordered">
								<thead>
									<th style="width: 80%" onclick="sortTable(0)">Nome</th>
									<th style="width: 10%">Tamanho</th>
									<th colspan="3">Opções</th>
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
									if ($handle = opendir('./arquivos')) {
										while (false !== ($entry = readdir($handle))) {
											if ($entry != "." && $entry != "..") {
												echo " <tr> ";
												echo " 	<td>".$entry."</td> ";
												echo "  <td>".formatSizeUnits(filesize('./arquivos/'.$entry))."</td>";
												echo " 	<td title=\"Download do arquivo.\"> <a href=\"download.php?file=".$entry."\"	onclick=\"(showProgressBar())\" class=\"btn btn-success\">                             <span class=\"glyphicon glyphicon-download\" aria-hidden=\"true\"></span>&nbsp; Baixar	  </a></td> ";
												echo "	<td title=\"Visualizar arquivo.\">  <a href=\"arquivos/".$entry."\"          										class=\"btn btn-primary\" data-lightbox=\"example-1\"> <span class=\"glyphicon glyphicon-search\" 	aria-hidden=\"true\"></span>&nbsp; Visualizar </a></td>";
												echo " 	<td title=\"Apagar arquivo.\"> 	    <a href=\"#\"      onclick=\"(deleteFile('".$entry."'))\" class=\"btn btn-danger\">							   <span class=\"glyphicon glyphicon-remove\" 	aria-hidden=\"true\"></span>&nbsp; Apagar	  </a></td> ";
												echo " </tr> ";
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