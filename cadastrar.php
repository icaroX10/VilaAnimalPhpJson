<?php
	session_start();
	if(isset($_SESSION['user'])){
		include "php/header.php";
		
?>

	<h1>Cadastrar - Pessoa Fisica</h1>
	<form action="Class/Action/PessoaFisicaAC.php?req=1" method="POST" class="form-group" enctype="multipart/form-data">
		<label>Nome</label>
		<input class="form-control" type="text" name="txtNome" required></br>
		<label>Email</label>
		<input class="form-control" type="text" name="txtEmail" required></br>
		<label>RG</label>
		<input class="form-control" type="text" name="txtRg" required></br>
		<label>CPF</label>
		<input class="form-control" type="text" name="txtCpf" required></br>
		<label>Telefone</label>
		<input class="form-control" type="text" name="txtNumero" required></br>
		<label>Celular</label>
		<input class="form-control" type="text" name="txtNumero1" ></br>
		<label>Rua</label>
		<input class="form-control" type="text" name="txtRua" required></br>
		<label>Bairro</label>
		<input class="form-control" type="text" name="txtBairro" required></br>
		<label>Cidade</label>
		<input class="form-control" type="text" name="txtCidade" required></br>
		<label>Referencia</label>
		<input class="form-control" type="text" name="txtReferencia" required></br>
		<label>Cep</label>
		<input class="form-control" type="text" name="txtCep" required></br>
		<label>Data Visita</label>
		<input class="form-control" type="date" name="datVis"></br>
		<label>Data de Execução</label>
		<input class="form-control" type="date" name="datExe"></br>
		<label>Negociação</label>
		<input class="form-control" type="text" name="txtNeg" ></br>
		<label>Forma de Pagamento</label>
		<input class="form-control" type="text" name="txtFormP" required></br>
		<label>Upload de Arquivo</label>
		<input type="file" name="fileUpload">
		<input type="submit" class="btn btn-primary" name="cadastrar" value="cadastrar">
	</form>
		

<?php
	include "php/footer.php";
	}else{
		echo "<script>window.location.href  = 'index.php';</script>";		
	}

?>
