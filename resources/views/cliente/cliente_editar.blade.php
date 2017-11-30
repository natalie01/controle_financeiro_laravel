@extends('layouts.app')
@section('content')
<h2>Editar</h2>
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
     <form action="{{route('cliente.update',$c->id)}}" id="form1" class="form-horizontal"  method="POST">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
	<div class="row">

		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Nome:</label><br />
		      <input type="text" name="nome" value ="{{$c->nome}}">
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
              <input type="text" name="documento"  value ="{{$c->documento}}"/>
	 	    </div>
          </div>
     </div>
      
    <div class="row">

    	  <div class="col-md-6">
             <div class="form-group">
               <label>Telefone:</label><br />
              <input type="text" name="telefone" value ="{{$c->telefone}}" />
	 	    </div>
          </div>
        
          <div class="col-md-6">
             <div class="form-group">
               <label>Email:</label><br />
              <input type="text" name="email"  value ="{{$c->email}}"/>
	 	    </div>
          </div>
     	
    
     </div>
        
   <div class="row">
     <div class="col-md-6">
             <div class="form-group">
             <label>Rua:</label><br />
		    <input type="text" name="rua" id="rua" size="45"  value ="{{$c->rua}}"/>
	 	    </div>
          </div>
        
          <div class="col-md-6">
             <div class="form-group">
               <label>Número:</label><br />
		    <input type="text" name="numero" id="numero" size="5"  value ="{{$c->numero}}"/>
	 	    </div>
          </div>
        
     </div> 
     
    <div class="row">
       <div class="col-md-6">
             <div class="form-group">
              <label>Cidade:</label><br />
		    <input type="text" name="cidade" id="cidade" size="25"   value ="{{$c->cidade}}"/>
	 	    </div>
          </div>
        
          <div class="col-md-2">
             <div class="form-group">
            <label>Estado:</label><br />
		    <input type="text" name="estado" id="estado" size="2"  value ="{{$c->estado}}"/>
	 	    </div>
          </div>
          
             <div class="col-md-2">
             <div class="form-group">
            <label>CEP</label><br />
		    <input type="text" name="cep" id="cep" size="8"  value ="{{$c->cep}}"/>
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