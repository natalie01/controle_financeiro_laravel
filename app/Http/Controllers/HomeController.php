<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use projeto_laravel\Empresa;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				/*$hoje= Carbon::now();
				$dt = $hoje->toFormattedDateString(); 
				*/
				$dt = $this->diaHoje();
				//$hoje =$datahoje->date;
        return view('home')->with('hoje',$dt);
				//return response()->json($datahoje->month);
				//return response()->json($dt);

    }

    public function empresa()
    {
				$dt = $this->diaHoje();
				//$hoje =$datahoje->date;
        return view('empresa')->with('hoje',$dt);
    }

    public function empresa_salvar(Request $request)
    {
				$params = Request::all();

			$nome_empresa = $params['nome_empresa'];
			$cidade = $params['cidade'];
			$estado = $params['estado'];
		
		$dt = $this->dataHoje();
	
			$saldo_inicial = $this->strToFloat($params['saldo_inicial']);
			$nao_informado = '';

			if(isset($params['nao_informado'])){
				$saldo_inicial = null;
				//$nao_informado =$params['nao_informado'];
			}
				
			//dd($params);
	
				Empresa::create(['nome_empresa'=>$nome_empresa,
														'cidade'=>$cidade,
														'estado' => $estado,
														'saldo_inicial'=>$saldo_inicial,
														'data_inicial'=>$dt,
														]);
        return view('home')->with('hoje',$dt);
	
    }

    public function diaHoje()
    {
				$hoje= Carbon::now();
				$dt_hoje = $hoje->toFormattedDateString(); 
				//$hoje =$datahoje->date;
        return $dt_hoje;
				//return response()->json($datahoje->month);
				//return response()->json($dt);

    }
}
