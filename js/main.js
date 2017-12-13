$(document).ready(function(){

	var dados = [];
	$('.pont').each(function(){
		dados.push($(this).attr('value'));
	});

//Configuracoes
	var dashboard = document.getElementById('grafico_barras');
	var _x = 0;
	var docHeight = document.documentElement.clientHeight- 20; // - 20 jsFiddle hack
	var docWidth = document.documentElement.clientWidth - 20;
	dashboard.height = docHeight;
	dashboard.width = docWidth;
	var ctx;
	// objeto para ser preenchido do tipo Grafico Barras
	var grafico = {
	    columnWidth: 50,
	    cor: '#0d9349',
	    gap: 5,
	    dataProvider:null,
	    barras:function(valor){
	        ctx = dashboard.getContext('2d');
	        var posicaoVertical = ctx.canvas.clientHeight-valor;
	        ctx.beginPath();
	        // posicionar no bottom
	        ctx.rect(_x,posicaoVertical,this.columnWidth,valor);
	        ctx.fillStyle=this.cor;
	        ctx.fill();
	        // adicionar valor superior
	        ctx.font = '12pt Calibri';
	        ctx.fillStyle="#0d9349";
	        ctx.fillText(valor,_x+ this.columnWidth*0.2,posicaoVertical-5);
	        ctx.closePath();
	        if(_x > dashboard.width)
	        {
	            _x = -columnWidth;
	            ctx.clearRect(0,0,dashboard.width,dashboard.height);
	            ctx.translate(0,0);
	            ctx.save();
	        }
	    },
	    init: function(){
	            for(var i=0;i<this.dataProvider.length;i++)
	            {
	                this.barras(this.dataProvider[i],this.cor);
	                 _x+=this.columnWidth+ this.gap;// incremento a posicao horizontal
	            }
	    }
	}




	// usando um provedor de dados para preencher

	grafico.dataProvider = dados;
	grafico.columnWidth = 50; // seta largura da coluna
	grafico.init(); // inicializa

	
	
	

	//var dados = $(this).closest('tr').find('input[data-id]').data('id');
});