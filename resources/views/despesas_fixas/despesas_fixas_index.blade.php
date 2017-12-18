@extends('layouts.app')
@section('content')

<div class="container" >
	<div class = "titulo">
		<h1>Despesas Fixas</h1>
		<a class = "adicionar btn btn-primary" 
			title="adicionar novo" id = "despesa-fixa" aria-label="adicionar-novo">+</a>
	</div>
		@if(isset($data))
		<div class="alert alert-info">
		<p id = "periodo">Data Hoje:  {{$data}} </p>
		</div>
		@endif

	@if(isset($c_removida))
		<div class="alert alert-info">
			<p>O registro n<span>&deg;</span> {{ $c_removida}} foi removido</p>
		</div>
	@endif

@if(old('mensagem'))
	<div class="alert alert-success">
		<strong>Sucesso!</strong>
		{{ old('mensagem') }} 
	</div>
@endif

<div id ="nova-despesa-fixa">
			<form  action="#"  class="form-horizontal"  method="post">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  	  
			
			<div class="row">
			<div class="col-md-2">
             <div class="form-group">
              <label>Valor:</label><br />
		    			<input type="text" name="valor" placeholder = "0,00" required 
								pattern="^(\d)*(\,\d{2}){0,1}$" value="{{ old('valor') }}"/>
	 	    		</div>
     		 </div>

				<div class="col-md-4">
				   <div class="form-group">
				     <label>Descri<span> &ccedil; </span><span>&atilde;</span>o:</label><br />
				    <input type="text" name="descricao" list="sugestoes"/>  
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
 
     <div class="col-md-4">
		     <div class="form-group">
		       <label>Categoria</label><br />
		      <input type="text" name="categoria" list="categorias"/>  
					<datalist id="categorias">
						<option value="vendas/serviços prestados">
						<option value="baixa de conta a receber">
						<option value="outro">
					</datalist>
		    </div>
      </div>

		<div class="col-md-2">
			 <div class="form-group">
					<label></label><br />
				   <input  type="submit" id = "despesa-fixa-fechar" class="btn btn-primary btn-block" value="salvar">
			 </div> 
		 </div>
     </div><!--row-->
	</form>
	</div>

		<br>
<div>
@if(empty($resultados)|| count($resultados)==0)
	<div class="alert alert-danger col-md-12">
	<p>Nenhum registro encontrado</p>
	</div>

@else
<div class="alert alert-default col-md-12">
	<p>{{count($resultados)}} resultados encontrados</p>
</div>


<br>

			<table class= "table1">
				<thead>
				<tr>
					<th>N°</th>
					<th>Data</th>
					<th>Valor</th>
						  <th>Descri<span>&ccedil;</span><span>&atilde;</span>o</th>
						  <th>Tipo</th>
						  <th>ref_titulo</th>
 							<th></th>
				</tr>
					</thead>
				<tbody>
			 @foreach ($resultados as $r)
				<tr class = "tr-{{$r->tipo}}">
					<td>{{$r->id}}</td>
					<td>{{$r->data}}</td>
					<td>{{$r->valor}}</td>
					<td>{{$r->descricao}}</td>
					<td>{{$r->tipo}}</td>
					<td>{{$r->ref_titulo}}</td>
					<td>
								<form action="/caixa_excluir/{{$r->id}}" method="POST">
									<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<button type ="submit" class="btn-excluir"  onclick="return confirm('deletar o registro?')">
								<span><i class="fa fa-trash-o fa-2x" aria-hidden="true" title="excluir"></i></span></button>
								 <span class="sr-only">excluir</span>
								</form>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
	</div>
	
@endif
</div><!--container-->
@endsection