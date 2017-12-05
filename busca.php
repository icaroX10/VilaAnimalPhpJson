<?php
	session_start();
	if(isset($_SESSION['user'])){
	require_once("Class/Controller/BuscaController.class.php");
	$busca = new BuscaController();
	$req = 0;
	$pg = (isset($_GET['pag'])) ? (int)$_GET['pag'] : 1;
	if(isset($_POST['Buscar'])){
		require_once("Class/Db.class.php");
		$db = new Db();
		$coluna = $_POST['txtCategoria'];
		$pesq = $_POST['txtBusca'];
		try{
			$sql = "SELECT pessoaf.id_pes_f,pessoaf.nome,pessoaf.email,pessoaf.rg,pessoaf.cpf,telefone.id as id_tel,telefone.numero,telefone.celular,endereco.id as id_end,endereco.rua,endereco.bairro,endereco.cidade,endereco.referencia,endereco.cep,negociar.id as id_neg,negociar.negociacao,negociar.dataV,negociar.dataT,negociar.formP,negociar.arquivo FROM pessoaf INNER JOIN telefonepf ON pessoaf.id_pes_f = telefonepf.pessoaf_id ";
			$stm = Db::prepare($sql);
			$stm->bindValue(':pesq', '%'.$pesq.'%');
			$stm->execute();
			if($stm->rowCount(PDO::FETCH_ASSOC)>=1){
				$teste =  $stm->fetchAll();		
			}else{
				echo "<script>alert('Nada Encontrado!');h</script>";
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		
	}
	include "php/header.php";
?>


		<h1>Buscar</h1>
			<form class="form-group" method="POST" action="busca.php?req=1">
				<label>Oque Pesquisar?</label>
				<select class="form-control" name="txtCategoria" required>
					<option disabled selected>Selecione uma opção</option>
					<option name="nome" value="nome">Nome</option>
					<option name="email" value="email">Email</option>
					<option name="cpf" value="cpf">Cpf</option>
					<option name="rg" value="rg">RG</option>
					<option name="numero" value="numero">Telefone</option>
					<option name="rua" value="rua">Rua</option>
					<option name="bairro" value="bairro">Bairro</option>
					<option name="cidade" value="cidade">Cidade</option>
					<option name="cep" value="cep">Cep</option>
					<option name="dataV" value="dataV">Data Visita</option>
					<option name="dataT" value="dataT">Data Execurção</option>
				</select>
				<label>Buscar</label>
				<input type="text" name="txtBusca" class="form-control" required>
				<input type="submit" name="Buscar" value="Buscar" class="btn btn-primary btn-lg">
			</form>
			<table id="teste1" class="table table-hover">
				<thead>
					<tr class="active">
						<th>Nome</th>
						<th>Email</th>
						<th>RG</th>
						<th>CPF</th>
						<th>Telefone</th>
						<th>Celular</th>
						<th>Rua</th>
						<th>Bairro</th>
						<th>Cidade</th>
						<th>Referência</th>
						<th>CEP</th>
						<th>Forma Pagamento</th>
						<th>Data Visita</th>
						<th>Data Execução</th>
					</tr>
				</thead>
				<tbody>
					<?php 

					if(empty($teste)){
					foreach ($busca->buscarTudo($pg) as $key => $value) { 
						?>
						<tr id="test"> 
							<td class="listO" data-nome="<?php echo $value->nome;?>"><?php echo $value->nome;?></td>
							<td class="listO" data-email="<?php echo $value->email;?>"><?php echo $value->email;?></td>
							<td class="listO" data-rg="<?php echo $value->rg;?>"><?php echo $value->rg;?></td>
							<td class="listO" data-cpf="<?php echo $value->cpf;?>"><?php echo $value->cpf;?></td>
							<td class="listO" data-numero="<?php echo $value->numero;?>"> <?php echo $value->numero;?></td>
							<td class="listO" data-celular="<?php echo $value->celular;?>"> <?php echo $value->celular;?></td>
							<td class="listO" data-rua="<?php echo $value->rua;?>"><?php echo $value->rua;?></td>
							<td class="listO" data-bairro="<?php echo $value->bairro;?>"><?php echo $value->bairro;?></td>
							<td class="listO" data-cidade="<?php echo $value->cidade;?>"><?php echo $value->cidade;?></td>
							<td class="listO" data-referencia="<?php echo $value->referencia;?>"><?php echo $value->referencia;?></td>
							<td class="listO" data-cep="<?php echo $value->cep;?>"><?php echo $value->cep;?></td>
							<td class="listO" data-form="<?php echo $value->formP;?>"><?php echo $value->formP;?></td>
							<td class="listO" data-dtv="<?php echo $value->dataV;?>"><?php echo $value->dataV;?></td>
							<td class="listO" data-dtt="<?php echo $value->dataT;?>"><?php echo $value->dataT;?></td>
							<input type="hidden" data-arq="<?php echo $value->arquivo;?>">
							<input type="hidden" data-tel="<?php echo $value->id_tel;?>">
							<input type="hidden" data-end="<?php echo $value->id_end;?>">
							<input type="hidden" data-id="<?php echo $value->id_pes_f ;?>" >
							<td><button type="button" id="butVis" name="" class="btn btn-warning butVis" data-toggle="modal" >View</button></td>
							<?php if($_SESSION['niveldeacesso'] == 1){?>
								<td><button type="button" id="butEdit" name="" class="btn btn-info butEdit" data-toggle="modal" >Editar</button></td>
								<td><button type="button" class="btn btn-danger btnExcluir" data-toggle="modal">Excluir</button></td>
							<?php }?>
						</tr>
					<?php } 
					}else{ 
						foreach ($teste as $key => $values) { 
						?>
						<tr>
							<td class="listO" data-nome="<?php echo $values->nome;?>"><?php echo $values->nome;?></td>
							<td class="listO" data-email="<?php echo $values->email;?>"><?php echo $values->email;?></td>
							<td class="listO" data-rg="<?php echo $values->rg;?>"><?php echo $values->rg;?></td>
							<td class="listO" data-cpf="<?php echo $values->cpf;?>"><?php echo $values->cpf;?></td>
							<td class="listO" data-numero="<?php echo $values->numero;?>"> <?php echo $values->numero;?></td>
							<td class="listO" data-celular="<?php echo $values->celular;?>"> <?php echo $values->celular;?></td>
							<td class="listO" data-rua="<?php echo $values->rua;?>"><?php echo $values->rua;?></td>
							<td class="listO" data-bairro="<?php echo $values->bairro;?>"><?php echo $values->bairro;?></td>
							<td class="listO" data-cidade="<?php echo $values->cidade;?>"><?php echo $values->cidade;?></td>
							<td class="listO" data-referencia="<?php echo $values->referencia;?>"><?php echo $values->referencia;?></td>
							<td class="listO" data-cep="<?php echo $values->cep;?>"><?php echo $values->cep;?></td>
							<td class="listO" data-form="<?php echo $values->formP;?>"><?php echo $values->formP;?></td>
							<td class="listO" data-dtv="<?php echo $values->dataV;?>"><?php echo $values->dataV;?></td>
							<td class="listO" data-dtt="<?php echo $values->dataT;?>"><?php echo $values->dataT;?></td>
							<input type="hidden" data-arq="<?php echo $values->arquivo;?>">
							<input type="hidden" data-tel="<?php echo $values->id_tel;?>">
							<input type="hidden" data-end="<?php echo $values->id_end;?>">
							<input type="hidden" data-id="<?php echo $values->id_pes_f ;?>" >
							<td><button type="button" id="butVis" name="" class="btn btn-warning butVis" data-toggle="modal" >View</button></td>
							<?php if($_SESSION['niveldeacesso'] == 1){?>
								<td><button type="button" id="butEdit" name="" class="btn btn-info butEdit" data-toggle="modal" >Editar</button></td>
								<td><button type="button" class="btn btn-danger btnExcluir" data-toggle="modal">Excluir</button></td>
							<?php }?>
						</tr>
						
					<?php
						}
					?>
						<a href="busca.php">Voltar</a>
				<?php
					}
					?>
				</tbody>
			</table>

			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Editar</h4>
			      </div>
			      <div class="modal-body">
			      <h1 id="teste"></h1>
			      	<form action="Class/Action/PessoaFisicaAC.php?req=2" method="POST" id="form-mod" class="form-group">
			      	
			      		<input type="hidden" id="pValorIdPes" name="txtId" value="">
			      		<input type="hidden" id="pValorIdTel" name="txtIdTel" value="">
			      		<input type="hidden" id="pValorIdEnd" name="txtIdEnd" value="">
			      		<label>Nome</label>
						<input class="form-control listP" id="txtNome" type="text" name="txtNome" value="" required></br>
						<label>Email</label>
						<input class="form-control listP" id="txtEmail" type="text" name="txtEmail" required></br>
						<label>RG</label>
						<input class="form-control listP" id="txtRg" type="text" name="txtRg" required></br>
						<label>CPF</label>
						<input class="form-control listP" id="txtCpf" type="text" name="txtCpf" required></br>
						<label>Telefone</label>
						<input class="form-control listP" id="txtNumero" type="text" name="txtNumero" required></br>
						<label>Celular</label>
						<input class="form-control"  id="txtCelular" type="text" name="txtCelular" ></br>
						<label>Rua</label>
						<input class="form-control listP" id="txtRua" type="text" name="txtRua" required></br>
						<label>Bairro</label>
						<input class="form-control listP" id="txtBairro" type="text" name="txtBairro" required></br>
						<label>Cidade</label>
						<input class="form-control listP" id="txtCidade" type="text" name="txtCidade" required></br>
						<label>Referencia</label>
						<input class="form-control listP" id="txtReferencia" type="text" name="txtReferencia" required></br>
						<label>Cep</label>
						<input class="form-control listP" id="txtCep" type="text" name="txtCep" required></br>
			      	</form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
			        <button type="button" class="salvarEdit btn btn-primary">Salvar Mudanças</button>
			      </div>
			    </div>
			  </div>
			</div>

			<div class="modal fade" id="Excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Excluir</h4>
			      </div>
			      <div class="modal-body">
			      		<form action="Class/Action/PessoaFisicaAC.php?req=3" method="POST" id="form-excl" class="form-group">
				      		<input type="hidden" id="pValorIdPesE" name="txtId" value="">
				      		<input type="hidden" id="pValorIdTelE" name="txtIdTel" value="">
				      		<input type="hidden" id="pValorIdEndE" name="txtIdEnd" value="">
			      		</form>
			        	 <h1>Deseja Realmente Excluir?</h1>

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
			        <button type="button" id="butExcluir" class="btn btn-primary">Sim</button>
			      </div>
			    </div>
			  </div>
			</div>

			<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h4 class="modal-title" id="myModalLabel">Informações</h4>
					  </div>
					  <div class="modal-body">
						    <h2>Nome</h2>
						    <h4 id="nome"></h4>
						    <h2>Email</h2>
						    <h4 id="email"></h4>
						    <h2>RG</h2>
						    <h4 id="rg"></h4>
						    <h2>Cpf</h2>
						    <h4 id="cpf"></h4>
						    <h2>Telefone</h2>
						    <h4 id="tel"></h4>
						    <h2>Celular</h2>
						    <h4 id="cel"></h4>
						    <h2>Rua</h2>
						    <h4 id="rua"></h4>
						    <h2>Bairro</h2>
						    <h4 id="bai"></h4>
						    <h2>Cidade</h2>
						    <h4 id="cid"></h4>
						    <h2>Referência</h2>
						    <h4 id="ref"></h4>
						    <h2>CEP</h2>
						    <h4 id="cep"></h4>
						    <h2>Forma Pagamento</h2>
						    <h4 id="fp"></h4>
						    <h2>Data Visita</h2>
						    <h4 id="dtv"></h4>
						    <h2>Data Execução</h2>
						    <h4 id="dtt"></h4>
						    <div class="arq">
						    	<h2>Arquivo</h2>
							    <a href="" class="butdown">
								    <figure class="pdfimage">
								    	<img src="Img/arquivoPdf.png">
								    	<figcaption id="arq"></figcaption>
								    </figure>
							    </a>
						    </div>
					  </div>
					  <div class="modal-footer">
					    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					</div>
				</div>
			</div>


			<?php 

				$qtPag = $busca->totalBusca();
				if($qtPag >= 25){
			?>
			<div class="paginacao">
				<ul>
					<li><a class="anterior" href="busca.php?pag=1">Anterior</a></li>
					<?php 
						
						if($qtPag > 1 && $pg <= $qtPag){
							for($i = 1 ; $i <= $qtPag;$i++){
								if($i== $pg){
									echo "<li><a class='ativo'>".$i."</a></li>"	;
								}else{
									echo "<li><a href='busca.php?pag=$i'>".$i."</a></li>";
								}
								
							}
						}
						echo "<li><a class='proxima' href='busca.php?pag=$qtPag'>Próxima</a></li>";
					?>
				</ul>
			</div>
			<?php }?>
		</div>
	</div>
	
<?php
	include "php/footer.php";
	}else{
		echo "<script>window.location.href  = 'index.php';</script>";		
	}
?>