@extends('layouts.app')
@section('content')
<h2>Baixa de Conta a Pagar</h2>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
		<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
		</ul>
		</div>
	@endif

@if(isset($datahoje))
	<h3>Data {{$datahoje}}	</h3>
@else  
	<h3>A data nao veio :(</h3>  
@endif

  <div class="container" id ="panel">
     <form action="/baixa_pagar_salvar" id="form1" class="form-horizontal"  method="post">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      
	<div class="row">

		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Data:</label><br />
					@if(isset($datahoje))
						<input type="data" name="data" value="{{$datahoje}}"/>
					@else  
		      	<input type="data" name="data" required />  
					@endif
		    </div>
      </div>

		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Valor Pago:</label><br />
					@if(isset($valor))
		      <input type="text" name="valor_pago" required id="valor_pago" 
							 placeholder = "{{$valor}}" value = "{{$valor}}" pattern="^\d*(,?\d{1,2})?$"/>
					@else  
		      	<input type="text" name="valor_pago" required id="valor_pago"
						 pattern="^(\d)*(\,\d{2}){0,1}$" />
					@endif  
		    </div>
      </div>

   </div> <!--row-->

	<div class="row">

		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Valor Residual:</label><br />
		      <input type="text" name="valor_residual" id="valor_residual" placeholder = "0,00" value = "0,00"
					 pattern="^\d*(,?\d{1,2})?$"/>  
		    </div>
      </div>
		  <div class="col-md-6">
		     <div class="form-group">
		       <label>Referente ao título N<span>&deg;</span>:</label><br />
					@if(isset($ref))
		      	<input type="text" name="ref_conta_pagar" readonly id="ref_conta_pagar" value="{{$ref}}"/>
					@else  
		      	<input type="text" name="ref_conta_pagar" required id="ref_conta_pagar" />
					@endif
		    </div>
      </div>

   </div> <!--row-->

       <input  type="submit" class="btn btn-primary btn-block" value="salvar">
   </form>  
  
    <br>
    <a class = "btn btn-danger" id="flip-up">Cancelar</a>
 </div><!--container-->

@endsection