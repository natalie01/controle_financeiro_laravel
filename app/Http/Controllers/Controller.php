<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
		
//funcao para converter a string para float
		public function strToFloat($str) { 
				if(strstr($str, ",")) { 
					$str = str_replace(",", ".", $str); // substitui ',' por '.' 
				} 
		
				if(preg_match("#([0-9\.]+)#", $str, $match)) { // procura por  '.' 
					return floatval($match[0]); 
				} else { 
					return floatval($str); 
				} 
			} 

	public function dataHoje() { 
	  $hoje= Carbon::now();
		$datahoje= $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
		return $datahoje;
	}
	
	public function getUserId(){
		$user = Auth::user();
		return $user->id;
	}

	public function teste($modelo,$view,$data,$mensagemo){
	//dd($params);
	$dados = DB::table($modelo)->where($query,'<' ,$data)->get();

	return view($view,compact('dados','mensagem'));

	}

public function getView($params,$modelo,$view,$query){
//dd($params);
	$periodo= $params['periodo'];

	if($periodo == 'umadata'){

		$data = $params['data'];
		
		//dd($data);

		if($data && $data!== ''){
			 $resultados=  DB::table($modelo)->whereDate($query,$data)->orderBy('id', 'desc')->get();

				return view($view,compact('data','resultados'));

		}else{
			$mensagem_sem_data= 'você não selecionou nenhuma data.';
			return view($view)->with('mensagem_sem_data', $mensagem_sem_data);
		}

	}elseif($periodo == 'duasdatas'){
			$dt1 = $params['data1'];
			$dt2= $params['data2'];

				
      	if($dt1 == '' && $dt2 == ''){
		         $mensagem_sem_data= 'você não selecionou nenhuma data.';
							return view($view)->with('mensagem_sem_data',$mensagem_sem_data);
		    }

 				if(($dt1 == '' && $dt2 != '') || ($dt1 != '' && $dt2 == '') ){
					$data = ($dt1 != '') ? $dt1 : $dt2;
					$resultados=  DB::table($modelo)->whereDate($query,$data)->orderBy('id', 'desc')->get();
					 $mensagem_uma_data  = 'você selecionou apenas uma data.O resultado mostrado é o resultado para essa data.';
						return view($view,compact('data','mensagem_uma_data','resultados'));
        
				}

				if($dt1  != '' && $dt2 != ''){
						if($dt1 ==  $dt2){
							$data = $dt1;
				      $mensagem_uma_data  = 'você selecionou datas iguais.O resultado mostrado é o resultado para essa data.';
							$resultados=  DB::table($modelo)->whereDate($query,$dt1)->orderBy('id', 'desc')->get();
							return view($view,compact('data','mensagem_uma_data','resultados'));
						}elseif($dt2 > $dt1){
							$resultados=  DB::table($modelo)->whereBetween($query,[$dt1 ,$dt2])->orderBy($query, 'desc')->get();
							$data = 'entre '.$dt1.' e '.$dt2;
							return view($view,compact('resultados','data'));
						}else{
							$resultados=  DB::table($modelo)->whereBetween($query,[$dt2 ,$dt1])->orderBy($query, 'desc')->get();
							$data = 'entre '.$dt2.' e '.$dt1;
							return view($view,compact('resultados','data'));
						}
        }
	
		}else{
			return response()->json('outro');
		}
}
}
