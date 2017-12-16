@extends('layouts.app')
@section('content')

<div class="container">
		@if(isset($datahoje))
		<p id = "hoje">Data:  {{$datahoje}}</p>
		@endif

<div class = "titulo">
	<h1>Contas a Receber</h1>
	<a class = "adicionar btn btn-primary" href="{{route('contapagar.create')}}" >+</a>
</div>

	@if(isset($c_removida))
		<div class="alert alert-info">
			<p>O registro n<span>&deg;</span> {{ $c_removida}} foi removido</p>
		</div>
	@endif

	@if(isset($mensagem))
		<div class="alert alert-success">
			<p>{{ $mensagem }}</p>
		</div>
	@endif

@if(old('msg'))
	<div class="alert alert-success">
		<strong>Sucesso!</strong>
	   {{ old('msg') }}.
	</div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

	@if(empty($contas_receber))
		<div class="alert alert-danger">
			nenhum registro encontrado
		</div>
	@else

		<p>{{ count($contas_receber)}}<span>&nbsp;</span>registros encontrados</p>
			<table class="table2">
			<thead>
					<tr>
					<th>N<span>&deg;</span>documento</th>
					<th>Devedor</th>
					<th>Data Emiss<span>&atilde;</span>o</th>
					<th>Data Vencimento</th>
					<th>Valor Total</th>
					<th>Status</th>
					<th colspan='3'></th>
					</tr>
			</thead>
			<tbody>
			@foreach ($contas_receber as $c)
				<tr>
				<td>{{ $c->id}}</td>
				<td>{{ $c->devedor }}
				<br>
				tel - 123456789
			 </td>

				<td>{{ $c->dataemissao}}</td>
				<td id = "data-vencimento">{{ $c->datavencimento}}</td>
				<td>{{ $c->valor_inicial}}</td>
				<td id = "status">{{ $c->status}} </td>

        <td>  
         <ul class ="list-icones list-icones-tabela list-unstyled">
         <li class = "flex-item-icone flex-item-icone-tabela"  id = "mostra">
						<a href="/baixa_conta_receber/{{$c->id}}"  aria-label="registrar recebimento" title="registrar recebimento">
          <span>
					<i class="fa fa-sign-in fa-2x"></i>
					<i class="fa fa-money fa-2x" aria-hidden="true"></i></span>
	        </a>  
					</li>

         <li  class = "flex-item-icone flex-item-icone-tabela" >
					<a href="{{route('contareceber.edit',$c->id)}}" aria-label="editar">
          <span><i class="fa fa-pencil fa-2x" aria-hidden="true" title="editar"></i></span>
				 </a>
			  </li>

          <li class = "flex-item-icone flex-item-icone-tabela" >
								<form action="{{route('contareceber.destroy',$c->id)}}" method="POST">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button type ="submit" class="btn-excluir"  onclick="return confirm('deletar o registro?')">
								<span><i class="fa fa-trash-o fa-2x" aria-hidden="true" title="excluir"></i></span></button>
								 <span class="sr-only">excluir</span>
								</form>
				 </li> 
          </ul> 
        </td>

				</tr>
					@endforeach
					</tbody>
				</table>
@endif
</div>
@endsection