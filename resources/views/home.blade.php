@extends('layouts.app')
@section('content')
<h3>Página Inicial</h3>
<p>{{$dt}}</p>

<p>Receitas : {{$soma_receitas}}</p>
<p>Despesas : {{$soma_despesas}}</p>
<p>Saldo: {{$saldo}}</p>
<div>
	<ul class = "list-unstyled">Recebimentos Previstos
		<li>Hoje : {{ $recebimentos_previstos_hoje }}</li>
		<li>M<span>&ecirc;</span>s : {{ $recebimentos_previstos_mes }}</li>
	</ul>
</div>
<div>
	<ul class = "list-unstyled">Pagamentos Previstos
		<li>Hoje : {{ $pagamentos_previstos_hoje }}</li>
		<li>M<span>&ecirc;</span>s : {{ $pagamentos_previstos_mes }}</li>
	</ul>
</div>
<div>
	<ul class = "list-unstyled">Contas Vencidas este M<span>&ecirc;</span>s
		<li>Recebimentos : {{ $recebimentos_atraso_mes }}</li>
		<li>Pagamentos : {{ $pagamentos_atraso_mes }}</li>
	</ul>
</div>
@endsection
