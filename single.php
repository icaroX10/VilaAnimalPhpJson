<?php 
	require_once("Class/Controller/UsuarioController.class.php");
	$user = new UsuarioController();
	if(isset($_GET['id'])){
		require_once("Class/Db.class.php");
		$db = new Db();
		$busca = $user->pegarDados($_GET['id']);
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="Css/reset.css">
    <link rel="stylesheet" href="Css/style.css">
</head>
<body>
	<div class="header">
	    <div class="container">
	        <a href="" class="logo">VilaAnimal</a>
	        <nav class="menu-principal-container">
	            <ul>
	                <li><a href="index.php">Home</a></li>
	                <li><a href="">a empresa</a></li>
	                <li><a href="">produtos</a></li>
	                <li><a href="">contatos</a></li>
	            </ul>
	        </nav>
	    </div>
	</div>
	<div class="container">
	    <div class="conteudo">


			<h1 class="title">Dados do Paciente</h1>
			<?php

				if(count($busca) > 0){
						foreach ($busca as $key => $value) {
							echo "<div class='nomesP'>";
							echo "<p><b>Pontuação:</b>".$value['pontuacao']."</p>";	
							echo "<input class='pont' type='hidden' value='".$value['pontuacao']."'>";	
							echo "<p><b>Data da Partida:</b>".$value['data']."</p>";		
							echo "<p><b>Duração da Sessão:</b>".$value['tempo']."</p>";		
							echo "</div>";
						}
					?>

				<canvas width="100" height="100" id="grafico_barras"></canvas>
			<?php
					}else{
			?>
					<h1>Não Existe nenhum dado</h1>

				<?php
					}

				?>	
		</div>
	</div>

	<div class="footer">
            <div class="container">
                <div class="foot_inf">
                    <span>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI.</span>
                </div>
                <div class="foot_end">
                    <p><b>Endereço</b>: Av. Professor Manoel Ribeiro, 582, Armação</p>
                    <p><b>Contatos</b>: 71- 3491-1775 / 98808-7085 (oi) / 98850-5522(tim)</p>
                </div>
                <div class="foot-menu">
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">a empresa</a></li>
                        <li><a href="">produtos</a></li>
                        <li><a href="">contatos</a></li>
                    </ul>
                </div>
                <div class="foot_rs">
                    <a href=""></a>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
</body>
</html>