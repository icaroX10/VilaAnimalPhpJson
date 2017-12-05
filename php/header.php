<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>JucyDecor</title>
	<link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Css/main.css">
</head>
<body>

	<div class="col-md-12">
		<div class="container">
			<div class="usuario">
			<?php
				if(isset($_SESSION['user'])){
					echo $_SESSION['user'];
			?>
				<a href="Class/Action/UsuarioAC.php?req=2">Deslogar</a>
				<?php
				}
				?>
			</div>