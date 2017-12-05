<?php
	class Endereco{
		protected  $tabela;
		protected $id;
		protected $rua;
		protected $bairro;
		protected $cidade;
		protected $referencia;
		protected $cep;

		public function setId($id){
			$this->id = $id;
		}
		public function getId(){
			return $this->id;
		}
		public function setRua($ru){
			$this->rua = $ru;
		}
		public function getRua(){
			return $this->rua;
		}
		public function setBairro($bar){
			$this->bairro = $bar;
		}
		public function getBairro(){
			return $this->bairro;
		}
		public function setCidade($cid){
			$this->cidade = $cid;
		}
		public function getCidade(){
			return $this->cidade;
		}
		public function setReferencia($ref){
			$this->referencia = $ref;
		}
		public function getReferencia(){
			return $this->referencia;
		}
		public function setCep($cp){
			$this->cep = $cp;
		}
		public function getCep(){
			return $this->cep;
		}
	}
?>