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
    });

 $("#mostra-cal-2").click(function(){
        $("#cal-2").toggle();
    });

 $("#esconde-cal-1").click(function(){
        $("#cal-1").hide();
    });

 $("#esconde-cal-2").click(function(){
        $("#cal-2").hide();
    });

	$("#form-datas-1").submit(function(){
					
					var dt1 = $("#data1").val();
					var dt2 = $("#data2").val();

					console.log(dt1 + ',' +dt2);
					$("#cal-1").hide();
		});

	$("#form-datas-2").submit(function(){
					
					var dtu = $("#data-unica").val();
					console.log(dtu);
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

//contas a receber em atraso
	
/*
$(".table2 tr").each(function() {
    //var id = $(this).attr("id");
		//console.log(id);
    // compare id to what you want
		var hoje = $("#hoje").text();
		var data_vencimento =$("#data-vencimento").text();
		var status = $("#status").text();
console.log(data_vencimento);
		if(hoje > data_vencimento){
			console.log('atrasado');
		}
	
	});
*/
});
