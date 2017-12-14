@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Fornecedores</h1>
	<table class="table table-striped table-bordered table-hover">
	@if(empty($fornecedores))
		<div class="alert alert-danger">
		Você não cadastrou nenhum cliente.
		</div>
	@else
  @foreach ($fornecedores as $f)
		<tr>
		<td>{{ $f->nome }}
		<br>
		tel - {{ $f->telefone }}
	 </td>

		<td id = "mostra">
		<a href="{{route('fornecedor.show',$f->id)}}" aria-label="ver detalhes">
		<span><i class="fa fa-search" aria-hidden="true" tittle="ver detalhes"></i></span>
		</a>
		</td>

		<td>
		<a href="{{route('fornecedor.edit',$f->id)}}" aria-label="editar">
		<span><i class="fa fa-pencil" aria-hidden="true" title="editar"></i></span>
		</a>
		</td>

		<td>
<form action="{{route('fornecedor.destroy',$f->id)}}" method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
		<button type ="submit" class= "btn-delete" onclick="return confirm('tem certeza que deseja excluir?')" >
				<span><i class="fa fa-trash-o" aria-hidden="true" tittle="excluir"></i></span></button>
				 <span class="sr-only">excluir</span>
		</form>
		</td>

		</tr>
	@endforeach
@endif
</table>
</div>

@if(old('nome'))
	<div class="alert alert-success">
		<strong>Sucesso!</strong>
		O fornecedor {{ old('nome') }} foi adicionado.
	</div>
@endif

@endsection

