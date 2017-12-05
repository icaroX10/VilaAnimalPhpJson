<?php
class BuscaDao {
	protected $tabela = "pessoaf";

	public $limite = 25;
	function buscaAll($pag){
		try{
			$inicio = ($pag * $this->limite) - $this->limite;
			$sql = "SELECT pessoaf.id_pes_f,pessoaf.nome,pessoaf.email,pessoaf.rg,pessoaf.cpf,telefone.id as id_tel,telefone.numero,telefone.celular,endereco.id as id_end,endereco.rua,endereco.bairro,endereco.cidade,endereco.referencia,endereco.cep,negociar.id as id_neg,negociar.negociacao,negociar.dataV,negociar.dataT,negociar.formP,negociar.arquivo FROM pessoaf INNER JOIN telefonepf ON pessoaf.id_pes_f = telefonepf.pessoaf_id INNER JOIN telefone ON telefonepf.telefone_id = telefone.id  INNER JOIN enderecopf ON pessoaf.id_pes_f = enderecopf.pessoaf_id INNER JOIN endereco ON enderecopf.endereco_id = endereco.id INNER JOIN negociarpf ON pessoaf.id_pes_f = negociarpf.pessoaf_id INNER JOIN negociar ON negociarpf.negociar_id=negociar.id  LIMIT $inicio , $this->limite";
			$stm = Db::prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function totalBusca(){
		try{
			$sql ="SELECT pessoaf.id_pes_f,pessoaf.nome,pessoaf.email,pessoaf.rg,pessoaf.cpf,telefone.id as id_tel,telefone.numero,telefone.celular,endereco.id as id_end,endereco.rua,endereco.bairro,endereco.cidade,endereco.referencia,endereco.cep,negociar.id as id_neg,negociar.negociacao,negociar.dataV,negociar.dataT,negociar.formP,negociar.arquivo FROM pessoaf INNER JOIN telefonepf ON pessoaf.id_pes_f = telefonepf.pessoaf_id INNER JOIN telefone ON telefonepf.telefone_id = telefone.id  INNER JOIN enderecopf ON pessoaf.id_pes_f = enderecopf.pessoaf_id INNER JOIN endereco ON enderecopf.endereco_id = endereco.id INNER JOIN negociarpf ON pessoaf.id_pes_f = negociarpf.pessoaf_id INNER JOIN negociar ON negociarpf.negociar_id=negociar.id";
			$stm = Db::prepare($sql);
			$stm->execute();
			$resultado = $stm->fetchAll();
			$count = $stm->rowCount(PDO::FETCH_ASSOC);
			$qtPag = ceil($count/$this->limite);
			return $qtPag;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function buscaEspecifica($coluna,$pesq){
		try{
			$sql = "SELECT pessoaf.id_pes_f,pessoaf.nome,pessoaf.email,pessoaf.rg,pessoaf.cpf,telefone.id as id_tel,telefone.numero,telefone.celular,endereco.id as id_end,endereco.rua,endereco.bairro,endereco.cidade,endereco.referencia,endereco.cep,negociar.id as id_neg,negociar.negociacao,negociar.dataV,negociar.dataT,negociar.formP,negociar.arquivo FROM pessoaf INNER JOIN telefonepf ON pessoaf.id_pes_f = telefonepf.pessoaf_id INNER JOIN telefone ON telefonepf.telefone_id = telefone.id  INNER JOIN enderecopf ON pessoaf.id_pes_f = enderecopf.pessoaf_id INNER JOIN endereco ON enderecopf.endereco_id = endereco.id INNER JOIN negociarpf ON pessoaf.id_pes_f = negociarpf.pessoaf_id INNER JOIN negociar ON negociarpf.negociar_id=negociar.id WHERE $coluna LIKE :pesq";
			$stm = Db::prepare($sql);
			$stm->bindValue(':pesq', '%'.$pesq.'%');
			$stm->execute();
			if($stm->rowCount(PDO::FETCH_ASSOC)>=1){
				return $stm->fetchAll();	
			}else{
				echo "<script>alert('Nada Encontrado!');h</script>";
			}
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>