@extends('layouts.app')
@section('content')
<ul>
 @foreach ($datas as $d)	
	<li>{{$d}}</li>
</ul>
	@endforeach
@endsection