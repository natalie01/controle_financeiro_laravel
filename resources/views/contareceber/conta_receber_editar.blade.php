@extends('layouts.app')
@section('content')
<h2>Conta a Receber</h2>
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
 <div class="row">
			<strong>Titulo n<span>&deg</span> {{ $c->num_titulo}}</strong><br>
			@if($c->parcelado != 0)
			<strong>Parcela n<span>&deg</span> {{ $c->num_parcela}}</strong>
			@endif
	</div>

     <form action="{{route('contareceber.update',$c->id)}}" id="form1" class="form-horizontal"  method="post">
    <input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <input type="hidden" name="msg" value="conta a receber atualizada" /> 
	

 <div class="row">
       <div class="col-md-2">
             <div class="form-group">
              <label>Valor Total:</label><br />
		    			<input type="text" name="valor" placeholder = "0,00" required 
								pattern="^(\d)*(\,\d{2}){0,1}$" value="{{ $c->valor_inicial}} "/>
	 	    		</div>
      </div>
       <div class="col-md-2">
             <div class="form-group">
              <label>Valor Pago:</label><br />
		    			<input type="text" name="valor_pago" placeholder = "0,00" required 
								pattern="^(\d)*(\,\d{2}){0,1}$" value="{{ $c->valor_pago}} "/>
	 	    		</div>
      </div>
       <div class="col-md-2">
             <div class="form-group">
              <label>Valor Restante:</label><br />
		    			<input type="text" name="valor_restante" placeholder = "0,00" required 
								pattern="^(\d)*(\,\d{2}){0,1}$" value="{{ $c->valor_residual}}"/>
	 	    		</div>
      </div>
       <div class="col-md-2">
             <div class="form-group">
              <label>N<span>&deg;</span> de pagamentos</label><br />
		    			<input type="number" min="1" name="n_pagtos" id="n_pagtos" 
							placeholder="1" value="{{ $c->n_pagtos}}"/>
	 	    		</div>
			</div>
       <div class="col-md-2" id="intervalo_pagtos"  style="display:none;">
             <div class="form-group">
              <label>A cada </label><br />
		    			 <input type="text" name="intervalo_pagtos" 
									placeholder="30" value="{{ $c->intervalo_pagtos}}"><span>dias</span>
	 	    		</div>
      </div>
</div><!--row--> 
       
 <div class="row">
     <div class="col-md-6">
             <div class="form-group">
               <label>Data Emiss<span>&atilde;</span>o</label><br />
		    					<input type="date" name="dataemissao"  pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"
										placeholder ="dia/mes/ano"  value="{{ $c->dataemissao }}"/>
	 	    		</div>
   	 </div>
        
       <div class="col-md-6">
           	<div class="form-group">
								<label>Data Vencimento:</label><br />
		    				<input type="date" name="datavencimento" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" 
									placeholder ="dia/mes/ano" value="{{ $c->datavencimento }}"/>
	 	    		</div>
       </div>
</div><!--row-->

 <div class="row">
  <div class="col-md-6">
             <div class="form-group">
               <label>Descri<span>&ccedil;</span><span>&atilde;</span>o:</label><br />
              		<input type="text" name="descricao" value="{{ $c->descricao }}"/>
	 	    			</div>
          </div>
        
          <div class="col-md-6">
             <div class="form-group">
               <label>Categoria:</label><br />
              <input type="text" name="categoria" value="{{ $c->categoria }}"/>
	 	   			 </div>
          </div>
  
 </div> <!--row--> 
     
<div class="row">
			 <div class="col-md-6">
		     <div class="form-group">
		       <label>Devedor:</label><br />
		      <input type="text" name="devedor" required id="searchname" value="{{ $c->devedor }}" />  
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
             	 <input type="text" name="documento" value="{{ $c->documento}}" />
	 	    			</div>
         </div>
</div><!--row-->
      
 <div class="row">
		<div class="col-md-6">
		     <div class="form-group">
		       <label>Telefone:</label><br />
		      	<input type="text" name="telefone" value="{{ $c->telefone }}" />
		 	    </div>
		</div>
 		 <div class="col-md-6">
     		 <div class="form-group">
         		 <label>Email:</label><br />
              <input type="text" name="email" value="{{ $c->email }}" />
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