@extends('layouts.app')
@section('content')
<h2>Nova Conta a Receber</h2>
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
     <form action="{{route('contareceber.store')}}" id="form1" class="form-horizontal"  method="post">
	<input type="hidden"
name="_token" value="{{{ csrf_token() }}}" />
      
	<div class="row">

		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Devedor:</label><br />
		      <input type="text" name="devedor" required id="searchname" value="{{ old('devedor') }}" />  
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
        
       <div class="col-md-6">
           	<div class="form-group">
								<label>Data Vencimento:</label><br />
		    				<input type="date" name="datavencimento" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" 
									placeholder ="dia/mes/ano" value="{{ old('datavencimento') }}"/>
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
       <div class="col-md-3">
             <div class="form-group">
              <label>N<span>&deg;</span> de pagamentos</label><br />
		    			<input type="number" min="1" name="n_pagtos" id="n_pagtos" 
							placeholder="1" value="{{ old('n_pagtos') }}"/>
	 	    		</div>
       <div class="col-md-3" id="intervalo_pagtos"  style="display:none;">
             <div class="form-group">
              <label>A cada </label><br />
		    			 <input type="text" name="intervalo_pagtos" 
									placeholder="30" value="{{ old('intervalo_pagtos') }}"><span>dias</span>
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