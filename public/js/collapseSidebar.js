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

 });
