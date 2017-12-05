<?php
	require_once("../DAL/PessoaFisicaDao.php");
	class  PessoaFisicaController{
		protected $pessoaFisicaDao;
		protected $cond=FALSE;

		function __construct(){
			$this->pessoaFisicaDao = new PessoaFisicaDao();
		}

		

		public   function verificaAll(PessoaFisica $pessoaF){
			$pfd = new PessoaFisicaDao();

			$pessoa =$pfd->buscaP($pessoaF->getCpf());
			
			if( count($pessoa) < 1 ){
				
				return $cond = TRUE;
			}
		}
		function insertP(PessoaFisica $pessoaF){
			if($pessoaF->getNome() != "" && $pessoaF->getEmail() != "" && $pessoaF->getRg() != "" && $pessoaF->getCpf() != ""){
				return $this->pessoaFisicaDao->insertP($pessoaF);
			}
		}

		function insertNum(Telefone $telefone){
			if( $telefone->getNumero() != ""){
				return $this->pessoaFisicaDao->insertNum($telefone);
			}
		}
		function insertEnd(Endereco $end){
			if($end->getRua() != "" && $end->getBairro() != "" && $end->getCidade() != "" && $end->getReferencia() != "" && $end->getCep() != ""){
				return $this->pessoaFisicaDao->insertEnd($end);
			}
		}

		function pessoaNum($pes,$num){
			if(!empty($pes) && !empty($num)){
				return $this->pessoaFisicaDao->pessoaNum($pes,$num);
			}
		}

		function pessoaEnd($pes,$end){
			if(!empty($pes) && !empty($end)){
				return $this->pessoaFisicaDao->pessoaEnd($pes,$end);
			}
		}

		function negociar(Negociacao $neg){
			if(!empty($neg->getFormPag())){
				return $this->pessoaFisicaDao->negociar($neg);
			}
		}

		function pessoaNeg($pes,$neg){
			if(!empty($pes) && !empty($neg)){
				return $this->pessoaFisicaDao->pessoaNeg($pes,$neg);
			}
		}

		function updateP(PessoaFisica $pessoaF){
			if($pessoaF->getNome() != "" && $pessoaF->getEmail() != "" && $pessoaF->getRg() != "" && $pessoaF->getCpf() != ""){
				return $this->pessoaFisicaDao->updateP($pessoaF);
			}
		}

		function updateNum(Telefone $telefone){
			if( $telefone->getNumero() != ""){
				return $this->pessoaFisicaDao->updateNum($telefone);
			}
		}

		function updateEnd(Endereco $end){
			if($end->getRua() != "" && $end->getBairro() != "" && $end->getCidade() != "" && $end->getReferencia() != "" && $end->getCep() != ""){
				return $this->pessoaFisicaDao->updateEnd($end);
			}
		}

		function destroyPes($id_pes){
			if(!empty($id_pes)){
				return $this->pessoaFisicaDao->destroyPes($id_pes);
			}
		}

		function destroyEnd($id_end){
			if(!empty($id_end)){
				return $this->pessoaFisicaDao->destroyEnd($id_end);
			}
		}
		function destroyTel($id_tel){
			if(!empty($id_tel)){
				return $this->pessoaFisicaDao->destroyTel($id_tel);
			}
		}

	}


?>