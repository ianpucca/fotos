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
			//Set the sorting direction to ascending:
			dir = "asc"; 
			/*Make a loop that will continue until
			no switching has been done:*/
			while (switching) {
			//start by saying: no switching is done:
			switching = false;
			rows = table.getElementsByTagName("TR");
			/*Loop through all table rows (except the
			first, which contains table headers):*/
			for (i = 1; i < (rows.length - 1); i++) {
			//start by saying there should be no switching:
			shouldSwitch = false;
			/*Get the two elements you want to compare,
			one from current row and one from the next:*/
			x = rows[i].getElementsByTagName("TD")[n];
			y = rows[i + 1].getElementsByTagName("TD")[n];
			/*check if the two rows should switch place,
			based on the direction, asc or desc:*/
			if (dir == "asc") {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			  //if so, mark as a switch and break the loop:
			  shouldSwitch= true;
			  break;
			}
		} else if (dir == "desc") {
		if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
		      //if so, mark as a switch and break the loop:
		      shouldSwitch= true;
		      break;
		  }
		}
	}
	if (shouldSwitch) {
		  /*If a switch has been marked, make the switch
		  and mark that a switch has been done:*/
		  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		  switching = true;
		  //Each time a switch is done, increase this count by 1:
		  switchcount ++;      
		} else {
		  /*If no switching has been done AND the direction is "asc",
		  set the direction to "desc" and run the while loop again.*/
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

function show(file){
	window.open('');
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
					<div class="widget-header" align="left">
						<h4><span class="glyphicon glyphicon-list" aria-hidden="true"><i class="icon-th-list"></i></span>&nbsp;&nbsp;Arquivos</h4>
					</div>
					<div class="widget-content">
						<table id="tableFotos" class="table table-striped table-bordered">
							<thead>
								<th style="width: 10%">#</th>
								<th style="width: 80%" onclick="sortTable(0)">Nome</th>
								<th style="width: 10%">Tamanho</th>
								<th colspan="2">Opções</th>
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
											echo " 	<td title=\"Apagar arquivo.\"> <a href=\"delete.php?file=".$entry."\" class=\"btn btn-danger\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a></td> ";
											echo "	<td title=\"Visualizar arquivo.\"> <a class=\"btn btn-primary\" href=\"arquivos/".$entry."\" data-lightbox=\"example-1\"> <span class=\"glyphicon glyphicon-search\" aria-hidden=\"true\"></span></a>";
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