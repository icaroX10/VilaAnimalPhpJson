<?php

	class Negociacao{
		protected $dataVis;
		protected $dataExec;
		protected $negocio;
		protected $formPag;
		protected $inscEst;
		protected $arquivo;

		function setDataVis($dtvis){
			$this->dataVis = $dtvis;
		}
		function getDataVis(){
			return $this->dataVis;
		}

		function setDataExec($dtEx){
			$this->dataExec = $dtEx;
		}
		function getDataExec(){
			return $this->dataExec;
		}

		function setNegocio($neg){
			$this->negocio = $neg;
		}
		function getNegocio(){
			$this->negocio;
		}

		function setFormPag($formP){
			$this->formPag = $formP;
		}
		function getFormPag(){
			return $this->formPag;
		}

		function setInscEst($inscE){
			$this->inscEst = $inscE;
		}

		function getInscEst(){
			return $this->inscEst;
		}

		function setArquivo($arq){
			$this->arquivo = $arq;
		}

		function getArquivo(){
			return $this->arquivo;
		}		
	}
?>