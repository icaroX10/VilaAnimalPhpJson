<!DOCTYPE html>
<html>
<head>
	<title>JucyDecor-Login</title>
	<link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
</head>

<body>


<div class="col-md-12">
	<div class="container">
		<div class="Login">
			<h1>Login</h1>
			<form method="POST" action="Class/Action/UsuarioAC.php?req=1" class="form-group">
				<label>Usuario</label>
				<input type="text" name="txtUser" class="form-control" required>
				<label>Senha</label>
				<input type="password" name="txtPass" class="form-control" required>
				<input type="submit" name="logar" value="Logar" class="btn btn-primary">
			</form>
		</div>
	</div>
	
</div>			
</body>
</html>