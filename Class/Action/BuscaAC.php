<?php
	$req = filter_input(INPUT_GET, "req"); //Obtemos o valor de REQ que é passado através da URL
	require_once("../Db.class.php");
	$db = new Db();
	//$db->getInstance();
	if($req){
		require_once("../Controller/BuscaController.class.php");
		$buscaController = new BuscaController();
		if($req == 1){
			$categoria = filter_input(INPUT_POST, "txtCategoria");
			$busca = filter_input(INPUT_POST,"txtBusca");
			if(!empty($categoria) && !empty($busca)){
				$buscaController->buscaEspecifica($categoria,$busca);
			}
		}
		
		
	}