<?php

	require_once("../Db.class.php");

	abstract class Pessoa extends Db{
		protected  $id;
		protected  $tabela;
		protected  $nome;
		protected  $email;
		protected  $rg;
		protected  $telefone;
		protected  $endereco;
		protected  $negociacao;
		protected  $tab_tel;
		protected  $tab_end;

		
		//GET e SET
		function setId($i){
			$this->id = $i;
		}
		function getId(){
			return $this->id;
		}

		function setNome($nome){
			$this->nome = $nome;
		}
		function getNome(){
			return $this->nome;
		}

		function setEmail($email){
			$this->email = $email;
		}
		function getEmail(){
			return $this->email;
		}

		function setRg($rg){
			$this->rg = $rg;
		}
		function getRg(){
			return $this->rg;
		}


		function setTelefone(Telefone $tel){
			$this->telefone[] = $tel;
		}
		function getTelefone(){
			return $this->telefone ;
		}
		function setEndereco(Endereco $end){
			$this->endereco[] = $end;
		}
		function getEndereco(){
			return $this->endereco ;
		}

		function setNegociacao(Negociacao $neg){
			$this->negociacao[] = $neg;
		}
		function getNegociacao(){
			return $this->negociacao;
		}

		
	}
?>