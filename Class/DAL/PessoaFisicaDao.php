<?php
	require_once("../Model/PessoaFisica.class.php");
	class PessoaFisicaDao {
		protected $tabela = "pessoaf";
		protected  $tab_tel = "telefone";
		protected  $tab_end = "endereco";

		public function findUm($id){
			$sql = "SELECT * FROM $this->tabela INNER JOIN telefonepf ON $this->tabela.id_pes_f = telefonepf.telefone_id INNER JOIN telefone ON telefonepf.telefone_id = telefone.id  INNER JOIN enderecopf ON $this->tabela.id_pes_f = enderecopf.endereco_id INNER JOIN endereco ON enderecopf.endereco_id = endereco.id  WHERE id_pes_fis="+$id;
			$stm = Db::prepare($sql);
			$stm->bindValue(':id',$id,PDO::PARAM_INT);
			$stm->execute();
			return $stm->fetch();
		}
		public function findAll(){
			$sql = "SELECT * FROM $this->tabela";
			$stm = Db::prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}
		//O Retorno da Função busca esta errado... e a Pesquisa tbm... desse jeito vai acabar achando muitos email parecido
		public  function buscaP($pesq){
			//$col = array("nome",'email',"rg","cpf");
			$sql = "SELECT * FROM $this->tabela WHERE cpf LIKE :pesq";
			$stm = Db::prepare($sql);
			//$stm->bindValue(':coluna',$coluna);
			//$stm->bindValue(':col',$col[$id_col]);
			$stm->bindValue(':pesq', '%'.$pesq.'%');
			$stm->execute();
			return 	$stm->fetchAll(PDO::FETCH_ASSOC); 
		}

		public  function buscaNum($pesq){
		
			$sql = "SELECT * FROM $this->tab_tel WHERE numero LIKE :pesq";
			$stm = Db::prepare($sql);
			//$stm->bindValue(':coluna',$coluna);
			$stm->bindValue(':pesq', '%'.$pesq.'%');
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_ASSOC);	
		}


		public  function buscaEnd($pesq){
		
			$sql = "SELECT * FROM $this->tab_end WHERE rua LIKE :pesq";
			$stm = Db::prepare($sql);
			//$stm->bindValue(':coluna',$coluna);
			$stm->bindValue(':pesq', '%'.$pesq.'%');
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_ASSOC);	
		}



		public function insertNum(Telefone $num){
			try{
				$sql = "INSERT INTO $this->tab_tel (numero,celular) values (:numero,:celular)";	
				$stm = Db::prepare($sql);
				$stm->bindValue(':numero',$num->getNumero());
				$stm->bindValue(':celular',$num->getCelular());
				$stm->execute();
				$id =  Db::lastId();
				return $id;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function insertEnd(Endereco $end){
			try{
				$sql = "INSERT INTO $this->tab_end (rua,bairro,cidade,referencia,cep) values (:rua,:bairro,:cid,:ref,:cep)";	
				$stm = Db::prepare($sql);
				$stm->bindValue(':rua',$end->getRua());
				$stm->bindValue(':bairro',$end->getBairro());
				$stm->bindValue(':cid',$end->getCidade());
				$stm->bindValue(':ref',$end->getReferencia());
				$stm->bindValue(':cep',$end->getCep());
				$stm->execute();
				$id =  Db::lastId();
				return $id;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		//Falta concerta a busca
		public function insertP(PessoaFisica $pessoaF){
			$pesqE = $this->buscaP($pessoaF->getCpf());
			
			if(count($pesqE) < 1){
				try{
					$sql = "INSERT INTO $this->tabela (nome,email,rg,cpf) values (:nome,:email,:rg,:cpf)";
					$stm = Db::prepare($sql);
					$stm->bindValue(':nome',$pessoaF->getNome());
					$stm->bindValue(':email',$pessoaF->getEmail());
					$stm->bindValue(':rg',$pessoaF->getRg());
					$stm->bindValue(':cpf',$pessoaF->getCpf());
					$stm->execute();	
					$id =  Db::lastId();
					return $id;
				}catch(PDOException $e){
					echo $e->getMessage();
				}	
			}else{
				echo "<script>alert('Email Ja cadastrado!');history.back();</script>";
			}
			
		}

		public function pessoaNum($pes, $num){
			//$buscaP = $this->buscaP($pes->getEmail());
			//$buscaN = $this->buscaNum($num->getNumero());
			if(!empty($pes) && !empty($num)){
				try{
				$sql = "INSERT INTO telefonepf (telefone_id,pessoaf_id) VALUES (:telefone_id,:pessoaf_id)";
				$stm = Db::prepare($sql);
				$stm->bindValue(':telefone_id',$num);
				$stm->bindValue(':pessoaf_id',$pes);
				$stm->execute();
				}catch(PDOException $e){
					echo $e->getMessage();
				}		
			}
		}
		public function pessoaEnd($pes,$end){
			//$buscaP = $this->buscaP($pes->getEmail());
			//$buscaE = $this->buscaEnd($end->getRua());
			if(!empty($pes) && !empty($end)){
				try{
				$sql = "INSERT INTO enderecopf (endereco_id,pessoaf_id) VALUES (:endereco_id,:pessoaf_id)";
				$stm = Db::prepare($sql);
				$stm->bindValue(':endereco_id',$end);
				$stm->bindValue(':pessoaf_id',$pes);

				$stm->execute();
				}catch(PDOException $e){
					echo $e->getMessage();
				}	
			}
		}

		public function negociar(Negociacao $neg){
			try{
				$sql = "INSERT INTO negociar (negociacao,dataV,dataT,formP,arquivo,insc_est) VALUES (:negociacao,:dataV,:dataT,:formP,:arquivo,:insc_est)";
				$stm = Db::prepare($sql);
				$stm->bindValue(':negociacao',$neg->getNegocio());
				$stm->bindValue(':dataV',$neg->getDataVis());
				$stm->bindValue(':dataT',$neg->getDataExec());
				$stm->bindValue(':formP',$neg->getFormPag());
				$stm->bindValue(':arquivo',$neg->getArquivo());
				$stm->bindValue(':insc_est',$neg->getInscEst());

				$stm->execute();
				$id =  Db::lastId();
				return $id;
				}catch(PDOException $e){
					echo $e->getMessage();
				}	
		}

		public function pessoaNeg($pes,$neg){
			if(!empty($pes) && !empty($neg)){
				try{
					$sql = "INSERT INTO negociarpf (negociar_id,pessoaf_id) VALUES (:negociar_id,:pessoaf_id)";
					$stm = Db::prepare($sql);
					$stm->bindValue(':negociar_id',$neg);
					$stm->bindValue(':pessoaf_id',$pes);
					$stm->execute();
				}catch(PDOException $e){
					echo $e->getMessage();
				}	
			}
		}


		public function updateP(PessoaFisica $pessoaF){
			$pesqE = $this->buscaP($pessoaF->getCpf());
			if(count($pesqE) < 1){
				
				try{
					$sql = "UPDATE $this->tabela SET nome = :nome , email = :email , rg = :rg , cpf = :cpf WHERE id_pes_f = :id";
					$stm = Db::prepare($sql);
					$stm->bindValue(':nome',$pessoaF->getNome());
					$stm->bindValue(':email',$pessoaF->getEmail());
					$stm->bindValue(':rg',$pessoaF->getRg());
					$stm->bindValue(':cpf',$pessoaF->getCpf());
					$stm->bindValue(':id' ,$pessoaF->getId());
					$stm->execute();
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			}
		}

		public function updateNum(Telefone $num){
			try{
				$sql = "UPDATE telefone SET numero = :numero celular = :celular WHERE id = :id";	
				$stm = Db::prepare($sql);
				$stm->bindValue(':numero',$num->getNumero());
				$stm->bindValue(':id' ,$num->getId());
				$stm->execute();
				$id =  Db::lastId();
				return $id;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function updateEnd(Endereco $end){
			try{
				$sql = "UPDATE $this->tab_end SET rua = :rua,bairro = :bairro ,cidade = :cid,referencia = :ref,cep = :cep WHERE id = :id";	
				$stm = Db::prepare($sql);
				$stm->bindValue(':rua',$end->getRua());
				$stm->bindValue(':bairro',$end->getBairro());
				$stm->bindValue(':cid',$end->getCidade());
				$stm->bindValue(':ref',$end->getReferencia());
				$stm->bindValue(':cep',$end->getCep());
				$stm->bindValue(':id',$end->getId());
				$stm->execute();
				$id =  Db::lastId();
				return $id;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function destroyPes($id_pes){
			if(!empty($id_pes)){
				$count = $this->verificaRelacao('pessoaf_id',$id_pes);
				if($count >= 1){
					try{
						$sql = "DELETE FROM telefonepf WHERE pessoaf_id = $id_pes;
								DELETE FROM enderecopf WHERE pessoaf_id = $id_pes;
								DELETE FROM negociarpf WHERE pessoaf_id = $id_pes;
								DELETE FROM $this->tabela WHERE id_pes_f = $id_pes";
					
						$stm = Db::prepare($sql);
						$stm->execute();
						return TRUE;
					}catch(PDOException $e){
						echo $e->getMessage();
					}
				}
				
			}
		}
		public function destroyTel($id_tel){
			if(!empty($id_tel)){
				try{
					$sql = "DELETE FROM $this->tab_tel WHERE id = $id_tel";
					$stm = Db::prepare($sql);
					$stm->execute();
					return TRUE;
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			}
		}
		public function destroyEnd($id_end){
			if(!empty($id_end)){
				try{
					$sql = "DELETE FROM $this->tab_end WHERE id = $id_end";
					$stm = Db::prepare($sql);
					$stm->execute();
					return TRUE;
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			}
		}



		public function verificaRelacao($coluna,$id){
			if(!empty($id)){
				try{
					$sql = "SELECT * FROM telefonepf WHERE $coluna = $id;
							SELECT * FROM enderecopf WHERE $coluna = $id;
							SELECT * FROM negociarpf WHERE $coluna = $id;";
					$stm = Db::prepare($sql);
					$stm->execute();
					$stm->fetchAll(PDO::FETCH_ASSOC); 
					$count = $stm->rowCount(PDO::FETCH_ASSOC);
					return $count;
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			}
		}
		//CONCERTA  OS DELETES QUE NÃO ESTÃO FUNCIONANDO
		//AJEITAR OS INSERT E UPDATE PRA RETORNA A OUTRA PAGINA QUANDO CADASTRAR
		//FAZER O LOGIN
		
	}
?>