<?php 
	require_once('../Model/Usuario.class.php');
	class UsuarioDao{
		protected $tabela = "usuario";

		function dadosPaciente(){
			try{
				$sql = "SELECT * FROM paciente INNER JOIN paciented ON paciente.id=paciented.paciente_id INNER JOIN dados ON dados.id=paciented.dados_id ";
				$stm = Db::prepare($sql);
				$stm->execute();
				return $stm->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		function verificaNick($nick){
			try{
				$sql = "SELECT * FROM paciente WHERE nickname = :nick";
				$stm = Db::prepare($sql);
				$stm->bindValue(":nick",$nick);
				$stm->execute();
				return $stm->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		function inserirPaciente($nick){
			try{
				$sql = "INSERT INTO paciente (nickname) values (:nick)";
				$stm = Db::prepare($sql);
				$stm->bindValue(":nick",$nick);
				$stm->execute();
				$id =  Db::lastId();
				return $id;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		function cadastrar(Usuario $user){
			$arrayId = array();
			$n = $this->verificaNick($user->getNickname());
			if(count($n) < 1){
				$cont =  count($user->getPontuacao());
				for($i = 0; $i < $cont; $i++){
					try{
						$sql = "INSERT INTO dados (pontuacao,tempo,data) values (:pontuacao,:tempo,:data)";
						$stm = Db::prepare($sql);
						$stm->bindValue(':pontuacao',$user->getPontuacao()[$i]);
						$stm->bindValue(':tempo',$user->getTempo()[$i]);
						$stm->bindValue(':data',$user->getDatajogo()[$i]);
						$stm->execute();
						$id =  Db::lastId();							
						$arrayId[] = $id;
						
					}catch(PDOException $e){
						echo $e->getMessage();
					}
				}
				$idP = $this->inserirPaciente($user->getNickname());
				$this->inserirPD($idP,$arrayId);
				
			}else{
				$nick = $this->verificaNick($user->getNickname());
				$idP;
				foreach($nick as $key => $value){
					$value = (object) $value;
					$idP = $value->id;
				}
				$cont =  count($user->getPontuacao());
				
				for($i = 0; $i < $cont; $i++){
					try{
						$sql = "INSERT INTO dados (pontuacao,tempo,data) values (:pontuacao,:tempo,:data)";
						$stm = Db::prepare($sql);
						$stm->bindValue(':pontuacao',$user->getPontuacao()[$i]);
						$stm->bindValue(':tempo',$user->getTempo()[$i]);
						$stm->bindValue(':data',$user->getDatajogo()[$i]);
						$stm->execute();
						$id =  Db::lastId();							
						$arrayId[] = $id;
						
					}catch(PDOException $e){
						echo $e->getMessage();
					}
				}
				$this->inserirPD($idP,$arrayId);				
			}

		}


		function inserirPD($idP,$arrayId){
			$cont = count($arrayId);
			for($i =0;$i < $cont;$i++){
				try {
					$sql = "INSERT INTO paciented (paciente_id,dados_id) values (:idp,:idd)";
					$stm = Db::prepare($sql);
					$stm->bindValue(':idp',$idP);
					$stm->bindValue(':idd',$arrayId[$i]);
					$stm->execute();
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}

		}
	}
?>