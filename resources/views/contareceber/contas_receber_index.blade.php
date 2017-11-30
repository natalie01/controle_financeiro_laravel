@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Contas a Receber</h1>
@if(isset($c_removida))
	<div class="alert alert-info">
	<p>O registro n<span>&deg;</span> {{ $c_removida}} foi removido</p>
	</div>
</div>
@endif

@if(isset($mensagem))
	<div class="alert alert-success">
	<p>O registro foi adicionado</p>
	</div>
</div>
@endif



	<table class="table table-striped table-bordered table-hover">
	@if(empty($contas_receber))
		<div class="alert alert-danger">
		nenhum registro encontrado
		</div>
	@else
		<div class="alert alert-default">
		<p>{{ count($contas_receber)}}registros encontrados</p>
		</div>
	<tr>
		<td>N<span>&deg;</span>documento</td>
		<td>Devedor</td>
		<td>data Emiss<span>&atilde;</span>o</td>
		<td>data Vencimento</td>
		<td>Valor</td>
		<td colspan='3'></td>
	</tr>
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

		<td id = "mostra">
		<a href="{{route('contareceber.show',$c->id)}}">
		<span><i class="fa fa-search" aria-hidden="true"></i></span>
		</a>
		</td>

		<td>
		<a href="{{route('contareceber.edit',$c->id)}}">
		<span><i class="fa fa-pencil" aria-hidden="true"></i></span>
		</a>
		</td>

		<td>
<form action="{{route('contareceber.destroy',$c->id)}}" method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
		<button type ="submit" class= "btn-delete" ><span><i class="fa fa-trash-o" aria-hidden="true"></i></span></button>
		</form>
		</td>

		</tr>
	@endforeach
@endif
</table>
@endsection