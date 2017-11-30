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
     <form action="{{route('contapagar.store')}}" id="form1" class="form-horizontal"  method="post">
	<input type="hidden"
name="_token" value="{{{ csrf_token() }}}" />
      
	<div class="row">

		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Credor:</label><br />
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
             <label>Data Vencimento:</label><br />
		    <input type="date" name="datalancamento" />
	 	    </div>
          </div>
        
          <div class="col-md-6">
             <div class="form-group">
               <label>Data Emissao</label><br />
		    <input type="date" name="dataemissao" />
	 	    </div>
          </div>
        
     </div> 
     
    <div class="row">
       <div class="col-md-6">
             <div class="form-group">
              <label>Valor:</label><br />
		    <input type="text" name="valor" />
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