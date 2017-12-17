@extends('layouts.app')
@section('content')


<div class="container">
	@if(isset($datahoje))
	<p>Data Hoje :<span>&nbsp;</span><span  id = "hoje">{{$datahoje}}</span></p>
	@endif

	<div class = "titulo">
		<h1>Contas a Pagar</h1>
		<a class = "adicionar btn btn-primary" href="{{route('contapagar.create')}}" 
			title="adicionar novo" aria-label="adicionar-novo">+</a>
	</div>

	@if(isset($c_removida))
		<div class="alert alert-info">
			<p>O registro n<span>&deg;</span> {{ $c_removida}} foi removido</p>
		</div>
	@endif

	@if(isset($mensagem))
		<div class="alert alert-success">
			<p>{{ $mensagem }}</p>
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

@if(old('msg'))
	<div class="alert alert-success">
		<strong>Sucesso!</strong>
	   {{ old('msg') }}.
	</div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
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
				<form  action="/selecionar_datas_contas_pagar" id="form-datas-1" class="form-horizontal"  method="post">
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
			<form  action="/selecionar_datas_contas_pagar" id="form-datas-2" class="form-horizontal"  method="post">
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

	@if(empty($resultados)|| count($resultados)==0)
	<div class="alert alert-danger col-md-12">
		<p>Nenhum registro encontrado</p>
	</div>
	@else
	<div class="alert alert-default col-md-12">
	<p>{{ count($resultados)}}<span>&nbsp;</span>registros encontrados</p>
			<table class="table2">
			<thead>
					<tr>
					<th>N<span>&deg;</span><span>&nbsp;</span>documento</th>
					<th>Credor</th>
					<th>Data Emiss<span>&atilde;</span>o</th>
					<th>Data Vencimento</th>
					<th>Valor Total</th>
					<th>Status</th>
					<th colspan='3'></th>
					</tr>
			</thead>
			<tbody>
			@foreach ($resultados as $c)
				<tr class="{{ $c->status}}">
				<td>{{ $c->id}}</td>
				<td id="credor">{{ $c->credor }}
				<br>
				tel - 123456789
			 </td>

				<td>{{ $c->dataemissao}}</td>
				<td>{{ $c->datavencimento}}</td>
				<td>{{ $c->valor_inicial}}</td>
				<td>{{ $c->status}}</td>

        <td>  
         <ul class ="list-icones list-icones-tabela list-unstyled">
         <li class = "flex-item-icone flex-item-icone-tabela"  id = "mostra">
						<a href="/baixa_conta_pagar/{{$c->id}}"  aria-label="registrar recebimento" title="registrar recebimento">
          <span>
					<i class="fa fa-sign-in fa-2x"></i>
					<i class="fa fa-money fa-2x" aria-hidden="true"></i></span>
	        </a>  
					</li>

         <li  class = "flex-item-icone flex-item-icone-tabela" >
					<a href="{{route('contapagar.edit',$c->id)}}" aria-label="editar">
          <span><i class="fa fa-pencil fa-2x" aria-hidden="true" title="editar"></i></span>
				 </a>
			  </li>

          <li class = "flex-item-icone flex-item-icone-tabela" >
								<form action="{{route('contapagar.destroy',$c->id)}}" method="POST">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button type ="submit" class="btn-excluir"  onclick="return confirm('deletar o registro?')">
								<span><i class="fa fa-trash-o fa-2x" aria-hidden="true" title="excluir"></i></span></button>
								 <span class="sr-only">excluir</span>
								</form>
				 </li> 
          </ul> 
        </td>

				</tr>
					@endforeach
					</tbody>
				</table>
@endif
</div>
@endsection