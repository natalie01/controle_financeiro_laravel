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
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <input type="hidden" name="msg" value="conta a receber adicionada" /> 
	

 <div class="row">
       <div class="col-md-6">
             <div class="form-group">
              <label>Valor:</label><br />
		    			<input type="text" name="valor" placeholder = "0,00" required 
								pattern="^(\d)*(\,\d{2}){0,1}$" value="{{ old('valor') }}"/>
	 	    		</div>
      </div>
       <div class="col-md-3">
             <div class="form-group">
              <label>N<span>&deg;</span> de pagamentos</label><br />
		    			<input type="number" min="1" name="n_pagtos" id="n_pagtos" 
							placeholder="1" value="{{ old('n_pagtos') }}"/>
	 	    		</div>
			</div>
       <div class="col-md-3" id="intervalo_pagtos"  style="display:none;">
             <div class="form-group">
              <label>A cada </label><br />
		    			 <input type="text" name="intervalo_pagtos" 
									placeholder="30" value="{{ old('intervalo_pagtos') }}"><span>dias</span>
	 	    		</div>
      </div>
</div><!--row--> 
       
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
</div><!--row-->

 <div class="row">
  <div class="col-md-6">
             <div class="form-group">
               <label>Descri<span>&ccedil;</span><span>&atilde;</span>o:</label><br />
              		<input type="text" name="descricao" value="{{ old('descricao') }}"/>
	 	    			</div>
          </div>
        
          <div class="col-md-6">
             <div class="form-group">
               <label>Categoria:</label><br />
              <input type="text" name="categoria" value="{{ old('categoria') }}"/>
	 	   			 </div>
          </div>
  
 </div> <!--row--> 
     
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
</div><!--row-->
      
 <div class="row">
		<div class="col-md-6">
		     <div class="form-group">
		       <label>Telefone:</label><br />
		      	<input type="text" name="telefone" value="{{ old('telefone') }}" />
		 	    </div>
		</div>
 		 <div class="col-md-6">
     		 <div class="form-group">
         		 <label>Email:</label><br />
              <input type="text" name="email" value="{{ old('email') }}" />
	 	   		</div>
     </div>     
</div><!--row-->
       
     
 		<div class="form-group">
		     <input  type="submit" class="btn btn-primary btn-block" value="salvar">
		</div>
 
   </form>  
  
    <br>
	  <div class="row">
	  <a href = "/contareceber" class = "btn btn-danger">Cancelar</a>
	   </div> <!--row-->
	 </div>

@endsection