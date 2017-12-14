@extends('layouts.app')
@section('content')

<h1>Detalhes do cliente: {{$fornecedor->nome}} </h1>
	<ul>
		<li>
		<b>tipoPessoa:</b> {{$fornecedor->tipoPessoa}}
		</li>
		<li>
		<b>telefone:</b> {{$fornecedor->telefone}}
		</li>
	</ul>
@endsection