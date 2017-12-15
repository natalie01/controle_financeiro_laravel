@extends('layouts.app')
@section('content')
<h2>Nova Despesa</h2>
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
        <input type="hidden" name="mensagem" value="nova despesa adicionada" />  
	<div class="row">
	<input type="hidden" name="tipo" value="despesa" />
		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Descri<span> &ccedil; </span><span>&atilde;</span>o:</label><br />
		      <input type="text" name="descricao" required list="sugestoes"/>  
					<datalist id="sugestoes">
						<option value="baixa de conta a pagar">
						<option value="conta de água">
						<option value="conta de luz">
						<option value="material de escritório">
						<option value="limpeza">
						<option value="combustível">
						<option value="outro">
					</datalist>
		    </div>
      </div>
     </div>
      

   <div class="row">
     			<div class="col-md-6">
             <div class="form-group">
               <label>Data Emiss<span>&atilde;</span>o</label><br />
		    					<input type="date" name="dataemissao"  pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"
										placeholder ="{{ $datahoje }}" value="{{ old('dataemissao') }}"/>
	 	    			</div>
   			 </div>
		 </div> 
     
    <div class="row">
      		 <div class="col-md-6">
             <div class="form-group">
              <label>Valor:</label><br />
		    			<input type="text" name="valor" placeholder = "0,00" required 
								pattern="^(\d)*(\,\d{2}){0,1}$" value="{{ old('valor') }}"/>
	 	    		</div>
     		 </div>
   
     </div>
        
     
   </div> 
       <input  type="submit" class="btn
	btn-primary btn-block" value="salvar">
   </form>  
  
    <br>
    <a class = "btn btn-danger" id="flip-up">Cancelar</a>
 </div>

@endsection