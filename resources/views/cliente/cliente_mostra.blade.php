@extends('layouts.app')
@section('content')

<h1>Detalhes do cliente: {{$cliente->nome}} </h1>
	<ul>
		<li>
		<b>tipoPessoa:</b> {{$cliente->tipoPessoa}}
		</li>
		<li>
		<b>telefone:</b> {{$cliente->telefone}}
		</li>
	</ul>
@endsection