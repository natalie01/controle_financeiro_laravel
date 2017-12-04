<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
//use Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use projeto_laravel\Caixa;
use projeto_laravel\Http\Requests\CaixaRequest;

class CaixaController extends Controller
{
		public function index()
		{

	  $hoje = Carbon::now();
			$data_hoje = Carbon::today();
			$inicio = $data_hoje->subDays(15);

			$fim_format = $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			$inicio_format = $inicio->year.'-'.$inicio->month.'-'.$inicio ->day;

			//$registros= Caixa::all();
    $registros= Caixa::whereBetween('data',[$inicio_format ,$fim_format])->orderBy('data', 'desc')->get();
		
		return view('caixa.relatorio_caixa',compact('registros','fim_format','inicio_format'));
/*
$teste = $request->teste;
return view('caixa.relatorio_caixa',compact('teste'));
*/

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

//selecionar datas para filtrar os dados a serem mostrados
	public function selecionar_datas($dt)
	{
		//$dt é uma string no formato &YYYY-MM-DD&YYYY-MM-DD onde a data inicial é a que vem no inicio 
	if($dt && $dt!== ''){
		$string = $dt;
	}


	$dt1 = substr($dt,1,10); //extrai a primeira data da string $dt
	$dt2 = substr($dt,12,10); //extrai a segunda data da string $dt

	//$dt3 = substr($dt,23,10); 

	if($dt2 == false){
		$dt2 = '';
	}

	$data_inicio	= Carbon::parse($dt1);
/*	$data_fim	= Carbon::parse($dt2);//se $dt2 for vazio usa a data atual

	$fim_format = $data_inicio->year.'-'.$data_inicio->month.'-'.$data_inicio->day;
	$inicio_format = $data_fim->year.'-'.$data_fim->month.'-'.$data_fim->day;

return redirect()->route('profile', ['id' => 1]);

 	return response()->json(array(
											'$dt1' => $dt1 ,'$dt2' => $dt2,
											'data_inicio'=>$data_inicio,'data_fim'=>$data_fim,
											'inicio_format'=>$inicio_format,'fim_format'=>$fim_format
			              ));
*/
 	return response()->json(array(
											'$dt1' => $dt1 ,'$dt2' => $dt2,
											'data_inicio'=>$data_inicio
			              ));
	}

public function selecionar_datas_post(Request $request)
{

/*$teste = $request->teste;
return view('caixa.relatorio_caixa',compact(''));
*/

	return response()->json(array($request));
}

}
