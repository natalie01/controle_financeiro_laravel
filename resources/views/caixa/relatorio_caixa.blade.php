@extends('layouts.app')
@section('content')

<div class="container" >

<h2>Fluxo de Caixa</h2>
		@if(isset($data))
		<div class="alert alert-success">
		<p id = "periodo">Data:  {{$data}}</p>
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

		<button class ="btn btn-primary" id="mostra-cal-1">
					<p>Selecione outro período:</p>
		</button><br>

		<div id ="cal-1">
			<form  action="/selecionar_datas_post" id="form-datas-1" class="form-horizontal"  method="post">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<input type="hidden" name="periodo" value="duasdatas" />
				<div class="form-group col-md-6">
				 <label>Data Início:</label><br />
					<input type="date" id="data-inicio" name="data1" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
				</div>
				<div class="form-group col-md-6">
					<label>Data Fim:</label><br />
					<input type="date" id="data-fim" name="data2" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
					<br>
				</div>
				<button type="submit" class ="btn btn-primary">OK</button>
			</form>
		<br>
		<button class ="btn btn-danger" id="esconde-cal-1">cancelar</button>
		</div>
		<br>

		<button class ="btn btn-primary" id="mostra-cal-2">
			<p>Selecione uma data específica para ver o resultado diário:</p>
		</button><br>
		<div id ="cal-2">
		 <form  action="/selecionar_datas_post" id="form-datas-2" class="form-horizontal"  method="post">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="periodo" value="umadata" />
				<div class="form-group col-md-6">
				 <label>Data Início:</label><br />
					<input type="date" id="data-unica"  name ="data" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
				</div>
				<button type="submit" class ="btn btn-primary">OK</button>
			</form>
			<br>
			<button class ="btn btn-danger" id="esconde-cal-2">cancelar</button>
			</div>
		<br>

@if(empty($registros))
	<div class="alert alert-danger">
	<p>Nenhum registro encontrado</p>
	</div>
@else
	<p>{{count($registros)}} registros encontrados</p>
		<p id = "aviso"></p>
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
</div><!--container-->
@endsection