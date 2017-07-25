<!DOCTYPE html>
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
		function login(){
			var usuario = $("#usuario");
			var senha = $("#senha");
			$.get('login.php?usuario='+usuario.val()+"&senha="+senha.val(), function(data) {
				if(data === "true"){
					window.location = "main.php";
				}else{
					alert('Oops');
				}
			});
		}
	</script>
	<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">Login</div>
			</div>     
			<div style="padding-top:30px" class="panel-body" >
				<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
				<form id="loginform" class="form-horizontal" role="form">

					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="usuario" type="text" class="form-control" name="username" value="" placeholder="Usuário">                                        
					</div>

					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="senha" type="password" class="form-control" name="password" placeholder="Senha">
					</div>
					<div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
							<a id="btn-login" href="#" class="btn btn-success" onclick="login()">Login  </a>
						</div>
					</div>
				</form>
			</div>
		</div>  
	</div>
</body>
</html>