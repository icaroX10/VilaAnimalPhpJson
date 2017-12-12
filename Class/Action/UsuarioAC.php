<?php
	$req = $_GET['req'];

	require_once("../Db.class.php");
	$db = new Db();

	$arq = "arquivo.txt";
	$file = fopen($arq,'a');		
	fwrite($file, "Criou");	
	fclose($file);
		
	if($req){
		require_once('../Controller/UsuarioController.class.php');
		$usuarioController  = new UsuarioController();

		if($req==1){
			require_once("../Model/Usuario.class.php");
			$data = file_get_contents('php://input');
			

			if(isset($data) || $data != ""){
				//$controle = '[{"nickname":"ola","teste":"olá mundo","idade":12,"pontuacao":[250.0,550.0],"tempo":[45.0,120.0],"data":["04/12/2017","07/12/2017"]}]';



				$controle = "[{$data}]";

				$json = json_decode($controle,true); 

				

				if(isset($json)){
					$user = new Usuario();		
					
					foreach ($json as $key => $value) {

						if(isset($value['nickname'])){
							$user->setNickname($value['nickname']);
						}
						$cont = count($value['pontuacao']);
						for($i = 0 ; $i< $cont; $i++){
							$user->setPontuacao($value['pontuacao'][$i]);

						}

						foreach ($value['tempo'] as $keys) {
							$user->setTempo($keys);	
						}

						foreach ($value['data'] as $keys) {
							$user->setDatajogo($keys);	
						}

					}
					if(!empty($user->getPontuacao()) && !empty($user->getDatajogo()) && !empty($user->getTempo())){
						/*
						$arq = "arquivo.txt";
						$file = fopen($arq,'a');		
						fwrite($file, $user->getDatajogo());	
						fclose($file);
						*/
						$usuario = $usuarioController->cadastrar($user);						
						
						
					}
				}
			}
				
			
		}elseif($req == 2){

			if(isset($_SESSION['user']) && isset($_SESSION['senha'])){
				session_destroy();
				echo "<script>window.location.href  = '../../index.php';</script>";	

			}
		}
	}

?>