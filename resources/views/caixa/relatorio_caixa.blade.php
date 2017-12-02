@extends('layouts.app')
@section('content')

<div class="container" >

<h2>Fluxo de Caixa</h2>
@if(empty($registros))
	<div class="alert alert-danger">
	<p>Nenhum registro encontrado</p>
	</div>
@else
	<p>{{count($registros)}} registros encontrados</p>

		<p>entre as datas  {{$inicio_format}} e {{$hoje_format}} </p>

			<table class= "table1">
				<thead>
				<tr>
					<th>N°</th>
					<th>Data</th>
					<th>Valor</th>
						  <th>Descricao</th>
						  <th>Tipo</th>
						  <th>ref_titulo</th>
				</tr>
					</thead>
				<tbody>
			 @foreach ($registros as $r)
				<tr>
					<td>{{$r->id}}</td>
					<td>{{$r->data}}</td>
					<td>{{$r->valor}}</td>
					<td>{{$r->descricao}}</td>
					<td>{{$r->tipo}}</td>
					<td>{{$r->ref_titulo}}</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		
@endif
</div>
@endsection