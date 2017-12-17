@extends('layouts.app')
@section('content')
<h1>PAGINA DE TESTE</h1>

	@if(empty($resultados))
		<div class="alert alert-danger">
			nenhum registro encontrado
		</div>
	@else
		<div class="alert alert-info">
			<p>Chegou {{ count($resultados)}}</p>
		</div>
	@endif

		@if(isset($mensagem_sem_data))
		<div class="alert alert-danger">
		<p >{{$mensagem_sem_data}}</p>
		</div>
		@endif

		@if(isset($mensagem_uma_data))
		<div class="alert alert-warning">
		<p >{{$mensagem_uma_data}}</p>
		</div>
		@endif
@endsection
