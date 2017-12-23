$(document).ready(function () {

 $('#sidebarCollapse').on('click', function () {
		     $('#sidebar').toggle();
		 });

		$('#searchname').keyup(function() {
			 var term = $('#searchname').val();
				console.log(term);
				if(term !== ''){
				var resultado=[];
				var nomes=[];
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			   $.ajax({url: "/autocomplete/"+term,data: {_token: CSRF_TOKEN},
    				dataType: 'JSON',
    				success: function (data) {
		      		console.log(data);
				 			console.log(typeof(data.results));
							resultado = data.results;
							nomes = resultado.map(function(r){return r.nome});
							console.log(nomes);

							$('#searchname').autocomplete({
					
							source:nomes,
						    minlength:1,
						    autoFocus:true,
						    select:function(e,ui)

						    {
						        $('#searchname').val(ui.item.value);
						    }

					 	 });//autocomplete

						$('#searchname').on( "autocompleteselect", function( event, ui ) {
							console.log('AUTOCOMPLETESELECT');
							console.log('nomes');

							console.log(ui.item.value);
									console.log(typeof(ui.item.value));
							var index = nomes.indexOf(ui.item.value);
							if(index !=-1){
								console.log('index'+index);
								var telefone= resultado[index].telefone;
								if(telefone){
								console.log(telefone);
								$('input[name="telefone"]').val(telefone);
								}
								var documento= resultado[index].documento;
								if(documento){
								console.log(documento);
								$('input[name="telefone"]').val(documento);
							}						
							}
						}); //autocomplete select

    			}//success

			});//ajax 
		}
		});//searchname keyup event
		
		 $("input[name='n_pagtos']").change(function(){ 
   if($('#n_pagtos').val()>1){
     $("#intervalo_pagtos").show();
    }else{
     $("#intervalo_pagtos").hide();
    }
    });

 $("#mostra-cal-1").click(function(){
        $("#cal-1").toggle();
        $("#cal-2").hide();
    });

 $("#mostra-cal-2").click(function(){
        $("#cal-2").toggle();
        $("#cal-1").hide();
    });

 $("#esconde-cal-1").click(function(){
        $("#cal-1").hide();
    });

 $("#esconde-cal-2").click(function(){
        $("#cal-2").hide();
    });

	$("#form-datas-1").submit(function(){
					
					/*var dt1 = $("#data1").val();
					var dt2 = $("#data2").val();

					console.log(dt1 + ',' +dt2);
*/
					$("#cal-1").hide();
		});

	$("#form-datas-2").submit(function(){
				/*	
					var dtu = $("#data-unica").val();
					console.log(dtu);
			*/
					$("#cal-2").hide();
		});


//calcula o valor residual das baixas de conta a receber automaticamente

	var v_total_inicial = $("#valor_total").val();
//para nao ficar aparecendo a mensagem de que a variavel nao existe se estiver em outra view
	if(!v_total_inicial){
  	 v_total_inicial= '';
	}

	var v_total_inicial_num = Number((v_total_inicial.replace(/\,/,'.')).trim());

   var v_residual_inicial = $("#valor_residual").val();
		if(!v_residual_inicial){
  	v_residual_inicial= '';
	}

   var v_residual_inicial_num = Number((v_residual_inicial.replace(/\,/,'.')).trim());
  console.log('valor inicial: ' +v_residual_inicial_num); 
  
    $("#valor_total").keyup(function(){
    	var v_total = $("#valor_total").val();
      console.log(v_total);

			//caso o usuario coloque um ponto para separar os centavos,trocar por virgula
			var v_total2 = v_total.replace(/\./,','); 
       $("#valor_total").val(v_total2);
        //var v_receb_number = Number(v_receb.replace(/\,/,'.'));
        var v_total_num = Number((v_total.replace(/\,/,'.')).trim());
      console.log(v_total_num);
      
      var diff = (v_total_inicial_num - v_total_num).toFixed(2);
      console.log(diff);
      console.log(typeof(diff));
 
       $("#valor_residual").val(diff.replace(/\./,','));
      console.log(typeof($("#valor_residual").val()));

    });


    $("#valor_residual").keyup(function(){
    	var v_res = $("#valor_residual").val();
      console.log(v_res);

			//caso o usuario coloque um ponto para separar os centavos,trocar por virgula
			var v_res2 = v_res.replace(/\./,','); 
       $("#valor_residual").val(v_res2);


        var v_res_num = Number((v_res.replace(/\,/,'.')).trim());
      console.log(v_res_num);
      
      var diff2 = (v_total_inicial_num - v_res_num).toFixed(2);
      console.log(diff2);
      console.log(typeof(diff2));
 
       $("#valor_total").val(diff2.replace(/\./,','));
      console.log(typeof($("#valor_total").val()));

    });

//formulario novo movimento caixa

 $("#tipo").change(function(){
		console.log($("#tipo").val());
		$("#mensagem").val('nova '+ $("#tipo").val() +'adicionada');
	
 	});

//botoes de filtro para a tabela do caixa

    $("#mostrar-receitas").click(function(){
        $(".tr-despesa").hide();
		$(".tr-receita").show();

    });
        $("#mostrar-despesas").click(function(){
        $(".tr-receita").hide();
      	$(".tr-despesa").show();

    });
		
        $("#mostrar-todos").click(function(){
        $(".tr-receita").show();
      	$(".tr-despesa").show();
	
    });

//botoes de filtro para a tabela contas

    $("#mostrar-atrasados").click(function(){
    $("tr[class!='atrasado']").hide();
			$(".total").hide();
//$("tr[class!='atrasado']").css('background','yellow');
				$(".atrasado").show();
			
    });

        $("#mostrar-no-prazo").click(function(){
        $(".atrasado").hide();
				$(".total").hide();
				$("tr[class!='atrasado']").show();
    });
		
    $("#mostrar-rec-parcial").click(function(){
        $(".recebimento parcial").show();
			$(".total").hide();
				$("tr[class!='recebimento parcial']").hide();
    });

    $("#mostrar-todos").click(function(){
      $("tr[class!='recebimento parcial']").show(); 
			$("tr[class!='atrasado']").show();
			 $(".atrasado").show();
			$(".recebimento parcial").show();
			$(".total").show();
    });

    $("#mostrar-pag-parcial").click(function(){
        $(".pagamento parcial").show();
			$(".total").hide();
				$("tr[class!='pagamento parcial']").hide();
    });


//contas a receber em atraso
	

$(".atrasado").css( "color", "#d9534f" ); //cor vermelha

//incluir despesas fixas
 $("#despesa-fixa").click(function(){
        $("#nova-despesa-fixa").toggle();
  
    });
 $(".despesa-fixa-fechar").click(function(){
        $("#nova-despesa-fixa").hide();
  
    });

/* $(".df-editar").click(function(){
        $("#despesa-fixa-editar").toggle();
  
    });

 $(".df-editar-fechar").click(function(){
        $("#despesa-fixa-editar").hide();
  
    });
*/


var modal = document.getElementById('myModal');

// abre o modal
$("button[class^='myBtn']").click(function() {

 var num = this.className;
var n = num.substr(num.indexOf('-') + 1);

console.log(n);

var valor = $(this).parent().prev().text();
var cat = $(this).parent().prev().prev().text();
var desc = $(this).parent().prev().prev().prev().text();


$("#modal-desc").val("" +desc +"");
$("#modal-cat").val("" +cat +"");
$("#modal-valor").val("" +valor +"");

 $("#myModal").show();
});

//fecha o modal
$(".close").click(function() {
	//modal.hide();
 $("#myModal").hide();
});

//fecha o modal quando o usuário clicar fora
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

 var r3m = $("#r3m").text();
 var r3d = $("#r3d").text();


//saldo do mes na página inicial

var saldo_mes = $("#saldo-mes").text();
console.log('saldo domes ' +saldo_mes);
if(saldo_mes > 0){
	$("#saldo-mes").parent().css('color','#337ab7')	;
}

if(saldo_mes < 0){
	$("#saldo-mes").parent().css('color','#d9534f')	;
}

if(saldo_mes == 0){
	$("#saldo-mes").parent().css('color','#333')	;
}




//grafico de barras receitas x despesas dos últimos 3 meses na página inicial
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Receitas", "Despesas"],
        datasets: [{
            label: 'últimos 3 meses',
            data: [r3m, r3d],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)'

            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255,99,132,1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
});
