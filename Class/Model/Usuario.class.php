<?php

class Usuario{
	protected $nickname;
	protected $pontuacao = array();
	protected $dataJogo = array();
	protected $tempo = array();

	public function setNickname($nickname){
		$this->nickname = $nickname;
	}
	public function getNickname(){
		return $this->nickname;
	}

	public function setPontuacao($pontuacao){
		$this->pontuacao[] = $pontuacao;
	}
	public function getPontuacao(){
		return $this->pontuacao;
	}

	public function setDatajogo($dataJogo){
		$this->dataJogo[] = $dataJogo;
	}
	public function getDatajogo(){
		return $this->dataJogo;
	}

	public function setTempo($tempo){
		$this->tempo[] = $tempo;
	}
	public function getTempo(){
		return $this->tempo;
	}

}

?>