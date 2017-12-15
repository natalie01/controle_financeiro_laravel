<?php

namespace projeto_laravel\Http\Controllers;
use Carbon\Carbon;
use projeto_laravel\Empresa;
use projeto_laravel\Caixa;
use projeto_laravel\ContaReceber;
use projeto_laravel\ContaPagar;
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
				$user_id = $this->getUserId();

	  	$hoje = Carbon::now();
			//dd($hoje);
			$dt1 = $hoje->year.'-'.$hoje->month.'-'.$hoje->day;
			

		//	$ontem = Carbon::now()->subDays(1); 

			$dt2 = $hoje->year.'-'.$hoje->month.'-'.'01';  //primeiro dia do mes atual
			
		  $dt3 = Carbon::parse($dt2); 
			$dt4 = $dt3->subDays(1);  //último dia do mes anterior

			$dt5 = $dt4->year.'-'.$dt4->month.'-'.$dt4->day; //último dia do mes anterior formato ano-mes-dia

				$soma_receitas = Caixa::select('valor')
													->where('tipo','like','%receita%')
													->where('user_id','=',$user_id)
													->whereBetween('data',[$dt2 ,$dt1])
													->sum('valor');

				$soma_despesas = Caixa::select('valor')
													->where('tipo','like','%despesa%')
													->where('user_id','=',$user_id)
													->whereBetween('data',[$dt2 ,$dt1])
													->sum('valor');

				$saldo_atual = Empresa::where('user_id','=',$user_id)
													->pluck('saldo_atual')->first();


				$saldo = $soma_receitas - $soma_despesas + $saldo_atual;

				$recebimentos_previstos_hoje = ContaReceber::select('valor_inicial')
													->where('user_id','=',$user_id)
													->where('datavencimento','=' ,$dt1)
													->sum('valor_inicial');

				$pagamentos_previstos_hoje =ContaPagar::select('valor_inicial')
													->where('user_id','=',$user_id)
													->where('datavencimento','=' ,$dt1)
													->sum('valor_inicial');


				$recebimentos_previstos_mes =  ContaReceber::select('valor_inicial')
													->where('user_id','=',$user_id)
													->whereBetween('datavencimento',[$dt2 ,$dt1])
													->sum('valor_inicial');

				$pagamentos_previstos_mes =  ContaPagar::select('valor_inicial')
													->where('user_id','=',$user_id)
													->whereBetween('datavencimento',[$dt2 ,$dt1])
													->sum('valor_inicial');



				$recebimentos_atraso_mes =  ContaReceber::select('valor_inicial')
													->where('user_id','=',$user_id)
													->whereBetween('datavencimento',[$dt2 ,$dt1])
													->sum('valor_inicial');

				$pagamentos_atraso_mes =  ContaPagar::select('valor_inicial')
													->where('user_id','=',$user_id)
													->whereBetween('datavencimento',[$dt2 ,$dt1])
													->sum('valor_inicial');
				//dd($soma_receitas);
        //dd($soma_despesas);
        return view('home',
							compact('dt','soma_receitas','soma_despesas','saldo',
							'recebimentos_previstos_hoje','pagamentos_previstos_hoje',
							'recebimentos_previstos_mes','pagamentos_previstos_mes',
							'recebimentos_atraso_mes','pagamentos_atraso_mes'				
							));
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
			$user_id = $this->getUserId();

			$nome_empresa = $params['nome_empresa'];
			$cidade = $params['cidade'];
			$estado = $params['estado'];
		
			$dt = $this->dataHoje();
	
			$saldo_inicial = $this->strToFloat($params['saldo_inicial']);
			$nao_informado = '';

			if(isset($params['nao_informado'])){
				$saldo_inicial = 0;
				//$nao_informado =$params['nao_informado'];
			}
				
			//dd($params);
	
				Empresa::create(['nome_empresa'=>$nome_empresa,
														'cidade'=>$cidade,
														'estado' => $estado,
														'saldo_inicial'=>$saldo_inicial,
														'saldo_atual'=>$saldo_inicial,
														'data_inicial'=>$dt,
														'user_id'=>$user_id
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
