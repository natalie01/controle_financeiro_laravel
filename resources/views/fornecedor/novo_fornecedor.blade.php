@extends('layouts.app')
@section('content')
<h2>Novo Cadastro</h2>
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
     <form action="{{route('fornecedor.store')}}" id="form1" class="form-horizontal"  method="post">
	<input type="hidden"
name="_token" value="{{{ csrf_token() }}}" />
      
	<div class="row">

		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Nome:</label><br />
		      <input type="text" name="nome" />  
		    </div>
                  </div>
   	
		
           <div class="col-md-3">
            <div class="form-group">
               <label>Tipo pessoa:</label><br />
              <label>Física
              <input type="radio" name="tipoPessoa" value="fis" id=="tipoPessoa1" />
              </label>
              <label>Jurídica
              <input type="radio" name="tipoPessoa"  value="jur" id=="tipoPessoa2"/>
              </label>
	 	    </div>
        	</div>

    	  <div class="col-md-6">
             <div class="form-group">
               <label>CPF / CNPJ:</label><br />
              <input type="text" name="documento" />
	 	    </div>
          </div>
     </div>
      
    <div class="row">

    	  <div class="col-md-6">
             <div class="form-group">
               <label>Telefone:</label><br />
              <input type="text" name="telefone" />
	 	    </div>
          </div>
        
          <div class="col-md-6">
             <div class="form-group">
               <label>Email:</label><br />
              <input type="text" name="email" />
	 	    </div>
          </div>
     	
    
     </div>
        
   <div class="row">
     <div class="col-md-6">
             <div class="form-group">
             <label>Rua:</label><br />
		    <input type="text" name="rua" id="rua" size="45" />
	 	    </div>
          </div>
        
          <div class="col-md-6">
             <div class="form-group">
               <label>Número:</label><br />
		    <input type="text" name="numero" id="numero" size="5" />
	 	    </div>
          </div>
        
     </div> 
     
    <div class="row">
       <div class="col-md-6">
             <div class="form-group">
              <label>Cidade:</label><br />
		    <input type="text" name="cidade" id="cidade" size="25" />
	 	    </div>
          </div>
        
          <div class="col-md-2">
             <div class="form-group">
            <label>Estado:</label><br />
		    <input type="text" name="estado" id="estado" size="2" />
	 	    </div>
          </div>
          
             <div class="col-md-2">
             <div class="form-group">
            <label>CEP</label><br />
		    <input type="text" name="cep" id="cep" size="8" />
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