<?php
	require_once("Pessoa.class.php");
	class PessoaJuridica extends Pessoa
	{
		protected $tabela = "pessoa_jur";
		protected $cnpj;

		public function setCnpj($cnp){
			$this->cnpj = $cnp;
		}
		public function getCnpj(){
			return $this->cnpj;
		}

		public function __construct($nam,$em,$r,$cnp)
		{
			$this->setNome($nam);
			$this->setEmail($em);
			$this->setRg($r);
			$this->setCnpj($cnp);
		}
	}
	
?>