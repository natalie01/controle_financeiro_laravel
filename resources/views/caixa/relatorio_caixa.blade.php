@extends('layouts.app')
@section('content')

<div class="container" >
	<div class = "titulo">
		<h1>Caixa</h1>
		<a class = "adicionar btn btn-primary" href="/novo_mov_caixa"
			title="adicionar novo" aria-label="adicionar-novo">+</a>
	</div>
		@if(isset($data))
		<div class="alert alert-info">
		<p id = "periodo">Data Hoje:  {{$data}} </p>
		</div>
		@endif

	@if(isset($c_removida))
		<div class="alert alert-info">
			<p>O registro n<span>&deg;</span> {{ $c_removida}} foi removido</p>
		</div>
	@endif

@if(old('mensagem'))
	<div class="alert alert-success">
		<strong>Sucesso!</strong>
		{{ old('mensagem') }} 
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

  <div class="btn-group btn-group-justified">
		 <a href="#" class ="btn btn-info" id="mostra-cal-1">
			   Veja outro período:
		 </a>
		<a href="#" class ="btn btn-primary" id="mostra-cal-2">Veja outro dia:
		 </a>
	</div>

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
				<div class="form-group col-md-12">
						<button type="submit" class ="btn btn-primary">OK</button>
				</div>
				</form>

			<div class="form-group col-md-12">
				<button class ="btn btn-danger" id="esconde-cal-1">cancelar</button>
			</div>
		</div>
		<br>



		<div id ="cal-2">
			<form  action="/selecionar_datas_post" id="form-datas-2" class="form-horizontal"  method="post">
				<div class="form-group col-md-12">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input type="hidden" name="periodo" value="umadata" />
					 <label>Data Início:</label><br />
						<input type="date" id="data-unica"  name ="data" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"/>
							<br />
					</div>
				<div class="form-group col-md-12">
					<button type="submit" class ="btn btn-primary">OK</button>
				</div>
				</form>

				<div class="form-group col-md-12">
					<button class ="btn btn-danger" id="esconde-cal-2">cancelar</button>	<br/>
				</div>
			</div>
		<br>

<div>
@if(empty($resultados)|| count($resultados)==0)
	<div class="alert alert-danger col-md-12">
	<p>Nenhum registro encontrado</p>
	</div>

@else
<div class="alert alert-default col-md-12">
	<p>{{count($resultados)}} resultados encontrados</p>
</div>

  <div class="btn-group btn-group-justified">
    <a href="#" class="btn btn-primary" id="mostrar-receitas">Receitas</a>
    <a href="#" class="btn btn-danger" id="mostrar-despesas">Despesas</a>
    <a href="#" class="btn btn-info" id="mostrar-todos">Todos</a>
  </div>

<br>

			<table class= "table1">
				<thead>
				<tr>
					<th>N°</th>
					<th>Data</th>
					<th>Valor</th>
						  <th>Categoria</th>
						  <th>Tipo</th>
						  <th>ref_titulo</th>
 							<th></th>
				</tr>
					</thead>
				<tbody>
			 @foreach ($resultados as $r)
				<tr class = "tr-{{$r->tipo}}">
					<td>{{$r->id}}</td>
					<td>{{$r->data}}</td>
					<td>{{$r->valor}}</td>
					<td>{{$r->categoria}}</td>
					<td>{{$r->tipo}}</td>
					<td>{{$r->ref_titulo}}</td>
					<td>
								<form action="/caixa_excluir/{{$r->id}}" method="POST">
									<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<button type ="submit" class="btn-excluir"  onclick="return confirm('deletar o registro?')">
								<span><i class="fa fa-trash-o fa-2x" aria-hidden="true" title="excluir"></i></span></button>
								 <span class="sr-only">excluir</span>
								</form>
					</td>
				</tr>
				@endforeach
			<tr colspan ="2" style="font-weight:bold" class="total">
				<td>TOTAL</td><td></td>	<td>{{$total}}<span>&nbsp;</span>R<span>&dollar;</span></td>
			</tr>
			<tr colspan ="2" style="font-weight:bold;" class="total-receitas">
				<td>Total Receitas</td><td></td>	<td>{{$soma_receitas}}<span>&nbsp;</span>R<span>&dollar;</span></td>
			</tr>
			<tr colspan ="2" style="font-weight:bold;" class="total-despesas">
				<td>Total Despesas</td><td></td>	<td>{{$soma_despesas}}<span>&nbsp;</span>R<span>&dollar;</span></td>
			</tr>
				</tbody>

			</table>
	</div>
	
@endif
</div><!--container-->
@endsection