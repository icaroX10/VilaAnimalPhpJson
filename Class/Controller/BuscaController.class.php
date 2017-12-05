<?php
	require_once("Class/DAL/BuscaDao.php");
	require_once("Class/Db.class.php");
	$db = new Db();
	class  BuscaController{
		protected $buscaDao;
		function __construct(){
			$this->buscaDao = new BuscaDao();
		}

		function buscaEspecifica($categoria,$pesq){
			if(!empty($categoria)&& !empty($pesq)){
				return $this->buscaDao->buscaEspecifica($categoria,$pesq);
			}
		}

		function buscarTudo($pag){
			if(!empty($pag)){
				return $this->buscaDao->buscaAll($pag);	
			}else{
				return $this->buscaDao->buscaAll(1);	
			}	
		}

		function totalBusca(){
			return $this->buscaDao->totalBusca();
		}
		
	}