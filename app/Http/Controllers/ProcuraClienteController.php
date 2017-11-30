<?php

namespace projeto_laravel\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use estoque\Produto;

class ProcuraClienteController extends Controller
{
   

 public function autocomplete()
{
	echo 'teste';

	//return response()->json($results);

return response()->json('resposta');
	}
}
