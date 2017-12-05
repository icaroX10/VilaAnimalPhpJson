<?
	require_once("Class/Controller/UsuarioController.class.php");
	$user = new UsuarioController();

	require_once("Class/Db.class.php");
	$db = new Db();
	include "php/header.php";


?>
<h1>Dados do Paciente</h1>
<?php
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

	include "php/footer.php";
?>

