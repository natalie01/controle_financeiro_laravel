@extends('layouts.app')
@section('content')
<h2>Nova Receita</h2>
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
     <form action="/incluir_novareceita" id="form1" class="form-horizontal"  method="post">
	<input type="hidden"
name="_token" value="{{{ csrf_token() }}}" />
      
	<div class="row">
	<input type="hidden" name="caixa" value="receita" />
		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Descri<span> &ccedil; </span><span>&atilde;</span>o:</label><br />
		      <input type="text" name="descricao" required id="searchname" value="{{ old('devedor') }}" />  
		    </div>
                  </div>
   	
		
           <div class="col-md-3">
            <div class="form-group">
               <label>Tipo pessoa:</label><br />
              <label>Física
              <input type="radio" name="tipoPessoa" value="fis" id="tipoPessoa1" />
              </label>
              <label>Jurídica
              <input type="radio" name="tipoPessoa"  value="jur" id="tipoPessoa2"/>
              </label>
	 	    </div>
        	</div>

    	  <div class="col-md-6">
             <div class="form-group">
               <label>CPF / CNPJ:</label><br />
              <input type="text" name="documento" value="{{ old('documento') }}" />
	 	    </div>
          </div>
     </div>
      
    <div class="row">

    	  <div class="col-md-6">
             <div class="form-group">
               <label>Telefone:</label><br />
              <input type="text" name="telefone" value="{{ old('telefone') }}" />
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
								pattern="^\d*(,?\d{1,2})?$" value="{{ old('valor') }}"/>
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