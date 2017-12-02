@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Contas a Receber</h1>
	@if(isset($c_removida))
		<div class="alert alert-info">
			<p>O registro n<span>&deg;</span> {{ $c_removida}} foi removido</p>
		</div>
	@endif

	@if(isset($mensagem))
		<div class="alert alert-success">
			<p>O registro foi adicionado</p>
		</div>
	@endif

	@if(empty($contas_receber))
		<div class="alert alert-danger">
			nenhum registro encontrado
		</div>
	@else

		<p>{{ count($contas_receber)}}registros encontrados</p>
			<table class="table2">
			<thead>
					<tr>
					<th>N<span>&deg;</span>documento</th>
					<th>Devedor</th>
					<th>data Emiss<span>&atilde;</span>o</th>
					<th>data Vencimento</th>
					<th>Valor</th>
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
				<td>{{ $c->datavencimento}}</td>
				<td>{{ $c->valor}}</td>

        <td>  
         <ul class ="list-icones list-icones-tabela list-unstyled">
         <li class = "flex-item-icone flex-item-icone-tabela"  id = "mostra"><a href="{{route('contareceber.show',$c->id)}}">
          <span><i class="fa fa-search fa-2x" aria-hidden="true"></i></span>
          </a>  </li>
         <li  class = "flex-item-icone flex-item-icone-tabela" ><a href="{{route('contareceber.edit',$c->id)}}">
          <span><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></span>
          </a>  </li>
          <li class = "flex-item-icone flex-item-icone-tabela" >
								<form action="{{route('contareceber.destroy',$c->id)}}" method="POST">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button type ="submit" class= "btn-delete" ><span><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></span></button>
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