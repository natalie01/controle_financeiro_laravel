@extends('layouts.app')
@section('content')
@if(isset($tipo))
<h2>Nova {{ $tipo }}</h2>
@else
<h2>Nova Movimenta<span>&ccedil;</span><span>&atilde;</span>o</h2>
@endif

	@if (count($errors) > 0)
		<div class="alert alert-danger">
		<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
		</ul>
		</div>
	@endif

  <div class="container" id ="panel">
     <form action="/incluir_novo_movim_caixa" id="form1" class="form-horizontal"  method="post">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
@if(isset($mensagem))
  <input type="hidden" name="mensagem" value={{$mensagem}} />    
@else
	<input type="hidden" name="mensagem"  value="novo mov. caixa adicionado" id = "mensagem"/>  
@endif

    <div class="row">
     			<div class="col-md-3">
             <div class="form-group">
               <label>Data Emiss<span>&atilde;</span>o</label><br />
		    					<input type="date" name="dataemissao"  pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"
										placeholder ="{{ $datahoje }}" value="{{ old('dataemissao') }}"/>
	 	    			</div>
   			 </div>
		 </div> 
     
    <div class="row">
      		 <div class="col-md-3">
             <div class="form-group">
              <label>Valor:</label><br />
		    			<input type="text" name="valor" placeholder = "0,00" required 
								pattern="^(\d)*(\,\d{2}){0,1}$" value="{{ old('valor') }}"/>
	 	    		</div>
     		 </div>

        <div class="col-md-3">
             <div class="form-group">
						@if(isset($tipo_pessoa))
              <label>{{ $tipo_pessoa}}</label><br />
						@else
              <label>Recebido de / Pago a </label><br />
             @endif
		    			<input type="text" name="pessoa" />
	 	    		</div>
     		 </div>

		@if(isset($tipo))
		<input type="hidden" name="tipo" value={{$tipo}}/>
		@else
     <div class="col-md-6">
		     <div class="form-group">
		       <label>Tipo</label><br />
					<input type="text" name="tipo" list="tipos" id="tipo"/>  
						<datalist id="tipos">
							<option value="receita ">
							<option value="despesa">
						</datalist>
				  </div>
		 </div>
		@endif
     </div><!--row-->
        
  	<div class="row">
				<div class="col-md-6">
				   <div class="form-group">
				     <label>Categoria</label><br />
				    <input type="text" name="categoria" list="sugestoes"/>  
							<datalist id="sugestoes">
							<option value="receitas">
								<option value="vendas/serviços prestados">
								<option value="baixa de conta a receber">
							 <option value="outro">
								 <option value="despesas">
								<option value="aluguel">
								<option value="conta de água">
							 <option value="conta de luz">
							 <option value="limpeza">
							 <option value="material de escritório">
							 <option value="impostos">
							 <option value="pessoas">
								<option value="baixa de conta a pagar">
								<option value="alimentação">
								<option value="telefone">
								<option value="internet">
								<option value="combustível">
								<option value="transporte">
								<option value="baixa de conta a pagar">
							<option value="outro">
							</datalist>
				  </div>
		    </div>
  </div>

  	<div class="row">
				<div class="col-md-6">
	 			<div class="form-group">
       		<input  type="submit" class="btn btn-primary btn-block" value="salvar">
   </div> 
  </div>
  </div>
   </form>  
  
    <br>
  	<div class="row">
  	  <a class = "btn btn-danger" href = "/relatorio_caixa">Cancelar</a>
	 </div>
 </div>

@endsection