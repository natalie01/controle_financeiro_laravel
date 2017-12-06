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

			$dt1 = $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			$dt2 = $inicio->year.'-'.$inicio->month.'-'.$inicio ->day;
			$data = 'entre '.$dt1.' e '.$dt2;
			//$registros= Caixa::all();
    $registros= Caixa::whereBetween('data',[$dt1 ,$dt2])->orderBy('data', 'desc')->get();
		
		return view('caixa.relatorio_caixa',compact('registros','data'));
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

			$valor = $this->strToFloat($str);

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
	
/*public function selecionar_datas($dt)
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

 	return response()->json(array(
											'$dt1' => $dt1 ,'$dt2' => $dt2,
											'data_inicio'=>$data_inicio
			              ));
	}

*/

	public function selecionar_datas_post(Request $request)
	{

	/*$teste = $request->teste;
	return view('caixa.relatorio_caixa',compact(''));
	*/
	$params = Request::all();
	//$params = $request;	
//	dd($params);
	//dd($params['data']);

	$periodo= $params['periodo'];

	if($periodo == 'umadata'){

		$data = $params['data'];
		//dd($data);
		if($data && $data!== ''){

			 $registros= Caixa::whereDate('data',$data)->orderBy('id', 'desc')->get();

			return view('caixa.relatorio_caixa',compact('data','registros'));

		}else{
			$mensagem_sem_data= 'você não selecionou nenhuma data.';
			return view('caixa.relatorio_caixa')->with('mensagem_sem_data', $mensagem_sem_data);
		}

	}elseif($periodo == 'duasdatas'){
			$dt1 = $params['data1'];
			$dt2= $params['data2'];

				
      	if($dt1 == '' && $dt2 == ''){
		         $mensagem_sem_data= 'você não selecionou nenhuma data.';
							return view('caixa.relatorio_caixa')->with('mensagem_sem_data',$mensagem_sem_data);
		    }

 				if(($dt1 == '' && $dt2 != '') || ($dt1 != '' && $dt2 == '') ){
					$data = ($dt1 != '') ? $dt1 : $dt2;
					$registros= Caixa::whereDate('data',$data)->orderBy('id', 'desc')->get();
					 $mensagem_uma_data  = 'você selecionou apenas uma data.O resultado mostrado é o resultado para essa data.';
						return view('caixa.relatorio_caixa',compact('data','mensagem_uma_data','registros'));
        
				}

				if($dt1  != '' && $dt2 != ''){
						if($dt1 ==  $dt2){
						$data = $dt1;
		        $mensagem_uma_data  = 'você selecionou datas iguais.O resultado mostrado é o resultado para essa data.';
						$registros= Caixa::whereDate('data',$dt1)->orderBy('id', 'desc')->get();
						return view('caixa.relatorio_caixa',compact('data','mensagem_uma_data','registros'));
						}elseif($dt2 > $dt1){
						$registros= Caixa::whereBetween('data',[$dt1 ,$dt2])->orderBy('data', 'desc')->get();
						$data = 'entre '.$dt1.' e '.$dt2;
						return view('caixa.relatorio_caixa',compact('registros','data'));
						}else{
						$registros= Caixa::whereBetween('data',[$dt2 ,$dt1])->orderBy('data', 'desc')->get();
						$data = 'entre '.$dt2.' e '.$dt1;
						return view('caixa.relatorio_caixa',compact('registros','data'));
						}
        }
       
		
	}else{
		return response()->json('outro');
	}

	}
	

}
