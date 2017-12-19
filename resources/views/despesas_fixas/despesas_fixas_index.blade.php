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
<p>Coloque aqui as despesas que ocorrem todo m<span>&ecirc;</span>s</p>
			<form  action="#"  class="form-horizontal"  method="post">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
 			<input type="hidden" name="mensagem" value="despesa fixa adicionada" /> 	  
			
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
							 <option value="contador">
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
						<option value="Aluguel">
						<option value="Eletricidade">
						<option value="Água">
						<option value="Telefone e Internet">
						<option value="Impostos">
						<option value="Contador">
						<option value="Material">
						<option value="outror">
					</datalist>
		    </div>
      </div>

		<div class="col-md-2">
			 <div class="form-group">
					<label></label><br />
				   <input  type="submit" class= "despesa-fixa-fechar btn btn-primary btn-block" value="salvar">
			 </div> 
		 </div>
     </div><!--row-->
	</form>
	<div class="row">
	<button  class= "despesa-fixa-fechar btn btn-danger">Cancelar</button>
	</div>
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

			<table class= "table3">
				<thead>
				<tr>
						  <th>Descri<span>&ccedil;</span><span>&atilde;</span>o</th>
						  <th>Categoria</th>
						  <th>valor</th>
 							<th colspan = "2"></th>
				</tr>
					</thead>
				<tbody>
			 @foreach ($resultados as $r)
		<tr class ="{{$r->id}}">
					<td >{{$r->descricao}}</td>
					<td>{{$r->categoria}}</td>
					<td>{{$r->valor}}</td>
		<td>
		<button aria-label="editar" class="myBtn-{{$r->id}}">
		<span><i class="fa fa-pencil" aria-hidden="true" title="editar"></i></button>
	

		</td>

					<td>
								<form action="{{route('despesas_fixas.destroy',$r->id)}}" method="POST">
									<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

									 <input type="hidden" name="_method" value="delete">
							<button type ="submit" class="btn-excluir"  onclick="return confirm('exclui despesa?')">
								<span><i class="fa fa-trash-o fa-2x" aria-hidden="true" title="excluir"></i></span></button>
								 <span class="sr-only">excluir</span>
								</form>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>

	</div>

<!-- Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3>Editar Despesa Fixa</h3>
    </div>
    <div class="modal-body">
			<form action="{{route('despesas_fixas.update',$r->id)}}" class="form-horizontal"  method="post">
			    <input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
 			<input type="hidden" name="mensagem" value="despesa fixa atualizada" /> 	  
			
			<div class="row">
			<div class="col-md-2">
             <div class="form-group">
              <label>Valor:</label><br />
		    			<input type="text" name="valor" placeholder = "0,00" required 
								pattern="^(\d)*(\,\d{2}){0,1}$" id="modal-valor"/>
	 	    		</div>
     		 </div>

				<div class="col-md-4">
				   <div class="form-group">
				     <label>Descri<span> &ccedil; </span><span>&atilde;</span>o:</label><br />
				    <input type="text" name="descricao" list="sugestoes" id ="modal-desc"/>  
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
							 <option value="contador">
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
		      <input type="text" name="categoria" list="categorias" id="modal-cat"/>  
					<datalist id="categorias">
						<option value="Aluguel">
						<option value="Eletricidade">
						<option value="Água">
						<option value="Telefone e Internet">
						<option value="Impostos">
						<option value="Contador">
						<option value="Material">
						<option value="outror">
					</datalist>
		    </div>
      </div>

		<div class="col-md-2">
			 <div class="form-group">
					<label></label><br />
				   <input  type="submit" class= "close btn btn-primary btn-block" value="salvar">
			 </div> 
		 </div>
     </div><!--row-->
	</form>
	<div class="row">
	<button  class= "close btn btn-danger">Cancelar</button>
	</div>
    </div><!--row-->

  </div>

</div><!-- Modal -->

	
@endif
</div><!--container-->
@endsection