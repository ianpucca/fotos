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

		$(document).ready(function() {

			$("#usuario").focus();

			$('#loginform').keydown(function(event) {
				if (event.keyCode == 13) {
					$("#btn-login").trigger("click");
					return false;
				}
			});

		});

		function login(){
			var divError = $("#divError");
			var usuario = $("#usuario");
			var senha = $("#senha");
			divError.hide();

			if(usuario.val() == '' || senha.val() == ''){
				divError.html('Informe um usuário ou senha válidos.');
				divError.show();
				return;
			}

			$.get('login.php?usuario='+usuario.val()+"&senha="+senha.val(), function(data) {
				if(data === "true"){
					window.location = "main.php";
				}else{
					usuario.val("");
					senha.val("");
					divError.html('Usuário ou senha incorretos.');
					divError.show();
				}
			});
			$("#usuario").focus();
		}
	</script>
	<br />
	<div class="container" align="center" id="divMain">
		<div id="divError" class="alert alert-danger" style="width: 50%;display: none;" align="center"></div>
		<div id="loginbox" style="margin-top:50px; width: 50%; height: 50%;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" align="center">                    
			<div class="panel panel-info" style="width: 50%; height: 50%">
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
	</div>
</body>
</html>