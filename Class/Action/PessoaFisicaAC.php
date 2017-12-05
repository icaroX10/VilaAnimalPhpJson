<?php
	$req = filter_input(INPUT_GET, "req"); //Obtemos o valor de REQ que é passado através da URL
	require_once("../Db.class.php");
	$db = new Db();
	//$db->getInstance();
	if($req){
		require_once("../Controller/PessoaFisicaController.class.php");
		$pessoaFisicaController =  new PessoaFisicaController();
		if($req == 1){
			require_once("../Model/PessoaFisica.class.php");
			require_once("../Model/Telefone.class.php");
			require_once("../Model/Endereco.class.php");
			require_once("../Model/Negociacao.class.php");
			$pessoaFisica = new PessoaFisica();
			$telefone = new Telefone();
			$end = new Endereco();
			$neg = new Negociacao();
			$cond =  0;
			$id_p;
			$id_e;
			$id_t;
			$id_n;
			
			$pessoaFisica->setNome(filter_input(INPUT_POST, "txtNome"));
			$pessoaFisica->setEmail(filter_input(INPUT_POST, "txtEmail"));
			$pessoaFisica->setRg(filter_input(INPUT_POST, "txtRg"));
			$pessoaFisica->setCpf(filter_input(INPUT_POST, "txtCpf"));
			$telefone->setNumero(filter_input(INPUT_POST, "txtNumero"));
			$telefone->setCelular(filter_input(INPUT_POST, "txtNumero1"));
			$end->setRua(filter_input(INPUT_POST, "txtRua"));
			$end->setBairro(filter_input(INPUT_POST, "txtBairro"));
			$end->setCidade(filter_input(INPUT_POST, "txtCidade"));
			$end->setReferencia(filter_input(INPUT_POST, "txtReferencia"));
			$end->setCep(filter_input(INPUT_POST, "txtCep"));
			$neg->setDataVis(filter_input(INPUT_POST, "datVis"));
			$neg->setDataExec(filter_input(INPUT_POST, "datExe"));
			$neg->setNegocio(filter_input(INPUT_POST, "txtNeg"));
			$neg->setFormPag(filter_input(INPUT_POST, "txtFormP"));
			$neg->setInscEst(filter_input(INPUT_POST, "txtInsEst"));


			if(!empty($pessoaFisica->getNome()) && !empty($pessoaFisica->getEmail()) && !empty($pessoaFisica->getRg()) && !empty($pessoaFisica->getCpf()) && !empty($telefone->getNumero()) && !empty($end->getRua())&& !empty($end->getBairro()) && !empty($end->getCidade()) && !empty($end->getReferencia()) && !empty($end->getCep())){

				if($pessoaFisicaController->verificaAll($pessoaFisica)){
					$id_p = $pessoaFisicaController->insertP($pessoaFisica);
					$id_t = $pessoaFisicaController->insertNum($telefone);
					$id_e = $pessoaFisicaController->insertEnd($end);	
					if(!empty($id_p) && !empty($id_t) && !empty($id_e)){
						$pessoaFisicaController->pessoaNum($id_p,$id_t);
						$pessoaFisicaController->pessoaEnd($id_p,$id_e);	
					}
					$cond++;
				}else{
					echo "<script>alert('Dados Ja existem no banco!');history.back();</script>";
				}
				
			}		

			if($_FILES['fileUpload']['size'] > 0){
				try{
					date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

				    $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo
				    $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
				    $dir = '../../uploads/'; //Diretório para uploads
				    if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name)){
				    	$neg->setArquivo($new_name);
						$id_n = $pessoaFisicaController->negociar($neg);	
						$cond++;
				    } //Fazer upload do arquivo

					
				}catch(PDOException $e){
					echo $e->getMessage();
				}	
			}else{
				$id_n = $pessoaFisicaController->negociar($neg);
				$cond++;
			}
			if(!empty($id_p) && !empty($id_n)){
				$pessoaFisicaController->pessoaNeg($id_p,$id_n);
			}
			if($cond >= 2){
				echo "<script>alert('Usuario Cadastrado!');window.location.href  = '../../busca.php';</script>";
			}

		}elseif ($req == 2) {
			require_once("../Model/PessoaFisica.class.php");
			require_once("../Model/Telefone.class.php");
			require_once("../Model/Endereco.class.php");
			require_once("../Model/Negociacao.class.php");
			$pessoaFisica = new PessoaFisica();
			$telefone = new Telefone();
			$end = new Endereco();
			$neg = new Negociacao();
			$cond =  0;
			$id_p;
			$id_e;
			$id_t;
			$id_n;
			$pessoaFisica->setId(filter_input(INPUT_POST, "txtId"));
			$pessoaFisica->setNome(filter_input(INPUT_POST, "txtNome"));
			$pessoaFisica->setEmail(filter_input(INPUT_POST, "txtEmail"));
			$pessoaFisica->setRg(filter_input(INPUT_POST, "txtRg"));
			$pessoaFisica->setCpf(filter_input(INPUT_POST, "txtCpf"));
			$telefone->setId(filter_input(INPUT_POST, "txtIdTel"));
			$telefone->setNumero(filter_input(INPUT_POST, "txtNumero"));
			$end->setId(filter_input(INPUT_POST, "txtIdEnd"));
			$end->setRua(filter_input(INPUT_POST, "txtRua"));
			$end->setBairro(filter_input(INPUT_POST, "txtBairro"));
			$end->setCidade(filter_input(INPUT_POST, "txtCidade"));
			$end->setReferencia(filter_input(INPUT_POST, "txtReferencia"));
			$end->setCep(filter_input(INPUT_POST, "txtCep"));

			if(!empty($pessoaFisica->getNome()) && !empty($pessoaFisica->getEmail()) && !empty($pessoaFisica->getRg()) && !empty($pessoaFisica->getCpf()) && !empty($telefone->getNumero()) && !empty($end->getRua())&& !empty($end->getBairro()) && !empty($end->getCidade()) && !empty($end->getReferencia()) && !empty($end->getCep())){

				
				if($pessoaFisicaController->verificaAll($pessoaFisica)){
					$id_p = $pessoaFisicaController->updateP($pessoaFisica);
					$id_t = $pessoaFisicaController->updateNum($telefone);
					$id_e = $pessoaFisicaController->updateEnd($end);	
					$cond++;
					echo "<script>alert('Usuario Atualizado!');window.location.href  = '../../busca.php';</script>";
				}else{
					echo "<script>alert('Dados Ja existem no banco!');</script>";
				}
				
			}
		}elseif($req == 3){
			$idP = filter_input(INPUT_POST, "txtId");
			$idT = filter_input(INPUT_POST, "txtIdTel");
			$idE = filter_input(INPUT_POST, "txtIdEnd");
			if(!empty($idP) && !empty($idT) && !empty($idE)){
				$pessoaFisicaController->destroyPes($idP);
				
			}
		}

	}

?>