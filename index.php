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
	                <li><a href="">Home</a></li>
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
					require_once("Class/Controller/UsuarioController.class.php");
					$user = new UsuarioController();

					require_once("Class/Db.class.php");
					$db = new Db();
					$dados = $user->dadosPaciente();
					if(count($dados) > 0){
						foreach ($dados as $key => $value) {
							echo "<h3><b>Nickname:</b>".$value['nickname']."</h3>";			
							echo "<h3><b>Pontuação:</b>".$value['pontuacao']."</h3>";
							echo "<h3><b>Tempo:</b>".$value['tempo']."</h3>";
							echo "<h3><b>Data do jogo:</b>".$value['data']."</h3>";
						}
					}else{
				?>
					
					<h1>Não Existe nenhum dado</h1>

				<?php
					}

				?>	
				<img class="pontos" src="Img/pontos.jpg">
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
</body>
</html>



