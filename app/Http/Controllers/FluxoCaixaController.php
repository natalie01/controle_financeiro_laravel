<?php

namespace projeto_laravel\Http\Controllers;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;
use Request;
class FluxoCaixaController extends Controller
{


   public function index()
    {
        return view('fluxocaixadatas');
    }

  public function resultado(Request $request){
			$datas = request::all();
			
			return view('fluxocaixaresultado')->with('datas',$datas);
					
	}	
}
