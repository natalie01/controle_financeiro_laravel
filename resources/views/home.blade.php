@extends('layouts.app')
@section('content')
<h1>DASHBOARD</h1>
<p>{{$dt}}</p>

<p>Receitas : {{$soma_receitas}}</p>
<p>Despesas : {{$soma_despesas}}</p>
<p>Saldo: {{$saldo}}</p>
<div>
	<ul>Recebimentos Previstos
		<li>Hoje : {{ $recebimentos_previstos_hoje }}</li>
		<li>M<span>&ecirc;</span>s : {{ $recebimentos_previstos_mes }}</li>
	</ul>
</div>
<div>
	<ul>Pagamentos Previstos
		<li>Hoje : {{ $pagamentos_previstos_hoje }}</li>
		<li>M<span>&ecirc;</span>s : {{ $pagamentos_previstos_mes }}</li>
	</ul>
</div>
<h1>{{$teste}}</h1>
<div>
	<ul>Contas Vencidas este M<span>&ecirc;</span>s
		<li>Recebimentos : {{ $recebimentos_atraso_mes }}</li>
		<li>Pagamentos : {{ $pagamentos_atraso_mes }}</li>
	</ul>
</div>
@endsection
