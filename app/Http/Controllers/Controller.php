<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
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
}
