$(document).ready(function () {
		 $('#sidebarCollapse').on('click', function () {
		     $('#sidebar').toggleClass('active');
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

	var v_recebido_inicial = $("#valor_recebido").val();
//para nao ficar aparecendo a mensagem de que a variavel nao existe se estiver em outra view
	if(!v_recebido_inicial){
  	 v_recebido_inicial= '';
	}

	var v_recebido_inicial_num = Number((v_recebido_inicial.replace(/\,/,'.')).trim());

   var v_residual_inicial = $("#valor_residual").val();
		if(!v_residual_inicial){
  	v_residual_inicial= '';
	}

   var v_residual_inicial_num = Number((v_residual_inicial.replace(/\,/,'.')).trim());
  console.log('valor inicial: ' +v_residual_inicial_num); 
  
    $("#valor_recebido").keyup(function(){
    	var v_receb = $("#valor_recebido").val();
      console.log(v_receb);

			//caso o usuario coloque um ponto para separar os centavos,trocar por virgula
			var v_receb2 = v_receb.replace(/\./,','); 
       $("#valor_recebido").val(v_receb2);
        //var v_receb_number = Number(v_receb.replace(/\,/,'.'));
        var v_receb_num = Number((v_receb.replace(/\,/,'.')).trim());
      console.log(v_receb_num);
      
      var diff = (v_recebido_inicial_num - v_receb_num).toFixed(2);
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
      
      var diff2 = (v_recebido_inicial_num - v_res_num).toFixed(2);
      console.log(diff2);
      console.log(typeof(diff2));
 
       $("#valor_recebido").val(diff2.replace(/\./,','));
      console.log(typeof($("#valor_recebido").val()));
    });


 });
