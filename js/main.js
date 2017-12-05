$(document).ready(function(){
	$('.butVis').on('click',function(){
		var id_client = $(this).closest('tr').find('input[data-id]').data('id');
		var id_tel = $(this).closest('tr').find('input[data-tel]').data('tel');
		var id_end = $(this).closest('tr').find('input[data-end]').data('end');
	    var nome = $(this).closest('tr').find('td[data-nome]').data('nome');
	    var email = $(this).closest('tr').find('td[data-email]').data('email');
	    var rg = $(this).closest('tr').find('td[data-rg]').data('rg');
	    var cpf = $(this).closest('tr').find('td[data-cpf]').data('cpf');
	    var numero = $(this).closest('tr').find('td[data-numero]').data('numero');
	    var celular = $(this).closest('tr').find('td[data-celular]').data('celular');
	    var rua = $(this).closest('tr').find('td[data-rua]').data('rua');
	    var bairro = $(this).closest('tr').find('td[data-bairro]').data('bairro');
	    var cidade = $(this).closest('tr').find('td[data-cidade]').data('cidade');
	    var referencia = $(this).closest('tr').find('td[data-referencia]').data('referencia');
	    var cep = $(this).closest('tr').find('td[data-cep]').data('cep');
	    var form = $(this).closest('tr').find('td[data-form]').data('form');
	    var dtv = $(this).closest('tr').find('td[data-dtv]').data('dtv');
	    var dtt = $(this).closest('tr').find('td[data-dtt]').data('dtt');
	    var arq = $(this).closest('tr').find('input[data-arq]').data('arq');

	    $("#nome").text(nome);
	    $("#email").text(email);
	    $("#rg").text(rg);
	    $("#cpf").text(cpf);
	    $("#tel").text(numero);
	    $("#cel").text(celular);
	    $("#rua").text(rua);
	    $("#bai").text(bairro);
	    $("#cid").text(cidade);
	    $("#ref").text(referencia);
	    $("#cep").text(cep);
	    $("#fp").text(form);
	    $("#dtv").text(dtv);
	    $("#dtt").text(dtt);
	    if(arq != ""){
	    	var dir = 'uploads/'+arq;
	    	$(".arq").show();
	    	$('.butdown').attr('href',dir);
	    	$('#arq').text(arq);	
	    }
	    

		$("#visualizar").modal('show');
	});

	$(".butEdit").on('click',function(){

		//Pegando valor da tabela e colocando em variaveis
		var id_client = $(this).closest('tr').find('input[data-id]').data('id');
		var id_tel = $(this).closest('tr').find('input[data-tel]').data('tel');
		var id_end = $(this).closest('tr').find('input[data-end]').data('end');
	    var nome = $(this).closest('tr').find('td[data-nome]').data('nome');
	    var email = $(this).closest('tr').find('td[data-email]').data('email');
	    var rg = $(this).closest('tr').find('td[data-rg]').data('rg');
	    var cpf = $(this).closest('tr').find('td[data-cpf]').data('cpf');
	    var numero = $(this).closest('tr').find('td[data-numero]').data('numero');
	    var celular = $(this).closest('tr').find('td[data-celular]').data('celular');
	    var rua = $(this).closest('tr').find('td[data-rua]').data('rua');
	    var bairro = $(this).closest('tr').find('td[data-bairro]').data('bairro');
	    var cidade = $(this).closest('tr').find('td[data-cidade]').data('cidade');
	    var referencia = $(this).closest('tr').find('td[data-referencia]').data('referencia');
	    var cep = $(this).closest('tr').find('td[data-cep]').data('cep');


		//Passando valor da tabela para os inputs do modal	    
	    $("#txtNome").val(nome);
	    $("#txtEmail").val(email);
	    $("#txtRg").val(rg);
	    $("#txtCpf").val(cpf);
	    $("#txtNumero").val(numero);
	    $("#txtCelular").val(celular);
	    $("#txtRua").val(rua);
	    $("#txtBairro").val(bairro);
	    $("#txtCidade").val(cidade);
	    $("#txtReferencia").val(referencia);
	    $("#txtCep").val(cep);


	    //Abrindo o modal
		$("#myModal").modal('show');


		//Passando valor do id pra o input hidden na busca
		$("#pValorIdPes").val(id_client);
		$("#pValorIdEnd").val(id_end);
		$("#pValorIdTel").val(id_tel);
	});

	//Função Ajax para mandar tudo do modal para o php
	$(".salvarEdit").click(function(){
		$.ajax({
			type:'POST',
			url: 'Class/Action/PessoaFisicaAC.php?req=2',
			data: $('#form-mod').serialize(),
			success: function(response) {
				alert("Pessoa atualizada!");
                window.location.replace("busca.php");
            },error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr, ajaxOptions, thrownError);
                }
			});
	});


	$('.btnExcluir').on('click', function(){
		var id_client = $(this).closest('tr').find('input[data-id]').data('id');
		var id_tel = $(this).closest('tr').find('input[data-tel]').data('tel');
		var id_end = $(this).closest('tr').find('input[data-end]').data('end');
		$("#pValorIdPesE").val(id_client);
		$("#pValorIdEndE").val(id_end);
		$("#pValorIdTelE").val(id_tel);
		$("#Excluir").modal('show');
	});

	$("#butExcluir").click(function(){
		$.ajax({
			type:'POST',
			url: 'Class/Action/PessoaFisicaAC.php?req=3',
			data: $('#form-excl').serialize(),
			success: function(response) {
				alert("Pessoa deletada!");
                window.location.replace("busca.php");
            },error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr, ajaxOptions, thrownError);
                }
			})
	});
});