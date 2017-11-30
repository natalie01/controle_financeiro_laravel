<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CaixaController extends Controller
{
      public function novareceita()
    {
				$hoje= Carbon::now();
				$datahoje= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
				return view('caixa.nova_receita')->with('datahoje',$datahoje);
		}

      public function incluir_novareceita()
    {
		return response()->json('ok');
		}

      public function novadespesa()
    {
				$hoje= Carbon::now();
				$datahoje= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
				return response()->json('ok');
		}

      public function incluir_novadespesa()
    {
		return response()->json('ok');
		}
}
