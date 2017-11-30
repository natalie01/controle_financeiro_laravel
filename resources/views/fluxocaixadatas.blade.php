@extends('layouts.app')
@section('content')
<div id="panel">
 <form action="/fluxocaixa/resultado" id="form-datas" class="form-horizontal"  method="post">
	<input type="hidden"
name="_token" value="{{{ csrf_token() }}}" />
   <label>Data Início:</label><br />
    <input type="date" id="data-inicio" name="data1" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
    <span class="validity"></span>
	  <label>Data Fim:</label><br />
    <input type="date" id="data-fim" name="data2" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
    <span class="validity"></span>
    <button type="submit" class ="btn btn-primary">Enviar</button>

</form>
</div>
@endsection