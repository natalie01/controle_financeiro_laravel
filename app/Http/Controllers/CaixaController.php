<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Request;
use Illuminate\Support\Facades\DB;

use projeto_laravel\Caixa;
use projeto_laravel\Http\Requests\CaixaRequest;

class CaixaController extends Controller
{
		public function index()
		{
		  $hoje = Carbon::now();
			$data_hoje= Carbon::today();
			$inicio = $data_hoje->subDays(15);

			$hoje_format = $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			$inicio_format = $inicio->year.'-'.$inicio->month.'-'.$inicio ->day;

			//$registros= Caixa::all();
    $registros= Caixa::whereBetween('data',[$inicio_format ,$hoje_format])->orderBy('data', 'desc')->get();
		
		return view('caixa.relatorio_caixa',compact('registros','hoje_format','inicio_format'));
		}


      public function novareceita()
    {
				$hoje= Carbon::now();
				$datahoje= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
				return view('caixa.nova_receita')->with('datahoje',$datahoje);
		}

/*    public function incluir_novareceita()
    {
		return response()->json('ok');
		}
*/
      public function novadespesa()
    {
				$hoje= Carbon::now();
				$datahoje= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
				return response()->json('ok');
		}

/*
      public function incluir_novadespesa()
    {
		return response()->json('ok');
		}
*/

    public function incluir_novo_movim_caixa(CaixaRequest $request)
    {
		$params = Request::all();

			$descricao = $request->descricao;
			$str= $request->valor;
			$tipo = $request->tipo;

			function getfloat($str) { 
				if(strstr($str, ",")) { 
					$str = str_replace(",", ".", $str); // substitui ',' por '.' 
				} 
		
				if(preg_match("#([0-9\.]+)#", $str, $match)) { // procura por  '.' 
					return floatval($match[0]); 
				} else { 
					return floatval($str); 
				} 
			} 

			
			$valor= getFloat($str);

			$dataemissao = $request->dataemissao;

			if(!$dataemissao){
				$hoje= Carbon::now();
				$dataemissao= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			}

			Caixa::create(['data'=>$dataemissao,
														'valor'=>$valor,
														'descricao' => $request->descricao,
														'tipo'=>$request->tipo
														]);

		return response()->json(array('valor'=>$valor,'tipo'=>$tipo,'data'=>$dataemissao));
		}
}
