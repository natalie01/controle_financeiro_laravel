@extends('layouts.app')
@section('content')
<h1>PAGINA DE TESTE</h1>
	@if(isset($dados))
		<div class="alert alert-info">
			<p>Chegou {{ count($dados)}}</p>
		</div>
	@endif

	@if(isset($mensagem))
		<div class="alert alert-success">
			<p>{{ $mensagem }}</p>
		</div>
	@endif
@endsection
