<?php
	require_once("Pessoa.class.php");
	class PessoaFisica extends Pessoa
	{
		
		protected $cpf;

		public function setCpf($cp){
			$this->cpf = $cp;
		}
		public function getCpf(){
			return $this->cpf;
		}

		
		
			
	}
	
?>