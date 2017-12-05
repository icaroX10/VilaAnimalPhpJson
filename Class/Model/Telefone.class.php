<?php
	class Telefone{
		protected  $tabela;
		protected $id;
		protected $numero;
		protected $celular;
		function setId($id){
			$this->id = $id;
		}
		function getId(){
			return $this->id;
		}
		public function setNumero($num){
			$this->numero = $num;
		}
		public function getNumero(){
			return $this->numero;
		}
		public function setCelular($num){
			$this->celular = $num;
		}
		public function getCelular(){
			return $this->celular;
		}
	}
	
?>